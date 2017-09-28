<?php

namespace Oenstrom\User;

use \Anax\Database\ActiveRecordModel;

/**
 * A database driven model.
 */
class User extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "User";



    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $role;
    public $username;
    public $password;
    public $email;
    public $created;
    //public $updated;
    public $deleted;
    //public $active;



    /**
     * Set the user password.
     *
     * @param string $password the password to hash.
     *
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }



    /**
     * AWd
     */
    public function verifyPassword($username, $password)
    {
        $this->find("username", $username);
        return password_verify($password, $this->password);
    }



    /**
     * Check if the username already exists in the database.
     */
    public function usernameExists($username)
    {
        $this->find("username", $username);
        return $this->username;
    }



    /**
     * Check if the email already exists in the database.
     *
     */
    public function emailExists($email)
    {
        $this->find("email", $email);
        return $this->email;
    }



    /**
     *
     */
    public function isAdmin()
    {
        return $this->role === "admin";
    }
}
