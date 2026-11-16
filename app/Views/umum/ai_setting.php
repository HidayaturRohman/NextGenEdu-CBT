<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <!-- Header Card -->
        <div class="card mb-4 border-0 shadow-sm" style="border-radius: 14px;">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3 flex-shrink-0">
                            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm"
                                 style="width: 56px; height: 56px; background: linear-gradient(135deg, #6366f1 0%, #4f46e5 50%, #2563eb 100%); color: #ffffff;">
                                <i class="fas fa-robot fa-lg"></i>
                            </div>
                        </div>
                        <div>
                            <h4 class="card-title mb-1 fw-bold text-dark d-flex align-items-center gap-2">
                                <?= esc($judul) ?>
                                <span id="badgeStatusHeader" class="badge rounded-pill <?= $has_key ? 'bg-success' : 'bg-warning text-dark' ?>" style="font-size: 0.75rem;">
                                    <?= $has_key ? 'API Key Aktif' : 'Belum Diatur' ?>
                                </span>
                            </h4>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                <?= esc($subjudul) ?>
                            </p>
                        </div>
                    </div>
                    <div>
                        <a href="https://aistudio.google.com/app/apikey" target="_blank" rel="noopener noreferrer"
                           class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold shadow-sm">
                            <i class="fas fa-external-link-alt me-1"></i> Ambil API Key Gratis di Google AI Studio
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Form Konfigurasi API Key -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 14px;">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h6 class="mb-0 fw-bold text-dark">
                            <i class="fas fa-key text-primary me-2"></i>Konfigurasi Google Gemini API
                        </h6>
                    </div>
                    <div class="card-body">
                        <form id="formAiConfig" onsubmit="return false;">
                            <div class="p-3 rounded-3 mb-3 border" style="background: #f8fafc;">
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                    <div>
                                        <span class="small text-muted d-block">Status Kunci Saat Ini:</span>
                                        <strong id="textMaskedKey" class="font-monospace text-dark">
                                            <?= $has_key ? esc($masked_key) : 'Belum ada API Key tersimpan' ?>
                                        </strong>
                                    </div>
                                    <div class="text-end">
                                        <span class="small text-muted d-block">Terakhir Diperbarui:</span>
                                        <small id="textUpdatedAt" class="fw-semibold text-secondary">
                                            <?= !empty($ai_config['updated_at']) ? esc($ai_config['updated_at']) : '-' ?>
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold text-dark">
                                    Google Gemini API Key <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-lock text-muted"></i></span>
                                    <input type="password" id="inputApiKey" name="api_key" class="form-control font-monospace"
                                           placeholder="<?= $has_key ? 'Kosongkan jika tidak ingin mengganti API Key, atau tempel API Key baru (AIzaSy...)' : 'Tempelkan Gemini API Key di sini (Contoh: AIzaSyB...)' ?>"
                                           autocomplete="off">
                                    <button type="button" class="btn btn-outline-secondary" onclick="toggleShowApiKey()" title="Lihat / Sembunyikan">
                                        <i id="iconToggleKey" class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <small class="text-muted d-block mt-1">
                                    API Key disimpan secara terisolasi dan aman di server sekolah. Guru dapat langsung menggunakan fitur asisten AI di <b>Bank Soal</b> dan <b>Materi/Tugas</b> tanpa perlu memasukkan API Key lagi.
                                </small>
                            </div>

                            <div class="mb-4">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <label class="form-label fw-semibold text-dark mb-0">
                                        Model Gemini AI Utama (Mendukung Gemini 2.5 &amp; 3.x ke Atas)
                                    </label>
                                    <button type="button" id="btnFetchModels" class="btn btn-xs btn-outline-primary py-0 px-2" onclick="muatDaftarModelGoogle()">
                                        <i class="fas fa-sync-alt me-1"></i> Muat Model Terbaru dari Google
                                    </button>
                                </div>
                                <?php
                                $curModel = $ai_config['model'] ?? 'gemini-2.5-flash';
                                $presetModels = [
                                    'gemini-3.1-pro-preview' => 'Gemini 3.1 Pro Preview (Generasi 3 Terbaru — Penalaran Sangat Tinggi)',
                                    'gemini-3-flash-preview' => 'Gemini 3.0 Flash Preview (Generasi 3 Terbaru — Cepat & Cerdas)',
                                    'gemini-2.5-pro'         => 'Gemini 2.5 Pro (Penalaran HOTS, Sains & Matematika Mendalam)',
                                    'gemini-2.5-flash'       => 'Gemini 2.5 Flash (Direkomendasikan — Cepat, Cerdas & Kuota Gratis Besar)',
                                    'gemini-2.5-flash-lite'  => 'Gemini 2.5 Flash Lite (Super Cepat & Kuota Harian Sangat Besar)',
                                    'gemini-2.0-flash'       => 'Gemini 2.0 Flash (Stabil & Respons Cepat)',
                                    'gemini-1.5-flash'       => 'Gemini 1.5 Flash (Kompatibilitas Klasik)',
                                ];
                                $isCustom = !array_key_exists($curModel, $presetModels);
                                ?>
                                <select id="selectAiModel" name="model" class="form-select" style="color: #1e293b !important;" onchange="onChangeSelectModel()">
                                    <?php foreach ($presetModels as $mKey => $mLabel): ?>
                                        <option value="<?= esc($mKey) ?>" <?= $curModel === $mKey ? 'selected' : '' ?>>
                                            <?= esc($mLabel) ?>
                                        </option>
                                    <?php endforeach; ?>
                                    <?php if ($isCustom && !empty($curModel)): ?>
                                        <option value="<?= esc($curModel) ?>" selected>Model Aktif: <?= esc($curModel) ?></option>
                                    <?php endif; ?>
                                    <option value="__custom__">-- Ketik Kode Model Sendiri (Gemini Versi Baru / Kustom) --</option>
                                </select>
                                <div id="wrapCustomModel" class="mt-2 d-none">
                                    <input type="text" id="inputCustomModel" class="form-control form-control-sm font-monospace"
                                           placeholder="Ketik ID model Google Gemini (contoh: gemini-3.1-pro-preview atau gemini-2.5-pro)">
                                </div>
                                <small class="text-muted d-block mt-1">
                                    Mendukung seluruh model generasi terbaru (<b>Gemini 2.5 Pro</b>, <b>Gemini 3.0 Flash</b>, <b>Gemini 3.1 Pro</b>, dst). Klik <b>"Muat Model Terbaru dari Google"</b> untuk mengambil daftar model langsung dari server Google AI.
                                    <br><span class="text-secondary"><i class="fas fa-info-circle me-1"></i>Catatan: Model berbayar/penalaran tinggi seperti <code>gemini-4-argon</code> tidak memiliki kuota gratis (Free Tier = 0) sehingga memerlukan Google Cloud Billing aktif; jika gagal/ditolak, sistem otomatis memakai model cadangan <code>gemini-2.5-flash</code>.</span>
                                </small>
                            </div>

                            <!-- Konfigurasi Provider Gambar AI Gratis -->
                            <div class="p-3 rounded-3 mb-4 border" style="background: #f0fdf4; border-color: #bbf7d0 !important;">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <h6 class="mb-0 fw-bold text-dark">
                                        <i class="fas fa-image text-success me-2"></i>Pengaturan Gambar AI Gratis (Opsional &mdash; Tanpa Kartu Kredit)
                                    </h6>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle">Gratis Harian</span>
                                </div>
                                <small class="text-secondary d-block mb-3">
                                    Karena Google Gemini mengunci model gambar native (<code>limit: 0</code>) pada API Key gratis, atur salah satu provider gratis berikut untuk menghasilkan <b>gambar foto/ilustrasi FLUX gratis tanpa watermark</b> (atau biarkan kosong untuk mode Diagram Vektor Gemini).
                                </small>

                                <?php $curImgProv = $ai_config['img_provider'] ?? 'auto'; ?>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold small text-dark mb-1">Provider Gambar AI Bawaan</label>
                                    <select id="selectImgProvider" name="img_provider" class="form-select form-select-sm" style="color: #1e293b !important;" onchange="onChangeImgProvider()">
                                        <option value="auto" <?= $curImgProv === 'auto' ? 'selected' : '' ?>>Otomatis Cerdas (Cloudflare/HF FLUX jika diisi &rarr; Gemini Native &rarr; Diagram Vektor)</option>
                                        <option value="cloudflare" <?= $curImgProv === 'cloudflare' ? 'selected' : '' ?>>Cloudflare Workers AI &mdash; FLUX.1-schnell (GRATIS ~100+ gambar/hari, Tanpa Kartu Kredit)</option>
                                        <option value="huggingface" <?= $curImgProv === 'huggingface' ? 'selected' : '' ?>>Hugging Face Router &mdash; FLUX.1-schnell (GRATIS Token)</option>
                                        <option value="pollinations_key" <?= $curImgProv === 'pollinations_key' ? 'selected' : '' ?>>Pollinations.ai Key (enter.pollinations.ai)</option>
                                        <option value="gemini_vector" <?= $curImgProv === 'gemini_vector' ? 'selected' : '' ?>>Diagram / Ilustrasi Vektor AI (Pakai Gemini Teks Aktif &mdash; Tanpa Akun Baru)</option>
                                        <option value="gemini_native" <?= $curImgProv === 'gemini_native' ? 'selected' : '' ?>>Google Gemini Image Native (Khusus Proyek dengan Billing Aktif)</option>
                                    </select>
                                </div>

                                <div class="row g-2">
                                    <div class="col-md-5">
                                        <label class="form-label small fw-semibold text-dark mb-1">
                                            Cloudflare Account ID
                                            <?php if (!empty($has_cf)): ?>
                                                <span class="badge bg-success ms-1">Aktif</span>
                                            <?php endif; ?>
                                        </label>
                                        <input type="text" id="inputCfAccountId" class="form-control form-control-sm font-monospace"
                                               value="<?= esc($ai_config['cf_account_id'] ?? '') ?>"
                                               placeholder="Contoh: 8a2f...c91d">
                                    </div>
                                    <div class="col-md-7">
                                        <label class="form-label small fw-semibold text-dark mb-1">
                                            Cloudflare API Token (Workers AI)
                                            <?php if (!empty($masked_cf)): ?>
                                                <span class="text-success fw-normal">(<?= esc($masked_cf) ?>)</span>
                                            <?php endif; ?>
                                        </label>
                                        <input type="password" id="inputCfApiToken" class="form-control form-control-sm font-monospace"
                                               placeholder="<?= !empty($has_cf) ? 'Kosongkan jika tidak ingin mengganti token' : 'Tempel Cloudflare API Token...' ?>"
                                               autocomplete="off">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label class="form-label small fw-semibold text-dark mb-1">
                                            Hugging Face Token (Opsional)
                                            <?php if (!empty($masked_hf)): ?>
                                                <span class="badge bg-info text-dark ms-1"><?= esc($masked_hf) ?></span>
                                            <?php endif; ?>
                                        </label>
                                        <input type="password" id="inputHfApiToken" class="form-control form-control-sm font-monospace"
                                               placeholder="<?= !empty($has_hf) ? 'Kosongkan jika tidak mengganti' : 'hf_...' ?>"
                                               autocomplete="off">
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label class="form-label small fw-semibold text-dark mb-1">
                                            Pollinations Key (Opsional)
                                            <?php if (!empty($masked_poll)): ?>
                                                <span class="badge bg-info text-dark ms-1"><?= esc($masked_poll) ?></span>
                                            <?php endif; ?>
                                        </label>
                                        <input type="password" id="inputPollinationsKey" class="form-control form-control-sm font-monospace"
                                               placeholder="<?= !empty($has_poll) ? 'Kosongkan jika tidak mengganti' : 'Key dari enter.pollinations.ai' ?>"
                                               autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div id="testResultBox" class="alert d-none mb-3" role="alert"></div>

                            <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center pt-2 border-top">
                                <button type="button" id="btnTestKey" class="btn btn-outline-info fw-semibold px-3" onclick="testKoneksiAi()">
                                    <i class="fas fa-plug me-1"></i> Tes Koneksi API
                                </button>
                                <button type="button" id="btnSaveKey" class="btn btn-primary fw-bold px-4 shadow-sm" onclick="simpanKonfigurasiAi()">
                                    <i class="fas fa-save me-1"></i> Simpan Pengaturan API
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Panduan & Keamanan Arsitektur -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 14px;">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h6 class="mb-0 fw-bold text-dark">
                            <i class="fas fa-info-circle text-success me-2"></i>Panduan &amp; Kegunaan Fitur AI
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6 class="fw-bold text-primary small text-uppercase mb-2">Cara Mendapatkan API Key Gratis:</h6>
                            <ol class="small text-secondary ps-3 mb-0" style="line-height: 1.7;">
                                <li>Buka halaman <a href="https://aistudio.google.com/app/apikey" target="_blank" class="fw-semibold">Google AI Studio (aistudio.google.com)</a> dan login dengan akun Google/Gmail.</li>
                                <li>Klik tombol <b>"Create API Key"</b>.</li>
                                <li>Salin kode API Key yang diawali dengan <code>AIzaSy...</code> lalu tempelkan pada kolom di samping dan klik <b>Simpan Pengaturan API</b>.</li>
                            </ol>
                        </div>

                        <div class="mb-3 p-3 rounded-3 border" style="background: #f8fafc;">
                            <h6 class="fw-bold text-success small text-uppercase mb-2">
                                <i class="fas fa-bolt me-1"></i>Rekomendasi Gambar AI Gratis (FLUX):
                            </h6>
                            <ol class="small text-secondary ps-3 mb-0" style="line-height: 1.65;">
                                <li>Daftar akun gratis di <a href="https://dash.cloudflare.com/sign-up" target="_blank" rel="noopener noreferrer" class="fw-semibold">Cloudflare Dashboard</a> (<b>tidak perlu kartu kredit</b>, gratis 10.000 Neurons/hari &approx; 100+ gambar FLUX).</li>
                                <li>Salin <b>Account ID</b> di menu <i>Workers &amp; Pages</i>.</li>
                                <li>Buat token di <i>My Profile &rarr; API Tokens &rarr; Create Token</i> menggunakan template <b>Workers AI</b>, lalu tempel di sebelah kiri dan klik Simpan.</li>
                            </ol>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <h6 class="fw-bold text-success small text-uppercase mb-2">Fitur yang Otomatis Aktif Setelah Disimpan:</h6>
                            <ul class="list-unstyled small mb-0">
                                <li class="mb-2 d-flex align-items-start">
                                    <i class="fas fa-check-circle text-success mt-1 me-2"></i>
                                    <div>
                                        <b>Generator Bank Soal CBT:</b> Membantu guru membuat soal Pilihan Ganda, PG Kompleks, Menjodohkan, Isian Singkat, dan Essai (bisa 1 soal ke editor maupun paket banyak soal sekaligus).
                                    </div>
                                </li>
                                <li class="mb-2 d-flex align-items-start">
                                    <i class="fas fa-check-circle text-success mt-1 me-2"></i>
                                    <div>
                                        <b>Generator Materi &amp; Tugas E-Learning:</b> Membantu guru menyusun bahan ajar, LKPD tatap muka, panduan diskusi, dan latihan soal otomatis.
                                    </div>
                                </li>
                                <li class="d-flex align-items-start">
                                    <i class="fas fa-shield-alt text-primary mt-1 me-2"></i>
                                    <div>
                                        <b>Arsitektur Terisolasi (Aman 100%):</b> Fitur AI berjalan sebagai asisten mandiri yang tidak mengubah alur penyimpanan asli maupun pelaksanaan ujian siswa.
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function toggleShowApiKey() {
        var inp = document.getElementById('inputApiKey');
        var ico = document.getElementById('iconToggleKey');
        if (!inp) return;
        if (inp.type === 'password') {
            inp.type = 'text';
            if (ico) { ico.classList.remove('fa-eye'); ico.classList.add('fa-eye-slash'); }
        } else {
            inp.type = 'password';
            if (ico) { ico.classList.remove('fa-eye-slash'); ico.classList.add('fa-eye'); }
        }
    }

    function onChangeSelectModel() {
        var val = $('#selectAiModel').val();
        if (val === '__custom__') {
            $('#wrapCustomModel').removeClass('d-none');
            $('#inputCustomModel').focus();
        } else {
            $('#wrapCustomModel').addClass('d-none');
        }
    }

    function muatDaftarModelGoogle() {
        var btn = $('#btnFetchModels');
        var apiKey = ($('#inputApiKey').val() || '').trim();
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i> Memuat...');

        $.ajax({
            url: base_url + 'aigenerator/listmodels',
            type: 'GET',
            dataType: 'JSON',
            data: { api_key: apiKey },
            success: function(res) {
                btn.prop('disabled', false).html('<i class="fas fa-sync-alt me-1"></i> Muat Model Terbaru dari Google');
                if (res && res.status && Array.isArray(res.models) && res.models.length > 0) {
                    var curVal = $('#selectAiModel').val();
                    var sel = $('#selectAiModel');
                    sel.empty();
                    for (var i = 0; i < res.models.length; i++) {
                        var m = res.models[i];
                        var isSel = (m.id === curVal) ? 'selected' : '';
                        sel.append('<option value="' + m.id + '" ' + isSel + '>' + m.title + '</option>');
                    }
                    sel.append('<option value="__custom__">-- Ketik Kode Model Sendiri (Kustom) --</option>');
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: 'Berhasil memuat ' + res.models.length + ' model Gemini langsung dari Google!',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    }
                } else {
                    var msg = (res && res.message) ? res.message : 'Gagal memuat daftar model.';
                    if (typeof Swal !== 'undefined') {
                        Swal.fire('Info', msg, 'info');
                    } else {
                        alert(msg);
                    }
                }
            },
            error: function() {
                btn.prop('disabled', false).html('<i class="fas fa-sync-alt me-1"></i> Muat Model Terbaru dari Google');
            }
        });
    }

    function onChangeImgProvider() {
        // Disimpan saat klik Simpan Pengaturan API
    }

    function simpanKonfigurasiAi() {
        var apiKey      = ($('#inputApiKey').val() || '').trim();
        var model       = $('#selectAiModel').val() || 'gemini-2.5-flash';
        if (model === '__custom__') {
            model = ($('#inputCustomModel').val() || '').trim() || 'gemini-2.5-flash';
        }
        var imgProvider = $('#selectImgProvider').val() || 'auto';
        var cfAccountId = ($('#inputCfAccountId').val() || '').trim();
        var cfApiToken  = ($('#inputCfApiToken').val() || '').trim();
        var hfApiToken  = ($('#inputHfApiToken').val() || '').trim();
        var pollKey     = ($('#inputPollinationsKey').val() || '').trim();
        var btn         = $('#btnSaveKey');

        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...');
        $('#testResultBox').addClass('d-none');

        $.ajax({
            url: base_url + 'aigenerator/savekey',
            type: 'POST',
            dataType: 'JSON',
            data: {
                api_key: apiKey,
                model: model,
                img_provider: imgProvider,
                cf_account_id: cfAccountId,
                cf_api_token: cfApiToken,
                hf_api_token: hfApiToken,
                pollinations_key: pollKey
            },
            success: function(res) {
                btn.prop('disabled', false).html('<i class="fas fa-save me-1"></i> Simpan Pengaturan API');
                if (res && res.status) {
                    $('#inputApiKey').val('');
                    $('#inputCfApiToken').val('');
                    $('#inputHfApiToken').val('');
                    $('#inputPollinationsKey').val('');
                    $('#textMaskedKey').text(res.masked_key || 'Tersimpan');
                    $('#textUpdatedAt').text(res.updated_at || 'Baru saja');
                    if (res.has_key) {
                        $('#badgeStatusHeader')
                            .removeClass('bg-warning text-dark')
                            .addClass('bg-success')
                            .text('API Key Aktif');
                    }

                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil Disimpan',
                            text: res.message,
                            timer: 2200,
                            showConfirmButton: false
                        }).then(function() {
                            if (cfApiToken || hfApiToken || pollKey) {
                                window.location.reload();
                            }
                        });
                    } else if (cfApiToken || hfApiToken || pollKey) {
                        window.location.reload();
                    }
                } else {
                    var msg = (res && res.message) ? res.message : 'Gagal menyimpan pengaturan API Key.';
                    if (typeof Swal !== 'undefined') {
                        Swal.fire('Gagal', msg, 'warning');
                    } else {
                        alert(msg);
                    }
                }
            },
            error: function() {
                btn.prop('disabled', false).html('<i class="fas fa-save me-1"></i> Simpan Pengaturan API');
                if (typeof Swal !== 'undefined') {
                    Swal.fire('Error', 'Gagal menghubungi server.', 'error');
                }
            }
        });
    }

    function escapeHtmlAi(str) {
        return $('<div>').text(String(str || '')).html();
    }

    function testKoneksiAi() {
        var btn = $('#btnTestKey');
        var box = $('#testResultBox');
        var selModel = $('#selectAiModel').val() || '';
        var customModel = ($('#inputCustomModel').val() || '').trim();
        var typedKey = ($('#inputApiKey').val() || '').trim();
        var modelLabel = selModel === '__custom__' ? (customModel || 'gemini-2.5-flash') : (selModel || 'gemini-2.5-flash');

        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i> Menguji Koneksi...');
        box.removeClass('d-none alert-success alert-danger alert-warning').addClass('alert-info')
           .html('<i class="fas fa-spinner fa-spin me-1"></i> Menguji model <b>' + escapeHtmlAi(modelLabel) + '</b> di server Google Gemini AI...');

        $.ajax({
            url: base_url + 'aigenerator/testkey',
            type: 'POST',
            dataType: 'JSON',
            data: {
                model: selModel,
                custom_model: customModel,
                api_key: typedKey
            },
            success: function(res) {
                btn.prop('disabled', false).html('<i class="fas fa-plug me-1"></i> Tes Koneksi API');
                if (res && res.status) {
                    if (res.fallback_used) {
                        box.removeClass('alert-info alert-danger alert-success').addClass('alert-warning')
                           .html('<i class="fas fa-exclamation-triangle me-1"></i> <b>Peringatan Fallback Model:</b> ' + escapeHtmlAi(res.message));
                    } else {
                        box.removeClass('alert-info alert-danger alert-warning').addClass('alert-success')
                           .html('<i class="fas fa-check-circle me-1"></i> <b>' + escapeHtmlAi(res.message) + '</b>');
                    }
                } else {
                    var err = (res && res.message) ? res.message : 'Koneksi gagal.';
                    box.removeClass('alert-info alert-success alert-warning').addClass('alert-danger')
                       .html('<i class="fas fa-exclamation-triangle me-1"></i> <b>Gagal:</b> ' + escapeHtmlAi(err));
                }
            },
            error: function() {
                btn.prop('disabled', false).html('<i class="fas fa-plug me-1"></i> Tes Koneksi API');
                box.removeClass('alert-info alert-success alert-warning').addClass('alert-danger')
                   .html('<i class="fas fa-exclamation-triangle me-1"></i> Gagal menghubungi endpoint tes koneksi.');
            }
        });
    }
</script>
<?= $this->endSection() ?>
