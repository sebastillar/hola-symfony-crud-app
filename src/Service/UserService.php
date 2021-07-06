<?php

namespace App\Service;

use App\Entity\User as User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class UserService
 * @package App\Service
 */
final class UserService
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $username
     * @return User
     * @throws EntityNotFoundException
     */
    public function getUser(string $username): User
    {
        $user = $this->userRepository->findByUsername($username);
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
    public function addUser(string $name, string $username, string $password, string $role): User
    {
        $user = new User();
        $user->setRole(Role::get($role));
        $user->setName($name);
        $user->setUsername($username);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            $password
        ));
        $this->userRepository->save($user);

        return $user;
    }

    /**
     * @param string $username
     * @param string $name
     * @param string $password
     * @param string $role
     * @return User
     * @throws EntityNotFoundException
     */
    public function updateUser(string $username, string $name, string $password, string $role): Article
    {
        $user = $this->userRepository->findByUsername($username);
        if (!$username) {
            throw new EntityNotFoundException('User with username '.$username.' does not exist!');
        }

        $user = new User();
        $user->setRole(Role::get($role));
        $user->setName($name);
        $user->setUsername($username);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            $password
        ));
        $this->userRepository->save($user);

        return $user;
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