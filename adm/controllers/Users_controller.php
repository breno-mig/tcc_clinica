<?php
require_once("conn.php");

class Users_controller{

    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function clear_string($string)
    {
        $clean_string = preg_replace('/[^[:alnum:] a-zÀ-ú]/', '', $string);
        return $clean_string;
    }

    public function clear_int($int)
    {
        $clean_int = preg_replace('/[[0-9]]/', '', $int);
        return $clean_int;
    }

    public function check_login($username, $password)
    {
        $clean_username = $this->clear_string($username);
        $clean_password = $this->clear_string($password);
        $query = "SELECT id_user FROM users WHERE username=:username AND password=:password AND is_active=1;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['username'=>$clean_username, 'password'=>$clean_password]);
        return $stmt->fetchColumn();
    }

    /*
    php password length

    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
    }else{
        echo 'Strong password.';
    }
    */
    public function pick_register($id)
    {
        $clean_id = $this->clear_int($id);
        #$query = "SELECT id_user, username, title FROM users WHERE username=:username AND password=sha1(:password) AND is_active=1;";
        #"SELECT id_user, username, title, picture, sex, is_active, profiles.title->>'f' as profile_title FROM users WHERE username=:username AND password=:password AND is_active=1;"
        $query = "SELECT id_user, username, title, picture, sex, is_active FROM users WHERE id_user=:id;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id'=>$clean_id]);
        $result = [];
        $row = $stmt->fetchObject();
        $result[] = $this->fill_user($row);
        return $result;
    }

    public function fill_user($result){
        $user = new Users();
        $user->setId_user($result->id_user)
             ->setUsername($result->username)
             ->setTitle($result->title)
             ->setPicture($result->picture)
             ->setSex($result->sex)
             ->setIs_active($result->is_active);
        return $user;
    }

    public function set_user_session($id){
        $current_user = $this->pick_register($id);
        foreach ($current_user as $user) {
            $id_user = $user->getId_user();
            $username = $user->getUsername();
            $title = $user->getTitle();
            $picture = $user->getPicture();
            $sex = $user->getSex();

            $_SESSION["id_user"] = $id_user;
            $_SESSION["username"] = $username;
            $_SESSION["title"] = $title;
            $_SESSION["picture"] = $picture;
            $_SESSION["sex"] = $sex;

            return $_SESSION;
        }
    }

