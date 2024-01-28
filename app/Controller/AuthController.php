<?php

namespace RezaFikkri\PHPLoginManagement\Controller;

use RezaFikkri\PHPLoginManagement\Core\View;

class AuthController
{
    public function login(): void
    {
        $model = [
            'title' => 'Login Page',
            'content' => 'Login'
        ];

        View::render('login', $model);
    }

    public function sigin(): void
    {
        session_start();

        $_SESSION['user'] = 'Reza';

        header('Location: /hello');
    }

    public function logout(): void
    {
        session_destroy();

        header('Location: /');
    }
}
