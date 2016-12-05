<?php
// src/DoninfoBundle/SendMessage/DoninfoSendMessage.php

namespace DoninfoBundle\SendMessage;

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
        
        $message->setAnnonce($annonce);
        $message->setUser($user);
        
        $em->persist($message);
        $em->flush();
    }
    
}
