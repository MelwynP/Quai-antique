<?php

namespace App\Repository;

use App\Entity\Flats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Flats>
 *
 * @method Flats|null find($id, $lockMode = null, $lockVersion = null)
 * @method Flats|null findOneBy(array $criteria, array $orderBy = null)
 * @method Flats[]    findAll()
 * @method Flats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlatsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Flats::class);
    }

    public function save(Flats $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Flats $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    /**
     * @return Flats[] Returns an array of Flat objects
     */
    public function saladPrefer()
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.id IN (:val)')
            ->setParameter('val', [1, 2])
            ->getQuery()
            ->getResult()
        ;
    }
    

    /**
     * @return Flats[] Returns an array of Flat objects
     */
    public function flatPrefer()
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.id IN (:val)')
            ->setParameter('val', [11, 14])
            ->getQuery()
            ->getResult()
        ;
    }


    /**
     * @return Flats[] Returns an array of Flat objects
     */
    public function cheesePrefer()
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.id IN (:val)')
            ->setParameter('val', [17, 18])
            ->getQuery()
            ->getResult()
        ;
    }


    /**
     * @return Flats[] Returns an array of Flat objects
     */
    public function dessertPrefer()
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.id IN (:val)')
            ->setParameter('val', [24, 25])
            ->getQuery()
            ->getResult()
        ;
    }

//    /**
//     * @return Flats[] Returns an array of Flats objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Flats
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
