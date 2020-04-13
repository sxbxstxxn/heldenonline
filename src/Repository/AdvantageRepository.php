<?php

namespace App\Repository;

use App\Entity\Advantage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Advantage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Advantage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Advantage[]    findAll()
 * @method Advantage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvantageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Advantage::class);
    }

    // /**
    //  * @return Advantage[] Returns an array of Advantage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Advantage
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
