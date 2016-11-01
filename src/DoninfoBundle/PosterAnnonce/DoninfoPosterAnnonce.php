<?php
// src/DoninfoBundle/PosterAnnonce/DoninfoPosterAnnonce.php

namespace DoninfoBundle\Inscription;

use \DateTime;

class DoninfoInscription
{

    protected $doctrine;
    
    public function __construct($doctrine)
    {      
        $this->doctrine = $doctrine;
    }

    /**
     * Poster une annonce
     *
     */
    public function createAnnonce($annonce)
    {
        $em = $this->doctrine->getManager();
        $date = new \DateTime('now');
        
        $user->setTypestructure('Entreprise');
        $user->setStatut('Inscrit');
        $user->setDateinscription($date);
        $user->setUsername($user->getCourriel());
        $user->setSalt('');
        $user->setRoles(array('ROLE_USER'));
                    
        $em->persist($annonce);
        $em->flush();
    }
}
