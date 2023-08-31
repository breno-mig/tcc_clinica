<?php

namespace App\Adapter\User;

require_once('../src/Commun/ValueObject/Password.php');
require_once('../src/Commun/ValueObject/Email.php');
require_once('../src/Commun/ValueObject/Cpf.php');
require_once('../src/UseCase/User/UserUseCase.php');

use App\Commun\ValueObject\Password;
use App\Commun\ValueObject\Email;
use App\Commun\ValueObject\Cpf;
use App\UseCase\User\UserUseCase;

class UserAdapter
{
    public function __construct(private $conn)
    {
        $this->conn = $conn;
    }

    public function get_user($username, $password):int
    {
        $verify = password_verify($password, $this->get_password_by_username($username));
        if ($verify) {
            $query = "SELECT id_user FROM user WHERE username = :username AND is_active = 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute(['username'=>$username]);
            return $stmt->fetchColumn();
        }else{
            echo"
                <script language='javascript' type='text/javascript'>
                    alert('Usuário não encontrado');
                </script>
            ";
            return 0;
        }
    }

    public function get_id_user_from_login($username, $password):int
    {
        $verify = password_verify($password, $this->get_password_by_username($username));
        if ($verify) {
            $query = "SELECT id_user FROM user WHERE username = :username AND is_active = 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute(['username'=>$username]);
            return $stmt->fetchColumn();
        }else{
            echo"
                <script language='javascript' type='text/javascript'>
                    alert('Erro ao encontrar usuário');
                </script>
            ";
            return 0;
        }
    }

    public function get_password_by_username($username):string
    {
        $query = "SELECT password FROM user WHERE username = :username AND is_active = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['username'=>$username]);
        return $stmt->fetchColumn();
    }

    public function get_user_by_id($id):object
    {        
        $query = "SELECT id_user, username, picture, sex, is_active, email, document, birth_date, registration_date, id_profile FROM user WHERE id_user=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id'=>$id]);
        return  $stmt->fetchObject();
    }

    public function get_id_profile_from_user($id):int
    {
        $query = "SELECT id_profile FROM user WHERE id_user = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id'=>$id]);
        return $stmt->fetchColumn();
    }

