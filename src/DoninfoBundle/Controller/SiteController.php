<?php

namespace DoninfoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use DoninfoBundle\Entity\User;
use DoninfoBundle\Entity\Favoris;
use DoninfoBundle\Entity\Annonce;
use DoninfoBundle\Entity\Recherche;
use DoninfoBundle\Entity\Message;
use DoninfoBundle\Entity\ContactPublic;
use DoninfoBundle\Entity\ContactMembre;
use DoninfoBundle\Form\Type\InscriptionType;
use DoninfoBundle\Form\Type\AnnonceType;
use DoninfoBundle\Form\Type\FavorisType;
use DoninfoBundle\Form\Type\RemoveFavorisType;
use DoninfoBundle\Form\Type\RechercheType;
use DoninfoBundle\Form\Type\MessageType;
use DoninfoBundle\Form\Type\ContactPublicType;
use DoninfoBundle\Form\Type\ContactMembreType;
use \DateTime;

class SiteController extends Controller
{
    public function accueilAction()
    {
        return $this->render('DoninfoBundle:Site:accueil.html.twig');
    }
    
    public function inscriptionAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
        
            $session = $this->container->get('session');
            
            $user = $this->get('security.token_storage')->getToken()->getUser();
             
            $session->getFlashBag()->add('erreur', 'Vous êtes déjà connecté.');
            
