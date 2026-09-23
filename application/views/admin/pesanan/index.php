<?php $this->load->view('layouts/admin_header'); ?>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h3 class="font-serif fw-bold text-burgundy mb-1">Daftar Pesanan Masuk</h3>
        <p class="text-muted small mb-0">Kelola dan konfirmasi permintaan reservasi dari calon pengantin.</p>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
    <div class="card-body p-0">
        <?php if (!empty($orders)): ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small text-uppercase text-muted">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Pemesan</th>
                            <th>Paket Pernikahan</th>
                            <th>Tgl. Acara</th>
                            <th>Status</th>
                            <th>Diproses Oleh</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $ord): ?>
                            <tr>
                                <td class="ps-4 fw-bold">#<?= $ord->order_id ?></td>
                                <td>
                                    <div class="fw-bold text-dark"><?= html_escape($ord->name) ?></div>
                                    <div class="text-muted small"><?= html_escape($ord->phone_number) ?> &bull; <?= html_escape($ord->email) ?></div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-burgundy"><?= html_escape($ord->package_name ? $ord->package_name : '-') ?></div>
                                    <?php if ($ord->price): ?>
                                        <div class="text-muted small">Rp <?= number_format($ord->price, 0, ',', '.') ?></div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div><i class="bi bi-calendar-event me-1 text-muted"></i> <?= date('d M Y', strtotime($ord->wedding_date)) ?></div>
                                    <div class="text-muted small">Diajukan: <?= date('d/m/Y H:i', strtotime($ord->created_at)) ?></div>
                                </td>
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
                                <td class="text-muted small">
                                    <?= html_escape($ord->approved_by_name ? $ord->approved_by_name : '-') ?>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="<?= base_url('admin/pesanan/detail/' . $ord->order_id) ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                        <i class="bi bi-eye me-1"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-5 text-muted">
                <i class="bi bi-card-checklist fs-1 opacity-50"></i>
                <h5 class="mt-2 mb-1">Belum Ada Pesanan Masuk</h5>
                <p class="small text-muted mb-0">Pesanan dari form website calon pengantin akan otomatis tampil di sini.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php $this->load->view('layouts/admin_footer'); ?>
