<?php

namespace App\Controller\Appoiment;

require_once('../src/Commun/Helper/intHelper.php');
require_once('../src/Commun/Helper/stringHelper.php');
require_once('../src/Controller/Connection/MySqlConnection.php');
require_once('../src/Controller/User/UserController.php');
require_once('../src/Adapter/Appoiment/AppoimentAdapter.php');
require_once('../src/Services/Appoiment/AppoimentServices.php');
require_once('../src/UseCase/Appoiment/AppoimentUseCase.php');

use App\Commun\Helper\intHelper;
use App\Commun\Helper\stringHelper;
use App\Controller\Connection\MySqlConnection;
use App\Controller\User\UserController;
use App\Adapter\Appoiment\AppoimentAdapter;
use App\Services\Appoiment\AppoimentServices;
use App\UseCase\Appoiment\AppoimentUseCase;

class AppoimentController
{

    use intHelper;
    use stringHelper;

    public function __construct(private $conn)
    {
        $this->conn = $conn;
    }

    public function get_all_appoiments($permisson)
    {
        if ($permission = true) {
            $appoiment_adapter = new AppoimentAdapter($this->conn);
            $appoiment_sevices = new AppoimentServices();
            $user_controller = new UserController($this->conn);

            $appoiment = $appoiment_adapter->get_all_appoiments();
            foreach ($appoiment as $appoiment)
            {
                if ($user_controller->check_if_user_is_active($appoiment['id_psychologist'])) {
                    $name_psychologist = $user_controller->get_username_by_id($appoiment['id_psychologist']);
                    $name_pacient = $user_controller->get_username_by_id($appoiment['id_pacient']);
                    $appoiment_sevices->show_listed_appoiments($appoiment,$name_pacient,$name_psychologist);
                }
            }
        } else {
            echo"<script language='javascript' type='text/javascript'>alert('Acesso restrito');window.location.href='home.php';</script>";
        }
    }

    public function get_appoiment_by_id($id)
    {
        $appoiment_adapter = new AppoimentAdapter($this->conn);
        $appoiment_use_case = new AppoimentUseCase($this->conn);
        $user_controller = new UserController($this->conn);

        $patient_id = $this->get_patient_by_appoiment_id($this->clear_int($id));
        $psychologist_id = $this->get_psychologist_by_appoiment_id($this->clear_int($id));

        $patient = $user_controller->get_user_by_id($this->clear_int($patient_id));
        $psychologist = $user_controller->get_user_by_id($this->clear_int($psychologist_id));

        return $appoiment_use_case->fill_appoiment($appoiment_adapter->get_appoiment_by_id($this->clear_int($id)),$patient, $psychologist);
    }

    public function get_all_appoiments_from_psychologist($permission,$id_user)
    {
        if ($permission) {$appoiment_adapter = new AppoimentAdapter($this->conn);
            $appoiment_sevices = new AppoimentServices();
            $user_controller = new UserController($this->conn);
    
            $appoiment = $appoiment_adapter->get_all_appoiments_from_psychologist($this->clear_int($id_user));
            foreach ($appoiment as $appoiment)
            {
                if ($user_controller->check_if_user_is_active($appoiment['id_psychologist'])&&$user_controller->check_if_user_is_active($appoiment['id_pacient'])) {
                    $name_psychologist = $user_controller->get_username_by_id($appoiment['id_psychologist']);
                    $name_pacient = $user_controller->get_username_by_id($appoiment['id_pacient']);
                    $appoiment_sevices->show_listed_appoiments($appoiment,$name_pacient,$name_psychologist);
                }
            }
        } else {
            echo"<script language='javascript' type='text/javascript'>alert('Acesso restrito');window.location.href='home.php';</script>";
        }
    }

    public function get_all_appoiments_from_patient($profile,$id_user)
    {
        $appoiment_adapter = new AppoimentAdapter($this->conn);
        $appoiment_sevices = new AppoimentServices();
        $user_controller = new UserController($this->conn);

        $appoiment = $appoiment_adapter->get_all_appoiments_from_patient($id_user);
        foreach ($appoiment as $appoiment)
        {
            if ($user_controller->check_if_user_is_active($appoiment['id_psychologist'])) {
                $name_psychologist = $user_controller->get_username_by_id($appoiment['id_psychologist']);
                $name_pacient = $user_controller->get_username_by_id($appoiment['id_pacient']);
                $appoiment_sevices->show_listed_appoiments($appoiment,$name_pacient,$name_psychologist);
            }
        }
    }

    public function get_all_booking_dates_from_patient($id_patient)
    {
        $appoiment_adapter = new AppoimentAdapter($this->conn);
    }

