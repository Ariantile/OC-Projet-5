<?php
// DoninfoBundle/Entity/Image

namespace DoninfoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Table(name="image")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Image
{
    /**
     * @ORM\ManyToOne(targetEntity="DoninfoBundle\Entity\Annonce", inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $annonce;
    
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="ext", type="string", length=255)
     */
    private $ext;
    
    /**
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;
     
    /**
     * @Assert\Image(
     *     mimeTypes = {"image/jpeg", "image/png", "image/gif"},
     *     maxSize = "1M",
     *     maxSizeMessage = "validation.annonce.image.size",
     *     mimeTypesMessage = "validation.annonce.image.type",
     *     minWidth = 200,
     *     minHeight = 100,
     *     minWidthMessage = "validation.annonce.image.minw",
     *     maxHeightMessage = "validation.annonce.image.minh",
     * )
     */
    private $file;

    // On ajoute cet attribut pour y stocker le nom du fichier temporairement
    private $tempFilename;
    
    private $deleteimg;
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null === $this->file) 
        {
            return;
        }
        
        $this->ext = $this->file->guessExtension();
        
        $this->alt = $this->file->getClientOriginalName();
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file) 
        {
            return;
        }

        if (null !== $this->tempFilename) 
        {
            $oldFile = $this->getUploadRootDir().'/'.$this->id.'.'.$this->tempFilename;
            if (file_exists($oldFile)) 
            {
                unlink($oldFile);
            }
        }
        
        $this->file->move(
            $this->getUploadRootDir(),
            $this->id.'.'.$this->ext
        );
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        $this->tempFilename = $this->getUploadRootDir().'/'.$this->id.'.'.$this->ext;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if (file_exists($this->tempFilename)) 
        {
            unlink($this->tempFilename);
        }
    }

    public function getUploadDir()
    {
        return 'uploads/img';
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }
    
    public function getWebPath()
    {
        return $this->getUploadDir().'/'.$this->getId().'.'.$this->getExt();
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
     * Set annonce
     *
     * @param Annonce $annonce
     */
    public function setAnnonce(Annonce $annonce)
    {
        $this->annonce = $annonce;
        
        return $this;
    }

    /**
     * Get annonce
     *
     * @return Annonce
     */
    public function getAnnonce()
    {
        return $this->annonce;
    }
    
    /**
     * @param string $ext
     *
     */
    public function setExt($ext)
    {
        $this->ext = $ext;
    }
    
    /**
     * Get ext
     *
     * @return string
     */
    public function getExt()
    {
        return $this->ext;
    }
    
    /**
     * @param string $alt
     *
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;
    }
    
    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }
    
    /**
     * Get file
     *
     */
    public function getFile()
    {
        return $this->file;
    }
    
    public function setFile(UploadedFile $file)
    {
        $this->file = $file;

        if (null !== $this->ext) 
        {
            $this->tempFilename = $this->ext;
            
            $this->ext = null;
            $this->alt = null;
        }
    }
    
    /**
     * Get deleteimg
     *
     * @return boolean
     */
    public function getDeleteimg()
    {
        return $this->deleteimg;
    }

    /**
     * Set deleteimg
     *
     * @param boolean $deleteimg
     *
     * @return Image
     */
    public function setDeleteimg($deleteimg)
    {
        $this->deleteimg = $deleteimg;

        return $this;
    }
}