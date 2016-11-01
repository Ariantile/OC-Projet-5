<?php

namespace DoninfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MessageAnnonce
 *
 * @ORM\Table(name="message_annonce")
 * @ORM\Entity(repositoryClass="DoninfoBundle\Repository\MessageAnnonceRepository")
 */
class MessageAnnonce
{
    /**
     * @ORM\ManyToOne(targetEntity="DoninfoBundle\Entity\Annonce", inversedBy="messageannonce")
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
     */
    private $contenumessage;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
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
     * @return MessageAnnonce
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
     * @return MessageAnnonce
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
     * @return MessageAnnonce
     */
    public function setAnnonce(\DoninfoBundle\Entity\Annonce $annonce)
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
     * @return MessageAnnonce
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
}
