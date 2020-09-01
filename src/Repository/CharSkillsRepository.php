<?php

namespace App\Repository;

use App\Entity\CharSkills;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CharSkills|null find($id, $lockMode = null, $lockVersion = null)
 * @method CharSkills|null findOneBy(array $criteria, array $orderBy = null)
 * @method CharSkills[]    findAll()
 * @method CharSkills[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharSkillsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CharSkills::class);
    }

    // /**
    //  * @return CharSkills[] Returns an array of CharSkills objects
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
    public function findOneBySomeField($value): ?CharSkills
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
