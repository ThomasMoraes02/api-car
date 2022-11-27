<?php 
namespace ApiCar\application\factories\driver;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use ApiCar\application\web\WebController;
use ApiCar\application\usecase\driver\LoadDrivers;
use ApiCar\infraestructure\driver\DriverRepositoryMongo;
use ApiCar\application\web\controllers\driver\LoadDriversOperation;

class MakeLoadDriver
{
    private WebController $controller;

    public function __construct()
    {
        $repository = new DriverRepositoryMongo;
        $useCase = new LoadDrivers($repository);
        $this->controller = new WebController(new LoadDriversOperation($useCase));
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $params = $request->getQueryParams();

        $params['id'] = $args['id'] ?? '';
        $responseController = $this->controller->handle($params);

        $response->getBody()->write(json_encode($responseController['body']));
        return $response->withHeader("Content-Type", "application/json")->withStatus($responseController['statusCode']);
    }
}