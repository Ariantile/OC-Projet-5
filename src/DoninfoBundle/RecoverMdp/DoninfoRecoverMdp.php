<?php
// src/DoninfoBundle/RecoverMdp/DoninfoRecoverMdp.php

namespace DoninfoBundle\RecoverMdp;

class DoninfoRecoverMdp
{
    private $mailer;
    private $twig;
    private $doctrine;
    private $container;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig, $doctrine, $container)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->doctrine = $doctrine;
        $this->container = $container;
    }

    /**
     * Récupération d'un mot de passe oublié
     *
     */
    public function recoverMdp($recoverdata, $user)
    {
        $em = $this->doctrine->getManager();
        
        $recoverdata->setMdpcode(sha1($user->getCourriel() + microtime()));
        $recoverdata->setUser($user);
        
        $em->persist($recoverdata);
        $em->flush();
    }
}
