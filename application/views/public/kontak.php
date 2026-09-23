<?php $this->load->view('layouts/header'); ?>

<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>" class="text-burgundy text-decoration-none">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kontak Kami</li>
        </ol>
    </nav>

    <!-- Header Title -->
    <div class="text-center mb-5">
        <h6 class="text-burgundy fw-bold text-uppercase tracking-wider">Hubungi Kami</h6>
        <h1 class="font-serif fw-bold display-6">Mari Wujudkan Hari Istimewa Anda</h1>
        <p class="text-muted">Silakan hubungi kami untuk informasi paket, konsultasi konsep, atau kunjungan studio</p>
        <div class="mx-auto bg-burgundy rounded" style="width: 60px; height: 3px;"></div>
    </div>

    <div class="row g-4 mb-5">
        <!-- Telepon -->
        <div class="col-md-6 col-lg-3">
            <div class="card card-custom h-100 p-4 text-center border-0 shadow-sm">
                <div class="rounded-circle bg-light text-burgundy d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-telephone fs-3"></i>
                </div>
                <h5 class="font-serif fw-bold mb-2">Telepon / WhatsApp</h5>
                <p class="text-muted small mb-1"><?= !empty($setting->phone_number1) ? html_escape($setting->phone_number1) : '-' ?></p>
                <?php if (!empty($setting->phone_number2)): ?>
                    <p class="text-muted small mb-0"><?= html_escape($setting->phone_number2) ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Email -->
        <div class="col-md-6 col-lg-3">
            <div class="card card-custom h-100 p-4 text-center border-0 shadow-sm">
                <div class="rounded-circle bg-light text-burgundy d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-envelope fs-3"></i>
                </div>
                <h5 class="font-serif fw-bold mb-2">Email Layanan</h5>
                <p class="text-muted small mb-1"><?= !empty($setting->email1) ? html_escape($setting->email1) : '-' ?></p>
                <?php if (!empty($setting->email2)): ?>
                    <p class="text-muted small mb-0"><?= html_escape($setting->email2) ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Alamat -->
        <div class="col-md-6 col-lg-3">
            <div class="card card-custom h-100 p-4 text-center border-0 shadow-sm">
                <div class="rounded-circle bg-light text-burgundy d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-geo-alt fs-3"></i>
                </div>
                <h5 class="font-serif fw-bold mb-2">Alamat Studio</h5>
                <p class="text-muted small mb-0"><?= !empty($setting->address) ? nl2br(html_escape($setting->address)) : 'Jl. Pengantin No. 1, Jakarta' ?></p>
            </div>
        </div>

        <!-- Jam Kerja -->
        <div class="col-md-6 col-lg-3">
            <div class="card card-custom h-100 p-4 text-center border-0 shadow-sm">
                <div class="rounded-circle bg-light text-burgundy d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-clock fs-3"></i>
                </div>
                <h5 class="font-serif fw-bold mb-2">Jam Operasional</h5>
                <p class="text-muted small mb-1"><strong><?= !empty($setting->header_business_hour) ? html_escape($setting->header_business_hour) : 'Senin - Sabtu' ?></strong></p>
                <p class="text-muted small mb-0"><?= !empty($setting->time_business_hour) ? html_escape($setting->time_business_hour) : '09:00 - 17:00 WIB' ?></p>
            </div>
        </div>
    </div>

    <!-- Peta Lokasi & Media Sosial -->
    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white mb-5">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <h4 class="font-serif fw-bold text-burgundy mb-3">Kunjungi Studio Kami</h4>
                <p class="text-muted mb-4">
                    Kami sangat senang menyambut Anda untuk berkonsultasi langsung mengenai detail konsep dekorasi, pemilihan busana, dan perencanaan acara hari bahagia Anda.
                </p>
                <h6 class="fw-bold mb-3">Ikuti Media Sosial Kami:</h6>
                <div class="d-flex gap-2">
                    <?php if (!empty($setting->facebook_url)): ?>
                        <a href="<?= html_escape($setting->facebook_url) ?>" target="_blank" class="btn btn-outline-burgundy rounded-pill px-3">
                            <i class="bi bi-facebook me-1"></i> Facebook
                        </a>
                    <?php endif; ?>
                    <?php if (!empty($setting->instagram_url)): ?>
                        <a href="<?= html_escape($setting->instagram_url) ?>" target="_blank" class="btn btn-outline-burgundy rounded-pill px-3">
                            <i class="bi bi-instagram me-1"></i> Instagram
                        </a>
                    <?php endif; ?>
                    <?php if (!empty($setting->youtube_url)): ?>
                        <a href="<?= html_escape($setting->youtube_url) ?>" target="_blank" class="btn btn-outline-burgundy rounded-pill px-3">
                            <i class="bi bi-youtube me-1"></i> YouTube
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="rounded-4 overflow-hidden shadow-sm" style="min-height: 280px; background-color: #f8f9fa;">
                    <?php if (!empty($setting->maps) && (strpos($setting->maps, '<iframe') !== false)): ?>
                        <?= $setting->maps ?>
                    <?php else: ?>
                        <div class="p-5 text-center d-flex flex-column align-items-center justify-content-center h-100 text-muted">
                            <i class="bi bi-map fs-1 text-burgundy opacity-50 mb-2"></i>
                            <h6 class="font-serif fw-bold">Peta Lokasi Studio</h6>
                            <p class="small text-muted mb-0"><?= !empty($setting->address) ? html_escape($setting->address) : 'Jl. Pengantin No. 1, Jakarta' ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('layouts/footer'); ?>
