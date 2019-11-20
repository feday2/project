<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityNotFoundException;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
abstract class AbstractRepository extends ServiceEntityRepository
{
    /**
     * @param array $orderBy
     */
    public function findOneBy(array $criteria, array $orderBy = null): ?object
    {
        $result = parent::findOneBy($criteria, $orderBy);
        if (null === $result) {
            throw new EntityNotFoundException();
        }

        return $result;
    }
}
