<?php

namespace RezaFikkri\PHPLoginManagement\Controller;

use RezaFikkri\PHPLoginManagement\Core\View;

class HomeController
{
    public function index(): void
    {
        $model = [
            'title' => 'Belajar PHP MVC',
            'content' => 'Selamat belajar PHP MVC',
            'todo' => ['ha' => 'hahaha']
        ];

        View::render('Home/index', $model);
    }

    public function hello(): void
    {
        echo "HomeController::hello()";
    }

    public function login(): void
    {
        $request = [
            'username' => $_POST['username'],
            'password' => $_POST['password']
        ];

        $response = [
            'message' => 'Login success'
        ];
    }
}
