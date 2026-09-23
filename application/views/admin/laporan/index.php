<?php $this->load->view('layouts/admin_header'); ?>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h3 class="font-serif fw-bold text-burgundy mb-1">Laporan Pesanan per Paket</h3>
        <p class="text-muted small mb-0">Rekapitulasi akumulasi jumlah pesanan masuk untuk setiap paket wedding.</p>
    </div>
    <div>
        <button type="button" onclick="window.print()" class="btn btn-outline-secondary bg-white rounded-pill px-3 shadow-sm">
            <i class="bi bi-printer me-1"></i> Cetak Laporan
        </button>
    </div>
</div>

<!-- 3 Ringkasan Angka -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card card-stat p-3 bg-white">
            <span class="text-muted small fw-semibold text-uppercase">Total Akumulasi Pesanan</span>
            <h2 class="fw-bold mt-2 mb-0 text-dark"><?= $total_orders ?></h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stat p-3 bg-white">
            <span class="text-muted small fw-semibold text-uppercase">Total Disetujui (Approved)</span>
            <h2 class="fw-bold mt-2 mb-0 text-success"><?= $total_approved ?></h2>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stat p-3 bg-white">
            <span class="text-muted small fw-semibold text-uppercase">Total Menunggu (Request)</span>
            <h2 class="fw-bold mt-2 mb-0 text-warning"><?= $total_requested ?></h2>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden" id="reportArea">
    <div class="card-header bg-white py-3 px-4 border-bottom">
        <h6 class="font-serif fw-bold text-burgundy mb-0">Tabel Rekapitulasi Pesanan Paket Pernikahan</h6>
    </div>
    <div class="card-body p-0">
        <?php if (!empty($reports)): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-light small text-uppercase text-muted">
                        <tr>
                            <th class="text-center" style="width: 50px;">No</th>
                            <th>Nama Paket Pernikahan</th>
                            <th>Harga Paket</th>
                            <th class="text-center bg-light-subtle">Total Pesanan</th>
                            <th class="text-center text-success">Disetujui</th>
                            <th class="text-center text-warning">Request</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($reports as $rep): ?>
                            <tr>
                                <td class="text-center fw-bold"><?= $no++ ?></td>
                                <td class="fw-semibold text-dark"><?= html_escape($rep->package_name) ?></td>
                                <td>Rp <?= number_format($rep->price, 0, ',', '.') ?></td>
                                <td class="text-center fw-bold fs-6 bg-light-subtle"><?= $rep->total_order ?></td>
                                <td class="text-center fw-semibold text-success"><?= $rep->total_approved ?></td>
                                <td class="text-center fw-semibold text-warning"><?= $rep->total_requested ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-5 text-muted">
                <i class="bi bi-graph-up-arrow fs-1 opacity-50"></i>
                <p class="mt-2 mb-0">Belum ada data paket atau pesanan yang tercatat.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
@media print {
    .sidebar-wrapper, .top-navbar, .btn, .d-flex.justify-content-between {
        display: none !important;
    }
    .main-content {
        margin-left: 0 !important;
        padding: 0 !important;
    }
    .card {
        box-shadow: none !important;
        border: 1px solid #ddd !important;
    }
}
</style>

<?php $this->load->view('layouts/admin_footer'); ?>
