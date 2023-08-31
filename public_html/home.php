<?php 
    session_start();
    if ($_SESSION['profile']) {
        $_SESSION['profile'] = array_values($_SESSION['profile']);
    } else {
        echo"<script language='javascript' type='text/javascript'>alert('Login necessário');window.location.href='login.php';</script>";
    }
    switch ($_SESSION['profile'][0]) {
        case '1':
            if ($_SESSION['sex'] == "m") {
                $title = "Administrador";
            } else {
                $title = "Administradora";
            }
            $defaut_page = "user_management";
            break;
        case '2':
            if ($_SESSION['sex'] == "m") {
                $title = "Psicólogo";
            } else {
                $title = "Psicóloga";
            }
            $defaut_page = "patient_management";
            break;
        case '3':
            if ($_SESSION['sex'] == "m") {
                $title = "Secretário";
            } else {
                $title = "Secretária";
            }
            $defaut_page = "patient_management";
            break;
        case '4':
            if ($_SESSION['sex'] == "m") {
                $title = "Paciente";
            } else {
                $title = "Paciente";
            }
            $defaut_page = "patient_appoiments";
            break;
        case null:
            echo"
                <script language='javascript' type='text/javascript'>
                alert('Login necessário!');
                window.location.href='../login.php';
                </script>
            ";
            break;
    }
    use App\Controller\User\UserController;
    use App\Controller\Profile\ProfileController;
    use App\Controller\Appoiment\AppoimentController;
    use App\Controller\Connection\MySqlConnection;

    require_once("../src/Controller/User/UserController.php");
    require_once("../src/Controller/Appoiment/AppoimentController.php");
    require_once("../src/Controller/Connection/MySqlConnection.php");
    require_once("../src/Entity/User/User.php");

    $user_controller = new UserController($conn);
    $profile_controller = new ProfileController($conn);
    $appoiment_controller = new AppoimentController($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/style-config.css"/>
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
                if (file_exists("pages/".$page.".php")) {
                    include "pages/".$page.".php";
                } else {
                    header("HTTP/1.0 404 Not Found");
                    include "pages/404.php";
                }
                /*
                echo'<pre>';
                print_r($_SESSION['profile']);
                echo'</pre>';
                */
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
                    <img src="images/'.$profile_picture.'" alt="profile_picture">
                ';
            ?>
            <h3 style="text-transform: capitalize;"><?php echo $_SESSION["username"]; ?></h3>
            <p><?php echo $title; ?></p>
        </div>
        <ul id="side-nav">
            <form id="page" action="home.php" method="get"></form>
            <?php echo $user_controller->get_options($_SESSION['profile'][0]);?>
            <li>
                <form id="logout" action="" method="post"></form>
                <button type="submit" name="logout" class="item" form="logout" value="true">Sair</button>
                <?php if ($_POST['logout']??false) {$user_controller->logout();} ?>
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