<div class="main-register">
    <h2>Cadastro de novo Usuário</h2>
    <hr>
    <form action="" method="POST">
        <div>
            <span>
                Tipo de usuário:
            </span>
            <select name="id_profile" id="select" required>
                <option value="">Selecionar</option>
                <?php
                if ($_SESSION['profile'][0] == "1") {
                    echo '<option value="1">Administrador</option>';
                }                
                ?>                
                <option value="2">Psicólogo</option>
                <option value="3">Secretaria</option>
                <option value="4">Paciente</option>
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
            <span>CPF:</span>
            <input name="document" type="text" placeholder="xxx.xxx.xxx-xx" required>
        </div>
        <div>
            <span>E-mail:</span>
            <input name="email" type="text" placeholder="email@email.com" required>
        </div>
        <div>
            <span>Senha:</span>
            <input name="password" type="password" placeholder="Senha" required>
        </div>   
        <input type="submit" class="btn-register" value="Cadastrar">
        <a href="home.php" class="btn-cancel">Cancelar</a>
    </form>
</div>
<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if ($_POST == null) {
            echo"
                <script language='javascript' type='text/javascript'>
                    alert('Ocorreu um Erro!!');
                </script>
            ";
        } else {
    
            if ($user_controller->insert_user($_POST)) {
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