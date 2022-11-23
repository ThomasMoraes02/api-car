<?php 
namespace ApiCar\Test\domain;

use ApiCar\domain\Email;
use PHPUnit\Framework\TestCase;
use PharIo\Manifest\InvalidEmailException;

class EmailTest extends TestCase
{
    public function test_email_valid()
    {
        $email = new Email("thomas@gmail.com");
        $this->assertEquals($email, "thomas@gmail.com");
    }

    public function test_email_invalid()
    {
        $this->expectException(InvalidEmailException::class);
        new Email("invalid");
    }
}