<?php

use RezaFikkri\PHPLoginManagement\Core\Router;
use RezaFikkri\PHPLoginManagement\Controller\{
    HomeController,
};

require_once __DIR__ . '/../vendor/autoload.php';

Router::add('GET', '/', HomeController::class, 'index');

Router::run();
