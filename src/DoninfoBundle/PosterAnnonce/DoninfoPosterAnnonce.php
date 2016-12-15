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
    public function updateAnnonce($annonce, $user, $form, $objetsDb)
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
        
        $objetsNew  = $annonce->getObjets();
        $imgsNew    = $annonce->getImages();
        
        /*foreach ($form->get('objets') as $formObjet) {
            $checkDelete = $formObjet->get('delete')->getData();
            if ($checkDelete === true)
            {
                $delObjet = $formObjet->getData();
                $annonce->removeObjet($delObjet);
                
            }
        }*/
        
        foreach ($objetsNew as $objet) 
        {
            if (false === $objetsDb->contains($objet)) 
            {
                $annonce->addObjet($objet);
                $em->persist($objet);
            } else if ( ($objet->getDelete() === true) && (true === $objetsDb->contains($objet)) ){
                $annonce->removeObjet($objet);
                $em->persist($objet);
            }
        }
        
        foreach($imgsNew as $img)
        {
            if ($img->getDeleteimg() === true)
            {
                $annonce->removeImage($img);
                $em->persist($img);
            }
        }

        $em->persist($annonce);
        $em->flush();
    }  
    
}
