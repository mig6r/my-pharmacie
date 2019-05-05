<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FamilleRepository")
 */
class Famille
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Medicament", mappedBy="famille", orphanRemoval=true)
     */
    private $medicaments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="famille")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Symptome", mappedBy="famille", orphanRemoval=true)
     */
    private $symptomes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CatMedicaments", mappedBy="famille", orphanRemoval=true)
     */
    private $catMedicaments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\GroupsMedic", mappedBy="famille", orphanRemoval=true)
     */
    private $groupsMedics;









    public function __construct()
    {

        $this->medicaments = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->symptomes = new ArrayCollection();
        $this->catMedicaments = new ArrayCollection();
        $this->groupsMedics = new ArrayCollection();



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



    /**
     * @return Collection|Medicament[]
     */
    public function getMedicaments(): Collection
    {
        return $this->medicaments;
    }

    public function addMedicament(Medicament $medicament): self
    {
        if (!$this->medicaments->contains($medicament)) {
            $this->medicaments[] = $medicament;
            $medicament->setFamille($this);
        }

        return $this;
    }

    public function removeMedicament(Medicament $medicament): self
    {
        if ($this->medicaments->contains($medicament)) {
            $this->medicaments->removeElement($medicament);
            // set the owning side to null (unless already changed)
            if ($medicament->getFamille() === $this) {
                $medicament->setFamille(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setFamille($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getFamille() === $this) {
                $user->setFamille(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Symptome[]
     */
    public function getSymptomes(): Collection
    {
        return $this->symptomes;
    }

    public function addSymptome(Symptome $symptome): self
    {
        if (!$this->symptomes->contains($symptome)) {
            $this->symptomes[] = $symptome;
            $symptome->setFamille($this);
        }

        return $this;
    }

    public function removeSymptome(Symptome $symptome): self
    {
        if ($this->symptomes->contains($symptome)) {
            $this->symptomes->removeElement($symptome);
            // set the owning side to null (unless already changed)
            if ($symptome->getFamille() === $this) {
                $symptome->setFamille(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CatMedicaments[]
     */
    public function getCatMedicaments(): Collection
    {
        return $this->catMedicaments;
    }

    public function addCatMedicament(CatMedicaments $catMedicament): self
    {
        if (!$this->catMedicaments->contains($catMedicament)) {
            $this->catMedicaments[] = $catMedicament;
            $catMedicament->setFamille($this);
        }

        return $this;
    }

    public function removeCatMedicament(CatMedicaments $catMedicament): self
    {
        if ($this->catMedicaments->contains($catMedicament)) {
            $this->catMedicaments->removeElement($catMedicament);
            // set the owning side to null (unless already changed)
            if ($catMedicament->getFamille() === $this) {
                $catMedicament->setFamille(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GroupsMedic[]
     */
    public function getGroupsMedics(): Collection
    {
        return $this->groupsMedics;
    }

    public function addGroupsMedic(GroupsMedic $groupsMedic): self
    {
        if (!$this->groupsMedics->contains($groupsMedic)) {
            $this->groupsMedics[] = $groupsMedic;
            $groupsMedic->setFamille($this);
        }

        return $this;
    }

    public function removeGroupsMedic(GroupsMedic $groupsMedic): self
    {
        if ($this->groupsMedics->contains($groupsMedic)) {
            $this->groupsMedics->removeElement($groupsMedic);
            // set the owning side to null (unless already changed)
            if ($groupsMedic->getFamille() === $this) {
                $groupsMedic->setFamille(null);
            }
        }

        return $this;
    }









}
