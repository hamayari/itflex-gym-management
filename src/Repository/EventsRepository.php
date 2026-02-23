<?php

namespace App\Repository;

use App\Entity\Events;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Events>
 *
 * @method Events|null find($id, $lockMode = null, $lockVersion = null)
 * @method Events|null findOneBy(array $criteria, array $orderBy = null)
 * @method Events[]    findAll()
 * @method Events[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Events::class);
    }
    public function getAvailablePlaces($idevent): int
    {
        // Implement the logic to get available places for the event
        // For example, you might get the total places and subtract reserved places
        // Adjust the logic based on your data model
        // This is a placeholder, and you should replace it with your actual logic
        $event = $this->find($idevent);

        if ($event) {
            $totalPlaces = $event->getNombreplacestotal();
            $reservedPlaces = $event->getNombreplacesreservees();

            return max(0, $totalPlaces - $reservedPlaces);
        }

        return 0;
    }
    public function searchEvents($searchData)
{
    $queryBuilder = $this->createQueryBuilder('e')
        ->leftJoin('e.idtype', 't'); // Assuming 'idtype' is the association in your Events entity

    // Add search conditions based on form data

    if ($searchData['type']) {
        $queryBuilder->andWhere('t.type LIKE :type')
            ->setParameter('type', '%' . $searchData['type'] . '%');
    }

    if ($searchData['date']) {
        $queryBuilder->andWhere('e.dateevent = :dateevent')
            ->setParameter('dateevent', $searchData['date']);
    }

    // Ajoutez d'autres conditions selon vos besoins

    return $queryBuilder->getQuery()->getResult();
}
public function findByCriteria($criteria)
{
    $queryBuilder = $this->createQueryBuilder('e');

    if (isset($criteria['date']) && $criteria['date']) {
        $queryBuilder
            ->andWhere('e.dateevent = :date')
            ->setParameter('date', $criteria['date']);
    }


    return $queryBuilder->getQuery()->getResult();
}
public function findByTitre($searchTerm)
    {
        $qb = $this->createQueryBuilder('e')
            ->andWhere('e.titreevent LIKE :searchTerm ')
            ->setParameter('searchTerm', '%'.$searchTerm.'%')
            ->orderBy('e.prixevent', 'ASC')
            ->getQuery();
    
        return $qb->getResult();
    }

//    /**
//     * @return Events[] Returns an array of Events objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Events
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
