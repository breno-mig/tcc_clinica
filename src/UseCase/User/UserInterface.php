<?php

namespace UseCase\User;
interface UserInterface
{
    public function __construct(UserInterface $repository);

    public function select($query);

    public function insert($query);

    public function delete($query);
}