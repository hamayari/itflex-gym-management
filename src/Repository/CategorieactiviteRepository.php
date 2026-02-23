<?php

namespace App\Repository;

use App\Entity\Categorieactivite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Categorieactivite>
 *
 * @method Categorieactivite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categorieactivite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categorieactivite[]    findAll()
 * @method Categorieactivite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieactiviteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categorieactivite::class);
    }

//    /**
//     * @return Categorieactivite[] Returns an array of Categorieactivite objects
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

//    public function findOneBySomeField($value): ?Categorieactivite
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
