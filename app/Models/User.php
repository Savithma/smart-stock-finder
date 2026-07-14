<?php

declare(strict_types=1);

namespace App\Models;

final class User
{
    public function __construct(
        private ?int $id,
        private ?int $branchId,
        private string $fullName,
        private string $username,
        private ?string $email,
        private string $passwordHash,
        private string $role,
        private string $status
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBranchId(): ?int
    {
        return $this->branchId;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function isActive(): bool
    {
        return $this->status === 'ACTIVE';
    }

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }
}
