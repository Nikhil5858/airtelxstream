<?php
require_once __DIR__ . '/../config.php';

class Database
{
    private static ?PDO $instance = null;

    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            $host   = 'localhost';
            $dbname = 'airtelxstream';
            $user   = 'root';
            $pass   = '';

            try {
                $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
                self::$instance = new PDO($dsn, $user, $pass);
            } catch (PDOException $e) {
                die("Database Connection Failed: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
