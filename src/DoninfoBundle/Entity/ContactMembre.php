<?php

namespace DoninfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints as Recaptcha;

/**
 * ContactMembre
 *
 * @ORM\Table(name="contact_membre")
 * @ORM\Entity(repositoryClass="DoninfoBundle\Repository\ContactMembreRepository")
 */
class ContactMembre
{
    /**
     * @ORM\ManyToOne(targetEntity="DoninfoBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $user;
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     *
     * @Assert\NotBlank(message = "validation.contactm.titre.blank")
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "validation.contactm.titre.min",
     *      maxMessage = "validation.contactm.titre.max"
     * )
     *
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     *
     * @Assert\NotBlank(message = "validation.contactm.msg.blank")
     * @Assert\Length(
     *      min = 2,
     *      max = 2000,
     *      minMessage = "validation.contactm.msg.min",
     *      maxMessage = "validation.contactm.msg.max"
     * )
     *
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="sujet", type="string", length=255)
     */
    private $sujet;

    /**
     * @var string
     *
     * @ORM\Column(name="numannonce", type="string", length=255, nullable=true)
     *
     * @Assert\Length(
     *      min = 8,
     *      max = 100,
     *      minMessage = "validation.contactm.num.min",
     *      maxMessage = "validation.contactm.num.max"
     * )
     *
     */
    private $numannonce;
    
    /**
     * @Recaptcha\IsTrue
     */
    public $recaptcha;
    
    /**
     * Set user
     *
     * @param \DoninfoBundle\Entity\User $user
     *
     * @return Annonce
     */
    public function setUser(\DoninfoBundle\Entity\User $user)
    {
        $this->user = $user;
        
        return $this;
    }

    /**
     * Get user
     *
     * @return \DoninfoBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return ContactMembre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return ContactMembre
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set sujet
     *
     * @param string $sujet
     *
     * @return ContactMembre
     */
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;

        return $this;
    }

    /**
     * Get sujet
     *
     * @return string
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * Set numannonce
     *
     * @param string $numannonce
     *
     * @return ContactMembre
     */
    public function setNumannonce($numannonce)
    {
        $this->numannonce = $numannonce;

        return $this;
    }

    /**
     * Get numannonce
     *
     * @return string
     */
    public function getNumannonce()
    {
        return $this->numannonce;
    }
}

