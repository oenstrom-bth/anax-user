<?php

namespace Oenstrom\User\HTMLForm;

/**
 * Test class for EditUserForm
 */
class EditUserFormTest extends \PHPUnit_Framework_TestCase
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
        $editUserForm = new EditUserForm($this->di, 2);
        $this->assertInstanceOf("Oenstrom\User\HTMLForm\EditUserForm", $editUserForm);
    }



    /**
     * Test callbackSubmit()
     */
    public function testCallbackSubmit()
    {
        $editUserForm = new EditUserForm($this->di, 2);
        $this->assertTrue(false !== $editUserForm->callbackSubmit());
    }
}
