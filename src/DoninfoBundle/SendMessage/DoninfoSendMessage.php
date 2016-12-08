<?php
// src/DoninfoBundle/SendMessage/DoninfoSendMessage.php

namespace DoninfoBundle\SendMessage;

use \DateTime;

class DoninfoSendMessage
{
    private $doctrine;

    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * Poster un message
     *
     */
    public function createMessage($message, $annonce, $user)
    {
        $em = $this->doctrine->getManager();
        $date = new \DateTime('now');
        
        $message->setAnnonce($annonce);
        $message->setUser($user);
        $message->setDatemsg($date);
        $message->setNewm(0);
        
        $em->persist($message);
        $em->flush();
    }
    
}
