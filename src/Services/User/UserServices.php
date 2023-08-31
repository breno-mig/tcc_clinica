<?php

namespace App\Services\User;

Class UserServices{

    public function get_welcome_message($name):string
    {
        return '
            <script class="top-alert" language="javascript" type="text/javascript">
                alert("Seja bem-vindo(a) '.$name.'");
                window.location.href="home.php";
            </script>
        ';
    }

    public function get_options($profile_id)
    {
        switch ($profile_id)
        {
            case 1:
                $options = '
                    <li><button type="submit" name="page" class="item" form="page" value="user_management">Usuários</button></li>
                    <li><button type="submit" name="page" class="item" form="page" value="profile_management">Perfis</button></li>
                    <li><button type="submit" name="page" class="item" form="page" value="config_user">Configurações</button></li>
                ';
            break;
            case 2:
                //<li><button type="submit" name="page" class="item" form="page" value="appoiment_management">Consultas</button></li>
                $options ='
                    <li><button type="submit" name="page" class="item" form="page" value="patient_management">Pacientes</button></li>
                    <li><button type="submit" name="page" class="item" form="page" value="new_appoiment_management">Consultas</button></li>
                    <li><button type="submit" name="page" class="item" form="page" value="config_user">Configurações</button></li>
                ';
            break;
            case 3:
                //<li><button type="submit" name="page" class="item" form="page" value="calendar">Calendario</button></li>
                $options ='
                    <li><button type="submit" name="page" class="item" form="page" value="patient_management">Pacientes</button></li>
                    <li><button type="submit" name="page" class="item" form="page" value="all_appoiments">Consultas</button></li>
                    <li><button type="submit" name="page" class="item" form="page" value="config_user">Configurações</button></li>
                ';
            break;
            case 4:
                //<li><button type="submit" name="page" class="item" form="page" value="calendar">Calendario</button></li>
                $options ='
                    <li><button type="submit" name="page" class="item" form="page" value="patient_appoiments">Consultas</button></li>
                    <li><button type="submit" name="page" class="item" form="page" value="config_user">Configurações</button></li>
                ';
            break;
        }
        return $options;
    }

    public function show_listed_users($users)
    {
        foreach ($users as $users)
        {
            if ($users['is_active'] == 0)
            {
                $is_deactivated = "deactivated-user";
            }else{
                $is_deactivated ="";
            }
            switch ($users["id_profile"]) {
                case 1:
                    $style = "listed-administrator";
                    if ($users["sex"] == "m")
                    {
                        $title_ = "Administrador";
                    } else {
                        $title_ = "Administradora";
                    }
                break;
                case 2:
                    $style = "listed-psychologist";
                    if ($users["sex"] == "m")
                    {
                
                        $title_ = "Psicologo";
                    } else {
                        $title_ = "Psicologa";
                    }
                break;
                case 3:
                    $style = "listed-secretary";
                    if ($users["sex"] == "m")
                    {
                        $title_ = "Secretario";
                    } else {
                        $title_ = "Secretaria";
                    }
                break;
                case 4:
                    if ($users["sex"] == "m")
                    {
                        $title_ = "Paciente";
                    } else {
                        $title_ = "Paciente";
                    }
                    $style = "listed-pacient";
                break;
            }
            echo'
                <li class="listed-user '.$is_deactivated.'">
                    <div class="listed-user_div">
                        <form action="home.php" method="GET" enctype="text/plain">
                            <span>'.$users["id_user"].' - 
                                <span class="'.$style.'">'.$title_.'</span>
                                <span>'.$users["username"].'</span>
                            </span>
            ';
            
            if ($_SESSION['profile'][0] == 2)
            {
                echo'
                    <button type="submit" name="page" class="btn-alteracao" value="notes" style="margin-left:5px;">
                        Anotações
                    </button>
                ';
            }

            echo'
                            <button type="submit" name="page" class="btn-alteracao" value="config_user">
                                Editar
                            </button>
                            <input type="hidden" name="id_user" value="'.$users["id_user"].'">
                        </form>
                    </div>
                </li>
            ';
            /*
                <button type="submit" class="btn-alteracao" form="users_actions" name="page" value="'.$config_page.'">Editar</button>
                <button type="submit" name="page" class="btn-delete" form="users_actions" value="delete-user='.$users["id_user"].'" style="float:right;margin-right:5px;">Excluir</button>
            
                <button type="submit" name="page" class="btn-alteracao" form="users_actions" value="config/'.$config_page.'&id_user='.$users["id_user"].'">
                    Editar
                </button>
                
                <input class="btn-alteracao" name="" type="submit" value="Editar">
                <input type="hidden" name="page" value="'.$config_page.'">
            */
        }
    }

    public function logout()
    {
        session_destroy();
        echo"
            <script language='javascript' type='text/javascript'>
                alert('Sessão encerrada');
                window.location.href='../index.php';
            </script>
        ";
    }

    public function show_config_info($user, $user_profile)
    {        
        echo'
            <div class="personal-image">
                Foto de Perfil
                    <label>
                        <input type="file" name="picture" onchange="PreviewImage();" id="uploadImage" value="">
                        <figure class="personal-figure">
                            <img src="images/'.$user->getPicture().'"id="uploadPreview" class="personal-avatar" alt="avatar">
                            <figcaption class="personal-figcaption">
                                <i class="fa fa-camera"></i>
                            </figcaption>
                        </figure>
                    </label>
                </div>
                <div>
                    <label for="username">Nome de Usuário</label>
                    <input type="text" name="username" required value="'.$user->getUsername().'">
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" required value="'.$user->getEmail().'">
                </div>
                <div>
                    <label for="document">CPF</label>
                    <input type="text" name="document" required value="'.$user->getDocument().'">
                </div>
                <div>
                    <label for="birth_date">Nascimento</label>
                    <input type="date" name="birth_date" required value="'.$user->getBirthDate()->format('Y-m-d').'">
                </div>
                '
            ;
        if ($user_profile === 1) {
            $is_active = $user->getIsActive();
            if ($is_active == 1) {
                $active = "checked";
                $not_active = null;
            } else {
                $active = null;
                $not_active = "checked";
            }
            echo $this->show_user_profile($user->getProfile()->getIdProfile()).'
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
                <input type="hidden" name="is_active" value="'.$user->getIsActive().'">
                <input type="hidden" name="id_profile" value="'.$user->getProfile()->getIdProfile().'">
            ';
        }
        echo $this->show_user_sex($user->getSex());
    }

    public function show_user_profile($id_profile)
    {
        switch ($id_profile) {
            case 1:
                echo'
                <div>
                    <label for="id_profile">Perfil</label>
                    <select name="id_profile" id="select" required>
                        <option value="">Selecionar</option>
                        <option value="1" selected>Administrador</option>             
                        <option value="2">Psicólogo</option>
                        <option value="3">Secretaria</option>
                        <option value="4">Paciente</option>
                    </select>
                </div>
                ';
                break;
            case 2:
                echo'
                <div>
                    <label for="profile">Perfil</label>
                    <select name="id_profile" id="select" required>
                        <option value="">Selecionar</option>
                        <option value="1">Administrador</option>             
                        <option value="2" selected>Psicólogo</option>
                        <option value="3">Secretaria</option>
                        <option value="4">Paciente</option>
                    </select>
                </div>
                ';
                break;
            case 3:
                echo'
                <div>
                    <label for="profile">Perfil</label>
                    <select name="id_profile" id="select" required>
                        <option value="">Selecionar</option>
                        <option value="1">Administrador</option>             
                        <option value="2">Psicólogo</option>
                        <option value="3" selected>Secretaria</option>
                        <option value="4">Paciente</option>
                    </select>
                </div>
                ';
                break;
            case 4:
                echo'
                <div>
                    <label for="profile">Perfil</label>
                    <select name="id_profile" id="select" required>
                        <option value="">Selecionar</option>
                        <option value="1">Administrador</option>             
                        <option value="2">Psicólogo</option>
                        <option value="3">Secretaria</option>
                        <option value="4" selected>Paciente</option>
                    </select>
                </div>
                ';
                break;
            default:
                echo'
                <div>
                    <label for="profile">Perfil</label>
                    <select name="id_profile" id="select" required>
                        <option value="">Selecionar</option>
                        <option value="1">Administrador</option>             
                        <option value="2">Psicólogo</option>
                        <option value="3">Secretaria</option>
                        <option value="4">Paciente</option>
                    </select>
                </div>
                ';
                break;
        }
    }

    public function show_user_sex($user_sex)
    {
        if ($user_sex === 'm') {
            echo'
            <div>
                <span>Sexo:</span>
                <label for="m">
                    Masculino
                    <input name="sex" id="m" type="radio" value="m" required checked>
                </label>
                <label for="f">
                    Feminino
                    <input name="sex" id="f" type="radio" value="f">
                </label>
            </div>
            ';
        } else {
            echo'
            <div>
                <span>Sexo:</span>
                <label for="m">
                    Masculino
                    <input name="sex" id="m" type="radio" value="m" required>
                </label>
                <label for="f">
                    Feminino
                    <input name="sex" id="f" type="radio" value="f" checked>
                </label>
            </div>
            ';
        }
        
    }
}