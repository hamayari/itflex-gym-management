<?php

namespace App\Repository;

use App\Entity\produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<produit>
 *
 * @method produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method produit[]    findAll()
 * @method produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class produitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, produit::class);
    }

//    /**
//     * @return Produit[] Returns an array of Produit objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    public function searchProduits($searchTerm)
    {
        $queryBuilder = $this->createQueryBuilder('p')
            ->leftJoin('p.categorie', 'c')
            ->where('p.titre LIKE :searchTerm')
            ->orWhere('p.image LIKE :searchTerm')
            ->orWhere('p.date LIKE :searchTerm')
            ->orWhere('p.description LIKE :searchTerm')
            ->orWhere('c.categorie LIKE :searchTerm')
            ->setParameter('searchTerm', '%' . $searchTerm . '%')
            ->getQuery();

        return $queryBuilder->getResult();
    }
}
