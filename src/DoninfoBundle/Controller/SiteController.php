<?php

namespace DoninfoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        $user = new User();
        $form = $this->get('form.factory')->create(InscriptionType::class, $user);
        
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) 
        {
            $inscription = $this->container->get('doninfo.inscription');
            $inscription->createUser($user);
            return $this->redirectToRoute('doninfo_inscription_done');
        }
        
        return $this->render('DoninfoBundle:Site:inscription.html.twig', array(
                'inscription'  => $form->createView()
        ));
    }
    
    public function connexionAction(Request $request)
    {
        
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('doninfo_index');
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
            return $this->redirectToRoute('doninfo_index');
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
    
    
    
    
    
    
    
    
    
    public function infosAction()
    {
        return $this->render('DoninfoBundle:Site:plusinfos.html.twig');
    }
    
    public function donationsAction()
    {
        $recherche = new Recherche();
        $form = $this->get('form.factory')->create(RechercheType::class, $recherche);        
        return $this->render('DoninfoBundle:Site:donations.html.twig', array(
                'recherche'  => $form->createView()
        ));
    }
    
    public function donAction($id)
    {
        return $this->render('DoninfoBundle:Site:don.html.twig');
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
    
    public function membreAction($id)
    {
        return $this->render('DoninfoBundle:Site:membre.html.twig');
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
