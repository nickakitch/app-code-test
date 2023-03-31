<?php
require_once 'vendor/autoload.php';

$database = \Controllers\Database::getInstance('information_schema');

$database->query('CREATE DATABASE IF NOT EXISTS `nicholas_hunt_code_challenge`;');

echo 'Database created successfully' . PHP_EOL;

$database->query('CREATE TABLE IF NOT EXISTS `nicholas_hunt_code_challenge`.`calls` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `date` DATETIME NOT NULL,
    `it_person` VARCHAR(32) NOT NULL,
    `username` VARCHAR(32) NOT NULL,
    `subject` VARCHAR(64) NOT NULL,
    `details` TEXT NOT NULL,
    `total_time_in_minutes` INT NOT NULL DEFAULT 0,
    `status` VARCHAR(11) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;');

echo 'Calls table created successfully' . PHP_EOL;

$database->query('CREATE TABLE IF NOT EXISTS `nicholas_hunt_code_challenge`.`call_details` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `call_id` INT NOT NULL,
    `date` DATETIME NOT NULL,
    `details` TEXT NOT NULL,
    `total_time_in_minutes` INT NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `deleted_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`call_id`) REFERENCES `calls`(`id`) ON DELETE CASCADE
) ENGINE = InnoDB;');

echo 'Call details table created successfully' . PHP_EOL;
