<?php

namespace App\Repository;

use App\Entity\Location;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
// use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Location|null find($id, $lockMode = null, $lockVersion = null)
 * @method Location|null findOneBy(array $criteria, array $orderBy = null)
 * @method Location[]    findAll()
 * @method Location[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $manager)
    {
        parent::__construct($registry, Location::class);
        $this->manager = $manager;
    }

    public function saveDelivery($location)
    {
        $newDelivery = new Location();

        $newDelivery

            ->setCodeMunicipality($codeMunicipality)
            ->setNameMunicipality($nameMunicipality)
            ->setCodeIneMunicipality($codeIneMunicipality)
            ->setCodeNuts4($codeNuts4)
            ->setNameNuts4($nameNuts4);

        $this->manager->persist($newDelivery);
        $this->manager->flush();
    }

    public function updateDelivery(Location $location): Location
    {
        $this->manager->persist($location);
        $this->manager->flush();

        return $location;
    }


    public function removeDelivery(Location $location)
    {
        $this->manager->remove($location);
        $this->manager->flush();
    }

    // /**
    //  * @return Deliverys[] Returns an array of Deliverys objects
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
    public function findOneBySomeField($value): ?Deliverys
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