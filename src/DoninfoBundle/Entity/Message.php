<?php

namespace DoninfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="DoninfoBundle\Repository\MessageRepository")
 */
class Message
{
    /**
     * @ORM\ManyToOne(targetEntity="DoninfoBundle\Entity\Annonce", inversedBy="messages")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $annonce;
    
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
     * @ORM\Column(name="contenumessage", type="text")
     *
     * @Assert\NotBlank(message = "validation.message.contenu.blank")
     * @Assert\Length(
     *      min = 2,
     *      max = 2000,
     *      minMessage = "validation.message.contenu.min",
     *      maxMessage = "validation.message.contenu.max"
     * )
     */
    private $contenumessage;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     *
     * @Assert\NotBlank(message = "validation.message.titre.blank")
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "validation.message.titre.min",
     *      maxMessage = "validation.message.titre.max"
     * )
     */
    private $titre;


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
     * Set contenumessage
     *
     * @param string $contenumessage
     *
     * @return Message
     */
    public function setContenumessage($contenumessage)
    {
        $this->contenumessage = $contenumessage;

        return $this;
    }

    /**
     * Get contenumessage
     *
     * @return string
     */
    public function getContenumessage()
    {
        return $this->contenumessage;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Message
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
     * Set annonce
     *
     * @param \DoninfoBundle\Entity\Annonce $annonce
     *
     * @return Message
     */
    public function setAnnonce(Annonce $annonce)
    {
        $this->annonce = $annonce;

        return $this;
    }

    /**
     * Get annonce
     *
     * @return \DoninfoBundle\Entity\Annonce
     */
    public function getAnnonce()
    {
        return $this->annonce;
    }

    /**
     * Set user
     *
     * @param \DoninfoBundle\Entity\User $user
     *
     * @return Message
     */
    public function setUser(User $user)
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
}
