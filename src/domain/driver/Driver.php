<?php 
namespace ApiCar\domain\driver;

use DateTime;
use DateTimeInterface;
use ApiCar\domain\Email;

class Driver
{
    private string $name;
    private Email $email;
    private DateTime $birthdate;

    public function __construct(string $name, Email $email, DateTime $birthdate)
    {
        $this->name = $name;
        $this->email = $email;
        $this->birthdate = $birthdate;
    }

    public static function create(string $name, string $email, string $birthdate)
    {
        return new Driver($name, new Email($email), new DateTime($birthdate));
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getBirthdate(): DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate($birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }
}