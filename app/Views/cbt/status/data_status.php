<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hidayatur Rohman
 * Date: 07/07/20
 * Time: 17:20
 */
?>

<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

<style>
/* Universal Fullscreen Scroll & Position Fix for Status Siswa */
#status-siswa-container:fullscreen,
#status-siswa-container:-webkit-full-screen,
#status-siswa-container:-moz-full-screen,
#status-siswa-container:-ms-fullscreen,
:fullscreen #status-siswa-container,
:-webkit-full-screen #status-siswa-container,
body.fullscreen-active #status-siswa-container {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    bottom: 0 !important;
    width: 100vw !important;
    height: 100vh !important;
    overflow-x: hidden !important;
    overflow-y: scroll !important;
    background-color: #f4f6f8 !important;
    padding: 140px 30px 50px 30px !important;
    box-sizing: border-box !important;
    z-index: 999999 !important;
    -webkit-overflow-scrolling: touch !important;
}

body.fullscreen-active .content-inner,
:fullscreen .content-inner,
:-webkit-full-screen .content-inner {
    margin-top: 0 !important;
}

#status-siswa-container .card:first-child {
    margin-top: 25px !important;
}

:fullscreen body, :-webkit-full-screen body, :-moz-full-screen body, :-ms-fullscreen body,
body.fullscreen-active, html:fullscreen, body:fullscreen {
    overflow: hidden !important;
}

:fullscreen .sidebar, :fullscreen .main-sidebar, :fullscreen .iq-navbar, :fullscreen .iq-navbar-header, :fullscreen footer,
:-webkit-full-screen .sidebar, :-webkit-full-screen .main-sidebar, :-webkit-full-screen .iq-navbar, :-webkit-full-screen .iq-navbar-header, :-webkit-full-screen footer,
body.fullscreen-active .sidebar, body.fullscreen-active .main-sidebar, body.fullscreen-active .iq-navbar, body.fullscreen-active .iq-navbar-header, body.fullscreen-active footer {
    display: none !important;
}

:fullscreen .main-content, :-webkit-full-screen .main-content, body.fullscreen-active .main-content {
    margin-left: 0 !important;
    padding: 0 !important;
}

#status-siswa-container .select2-container--open {
    z-index: 9999999 !important;
}
.select2-dropdown {
    z-index: 9999999 !important;
}
#status-siswa-container .card.my-shadow {
    min-height: 480px;
}
.select2-container--bootstrap4 .select2-results > .select2-results__options {
    max-height: 220px !important;
    overflow-y: auto !important;
    overscroll-behavior: contain !important;
    -webkit-overflow-scrolling: touch !important;
}
#status-siswa-container .modal-backdrop,
.modal-backdrop {
    z-index: 9999980 !important;
}
#status-siswa-container .modal,
.modal {
    z-index: 9999990 !important;
}
.swal2-container {
    z-index: 9999999 !important;
}

/* ===== Enhanced Status Siswa Modern Styling ===== */
.status-filter-panel {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
}
.status-toolbar-panel {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}
#table-status-wrapper {
    border-radius: 10px;
    overflow: hidden;
    border: 1px solid #cbd5e1;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}
#table-status {
    margin-bottom: 0 !important;
}
#table-status thead th {
    background: #1d4ed8 !important;
    color: #ffffff !important;
    font-weight: 700 !important;
    text-align: center !important;
    vertical-align: middle !important;
    border: 1px solid rgba(255, 255, 255, 0.25) !important;
    font-size: 0.82rem !important;
    padding: 8px 6px !important;
}
#table-status thead tr:first-child th {
    background: #1e3a8a !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    font-size: 0.84rem !important;
    padding: 10px 6px !important;
}
#table-status thead .check {
    width: 17px;
    height: 17px;
    cursor: pointer;
    accent-color: #22c55e;
}
#table-status tbody td {
    vertical-align: middle !important;
    font-size: 0.86rem !important;
    padding: 7px 8px !important;
}
#table-status tbody tr:hover {
    background-color: #f1f5f9 !important;
}
html[data-bs-theme="dark"] .status-filter-panel,
html[data-bs-theme="dark"] .status-toolbar-panel {
    background: #1e293b !important;
    border-color: #334155 !important;
}
html[data-bs-theme="dark"] .status-filter-panel .input-group-text,
html[data-bs-theme="dark"] .status-toolbar-panel .input-group-text {
    background: #0f172a !important;
    border-color: #334155 !important;
    color: #94a3b8 !important;
}
html[data-bs-theme="dark"] #table-status-wrapper {
    border-color: #334155 !important;
}
html[data-bs-theme="dark"] #table-status thead th {
    background: #0f172a !important;
    border-color: #334155 !important;
}
html[data-bs-theme="dark"] #table-status tbody td {
    border-color: #334155 !important;
}
html[data-bs-theme="dark"] #table-status tbody tr:hover {
    background-color: #1e293b !important;
}
</style>

