<?php

use ApiCar\application\usecase\CreateDriver;
use ApiCar\application\usecase\LoadDrivers;
use ApiCar\application\web\controllers\CreateDriverOperation;
use ApiCar\application\web\controllers\LoadDriversOperation;
use ApiCar\application\web\WebController;
use ApiCar\infraestructure\driver\DriverRepositoryMongo;
use Slim\Factory\AppFactory;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

require_once("vendor/autoload.php");

ini_set("display_errors", 1);

$app = AppFactory::create();

$app->get("/drivers", function(Request $request, Response $response, array $args) {
    $repository = new DriverRepositoryMongo;
    $useCase = new LoadDrivers($repository);
    $controller = new WebController(new LoadDriversOperation($useCase));

    $params = $request->getQueryParams();

    $responseController = $controller->handle($params);

    $response->getBody()->write(json_encode($responseController['body']));
    return $response->withHeader("Content-Type", "application/json")->withStatus($responseController['statusCode']);
});

$app->get("/drivers/{id}", function(Request $request, Response $response, array $args) {
    $repository = new DriverRepositoryMongo;
    $useCase = new LoadDrivers($repository);
    $controller = new WebController(new LoadDriversOperation($useCase));

    $params['id'] = $args['id'];

    $responseController = $controller->handle($params);

    $response->getBody()->write(json_encode($responseController['body']));
    return $response->withHeader("Content-Type", "application/json")->withStatus($responseController['statusCode']);
});

$app->post("/drivers", function(Request $request, Response $response, array $args) {
    $repository = new DriverRepositoryMongo;
    $useCase = new CreateDriver($repository);
    $controller = new WebController(new CreateDriverOperation($useCase));

    $payload = json_decode($request->getBody(),true);
    $responseController = $controller->handle($payload);

    $response->getBody()->write(json_encode($responseController['body']));
    return $response->withHeader("Content-Type", "application/json")->withStatus($responseController['statusCode']);
});

$app->run();