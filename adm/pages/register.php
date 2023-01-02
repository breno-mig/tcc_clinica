<div class="main-register">
    <h2>Novo Usuário</h2>
    <hr>
    <form action="" method="POST">
        <div>
            <span>
                Tipo de usuário:
            </span>
            <select name="title" id="select" required>
                <option value="">Selecionar</option>
                <?php
                if ($_SESSION['title'] == "adm") {
                    echo '<option value="adm">Administrador</option>';
                }                
                ?>                
                <option value="psi">Psicólogo</option>
                <option value="secre">Secretaria</option>
                <option value="paci">Paciente</option>
            </select>
        </div>
        <div>
            <span>Nome de usuário:</span>
            <input name="username" type="text" placeholder="Usuário" required>
        </div>
        <div>
            <span>Sexo:</span>
            <label for="m">
                Masculino
                <input name="sex" id="m" type="radio" value="m" required>
            </label>
            <label for="f">
                Feminino
                <input name="sex" id="f" type="radio" value="f">
            </label>
        </div>  
        <div>
            <span>Senha:</span>
            <input name="password" type="password" placeholder="Senha" required>
        </div>   
        <input type="submit" class="btn-register" value="Cadastrar">
        <a href="home.php?page=user_management" class="btn-cancel">Cancelar</a>
    </form>
</div>
<?php
    require_once("../controllers/Users_controller.php");
    require_once("../classes/Users.php");
    $users_controller = new Users_controller($conn);

    if($_SERVER['REQUEST_METHOD']=='POST'){
        if ($_POST == null) {
            echo"
                <script language='javascript' type='text/javascript'>
                    alert('Ocorreu um Erro!!');
                </script>
            ";
        } else {
            $password = MD5($_POST['password']);
            $username = $_POST['username'];
            $title = $_POST['title'];
            $sex = $_POST['sex'];
            
            $insert = $users_controller->insert_user($_POST);
    
            if ($insert == true) {
                echo"
                    <script language='javascript' type='text/javascript'>
                        alert('Cadastro Realizado');
                        window.location.href='home.php';
                    </script>
                ";
            }else {
                echo"
                    <script language='javascript' type='text/javascript'>
                        alert('Ocorreu um Erro!!');
                    </script>
                ";
            }
        }
    } 
?>