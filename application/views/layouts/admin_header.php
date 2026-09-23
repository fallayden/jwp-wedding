<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Panel Admin - JWP Wedding Organizer' ?></title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --admin-sidebar-bg: #4A1227;
            --admin-sidebar-hover: #601833;
            --primary-burgundy: #6B1E3B;
            --bg-canvas: #f8f9fa;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-canvas);
            color: #212529;
        }

        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .sidebar-wrapper {
            background-color: var(--admin-sidebar-bg);
            min-height: 100vh;
            color: #ffffff;
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar-brand {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            font-size: 1.15rem;
            font-weight: 700;
            color: #ffffff;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .sidebar-nav {
            padding: 1rem 0;
            list-style: none;
            margin: 0;
        }

        .sidebar-nav .nav-link {
            color: rgba(255,255,255,0.75);
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            font-size: 0.92rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .sidebar-nav .nav-link:hover {
            color: #ffffff;
            background-color: var(--admin-sidebar-hover);
            padding-left: 1.75rem;
        }

        .sidebar-nav .nav-link.active {
            color: #ffffff;
            background-color: #6B1E3B;
            border-left: 4px solid #D4AF37;
            font-weight: 600;
        }

        .sidebar-nav .nav-link i {
            font-size: 1.2rem;
            margin-right: 0.85rem;
        }

        .main-content {
            margin-left: 260px;
            padding: 2rem;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .top-navbar {
            background: #ffffff;
            border-radius: 1rem;
            padding: 0.75rem 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-burgundy {
            background-color: var(--primary-burgundy);
            color: #ffffff;
            border-color: var(--primary-burgundy);
        }

        .btn-burgundy:hover {
            background-color: #50142A;
            color: #ffffff;
        }

        .card-stat {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            transition: transform 0.2s;
        }

        .card-stat:hover {
            transform: translateY(-3px);
        }

        @media (max-width: 991.98px) {
            .sidebar-wrapper {
                margin-left: -260px;
                transition: margin 0.3s ease;
            }
            .sidebar-wrapper.show {
                margin-left: 0;
            }
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <?php $this->load->view('layouts/admin_sidebar'); ?>

    <!-- Main Content Area -->
    <div class="main-content flex-grow-1">
        <!-- Top Navigation Bar -->
        <div class="top-navbar">
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-outline-secondary d-lg-none me-2" id="sidebarToggle">
                    <i class="bi bi-list fs-5"></i>
                </button>
                <h5 class="font-serif fw-bold text-burgundy mb-0 d-none d-sm-block">
                    <?= isset($title) ? $title : 'Panel Admin' ?>
                </h5>
            </div>

            <div class="d-flex align-items-center gap-3">
                <a href="<?= base_url() ?>" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill px-3" title="Buka Website">
                    <i class="bi bi-globe me-1"></i> <span class="d-none d-md-inline">Lihat Web</span>
                </a>
                <div class="dropdown">
                    <button class="btn btn-sm btn-light border rounded-pill dropdown-toggle d-flex align-items-center px-3 py-1" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle fs-5 me-2 text-burgundy"></i>
                        <span class="fw-semibold small"><?= $this->session->userdata('name') ? $this->session->userdata('name') : 'Admin' ?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                        <li><a class="dropdown-item small" href="<?= base_url('admin/pengaturan') ?>"><i class="bi bi-person-gear me-2"></i> Profil & Pengaturan</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <button type="button" class="dropdown-item small text-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> <?= $this->session->flashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $this->session->flashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
