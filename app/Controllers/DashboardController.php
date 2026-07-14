<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Middleware\AuthMiddleware;

final class DashboardController extends Controller
{
    public function index(): void
    {
        AuthMiddleware::handle();

        $user = Session::get('user');

        $dashboardTitles = [
            'OWNER' => 'Owner Dashboard',
            'BRANCH_ADMIN' => 'Branch Admin Dashboard',
            'STOREKEEPER' => 'Storekeeper Dashboard',
            'SALES_ASSISTANT' => 'Sales Assistant Dashboard',
            'CASHIER' => 'Cashier Dashboard'
        ];

        $dashboardTitle = $dashboardTitles[$user['role']] ?? 'Dashboard';

        $this->view('dashboard/index', [
            'user' => $user,
            'dashboardTitle' => $dashboardTitle,
            'csrfToken' => Session::csrfToken()
        ]);
    }
}
