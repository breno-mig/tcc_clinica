<?php

namespace App\UseCase\Profile;

use App\UseCase\Profile\ProfileUseCaseInterface;
//implements ProfileUseCaseInterface
class ProfileUseCase
{
    private ProfileUseCaseInterface $repository;

    public function __construct(ProfileUseCaseInterface $repository)
    {
        $this->repository = $repository;
    }

    public function select($query)
    {
        return $this->repository->select($query);
    }

    public function insert($query)
    {
        return $this->repository->insert($query);
    }

    public function delete($query)
    {
        return $this->repository->delete($query);
    }
}