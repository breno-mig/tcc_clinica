<?php
$user = $_GET['id_user']??null;
$appoiment = $_GET['id_appoiment']??null;

if ($user) {
    echo'
    <section>
        <div class="card-users">
            <h2>Gerenciamento de Anotações</h2>
            <ul class="listed-user_list">
    ';
            $appoiment_controller->get_notes_by_patient($_GET['id_user']);
    echo'
            </ul>
        </div>
    </section>
    ';
} elseif($appoiment) {
    $notes = $appoiment_controller->get_notes_by_id($_GET['id_appoiment']);
    $appoiment_controller->show_notes($notes);

    if($_SERVER['REQUEST_METHOD']=='POST'){
        if ($_POST['save']) {
            if ($appoiment_controller->update_appoiment_observation($_POST['observation'],$_GET['id_appoiment'])) {
                echo"
                    <script language='javascript' type='text/javascript'>
                        alert('Anotação atualizada com sucesso');
                        window.location.href='home.php?page=appoiment_management';
                    </script>
                ";
            }else {
                echo"
                    <script language='javascript' type='text/javascript'>
                        alert('Ocorreu um Erro!!');
                    </script>
                ";
            }
        } else {
            echo"
                <script language='javascript' type='text/javascript'>
                    alert('Ocorreu um Erro!!');
                </script>
            ";
        }
    } 
}
?>