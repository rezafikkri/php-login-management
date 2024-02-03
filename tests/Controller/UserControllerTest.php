<?php

namespace RezaFikkri\PHPLoginManagement\Core {
    function header(string $value): void
    {
        echo $value;
    }
}

namespace RezaFikkri\PHPLoginManagement\Controller
{
    use PHPUnit\Framework\TestCase;
    use RezaFikkri\PHPLoginManagement\Config\Database;
    use RezaFikkri\PHPLoginManagement\Domain\User;
    use RezaFikkri\PHPLoginManagement\Repository\UserRepository;

    class UserControllerTest extends TestCase
    {
        private UserController $userController;
        private UserRepository $userRepository;

        protected function setUp(): void
        {
            $this->userController = new UserController();

            $this->userRepository = new UserRepository(Database::getConnection());
            $this->userRepository->deleteAll();

            putenv('mode=test');
        }

        public function testRegister(): void
        {
            $this->expectOutputRegex('/Register/');
            $this->expectOutputRegex('/id/');
            $this->expectOutputRegex('/name/');
            $this->expectOutputRegex('/password/');
            $this->expectOutputRegex('/Register new user/');

            $this->userController->register();
        }

        public function testPostRegisterSuccess(): void
        {
            $this->expectOutputString('Location: /users/login');

            $_POST['id'] = 'reza';
            $_POST['name'] = 'Reza';
            $_POST['password'] = 'rahasia';

            $this->userController->postRegister();
        }

        public function testPostRegisterValidationError(): void
        {
            $this->expectOutputRegex('/Register/');
            $this->expectOutputRegex('/id/');
            $this->expectOutputRegex('/name/');
            $this->expectOutputRegex('/password/');
            $this->expectOutputRegex('/Register new user/');
            $this->expectOutputRegex('/id, name and password cannot blank./');

            $_POST['id'] = 'reza';
            $_POST['name'] = '';
            $_POST['password'] = '';

            $this->userController->postRegister();
        }

        public function testPostRegisterDuplicate(): void
        {
            $user = new User();
            $user->id = 'reza';
            $user->name = 'Reza';
            $user->password = 'rahasia';
            $this->userRepository->save($user);

            $this->expectOutputRegex('/Register/');
            $this->expectOutputRegex('/id/');
            $this->expectOutputRegex('/name/');
            $this->expectOutputRegex('/password/');
            $this->expectOutputRegex('/Register new user/');
            $this->expectOutputRegex('/User id already exists./');

            $_POST['id'] = 'reza';
            $_POST['name'] = 'Reza';
            $_POST['password'] = 'rahasia';

            $this->userController->postRegister();       
        }
    }

}// end namespace
