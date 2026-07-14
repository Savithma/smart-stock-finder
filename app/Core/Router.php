<?php

declare(strict_types=1);

namespace App\Core;

final class Router
{
    private array $getRoutes = [];
    private array $postRoutes = [];

    public function get(
        string $route,
        callable $handler
    ): void {
        $this->getRoutes[$this->normalize($route)] = $handler;
    }

    public function post(
        string $route,
        callable $handler
    ): void {
        $this->postRoutes[$this->normalize($route)] = $handler;
    }

    public function dispatch(
        string $requestMethod,
        string $route
    ): void {
        $route = $this->normalize($route);

        $routes = strtoupper($requestMethod) === 'POST'
            ? $this->postRoutes
            : $this->getRoutes;

        if (!isset($routes[$route])) {
            http_response_code(404);

            require __DIR__ .
                '/../../resources/views/errors/404.php';

            return;
        }

        $handler = $routes[$route];
        $handler();
    }

    private function normalize(string $route): string
    {
        $route = trim($route, '/');

        return $route === '' ? 'login' : $route;
    }
}
