<?php

class Database {
    private static $connection = null;

    public static function getConnection() {
        if (self::$connection === null) {
            $dsn = 'mysql:host=127.0.0.1;port=3307;dbname=progweb;charset=utf8mb4';
            $username = 'root';
            $password = '';

            self::$connection = new PDO(
                $dsn,
                $username,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        }

        return self::$connection;
    }
}
