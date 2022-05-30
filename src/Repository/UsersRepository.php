<?php

namespace App\Repository;

use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
// use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Users|null find($id, $lockMode = null, $lockVersion = null)
 * @method Users|null findOneBy(array $criteria, array $orderBy = null)
 * @method Users[]    findAll()
 * @method Users[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $manager)
    {
        parent::__construct($registry, Users::class);
        $this->manager = $manager;
    }

    public function saveUsers($names, $firstSurname, $secondSurname, $email, $celPhone, $password, $token, $isActive)
    {
        $newUsers = new Users();

        $newUsers
            ->setNames($names)
            ->setFirstSurname($firstSurname)
            ->setsecondSurname($secondSurname)
            ->setEmail($email)
            ->setCelPhone($celPhone)
            ->setPassword($password)
            ->setToken($token)
            ->setIsActive($isActive);

        $this->manager->persist($newUsers);
        $this->manager->flush();
    }

    public function updateUsers(Users $users): Users
    {
        $this->manager->persist($users);
        $this->manager->flush();

        return $users;
    }


    public function removeUsers(Users $users)
    {
        $this->manager->remove($users);
        $this->manager->flush();
    }

    // /**
    //  * @return Users[] Returns an array of Users objects
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
    public function findOneBySomeField($value): ?Users
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