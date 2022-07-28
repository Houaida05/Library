<?php

namespace App\Repository;

use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }

    // /**
    //  * @return Livre[] Returns an array of Livre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

*/

    public function findByPrixPage10Trie($prix,$qteStock)
    {
        return $this->createQueryBuilder('l')
            ->andWhere ('l.prix>:prix AND l.qteStock<:qteStock')
            ->setParameter('prix',$prix)
            ->setParameter('qteStock',$qteStock)
            ->orderBy('l.prix','DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }



    public function findByCat( $cat,$titre,$prix)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.categorie = :val ')
            ->andWhere(' l.titre LIKE :titre')
            ->andWhere('l.prix <= :prix ')
            ->setParameter('prix',$prix)
           // ->setParameter('prixmax',$prixmax)
            ->setParameter('val',$cat)
            ->setParameter('titre', '%'.$titre['titre'].'%')
            ->orderBy('l.id','asc')
            ->getQuery()
            ->getResult()
;
    }
    public function findByTitle($titre)
    {
        return $this->createQueryBuilder('l')
            ->andWhere(' l.titre LIKE :titre')
            ->setParameter('titre', $titre)
            ->getQuery()
            ->getResult()
            ;
    }
    public function countAllBook()
    {
        $queryBuilder = $this->createQueryBuilder('a');
        $queryBuilder->select('COUNT(a.id) as value');

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }


    /*
    public function findOneBySomeField($value): ?Livre
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
