<?php


class UserController {


    use intHelper;
    use stringHelper;

    public function __construct(private Connection $conn){}

    public function get_login($username, $password)
    {
        $clean_username = $this->clear_string($username);
        $clean_password = $this->clear_string($password);

        $query = "SELECT id_user FROM user WHERE username=:username AND password=:password AND is_active=1;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['username'=>$clean_username, 'password'=>$clean_password]);
        return $stmt->fetchColumn();
    }

    public function get_user_by_id($id)
    {
        $clean_id = $this->clear_int($id);

        $query = "SELECT id_user, username, picture, sex, is_active, email, document, birth_date, id_profile FROM user WHERE id_user=:id;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id'=>$clean_id]);
        $row = $stmt->fechObject();
        $result[] = $this->fill_user($row);
    }

}
