<?php

declare(strict_types=1);

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Core\Router;

return static function (
    Router $router,
    AuthController $authController,
    DashboardController $dashboardController
): void {
    $router->get(
        'login',
        fn() => $authController->showLogin()
    );

    $router->post(
        'login',
        fn() => $authController->login()
    );

    $router->get(
        'dashboard',
        fn() => $dashboardController->index()
    );

    $router->post(
        'logout',
        fn() => $authController->logout()
    );
};
