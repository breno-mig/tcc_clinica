<?php

namespace App\Controller\Connection;

/*
 * Fazer funcionar no modelo atual, depois experimentar a abstração da classe Conexão, implementando na classe MySQL
 * assim, modularizando o código.
*/

use \PDO;
use PDOException;
use Exception;
use InvalidArgumentException;

$host = "db-mysql";
$db_name = "tcc_clinica";
$port = "3306";
$username_db = "root";
$password_db = "root";
$dsn = "mysql:dbname=$db_name;host=$host;port=$port;";

try {
    $conn = new PDO($dsn, $username_db, $password_db);
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    /*if (isset($conn)) {
        echo "conn:";
        echo "<br>";
        var_dump($conn);
        echo "<br>";
    }*/
} catch(PDOException $e) {
    //echo 'ERROR: ' . $e->getMessage();
    throw new PDOException($e);
}