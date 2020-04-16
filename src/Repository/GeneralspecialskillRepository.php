<?php

namespace App\Repository;

use App\Entity\Generalspecialskill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Generalspecialskill|null find($id, $lockMode = null, $lockVersion = null)
 * @method Generalspecialskill|null findOneBy(array $criteria, array $orderBy = null)
 * @method Generalspecialskill[]    findAll()
 * @method Generalspecialskill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GeneralspecialskillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Generalspecialskill::class);
    }

    // /**
    //  * @return Generalspecialskill[] Returns an array of Generalspecialskill objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Generalspecialskill
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
