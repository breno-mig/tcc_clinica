<?php

namespace App\Connection;

use PDO;
use PDOException;

class MySqlConnection
{
    public function __construct()
    {
        $this->connect();
    }

    private function connect():void
    {
        $dsn = 'mysql:dbname=tcc_clinica;host=mysql.localhost;port=3306';
        $username_db="root";
        $password_db="root";

        try {
            $conn = new PDO($dsn,$username_db, $password_db);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }

}