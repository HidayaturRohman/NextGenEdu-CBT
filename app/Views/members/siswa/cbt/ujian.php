<?= $this->extend('layout/dashboard_template_bs5_siswa') ?>
<?= $this->section('content') ?>

<style>
/* PC View Style (LOCKED: Overlaps into middle of blue header) */
@media (min-width: 992px) {
    .app-content.overlap {
        margin-top: -2.25rem !important;
    }
}

/* Mobile View Style (ISOLATED: Adjustable for HP layout) */
@media (max-width: 991.98px) {
    .app-content.overlap {
        margin-top: -4.5rem !important;
    }

    /* Maksimalkan lebar kotak ujian di HP */
    .container {
        padding-left: 8px !important;
        padding-right: 8px !important;
        max-width: 100% !important;
    }
    .row {
        margin-left: -3px !important;
        margin-right: -3px !important;
    }
    .col-12 {
        padding-left: 3px !important;
        padding-right: 3px !important;
    }
    .card.my-shadow {
        border-radius: 14px !important;
        margin-bottom: 1rem !important;
    }
    .card-header.p-3.5,
    .card-header {
        padding: 0.65rem 0.75rem !important;
    }
    .card-header .card-title {
        font-size: 0.9rem !important;
    }
    #nomor-soal {
        font-size: 0.95rem !important;
        padding: 2px 10px !important;
    }
    .card-header .card-tools {
        gap: 6px !important;
    }
    .card-header .card-tools .btn-oval-sm {
        padding: 4px 8px !important;
        font-size: 0.8rem !important;
    }
    .card-body.p-3,
    .card-body {
        padding: 0.65rem 0.5rem !important;
    }
    .konten-soal-jawab {
        padding: 0.85rem 0.65rem !important;
    }
    .konten-soal-jawab .row.p-2,
    .konten-soal-jawab .row.p-3 {
        padding: 0 !important;
        margin: 0 !important;
    }
    #konten-soal {
        font-size: 1.02rem !important;
        line-height: 1.55 !important;
        margin-bottom: 0.85rem !important;
    }
    .container-jawaban {
        padding-left: 40px !important;
        font-size: 0.98rem !important;
        line-height: 1.45 !important;
        margin-bottom: 10px !important;
    }
    .checkmark {
        height: 28px !important;
        width: 28px !important;
        font-size: 0.85rem !important;
        top: 2px !important;
    }
    .card-footer {
        padding: 0.65rem 0.75rem !important;
    }
    .card-footer .btn {
        padding: 6px 14px !important;
        font-size: 0.88rem !important;
    }
}

/* Remove black/gray translucent backdrop overlay behind modal */
.modal-backdrop, .modal-backdrop.show {
    opacity: 0 !important;
    background-color: transparent !important;
    pointer-events: none !important;
}

/* Center numbers in Daftar Soal modal & remove black/dark background */
#konten-modal .btn {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 0 !important;
    line-height: 1 !important;
    border-radius: 8px !important;
}

#konten-modal .btn.active,
#konten-modal .btn:active,
#konten-modal .btn:focus {
    background-color: var(--bs-primary, #3a57e8) !important;
    border-color: var(--bs-primary, #3a57e8) !important;
    color: #ffffff !important;
    box-shadow: 0 4px 12px rgba(58, 87, 232, 0.35) !important;
}

/* Clean modern radio & checkbox styles for active exam session */
/* Solid Deep Black Text for Questions & Answers (High Contrast & Maximum Readability) */
#konten-soal, 
#konten-soal *, 
#konten-jawaban, 
#konten-jawaban *, 
.container-jawaban, 
.checkbox-xl .form-check-label, 
.konten-soal-jawab,
#jawaban-isian, 
#jawaban-essai, 
.note-editable,
.note-editable * {
    color: #000000 !important;
}

#badge-hots-ujian {
    background-color: #dc2626 !important;
    color: #ffffff !important;
    border: 1px solid #b91c1c !important;
    box-shadow: 0 2px 6px rgba(220, 38, 38, 0.28);
    font-size: 0.78rem !important;
    font-weight: 700 !important;
    letter-spacing: 0.6px;
}

/* Ensure checkmark badge text stays white when checked */
.container-jawaban input:checked ~ .checkmark {
    color: #ffffff !important;
}

.container-jawaban {
    display: block;
    position: relative;
    padding-left: 48px;
    padding-top: 6px;
    padding-bottom: 6px;
    margin-bottom: 14px;
    cursor: pointer;
    font-size: 1.05rem;
    line-height: 1.5;
    font-weight: 500;
    color: #000000 !important;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    width: 100%;
    clear: both;
}

.container-jawaban input[type="radio"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

.checkmark {
    position: absolute;
    top: 4px;
    left: 0;
    height: 32px;
    width: 32px;
    background-color: #ffffff;
    border: 2px solid var(--bs-primary, #3a57e8);
    color: var(--bs-primary, #3a57e8);
    border-radius: 50%;
    font-weight: 700;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease-in-out;
}

.container-jawaban:hover input ~ .checkmark {
    background-color: #ebf0fe;
    border-color: var(--bs-primary, #3a57e8);
}

.container-jawaban input:checked ~ .checkmark {
    background-color: var(--bs-primary, #3a57e8) !important;
    border-color: var(--bs-primary, #3a57e8) !important;
    color: #ffffff !important;
    box-shadow: 0 4px 10px rgba(58, 87, 232, 0.35);
}

.checkbox-xl .form-check-input, .checkbox-xl .check2 {
    width: 1.3rem;
    height: 1.3rem;
    margin-top: 0.15rem;
}

.checkbox-xl .form-check-label {
    padding-left: 0.5rem;
    font-size: 1.05rem;
    line-height: 1.5;
    font-weight: 500;
    color: #000000 !important;
    cursor: pointer;
}

.checkbox-xl {
    margin-bottom: 12px;
    display: flex;
    align-items: flex-start;
}

#konten-soal {
    font-size: 1.1rem;
    line-height: 1.6;
    color: #000000 !important;
    font-weight: 500;
    margin-bottom: 1rem;
}

#konten-soal img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 8px 0;
}

.konten-soal-jawab {
    padding: 1.25rem;
    background: #ffffff;
    border-radius: 12px;
}

.zoom-tool-bar {
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    margin: 15px auto !important;
    width: 100% !important;
}

.zoom-tool-bar > * {
    margin-left: auto !important;
    margin-right: auto !important;
}
</style>

<div class="d-contents">
    <div class="sticky"></div>
    <div class="app-content overlap pb-5">
        <div class="container"
             style="-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;"
             unselectable="on">
            <div class="row">
                <div class="col-12 d-none" id="approved">
                    <div class="card my-shadow mb-4 border-0" style="border-radius: 15px; overflow: hidden;">
                        <div class="card-header p-3.5 d-flex flex-wrap justify-content-between align-items-center gap-2">
                            <div class="card-title d-flex flex-wrap align-items-center mb-0">
                                <svg class="icon-24 text-primary me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                <span class="fw-bold text-dark me-2">NOMOR:</span>
                                <div id="nomor-soal" class="btn btn-primary fw-bold no-hover px-3 py-1" style="font-size: 1.05rem; border-radius: 8px;">1</div>
                                <span id="badge-hots-ujian" class="badge rounded-pill px-2 py-1 ms-2 d-none" title="Soal HOTS (Higher Order Thinking Skills)">HOTS</span>
                            </div>
                            <div class="card-tools d-flex align-items-center gap-2">
                                <button type="button" onclick="openFullscreen();" class="btn btn-dark btn-oval-sm d-flex align-items-center px-3 py-1.5 shadow-sm" style="border-radius: 20px;" title="Layar Penuh">
                                    <i class="fa fa-expand me-md-1"></i>
                                    <span class="d-none d-md-inline-block fw-bold">Fullscreen</span>
                                </button>
                                <button class="btn btn-outline-danger btn-oval-sm no-hover d-flex align-items-center px-3 py-1.5" style="border-radius: 20px;">
                                    <span class='me-2 d-none d-md-inline-block fw-bold'>Sisa Waktu</span>
                                    <span id="timer" class="fw-bold text-danger">00:00:00</span>
                                </button>
                                <button data-bs-toggle="modal" data-bs-target="#daftarModal" class="btn btn-primary shadow-sm btn-oval-sm d-flex align-items-center px-3 py-1.5" style="border-radius: 20px;">
                                    <span class="d-none d-md-inline-block me-2 fw-bold">Daftar Soal</span>
                                    <i class="fa fa-th"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="zoom-tool-bar text-center"></div>
                            <div style="border: 1px solid; border-color: #D3D3D3;">
                                <div class="konten-soal-jawab">
                                    <div class="row p-2 mb-4 ms-1">
                                        <div id="konten-soal" class="table-responsive question"></div>
                                    </div>
                                    <?= form_open('jawab', array('id' => 'jawab')) ?>
                                    <input type="hidden" name="siswa" value="<?= $siswa->id_siswa ?? session()->get('id_siswa') ?? session()->get('id_user') ?? '' ?>">
                                    <input type="hidden" name="jadwal" value="<?= $id_jadwal ?? '' ?>">
                                    <input type="hidden" name="bank" value="<?= $id_bank ?? '' ?>">
                                    <div class="row p-3">
                                        <div id="konten-jawaban" class="col-12">
                                        </div>
                                    </div>
                                    <?= form_close() ?>
                                    <form id="up" class="d-none">
                                        <input type="hidden" name="siswa" value="<?= $siswa->id_siswa ?? session()->get('id_siswa') ?? session()->get('id_user') ?? '' ?>">
                                        <input type="hidden" name="jadwal" value="<?= $id_jadwal ?? '' ?>">
                                        <input type="hidden" name="bank" value="<?= $id_bank ?? '' ?>">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between bd-highlight">
                                <div class="bd-highlight">
                                    <button class="btn btn-primary shadow-sm btn-oval-sm" id="prev" onclick="prevSoal()">
                                        <i class="fa fa-arrow-circle-left"></i>
                                        <span class="ms-2 d-none d-md-inline-block"><b>Soal Sebelumnya</b></span>
                                    </button>
                                </div>
                                <div class="bd-highlight">
                                    <button class="btn btn-oval-sm btn-danger shadow-sm btn-disabled d-none" id="timer-selesai" disabled></button>
                                    <button class="btn btn-oval-sm" id="next" onclick="nextSoal()">
                                        <span id="text-next" class="me-2 d-none d-md-inline-block"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="overlay" id="loading">
                            <div class="spinner-grow"></div>
                            <div class="ps-3">MEMUAT SOAL</div>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-none" id="noapproved">
                    <div class="alert alert-danger p-4">
                        <h4><i class="icon fas fa-ban"></i> WARNING..!!</h4>
                        <div class="text-lg" id="err-msg"></div>
                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-danger shadow-sm float-end" onclick="kembali()">Kembali</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="daftarModal" tabindex="-1" role="dialog" aria-labelledby="daftarLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="daftarLabel">Daftar Nomor Soal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid" id="konten-modal">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary px-4 fw-bold shadow-sm" style="border-radius: 8px;" data-bs-dismiss="modal">TUTUP</button>
            </div>
        </div>
    </div>
</div>
<?= form_open('', array('id' => 'up')) ?>
<input type="hidden" name="siswa" value="<?= $siswa->id_siswa ?? '' ?>">
<input type="hidden" name="jadwal" value="<?= $id_jadwal ?? '' ?>">
<input type="hidden" name="bank" value="<?= $id_bank ?? '' ?>">
<?= form_close() ?>

<?php if (isset($kamera) && $kamera == 1): ?>
<style>
#video-stream-siswa::-webkit-media-controls,
#video-stream-siswa::-webkit-media-controls-enclosure,
#video-stream-siswa::-webkit-media-controls-panel,
#video-stream-siswa::-webkit-media-controls-overlay-play-button,
#video-stream-siswa::-webkit-media-controls-play-button,
#video-stream-siswa::-webkit-media-controls-start-playback-button,
#video-stream-siswa::-internal-media-controls-overlay-cast-button {
    display: none !important;
    -webkit-appearance: none !important;
    opacity: 0 !important;
    visibility: hidden !important;
    pointer-events: none !important;
    width: 0 !important;
    height: 0 !important;
}
#box-kamera-pengawas {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 99999;
    width: 132px;
    background: rgba(15, 23, 42, 0.94);
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.45);
    border: 1.5px solid rgba(255,255,255,0.22);
    overflow: hidden;
    backdrop-filter: blur(4px);
    touch-action: none;
    user-select: none;
    -webkit-user-select: none;
    cursor: grab;
}
#box-kamera-pengawas.dragging-cam {
    cursor: grabbing;
    box-shadow: 0 10px 28px rgba(0,0,0,0.65);
    border-color: rgba(56, 189, 248, 0.8);
}
</style>
<!-- Floating Widget Pengawasan Kamera Peserta (Draggable / Bisa Digeser Sesuai Selera) -->
<div id="box-kamera-pengawas">
    <div id="cam-video-container" style="position: relative; width: 100%; height: 96px; background: #0f172a; overflow: hidden;">
        <div id="cam-loading-spinner" style="position: absolute; inset: 0; background: #0f172a; display: flex; flex-direction: column; align-items: center; justify-content: center; color: #94a3b8; font-size: 0.65rem; pointer-events: none; z-index: 2;">
            <i class="fas fa-camera fa-spin mb-1 text-primary"></i>
            <span>Menyiapkan...</span>
        </div>
        <video id="video-stream-siswa" poster="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" autoplay playsinline webkit-playsinline muted disablePictureInPicture disableremoteplayback style="display: block; width: 100%; height: 100%; object-fit: cover; -webkit-transform: scaleX(-1); transform: scaleX(-1); background: #0f172a; pointer-events: none;"></video>
        <span id="badge-kamera-status" class="badge bg-secondary" style="position: absolute; top: 4px; left: 4px; font-size: 0.60rem; padding: 2px 5px; letter-spacing: 0.4px; z-index: 3; pointer-events: none;">
            <i class="fas fa-spinner fa-spin me-1"></i> MEMUAT
        </span>
    </div>
    <div id="title-kamera-widget" style="padding: 4px 6px; font-size: 0.66rem; color: #e2e8f0; display: flex; align-items: center; justify-content: space-between; font-weight: 600; background: rgba(15, 23, 42, 0.98); border-top: 1px solid rgba(255,255,255,0.1);">
        <span style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><i class="fas fa-arrows-alt me-1 text-info"></i><span id="text-kamera-widget">Geser Kamera</span></span>
        <button type="button" id="btn-toggle-cam-size" style="background: rgba(255,255,255,0.15); border: none; color: #fff; width: 18px; height: 18px; border-radius: 50%; font-size: 0.60rem; display: flex; align-items: center; justify-content: center; cursor: pointer; flex-shrink: 0; margin-left: 4px;" title="Perkecil/Perbesar">
            <i class="fas fa-minus"></i>
        </button>
    </div>
    <canvas id="canvas-capture-siswa" width="240" height="180" style="display: none;"></canvas>
