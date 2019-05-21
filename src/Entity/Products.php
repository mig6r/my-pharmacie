<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductsRepository")
 */
class Products
{
    public function __construct(){
        $this->createdAt = new \DateTime();
        $this->state = 0;
    }

    const STATES = [
        0 => 'Neuf',
        1 => 'Ouvert',
        2 => 'Presque vide'
    ];
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Medicament", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $medicament;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Famille", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $famille;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     */
    private $state;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $expire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Locations", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $location;

    /**
     * @ORM\Column(type="integer")
     */
    private $initialQuantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMedicament(): ?Medicament
    {
        return $this->medicament;
    }

    public function setMedicament(?Medicament $medicament): self
    {
        $this->medicament = $medicament;

        return $this;
    }

    public function getFamille(): ?Famille
    {
        return $this->famille;
    }

    public function setFamille(?Famille $famille): self
    {
        $this->famille = $famille;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getState(): ?int
    {
        return $this->state;
    }

    public function setState(int $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getStateName(): string
    {
       return self::STATES[$this->state];
    }

    public function getExpire(): ?\DateTimeInterface
    {
        return $this->expire;
    }

    public function setExpire(?\DateTimeInterface $expire): self
    {
        $this->expire = $expire;

        return $this;
    }

    public function getLocation(): ?Locations
    {
        return $this->location;
    }

    public function setLocation(?Locations $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getInitialQuantity(): ?int
    {
        return $this->initialQuantity;
    }

    public function setInitialQuantity(int $initialQuantity): self
    {
        $this->initialQuantity = $initialQuantity;

        return $this;
    }
}
