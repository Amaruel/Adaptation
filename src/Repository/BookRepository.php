<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function findBook()
    {

        $qb = $this->createQueryBuilder('b');
        $qb ->join('b.authors', 'bab')
            ->join('b.categories', 'bcat')
            ->addSelect('bab')
            ->addSelect('bcat');

        $qb->setMaxResults(30);
        $query = $qb->getQuery();
        return new Paginator($query);
    }

    public function bookDetails($id)
    {
        $qb = $this->createQueryBuilder('b');
        $qb ->join('b.categories', 'bcat')
            ->leftJoin('b.authors', 'bab')
            ->addSelect('bab')
            ->addSelect('bcat');

        $qb->setMaxResults(30);
        $query = $qb->getQuery();
        return $query->getResult();
    }

    // /**
    //  * @return Book[] Returns an array of Book objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Book
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
