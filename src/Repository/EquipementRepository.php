<?php

namespace App\Repository;

use App\Entity\Equipement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Equipement>
 *
 * @method Equipement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Equipement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Equipement[]    findAll()
 * @method Equipement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquipementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Equipement::class);
    }

//    /**
//     * @return Equipement[] Returns an array of Equipement objects
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

//    public function findOneBySomeField($value): ?Equipement
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
public function searchEquipements($searchTerm)
{
    $queryBuilder = $this->createQueryBuilder('e')
        ->leftJoin('e.categorie', 'c')
        ->where('e.IdEquipement LIKE :searchTerm')
        ->orWhere('e.NomEquipement LIKE :searchTerm')
        ->orWhere('e.Quantite LIKE :searchTerm')
        ->orWhere('e.DateAchat LIKE :searchTerm')
        ->orWhere('e.PrixAchat LIKE :searchTerm')
        ->orWhere('c.categorie LIKE :searchTerm')
        ->setParameter('searchTerm', '%' . $searchTerm . '%')
        ->getQuery();

    return $queryBuilder->getResult();
}
public function countByNomCategorie($NomCategorie)
{
    return $this->createQueryBuilder('e')
        ->select('COUNT(e.NomCategorie)')
        ->where('e.NomCategorie = :NomCategorie')
        ->setParameter('NomCategorie', $NomCategorie)
        ->getQuery()
        ->getSingleScalarResult();
}
}