    public function get_all_booking_dates($permission)
    {
        if ($permission) {
            $appoiment_adapter = new AppoimentAdapter($this->conn);
            return $appoiment_adapter->get_all_booking_dates();
        } else {
            echo"<script language='javascript' type='text/javascript'>alert('Acesso restrito');window.location.href='home.php';</script>";
        }
        
    }

    public function insert_appoiment($appoiment_to_insert):bool
    {
        $appoiment_adapter = new AppoimentAdapter($this->conn);
        return $appoiment_adapter->insert_appoiment($appoiment_to_insert);
    }

    public function show_patient_to_select($required)
    {
        if ($required) {
            $is_required = true;
        }
        $appoiment_sevices = new AppoimentServices();
        $user_controller = new UserController($this->conn);
        return $appoiment_sevices->show_patient_to_select($user_controller->get_all_patients(),$is_required??false);
    }

    public function show_patient_selected($required, $id_patient)
    {
        if ($required) {
            $is_required = true;
        }
        $appoiment_sevices = new AppoimentServices();
        $user_controller = new UserController($this->conn);
        return $appoiment_sevices->show_patient_selected($user_controller->get_all_patients(),$is_required??false, $id_patient);
    }

    public function show_psychologist_to_select($required)
    {
        if ($required) {
            $is_required = true;
        }
        $appoiment_sevices = new AppoimentServices();
        $user_controller = new UserController($this->conn);
        return $appoiment_sevices->show_psychologist_to_select($user_controller->get_all_psychologist(),$is_required??false);
    }

    public function config_appoiment($id,$permission)
    {
        if ($permission) {
            $appoiment_sevices = new AppoimentServices();
            $user_controller = new UserController($this->conn);
            return $appoiment_sevices->show_appoiment_config($this->get_appoiment_by_id($this->clear_int($id)),$user_controller->get_all_psychologist());
        } else {
            echo"<script language='javascript' type='text/javascript'>alert('Acesso restrito');window.location.href='home.php';</script>";
        }
    }

    public function get_patient_by_appoiment_id($id)
    {
        $appoiment_adapter = new AppoimentAdapter($this->conn);
        return $appoiment_adapter->get_patient_by_appoiment_id($id);
    }

    public function get_psychologist_by_appoiment_id($id)
    {
        $appoiment_adapter = new AppoimentAdapter($this->conn);
        return $appoiment_adapter->get_psychologist_by_appoiment_id($id);
    }

    public function update_appoiment($id,$appoiment_to_update,$user_profile)
    {
        $appoiment_adapter = new AppoimentAdapter($this->conn);
        $result = $appoiment_adapter->update_appoiment($id,$appoiment_to_update);

        if ($result) {
            if ($user_profile == 2) {
                echo"<script language='javascript' type='text/javascript'>alert('Consulta atualizada com sucesso');window.location.href='home.php?page=appoiment_management';</script>";
            } elseif ($user_profile == 3) {
                echo"<script language='javascript' type='text/javascript'>alert('Consulta atualizada com sucesso');window.location.href='home.php?page=all_appoiments';</script>";
            }
        } else {
            echo"<script language='javascript' type='text/javascript'>alert('Ocorreu um erro ao atualizar a consulta')</script>";
        }
    }

    public function get_notes_by_id($id)
    {
        $appoiment_adapter = new AppoimentAdapter($this->conn);
        return $appoiment_adapter->get_notes_by_id($this->clear_int($id));
    }

    public function show_notes($notes)
    {
        $appoiment_sevices = new AppoimentServices();
        return $appoiment_sevices->show_notes($notes);
    }

    public function update_appoiment_observation($observation,$id)
    {
        $appoiment_adapter = new AppoimentAdapter($this->conn);
        $result = $appoiment_adapter->update_appoiment_observation($observation,$this->clear_int($id));

        if ($result) {
            return true;
        } else {
            return false;
        }
        
    }

    public function get_notes_by_patient($id_patient)
    {
        $appoiment_adapter = new AppoimentAdapter($this->conn);
        $user_controller = new UserController($this->conn);
        
        $appoiment = $appoiment_adapter->get_notes_by_patient($this->clear_int($id_patient));
        foreach ($appoiment as $appoiment)
        {
            if ($user_controller->check_if_user_is_active($appoiment['id_pacient'])) {
                $name_pacient = $user_controller->get_username_by_id($appoiment['id_pacient']);
                $this->show_patient_notes($appoiment,$name_pacient);
            }
        }
    }

    public function show_patient_notes($appoiment,$name_pacient)
    {
        $appoiment_sevices = new AppoimentServices();
        return $appoiment_sevices->show_patient_notes($appoiment,$name_pacient);
    }

