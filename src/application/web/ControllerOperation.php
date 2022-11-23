<?php 
namespace ApiCar\application\web;

interface ControllerOperation
{
    public function execute(array $request);
}