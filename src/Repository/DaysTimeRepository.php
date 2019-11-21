<?php

namespace App\Repository;

use App\Entity\DaysTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DaysTime|null find($id, $lockMode = null, $lockVersion = null)
 * @method DaysTime|null findOneBy(array $criteria, array $orderBy = null)
 * @method DaysTime[]    findAll()
 * @method DaysTime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DaysTimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DaysTime::class);
    }

    // /**
    //  * @return DaysTime[] Returns an array of DaysTime objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DaysTime
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
