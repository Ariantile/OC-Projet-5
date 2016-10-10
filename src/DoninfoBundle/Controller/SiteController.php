<?php

namespace DoninfoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SiteController extends Controller
{
    public function accueilAction()
    {
        return $this->render('DoninfoBundle:Site:accueil.html.twig');
    }
    
    public function donateurAction()
    {
        return $this->render('DoninfoBundle:Site:donateur.html.twig');
    }
    
    public function demandeurAction()
    {
        return $this->render('DoninfoBundle:Site:demandeur.html.twig');
    }
    
    public function inscriptionAction()
    {
        return $this->render('DoninfoBundle:Site:inscription.html.twig');
    }
    
    public function connexionAction()
    {
        return $this->render('DoninfoBundle:Site:connexion.html.twig');
    }
    
    public function contactAction()
    {
        return $this->render('DoninfoBundle:Site:contact.html.twig');
    }
    
    public function mentionsAction()
    {
        return $this->render('DoninfoBundle:Site:mentions.html.twig');
    }
    
    public function indexAction()
    {
        return $this->render('DoninfoBundle:Site:index.html.twig');
    }
    
    public function donationsAction()
    {
        return $this->render('DoninfoBundle:Site:donations.html.twig');
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
