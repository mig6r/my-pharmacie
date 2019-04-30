<?php
/**
 * Created by PhpStorm.
 * User: Seb
 * Date: 29/04/2019
 * Time: 12:58
 */

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;

class MedicamentFilter
{
    /**
     * @var int|null
     */
    private $catMedic;

    /**
     * @var int|null
     */
    private $groupMedic;

    /**
     * @var ArrayCollection
     */
    private $symptomes;

    public function __construct()
    {
        $this->symptomes = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getCatMedic(): ?int
    {
        return $this->catMedic;
    }

    /**
     * @param int $catMedic
     */
    public function setCatMedic(int $catMedic): void
    {
        $this->catMedic = $catMedic;
    }

    /**
     * @return int
     */
    public function getGroupMedic(): ?int
    {
        return $this->groupMedic;
    }

    /**
     * @param int $groupMedic
     */
    public function setGroupMedic(int $groupMedic): void
    {
        $this->groupMedic = $groupMedic;
    }

    /**
     * @return ArrayCollection
     */
    public function getSymptomes(): ArrayCollection
    {
        return $this->symptomes;
    }

    /**
     * @param ArrayCollection $symptomes
     */
    public function setSymptomes(ArrayCollection $symptomes): void
    {
        $this->symptomes = $symptomes;
    }


}