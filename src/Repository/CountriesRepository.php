<?php

namespace App\Repository;

use App\Entity\Countries;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
// use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Countries|null find($id, $lockMode = null, $lockVersion = null)
 * @method Countries|null findOneBy(array $criteria, array $orderBy = null)
 * @method Countries[]    findAll()
 * @method Countries[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CountriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $manager)
    {
        parent::__construct($registry, Countries::class);
        $this->manager = $manager;
    }

    public function saveCountries($countries)
    {
        $newCountries = new Countries();

        $newCountries

            ->setName($name)
            ->setNombre($nombre)
            ->setIso($iso);

        $this->manager->persist($newCountries);
        $this->manager->flush();
    }

    public function updateCountries(Countries $countries): Countries
    {
        $this->manager->persist($countries);
        $this->manager->flush();

        return $countries;
    }


    public function removeCountries(Countries $countries)
    {
        $this->manager->remove($countries);
        $this->manager->flush();
    }

    // /**
    //  * @return Countriess[] Returns an array of Countriess objects
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
    public function findOneBySomeField($value): ?Countriess
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