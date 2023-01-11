<?php 
    session_start();
    switch ($_SESSION['title']) {
        case 'adm':
            if ($_SESSION['sex'] == "m") {
                $title = "Administrador";
            } else {
                $title = "Administradora";
            }
            $defaut_page = "user_management";
            break;
        case 'psi':
            if ($_SESSION['sex'] == "m") {
                $title = "Psicologo";
            } else {
                $title = "Psicologa";
            }
            $defaut_page = "pacient_management";
            break;
        case 'secre':
            if ($_SESSION['sex'] == "m") {
                $title = "Secretario";
            } else {
                $title = "Secretaria";
            }
            $defaut_page = "pacient_management";
            break;
        case 'paci':
            $title = "Paciente";
            $defaut_page = "calendar";
            break;
        case null:
            echo"
                <script language='javascript' type='text/javascript'>
                alert('Login necessário!');
                window.location.href='../index.php';
                </script>
            ";
            break;
    }
    require_once("../controllers/Users_controller.php");
    require_once("../classes/Users.php");
    $users_controller = new Users_controller($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="../styles/home.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/style-config.css"/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--
    <script src="../styles/jquery.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="../styles/javascript.js"></script>
    -->
    <title>Home | <?php echo $title; ?></title>
</head>
<body>
<section id="lateral-navbar">
    <div class="wrapper">
        <div class="section">
            <div class="top_navbar">
                <div class="hamburger">
                    <a href="#">
                    <i class="fas fa-bars"></i>
                </a>
            </div>
        </div>
        <div class="container">
            <?php 
                $page = $_GET['page']??$defaut_page;
                if (file_exists($page.".php")) {
                    include $page.".php";
                } else {
                    header("HTTP/1.0 404 Not Found");
                    include "404.php";
                } 
            ?>
        </div>
    </div>
    <div class="sidebar">
        <div class="profile">
            <?php
                if ($_SESSION['picture'] == null) {
                    $profile_picture = 'default.png';
                } else {
                    $profile_picture = $_SESSION['picture'];
                }
                echo'
                    <img src="../images/'.$profile_picture.'" alt="profile_picture">
                ';
            ?>
            <h3 style="text-transform: capitalize;"><?php echo $_SESSION["username"]; ?></h3>
            <p><?php echo $title; ?></p>
        </div>
        <ul id="side-nav">
            <form id="page" action="home.php" method="get"></form>
            <?php
                $options = $users_controller->get_options($_SESSION['title']);
                echo $options;
            ?>
            <li>
                <button type="submit" name="page" class="item" form="page" value="logout">Sair</button>
            </li>
        </ul>
    </div>
    <script>
        var hamburger = document.querySelector(".hamburger");
        hamburger.addEventListener("click", function(){
            document.querySelector("body").classList.toggle("active");
        });
    </script>
</section>
</body>
</html>