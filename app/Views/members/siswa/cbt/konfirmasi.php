<?= $this->extend('layout/dashboard_template_bs5_siswa') ?>
<?= $this->section('content') ?>

<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hidayatur Rohman
 * Date: 23/08/20
 * Time: 23:18
 */
?>
<div class="d-contents">
    <div class="sticky"></div>
    <div class="app-content overlap pb-5">
        <div class="container">
            <!-- Top Hero Banner & Student Widget -->
            <?= $this->include('members/siswa/templates/top') ?>

            <div class="row">
                <div class="col-12">
                    <div class="card my-shadow mb-4 border-0" style="border-radius: 15px; overflow: hidden;">
                        <div class="card-header py-3 border-bottom bg-white">
                            <h6 class="text-center fw-bold mb-0 text-uppercase" style="letter-spacing: 0.05em; color: #232D42;">
                                <i class="fas fa-clipboard-check text-primary me-2"></i> KONFIRMASI UJIAN
                            </h6>
                        </div>
                        <div class="card-body p-4">
                            <?php if (isset($exambro_check) && !$exambro_check['allowed']) : ?>
                                <div class="text-center py-4 px-2">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-danger bg-opacity-10 text-danger rounded-circle p-3 mb-3 shadow-xs" style="width: 86px; height: 86px;">
                                        <i class="fas fa-shield-alt fa-3x"></i>
                                    </div>
                                    <h4 class="fw-bold text-danger mb-2">AKSES UJIAN DIKUNCI</h4>
                                    <div class="mb-3">
                                        <span class="badge bg-danger text-white px-3 py-1.5 rounded-pill fw-semibold shadow-xs" style="font-size: 0.88rem;">
                                            <i class="fas fa-lock me-1"></i> <?= esc($exambro_check['rule_name'] ?? 'Wajib Exambro Resmi') ?>
                                        </span>
                                    </div>
                                    <div class="alert alert-danger border-0 rounded-3 text-start mx-auto mb-4 p-3 shadow-sm" style="max-width: 650px; background-color: #fff5f5; border-left: 5px solid #ef4444 !important;">
                                        <div class="d-flex align-items-start">
                                            <i class="fas fa-bullhorn text-danger fa-2x me-3 flex-shrink-0 mt-1"></i>
                                            <div class="small text-dark w-100">
                                                <strong class="d-block mb-1 text-danger fs-6"><i class="fas fa-exclamation-circle me-1"></i> Pesan Peringatan Saat Siswa Diblokir:</strong>
                                                <div class="p-2.5 bg-white rounded border border-danger border-opacity-25 mt-1 text-dark" style="line-height: 1.6; font-size: 0.94rem;">
                                                    <?= nl2br(esc($exambro_check['pesan_blokir'])) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center gap-2 flex-wrap mb-4">
                                        <?php if (in_array($exambro_check['mode'], [1, 2]) && !empty($exambro_check['link_android']) && $exambro_check['link_android'] !== '#'): ?>
                                            <a href="<?= esc($exambro_check['link_android']) ?>" target="_blank" class="btn btn-success px-4 py-2.5 fw-bold shadow-sm d-inline-flex align-items-center" style="border-radius: 10px;">
                                                <i class="fab fa-android fa-lg me-2"></i> Download Exambro Android
                                            </a>
                                        <?php endif; ?>
                                        <?php if (in_array($exambro_check['mode'], [1, 3]) && !empty($exambro_check['link_pc']) && $exambro_check['link_pc'] !== '#'): ?>
                                            <a href="<?= esc($exambro_check['link_pc']) ?>" target="_blank" class="btn btn-info text-white px-4 py-2.5 fw-bold shadow-sm d-inline-flex align-items-center" style="border-radius: 10px;">
                                                <i class="fas fa-desktop fa-lg me-2"></i> Download Exambro PC
                                            </a>
                                        <?php endif; ?>
                                        <button onclick="location.reload();" class="btn btn-primary px-4 py-2.5 fw-bold shadow-sm d-inline-flex align-items-center" style="border-radius: 10px;">
                                            <i class="fas fa-sync-alt me-2"></i> Cek Ulang Browser
                                        </button>
                                        <a href="<?= base_url('cbtsiswa/cbt') ?>" class="btn btn-secondary px-4 py-2.5 fw-bold shadow-sm d-inline-flex align-items-center" style="border-radius: 10px;">
                                            <i class="fas fa-arrow-left me-2"></i> Kembali ke Jadwal
                                        </a>
                                    </div>
                                    <div class="text-muted small">
                                        <span class="d-inline-block text-truncate" style="max-width: 550px;">
                                            <i class="fas fa-info-circle me-1"></i> User-Agent Anda: <code><?= esc($exambro_check['user_agent']) ?></code>
                                        </span>
                                    </div>
                                </div>
                            <?php elseif ($support && $valid) : ?>
                                <div class="text-center mb-4">
                                    <h4 class="fw-bold text-dark mb-1">
                                        <?= esc($jadwal->jenis->nama_jenis ?? $jadwal->jenis->kode_jenis) ?>
                                    </h4>
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-semibold">
                                        Tahun Pelajaran <?= esc($jadwal->tp->tahun) ?> | Semester <?= esc($jadwal->smt->smt) ?>
                                    </span>
                                </div>

                                <?php
                                $kelasbank = '';
                                $no = 1;
                                foreach ($jadwal->bank->bank_kelas as $j) {
                                    foreach ($kelas as $k) {
                                        if ($j->kelas_id === $k->id_kelas) {
                                            if ($no > 1) {
                                                $kelasbank .= ', ';
                                            }
                                            $kelasbank .= $k->nama_kelas;
                                            $no++;
                                        }
                                    }
                                }
                                ?>

                                <?= form_open('', array('id' => 'konfir')) ?>
                                <input type="hidden" name="siswa" value="<?= $siswa->id_siswa ?? session()->get('id_siswa') ?? session()->get('id_user') ?? '' ?>">
                                <input type="hidden" name="jadwal" value="<?= $jadwal->id_jadwal ?>">
                                <input type="hidden" name="bank" value="<?= $jadwal->bank->id_bank ?>">

                                <div class="row justify-content-center">
                                    <div class="col-lg-10">
                                        <ul class="list-group list-group-flush mb-4 border rounded-3 overflow-hidden">
                                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                                <span class="text-muted"><i class="fas fa-book text-primary me-2"></i> Mata Pelajaran</span>
                                                <span class="fw-bold text-dark"><?= esc($jadwal->bank->mapel->nama_mapel) ?></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                                <span class="text-muted"><i class="fas fa-users text-primary me-2"></i> Kelas</span>
                                                <span class="fw-bold text-dark"><?= esc($kelasbank) ?></span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                                <span class="text-muted"><i class="fas fa-clock text-primary me-2"></i> Durasi Waktu</span>
                                                <span class="fw-bold text-dark"><?= esc($jadwal->durasi_ujian) ?> Menit</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                                <span class="text-muted"><i class="fas fa-list-ol text-primary me-2"></i> Jumlah Soal</span>
                                                <span class="fw-bold text-dark">
                                                    <?= $jadwal->bank->tampil_pg + $jadwal->bank->tampil_kompleks + $jadwal->bank->tampil_jodohkan + $jadwal->bank->tampil_isian + $jadwal->bank->tampil_esai ?> Soal
                                                </span>
                                            </li>
                                            <?php if ($jadwal->token === '1') : ?>
                                                <li class="list-group-item py-3 bg-light">
                                                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                                                        <div>
                                                            <span class="fw-bold text-danger d-block mb-1"><i class="fas fa-key me-2"></i> Token Ujian</span>
                                                            <small class="text-muted">Ketik manual atau scan QR Code dari pengawas</small>
                                                        </div>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <input type='text' id="input-token" class="form-control text-center fw-bold text-uppercase border-primary shadow-sm" name='token' placeholder="TOKEN" style="letter-spacing: 3px; max-width: 140px; font-size: 1.1rem; height: 42px;"/>
                                                            <button type="button" class="btn btn-primary d-inline-flex align-items-center gap-2 fw-bold shadow-sm px-3" id="btn-scan-qr" onclick="openQrScannerModal()" style="height: 42px;" title="Scan QR Code Token">
                                                                <i class="fas fa-qrcode fa-lg"></i>
                                                                <span class="d-none d-sm-inline">Scan QR</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                        </ul>

                                        <?php if (!empty($pengawas)): ?>
                                            <div class="alert alert-light border rounded-3 p-3 mb-4">
                                                <h6 class="fw-bold text-dark mb-2"><i class="fas fa-user-shield text-info me-2"></i> Pengawas Ujian:</h6>
                                                <ul class="mb-0 ps-3 text-muted">
                                                    <?php foreach ($pengawas as $pws) :?>
                                                        <li><?= esc($pws->nama_guru) ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>

                                        <div class="d-flex justify-content-between align-items-center gap-2 mt-4 pt-2 border-top">
                                            <a href="<?= base_url('cbtsiswa/cbt') ?>" class="btn btn-secondary px-4 py-2 fw-bold shadow-sm" style="border-radius: 10px;">
                                                <i class="fas fa-arrow-left me-2"></i> KEMBALI
                                            </a>
                                            <button id="load-soal" type="submit" class="btn btn-success px-4 py-2 fw-bold shadow-sm" style="border-radius: 10px;">
                                                <i class="fas fa-play me-2"></i> MULAI UJIAN
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <?= form_close(); ?>
                            <?php elseif (!$valid) : ?>
                                <div class="text-center py-4 px-2">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-danger bg-opacity-10 text-danger rounded-circle p-3 mb-3" style="width: 76px; height: 76px;">
                                        <i class="fas fa-exclamation-triangle fa-2x"></i>
                                    </div>
                                    <h4 class="fw-bold text-danger mb-2">RESET IZIN DIPERLUKAN</h4>
                                    <p class="text-muted mb-4 fs-6">Ujian tidak bisa dilanjutkan secara langsung. Status ujian Anda memerlukan reset izin dari proktor/pengawas.</p>

                                    <div class="alert alert-warning border-0 rounded-3 text-start mx-auto mb-4 p-3" style="max-width: 600px; background-color: #fff8e6; border: 1px solid #fde68a !important;">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-info-circle text-warning fa-2x me-3"></i>
                                            <div class="small text-dark">
                                                <strong>Langkah Penyelesaian:</strong><br>
                                                Silakan hubungi proktor / pengawas ruangan untuk mengizinkan reset sesi ujian Anda, kemudian tekan tombol refresh di bawah ini.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                                        <a href="<?= base_url('cbtsiswa/cbt') ?>" class="btn btn-secondary px-4 py-2.5 fw-bold shadow-sm" style="border-radius: 10px;">
                                            <i class="fas fa-arrow-left me-2"></i> Kembali ke Jadwal
                                        </a>
                                        <button onclick="location.reload();" class="btn btn-primary px-4 py-2.5 fw-bold shadow-sm" style="border-radius: 10px;">
                                            <i class="fas fa-sync-alt me-2"></i> Refresh Halaman
                                        </button>
                                        <a href="<?= base_url('auth/logout') ?>" onclick="logout(event); return false;" class="btn btn-outline-danger px-4 py-2.5 fw-bold shadow-sm" style="border-radius: 10px;">
                                            <i class="fas fa-power-off me-2"></i> Logout
                                        </a>
                                    </div>
                                </div>

                            <?php elseif (!$support): ?>
                                <div class="text-center py-4 px-2">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-danger bg-opacity-10 text-danger rounded-circle p-3 mb-3" style="width: 76px; height: 76px;">
                                        <i class="fas fa-window-close fa-2x"></i>
                                    </div>
                                    <h4 class="fw-bold text-danger mb-2">BROWSER TIDAK DIDUKUNG</h4>
                                    <p class="text-muted mb-4">Browser yang Anda gunakan saat ini tidak mendukung fitur ujian. Silakan gunakan browser Chrome atau Mozilla Firefox versi terbaru.</p>
                                    <div class="d-flex justify-content-center gap-2 mt-4 flex-wrap">
                                        <a href="<?= base_url('cbtsiswa/cbt') ?>" class="btn btn-secondary px-4 py-2.5 fw-bold shadow-sm" style="border-radius: 10px;">
                                            <i class="fas fa-arrow-left me-2"></i> Kembali ke Jadwal
                                        </a>
                                        <a href="<?= base_url('auth/logout') ?>" onclick="logout(event); return false;" class="btn btn-outline-danger px-4 py-2.5 fw-bold shadow-sm" style="border-radius: 10px;">
                                            <i class="fas fa-power-off me-2"></i> Logout
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>/assets/app/js/redirect.js"></script>
<script>
    var isSubmittingKonfir = false;
    $('#konfir').submit(function (e) {
        e.stopPropagation();
        e.preventDefault();
        if (isSubmittingKonfir) return;

        var $tokenEl = $('#input-token');
        if ($tokenEl.length) {
            var cleanToken = ($tokenEl.val() || '').replace(/[\s\u200B-\u200D\uFEFF]+/g, '').toUpperCase();
            $tokenEl.val(cleanToken);
            if (!cleanToken) {
                swal.fire({
                    title: "Perhatian",
                    html: "Silakan masukkan <b>Token Ujian</b> terlebih dahulu.<br><small class='text-muted'>Ketik manual atau klik Scan QR dari pengawas.</small>",
                    icon: "warning"
                }).then(() => {
                    setTimeout(() => $tokenEl.trigger('focus'), 120);
                });
                return;
            }
        }

        isSubmittingKonfir = true;
        swal.fire({
            title: "Membuka Soal",
            text: "Silahkan tunggu....",
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
                swal.showLoading();
            }
        });

        var jadwal = $(this).find('input[name="jadwal"]').val();
        $.ajax({
            type: 'POST',
            url: base_url + 'cbtsiswa/validasi_siswa',
            data: $(this).serialize(),
            success: function (data) {
                isSubmittingKonfir = false;
                console.log(data);
                if (typeof data === 'string') {
                    try { data = JSON.parse(data); } catch (err) {}
                }
                if (data && data.exambro_blocked) {
                    swal.fire({
                        title: data.title || "AKSES UJIAN DIKUNCI",
                        html: "<div class='text-start p-2'>" +
                              "<div class='alert alert-danger mb-2'>" + data.message + "</div>" +
                              "<div class='small text-muted'>Aturan: <b>" + (data.rule_name || 'Exambro Resmi') + "</b></div>" +
                              "</div>",
                        icon: "warning",
                        confirmButtonColor: "#d33",
                        confirmButtonText: "Tutup"
                    }).then(() => {
                        location.reload();
                    });
                    return;
                }
                const isTokenValid = (data && (data.token === true || data.token_valid === true));
                if (isTokenValid) {
                    if (data.support === false) {
                        swal.fire({
                            "title": "Error",
                            "html": "Browser tidak mendukung!<br>Gunakan browser Chrome, atau Mozilla<br>005",
                            "icon": "error"
                        });
                    } else {
                        if (data.izinkan === true) {
                            if (data.ada_waktu === true) {
                                const jml_soal = data.jml_soal;
                                let ada_soal = false;
                                if (Array.isArray(jml_soal) && jml_soal.length > 0) {
                                    ada_soal = (jml_soal[0].counted_rows !== undefined ? jml_soal[0].counted_rows : jml_soal[0]) > 0;
                                } else if (typeof jml_soal === 'number') {
                                    ada_soal = jml_soal > 0;
                                }
                                if (ada_soal) {
                                    window.location.href = base_url + 'cbtsiswa/penilaian/' + jadwal;
                                } else {
                                    swal.fire({
                                        "title": "Error",
                                        "html": "Tidak ada soal ujian<br>Hubungi proktor<br>004",
                                        "icon": "error"
                                    });
                                }
                            } else {
                                swal.fire({
                                    "title": "Error",
                                    "html": data.warn.msg + "<br>Hubungi proktor<br>003",
                                    "icon": "error"
                                });
                            }
                        } else {
                            swal.fire({
                                "title": "Error",
                                "html": "Anda sedang mengerjakan ujian di perangkat lain<br>Hubungi proktor<br>002",
                                "icon": "error"
                            });
                        }
                    }
                } else {
                    var errHtml = "TOKEN salah!<br>Hubungi proktor<br>001";
                    if (data && data.reason === 'jadwal_not_found') {
                        errHtml = (data.message || "Jadwal ujian tidak ditemukan") + "<br>Silakan muat ulang halaman";
                    } else if (data && data.reason === 'token_missing') {
                        errHtml = (data.token_msg || "Token ujian belum dibuat") + "<br>Hubungi proktor";
                    }
                    swal.fire({
                        "title": "Error",
                        "html": errHtml,
                        "icon": "error"
                    }).then(() => {
                        if ($tokenEl.length) {
                            setTimeout(() => $tokenEl.trigger('focus').select(), 120);
                        }
                    });
                }
            }, error: function (xhr, error, status) {
                isSubmittingKonfir = false;
                swal.fire({
                    "title": "Error",
                    "html": "Coba kembali ke beranda, lalu ulangi lagi<br>006",
                    "icon": "error"
                });
                console.log(xhr.responseText);
            }
        });
    });
