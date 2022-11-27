<?php 
namespace ApiCar\application\usecase\driver;

use DomainException;
use ApiCar\application\usecase\UseCase;
use ApiCar\domain\driver\DriverRepository;

class LoadDrivers implements UseCase
{
    private DriverRepository $repository;

    public function __construct(DriverRepository $repository)
    {
        $this->repository = $repository;
    }

    public function perform(array $request): array
    {
        if(!empty($request['id'])) {
            $driver = $this->repository->findDriverById($request['id']);

            return [
                "id" => $request['id'],
                "name" => $driver->getName(),
                "email" => strval($driver->getEmail()),
                "birthdate" => $driver->getBirthdate()->format("Y-m-d")
            ];
        }

        $drivers = $this->repository->findAllDrivers();

        if(empty($drivers)) {
            throw new DomainException("Drivers not found");
        }

        return $drivers;
    }
}