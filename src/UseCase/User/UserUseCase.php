<?php

namespace App\UseCase\User;

//implements UserInterface
use App\Entity\User\User;
use App\Entity\Profile\Profile;
use App\Connection\MySqlConnection;
use App\Commun\ValueObject\Email;
use App\Commun\ValueObject\Cpf;
use DateTime;
// passar metodos da camada Repository para a Adapter

require_once('../src/Entity/User/User.php');
require_once('../src/Entity/Profile/Profile.php');
require_once("../src/Commun/ValueObject/Email.php");
require_once("../src/Commun/ValueObject/Cpf.php");

class UserUseCase
{

    public function __construct(private $conn)
    {
        $this->conn = $conn;
    }

    public function fill_user($user_to_fill, $profile):object
    {
        //, $profile
        $user = new User($profile);
        //$profile = new Profile();

        $user->setIdUser($user_to_fill->id_user)
            ->setUsername($user_to_fill->username)
            ->setSex($user_to_fill->sex)
            ->setPicture($user_to_fill->picture)
            ->setEmail(new Email($user_to_fill->email))
            ->setIsActive($user_to_fill->is_active)
            ->setDocument(new Cpf($user_to_fill->document))
            ->setBirthDate(new DateTime($user_to_fill->birth_date??date("Y-m-d", mktime(0, 0, 0, 1, 1, 2000))))
            ->setRegistrationDate(new DateTime($user_to_fill->registration_date))
            ->setProfile($profile)
        ;
        return $user;
    }

    public function set_user_session($user)
    {
        $_SESSION["id_user"] = $user->getIdUser();
        $_SESSION["username"] = $user->getUsername();
        $_SESSION["profile"] = (array) $user->getProfile();
        $_SESSION["picture"] = $user->getPicture();
        $_SESSION["sex"] = $user->getSex();
        return $_SESSION;
    }

    public function save_user_picture():string
    {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["picture"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        if(isset($_POST["edit"])) {
            $check = getimagesize($_FILES["picture"]["tmp_name"]);
            if($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "O arquivo não é uma imagem.";
                $uploadOk = 0;
            }
        }
        
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "Apenas são permitidos arquivos do tipo: JPG, JPEG, PNG e GIF.";
            $uploadOk = 0;
        }
        
        if ($uploadOk == 0) {
            echo "Houve um problema ao salvar o arquivo.";
        } else {
            if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
                return $_FILES["picture"]["name"];
            }
        }
    }

}