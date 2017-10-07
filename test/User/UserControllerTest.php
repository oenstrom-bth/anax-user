<?php

namespace Oenstrom\User;

/**
 * Test class for User
 */
class UserControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test setup
     */
    protected function setUp()
    {
        $this->di = new \Anax\DI\DIFactoryConfig("MockDi.php");
    }



    /**
     * Test authenticatedOnly()
     *
     */
    public function testUserController()
    {
        $userController = $this->di->get("userController");
        $userController->getPostRegister();
        $userController->getPostLogin();
        $this->assertInstanceOf("Oenstrom\User\UserController", $userController);
    }



    /**
     * Test getGravatar()
     */
    public function testGetGravatar()
    {
        $userController = new UserController();
        $gravatar = $userController->getGravatar("olof.enstrom@gmail.com");
        $this->assertEquals("https://www.gravatar.com/avatar/2ad47faadafcb0262b9af4407399e686?s=80&d=mm&r=g", $gravatar);

        $gravatarImg = $userController->getGravatar("olof.enstrom@gmail.com", true);
        $this->assertEquals('<img src="https://www.gravatar.com/avatar/2ad47faadafcb0262b9af4407399e686?s=80&d=mm&r=g" alt="olof.enstrom@gmail.com" />', $gravatarImg);

        $gravatarAtts = $userController->getGravatar("olof.enstrom@gmail.com", true, 160, "mm", "g", ["title" => "test"]);
        $this->assertEquals('<img src="https://www.gravatar.com/avatar/2ad47faadafcb0262b9af4407399e686?s=160&d=mm&r=g" alt="olof.enstrom@gmail.com" title="test" />', $gravatarAtts);
    }
}
