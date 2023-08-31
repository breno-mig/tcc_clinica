<?php

namespace App\Adapter\Profile;

//require_once('../src/Controller/Connection/MySqlConnection.php');
//use App\Controller\Connection\MySqlConnection;

class ProfileAdapter
{
    public function __construct(private $conn)
    {
        $this->conn = $conn;
    }

    public function get_profile_by_id($id):object
    {
        $query = "SELECT * FROM profile WHERE id_profile=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id'=>$id]);
        return  $stmt->fetchObject();
    }

    public function list_all_profiles()
    {
        $query = "SELECT * FROM profile";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function get_profile_name_by_id($id):string
    {
        $query = "SELECT name FROM profile WHERE id_profile=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id'=>$id]);
        return  $stmt->fetchColumn();
    }

    public function update_profile($profile_to_update,$id):bool
    {
        $permissions_json = json_encode($permissions_array = [
            'access_to_user'=>[
                'edit'=>(bool) $profile_to_update['edit_user'],
                'view'=>(bool) $profile_to_update['view_user'],
                'insert'=>(bool) $profile_to_update['insert_user'],
            ],
            'access_to_notes'=>[
                'edit'=>(bool) $profile_to_update['edit_notes'],
                'view'=>(bool) $profile_to_update['view_notes'],
                'insert'=>(bool) $profile_to_update['insert_notes'],
            ],
            'access_to_patient'=>[
                'edit'=>(bool) $profile_to_update['edit_patient'],
                'view'=>(bool) $profile_to_update['view_patient'],
                'insert'=>(bool) $profile_to_update['insert_patient'],
            ],
            'access_to_appoiment'=>[
                'edit'=>(bool) $profile_to_update['edit_appoiment'],
                'view'=>(bool) $profile_to_update['view_appoiment'],
                'insert'=>(bool) $profile_to_update['insert_appoiment'],
            ]
        ]);
        $query = "UPDATE profile SET
        name = :name,
        is_active = :is_active,
        permissions = :permissions
        WHERE id_profile = :id_profile";
        $stmt = $this->conn->prepare($query);
        $result = $stmt->execute([
            'name'=>$profile_to_update['name'],
            'permissions'=>$permissions_json,
            'is_active'=>$profile_to_update['is_active'],
            'id_profile'=>$id
        ]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function insert_profile($profile_to_insert):bool
    {
        $permissions_json = json_encode($permissions_array = [
            'access_to_user'=>[
                'edit'=>(bool) $profile_to_insert['edit_user'],
                'view'=>(bool) $profile_to_insert['view_user'],
                'insert'=>(bool) $profile_to_insert['insert_user'],
            ],
            'access_to_notes'=>[
                'edit'=>(bool) $profile_to_insert['edit_notes'],
                'view'=>(bool) $profile_to_insert['view_notes'],
                'insert'=>(bool) $profile_to_insert['insert_notes'],
            ],
            'access_to_patient'=>[
                'edit'=>(bool) $profile_to_insert['edit_patient'],
                'view'=>(bool) $profile_to_insert['view_patient'],
                'insert'=>(bool) $profile_to_insert['insert_patient'],
            ],
            'access_to_appoiment'=>[
                'edit'=>(bool) $profile_to_insert['edit_appoiment'],
                'view'=>(bool) $profile_to_insert['view_appoiment'],
                'insert'=>(bool) $profile_to_insert['insert_appoiment'],
            ]
        ]);
        
        $query = "INSERT INTO profile (
            name, permissions
        ) VALUES (
            :name, :permissions
        )";
        $stmt = $this->conn->prepare($query);
        $result = $stmt->execute([
            'name'=>$profile_to_insert['name'],
            'permissions'=>$permissions_json
        ]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}