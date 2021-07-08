<?php

namespace App\Repository;

use App\Entity\User as User;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;


/**
 * Class UserRepository
 * @package App\Repository
 */
class UserRepository extends ServiceEntityRepository
{   

    
    
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    } 


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
    public function findOneByUsername(string $username): ?User
    {
        $user = $this->createQueryBuilder('u')
            ->where('u.username = :val')
            ->setParameter('val', $username)
            ->getQuery()
            ->getOneOrNullResult();
    
        return $user;
    }   
    
    /**
     * @return array
     */
    public function findAll(): array
    {
        $users = $this->createQueryBuilder('u')
            ->select("u")
            ->from("App:User", "usu")
            ->orderBy("usu.name", "ASC")
            ->getQuery()
            ->getResult();
        return $users;
    }    
    
    /**
     * @param User $user
     */
    public function save(User $user): void
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    } 
    
    /**
     * @param User $user
     */
    public function delete(User $user): void
    {
        $this->getEntityManager()->remove($user);
        $this->getEntityManager()->flush();
    }    
}


