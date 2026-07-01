<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StaffHub Employee Directory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= base_url('employees') ?>">
                <img src="<?= base_url('logo.png') ?>" alt="Logo" width="30" height="30" class="d-inline-block align-text-top me-2">
                StaffHub
            </a>
            <?php if (session()->get('isLoggedIn')): ?>
                <span class="navbar-text">
                    Logged in as <strong><?= esc(session()->get('username')) ?></strong> | 
                    <a href="<?= base_url('auth/logout') ?>" class="text-danger ms-2 text-decoration-none">🔓 Logout</a>
                </span>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>