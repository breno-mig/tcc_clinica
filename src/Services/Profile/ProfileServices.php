<?php

namespace App\Services\Profile;

Class ProfileServices{

    public function show_listed_profiles($profile)
    {
        foreach ($profile as $profile)
        {
            if ($profile['is_active'] == 0)
            {
                $is_deactivated = "deactivated-user";
            }else{
                $is_deactivated ="";
            }
            switch ($profile["id_profile"]) {
                case 1:
                    $style = "listed-administrator";
                    $profile_name = "Administrador";
                break;
                case 2:
                    $style = "listed-psychologist";
                    $profile_name = "Psicólogo";
                break;
                case 3:
                    $style = "listed-secretary";
                    $profile_name = "Secretaria";
                break;
                case 4:
                    $style = "listed-pacient";
                    $profile_name = "Paciente";
                break;
            }
            echo'
                <li class="listed-user '.$is_deactivated.'">
                    <div class="listed-user_div">
                        <form action="home.php" method="GET" enctype="text/plain">
                            <span>'.$profile["id_profile"].' - 
                            <span class="'.$style.'">'.$profile_name.'</span></span></span>
                            <button type="submit" name="page" class="btn-alteracao" value="config_profile">
                                Editar
                            </button>
                            <input type="hidden" name="id_profile" value="'.$profile["id_profile"].'">
                        </form>
                    </div>
                </li>
            ';
        }
    }

    public function show_config_info($profile,$user_profile)
    {
        echo'
            <div>
                <label for="name">Nome do perfil</label>
                <input type="text" name="name" required value="'.$profile->getName().'">
            </div>
        ';
        echo'
            <div>
                '.$this->show_permissions($profile->getPermissions()).'
            </div>
        ';
        if ($user_profile === 1) {
            $is_active = $profile->getIsActive();
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
        } else {
            echo'
                <input type="hidden" name="is_active" value="'.$profile->getIsActive().'">
            ';
        }
    }

    public function show_permissions($permissions)
    {
        echo'
        <label for="permissions">Permissões</label>
        <div style="margin-left:25px;">
        ';
        $i = 1;
        foreach ($permissions as $permissions) {
            switch ($i) {
                case 1:
                    $name_permission = "Usuário";
                    $value = "user";
                    break;
                case 2:
                    $name_permission = "Prontuário";
                    $value = "notes";
                    break;
                case 3:
                    $name_permission = "Pacientes";
                    $value = "patient";
                    break;
                case 4:
                    $name_permission = "Consultas";
                    $value = "appoiment";
                    break;
            }
            $i = $i +1;
            $j = 1;
            echo'<p style="text-decoration: underline;">'.$name_permission.'</p>';
            foreach ($permissions as $permissions) {
                switch ($j) {
                    case 1:
                        $name = "Editar";
                        $permission_to = "edit";
                        break;
                    case 2:
                        $name = "Visualizar";
                        $permission_to = "view";
                        break;
                    case 3:
                        $name = "Inserir";
                        $permission_to = "insert";
                        break;
                }
                if ($permissions == 1) {
                    $active = "checked";
                    $not_active = null;
                } else {
                    $active = null;
                    $not_active = "checked";
                }
                echo'
                <div class="is_active" style="margin-left:25px;justify-content: space-between;width:160px;">
                    <span class="is_active_title">'.$name.':</span>
                    <div class="is_active_wrapper">
                        <div class="custom-input">
                            <input name="'.$permission_to.'_'.$value.'" id="'.$permission_to.'_'.$value.'" type="radio" value="1" '.$active.'>
                            <label for="'.$permission_to.'_'.$value.'">Sim</label>
                        </div>
                        <div class="custom-input">
                            <input name="'.$permission_to.'_'.$value.'" id="'.$permission_to.'_'.$value.'_0" type="radio" value="0" '.$not_active.' required>
                            <label for="'.$permission_to.'_'.$value.'_0">Não</label>
                        </div>
                    </div>
                </div>
                ';

            $j = $j +1;
            }
        }
        echo'</div>';
    }

    public function new_profile_options()
    {
        echo'
            <div>
                <label for="name">Nome do perfil</label>
                <input type="text" name="name" required value="">
            </div>
        ';
        echo'
        <div>
            <label for="permissions">Permissões</label>
            <div style="margin-left:25px;">
                <p style="text-decoration: underline;">Usuário:</p>

                <div class="is_active" style="margin-left:25px;justify-content: space-between;width:160px;">
                    <span class="is_active_title">Editar:</span>
                    <div class="is_active_wrapper">
                        <div class="custom-input">
                            <input name="edit_user" id="edit_user" type="radio" value="1">
                            <label for="edit_user">Sim</label>
                        </div>
                        <div class="custom-input">
                            <input name="edit_user" id="edit_user_0" type="radio" value="0" checked required>
                            <label for="edit_user_0">Não</label>
                        </div>
                    </div>
                </div>

                <div class="is_active" style="margin-left:25px;justify-content: space-between;width:160px;">
                    <span class="is_active_title">Visualizar:</span>
                    <div class="is_active_wrapper">
                        <div class="custom-input">
                            <input name="view_user" id="view_user" type="radio" value="1">
                            <label for="view_user">Sim</label>
                        </div>
                        <div class="custom-input">
                            <input name="view_user" id="view_user_0" type="radio" value="0" checked required>
                            <label for="view_user_0">Não</label>
                        </div>
                    </div>
                </div>

                <div class="is_active" style="margin-left:25px;justify-content: space-between;width:160px;">
                    <span class="is_active_title">Inserir:</span>
                    <div class="is_active_wrapper">
                        <div class="custom-input">
                            <input name="insert_user" id="insert_user" type="radio" value="1">
                            <label for="insert_user">Sim</label>
                        </div>
                        <div class="custom-input">
                            <input name="insert_user" id="insert_user_0" type="radio" value="0" checked required>
                            <label for="insert_user_0">Não</label>
                        </div>
                    </div>
                </div>

                <p style="text-decoration: underline;">Prontuário:</p>

                <div class="is_active" style="margin-left:25px;justify-content: space-between;width:160px;">
                    <span class="is_active_title">Editar:</span>
                    <div class="is_active_wrapper">
                        <div class="custom-input">
                            <input name="edit_notes" id="edit_notes" type="radio" value="1">
                            <label for="edit_notes">Sim</label>
                        </div>
                        <div class="custom-input">
                            <input name="edit_notes" id="edit_notes_0" type="radio" value="0" checked required>
                            <label for="edit_notes_0">Não</label>
                        </div>
                    </div>
                </div>

                <div class="is_active" style="margin-left:25px;justify-content: space-between;width:160px;">
                    <span class="is_active_title">Visualizar:</span>
                    <div class="is_active_wrapper">
                        <div class="custom-input">
                            <input name="view_notes" id="view_notes" type="radio" value="1">
                            <label for="view_notes">Sim</label>
                        </div>
                        <div class="custom-input">
                            <input name="view_notes" id="view_notes_0" type="radio" value="0" checked required>
                            <label for="view_notes_0">Não</label>
                        </div>
                    </div>
                </div>

                <div class="is_active" style="margin-left:25px;justify-content: space-between;width:160px;">
                    <span class="is_active_title">Inserir:</span>
                    <div class="is_active_wrapper">
                        <div class="custom-input">
                            <input name="insert_notes" id="insert_notes" type="radio" value="1">
                            <label for="insert_notes">Sim</label>
                        </div>
                        <div class="custom-input">
                            <input name="insert_notes" id="insert_notes_0" type="radio" value="0" checked required>
                            <label for="insert_notes_0">Não</label>
                        </div>
                    </div>
                </div>

                <p style="text-decoration: underline;">Paciente:</p>

                <div class="is_active" style="margin-left:25px;justify-content: space-between;width:160px;">
                    <span class="is_active_title">Editar:</span>
                    <div class="is_active_wrapper">
                        <div class="custom-input">
                            <input name="edit_patient" id="edit_patient" type="radio" value="1">
                            <label for="edit_patient">Sim</label>
                        </div>
                        <div class="custom-input">
                            <input name="edit_patient" id="edit_patient_0" type="radio" value="0" checked required>
                            <label for="edit_patient_0">Não</label>
                        </div>
                    </div>
                </div>

                <div class="is_active" style="margin-left:25px;justify-content: space-between;width:160px;">
                    <span class="is_active_title">Visualizar:</span>
                    <div class="is_active_wrapper">
                        <div class="custom-input">
                            <input name="view_patient" id="view_patient" type="radio" value="1">
                            <label for="view_patient">Sim</label>
                        </div>
                        <div class="custom-input">
                            <input name="view_patient" id="view_patient_0" type="radio" value="0" checked required>
                            <label for="view_patient_0">Não</label>
                        </div>
                    </div>
                </div>

                <div class="is_active" style="margin-left:25px;justify-content: space-between;width:160px;">
                    <span class="is_active_title">Inserir:</span>
                    <div class="is_active_wrapper">
                        <div class="custom-input">
                            <input name="insert_patient" id="insert_patient" type="radio" value="1">
                            <label for="insert_patient">Sim</label>
                        </div>
                        <div class="custom-input">
                            <input name="insert_patient" id="insert_patient_0" type="radio" value="0" checked required>
                            <label for="insert_patient_0">Não</label>
                        </div>
                    </div>
                </div>

                <p style="text-decoration: underline;">Consulta:</p>

                <div class="is_active" style="margin-left:25px;justify-content: space-between;width:160px;">
                    <span class="is_active_title">Editar:</span>
                    <div class="is_active_wrapper">
                        <div class="custom-input">
                            <input name="edit_appoiment" id="edit_appoiment" type="radio" value="1">
                            <label for="edit_appoiment">Sim</label>
                        </div>
                        <div class="custom-input">
                            <input name="edit_appoiment" id="edit_appoiment_0" type="radio" value="0" checked required>
                            <label for="edit_appoiment_0">Não</label>
                        </div>
                    </div>
                </div>

                <div class="is_active" style="margin-left:25px;justify-content: space-between;width:160px;">
                    <span class="is_active_title">Visualizar:</span>
                    <div class="is_active_wrapper">
                        <div class="custom-input">
                            <input name="view_appoiment" id="view_appoiment" type="radio" value="1">
                            <label for="view_appoiment">Sim</label>
                        </div>
                        <div class="custom-input">
                            <input name="view_appoiment" id="view_appoiment_0" type="radio" value="0" checked required>
                            <label for="view_appoiment_0">Não</label>
                        </div>
                    </div>
                </div>

                <div class="is_active" style="margin-left:25px;justify-content: space-between;width:160px;">
                    <span class="is_active_title">Inserir:</span>
                    <div class="is_active_wrapper">
                        <div class="custom-input">
                            <input name="insert_appoiment" id="insert_appoiment" type="radio" value="1">
                            <label for="insert_appoiment">Sim</label>
                        </div>
                        <div class="custom-input">
                            <input name="insert_appoiment" id="insert_appoiment_0" type="radio" value="0" checked required>
                            <label for="insert_appoiment_0">Não</label>
                        </div>
                    </div>
                </div>

            </div>
        </div> 
        ';
    }

    public function get_profile_name_by_sex($user_sex){
        if ($user_sex == "m") {
            return $_SESSION['profile'][2]["M"];
        } else {
            return $_SESSION['profile'][2]["F"];
        }
    }
}