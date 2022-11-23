<?php 
namespace ApiCar\Test\domain;

use ApiCar\domain\Email;
use DomainException;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    public function test_email_valid()
    {
        $email = new Email("thomas@gmail.com");
        $this->assertEquals($email, "thomas@gmail.com");
    }

    public function test_email_invalid()
    {
        $this->expectException(DomainException::class);
        new Email("invalid");
    }
}