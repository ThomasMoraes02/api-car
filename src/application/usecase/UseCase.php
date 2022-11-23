<?php 
namespace ApiCar\application\usecase;

interface UseCase
{
    public function perform(array $request): array;
}