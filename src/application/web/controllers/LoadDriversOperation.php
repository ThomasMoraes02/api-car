<?php 
namespace ApiCar\application\web\controllers;

use ApiCar\application\web\HelperHttp;
use ApiCar\application\usecase\UseCase;
use ApiCar\application\web\ControllerOperation;
use Throwable;

class LoadDriversOperation implements ControllerOperation
{
    use HelperHttp;

    private UseCase $useCase;

    public function __construct(UseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function execute(array $request)
    {
        try {
            $response = $this->useCase->perform($request);
            return $this->ok($response);
        } catch(Throwable $e) {
            return $this->forbidden($e->getMessage());
        }
        return $this->serverError("Server Error");
    }
}