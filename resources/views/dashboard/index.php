<?php

declare(strict_types=1);

/** @var string $dashboardTitle */
/** @var string $csrfToken */

/**
 * @var array{
 *     id: int|null,
 *     branch_id: int|null,
 *     full_name: string,
 *     username: string,
 *     role: string
 * } $user
 */

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">

    <title>
        <?= htmlspecialchars(
            $dashboardTitle,
            ENT_QUOTES,
            'UTF-8'
        ) ?>
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar bg-white border-bottom">
        <div class="container">
            <span class="navbar-brand fw-bold">
                Smart Stock Finder
            </span>

            <form
                method="POST"
                action="index.php?route=logout">
                <input
                    type="hidden"
                    name="_token"
                    value="<?= htmlspecialchars(
                                $csrfToken,
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>">

                <button
                    type="submit"
                    class="btn btn-outline-danger btn-sm">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <main class="container py-5">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h1 class="h3 fw-bold">
                    <?= htmlspecialchars(
                        $dashboardTitle,
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </h1>

                <p class="mb-1">
                    Welcome,
                    <strong>
                        <?= htmlspecialchars(
                            $user['full_name'],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </strong>
                </p>

                <p class="text-secondary mb-0">
                    Role:
                    <?= htmlspecialchars(
                        $user['role'],
                        ENT_QUOTES,
                        'UTF-8'
                    ) ?>
                </p>
            </div>
        </div>
    </main>

</body>

</html>