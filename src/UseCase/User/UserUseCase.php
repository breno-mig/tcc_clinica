<?php

namespace App\UseCase\User;

//implements UserInterface
class UserUseCase
{
    private UserInterface $repository;

	public function __construct(UserInterface $repository)
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