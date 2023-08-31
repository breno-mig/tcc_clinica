<?php

namespace App\Entity\Profile;
interface ProfileInterface
{
    public function findById(int $id_profile): ?Profile;
    public function save(Profile $profile): void;
}