<?php
class Administrator{
    private $id_administrator;
    private $fk_id_user;
    private $email;

    /**
     * Get the value of id_administrator
     */ 
    public function getId_administrator()
    {
        return $this->id_administrator;
    }

    /**
     * Set the value of id_administrator
     *
     * @return  self
     */ 
    public function setId_administrator($id_administrator)
    {
        $this->id_administrator = $id_administrator;

        return $this;
    }

    /**
     * Get the value of fk_id_user
     */ 
    public function getFk_id_user()
    {
        return $this->fk_id_user;
    }

    /**
     * Set the value of fk_id_user
     *
     * @return  self
     */ 
    public function setFk_id_user($fk_id_user)
    {
        $this->fk_id_user = $fk_id_user;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
}