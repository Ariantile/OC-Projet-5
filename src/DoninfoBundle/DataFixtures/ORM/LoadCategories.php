<?php
// src/DoninfoBundle/DataFixtures/ORM/LoadCategories.php

namespace DoninfoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoninfoBundle\Entity\Categorie;

class LoadCategories implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {           
        $arraycategories = array(
            array('nom' => 'PC complet',        'groupe' => 'Ordinateur de bureau'),
            array('nom' => 'PC UC uniquement',  'groupe' => 'Ordinateur de bureau'),
            array('nom' => 'Mac',               'groupe' => 'Ordinateur de bureau'),
            
            array('nom' => 'NetBook',           'groupe' => 'Ordinateur portable'),
            array('nom' => 'NoteBook',          'groupe' => 'Ordinateur portable'),
            array('nom' => 'Ultraportable',     'groupe' => 'Ordinateur portable'),
            array('nom' => 'MacBook',           'groupe' => 'Ordinateur portable'),
            
            array('nom' => 'Serveur',           'groupe' => 'Serveur'),
            
            array('nom' => '15 pouces',         'groupe' => 'Moniteur'),
            array('nom' => '17 pouces',         'groupe' => 'Moniteur'),
            array('nom' => '19 pouces',         'groupe' => 'Moniteur'),
            array('nom' => '20 pouces',         'groupe' => 'Moniteur'),
            array('nom' => '22 pouces',         'groupe' => 'Moniteur'),
            array('nom' => '23 pouces',         'groupe' => 'Moniteur'),
            array('nom' => '24 pouces',         'groupe' => 'Moniteur'),
            array('nom' => '27 pouces et plus', 'groupe' => 'Moniteur'),
            array('nom' => 'CRT',               'groupe' => 'Moniteur'),
            
            array('nom' => 'Imprimante jet d\'encre',               'groupe' => 'Imprimante et scanner'),
            array('nom' => 'Imprimante jet d\'encre multifonction', 'groupe' => 'Imprimante et scanner'),
            array('nom' => 'Imprimante laser',                      'groupe' => 'Imprimante et scanner'),
            array('nom' => 'Imprimante laser multifonction',        'groupe' => 'Imprimante et scanner'),
            array('nom' => 'Scanner seul',                          'groupe' => 'Imprimante et scanner'),
            
            array('nom' => 'Clavier',           'groupe' => 'Périphérique et connectique'),
            array('nom' => 'Souris',            'groupe' => 'Périphérique et connectique'),
            array('nom' => 'Son',               'groupe' => 'Périphérique et connectique'),
            array('nom' => 'Connectique',       'groupe' => 'Périphérique et connectique'),
            
            array('nom' => 'Disque dur interne',    'groupe' => 'Stockage'),
            array('nom' => 'Disque dur externe',    'groupe' => 'Stockage'),
            array('nom' => 'Nas',                   'groupe' => 'Stockage'),
            
            array('nom' => 'Routeur avec wifi',         'groupe' => 'Réseau'),
            array('nom' => 'Routeur sans wifi',         'groupe' => 'Réseau'),
            array('nom' => 'Carte réseau avec wifi',    'groupe' => 'Réseau'),
            array('nom' => 'Carte réseau sans wifi',    'groupe' => 'Réseau'),
            array('nom' => 'Hub et switch',             'groupe' => 'Réseau'),
            
            array('nom' => 'Carte mère',            'groupe' => 'Composant'),
            array('nom' => 'Processeur',            'groupe' => 'Composant'),
            array('nom' => 'Mémoire',               'groupe' => 'Composant'),
            array('nom' => 'Carte graphique',       'groupe' => 'Composant'),
            array('nom' => 'Alimentation',          'groupe' => 'Composant'),
            array('nom' => 'Carte son',             'groupe' => 'Composant'),
            array('nom' => 'Carte d\'acquisition',  'groupe' => 'Composant'),
            array('nom' => 'Boitier vide',          'groupe' => 'Composant'),
            
            array('nom' => 'Autre',     'groupe' => 'Autre'),
        );
        
        foreach ($arraycategories as $row) 
        {
            $categorie = new Categorie();
            $categorie->setNom($row['nom']);
            $categorie->setGroupe($row['groupe']);
            $manager->persist($categorie);
        }
 
        $manager->flush();
    }
}
