<?php

namespace Oenstrom\User\HTMLForm;

/**
 * Test class for ProfileForm
 */
class ProfileFormTest extends \PHPUnit_Framework_TestCase
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
        $profileForm = new ProfileForm($this->di);
        $this->assertInstanceOf("Oenstrom\User\HTMLForm\ProfileForm", $profileForm);
    }



    /**
     * Test callbackSubmit()
     */
    public function testCallbackSubmit()
    {
        $profileForm = new ProfileForm($this->di);
        $this->assertFalse($profileForm->callbackSubmit());
    }
}
