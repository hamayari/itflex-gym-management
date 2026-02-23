<?php

namespace App\Repository;

use App\Entity\ReservationOffer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
/**
 * @extends ServiceEntityRepository<ReservationOffer>
 *
 * @method ReservationOffer|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationOffer|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationOffer[]    findAll()
 * @method ReservationOffer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationOfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationOffer::class);
    }

//    /**
//     * @return ReservationOffer[] Returns an array of ReservationOffer objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ReservationOffer
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function getCountByTypeOffer($type)
{
    return $this->createQueryBuilder('r')
        ->select('COUNT(r.idreservation)')
        ->join('r.idoffer', 'o') // Join with the Offer entity
        ->where('o.titleoffer = :type')
        ->setParameter('type', $type)
        ->getQuery()
        ->getSingleScalarResult();
}

}
