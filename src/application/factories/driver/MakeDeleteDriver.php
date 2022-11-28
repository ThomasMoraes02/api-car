<?php 
namespace ApiCar\application\factories\driver;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use ApiCar\application\web\WebController;
use ApiCar\application\usecase\driver\DeleteDriver;
use ApiCar\infraestructure\driver\DriverRepositoryMongo;
use ApiCar\application\web\controllers\driver\DeleteDriverOperation;

class MakeDeleteDriver
{
    private WebController $controller;

    public function __construct()
    {
        $repository = new DriverRepositoryMongo;
        $useCase = new DeleteDriver($repository);
        $this->controller = new WebController(new DeleteDriverOperation($useCase));
    }

    public function __invoke(Request $request, Response $response, array $args)
    {  
        $payload['id'] = $args['id'] ?? '';
        $responseController = $this->controller->handle($payload);

        $response->getBody()->write(json_encode($responseController['body']));
        return $response->withHeader("Content-Type", "application/json")->withStatus($responseController['statusCode']);
    }
}