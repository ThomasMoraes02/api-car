<?php 
namespace ApiCar\application\usecase\driver;

use ApiCar\application\usecase\UseCase;
use ApiCar\domain\driver\DriverRepository;
use Error;

class DeleteDriver implements UseCase
{
    private DriverRepository $repository;

    public function __construct(DriverRepository $repository)
    {
        $this->repository = $repository;
    }

    public function perform(array $request): array
    {
        $driver = $this->repository->findDriverById($request['id']);

        if(empty($driver)) {
            throw new Error("Driver not found");
        }

        $this->repository->deleteDriver(intval($request['id']));

        return [
            "Driver deleted successfuly"
        ];
    }
}