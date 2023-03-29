<?php

namespace App\Repository;

use App\Entity\Menu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Menu>
 *
 * @method Menu|null find($id, $lockMode = null, $lockVersion = null)
 * @method Menu|null findOneBy(array $criteria, array $orderBy = null)
 * @method Menu[]    findAll()
 * @method Menu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Menu::class);
    }

    public function save(Menu $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Menu $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Menu[] Returns an array of Flat objects
     */
    public function menuExpress()
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.id IN (:val)')
            ->setParameter('val', [1])
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Menu[] Returns an array of Flat objects
     */
    public function menuSavoyard()
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.id IN (:val)')
            ->setParameter('val', [2])
            ->getQuery()
            ->getResult()
        ;
    }


    
    /**
     * @return Menu[] Returns an array of Flat objects
     */
    public function menuComplet()
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.id IN (:val)')
            ->setParameter('val', [3])
            ->getQuery()
            ->getResult()
        ;
    }


  
//    public function findOneBySomeField($value): ?Menu
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
