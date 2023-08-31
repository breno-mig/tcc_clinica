<?php

namespace App\test\Entity;

use App\Entity\Profile\Profile;
use PHPUnit\Framework\TestCase;

class ProfileTest extends TestCase
{
    public function testIdProfile()
    {
        $profile = new Profile();
        $profile->setIdProfile(1);
        $this->assertEquals(1,$profile->getIdProfile());
    }

    public function testPermissions()
    {
        $json = '
        {
            "access_to_note": {
                "edit": false,
                "view": false,
                "insert": false
            },
            "access_to_user": {
                "edit": true,
                "view": true,
                "insert": true
            },
            "access_to_appoiment": {
                "edit": false,
                "view": false,
                "insert": false
            }
        }
        ';
        $array = json_decode($json,true);
        $profile = new Profile();
        $profile->setPermissions($array);
        $this->assertEquals($array,$profile->getPermissions());
    }

    public function testExtra()
    {
        $json = '
        {
            "access_to_note": {
                "edit": false,
                "view": false,
                "insert": false
            },
            "access_to_user": {
                "edit": true,
                "view": true,
                "insert": true
            },
            "access_to_appoiment": {
                "edit": false,
                "view": false,
                "insert": false
            }
        }
        ';
        $array = json_decode($json,true);
        $profile = new Profile();
        $profile->setExtra($array);
        $this->assertEquals($array,$profile->getExtra());
    }

    public function testName()
    {
        $profile = new Profile();
        $profile->setName('adm');
        $this->assertEquals('adm',$profile->getName());
    }

    public function testIsActive()
    {
        $profile = new Profile();
        $profile->setIsActive(1);
        $this->assertEquals(1,$profile->getIsActive());
    }
}
