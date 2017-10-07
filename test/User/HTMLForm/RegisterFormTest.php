<?php

namespace Oenstrom\User\HTMLForm;

/**
 * Test class for User
 */
class RegisterFormTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test setup
     */
    protected function setUp()
    {
        $this->di = new \Anax\DI\DIFactoryConfig("MockDi.php");
    }



    /**
     * Test create form
     */
    public function testCreateForm()
    {
        $registerForm = new RegisterForm($this->di);
        $this->assertInstanceOf("Oenstrom\User\HTMLForm\RegisterForm", $registerForm);
    }



    /**
     * Test getLoggedInUser()
     */
    public function testCallbackSubmit()
    {
        $registerForm = new RegisterForm($this->di);
        $registerForm->callbackSubmit();
        // $this->assertFalse($loginForm->callbackSubmit());
    }
}
