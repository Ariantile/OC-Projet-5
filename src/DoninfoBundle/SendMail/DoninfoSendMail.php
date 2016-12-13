<?php
// src/DoninfoBundle/SendMail/DoninfoSendMail.php

namespace DoninfoBundle\SendMail;

class DoninfoSendMail
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
     * Courriel de changement de mdp
     *
     */
    public function sendMailRecover($courriel, $code)
    {
        $mail = \Swift_Message::newInstance();
            
        $mail->setSubject('Don Info - Réinitialiser votre mot de passe')
             ->setFrom('activation@doninfo.com')
             ->setTo($courriel)
             ->setBody(
                    $this->twig->render(
                        'DoninfoBundle:Mail:recovercourriel.html.twig',
                        array('courriel' => $courriel, 'code' => $code)
                    ),
                    'text/html'
                );
            
        $this->mailer->send($mail);
    }
    
    /**
     * Génération et envoi de mail
     *
     */
    public function sendMailActivation($courriel, $code_active)
    {
        $mail = \Swift_Message::newInstance();
            
        $mail->setSubject('Don Info - Activation de compte')
             ->setFrom('activation@doninfo.com')
             ->setTo($courriel)
             ->setBody(
                    $this->twig->render(
                        'DoninfoBundle:Mail:activationcourriel.html.twig',
                        array('courriel' => $courriel, 'code' => $code_active)
                    ),
                    'text/html'
                );
            
        $this->mailer->send($mail);
    }
    
    /**
     * Génération et envoi de mail en cas de message
     *
     */
    public function sendMailMessage($courriel, $message)
    {
        $image = $this->container->get('kernel')->getRootDir().'/../web/bundles/doninfobundle/images/logo.png';
        
        $mail = \Swift_Message::newInstance();
            
        $logo = $mail->embed(\Swift_Image::fromPath($image));
            
        $mail->setSubject('Don Info - Nouveau message')
             ->setFrom('activation@doninfo.com')
             ->setTo($courriel)
             ->setBody(
                    $this->twig->render(
                        'DoninfoBundle:Mail:activationcourriel.html.twig',
                        array('courriel' => $courriel, 'logo' => $logo, 'messsage' => $message)
                    ),
                    'text/html'
                );
            
        $this->mailer->send($mail);
    }
}
