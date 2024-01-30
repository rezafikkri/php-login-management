<?php

namespace RezaFikkri\PHPLoginManagement\Repository;

use PDO;
use RezaFikkri\PHPLoginManagement\Domain\User;

class UserRepository
{
    public function __construct(private PDO $connection)
    {
        
    }

    public function save(User $user): User
    {
        $sql = 'INSERT INTO users(id, name, password) VALUES(:id, :name, :password)'; 
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            ':id' => $user->id,
            ':name' => $user->name,
            ':password' => $user->password
        ]);
        return $user;
    }
}
