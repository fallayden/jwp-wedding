<!-- Sidebar Component -->
<div class="sidebar-wrapper d-flex flex-column" id="adminSidebar">
    <a href="<?= base_url('admin/dashboard') ?>" class="sidebar-brand">
        <i class="bi bi-gem text-warning fs-4 me-2"></i>
        <span class="font-serif">JWP Wedding</span>
    </a>

    <ul class="sidebar-nav flex-grow-1">
        <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(2) == 'dashboard' || $this->uri->segment(2) == '' ? 'active' : '' ?>" href="<?= base_url('admin/dashboard') ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(2) == 'katalog' ? 'active' : '' ?>" href="<?= base_url('admin/katalog') ?>">
                <i class="bi bi-box-seam"></i> Katalog Paket
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(2) == 'pesanan' ? 'active' : '' ?>" href="<?= base_url('admin/pesanan') ?>">
                <i class="bi bi-card-checklist"></i> Daftar Pesanan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(2) == 'laporan' ? 'active' : '' ?>" href="<?= base_url('admin/laporan') ?>">
                <i class="bi bi-graph-up-arrow"></i> Laporan Pesanan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(2) == 'pengaturan' ? 'active' : '' ?>" href="<?= base_url('admin/pengaturan') ?>">
                <i class="bi bi-sliders"></i> Profil & Pengaturan
            </a>
        </li>
    </ul>

    <div class="p-3 border-top border-secondary">
        <button type="button" class="btn btn-outline-light w-100 rounded-pill btn-sm py-2 d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#logoutModal">
            <i class="bi bi-box-arrow-right me-2"></i> Keluar (Logout)
        </button>
    </div>
</div>
