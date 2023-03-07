<?php

namespace App\Controller\User;

use App\Commun\Helper\intHelper;
use App\Commun\Helper\stringHelper;
use App\Connection\MySqlConnection;

//implements UserControllerInterface
class UserController
{

    use intHelper;
    use stringHelper;

    public function check_login($username, $password):string
    {
        $clean_username = $this->clear_string($username);
        $clean_password = $this->clear_string($password);

        $stmt->execute(['username'=>$clean_username, 'password'=>$clean_password]);
        return $stmt->fetchArray();
    }

    public function get_user_by_id($id)
    {
        $clean_id = $this->clear_int($id);

        $query = "SELECT id_user, username, picture, sex, is_active, email, document, birth_date, id_profile FROM user WHERE id_user=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id'=>$clean_id]);
        return $stmt->fechArray();
    }

}
