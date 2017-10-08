<?php

namespace Oenstrom\User;

/**
 * Test class for User
 */
class AdminControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test setup
     */
    protected function setUp()
    {
        $this->di = new \Anax\DI\DIFactoryConfig("MockDi.php");
    }



    public function testAdminController()
    {
        $adminController = $this->di->get("adminController");
        $this->assertInstanceOf("Oenstrom\User\AdminController", $adminController);
        $this->assertNull($adminController->getUsers());
        $this->assertNull($adminController->getPostNewUser());
        $this->assertNull($adminController->getPostEditUser(1));
        $this->assertNull($adminController->getDeleteUser(2));
    }
}
