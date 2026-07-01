<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StaffHub - Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark d-flex align-items-center" style="height: 100vh;">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-4 text-center">
                        <h3 class="mb-1">🏢 StaffHub</h3>
                        <p class="text-muted small mb-4">Internal Directory Gateway Portal</p>
                        
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger small py-2"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <form action="<?= base_url('auth/login') ?>" method="POST">
                            <?= csrf_field() ?>
                            <div class="mb-3 text-start">
                                <label class="form-label small fw-bold">Admin Username</label>
                                <input type="text" name="username" class="form-control" required placeholder="admin">
                            </div>
                            <div class="mb-4 text-start">
                                <label class="form-label small fw-bold">Secret Password</label>
                                <input type="password" name="password" class="form-control" required placeholder="••••••••">
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Authenticate Security Key</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>