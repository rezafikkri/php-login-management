<?php

namespace RezaFikkri\PHPLoginManagement\Controller;

use RezaFikkri\PHPLoginManagement\Core\View;

class HomeController
{
    public function index(): void
    {
        View::render('Home/index', [
            'title' => 'PHP Login Management',
            'content' => 'Belajar PHP MVC'
        ]);
    }
}
