<?php 
    if ($_SESSION['title'] <> 'adm') {
        echo"
            <script language='javascript' type='text/javascript'>
                alert('Acesso restrito');
                window.location.href='home.php';
            </script>
        ";
    }
    require_once("../controllers/Users_controller.php");
    require_once("../classes/Users.php");
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
            <form action="" method="POST">
                <button class="filter-users" type="submit">Todos</button>
                <input type="hidden" name="title" value="">
            </form>
            <form action="" method="POST">
                <button class="filter-users" type="submit">Administradores</button>
                <input type="hidden" name="title" value="adm">
            </form>
            <form action="" method="POST">
                <button class="filter-users" type="submit">Psicologos</button>
                <input type="hidden" name="title" value="psi">
            </form>
            <form action="" method="POST">
                <button class="filter-users" type="submit">Secretarios</button>
                <input type="hidden" name="title" value="secre">
            </form>
            <form action="" method="POST">
                <button class="filter-users" type="submit">Pacientes</button>
                <input type="hidden" name="title" value="paci">
            </form>
        </div>
        <ul class="listed-user_list">
        <?php
            $users_controller = new Users_controller($conn);

            if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['title']<>null){
                $filtered_title = $_POST['title'];
                $listed_user = $users_controller->filter_users($_SESSION['title'],$filtered_title);
            }else {
                $listed_user = $users_controller->list_all_users($_SESSION['title']);
            }
        ?>
        </ul>
    </div>
</section>