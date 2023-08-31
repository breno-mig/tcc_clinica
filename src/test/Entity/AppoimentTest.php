<?php

namespace App\test\Entity;

use App\Entity\Appoiment\Appoiment;
use DateTime;
use DateTimeZone;
use PHPUnit\Framework\TestCase;

class AppoimentTest extends TestCase
{
    public function testIdAppoiment()
    {
        $appoiment = new Appoiment();
        $appoiment->setIdAppoiment(1);
        $this->assertEquals(1,$appoiment->getIdAppoiment());
    }

    public function testBookingDate()
    {
        $appoiment = new Appoiment();

        $date = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
        $today = $date->format('Y-m-d');
        $appoiment->setBookingDate($date);
        $user_date = $appoiment->getBookingDate();
        $formated_date = $user_date->format('Y-m-d');
        $this->assertEquals($today,$formated_date);
    }

    public function testAppoimentDate()
    {
        $appoiment = new Appoiment();

        $date = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
        $today = $date->format('Y-m-d');
        $appoiment->setAppoimentDate($date);
        $user_date = $appoiment->getAppoimentDate();
        $formated_date = $user_date->format('Y-m-d');
        $this->assertEquals($today,$formated_date);
    }

    public function testIsActive()
    {
        $appoiment = new Appoiment();
        $appoiment->setIsActive(1);
        $this->assertEquals(1,$appoiment->getIsActive());
    }

    public function testObservation()
    {
        $appoiment = new Appoiment();
        $appoiment->setObservation('teste');
        $this->assertEquals('teste',$appoiment->getObservation());
    }

    public function testIdPatient()
    {
        $appoiment = new Appoiment();
        $appoiment->setIdPatient(1);
        $this->assertEquals(1,$appoiment->getIdPatient());
    }

    public function testIdPsychologist()
    {
        $appoiment = new Appoiment();
        $appoiment->setIdPsychologist(2);
        $this->assertEquals(2,$appoiment->getIdPsychologist());
    }
}
