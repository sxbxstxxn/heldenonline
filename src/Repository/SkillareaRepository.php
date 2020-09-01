<?php

namespace App\Repository;

use App\Entity\Skillarea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Skillarea|null find($id, $lockMode = null, $lockVersion = null)
 * @method Skillarea|null findOneBy(array $criteria, array $orderBy = null)
 * @method Skillarea[]    findAll()
 * @method Skillarea[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SkillareaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Skillarea::class);
    }

    // /**
    //  * @return Skillarea[] Returns an array of Skillarea objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Skillarea
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
