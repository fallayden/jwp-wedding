<?php $this->load->view('layouts/header'); ?>

<!-- Hero Section -->
<section class="hero-banner">
    <div class="container text-center py-5">
        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-semibold mb-3">
            <i class="bi bi-stars me-1"></i> Wujudkan Pernikahan Impian Anda
        </span>
        <h1 class="display-4 fw-bold font-serif mb-3">
            Momen Bahagia, Kenangan Abadi Bersama Kami
        </h1>
        <p class="lead max-w-700 mx-auto text-white-50 mb-4 px-md-5">
            Kami hadir untuk membantu Anda merancang, mengatur, dan mewujudkan hari pernikahan yang sempurna dengan pilihan paket terlengkap dan layanan profesional.
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="#katalog" class="btn btn-warning btn-lg px-4 rounded-pill fw-semibold shadow">
                <i class="bi bi-box-seam me-1"></i> Pilih Paket
            </a>
            <a href="<?= base_url('kontak') ?>" class="btn btn-outline-light btn-lg px-4 rounded-pill fw-semibold">
                <i class="bi bi-chat-dots me-1"></i> Konsultasi Gratis
            </a>
        </div>
    </div>
</section>

<!-- Flash Message -->
<div class="container mt-4">
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
</div>

<!-- Section Katalog Paket -->
<section id="katalog" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-burgundy fw-bold text-uppercase tracking-wider">Katalog Pilihan</h6>
            <h2 class="font-serif fw-bold display-6">Paket Pernikahan Terbaik</h2>
            <p class="text-muted">Pilih paket yang sesuai dengan konsep dan anggaran hari bahagia Anda</p>
            <div class="mx-auto bg-burgundy rounded" style="width: 60px; height: 3px;"></div>
        </div>

        <?php if (!empty($catalogues)): ?>
            <div class="row g-4">
                <?php foreach ($catalogues as $pkg): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-custom h-100 shadow-sm d-flex flex-column">
                            <div class="position-relative overflow-hidden" style="height: 240px; background-color: #f1e6eb;">
                                <?php if (!empty($pkg->image) && file_exists('./uploads/catalogues/' . $pkg->image)): ?>
                                    <img src="<?= base_url('uploads/catalogues/' . $pkg->image) ?>" class="w-100 h-100 object-fit-cover" alt="<?= html_escape($pkg->package_name) ?>">
                                <?php else: ?>
                                    <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                                        <i class="bi bi-card-image fs-1 text-burgundy opacity-50"></i>
                                        <span class="small mt-2">Gambar Paket</span>
                                    </div>
                                <?php endif; ?>
                                <span class="position-absolute top-0 end-0 m-3 badge bg-burgundy px-3 py-2 rounded-pill shadow-sm">
                                    <i class="bi bi-check-circle me-1"></i> Tersedia
                                </span>
                            </div>

                            <div class="card-body p-4 d-flex flex-column">
                                <h4 class="font-serif fw-bold text-burgundy mb-2"><?= html_escape($pkg->package_name) ?></h4>
                                <div class="fs-4 fw-bold text-dark mb-3">
                                    Rp <?= number_format($pkg->price, 0, ',', '.') ?>
                                </div>
                                <p class="card-text text-muted small flex-grow-1">
                                    <?= character_limiter(strip_tags($pkg->description), 140) ?>
                                </p>
                                <div class="mt-4 pt-3 border-top">
                                    <a href="<?= base_url('detail-paket/' . $pkg->catalogue_id) ?>" class="btn btn-burgundy w-100 rounded-pill py-2 fw-semibold">
                                        Lihat Detail & Pesan <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-5 bg-white rounded-4 shadow-sm p-4">
                <i class="bi bi-gift fs-1 text-burgundy opacity-50"></i>
                <h5 class="font-serif mt-3">Belum Ada Paket yang Ditampilkan</h5>
                <p class="text-muted small">Paket pernikahan sedang dipersiapkan oleh pihak administrator.</p>
                <a href="<?= base_url('kontak') ?>" class="btn btn-outline-burgundy btn-sm rounded-pill px-4 mt-2">
                    Hubungi Customer Service
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Section Alasan Memilih Kami -->
<section class="py-5 bg-white border-top border-bottom">
    <div class="container">
        <div class="text-center mb-5">
            <h6 class="text-burgundy fw-bold text-uppercase">Keunggulan</h6>
            <h2 class="font-serif fw-bold">Mengapa Memilih Kami?</h2>
        </div>
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-light h-100">
                    <div class="rounded-circle bg-burgundy text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
                        <i class="bi bi-award fs-3"></i>
                    </div>
                    <h5 class="font-serif fw-bold text-burgundy mb-2">Profesional & Berpengalaman</h5>
                    <p class="text-muted small mb-0">Tim wedding planner berpengalaman yang siap mengawal setiap detail acara Anda dari persiapan hingga resepsi.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-light h-100">
                    <div class="rounded-circle bg-burgundy text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
                        <i class="bi bi-sliders fs-3"></i>
                    </div>
                    <h5 class="font-serif fw-bold text-burgundy mb-2">Paket Fleksibel & Transparan</h5>
                    <p class="text-muted small mb-0">Berbagai variasi paket pernikahan dapat disesuaikan dengan kebutuhan, konsep impian, dan anggaran tanpa biaya tersembunyi.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 rounded-4 bg-light h-100">
                    <div class="rounded-circle bg-burgundy text-white d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
                        <i class="bi bi-heart fs-3"></i>
                    </div>
                    <h5 class="font-serif fw-bold text-burgundy mb-2">Pelayanan Sepenuh Hati</h5>
                    <p class="text-muted small mb-0">Kepuasan dan kebahagiaan pasangan pengantin serta keluarga adalah prioritas utama dari setiap layanan kami.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('layouts/footer'); ?>
