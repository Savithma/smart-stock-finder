<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use PDO;

final class UserRepository
{
    public function __construct(
        private PDO $database
    ) {}

    public function findByUsername(string $username): ?User
    {
        $statement = $this->database->prepare(
            'SELECT
                id,
                branch_id,
                full_name,
                username,
                email,
                password_hash,
                role,
                status
             FROM users
             WHERE username = :username
             LIMIT 1'
        );

        $statement->execute([
            'username' => trim($username)
        ]);

        $row = $statement->fetch();

        if (!$row) {
            return null;
        }

        return new User(
            id: (int) $row['id'],
            branchId: $row['branch_id'] !== null
                ? (int) $row['branch_id']
                : null,
            fullName: $row['full_name'],
            username: $row['username'],
            email: $row['email'],
            passwordHash: $row['password_hash'],
            role: $row['role'],
            status: $row['status']
        );
    }

    public function updateLastLogin(int $userId): bool
    {
        $statement = $this->database->prepare(
            'UPDATE users
             SET last_login_at = NOW()
             WHERE id = :id'
        );

        return $statement->execute([
            'id' => $userId
        ]);
    }
}
