<?php

class Pacients{
    private $id_pacients;
    private $fk_id_user;
    private $email;
    private $cpf;

    /**
     * Get the value of id_pacients
     */ 
    public function getId_pacients()
    {
        return $this->id_pacients;
    }

    /**
     * Set the value of id_pacients
     *
     * @return  self
     */ 
    public function setId_pacients($id_pacients)
    {
        $this->id_pacients = $id_pacients;

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

    /**
     * Get the value of cpf
     */ 
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set the value of cpf
     *
     * @return  self
     */ 
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }
}