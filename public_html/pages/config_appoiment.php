<section>
<div class="main-config">
    <h2>Editar Consulta:</h2>
    <hr>
    <div class="card-config">
        <div>
            <form method="POST" action="" enctype="multipart/form-data">
                <?php $appoiment_controller->config_appoiment($_GET['id_appoiment'],$_SESSION['profile'][1]['access_to_appoiment']['edit']); ?>
                <div>
                    <button class="btn-register">Salvar</button>
                    <?php
                        if ($_SESSION['profile'][0] == 2) {
                            echo'<a href="home.php?page=appoiment_management" class="btn-cancel">Cancelar</a>';
                        } elseif ($_SESSION['profile'][0] == 3) {
                            echo'<a href="home.php?page=all_appoiments" class="btn-cancel">Cancelar</a>';
                        } elseif ($_SESSION['profile'][0] == 4) {
                            echo'<a href="home.php?page=patient_appoiments" class="btn-cancel">Cancelar</a>';
                        }
                    ?>
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
                        $appoiment_controller->update_appoiment($_GET['id_appoiment'],$_POST,$_SESSION['profile'][0]);
                    }
                ?>
            </form>
        </div>
    </div>
</div>
<section>