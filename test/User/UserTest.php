<?php

namespace Oenstrom\User;

/**
 * Test class for User
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test setup
     */
    protected function setUp()
    {
        $this->di = new \Anax\DI\DIFactoryConfig("MockDi.php");
        $this->user = new User();
        $this->user->setDb($this->di->get("db"));
    }



    /**
     * Test the instance.
     */
    public function testCreateUser()
    {
        $this->assertInstanceOf("Oenstrom\User\User", $this->user);
    }



    /**
     * Test setPassword()
     */
    public function testSetPassword()
    {
        $this->user->find("username", "user");
        $this->assertNull($this->user->password);

        $this->user->find("username", "doe");
        $oldPass = $this->user->password;
        $this->user->setPassword("test");

        $this->assertStringStartsWith("$2y$10", $this->user->password);
        $this->assertNotEquals($oldPass, $this->user->password);
    }



    /**
     * Test test verifyPassword()
     */
    public function testVerifyPassword()
    {
        $this->assertFalse($this->user->verifyPassword("doe", "wrong"));
        $this->assertTrue($this->user->verifyPassword("doe", "doe"));
    }



    /**
     * Test usernameExists()
     */
    public function testUsernameExists()
    {
        $this->assertNull($this->user->usernameExists("user"));
        $this->assertSame($this->user->usernameExists("doe"), "doe");
    }



    /**
     * Test emailExists()
     */
    public function testEmailExists()
    {
        $this->assertNull($this->user->emailExists("invalid@email.com"));
        $this->assertSame($this->user->emailExists("admin@admin.com"), "admin@admin.com");
    }



    /**
     * Test isAdmin()
     */
    public function testIsAdmin()
    {
        $this->user->find("username", "doe");
        $this->assertFalse($this->user->isAdmin());

        $this->user->find("username", "admin");
        $this->assertTrue($this->user->isAdmin());
    }
}
