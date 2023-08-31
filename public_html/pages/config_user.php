<section>
<div class="main-config">
    <h2>Configurações de Perfil</h2>
    <hr>
    <div class="card-config">
        <div>
            <form method="POST" action="" enctype="multipart/form-data">
                <?php $user_controller->config_user($_GET['id_user']??$_SESSION['id_user'],$_SESSION['profile'][0]); ?>
                <div>
                    <label for="password">Nova Senha</label>
                    <input type="password" name="password" placeholder="Nova Senha" value="" autocomplete="false">
                </div>   
                <div>
                    <button class="btn-register">Salvar</button>
                    <a href="home.php" class="btn-cancel">Cancelar</a>
                    <input type="hidden" name="edit" value="edit">
                </div>
                <script type="text/javascript">
                    function PreviewImage() {
                        var oFReader = new FileReader();
                        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
                        oFReader.onload = function (oFREvent) {
                            document.getElementById("uploadPreview").src = oFREvent.target.result;
                        };
                    };
                </script>
                <?php
                    if (isset($_POST["edit"])) {
                        $user_controller->update_user($_POST,$_GET['id_user']??$_SESSION['id_user']);
                    }
                ?>
            </form>
        </div>
    </div>
</div>
<section>