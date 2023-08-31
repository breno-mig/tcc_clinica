<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="styles/primary.css"/>
    <title>Login | Clinica</title>
</head>
<body>
    <div class="main-login">
        <div class="card-login">
            <form action="" method="POST" class="form-login">
                <center><span>Psicólogos pela Saúde</span></center>
                <!--<h1>Login</h1>-->
                <div>
                    <label for="username">Usuário:</label><br>
                    <input class="input-login" type="text" name="username" id="username" placeholder="Usuário">
                </div>
                <div>
                    <label for="password">Senha:</label><br>
                    <input class="input-login" type="password" name="password" id="password" placeholder="Senha">
                </div>
                <input class="btn-login" type="submit" value="Entrar" name="login">
            </form>
            <?php

                use App\Controller\User\UserController;
                
                require_once("../src/Controller/User/UserController.php");
                require_once("../src/Controller/Connection/MySqlConnection.php");
                
                $user_controller = new UserController($conn);

                if($_SERVER['REQUEST_METHOD']=='POST'){

                    $id_user = $user_controller->check_login($_POST['username'],$_POST['password']);

                    if ($id_user) {
                        $current_user = $user_controller->get_user_by_id($id_user);
                        /*foreach ($current_user as $user) {
                            $name = $user->getUsername();
                        }*/
                        session_start();
                        $_SESSION = $user_controller->start_user_session($id_user);
                        echo'
                            <script language="javascript" type="text/javascript">
                                alert("Seja bem-vindo(a) '.$_SESSION["username"].'");
                                window.location.href="home.php";
                            </script>
                        ';
                    }
                } 
            ?>
        </div>
    </div>
</body>
</html>