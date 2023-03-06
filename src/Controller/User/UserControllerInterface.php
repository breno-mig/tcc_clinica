<?php
namespace App\Controller\User;

interface UserControllerInterface
{
    public function check_login($username, $password):string;

    public function get_user_by_id($id);
}