    public function insert_user($new_user){
        $query = "INSERT INTO users (username, password, title, sex, is_active) VALUES (:username, :password, :title, :sex, 1);";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            'username'=>$new_user['username'],
            'password'=>MD5($new_user['password']),
            'title'=>$new_user['title'],
            'sex'=>$new_user['sex']
        ]);
        $id_user = $this->conn->lastInsertId();
        if ($stmt) {
            $insert_user = true;
        }
        switch ($new_user['title']) {
            case 'adm':
                $query = "INSERT INTO administrator (fk_id_user) VALUES (:id_user);";
                $stmt = $this->conn->prepare($query);
                $stmt->execute(['id_user'=>$id_user]);
                if ($stmt) {
                    $insert_title = true;
                }
            break;
            case 'psi':
                $query = "INSERT INTO psychologist (fk_id_user) VALUES (:id_user);";
                $stmt = $this->conn->prepare($query);
                $stmt->execute(['id_user'=>$id_user]);
                if ($stmt) {
                    $insert_title = true;
                }
            break;
            case 'secre':
                $query = "INSERT INTO secretary (fk_id_user) VALUES (:id_user);";
                $stmt = $this->conn->prepare($query);
                $stmt->execute(['id_user'=>$id_user]);
                if ($stmt) {
                    $insert_title = true;
                }
            break;
            case 'paci':
                $query = "INSERT INTO pacients (fk_id_user) VALUES (:id_user);";
                $stmt = $this->conn->prepare($query);
                $stmt->execute(['id_user'=>$id_user]);
                if ($stmt) {
                    $insert_title = true;
                }
            break;
        }
        if ($insert_title == true && $insert_user == true) {
            return true;
        }
    }

    public function get_options($title){
        switch ($title) {
            case 'adm':
                $options = '
                    <li>
                        <button type="submit" name="page" class="item" form="page" value="user_management">Usuarios</button>
                    </li>
                    <li>
                        <button type="submit" name="page" class="item" form="page" value="config-administrator">Configurações</button>
                    </li>
                ';
            break;
            case 'psi':
                $options ='
                    <li>
                        <button type="submit" name="page" class="item" form="page" value="pacient_management">Pacientes</button>
                    </li>
                    <li>
                        <button type="submit" name="page" class="item" form="page" value="calendar">Agenda</button>
                    </li>
                    <li>
                        <button type="submit" name="page" class="item" form="page" value="config-psychologist">Configurações</button>
                    </li>
                ';
            break;
            case 'secre':
                $options ='
                    <li>
                        <button type="submit" name="page" class="item" form="page" value="pacient_management">Pacientes</button>
                    </li>
                    <li>
                        <button type="submit" name="page" class="item" form="page" value="calendar">Agenda</button>
                    </li>
                    <li>
                        <button type="submit" name="page" class="item" form="page" value="config-secretary">Configurações</button>
                    </li>
                ';
            break;
            case 'paci':
                $options ='
                    <li>
                        <button type="submit" name="page" class="item" form="page" value="calendar">Agendas</button>
                    </li>
                    <li>
                        <button type="submit" name="page" class="item" form="page" value="config-pacient">Configurações</button>
                    </li>
                ';
            break;
        }
        return $options;
    }

    public function list_all_users($title){
        if ($title == 'adm') {   
            $query = "SELECT * FROM users";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $users = $stmt->fetchAll();
            $result = $this->show_listed_users($users);
        }else{
            echo"
                <script language='javascript' type='text/javascript'>
                    alert('Acesso restrito');
                    window.location.href='home.php';
                </script>
            ";
        }
    }

    public function filter_users($user_title, $filtered_title){
        $clean_filtered_title = preg_replace('/[^[:alnum:] a-zÀ-ú]/', '', $filtered_title);
        if ($user_title == 'adm' || $user_title == 'psi') {   
            $query = "SELECT * FROM users WHERE title=:filtered_title";
            $stmt = $this->conn->prepare($query);
            $stmt->execute(['filtered_title'=>$clean_filtered_title]);
            $users = $stmt->fetchAll();
            $result = $this->show_listed_users($users);
        }else{
            echo"
                <script language='javascript' type='text/javascript'>
                    alert('Acesso restrito');
                    window.location.href='home.php';
                </script>
            ";
        }
    }

    public function show_listed_users($users){
        foreach ($users as $users) {
            if ($users['is_active'] == 0) {
                $is_deactivated = "deactivated-user";
            }else{
                $is_deactivated ="";
            }
            switch ($users["title"]) {
                case 'adm':
                    $style = "listed-administrator";
                    if ($users["sex"] == "m") {
                        $title_ = "Administrador";
                    } else {
                        $title_ = "Administradora";
                    }
                    $config_page = "config-administrator&id_user=".$users["id_user"];
                break;
                case 'psi':
                    $style = "listed-psychologist";
                    if ($users["sex"] == "m") {
                        $title_ = "Psicologo";
                    } else {
                        $title_ = "Psicologa";
                    }
                    $config_page = "config-psychologist&id_user=".$users["id_user"];
                break;
                case 'secre':
                    $style = "listed-secretary";
                    if ($users["sex"] == "m") {
                        $title_ = "Secretario";
                    } else {
                        $title_ = "Secretaria";
                    }
                    $config_page = "config-secretary&id_user=".$users["id_user"];
                break;
                case 'paci':
                    $style = "listed-pacient";
                    $title_ = "Paciente";
                    $config_page = "config-pacient&id_user=".$users["id_user"];
                break;
            }
            echo'
                <li class="listed-user '.$is_deactivated.'">
                    <form id="users_actions" action="home.php" method="GET" enctype="text/plain">
                    <div class="listed-user_div">
                        <span>'.$users["id_user"].' - 
                        <span>'.$users["username"].'
                        <span class="'.$style.'">'.$title_.'</span></span></span>
            ';
            
            if ($_SESSION['title'] == "psi" || $_SESSION['title'] == "secre") {
                echo'
                    <input class="btn-alteracao" name="page" type="submit" value="Anotações">
                ';
            }

            echo'
                        <input class="btn-alteracao" name="page" type="submit" value="Editar">
                    </div>
                    </form>
                </li>
            ';
            /*
                <button type="submit" class="btn-alteracao" form="users_actions" name="page" value="'.$config_page.'">Editar</button>
                <button type="submit" name="page" class="btn-delete" form="users_actions" value="delete-user='.$users["id_user"].'" style="float:right;margin-right:5px;">Excluir</button>
            */
        }
    }
}