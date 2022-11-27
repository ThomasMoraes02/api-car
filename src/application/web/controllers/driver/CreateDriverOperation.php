<?php 
namespace ApiCar\application\web\controllers\driver;

use ApiCar\application\usecase\UseCase;
use ApiCar\application\web\ControllerOperation;
use ApiCar\application\web\HelperHttp;
use Throwable;

class CreateDriverOperation implements ControllerOperation
{
    use HelperHttp;

    public array $requiredParams = ["name", "email", "birthdate"];

    private UseCase $useCase;

    public function __construct(UseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function execute(array $request)
    {
        try {
            $response = $this->useCase->perform($request);
            return $this->created($response);
        } catch(Throwable $e) {
            return $this->forbidden($e->getMessage());
        }
        return $this->badRequest("Bad Request");
    }
}