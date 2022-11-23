<?php 
namespace ApiCar\Test\infraestructure\driver;

use ApiCar\domain\driver\Driver;
use ApiCar\domain\driver\DriverRepository;
use ApiCar\domain\Email;
use ApiCar\infraestructure\driver\DriverRepositoryMemory;
use DateTime;
use PHPUnit\Framework\TestCase;

class DriverRepositoryMemoryTest extends TestCase
{
    public Driver $driver;
    public DriverRepositoryMemory $repository;

    protected function setUp(): void
    {
        $this->driver = new Driver("Thomas Moraes", new Email("thomas@gmail.com"), new DateTime("2000-08-02"));
        $this->repository = new DriverRepositoryMemory;
    }

    public function test_add_driver_repository()
    {
        $this->repository->addDriver($this->driver);

        $this->assertEquals("1", count($this->repository->findAllDrivers()));
    }
}