<?php

namespace App\Repository;

use App\Entity\NameRoad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
// use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method NameRoad|null find($id, $lockMode = null, $lockVersion = null)
 * @method NameRoad|null findOneBy(array $criteria, array $orderBy = null)
 * @method NameRoad[]    findAll()
 * @method NameRoad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NameRoadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $manager)
    {
        parent::__construct($registry, NameRoad::class);
        $this->manager = $manager;
    }

    public function saveNameRoad($name)
    {
        $newNameRoad = new NameRoad();

        $newNameRoad

            ->setName($name);

        $this->manager->persist($newNameRoad);
        $this->manager->flush();
    }

    public function updateNameRoad(NameRoad $nameRoad): NameRoad
    {
        $this->manager->persist($nameRoad);
        $this->manager->flush();

        return $nameRoad;
    }


    public function removeNameRoad(NameRoad $nameRoad)
    {
        $this->manager->remove($nameRoad);
        $this->manager->flush();
    }

    // /**
    //  * @return NameRoads[] Returns an array of NameRoads objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NameRoads
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}