<?php $this->load->view('layouts/admin_header'); ?>

<div class="mb-4">
    <h3 class="font-serif fw-bold text-burgundy mb-1">Profil & Pengaturan Website</h3>
    <p class="text-muted small mb-0">Kelola akun administrator dan informasi identitas website wedding organizer.</p>
</div>

<div class="row g-4">
    <!-- Card Profil Admin -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-4 bg-white p-4 h-100">
            <h5 class="font-serif fw-bold text-burgundy mb-4 pb-2 border-bottom">
                <i class="bi bi-person-gear me-2"></i> Akun Administrator
            </h5>

            <?= form_open('admin/pengaturan/update_profil') ?>
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nama Lengkap Admin <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" required value="<?= set_value('name', $admin ? $admin->name : '') ?>">
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label fw-semibold">Username <span class="text-danger">*</span></label>
                    <input type="text" name="username" id="username" class="form-control" required value="<?= set_value('username', $admin ? $admin->username : '') ?>">
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold">Kata Sandi Baru</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
                    <div class="form-text small">Minimal 5 karakter jika ingin mengganti password.</div>
                </div>

                <button type="submit" class="btn btn-burgundy rounded-pill w-100 py-2 fw-semibold shadow-sm">
                    <i class="bi bi-check2-circle me-1"></i> Simpan Profil Admin
                </button>
            <?= form_close() ?>
        </div>
    </div>

    <!-- Card Pengaturan Website -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
            <h5 class="font-serif fw-bold text-burgundy mb-4 pb-2 border-bottom">
                <i class="bi bi-globe me-2"></i> Informasi & Identitas Website
            </h5>

            <?= form_open_multipart('admin/pengaturan/update_website') ?>
                <div class="row g-3 mb-3">
                    <div class="col-md-8">
                        <label for="website_name" class="form-label fw-semibold">Nama Bisnis / Website <span class="text-danger">*</span></label>
                        <input type="text" name="website_name" id="website_name" class="form-control" required value="<?= set_value('website_name', $setting ? $setting->website_name : '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="logo" class="form-label fw-semibold">Logo Website</label>
                        <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
                        <?php if (!empty($setting->logo) && file_exists('./uploads/logo/' . $setting->logo)): ?>
                            <div class="mt-2 text-center p-2 border rounded bg-light">
                                <img src="<?= base_url('uploads/logo/' . $setting->logo) ?>" alt="Logo" style="max-height: 40px;">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="phone_number1" class="form-label fw-semibold">Nomor Telepon / WhatsApp 1</label>
                        <input type="text" name="phone_number1" id="phone_number1" class="form-control" value="<?= set_value('phone_number1', $setting ? $setting->phone_number1 : '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="phone_number2" class="form-label fw-semibold">Nomor Telepon 2 (Alternatif)</label>
                        <input type="text" name="phone_number2" id="phone_number2" class="form-control" value="<?= set_value('phone_number2', $setting ? $setting->phone_number2 : '') ?>">
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="email1" class="form-label fw-semibold">Email Utama</label>
                        <input type="email" name="email1" id="email1" class="form-control" value="<?= set_value('email1', $setting ? $setting->email1 : '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="email2" class="form-label fw-semibold">Email Alternatif</label>
                        <input type="email" name="email2" id="email2" class="form-control" value="<?= set_value('email2', $setting ? $setting->email2 : '') ?>">
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="header_business_hour" class="form-label fw-semibold">Hari Operasional</label>
                        <input type="text" name="header_business_hour" id="header_business_hour" class="form-control" placeholder="Contoh: Senin - Sabtu" value="<?= set_value('header_business_hour', $setting ? $setting->header_business_hour : '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="time_business_hour" class="form-label fw-semibold">Jam Operasional</label>
                        <input type="text" name="time_business_hour" id="time_business_hour" class="form-control" placeholder="Contoh: 09:00 - 17:00 WIB" value="<?= set_value('time_business_hour', $setting ? $setting->time_business_hour : '') ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label fw-semibold">Alamat Kantor / Studio</label>
                    <textarea name="address" id="address" rows="2" class="form-control"><?= set_value('address', $setting ? $setting->address : '') ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="maps" class="form-label fw-semibold">Embed Google Maps (HTML iframe atau Link)</label>
                    <textarea name="maps" id="maps" rows="2" class="form-control" placeholder="Kode embed iframe Google Maps..."><?= set_value('maps', $setting ? $setting->maps : '') ?></textarea>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label for="facebook_url" class="form-label fw-semibold"><i class="bi bi-facebook text-primary me-1"></i> Facebook URL</label>
                        <input type="url" name="facebook_url" id="facebook_url" class="form-control" value="<?= set_value('facebook_url', $setting ? $setting->facebook_url : '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="instagram_url" class="form-label fw-semibold"><i class="bi bi-instagram text-danger me-1"></i> Instagram URL</label>
                        <input type="url" name="instagram_url" id="instagram_url" class="form-control" value="<?= set_value('instagram_url', $setting ? $setting->instagram_url : '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="youtube_url" class="form-label fw-semibold"><i class="bi bi-youtube text-danger me-1"></i> YouTube URL</label>
                        <input type="url" name="youtube_url" id="youtube_url" class="form-control" value="<?= set_value('youtube_url', $setting ? $setting->youtube_url : '') ?>">
                    </div>
                </div>

                <button type="submit" class="btn btn-burgundy rounded-pill w-100 py-2 fw-semibold shadow-sm">
                    <i class="bi bi-save me-1"></i> Simpan Pengaturan Website
                </button>
            <?= form_close() ?>
        </div>
    </div>
</div>

<?php $this->load->view('layouts/admin_footer'); ?>
