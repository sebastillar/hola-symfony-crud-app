<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Tests\Service;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserServiceTest extends KernelTestCase
{
    public function testGetUserByUsername()
    {
        self::bootKernel();

        $container = self::$container;
        
        $user = $container->get(UserService::class)->getUser("user2");

        $this->assertSame("Name2", $user->getName());
    }
    
    public function testUpdateUser()
    {
        self::bootKernel();

        $container = self::$container;
        
        $userUpdated = $container->get(UserService::class)->updateUser([
            "name" => "NameUpdated",
            "username" => "user1"
        ]);

        $user = $container->get(UserService::class)->getUser("user1");
        
        $this->assertEquals("NameUpdated", $user->getName());
    }

    public function testAddUser()
    {
        self::bootKernel();

        $container = self::$container;
        
        $container->get(UserService::class)->addUser([
            "name" => "NewUser",
            "username" => "MyNewUser1",
            "role" => "PAGE_1",
            "password" => "1234",
        ]);

        $user = $container->get(UserService::class)->getUser("MyNewUser1");
        
        $this->assertEquals("NewUser", $user->getName());
    }

    public function testDeleteUser()
    {
        self::bootKernel();

        $container = self::$container;
        
        $container->get(UserService::class)->deleteUser("MyNewUser1");

        $user = $container->get(UserService::class)->getUser("MyNewUser1");
        
        $this->assertEquals(null, $user);
    }    
}
