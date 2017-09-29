--
-- Create a database for test
--
DROP DATABASE anaxuser;
CREATE DATABASE IF NOT EXISTS anaxuser;

USE anaxuser;



-- Ensure UTF8 on the database connection
SET NAMES utf8;


--
-- Table User
--
DROP TABLE IF EXISTS User;
CREATE TABLE User (
    `id` 		INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `role`		VARCHAR(20) NOT NULL DEFAULT 'user',
    `username`	VARCHAR(80) UNIQUE NOT NULL,
    `email`		VARCHAR(255) UNIQUE NOT NULL,
    `password`	VARCHAR(255) NOT NULL,
    `created`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `deleted`	DATETIME
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;


INSERT INTO User(role, username, email, password) VALUES
('admin', 'admin', 'admin@admin.com', '$2y$10$Njbsb6l8TCLdvHUcS/65IOcEVARQGICBYqDqx8843aPgpVdlYedrC'),
('user', 'doe', 'user@user.com', '$2y$10$26KgRWjs3F654.yHpsYYDO4sd86ksNN1E8zpQ2yHMA/yx33tV/ACq');
