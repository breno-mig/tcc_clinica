<?php

declare(strict_types=1);

namespace App\test\Entity;

use App\Commun\ValueObject\Cpf;
use App\Commun\ValueObject\Email;
use App\Commun\ValueObject\Password;
use App\Entity\User\User;
use DateTime;
use DateTimeZone;
use InvalidArgumentException;
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
        $password = new Password('Aa1!Aa1!');
        $user->setPassword($password);
        $this->assertNull($user->getPassword());
    }

    public function testPasswordExeption()
    {
        $this->expectException(InvalidArgumentException::class);
        $password = new Password('ExDeSenhaFraca123');
    }

    public function testEmail()
    {
        $user = new User();
        $email = new Email('breno@teste.com');
        $user->setEmail($email);
        $this->assertEquals('breno@teste.com',$user->getEmail());
    }

    public function testCpf()
    {
        $user = new User();
        $cpf = new Cpf('012.345.678-90');
        $user->setDocument($cpf);
        $this->assertEquals('01234567890',$user->getDocument());
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
        $date = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
        $today = $date->format('Y-m-d');
        $user->setBirthDate($date);
        $user_date = $user->getBirthDate();
        $formated_date = $user_date->format('Y-m-d');
        $this->assertEquals($today,$formated_date);
    }

    public function testRegistrationDate()
    {
        $user = new User();
        $date = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
        $today = $date->format('Y-m-d');
        $user->setRegistrationDate($date);
        $user_date = $user->getRegistrationDate();
        $formated_date = $user_date->format('Y-m-d');
        $this->assertEquals($today,$formated_date);
    }
    public function testIdProfile()
    {
        $user = new User();
        $user->setIdProfile(1);
        $this->assertEquals(1,$user->getIdProfile());
    }
}