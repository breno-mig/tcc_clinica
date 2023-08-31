<?php

namespace App\Entity\User;
interface UserInterface
{
    public function findById(int $id_user): ?User;
    public function save(User $user): void;
}