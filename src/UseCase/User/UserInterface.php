<?php

namespace User\UseCase;
interface UserInterface
{
    public function __construct(UserInterface $repository);

}