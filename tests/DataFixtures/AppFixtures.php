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
        $roleAdmin=Role::get('ADMIN');
        $roleOne=Role::get('PAGE_1');
        $roleTwo=Role::get('PAGE_2');
        
        $userAdmin = new User();
        $userAdmin->setRole($roleAdmin);
        $userAdmin->setName("Admin");
        $userAdmin->setUsername("admin");
        $userAdmin->setPassword($this->passwordEncoder->encodePassword(
            $userAdmin,
            "adminpassword"
        ));
        
        $manager->persist($userAdmin);
        
        for ($i = 0; $i < 20; $i++) 
        {
            $user = new User();
            if($i%2 == 0)
                $user->setRole($roleTwo);
            else
                $user->setRole($roleOne);                
            $user->setName("Name".$i);
            $user->setUsername("user".$i);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                "password".$i
            ));
            $manager->persist($user);
        }
        
        $manager->flush();
    }
   
}
