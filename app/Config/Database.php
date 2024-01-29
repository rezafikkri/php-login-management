<?php

namespace RezaFikkri\PHPLoginManagement\Config;

use PDO;

class Database
{
    private static ?PDO $pdo = null;

    public static function getConnection(string $env = 'test'): ?PDO
    {
        if (static::$pdo == null) {
            require_once __DIR__ . '/../../config/database.php';
            $config = getDatabaseConfig();

            static::$pdo = new PDO($config['database'][$env]['dsn']);
        }

        return static::$pdo;
    }
}
