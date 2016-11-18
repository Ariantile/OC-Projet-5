<?php

namespace DoninfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints as Recaptcha;

/**
 * ContactPublic
 *
 * @ORM\Table(name="contact_public")
 * @ORM\Entity(repositoryClass="DoninfoBundle\Repository\ContactPublicRepository")
 */
class ContactPublic
{
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
     * @Assert\NotBlank(message = "validation.contactp.titre.blank")
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "validation.contactp.titre.min",
     *      maxMessage = "validation.contactp.titre.max"
     * )
     *
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     *
     * @Assert\NotBlank(message = "validation.contactp.msg.blank")
     * @Assert\Length(
     *      min = 2,
     *      max = 2000,
     *      minMessage = "validation.contactp.msg.min",
     *      maxMessage = "validation.contactp.msg.max"
     * )
     *
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     *
     * @Assert\NotBlank(message = "validation.contactp.nom.blank")
     * @Assert\Length(
     *      min = 2,
     *      max = 150,
     *      minMessage = "validation.contactp.nom.min",
     *      maxMessage = "validation.contactp.nom.max"
     * )
     *
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     *
     * @Assert\NotBlank(message = "validation.contactp.prenom.blank")
     * @Assert\Length(
     *      min = 2,
     *      max = 150,
     *      minMessage = "validation.contactp.prenom.min",
     *      maxMessage = "validation.contactp.prenom.max"
     * )
     *
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="courriel", type="string", length=255)
     *
     * @Assert\NotBlank(message = "validation.contactp.courriel.blank")
     * @Assert\Email(
     *     message = "validation.contactp.courriel.valid",
     *     checkMX = true
     * )
     * @Assert\Length(
     *      min = 4,
     *      max = 150,
     *      minMessage = "validation.contactp.courriel.min",
     *      maxMessage = "validation.contactp.courriel.max",
     * )
     */
    private $courriel;
    
    /**
     * @Recaptcha\IsTrue
     */
    public $recaptcha;
    
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
     * @return ContactPublic
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
     * @return ContactPublic
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
     * Set nom
     *
     * @param string $nom
     *
     * @return ContactPublic
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return ContactPublic
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set courriel
     *
     * @param string $courriel
     *
     * @return ContactPublic
     */
    public function setCourriel($courriel)
    {
        $this->courriel = $courriel;

        return $this;
    }

    /**
     * Get courriel
     *
     * @return string
     */
    public function getCourriel()
    {
        return $this->courriel;
    }
}