    public function list_all_users()
    {
        $query = "SELECT id_user, username, picture, sex, is_active, email, document, birth_date, registration_date, id_profile FROM user";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function filter_users($id_profile)
    {
        $query = "SELECT id_user, username, picture, sex, is_active, email, document, birth_date, registration_date, id_profile FROM user WHERE id_profile = :id_profile";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id_profile'=>$id_profile]);
        return $stmt->fetchAll();
    }

    public function list_all_patients()
    {
        $query = "SELECT id_user, username, picture, sex, is_active, email, document, birth_date, registration_date, id_profile FROM user WHERE id_profile = 4";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function insert_user($user_to_insert):bool
    {
        $query = "INSERT INTO user (
            username, password, document, email, sex, picture, is_active, registration_date, id_profile) VALUES (
            :username, :password, :document, :email, :sex, 'default.png', 1, now(), :id_profile);";
        $stmt = $this->conn->prepare($query);
        $result = $stmt->execute([
            'username'=>$user_to_insert['username'],
            'password'=>new Password($user_to_insert['password']),
            'document'=> new Cpf($user_to_insert['document']),
            'email'=> new Email($user_to_insert['email']),
            'sex'=>$user_to_insert['sex'],
            'id_profile'=>$user_to_insert['id_profile']
        ]);
        //id_profile=2&username=teste&sex=m&password=Miggiolaro2019%21%40
        if ($result) {
            return true;
        } else {
            return false;
        }
        
    }

    public function update_user($user_to_update,$id_user)
    {
        $user_use_case = new UserUseCase($this->conn);

        if ($_FILES['picture']['size'] <> 0) {
            $query = "UPDATE user SET
                username = :username, 
                sex = :sex, 
                picture = :picture, 
                email = :email, 
                is_active = :is_active, 
                document = :document, 
                birth_date = :birth_date, 
                id_profile = :id_profile WHERE id_user = :id_user";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute([
                'username'=>$user_to_update['username'],
                'sex'=>$user_to_update['sex'],
                'picture'=>$user_use_case->save_user_picture(),
                'email'=> new Email($user_to_update['email']),
                'is_active'=>$user_to_update['is_active'],
                'document'=> new Cpf($user_to_update['document']),
                'birth_date'=>$user_to_update['birth_date'],
                'id_profile'=>$user_to_update['id_profile'],
                'id_user'=>$id_user
            ]);
        } else {
            $query = "UPDATE user SET
                username = :username, 
                sex = :sex, 
                email = :email, 
                is_active = :is_active, 
                document = :document, 
                birth_date = :birth_date, 
                id_profile = :id_profile WHERE id_user = :id_user";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute([
                'username'=>$user_to_update['username'],
                'sex'=>$user_to_update['sex'],
                'email'=> new Email($user_to_update['email']),
                'is_active'=>$user_to_update['is_active'],
                'document'=> new Cpf($user_to_update['document']),
                'birth_date'=>$user_to_update['birth_date'],
                'id_profile'=>$user_to_update['id_profile'],
                'id_user'=>$id_user
            ]);
        }

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function update_user_with_password($user_to_update,$id_user)
    {
        $user_use_case = new UserUseCase($this->conn);
        
        if ($_FILES['picture']['size'] <> 0) {
            $query = "UPDATE user SET
                username = :username, 
                password = :password, 
                sex = :sex, 
                picture = :picture, 
                email = :email, 
                is_active = :is_active, 
                document = :document, 
                birth_date = :birth_date, 
                id_profile = :id_profile WHERE id_user = :id_user";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute([
                'username'=>$user_to_update['username'],
                'password'=>new Password($user_to_update['password']),
                'sex'=>$user_to_update['sex'],
                'picture'=>$user_use_case->save_user_picture(),
                'email'=> new Email($user_to_update['email']),
                'is_active'=>$user_to_update['is_active'],
                'document'=> new Cpf($user_to_update['document']),
                'birth_date'=>$user_to_update['birth_date'],
                'id_profile'=>$user_to_update['id_profile'],
                'id_user'=>$id_user
            ]);
        }else{
            $query = "UPDATE user SET
                username = :username, 
                password = :password, 
                sex = :sex, 
                email = :email, 
                is_active = :is_active, 
                document = :document, 
                birth_date = :birth_date, 
                id_profile = :id_profile WHERE id_user = :id_user";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute([
                'username'=>$user_to_update['username'],
                'password'=>new Password($user_to_update['password']),
                'sex'=>$user_to_update['sex'],
                'email'=> new Email($user_to_update['email']),
                'is_active'=>$user_to_update['is_active'],
                'document'=> new Cpf($user_to_update['document']),
                'birth_date'=>$user_to_update['birth_date'],
                'id_profile'=>$user_to_update['id_profile'],
                'id_user'=>$id_user
            ]);
        }

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function get_all_patients()
    {
        $query = "SELECT id_user, username, picture, sex, is_active, email, document, birth_date, registration_date, id_profile FROM user WHERE id_profile = 4 AND is_active = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function get_all_psychologist()
    {
        $query = "SELECT id_user, username, picture, sex, is_active, email, document, birth_date, registration_date, id_profile FROM user WHERE id_profile = 2 AND is_active = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function get_username_by_id($id):string
    {
        $query = "SELECT username FROM user WHERE id_user = :id_user";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id_user'=>$id]);
        return $stmt->fetchColumn();
    }

    public function check_if_user_is_active($id)
    {
        $query = "SELECT id_user FROM user WHERE id_user = :id_user AND is_active = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id_user'=>$id]);
        return $stmt->fetchColumn();
    }
}