<div id="status-siswa-container">
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between w-100">
                <div class="d-flex align-items-center">
                    <div class="me-3 flex-shrink-0">
                        <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%); color: #ffffff;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                            <?= $judul ?>
                        </h4>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">Monitoring real-time status ujian siswa yang sedang berlangsung, durasi tersisa, dan reset ujian.</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" id="btn-fullscreen" onclick="toggleFullScreenStatus();" class="btn btn-sm btn-dark text-white shadow-sm" data-bs-toggle="tooltip" title="Layar Penuh (Sembunyikan Menu)">
                        <i class="fa fa-expand me-1"></i> Fullscreen
                    </button>
                    <button type="button" id="btn-reload-status" onclick="reloadStatusData(this);" class="btn btn-sm btn-primary text-white shadow-sm" data-bs-toggle="tooltip" title="Perbarui Data (Tanpa Keluar Fullscreen)">
                        <i class="fa fa-sync me-1"></i> Reload
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card my-shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center pb-3">
            <h5 class="card-title mb-0 fw-bold d-flex align-items-center">
                <i class="fas fa-tasks text-primary me-2"></i><?= $subjudul ?>
            </h5>
            <button class="btn btn-light border btn-sm" data-bs-toggle="modal" data-bs-target="#infoModal">
                <i class="fas fa-info-circle me-1 text-primary"></i> Info Error
            </button>
        </div>
        <div class="card-body">
            <!-- Dual Banners: Token Ujian & Password Keluar Kiosk CBT -->
            <div class="row mb-4">
                <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                    <div class="card border-0 text-white shadow-sm overflow-hidden h-100" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); border-radius: 12px;">
                        <div class="card-body p-3 p-md-4 d-flex flex-column justify-content-between">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="d-inline-flex align-items-center">
                                    <div class="p-2 bg-white bg-opacity-20 rounded-3 me-3">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="badge bg-warning text-dark fw-bold text-uppercase px-2 py-1 mb-1">TOKEN UJIAN</span>
                                        <h6 class="text-white-50 mb-0 small">Rilis token masuk ke siswa</h6>
                                    </div>
                                </div>
                                <span id="interval" class="badge bg-danger fs-6 px-2 py-1 fw-semibold shadow-sm d-none">--:--:--</span>
                            </div>
                            <div class="text-center my-2">
                                <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-20 px-4 py-2 rounded-3 border border-white border-opacity-25 shadow-sm">
                                    <span id="token-view" class="fw-bold text-warning" style="font-family: 'Arial Black', 'Impact', sans-serif; font-size: 2.5rem; letter-spacing: 6px; text-shadow: 0 2px 4px rgba(0,0,0,0.4);">------</span>
                                    <input id="token-input" type="hidden" readonly="readonly" />
                                </div>
                                <div class="mt-2">
                                    <button type="button" class="btn btn-warning btn-sm fw-bold text-dark shadow-sm px-3" onclick="showQrTokenModal()">
                                        <i class="fa fa-qrcode me-1"></i> Tampilkan QR Code Token
                                    </button>
                                </div>
                            </div>
                            <div class="text-center text-white-50 small">
                                Token digunakan siswa untuk mulai mengerjakan soal
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="card border-0 text-white shadow-sm overflow-hidden h-100" style="background: linear-gradient(135deg, #065f46 0%, #047857 100%); border-radius: 12px;">
                        <div class="card-body p-3 p-md-4 d-flex flex-column justify-content-between">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div class="d-inline-flex align-items-center">
                                    <div class="p-2 bg-white bg-opacity-20 rounded-3 me-3">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0 1 9.9-1"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="badge bg-light text-dark fw-bold text-uppercase px-2 py-1 mb-1">KODE KELUAR UJIAN</span>
                                        <h6 class="text-white-50 mb-0 small">Buka kunci / keluar mode ujian siswa</h6>
                                    </div>
                                </div>
                                <div class="d-flex gap-1">
                                    <button type="button" id="btn-generate-exit-code" class="btn btn-sm btn-warning text-dark fw-bold shadow-sm" title="Buat Kode Baru">
                                        <i class="fas fa-sync-alt me-1"></i> Buat Baru
                                    </button>
                                    <button type="button" id="btn-copy-exit-code" class="btn btn-sm btn-light text-dark fw-bold shadow-sm" title="Salin Kode">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="text-center my-2">
                                <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-20 px-4 py-2 rounded-3 border border-white border-opacity-25 shadow-sm">
                                    <span id="kiosk-exit-code-view" class="fw-bold text-warning" style="font-family: 'Arial Black', 'Impact', sans-serif; font-size: 2.5rem; letter-spacing: 6px; text-shadow: 0 2px 4px rgba(0,0,0,0.4);"><?= esc($kiosk_exit_code ?? '------') ?></span>
                                </div>
                                <div class="mt-2">
                                    <button type="button" class="btn btn-warning btn-sm fw-bold text-dark shadow-sm px-3" onclick="showQrExitModal()">
                                        <i class="fa fa-qrcode me-1"></i> Tampilkan QR Code Keluar
                                    </button>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center text-white-50 small">
                                <span>Sinkron realtime dengan APK Android</span>
                                <?php
                                $offlineCode = 'ISLAH' . date('dm');
                                if (isset($setting->sekolah)) {
                                    if (stripos($setting->sekolah, 'puunokullo') !== false) {
                                        $offlineCode = 'SDN1' . date('dm');
                                    } elseif (stripos($setting->sekolah, 'ict') !== false || stripos($setting->sekolah, 'cendekia') !== false) {
                                        $offlineCode = 'ICT' . date('dm');
                                    }
                                }
                                ?>
                                <span>Darurat Offline: <strong class="text-white"><?= $offlineCode ?></strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel Filter Waktu & Ruang/Kelas -->
            <div class="card status-filter-panel shadow-sm mb-4">
                <div class="card-body p-3">
                    <div class="row g-2 align-items-center">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="input-group input-group-sm shadow-sm">
                                <span class="input-group-text bg-white fw-bold text-secondary border-end-0" style="min-width: 70px;">
                                    <i class="fas fa-calendar-alt me-1.5 text-primary"></i> Hari
                                </span>
                                <select name="tgl" id="tgl" class="form-select form-select-sm border-start-0 fw-semibold text-dark">
                                    <option value="">Pilih Tanggal</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="input-group input-group-sm shadow-sm">
                                <span class="input-group-text bg-white fw-bold text-secondary border-end-0" style="min-width: 80px;">
                                    <i class="fas fa-filter me-1.5 text-primary"></i> Filter By
                                </span>
                                <select name="printby" id="printby" class="form-select form-select-sm border-start-0 fw-semibold text-dark">
                                    <option value="1" selected="selected">Ruang</option>
                                    <option value="2">Kelas</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 d-none" id="by-kelas">
                            <div class="input-group input-group-sm shadow-sm">
                                <span class="input-group-text bg-white fw-bold text-secondary border-end-0" style="min-width: 75px;">
                                    <i class="fas fa-chalkboard me-1.5 text-primary"></i> Kelas
                                </span>
                                <select name="kelas" id="kelas" class="form-select form-select-sm border-start-0 fw-semibold text-dark">
                                    <option value="" selected="selected">Pilih Kelas</option>
                                    <?php if (!empty($init_kelas) && is_array($init_kelas)): ?>
                                        <?php foreach ($init_kelas as $idk => $namak): ?>
                                            <option value="<?= esc($idk) ?>"><?= esc($namak) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-6 col-md-3 by-ruang">
                            <div class="input-group input-group-sm shadow-sm">
                                <span class="input-group-text bg-white fw-bold text-secondary border-end-0" style="min-width: 75px;">
                                    <i class="fas fa-door-open me-1.5 text-primary"></i> Ruang
                                </span>
                                <select name="ruang" id="ruang" class="form-select form-select-sm border-start-0 fw-semibold text-dark">
                                    <option value="" selected="selected">Pilih Ruang</option>
                                    <?php if (!empty($init_ruang) && is_array($init_ruang)): ?>
                                        <?php foreach ($init_ruang as $idr => $namar): ?>
                                            <option value="<?= esc($idr) ?>"><?= esc($namar) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-6 col-md-3 by-ruang">
                            <div class="input-group input-group-sm shadow-sm">
                                <span class="input-group-text bg-white fw-bold text-secondary border-end-0" style="min-width: 65px;">
                                    <i class="fas fa-clock me-1.5 text-primary"></i> Sesi
                                </span>
                                <select name="sesi" id="sesi" class="form-select form-select-sm border-start-0 fw-semibold text-dark">
                                    <option value="" selected="selected">Pilih Sesi</option>
                                    <?php if (!empty($init_sesi) && is_array($init_sesi)): ?>
                                        <?php foreach ($init_sesi as $ids => $namas): ?>
                                            <option value="<?= esc($ids) ?>"><?= esc($namas) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ringkasan Monitoring Ujian (KPI Cards) -->
            <div class="row g-3 mb-4 d-none" id="status-kpi-row">
                <div class="col-6 col-md-3">
                    <div class="card kpi-pastel-card kpi-pastel-blue border-0 shadow-sm h-100">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="kpi-pastel-icon me-3">
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <div class="kpi-pastel-title small">Total Peserta</div>
                                <div class="fs-4 fw-bold kpi-pastel-value"><span id="kpi-status-total">0</span> <span class="fs-6 fw-normal kpi-pastel-sub">sesi</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card kpi-pastel-card kpi-pastel-amber border-0 shadow-sm h-100">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="kpi-pastel-icon me-3">
                                <i class="fas fa-hourglass-half"></i>
                            </div>
                            <div>
                                <div class="kpi-pastel-title small">Sedang Mengerjakan</div>
                                <div class="fs-4 fw-bold kpi-pastel-value"><span id="kpi-status-aktif">0</span> <span class="fs-6 fw-normal kpi-pastel-sub">aktif</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card kpi-pastel-card kpi-pastel-green border-0 shadow-sm h-100">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="kpi-pastel-icon me-3">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <div class="kpi-pastel-title small">Selesai Ujian</div>
                                <div class="fs-4 fw-bold kpi-pastel-value"><span id="kpi-status-selesai">0</span> <span class="fs-6 fw-normal kpi-pastel-sub">tuntas</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card kpi-pastel-card kpi-pastel-red border-0 shadow-sm h-100">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="kpi-pastel-icon me-3">
                                <i class="fas fa-user-clock"></i>
                            </div>
                            <div>
                                <div class="kpi-pastel-title small">Belum Mulai</div>
                                <div class="fs-4 fw-bold kpi-pastel-value"><span id="kpi-status-belum">0</span> <span class="fs-6 fw-normal kpi-pastel-sub">menunggu</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Toolbar Aksi & Filter Jadwal -->
            <div class="card status-toolbar-panel mb-3 d-none" id="info">
                <div class="card-body p-2 p-md-3">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                        <!-- Sisi Kiri: Filter Jadwal & Tombol Refresh / Bantuan -->
                        <div class="d-flex flex-wrap align-items-center gap-2 flex-grow-1" style="min-width: 280px; max-width: 680px;">
                            <div class="input-group input-group-sm shadow-sm flex-grow-1" style="min-width: 220px; max-width: 440px;">
                                <span class="input-group-text bg-white text-primary border-end-0 fw-bold">
                                    <i class="fas fa-book-open me-1.5"></i> Jadwal
                                </span>
                                <select name="jadwal-by" id="jadwal-by" class="form-select form-select-sm border-start-0 fw-semibold text-dark shadow-none" style="height: 38px;"></select>
                            </div>
                            <div class="btn-group btn-group-sm shadow-sm" role="group">
                                <button type="button" class="btn btn-light border text-secondary fw-semibold py-1 px-3 d-inline-flex align-items-center" onclick="refreshStatus()" data-bs-toggle="tooltip" title="Segarkan status ujian" style="height: 38px;">
                                    <i class="fas fa-sync-alt me-1.5 text-primary"></i> Refresh
                                </button>
                                <button type="button" class="btn btn-light border text-info fw-semibold py-1 px-3 d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#bantuanStatusModal" title="Petunjuk & Bantuan Aksi" style="height: 38px;">
                                    <i class="fas fa-question-circle me-1.5"></i> Bantuan
                                </button>
                            </div>
                        </div>

                        <!-- Sisi Kanan: Pencarian & Terapkan Aksi -->
                        <div class="d-flex align-items-center gap-2 ms-auto">
                            <div class="input-group input-group-sm shadow-sm" style="width: 240px;">
                                <span class="input-group-text bg-white text-muted border-end-0 py-1" style="height: 38px;">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="search" id="cari-status-siswa" class="form-control form-control-sm border-start-0 shadow-none py-1" placeholder="Cari peserta / kelas..." style="height: 38px;">
                            </div>
                            <?php $dnone = ''; ?>
                            <button type="button" class="btn btn-sm btn-success fw-bold shadow-sm px-3 d-inline-flex align-items-center text-nowrap <?= $dnone ?>" onclick="terapkanAksi()" data-bs-toggle="tooltip" title="Terapkan Aksi pada siswa terpilih" style="height: 38px; min-width: 155px;">
                                <i class="fas fa-check-double me-1.5"></i> Terapkan Aksi
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wrapper Tabel Status Peserta Ujian -->
            <div class="table-responsive" id="table-status-wrapper">
                <table class="table table-bordered table-sm" id="table-status"></table>
            </div>
        </div>
        <div class="overlay d-none" id="loading">
            <div class="spinner-grow"></div>
        </div>
    </div>

    <?= form_open('', array('id' => 'reset')) ?>
    <div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="resetLabel" aria-hidden="true">
        <div class="modal-dialog modal-xs" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resetLabel">Reset Waktu Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="id_cbt_siswa" name="id_cbt_siswa" value="">
                        <div class="icheck-success">
                            <input class="radio" type="radio" name="reset" id="reset1" value="1">
                            <label for="reset1">Reset Waktu dari awal</label>
                        </div>
                        <div class="icheck-success">
                            <input class="radio" type="radio" name="reset" id="reset2" value="2">
                            <label for="reset2">Lanjutkan sisa waktu</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary shadow-sm">OK</button>
                    <button type="button" class="btn btn-secondary shadow-sm" data-bs-dismiss="modal">BATAL</button>
                </div>
            </div>
        </div>
    </div>
    <?= form_close() ?>

    <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoLabel">Kode error siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table w-100">
                        <tr>
                            <td class="fw-bold text-bold">001</td>
                            <td>:</td>
                            <td>Token salah atau token belum digenerate</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-bold">002</td>
                            <td>:</td>
                            <td>Harus reset izin</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-bold">003</td>
                            <td>:</td>
                            <td>Harus reset waktu</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-bold">004</td>
                            <td>:</td>
                            <td>Soal belum dibuat atau belum dipilih</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-bold">005</td>
                            <td>:</td>
                            <td>Siswa menggunakan browser yang tidak mendukung</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-bold">006</td>
                            <td>:</td>
                            <td>internet down atau error dari database/server</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary shadow-sm" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Panduan / Bantuan Status Ujian -->
    <div class="modal fade" id="bantuanStatusModal" tabindex="-1" role="dialog" aria-labelledby="bantuanStatusLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content shadow border-0" style="border-radius: 12px; overflow: hidden;">
                <div class="modal-header bg-primary text-white py-3">
                    <h5 class="modal-title fs-6 fw-bold" id="bantuanStatusLabel">
                        <i class="fa fa-question-circle me-2"></i>Panduan &amp; Aksi Status Ujian
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3 p-md-4">
                    <div id="info-penggunaan">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item px-0 py-2 border-0 d-flex align-items-start">
                                <span class="badge bg-light text-dark border me-3 mt-1 text-nowrap"><i class="fa fa-sync text-primary me-1"></i> Refresh</span>
                                <div class="small">Perbarui status ujian dan progres pengerjaan siswa secara realtime.</div>
                            </div>
                            <div class="list-group-item px-0 py-2 border-0 d-flex align-items-start">
                                <span class="badge bg-warning text-dark me-3 mt-1 text-nowrap">RESET WAKTU</span>
                                <div class="small">Jika siswa keluar/logout sebelum selesai dan tidak melanjutkan sampai batas waktu habis, reset waktu untuk mengizinkan siswa melanjutkan.</div>
                            </div>
                            <div class="list-group-item px-0 py-2 border-0 d-flex align-items-start">
                                <span class="badge bg-info text-white me-3 mt-1 text-nowrap">RESET IZIN</span>
                                <div class="small">Mengizinkan siswa kembali login atau melanjutkan ujian di perangkat/browser yang berbeda.</div>
                            </div>
                            <div class="list-group-item px-0 py-2 border-0 d-flex align-items-start">
                                <span class="badge bg-danger text-white me-3 mt-1 text-nowrap">PAKSA SELESAI</span>
                                <div class="small">Menghentikan dan mengunci ujian siswa dari jarak jauh serta langsung menyimpan jawaban akhir.</div>
                            </div>
                            <div class="list-group-item px-0 py-2 border-0 d-flex align-items-start">
                                <span class="badge bg-secondary text-white me-3 mt-1 text-nowrap">ULANG</span>
                                <div class="small">Mengulang ujian siswa dari awal (menghapus progres jawaban yang sudah ada).</div>
                            </div>
                            <div class="list-group-item px-0 py-2 border-0 d-flex align-items-start">
                                <span class="badge bg-success text-white me-3 mt-1 text-nowrap"><i class="fa fa-check me-1"></i> Terapkan</span>
                                <div class="small">Mengeksekusi aksi yang telah dipilih/dicentang pada tabel siswa sekaligus secara massal.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer py-2 bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pelanggaranModal" tabindex="-1" role="dialog" aria-labelledby="pelanggaranLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pelanggaranLabel">Pelanggaran Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table w-100 table-bordered">
                        <tr>
                            <th>Jenis Pelanggaran</th>
                            <th>Jumlah</th>
                        </tr>
                        <tr>
                            <td>
                                Pelanggaran Ringan
                                <ul>
                                    <li>Memulai ujian dengan tampilan tidak fullscreen</li>
                                </ul>
                            </td>
                            <td class="text-bold align-middle text-center" id="jml-ringan"></td>
                        </tr>
                        <tr>
                            <td>
                                Pelanggaran Sedang
                                <ul>
                                    <li>Mencoba keluar dari fullscreen</li>
                                </ul>
                            </td>
                            <td class="text-bold align-middle text-center" id="jml-sedang"></td>
                        </tr>
                        <tr>
                            <td>
                                Pelanggaran Berat
                                <ul>
                                    <li>Mencoba membuka tab baru</li>
                                    <li>Keluar dari aplikasi sebelum selesai</li>
                                    <li>Me-minimize browser</li>
                                </ul>
                            </td>
                            <td class="text-bold align-middle text-center" id="jml-berat"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary shadow-sm" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pantau Kamera Peserta Ujian -->
