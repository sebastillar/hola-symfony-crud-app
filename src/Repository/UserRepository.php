<?php

namespace App\Repository;

use App\Entity\User as User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;


/**
 * Class UserRepository
 * @package App\Repository
 */
class UserRepository extends ServiceEntityRepository
{   
    
    /**
     * UserRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);        
       
    } 
    
    /*
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    } 
     * 
     */   

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    /**
     * @param string $username
     * @return User
     */
    public function findByUsername(string $username): ?User
    {
        return $this->findOneBy(["username"=>$username]);
    }   
    
    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->findAll();
    }    
    
    /**
     * @param User $user
     */
    public function save(User $user, EntityManagerInterface $manager): void
    {
        $manager->persist($user);
        $manager->flush();
    } 
    
    /**
     * @param User $user
     */
    public function delete(User $user, EntityManagerInterface $manager): void
    {
        $manager->remove($user);
        $manager->flush();
    }    
}


