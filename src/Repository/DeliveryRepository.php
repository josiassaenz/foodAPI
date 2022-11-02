<?php

namespace App\Repository;

use App\Entity\Delivery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
// use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\deliveryController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @method Delivery|null find($id, $lockMode = null, $lockVersion = null)
 * @method Delivery|null findOneBy(array $criteria, array $orderBy = null)
 * @method Delivery[]    findAll()
 * @method Delivery[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Delivery[]    findByDateDeliverys(array $criteria, $offset = null)
 */
class DeliveryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $manager)
    {
        parent::__construct($registry, Delivery::class);
        $this->manager = $manager;
    }
 
    /**
     * @param \DateTime $date
    */
    public function saveDelivery($idBeneficiarie, $kg, $date)
    {
        $newDelivery = new Delivery();

        $newDelivery
            ->setIdBeneficiarie($idBeneficiarie)
            ->setKg($kg)
            ->setDate(\DateTime::createFromFormat('Y-m-d', $date));

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

    /**
     * @return Deliverys[] Returns an array of Deliverys objects
    */
    public function findByDateDeliverys()
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(" SELECT 
                                        a.id id,
                                        CONCAT(b.names,' ',b.firstSurname,' ',b.secondSurname) names,
                                        b.celPhone celPhone,
                                        a.kg kg,
                                        b.signture signture
                                    FROM App\Entity\Delivery a
                                    INNER JOIN App\Entity\Beneficiaries b WITH a.idBeneficiarie = b.id");
        return $query->getResult();
    }
    

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