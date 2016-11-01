<?php
// src/DoninfoBundle/Inscription/DoninfoInscription.php

namespace DoninfoBundle\Inscription;

use \DateTime;

class DoninfoInscription
{

    protected $doctrine;
    
    public function __construct($doctrine, $encoder)
    {      
        $this->doctrine = $doctrine;
        $this->encoder = $encoder;
    }

    /**
     * Inscription d'un utilisateur
     *
     */
    public function createUser($user)
    {
        $em = $this->doctrine->getManager();
        $date = new \DateTime('now');
        
        $user->setTypestructure('Entreprise');
        $user->setStatut('Inscrit');
        $user->setDateinscription($date);
        $user->setUsername($user->getCourriel());
        $user->setSalt('');
        $user->setRoles(array('ROLE_USER'));
        
        $password = $user->getPassword();
        $password_encode = $this->encoder->encodePassword($user, $password);
        $user->setPassword($password_encode);
            
        $em->persist($user);
        $em->flush();
    }
}
