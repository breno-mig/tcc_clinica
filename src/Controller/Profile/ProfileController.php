<?php

namespace App\Controller\Profile;

require_once('../src/Commun/Helper/intHelper.php');
require_once('../src/Commun/Helper/stringHelper.php');
require_once('../src/Adapter/Profile/ProfileAdapter.php');
require_once('../src/Services/Profile/ProfileServices.php');
require_once('../src/UseCase/Profile/ProfileUseCase.php');

use App\Commun\Helper\intHelper;
use App\Commun\Helper\stringHelper;
use App\Adapter\Profile\ProfileAdapter;
use App\Services\Profile\ProfileServices;
use App\UseCase\Profile\ProfileUseCase;

class ProfileController
{

    use intHelper;
    use stringHelper;

    public function __construct(private $conn)
    {
        $this->conn = $conn;
    }

    public function get_profile_by_id($id):object
    {
        $profile_adapter = new ProfileAdapter($this->conn);
        $profile_use_case = new ProfileUseCase($this->conn);

        $clean_id = $this->clear_int($id);

        return $profile_use_case->fill_profile($profile_adapter->get_profile_by_id($clean_id));
    }

    public function check_permissions_to_patient($user_permissions)
    {
        echo $user_permissions['edit'];
    }

    public function list_all_profiles()
    {
        $profile_adapter = new ProfileAdapter($this->conn);
        return $this->show_listed_profiles($profile_adapter->list_all_profiles());
    }

    public function show_listed_profiles($profile_to_show)
    {
        $profile_services = new ProfileServices($this->conn);
        return $profile_services->show_listed_profiles($profile_to_show);
    }

    public function config_profile($id,$user_profile)
    {
        $clean_id = $this->clear_int($id);
        $clean_profile = $this->clear_int($user_profile);
        $profile_services = new ProfileServices($this->conn);
        return $profile_services->show_config_info($this->get_profile_by_id($clean_id),$clean_profile);
    }

    public function get_profile_name_by_id($id)
    {
        $profile_adapter = new ProfileAdapter($this->conn);
        return $profile_adapter->get_profile_name_by_id($this->clear_int($id));
    }

    public function update_profile($profile_to_update,$id_profile)
    {
        $profile_adapter = new ProfileAdapter($this->conn);
        $result = $profile_adapter->update_profile($profile_to_update,$this->clear_int($id_profile));
        
        if ($result) {
            echo"<script language='javascript' type='text/javascript'>alert('Perfil atualizado com sucesso');window.location.href='home.php?page=profile_management';</script>";
        } else {
            echo"<script language='javascript' type='text/javascript'>alert('Ocorreu um erro ao atualizar o perfil');window.location.href='home.php?page=profile_management';</script>";
        }
    }

    public function insert_profile($profile_to_insert)
    {
        $profile_adapter = new ProfileAdapter($this->conn);
        $result = $profile_adapter->insert_profile($profile_to_insert);
        
        if ($result) {
            echo"<script language='javascript' type='text/javascript'>alert('Perfil inserido com sucesso');window.location.href='home.php?page=profile_management';</script>";
        } else {
            echo"<script language='javascript' type='text/javascript'>alert('Ocorreu um erro ao inserir o perfil');window.location.href='home.php?page=profile_management';</script>";
        }
    }

    public function new_profile_options()
    {
        $profile_services = new ProfileServices();
        return $profile_services->new_profile_options();
    }
}