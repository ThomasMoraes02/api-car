<?php

use Slim\Factory\AppFactory;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

require_once("vendor/autoload.php");

$app = AppFactory::create();

$app->get("/drivers", function(Request $request, Response $response, array $args) {
    $response->getBody()->write("Hello World");
    return $response;
});

$app->run();