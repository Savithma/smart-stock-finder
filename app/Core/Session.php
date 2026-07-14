<?php

declare(strict_types=1);

namespace App\Core;

final class Session
{
    private function __construct() {}

    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function get(
        string $key,
        mixed $default = null
    ): mixed {
        return $_SESSION[$key] ?? $default;
    }

    public static function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public static function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public static function regenerate(): void
    {
        session_regenerate_id(true);
    }

    public static function csrfToken(): string
    {
        if (!self::has('csrf_token')) {
            self::set(
                'csrf_token',
                bin2hex(random_bytes(32))
            );
        }

        return self::get('csrf_token');
    }

    public static function verifyCsrf(
        ?string $submittedToken
    ): bool {
        $storedToken = self::get('csrf_token');

        if (
            !is_string($submittedToken) ||
            !is_string($storedToken)
        ) {
            return false;
        }

        return hash_equals(
            $storedToken,
            $submittedToken
        );
    }

    public static function destroy(): void
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $parameters = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $parameters['path'],
                $parameters['domain'],
                $parameters['secure'],
                $parameters['httponly']
            );
        }

        session_destroy();
    }
}
