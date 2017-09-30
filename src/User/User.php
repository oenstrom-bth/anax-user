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
     * @var string $role not null default "user".
     * @var string $username unique not null.
     * @var string $password not null.
     * @var string $email unique not null.
     * @var timestamp $created default CURRENT_TIMESTAMP.
     * @var timestamp $deleted default null.
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
     * Check if password is correct.
     *
     * @param string $username the username of the user
     * @param string $password the password of the user
     *
     * @return boolean true if the password match the user password, else false
     */
    public function verifyPassword($username, $password)
    {
        $this->find("username", $username);
        return password_verify($password, $this->password);
    }



    /**
     * Check if the username already exists in the database.
     *
     * @return string|null the username if it exists, else null
     */
    public function usernameExists($username)
    {
        $this->find("username", $username);
        return $this->username;
    }



    /**
     * Check if the email already exists in the database.
     *
     * @return string|null the email if it exists, else null
     */
    public function emailExists($email)
    {
        $this->find("email", $email);
        return $this->email;
    }



    /**
     * Check if the user is an admin.
     *
     * @return boolean true if user is admin, else false
     */
    public function isAdmin()
    {
        return $this->role === "admin";
    }
}
