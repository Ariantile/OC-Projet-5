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
        
        $user->setStatut('Inscrit');
        $user->setDateinscription($date);
        $user->setUsername($user->getCourriel());
        $user->setSalt(md5(uniqid()));
        $user->setRoles(array('ROLE_USER'));
        $user->setActivation(sha1($user->getCourriel() + microtime()));
        
        $password = $user->getPassword();
        $password_encode = $this->encoder->encodePassword($user, $password);
        $user->setPassword($password_encode);
            
        $em->persist($user);
        $em->flush();
    }
    
    
    /**
     * Update d'un utilisateur
     *
     */
    public function updateUser($user)
    {
        $em = $this->doctrine->getManager();
        $em->flush();
    }
    
}
