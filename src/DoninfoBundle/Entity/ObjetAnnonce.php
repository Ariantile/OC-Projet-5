<?php

namespace DoninfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ObjetAnnonce
 *
 * @ORM\Table(name="objet_annonce")
 * @ORM\Entity(repositoryClass="DoninfoBundle\Repository\ObjetAnnonceRepository")
 */
class ObjetAnnonce
{
    /**
     * @ORM\ManyToOne(targetEntity="DoninfoBundle\Entity\Annonce", inversedBy="objetannonce")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $annonce;
    
    /**
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $categorie;
    
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
     * @ORM\Column(name="etat", type="string", length=255)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="quantite", type="string", length=255)
     */
    private $quantite;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;


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
     * Set etat
     *
     * @param string $etat
     *
     * @return ObjetAnnonce
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set quantite
     *
     * @param string $quantite
     *
     * @return ObjetAnnonce
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return string
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ObjetAnnonce
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set annonce
     *
     * @param \DoninfoBundle\Entity\Annonce $annonce
     *
     * @return ObjetAnnonce
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
     * Set categorie
     *
     * @param \DoninfoBundle\Entity\Categorie $categorie
     *
     * @return ObjetAnnonce
     */
    public function setCategorie(\DoninfoBundle\Entity\Categorie $categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \DoninfoBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
}
