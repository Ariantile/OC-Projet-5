<?php
// src/DoninfoBundle/PosterAnnonce/DoninfoPosterAnnonce.php

namespace DoninfoBundle\PosterAnnonce;

use \DateTime;

class DoninfoPosterAnnonce
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
    public function createAnnonce($annonce, $user)
    {
        $em = $this->doctrine->getManager();
        $date = new \DateTime('now');
        $annonce->setDatecreation($date);
        $annonce->setNumero(uniqid());
        $annonce->setStatut('En cours');
        $annonce->setUser($user);
        $annonce->setType('Donation');
        
        $images = $annonce->getImages();
        $objets = $annonce->getObjets();
        
        foreach ($images as $image)
        {
            $image->setAnnonce($annonce);
        }

        foreach ($objets as $objet)
        {
            $objet->setAnnonce($annonce);
        }
        
        $em->persist($annonce);
        $em->flush();
    }
}
