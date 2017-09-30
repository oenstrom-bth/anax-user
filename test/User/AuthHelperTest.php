<?php

namespace Oenstrom\User;

/**
 * Test class for User
 */
class AuthHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test setup
     */
    protected function setUp()
    {
        $conf = include "MockDiConfig.php";
        $this->di = new \Anax\DI\DIFactoryConfig($conf);
    }



    /**
     * Test getLoggedInUser()
     */
    public function testGetLoggedInUser()
    {
        $auth = new AuthHelper();
        $auth->setDi($this->di);
        $this->assertFalse($auth->getLoggedInUser());

        $session = $this->di->get("session");
        $session->set("username", "test");
        $this->assertInstanceOf("Oenstrom\User\User", $auth->getLoggedInUser());
    }



    /**
     * Test isLoggedIn()
     */
    public function testIsLoggedIn()
    {
        $auth = new AuthHelper();
        $auth->setDi($this->di);
        $this->assertFalse($auth->isLoggedIn());

        $session = $this->di->get("session");
        $session->set("username", "test");
        $this->assertTrue($auth->isLoggedIn());
    }



    /**
     * Test isAdmin()
     */
    public function testIsAdmin()
    {
        $auth = new AuthHelper();
        $auth->setDi($this->di);
        $session = $this->di->get("session");
        $session->set("username", "test");
        $this->assertTrue($auth->isAdmin());

        $session->set("username", "test2");
        $this->assertFalse($auth->isAdmin());
    }
}
