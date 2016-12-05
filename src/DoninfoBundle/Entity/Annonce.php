<?php

namespace DoninfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints as Recaptcha;
use DoninfoBundle\Validator\Codepostal;

/**
 * Annonce
 *
 * @ORM\Table(name="annonce")
 * @ORM\Entity(repositoryClass="DoninfoBundle\Repository\AnnonceRepository")
 */
class Annonce
{
    /**
     * @ORM\OneToMany(targetEntity="DoninfoBundle\Entity\Objet", mappedBy="annonce", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $objets;
    
    /**
     * @ORM\OneToMany(targetEntity="DoninfoBundle\Entity\Image", mappedBy="annonce", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $images;
    
    /**
     * @ORM\OneToMany(targetEntity="DoninfoBundle\Entity\Message", mappedBy="annonce", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $messages;
    
    /**
     * @ORM\ManyToOne(targetEntity="DoninfoBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="Departement")
     * @ORM\JoinColumn(referencedColumnName="departement_id", nullable=false)
     */
    private $departement;
    
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
     * @Assert\NotBlank(message = "validation.annonce.titre.blank")
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "validation.annonce.titre.min",
     *      maxMessage = "validation.annonce.titre.max"
     * )
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     *
     * @Assert\NotBlank(message = "validation.annonce.description.blank")
     * @Assert\Length(
     *      min = 2,
     *      max = 2000,
     *      minMessage = "validation.annonce.description.min",
     *      maxMessage = "validation.annonce.description.max"
     * )
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datelimite", type="datetime", nullable=true)
     *
     */
    private $datelimite;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecreation", type="datetime")
     *
     */
    private $datecreation;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     *
     * @Assert\NotBlank(message = "validation.annonce.adresse.blank")
     * @Assert\Length(
     *      min = 2,
     *      max = 150,
     *      minMessage = "validation.annonce.adresse.min",
     *      maxMessage = "validation.annonce.adresse.max"
     * )
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     *
     * @Assert\NotBlank(message = "validation.annonce.ville.blank")
     * @Assert\Length(
     *      min = 2,
     *      max = 80,
     *      minMessage = "validation.annonce.ville.min",
     *      maxMessage = "validation.annonce.ville.max"
     * )
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="codepostal", type="string", length=5)
     *
     * @Assert\NotBlank(message = "validation.annonce.postal.blank")
     * @Assert\Length(
     *      min = 5,
     *      max = 5,
     *      minMessage = "validation.annonce.postal.min",
     *      maxMessage = "validation.annonce.postal.max"
     * )
     * @Codepostal()
     */
    private $codepostal;
        
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
    
    public function __construct()
    {
        $this->objets   = new ArrayCollection();
        $this->images   = new ArrayCollection();
        $this->messages = new ArrayCollection();
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
     * Set departement
     *
     * @param \DoninfoBundle\Entity\Departement $departement
     *
     * @return Objet
     */
    public function setDepartement(Departement $departement)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement
     *
     * @return \DoninfoBundle\Entity\Departement
     */
    public function getDepartement()
    {
        return $this->departement;
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
     * Add objet
     *
     * @param \DoninfoBundle\Entity\Objet $objet
     *
     * @return Annonce
     */
    public function addObjet(Objet $objet)
    {
        $this->objets[] = $objet;

        $objet->setAnnonce($this);
    }

    /**
     * Remove objet
     *
     * @param \DoninfoBundle\Entity\Objet $objet
     */
    public function removeObjet(Objet $objet)
    {
        $this->objetsannonce->removeElement($objet);
    }

    /**
     * Get objet
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getObjets()
    {
        return $this->objets;
    }
    
    /**
     * Add message
     *
     * @param \DoninfoBundle\Entity\Message $message
     *
     * @return Annonce
     */
    public function addMessage(Message $message)
    {
        $this->messages[] = $message;

        $message->setAnnonce($this);
    }

    /**
     * Remove message
     *
     * @param \DoninfoBundle\Entity\Message $message
     */
    public function removeMessage(Message $message)
    {
        $this->messages->removeElement($message);
    }

    /**
     * Get message
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessages()
    {
        return $this->messages;
    }
    
    /**
     * Add image
     *
     * @param \DoninfoBundle\Entity\Image $image
     *
     * @return Annonce
     */
    public function addImage(Image $image)
    {
        $this->images[] = $image;

        $image->setAnnonce($this);
    }

    /**
     * Remove image
     *
     * @param \DoninfoBundle\Entity\image $image
     */
    public function removeImage(Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get image
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function numAnnonce()
    {
        $this->setNumero($this->getNumero . $this->getId());
    }
    
}
