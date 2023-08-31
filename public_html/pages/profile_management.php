<section>
    <div class="card-users">
        <h2>Gerenciamento de Perfis</h2>
        <form action="home.php" method="GET">
            <button class="new-user" type="submit">Novo Perfil</button>
            <input type="hidden" name="page" value="new_profile">
        </form>
        <ul class="listed-user_list">
        <?php $profile_controller->list_all_profiles($_SESSION['profile'][0]); ?>
        </ul>
    </div>
</section>