<?php

namespace DoninfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints as Recaptcha;

/**
 * Annonce
 *
 * @ORM\Table(name="annonce")
 * @ORM\Entity(repositoryClass="DoninfoBundle\Repository\AnnonceRepository")
 */
class Annonce
{
    /**
     * @ORM\OneToMany(targetEntity="DoninfoBundle\Entity\ObjetAnnonce", mappedBy="annonce", cascade={"persist"})
     * @Assert\Valid()
     */
    private $objetannonce;
    
    /**
     * @ORM\OneToMany(targetEntity="DoninfoBundle\Entity\MessageAnnonce", mappedBy="annonce", cascade={"persist"})
     * @Assert\Valid()
     */
    private $messageannonce;
    
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
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datelimite", type="datetime")
     */
    private $datelimite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecreation", type="datetime")
     */
    private $datecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="codepostal", type="string", length=12)
     */
    private $codepostal;

    /**
     * @var string
     *
     * @ORM\Column(name="photo1", type="string", length=255, nullable=true)
     */
    private $photo1;

    /**
     * @var string
     *
     * @ORM\Column(name="photo2", type="string", length=255, nullable=true)
     */
    private $photo2;

    /**
     * @var string
     *
     * @ORM\Column(name="photo3", type="string", length=255, nullable=true)
     */
    private $photo3;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=255)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=255)
     */
    private $statut;
    
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
     * @return Annonce
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
     * Set description
     *
     * @param string $description
     *
     * @return Annonce
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
     * Set datelimite
     *
     * @param \DateTime $datelimite
     *
     * @return Annonce
     */
    public function setDatelimite($datelimite)
    {
        $this->datelimite = $datelimite;

        return $this;
    }

    /**
     * Get datelimite
     *
     * @return \DateTime
     */
    public function getDatelimite()
    {
        return $this->datelimite;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     *
     * @return Annonce
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    /**
     * Get datecreation
     *
     * @return \DateTime
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Annonce
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Annonce
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set codepostal
     *
     * @param string $codepostal
     *
     * @return Annonce
     */
    public function setCodepostal($codepostal)
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    /**
     * Get codepostal
     *
     * @return string
     */
    public function getCodepostal()
    {
        return $this->codepostal;
    }

    /**
     * Set photo1
     *
     * @param string $photo1
     *
     * @return Annonce
     */
    public function setPhoto1($photo1)
    {
        $this->photo1 = $photo1;

        return $this;
    }

    /**
     * Get photo1
     *
     * @return string
     */
    public function getPhoto1()
    {
        return $this->photo1;
    }

    /**
     * Set photo2
     *
     * @param string $photo2
     *
     * @return Annonce
     */
    public function setPhoto2($photo2)
    {
        $this->photo2 = $photo2;

        return $this;
    }

    /**
     * Get photo2
     *
     * @return string
     */
    public function getPhoto2()
    {
        return $this->photo2;
    }

    /**
     * Set photo3
     *
     * @param string $photo3
     *
     * @return Annonce
     */
    public function setPhoto3($photo3)
    {
        $this->photo3 = $photo3;

        return $this;
    }

    /**
     * Get photo3
     *
     * @return string
     */
    public function getPhoto3()
    {
        return $this->photo3;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Annonce
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set numero
     *
     * @param string $numero
     *
     * @return Annonce
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set statut
     *
     * @param string $statut
     *
     * @return Annonce
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

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
     * Add objetannonce
     *
     * @param \DoninfoBundle\Entity\ObjetAnnonce $objetannonce
     *
     * @return Annonce
     */
    public function addObjetAnnonce(\DoninfoBundle\Entity\ObjetAnnonce $objetannonce)
    {
        $this->objetannonce[] = $objetannonce;

        return $this;
    }

    /**
     * Remove objetannonce
     *
     * @param \DoninfoBundle\Entity\ObjetAnnonce $objetannonce
     */
    public function removeObjetAnnonce(\DoninfoBundle\Entity\ObjetAnnonce $objetannonce)
    {
        $this->objetannonce->removeElement($objetannonce);
    }

    /**
     * Get objetannonce
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getObjetAnnonce()
    {
        return $this->objetannonce;
    }
    
    /**
     * Add messageannonce
     *
     * @param \DoninfoBundle\Entity\MessageAnnonce $messageannonce
     *
     * @return Annonce
     */
    public function addMessageAnnonce(\DoninfoBundle\Entity\MessageAnnonce $messageannonce)
    {
        $this->messageannonce[] = $messageannonce;

        return $this;
    }

    /**
     * Remove messageannonce
     *
     * @param \DoninfoBundle\Entity\MessageAnnonce $messageannonce
     */
    public function removeMessageAnnonce(\DoninfoBundle\Entity\MessageAnnonce $messageannonce)
    {
        $this->messageannonce->removeElement($messageannonce);
    }

    /**
     * Get messageannonce
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessageAnnonce()
    {
        return $this->messageannonce;
    }
}
