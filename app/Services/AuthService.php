<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

final class AuthService
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function authenticate(
        string $username,
        string $password
    ): ?User {
        $username = trim($username);

        if ($username === '' || $password === '') {
            return null;
        }

        $user = $this->userRepository
            ->findByUsername($username);

        if ($user === null) {
            return null;
        }

        if (!$user->isActive()) {
            return null;
        }

        if (
            !password_verify(
                $password,
                $user->getPasswordHash()
            )
        ) {
            return null;
        }

        if ($user->getId() !== null) {
            $this->userRepository
                ->updateLastLogin($user->getId());
        }

        return $user;
    }
}
