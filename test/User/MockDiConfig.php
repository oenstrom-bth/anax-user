<?php

namespace Oenstrom\User;

/**
 * Mock DI configuration file
 */
return [
    "services" => [
        "session" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Session\SessionConfigurable();
                $obj->configure(["name" => "oenstrom-anax-session-test"]);
                $obj->start();
                return $obj;
            }
        ],
        "db" => [
            "shared" => true,
            "callback" => function () {
                $obj = new MockDatabaseQueryBuilder();
                return $obj;
            }
        ],
    ],
];
