<?php

namespace App\UseCase\Profile;

use App\Entity\Profile\Profile;

class ProfileUseCase implements ProfileInterface
{
    private ProfileInterface $repository;

    public function __construct(ProfileInterface $repository)
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