<?php

namespace App\Repository;

use App\Entity\Identification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
// use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Identification|null find($id, $lockMode = null, $lockVersion = null)
 * @method Identification|null findOneBy(array $criteria, array $orderBy = null)
 * @method Identification[]    findAll()
 * @method Identification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdentificationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $manager)
    {
        parent::__construct($registry, Identification::class);
        $this->manager = $manager;
    }

    public function saveIdentification($identification)
    {
        $newIdentification = new Identification();

        $newIdentification

            ->setTypeIdentification($typeIdentification);

        $this->manager->persist($newIdentification);
        $this->manager->flush();
    }

    public function updateIdentification(Identification $identification): Identification
    {
        $this->manager->persist($identification);
        $this->manager->flush();

        return $identification;
    }


    public function removeIdentification(Identification $identification)
    {
        $this->manager->remove($identification);
        $this->manager->flush();
    }

    // /**
    //  * @return Identifications[] Returns an array of Identifications objects
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
    public function findOneBySomeField($value): ?Identifications
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