<?php

namespace App\UseCase\User;

//implements UserInterface
use App\Entity\User\User;

class UserUseCase
{

    public function __construct(private $repository){}

    public function fill_user($user_to_fill):object
    {
        $user = new User();

        $user->setIdUser($user_to_fill->id_user)
            ->setUsername($user_to_fill->username)
            ->setSex($user_to_fill->sex)
            ->setPicture($user_to_fill->picture)
            ->setEmail($user_to_fill->email)
            ->setIsActive($user_to_fill->is_active)
            ->setDocument($user_to_fill->document)
            ->setBirthDate($user_to_fill->birth_date)
            ->setRegistrationDate($user_to_fill->registration_date)
            ->setIdProfile($user_to_fill->id_profile)
        ;
        return $user;
    }

}