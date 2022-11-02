<?php

namespace App\Repository;

use App\Entity\Beneficiaries;
use App\Entity\StatusDocuments;
use App\Entity\Countries;
use App\Entity\Location;
use App\Entity\Provinceses;
use App\Entity\Identification;
use App\Entity\NameRoad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
// use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Beneficiaries|null find($id, $lockMode = null, $lockVersion = null)
 * @method Beneficiaries|null findOneBy(array $criteria, array $orderBy = null)
 * @method Beneficiaries[]    findAll()
 * @method Beneficiaries[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeneficiariesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $manager)
    {
        parent::__construct($registry, Beneficiaries::class);
        $this->manager = $manager;
    }

    /**
     * @param \DateTime $born
    */
    public function saveBeneficiaries($names, $firstSurname, $secondSurname, $celPhone, $typeIdentification, $numberIdentification, $born, $email, $signture, $country, $province, $location, $nameRoad, $otherDirection, $termsConditions, $statusDocuments, $familyUnit)
    {
        $newBeneficiarie = new Beneficiaries();

        $newBeneficiarie

            ->setNames($names)
            ->setFirstSurname($firstSurname)
            ->setSecondSurname($secondSurname)
            ->setCelPhone($celPhone)
            ->setTypeIdentification($this->manager->getReference(Identification::class, $typeIdentification))
            ->setNumberIdentification($numberIdentification)
            ->setBorn(\DateTime::createFromFormat('Y-m-d', $born))
            ->setEmail($email)
            ->setSignture($signture)
            ->setCountry($this->manager->getReference(Countries::class, $country))
            ->setProvince($this->manager->getReference(Provinceses::class, $province))
            ->setLocation($this->manager->getReference(Location::class, $location))
            ->setNameRoad($this->manager->getReference(NameRoad::class, $nameRoad))
            ->setOtherDirection($otherDirection)
            ->setTermsConditions($termsConditions)
            ->setStatusDocuments($this->manager->getReference(StatusDocuments::class, $statusDocuments))
            ->setFamilyUnit($familyUnit);

        $this->manager->persist($newBeneficiarie);
        $this->manager->flush();
    }

    public function updateBeneficiarie(Beneficiaries $users): Beneficiaries
    {
        $this->manager->persist($users);
        $this->manager->flush();

        return $users;
    }


    public function removeBeneficiarie(Beneficiaries $users)
    {
        $this->manager->remove($users);
        $this->manager->flush();
    }

    // /**
    //  * @return Beneficiaries[] Returns an array of Beneficiaries objects
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
    public function findOneBySomeField($value): ?Beneficiaries
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