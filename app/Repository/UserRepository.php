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

    public function findById(string $id): ?User
    {
        $stmt = $this->connection->prepare("SELECT id, name, password FROM users WHERE id=:id");
        $stmt->execute([ ':id' => $id ]);

        try {
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $user = new User();
                $user->id = $row['id'];
                $user->name = $row['name'];
                $user->password = $row['password'];
                return $user;
            }
            return null;
        } finally {
            $stmt->closeCursor();
        }
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM users");
    }
}
