<?php

namespace App\Repository;

use App\Entity\StatusDocuments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
// use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method StatusDocuments|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatusDocuments|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatusDocuments[]    findAll()
 * @method StatusDocuments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusDocumentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $manager)
    {
        parent::__construct($registry, StatusDocuments::class);
        $this->manager = $manager;
    }

    public function saveStatusDocuments($statusDocuments)
    {
        $newStatusDocuments = new StatusDocuments();

        $newStatusDocuments

            ->SetStatusDocuments($statusDocuments);

        $this->manager->persist($newStatusDocuments);
        $this->manager->flush();
    }

    public function updateStatusDocuments(StatusDocuments $statusDocuments): StatusDocuments
    {
        $this->manager->persist($statusDocuments);
        $this->manager->flush();

        return $statusDocuments;
    }


    public function removeStatusDocuments(StatusDocuments $statusDocuments)
    {
        $this->manager->remove($statusDocuments);
        $this->manager->flush();
    }

    // /**
    //  * @return StatusDocuments[] Returns an array of StatusDocumentss objects
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
    public function findOneBySomeField($value): ?StatusDocuments
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