<?php

namespace App\Repository;

use App\Entity\ExcludeDaysTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ExcludeDaysTime|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExcludeDaysTime|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExcludeDaysTime[]    findAll()
 * @method ExcludeDaysTime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExcludeDaysTimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExcludeDaysTime::class);
    }

    public function findWorkDateBeetween($leftDate, $rightDate)
    {
        return $this->createQueryBuilder('d')
        ->where('d.isWork = 1')
        ->andWhere('d.date BETWEEN :leftDate AND :rightDate')
        ->setParameter('leftDate', $leftDate->format('Y-m-d'))
        ->setParameter('rightDate', $rightDate->format('Y-m-d'))
        ->orderBy('d.date', 'ASC')
        ->getQuery()
        ->getResult();
    }

}
