<?php

namespace App\Controller;

use App\Service\UserService;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Form\UserType;
use FOS\RestBundle\Controller\Annotations\RequestParam;

/***
 * RestUserController.
 * @Route("/api/v1",name="api_")
 */
class RestUserController extends AbstractFOSRestController
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
     * @Rest\Post("/user")
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
        
        $form = $this->createForm(UserType::class, $user);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);
        if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($user);
          $em->flush();
          return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));
        }
        return $this->handleView($this->view($form->getErrors()));
    }    

    /**
     * Retrieves an User resource
     * @Rest\Get("/v1/user/{username}")
     * @param string $userName
     * @return View
     */

    public function getUserByUsername(string $userName): View
    {
        $user = $this->userService->getUser($userName);

        return $this->handleView($this->view($user));
    }   
    
    /**
     * Lists all Users.
     * @Rest\Get("/v1/users")
     *
     * @return Response
     */
    public function getUsers()
    {
        $users = $this->userService->getAllUsers();

        return $this->handleView($this->view($users));

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
            $request->get($userName),
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





