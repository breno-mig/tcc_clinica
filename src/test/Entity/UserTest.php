<?php

declare(strict_types=1);

namespace App\test\Entity;

use App\Entity\User\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    public function testUsername():void
    {
        $user = new User();
        $user->setUsername('Breno');
        $this->assertEquals('Breno',$user->getUsername());
    }

    public function testPassword()
    {
        $user = new User();
        $user->setPassword('Aa1!Aa1!');
        $this->assertEquals('',$user->getPassword());
    }

    public function testEmail()
    {
        $user = new User();
        $user->setEmail('breno@teste.com');
        $this->assertEquals('breno@teste.com',$user->getEmail());
    }

    public function testCpf()
    {
        $user = new User();
        $user->setDocument('479.131.958-35');
        $this->assertEquals('47913195835',$user->getDocument());
    }

    public function testSex()
    {
        $user = new User();
        $user->setSex('m');
        $this->assertEquals('m',$user->getSex());
    }

    public function testPicture()
    {
        $user = new User();
        $user->setPicture('foto_perfil.png');
        $this->assertEquals('foto_perfil.png',$user->getPicture());
    }

    public function testIsActive()
    {
        $user = new User();
        $user->setIsActive(1);
        $this->assertEquals(1,$user->getIsActive());
    }

    public function testBirthDate()
    {
        $user = new User();
        $user->setBirthDate(date("Y-m-d H:i:s"));
        $this->assertEquals(date("Y-m-d H:i:s"),$user->getBirthDate());
    }

    public function testRegistrationDate()
    {
        $user = new User();
        $user->setRegistrationDate(date());
        $this->assertEquals(date(),$user->getRegistrationDate());
    }
    public function testIdProfile()
    {
        $user = new User();
        $user->setIdProfile(1);
        $this->assertEquals(1,$user->getIdProfile());
    }
}