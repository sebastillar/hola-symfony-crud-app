<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\UserService;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
    
class RestUserController extends AbstractController
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    /**
     * Creates an User resource
     * @param Request $request
     * @return View
     * @IsGranted("ADMIN")
     */
    public function postUser(Request $request): View
    {
        $user = $this->userService->addUser(
            $request->get('name'), 
            $request->get('username'),
            $request->get('role'),
            $request->get('password')                
        );

        // In case our POST was a success we need to return a 201 HTTP CREATED response with the created object
        return View::create($user, Response::HTTP_CREATED);
    }    

    /**
     * Retrieves an User resource
     * @param string $userName
     * @return View
     */
    /*
    public function getUser(string $userName): View
    {
        $user = $this->userService->getUser($userName);


        // In case our GET was a success we need to return a 200 HTTP OK response with the request object
        return View::create($user, Response::HTTP_OK);
    }   
    */
    /**
     * Retrieves a collection of User resource
     * @return View
     */
    public function getUsers(): View
    {
        $users = $this->userService->getAllUsers();

        // In case our GET was a success we need to return a 200 HTTP OK response with the collection of user object
        return View::create($users, Response::HTTP_OK);
    }
    
    /**
     * Replaces User resource
     * @param string $userName
     * @param Request $request
     * @return View
     * @IsGranted("ADMIN")
     */
    public function putUser(string $userName, Request $request): View
    {
        $user = $this->userService->updateUser($userName, 
            $request->get('name'), 
            $request->get($username),
            $request->get('role'),
            $request->get('password'),
        );


        // In case our PUT was a success we need to return a 200 HTTP OK response with the object as a result of PUT
        return View::create($user, Response::HTTP_OK);
    }

    /**
     * Removes the User resource
     * @param user $userName
     * @return View
     * @IsGranted("ADMIN")
     */
    public function deleteUser(string $userName): View
    {
        $this->userService->deleteUser($userName);


        // In case our DELETE was a success we need to return a 204 HTTP NO CONTENT response. The object is deleted.
        return View::create([], Response::HTTP_NO_CONTENT);
    }    

}
