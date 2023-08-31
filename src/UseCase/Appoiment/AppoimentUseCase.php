<?php

namespace App\UseCase\Appoiment;

require_once("../src/Entity/Appoiment/Appoiment.php");

use App\Entity\Appoiment\Appoiment;
use DateTime;

// implements AppoimentInterface
class AppoimentUseCase
{
    private AppoimentInterface $repository;

    public function __construct(private $conn)
    {
        $this->conn = $conn;
    }

    public function fill_appoiment($appoiment_to_fill,$patient, $psychologist):object
    {
        $appoiment = new Appoiment();

        $appoiment->setIdAppoiment($appoiment_to_fill->id_appoiment)
                  ->setBookingDate(new DateTime($appoiment_to_fill->booking_date))
                  ->setIsActive($appoiment_to_fill->is_active)
                  ->setAppoimentDate(new DateTime($appoiment_to_fill->appointment_date))
                  ->setObservation($appoiment_to_fill->observation??"")
                  ->setIdPsychologist($psychologist)
                  ->setIdPatient($patient)
        ;

        return $appoiment;
    }
}