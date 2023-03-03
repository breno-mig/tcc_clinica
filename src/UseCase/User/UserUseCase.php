<?php

namespace User\UseCase;

use Entity\User\User;

class UserUseCase
{

    public function __construct(private Connection $conn){}

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

    public function set_user_session($user)
    {
        $_SESSION["id_user"] = $user->getIdUser();
        $_SESSION["username"] = $user->getUsername();
        $_SESSION["picture"] = $user->getPicture();
        $_SESSION["sex"] = $user->getSex();

        return $_SESSION;
    }
}