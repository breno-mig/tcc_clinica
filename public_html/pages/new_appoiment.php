<div class="main-register">
    <h2>Cadastro de nova Consulta</h2>
    <hr>
    <form action="" method="POST">
        <div>
            <span>
                Paciente
            </span>
            <?php $appoiment_controller->show_patient_to_select($required = true);?>
        </div>
        <div>
            <span>
                Piscologo
            </span>
            <?php $appoiment_controller->show_psychologist_to_select($required = true);?>
        </div>
        <div>
            <span>Data de agendamento</span>
            <input name="booking_date" type="datetime-local" placeholder="">
        </div> 
        <div>
            <span>Observações</span>
            <input name="observations" type="text" placeholder="">
        </div> 
        <input type="submit" class="btn-register" value="Salvar">
        <?php
            if ($_SESSION['profile'][0] == 2) {
                echo'<a href="home.php?page=appoiment_management" class="btn-cancel">Cancelar</a>';
            } elseif ($_SESSION['profile'][0] == 3) {
                echo'<a href="home.php?page=all_appoiments" class="btn-cancel">Cancelar</a>';
            }
        ?>
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
    
            if ($appoiment_controller->insert_appoiment($_POST)) {
                echo"
                    <script language='javascript' type='text/javascript'>
                        alert('Consulta agendada com sucesso');
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