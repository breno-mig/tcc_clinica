<?php

namespace App\Entity\Appoiment;

use DateTimeInterface;
use App\Entity\User\User;

class Appoiment
{
    private int $id_appoiment;
    private DateTimeInterface $booking_date;
    private int $is_active;
    private DateTimeInterface $appoiment_date;
    private string $observation;
    private User $id_patient;
    private User $id_psychologist;

    /**
     * @return User
     */
    public function getIdPatient(): User
    {
        return $this->id_patient;
    }

    /**
     * @param User $id_patient
     * @return Appoiment
     */
    public function setIdPatient(User $id_patient): Appoiment
    {
        $this->id_patient = $id_patient;
        return $this;
    }

    /**
     * @return User
     */
    public function getIdPsychologist(): User
    {
        return $this->id_psychologist;
    }

    /**
     * @param User $id_psychologist
     * @return Appoiment
     */
    public function setIdPsychologist(User $id_psychologist): Appoiment
    {
        $this->id_psychologist = $id_psychologist;
        return $this;
    }


    /**
     * @return int
     */
    public function getIdAppoiment(): int
    {
        return $this->id_appoiment;
    }

    /**
     * @param int $id_appoiment
     * @return Appoiment
     */
    public function setIdAppoiment(int $id_appoiment): Appoiment
    {
        $this->id_appoiment = $id_appoiment;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getBookingDate(): DateTimeInterface
    {
        return $this->booking_date;
    }

    /**
     * @param DateTimeInterface $booking_date
     * @return Appoiment
     */
    public function setBookingDate(DateTimeInterface $booking_date): Appoiment
    {
        $this->booking_date = $booking_date;
        return $this;
    }

    /**
     * @return int
     */
    public function getIsActive(): int
    {
        return $this->is_active;
    }

    /**
     * @param int $is_active
     * @return Appoiment
     */
    public function setIsActive(int $is_active): Appoiment
    {
        $this->is_active = $is_active;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getAppoimentDate(): DateTimeInterface
    {
        return $this->appoiment_date;
    }

    /**
     * @param DateTimeInterface $appoiment_date
     * @return Appoiment
     */
    public function setAppoimentDate(DateTimeInterface $appoiment_date): Appoiment
    {
        $this->appoiment_date = $appoiment_date;
        return $this;
    }

    /**
     * @return string
     */
    public function getObservation(): string
    {
        return $this->observation;
    }

    /**
     * @param string $observation
     * @return Appoiment
     */
    public function setObservation(string $observation): Appoiment
    {
        $this->observation = $observation;
        return $this;
    }

}