<?php

namespace RezaFikkri\PHPLoginManagement\Repository;

use PHPUnit\Framework\TestCase;
use RezaFikkri\PHPLoginManagement\Config\Database;
use RezaFikkri\PHPLoginManagement\Domain\User;

class UserRepositoryTest extends TestCase
{
    private UserRepository $userRepository;

    public function setUp(): void
    {
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->userRepository->deleteAll();
    }

    public function testSaveSuccess(): void
    {
        $user = new User();
        $user->id = 'reza';
        $user->name = 'Reza';
        $user->password = 'rahasia';

        $this->userRepository->save($user);
        $result = $this->userRepository->findById($user->id);

        $this->assertEquals($user->id, $result->id);
        $this->assertEquals($user->name, $result->name);
        $this->assertEquals($user->password, $result->password);
    }

    public function testFindByIdNotFound(): void
    {
        $user = $this->userRepository->findById("NotFound");
        $this->assertNull($user);
    }
}
