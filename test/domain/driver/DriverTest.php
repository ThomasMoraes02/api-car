<?php 
namespace ApiCar\Test\domain\driver;

use ApiCar\domain\driver\Driver;
use ApiCar\domain\Email;
use DateTime;
use PHPUnit\Framework\TestCase;

class DriverTest extends TestCase
{
    public function test_create_driver()
    {
        $driver = new Driver("Thomas Moraes", new Email("thomas@gmail.com"), new DateTime("2000-08-02"));

        $this->assertEquals("Thomas Moraes", $driver->getName());
        $this->assertEquals("thomas@gmail.com", $driver->getEmail());
        $this->assertEquals("02-08-2000", $driver->getBirthdate()->format("d-m-Y"));
    }

    public function test_create_simple_driver()
    {
        $driver = Driver::create("Thomas", "thomas@gmail.com", "2000-08-02");
        $this->assertEquals("Thomas", $driver->getName());
    }
}