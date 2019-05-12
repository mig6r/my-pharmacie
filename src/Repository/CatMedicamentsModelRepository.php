<?php

namespace App\Repository;

use App\Entity\CatMedicamentsModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CatMedicamentsModel|null find($id, $lockMode = null, $lockVersion = null)
 * @method CatMedicamentsModel|null findOneBy(array $criteria, array $orderBy = null)
 * @method CatMedicamentsModel[]    findAll()
 * @method CatMedicamentsModel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatMedicamentsModelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CatMedicamentsModel::class);
    }

    // /**
    //  * @return CatMedicamentsModel[] Returns an array of CatMedicamentsModel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CatMedicamentsModel
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
