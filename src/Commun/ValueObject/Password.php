<?php

namespace App\Commun\ValueObject;


use InvalidArgumentException;

final class Password
{
    private string $password;

    public function __construct(string $password)
    {
        $this->password = $password;
        $this->isValid();
    }

    private function isValid(): void
    {
        $min_lenght = 8;
        $uppercase = preg_match('@[A-Z]@', $this->password);
        $lowercase = preg_match('@[a-z]@', $this->password);
        $number    = preg_match('@[0-9]@', $this->password);
        $special_chars = preg_match('@[^\w]@', $this->password);

        if(!$uppercase || !$lowercase || !$number || !$special_chars || strlen($this->password) < $min_lenght) {
            throw new InvalidArgumentException("Senha fraca");
        }

        $options = [
            'cost' => 13,
        ];

        $this->password = password_hash($this->password, PASSWORD_BCRYPT, $options);
    }

    public function __toString(): string
    {

        return $this->password;
    }

}