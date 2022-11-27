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
            WebController::getMissingParams($request, $this->controller->requiredParams);
            return $this->controller->execute($request);
        } catch(Throwable $e) {
            return $this->serverError($e->getMessage());
        }
    }

    /**
     * Verifica os parâmetros obrigatórios
     *
     * @param [type] $request
     * @param [type] $requiredParams
     * @return array
     */
    private static function getMissingParams($request, $requiredParams): array
    {
        $missingParams = [];

        for ($i=0; $i < count($requiredParams); $i++) { 
            if(!in_array($requiredParams[$i], array_keys($request)) || empty($request[$requiredParams[$i]])) {
                $missingParams[$requiredParams[$i]]; 
            }
        }

        return $missingParams;
    }
}