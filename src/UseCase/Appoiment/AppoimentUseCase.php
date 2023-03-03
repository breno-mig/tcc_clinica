<?php

namespace UseCase\Appoiment;

class AppoimentUseCase implements AppoimentInterface
{
    private AppoimentInterface $repository;

    public function __construct(AppoimentInterface $repository)
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