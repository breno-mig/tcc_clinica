<?php

namespace App\Adapter\Appoiment;

require_once('../src/Controller/Connection/MySqlConnection.php');

class AppoimentAdapter
{
    public function __construct(private $conn)
    {
        $this->conn = $conn;
    }

    public function get_all_appoiments()
    {
        $query = "SELECT * FROM appoiment";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function get_appoiment_by_id($id)
    {
        $query = "SELECT * FROM appoiment WHERE id_appoiment = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id'=>$id]);
        return $stmt->fetchObject();
    }

    public function get_all_appoiments_from_psychologist($id_user)
    {
        $query = "SELECT * FROM appoiment WHERE id_psychologist = :id_user";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id_user'=>$id_user]);
        return $stmt->fetchAll();
    }

    public function get_all_appoiments_from_patient($id_user)
    {
        $query = "SELECT * FROM appoiment WHERE id_pacient = :id_user";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id_user'=>$id_user]);
        return $stmt->fetchAll();
    }

    public function insert_appoiment($appoiment_to_insert)
    {
        $query = "INSERT INTO appoiment
        (booking_date, is_active, id_psychologist, appointment_date, id_pacient, observation) VALUES
        (:booking_date, 1, :id_psychologist, now(), :id_pacient, :observation)";
        $stmt = $this->conn->prepare($query);
        $result = $stmt->execute([
            'booking_date'=>$appoiment_to_insert['booking_date'],
            'id_psychologist'=>$appoiment_to_insert['id_psychologist'],
            'id_pacient'=>$appoiment_to_insert['id_pacient'],
            'observation'=>$appoiment_to_insert['observation']??null
        ]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function update_appoiment($id,$appoiment_to_update)
    {
        $query = "UPDATE appoiment SET booking_date = :booking_date, observation = :observation, is_active = :is_active WHERE id_appoiment = :id_appoiment";
        $stmt = $this->conn->prepare($query);
        $result = $stmt->execute([
            'booking_date'=>$appoiment_to_update['booking_date'],
            'observation'=>$appoiment_to_update['observation'],
            'is_active'=>$appoiment_to_update['is_active'],
            'id_appoiment'=>$id
        ]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function get_patient_by_appoiment_id($id)
    {
        $query = "SELECT id_pacient FROM appoiment WHERE id_appoiment = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id'=>$id]);
        return $stmt->fetchColumn();
    }

    public function get_psychologist_by_appoiment_id($id)
    {
        $query = "SELECT id_psychologist FROM appoiment WHERE id_appoiment = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id'=>$id]);
        return $stmt->fetchColumn();
    }

    public function get_notes_by_id($id)
    {
        $query = "SELECT observation FROM appoiment WHERE id_appoiment = :id_appoiment";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id_appoiment'=>$id]);
        return $stmt->fetchColumn();
    }

    public function update_appoiment_observation($observation,$id)
    {
        $query = "UPDATE appoiment SET observation = :observation WHERE id_appoiment = :id_appoiment";
        $stmt = $this->conn->prepare($query);
        $result = $stmt->execute([
            'observation'=>$observation,
            'id_appoiment'=>$id
        ]);
        if ($result) {
            return true;
        } else {
            return false;
        } 
    }

    public function get_notes_by_patient($id_patient)
    {
        $query = "SELECT * FROM appoiment WHERE id_pacient = :id_patient";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id_patient'=>$id_patient]);
        return $stmt->fetchAll();
    }

    public function get_all_booking_dates()
    {
        $query = "SELECT booking_date FROM appoiment";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function get_filtered_appoiments($filter,$values)
    {
        $query = "SELECT * FROM appoiment $filter";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($values);
        return $stmt->fetchAll();
    }
}