<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocationsRepository")
 */
class Locations
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Locations", inversedBy="parentLocation")
     * @ORM\JoinColumn(nullable=true)
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Locations", mappedBy="parent", orphanRemoval=true)
     */
    private $parentLocation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Famille", inversedBy="locations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $famille;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Products", mappedBy="location")
     */
    private $products;

    public function __construct()
    {
        $this->parentLocation = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getParentLocation(): Collection
    {
        return $this->parentLocation;
    }

    public function addParentLocation(self $parentLocation): self
    {
        if (!$this->parentLocation->contains($parentLocation)) {
            $this->parentLocation[] = $parentLocation;
            $parentLocation->setParent($this);
        }

        return $this;
    }

    public function removeParentLocation(self $parentLocation): self
    {
        if ($this->parentLocation->contains($parentLocation)) {
            $this->parentLocation->removeElement($parentLocation);
            // set the owning side to null (unless already changed)
            if ($parentLocation->getParent() === $this) {
                $parentLocation->setParent(null);
            }
        }

        return $this;
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

    public function getFamille(): ?Famille
    {
        return $this->famille;
    }

    public function setFamille(?Famille $famille): self
    {
        $this->famille = $famille;

        return $this;
    }

    /**
     * @return Collection|Products[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Products $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setLocation($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getLocation() === $this) {
                $product->setLocation(null);
            }
        }

        return $this;
    }
}
