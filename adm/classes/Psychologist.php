<?php
class Psychologist{
    private $id_psychologist;
    private $fk_id_user;
    private $email;
    private $crp;
    private $abord;

    /**
     * Get the value of id_psychologist
     */ 
    public function getId_psychologist()
    {
        return $this->id_psychologist;
    }

    /**
     * Set the value of id_psychologist
     *
     * @return  self
     */ 
    public function setId_psychologist($id_psychologist)
    {
        $this->id_psychologist = $id_psychologist;

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
     * Get the value of crp
     */ 
    public function getCrp()
    {
        return $this->crp;
    }

    /**
     * Set the value of crp
     *
     * @return  self
     */ 
    public function setCrp($crp)
    {
        $this->crp = $crp;

        return $this;
    }

    /**
     * Get the value of abord
     */ 
    public function getAbord()
    {
        return $this->abord;
    }

    /**
     * Set the value of abord
     *
     * @return  self
     */ 
    public function setAbord($abord)
    {
        $this->abord = $abord;

        return $this;
    }
}