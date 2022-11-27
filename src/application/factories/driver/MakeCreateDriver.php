<?php
namespace ApiCar\application\factories\driver;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use ApiCar\application\web\WebController;
use ApiCar\application\usecase\driver\CreateDriver;
use ApiCar\infraestructure\driver\DriverRepositoryMongo;
use ApiCar\application\web\controllers\driver\CreateDriverOperation;

class MakeCreateDriver
{
    private WebController $controller;

    public function __construct()
    {
        $repository = new DriverRepositoryMongo;
        $useCase = new CreateDriver($repository);
        $this->controller = new WebController(new CreateDriverOperation($useCase));
    }

    public function __invoke(Request $request, Response $response, array $args)
    {  
        $payload = json_decode($request->getBody(),true);
        $responseController = $this->controller->handle($payload);

        $response->getBody()->write(json_encode($responseController['body']));
        return $response->withHeader("Content-Type", "application/json")->withStatus($responseController['statusCode']);
    }
}