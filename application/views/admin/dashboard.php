<?php $this->load->view('layouts/admin_header'); ?>

<!-- Greeting & Action Buttons -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h3 class="font-serif fw-bold text-burgundy mb-1">Selamat Datang, <?= html_escape($admin_name) ?>!</h3>
        <p class="text-muted small mb-0">Berikut adalah ringkasan performa dan aktivitas wedding organizer hari ini.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= base_url('admin/katalog/tambah') ?>" class="btn btn-burgundy rounded-pill btn-sm px-3 shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Katalog
        </a>
        <a href="<?= base_url('admin/pesanan') ?>" class="btn btn-outline-secondary rounded-pill btn-sm px-3 bg-white">
            <i class="bi bi-card-checklist me-1"></i> Lihat Pesanan
        </a>
    </div>
</div>

<!-- 4 Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card card-stat p-3 bg-white h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold text-uppercase">Total Paket</span>
                    <h2 class="fw-bold mt-2 mb-0 text-dark"><?= $count_catalogues ?></h2>
                </div>
                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; color: #6B1E3B;">
                    <i class="bi bi-box-seam fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card card-stat p-3 bg-white h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold text-uppercase">Dipublikasikan</span>
                    <h2 class="fw-bold mt-2 mb-0 text-primary"><?= $count_published ?></h2>
                </div>
                <div class="rounded-circle bg-light-subtle d-flex align-items-center justify-content-center text-primary" style="width: 50px; height: 50px;">
                    <i class="bi bi-check-circle fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card card-stat p-3 bg-white h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold text-uppercase">Pesanan Request</span>
                    <h2 class="fw-bold mt-2 mb-0 text-warning"><?= $count_requested ?></h2>
                </div>
                <div class="rounded-circle bg-warning-subtle d-flex align-items-center justify-content-center text-warning" style="width: 50px; height: 50px;">
                    <i class="bi bi-clock-history fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card card-stat p-3 bg-white h-100">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-semibold text-uppercase">Pesanan Disetujui</span>
                    <h2 class="fw-bold mt-2 mb-0 text-success"><?= $count_approved ?></h2>
                </div>
                <div class="rounded-circle bg-success-subtle d-flex align-items-center justify-content-center text-success" style="width: 50px; height: 50px;">
                    <i class="bi bi-patch-check fs-3"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders Table Card -->
<div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
    <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center border-bottom">
        <h6 class="font-serif fw-bold mb-0 text-burgundy"><i class="bi bi-clock-history me-2"></i> Pesanan Terbaru</h6>
        <a href="<?= base_url('admin/pesanan') ?>" class="text-decoration-none small fw-semibold text-burgundy">
            Lihat Semua Pesanan <i class="bi bi-arrow-right"></i>
        </a>
    </div>
    <div class="card-body p-0">
        <?php if (!empty($recent_orders)): ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small text-uppercase text-muted">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Nama Pemesan</th>
                            <th>Paket Pernikahan</th>
                            <th>Tgl. Pernikahan</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_orders as $ord): ?>
                            <tr>
                                <td class="ps-4 fw-bold">#<?= $ord->order_id ?></td>
                                <td>
                                    <div class="fw-semibold"><?= html_escape($ord->name) ?></div>
                                    <div class="text-muted small"><?= html_escape($ord->phone_number) ?></div>
                                </td>
                                <td><?= html_escape($ord->package_name ? $ord->package_name : '-') ?></td>
                                <td><?= date('d M Y', strtotime($ord->wedding_date)) ?></td>
                                <td>
                                    <?php if ($ord->status === 'approved'): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill">
                                            <i class="bi bi-check2 me-1"></i> Disetujui
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-1 rounded-pill">
                                            <i class="bi bi-hourglass-split me-1"></i> Request
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="<?= base_url('admin/pesanan/detail/' . $ord->order_id) ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-5 text-muted">
                <i class="bi bi-inbox fs-1 opacity-50"></i>
                <p class="mt-2 mb-0">Belum ada pesanan yang masuk.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php $this->load->view('layouts/admin_footer'); ?>
