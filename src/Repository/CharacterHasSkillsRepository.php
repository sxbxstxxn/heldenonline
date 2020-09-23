<?php

namespace App\Repository;

use App\Entity\CharacterHasSkills;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CharacterHasSkills|null find($id, $lockMode = null, $lockVersion = null)
 * @method CharacterHasSkills|null findOneBy(array $criteria, array $orderBy = null)
 * @method CharacterHasSkills[]    findAll()
 * @method CharacterHasSkills[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharacterHasSkillsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CharacterHasSkills::class);
    }

    // /**
    //  * @return CharacterHasSkills[] Returns an array of CharacterHasSkills objects
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
    public function findOneBySomeField($value): ?CharacterHasSkills
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