<div class="modal fade" id="modalPantauKamera" tabindex="-1" aria-labelledby="modalPantauKameraLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
        <div class="modal-content shadow border-0" style="border-radius: 14px; overflow: hidden;">
            <div class="modal-header bg-dark text-white py-2 px-3">
                <h6 class="modal-title fw-bold mb-0 d-flex align-items-center" id="modalPantauKameraLabel">
                    <i class="fas fa-video text-danger me-2"></i> Pengawasan Kamera Peserta
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" onclick="tutupPantauKamera()"></button>
            </div>
            <div class="modal-body p-3 bg-light">
                <div class="d-flex justify-content-between align-items-center mb-2 px-1">
                    <div>
                        <div class="fw-bold text-dark fs-6" id="pantau-nama-siswa">-</div>
                        <small class="text-muted" id="pantau-nomor-siswa">-</small>
                    </div>
                    <div>
                        <span id="pantau-badge-status" class="badge bg-secondary px-2 py-1">Menghubungkan...</span>
                    </div>
                </div>
                <div class="position-relative rounded shadow-sm overflow-hidden" style="background: #111; min-height: 280px; display: flex; align-items: center; justify-content: center;">
                    <img id="pantau-video-frame" src="" style="width: 100%; height: auto; max-height: 340px; display: none; object-fit: cover; transform: scaleX(-1);" alt="Live Feed">
                    <div id="pantau-loading-placeholder" class="text-white p-4 text-center">
                        <i class="fas fa-spinner fa-spin fa-2x mb-2 text-primary"></i>
                        <div class="small text-white-50">Menghubungkan ke kamera siswa...</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-2 px-1" style="font-size: 0.78rem;">
                    <span class="text-muted" id="pantau-last-update">Menunggu sinyal...</span>
                    <span class="text-success fw-bold"><i class="fas fa-shield-alt me-1"></i> Live Proctoring</span>
                </div>
            </div>
            <div class="modal-footer py-2 px-3 bg-white d-flex justify-content-between">
                <button type="button" class="btn btn-sm btn-secondary" onclick="tutupPantauKamera()" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Tutup
                </button>
                <small class="text-muted" style="font-size: 0.75rem;">Kamera hanya aktif saat dipantau</small>
            </div>
        </div>
    </div>
