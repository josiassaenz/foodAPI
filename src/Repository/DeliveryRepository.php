<?php

namespace App\Repository;

use App\Entity\Delivery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
// use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Delivery|null find($id, $lockMode = null, $lockVersion = null)
 * @method Delivery|null findOneBy(array $criteria, array $orderBy = null)
 * @method Delivery[]    findAll()
 * @method Delivery[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeliveryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $manager)
    {
        parent::__construct($registry, Delivery::class);
        $this->manager = $manager;
    }

    public function saveDelivery($delivery)
    {
        $newDelivery = new Delivery();

        $newDelivery

            ->setId_beneficiarie($id_beneficiarie)
            ->setKg($kg)
            ->setDate($date);

        $this->manager->persist($newDelivery);
        $this->manager->flush();
    }

    public function updateDelivery(Delivery $delivery): Delivery
    {
        $this->manager->persist($delivery);
        $this->manager->flush();

        return $delivery;
    }


    public function removeDelivery(Delivery $delivery)
    {
        $this->manager->remove($delivery);
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