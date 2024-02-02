<?php

namespace RezaFikkri\PHPLoginManagement\Service;

use PHPUnit\Framework\TestCase;
use RezaFikkri\PHPLoginManagement\Config\Database;
use RezaFikkri\PHPLoginManagement\Domain\User;
use RezaFikkri\PHPLoginManagement\DTO\UserRegisterRequest;
use RezaFikkri\PHPLoginManagement\Exception\ValidationException;
use RezaFikkri\PHPLoginManagement\Repository\UserRepository;

class UserServiceTest extends TestCase
{
    private UserService $userService;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $connection = Database::getConnection();
        $this->userRepository = new UserRepository($connection);
        $this->userService = new UserService($this->userRepository);

        $this->userRepository->deleteAll();
    }

    public function testRegisterSuccess(): void
    {
        $request = new UserRegisterRequest();
        $request->id = 'reza';
        $request->name = 'Reza';
        $request->password = 'rahasia';
        $response = $this->userService->register($request);

        $this->assertEquals($request->id, $response->user->id);
        $this->assertEquals($request->name, $response->user->name);
        $this->assertTrue(password_verify($request->password, $response->user->password));
    }

    public function testRegisterFailed(): void
    {
        $this->expectException(ValidationException::class);

        $request = new UserRegisterRequest();
        $request->id = '';
        $request->name = '';
        $request->password = '';
        $this->userService->register($request);
    }

    public function testRegisterDuplicate(): void
    {
        $user = new User();
        $user->id = 'reza';
        $user->name = 'Reza';
        $user->password = 'rahasia';

        $this->userRepository->save($user);

        $this->expectException(ValidationException::class);

        $request = new UserRegisterRequest();
        $request->id = 'reza';
        $request->name = 'Reza';
        $request->password = 'rahasia';
        $this->userService->register($request);
    }
}