</div>

<?= form_open('', array('id' => 'post_data')) ?>
<?= form_close(); ?>

<script src="<?= base_url() ?>/assets/app/js/findMyData.js"></script>
<script>
    let ruangs = {};
    let arrRuang = [];
    var dnone = "";
    var printBy = '1';
    var url = '';

    var kelas;
    var tglJadwal, ruang, sesi;
    let responseJadwal;
    let jadwalSelected = 'all';

    function toggleFullScreenStatus() {
        var elem = document.documentElement;

        if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) {
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.msRequestFullscreen) {
                elem.msRequestFullscreen();
            } else if (elem.mozRequestFullScreen) {
                elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullscreen) {
                elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            }
        }
    }

    document.addEventListener("fullscreenchange", updateFullscreenBtn);
    document.addEventListener("webkitfullscreenchange", updateFullscreenBtn);
    document.addEventListener("mozfullscreenchange", updateFullscreenBtn);
    document.addEventListener("MSFullscreenChange", updateFullscreenBtn);

    function updateFullscreenBtn() {
        var isFull = document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement;
        var btn = $('#btn-fullscreen');
        if (isFull) {
            btn.html('<i class="fa fa-compress me-1"></i> Keluar Fullscreen');
            btn.removeClass('btn-dark').addClass('btn-danger');
            $('body').addClass('fullscreen-active');
            try { sessionStorage.setItem('cbt_status_fullscreen', '1'); } catch (e) {}
            $('#fullscreen-restore-toast').remove();
        } else {
            btn.html('<i class="fa fa-expand me-1"></i> Fullscreen');
            btn.removeClass('btn-danger').addClass('btn-dark');
            $('body').removeClass('fullscreen-active');
            try { sessionStorage.setItem('cbt_status_fullscreen', '0'); } catch (e) {}
        }
    }

    function reloadStatusData(btn) {
        var $btn = $(btn || '#btn-reload-status');
        var originalHtml = $btn.html();
        $btn.prop('disabled', true).html('<i class="fa fa-sync fa-spin me-1"></i> Memuat...');

        // 1. Refresh Token Ujian
        if (typeof getToken === 'function') {
            try { getToken(); } catch (e) { console.error('Token refresh err:', e); }
        }

        // 2. Refresh Kode Keluar Kiosk CBT
        $.ajax({
            url: base_url + "cbtstatus/get_exit_code",
            type: 'GET',
            dataType: 'json',
            cache: false,
            success: function (res) {
                if (res && res.code) {
                    $('#kiosk-exit-code-view').text(res.code);
                }
            }
        });

        // 3. Refresh Jadwal & Status Siswa realtime tanpa reload halaman
        if (url && url !== '') {
            $('#cari-status-siswa').val('');
            $('#loading').removeClass('d-none');
            $.ajax({
                type: "GET",
                url: url,
                cache: false,
                success: function (response) {
                    $('#loading').addClass('d-none');
                    responseJadwal = response;
                    optionJadwal();
                    if (typeof showSuccessToast === 'function') {
                        showSuccessToast('Data status ujian berhasil diperbarui');
                    }
                },
                error: function (xhr, status, error) {
                    $('#loading').addClass('d-none');
                    console.error("Gagal refresh status siswa:", error);
                },
                complete: function () {
                    setTimeout(function () {
                        $btn.prop('disabled', false).html(originalHtml);
                    }, 400);
                }
            });
        } else {
            getAllJadwal();
            setTimeout(function () {
                $btn.prop('disabled', false).html(originalHtml);
                if (typeof showSuccessToast === 'function') {
                    showSuccessToast('Data status ujian berhasil diperbarui');
                }
            }, 600);
        }
    }

    $(document).ready(function () {
        ajaxcsrf();

        // Restore mode Fullscreen jika sebelumnya aktif dan terjadi hard refresh
        try {
            if (sessionStorage.getItem('cbt_status_fullscreen') === '1' && !document.fullscreenElement) {
                var restoreHtml = `
                <div id="fullscreen-restore-toast" class="position-fixed top-0 start-50 translate-middle-x mt-3 shadow-lg" style="z-index: 99999999;">
                    <div class="alert alert-primary d-flex align-items-center gap-2 py-2 px-3 mb-0 rounded-pill border-0 shadow">
                        <i class="fa fa-expand text-primary"></i>
                        <span class="small">Mode Layar Penuh (Fullscreen) sebelumnya aktif:</span>
                        <button type="button" class="btn btn-sm btn-primary rounded-pill px-3 py-1 fw-bold" onclick="toggleFullScreenStatus(); $('#fullscreen-restore-toast').remove();">
                            Lanjut Fullscreen
                        </button>
                        <button type="button" class="btn btn-sm btn-link text-muted p-0 ms-1" onclick="$(this).closest('#fullscreen-restore-toast').remove(); sessionStorage.setItem('cbt_status_fullscreen', '0');">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>`;
                $('body').append(restoreHtml);

                var restoreFsOnInteraction = function() {
                    if (sessionStorage.getItem('cbt_status_fullscreen') === '1' && !document.fullscreenElement) {
                        toggleFullScreenStatus();
                    }
                    $('#fullscreen-restore-toast').remove();
                    $(document).off('click.fsRestore keydown.fsRestore');
                };
                $(document).on('click.fsRestore keydown.fsRestore', restoreFsOnInteraction);
            }
        } catch (e) {}

        $('#btn-generate-exit-code').on('click', function () {
            var btn = $(this);
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i> Buat...');
            $.ajax({
                url: base_url + "cbtstatus/generate_exit_code",
                type: 'POST',
                dataType: 'json',
                success: function (res) {
                    btn.prop('disabled', false).html('<i class="fas fa-sync-alt me-1"></i> Buat Baru');
                    if (res && res.status) {
                        $('#kiosk-exit-code-view').text(res.code);
                        if (typeof showSuccessToast === 'function') {
                            showSuccessToast('Kode keluar ujian diperbarui: ' + res.code);
                        } else if (typeof swal !== 'undefined') {
                            swal.fire({
                                title: 'Kode Keluar Baru',
                                html: '<h2 class="text-success fw-bold letter-spacing-2">' + res.code + '</h2><p class="text-muted">Gunakan kode atau QR ini untuk membuka ujian di APK Android.</p>',
                                icon: 'success'
                            });
                        }
                    }
                },
                error: function () {
                    btn.prop('disabled', false).html('<i class="fas fa-sync-alt me-1"></i> Buat Baru');
                    alert('Gagal memperbarui kode keluar ujian');
                }
            });
        });

        $('#btn-copy-exit-code').on('click', function () {
            var code = $('#kiosk-exit-code-view').text().trim();
            if (code && code !== '------') {
                if (navigator.clipboard) {
                    navigator.clipboard.writeText(code).then(function() {
                        if (typeof showSuccessToast === 'function') showSuccessToast('Kode ' + code + ' berhasil disalin!');
                        else alert('Kode: ' + code);
                    });
                } else {
                    alert('Kode: ' + code);
                }
            }
        });

        var opsiPrintBy = $("#printby");


        opsiPrintBy.change(function () {
            printBy = $(this).val();
            if (printBy === '1') {
                $('#by-kelas').addClass('d-none');
                $('.by-ruang').removeClass('d-none');
                if (ruang && sesi && tglJadwal) loadSiswaRuang(ruang, sesi, tglJadwal)
            } else {
                $('#by-kelas').removeClass('d-none');
                $('.by-ruang').addClass('d-none');
                if (kelas && tglJadwal) loadSiswaKelas(kelas, tglJadwal)
            }
        });

        var idSiswa = '';
        var idCbtSiswa = '';
        $('#resetModal').on('show.bs.modal', function (e) {
            idSiswa = $(e.relatedTarget).data('siswa');
            idCbtSiswa = $(e.relatedTarget).data('cbt');
            $('#id_cbt_siswa').val(idCbtSiswa)
        });

        $('#reset').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            $('#resetModal').modal('hide').data('bs.modal', null);

            let formData = new FormData($('#reset')[0]);

            $.ajax({
                url: base_url + "cbtstatus/resettimer",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status) refreshStatus();
                    else showDangerToast('tidak bisa mereset waktu');
                }, error: function (xhr, status, error) {
                    console.log('error');
                }
            });
        });

        const select2SearchConfig = {
            width: '100%',
            theme: 'bootstrap4'
        };

        var opsiJadwal = $("#jadwal-by");
        if ($.fn.select2) {
            opsiJadwal.select2(select2SearchConfig);
        }
        opsiJadwal.change(function () {
            jadwalSelected = $(this).val();
            if (jadwalSelected === 'all') {
                createPreview(responseJadwal, true);
                return;
            }
            const filter = responseJadwal.jadwals.filter(jad => jad.id_jadwal === jadwalSelected);
            const newData = { ...responseJadwal, jadwals: filter.length > 0 ? filter : [] };
            createPreview(newData, true)
        })

        $('#pelanggaranModal').on('show.bs.modal', function (e) {
            const ringan = $(e.relatedTarget).data('ringan');
            const sedang = $(e.relatedTarget).data('sedang');
            const berat = $(e.relatedTarget).data('berat');

            $(e.currentTarget).find('#jml-ringan').text(ringan + ' x');
            $(e.currentTarget).find('#jml-sedang').text(sedang + ' x');
            $(e.currentTarget).find('#jml-berat').text(berat + ' x');
        });

        $('#cari-status-siswa').on("input", function () {
            const searchTerm = $(this).val().toLowerCase();
            const result = simpleDataSearch(responseJadwal, {
                arrayKeys: ['jadwals', 'sesisiswa'],
                keys: ['siswa.nama', 'siswa.agama', 'peserta.nomor_peserta',
                    'ruang.kode_ruang', 'kelas.kode_kelas', 'sesi.kode_sesi',
                    'bank.bank_kode', 'bank.mapel.kode'],
            });
            let resName = result.search(searchTerm);
            if (resName.jadwals.length > 0 && resName.sesisiswa.length > 0) {
                const newData = { ...responseJadwal, jadwals: resName.jadwals, sesisiswa: resName.sesisiswa };
                createPreview(newData);
                return;
            }

            if (resName.sesisiswa.length > 0) {
                const newData = { ...responseJadwal, sesisiswa: resName.sesisiswa, jadwals: responseJadwal.jadwals };
                createPreview(newData);
                return;
            }

            if (resName.jadwals.length > 0) {
                const newData = { ...responseJadwal, jadwals: resName.jadwals, sesisiswa: responseJadwal.sesisiswa };
                createPreview(newData);
                return;
            }

            const newData = { ...responseJadwal, jadwals: [], sesisiswa: [] };
            createPreview(newData);
        });

        getAllJadwal();
    });

    function terapkanAksi() {
        const $rows = $('#table-status').find('tr:visible'), headers = $rows.splice(0, 2);
        let itemJadwal = {
            reset: [],
            force: [],
            ulang: [],
        }
        let jmlSiswaReset = [];
        let jmlSiswaForce = [];
        let jmlSiswaUlang = [];
        $rows.each((i, row) => {
            const $colReset = $(row).find('.input-reset');
            const $colForce = $(row).find('.input-force');
            const $colUlang = $(row).find('.input-ulang');

            if ($colReset.prop("checked") === true) {
                const jadwal_id = $colReset.parent().data('jadwal')
                const cbt_id = $colReset.parent().data('cbt')
                const siswa_id = $colForce.parent().data('siswa')
                if (!jmlSiswaReset.includes(siswa_id)) jmlSiswaReset.push(siswa_id)

                const item = itemJadwal.force.find(j => j.id_jadwal?.toString() === jadwal_id?.toString())
                if (item) {
                    item.id_cbt_siswa.push(cbt_id)
                } else {
                    let reset = {
                        id_jadwal: jadwal_id,
                        id_cbt_siswa: [cbt_id], // for cbt_siswa
                    }
                    itemJadwal.reset.push(reset)
                }
            }
            if ($colForce.prop("checked") === true) {
                const cbt_id = $colForce.parent().data('cbt')
                const jadwal_id = $colForce.parent().data('jadwal')
                const siswa_id = $colForce.parent().data('siswa')
                if (!jmlSiswaForce.includes(siswa_id)) jmlSiswaForce.push(siswa_id)

                const item = itemJadwal.force.find(j => j.id_jadwal?.toString() === jadwal_id?.toString())
                if (item) {
                    item.id_cbt_siswa.push(cbt_id)
                    item.id_siswa.push(siswa_id)
                } else {
                    let force = {
                        id_jadwal: jadwal_id,
                        id_cbt_siswa: [cbt_id], // for cbt_siswa
                        id_siswa: [siswa_id]    // for log_ujian
                    }
                    itemJadwal.force.push(force)
                }
            }
            if ($colUlang.prop("checked") === true) {
                const jadwal_id = $colUlang.parent().data('jadwal')
                const cbt_id = $colUlang.parent().data('cbt')
                const siswa_id = $colUlang.parent().data('siswa')
                if (!jmlSiswaUlang.includes(siswa_id)) jmlSiswaUlang.push(siswa_id)

                const item = itemJadwal.force.find(j => j.id_jadwal?.toString() === jadwal_id?.toString())
                if (item) {
                    item.id_cbt_siswa.push(cbt_id)
                    item.id_siswa.push(siswa_id)
                } else {
                    let ulang = {
                        id_jadwal: jadwal_id,
                        id_cbt_siswa: [cbt_id], // for cbt_siswa
                        id_siswa: [siswa_id]    // for log_ujian
                    }
                    itemJadwal.ulang.push(ulang)
                }
            }
        })

        var jmlReset = jmlSiswaReset.length === 0 ? '' : '<b>' + jmlSiswaReset.length + '</b> siswa akan direset<br>';
        var jmlForce = jmlSiswaForce.length === 0 ? '' : '<b>' + jmlSiswaForce.length + '</b> siswa akan dipaksa selesai<br>';
        var jmlUlang = jmlSiswaUlang.length === 0 ? '' : '<b>' + jmlSiswaUlang.length + '</b> siswa akan mengulang ujian';

        var resReset = jmlSiswaReset.length === 0 ? '' : '<b>' + jmlSiswaReset.length + '</b> siswa berhasil direset<br>';
        var resForce = jmlSiswaForce.length === 0 ? '' : '<b>' + jmlSiswaForce.length + '</b> siswa berhasil dipaksa selesai<br>';
        var resUlang = jmlSiswaUlang.length === 0 ? '' : '<b>' + jmlSiswaUlang.length + '</b> siswa harus mengulang ujian';

        if (itemJadwal.reset.length === 0 && itemJadwal.force.length === 0 && itemJadwal.ulang.length === 0) {
            showWarningToast('Silahkan pilih siswa terlebih dulu');
            return;
        }

        let formData = new FormData($('#post_data')[0]);
        formData.append("data", JSON.stringify(itemJadwal));
        swal.fire({
            title: "Terapkan Aksi",
            html: jmlReset + jmlForce + jmlUlang,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Apply"
        }).then(result => {
            if (result.value) {
                $.ajax({
                    url: base_url + "cbtstatus/applyaction",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        swal.fire({
                            title: "Sukses",
                            html: resForce + resReset + resUlang,
                            icon: "success"
                        }).then(result => {
                            if (printBy === '1') {
                                url = base_url + "cbtstatus/getstatussiswa?ruang=" + ruang + '&sesi=' + sesi + '&tgl=' + tglJadwal;
                            } else {
                                url = base_url + "cbtstatus/getstatussiswa?kelas=" + kelas + '&tgl=' + tglJadwal;
                            }
                            refreshStatus();
                        });
                    }, error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                        swal.fire({
                            "title": "Error",
                            "html": xhr.responseText,
                            "icon": "error"
                        });
                    }
                });
            }
        });
    }

    function refreshStatus() {
        $('#cari-status-siswa').val('')
        $('#loading').removeClass('d-none');
        setTimeout(function () {
            $.ajax({
                type: "GET",
                url: url,
                success: function (response) {
                    responseJadwal = response;
                    optionJadwal();
                }
            });
        }, 500);
    }

    function optionJadwal() {
        var opsiJadwal = $("#jadwal-by");
        opsiJadwal.html('');
        opsiJadwal.append(`<option value="all" ${jadwalSelected === 'all' ? 'selected' : ''}>Semua Jadwal</option>`);
        for (const jadwal of responseJadwal.jadwals) {
            if (jadwal) {
                const mapelName = jadwal.bank?.mapel?.nama_mapel || jadwal.bank?.mapel?.kode || '';
                const bankKode = jadwal.bank?.bank_kode || '';
                const labelText = mapelName ? `${mapelName} (${bankKode})` : bankKode;
                opsiJadwal.append(`<option value="${jadwal.id_jadwal}" ${jadwalSelected === jadwal.id_jadwal ? 'selected' : ''}>${labelText}</option>`);
            }
        }
        opsiJadwal.trigger('change');
    }

    function createPreview(data, isInit) {
        console.log('jadwal', data)
        const disabled = data.is_empty ? 'disabled' : '';
        let tbody = '<thead class="alert-light">' +
            '<tr>' +
            '<th rowspan="2" class="text-center align-middle">No.</th>' +
            '<th rowspan="2" class="text-center align-middle" style="min-width: 220px">Data Siswa</th>' +
            '<th colspan="3" class="text-center align-middle">Jadwal Ujian</th>' +
            '<th colspan="3" class="text-center align-middle">Status Siswa</th>' +
            '<th colspan="4" class="text-center align-middle ' + dnone + '">Aksi</th>' +
            '</tr>' +
            '<tr>' +
            '<th class="text-center align-middle">Jam<br/>ke</th>' +
            '<th class="text-center align-middle">Mapel</th>' +
            '<th class="text-center align-middle">Kode & <br/>Status Jadwal</th>' +
            '<th class="text-center align-middle p-1">Mulai</th>' +
            '<th class="text-center align-middle">Durasi</th>' +
            '<th class="text-center align-middle">Fouls</th>' +
            '<th class="text-center align-middle ' + dnone + '">Reset<br/>Waktu</th>' +
            '<th class="text-center align-middle ' + dnone + '">Reset<br/>Izin' +
            '<br><input id="input-reset-all" class="check" type="checkbox" ' + disabled + '>' +
            '</th>' +
            '<th class="text-center align-middle ' + dnone + '">Paksa<br/>Selesai' +
            '<br><input id="input-force-all" class="check" type="checkbox" ' + disabled + '>' +
            '</th>' +
            '<th class="text-center align-middle ' + dnone + '">Ulang' +
            '<br><input id="input-ulang-all" class="check" type="checkbox" ' + disabled + '>' +
            '</th>' +
            '</tr></thead><tbody>';

        const all_jadwals = (Array.isArray(data.jadwals) ? data.jadwals : []);
        let kpiTotal = 0, kpiAktif = 0, kpiSelesai = 0, kpiBelum = 0;
        if (Array.isArray(data.sesisiswa) && data.sesisiswa.length > 0) {
            data.sesisiswa.sort((a, b) => a.peserta?.nomor_peserta?.localeCompare(b.peserta?.nomor_peserta, undefined, {numeric: true}))
            let ind = 1;
            for (const sesiSiswa of data.sesisiswa) {
                var genap = ind % 2 === 0;
                const bgRow = genap ? '#e9ecef' : '#fff'

                const idSiswa = sesiSiswa?.siswa_id ?? 'N/A';
                var sesi = sesiSiswa?.sesi?.kode_sesi ?? 'N/A';
                var ruang = sesiSiswa?.ruang?.kode_ruang ?? 'N/A';
                var kelas = sesiSiswa?.kelas?.kode_kelas ?? 'N/A';
                const nama = sesiSiswa?.siswa?.nama ?? '';
                const agama = sesiSiswa?.siswa?.agama ?? '';
                const sesi_id = sesiSiswa?.sesi_id ?? '';
                const ruang_id = sesiSiswa?.ruang_id ?? '';

                const bankSoals = all_jadwals.filter(jad =>
                        !(jad?.bank?.soal_agama != '-' && jad?.bank?.soal_agama != '0' && jad?.bank?.soal_agama != agama) &&
                        jad?.bank?.bank_kelas?.some(k => k?.kelas_id?.toString() == sesiSiswa?.kelas_id?.toString())
                );

                bankSoals.sort((a, b) => {
                    const jamA = parseInt(a?.pengawas?.[ruang_id]?.[sesi_id]?.jam_ke || 1);
                    const jamB = parseInt(b?.pengawas?.[ruang_id]?.[sesi_id]?.jam_ke || 1);
                    return jamA - jamB;
                });

                let rowsMapel = bankSoals.length || "1";
                if (bankSoals.length > 0) {
                    let indJadwal = 0;
                    for (const bank of bankSoals) {
                        const pengawas = bank?.pengawas?.[ruang_id]?.[sesi_id] || {};
                        const akhirUjian = ((bank.tgl_selesai).split(' ')[0]).replaceAll('-', '')
                        const now = ((data.today).split(' ')[0]).replaceAll('-', '')
                        const tglBerkahir = now > akhirUjian
                        const tersedia = tglBerkahir ? '<i class="fa fa-times-circle text-danger"></i>' : '<i class="fa fa-check-circle text-success"></i>'
                        let rowJadwal = '<td class="align-middle text-center">'+(pengawas.jam_ke || '1')+'</td>' +
                            '<td class="align-middle">' + bank.bank.mapel.kode + '</td>' +
                            '<td class="align-middle text-center"><div class="d-flex flex-row justify-content-between">' +
                            '<span>' + bank.bank.bank_kode + '</span>' +
                            '<span class="ms-2 me-2">' + tersedia + '</span></div></td>';

                        if (Array.isArray(sesiSiswa?.cbtsiswa) && sesiSiswa.cbtsiswa.length > 0) {
                            const cbtSiswa = sesiSiswa.cbtsiswa.find(cbt => cbt?.id_jadwal === bank?.id_jadwal);
                            kpiTotal++;
                            if (cbtSiswa) {
                                const hitungDurasi = kalkulasiWaktu(cbtSiswa)
                                const durasi = hitungDurasi.durasi || '0m';
                                var sudahSelesai = cbtSiswa.selesai || false;
                                if (sudahSelesai) { kpiSelesai++; } else { kpiAktif++; }
                                var loading = sudahSelesai ? '<i class="fa fa-check me-2 text-success"></i>' : '<i class="fa fa-spinner fa-spin me-2 text-primary"></i>';

                                var disabledResetWaktu = !tglBerkahir && !sudahSelesai && cbtSiswa.reset_waktu === '0' ? '' : 'disabled';
                                var disabledResetIzin = !sudahSelesai && cbtSiswa.reset_izin != null && cbtSiswa.reset_izin === '0' ? '' : 'disabled';
                                var disabledSelesai = !sudahSelesai ? '' : 'disabled';
                                var disabledUlang = sudahSelesai ? '' : 'disabled';

                                const mulai = () => {
                                    if (!bank?.tgl_mulai || !cbtSiswa?.mulai) return '- : -';
                                    const start = bank.tgl_mulai.replaceAll('-', '');
                                    const time = cbtSiswa?.mulai?.split(' ')[0].replaceAll('-', '');
                                    let susulan = time > start ? '<br /><span class="text-xs">susulan</span>' : '';
                                    const siswaMulai = new Date(cbtSiswa?.mulai)
                                    return `${zeroPad(siswaMulai.getHours(), 2)}:${zeroPad(siswaMulai.getMinutes(), 2)}${susulan}`;
                                };

                                const totalPelanggaran = function () {
                                    if (bank?.pelanggaran != '1') {
                                        return 0;
                                    } else {
                                        return (cbtSiswa.pelanggaran?.ringan || 0) + (cbtSiswa.pelanggaran?.sedang || 0) + (cbtSiswa.pelanggaran?.berat || 0);
                                    }
                                }
                                const btn = `<button class="btn ${bank?.pelanggaran != '1' ? 'btn-outline-secondary' : 'btn-outline-danger'} btn-sm fw-bold"
                                                data-bs-toggle="modal" data-bs-target="#pelanggaranModal"
                                                data-ringan="${cbtSiswa.pelanggaran?.ringan || 0 }"
                                                data-sedang="${cbtSiswa.pelanggaran?.sedang || 0}"
                                                data-berat="${cbtSiswa.pelanggaran?.berat || 0}"
                                                ${bank?.pelanggaran != '1' ? 'disabled' : ''}>${totalPelanggaran()} x</button>`
                                const btnKamera = (bank?.kamera == '1' && !sudahSelesai) ? 
                                    '<br/><button type="button" class="btn btn-outline-primary btn-sm fw-bold px-2 py-0 mt-1 shadow-sm" onclick="bukaPantauKamera(\''+idSiswa+'\', \''+(cbtSiswa?.id_jadwal || bank?.id_jadwal)+'\', \''+(nama || '').replace(/'/g, "\\'")+'\', \''+(sesiSiswa?.peserta?.nomor_peserta || '')+'\')" title="Pantau Kamera Peserta"><i class="fas fa-video me-1"></i>Pantau</button>' : '';

                                rowJadwal += '<td class="text-center align-middle">' + mulai() + '</td>' +
                                    '<td class="text-center align-middle">' + loading + durasi + btnKamera + '</td>' +
                                    '<td class="text-center align-middle">' + btn + '</td>' +
                                    '<td class="text-center align-middle '+dnone+'">' +
                                    '	<button type="button" class="btn btn-warning text-white btn-sm px-2" ' +
                                    'data-siswa="' + idSiswa + '" data-cbt="' + cbtSiswa.id_cbt_siswa + '" ' +
                                    'data-bs-toggle="modal" data-bs-target="#resetModal" ' + disabledResetWaktu + '> <i class="fa fa-sync me-1"></i> Reset</button>' +
                                    '</td>' +
                                    '<td class="text-center text-success align-middle ' + dnone + '" data-siswa="'+idSiswa+'" data-cbt="' + cbtSiswa.id_cbt_siswa + '" data-jadwal="'+ cbtSiswa.id_jadwal +'">' +
                                    '<input class="check input-reset" type="checkbox" ' + disabledResetIzin + '>' +
                                    '</td>' +
                                    '<td class="text-center text-danger align-middle ' + dnone + '" data-siswa="'+idSiswa+'" data-cbt="' + cbtSiswa.id_cbt_siswa + '" data-jadwal="'+ cbtSiswa.id_jadwal +'">' +
                                    '<input class="check input-force" type="checkbox" ' + disabledSelesai + '>' +
                                    '</td>' +
                                    '<td class="text-center text-danger align-middle ' + dnone + '" data-siswa="'+idSiswa+'" data-cbt="' + cbtSiswa.id_cbt_siswa + '" data-jadwal="'+ cbtSiswa.id_jadwal +'">' +
                                    '<input class="check input-ulang" type="checkbox" ' + disabledUlang + '>' +
                                    '</td>' +
                                    '</tr>';
                            } else {
                                kpiBelum++;
                                rowJadwal += '<td colspan="7" class="align-middle text-center text-warning">Belum mengerjakan</td></tr>'
                            }
                        } else {
                            kpiTotal++;
                            kpiBelum++;
                            rowJadwal += '<td colspan="7" class="align-middle text-center text-warning">Belum mengerjakan</td></tr>'
                        }
                        if (indJadwal === 0) {
                            tbody += '<tr style="background: '+bgRow+'" data-siswa="'+idSiswa+'">' +
                                '<td rowspan="'+rowsMapel+'" class="text-center align-middle">' + ind + '</td>' +
                                '<td rowspan="'+rowsMapel+'" class="align-middle">' +
                                '<div class="d-flex flex-column">' +
                                '<span class="fw-bold">' + nama + '</span>' +
                                '<span>' + sesiSiswa?.peserta?.nomor_peserta + '</span>' +
                                '<div class="m-0">';
                            if (agama) {
                                tbody += '<span class="badge bg-primary me-1">' + agama + '</span>';
                            }
                            tbody += '<span class="badge bg-primary me-1">' + kelas + '</span>'+
                                '<span class="badge bg-primary me-1">' + ruang +'</span>' +
                                '<span class="badge bg-primary">'+ sesi + '</span>' +
                                '</div></div>' +
                                '</td>';
                            tbody += rowJadwal+'</tr>';
                            ind ++
                        } else {
                            tbody += '<tr style="background: '+bgRow+'">'+rowJadwal;
                        }
                        indJadwal ++;
                    }
                }
            }
        } else {
            const isEmpty = isInit ? 'Tidak ada siswa tergabung disini!' : 'Pencarian tidak ditemukan';
            tbody += '<tr><td colspan="12" class="text-center">'+isEmpty+'</td></tr>'
        }

        tbody += '</tbody>';
        $('#table-status').html(tbody);
        $('#kpi-status-total').text(kpiTotal);
        $('#kpi-status-aktif').text(kpiAktif);
        $('#kpi-status-selesai').text(kpiSelesai);
        $('#kpi-status-belum').text(kpiBelum);
        $('#status-kpi-row').toggleClass('d-none', kpiTotal === 0);
        $('#info').removeClass('d-none');

        $('#loading').addClass('d-none');

        $("#input-reset-all").on("click", function () {
            if (this.checked) {
                $(".input-reset").each(function () {
                    if (!$(this).prop('disabled')) {
                        this.checked = true;
                    }
                    $("#input-reset-all").prop("checked", true);
                });
            } else {
                $(".input-reset").each(function () {
                    if (!$(this).prop('disabled')) {
                        this.checked = false;
                    }
                    $("#input-reset-all").prop("checked", false);
                });
            }
        });

        $("#input-force-all").on("click", function () {
            if (this.checked) {
                $(".input-force").each(function () {
                    if (!$(this).prop('disabled')) {
                        this.checked = true;
                    }
                    $("#input-force-all").prop("checked", true);
                });
            } else {
                $(".input-force").each(function () {
                    if (!$(this).prop('disabled')) {
                        this.checked = false;
                    }
                    $("#input-force-all").prop("checked", false);
                });
            }
        });

        $("#input-ulang-all").on("click", function () {
            if (this.checked) {
                $(".input-ulang").each(function () {
                    if (!$(this).prop('disabled')) {
                        this.checked = true;
                    }
                    $("#input-ulang-all").prop("checked", true);
                });
            } else {
                $(".input-ulang").each(function () {
                    if (!$(this).prop('disabled')) {
                        this.checked = false;
                    }
                    $("#input-ulang-all").prop("checked", false);
                });
            }
        });
    }

    function getDetailJadwal(idJadwal) {
        $.ajax({
            type: "GET",
            url: base_url + "cbtstatus/getjadwalujianbyjadwal?id_jadwal=" + idJadwal,
            cache: false,
            success: function (response) {
                var selKelas = $('#kelas');
                selKelas.html('');
                selKelas.append('<option value="">Pilih Kelas</option>');
                $.each(response, function (k, v) {
                    if (v != null) {
                        selKelas.append('<option value="' + k + '">' + v + '</option>');
                    }
                });
            }
        });
    }

    function getAllJadwal() {
        $.ajax({
            type: "GET",
            url: base_url + "cbtstatus/gettgljadwalujian",
            cache: false,
            success: function (response) {
                setOptionJadwal(response)
            }
        });
    }

    function setOptionJadwal(data) {
        console.log('data', data);
        var opsiTgl = $("#tgl");
        var opsiRuang = $("#ruang");
        var opsiSesi = $("#sesi");
        var opsiKelas = $("#kelas");
        opsiTgl.prop('disabled', false).removeAttr('disabled');
        opsiTgl.html('<option value="">Pilih Tanggal</option>');

        const defaultRuang = (data && data.default_ruang) ? data.default_ruang : {};
        const defaultSesi = (data && data.default_sesi) ? data.default_sesi : {};
        const defaultKelas = (data && data.default_kelas) ? data.default_kelas : {};

        function populateSubSelects(selectedTgl) {
            const prevKelas = opsiKelas.val();
            const prevRuang = opsiRuang.val();
            const prevSesi = opsiSesi.val();

            opsiKelas.html('<option value="">Pilih Kelas</option>');
            opsiRuang.html('<option value="">Pilih Ruang</option>');
            opsiSesi.html('<option value="">Pilih Sesi</option>');

            let existKls = [];
            const tglKelas = (selectedTgl && data && data.kelas && data.kelas[selectedTgl]) ? data.kelas[selectedTgl] : [];
            if (Array.isArray(tglKelas) && tglKelas.length > 0) {
                for (const arrkelas of tglKelas) {
                    if (arrkelas && typeof arrkelas === 'object') {
                        for (const idKls in arrkelas) {
                            if (!existKls.includes(idKls)) {
                                existKls.push(idKls);
                                opsiKelas.append('<option value="' + idKls + '">' + arrkelas[idKls] + '</option>');
                            }
                        }
                    }
                }
            }
            if (existKls.length === 0 && defaultKelas && typeof defaultKelas === 'object') {
                for (const idKls in defaultKelas) {
                    if (!existKls.includes(idKls)) {
                        existKls.push(idKls);
                        opsiKelas.append('<option value="' + idKls + '">' + defaultKelas[idKls] + '</option>');
                    }
                }
            }

            let existRuang = [];
            const allRuang = (selectedTgl && data && data.ruang && data.ruang[selectedTgl]) ? data.ruang[selectedTgl] : {};
            for (const idr in allRuang) {
                if (!existRuang.includes(idr)) {
                    existRuang.push(idr);
                    opsiRuang.append('<option value="' + idr + '">' + allRuang[idr] + '</option>');
                }
            }
            if (existRuang.length === 0 && defaultRuang && typeof defaultRuang === 'object') {
                for (const idr in defaultRuang) {
                    if (!existRuang.includes(idr)) {
                        existRuang.push(idr);
                        opsiRuang.append('<option value="' + idr + '">' + defaultRuang[idr] + '</option>');
                    }
                }
            }

            let existSesi = [];
            const allSesi = (selectedTgl && data && data.sesi && data.sesi[selectedTgl]) ? data.sesi[selectedTgl] : {};
            for (const ids in allSesi) {
                if (!existSesi.includes(ids)) {
                    existSesi.push(ids);
                    opsiSesi.append('<option value="' + ids + '">' + allSesi[ids] + '</option>');
                }
            }
            if (existSesi.length === 0 && defaultSesi && typeof defaultSesi === 'object') {
                for (const ids in defaultSesi) {
                    if (!existSesi.includes(ids)) {
                        existSesi.push(ids);
                        opsiSesi.append('<option value="' + ids + '">' + defaultSesi[ids] + '</option>');
                    }
                }
            }

            if (prevKelas && existKls.includes(String(prevKelas))) opsiKelas.val(prevKelas);
            if (prevRuang && existRuang.includes(String(prevRuang))) opsiRuang.val(prevRuang);
            if (prevSesi && existSesi.includes(String(prevSesi))) opsiSesi.val(prevSesi);
        }

        if (!data || !data.jadwal || Object.keys(data.jadwal).length === 0) {
            opsiTgl.append('<option value="">Belum ada jadwal</option>');
            populateSubSelects('');
            return;
        }

        const tglKeys = Object.keys(data.jadwal);
        for (const id of tglKeys) {
            opsiTgl.append('<option value="' + id + '">' + data.jadwal[id] + '</option>');
        }

        opsiTgl.off('change').on('change', function () {
            const selectedTgl = $(this).val();
            tglJadwal = selectedTgl;
            populateSubSelects(selectedTgl);
            if (selectedTgl) {
                if (printBy === '1' && opsiRuang.val() && opsiSesi.val()) {
                    loadSiswaRuang(opsiRuang.val(), opsiSesi.val(), selectedTgl);
                } else if (printBy === '2' && opsiKelas.val()) {
                    loadSiswaKelas(opsiKelas.val(), selectedTgl);
                }
            }
        });

        opsiKelas.off('change').on('change', function () {
            kelas = $(this).val();
            tglJadwal = opsiTgl.val();
            loadSiswaKelas(kelas, tglJadwal);
        });

        opsiRuang.off('change').on('change', function () {
            sesi = opsiSesi.val();
            ruang = $(this).val();
            tglJadwal = opsiTgl.val();
            loadSiswaRuang(ruang, sesi, tglJadwal);
        });

        opsiSesi.off('change').on('change', function () {
            sesi = $(this).val();
            ruang = opsiRuang.val();
            tglJadwal = opsiTgl.val();
            loadSiswaRuang(ruang, sesi, tglJadwal);
        });

        // Otomatis pilih tanggal hari ini (atau tanggal jadwal terbaru) agar Ruang & Sesi langsung aktif
        const todayIso = '<?= date('Y-m-d') ?>';
        const autoTgl = data.jadwal[todayIso] ? todayIso : (tglKeys.length > 0 ? tglKeys[0] : '');
        if (autoTgl) {
            opsiTgl.val(autoTgl).trigger('change');
        } else {
            populateSubSelects('');
        }
    }

    function loadSiswaRuang(ruang, sesi, tglJadwal) {
        var empty = ruang === '' || sesi === '' || tglJadwal === '';
        if (!empty) {
            url = base_url + "cbtstatus/getstatussiswa?ruang=" + ruang + '&sesi=' + sesi + '&tgl=' + tglJadwal;
            refreshStatus();
        } else {
            console.log('empty')
        }
    }

    function loadSiswaKelas(kelas, tglJadwal) {
        var empty = kelas === '' || tglJadwal === '';
        if (!empty) {
            url = base_url + "cbtstatus/getstatussiswa?kelas=" + kelas + '&tgl=' + tglJadwal;
            refreshStatus();
        } else {
            console.log('empty')
        }
    }

    function kalkulasiWaktu(durasi) {
        if (!durasi || !durasi.mulai) return durasi;

        const mulai = new Date(durasi.mulai).getTime();
        let lamanya = durasi.lama_ujian;

        if (!lamanya || !lamanya.includes(':')) {
            if (!durasi.selesai) return durasi;

            const selesai = new Date(durasi.selesai).getTime();
            if (isNaN(mulai) || isNaN(selesai) || selesai < mulai) return durasi;

            const lama = (selesai - mulai) / 1000;
            const jam = Math.floor(lama / 3600).toString().padStart(2, '0');
            const menit = Math.floor((lama % 3600) / 60).toString().padStart(2, '0');
            const detik = Math.floor(lama % 60).toString().padStart(2, '0');

            lamanya = `${jam}:${menit}:${detik}`;
        }

        const [h, m, s] = lamanya.split(':').map(Number);
        const ej = h ? `${h} jam ` : '';
        const em = m ? `${m} mnt ` : '';
        const ed = s ? `${s} dtk` : '';

        return {
            ...durasi,
            lama_ujian: lamanya,
            durasi: ej + em + ed || '0 dtk'
        };
    }

    var activePantauTimer = null;
    var activePantauJadwal = null;
    var activePantauSiswa = null;

    function bukaPantauKamera(idSiswa, idJadwal, namaSiswa, nomorPeserta) {
        activePantauJadwal = idJadwal;
        activePantauSiswa = idSiswa;

        $('#pantau-nama-siswa').text(namaSiswa || 'Siswa');
        $('#pantau-nomor-siswa').text(nomorPeserta ? ('No. Peserta: ' + nomorPeserta) : 'No. Peserta: -');
        $('#pantau-badge-status').removeClass('bg-success bg-danger').addClass('bg-secondary').text('Menghubungkan...');
        $('#pantau-last-update').text('Meminta izin streaming...');
        $('#pantau-video-frame').hide().attr('src', '');
        $('#pantau-loading-placeholder').show();

        var modalEl = document.getElementById('modalPantauKamera');
        var modalObj = bootstrap.Modal.getOrCreateInstance(modalEl);
        modalObj.show();

        startPollingPantauFrame(idJadwal, idSiswa);

        $.ajax({
            url: base_url + 'cbtstatus/request_pantau',
            type: 'POST',
            data: { id_jadwal: idJadwal, id_siswa: idSiswa },
            dataType: 'json'
        });
    }

    var isFetchingPantau = false;
    function startPollingPantauFrame(idJadwal, idSiswa) {
        if (activePantauTimer) clearInterval(activePantauTimer);
        isFetchingPantau = false;

        function fetchFrame() {
            if (isFetchingPantau || !activePantauJadwal || !activePantauSiswa) return;
            isFetchingPantau = true;

            $.ajax({
                url: base_url + 'cbtstatus/get_pantau_frame',
                type: 'GET',
                cache: false,
                data: { id_jadwal: idJadwal, id_siswa: idSiswa, _t: Date.now() },
                dataType: 'json',
                success: function(res) {
                    if (res && res.frame) {
                        $('#pantau-loading-placeholder').hide();
                        var frameImg = document.getElementById('pantau-video-frame');
                        if (frameImg) {
                            frameImg.src = res.frame;
                            $(frameImg).show();
                        }
                        $('#pantau-badge-status').removeClass('bg-secondary bg-danger').addClass('bg-success').html('<i class="fas fa-circle me-1 text-white"></i> LIVE');
                        $('#pantau-last-update').text('Terhubung • ' + (res.updated_at || 'Baru saja'));
                    } else if (res && (res.stream_status === 'requested' || res.stream_status === 'standby')) {
                        $('#pantau-last-update').text('Menghubungkan ke kamera siswa...');
                    }
                },
                complete: function() {
                    isFetchingPantau = false;
                }
            });
        }

        fetchFrame();
        activePantauTimer = setInterval(fetchFrame, 900);
    }

    function tutupPantauKamera() {
        if (activePantauTimer) {
            clearInterval(activePantauTimer);
            activePantauTimer = null;
        }
        isFetchingPantau = false;
        if (activePantauJadwal && activePantauSiswa) {
            $.ajax({
                url: base_url + 'cbtstatus/stop_pantau',
                type: 'POST',
                data: { id_jadwal: activePantauJadwal, id_siswa: activePantauSiswa }
            });
        }
        activePantauJadwal = null;
        activePantauSiswa = null;
        $('#pantau-video-frame').hide().attr('src', '');
        $('#pantau-loading-placeholder').show();
    }
</script>

<?= $this->include('cbt/token/modal_qr') ?>
<?= $this->endSection() ?>
