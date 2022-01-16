<?php

namespace App\Repository;

use App\Entity\Livre;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }


    /**
    * @return Livre[] Returns an array of Livre objects
    */
    
    public function findByTitleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.title LIKE :val')
            ->setParameter('val', "%".$value."%")
            ->getQuery()
            ->getResult()
        ;
    }

    
    public function findByDate($date1, $date2)
    {
        return $this->createQueryBuilder('l')
            ->where('l.date_de_parution >= :date1')
            ->andWhere('l.date_de_parution <= :date2')
            ->setParameter('date1', $date1)
            ->setParameter('date2', $date2)
            ->getQuery()
            ->getResult()
            ;
    }

    

    /*
    public function findOneBySomeField($value): ?Livre
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
