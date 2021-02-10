<?php

namespace App\Repository;

use App\Entity\ChoiceDate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ChoiceDate|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChoiceDate|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChoiceDate[]    findAll()
 * @method ChoiceDate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChoiceDateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChoiceDate::class);
    }

    // /**
    //  * @return ChoiceDate[] Returns an array of ChoiceDate objects
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
    public function findOneBySomeField($value): ?ChoiceDate
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
