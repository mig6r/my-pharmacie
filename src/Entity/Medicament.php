<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MedicamentRepository")
 * @Vich\Uploadable()
 */
class Medicament
{

    const TYPES = [
        0 => 'Non défini',
        1 => 'Antibiotique',
        2 => 'Divers',
        3 => 'Soin du corps'
    ];
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var File|null
     * @Assert\Image(
     *     mimeTypes="image/jpeg")
     *
     * @Vich\UploadableField(mapping="medicament_image", fileNameProperty="picture")
     */
    private $imageFile;

    /**
     * @Assert\Length(
     *     min = 5,
     *     max = 50,
     *     minMessage = "{{ limit }} caractères minimum pour le titre du médicament)",
     *     maxMessage = "{{ limit }} caractères maximum pour le nom du médicament"
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $notice;


    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enable = true;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaires;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Symptome", inversedBy="medicaments")
     */
    private $symptomes;

    /**
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CatMedicaments", inversedBy="medicament")
     * @ORM\JoinColumn(nullable=false)
     */
    private $catMedicament;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GroupsMedic", inversedBy="medicaments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $GroupMedicament;

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->symptomes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): string
    {
        $slugify = new Slugify();
        return $slugify->slugify($this->name);
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNotice(): ?string
    {
        return $this->notice;
    }

    public function setNotice(?string $notice): self
    {
        $this->notice = $notice;

        return $this;
    }


    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getEnable(): ?bool
    {
        return $this->enable;
    }

    public function setEnable(bool $enable): self
    {
        $this->enable = $enable;

        return $this;
    }

    public function getCommentaires(): ?string
    {
        return $this->commentaires;
    }

    public function setCommentaires(?string $commentaires): self
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    /**
     * @return Collection|symptome[]
     */
    public function getSymptomes(): Collection
    {
        return $this->symptomes;
    }

    public function addSymptome(symptome $symptome): self
    {
        if (!$this->symptomes->contains($symptome)) {
            $this->symptomes[] = $symptome;
        }

        return $this;
    }

    public function removeSymptome(symptome $symptome): self
    {
        if ($this->symptomes->contains($symptome)) {
            $this->symptomes->removeElement($symptome);
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     * @return Medicament
     */
    public function setImageFile(?File $imageFile): Medicament
    {
        $this->imageFile = $imageFile;

        if ($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getCatMedicament(): ?CatMedicaments
    {
        return $this->catMedicament;
    }

    public function setCatMedicament(?CatMedicaments $catMedicament): self
    {
        $this->catMedicament = $catMedicament;

        return $this;
    }

    public function getGroupMedicament(): ?GroupsMedic
    {
        return $this->GroupMedicament;
    }

    public function setGroupMedicament(?GroupsMedic $GroupMedicament): self
    {
        $this->GroupMedicament = $GroupMedicament;

        return $this;
    }


}
