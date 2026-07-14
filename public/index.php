<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Core\Database;
use App\Core\Router;
use App\Core\Session;
use App\Repositories\UserRepository;
use App\Services\AuthService;

Session::start();

try {
    $database = Database::connect();

    $userRepository = new UserRepository(
        $database
    );

    $authService = new AuthService(
        $userRepository
    );

    $authController = new AuthController(
        $authService
    );

    $dashboardController =
        new DashboardController();

    $router = new Router();

    $registerRoutes = require __DIR__ .
        '/../routes/web.php';

    $registerRoutes(
        $router,
        $authController,
        $dashboardController
    );

    $route = (string) (
        $_GET['route'] ?? 'login'
    );

    $router->dispatch(
        $_SERVER['REQUEST_METHOD'],
        $route
    );
} catch (Throwable $exception) {
    http_response_code(500);

    echo 'The application encountered an error.';

    // During development only:
    // echo '<pre>' . $exception . '</pre>';
}
