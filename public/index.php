<?php

use ApiCar\application\usecase\CreateDriver;
use ApiCar\application\web\controllers\CreateDriverOperation;
use ApiCar\application\web\WebController;
use ApiCar\infraestructure\driver\DriverRepositoryMemory;
use Slim\Factory\AppFactory;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

require_once("vendor/autoload.php");

$app = AppFactory::create();

$app->get("/drivers", function(Request $request, Response $response, array $args) {
    $response->getBody()->write("Hello World");
    return $response;
});

$app->post("/drivers", function(Request $request, Response $response, array $args) {
    $repository = new DriverRepositoryMemory;
    $useCase = new CreateDriver($repository);
    $controller = new WebController(new CreateDriverOperation($useCase));

    $payload = json_decode($request->getBody(),true);
    $responseController = $controller->handle($payload);

    $response->getBody()->write(json_encode($responseController['body']));
    return $response->withHeader("Content-Type", "application/json")->withStatus($responseController['statusCode']);
});

$app->run();