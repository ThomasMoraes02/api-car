<?php 
namespace ApiCar\application\usecase;

use ApiCar\domain\driver\Driver;
use ApiCar\domain\driver\DriverRepository;
use ApiCar\domain\Email;
use DomainException;
use Error;
use Exception;
use InvalidArgumentException;
use Throwable;

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