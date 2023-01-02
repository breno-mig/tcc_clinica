<?php
class Appoiment{
    private $id_appoiment;
    private $date;
    private $fk_id_pacients;
    private $fk_id_psychologist;

    /**
     * Get the value of id_appoiment
     */ 
    public function getId_appoiment()
    {
        return $this->id_appoiment;
    }

    /**
     * Set the value of id_appoiment
     *
     * @return  self
     */ 
    public function setId_appoiment($id_appoiment)
    {
        $this->id_appoiment = $id_appoiment;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of fk_id_pacients
     */ 
    public function getFk_id_pacients()
    {
        return $this->fk_id_pacients;
    }

    /**
     * Set the value of fk_id_pacients
     *
     * @return  self
     */ 
    public function setFk_id_pacients($fk_id_pacients)
    {
        $this->fk_id_pacients = $fk_id_pacients;

        return $this;
    }

    /**
     * Get the value of fk_id_psychologist
     */ 
    public function getFk_id_psychologist()
    {
        return $this->fk_id_psychologist;
    }

    /**
     * Set the value of fk_id_psychologist
     *
     * @return  self
     */ 
    public function setFk_id_psychologist($fk_id_psychologist)
    {
        $this->fk_id_psychologist = $fk_id_psychologist;

        return $this;
    }
}