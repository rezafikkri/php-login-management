<?php

namespace RezaFikkri\PHPLoginManagement\Service;

use Exception;
use RezaFikkri\PHPLoginManagement\Config\Database;
use RezaFikkri\PHPLoginManagement\Domain\User;
use RezaFikkri\PHPLoginManagement\DTO\{
    UserRegisterRequest,
    UserRegisterResponse,
};
use RezaFikkri\PHPLoginManagement\Exception\ValidationException;
use RezaFikkri\PHPLoginManagement\Repository\UserRepository;

class UserService
{
    public function __construct(private UserRepository $userRepository): void
    {
        
    }

    public function register(UserRegisterRequest $request): UserRegisterResponse
    {
        $this->validateUserRegistrationRequest($request);

        try {
            Database::beginTransaction();

            $user = $this->userRepository->findById($request->id);
            if ($user != null) {
                throw new ValidationException('User id already exists.');
            }

            $user = new User();
            $user->id = $request->id;
            $user->name = $request->name;
            $user->password = password_hash($request->password, PASSWORD_BCRYPT);

            $this->userRepository->save($user);

            $response = new UserRegisterResponse();
            $response->user = $user;

            Database::commitTransaction();
            return $response;
        } catch (Exception $e) {
            Database::rollbackTransaction();
            throw $e;
        }
    }

    private function validateUserRegistrationRequest(UserRegisterRequest $request)
    {
        if (
            $request->id == null ||
            $request->name == null ||
            $request->password == null ||
            trim($request->id) == '' ||
            trim($request->name) == '' ||
            trim($request->password) == ''
        ) {
            throw new ValidationException('id, name and password cannot blank.');
        }
    }
}