</script>

<!-- Preload HTML5 QR Code Library -->
<script src="<?= base_url('assets/app/js/html5-qrcode.min.js') ?>"></script>

<!-- Modal Scanner QR Code Token (Siswa) -->
<div class="modal fade" id="modalScanToken" tabindex="-1" aria-labelledby="modalScanTokenLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg text-center" style="border-radius: 18px; overflow: hidden; background: #ffffff;">
            <div class="modal-header text-white py-3 border-0" style="background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);">
                <div class="w-100 position-relative">
                    <h5 class="modal-title fw-bold text-white d-flex align-items-center justify-content-center mb-0" id="modalScanTokenLabel">
                        <i class="fas fa-qrcode me-2"></i> PINDAI QR CODE TOKEN
                    </h5>
                    <button type="button" class="btn-close btn-close-white position-absolute top-50 end-0 translate-middle-y" data-bs-dismiss="modal" aria-label="Close" onclick="stopQrScanner()"></button>
                </div>
            </div>
            <div class="modal-body p-4 bg-light">
                <p class="text-muted small mb-3">Arahkan kamera ke QR Code token yang ditampilkan pengawas / proktor di depan kelas.</p>

                <!-- Scanner Video Viewport Container -->
                <div id="qr-reader-container" class="position-relative mx-auto rounded-4 overflow-hidden shadow-sm bg-dark border" style="max-width: 320px; min-height: 260px; display: flex; align-items: center; justify-content: center;">
                    <div id="qr-reader" style="width: 100%;"></div>
                </div>

                <!-- Status Feedback Badge -->
                <div id="scanner-status" class="alert alert-info py-2 px-3 mt-3 mb-0 small rounded-3">
                    <i class="fas fa-camera me-1"></i> Menyiapkan kamera...
                </div>
            </div>
            <div class="modal-footer bg-white py-2 px-3 border-top justify-content-between">
                <button type="button" class="btn btn-outline-secondary btn-sm fw-semibold" id="btn-switch-camera" onclick="switchScannerCamera()" style="display: none;">
                    <i class="fas fa-sync-alt me-1"></i> Ganti Kamera
                </button>
                <button type="button" class="btn btn-secondary btn-sm px-4 fw-bold ms-auto" data-bs-dismiss="modal" onclick="stopQrScanner()">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    var html5QrCode = null;
    var currentCameraId = null;
    var availableCameras = [];
    var isScannerScriptLoading = false;

    function openQrScannerModal() {
        // Jika menggunakan Aplikasi Android LMS/CBT native, panggil scanner native Android
        if (window.CbtBridge && typeof window.CbtBridge.scanTokenQr === 'function') {
            try {
                window.CbtBridge.scanTokenQr();
                return;
            } catch(e) {
                console.warn('Native QR scanner error, falling back to web modal', e);
            }
        }

        var modalEl = document.getElementById('modalScanToken');
        if (!modalEl) return;
        var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.show();

        // Jika menggunakan Aplikasi Android CBT lama, otomatis pemicu izin kamera
        if (window.CbtBridge && typeof window.CbtBridge.requestCameraPermission === 'function') {
            try {
                window.CbtBridge.requestCameraPermission();
            } catch(e) {}
        }

        $('#scanner-status').removeClass('alert-danger alert-success').addClass('alert-info')
            .html('<i class="fas fa-spinner fa-spin me-1"></i> Menyiapkan modul kamera...');

        if (typeof Html5Qrcode === 'undefined') {
            if (!isScannerScriptLoading) {
                isScannerScriptLoading = true;
                var script = document.createElement('script');
                script.src = "<?= base_url('assets/app/js/html5-qrcode.min.js') ?>";
                script.onload = function() {
                    isScannerScriptLoading = false;
                    setTimeout(function() {
                        startQrScanner();
                    }, 200);
                };
                script.onerror = function() {
                    isScannerScriptLoading = false;
                    $('#scanner-status').removeClass('alert-info alert-success').addClass('alert-danger')
                        .html('<i class="fas fa-exclamation-triangle me-1"></i> Gagal memuat library scanner. Silakan ketik token manual.');
                };
                document.head.appendChild(script);
            }
        } else {
            setTimeout(function() {
                startQrScanner();
            }, 200);
        }
    }

    function startQrScanner() {
        if (typeof Html5Qrcode === 'undefined') {
            $('#scanner-status').removeClass('alert-info alert-success').addClass('alert-danger')
                .html('<i class="fas fa-exclamation-triangle me-1"></i> Library scanner belum siap. Silakan ketik token manual.');
            return;
        }

        if (html5QrCode && html5QrCode.isScanning) {
            try { html5QrCode.stop(); } catch(e) {}
        }

        html5QrCode = new Html5Qrcode("qr-reader");

        var config = {
            fps: 15,
            qrbox: { width: 220, height: 220 },
            aspectRatio: 1.0
        };

        Html5Qrcode.getCameras().then(devices => {
            if (devices && devices.length) {
                availableCameras = devices;
                if (devices.length > 1) {
                    $('#btn-switch-camera').show();
                } else {
                    $('#btn-switch-camera').hide();
                }

                // Prefer rear camera on mobile devices
                var selectedCamera = devices[0].id;
                for (var i = 0; i < devices.length; i++) {
                    var label = devices[i].label.toLowerCase();
                    if (label.indexOf('back') !== -1 || label.indexOf('rear') !== -1 || label.indexOf('belakang') !== -1 || label.indexOf('environment') !== -1) {
                        selectedCamera = devices[i].id;
                        break;
                    }
                }
                currentCameraId = selectedCamera;

                html5QrCode.start(
                    selectedCamera,
                    config,
                    function(decodedText) {
                        onQrCodeScanned(decodedText);
                    },
                    function(errorMessage) {}
                ).then(function() {
                    $('#scanner-status').removeClass('alert-info alert-danger').addClass('alert-success')
                        .html('<i class="fas fa-video me-1"></i> Kamera aktif. Arahkan ke QR Code token.');
                }).catch(function(err) {
                    fallbackStartScanner(config);
                });
            } else {
                fallbackStartScanner(config);
            }
        }).catch(function(err) {
            fallbackStartScanner(config);
        });
    }

    function fallbackStartScanner(config) {
        if (!html5QrCode) return;
        html5QrCode.start(
            { facingMode: "environment" },
            config,
            function(decodedText) {
                onQrCodeScanned(decodedText);
            },
            function(errorMessage) {}
        ).then(function() {
            $('#scanner-status').removeClass('alert-info alert-danger').addClass('alert-success')
                .html('<i class="fas fa-video me-1"></i> Kamera aktif. Arahkan ke QR Code token.');
        }).catch(function(err2) {
            $('#scanner-status').removeClass('alert-info alert-success').addClass('alert-danger')
                .html('<div class="fw-bold mb-1 text-danger"><i class="fas fa-camera-slash me-1"></i> Izin Kamera Belum Aktif</div>' +
                      '<div class="small text-start text-dark mt-2 p-2 bg-white rounded border">' +
                      '<b>Petunjuk untuk Siswa:</b><br>' +
                      '1. Ketuk ikon <b>🔒 Gembok / Setelan</b> di kiri atas bilah alamat browser.<br>' +
                      '2. Pilih menu <b>Izin Situs (Permissions)</b> &rarr; <b>Kamera</b> &rarr; Pilih <b>Izinkan</b>.<br>' +
                      '3. Buka kembali tombol <b>Scan QR</b> atau ketikkan token secara manual.' +
                      '</div>');
        });
    }

    function stopQrScanner() {
        if (html5QrCode) {
            try {
                if (html5QrCode.isScanning) {
                    html5QrCode.stop().then(function() {
                        html5QrCode.clear();
                    }).catch(function(err) {});
                }
            } catch(e) {}
        }
    }

    function switchScannerCamera() {
        if (!availableCameras || availableCameras.length <= 1 || !html5QrCode) return;
        var nextIndex = 0;
        for (var i = 0; i < availableCameras.length; i++) {
            if (availableCameras[i].id === currentCameraId) {
                nextIndex = (i + 1) % availableCameras.length;
                break;
            }
        }
        currentCameraId = availableCameras[nextIndex].id;
        stopQrScanner();
        setTimeout(function() {
            startQrScanner();
        }, 300);
    }

    function onQrCodeScanned(decodedText) {
        if (!decodedText) return;

        var token = decodedText.trim();
        try {
            var parsed = JSON.parse(token);
            if (parsed.token) token = parsed.token;
        } catch(e) {}
        token = token.toUpperCase().trim();

        try {
            if (navigator.vibrate) navigator.vibrate([100, 50, 100]);
        } catch(e) {}

        stopQrScanner();
        var modalEl = document.getElementById('modalScanToken');
        if (modalEl) {
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();
        }

        $('#input-token').val(token);

        var sw = typeof Swal !== 'undefined' ? Swal : (typeof swal !== 'undefined' ? swal : null);
        if (sw) {
            sw.fire({
                icon: 'success',
                title: 'QR Code Terdeteksi!',
                html: 'Token berhasil diisi: <strong class="fs-4 text-primary">' + token + '</strong><br><small class="text-muted">Silakan tekan "MULAI UJIAN" untuk melanjutkan.</small>',
                timer: 2000,
                showConfirmButton: false
            });
        }
    }

    $('#modalScanToken').on('hidden.bs.modal', function () {
        stopQrScanner();
    });
</script>
<?= $this->endSection() ?>
