<?php

namespace Oenstrom\User;

/**
 * Test class for AuthHelper
 */
class AuthHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test setup
     */
    protected function setUp()
    {
        $this->di = new \Anax\DI\DIFactoryConfig("MockDi.php");
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
        $session->set("username", "doe");
        $this->assertInstanceOf("Oenstrom\User\User", $auth->getLoggedInUser());
    }



    /**
     * Test isLoggedIn()
     */
    public function testIsLoggedIn()
    {
        $auth = new AuthHelper();
        $auth->setDi($this->di);
        $session = $this->di->get("session");

        $session->delete("username");
        $this->assertFalse($auth->isLoggedIn());

        $session->set("username", "doe");
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
        $session->set("username", "admin");
        $this->assertTrue($auth->isAdmin());

        $session->set("username", "doe");
        $this->assertFalse($auth->isAdmin());

        $session->set("username", "awdawdawd");
        $this->assertFalse($auth->isAdmin());
    }



    /**
     * Test authenticatedOnly()
     *
     * @runInSeparateProcess
     */
    public function testAuthenticatedOny()
    {
        $auth = new AuthHelper();
        $auth->setDi($this->di);
        $session = $this->di->get("session");
        $session->set("username", "test2");
        $auth->authenticatedOnly();
    }



    /**
     * Test adminOnly()
     *
     * @runInSeparateProcess
     */
    public function testAdminOnly()
    {
        // $di = new \Anax\DI\DIFactoryConfig("MockDi.php");
        $auth = new AuthHelper();
        $auth->setDi($this->di);
        $session = $this->di->get("session");
        $session->set("username", "doe");
        $auth->adminOnly();
    }
}
