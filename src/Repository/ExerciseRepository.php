<?php

namespace App\Repository;

use App\Entity\Exercise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use DoctrineExtensions\Query\Mysql\Rand;
use http\Env\Request;

/**
 * @method Exercise|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exercise|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exercise[]    findAll()
 * @method Exercise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exercise::class);
    }

    // /**
    //  * @return Exercise[] Returns an array of Exercise objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


//    public function randomEx(): ?Exercise
//    {
//        return $this->createQueryBuilder('e')
//            ->select('e')
//            ->setParameter('limit', 1)
//            ->o(\rand())
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

}
