<?php

namespace Commun\ValueObject;

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
            throw new \DomainException("Senha fraca");
        }
    }

}