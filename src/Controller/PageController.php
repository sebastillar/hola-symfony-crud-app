<?php

namespace App\Controller;

use App\Security\AccessDeniedHandler;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\Entity\Role;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    private $exception;
    private $handler;
    
    public function __construct(
        AccessDeniedException $accessDeniedException,
        AccessDeniedHandler $handler
    )
    {
        $this->exception = $accessDeniedException;
        $this->handler = $handler;
    }
    
    public function index(Request $request, $num_page): Response
    {
        $role = $this->getUser()->getRole();

        if (
                $role === Role::get(Role::PAGE_1) && $num_page == 2 || 
                $role === Role::get(Role::PAGE_2) && $num_page == 1
        ) {
            return $this->handler->handle($request, $this->exception);
        }

        return $this->render('page/index.html.twig', [
            'controller_name' => 'asdas',
            'num_page' => $num_page
        ]);        
    }
}
