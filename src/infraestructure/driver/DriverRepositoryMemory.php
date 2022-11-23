<?php 
namespace ApiCar\infraestructure\driver;

use ApiCar\domain\driver\Driver;
use ApiCar\domain\driver\DriverRepository;
use ApiCar\domain\Email;
use Exception;

class DriverRepositoryMemory implements DriverRepository
{
    private array $drivers = [];

    public function addDriver($driver): void
    {
        $this->drivers[] = $driver;
    }

    public function findDriverById($id): Driver
    {
        $driver = array_filter($this->drivers, fn($driver) => $driver == $id, ARRAY_FILTER_USE_KEY);

        if(empty($driver)) {
            throw new Exception("Driver not found");
        }

        return current($driver);
    }

    public function findByEmail(Email $email): Driver
    {
        $driver = array_filter($this->drivers, fn($driver) => $driver->getEmail() == $email);

        if(empty($driver)) {
            throw new Exception("Driver not found");
        }

        return current($driver);
    }

    public function findAllDrivers(): array
    {
        return $this->drivers;
    }

    public function deleteDriver(int $id): void
    {
        $driver = $this->findDriverById($id);
        unset($this->drivers[$id]);
    }
}