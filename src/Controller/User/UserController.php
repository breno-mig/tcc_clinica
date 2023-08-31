<?php

namespace App\Controller\User;

require_once('../src/Commun/Helper/intHelper.php');
require_once('../src/Commun/Helper/stringHelper.php');
require_once('../src/Adapter/User/UserAdapter.php');
require_once('../src/UseCase/User/UserUseCase.php');
require_once('../src/Services/User/UserServices.php');
require_once('../src/Controller/Connection/MySqlConnection.php');
require_once('../src/Commun/ValueObject/Password.php');
require_once('../src/Controller/Profile/ProfileController.php');

use App\Commun\Helper\intHelper;
use App\Commun\Helper\stringHelper;
use App\Adapter\User\UserAdapter;
use App\UseCase\User\UserUseCase;
use App\Services\User\UserServices;
use App\Controller\Connection\MySqlConnection;
use App\Commun\ValueObject\Password;
use App\Controller\Profile\ProfileController;

//implements UserControllerInterface
class UserController
{

    use intHelper;
    use stringHelper;

    public function __construct(private $conn)
    {
        $this->conn = $conn;
    }

    public function check_login($username, $password):int
    {
        $clean_username = $this->clear_string($username);

        $user_adapter = new UserAdapter($this->conn);
        return $user_adapter->get_user($clean_username, $password);
    }

    public function get_welcome_message($name):string
    {
        $user_services = new UserServices();
        return $user_services->get_welcome_message($name);
    }

    public function get_id_user_from_login($username, $password):int
    {
        $clean_username = $this->clear_string($username);

        $user_adapter = new UserAdapter($this->conn);
        return $user_adapter->get_id_user_from_login($clean_username, $password);
    }

    public function get_user_by_id($id):Object
    {
        $user_use_case = new UserUseCase($this->conn);
        $user_adapter = new UserAdapter($this->conn);
        $profile_controller = new ProfileController($this->conn);

        $clean_id = $this->clear_int($id);

        $user = $user_adapter->get_user_by_id($clean_id);

        $profile = $profile_controller->get_profile_by_id($user_adapter->get_id_profile_from_user($clean_id));

        return $user_use_case->fill_user($user, $profile);
    }

    public function start_user_session($id):array
    {
        $clean_id = $this->clear_int($id);

        $user_use_case = new UserUseCase($this->conn);
        return $user_use_case->set_user_session($this->get_user_by_id($clean_id));
    }

    public function get_id_profile_from_user($id):int
    {
        $user_adapter = new UserAdapter($this->conn);
        return $user_adapter->get_id_profile_from_user($id);
    }

    public function get_options($profile_id)
    {
        $user_services = new UserServices();
        return $user_services->get_options($profile_id);
    }

    public function list_all_users($profile_id)
    {
        $clean_id = $this->clear_int($profile_id);

        $user_adapter = new UserAdapter($this->conn);
        if ($clean_id === 1) {
            return $this->show_listed_users($user_adapter->list_all_users());
        } else {
            echo"<script language='javascript' type='text/javascript'>alert('Acesso restrito');window.location.href='home.php';</script>";
        }
    }

    public function filter_users($user_profile, $profile_to_filter)
    {
        $clean_profile_to_fill = $this->clear_int($profile_to_filter);
        $clean_id = $this->clear_int($user_profile);
        
        $user_adapter = new UserAdapter($this->conn);
        if ($clean_id === 1) {
            return $this->show_listed_users($user_adapter->filter_users($clean_profile_to_fill));
        }else{
            echo"<script language='javascript' type='text/javascript'>alert('Acesso restrito');window.location.href='home.php';</script>";
        }
    }

    public function list_all_patients($user_profile)
    {
        $clean_id = $this->clear_int($user_profile);
        
        $user_adapter = new UserAdapter($this->conn);
        if ($clean_id === 2 or $clean_id === 3) {
            return $this->show_listed_users($user_adapter->list_all_patients());
        }else{
            echo"<script language='javascript' type='text/javascript'>alert('Acesso restrito');window.location.href='home.php';</script>";
        }
    }

    public function show_listed_users($users)
    {
        $user_services = new UserServices();
        return $user_services->show_listed_users($users);
    }

    public function insert_user($user_to_insert):bool
    {
        $user_adapter = new UserAdapter($this->conn);
        return $user_adapter->insert_user($user_to_insert);
    }

    public function logout()
    {
        $user_services = new UserServices();
        return $user_services->logout();
    }

    public function config_user($id,$user_profile)
    {
        $clean_id = $this->clear_int($id);
        $clean_profile = $this->clear_int($user_profile);
        $user_services = new UserServices($this->conn);
        return $user_services->show_config_info($this->get_user_by_id($clean_id),$clean_profile);
    }

    public function update_user($user_to_uptade,$id)
    {
        $clean_id = $this->clear_int($id);
        $user_adapter = new UserAdapter($this->conn);
        if ($_POST['password']) {
            $result = $user_adapter->update_user_with_password($_POST,$clean_id);
        } else {
            $result = $user_adapter->update_user($_POST,$clean_id);
        }

        if ($result) {
            if ($_SESSION['profile'][0] == 1) {
                echo"<script language='javascript' type='text/javascript'>alert('Usuário atualizado com sucesso');window.location.href='home.php?page=user_management';</script>";
            } else {
                echo"<script language='javascript' type='text/javascript'>alert('Paciente atualizado com sucesso');window.location.href='home.php?page=patient_management';</script>";
            }
            
            
        } else {
            echo"<script language='javascript' type='text/javascript'>alert('Ocorreu um erro ao atualizar o usuário')</script>";
        }
        
    }

    public function get_all_patients()
    {
        $user_adapter = new UserAdapter($this->conn);
        return $user_adapter->get_all_patients();
    }

    public function get_all_psychologist()
    {
        $user_adapter = new UserAdapter($this->conn);
        return $user_adapter->get_all_psychologist();
    }

    public function get_username_by_id($id):string
    {
        $clean_id = $this->clear_int($id);
        $user_adapter = new UserAdapter($this->conn);
        return $user_adapter->get_username_by_id($clean_id);
    }

    public function check_if_user_is_active($id):bool
    {
        $clean_id = $this->clear_int($id);
        $user_adapter = new UserAdapter($this->conn);
        if ($user_adapter->check_if_user_is_active($clean_id)) {
            return true;
        } else {
            return false;
        }
        
    }
}
