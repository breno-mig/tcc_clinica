<?php
require_once("conn.php");

class Users_controller{

    private $conn;
    public function __construct($conn){

        $this->conn = $conn;
    }

    public function check_login($username, $password){
        $query = "SELECT id_user FROM users WHERE username=:username AND password=:password;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['username'=>$username, 'password'=>$password]);
        $row = $stmt->fetchColumn();
        return $row;
    }

    public function pick_register($id){
        $id = preg_replace('/[^[:alnum:]_]/', '',$id);
        $query = "SELECT * FROM users WHERE id_user=:id;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id'=>$id]);
        $result = [];
        $row = $stmt->fetchObject();
        $result[] = $this->fill_user($row);
        return $result;
    }

    public function fill_user($result){
        $user = new Users();
        $user->setId_user($result->id_user)
             ->setUsername($result->username)
             ->setPassword($result->password)
             ->setTitle($result->title)
             ->setPicture($result->picture)
             ->setSex($result->sex);
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
        $query = "INSERT INTO users (username, password, title, sex) VALUES (:username, :password, :title, :sex);";
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
                        <form id="user_management" action="home.php" method="get">
                                <input type="submit" class="item" value="Usuarios">
                                <input type="hidden" name="page" value="user_management">
                        </form>
                    </li>
                    <li>
                        <form id="config" action="home.php" method="get">
                                <input type="submit" class="item" value="Configurações">
                                <input type="hidden" name="page" value="config-administrator">
                        </form>
                    </li>
                ';
                break;
                case 'psi':
                    $options ='
                        <li>
                            <form id="pacient_management" action="home.php" method="get">
                                    <input type="submit" class="item" value="Pacientes">
                                    <input type="hidden" name="page" value="pacient_management">
                            </form>
                        </li>
                        <li>
                            <form id="calendar" action="home.php" method="get">
                                    <input type="submit" class="item" value="Calendario">
                                    <input type="hidden" name="page" value="calendar">
                            </form>
                        </li>
                        <li>
                            <form id="config" action="home.php" method="get">
                                    <input type="submit" class="item" value="Configurações">
                                    <input type="hidden" name="page" value="config-psychologist">
                            </form>
                        </li>
                    ';
                break;
                case 'secre':
                    $options ='
                        <li>
                            <form id="pacient_management" action="home.php" method="get">
                                    <input type="submit" class="item" value="Pacientes">
                                    <input type="hidden" name="page" value="pacient_management">
                            </form>
                        </li>
                        <li>
                            <form id="calendar" action="home.php" method="get">
                                    <input type="submit" class="item" value="Calendario">
                                    <input type="hidden" name="page" value="calendar">
                            </form>
                        </li>
                        <li>
                            <form id="config" action="home.php" method="get">
                                    <input type="submit" class="item" value="Configurações">
                                    <input type="hidden" name="page" value="config-secretary">
                            </form>
                        </li>
                    ';
                break;
                case 'paci':
                    $options ='
                        <li>
                            <form id="calendar" action="home.php" method="get">
                                    <input type="submit" class="item" value="Calendario">
                                    <input type="hidden" name="page" value="calendar">
                            </form>
                        </li>
                        <li>
                            <form id="config" action="home.php" method="get">
                                    <input type="submit" class="item" value="Configurações">
                                    <input type="hidden" name="page" value="config-pacient">
                            </form>
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
            foreach ($users as $users) {
                switch ($users["title"]) {
                    case 'adm':
                        $style = "listed-administrator";
                        if ($users["sex"] == "m") {
                            $title_ = "Administrador";
                        } else {
                            $title_ = "Administradora";
                        }
                        $config_page = "config-administrator";
                        break;
                    case 'psi':
                        $style = "listed-psychologist";
                        if ($users["sex"] == "m") {
                            $title_ = "Psicologo";
                        } else {
                            $title_ = "Psicologa";
                        }
                        $config_page = "config-psychologist";
                        break;
                    case 'secre':
                        $style = "listed-secretary";
                        if ($users["sex"] == "m") {
                            $title_ = "Secretario";
                        } else {
                            $title_ = "Secretaria";
                        }
                        $config_page = "config-secretary";
                        break;
                    case 'paci':
                        $style = "listed-pacient";
                        $title_ = "Paciente";
                        $config_page = "config-pacient";
                        break;
                }
                echo'
                    <li class="listed-user">
                        <form action="home.php?page='.$config_page.'&id_user='.$users["id_user"].'" method="POST">
                            <div class="listed-user_div">
                                <span>'.$users["id_user"].' - 
                                <span>'.$users["username"].'
                                <span class="'.$style.'">'.$title_.'</span></span></span>
                                <input type="submit" value="Editar" name="edit" class="btn-alteracao">
                            </div>
                        </form>
                    </li>
                ';
            }#<input type="hidden" name="profile-picture" value="'.$users["picture"].'">
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
        if ($user_title == 'adm') {   
            $query = "SELECT * FROM users WHERE title=:filtered_title";
            $stmt = $this->conn->prepare($query);
            $stmt->execute(['filtered_title'=>$filtered_title]);
            $users = $stmt->fetchAll();
            foreach ($users as $users) {
                switch ($users["title"]) {
                    case 'adm':
                        $style = "listed-administrator";
                        if ($users["sex"] == "m") {
                            $title_ = "Administrador";
                        } else {
                            $title_ = "Administradora";
                        }
                        $config_page = "config-administrator";
                        break;
                    case 'psi':
                        $style = "listed-psychologist";
                        if ($users["sex"] == "m") {
                            $title_ = "Psicologo";
                        } else {
                            $title_ = "Psicologa";
                        }
                        $config_page = "config-psychologist";
                        break;
                    case 'secre':
                        $style = "listed-secretary";
                        if ($users["sex"] == "m") {
                            $title_ = "Secretario";
                        } else {
                            $title_ = "Secretaria";
                        }
                        $config_page = "config-secretary";
                        break;
                    case 'paci':
                        $style = "listed-pacient";
                        $title_ = "Paciente";
                        $config_page = "config-pacient";
                        break;
                }
                echo'
                    <li class="listed-user">
                        <form action="home.php?page='.$config_page.'&id_user='.$users["id_user"].'" method="POST">
                            <div class="listed-user_div">
                                <span>'.$users["id_user"].' - 
                                <span>'.$users["username"].'
                                <span class="'.$style.'">'.$title_.'</span></span></span>
                                <input type="submit" value="Editar" name="edit" class="btn-alteracao">
                            </div>
                        </form>
                    </li>
                ';
            }#<input type="hidden" name="profile-picture" value="'.$users["picture"].'">
        }else{
            echo"
                <script language='javascript' type='text/javascript'>
                    alert('Acesso restrito');
                    window.location.href='home.php';
                </script>
            ";
        }
    }
}