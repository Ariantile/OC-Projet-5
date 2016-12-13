<?php

namespace DoninfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use DoninfoBundle\Validator\Courrielmdp;

/**
 * MdpOublie
 *
 * @ORM\Table(name="mdp_oublie")
 * @ORM\Entity(repositoryClass="DoninfoBundle\Repository\MdpOublieRepository")
 *
 *
 */

class MdpOublie
{ 
    /**
     * @ORM\OneToOne(targetEntity="DoninfoBundle\Entity\User")
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
     * @ORM\Column(name="mdp_code", type="string", length=255)
     */
    private $mdpcode;
    
    /**
     * @var string
     *
     * @Assert\NotBlank(message = "validation.user.courriel.blank")
     * @Assert\Email(
     *     message = "validation.user.courriel.valid"
     * )
     *
     * @Courrielmdp()
     *
     * @ORM\Column(name="courriel_recover", type="string", length=255)
     */
    private $courriel;
    
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
     * Set mdpcode
     *
     * @return string
     */
    public function setMdpcode($mdpcode)
    {
        $this->mdpcode = $mdpcode;
        
        return $this;
    }
    
    /**
     * Get mdpcode
     *
     * @return string
     */
    public function getMdpcode()
    {
        return $this->mdpcode;
    }
    
    /**
     * Set courriel
     *
     * @return string
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
    
    /**
     * Set user
     *
     * @param \DoninfoBundle\Entity\User $user
     *
     * @return MdpOublie
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
