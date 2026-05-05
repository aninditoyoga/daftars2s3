<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f1f5f9;
        }

        .login-card {
            max-width: 420px;
            margin: 100px auto;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">Admin Login</h4>
            </div>
            <div class="card-body">
                <?php if (!empty($login_error)): ?>
                    <div class="alert alert-danger"><?= esc($login_error) ?></div>
                <?php endif ?>

                <form method="POST" action="<?= site_url('admin/login') ?>">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
            <div class="card-footer text-center text-muted">
                User: <strong>admin</strong> | Password: <strong>admin123</strong>
            </div>
        </div>
    </div>
</body>

</html>