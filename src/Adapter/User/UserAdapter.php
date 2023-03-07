<?php

use App\Connection\MySqlConnection;

class UserAdapter
{
    private MySqlConnection $conn;

    public function __construct()
    {
        $this->conn = new MySqlConnection();
    }

    public function check_login_query()
    {
        $query = "SELECT id_user, is_active FROM user WHERE username = :username AND password = :password AND is_active = 1";
        return $stmt = $this->conn->prepare($query);
    }
}