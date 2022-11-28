<?php 
namespace ApiCar\application\web\controllers\driver;

use Throwable;
use ApiCar\application\web\HelperHttp;
use ApiCar\application\usecase\UseCase;
use ApiCar\application\web\ControllerOperation;

class DeleteDriverOperation implements ControllerOperation
{
    use HelperHttp;

    public $requiredParams = [];

    private UseCase $useCase;

    public function __construct(UseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    public function execute(array $request)
    {
        try {
            $reponse = $this->useCase->perform($request);
            return $this->ok($reponse);
        } catch(Throwable $e) {
            return $this->forbidden($e->getMessage());
        }
        return $this->badRequest("Bad Request");
    }
}