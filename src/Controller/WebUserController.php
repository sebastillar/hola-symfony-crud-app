<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Service\UserService;
use App\Entity\User;

class WebUserController extends AbstractController
{
    
    private $session;
    private $loggedUser;
    private $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }    
/*    
 * 
 * 
    
    public function navigate()
    {
        $username = $this->session->get('username');
        if( !$username )
        {
            return $this->redirectToRoute('login',array(),302);            
        }
        else
        {
            $this->loggedUser = $this->userRepository->findByUsername($username);
            if( $this->loggedUser->getRole() == "ADMIN" || $this->loggedUser->getRole() == "PAGE_1")
            {
                return $this->redirectToRoute('user',[
                    'name' => $this->loggedUser->getName(),
                    'number' => 1
                ],302);                                
            }
            else{
                return $this->redirectToRoute('user',[
                    'name' => $this->loggedUser->getName(),
                    'number' => 2
                ],302);                                
            }
        }
    
     
    }
    */
    
    public function index()
    {
        return $this->render('index.html.twig',[]);
    }    
    
    public function renderUserPage($number)
    {
        return $this->render(
            'page/user.html.twig',
            [
                "page" => $number
            ]
        );
    }
    
    public function error()
    {
        return $this->render('error/error.html.twig');
    }    
    
    public function login(AuthenticationUtils $auth, UserService $userService)
    {
        $error = $auth->getLastAuthenticationError();
        $lastUsername = $auth->getLastUsername();
        $user = new User;
        $page = 0;
        if($lastUsername)
        {
            $this->session->set('username', $lastUsername);    
            $user = $userService->getUser($lastUsername);
        }
        
        if($user->getRole() == "ADMIN" || $user->getRole() == "PAGE_1")
        {
            $page = 1;
        }
        else
        {
            $page = 2;
        }

        return $this->render(
            'page/user.html.twig',
            [
                "page" => 1
            ]                
        );
    }    
}
