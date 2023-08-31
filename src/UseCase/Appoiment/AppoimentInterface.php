<?php

namespace App\UseCase\Appoiment;

interface AppoimentInterface
{
    public function __construct(AppoimentInterface $repository);

    public function select($query);

    public function insert($query);

    public function delete($query);
}