<?php

namespace RezaFikkri\PHPLoginManagement\Controller;

use RezaFikkri\PHPLoginManagement\Config\Database;
use RezaFikkri\PHPLoginManagement\Core\View;
use RezaFikkri\PHPLoginManagement\DTO\UserRegisterRequest;
use RezaFikkri\PHPLoginManagement\Exception\ValidationException;
use RezaFikkri\PHPLoginManagement\Repository\UserRepository;
use RezaFikkri\PHPLoginManagement\Service\UserService;

class UserController
{
    private UserService $userService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $this->userService = new UserService($userRepository);
    }

    public function register(): void
    {
        View::render('User/register', [
            'title' => 'Register new user'
        ]);
    }

    public function postRegister(): void
    {
        $request = new UserRegisterRequest();
        $request->id = $_POST['id'];
        $request->name = $_POST['name'];
        $request->password = $_POST['password'];

        try {
            $this->userService->register($request);
            View::redirect('/users/login');
        } catch (ValidationException $ve) {
            View::render('User/register', [
                'title' => 'Register new user',
                'error' => $ve->getMessage()
            ]);
        }
    }
}
