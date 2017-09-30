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
        $this->db = new MockDatabaseQueryBuilder();
        $this->user = new User();
        $this->user->setDb($this->db);
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

        $this->user->find("username", "test");
        $this->user->setPassword("test");
        $this->assertStringStartsWith("$2y$10", $this->user->password);
    }



    /**
     * Test test verifyPassword()
     */
    public function testVerifyPassword()
    {
        $this->assertFalse($this->user->verifyPassword("user", "wrong"));
        $this->assertTrue($this->user->verifyPassword("test", "test"));
    }



    /**
     * Test usernameExists()
     */
    public function testUsernameExists()
    {
        $this->assertNull($this->user->usernameExists("user"));
        $this->assertSame($this->user->usernameExists("test"), "test");
    }



    /**
     * Test emailExists()
     */
    public function testEmailExists()
    {
        $this->assertNull($this->user->emailExists("invalid@email.com"));
        $this->assertSame($this->user->emailExists("test@test.com"), "test@test.com");
    }



    /**
     * Test isAdmin()
     */
    public function testIsAdmin()
    {
        $this->user->find("username", "user");
        $this->assertFalse($this->user->isAdmin());

        $this->user->find("username", "test");
        $this->assertTrue($this->user->isAdmin());
    }
}
