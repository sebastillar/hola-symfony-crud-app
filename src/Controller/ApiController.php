<?php

namespace App\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Tqdev\PhpCrudApi\Api;
use Tqdev\PhpCrudApi\Config;

class ApiController extends AbstractController
{
/**
     * @Route("/api{params}", name="api_route", requirements={"params"=".+"})
     */
    public function index(Request $symfonyRequest): Response
    {
        // Convert the symfonyRequest to a psrRequest
        $psr17Factory = new Psr17Factory();
        $psrHttpFactory = new PsrHttpFactory(
            $psr17Factory, 
            $psr17Factory,
            $psr17Factory, 
            $psr17Factory
        );
        $psrRequest = $psrHttpFactory->createRequest($symfonyRequest);

        // PHP-CRUD-API takes a psrRequest and generates a psrResponse
        $config = new Config([
            'username' => 'admin',
            'password' => 'admin',
            'database' => 'hola_dev_db',
            'basePath' => '/api',
        ]);
        $api = new Api($config);
        $psrResponse = $api->handle($psrRequest);

        // Convert the psrResponse to a symfonyResponse
        $httpFoundationFactory = new HttpFoundationFactory();
        $symfonyResponse = $httpFoundationFactory->createResponse($psrResponse);

        return $symfonyResponse;
    }
}