    public function get_filtered_appoiments($permission, $filters)
    {
        if ($permission) {
            $options = [];
            if ($filters['id_psychologist'] <> "") {
                $values[] = $filters['id_psychologist'];
                $options[] = "AND id_psychologist = ? ";
            }
            if ($filters['id_pacient'] <> "") {
                $values[] = $filters['id_pacient'];
                $options[] = "AND id_pacient = ? ";
            }
            if ($filters['from'] <> "") {
                $values[] = $filters['from'];
                $options[] = "AND booking_date >= ?";
            }
            if ($filters['to'] <> "") {
                $values[] = $filters['to'];
                $options[] = "AND booking_date <= ?";
            }

            $filter="WHERE TRUE ";
            foreach ($options as $options) {
                $filter = $filter. $options;
            }
            
            $user_controller = new UserController($this->conn);
            $appoiment_adapter = new AppoimentAdapter($this->conn);
            $appoiment_sevices = new AppoimentServices();

            $appoiment = $appoiment_adapter->get_filtered_appoiments($filter,$values??null);
            foreach ($appoiment as $appoiment)
            {
                if ($user_controller->check_if_user_is_active($appoiment['id_psychologist'])) {
                    $name_psychologist = $user_controller->get_username_by_id($appoiment['id_psychologist']);
                    $name_pacient = $user_controller->get_username_by_id($appoiment['id_pacient']);
                    $appoiment_sevices->show_listed_appoiments($appoiment,$name_pacient,$name_psychologist);
                }
            }
        } else {
            echo"<script language='javascript' type='text/javascript'>alert('Acesso restrito');window.location.href='home.php';</script>";
        }
    }

    public function get_filtered_appoiments_from_psychologist($permission,$id_user,$filters)
    {
        if ($permission) {
            $options = [];
            if ($filters['id_pacient'] <> "") {
                $values[] = $filters['id_pacient'];
                $options[] = "AND id_pacient = ? ";
            }
            if ($filters['from'] <> "") {
                $values[] = $filters['from'];
                $options[] = "AND booking_date >= ?";
            }
            if ($filters['to'] <> "") {
                $values[] = $filters['to'];
                $options[] = "AND booking_date <= ?";
            }
            if ($id_user) {
                $values[] = $this->clear_int($id_user);
                $options[] = "AND id_psychologist = ?";
            }

            $filter = "WHERE TRUE ";
            foreach ($options as $options) {
                $filter = $filter. $options;
            }
            
            $user_controller = new UserController($this->conn);
            $appoiment_adapter = new AppoimentAdapter($this->conn);
            $appoiment_sevices = new AppoimentServices();

            $appoiment = $appoiment_adapter->get_filtered_appoiments($filter,$values??null);
            foreach ($appoiment as $appoiment)
            {
                if ($user_controller->check_if_user_is_active($appoiment['id_psychologist'])) {
                    $name_psychologist = $user_controller->get_username_by_id($appoiment['id_psychologist']);
                    $name_pacient = $user_controller->get_username_by_id($appoiment['id_pacient']);
                    $appoiment_sevices->show_listed_appoiments($appoiment,$name_pacient,$name_psychologist);
                }
            }
        } else {
            echo"<script language='javascript' type='text/javascript'>alert('Acesso restrito');window.location.href='home.php';</script>";
        }
    }

    public function get_filtered_appoiments_from_patient($permission,$id_user,$filters)
    {
        if ($permission) {
            $options = [];
            if ($filters['from'] <> "") {
                $values[] = $filters['from'];
                $options[] = "AND booking_date >= ?";
            }
            if ($filters['to'] <> "") {
                $values[] = $filters['to'];
                $options[] = "AND booking_date <= ?";
            }
            if ($id_user) {
                $values[] = $this->clear_int($id_user);
                $options[] = "AND id_pacient = ?";
            }

            $filter="WHERE TRUE ";
            foreach ($options as $options) {
                $filter = $filter. $options;
            }
            
            $user_controller = new UserController($this->conn);
            $appoiment_adapter = new AppoimentAdapter($this->conn);
            $appoiment_sevices = new AppoimentServices();

            $appoiment = $appoiment_adapter->get_filtered_appoiments($filter,$values??null);
            foreach ($appoiment as $appoiment)
            {
                if ($user_controller->check_if_user_is_active($appoiment['id_psychologist'])) {
                    $name_psychologist = $user_controller->get_username_by_id($appoiment['id_psychologist']);
                    $name_pacient = $user_controller->get_username_by_id($appoiment['id_pacient']);
                    $appoiment_sevices->show_listed_appoiments($appoiment,$name_pacient,$name_psychologist);
                }
            }
        } else {
            echo"<script language='javascript' type='text/javascript'>alert('Acesso restrito');window.location.href='home.php';</script>";
        }
    }
}