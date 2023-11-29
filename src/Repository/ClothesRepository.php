<?php

namespace App\Repository;

use App\Entity\Clothes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Clothes>
 *
 * @method Clothes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Clothes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Clothes[]    findAll()
 * @method Clothes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClothesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Clothes::class);
    }

//    /**
//     * @return Clothes[] Returns an array of Clothes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Clothes
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
