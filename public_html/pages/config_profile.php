<section>
<div class="main-config">
    <h2>Editar perfil: <?php echo $profile_controller->get_profile_name_by_id($_GET['id_profile']) ?></h2>
    <hr>
    <div class="card-config">
        <div>
            <form method="POST" action="" enctype="multipart/form-data">
                <?php $profile_controller->config_profile($_GET['id_profile'],$_SESSION['profile'][0]); ?>
                <div>
                    <button class="btn-register">Salvar</button>
                    <a href="home.php?page=profile_management" class="btn-cancel">Cancelar</a>
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
                        $profile_controller->update_profile($_POST,$_GET['id_profile']);
                    }
                ?>
            </form>
        </div>
    </div>
</div>
<section>