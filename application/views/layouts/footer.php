<!-- Footer -->
<footer class="footer-custom pt-5 pb-4 mt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-gem text-warning fs-3 me-2"></i>
                    <h5 class="font-serif fw-bold text-white mb-0">
                        <?= !empty($setting->website_name) ? html_escape($setting->website_name) : 'JWP Wedding Organizer' ?>
                    </h5>
                </div>
                <p class="small text-white-50">
                    Mewujudkan momen pernikahan impian Anda dengan layanan profesional, paket lengkap, dan sentuhan elegan terbaik.
                </p>
                <div class="d-flex gap-3 mt-3">
                    <?php if (!empty($setting->facebook_url)): ?>
                        <a href="<?= html_escape($setting->facebook_url) ?>" target="_blank" class="text-white-50 fs-5"><i class="bi bi-facebook"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($setting->instagram_url)): ?>
                        <a href="<?= html_escape($setting->instagram_url) ?>" target="_blank" class="text-white-50 fs-5"><i class="bi bi-instagram"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($setting->youtube_url)): ?>
                        <a href="<?= html_escape($setting->youtube_url) ?>" target="_blank" class="text-white-50 fs-5"><i class="bi bi-youtube"></i></a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <h6 class="text-white fw-bold mb-3">Kontak & Lokasi</h6>
                <ul class="list-unstyled small text-white-50 mb-0">
                    <li class="mb-2">
                        <i class="bi bi-geo-alt text-warning me-2"></i>
                        <?= !empty($setting->address) ? html_escape($setting->address) : 'Jl. Pengantin No. 1, Jakarta' ?>
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-telephone text-warning me-2"></i>
                        <?= !empty($setting->phone_number1) ? html_escape($setting->phone_number1) : '081234567890' ?>
                        <?= !empty($setting->phone_number2) ? ' / ' . html_escape($setting->phone_number2) : '' ?>
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-envelope text-warning me-2"></i>
                        <?= !empty($setting->email1) ? html_escape($setting->email1) : 'info@jwpwedding.com' ?>
                    </li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-12">
                <h6 class="text-white fw-bold mb-3">Jam Operasional</h6>
                <p class="small text-white-50 mb-1">
                    <strong><?= !empty($setting->header_business_hour) ? html_escape($setting->header_business_hour) : 'Senin - Sabtu' ?></strong>
                </p>
                <p class="small text-white-50 mb-3">
                    <?= !empty($setting->time_business_hour) ? html_escape($setting->time_business_hour) : '09:00 - 17:00 WIB' ?>
                </p>
                <a href="<?= base_url('kontak') ?>" class="btn btn-sm btn-outline-light rounded-pill px-3">
                    <i class="bi bi-chat-dots me-1"></i> Hubungi Kami
                </a>
            </div>
        </div>

        <hr class="border-secondary my-4">

        <div class="row align-items-center small text-white-50">
            <div class="col-md-6 text-center text-md-start">
                &copy; <?= date('Y') ?> <strong><?= !empty($setting->website_name) ? html_escape($setting->website_name) : 'JWP Wedding Organizer' ?></strong>. Hak Cipta Dilindungi.
            </div>
            <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
                LSP Telematika - Junior Web Programmer
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
