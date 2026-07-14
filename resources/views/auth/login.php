<?php

declare(strict_types=1);

/** @var string $csrfToken */
/** @var string|null $error */

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">

    <title>Login | Smart Stock Finder</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container">
        <div
            class="row justify-content-center align-items-center"
            style="min-height: 100vh;">
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="fw-bold mb-1">
                            Smart Stock Finder
                        </h2>

                        <p class="text-secondary mb-4">
                            Sign in to your retail workspace
                        </p>

                        <?php if (!empty($error)): ?>
                            <div
                                class="alert alert-danger"
                                role="alert">
                                <?= htmlspecialchars(
                                    (string) $error,
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </div>
                        <?php endif; ?>

                        <form
                            method="POST"
                            action="index.php?route=login">
                            <input
                                type="hidden"
                                name="_token"
                                value="<?= htmlspecialchars(
                                            $csrfToken,
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ) ?>">

                            <div class="mb-3">
                                <label
                                    for="username"
                                    class="form-label">
                                    Username
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="username"
                                    name="username"
                                    autocomplete="username"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label
                                    for="password"
                                    class="form-label">
                                    Password
                                </label>

                                <input
                                    type="password"
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    autocomplete="current-password"
                                    required>
                            </div>

                            <button
                                type="submit"
                                class="btn btn-primary w-100">
                                Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>