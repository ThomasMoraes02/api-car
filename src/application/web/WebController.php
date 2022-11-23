<?php 
namespace ApiCar\application\web;

use Throwable;
use ApiCar\application\web\ControllerOperation;

class WebController
{
    use HelperHttp;

    private ControllerOperation $controller;

    public function __construct(ControllerOperation $controller)
    {
        $this->controller = $controller;
    }

    public function handle(array $request)
    {
        try {
            return $this->controller->execute($request);
        } catch(Throwable $e) {
            return $this->serverError($e->getMessage());
        }
    }
}