<?php

namespace App\Service;

use App\Entity\Role as Role;
use App\Entity\User as User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserService
 * @package App\Service
 */
class UserService
{

    /**
     * @var UserRepository
     */
    private $userRepository;
    private $passwordEncoder;
    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository, UserPasswordEncoderInterface $encoder){
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $encoder;
    }

    
    /**
     * @param string $username
     * @return User
     * @throws EntityNotFoundException
     */
    public function getUser(string $username): User
    {
        $user = $this->userRepository->findOneByUsername($username);
        if (!$user) {
            throw new EntityNotFoundException('User with username '.$username.' does not exist!');
        }
        return $user;
    }

    /**
     * @return array|null
     */
    public function getAllUsers(): ?array
    {
        return $this->userRepository->findAll();
    }

    /**
     * @param string $name
     * @param string $username
     * @param string $password
     * @param string $role 
     * @return User
     */
    public function addUser($options)
    {
        if (
            !array_key_exists("role", $options) ||
            !array_key_exists("name", $options) ||
            !array_key_exists("username", $options) ||
            !array_key_exists("password", $options)
        ) {
            throw new EntityNotFoundException('All fields are required.');
        }  
        
        $user = $this->userRepository->findOneByUsername($options["username"]);
        
        if ($user) {
            throw new EntityNotFoundException('User with username '.$options["username"].' already exists!');
        }        
         
        $user = new User();        
        $user->setRole(Role::get($options["role"]));
        $user->setName($options["name"]);
        $user->setUsername($options["username"]);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            $options["password"]
        ));
        $this->userRepository->save($user);
    }

    /**
     * @param string $username
     * @param string $name
     * @param string $password
     * @param string $role
     * @return User
     * @throws EntityNotFoundException
     */
    public function updateUser($options)
    {

        $user = $this->userRepository->findOneByUsername($options["username"]);
        if (!$options["username"]) {
            throw new EntityNotFoundException('User with username '.$options["username"].' does not exist!');
        }
        
        if(array_key_exists("role", $options)) {
           $user->setRole(Role::get($options["role"]));            
        }
        
        if(array_key_exists("name", $options)) {
           $user->setName($options["name"]);            
        }
        
        if(array_key_exists("username", $options)) {
            $user->setUsername($options["username"]);
        }
        
        if(array_key_exists("password", $options)) {
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                $options["password"]
            ));
        }       

        return $this->userRepository->save($user);
    }

    /**
     * @param string $username
     * @throws EntityNotFoundException
     */
    public function deleteUser(string $username): void
    {
        $user = $this->userRepository->findByUsername($username);
        if (!$user) {
            throw new EntityNotFoundException('User with name '.$username.' does not exist!');
        }

        $this->userRepository->delete($user);
    }

}