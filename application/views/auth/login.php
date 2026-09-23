<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Login Admin - JWP Wedding Organizer' ?></title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-burgundy: #6B1E3B;
            --primary-dark: #4A1227;
            --bg-ivory: #FFF9F5;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-ivory);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .btn-burgundy {
            background-color: var(--primary-burgundy);
            color: #ffffff;
            border-color: var(--primary-burgundy);
            transition: all 0.3s ease;
        }

        .btn-burgundy:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(107, 30, 59, 0.25);
        }

        .login-card {
            border: 1px solid rgba(107, 30, 59, 0.12);
            border-radius: 1.5rem;
            box-shadow: 0 15px 35px rgba(107, 30, 59, 0.08);
            background: #ffffff;
            width: 100%;
            max-width: 440px;
        }
    </style>
</head>
<body>

<div class="container p-3">
    <div class="login-card mx-auto p-4 p-md-5">
        <div class="text-center mb-4">
            <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px; color: #6B1E3B;">
                <i class="bi bi-shield-lock-fill fs-2"></i>
            </div>
            <h3 class="font-serif fw-bold" style="color: #6B1E3B;">Panel Administrator</h3>
            <p class="text-muted small">Silakan masuk untuk mengelola katalog, pesanan, dan website</p>
        </div>

        <!-- Alert Flash Messages -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show small py-2" role="alert">
                <i class="bi bi-check-circle me-1"></i> <?= $this->session->flashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show small py-2" role="alert">
                <i class="bi bi-exclamation-circle me-1"></i> <?= $this->session->flashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?= form_open('auth/login') ?>
            <div class="mb-3">
                <label for="username" class="form-label small fw-semibold">Username</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted"><i class="bi bi-person"></i></span>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" required autofocus value="<?= set_value('username') ?>">
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label small fw-semibold">Kata Sandi</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted"><i class="bi bi-key"></i></span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan kata sandi" required>
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-burgundy w-100 py-2 rounded-pill fw-bold mb-3 shadow-sm">
                <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
            </button>

            <div class="text-center pt-2 border-top">
                <a href="<?= base_url() ?>" class="text-decoration-none small text-muted">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Website
                </a>
            </div>
        <?= form_close() ?>
    </div>
</div>

<!-- Bootstrap 5 JS & Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('bi-eye');
            eyeIcon.classList.add('bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('bi-eye-slash');
            eyeIcon.classList.add('bi-eye');
        }
    });
</script>

</body>
</html>
