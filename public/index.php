<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;

try {
    Database::connect();

    echo 'Smart Stock Finder database connected successfully.';
} catch (Throwable $exception) {
    echo 'Application could not connect to the database.';
}
