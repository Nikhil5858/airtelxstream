<?php

class Database
{
    private static ?Database $instance = null;
    private PDO $connection;

    private function __construct()
    {
        $host   = 'localhost';
        $db = 'airtelxstream';
        $user   = 'root';
        $pass   = '';

        $dsn = "mysql:host={$host};dbname={$db};charset=utf8mb4";

        $this->connection = new PDO($dsn, $user, $pass);
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
