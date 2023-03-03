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
}