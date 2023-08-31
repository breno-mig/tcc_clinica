<?php

namespace App\UseCase\Profile;

use App\Entity\Profile\Profile;
//use App\Controller\Connection\MySqlConnection;
//use App\UseCase\Profile\ProfileUseCaseInterface;

//require_once '../../Controller/Connection/MySqlConnection.php';
//implements ProfileUseCaseInterface
class ProfileUseCase
{
    
    public function __construct(private $conn)
    {
        $this->conn = $conn;
    }
    

    public function fill_profile($profile_to_fill):object
    {
        $profile = new Profile();

        $profile->setIdProfile($profile_to_fill->id_profile)
                ->setName($profile_to_fill->name)
                ->setPermissions(json_decode($profile_to_fill->permissions, true))
                ->setIsActive($profile_to_fill->is_active)
        ;
/*
        $permissions = $profile->getPermissions();
        var_dump($permissions);
        if ($permissions ["access_to_user"] ["edit"] == true) {
            echo 'ola';
            echo '<br>';
        }*/
        return $profile;
    }

    public function get_permissions_by_id($id_profile):array
    {
        
    }

    public function select_all()
    {
        $query = "SELECT * FROM profile";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchObject();
        return $this->fill_profile($row);

    }
}