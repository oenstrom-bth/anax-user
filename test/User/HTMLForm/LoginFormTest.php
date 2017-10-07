<?php

namespace Oenstrom\User\HTMLForm;

/**
 * Test class for User
 */
class LoginFormTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test setup
     */
    protected function setUp()
    {
        // $conf = include "MockDiConfig.php";
        // $this->di = new \Anax\DI\DIFactoryConfig($conf);
        $this->di = new \Anax\DI\DIFactoryConfig("MockDi.php");
    }



    /**
     * Test create form
     */
    public function testCreateForm()
    {
        $loginForm = new LoginForm($this->di);
        $this->assertInstanceOf("Oenstrom\User\HTMLForm\LoginForm", $loginForm);
    }



    /**
     * Test getLoggedInUser()
     */
    public function testCallbackSubmit()
    {
        $loginForm = new LoginForm($this->di);
        $this->assertFalse($loginForm->callbackSubmit());
    }
}
