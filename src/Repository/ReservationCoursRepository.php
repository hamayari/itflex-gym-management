<?php

namespace App\Repository;

use App\Entity\ReservationCours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReservationCours>
 *
 * @method ReservationCours|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationCours|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationCours[]    findAll()
 * @method ReservationCours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationCoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationCours::class);
    }

//    /**
//     * @return ReservationCours[] Returns an array of ReservationCours objects
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

//    public function findOneBySomeField($value): ?ReservationCours
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
