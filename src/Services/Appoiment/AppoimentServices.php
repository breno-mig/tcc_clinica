<?php

namespace App\Services\Appoiment;

class AppoimentServices
{
    public function show_patient_to_select($patient, $is_required)
    {
        if ($is_required) {
            $required = "required";
        }else{
            $required = "";
        }
        echo'
            <select name="id_pacient" id="select" '.$required.'>
            <option value="">Selecionar</option>
        ';
        foreach ($patient as $patient) {
            echo'
                <option value="'.$patient['id_user'].'">'.$patient['username'].'</option>
            ';
        }
        echo'
            </select>
        ';
    }

    public function show_patient_selected($patient, $is_required, $id_patient)
    {
        if ($is_required) {
            $required = "required";
        }else{
            $required = "";
        }
        echo'
            <select name="id_pacient" id="select" '.$required.'>
            <option value="">Selecionar</option>
        ';
        foreach ($patient as $patient) {
            if ($patient["id_user"] == $id_patient) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            echo'
                <option value="'.$patient['id_user'].'" '.$selected.'>'.$patient['username'].'</option>
            ';
        }
        echo'
            </select>
        ';
    }

    public function show_psychologist_to_select($psychologist, $is_required)
    {
        if ($is_required) {
            $required = "required";
        }else{
            $required = "";
        }
        echo'
            <select name="id_psychologist" id="select" '.$required.'>
            <option value="">Selecionar</option>
        ';
        foreach ($psychologist as $psychologist) {
            echo'
                <option value="'.$psychologist['id_user'].'">'.$psychologist['username'].'</option>
            ';
        }
        echo'
            </select>
        ';
    }

    public function show_psychologist_to_select_in_config($psychologist,$id_psychologist)
    {
        foreach ($psychologist as $psychologist) {
            if ($psychologist['id_user'] == $id_psychologist) {
                $selected = 'selected';
            }else{
                $selected = "";
            }
            echo'
                <option value="'.$psychologist['id_user'].'" '.$selected.'>'.$psychologist['username'].'</option>
            ';
        }
    }

    public function show_listed_appoiments($appoiment,$name_pacient,$name_psychologist)
    {
        //$booking_date = ;
        if ($appoiment['is_active'] == 0)
        {
            $is_deactivated = "deactivated-user";
        }else{
            $is_deactivated ="";
        }
        echo'
            <li class="listed-user '.$is_deactivated.'">
                <div class="listed-user_div">
                    <form action="home.php" method="GET" enctype="text/plain">
                        <span>'.date('d/m/Y',strtotime($appoiment["booking_date"])).' | 
                        <span>Horário: '.date('H:i',strtotime($appoiment["booking_date"])).'</span> | <span>Psicologo: '.$name_psychologist.'</span> | <span>Paciente: '.$name_pacient.'</span></span></span>
                        <button type="submit" name="page" class="btn-alteracao" value="config_appoiment" style="margin-left:5px;">
                            Editar
                        </button>
        ';
        if ($_SESSION['profile'][1]['access_to_notes']['view'] == 1) {
                    echo'
                        <button type="submit" name="page" class="btn-alteracao" value="notes">
                            Anotações
                        </button>
                    ';
        }
        echo'
                        <input type="hidden" name="id_appoiment" value="'.$appoiment["id_appoiment"].'">
                    </form>
                </div>
            </li>
        ';
    }

    public function show_appoiment_config($appoiment,$psychologists)
    {

        if ($_SESSION['profile'][0] <> 4) {
            echo"
                <div>
                <span>Psicólogo</span>
            ";
            echo"
                <select name='id_psychologist' id='select' required style='text-transform:capitalize;'>
                <option value=''>Selecionar</option>
            ";
            echo $this->show_psychologist_to_select_in_config($psychologists,$appoiment->getIdPsychologist()->getIdUser());
            echo"
                </select>
            ";
            echo"
                </div>
            ";
        }
        echo'
            <div>
                <label for="booking_date">Data da Consulta</label>
                <input type="datetime-local" name="booking_date" required value="'.$appoiment->getBookingDate()->format('Y-m-d H:i').'">
            </div>
            '
        ;
        if ($_SESSION['profile'][1]['access_to_notes']['view'] == true) {
            echo'
            <div>
                <label for="observation">Anotações</label>
                <input type="text" name="observation" value="'.$appoiment->getObservation().'">
            </div>
            ';
        }else{
            echo'<input type="hidden" name="observation" value="'.$appoiment->getObservation().'">';
        }
        $is_active = $appoiment->getIsActive();
            if ($is_active == 1) {
                $active = "checked";
                $not_active = null;
            } else {
                $active = null;
                $not_active = "checked";
            }
        echo'
            <div class="is_active">
            <span class="is_active_title">Ativo</span>
                <div class="is_active_wrapper">
                    <div class="custom-input">
                        <input name="is_active" id="1" type="radio" value="1" '.$active.'>
                        <label for="1">Sim</label>
                    </div>
                    <div class="custom-input">
                        <input name="is_active" id="0" type="radio" value="0" '.$not_active.' required>
                        <label for="0">Não</label>
                    </div>
                </div>
            </div>
            ';
    }

    public function show_notes($notes)
    {
        echo'
            <div class="main-register">
                <h2>Anotações</h2>
                <hr>
                <form action="" method="POST">
                    <div>
                        <textarea name="observation" id="observation" cols="60" rows="25" style="padding:5px;">'.$notes.'</textarea>
                    </div> 
                    <input type="submit" class="btn-register" value="Salvar">
                    <input type="hidden" name="save" value="true">
                    <a href="home.php?page=appoiment_management" class="btn-cancel">Cancelar</a>
                </form>
            </div>
        ';
    }

    public function show_patient_notes($appoiment,$name_pacient)
    {
        if ($appoiment['is_active'] == 0)
        {
            $is_deactivated = "deactivated-user";
        }else{
            $is_deactivated ="";
        }
        echo'
            <li class="listed-user '.$is_deactivated.'">
                <div class="listed-user_div">
                    <form action="home.php" method="GET" enctype="text/plain">
                        <span>'.date('d/m/Y',strtotime($appoiment["booking_date"])).' | 
                        <span>Paciente: '.$name_pacient.'</span></span></span>
                        <button type="submit" name="page" class="btn-alteracao" value="config_appoiment" style="margin-left:5px;">
                            Editar
                        </button>
                        <button type="submit" name="page" class="btn-alteracao" value="notes">
                            Anotações
                        </button>
                        <input type="hidden" name="id_appoiment" value="'.$appoiment["id_appoiment"].'">
                    </form>
                </div>
            </li>
        ';
    }
}