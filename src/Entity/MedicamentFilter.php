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
     * @var object
     */
    private $catMedic;

    /**
     * @var object
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
     * @return object
     */
    public function getCatMedic(): ?object
    {
        return $this->catMedic;
    }

    /**
     * @param $catMedic
     */
    public function setCatMedic(object $catMedic)
    {
        $this->catMedic = $catMedic;
    }

    /**
     * @return object
     */
    public function getGroupMedic(): ?object
    {
        return $this->groupMedic;
    }

    /**
     * @param int $groupMedic
     */
    public function setGroupMedic(object $groupMedic): void
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