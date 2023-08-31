<section>
<div class="main-config">
    <h2>Novo Perfil</h2>
    <hr>
    <div class="card-config">
        <div>
            <form method="POST" action="" enctype="multipart/form-data">
                <?php $profile_controller->new_profile_options(); ?>
                <div>
                    <button class="btn-register">Salvar</button>
                    <a href="home.php?page=profile_management" class="btn-cancel">Cancelar</a>
                    <input type="hidden" name="new" value="new">
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
                    if (isset($_POST["new"])) {
                        $profile_controller->insert_profile($_POST);
                    }
                ?>
            </form>
        </div>
    </div>
</div>
<section>