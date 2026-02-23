<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\TypeAbonn;

/**
 * @extends ServiceEntityRepository<TypeAbonn>
 *
 * @method TypeAbonn|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeAbonn|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeAbonn[]    findAll()
 * @method TypeAbonn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeAbonnRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeAbonn::class);
    }

    public function findBySearchQuery($searchQuery)
    {
        // Implement your logic to filter results based on the search query
        // For example, use the query builder to add WHERE conditions
        $qb = $this->createQueryBuilder('ta');

        if ($searchQuery) {
            $qb->andWhere('ta.type LIKE :search')
                ->setParameter('search', '%' . $searchQuery . '%');
        }

        return $qb->getQuery()->getResult();
    }

//    /**
//     * @return TypeAbonn[] Returns an array of TypeAbonn objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TypeAbonn
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function save(TypeAbonn $entity, bool $flush = false): void
{
    $this->getEntityManager()->persist($entity);

    if ($flush) {
        $this->getEntityManager()->flush();
    }
}

public function remove(TypeAbonn $entity, bool $flush = false): void
{
    $this->getEntityManager()->remove($entity);

    if ($flush) {
        $this->getEntityManager()->flush();
    }
}


public function searchByType(string $query): array
{
    return $this->createQueryBuilder('t')
        ->andWhere('t.type LIKE :query')
        ->setParameter('query', '%' . $query . '%')
        ->getQuery()
        ->getResult();
}

public function searchByDes(string $query): array
{
    return $this->createQueryBuilder('t')
        ->andWhere('t.description LIKE :query')
        ->setParameter('query', '%' . $query . '%')
        ->getQuery()
        ->getResult();
}

public function searchByAbonn(string $query): array
{
    return $this->createQueryBuilder('t')
        ->andWhere('t.nb_abonnement LIKE :query')
        ->setParameter('query', '%' . $query . '%')
        ->getQuery()
        ->getResult();
}

}
