CREATE DATABASE `balloons`;

CREATE TABLE `users` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(255) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL
) CHARACTER SET = 'utf8' COLLATE = 'utf8_general_ci';

CREATE TABLE `products` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `category_id` INT NOT NULL,
    `image_name` VARCHAR(55) NOT NULL,
    `title` VARCHAR(255),
    `description` TEXT,
    `price` INT
) CHARACTER SET = 'utf8' COLLATE = 'utf8_general_ci';

CREATE TABLE `categories` (
	`id` INT PRIMARY KEY AUTO_INCREMENT,
	`name` VARCHAR(255) UNIQUE NOT NULL
) CHARACTER SET = 'utf8' COLLATE = 'utf8_general_ci';
