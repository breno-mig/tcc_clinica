<?php

class Secretary{
    private $id_secretary;
    private $fk_id_user;
    private $email;

    /**
     * Get the value of id_secretary
     */ 
    public function getId_secretary()
    {
        return $this->id_secretary;
    }

    /**
     * Set the value of id_secretary
     *
     * @return  self
     */ 
    public function setId_secretary($id_secretary)
    {
        $this->id_secretary = $id_secretary;

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