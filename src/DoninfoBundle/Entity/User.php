<?php

namespace DoninfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints as Recaptcha;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="DoninfoBundle\Repository\UserRepository")
 */
class User implements AdvancedUserInterface
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
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(name="password", type="string", length=255)
     *
     * @Assert\NotBlank(message = "validation.user.pass.blank")
     * @Assert\Length(
     *      min = 8,
     *      minMessage = "validation.user.pass.reg",
     * )
     * @Assert\Regex(
     *     pattern= "/^(?=.*[A-z])(?=.*[0-9])(?=.{8,})/",
     *     message= "validation.user.pass.reg",
     * )
     *
     */
    private $password;

    /**
    * @ORM\Column(name="salt", type="string", length=255)
    */
    private $salt;

    /**
     * @ORM\Column(name="roles", type="array")
     */
    private $roles = array();
    
    /**
     * @var string
     *
     * @ORM\Column(name="active_code", type="string", length=255)
     */
    private $activation;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nomstructure", type="string", length=255)
     *
     * @Assert\NotBlank(message = "validation.user.structure.blank")
     * @Assert\Length(
     *      min = 2,
     *      max = 150,
     *      minMessage = "validation.user.structure.min",
     *      maxMessage = "validation.user.structure.max",
     * )
     */
    private $nomstructure;

    /**
     * @var string
     *
     * @ORM\Column(name="typestructure", type="string", length=255)
     *
     */
    private $typestructure;

    /**
     * @var string
     *
     * @ORM\Column(name="sirenrna", type="string", length=255)
     *
     * @Assert\NotBlank(message = "validation.user.sirenrna.blank")
     * @Assert\Length(
     *      min = 9,
     *      max = 14,
     *      minMessage = "validation.user.sirenrna.min",
     *      maxMessage = "validation.user.sirenrna.max",
     * )
     */
    private $sirenrna;

    /**
     * @var string
     *
     * @ORM\Column(name="activite", type="string", length=255)
     *
     * @Assert\NotBlank(message = "validation.user.activite.blank")
     * @Assert\Length(
     *      min = 2,
     *      max = 150,
     *      minMessage = "validation.user.activite.min",
     *      maxMessage = "validation.user.activite.max",
     * )
     */
    private $activite;

    /**
     * @var string
     *
     * @ORM\Column(name="ape", type="string", length=255, nullable=true)
     *
     * @Assert\Length(
     *      min = 5,
     *      max = 5,
     *      minMessage = "validation.user.ape.max",
     *      maxMessage = "validation.user.ape.max",
     * )
     */
    private $ape;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     *
     * @Assert\NotBlank(message = "validation.user.adresse.blank")
     * @Assert\Length(
     *      min = 2,
     *      max = 150,
     *      minMessage = "validation.user.adresse.min",
     *      maxMessage = "validation.user.adresse.max",
     * )
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     *
     * @Assert\NotBlank(message = "validation.user.ville.blank")
     * @Assert\Length(
     *      min = 2,
     *      max = 80,
     *      minMessage = "validation.user.ville.min",
     *      maxMessage = "validation.user.ville.max",
     * )
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="codepostal", type="string", length=12)
     *
     * @Assert\NotBlank(message = "validation.user.postal.blank")
     * @Assert\Length(
     *      min = 3,
     *      max = 12,
     *      minMessage = "validation.user.postal.min",
     *      maxMessage = "validation.user.postal.max",
     * )
     */
    private $codepostal;

    /**
     * @var string
     *
     * @ORM\Column(name="siteweb", type="string", length=255, nullable=true)
     *
     * @Assert\Url(
     *    message = "validation.user.siteweb.url",
     * )
     * @Assert\Length(
     *      max = 150,
     *      maxMessage = "validation.user.siteweb.max",
     * )
     */
    private $siteweb;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone", type="integer")
     *
     * @Assert\NotBlank(message = "validation.user.tel.blank")
     * @Assert\Length(
     *      min = 3,
     *      max = 20,
     *      minMessage = "validation.user.tel.min",
     *      maxMessage = "validation.user.tel.max",
     * )
     * @Assert\Regex(
     *     pattern= "/^[0-9]*$/",
     *     message= "validation.user.tel.reg",
     * )
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="courriel", type="string", length=255, unique=true)
     *
     * @Assert\NotBlank(message = "validation.user.courriel.blank")
     * @Assert\Email(
     *     message = "validation.user.courriel.valid",
     *     checkMX = true
     * )
    * @Assert\Length(
     *      min = 4,
     *      max = 150,
     *      minMessage = "validation.user.courriel.min",
     *      maxMessage = "validation.user.courriel.max",
     * )
     */
    private $courriel;

    /**
     * @var string
     *
     * @ORM\Column(name="nomuser", type="string", length=255)
     *
     * @Assert\NotBlank(message = "validation.user.nom.blank")
     * @Assert\Length(
     *      min = 2,
     *      max = 150,
     *      minMessage = "validation.user.nom.min",
     *      maxMessage = "validation.user.nom.max",
     * )
     */
    private $nomuser;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomuser", type="string", length=255)
     *
     * @Assert\NotBlank(message = "validation.user.prenom.blank")
     * @Assert\Length(
     *      min = 2,
     *      max = 150,
     *      minMessage = "validation.user.prenom.min",
     *      maxMessage = "validation.user.prenom.max",
     * )
     */
    private $prenomuser;
    
    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=255)
     */
    private $statut;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateinscription", type="datetime")
     */
    private $dateinscription;
    
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
     * Set username
     *
     * @return string
     */
    public function setUsername($username)
    {
        $this->username = $username;
            
        return $this;
    }
    
    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->courriel;
    }
    
    /**
     * Set password
     *
     * @param string password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * Set salt
     *
     * @return string
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
        
        return $this;
    }
    
    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }
    
    /**
     * Set roles
     *
     * @param string roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return string
     */
    public function getRoles()
    {
        return $this->roles;
    }
    
    /**
     * Set activation
     *
     * @return string
     */
    public function setActivation($activation)
    {
        $this->activation = $activation;
        
        return $this;
    }
    
    /**
     * Get activation
     *
     * @return string
     */
    public function getActivation()
    {
        return $this->activation;
    }
    
    /**
     * Set nomstructure
     *
     * @param string $nomstructure
     *
     * @return User
     */
    public function setNomstructure($nomstructure)
    {
        $this->nomstructure = $nomstructure;

        return $this;
    }

    /**
     * Get nomstructure
     *
     * @return string
     */
    public function getNomstructure()
    {
        return $this->nomstructure;
    }

    /**
     * Set typestructure
     *
     * @param string $typestructure
     *
     * @return User
     */
    public function setTypestructure($typestructure)
    {
        $this->typestructure = $typestructure;

        return $this;
    }

    /**
     * Get typestructure
     *
     * @return string
     */
    public function getTypestructure()
    {
        return $this->typestructure;
    }

    /**
     * Set sirenrna
     *
     * @param string $sirenrna
     *
     * @return User
     */
    public function setSirenrna($sirenrna)
    {
        $this->sirenrna = $sirenrna;

        return $this;
    }

    /**
     * Get sirenrna
     *
     * @return string
     */
    public function getSirenrna()
    {
        return $this->sirenrna;
    }

    /**
     * Set activite
     *
     * @param string $activite
     *
     * @return User
     */
    public function setActivite($activite)
    {
        $this->activite = $activite;

        return $this;
    }

    /**
     * Get activite
     *
     * @return string
     */
    public function getActivite()
    {
        return $this->activite;
    }

    /**
     * Set ape
     *
     * @param string $ape
     *
     * @return User
     */
    public function setApe($ape)
    {
        $this->ape = $ape;

        return $this;
    }

    /**
     * Get ape
     *
     * @return string
     */
    public function getApe()
    {
        return $this->ape;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return User
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
     * @return User
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
     * @return User
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
     * Set siteweb
     *
     * @param string $siteweb
     *
     * @return User
     */
    public function setSiteweb($siteweb)
    {
        $this->siteweb = $siteweb;

        return $this;
    }

    /**
     * Get siteweb
     *
     * @return string
     */
    public function getSiteweb()
    {
        return $this->siteweb;
    }

    /**
     * Set telephone
     *
     * @param integer $telephone
     *
     * @return User
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return int
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set courriel
     *
     * @param string $courriel
     *
     * @return User
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
     * Set nomuser
     *
     * @param string $nomuser
     *
     * @return User
     */
    public function setNomuser($nomuser)
    {
        $this->nomuser = $nomuser;

        return $this;
    }

    /**
     * Get nomuser
     *
     * @return string
     */
    public function getNomuser()
    {
        return $this->nomuser;
    }

    /**
     * Set prenomuser
     *
     * @param string $prenomuser
     *
     * @return User
     */
    public function setPrenomuser($prenomuser)
    {
        $this->prenomuser = $prenomuser;

        return $this;
    }

    /**
     * Get prenomuser
     *
     * @return string
     */
    public function getPrenomuser()
    {
        return $this->prenomuser;
    }
    
    /**
     * Set statut
     *
     * @param string $statut
     *
     * @return User
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
     * Set dateinscription
     *
     * @param \DateTime $dateinscription
     *
     * @return User
     */
    public function setDateinscription($dateinscription)
    {
        $this->dateinscription = $dateinscription;

        return $this;
    }

    /**
     * Get dateinscription
     *
     * @return \DateTime
     */
    public function getDateinscription()
    {
        return $this->dateinscription;
    }
    
    public function eraseCredentials()
    {
    }
    
    public function isEnabled()
    {
        if ( ($this->getStatut() === 'Inscrit') || ($this->getStatut() === 'Banni') ) {
            return false;
        } else if ($this->getStatut() === 'Valide') {
            return true;
        }
    }
    
    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }
    
}
