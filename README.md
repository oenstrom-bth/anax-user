Anax user
==================================
Anax user module implementing user and admin functionality.


Install
------------------
Install the module with composer and then integrate the module with your Anax installation.

### Install with composer
```
composer require oenstrom/user
```

### Automatic configuration
You can automatically configurate most of the module using the makefile. The makefile is located in `vendor/oenstrom/user/`, make sure you are in that directory before running the make command.
```
# cd vendor/oenstrom/user
make install-module
```

### Manual configuration
If you want to manually copy the files you can do so from the root directory of your Anax installation with the following commands.
```
rsync -a vendor/oenstrom/user/config/di/* config/di/
rsync -a vendor/oenstrom/user/config/route/* config/route/
rsync -a vendor/oenstrom/user/config/database.php config/
rsync -a vendor/oenstrom/user/view/user view/
```

### Setup database
Execute the SQL-file `sql/setup.sql` to create a new database called `anaxuser` and a new table with two users:
`admin:admin` and `doe:doe`
If you already have a database, just edit the SQL-file or use the SQL code below.
```
CREATE TABLE User (
    `id`        INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `role`      VARCHAR(20) NOT NULL DEFAULT 'user',
    `username`  VARCHAR(80) UNIQUE NOT NULL,
    `email`     VARCHAR(255) UNIQUE NOT NULL,
    `password`  VARCHAR(255) NOT NULL,
    `created`   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `deleted`   DATETIME
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO User(role, username, email, password) VALUES
('admin', 'admin', 'admin@admin.com', '$2y$10$Njbsb6l8TCLdvHUcS/65IOcEVARQGICBYqDqx8843aPgpVdlYedrC'),
('user', 'doe', 'user@user.com', '$2y$10$26KgRWjs3F654.yHpsYYDO4sd86ksNN1E8zpQ2yHMA/yx33tV/ACq');
```
Now update the file `config/database.php` with settings and credentials for your SQL server.


### Test it
When all of the above is done you can test it with the following routes.
```
user/register               Register a new account
user/login                  Login with your account
user/logout                 Logout from your account

# Protected from unauthenticated users
user/profile                Display the user profile

# Protected from unauthorized users
user/admin/users            Display all users
user/admin/users/add        Create a new user
user/admin/update/:id       Update an user with the provided id
user/admin/delete/:id       Delete an user with the provided id
```

License
------------------
This software carries a MIT license.


```

  Copyright (c) 2017 Olof Enström (olof.enstrom@gmail.com)

```
