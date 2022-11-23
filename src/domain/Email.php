<?php 
namespace ApiCar\domain;

use PharIo\Manifest\InvalidEmailException;

class Email
{
    private string $email;

    public function __construct(string $email)
    {
        $this->setEmail($email);
    }

    private function setEmail(string $email): void
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL) != true) {
            throw new InvalidEmailException("This e-mail is invalid: $email");
        }
        $this->email = $email;
    }

    public function __toString(): string
    {
        return $this->email;
    }
}