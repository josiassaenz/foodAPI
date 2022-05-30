<?php

namespace App\Repository;

use App\Entity\Provinces;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
// use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Provinces|null find($id, $lockMode = null, $lockVersion = null)
 * @method Provinces|null findOneBy(array $criteria, array $orderBy = null)
 * @method Provinces[]    findAll()
 * @method Provinces[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProvincesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $manager)
    {
        parent::__construct($registry, Provinces::class);
        $this->manager = $manager;
    }

    public function saveProvinces($code, $postalCode, $name, $phoneCode, $iso2)
    {
        $newProvinces = new Provinces();

        $newProvinces
            ->setCode($code)
            ->setPostalCode($postalCode)
            ->setName($name)
            ->setPhoneCode($phoneCode)
            ->setIso2($iso2);

        $this->manager->persist($newProvinces);
        $this->manager->flush();
    }

    public function updateProvinces(Provinces $provinces): Provinces
    {
        $this->manager->persist($provinces);
        $this->manager->flush();

        return $provinces;
    }


    public function removeProvinces(Provinces $provinces)
    {
        $this->manager->remove($provinces);
        $this->manager->flush();
    }

    // /**
    //  * @return Provinces[] Returns an array of Provinces objects
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
    public function findOneBySomeField($value): ?Provinces
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