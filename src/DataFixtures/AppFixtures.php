<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;
    
    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->passwordEncoder = $encoder;
    }
    
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setRole(Role::get('ADMIN'));
        $user->setName("Admin");
        $user->setUsername("admin");
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            "adminpassword"
        ));
        $manager->persist($user);
        $manager->flush();
    }
   
}
