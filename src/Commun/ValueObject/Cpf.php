<?php

namespace App\Commun\ValueObject;
use DomainException;

final class Cpf
{
    private string $cpf;

    public function __construct(string $cpf)
    {
        $this->cpf = $cpf;
        $this->isValid();
    }

    private function isValid(): void
    {
        // Extrai somente os números
        $this->cpf = preg_replace('/[^0-9]/is', '', $this->cpf);

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($this->cpf) != 11) {
            throw new DomainException("Cpf invalido");
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $this->cpf)) {
            throw new DomainException("Cpf invalido");
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $this->cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($this->cpf[$c] != $d) {
                throw new DomainException("Cpf invalido");
            }
        }
    }

    public function __toString(): string
    {
        return $this->cpf;
    }
}