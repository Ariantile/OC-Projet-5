<?php
// src/DoninfoBundle/DataFixtures/ORM/LoadUsers.php

namespace DoninfoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use DoninfoBundle\Entity\User;
use \DateTime;


class LoadUsers implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    public function load(ObjectManager $manager)
    {           
        $arrayusers = array(
            array('nomstructure'    => 'Structure 1',
                  'typestructure'   => 'Entreprise',
                  'sirenrna'        => '156156515',
                  'activite'        => 'Service informatique',
                  'ape'             => 'W9564',
                  'adresse'         => '55 boulevard Gambetta',
                  'ville'           => 'Rouen',
                  'codepostal'      => '76000',
                  'siteweb'         => 'http://site1.com',
                  'telephone'       => '0493000000',
                  'courriel'        => 'adresse1@mail.com',
                  'nomuser'         => 'Nomuser1',
                  'prenomuser'      => 'Prenomuser1',
                  'statut'          => 'inscrit',
                  'password'        => '12345'),
            array('nomstructure'    => 'Structure 2',
                  'typestructure'   => 'Entreprise',
                  'sirenrna'        => '123456789',
                  'activite'        => 'Service informatique',
                  'ape'             => 'W2564',
                  'adresse'         => '55 boulevard Gambetta',
                  'ville'           => 'Nice',
                  'codepostal'      => '06000',
                  'siteweb'         => 'http://site2.com',
                  'telephone'       => '0493000000',
                  'courriel'        => 'adresse2@mail.com',
                  'nomuser'         => 'Nomuser2',
                  'prenomuser'      => 'Prenomuser2',
                  'statut'          => 'Valide',
                  'password'        => '12345'),
            array('nomstructure'    => 'Structure 3',
                  'typestructure'   => 'Entreprise',
                  'sirenrna'        => '987654321',
                  'activite'        => 'Développement web',
                  'ape'             => 'W6548',
                  'adresse'         => '3 rue chose',
                  'ville'           => 'Paris',
                  'codepostal'      => '75000',
                  'siteweb'         => 'http://site3.com',
                  'telephone'       => '0140000000',
                  'courriel'        => 'adresse3@mail.com',
                  'nomuser'         => 'Nomuser3',
                  'prenomuser'      => 'Prenomuser3',
                  'statut'          => 'Valide',
                  'password'        => '12345'),
            array('nomstructure'    => 'Structure 4',
                  'typestructure'   => 'Association',
                  'sirenrna'        => '456261651',
                  'activite'        => 'Aide à la personne',
                  'ape'             => '',
                  'adresse'         => '23 boulevard bidule',
                  'ville'           => 'Orléans',
                  'codepostal'      => '45000',
                  'siteweb'         => '',
                  'telephone'       => '0000000000',
                  'courriel'        => 'adresse4@mail.com',
                  'nomuser'         => 'Nomuser4',
                  'prenomuser'      => 'Prenomuser4',
                  'statut'          => 'Valide',
                  'password'        => '12345'),
            array('nomstructure'    => 'Structure 5',
                  'typestructure'   => 'Association',
                  'sirenrna'        => '565465469',
                  'activite'        => 'Sport',
                  'ape'             => 'W6516',
                  'adresse'         => '36 rue Ferrendo',
                  'ville'           => 'Toulouse',
                  'codepostal'      => '31500',
                  'siteweb'         => 'http://site5.com',
                  'telephone'       => '0000000000',
                  'courriel'        => 'adresse5@mail.com',
                  'nomuser'         => 'Nomuser5',
                  'prenomuser'      => 'Prenomuser5',
                  'statut'          => 'Valide',
                  'password'        => '12345'),
            array('nomstructure'    => 'Structure 6',
                  'typestructure'   => 'Entreprise',
                  'sirenrna'        => '125654161',
                  'activite'        => 'Aeronotique',
                  'ape'             => 'W1561',
                  'adresse'         => '22 rue Merens',
                  'ville'           => 'Toulouse',
                  'codepostal'      => '31000',
                  'siteweb'         => 'http://site6.com',
                  'telephone'       => '0000000000',
                  'courriel'        => 'adresse6@mail.com',
                  'nomuser'         => 'Nomuser6',
                  'prenomuser'      => 'Prenomuser6',
                  'statut'          => 'Valide',
                  'password'        => '12345'),
            );
        
        foreach ($arrayusers as $row) 
        {
            $user = new User();
            $user->setDateinscription(new \DateTime('now'));
            
            $encoder = $this->container->get('security.password_encoder');
            $password_encode =  $encoder->encodePassword($user, $row['password']);
            
            $user->setUsername($row['courriel']);
            $user->setSalt(md5(uniqid()));
            $user->setRoles(array('ROLE_USER'));
            $user->setNomstructure($row['nomstructure']);
            $user->setTypestructure($row['typestructure']);
            $user->setSirenrna($row['sirenrna']);
            $user->setActivite($row['activite']);
            $user->setApe($row['ape']);
            $user->setAdresse($row['adresse']);
            $user->setVille($row['ville']);
            $user->setCodepostal($row['codepostal']); 
            $user->setSiteweb($row['siteweb']);
            $user->setTelephone($row['telephone']);
            $user->setCourriel($row['courriel']);
            $user->setNomuser($row['nomuser']);
            $user->setPrenomuser($row['prenomuser']);
            $user->setStatut($row['statut']);
            $user->setPassword($password_encode);
            $user->setActivation(sha1($row['courriel'] + microtime()));
            
            $manager->persist($user);
        }
 
        $manager->flush();
    }
}