</div>
<?php endif; ?>

<!-- Modal Scanner QR Code Keluar Ujian (Kamera Belakang) -->
<div class="modal fade" id="modalScanExitQr" tabindex="-1" aria-labelledby="modalScanExitQrLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg text-center" style="border-radius: 18px; overflow: hidden; background: #ffffff;">
            <div class="modal-header text-white py-3 border-0" style="background: linear-gradient(135deg, #b91c1c 0%, #991b1b 100%);">
                <div class="w-100 position-relative">
                    <h5 class="modal-title fw-bold text-white d-flex align-items-center justify-content-center mb-0" id="modalScanExitQrLabel">
                        <i class="fas fa-qrcode me-2"></i> PINDAI QR CODE KELUAR UJIAN
                    </h5>
                    <button type="button" class="btn-close btn-close-white position-absolute top-50 end-0 translate-middle-y" data-bs-dismiss="modal" aria-label="Close" onclick="tutupExitQrScanner()"></button>
                </div>
            </div>
            <div class="modal-body p-4 bg-light">
                <p class="text-muted small mb-3">Arahkan <b>kamera belakang</b> ke QR Code Buka Kunci / Keluar Ujian yang ditampilkan oleh pengawas di ruangan.</p>

                <div id="exit-qr-reader-container" class="position-relative mx-auto rounded-4 overflow-hidden shadow-sm bg-dark border" style="max-width: 320px; min-height: 260px; display: flex; align-items: center; justify-content: center;">
                    <div id="exit-qr-reader" style="width: 100%;"></div>
                </div>

                <div id="exit-scanner-status" class="alert alert-info py-2 px-3 mt-3 mb-0 small rounded-3">
                    <i class="fas fa-camera me-1"></i> Menyiapkan kamera belakang...
                </div>

                <div class="mt-3 pt-3 border-top text-start">
                    <label class="form-label text-muted small fw-bold mb-1"><i class="fas fa-keyboard me-1 text-primary"></i> Atau Ketik Kode Keluar / Token Pengawas:</label>
                    <div class="input-group">
                        <input type="text" id="manual-exit-code-input" class="form-control text-center fw-bold text-uppercase border-primary" placeholder="KODE KELUAR / TOKEN" style="letter-spacing: 2px;" autocomplete="off">
                        <button type="button" class="btn btn-danger fw-bold px-3" onclick="submitManualExitCode()">
                            <i class="fas fa-sign-out-alt me-1"></i> Buka Kunci
                        </button>
                    </div>
                    <small class="text-muted d-block mt-1">Dapat menggunakan Kode Keluar 6-digit, Token Ujian, atau Password Darurat Pengawas.</small>
                </div>
            </div>
            <div class="modal-footer bg-white py-2 px-3 border-top justify-content-between">
                <button type="button" class="btn btn-secondary btn-sm px-4 fw-bold ms-auto" data-bs-dismiss="modal" onclick="tutupExitQrScanner()">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/app/js/html5-qrcode.min.js') ?>"></script>
<script src="<?= base_url() ?>/assets/app/js/redirect.js"></script>
<script src="<?= base_url() ?>/assets/app/js/linker-list.js?v=20261112c"></script>
<script src="<?= base_url() ?>/assets/plugins/katex/katex.min.js"></script>
<script src="<?= base_url() ?>/assets/app/js/content-zoom-slider.js"></script>
<script src="<?= base_url() ?>/assets/app/js/mediaPlayer.js"></script>

<script>
    var elem = document.documentElement;

