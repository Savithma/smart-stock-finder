<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Core\Session;

final class RoleMiddleware
{
    private function __construct() {}

    public static function allow(
        array $allowedRoles
    ): void {
        AuthMiddleware::handle();

        $user = Session::get('user');
        $currentRole = $user['role'] ?? null;

        if (
            !is_string($currentRole) ||
            !in_array(
                $currentRole,
                $allowedRoles,
                true
            )
        ) {
            http_response_code(403);

            require __DIR__ .
                '/../../resources/views/errors/403.php';

            exit;
        }
    }
}
