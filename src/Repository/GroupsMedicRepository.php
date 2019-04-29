<?php

namespace App\Repository;

use App\Entity\GroupsMedic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GroupsMedic|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupsMedic|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupsMedic[]    findAll()
 * @method GroupsMedic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupsMedicRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GroupsMedic::class);
    }


    /**
     * @return array
     */
    public function getChoices(): array
    {
        $choices =  $this->createQueryBuilder('g')
            ->select('g.id, g.Name')
            ->orderBy('g.Name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
        $arr = [];
        foreach ($choices as $k => $v) {
            $arr[$v["Name"]] = $v["id"];
        }
        return $arr;
    }
    // /**
    //  * @return GroupsMedic[] Returns an array of GroupsMedic objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GroupsMedic
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
