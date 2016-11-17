<?php

namespace DoninfoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use DoninfoBundle\Entity\User;
use DoninfoBundle\Entity\Annonce;
use DoninfoBundle\Entity\Recherche;
use DoninfoBundle\Entity\ContactPublic;
use DoninfoBundle\Entity\ContactMembre;
use DoninfoBundle\Form\Type\InscriptionType;
use DoninfoBundle\Form\Type\AnnonceType;
use DoninfoBundle\Form\Type\RechercheType;
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
    
    public function inscriptiondoneAction() {
        
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
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
        
            $session = $this->container->get('session');
            
            $user = $this->get('security.token_storage')->getToken()->getUser();
             
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
        $annonce = new Annonce();
        $form = $this->get('form.factory')->create(AnnonceType::class, $annonce);
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) 
        {
            $poster = $this->container->get('doninfo.poster_annonce');
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $poster->createAnnonce($annonce, $user);
            return $this->redirectToRoute('doninfo_annonce', array('id' => $annonce->getId()));
        }
        
        return $this->render('DoninfoBundle:Site:postannonce.html.twig', array(
                'annonce'  => $form->createView()
        ));
    }
    
    public function contactPublicAction(Request $request)
    {
        $contact = new ContactPublic();
        $form  = $this->get('form.factory')->create(ContactPublicType::class, $contact);
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $mail = $this->container->get('doninfo.send_contact');
            $mail->sendContactPublic($contact);
        }
        
        return $this->render('DoninfoBundle:Site:contact.html.twig', array(
                'contact'   => $form->createView()
        ));
    }
    
    public function contactMembreAction(Request $request)
    {
        $contact = new ContactMembre();
        $form = $this->get('form.factory')->create(ContactMembreType::class, $contact);
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $mail = $this->container->get('doninfo.send_contact');
            $mail->sendContactMembre($contact);
        }
        
        return $this->render('DoninfoBundle:Site:contactmembre.html.twig', array(
                'contactmembre' => $form->createView()
        ));
    }
    
    public function membreAction($id)
    {
        return $this->render('DoninfoBundle:Site:membre.html.twig');
    }
    
    public function annonceAction($id)
    {
        
        $em = $this->getDoctrine()->getManager();
        
        $annonce = $em->getRepository('DoninfoBundle:Annonce')->find($id);
        
        if (!$annonce) {
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        }
        
        $images     = $annonce->getImages();
        $objets     = $annonce->getObjets();
        $messages   = $annonce->getMessages();
        
        $owner      = $annonce->getUser();
        $courriel   = $owner->getCourriel();
        $nom        = $owner->getNomstructure();
        

        
        return $this->render('DoninfoBundle:Site:annonce.html.twig', array(
            'annonce'   => $annonce,
            'images'    => $images,
            'objets'    => $objets,
            'messages'  => $messages,
            'courriel'  => $courriel,
            'nom'       => $nom
        ));
    }

    public function infosAction()
    {
        return $this->render('DoninfoBundle:Site:plusinfos.html.twig');
    }
    
    public function donationsAction(Request $request)
    {
        $recherche = new Recherche();
        $form = $this->get('form.factory')->create(RechercheType::class, $recherche);
        
        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT a FROM DoninfoBundle:Annonce a";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 5)
        );
        
        return $this->render('DoninfoBundle:Site:donations.html.twig', array(
                'recherche'  => $form->createView(),
                'pagination' => $pagination
        ));
    }
    
    public function demandesAction()
    {
        return $this->render('DoninfoBundle:Site:demandes.html.twig');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function demandeAction($id)
    {
        return $this->render('DoninfoBundle:Site:demande.html.twig');
    }
    
    public function tutorielAction()
    {
        return $this->render('DoninfoBundle:Site:tutoriel.html.twig');
    }
    
    public function infomembreAction($id)
    {
        return $this->render('DoninfoBundle:Site:infomembre.html.twig');
    }
    
    public function suiviAction($id)
    {
        return $this->render('DoninfoBundle:Site:suivi.html.twig');
    }
}
