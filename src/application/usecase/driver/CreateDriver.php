<?php 
namespace ApiCar\application\usecase\driver;

use Error;
use Exception;
use ApiCar\domain\Email;
use ApiCar\domain\driver\Driver;
use ApiCar\application\usecase\UseCase;
use ApiCar\domain\driver\DriverRepository;

class CreateDriver implements UseCase
{
    private DriverRepository $repository;

    public function __construct(DriverRepository $repository)
    {
        $this->repository = $repository;
    }

    public function perform(array $request): array
    {
        try {
            $find = $this->repository->findByEmail(new Email($request['email']));

            if(!empty($find)) {
                throw new Error("Driver already exists");
            }
        } catch(Exception $e) {
            $driver = Driver::create($request['name'], $request['email'], $request['birthdate']);
            $this->repository->addDriver($driver);
        }

        return [
            "name" => $driver->getName(),
            "email" => strval($driver->getEmail())
        ];
    }
}