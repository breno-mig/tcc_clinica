<?php

namespace App\test\Controller\User;

use App\Controller\User\UserController;
use PHPUnit\Framework\TestCase;

class UserControllerTest extends TestCase
{
    public function testSelect():void
    {
        $userController = new UserControllerTest();
        $this->assertInstanceOf(
            $userController->check_login('Breno','$2y$10$gSoHjs3mf1BZdukYxuMaNu9.fAOivQPbEWkUMyu1x4ag3OtMIMXTi')
        );
    }
}
