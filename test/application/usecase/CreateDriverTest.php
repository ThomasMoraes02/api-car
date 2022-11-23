<?php 
namespace ApiCar\Test\application\usecase;

use Error;
use Exception;
use DomainException;
use PHPUnit\Framework\TestCase;
use ApiCar\domain\driver\Driver;
use ApiCar\domain\driver\DriverRepository;
use ApiCar\application\usecase\CreateDriver;
use ApiCar\infraestructure\driver\DriverRepositoryMemory;

class CreateDriverTest extends TestCase
{
    private DriverRepository $repository;
    
    protected function setUp(): void
    {
        $this->repository = new DriverRepositoryMemory;
    }

    public function test_use_case_create_driver()
    {
        $request = [
            "name" => "Thomas Moraes",
            "email" => "thomas@gmail.com",
            "birthdate" => "2000-08-02"
        ];

        $useCase = new CreateDriver($this->repository);
        $response = $useCase->perform($request);

        $this->assertEquals("Thomas Moraes", $response['name']);
        $this->assertEquals("thomas@gmail.com", $response['email']);
    }

    public function test_use_case_create_driver_already_exists()
    {
        $this->expectException(Error::class);
        
        $driver = Driver::create("Igor Moraes", "igor@gmail.com", "2005-11-14");
        $this->repository->addDriver($driver);
        
        $request = [
            "name" => "Igor Moraes",
            "email" => "igor@gmail.com",
            "birthdate" => "2005-11-14"
        ];
        
        $useCase = new CreateDriver($this->repository);
        $useCase->perform($request);
    }
}