<section>
    <div class="card-users">
        <h2>Gerenciamento de Consultas</h2>
        <form action="home.php" method="GET">
            <button class="new-user" type="submit">Nova Consulta</button>
            <input type="hidden" name="page" value="new_appoiment">
        </form>
        <div class="filter" style="max-width:400px;display: inline-block;">
            <h3>Filtros:</h3>
            <form id="filter-appoiment" action="" method="POST">
                <div>
                    <span>Paciente: </span>
                    <?php
                        if ($_POST['id_pacient']??null) {
                            echo $appoiment_controller->show_patient_selected($required = false, $_POST["id_pacient"]);
                        } else {
                            echo $appoiment_controller->show_patient_to_select($required = false);
                        }
                    ?>
                </div>
                <div>
                    <span>Período: </span>
                    <label for="from">De </label><input type="date" name="from" id="from" value="<?php if($_POST['from']??null){ $data = new DateTime($_POST['from']); echo $data->format('Y-m-d');}?>">
                    <label for="to">Até </label><input type="date" name="to" id="to" value="<?php if($_POST['to']??null){ $data = new DateTime($_POST['to']); echo $data->format('Y-m-d');}?>">
                </div>
                <button class="btn-alteracao" style="float:left;" type="submit">Filtrar</button>
                <input type="hidden" name="filter">
            </form>
            <form action="" method="POST">
                <button class="btn-alteracao" style="float:left; margin-left:5px;" type="submit">Limpar Filtros</button>
                <input type="hidden" name="clear">
            </form>
        </div>
        <ul class="listed-user_list" style="margin-top: 0px !important;">
        <?php
            if (isset($_POST['filter'])) {
                $appoiment_controller->get_filtered_appoiments_from_psychologist($_SESSION['profile'][1]['access_to_appoiment']['view'], $_SESSION['id_user'], $_POST);
            }else{
                $appoiment_controller->get_all_appoiments_from_psychologist($_SESSION['profile'][1]['access_to_appoiment']['view'], $_SESSION['id_user']);
            }
        ?>
        </ul>
    </div>
</section>