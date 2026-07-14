<?php

declare(strict_types=1);

namespace App\Core;

abstract class Controller
{
    protected function view(
        string $view,
        array $data = []
    ): void {
        extract($data, EXTR_SKIP);

        $viewPath = __DIR__ .
            '/../../resources/views/' .
            $view .
            '.php';

        if (!file_exists($viewPath)) {
            throw new \RuntimeException(
                "View not found: {$view}"
            );
        }

        require $viewPath;
    }

    protected function redirect(string $route): never
    {
        header(
            'Location: index.php?route=' .
                urlencode($route)
        );

        exit;
    }
}
