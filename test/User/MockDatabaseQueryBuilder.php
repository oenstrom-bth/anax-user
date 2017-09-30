<?php

namespace Oenstrom\User;

use Anax\Database\DatabaseQueryBuilder;

/**
 * A DatabaseQueryBuilder mock class
 *
 * @SuppressWarnings("unused")
 */
class MockDatabaseQueryBuilder extends DatabaseQueryBuilder
{
    public $username;
    public $email;

    public function connect()
    {
        return $this;
    }
    public function select($columns = '*')
    {
        return $this;
    }
    public function from($tableName)
    {
        return $this;
    }
    public function where($condition)
    {
        $this->condition = $condition;
        return $this;
    }
    public function execute($query = null, $params = array())
    {
        if ($this->condition === "username = ?") {
            $this->username = $query[0];
        } elseif ($this->condition === "email = ?") {
            $this->email = $query[0];
        }
        return $this;
    }
    public function fetchInto($object)
    {
        if ($this->email === "test@test.com" || $this->username === "test" || $this->username === "test2") {
            $object->id = 1;
            $object->role = $this->username === "test" ? "admin" : "user";
            $object->username = "test";
            $object->password = password_hash("test", PASSWORD_DEFAULT);
            $object->email = "test@test.com";
            return $object;
        }
        return false;
    }
}
