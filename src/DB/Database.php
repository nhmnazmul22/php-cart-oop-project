<?php

namespace App\DB;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    public static function getConnection(): PDO
    {
        // Load environment variables
        $env = parse_ini_file(__DIR__ . '/../../.env');
        if (!$env) {
            die('.env file not found!');
        }

        if (self::$connection === null) {

            $host = $env['DB_HOST'];
            $db   = $env['DB_NAME'];
            $user = $env['DB_USER'];
            $pass = $env['DB_PASS'];

            $charset = $env['DB_CHARSET'] ?? 'utf8mb4';

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            try {
                self::$connection = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                die("Database connection failed " . $e->getMessage());
            }
        }
        return self::$connection;
    }
}
