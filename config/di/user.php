<?php
/**
 * Configuration file for anax-user DI container.
 */
return [
    // Services to add to the container.
    "services" => [
        "userController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Oenstrom\User\UserController();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "adminController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Oenstrom\User\AdminController();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "authHelper" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Oenstrom\User\AuthHelper();
                $obj->setDI($this);
                return $obj;
            }
        ],
    ],
];
