<?php

namespace App\Repository;

use App\Entity\Medicament;
use App\Entity\MedicamentFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
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

    public function findAllForUser($famille)
    {
        return $this->createQueryBuilder('m')
            ->leftJoin('m.products', 'prod')
            ->andWhere('m.famille = :val')
            ->setParameter('val', $famille)
            ->orderBy('m.name', 'ASC')

            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Query
     */
    public function findAllEnableQuery(MedicamentFilter $search, $famille): Query
    {
        $query = $this->findEnableQuery($famille);



        if ($search->getCatMedic()){

            $query = $query
                ->andWhere('m.catMedicament = :catmedic')
                ->setParameter('catmedic', $search->getCatMedic());
            $where="andwhere";
        }

        if ($search->getGroupMedic()){

            $query = $query
                ->andWhere('m.GroupMedicament = :groupmedic')
                ->setParameter('groupmedic', $search->getGroupMedic());

        }

        if ($search->getSymptomes()->count() > 0){

            foreach ($search->getSymptomes() as $symptome){
                $query = $query
                    ->andWhere(':symptome MEMBER of m.symptomes')
                    ->setParameter('symptome', $symptome);
            }
        }


            return $query->getQuery();
    }

    /**
     * @return Medicament[]
     */
    public function findLatest($famille): Query
    {
        return $this->findEnableQuery($famille)
            ->setMaxResults(5)
            ->orderBy('m.id', 'DESC')
            ->getQuery();
        //->getResult();
    }


    private function findEnableQuery($famille): QueryBuilder
    {
        return $this->createQueryBuilder("m")
            ->where("m.enable = true")
        ->andWhere('m.famille = :val')
        ->setParameter('val', $famille);
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
