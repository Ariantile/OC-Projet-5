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
        
        $typestructure = $user->getTypestructure();
        
        if ($typestructure === 'Entreprise')
        {
            
            $annonce->setType('Donation');
            
        } else if ($typestructure === 'Association') {
            
            $annonce->setType('Besoin');
            
        }
          
        $codeps = $annonce->getCodepostal();
        
        if (substr($codeps, 0, 2) === 97)
        {
            $codeps_sub = substr($codeps, 0, 3);
        } else {
            $codeps_sub = substr($codeps, 0, 2);
        }
            
        $departement = $em->getRepository('DoninfoBundle:Departement')->findOneByCode($codeps_sub);

        $annonce->setDepartement($departement);    
            
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
    
    /**
     * Updater une annonce
     *
     */
    public function updateAnnonce($annonce, $user)
    {
        $em     = $this->doctrine->getManager();
                  
        $codeps = $annonce->getCodepostal();
        
        if (substr($codeps, 0, 2) === 97)
        {
            $codeps_sub = substr($codeps, 0, 3);
        } else {
            $codeps_sub = substr($codeps, 0, 2);
        }
            
        $departement = $em->getRepository('DoninfoBundle:Departement')->findOneByCode($codeps_sub);

        $annonce->setDepartement($departement);    
            
        $images = $annonce->getImages();
        $objets = $annonce->getObjets();
        
        foreach ($images as $image)
        {
            if (!isset($image))
            {
                $annonce->removeImage($image);
            } else {
                $annonce->addImage($image);
            }
        }
        
        foreach ($objets as $objet)
        {
            if (!isset($objet))
            {
                $annonce->removeObjet($objet);
            } else {
                $annonce->addObjet($objet);
            }
        }

        $em->flush();
    }  
    
}
