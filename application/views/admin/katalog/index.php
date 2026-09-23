<?php $this->load->view('layouts/admin_header'); ?>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h3 class="font-serif fw-bold text-burgundy mb-1">Manajemen Katalog Paket</h3>
        <p class="text-muted small mb-0">Kelola daftar paket pernikahan yang ditawarkan kepada calon pengantin.</p>
    </div>
    <div>
        <a href="<?= base_url('admin/katalog/tambah') ?>" class="btn btn-burgundy rounded-pill px-3 shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Paket Baru
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
    <div class="card-body p-0">
        <?php if (!empty($catalogues)): ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small text-uppercase text-muted">
                        <tr>
                            <th class="ps-4" style="width: 80px;">Gambar</th>
                            <th>Nama Paket</th>
                            <th>Harga</th>
                            <th>Publikasi</th>
                            <th>Dibuat Oleh</th>
                            <th class="text-end pe-4" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($catalogues as $cat): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="rounded-3 overflow-hidden" style="width: 60px; height: 60px; background-color: #f1e6eb;">
                                        <?php if (!empty($cat->image) && file_exists('./uploads/catalogues/' . $cat->image)): ?>
                                            <img src="<?= base_url('uploads/catalogues/' . $cat->image) ?>" class="w-100 h-100 object-fit-cover" alt="Foto">
                                        <?php else: ?>
                                            <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                                <i class="bi bi-card-image text-burgundy opacity-50"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?= html_escape($cat->package_name) ?></div>
                                    <div class="text-muted small text-truncate" style="max-width: 320px;">
                                        <?= strip_tags($cat->description) ?>
                                    </div>
                                </td>
                                <td class="fw-semibold">
                                    Rp <?= number_format($cat->price, 0, ',', '.') ?>
                                </td>
                                <td>
                                    <?php if ($cat->status_publish === 'Y'): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill">
                                            <i class="bi bi-eye me-1"></i> Aktif (Y)
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-3 py-1 rounded-pill">
                                            <i class="bi bi-eye-slash me-1"></i> Nonaktif (N)
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-muted small">
                                    <?= html_escape($cat->creator_name ? $cat->creator_name : 'Admin') ?>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        <a href="<?= base_url('admin/katalog/ubah/' . $cat->catalogue_id) ?>" class="btn btn-sm btn-outline-primary" title="Ubah">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $cat->catalogue_id ?>" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade text-start" id="deleteModal<?= $cat->catalogue_id ?>" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered modal-sm">
                                            <div class="modal-content border-0 shadow rounded-4 text-center p-3">
                                                <div class="modal-body py-4">
                                                    <div class="rounded-circle bg-danger-subtle text-danger d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                                        <i class="bi bi-trash3 fs-3"></i>
                                                    </div>
                                                    <h5 class="fw-bold mb-2">Hapus Paket?</h5>
                                                    <p class="text-muted small mb-4">
                                                        Paket <strong>"<?= html_escape($cat->package_name) ?>"</strong> akan dihapus permanen beserta fotonya.
                                                    </p>
                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                                                        <a href="<?= base_url('admin/katalog/hapus/' . $cat->catalogue_id) ?>" class="btn btn-danger rounded-pill px-3">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-5 text-muted">
                <i class="bi bi-box-seam fs-1 opacity-50"></i>
                <h5 class="mt-2 mb-1">Belum Ada Katalog Paket</h5>
                <p class="small text-muted mb-3">Silakan tambahkan paket pernikahan pertama Anda.</p>
                <a href="<?= base_url('admin/katalog/tambah') ?>" class="btn btn-burgundy rounded-pill btn-sm px-4">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Paket
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php $this->load->view('layouts/admin_footer'); ?>
