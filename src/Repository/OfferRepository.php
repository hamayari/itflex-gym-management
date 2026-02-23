<?php

namespace App\Repository;

use App\Entity\Offer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @extends ServiceEntityRepository<Offer>
 *
 * @method Offer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offer[]    findAll()
 * @method Offer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offer::class);
    }

//    /**
//     * @return Offer[] Returns an array of Offer objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Offer
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


public function save(Offer $entity, bool $flush = false): void
{
    $this->getEntityManager()->persist($entity);

    if ($flush) {
        $this->getEntityManager()->flush();
    }
}

public function remove(Offer $entity, bool $flush = false): void
{
    $this->getEntityManager()->remove($entity);

    if ($flush) {
        $this->getEntityManager()->flush();
    }
}


public function listOfferBynb_reservations()
    {
        return $this->createQueryBuilder('o')
            ->orderBy('o.nb_reservation', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findById($value): ?Offer
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.idoffer = :val')
            ->setParameter('val', $value)
            ->getQuery()
             ->getOneOrNullResult();
        
    }

    public function getChartData(): array
    {
        $qb = $this->createQueryBuilder('o')
            ->select('o.titleoffer', 'o.nb_reservation')
            ->getQuery();

        return $qb->getResult();
    }




    

    public function searchByTitle(string $query): array
{
    return $this->createQueryBuilder('t')
        ->andWhere('t.titleoffer LIKE :query')
        ->setParameter('query', '%' . $query . '%')
        ->getQuery()
        ->getResult();
}
public function searchByDec(string $query): array
{
    return $this->createQueryBuilder('t')
        ->andWhere('t.descriptionoffer LIKE :query')
        ->setParameter('query', '%' . $query . '%')
        ->getQuery()
        ->getResult();
}
public function searchByPrix(string $query): array
{
    return $this->createQueryBuilder('t')
        ->andWhere('t.prix LIKE :query')
        ->setParameter('query', '%' . $query . '%')
        ->getQuery()
        ->getResult();
}
public function searchByDateD(string $query): array
{
    return $this->createQueryBuilder('t')
        ->andWhere('t.datedeboffer LIKE :query')
        ->setParameter('query', '%' . $query . '%')
        ->getQuery()
        ->getResult();
}
public function searchByDateF(string $query): array
{
    return $this->createQueryBuilder('t')
        ->andWhere('t.datefinoffer LIKE :query')
        ->setParameter('query', '%' . $query . '%')
        ->getQuery()
        ->getResult();
}
public function searchByNBR(string $query): array
{
    return $this->createQueryBuilder('t')
        ->andWhere('t.nb_reservation LIKE :query')
        ->setParameter('query', '%' . $query . '%')
        ->getQuery()
        ->getResult();
}
public function searchByNBMAX(string $query): array
{
    return $this->createQueryBuilder('t')
        ->andWhere('t.nb_max_reservation LIKE :query')
        ->setParameter('query', '%' . $query . '%')
        ->getQuery()
        ->getResult();
}




}
