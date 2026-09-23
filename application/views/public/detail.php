<?php $this->load->view('layouts/header'); ?>

<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>" class="text-burgundy text-decoration-none">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Paket</li>
            <li class="breadcrumb-item active" aria-current="page"><?= html_escape($catalogue->package_name) ?></li>
        </ol>
    </nav>

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

    <div class="row g-4">
        <!-- Kolom Kiri: Informasi Paket -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white">
                <div style="height: 380px; background-color: #f1e6eb;" class="position-relative">
                    <?php if (!empty($catalogue->image) && file_exists('./uploads/catalogues/' . $catalogue->image)): ?>
                        <img src="<?= base_url('uploads/catalogues/' . $catalogue->image) ?>" class="w-100 h-100 object-fit-cover" alt="<?= html_escape($catalogue->package_name) ?>">
                    <?php else: ?>
                        <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                            <i class="bi bi-card-image fs-1 text-burgundy opacity-50"></i>
                            <span class="mt-2">Foto Paket Pernikahan</span>
                        </div>
                    <?php endif; ?>
                    <span class="position-absolute top-0 end-0 m-3 badge bg-burgundy px-3 py-2 rounded-pill shadow-sm">
                        <i class="bi bi-check-circle me-1"></i> Tersedia
                    </span>
                </div>

                <div class="card-body p-4 p-md-5">
                    <span class="badge bg-light text-burgundy border px-3 py-2 rounded-pill fw-semibold mb-2">Paket Wedding Pilihan</span>
                    <h2 class="font-serif fw-bold text-burgundy mb-2"><?= html_escape($catalogue->package_name) ?></h2>
                    <div class="display-6 fw-bold text-dark mb-4">
                        Rp <?= number_format($catalogue->price, 0, ',', '.') ?>
                    </div>

                    <h5 class="fw-bold font-serif text-dark border-bottom pb-2 mb-3">Deskripsi & Fasilitas Paket</h5>
                    <div class="text-secondary leading-relaxed mb-4">
                        <?= nl2br(html_escape($catalogue->description)) ?>
                    </div>

                    <div class="p-3 bg-light rounded-3 border">
                        <div class="row g-3 small">
                            <div class="col-sm-6 d-flex align-items-center">
                                <i class="bi bi-check2-circle text-success fs-5 me-2"></i> Konsultasi Konsep Acara
                            </div>
                            <div class="col-sm-6 d-flex align-items-center">
                                <i class="bi bi-check2-circle text-success fs-5 me-2"></i> Koordinasi Vendor & Rundown
                            </div>
                            <div class="col-sm-6 d-flex align-items-center">
                                <i class="bi bi-check2-circle text-success fs-5 me-2"></i> Tim Wedding Organizer Hari H
                            </div>
                            <div class="col-sm-6 d-flex align-items-center">
                                <i class="bi bi-check2-circle text-success fs-5 me-2"></i> Pendampingan Pengantin & Keluarga
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Form Pemesanan -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white sticky-top" style="top: 90px;">
                <div class="text-center mb-4">
                    <div class="rounded-circle bg-light text-burgundy d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px;">
                        <i class="bi bi-calendar2-heart fs-4"></i>
                    </div>
                    <h4 class="font-serif fw-bold text-burgundy mb-1">Form Pemesanan Paket</h4>
                    <p class="text-muted small">Kirim permintaan reservasi Anda tanpa perlu membuat akun</p>
                </div>

                <?= form_open('pesan') ?>
                    <input type="hidden" name="catalogue_id" value="<?= $catalogue->catalogue_id ?>">

                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted">Paket Terpilih</label>
                        <input type="text" class="form-control bg-light" value="<?= html_escape($catalogue->package_name) ?> (Rp <?= number_format($catalogue->price, 0, ',', '.') ?>)" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label small fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Contoh: Rian & Anisa" required value="<?= set_value('name') ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label small fw-semibold">Alamat Email <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" id="email" class="form-control" placeholder="email@contoh.com" required value="<?= set_value('email') ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label small fw-semibold">Nomor WhatsApp / Telepon <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-whatsapp"></i></span>
                            <input type="tel" name="phone_number" id="phone_number" class="form-control" placeholder="0812xxxxxxxx" required value="<?= set_value('phone_number') ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="wedding_date" class="form-label small fw-semibold">Rencana Tanggal Pernikahan <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-calendar-event"></i></span>
                            <input type="date" name="wedding_date" id="wedding_date" class="form-control" required min="<?= date('Y-m-d') ?>" value="<?= set_value('wedding_date') ?>">
                        </div>
                    </div>

                    <div class="alert alert-warning py-2 px-3 small border-0 d-flex align-items-center mb-4">
                        <i class="bi bi-info-circle-fill me-2 fs-5 text-warning"></i>
                        <div>Permintaan baru otomatis berstatus <strong>Request</strong>. Tim kami akan menghubungi Anda untuk konfirmasi.</div>
                    </div>

                    <button type="submit" class="btn btn-burgundy w-100 py-3 rounded-pill fw-bold shadow-sm">
                        <i class="bi bi-send-fill me-1"></i> Kirim Permintaan Pemesanan
                    </button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('layouts/footer'); ?>