            return $this->redirectToRoute('doninfo_membre', array('id' => $user->getId()));
        }
            
        $user = new User();
        $form = $this->get('form.factory')->create(InscriptionType::class, $user);
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) 
        {
            $inscription = $this->container->get('doninfo.inscription');
            $activation  = $this->container->get('doninfo.send_mail');
            
            $inscription->createUser($user);
            
            $courriel    = $user->getCourriel();
            $code_active = $user->getActivation();
            
            $activation->sendMailActivation($courriel, $code_active);
            
            return $this->redirectToRoute('doninfo_inscription_done');
        }
        
        return $this->render('DoninfoBundle:Site:inscription.html.twig', array(
                'inscription'  => $form->createView()
        ));
    }
    
    public function inscriptiondoneAction() 
    {
        
        return $this->render('DoninfoBundle:Site:inscriptiondone.html.twig');
        
    }
    
    public function activationAction(Request $request, $active_code)
    {
        $session = $this->container->get('session');
        
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            
            $user = $this->get('security.token_storage')->getToken()->getUser();
             
            $session->getFlashBag()->add('erreur', 'Activation impossible, utilisateur déjà connecté.');
            
            return $this->redirectToRoute('doninfo_membre', array('id' => $user->getId()));
            
        }
        
        $em = $this->getDoctrine()->getManager();
        
        $user = $em->getRepository('DoninfoBundle:User')->findUserByActivationCode($active_code);
        
        if (!$user) {
            
            throw new NotFoundHttpException("Aucun utilisateur trouvé.");
            
        } else if ( ($user->getStatut() === 'Valide') || ($user->getStatut() === 'Banni') ) {
            
            $session->getFlashBag()->add('erreur', 'Activation impossible, le compte selectionné est déjà activé ou banni.');
            
            return $this->redirectToRoute('doninfo_connexion');
            
        } else {
            
            $user->setStatut('Valide');
            $em->flush();
            
            $session->getFlashBag()->add('message', 'Votre compte à été activé avec succès. Vous pouvez maintenant vous connecter.');
            
            return $this->redirectToRoute('doninfo_connexion');
        }
    }
    
    public function connexionAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) 
        {
            $session    = $this->container->get('session');
            $user       = $this->get('security.token_storage')->getToken()->getUser();
            $session->getFlashBag()->add('erreur', 'Vous êtes déjà connecté.');
            
            return $this->redirectToRoute('doninfo_membre', array('id' => $user->getId()));
            
        } else if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            
            return $this->redirectToRoute('doninfo_accueil');
            
        }
        
        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render('DoninfoBundle:Security:connexion.html.twig', array(
            'last_username' => $authenticationUtils->getLastUsername(),
            'error'         => $authenticationUtils->getLastAuthenticationError(),
        ));
    }
    
    public function postAnnonceAction(Request $request)
    {
        $annonce    = new Annonce();
        $session    = $this->container->get('session');
        $user       = $this->get('security.token_storage')->getToken()->getUser();
        
        if (!$user)
        {
            throw new AccessDeniedException('Vous devez être authentifié pour poster une annonce!');
        }
        
        $adresse    = $user->getAdresse();
        $ville      = $user->getVille();
        $codeps     = $user->getCodepostal();

        $form       = $this->get('form.factory')->create(AnnonceType::class, $annonce);
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) 
        {
            $poster = $this->container->get('doninfo.poster_annonce');
            $user   = $this->get('security.token_storage')->getToken()->getUser();
            $poster->createAnnonce($annonce, $user);
            return $this->redirectToRoute('doninfo_annonce', array('id' => $annonce->getId()));
        }
        
        return $this->render('DoninfoBundle:Site:postannonce.html.twig', array(
                'annonce'  => $form->createView(),
                'adresse_val'  => $adresse,
                'ville_val'    => $ville,
                'codeps_val'   => $codeps
        ));
    }
    
    public function contactPublicAction(Request $request)
    {
        $contact    = new ContactPublic();
        $form       = $this->get('form.factory')->create(ContactPublicType::class, $contact);
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $mail = $this->container->get('doninfo.send_contact');
            $mail->sendContactPublic($contact);
        }
        
        return $this->render('DoninfoBundle:Contact:contact.html.twig', array(
                'contact'   => $form->createView()
        ));
    }
    
    public function contactMembreAction(Request $request)
    {
        $contact    = new ContactMembre();
        $form       = $this->get('form.factory')->create(ContactMembreType::class, $contact);
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $mail = $this->container->get('doninfo.send_contact');
            $mail->sendContactMembre($contact);
        }
        
        return $this->render('DoninfoBundle:Contact:contactmembre.html.twig', array(
                'contactmembre' => $form->createView()
        ));
    }
    
    public function annonceAction($id, Request $request)
    {
        $em             = $this->getDoctrine()->getManager();
        $session        = $this->container->get('session');
        $annonce        = $em->getRepository('DoninfoBundle:Annonce')->getAnnonce($id);
        
        if (!$annonce) 
        {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }
        
        $message        = new Message();
        $favoris        = new Favoris();
        $user           = $this->get('security.token_storage')->getToken()->getUser();
        
        if ($user !== $annonce->getUser())
        {
            $favorisuser    = $em->getRepository('DoninfoBundle:Favoris')->findOneByAnnonce($id);
            $form           = $this->get('form.factory')->create(MessageType::class, $message);
            $messages       = $annonce->getMessages();
            
            if (!$favorisuser)
            {
                $formfav = $this->get('form.factory')->create(FavorisType::class, $favoris);
            
            } else {
            
                $formfav = $this->get('form.factory')->create(RemoveFavorisType::class, $favoris);
            }
        }
        
        $images         = $annonce->getImages();
        $objets         = $annonce->getObjets();
        $nom            = $annonce->getUser()->getNomstructure();
        $departement    = $annonce->getDepartement()->getNom();        
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) 
        {
            $session    = $this->container->get('session'); 
            $poster     = $this->container->get('doninfo.send_message');
            
            $poster->createMessage($message, $annonce, $user);
            $session->getFlashBag()->add('message', 'Votre message a été envoyé avec succès.');
        } 
        
        if (isset($formfav))
        {
            if ($request->isMethod('POST') && 
                $formfav->has('ajouter') &&
                $formfav->handleRequest($request)->isValid()) 
            { 
                $favoris->setUser($user);
                $favoris->setAnnonce($annonce);

                $em->persist($favoris);
                $em->flush();

                $session->getFlashBag()->add('message', 'Annonce ajoutée aux favoris.');
                return $this->redirectToRoute('doninfo_annonce', array('id' => $id));
            } 
        
            if ($request->isMethod('POST') && 
                $formfav->has('retirer') && 
                $formfav->handleRequest($request)->isValid())
            {
                $em->remove($favorisuser);
                $em->flush();

                $session->getFlashBag()->add('message', 'Annonce retirée des favoris.');
                return $this->redirectToRoute('doninfo_annonce', array('id' => $id));
            }
            
            return $this->render('DoninfoBundle:Site:annonce.html.twig', array(
                'annonce'       => $annonce,
                'images'        => $images,
                'objets'        => $objets,
                'messages'      => $messages,
                'nom'           => $nom,
                'departement'   => $departement,
                'message'       => $form->createView(),
                'formfav'       => $formfav->createView()
            ));
        } else {
            return $this->render('DoninfoBundle:Site:annonce.html.twig', array(
                'annonce'       => $annonce,
                'images'        => $images,
                'objets'        => $objets,
                'nom'           => $nom,
                'departement'   => $departement, 
            ));
        }
    }
    
    public function editAnnonceAction(Annonce $annonce, Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        if (!$user)
        {
            throw new AccessDeniedException('Vous devez être authentifié pour effectuer cette action.');
        } else if ($user !== $annonce->getUser()) {
            throw new AccessDeniedException('Édition impossible.');
        } else if ($annonce->getStatut() === 'Terminee') {
            $request->getSession()->getFlashBag()->add('message', 'Impossible d\'éditer une annonce terminée.');
            $referer = $request->headers->get('referer');
            return $this->redirect($referer);
        }
        
        $form = $this->get('form.factory')->create(AnnonceType::class, $annonce);
        
        $adresse    = $annonce->getAdresse();
        $ville      = $annonce->getVille();
        $codeps     = $annonce->getCodepostal();

        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) 
        {
            $em = $this->getDoctrine()->getManager();
            
            $updater = $this->container->get('doninfo.poster_annonce');
            $updater->updateAnnonce($annonce, $user);
            
            $request->getSession()->getFlashBag()->add('message', 'Modifications enregistrée.');
            return $this->redirectToRoute('doninfo_annonce', array('id' => $annonce->getId()));
        }
        
        return $this->render('DoninfoBundle:Site:annonceedit.html.twig', array(
                'data'          => $annonce,
                'adresse_val'   => $adresse,
                'ville_val'     => $ville,
                'codeps_val'    => $codeps,
                'annonce'       => $form->createView(),
        ));
    } 
    
    public function donationsAction(Request $request)
    {
        $recherche  = new Recherche();
        $type       = 'Donation';
        $limit      = 10;
        
        $form       = $this->get('form.factory')->create(RechercheType::class, $recherche);
        $annonces   = $this->container->get('doninfo.list_annonce');
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) 
        {
            $pagination = $annonces->rechercheAnnonce($type, $limit, $recherche);
        } else {
            $pagination = $annonces->listerAnnonceAll($type, $limit);
        }

        return $this->render('DoninfoBundle:Site:donations.html.twig', array(
                'recherche'  => $form->createView(),
                'pagination' => $pagination
        ));
    }
    
    public function besoinsAction(Request $request)
    {
        $recherche  = new Recherche();
        $type       = 'Besoin';
        $limit      = 10;
        
        $form       = $this->get('form.factory')->create(RechercheType::class, $recherche);
        $annonces   = $this->container->get('doninfo.list_annonce');
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) 
        {        
            $pagination = $annonces->rechercheAnnonce($type, $limit, $recherche);
        } else {
            $pagination = $annonces->listerAnnonceAll($type, $limit);
        }
        
        return $this->render('DoninfoBundle:Site:donations.html.twig', array(
                'recherche'  => $form->createView(),
                'pagination' => $pagination
        ));
        
    }
    
    public function membreAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        if (!$user) 
        {
            throw new AccessDeniedException("Vous devez être authentifié pour accéder à cette page.");
        }
        
        $annonces   = $this->container->get('doninfo.list_annonce');
        $limit      = 5;
        $statutOn   = 'En cours';
        
        $paginationOn   = $annonces->listerAnnonceMembre($user, $limit, $statutOn);
        
        return $this->render('DoninfoBundle:Membre:membreacc.html.twig', array(
                'pagination'    => $paginationOn,
        ));
    }
    
    public function membreEditAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        if (!$user) 
        {
            throw new AccessDeniedException("Vous devez être authentifié pour accéder à cette page.");
        }
        
        $userid     = $user->getId();
        $em         = $this->getDoctrine()->getManager();
        
        $edituser   = $em->getRepository('DoninfoBundle:User')->findOneById($userid);
        $form       = $this->get('form.factory')->create(InscriptionType::class, $edituser); 
        
        $form->remove('typestructure')
             ->remove('activite')
             ->remove('sirenrna')
             ->remove('ape')
             ->remove('courriel')
             ->remove('password');
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) 
        {     
            $updater = $this->container->get('doninfo.inscription');
            $updater->updateUser($edituser);
            
            $request->getSession()->getFlashBag()->add('message', 'Modifications enregistrées.');
            return $this->redirectToRoute('doninfo_membre');
        }
        
        return $this->render('DoninfoBundle:Membre:editmembre.html.twig', array(
            'editmembre' => $form->createView(),
        ));
    }
 
    public function favorisAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        if (!$user) 
        {
            throw new AccessDeniedException("Vous devez être authentifié pour accéder à cette page.");
        }
        
        $annonces   = $this->container->get('doninfo.list_annonce');
        $limit      = 10;
        
        $pagination = $annonces->listerAnnonceMembreFavoris($user, $limit);
        
        return $this->render('DoninfoBundle:Membre:membrefavoris.html.twig', array(
            'pagination'    => $pagination
        ));
    }
    
    public function membrearchiveAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        if (!$user) 
        {
            throw new AccessDeniedException("Vous devez être authentifié pour accéder à cette page.");
        }
        
        $annonces   = $this->container->get('doninfo.list_annonce');
        $limit      = 5;
        $statutOff  = 'Terminee';
        
        $paginationOff  = $annonces->listerAnnonceMembre($user, $limit, $statutOff);
        
        return $this->render('DoninfoBundle:Membre:membrearchive.html.twig', array(
            'paginationOff' => $paginationOff
        ));
    }
    
    public function membreinfosAction()
    {
        return $this->render('DoninfoBundle:Membre:membreinfos.html.twig');
    }
    
    public function messageviewAction($id, Request $request)
    {
        $em         = $this->getDoctrine()->getManager();
        $session    = $this->container->get('session');
        $user       = $this->get('security.token_storage')->getToken()->getUser();
        
        $message    = $em->getRepository('DoninfoBundle:Message')->getMessage($id);
        
        if (!$message) 
        {
            throw new NotFoundHttpException("Le message d'id ".$id." n'existe pas.");
        } else if ($message->getAnnonce()->getUser() !== $user && $message->getUser() !== $user) {
            throw new AccessDeniedException("vous n'etes pas autorise a accéder a la page requise");
        }
        
        if ($message->getNewm() === 0) {
            $message->setNewm(1);
            $em->flush();
        }

        return $this->render('DoninfoBundle:Membre:messageview.html.twig', array (
            'message' => $message
        ));
    }
    
    public function membremessagesAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        if (!$user) 
        {
            throw new AccessDeniedException("Vous devez être authentifié pour accéder à cette page.");
        }
        
        $messages   = $this->container->get('doninfo.list_messages');
        $limit      = 10;
        $new        = 0;
        
        $pagination  = $messages->listerMessages($user, $limit, $new);
        
        return $this->render('DoninfoBundle:Membre:membremessages.html.twig', array (
            'pagination' => $pagination
        ));
    }
    
    public function membremessagesoldAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        if (!$user) 
        {
            throw new AccessDeniedException("Vous devez être authentifié pour accéder à cette page.");
        }
        
        $messages   = $this->container->get('doninfo.list_messages');
        $limit      = 10;
        $new        = 1;
        
        $pagination  = $messages->listerMessages($user, $limit, $new);
        
        return $this->render('DoninfoBundle:Membre:membremessagesold.html.twig', array (
            'pagination' => $pagination
        ));
    }
    
    public function membremessagessendAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        if (!$user) 
        {
            throw new AccessDeniedException("Vous devez être authentifié pour accéder à cette page.");
        }
        
        $messages   = $this->container->get('doninfo.list_messages');
        $limit      = 10;
        
        $pagination  = $messages->listerMessagesSend($user, $limit);
        
        return $this->render('DoninfoBundle:Membre:membremessagessend.html.twig', array (
            'pagination' => $pagination
        ));
    }
    
}
