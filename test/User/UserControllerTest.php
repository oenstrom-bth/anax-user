<?php

namespace Oenstrom\User;

/**
 * Test class for UserController
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
     * Test userContoller
     *
     */
    public function testUserController()
    {
        $userController = $this->di->get("userController");
        $this->assertInstanceOf("Oenstrom\User\UserController", $userController);
        $this->assertNull($userController->getPostRegister());
        $this->assertNull($userController->getPostLogin());
    }



    /**
     * Test getLogout()
     *
     * @runInSeparateProcess
     */
    public function testGetLogut()
    {
        $userController = $this->di->get("userController");
        $session = $this->di->get("session");
        session_start();
        $session->set("username", "doe");
        $this->assertTrue($session->has("username"));
        $userController->getLogout();
        $this->assertFalse($session->has("username"));
    }



    /**
     * Test getGravatar()
     */
    public function testGetGravatar()
    {
        $userController = new UserController();
        $gravUrl = "https://www.gravatar.com/avatar/2ad47faadafcb0262b9af4407399e686";
        $gravatar = $userController->getGravatar("olof.enstrom@gmail.com");
        $this->assertEquals(
            "https://www.gravatar.com/avatar/2ad47faadafcb0262b9af4407399e686?s=80&d=mm&r=g",
            $gravatar
        );

        $gravatarImg = $userController->getGravatar("olof.enstrom@gmail.com", true);
        $this->assertEquals(
            '<img src="' . $gravUrl . '?s=80&d=mm&r=g" alt="olof.enstrom@gmail.com" />',
            $gravatarImg
        );

        $gravatarAtts = $userController->getGravatar(
            "olof.enstrom@gmail.com",
            true,
            160,
            "mm",
            "g",
            ["title" => "test"]
        );
        $this->assertEquals(
            '<img src="' . $gravUrl . '?s=160&d=mm&r=g" alt="olof.enstrom@gmail.com" title="test" />',
            $gravatarAtts
        );
    }
}
