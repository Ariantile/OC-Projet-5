<?php

namespace DoninfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Favoris
 *
 * @ORM\Table(name="favoris")
 * @ORM\Entity(repositoryClass="DoninfoBundle\Repository\FavorisRepository")
 */
class Favoris
{
    /**
     * @ORM\ManyToOne(targetEntity="DoninfoBundle\Entity\Annonce")
     * @ORM\JoinColumn(nullable=false)
     */
    private $annonce;
    
    /**
     * @ORM\ManyToOne(targetEntity="DoninfoBundle\Entity\User", inversedBy="favoris")
     * @ORM\JoinColumn(nullable=false)
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
     * Set annonce
     *
     * @param \DoninfoBundle\Entity\Annonce $annonce
     *
     * @return Favoris
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
     * @return Favoris
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
    
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

