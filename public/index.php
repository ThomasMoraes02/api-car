<?php

use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use ApiCar\application\factories\driver\MakeLoadDriver;
use ApiCar\application\factories\driver\MakeCreateDriver;
use ApiCar\application\factories\driver\MakeDeleteDriver;

require_once("vendor/autoload.php");

ini_set("display_errors", 1);

$app = AppFactory::create();

$app->group("/drivers", function(RouteCollectorProxy $group) {
    $group->get("", MakeLoadDriver::class);
    $group->get("/{id}", MakeLoadDriver::class);
    $group->post("", MakeCreateDriver::class);
    $group->delete("/{id}", MakeDeleteDriver::class);
});

$app->run();