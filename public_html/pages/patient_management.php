<section>
    <div class="card-users">
        <h2>Gerenciamento de Pacientes</h2>
        <form action="home.php" method="GET">
            <button class="new-user" type="submit">Novo Paciente</button>
            <input type="hidden" name="page" value="register">
        </form>
        <ul class="listed-user_list">
        <?php
            $listed_user = $user_controller->list_all_patients($_SESSION['profile'][0]);
        ?>
        </ul>
    </div>
</section>