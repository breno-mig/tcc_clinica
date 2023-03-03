<?php

namespace UseCase\Profile;
interface ProfileInterface
{
    public function __construct(ProfileInterface $repository);

    public function select($query);

    public function insert($query);

    public function delete($query);
}