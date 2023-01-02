<?php
//$host="breno.app";
$host="localhost";
//$username_db="breno_clinica";
$username_db="root";
//$password_db="Miggiolaro2019!@";
$password_db="";
$db_name="breno_trab-clinica";


try {
    $conn = new PDO('mysql:host=localhost;dbname=breno_trab-clinica',$username_db, $password_db);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
  }

/*try {
    $conn = new PDO($host, $username_db, $password_db, $db_name);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}*/
#$conn = mysqli_connect($host, $username_db, $password_db, $db_name);
/*$db = mysqli_select_db($connect, $db_name);

try {
    $connect= new PDO("mysql:host=localhost;dbname=trab-clinica", $username_db, $password_db);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}*/

//! before the $connect to see if te connection has failed
/*if (!$connect) {
    die("Falha na conexão: ".mysqli_connect_error());
    echo("Falha na conexão<br>");
} else {
    echo("Conexão Ok<br>");
}*/
?>