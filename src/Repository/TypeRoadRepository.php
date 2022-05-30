<?php

namespace App\Repository;

use App\Entity\TypeRoad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
// use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method TypeRoad|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeRoad|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeRoad[]    findAll()
 * @method TypeRoad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeRoadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $manager)
    {
        parent::__construct($registry, TypeRoad::class);
        $this->manager = $manager;
    }

    public function saveTypeRoad($typeRoad)
    {
        $newTypeRoad = new TypeRoad();

        $newTypeRoad

            ->setCode($code)
            ->setKeyRoad($keyRoad);

        $this->manager->persist($newTypeRoad);
        $this->manager->flush();
    }

    public function updateTypeRoad(TypeRoad $typeRoad): TypeRoad
    {
        $this->manager->persist($typeRoad);
        $this->manager->flush();

        return $typeRoad;
    }


    public function removeTypeRoad(TypeRoad $typeRoad)
    {
        $this->manager->remove($typeRoad);
        $this->manager->flush();
    }

    // /**
    //  * @return TypeRoads[] Returns an array of TypeRoads objects
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
    public function findOneBySomeField($value): ?TypeRoads
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