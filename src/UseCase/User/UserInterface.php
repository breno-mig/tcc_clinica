<?php

namespace User\UseCase;
interface UserInterface
{
    public function __construct($conn);

    public function get_login($stmt,$clean_username,$clean_password);

    public function get_user_by_id($id);

    public function fill_user($user_to_fill);

}