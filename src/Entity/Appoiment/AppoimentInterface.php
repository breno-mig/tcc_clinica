<?php

namespace App\Entity\Appoiment;

interface AppoimentInterface
{
    public function findById(int $id_appoiment): ?Appoiment;
    public function save(Appoiment $appoiment): void;
}