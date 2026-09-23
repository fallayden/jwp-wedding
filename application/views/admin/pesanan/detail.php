<?php $this->load->view('layouts/admin_header'); ?>

<div class="mb-4">
    <a href="<?= base_url('admin/pesanan') ?>" class="text-decoration-none small text-muted">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Pesanan
    </a>
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mt-2">
        <h3 class="font-serif fw-bold text-burgundy mb-0">Detail Pesanan #<?= $order->order_id ?></h3>
        <div>
            <?php if ($order->status === 'approved'): ?>
                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill fs-6">
                    <i class="bi bi-check2-all me-1"></i> Status: Disetujui
                </span>
            <?php else: ?>
                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2 rounded-pill fs-6">
                    <i class="bi bi-hourglass-split me-1"></i> Status: Request
                </span>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Informasi Pemesan -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4 bg-white p-4 p-md-5 mb-4">
            <h5 class="font-serif fw-bold text-burgundy mb-4 pb-2 border-bottom">
                <i class="bi bi-person-lines-fill me-2"></i> Data Calon Pengantin
            </h5>

            <div class="row g-3">
                <div class="col-sm-6">
                    <label class="small text-muted fw-semibold">Nama Lengkap</label>
                    <div class="fs-5 fw-bold text-dark"><?= html_escape($order->name) ?></div>
                </div>

                <div class="col-sm-6">
                    <label class="small text-muted fw-semibold">Nomor WhatsApp / Telepon</label>
                    <div class="fs-6 fw-semibold text-dark d-flex align-items-center gap-2 mt-1">
                        <span><?= html_escape($order->phone_number) ?></span>
                        <?php 
                            // Format nomor WA
                            $clean_phone = preg_replace('/[^0-9]/', '', $order->phone_number);
                            if (substr($clean_phone, 0, 1) === '0') {
                                $clean_phone = '62' . substr($clean_phone, 1);
                            }
                        ?>
                        <a href="https://wa.me/<?= $clean_phone ?>?text=Halo%20<?= urlencode($order->name) ?>,%20kami%20dari%20JWP%20Wedding%20Organizer%20mengenai%20pesanan%20paket%20pernikahan%20Anda." target="_blank" class="btn btn-sm btn-success rounded-pill px-2 py-0" title="Hubungi via WhatsApp">
                            <i class="bi bi-whatsapp"></i> Chat
                        </a>
                    </div>
                </div>

                <div class="col-sm-6">
                    <label class="small text-muted fw-semibold">Alamat Email</label>
                    <div class="fs-6 text-dark"><?= html_escape($order->email) ?></div>
                </div>

                <div class="col-sm-6">
                    <label class="small text-muted fw-semibold">Rencana Tanggal Pernikahan</label>
                    <div class="fs-6 fw-bold text-burgundy">
                        <i class="bi bi-calendar-event me-1"></i> <?= date('d F Y', strtotime($order->wedding_date)) ?>
                    </div>
                </div>

                <div class="col-sm-6">
                    <label class="small text-muted fw-semibold">Waktu Pemesanan Masuk</label>
                    <div class="small text-secondary"><?= date('d F Y - H:i', strtotime($order->created_at)) ?> WIB</div>
                </div>

                <div class="col-sm-6">
                    <label class="small text-muted fw-semibold">Disetujui Oleh</label>
                    <div class="small text-secondary"><?= html_escape($order->approved_by_name ? $order->approved_by_name : 'Belum disetujui') ?></div>
                </div>
            </div>

            <!-- Tombol Konfirmasi Approval -->
            <div class="mt-4 pt-4 border-top">
                <?php if ($order->status === 'requested'): ?>
                    <button type="button" class="btn btn-success rounded-pill px-4 py-2 fw-semibold shadow-sm" data-bs-toggle="modal" data-bs-target="#approveModal">
                        <i class="bi bi-check2-circle me-1"></i> Setujui Pesanan Ini
                    </button>
                <?php else: ?>
                    <div class="alert alert-success d-flex align-items-center mb-0 py-2 small">
                        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                        <div>Pesanan ini sudah berstatus <strong>Disetujui</strong>. Jadwal telah dikonfirmasi ke klien.</div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Informasi Paket yang Dipilih -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-4 bg-white p-4 overflow-hidden">
            <h5 class="font-serif fw-bold text-burgundy mb-3 pb-2 border-bottom">
                <i class="bi bi-box-seam me-2"></i> Paket yang Dipesan
            </h5>

            <div class="rounded-3 overflow-hidden mb-3" style="height: 180px; background-color: #f1e6eb;">
                <?php if (!empty($order->catalogue_image) && file_exists('./uploads/catalogues/' . $order->catalogue_image)): ?>
                    <img src="<?= base_url('uploads/catalogues/' . $order->catalogue_image) ?>" class="w-100 h-100 object-fit-cover" alt="Foto">
                <?php else: ?>
                    <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                        <i class="bi bi-card-image fs-1 opacity-50"></i>
                    </div>
                <?php endif; ?>
            </div>

            <h4 class="font-serif fw-bold text-dark mb-1"><?= html_escape($order->package_name ? $order->package_name : '-') ?></h4>
            <div class="fs-4 fw-bold text-burgundy mb-3">
                Rp <?= number_format($order->price, 0, ',', '.') ?>
            </div>

            <a href="<?= base_url('detail-paket/' . $order->catalogue_id) ?>" target="_blank" class="btn btn-outline-burgundy btn-sm rounded-pill w-100">
                <i class="bi bi-arrow-up-right me-1"></i> Lihat Halaman Paket Publik
            </a>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Persetujuan -->
<?php if ($order->status === 'requested'): ?>
<div class="modal fade" id="approveModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow rounded-4 text-center p-3">
            <div class="modal-body py-4">
                <div class="rounded-circle bg-success-subtle text-success d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-patch-check fs-2"></i>
                </div>
                <h5 class="fw-bold mb-2">Setujui Pesanan?</h5>
                <p class="text-muted small mb-4">
                    Status pesanan #<?= $order->order_id ?> atas nama <strong><?= html_escape($order->name) ?></strong> akan diubah menjadi <strong>Disetujui</strong>.
                </p>
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                    <a href="<?= base_url('admin/pesanan/approve/' . $order->order_id) ?>" class="btn btn-success rounded-pill px-3">
                        Ya, Setujui
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php $this->load->view('layouts/admin_footer'); ?>