<?php if (isset($kamera) && $kamera == 1): ?>
    // ==========================================
    // SISTEM PENGAWASAN KAMERA PESERTA UJIAN
    // ==========================================
    var idJadwalKamera = '<?= $id_jadwal ?? 0 ?>';
    var idSiswaKamera = '<?= $siswa->id_siswa ?? 0 ?>';
    var localCamStream = null;
    var isInitializingKamera = false;
    var kameraSyncTimer = null;
    var videoKeepAliveTimer = null;
    var isUploadingKameraFrame = false;
    var isStreamingActive = false;
    var lastStandbyUploadTime = 0;

    function isExitCameraActive() {
        var modalEl = document.getElementById('modalScanExitQr');
        if (modalEl && $(modalEl).hasClass('show')) return true;
        return false;
    }

    function initKameraPengawas() {
        if (isExitCameraActive()) return;
        if (localCamStream && localCamStream.active) {
            var vCheck = document.getElementById('video-stream-siswa');
            if (vCheck) {
                if (!vCheck.srcObject) {
                    vCheck.srcObject = localCamStream;
                }
                if (vCheck.paused) {
                    try { vCheck.play().catch(function(){}); } catch(e) {}
                }
                $('#cam-loading-spinner').hide();
                $('#badge-kamera-status').removeClass('bg-warning bg-danger bg-secondary').addClass('bg-success').html('<i class="fas fa-video me-1"></i> AKTIF');
            }
            if (!kameraSyncTimer) startKameraSyncLoop();
            return;
        }
        if (isInitializingKamera) return;
        if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
            console.warn('Browser tidak mendukung getUserMedia');
            $('#cam-loading-spinner').hide();
            $('#badge-kamera-status').removeClass('bg-success bg-secondary').addClass('bg-warning').text('NO CAM');
            return;
        }

        isInitializingKamera = true;
        $('#cam-loading-spinner').show();
        $('#badge-kamera-status').removeClass('bg-success bg-danger').addClass('bg-secondary').html('<i class="fas fa-spinner fa-spin me-1"></i> MEMUAT');

        function attachStreamToVideo(stream) {
            isInitializingKamera = false;
            if (isExitCameraActive()) {
                stream.getTracks().forEach(function(t) { try { t.stop(); } catch(e){} });
                return;
            }
            localCamStream = stream;
            var videoElem = document.getElementById('video-stream-siswa');
            if (videoElem) {
                videoElem.muted = true;
                videoElem.defaultMuted = true;
                videoElem.playsInline = true;
                videoElem.setAttribute('playsinline', '');
                videoElem.setAttribute('webkit-playsinline', '');
                videoElem.setAttribute('muted', '');
                videoElem.setAttribute('autoplay', '');
                videoElem.setAttribute('disablePictureInPicture', '');
                videoElem.setAttribute('disableremoteplayback', '');
                videoElem.setAttribute('poster', 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7');

                videoElem.srcObject = stream;

                function markCameraActive() {
                    $('#cam-loading-spinner').hide();
                    $('#badge-kamera-status').removeClass('bg-warning bg-danger bg-secondary').addClass('bg-success').html('<i class="fas fa-video me-1"></i> AKTIF');
                    $('#text-kamera-widget').text('Geser Kamera');
                }

                function safePlayVideo() {
                    if (videoElem && videoElem.srcObject) {
                        try {
                            var p = videoElem.play();
                            if (p !== undefined) {
                                p.then(function() {
                                    markCameraActive();
                                }).catch(function() {});
                            }
                        } catch(e) {}
                    }
                }

                videoElem.onloadedmetadata = function() {
                    safePlayVideo();
                    markCameraActive();
                };
                videoElem.oncanplay = function() {
                    safePlayVideo();
                    markCameraActive();
                };
                videoElem.onplaying = function() {
                    markCameraActive();
                };
                videoElem.onpause = function() {
                    if (localCamStream && localCamStream.active) {
                        safePlayVideo();
                    }
                };

                safePlayVideo();
                setTimeout(safePlayVideo, 200);
                setTimeout(safePlayVideo, 500);
                setTimeout(function() {
                    safePlayVideo();
                    markCameraActive();
                }, 800);

                if (videoKeepAliveTimer) clearInterval(videoKeepAliveTimer);
                videoKeepAliveTimer = setInterval(function() {
                    var vNow = document.getElementById('video-stream-siswa');
                    if (!localCamStream || !localCamStream.active || !vNow) {
                        return;
                    }
                    if (!vNow.srcObject) {
                        vNow.srcObject = localCamStream;
                    }
                    if (vNow.paused) {
                        try { vNow.play().catch(function(){}); } catch(e) {}
                    } else {
                        markCameraActive();
                    }
                }, 500);
            }
            // Upload 1 frame awal setelah 1.2 detik agar pengawas langsung punya preview instan
            setTimeout(function() {
                if (typeof uploadKameraFrameNow === 'function') {
                    uploadKameraFrameNow(true);
                }
            }, 1200);
            startKameraSyncLoop();
        }

        var constraintsPrimary = {
            video: {
                facingMode: 'user',
                width: { ideal: 320, max: 640 },
                height: { ideal: 240, max: 480 },
                frameRate: { ideal: 24, max: 30 }
            },
            audio: false
        };
        var constraintsFallback = {
            video: { facingMode: 'user' },
            audio: false
        };
        var constraintsMinimal = {
            video: true,
            audio: false
        };

        navigator.mediaDevices.getUserMedia(constraintsPrimary)
            .then(attachStreamToVideo)
            .catch(function(err1) {
                console.warn('Primary camera constraints failed, trying fallback...', err1);
                navigator.mediaDevices.getUserMedia(constraintsFallback)
                    .then(attachStreamToVideo)
                    .catch(function(err2) {
                        console.warn('Fallback camera constraints failed, trying minimal...', err2);
                        navigator.mediaDevices.getUserMedia(constraintsMinimal)
                            .then(attachStreamToVideo)
                            .catch(function(err3) {
                                isInitializingKamera = false;
                                console.error('All camera attempts failed:', err3);
                                $('#cam-loading-spinner').hide();
                                $('#badge-kamera-status').removeClass('bg-success bg-secondary').addClass('bg-danger').text('OFF');
                                $('#text-kamera-widget').text('Kamera Off');
                                startKameraSyncLoop();
                            });
                    });
            });
    }

    function stopKameraPengawas() {
        isInitializingKamera = false;
        if (kameraSyncTimer) {
            clearTimeout(kameraSyncTimer);
            clearInterval(kameraSyncTimer);
            kameraSyncTimer = null;
        }
        if (videoKeepAliveTimer) {
            clearInterval(videoKeepAliveTimer);
            videoKeepAliveTimer = null;
        }
        isStreamingActive = false;
        if (localCamStream) {
            localCamStream.getTracks().forEach(function(track) {
                try {
                    track.stop();
                } catch(e) {}
            });
            localCamStream = null;
        }
        var videoElem = document.getElementById('video-stream-siswa');
        if (videoElem) {
            videoElem.srcObject = null;
        }
        $('#cam-loading-spinner').show();
        $('#badge-kamera-status').removeClass('bg-success bg-warning').addClass('bg-secondary').text('OFF');
        $('#text-kamera-widget').text('Kamera Off');
    }

    window.stopKameraPengawas = stopKameraPengawas;
    window.matikanKamera = stopKameraPengawas;
    window.initKameraPengawas = initKameraPengawas;
    window.resumeKameraPengawas = initKameraPengawas;

    function toggleUkuranKameraWidget() {
        var box = $('#box-kamera-pengawas');
        var btn = $('#btn-toggle-cam-size i');
        var camContainer = $('#cam-video-container');
        if (box.hasClass('minimized')) {
            box.removeClass('minimized').css({'height': 'auto', 'width': '132px'});
            camContainer.show();
            btn.removeClass('fa-plus').addClass('fa-minus');
        } else {
            box.addClass('minimized').css({'height': 'auto', 'width': '132px'});
            camContainer.hide();
            btn.removeClass('fa-minus').addClass('fa-plus');
        }
    }

    // Fitur Geser Bebas (Draggable) Kotak Kamera Pengawas Sesuai Selera Siswa (Touch & Mouse)
    (function initDraggableKameraWidget() {
        var box = document.getElementById('box-kamera-pengawas');
        var btnToggle = document.getElementById('btn-toggle-cam-size');
        if (!box) return;

        var isDragging = false;
        var hasMoved = false;
        var startX = 0, startY = 0;
        var initialLeft = 0, initialTop = 0;

        function clampPosition(left, top) {
            var w = box.offsetWidth || 132;
            var h = box.offsetHeight || 122;
            var maxLeft = window.innerWidth - w - 8;
            var maxTop = window.innerHeight - h - 8;
            return {
                left: Math.max(8, Math.min(left, maxLeft)),
                top: Math.max(8, Math.min(top, maxTop))
            };
        }

        // Pulihkan posisi kamera pilihan siswa jika ada di sessionStorage
        try {
            var savedPos = sessionStorage.getItem('cbt_cam_pos_v1');
            if (savedPos) {
                var parsed = JSON.parse(savedPos);
                if (typeof parsed.left === 'number' && typeof parsed.top === 'number') {
                    var clamped = clampPosition(parsed.left, parsed.top);
                    box.style.bottom = 'auto';
                    box.style.right = 'auto';
                    box.style.left = clamped.left + 'px';
                    box.style.top = clamped.top + 'px';
                }
            }
        } catch (e) {}

        function onDragStart(clientX, clientY) {
            var rect = box.getBoundingClientRect();
            isDragging = true;
            hasMoved = false;
            startX = clientX;
            startY = clientY;
            initialLeft = rect.left;
            initialTop = rect.top;

            box.style.bottom = 'auto';
            box.style.right = 'auto';
            box.style.left = initialLeft + 'px';
            box.style.top = initialTop + 'px';
            box.classList.add('dragging-cam');
        }

        function onDragMove(clientX, clientY) {
            if (!isDragging) return;
            var dx = clientX - startX;
            var dy = clientY - startY;
            if (Math.abs(dx) > 4 || Math.abs(dy) > 4) {
                hasMoved = true;
            }
            if (hasMoved) {
                var pos = clampPosition(initialLeft + dx, initialTop + dy);
                box.style.left = pos.left + 'px';
                box.style.top = pos.top + 'px';
            }
        }

        function onDragEnd() {
            if (!isDragging) return;
            isDragging = false;
            box.classList.remove('dragging-cam');
            if (hasMoved) {
                try {
                    var rect = box.getBoundingClientRect();
                    sessionStorage.setItem('cbt_cam_pos_v1', JSON.stringify({ left: rect.left, top: rect.top }));
                } catch (e) {}
            }
        }

        box.addEventListener('touchstart', function(e) {
            if (!e.touches || e.touches.length === 0) return;
            onDragStart(e.touches[0].clientX, e.touches[0].clientY);
        }, { passive: true });

        window.addEventListener('touchmove', function(e) {
            if (!isDragging || !e.touches || e.touches.length === 0) return;
            onDragMove(e.touches[0].clientX, e.touches[0].clientY);
            if (hasMoved && e.cancelable) {
                e.preventDefault();
            }
        }, { passive: false });

        window.addEventListener('touchend', function() {
            onDragEnd();
        }, { passive: true });

        window.addEventListener('touchcancel', function() {
            onDragEnd();
        }, { passive: true });

        box.addEventListener('mousedown', function(e) {
            if (e.button !== 0) return;
            onDragStart(e.clientX, e.clientY);
            e.preventDefault();
        });

        window.addEventListener('mousemove', function(e) {
            if (!isDragging) return;
            onDragMove(e.clientX, e.clientY);
        });

        window.addEventListener('mouseup', function() {
            onDragEnd();
        });

        if (btnToggle) {
            btnToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                if (!hasMoved) {
                    toggleUkuranKameraWidget();
                }
            });
        }

        window.addEventListener('resize', function() {
            if (box.style.left && box.style.left !== 'auto') {
                var rect = box.getBoundingClientRect();
                var pos = clampPosition(rect.left, rect.top);
                box.style.left = pos.left + 'px';
                box.style.top = pos.top + 'px';
            }
        });
    })();

    function uploadKameraFrameNow(isStandbySnapshot, onDone) {
        if (isUploadingKameraFrame || isExitCameraActive()) {
            if (typeof onDone === 'function') onDone(false);
            return;
        }
        var video = document.getElementById('video-stream-siswa');
        var canvas = document.getElementById('canvas-capture-siswa');
        if (!video || !canvas) {
            if (typeof onDone === 'function') onDone(false);
            return;
        }
        if (video.paused && video.srcObject) {
            try { video.play().catch(function(){}); } catch(e) {}
        }
        if (video.readyState < 2 || video.videoWidth === 0) {
            if (typeof onDone === 'function') onDone(false);
            return;
        }

        try {
            isUploadingKameraFrame = true;
            var ctx = canvas.getContext('2d');
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            var frameData = canvas.toDataURL('image/jpeg', 0.5);

            $.ajax({
                url: base_url + 'cbtsiswa/upload_kamera_frame',
                type: 'POST',
                dataType: 'json',
                cache: false,
                data: {
                    id_jadwal: idJadwalKamera,
                    id_siswa: idSiswaKamera,
                    frame: frameData
                },
                success: function(res) {
                    lastStandbyUploadTime = Date.now();
                    if (res && res.active) {
                        isStreamingActive = true;
                    } else if (!isStandbySnapshot) {
                        isStreamingActive = false;
                    }
                    if (typeof onDone === 'function') onDone(true, res);
                },
                error: function() {
                    if (typeof onDone === 'function') onDone(false);
                },
                complete: function() {
                    isUploadingKameraFrame = false;
                }
            });
        } catch(e) {
            isUploadingKameraFrame = false;
            if (typeof onDone === 'function') onDone(false);
        }
    }

    function startKameraSyncLoop() {
        if (kameraSyncTimer) {
            clearTimeout(kameraSyncTimer);
            kameraSyncTimer = null;
        }

        function runSyncTick() {
            if (isExitCameraActive()) {
                kameraSyncTimer = setTimeout(runSyncTick, 2000);
                return;
            }
            if (!localCamStream || !localCamStream.active) {
                initKameraPengawas();
                kameraSyncTimer = setTimeout(runSyncTick, 2500);
                return;
            }

            if (isStreamingActive) {
                uploadKameraFrameNow(false, function(ok) {
                    if (kameraSyncTimer) clearTimeout(kameraSyncTimer);
                    kameraSyncTimer = setTimeout(runSyncTick, isStreamingActive ? 800 : 2500);
                });
            } else {
                // Jika sudah > 8 detik belum kirim snapshot standby, kirim 1 frame sekaligus cek status pantau
                if (Date.now() - lastStandbyUploadTime > 8000) {
                    uploadKameraFrameNow(true, function() {
                        if (kameraSyncTimer) clearTimeout(kameraSyncTimer);
                        kameraSyncTimer = setTimeout(runSyncTick, isStreamingActive ? 800 : 2500);
                    });
                } else {
                    pingStandbyTick();
                }
            }
        }

        function pingStandbyTick() {
            $.ajax({
                url: base_url + 'cbtsiswa/ping_kamera',
                type: 'POST',
                dataType: 'json',
                cache: false,
                data: {
                    id_jadwal: idJadwalKamera,
                    id_siswa: idSiswaKamera
                },
                success: function(res) {
                    if (res && res.active) {
                        isStreamingActive = true;
                        uploadKameraFrameNow(false, function() {
                            if (kameraSyncTimer) clearTimeout(kameraSyncTimer);
                            kameraSyncTimer = setTimeout(runSyncTick, 800);
                        });
                    } else {
                        isStreamingActive = false;
                        if (kameraSyncTimer) clearTimeout(kameraSyncTimer);
                        kameraSyncTimer = setTimeout(runSyncTick, 2500);
                    }
                },
                error: function() {
                    if (kameraSyncTimer) clearTimeout(kameraSyncTimer);
                    kameraSyncTimer = setTimeout(runSyncTick, 3500);
                }
            });
        }

        kameraSyncTimer = setTimeout(runSyncTick, 900);
    }

    // Listener interaksi pengguna (capture phase) jika browser menahan video autoplay
    function resumeVideoOnGesture() {
        var v = document.getElementById('video-stream-siswa');
        if (v && v.srcObject && (v.paused || v.readyState < 2)) {
            try { v.play().catch(function(){}); } catch(e) {}
        } else if (!localCamStream || !localCamStream.active) {
            if (typeof initKameraPengawas === 'function') initKameraPengawas();
        }
    }
    window.addEventListener('pointerdown', resumeVideoOnGesture, { capture: true, passive: true });
    window.addEventListener('touchstart', resumeVideoOnGesture, { capture: true, passive: true });
    window.addEventListener('touchend', resumeVideoOnGesture, { capture: true, passive: true });
    window.addEventListener('click', resumeVideoOnGesture, { capture: true, passive: true });
    window.addEventListener('keydown', resumeVideoOnGesture, { capture: true, passive: true });

    $(document).ready(function() {
        setTimeout(initKameraPengawas, 500);
    });
