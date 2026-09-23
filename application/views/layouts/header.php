<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'JWP Wedding Organizer' ?></title>

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
            --accent-mauve: #A64D79;
            --accent-gold: #D4AF37;
            --bg-ivory: #FFF9F5;
            --text-dark: #212529;
            --text-muted: #6c757d;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-ivory);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        h1, h2, h3, h4, .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .bg-burgundy {
            background-color: var(--primary-burgundy) !important;
        }

        .text-burgundy {
            color: var(--primary-burgundy) !important;
        }

        .btn-burgundy {
            background-color: var(--primary-burgundy);
            color: #ffffff;
            border-color: var(--primary-burgundy);
            transition: all 0.3s ease;
        }

        .btn-burgundy:hover, .btn-burgundy:focus {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(107, 30, 59, 0.25);
        }

        .btn-outline-burgundy {
            color: var(--primary-burgundy);
            border-color: var(--primary-burgundy);
            transition: all 0.3s ease;
        }

        .btn-outline-burgundy:hover {
            background-color: var(--primary-burgundy);
            color: #ffffff;
        }

        .navbar-custom {
            background-color: #ffffff;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        }

        .navbar-custom .nav-link {
            color: #495057;
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: color 0.2s ease;
        }

        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            color: var(--primary-burgundy);
            font-weight: 600;
        }

        .hero-banner {
            background: linear-gradient(135deg, rgba(107, 30, 59, 0.95), rgba(74, 18, 39, 0.88)), url('https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
            color: white;
            padding: 5rem 0;
            border-radius: 0 0 2rem 2rem;
        }

        .card-custom {
            border: 1px solid rgba(107, 30, 59, 0.1);
            border-radius: 1rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: #ffffff;
            overflow: hidden;
        }

        .card-custom:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(107, 30, 59, 0.12);
        }

        .footer-custom {
            background-color: #2b0b18;
            color: #d1c1c7;
            margin-top: auto;
        }

        .badge-requested {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }

        .badge-approved {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>

<!-- Navigation Header -->
<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="<?= base_url() ?>">
            <?php if (!empty($setting->logo) && file_exists('./uploads/logo/' . $setting->logo)): ?>
                <img src="<?= base_url('uploads/logo/' . $setting->logo) ?>" alt="Logo" height="42" class="me-2">
            <?php else: ?>
                <i class="bi bi-gem text-burgundy fs-3 me-2"></i>
            <?php endif; ?>
            <span class="font-serif fw-bold fs-4 text-burgundy">
                <?= !empty($setting->website_name) ? html_escape($setting->website_name) : 'JWP Wedding' ?>
            </span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(1) == '' || $this->uri->segment(1) == 'home' ? 'active' : '' ?>" href="<?= base_url() ?>">
                        <i class="bi bi-house-door me-1"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(1) == 'kontak' ? 'active' : '' ?>" href="<?= base_url('kontak') ?>">
                        <i class="bi bi-telephone me-1"></i> Kontak Kami
                    </a>
                </li>
                <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                    <a class="btn btn-outline-burgundy btn-sm px-3 rounded-pill" href="<?= base_url('login') ?>">
                        <i class="bi bi-lock me-1"></i> Login Admin
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
