<?php

namespace App\Repository;

use App\Entity\categoriemagasin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategorieMagasin>
 *
 * @method CategorieMagasin|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieMagasin|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieMagasin[]    findAll()
 * @method CategorieMagasin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class categoriemagasinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, categoriemagasin::class);
    }

//    /**
//     * @return CategorieMagasin[] Returns an array of CategorieMagasin objects
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

//    public function findOneBySomeField($value): ?CategorieMagasin
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
public function findAll()
{
    return $this->createQueryBuilder('c')
        ->orderBy('c.categorie', 'ASC')
        ->getQuery()
        ->getResult();
}
}
