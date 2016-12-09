<?php
// src/DoninfoBundle/SendContact/DoninfoSendContact.php

namespace DoninfoBundle\SendContact;

use \DateTime;

class DoninfoSendContact
{
    private $mailer;
    private $twig;
    private $doctrine;
    private $container;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig, $doctrine, $container)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->doctrine = $doctrine;
        $this->container = $container;
    }

    /**
     * Enregistrement et envoi du formulaire de contact membre
     *
     */
    public function sendContactMembre($contact, $user)
    {
        $em = $this->doctrine->getManager();
        $date = new \DateTime('now');
        
        $contact->setDatecontactm($date);
        $contact->setUser($user);
        
        $em->persist($contact);
        $em->flush();
    }
    
    /**
     * Enregistrement et envoi du formulaire de contact membre
     *
     */
    public function sendContactPublic($contact)
    {
        $em = $this->doctrine->getManager();
        $date = new \DateTime('now');
        
        $contact->setDatecontactp($date);
        
        $em->persist($contact);
        $em->flush();
    }
}
