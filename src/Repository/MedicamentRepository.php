<?php

namespace App\Repository;

use App\Entity\Medicament;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Medicament|null find($id, $lockMode = null, $lockVersion = null)
 * @method Medicament|null findOneBy(array $criteria, array $orderBy = null)
 * @method Medicament[]    findAll()
 * @method Medicament[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MedicamentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Medicament::class);
    }

    /**
     * @return Medicament[]
     */
    public function findAllEnable(): array
    {
        return $this->findEnableQuery()
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Medicament[]
     */
    public function findLatest(): array
    {
        return $this->findEnableQuery()
            ->setMaxResults(5)
            ->getQuery()
        ->getResult();
    }


    private function findEnableQuery(): QueryBuilder
    {
        return $this->createQueryBuilder("m")
            ->where("m.enable = true");
    }
    // /**
    //  * @return Medicament[] Returns an array of Medicament objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Medicament
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
