<?php

namespace DoninfoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use DoninfoBundle\Entity\User;
use DoninfoBundle\Entity\Annonce;
use DoninfoBundle\Entity\Recherche;
use DoninfoBundle\Form\Type\InscriptionType;
use DoninfoBundle\Form\Type\AnnonceType;
use DoninfoBundle\Form\Type\RechercheType;
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
            /*$session->getFlashBag()->add('erreur', 'louvre.flash.erreur.billet');*/
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
    
    public function contactAction()
    {
        return $this->render('DoninfoBundle:Site:contact.html.twig');
    }
    
    public function infosAction()
    {
        return $this->render('DoninfoBundle:Site:plusinfos.html.twig');
    }
    
    public function postAnnonceAction()
    {
        $annonce = new Annonce();
        $form = $this->get('form.factory')->create(AnnonceType::class, $annonce);
        return $this->render('DoninfoBundle:Site:postannonce.html.twig', array(
                'annonce'  => $form->createView()
        ));
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
    
    public function contactmembreAction()
    {
        return $this->render('DoninfoBundle:Site:contactmembre.html.twig');
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
