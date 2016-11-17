<?php

namespace DoninfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Objet
 *
 * @ORM\Table(name="objet")
 * @ORM\Entity(repositoryClass="DoninfoBundle\Repository\ObjetRepository")
 */
class Objet
{
    /**
     * @ORM\ManyToOne(targetEntity="DoninfoBundle\Entity\Annonce", inversedBy="objets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $annonce;
    
    /**
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumn(nullable=false)
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
     *
     * @Assert\NotBlank(message = "validation.objet.qte.blank")
     * @Assert\Range(
     *      min = 1,
     *      minMessage = "validation.objet.qte.min",
     * )
     *
     */
    private $quantite;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 2000,
     *      minMessage = "validation.objet.description.min",
     *      maxMessage = "validation.objet.description.max"
     * )
     *
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
     * @return Objet
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
     * @return Objet
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
     * @return Objet
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
     * @return Objet
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
     * Set categorie
     *
     * @param \DoninfoBundle\Entity\Categorie $categorie
     *
     * @return Objet
     */
    public function setCategorie(Categorie $categorie)
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
