<?php
$host="localhost";
$username_db="root";
$password_db="";
$db_name="breno_trab-clinica";

try {
    $conn = new PDO('mysql:host=localhost;dbname=breno_trab-clinica',$username_db, $password_db);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
      echo 'ERROR: ' . $e->getMessage();
  }
?>
