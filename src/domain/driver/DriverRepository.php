<?php 
namespace ApiCar\domain\driver;

interface DriverRepository
{
    public function addDriver($driver): void;

    public function findDriverById($id): Driver;

    public function findAllDrivers(): array;
    
    public function deleteDriver(int $id): void;
}