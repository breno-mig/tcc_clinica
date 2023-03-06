<?php

declare(strict_types=1);

namespace App\test\Entity;

use App\Controller\User\UserController;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    public function testSelect():void
    {
        $userController = new UserController();
        $this->assertInstanceOf(
            $userController->check_login('Breno','$2y$10$gSoHjs3mf1BZdukYxuMaNu9.fAOivQPbEWkUMyu1x4ag3OtMIMXTi')
        );
    }
}