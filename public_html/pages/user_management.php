<?php 
    if ($_SESSION['profile'][0] <> '1') {
        echo"
            <script language='javascript' type='text/javascript'>
                alert('Acesso restrito');
                window.location.href='home.php';
            </script>
        ";
    }
    //require_once("../src/Controller/User/UserController.php");
    //require_once("../src/Entity/User/User.php");

    //use App\Controller\User\UserController;
?>
<section>
    <div class="card-users">
        <h2>Gerenciamento de Usuários</h2>
        <form action="home.php" method="GET">
            <button class="new-user" type="submit">Novo Usuario</button>
            <input type="hidden" name="page" value="register">
        </form>
        <div class="filter">
            <h3>Filtrar:</h3>
            <br>
            <form id="filter-users" action="" method="POST"></form>
            <button form="filter-users" name="profile_id" value="" class="filter-users" type="submit">Todos</button>
            <button form="filter-users" name="profile_id" value="1" class="filter-users" type="submit">Administradores</button>
            <button form="filter-users" name="profile_id" value="2" class="filter-users" type="submit">Psicologos</button>
            <button form="filter-users" name="profile_id" value="3" class="filter-users" type="submit">Secretarios</button>
            <button form="filter-users" name="profile_id" value="4" class="filter-users" type="submit">Pacientes</button>
            <!--
                Criar slider para Somente ativos | Somente desativados | Todos
                Mais recentes ou mais antigos
            -->
        </div>
        <ul class="listed-user_list">
        <?php
            $id_profile = $_POST['profile_id']??null;
            if($_SERVER['REQUEST_METHOD']=='POST' && $id_profile<>null){
                $listed_user = $user_controller->filter_users($_SESSION['profile'][0],$_POST['profile_id']);
            }else {
                $listed_user = $user_controller->list_all_users($_SESSION['profile'][0]);
            }
        ?>
        </ul>
    </div>
</section>