<?php

namespace Controllers;

class Database
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(?string $database = null): \PDO
    {
        if (self::$instance === null) {
            $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
            $dotenv->load();

            $databaseHost = $_ENV['DATABASE_HOST'];
            $databasePort = $_ENV['DATABASE_PORT'];
            $databaseName = $database ?? $_ENV['DATABASE_NAME'];
            $databaseUsername = $_ENV['DATABASE_USERNAME'];
            $databasePassword = $_ENV['DATABASE_PASSWORD'];

            self::$instance = new \PDO("mysql:host=$databaseHost;dbport=$databasePort;dbname=$databaseName", $databaseUsername, $databasePassword);
        }

        return self::$instance;
    }
}