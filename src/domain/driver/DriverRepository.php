<?php 
namespace ApiCar\domain\driver;

use ApiCar\domain\Email;

interface DriverRepository
{
    public function addDriver(Driver $driver): void;

    public function findDriverById(int $id): Driver;

    public function findByEmail(Email $email): Driver;

    public function findAllDrivers(): array;
    
    public function deleteDriver(int $id): void;
}