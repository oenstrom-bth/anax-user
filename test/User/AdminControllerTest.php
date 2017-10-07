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
        $adminController->getUsers();
        $adminController->getPostNewUser();
        $adminController->getPostEditUser(1);
        $adminController->getDeleteUser(2);
        $this->assertInstanceOf("Oenstrom\User\AdminController", $adminController);
    }
}
