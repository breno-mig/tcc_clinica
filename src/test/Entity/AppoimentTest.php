<?php

namespace App\test\Entity;

use App\Entity\Appoiment\Appoiment;
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
        $appoiment->setBookingDate(date("Y-m-d H:i:s"));
        $this->assertEquals(date("Y-m-d H:i:s"),$appoiment->getBookingDate());
    }

    public function testAppoimentDate()
    {
        $appoiment = new Appoiment();
        $appoiment->setAppoimentDate(date("Y-m-d H:i:s"));
        $this->assertEquals(date("Y-m-d H:i:s"),$appoiment->getAppoimentDate());
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
        $appoiment->setIdPsychologist(1);
        $this->assertEquals(1,$appoiment->getIdPsychologist());
    }
}
