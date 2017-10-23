<?php
/**
 * Mock DI config
 */
return [
    "services" => [
        "request" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Request\Request();
                $obj->init();
                return $obj;
            }
        ],
        "response" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Oenstrom\User\MockResponse();
                return $obj;
            }
        ],
        "url" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Url\Url();
                $request = $this->get("request");
                $obj->setSiteUrl($request->getSiteUrl());
                $obj->setBaseUrl($request->getBaseUrl());
                $obj->setStaticSiteUrl($request->getSiteUrl());
                $obj->setStaticBaseUrl($request->getBaseUrl());
                $obj->setScriptName($request->getScriptName());
                $obj->configure("MockUrl.php");
                $obj->setDefaultsFromConfiguration();
                return $obj;
            }
        ],
        "router" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Route\Router();
                $obj->setDI($this);
                $obj->configure("MockRoute.php");
                return $obj;
            }
        ],
        "view" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\View\ViewCollection();
                $obj->setDI($this);
                $obj->configure("MockView.php");
                return $obj;
            }
        ],
        "viewRenderFile" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\View\ViewRenderFile2();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "session" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Session\SessionConfigurable();
                $obj->configure(["name" => "oenstrom-anax-session-test"]);
                $obj->start();
                return $obj;
            }
        ],
        "textfilter" => [
            "shared" => true,
            "callback" => "\Anax\TextFilter\TextFilter",
        ],
        "pageRender" => [
            "shared" => true,
            "callback" => function () {
                // $obj = new \Anax\Page\PageRender();
                // $obj->setDI($this);
                // return $obj;
                $obj = new \Oenstrom\User\MockPageRender();
                return $obj;
            }
        ],
        "errorController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Page\ErrorController();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "debugController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Page\DebugController();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "flatFileContentController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Anax\Page\FlatFileContentController();
                $obj->setDI($this);
                return $obj;
            }
        ],
        "user" => [
            "shared" => false,
            "callback" => function () {
                $user = new \Oenstrom\User\User("User");
                $user->setDb($this->get("db"));
                return $user;
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
        "userController" => [
            "shared" => true,
            "callback" => function () {
                $obj = new \Oenstrom\User\UserController();
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
        "db" => [
            "shared" => false,
            "callback" => function () {
                $obj = new \Anax\Database\DatabaseQueryBuilder();
                $obj->configure("MockSQLite.php");
                $obj->connect();

                $sql = '
                CREATE TABLE `User`
                (
                    `id`        INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
                    `role`      VARCHAR(20) NOT NULL DEFAULT "user",
                    `username`  VARCHAR(80) UNIQUE NOT NULL,
                    `email`     VARCHAR(255) UNIQUE NOT NULL,
                    `password`  VARCHAR(255) NOT NULL,
                    `created`   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    `deleted`   DATETIME
                )';
                $obj->execute($sql);
                $sql = 'INSERT INTO `User`(role, username, email, password) VALUES
                        ("admin", "admin", "admin@admin.com", "$2y$10$Njbsb6l8TCLdvHUcS/65IOcEVARQGICBYqDqx8843aPgpVdlYedrC"),
                        ("user", "doe", "user@user.com", "$2y$10$26KgRWjs3F654.yHpsYYDO4sd86ksNN1E8zpQ2yHMA/yx33tV/ACq")';
                $obj->execute($sql);

                return $obj;
            }
        ],
    ],
];
