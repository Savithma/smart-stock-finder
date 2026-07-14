<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Services\AuthService;

final class AuthController extends Controller
{
    public function __construct(
        private AuthService $authService
    ) {}

    public function showLogin(): void
    {
        if (Session::has('user')) {
            $this->redirect('dashboard');
        }

        $error = Session::get('login_error');
        Session::remove('login_error');

        $this->view('auth/login', [
            'error' => $error,
            'csrfToken' => Session::csrfToken()
        ]);
    }

    public function login(): void
    {
        $submittedToken = $_POST['_token'] ?? null;

        if (!Session::verifyCsrf($submittedToken)) {
            Session::set(
                'login_error',
                'Your session has expired. Please try again.'
            );

            $this->redirect('login');
        }

        $username = trim(
            (string) ($_POST['username'] ?? '')
        );

        $password = (string) (
            $_POST['password'] ?? ''
        );

        if ($username === '' || $password === '') {
            Session::set(
                'login_error',
                'Username and password are required.'
            );

            $this->redirect('login');
        }

        $user = $this->authService->authenticate(
            $username,
            $password
        );

        if ($user === null) {
            Session::set(
                'login_error',
                'Invalid username or password.'
            );

            $this->redirect('login');
        }

        Session::regenerate();

        Session::set('user', [
            'id' => $user->getId(),
            'branch_id' => $user->getBranchId(),
            'full_name' => $user->getFullName(),
            'username' => $user->getUsername(),
            'role' => $user->getRole()
        ]);

        $this->redirect('dashboard');
    }

    public function logout(): void
    {
        $submittedToken = $_POST['_token'] ?? null;

        if (!Session::verifyCsrf($submittedToken)) {
            http_response_code(403);
            exit('Invalid request.');
        }

        Session::destroy();

        $this->redirect('login');
    }
}
