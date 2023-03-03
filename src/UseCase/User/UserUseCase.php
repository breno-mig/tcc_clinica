<?php

namespace User\UseCase;

use Connection\Connection;

class UserUseCase implements UserInterface
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