<?php

function getDatabaseConfig(): array
{
    $host = 'localhost';
    $port = '5432';
    $user = 'reza';
    $password = 'reza';

    return [
        'database' => [
            'test' => [
                'dsn' => "pgsql:host=$host;port=$port;dbname=php_login_management_test;user=$user;password=$password"
            ],
            'prod' => [
                'dsn' => "pgsql:host=$host;port=$port;dbname=php_login_management;user=$user;password=$password"
            ]
        ]
    ];
}