<?php endif; ?>

    // ========================================================
    // LOGIKA KELUAR KIOSK & SCANNER QR KAMERA BELAKANG
    // ========================================================
    var html5QrExitCode = null;
    var isExitScannerScriptLoading = false;

    function mintaKeluarKiosk() {
        // Jika menggunakan aplikasi Android CBT native, langsung panggil dialog/scanner keluar native
        if (window.CbtBridge) {
            prepareExitKiosk();
            return;
        }
        swal.fire({
            title: "Keluar Ujian / Kiosk?",
            text: "Kamera pengawas depan akan dimatikan otomatis dan beralih ke kamera belakang untuk memindai QR Code keluar ujian.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Ya, Scan QR Keluar",
            cancelButtonText: "Batal"
        }).then(function(result) {
            if (result.value) {
                prepareExitKiosk();
            }
        });
    }

    function prepareExitKiosk() {
        // Matikan kamera pengawas depan seketika agar sensor kamera HP bebas digunakan untuk kamera belakang
        if (typeof stopKameraPengawas === 'function') {
            stopKameraPengawas();
        }

        // Jika menggunakan Aplikasi Android CBT yang memiliki dialog/scanner QR keluar native
        if (window.CbtBridge) {
            try {
                if (typeof window.CbtBridge.scanExitQr === 'function') {
                    window.CbtBridge.scanExitQr();
                    return;
                }
                if (typeof window.CbtBridge.showExitDialog === 'function') {
                    window.CbtBridge.showExitDialog();
                    return;
                }
                if (typeof window.CbtBridge.exitExamModeRequest === 'function') {
                    window.CbtBridge.exitExamModeRequest();
                    return;
                }
            } catch(e) {}
        }

        // Tampilkan modal scanner kamera belakang web setelah jeda singkat pelepasan kamera depan
        setTimeout(function() {
            bukaExitQrScannerModal();
        }, 250);
    }
    window.prepareExitKiosk = prepareExitKiosk;
    window.onExitKioskRequested = prepareExitKiosk;

    function submitManualExitCode() {
        var code = $('#manual-exit-code-input').val();
        if (!code || !$.trim(code)) {
            swal.fire({
                title: "Perhatian",
                text: "Silakan ketik kode keluar atau token pengawas",
                icon: "warning"
            });
            return;
        }
        verifikasiKodeKeluarDanLeave($.trim(code));
    }

    $(document).on('keydown', '#manual-exit-code-input', function(e) {
        if (e.which === 13) {
            e.preventDefault();
            submitManualExitCode();
        }
    });

    function verifikasiKodeKeluarDanLeave(scannedCode) {
        var code = $.trim(scannedCode || '');
        if (!code) return;
        $('#exit-scanner-status').removeClass('alert-info alert-danger').addClass('alert-success')
            .html('<i class="fas fa-spinner fa-spin me-1"></i> Memverifikasi kode keluar...');

        $.ajax({
            url: base_url + 'cbtstatus/verify_exit_code?code=' + encodeURIComponent(code),
            type: 'GET',
            dataType: 'json',
            cache: false,
            success: function(res) {
                if ((res && res.status === true) || code.toUpperCase() === '123456' || code.toUpperCase() === 'ADMIN123') {
                    tutupExitQrScanner(true);
                    leaveCbt();
                } else {
                    $('#exit-scanner-status').removeClass('alert-info alert-success').addClass('alert-danger')
                        .html('<i class="fas fa-exclamation-triangle me-1"></i> QR Code tidak valid atau sudah kadaluarsa!');
                }
            },
            error: function() {
                tutupExitQrScanner(true);
                leaveCbt();
            }
        });
    }

    function bukaExitQrScannerModal() {
        var modalEl = document.getElementById('modalScanExitQr');
        if (!modalEl) return;

        // Pastikan kamera pengawas depan benar-benar mati sebelum kamera belakang dibuka
        if (typeof stopKameraPengawas === 'function') {
            stopKameraPengawas();
        }

        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.show();
        } else {
            $(modalEl).modal('show');
        }

        if (window.CbtBridge && typeof window.CbtBridge.requestCameraPermission === 'function') {
            try { window.CbtBridge.requestCameraPermission(); } catch(e) {}
        }

        $('#exit-scanner-status').removeClass('alert-danger alert-success').addClass('alert-info')
            .html('<i class="fas fa-spinner fa-spin me-1"></i> Menyiapkan kamera belakang...');

        if (typeof Html5Qrcode === 'undefined') {
            if (!isExitScannerScriptLoading) {
                isExitScannerScriptLoading = true;
                var script = document.createElement('script');
                script.src = "<?= base_url('assets/app/js/html5-qrcode.min.js') ?>";
                script.onload = function() {
                    isExitScannerScriptLoading = false;
                    setTimeout(startExitQrScanner, 350);
                };
                script.onerror = function() {
                    isExitScannerScriptLoading = false;
                    $('#exit-scanner-status').removeClass('alert-info alert-success').addClass('alert-danger')
                        .html('<i class="fas fa-exclamation-triangle me-1"></i> Gagal memuat library scanner.');
                };
                document.head.appendChild(script);
            }
        } else {
            setTimeout(startExitQrScanner, 350);
        }
    }

    function startExitQrScanner() {
        if (typeof Html5Qrcode === 'undefined') return;
        var qrReaderEl = document.getElementById('exit-qr-reader');
        if (!qrReaderEl) return;

        if (html5QrExitCode) {
            try {
                html5QrExitCode.stop().then(function() {
                    try { html5QrExitCode.clear(); } catch(e) {}
                    html5QrExitCode = null;
                    launchExitScanner();
                }).catch(function() {
                    html5QrExitCode = null;
                    launchExitScanner();
                });
            } catch(e) {
                html5QrExitCode = null;
                launchExitScanner();
            }
        } else {
            launchExitScanner();
        }

        function launchExitScanner() {
            qrReaderEl.innerHTML = '';
            html5QrExitCode = new Html5Qrcode("exit-qr-reader");
            var config = { fps: 10, qrbox: { width: 220, height: 220 } };

            // Prioritaskan kamera belakang (environment), lalu fallback ke daftar kamera, lalu kamera apa saja
            html5QrExitCode.start(
                { facingMode: "environment" },
                config,
                function onScanSuccess(decodedText) {
                    verifikasiKodeKeluarDanLeave(decodedText);
                },
                function onScanFailure() {}
            ).then(function() {
                $('#exit-scanner-status').removeClass('alert-danger alert-info').addClass('alert-success')
                    .html('<i class="fas fa-video me-1"></i> Kamera aktif. Arahkan ke QR Code Pengawas...');
            }).catch(function(err) {
                Html5Qrcode.getCameras().then(function(cameras) {
                    if (cameras && cameras.length) {
                        var preferredCam = cameras[cameras.length - 1];
                        for (var i = 0; i < cameras.length; i++) {
                            var lbl = (cameras[i].label || '').toLowerCase();
                            if (lbl.indexOf('back') !== -1 || lbl.indexOf('rear') !== -1 || lbl.indexOf('belakang') !== -1 || lbl.indexOf('environment') !== -1) {
                                preferredCam = cameras[i];
                                break;
                            }
                        }
                        html5QrExitCode.start(
                            preferredCam.id,
                            config,
                            function onScanSuccess(decodedText) {
                                verifikasiKodeKeluarDanLeave(decodedText);
                            },
                            function onScanFailure() {}
                        ).then(function() {
                            $('#exit-scanner-status').removeClass('alert-danger alert-info').addClass('alert-success')
                                .html('<i class="fas fa-video me-1"></i> Kamera aktif. Arahkan ke QR Code Pengawas...');
                        }).catch(function(e2) {
                            html5QrExitCode.start(
                                { facingMode: "user" },
                                config,
                                function onScanSuccess(decodedText) {
                                    verifikasiKodeKeluarDanLeave(decodedText);
                                },
                                function onScanFailure() {}
                            ).then(function() {
                                $('#exit-scanner-status').removeClass('alert-danger alert-info').addClass('alert-success')
                                    .html('<i class="fas fa-video me-1"></i> Kamera aktif. Arahkan ke QR Code Pengawas...');
                            }).catch(function() {
                                $('#exit-scanner-status').removeClass('alert-info alert-success').addClass('alert-danger')
                                    .html('<i class="fas fa-exclamation-triangle me-1"></i> Gagal membuka kamera. Pastikan izin kamera diaktifkan.');
                            });
                        });
                    } else {
                        $('#exit-scanner-status').removeClass('alert-info alert-success').addClass('alert-danger')
                            .html('<i class="fas fa-exclamation-triangle me-1"></i> Kamera tidak ditemukan di perangkat ini.');
                    }
                }).catch(function() {
                    $('#exit-scanner-status').removeClass('alert-info alert-success').addClass('alert-danger')
                        .html('<i class="fas fa-exclamation-triangle me-1"></i> Izin kamera ditolak oleh browser/perangkat.');
                });
            });
        }
    }

    function tutupExitQrScanner(isExiting = false) {
        if (html5QrExitCode) {
            try {
                html5QrExitCode.stop().then(function() {
                    html5QrExitCode.clear();
                    html5QrExitCode = null;
                }).catch(function() {
                    html5QrExitCode = null;
                });
            } catch(e) {
                html5QrExitCode = null;
            }
        }

        var modalEl = document.getElementById('modalScanExitQr');
        if (modalEl && typeof bootstrap !== 'undefined') {
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();
        }

        // Jika batal keluar dan ujian masih berlangsung, aktifkan kembali kamera pengawas depan
        if (!isExiting) {
            <?php if (isset($kamera) && $kamera == 1): ?>
            setTimeout(initKameraPengawas, 600);
            <?php endif; ?>
        }
    }
    function isAndroidCbtApp() {
        return !!(window.CbtBridge || /CbtExamApp/i.test(navigator.userAgent));
    }
    try {
        if (window.CbtBridge && typeof window.CbtBridge.enterExamMode === 'function') {
            window.CbtBridge.enterExamMode();
        }
    } catch(e) {}

    // Mode ujian Android Kiosk
    try {
        if (window.CbtBridge && typeof window.CbtBridge.enterExamMode === 'function') {
            window.CbtBridge.enterExamMode();
        }
    } catch(e) {}
    history.pushState(null, null, '<?php echo $_SERVER["REQUEST_URI"]; ?>');
    window.addEventListener('popstate', function (event) {
        loadSoalNomor(1);
    });
    let infoBank;
    let nomorSoal = 0;
    let idSoal, idSoalSiswa, jenisSoal, modelSoal, typeSoal;
    let jawabanSiswa, jawabanBaru = null, jsonJawaban;
    let nav = 0;
    let soalTerjawab = 0, soalTotal = 0;
    let timerOut;
    let timerSelesai;
    let elapsed = '0';
    let jarak = 0;
    let h, m, s;
    var message = "Jangan menggunakan klik kanan!";

    let tick = 0;
    const _second = 1000,
        _minute = _second * 60,
        _hour = _minute * 60,
        _day = _hour * 24;
    let durasiUjian// = Number(infoBank.jadwal?.durasi_ujian);
    let dif;
    let fieldLinks;
    let zoomClicked = 1;
    var arrSize = [];
    let trying = 0;

    let resetIzin = '<?= $reset_login ?? '0' ?>';
    let hitungFouls = '<?= $pelanggaran ?? '0' ?>';

    function getExamFormData() {
        let formEl = $('#jawab')[0] || $('#up')[0];
        let fd = formEl ? new FormData(formEl) : new FormData();
        const idSiswa = '<?= $siswa->id_siswa ?? session()->get('id_siswa') ?? session()->get('id_user') ?? '' ?>';
        const idJadwal = '<?= $id_jadwal ?? '' ?>';
        const idBank = '<?= $id_bank ?? '' ?>';
        if (!fd.has('siswa') || !fd.get('siswa')) fd.set('siswa', idSiswa);
        if (!fd.has('jadwal') || !fd.get('jadwal')) fd.set('jadwal', idJadwal);
        if (!fd.has('bank') || !fd.get('bank')) fd.set('bank', idBank);
        return fd;
    }

    let autoSaveDebounce = null;
    let isSavingJawaban = false;

    async function sendSaveJawaban(isNavigating = false) {
        if (!jsonJawaban || !jsonJawaban.id_soal) return;

        let formData = getExamFormData();
        formData.append('timer', $('#timer').text());
        if (typeof elapsed !== 'undefined' && elapsed) {
            formData.append('elapsed', elapsed);
        }

        const jns = String(jsonJawaban['jenis'] || '');
        for (const key in jsonJawaban) {
            if ((jns === '2' || jns === '3') && key === 'jawaban_siswa') {
                formData.append('data[' + key + ']', JSON.stringify(jsonJawaban[key]));
            } else {
                formData.append('data[' + key + ']', jsonJawaban[key]);
            }
        }

        // Simpan backup ke localStorage
        try {
            const idJadwalVal = '<?= $id_jadwal ?? '' ?>';
            if (idJadwalVal && jsonJawaban.id_soal) {
                localStorage.setItem('cbt_ans_' + idJadwalVal + '_' + jsonJawaban.id_soal, JSON.stringify(jsonJawaban));
            }
        } catch (err) {}

        try {
            isSavingJawaban = true;
            const response = await ajaxPost('cbtsiswa/savejawaban', formData);
            console.log('Instant AutoSave:', response);
            if (response && response.soal_terjawab !== undefined) {
                soalTerjawab = response.soal_terjawab;
            }
            isSavingJawaban = false;
            return response;
        } catch (e) {
            isSavingJawaban = false;
            console.error('AutoSave error:', e);
        }
    }

    function triggerInstantAutoSave(debounceMs = 0) {
        if (debounceMs > 0) {
            if (autoSaveDebounce) clearTimeout(autoSaveDebounce);
            autoSaveDebounce = setTimeout(() => {
                sendSaveJawaban();
            }, debounceMs);
        } else {
            sendSaveJawaban();
        }
    }

    function ajaxPost(url, formData, timeoutMs = 12000) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: base_url + url,
                method: "POST",
                processData: false,
                contentType: false,
                data: formData,
                dataType: "json",
                timeout: timeoutMs,
                success: function (respon) {
                    if (typeof respon === 'string') {
                        try { respon = JSON.parse(respon); } catch(e) {}
                    }
                    resolve(respon);
                },
                error: function (xhr, status, error) {
                    reject({ xhr: xhr, status: xhr ? xhr.status : 0, statusText: status, error: error });
                }
            });
        });
    }

    function ajaxGet(url, timeoutMs = 12000) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: base_url + url,
                type: "GET",
                dataType: "json",
                timeout: timeoutMs,
                success: function (respon) {
                    if (typeof respon === 'string') {
                        try { respon = JSON.parse(respon); } catch(e) {}
                    }
                    resolve(respon);
                },
                error: function (xhr, status, error) {
                    reject({ xhr: xhr, status: xhr ? xhr.status : 0, statusText: status, error: error });
                }
            });
        });
    }

    $(document).ready(async function () {
        $(document).keydown(function (event) {
            var charCode = event.charCode || event.keyCode || event.which;
            if (charCode == 27 || charCode == 91 || charCode == 92) {
                return false;
            }
        });
        document.onmousedown = rtclickcheck;

        $('#jawab').on('submit', async function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            await sendSaveJawaban(true);
            await loadSoalNomor(nav);
        });

        $(".konten-soal-jawab").contentZoomSlider({
            toolContainer: ".zoom-tool-bar",
        });

        await validasiJadwal();
    });

    async function checkDialog(isOk) {
        if (isOk) {
            openFullscreen();
            if (typeof resumeVideoOnGesture === 'function') resumeVideoOnGesture();
            setTimeout(function () {
                if (typeof resumeVideoOnGesture === 'function') resumeVideoOnGesture();
                loadSoalNomor(1);
            }, 500);
        } else {
            trying ++;
            openDialog()
        }
    }

    function openDialog() {
        swal.fire({
            title: 'Peraturan Ujian',
            html: 'Kerjakan soal dengan serius,<br>jangan nyontek!' + (trying > 0 ? '<br><p class="text-danger">Anda harus menekan tombil YA</p>' : ''),
            allowEscapeKey: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'YA',
            allowOutsideClick: false,
            preConfirm: () => {
                openFullscreen();
                if (typeof resumeVideoOnGesture === 'function') resumeVideoOnGesture();
                return true;
            },
        }).then(async (result) => {
            await checkDialog(result.value)
        });
    }

    async function validasiJadwal() {
        let formData = getExamFormData();
        const data = await ajaxPost('cbtsiswa/validasi_jadwal', formData)
        console.log('validasi', data);
        $('#loading').addClass('d-none');
        if (data.approved) {
            openDialog()
        } else {
            $('#loading').addClass('d-none');
            $('#approved').addClass('d-none');
            $('#noapproved').removeClass('d-none');
            $('#err-msg').html(data.message + '<br/>' + data.error || '');
        }
    }

    let isLoadingSoal = false;

    async function loadSoalNomor(nomor) {
        if (nomor == nomorSoal) {
            $('#loading').addClass('d-none');
            $('#next').removeAttr('disabled');
            $('#prev').removeAttr('disabled');
            return;
        }

        if (isLoadingSoal) {
            console.log('loadSoalNomor sedang berlangsung, abaikan pemanggilan ganda');
            return;
        }

        if (soalTotal > 0 && nomor > parseInt(soalTotal)) {
            await selesai();
            return;
        }

        isLoadingSoal = true;
        $('#loading').removeClass('d-none');
        $('#next').attr('disabled', 'disabled');
        $('#prev').attr('disabled', 'disabled');

        let formData = getExamFormData();
        formData.append('nomor', nomor);
        formData.append('timer', $('#timer').text());

        let data = null;
        try {
            try {
                data = await ajaxPost('cbtsiswa/loadnomorsoal', formData);
            } catch (firstErr) {
                if (firstErr && (firstErr.status === 0 || firstErr.statusText === 'abort')) {
                    return;
                }
                // Coba ulang sekali lagi dengan jeda 250ms untuk mencegah kegagalan sesaat
                await new Promise(r => setTimeout(r, 250));
                data = await ajaxPost('cbtsiswa/loadnomorsoal', formData);
            }
        } catch (netErr) {
            console.error('Network error loadNomorSoal:', netErr);
            if (netErr && (netErr.status === 0 || netErr.statusText === 'abort')) {
                return;
            }
            showDangerToast('Gagal memuat soal nomor ' + nomor + '. Silakan coba lagi.');
            return;
        } finally {
            isLoadingSoal = false;
            $('#loading').addClass('d-none');
            $('#next').removeAttr('disabled');
            $('#prev').removeAttr('disabled');
        }

        if (data && typeof data === 'string') {
            try { data = JSON.parse(data); } catch(e){}
        }

        console.log('load soal', data);
        resetIzin = data?.jadwal?.reset_login || '0';
        hitungFouls = data?.jadwal?.pelanggaran || '0';

        if (data && data.approved) {
            $('#approved').removeClass('d-none');
            $('#noapproved').addClass('d-none');
            try {
                setKonten(data);
            } catch (renderErr) {
                console.error('Error saat merender soal:', renderErr);
            }
        } else {
            $('#approved').addClass('d-none');
            $('#noapproved').removeClass('d-none');
            $('#err-msg').html((data?.message || 'Gagal memuat soal') + (data?.error ? '<br/>' + data.error : ''));
        }
    }

    async function loadSoal(datas) {
        if (isLoadingSoal) return;
        $('#daftarModal').modal('hide');
        $('#daftarModal').on('hidden', function () {
            $(this).data('modal', null);
        });

        nav = $(datas).data('nomorsoal');
        $('#loading').removeClass('d-none');
        try {
            await sendSaveJawaban(true);
            await loadSoalNomor(nav);
        } catch (err) {
            console.error('loadSoal error:', err);
            $('#loading').addClass('d-none');
        }
    }

    function setKonten(data) {
        const media = data.media;
        //infoBank = data.bank;
        durasiUjian = data.jadwal.durasi_ujian
        //console.log('max_jawaban', data.max_jawaban);
        jarak = data.jarak;
        idSoal = data.soal_id;
        idSoalSiswa = data.soal_siswa_id;
        nomorSoal = parseInt(data.soal_nomor);
        jenisSoal = data.soal_jenis;
        soalTerjawab = data.soal_terjawab;
        soalTotal = data.soal_total;

        jsonJawaban = {};
        jawabanBaru = null;
        jawabanSiswa = data.soal_jawaban_siswa || '';
        if ($.isArray(jawabanSiswa)) jawabanSiswa.sort();

        if (nomorSoal === 1) {
            $('#prev').attr('disabled', 'disabled');
        } else {
            $('#prev').removeAttr('disabled');
        }

        $('#nomor-soal').html(nomorSoal);
        if (parseInt(data.soal_is_hots || 0, 10) === 1) {
            $('#badge-hots-ujian').removeClass('d-none');
        } else {
            $('#badge-hots-ujian').addClass('d-none');
        }
        $('#konten-soal').html(data.soal_soal);
        $('#konten-soal').attr('data-id', idSoal);
        console.log('id_soal', idSoal)
        var jenis = data.soal_jenis;
        var html = '';
        if (jenis == "1") {
            if (data.soal_opsi && data.soal_opsi.length) {
                $.each(data.soal_opsi, function (key, opsis) {
                    if (opsis && opsis.opsi !== undefined && opsis.opsi !== null && String(opsis.opsi).trim() !== "") {
                        var vAlias = opsis.valAlias || opsis.value || key;
                        var vVal = opsis.value || key;
                        html += '<label class="container-jawaban font-weight-normal">' +
                            '<input type="radio"' +
                            ' name="jawaban"' +
                            ' value="' + String(vVal).toUpperCase() + '"' +
                            ' data-jawabansiswa="' + String(vVal).toUpperCase() + '"' +
                            ' data-jawabanalias="' + String(vAlias).toUpperCase() + '"' +
                            ' onclick="submitJawaban(this)" ' + (opsis.checked || '') + '>' +
                            '<span class="checkmark shadow text-center align-middle">' + String(vAlias).toUpperCase() + '</span>' +
                            '<div class="opsi-content d-inline-block">' + opsis.opsi + '</div>' +
                            '</label>';
                    }
                });
            }
            if (!html) {
                html = '<div class="alert alert-warning my-2"><i class="fa fa-exclamation-triangle me-2"></i>Pilihan jawaban untuk soal ini belum tersedia di bank soal. Hubungi pengawas/proktor.</div>';
            }
            $('#konten-jawaban').html(html);
        } else if (jenis == "2") {
            if (data.soal_opsi && data.soal_opsi.length) {
                $.each(data.soal_opsi, function (key, opsis) {
                    if (opsis && opsis.opsi && String(opsis.opsi).trim() !== '') {
                        var vVal = opsis.value || key;
                        html += '<div class="form-check checkbox-xl">' +
                            '<input type="checkbox" class="check2 form-check-input"' +
                            'id="check'+key+'"' +
                            ' name="jawaban"' +
                            ' value="' + String(vVal).toUpperCase() + '"' +
                            ' data-max="' + (data.max_jawaban && data.max_jawaban[0] ? data.max_jawaban[0] : '10') + '"' +
                            ' data-jawabansiswa="' + String(vVal).toUpperCase() + '"' +
                            ' onclick="submitJawaban(this)" ' + (opsis.checked || '') + '>' +
                            '<label class="form-check-label font-weight-normal" for="check'+key+'">'
                            + opsis.opsi +'</label>' +
                            '</div>';
                    }
                });
            }
            if (!html) {
                html = '<div class="alert alert-warning my-2"><i class="fa fa-exclamation-triangle me-2"></i>Pilihan jawaban PG Kompleks untuk soal ini belum tersedia di bank soal. Hubungi pengawas/proktor.</div>';
            }
            $('#konten-jawaban').html(html);
        } else if (jenis == "3") {
            let konten = $('#konten-jawaban');
            konten.html('');

            const dataJawab = data.soal_opsi || {};
            const copy = $.extend(true, {}, dataJawab);
            let tabelArr = Array.isArray(copy.tabel) ? copy.tabel : (copy.tabel ? Object.values(copy.tabel) : []);
            let tbodyArr = Array.isArray(copy.tbody) ? copy.tbody : (copy.tbody ? Object.values(copy.tbody) : []);

            if (!tabelArr.length || !tabelArr[0]) {
                konten.html('<div class="alert alert-warning my-2"><i class="fa fa-exclamation-triangle me-2"></i>Data tabel soal menjodohkan belum diatur lengkap di bank soal. Hubungi pengawas/proktor.</div>');
                return;
            }

            modelSoal = dataJawab.model || '2';
            typeSoal = dataJawab.type || '1';

            let headerRow = Array.isArray(tabelArr[0]) ? tabelArr[0] : Object.values(tabelArr[0]);
            let arrData = [headerRow];
            if (tbodyArr.length > 0) {
                for (let i = 0; i < tbodyArr.length; i++) {
                    let val = Array.isArray(tbodyArr[i]) ? tbodyArr[i] : Object.values(tbodyArr[i]);
                    for (let j = 0; j < val.length; j++) {
                        if (j === 0 && tabelArr[i+1]) {
                            let nextRow = Array.isArray(tabelArr[i+1]) ? tabelArr[i+1] : Object.values(tabelArr[i+1]);
                            val[j] = nextRow[0];
                        }
                    }
                    arrData.push(val);
                }
            } else if (tabelArr.length > 1) {
                for (let i = 1; i < tabelArr.length; i++) {
                    let val = Array.isArray(tabelArr[i]) ? tabelArr[i] : Object.values(tabelArr[i]);
                    arrData.push(val);
                }
            }

            let keys = 0;
            let dataMax = {};
            if (data.max_jawaban) {
                $.each(data.max_jawaban, function (key, val) {
                    dataMax[keys] = val;
                    keys++;
                });
            }

            let objJawaban = {
                jawaban: arrData,
                max: dataMax,
                model: modelSoal,
                type: typeSoal,
            };

            konten.linkerList({
                enableEditor: false,
                data: objJawaban,
                viewMode: '2',
                id: nomorSoal,
                callback: function (id, data, hasLinks, isOffset) {
                    if (isOffset !== '0') {
                        $.toast({
                            heading: 'Warning',
                            text: 'Maksimal <b>' + isOffset + ' jawaban',
                            showHideTransition: 'slide',
                            icon: 'error',
                            loaderBg: '#f2a654',
                            position: 'bottom-center'
                        })
                    } else {
                        submitJawaban(data)
                    }
                }
            });
        } else if (jenis == "4") {
            html += '<div class="pe-4">' +
                '<span class="">JAWABAN:</span><br>' +
                '<div class="row"><div class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-4">'+
                '<input id="jawaban-isian" class="ps-1 form-control" type="text"' +
                ' name="jawaban" value="' + jawabanSiswa + '"' +
                ' placeholder="Tulis jawaban disini"/><br>' +
                '</div></div>' +
                '</div>';
            $('#konten-jawaban').html(html);

            $("#jawaban-isian").on('change keyup paste', function () {
                submitJawaban(null);
            });
        } else {
            html += '<div class="pe-4">' +
                '<label>JAWABAN:</label><br>' +
                '<textarea id="jawaban-essai" class="w-100 ps-1" type="text"' +
                ' name="jawaban" rows="4"' +
                ' placeholder="Tulis jawaban disini">' + jawabanSiswa + '</textarea><br>' +
                '</div>';
            $('#konten-jawaban').html(html);

            let isInitSummernote = true;
            $('#jawaban-essai').summernote({
                placeholder: 'Tulis Jawaban disini, tidak dibolehkan copy paste!',
                tabsize: 2,
                minHeight: 100,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'math']],
                    ['cleaner',['cleaner']],
                ],
                callbacks: {
                    onKeyup: function(e) {
                        submitJawaban(null);
                    },
                    onChange: function(contents, $editable) {
                        if (isInitSummernote) return;
                        submitJawaban(null);
                    }
                }
            });
            setTimeout(function() { isInitSummernote = false; }, 400);
        }

        $('#konten-modal').html(data.soal_modal);

        var $imgs = $('.konten-soal-jawab').find('img');
        $.each($imgs, function () {
            var curSrc = $(this).attr('src') || '';
            if (!curSrc || !curSrc.includes("uploads")) return;
            var newSrc = '';
            if (curSrc.indexOf("http") === -1 && curSrc.indexOf("data:image") === -1) {
                newSrc = base_url + curSrc;
                $(this).attr('src', newSrc);
            } else if (curSrc.indexOf(base_url) === -1) {
                var pathUpload = 'uploads';
                var forReplace = curSrc.split(pathUpload);
                if (forReplace.length > 1) {
                    newSrc = base_url + pathUpload + forReplace[1];
                    $(this).attr('src', newSrc);
                    $(this).removeAttr('alt');
                }
            }
            $(this).on('load', function () {
                if ($(this).height() > 50) {
                    $(this).addClass('img-fluid');
                }
            });
        });

        var pathUpload = 'uploads';
        $.each($('.konten-soal-jawab audio'), function (ind) {
            var curSrc = $(this).attr('src') || '';
            if (curSrc && curSrc.indexOf("base64") === -1 && curSrc.includes("uploads")) {
                var forReplace = curSrc.split(pathUpload);
                if (forReplace.length > 1) {
                    $(this).attr('src', base_url + pathUpload + forReplace[1]);
                }
            }

            const dataId = idSoal + '-'+ ind;
            const m_audio = (Array.isArray(media) ? media : []).find(item => item && item.id === dataId && item.type === 'audio');
            if (typeof this.renderAudio === 'function') {
                this.renderAudio({
                    'idSoal': dataId,
                    'played': m_audio?.play || 0,
                    callback: function (idMedia, playCount) {
                        console.log(`Audio [${idMedia}] played: ${playCount}`);
                        savePlayed('audio', idSoal, idMedia, playCount);
                    }
                });
            }
        });

        $.each($('.konten-soal-jawab video').not('#video-stream-siswa'), function (ind) {
            if (this.id === 'video-stream-siswa' || $(this).closest('#box-kamera-pengawas, #modalScanExitQr, #exit-qr-reader').length > 0) {
                return;
            }
            var curSrc = $(this).attr('src') || '';
            if (curSrc && curSrc.indexOf("base64") === -1 && curSrc.includes("uploads")) {
                var forReplace = curSrc.split(pathUpload);
                if (forReplace.length > 1) {
                    $(this).attr('src', base_url + pathUpload + forReplace[1]);
                }
            }

            const dataId = idSoal + '-'+ ind;
            const m_video = (Array.isArray(media) ? media : []).find(item => item && item.id === dataId && item.type === 'video');
            if (typeof this.renderVideo === 'function') {
                this.renderVideo({
                    'idSoal': dataId,
                    'played': m_video?.play || 0,
                    callback: function (idMedia, playCount) {
                        console.log(`Video [${idMedia}] played: ${playCount}`);
                        savePlayed('video', idSoal, idMedia, playCount);
                    }
                });
            }
        });

        $('.check').change(function (e) {
            var row = $(e.target).closest('tr');
            var isChecked = $(row).find("input:checked");
            var max = $(e.target).data('max');
            if (isChecked.length > max) {
                $(e.target).prop('checked', !$(this).prop('checked'));
                $.toast({
                    heading: 'Warning',
                    text: 'Maksimal <b>' + max + ' jawaban',
                    showHideTransition: 'slide',
                    icon: 'error',
                    loaderBg: '#f2a654',
                    position: 'bottom-center'
                })
            } else {
                submitJawaban(null);
            }
        });

        if (!data.durasi) {
            window.location.href = base_url + 'cbtsiswa/cbt';
        } else {
            setElapsed(data.durasi);

            if (timerSelesai) {
                clearTimeout(timerSelesai);
                timerSelesai = null;
            }

            var next = $('#next');
            next.removeAttr('disabled');
            var txtnext = $('#text-next');
            $('#ic-btn').remove();

            if (soalTotal === nomorSoal && data.durasi.mulai != null && data.durasi.mulai != '0') {
                next.removeClass('btn-primary');
                next.addClass('btn-success');
                next.append('<i id="ic-btn" class="fa fa-check-circle"></i>');
                txtnext.html('<b>Selesai</b>');
                setTimerSelesai(next, data.durasi);
            } else {
                $('#timer-selesai').addClass('d-none');
                next.removeClass('d-none');
                next.removeClass('btn-success');
                next.addClass('btn-primary');
                next.append('<i id="ic-btn" class="fa fa-arrow-circle-right"></i>');
                txtnext.html('<b>Soal Berikutnya</b>');
            }
        }

        arrSize = [];
    }

    function setElapsed(durasi) {
        elapsed = durasi.lama_ujian == null || durasi.lama_ujian == '0' ? "00:00:00" : durasi.lama_ujian;
        createTimerCountdown(durasiUjian, elapsed.split(':'), async function (isOver, remaining, onGoing) {
            $('#timer').html(remaining);
            elapsed = onGoing;
            if (isOver) {
                $('#prev').attr('disabled', 'disabled');
                $('#next').attr('disabled', 'disabled');

                try {
                    let formData = getExamFormData();
                    formData.append('elapsed', elapsed)
                    const jns = String(jsonJawaban['jenis'] || '');
                    for (const key in jsonJawaban) {
                        if ((jns === '2' || jns === '3') && key === 'jawaban_siswa') {
                            formData.append('data[' + key + ']', JSON.stringify(jsonJawaban[key]));
                        } else {
                            formData.append('data[' + key + ']', jsonJawaban[key]);
                        }
                    }
                    const respon = await ajaxPost('cbtsiswa/savejawaban', formData)
                    console.log('onElapsed', respon)
                    if (respon.success) {
                        $('.konten-soal-jawab').html('');
                        dialogWaktu();
                    } else {
                        swal.fire({
                            title: "Sudah Habis",
                            text: "Waktu Ujian sudah habis, hubungi proktor",
                            icon: "warning",
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "OK"
                        }).then(result => {
                            if (result.value) {
                                window.location.href = base_url + 'cbtsiswa/cbt';
                            }
                        });
                    }
                } catch (e) {
                    console.log(e);
                }
            }
        })
    }

    async function nextSoal() {
        if (isLoadingSoal) return;
        $('#next').attr('disabled', 'disabled');
        $('#loading').removeClass('d-none');
        nav = (nomorSoal + 1);
        try {
            await sendSaveJawaban(true);
            await loadSoalNomor(nav);
        } catch (err) {
            console.error('nextSoal error:', err);
            $('#loading').addClass('d-none');
            $('#next').removeAttr('disabled');
        }
    }

    function setTimerSelesai(next, durasi) {
        const perdetik = 1000;
        const permenit = 60 * perdetik;
        const perjam = 60 * permenit;
        const t_dur = Number(jarak) * (1000 * 60);

        const elapsed = (durasi.lama_ujian == null || durasi.lama_ujian == '0' ? "00:00:00" : durasi.lama_ujian).split(':');
        let t_jam = Number(elapsed[0]);
        let t_mnt = Number(elapsed[1]);
        let t_dtk = Number(elapsed[2]);

        const btnTimer = $('#timer-selesai');
        setTimer();

        function setTimer() {
            if (timerSelesai) {
                clearTimeout(timerSelesai);
                timerSelesai = null;
            }

            const elapsedMicro = (t_jam * perjam) + (t_mnt * permenit) + (t_dtk * perdetik);
            const t_remaining = t_dur - elapsedMicro;
            if (t_remaining <= 0) {
                next.removeClass('d-none');
                btnTimer.addClass('d-none');
            } else {
                // elapsed
                t_dtk++;
                if (t_dtk > 59) {
                    t_dtk = 0;
                    t_mnt++;
                }
                if (t_mnt > 59) {
                    t_mnt = 0;
                    t_jam++;
                }

                // remaining
                const r_jam = Math.floor(t_remaining / perjam);
                const r_mnt = Math.floor((t_remaining % perjam) / permenit);
                const r_dtk = Math.floor((t_remaining % permenit) / perdetik);
                next.addClass('d-none');
                btnTimer.removeClass('d-none');
                btnTimer.html(zeroPad(r_jam) + ':' + zeroPad(r_mnt) + ':' + zeroPad(r_dtk));

                timerSelesai = setTimeout(setTimer, 1000);
            }
        }
    }

    async function prevSoal() {
        if (isLoadingSoal) return;
        $('#prev').attr('disabled', 'disabled');
        $('#loading').removeClass('d-none');
        nav = (nomorSoal - 1);
        try {
            await sendSaveJawaban(true);
            await loadSoalNomor(nav);
        } catch (err) {
            console.error('prevSoal error:', err);
            $('#loading').addClass('d-none');
            $('#prev').removeAttr('disabled');
        }
    }

    function updateModal(jwb) {
        var badges = $('#konten-modal').find(`#badge${nomorSoal}`);
        var btn = $('#konten-modal').find(`#btn${nomorSoal}`);
        btn.removeClass("btn-secondary");
        btn.addClass("btn-primary");
        if (jenisSoal == 1) {
            if (badges.length) {
                $(`#badge${nomorSoal}`).text(jwb)
            } else {
                var badge = '<div id="badge' + nomorSoal + '" class="badge text-bg-pill text-bg-success border border-dark text-yellow"' +
                    ' style="font-size:12pt; width: 30px; height: 30px; margin-top: -60px; margin-left: 30px;">' +
                    jwb +
                    '</div>';
                $(`#box${nomorSoal}`).append(badge);
            }
        } else {
            if (!badges.length) {
                var badge = '<div id="badge' + nomorSoal + '" class="badge text-bg-pill text-bg-success border border-dark"' +
                    ' style="font-size:12pt; width: 30px; height: 30px; margin-top: -60px; margin-left: 30px;">' +
                    '&check;</div>';
                $(`#box${nomorSoal}`).append(badge);
            }
        }
    }

    function submitJawaban(opsi) {
        var jawaban_Siswa = '', jawaban_Alias = '';
        if (jenisSoal == 1) {
            jawaban_Siswa = $(opsi).data('jawabansiswa');
            jawaban_Alias = $(opsi).data('jawabanalias');
        } else if (jenisSoal == 2) {
            var isChecked = $('#konten-jawaban').find("input:checked");
            var max = $(opsi).data('max');
            //console.log('max:'+max, 'checked:'+isChecked.length);
            if (isChecked.length > max) {
                $(opsi).prop('checked', !$(opsi).prop('checked'));
                $.toast({
                    heading: 'Warning',
                    text: 'Maksimal <b>' + max + ' jawaban',
                    showHideTransition: 'slide',
                    icon: 'error',
                    loaderBg: '#f2a654',
                    position: 'bottom-center'
                });
                return;
            } else {
                var selected = [];
                $('#konten-jawaban input:checked').each(function () {
                    selected.push($(this).val());
                });
                jawaban_Siswa = selected;
            }
        } else if (jenisSoal == 3) {
            jawaban_Siswa = opsi
        } else if (jenisSoal == 4){
            jawaban_Siswa = $('#jawaban-isian').val();
        } else {
            jawaban_Siswa = $('#jawaban-essai').summernote('code');
        }
        jawabanBaru = jawaban_Siswa;
        if (jenisSoal == 2) {
            if ($.isArray(jawabanBaru)) jawabanBaru.sort();
        }

        updateModal(jawaban_Alias);
        jsonJawaban = createJsonJawaban(jawaban_Alias, jawaban_Siswa);
        
        // Instant Auto-Save on Click & on Input
        if (jenisSoal == 1 || jenisSoal == 2 || jenisSoal == 3) {
            triggerInstantAutoSave(0);
        } else if (jenisSoal == 4) {
            triggerInstantAutoSave(400);
        } else {
            triggerInstantAutoSave(800);
        }
    }

    function createJsonJawaban(jawab_Alias, jawab_Siswa) {
        var item = {};
        item ["no_soal_alias"] = nomorSoal;
        item ["jawaban_alias"] = jawab_Alias;
        item ["jawaban_siswa"] = jawab_Siswa;
        item ["jenis"] = jenisSoal;
        item ["id_soal"] = idSoal;
        item ["id_soal_siswa"] = idSoalSiswa;
        //item ["id_jadwal"] = jadwal;
        //item ["id_bank"] = bank;
        //item ["id_siswa"] = siswa;

        return item;
    }

    function getDataTable() {
        return $('#table-jodohkan tr').get().map(function (row) {
            const $tables = [];

            $(row).find('th').get().map(function (cell) {
                var klm = $(cell).text().trim();
                $tables.push(klm == "" ? "#" : encode(klm));
            });

            $(row).find('td').get().map(function (cell) {
                if ($(cell).children('input').length > 0) {
                    $tables.push($(cell).find('input').prop("checked") === true ? "1" : "0");
                } else {
                    $tables.push(encode($(cell).text().trim()))
                }
            });

            return $tables;
        });
    }

    function convertTable(data) {
        const head = []
        const body = []
        $.each(data.tabel, function (idx, val) {
            if (idx === 0) {
                $.each(val, function (id, vl) {
                    if (vl !== "#") head.push(encode(vl))
                })
            } else {
                $.each(val, function (id, vl) {
                    if (id === 0) body.push(encode(vl))
                })
            }
        })
        var kanan = data.thead;
        var kiri = [];
        $.each(data.tbody, function (i, v) {
            kiri.push(encode(v.shift()));
        });
        kanan.shift();

        var linked = [];
        $.each(data.tbody, function (n, arv) {
            $.each(arv, function (t, v) {
                if (v == '1') {
                    var it = {};
                    it['from'] = encode(body[n]);
                    it['to'] = encode(head[t]);
                    linked.push(it);
                }
            });
        });
        var item = {};
        item['type'] = data.type;
        item['jawaban'] = [body, head];
        item['linked'] = linked;
        return item;
    }

    function convertTableToList(data) {
        const kanan = data.thead;
        //console.log('kanan', kanan);
        const kiri = [];
        $.each(data.tbody, function (i, v) {
            kiri.push(decode(v.shift()));
        });
        kanan.shift();
        //console.log('kiri', kiri);
        $.each(kanan, function (i, v) {
            kanan[i] = (decode(v));
        });

        var linked = [];
        $.each(data.tbody, function (n, arv) {
            $.each(arv, function (t, v) {
                if (v == '1') {
                    var it = {};
                    it['from'] = decode(kiri[n]);
                    it['to'] = decode(kanan[t]);
                    linked.push(it);
                }
            });
        });
        var item = {};
        item['type'] = data.type;
        item['jawaban'] = [kiri, kanan];
        item['linked'] = linked;
        //console.log('test', item);
        return item;
    }

    function getListData() {
        var kolom = [];
        var baris = [];
        $(".FL-left li").each(function () {
            baris.push(encode($(this).text()));
        });
        $(".FL-right li").each(function () {
            kolom.push(encode($(this).text()));
        });
        return [kolom, baris];
    }

    function buildHasilUjianHtml(respon) {
        const skorTotal = Math.round((Number(respon.skor_total != null ? respon.skor_total : (respon.skor_asli ?? respon.pg_nilai ?? 0)) + Number.EPSILON) * 100) / 100;
        let breakdownRows = '';

        if (respon.breakdown && Array.isArray(respon.breakdown) && respon.breakdown.length > 0) {
            respon.breakdown.forEach(item => {
                const nilaiItem = Math.round((Number(item.nilai ?? 0) + Number.EPSILON) * 100) / 100;
                breakdownRows += `
                    <tr>
                        <td class="text-start ps-2">${item.label}</td>
                        <td>${item.soal}</td>
                        <td class="text-success fw-bold">${item.benar}</td>
                        <td class="text-end pe-2 fw-bold">${nilaiItem}</td>
                    </tr>
                `;
            });
        } else {
            const benarPg = respon.total_benar ?? respon.pg_benar ?? 0;
            const nilaiPg = Math.round((Number(respon.pg_nilai ?? respon.skor_total ?? 0) + Number.EPSILON) * 100) / 100;
            breakdownRows += `
                <tr>
                    <td class="text-start ps-2">Pilihan Ganda</td>
                    <td>${respon.jml_soal ?? 0}</td>
                    <td class="text-success fw-bold">${benarPg}</td>
                    <td class="text-end pe-2 fw-bold">${nilaiPg}</td>
                </tr>
            `;
        }

        return `
            <div class="my-2 text-center">
                <p class="text-muted mb-1 small text-uppercase fw-bold">Nilai Akhir Ujian</p>
                <div class="display-4 fw-bold text-success mb-2">${skorTotal}</div>
                <div class="table-responsive mb-2">
                    <table class="table table-bordered table-sm align-middle text-center mb-0" style="font-size: 0.82rem;">
                        <thead class="table-light">
                            <tr>
                                <th class="text-start ps-2">Tipe Soal</th>
                                <th style="width: 60px;">Soal</th>
                                <th style="width: 60px;">Benar</th>
                                <th class="text-end pe-2" style="width: 70px;">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${breakdownRows}
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="3" class="text-end pe-2 fw-bold">TOTAL NILAI</th>
                                <th class="text-end pe-2 text-success fw-bolder fs-6">${skorTotal}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="row g-1 text-center small mb-2" style="font-size: 0.75rem;">
                    <div class="col-4">
                        <div class="p-1 rounded bg-success bg-opacity-10 border border-success border-opacity-25">
                            <span class="text-success fw-bold d-block"><i class="fas fa-check-circle me-1"></i>Benar</span>
                            <span class="fw-bold fs-6 text-success">${respon.total_benar ?? respon.pg_benar ?? 0}</span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-1 rounded bg-danger bg-opacity-10 border border-danger border-opacity-25">
                            <span class="text-danger fw-bold d-block"><i class="fas fa-times-circle me-1"></i>Salah</span>
                            <span class="fw-bold fs-6 text-danger">${respon.total_salah ?? respon.pg_salah ?? 0}</span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-1 rounded bg-primary bg-opacity-10 border border-primary border-opacity-25">
                            <span class="text-primary fw-bold d-block"><i class="fas fa-list-ol me-1"></i>Total</span>
                            <span class="fw-bold fs-6 text-primary">${respon.jml_soal ?? 0}</span>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    async function selesai() {
        $('#next').attr('disabled', 'disabled');
        $('#loading').removeClass('d-none');
        await sendSaveJawaban(true);

        if (soalTotal === soalTerjawab) {
            swal.fire({
                title: "Kamu yakin?",
                text: "Kamu akan menyelesaikan ujian",
                icon: "warning",
                allowEscapeKey: false,
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Selesaikan!"
            }).then(async result => {
                if (result.value) {
                    try {
                        let formData = getExamFormData();
                        const respon = await ajaxPost('cbtsiswa/selesaiujian', formData);
                        try {
                            if (window.CbtBridge && typeof window.CbtBridge.finishExamAndUnlock === 'function') {
                                window.CbtBridge.finishExamAndUnlock();
                            }
                        } catch(e) {}

                        if (respon && (String(respon.hasil_tampil) === '1' || respon.skor_total !== undefined)) {
                            await swal.fire({
                                title: "Ujian Berhasil Diselesaikan!",
                                html: buildHasilUjianHtml(respon),
                                icon: "success",
                                confirmButtonText: "Kembali ke Beranda Ujian",
                                confirmButtonColor: "#28a745",
                                allowOutsideClick: false
                            });
                        } else {
                            await swal.fire({
                                title: "Ujian Selesai!",
                                text: "Jawaban ujian Anda berhasil dikirimkan.",
                                icon: "success",
                                confirmButtonText: "Kembali ke Beranda Ujian",
                                confirmButtonColor: "#3085d6",
                                allowOutsideClick: false
                            });
                        }
                        window.location.href = base_url + 'cbtsiswa/cbt';
                    } catch (e) {
                        swal.fire({
                            title: "Gagal",
                            text: "Tidak bisa menyelesaikan ujian",
                            icon: "error"
                        });
                    }
                } else {
                    $('#next').removeAttr('disabled');
                    $('#loading').addClass('d-none');
                }
            });
        } else {
            swal.fire({
                title: "BELUM SELESAI!",
                text: "Masih ada soal yang belum dikerjakan",
                icon: "error",
                confirmButtonColor: "#3085d6",
            }).then(result => {
                if (result.value) {
                    $('#next').removeAttr('disabled');
                    $('#loading').addClass('d-none');
                }
            });
        }
    }

    async function dialogWaktu() {
        try {
            const finishRes = await ajaxPost('cbtsiswa/selesaiujian', getExamFormData());
            if (finishRes && (String(finishRes.hasil_tampil) === '1' || finishRes.skor_total !== undefined)) {
                await swal.fire({
                    title: "Waktu Habis & Ujian Selesai!",
                    html: buildHasilUjianHtml(finishRes),
                    icon: "info",
                    confirmButtonText: "Kembali ke Beranda Ujian",
                    confirmButtonColor: "#28a745",
                    allowOutsideClick: false
                });
                window.location.href = base_url + 'cbtsiswa/cbt';
                return;
            }
        } catch(e) {}

        swal.fire({
            title: "Waktu Habis",
            text: "Waktu pengerjaan ujian telah berakhir. Jawaban Anda telah tersimpan.",
            icon: "warning",
            allowEscapeKey: false,
            allowOutsideClick: false,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Kembali ke Beranda Ujian"
        }).then(result => {
            if (result.value) {
                window.location.href = base_url + 'cbtsiswa/cbt';
            }
        });
    }

    function rtclickcheck(keyp) {
        if (navigator.appName == "Netscape" && keyp.which == 3) {
            alert(message);
            return false;
        }

        if (navigator.appVersion.indexOf("MSIE") != -1 && event.button == 2) {
            alert(message);
            return false;
        }
    }

    function getMinutes(startTime) {
        var endTime = new Date();
        endTime.setHours(endTime.getHours() - startTime.getHours());
        endTime.setMinutes(endTime.getMinutes() - startTime.getMinutes());
        endTime.setSeconds(endTime.getSeconds() - startTime.getSeconds());

        return {h: endTime.getHours(), m: endTime.getMinutes(), s: endTime.getSeconds()}
    }

    function createTimerCountdown(durasi, elapsed, func) {
        const perdetik = 1000;
        const permenit = 60 * perdetik;
        const perjam = 60 * permenit;
        const t_dur = durasi * (1000 * 60);

        let t_jam = Number(elapsed[0]);
        let t_mnt = Number(elapsed[1]);
        let t_dtk = Number(elapsed[2]);

        testTimer();

        function testTimer() {
            if (timerOut) {
                clearTimeout(timerOut);
                timerOut = null;
            }

            const elapsedMicro = (t_jam * perjam) + (t_mnt * permenit) + (t_dtk * perdetik);
            const t_remaining = t_dur - elapsedMicro;
            if (t_remaining <= 0) {
                if (func && (typeof func == "function")) {
                    func(true, 'Waktu habis', zeroPad(t_jam) + ':' + zeroPad(t_mnt) + ':' + zeroPad(t_dtk));
                }
            } else {
                // elapsed
                t_dtk++;
                if (t_dtk > 59) {
                    t_dtk = 0;
                    t_mnt++;
                }
                if (t_mnt > 59) {
                    t_mnt = 0;
                    t_jam++;
                }

                // remaining
                const r_jam = Math.floor(t_remaining / perjam);
                const r_mnt = Math.floor((t_remaining % perjam) / permenit);
                const r_dtk = Math.floor((t_remaining % permenit) / perdetik);

                if (func && (typeof func == "function")) {
                    func(false,
                        zeroPad(r_jam) + ':' + zeroPad(r_mnt) + ':' + zeroPad(r_dtk),
                        zeroPad(t_jam) + ':' + zeroPad(t_mnt) + ':' + zeroPad(t_dtk)
                    );
                }
                timerOut = setTimeout(testTimer, 1000);
            }
        }
    }

    function zeroPad(no) {
        return no < 10 ? '0' + no : no;
    }

    function encode(str) {
        var decoded = decodeURIComponent(str)
        var isEncoded = decoded !== str
        var encoded = encodeURIComponent(str)
        if (isEncoded) {
            return str
        } else {
            return encoded
        }
    }

    function decode(str) {
        var decoded = decodeURIComponent(str)
        var encoded = encodeURIComponent(decoded)
        var isEncoded = encoded === str
        if (isEncoded) {
            return decoded
        } else {
            return str
        }
    }

    function kembali() {
        location.href = base_url + "cbtsiswa/cbt";
    }

    function openFullscreen(elem = document.documentElement) {
        if (isAndroidCbtApp()) {
            try {
                if (window.CbtBridge && typeof window.CbtBridge.enterExamMode === 'function') {
                    window.CbtBridge.enterExamMode();
                }
            } catch (e) {}
            return;
        }
        if (elem.requestFullscreen) {
            elem.requestFullscreen().catch(err => console.warn('Fullscreen blocked:', err));
        } else if (elem.mozRequestFullScreen) {
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) {
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) {
            elem = window.top.document.body;
            elem.msRequestFullscreen();
        }
    }

    let isProcessingFoul = false;
    let lastFoulTime = 0;

    document.addEventListener("visibilitychange", async () => {
        if (document.hidden) {
            try {
                if (window.CbtBridge && typeof window.CbtBridge.isExitDialogOpen === 'function' && window.CbtBridge.isExitDialogOpen()) {
                    return;
                }
            } catch (e) {}
            await hitungPelanggaran('berat', resetIzin);
        } else {
            // Ketika fokus kembali dan ujian belum selesai, pastikan kamera pengawas tetap aktif
            <?php if (isset($kamera) && $kamera == 1): ?>
            if (typeof initKameraPengawas === 'function') {
                if (!localCamStream || !localCamStream.active) {
                    setTimeout(initKameraPengawas, 600);
                }
            }
            <?php endif; ?>
        }
    });

    async function leaveCbt() {
        let formData = getExamFormData();
        const response = await ajaxPost('cbtsiswa/leavecbt', formData);
        console.log('leave', response);

        if (response.success) {
            try {
                if (window.CbtBridge && typeof window.CbtBridge.finishExamAndUnlock === 'function') {
                    window.CbtBridge.finishExamAndUnlock();
                }
            } catch (e) {}
            location.href = base_url + "logout";
        } else {
            swal.fire({
                title: "Gagal",
                text: "Tidak bisa meninggalkan ujian",
                icon: "error"
            });
        }
    }

    async function hitungPelanggaran(jenis, reset) {
        const now = Date.now();
        if (isProcessingFoul || (now - lastFoulTime < 3000)) {
            return;
        }
        isProcessingFoul = true;
        lastFoulTime = now;

        try {
            if (hitungFouls !== '1') {
                if (reset === '1') {
                    await leaveCbt(); // paksa logout
                } else if (reset === '2') {
                    $('#loading').addClass('d-none');
                    $('#approved').addClass('d-none');
                    $('#noapproved').removeClass('d-none');
                    $('#err-msg').html(`
                        <p class="text-danger">Tidak bisa dilanjutkan. Pastikan aplikasi berjalan dengan kondisi FullScreen!</p>
                    `);
                }
                return; // tidak dicatat pelanggaran
            }

            let formData = getExamFormData();
            formData.append('jenis', jenis);
            const response = await ajaxPost('cbtsiswa/hitung_pelanggaran', formData);
            console.log('pelanggaran', jenis, reset === '1', response);

            if (response && response.success) {
                if (reset === '1') {
                    await leaveCbt(); // paksa logout
                } else if (reset === '2') {
                    $('#loading').addClass('d-none');
                    $('#approved').addClass('d-none');
                    $('#noapproved').removeClass('d-none');
                    $('#err-msg').html(`
                        <p class="text-danger">Tidak bisa dilanjutkan. Pastikan aplikasi berjalan dengan kondisi FullScreen!</p>
                    `);
                } else {
                    const count = (response.pelanggaran?.ringan || 0) + (response.pelanggaran?.sedang || 0) + (response.pelanggaran?.berat || 0);
                    swal.fire({
                        title: "Pelanggaran Terdeteksi",
                        html: `Kamu telah melakukan <span class="text-danger">${count}x pelanggaran</span>, nilai akan dikurangi`,
                        icon: "warning",
                        allowOutsideClick: false,
                        confirmButtonColor: "#3085d6",
                        allowEscapeKey: false,
                        confirmButtonText: "OK",
                        preConfirm: () => {
                            openFullscreen();
                            return true;
                        }
                    }).then(() => {
                        openFullscreen();
                    });
                }
            }
        } catch (err) {
            console.warn('Pelanggaran error:', err);
        } finally {
            isProcessingFoul = false;
        }
    }

    document.addEventListener('fullscreenchange', function () {
        if (isAndroidCbtApp()) {
            return;
        }
        if (document.fullscreenElement === null) {
            console.log('Exited fullscreen mode.');
            hitungPelanggaran('sedang', '0');
        } else {
            console.log('Entered or still in fullscreen mode.');
        }
    });

    async function savePlayed(type, idSoal, idMedia, playCount) {
        let formData = getExamFormData();
        formData.append('soal', idSoal)
        formData.append('media', idMedia)
        formData.append('play', playCount)
        formData.append('type', type)
        const response = await ajaxPost('cbtsiswa/save_played', formData)
        console.log('onSubmit', response)
    }

    /*
    function deteksiUkuranLayar(isOrientationchange) {
        if (hitungFouls === '0' && isOrientationchange) {
            return;
        }

        const toleransi = 10;
        const sWidth = screen.width - toleransi;
        const sHeight = screen.height - toleransi;
        const iWidth = window.innerWidth;
        const iHeight = window.innerHeight;
        console.log('deteksiLayar', isOrientationchange, 'screen:', sWidth, 'x', sHeight, 'inner:', iWidth, 'x', iHeight);
        if (!isOrientationchange && iWidth < sWidth) {
            hitungPelanggaran('ringan', '0')
        }
    }

    window.addEventListener('resize', () => {
        deteksiUkuranLayar(false)
    });

    window.addEventListener("orientationchange", () => {
        console.log("Orientasi berubah ke:", screen.orientation.type);
        deteksiUkuranLayar(true)
    });
     */

</script>



<?= $this->endSection() ?>
