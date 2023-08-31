<?php

namespace App\Commun\ValueObject;

use DomainException;

final class Email
{
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
        $this->isValid();
    }

    private function isValid(): void
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new DomainException("E-mail is not valid");
        }
    }

    public function __toString(): string
    {
        return $this->email;
    }
}