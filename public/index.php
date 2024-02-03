<?php

use RezaFikkri\PHPLoginManagement\Config\Database;
use RezaFikkri\PHPLoginManagement\Core\Router;
use RezaFikkri\PHPLoginManagement\Controller\{
    HomeController,
    UserController,
};

require_once __DIR__ . '/../vendor/autoload.php';

// karena koneksi ke database hanya akan dibuat sekali,
// maka kita buat satu koneksi di halaman index dengan env prod, sehingga
// ketika nanti getConnection lagi, maka otomatis akan memakai env prod, bukan env test lagi
Database::getConnection('prod');

Router::add('GET', '/', HomeController::class, 'index');
Router::add('GET', '/users/register', UserController::class, 'register');
Router::add('POST', '/users/register', UserController::class, 'postRegister');

Router::run();
