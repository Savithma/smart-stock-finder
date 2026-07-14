<?php

declare(strict_types=1);

namespace App\Models;

final class UserRole
{
    public const OWNER = 'OWNER';
    public const BRANCH_ADMIN = 'BRANCH_ADMIN';
    public const STOREKEEPER = 'STOREKEEPER';
    public const SALES_ASSISTANT = 'SALES_ASSISTANT';
    public const CASHIER = 'CASHIER';

    private function __construct() {}

    public static function all(): array
    {
        return [
            self::OWNER,
            self::BRANCH_ADMIN,
            self::STOREKEEPER,
            self::SALES_ASSISTANT,
            self::CASHIER
        ];
    }
}
