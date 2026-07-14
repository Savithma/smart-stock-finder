<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Core\Session;

final class AuthMiddleware
{
    private function __construct() {}

    public static function handle(): void
    {
        if (!Session::has('user')) {
            header(
                'Location: index.php?route=login'
            );

            exit;
        }
    }
}
