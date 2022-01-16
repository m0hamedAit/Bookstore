<?php

namespace App\Repository;

use App\Entity\AuteurLivre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AuteurLivre|null find($id, $lockMode = null, $lockVersion = null)
 * @method AuteurLivre|null findOneBy(array $criteria, array $orderBy = null)
 * @method AuteurLivre[]    findAll()
 * @method AuteurLivre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuteurLivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AuteurLivre::class);
    }

    // /**
    //  * @return AuteurLivre[] Returns an array of AuteurLivre objects
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
    public function findOneBySomeField($value): ?AuteurLivre
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
