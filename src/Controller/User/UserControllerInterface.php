<?php

interface UserControllerInterface
{
    public function get_login($username, $password);

    public function get_user_by_id($id);
}