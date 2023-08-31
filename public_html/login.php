<?php session_start()?>
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
    <link rel="stylesheet" type="text/css" href="styles/login_style.css"/>
    <title>Login | Clinica</title>
</head>
<body>
   <div class="container vh-100 login-container">
        <div class="col-md-12 d-flex br-10 my-shadow">
            <div class="col-md-6 login-height login-left d-flex">
                <div class="col-md-8 col-md-offset-2 d-flex">
                    <h1>Psicólogos pela Saúde</h1>
                    <hr>
                    <p>Gerencie suas consultas de uma maneira simples e descomplicada.</p>
                    <hr>
                </div>
            </div>

            <div class="col-md-6 login-height login-right">
                <div class="col-md-12 d-flex">
                    <h2>Seja Bem-Vindo</h2>
                    <div class="inputs w-50">
                        <form action="" method="POST" class="" autocomplete="off">
                            <div class="username">
                                <label for="username">Usuário:</label><br>
                                <input class="input-login" type="text" name="username" id="username" placeholder="Insira seu nome de usuário" autocomplete="off">
                            </div>
                            <div class="password">
                                <label for="password">Senha:</label><br>
                                <input class="input-login" type="password" name="password" id="password" placeholder="Insira sua senha" autocomplete="off">
                                <a href="?forgot_password=1" class="forgot-password">Esqueci a senha</a>
                            </div>
                                <p class="register-text">Não possuí uma conta? Clique em <a href="#">"Registrar"</a> e crie uma conta agora mesmo.</p>
                            <div class="buttons">
                                <a href="register.php" class="register btn">Registrar</a>
                                <input class="submit btn" type="submit" value="Entrar" name="login">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
   </div>
</body>
</html>
<?php
    use App\Controller\User\UserController;

    if($_SERVER['REQUEST_METHOD']=='POST'){

        require_once("../src/Controller/User/UserController.php");
        require_once("../src/Controller/Connection/MySqlConnection.php");
        
        $user_controller = new UserController($conn);

        if ($user_controller->check_login($_POST['username'],$_POST['password'])) {

            $user_controller->start_user_session($user_controller->get_id_user_from_login($_POST['username'],$_POST['password']));

            echo $user_controller->get_welcome_message($_SESSION["username"]);
        }
    } 
?>