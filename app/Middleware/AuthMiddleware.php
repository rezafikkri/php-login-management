<?php

namespace RezaFikkri\PHPLoginManagement\Middleware;

use RezaFikkri\PHPLoginManagement\Core\Middleware;

class AuthMiddleware implements Middleware
{
    public function before(): void
    {
        session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }
    }
}
