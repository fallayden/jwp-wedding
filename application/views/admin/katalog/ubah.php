<?php $this->load->view('layouts/admin_header'); ?>

<div class="mb-4">
    <a href="<?= base_url('admin/katalog') ?>" class="text-decoration-none small text-muted">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Katalog
    </a>
    <h3 class="font-serif fw-bold text-burgundy mt-2 mb-1">Ubah Paket Katalog</h3>
    <p class="text-muted small mb-0">Perbarui data atau foto untuk paket: <strong><?= html_escape($catalogue->package_name) ?></strong></p>
</div>

<div class="card border-0 shadow-sm rounded-4 bg-white p-4 p-md-5">
    <?= form_open_multipart('admin/katalog/ubah/' . $catalogue->catalogue_id) ?>
        <div class="row g-4">
            <div class="col-md-8">
                <div class="mb-3">
                    <label for="package_name" class="form-label fw-semibold">Nama Paket Pernikahan <span class="text-danger">*</span></label>
                    <input type="text" name="package_name" id="package_name" class="form-control" required value="<?= set_value('package_name', $catalogue->package_name) ?>">
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="price" class="form-label fw-semibold">Harga Paket (Rp) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="price" id="price" class="form-control" min="0" required value="<?= set_value('price', $catalogue->price) ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="status_publish" class="form-label fw-semibold">Status Publikasi <span class="text-danger">*</span></label>
                        <select name="status_publish" id="status_publish" class="form-select" required>
                            <option value="Y" <?= set_select('status_publish', 'Y', $catalogue->status_publish === 'Y') ?>>Aktif / Publikasikan (Y)</option>
                            <option value="N" <?= set_select('status_publish', 'N', $catalogue->status_publish === 'N') ?>>Nonaktif / Draf (N)</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Deskripsi & Fasilitas Paket <span class="text-danger">*</span></label>
                    <textarea name="description" id="description" rows="7" class="form-control" required><?= set_value('description', $catalogue->description) ?></textarea>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-light border p-3 rounded-4 mb-3">
                    <label for="image" class="form-label fw-semibold">Foto Paket</label>
                    <input type="file" name="image" id="image" class="form-control mb-2" accept="image/*" onchange="previewImage(this)">
                    <div class="small text-muted mb-3">Pilih file baru jika ingin mengganti foto (Maks: 5 MB).</div>
                    
                    <div class="rounded-3 border overflow-hidden d-flex align-items-center justify-content-center bg-white" style="height: 200px;">
                        <?php if (!empty($catalogue->image) && file_exists('./uploads/catalogues/' . $catalogue->image)): ?>
                            <img id="imgPreview" src="<?= base_url('uploads/catalogues/' . $catalogue->image) ?>" alt="Current" class="w-100 h-100 object-fit-cover">
                            <div id="imgPlaceholder" class="d-none text-center text-muted">
                                <i class="bi bi-image fs-1 opacity-50"></i>
                            </div>
                        <?php else: ?>
                            <img id="imgPreview" src="#" alt="Preview" class="w-100 h-100 object-fit-cover d-none">
                            <div id="imgPlaceholder" class="text-center text-muted">
                                <i class="bi bi-image fs-1 opacity-50"></i>
                                <div class="small mt-1">Belum ada foto</div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-burgundy py-2 rounded-pill fw-semibold shadow-sm">
                        <i class="bi bi-check2-circle me-1"></i> Simpan Perubahan
                    </button>
                    <a href="<?= base_url('admin/katalog') ?>" class="btn btn-light py-2 rounded-pill">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    <?= form_close() ?>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('imgPreview');
        const placeholder = document.getElementById('imgPlaceholder');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none');
                if (placeholder) placeholder.classList.add('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<?php $this->load->view('layouts/admin_footer'); ?>
