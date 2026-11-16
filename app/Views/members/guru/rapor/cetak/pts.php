<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

<div class="d-contents">
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="me-3 flex-shrink-0">
                        <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #ffffff;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="8" r="7"></circle>
                                <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="card-title mb-1 fw-bold d-flex align-items-center text-dark">
                            Cetak Rapor STS (Tengah Semester)
                        </h4>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">Laporan Hasil Belajar Peserta Didik Kelas <?= esc($kelas->nama_kelas ?? '-') ?> - Kurikulum Merdeka</p>
                    </div>
                </div>
                <?php if (($rapor_setting->mode_rapor ?? 'semua') !== 'sts'): ?>
                <div class="d-flex gap-2">
                    <a href="<?= base_url('rapor/cetakakhir') ?>" class="btn btn-outline-success shadow-sm rounded-pill">
                        <i class="fas fa-book-reader me-1"></i> Buka Rapor SAS (Akhir Semester)
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center" role="alert">
        <i class="fas fa-exclamation-triangle me-2 fs-5 text-warning"></i>
        <div><?= session()->getFlashdata('error') ?></div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <div class="row">
        <!-- Panel Siswa (Kiri) -->
        <div class="col-md-3 mb-4 mb-md-0">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-warning text-dark py-3">
                    <h6 class="card-title text-dark mb-0 fw-bold"><i class="fas fa-users me-2"></i>Daftar Siswa (<?= count($siswas) ?>)</h6>
                </div>
                <div class="card-body p-0" style="max-height: 600px; overflow-y: auto;">
                    <div class="list-group list-group-flush" id="list-siswa">
                        <?php foreach ($siswas as $idx => $s): ?>
                            <a href="javascript:void(0)" class="list-group-item list-group-item-action d-flex align-items-center py-2 px-3 siswa-item <?= $idx === 0 ? 'active' : '' ?>" data-id="<?= $s->id_siswa ?>" onclick="selectSiswa(<?= $s->id_siswa ?>)">
                                <span class="badge bg-soft-warning text-dark rounded-pill me-2 fw-bold" style="min-width: 26px;"><?= $idx + 1 ?></span>
                                <span class="fw-medium text-truncate" style="font-size: 0.88rem;"><?= esc($s->nama) ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel Preview & Tombol Cetak (Kanan) -->
        <div class="col-md-9">
            <div class="card shadow-sm border-0">
                <!-- Baris 1: Pilihan Mode Dokumen & Tombol Aksi Cetak -->
                <div class="card-header bg-white py-2 px-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <!-- Toggle Format: Rapor Ringkas, Rapor Lengkap, Rekap Nilai, Sampul, Identitas -->
                        <div class="btn-group btn-group-sm shadow-sm rounded-pill p-1 bg-light border" role="group">
                            <button type="button" class="btn btn-sm btn-primary rounded-pill px-3 fw-bold" id="btn-mode-ringkas" onclick="switchMode('ringkas')">
                                <i class="fas fa-file-alt me-1"></i> Rapor Ringkas / Singkat
                            </button>
                            <button type="button" class="btn btn-sm btn-light rounded-pill px-3 fw-bold" id="btn-mode-lengkap" onclick="switchMode('lengkap')">
                                <i class="fas fa-book me-1"></i> Rapor Lengkap
                            </button>
                            <button type="button" class="btn btn-sm btn-light rounded-pill px-3 fw-bold" id="btn-mode-rekap" onclick="switchMode('rekap')">
                                <i class="fas fa-clipboard-list me-1"></i> Rekap Nilai
                            </button>
                            <button type="button" class="btn btn-sm btn-light rounded-pill px-3 fw-bold" id="btn-mode-sampul" onclick="switchMode('sampul')">
                                <i class="fas fa-book-open me-1"></i> Sampul
                            </button>
                            <button type="button" class="btn btn-sm btn-light rounded-pill px-3 fw-bold" id="btn-mode-identitas" onclick="switchMode('identitas')">
                                <i class="fas fa-id-card me-1"></i> Identitas
                            </button>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-1 flex-wrap">
                        <button class="btn btn-warning btn-sm fw-bold px-3 rounded-pill shadow-sm text-dark" onclick="printCurrentRapor()">
                            <i class="fa fa-print me-1"></i> Cetak Siswa Ini
                        </button>
                        <button class="btn btn-outline-secondary btn-sm fw-bold px-3 rounded-pill" onclick="printAllRapor()">
                            <i class="fa fa-copy me-1"></i> Cetak Semua Siswa
                        </button>
                        <a href="<?= base_url('rapor/cetakleger/' . ($kelas->id_kelas ?? '')) ?>" target="_blank" class="btn btn-outline-success btn-sm fw-bold px-3 rounded-pill shadow-sm" title="Buka & Cetak Legger Nilai">
                            <i class="fa fa-book me-1"></i> Legger
                        </a>
                        <a href="<?= base_url('rapor/cetakranking/' . ($kelas->id_kelas ?? '')) ?>" target="_blank" class="btn btn-warning btn-sm fw-bold px-3 rounded-pill shadow-sm text-dark" title="Buka & Cetak Ranking Nilai">
                            <i class="fas fa-trophy me-1"></i> Ranking
                        </a>
                        <button type="button" class="btn btn-outline-success btn-sm fw-bold px-3 rounded-pill shadow-sm" onclick="downloadLegerExcel()" title="Unduh File Excel Legger Nilai">
                            <i class="fa fa-file-excel me-1"></i> Legger Excel
                        </button>
                    </div>
                </div>
<?php
$schInfo = detectSchoolType($setting ?? null);
$isKemenagSchool = isset($is_kemenag) ? $is_kemenag : $schInfo->is_kemenag;
$schoolType = isset($school_type) ? $school_type : $schInfo->school_type;
$govName = $isKemenagSchool ? 'Kemenag' : 'Kemendikdasmen';
$satName = $isKemenagSchool ? 'Madrasah' : 'Sekolah';
?>
                <!-- Baris 2: Parameter Tampilan Rapor (Format, TTD, Logo & Zoom) -->
                <div class="py-2 px-3 bg-light bg-opacity-75 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <!-- Format Rapor -->
                        <div class="d-inline-flex align-items-center bg-white border rounded-pill px-2 py-1 shadow-sm text-nowrap">
                            <span class="small text-muted fw-bold me-1 text-nowrap" style="font-size: 0.8rem;"><i class="fas fa-file-alt text-secondary me-1"></i>Format:</span>
                            <select id="select-format-rapor" class="form-select form-select-sm border-0 bg-transparent py-0 ps-1 pe-4 fw-bold text-dark text-nowrap" style="width: auto; cursor: pointer; font-size: 0.82rem;" onchange="changeFormatRapor(this.value)">
                                <?php if ($isKemenagSchool): ?>
                                    <option value="kemenag" selected>Model Kemenag (RDM)</option>
                                    <option value="diknas">Model Diknas (Kemendikdasmen)</option>
                                <?php else: ?>
                                    <option value="diknas" selected>Model Diknas (Kemendikdasmen)</option>
                                    <option value="kemenag">Model Kemenag (RDM)</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <!-- TTD Rapor -->
                        <div id="wrap-ttd-rapor" class="d-inline-flex align-items-center bg-white border rounded-pill px-2 py-1 shadow-sm text-nowrap">
                            <span class="small text-muted fw-bold me-1 text-nowrap" style="font-size: 0.8rem;"><i class="fas fa-file-signature text-primary me-1"></i>TTD Rapor:</span>
                            <select id="select-ttd-rapor" class="form-select form-select-sm border-0 bg-transparent py-0 ps-1 pe-4 fw-bold text-dark text-nowrap" style="width: auto; cursor: pointer; font-size: 0.82rem;" onchange="changeTtdRapor(this.value)">
                                <option value="3" <?= ($rapor_setting->ttd_rapor_ringkas ?? '3') == '3' ? 'selected' : '' ?>>3 TTD (+ Orang Tua)</option>
                                <option value="3_tingkat" <?= ($rapor_setting->ttd_rapor_ringkas ?? '3') == '3_tingkat' ? 'selected' : '' ?>>3 TTD (Bertingkat)</option>
                                <option value="2" <?= ($rapor_setting->ttd_rapor_ringkas ?? '3') == '2' ? 'selected' : '' ?>>2 TTD (Kepala &amp; Wali)</option>
                            </select>
                        </div>

                        <!-- Logo Kop -->
                        <div id="wrap-model-kop" class="d-inline-flex align-items-center bg-white border rounded-pill px-2 py-1 shadow-sm text-nowrap">
                            <span class="small text-muted fw-bold me-1 text-nowrap" style="font-size: 0.8rem;"><i class="fas fa-image text-secondary me-1"></i>Logo:</span>
                            <select id="select-model-kop" class="form-select form-select-sm border-0 bg-transparent py-0 ps-1 pe-4 fw-bold text-dark text-nowrap" style="width: auto; cursor: pointer; font-size: 0.82rem;" onchange="changeModelKop(this.value)">
                                <option value="1">1 Logo (<?= $govName ?>)</option>
                                <option value="2">2 Logo (<?= $govName ?> &amp; <?= $satName ?>)</option>
                                <option value="0">Tanpa Logo</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-1">
                        <button class="btn btn-white btn-sm border bg-white shadow-sm" onclick="zoomIn()" title="Perbesar"><i class="fa fa-search-plus"></i></button>
                        <button class="btn btn-white btn-sm border bg-white shadow-sm" onclick="zoomOut()" title="Perkecil"><i class="fa fa-search-minus"></i></button>
                        <button class="btn btn-white btn-sm border bg-white shadow-sm" onclick="zoomReset()" title="Reset Zoom"><i class="fa fa-sync"></i></button>
                    </div>
                </div>
                </div>

                <div class="card-body bg-secondary bg-opacity-10 p-3 overflow-auto text-center" style="min-height: 600px;">
                    <div id="zoom-container" style="display: inline-block; transform-origin: top center; transition: transform 0.2s;">
                        <div id="print-area" class="text-start">
                            <div id="rapor-content">
                                <div class="text-center py-5 text-muted">
                                    <i class="fas fa-spinner fa-spin fa-2x mb-3"></i>
                                    <div>Memuat data nilai siswa...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="all-print-container" style="display:none;" class="text-start"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.rapor-page {
    width: 210mm;
    min-height: 297mm;
    padding: 8mm 15mm 16mm 15mm;
    margin: 0 auto 20px auto;
    background-color: #ffffff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    box-sizing: border-box !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 9.5pt;
    line-height: 1.25;
    color: #000000;
    position: relative;
    background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25'><defs><pattern id='wm' width='240' height='65' patternUnits='userSpaceOnUse' patternTransform='rotate(-38)'><text x='10' y='35' fill='%2343a047' fill-opacity='0.22' font-family='Arial, sans-serif' font-size='13'>* <?= esc($rapor_setting->watermark_teks ?? 'MTs Hidayatul Islamiyah') ?></text></pattern></defs><rect width='100%25' height='100%25' fill='url(%23wm)'/></svg>");
}

.rapor-page,
.rapor-page * {
    box-sizing: border-box !important;
}

.rapor-page.format-diknas {
    background-image: none !important;
}
.rapor-page.format-diknas .watermark-logo-center {
    display: none !important;
}

.rapor-page table,
.rapor-page th,
.rapor-page td,
.rapor-page div,
.rapor-page span,
.rapor-page p {
    font-family: Arial, Helvetica, sans-serif !important;
}

.rapor-page table,
.rapor-page .tbl-nilai,
.rapor-page .tbl-info,
.rapor-page .tbl-header-kop {
    width: 100% !important;
    max-width: 100% !important;
    table-layout: fixed !important;
    box-sizing: border-box !important;
    border-collapse: collapse !important;
}

.rapor-page th,
.rapor-page td,
.tbl-nilai th,
.tbl-nilai td {
    box-sizing: border-box !important;
    white-space: normal !important;
    word-wrap: break-word !important;
    overflow-wrap: break-word !important;
    word-break: normal !important;
}

.rapor-page .watermark-logo-center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 320px;
    height: auto;
    opacity: 0.18;
    pointer-events: none;
    z-index: 0;
}
.rapor-page .watermark-logo-center img {
    width: 100%;
    height: auto;
    display: block;
}

.rapor-page .rapor-content-layer {
    position: relative;
    z-index: 1;
    background: transparent !important;
}

.rapor-page table,
.rapor-page table tr,
.rapor-page table td {
    background: transparent !important;
    background-color: transparent !important;
}

.rapor-page .line-divider {
    border-top: 2.5px solid #000000;
    margin: 4px 0 5px 0;
}

.rapor-page table {
    width: 100%;
    border-collapse: collapse;
}

.rapor-page .tbl-header-kop td {
    padding: 1px 4px;
    font-family: Arial, Helvetica, sans-serif !important;
}

.rapor-page .tbl-info td {
    padding: 1.5px 4px;
    vertical-align: top;
    font-size: 9pt;
    font-family: Arial, Helvetica, sans-serif !important;
    line-height: 1.3;
}

.rapor-page .tbl-nilai, .rapor-page .tbl-nilai th, .rapor-page .tbl-nilai td {
    border: 1px solid #000000;
}

.rapor-page .tbl-nilai th {
    background-color: #f2f2f2;
    text-align: center;
    font-weight: bold;
    padding: 4px 4px;
    font-size: 9.5pt;
}

.rapor-page .tbl-nilai td {
    padding: 2.5px 6px;
    vertical-align: middle;
    font-size: 9.5pt;
}

.rapor-page .text-center,
.rapor-page td.text-center,
.rapor-page th.text-center,
.tbl-nilai td.text-center,
.tbl-nilai th.text-center,
table.tbl-nilai td.text-center,
table.tbl-nilai th.text-center,
.text-center {
    text-align: center !important;
}

.rapor-page .text-right,
.rapor-page .text-end,
.rapor-page td.text-right,
.rapor-page td.text-end,
.tbl-nilai td.text-right,
.tbl-nilai td.text-end,
.text-right,
.text-end {
    text-align: right !important;
}

.rapor-page .text-left,
.rapor-page .text-start,
.rapor-page td.text-left,
.rapor-page td.text-start,
.tbl-nilai td.text-left,
.tbl-nilai td.text-start,
.text-left,
.text-start {
    text-align: left !important;
}

.rapor-page .text-justify,
.rapor-page td.text-justify,
.text-justify {
    text-align: justify !important;
}

.rapor-page .fw-bold,
.tbl-nilai .fw-bold,
.fw-bold {
    font-weight: bold !important;
}

.rapor-footer-bottom {
    position: absolute;
    bottom: 5mm;
    left: 15mm;
    right: 15mm;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 8pt;
    color: #666;
    line-height: 1;
    pointer-events: none;
    z-index: 10;
}

.page-break {
    page-break-after: always;
    break-after: page;
}

@media print {
    @page {
        size: A4 portrait;
        margin: 0;
    }
    body, html {
        width: 210mm !important;
        min-width: 210mm !important;
        margin: 0 auto !important;
        padding: 0 !important;
        background: #fff !important;
        font-family: Arial, Helvetica, sans-serif !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    .d-contents, .sidebar, .navbar, .card-header, .no-print, button {
        display: none !important;
    }
    #zoom-container {
        transform: none !important;
    }
    .rapor-page {
        box-shadow: none !important;
        margin: 0 auto !important;
        width: 210mm !important;
        max-width: 210mm !important;
        min-width: 210mm !important;
        height: 296mm !important;
        max-height: 296.5mm !important;
        min-height: 285mm !important;
        padding: 7mm 15mm 12mm 15mm !important;
        box-sizing: border-box !important;
        page-break-after: always !important;
        break-after: page !important;
        page-break-inside: avoid !important;
        break-inside: avoid !important;
        position: relative !important;
        overflow: hidden !important;
        background-color: #ffffff !important;
        font-family: Arial, Helvetica, sans-serif !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    .rapor-page:last-child {
        page-break-after: auto !important;
        break-after: auto !important;
    }
    .rapor-footer-bottom {
        bottom: 3.5mm !important;
        left: 15mm !important;
        right: 15mm !important;
    }
    .rapor-page * {
        box-sizing: border-box !important;
    }
    .rapor-page table,
    .rapor-page .tbl-nilai,
    .rapor-page .tbl-info,
    .rapor-page .tbl-header-kop {
        width: 100% !important;
        max-width: 100% !important;
        table-layout: fixed !important;
        border-collapse: collapse !important;
        box-sizing: border-box !important;
        font-family: Arial, Helvetica, sans-serif !important;
    }
    .rapor-page th,
    .rapor-page td,
    .tbl-nilai th,
    .tbl-nilai td {
        box-sizing: border-box !important;
        white-space: normal !important;
        word-wrap: break-word !important;
        overflow-wrap: break-word !important;
        word-break: normal !important;
        font-family: Arial, Helvetica, sans-serif !important;
    }
    .rapor-page .text-center,
    .rapor-page td.text-center,
    .rapor-page th.text-center,
    .tbl-nilai td.text-center,
    .tbl-nilai th.text-center,
    table.tbl-nilai td.text-center,
    table.tbl-nilai th.text-center,
    .text-center {
        text-align: center !important;
    }
    .rapor-page .text-right,
    .rapor-page .text-end,
    .rapor-page td.text-right,
    .rapor-page td.text-end,
    .tbl-nilai td.text-right,
    .tbl-nilai td.text-end,
    .text-right,
    .text-end {
        text-align: right !important;
    }
    .rapor-page .text-left,
    .rapor-page .text-start,
    .rapor-page td.text-left,
    .rapor-page td.text-start,
    .tbl-nilai td.text-left,
    .tbl-nilai td.text-start,
    .text-left,
    .text-start {
        text-align: left !important;
    }
    .rapor-page .text-justify,
    .rapor-page td.text-justify,
    .text-justify {
        text-align: justify !important;
    }
    .rapor-page .fw-bold,
    .tbl-nilai .fw-bold,
    .fw-bold {
        font-weight: bold !important;
    }
    .rapor-page.format-diknas {
        background-image: none !important;
    }
    .rapor-page.format-diknas .watermark-logo-center {
        display: none !important;
    }
    .rapor-page.rapor-page-landscape {
        width: 297mm !important;
        max-width: 297mm !important;
        min-width: 297mm !important;
        min-height: 205mm !important;
        padding: 8mm 12mm 10mm 12mm !important;
    }
    .rapor-page.rapor-page-landscape .rapor-footer-bottom {
        left: 12mm !important;
        right: 12mm !important;
        bottom: 5mm !important;
    }
    .rapor-page.rapor-page-sampul {
        padding: 5mm 8mm !important;
        height: 275mm !important;
        max-height: 275mm !important;
        min-height: auto !important;
        overflow: hidden !important;
        page-break-after: always !important;
        break-after: page !important;
        page-break-inside: avoid !important;
        break-inside: avoid !important;
    }
    .rapor-footer-bottom {
        position: absolute !important;
        bottom: 5mm !important;
        left: 15mm !important;
        right: 15mm !important;
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        font-size: 8pt !important;
        color: #555 !important;
        line-height: 1 !important;
        z-index: 10 !important;
    }
}
.rapor-page.rapor-page-landscape {
    width: 297mm !important;
    max-width: 297mm !important;
    min-height: 205mm !important;
    padding: 8mm 12mm 10mm 12mm !important;
}
.rapor-page.rapor-page-landscape .rapor-footer-bottom {
    left: 12mm !important;
    right: 12mm !important;
    bottom: 5mm !important;
}
.rapor-page-sampul {
    padding: 6mm 10mm !important;
    min-height: 285mm !important;
    overflow: hidden !important;
}
</style>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/app/js/cetak-area.js') ?>?v=<?= time() ?>"></script>
<script>
    var currentSiswaId = <?= !empty($siswas[0]->id_siswa) ? $siswas[0]->id_siswa : 0 ?>;
    var idKelas = <?= !empty($kelas->id_kelas) ? $kelas->id_kelas : 0 ?>;
    var schoolType = '<?= $schoolType ?>';
    var isKemenagSchool = <?= $isKemenagSchool ? 'true' : 'false' ?>;
    var currentFormatRapor = schoolType;
    var currentTtdMode = '<?= esc($rapor_setting->ttd_rapor_ringkas ?? '3') ?>';
    var currentZoom = 1;
    var currentMode = 'ringkas'; // 'ringkas' atau 'lengkap'
    var cachedSiswaData = {};
    var allSiswaList = <?= json_encode(array_map(function($s) { return ['id_siswa' => $s->id_siswa, 'nama' => $s->nama]; }, $siswas)) ?>;

    $(document).ready(function () {
        ajaxcsrf();

        if ($('#select-format-rapor').length) {
            $('#select-format-rapor').val(currentFormatRapor);
            $('#wrap-model-kop').show();
        }
        var savedTtd = localStorage.getItem('rapor_ttd_ringkas');
        if (savedTtd !== null && $('#select-ttd-rapor').length) {
            $('#select-ttd-rapor').val(savedTtd);
            currentTtdMode = savedTtd;
        } else if ($('#select-ttd-rapor').length) {
            $('#select-ttd-rapor').val(currentTtdMode);
        }
        if (currentSiswaId > 0) {
            loadRaporSiswa(currentSiswaId);
        }
    });

    function changeTtdRapor(val) {
        currentTtdMode = val;
        localStorage.setItem('rapor_ttd_ringkas', val);
        if (cachedSiswaData[currentSiswaId]) {
            renderCurrentRapor(cachedSiswaData[currentSiswaId]);
        }
    }

    function switchMode(mode) {
        currentMode = mode;
        $('#btn-mode-ringkas, #btn-mode-lengkap, #btn-mode-rekap, #btn-mode-sampul, #btn-mode-identitas').removeClass('btn-primary').addClass('btn-light');
        $('#btn-mode-' + mode).removeClass('btn-light').addClass('btn-primary');

        if (mode === 'ringkas') {
            $('#wrap-ttd-rapor').css('display', 'inline-flex');
        } else {
            $('#wrap-ttd-rapor').css('display', 'none');
        }

        if (cachedSiswaData[currentSiswaId]) {
            renderCurrentRapor(cachedSiswaData[currentSiswaId]);
        } else if (currentSiswaId > 0) {
            loadRaporSiswa(currentSiswaId);
        }
    }

    function selectSiswa(sId) {
        currentSiswaId = sId;
        $('.siswa-item').removeClass('active');
        $('.siswa-item[data-id="' + sId + '"]').addClass('active');
        loadRaporSiswa(sId);
    }

    function loadRaporSiswa(sId) {
        if (cachedSiswaData[sId]) {
            renderCurrentRapor(cachedSiswaData[sId]);
            return;
        }

        $('#rapor-content').html('<div class="text-center py-5 text-muted"><i class="fas fa-spinner fa-spin fa-2x mb-3"></i><div>Memuat rapor nilai siswa...</div></div>');

        $.ajax({
            url: '<?= base_url('rapor/getraporsiswalengkap') ?>/' + sId + '/' + idKelas,
            type: 'GET',
            dataType: 'json',
            success: function (res) {
                if (res.status) {
                    cachedSiswaData[sId] = res.data;
                    if (res.data && res.data.setting) {
                        var savedKop = localStorage.getItem('rapor_model_kop');
                        if (savedKop !== null) {
                            $('#select-model-kop').val(savedKop);
                        } else if (res.data.setting.model_kop !== undefined) {
                            $('#select-model-kop').val(res.data.setting.model_kop);
                        }
                        var savedTtd = localStorage.getItem('rapor_ttd_ringkas');
                        if (savedTtd !== null) {
                            $('#select-ttd-rapor').val(savedTtd);
                            currentTtdMode = savedTtd;
                        } else if (res.data.setting.ttd_rapor_ringkas !== undefined) {
                            $('#select-ttd-rapor').val(res.data.setting.ttd_rapor_ringkas);
                            currentTtdMode = res.data.setting.ttd_rapor_ringkas;
                        }
                    }
                    renderCurrentRapor(res.data);
                } else {
                    $('#rapor-content').html('<div class="alert alert-danger m-4">Gagal memuat data rapor: ' + (res.message || '-') + '</div>');
                }
            },
            error: function () {
                $('#rapor-content').html('<div class="alert alert-danger m-4">Terjadi kesalahan sistem saat memuat rapor.</div>');
            }
        });
    }

    function getSemesterLabel(smt) {
        var s = String(smt || '1').toLowerCase();
        if (s === '1' || s.indexOf('ganjil') >= 0 || s.indexOf('satu') >= 0) {
            return 'I (SATU)';
        }
        return 'II (DUA)';
    }

    function isDiknasFormat(d) {
        if (typeof currentFormatRapor !== 'undefined' && currentFormatRapor === 'diknas') return true;
        if (typeof currentFormat !== 'undefined' && currentFormat === 'diknas') return true;
        if (typeof isKemenagSchool !== 'undefined' && isKemenagSchool === false) return true;
        if (typeof schoolType !== 'undefined' && schoolType === 'diknas') return true;
        if (d) {
            if (d.school_type === 'diknas') return true;
            if (d.is_kemenag === false) return true;
            var sekNama = (d.sekolah && d.sekolah.sekolah ? d.sekolah.sekolah : '').toLowerCase();
            if (/\b(sd|sdn|smp|smpn|sma|sman|smk|smkn|sekolah dasar)\b/i.test(sekNama)) return true;
        }
        return false;
    }

    function getJabatanKepsek(d, isDiknas) {
        if (isDiknas === true) return 'Kepala Sekolah';
        if (isDiknasFormat(d)) return 'Kepala Sekolah';
        var sekNama = '';
        if (d && d.sekolah && d.sekolah.sekolah) {
            sekNama = String(d.sekolah.sekolah).toLowerCase();
        } else if (typeof setting !== 'undefined' && setting && setting.sekolah) {
            sekNama = String(setting.sekolah).toLowerCase();
        }
        if (/\b(sd|sdn|smp|smpn|sma|sman|smk|smkn|sekolah dasar)\b/i.test(sekNama)) {
            return 'Kepala Sekolah';
        }
        if (/\b(mi|mis|min|mts|mtss|mtsn|ma|mas|man|mak|madrasah)\b/i.test(sekNama)) {
            return 'Kepala Madrasah';
        }
        if (typeof isKemenagSchool !== 'undefined' && !isKemenagSchool) {
            return 'Kepala Sekolah';
        }
        return 'Kepala Madrasah';
    }

    function renderCurrentRapor(d) {
        try {
            if (currentMode === 'sampul') {
                renderSampulHtml(d);
            } else if (currentMode === 'identitas') {
                renderIdentitasHtml(d);
            } else if (currentMode === 'rekap') {
                renderRekapHtml(d);
            } else if (currentMode === 'lengkap') {
                renderRaporLengkapHtml(d);
            } else {
                renderRaporRingkasHtml(d);
            }
        } catch (e) {
            console.error('Error rendering rapor:', e);
            $('#rapor-content').html('<div class="alert alert-danger m-4">Terjadi kesalahan saat memuat tampilan dokumen: ' + (e.message || e) + '</div>');
        }
    }

    function changeFormatRapor(val) {
        currentFormatRapor = val;
        localStorage.setItem('cbt_format_rapor', val);
        if (val === 'diknas') {
            $('#wrap-model-kop').hide();
        } else {
            $('#wrap-model-kop').show();
        }
        if (cachedSiswaData[currentSiswaId]) {
            renderCurrentRapor(cachedSiswaData[currentSiswaId]);
        }
    }

    function changeModelKop(val) {
        localStorage.setItem('rapor_model_kop', val);
        if (cachedSiswaData[currentSiswaId]) {
            renderCurrentRapor(cachedSiswaData[currentSiswaId]);
        }
    }

    function generateKopHtml(d) {
        var sek = d.sekolah || {};
        var set = d.setting || {};
        var isDiknas = (currentFormatRapor === 'diknas' || schoolType === 'diknas');
        var logoGovUrl = isDiknas ? '<?= base_url('assets/img/tutwuri.png') ?>' : '<?= base_url('assets/img/kemenag_logo_kop.jpg') ?>';
        var govTitle = isDiknas ? 'KEMENTERIAN PENDIDIKAN DASAR DAN MENENGAH' : 'KEMENTERIAN AGAMA REPUBLIK INDONESIA';

        // Logo Lembaga / Madrasah / Sekolah
        var logoMadrasahUrl = '';
        if (sek.logo_kiri && sek.logo_kiri.trim() !== '' && sek.logo_kiri.toLowerCase().indexOf('kemenag') === -1 && sek.logo_kiri.toLowerCase().indexOf('tutwuri') === -1) {
            logoMadrasahUrl = (sek.logo_kiri.indexOf('http') === 0) ? sek.logo_kiri : ('<?= base_url() ?>/' + sek.logo_kiri.replace(/^\/+/, ''));
        } else if (sek.logo_kanan && sek.logo_kanan.trim() !== '' && sek.logo_kanan.toLowerCase().indexOf('kemenag') === -1 && sek.logo_kanan.toLowerCase().indexOf('tutwuri') === -1) {
            logoMadrasahUrl = (sek.logo_kanan.indexOf('http') === 0) ? sek.logo_kanan : ('<?= base_url() ?>/' + sek.logo_kanan.replace(/^\/+/, ''));
        } else if (sek.logo_kiri && sek.logo_kiri.trim() !== '') {
            logoMadrasahUrl = (sek.logo_kiri.indexOf('http') === 0) ? sek.logo_kiri : ('<?= base_url() ?>/' + sek.logo_kiri.replace(/^\/+/, ''));
        }

        var kec = sek.kecamatan ? (sek.kecamatan.toLowerCase().indexOf('kec') >= 0 ? sek.kecamatan : ('Kecamatan ' + sek.kecamatan)) : 'Kecamatan Plumpang';
        var kab = sek.kota ? (sek.kota.toLowerCase().indexOf('kab') >= 0 || sek.kota.toLowerCase().indexOf('kota') >= 0 ? sek.kota : ('Kabupaten ' + sek.kota)) : 'Kabupaten Tuban';
        var prov = sek.provinsi ? (' - ' + sek.provinsi) : ' - Jawa Timur';
        var barisKecKab = kec + ', ' + kab + prov;
        var barisDesa = (sek.desa || 'SUMBERAGUNG').toUpperCase();

        var selectedModelKop = $('#select-model-kop').length ? parseInt($('#select-model-kop').val()) : null;
        var modelKop = (selectedModelKop !== null && !isNaN(selectedModelKop)) ? selectedModelKop : (set.model_kop !== undefined && set.model_kop !== null ? parseInt(set.model_kop) : 1);

        if (modelKop === 2) {
            // 2 Logo: Kiri Kementerian, Kanan Lembaga
            var rightLogoHtml = logoMadrasahUrl ? '<img src="' + logoMadrasahUrl + '" style="max-width: 80px; max-height: 80px; height: auto;">' : '';
            return '<table class="tbl-header-kop mb-1" style="width: 100%; border-collapse: collapse; font-family: Arial, Helvetica, sans-serif;">' +
                '<tr>' +
                '<td style="width: 15%; text-align: center; vertical-align: middle;"><img src="' + logoGovUrl + '" style="max-width: 80px; max-height: 80px; height: auto;"></td>' +
                '<td style="width: 70%; text-align: center; vertical-align: middle;">' +
                '<div style="font-family: Arial, Helvetica, sans-serif; font-size: 12pt; font-weight: bold; letter-spacing: 0.5px; text-transform: uppercase;">' + govTitle + '</div>' +
                '<div style="font-family: Arial, Helvetica, sans-serif; font-size: 14pt; font-weight: bold; letter-spacing: 0.5px; margin-top: 2px; text-transform: uppercase;">' + (sek.sekolah || 'MTSS HIDAYATUL ISLAMIYAH') + '</div>' +
                '<div style="font-family: Arial, Helvetica, sans-serif; font-size: 11pt; font-weight: bold; font-style: italic; margin-top: 1px; text-transform: uppercase;">' + barisDesa + '</div>' +
                '<div style="font-family: Arial, Helvetica, sans-serif; font-size: 9.5pt; font-style: italic; margin-top: 1px;">' + barisKecKab + '</div>' +
                '</td>' +
                '<td style="width: 15%; text-align: center; vertical-align: middle;">' + rightLogoHtml + '</td>' +
                '</tr></table>';
        } else if (modelKop === 0) {
            // Tanpa Logo
            return '<table class="tbl-header-kop mb-1" style="width: 100%; border-collapse: collapse; font-family: Arial, Helvetica, sans-serif;">' +
                '<tr>' +
                '<td style="width: 100%; text-align: center; vertical-align: middle;">' +
                '<div style="font-family: Arial, Helvetica, sans-serif; font-size: 12pt; font-weight: bold; letter-spacing: 0.5px; text-transform: uppercase;">' + govTitle + '</div>' +
                '<div style="font-family: Arial, Helvetica, sans-serif; font-size: 14pt; font-weight: bold; letter-spacing: 0.5px; margin-top: 2px; text-transform: uppercase;">' + (sek.sekolah || 'MTSS HIDAYATUL ISLAMIYAH') + '</div>' +
                '<div style="font-family: Arial, Helvetica, sans-serif; font-size: 11pt; font-weight: bold; font-style: italic; margin-top: 1px; text-transform: uppercase;">' + barisDesa + '</div>' +
                '<div style="font-family: Arial, Helvetica, sans-serif; font-size: 9.5pt; font-style: italic; margin-top: 1px;">' + barisKecKab + '</div>' +
                '</td></tr></table>';
        } else {
            // 1 Logo: Kiri Kementerian Saja
            return '<table class="tbl-header-kop mb-1" style="width: 100%; border-collapse: collapse; font-family: Arial, Helvetica, sans-serif;">' +
                '<tr>' +
                '<td style="width: 15%; text-align: center; vertical-align: middle;"><img src="' + logoGovUrl + '" style="max-width: 80px; max-height: 80px; height: auto;"></td>' +
                '<td style="width: 70%; text-align: center; vertical-align: middle;">' +
                '<div style="font-family: Arial, Helvetica, sans-serif; font-size: 12pt; font-weight: bold; letter-spacing: 0.5px; text-transform: uppercase;">' + govTitle + '</div>' +
                '<div style="font-family: Arial, Helvetica, sans-serif; font-size: 14pt; font-weight: bold; letter-spacing: 0.5px; margin-top: 2px; text-transform: uppercase;">' + (sek.sekolah || 'MTSS HIDAYATUL ISLAMIYAH') + '</div>' +
                '<div style="font-family: Arial, Helvetica, sans-serif; font-size: 11pt; font-weight: bold; font-style: italic; margin-top: 1px; text-transform: uppercase;">' + barisDesa + '</div>' +
                '<div style="font-family: Arial, Helvetica, sans-serif; font-size: 9.5pt; font-style: italic; margin-top: 1px;">' + barisKecKab + '</div>' +
                '</td>' +
                '<td style="width: 15%; text-align: center; vertical-align: middle;"></td>' +
                '</tr></table>';
        }
    }

    function filterMapelByAgamaSiswa(nilaiList, siswaAgama) {
        if (!nilaiList || !nilaiList.length) return [];
        var agm = (siswaAgama || 'islam').toLowerCase().trim();
        var allAgamas = ['islam', 'kristen', 'protestan', 'katolik', 'hindu', 'buddha', 'budha', 'khonghucu', 'konghucu'];
        
        return nilaiList.filter(function(n) {
            var nama = (n.nama_mapel || '').toLowerCase();
            var isMapelAgama = (nama.indexOf('agama') >= 0 || nama.indexOf('pabp') >= 0 || nama.indexOf('pai') >= 0 || nama.indexOf('pak') >= 0);
            if (!isMapelAgama) return true;
            
            for (var i = 0; i < allAgamas.length; i++) {
                var otherAgm = allAgamas[i];
                if (nama.indexOf(otherAgm) >= 0) {
                    var isMatch = (agm.indexOf(otherAgm) >= 0 || (otherAgm === 'protestan' && agm.indexOf('kristen') >= 0) || (otherAgm === 'kristen' && agm.indexOf('protestan') >= 0));
                    if (isMatch) return true;
                    return false;
                }
            }
            return true;
        });
    }

    function groupNilaiMapel(nilaiList, siswaAgama) {
        nilaiList = filterMapelByAgamaSiswa(nilaiList, siswaAgama);
        var paiItems = [];
        var umumItems = [];
        var mulokItems = [];

        nilaiList.forEach(function (n) {
            var nama = (n.nama_mapel || '').toLowerCase();
            if (nama.indexOf("qur'an") >= 0 || nama.indexOf("quran") >= 0 ||
                (nama.indexOf("akidah") >= 0 && nama.indexOf("akhlak") >= 0) ||
                (nama.indexOf("fikih") >= 0 && nama.indexOf("peminatan") === -1 && nama.indexOf("ushul") === -1) ||
                (nama.indexOf("fiqih") >= 0 && nama.indexOf("peminatan") === -1 && nama.indexOf("ushul") === -1) ||
                nama.indexOf("sejarah kebudayaan") >= 0 || nama.indexOf("ski") >= 0) {
                paiItems.push(n);
            } else if (nama.indexOf("jawa") >= 0 || nama.indexOf("sunda") >= 0 || nama.indexOf("aswaja") >= 0 || nama.indexOf("aqidatul") >= 0 || (n.kategori && n.kategori.toLowerCase() === 'mulok') || (n.kelompok && n.kelompok.toLowerCase() === 'mulok')) {
                mulokItems.push(n);
            } else {
                umumItems.push(n);
            }
        });
        return { pai: paiItems, umum: umumItems, mulok: mulokItems };
    }

    function groupNilaiMapelDiknas(nilaiList, siswaAgama) {
        nilaiList = filterMapelByAgamaSiswa(nilaiList, siswaAgama);
        var umumItems = [];
        var pilihanItems = [];
        var mulokItems = [];

        nilaiList.forEach(function (n) {
            var nama = (n.nama_mapel || '').toLowerCase();
            var kel = (n.kelompok || '').toLowerCase();
            var kat = (n.kategori || '').toLowerCase();

            // Pilihan: Seni Tari, Seni Rupa, Seni Musik, Seni Teater, Seni Budaya, Prakarya, atau kategori 'pilihan'
            if (nama.indexOf('seni') >= 0 || nama.indexOf('prakarya') >= 0 || kel.indexOf('pilihan') >= 0 || kat.indexOf('pilihan') >= 0 || kel.indexOf('pil') >= 0 || kat.indexOf('pil') >= 0) {
                pilihanItems.push(n);
            }
            // Mulok: Bahasa Daerah (Jawa, Sunda, Madura, Bali, Daerah), Aswaja, Aqidatul Awam, atau kelompok/kategori 'mulok'
            else if (nama.indexOf('jawa') >= 0 || nama.indexOf('sunda') >= 0 || nama.indexOf('madura') >= 0 || nama.indexOf('daerah') >= 0 || nama.indexOf('aswaja') >= 0 || nama.indexOf('aqidatul') >= 0 || kel.indexOf('mulok') >= 0 || kat.indexOf('mulok') >= 0) {
                mulokItems.push(n);
            }
            // Umum: Mapel umum kurikulum (PAI/Pendidikan Agama & Budi Pekerti, Pancasila, Bahasa Indonesia, MTK, IPA, IPS, PJOK, B. Inggris, Informatika, dll.)
            else {
                umumItems.push(n);
            }
        });
        return { umum: umumItems, pilihan: pilihanItems, mulok: mulokItems };
    }

    function formatCapaianDiknas(str) {
        if (!str || str.trim() === '' || str === '-') return '-';
        var s = str;
        s = s.replace(/Menunjukkan penguasaan yang sangat baik dalam/gi, 'Mencapai Kompetensi dengan sangat baik dalam hal');
        s = s.replace(/Menunjukkan penguasaan yang baik dalam/gi, 'Mencapai Kompetensi dengan baik dalam hal');
        s = s.replace(/Menunjukkan penguasaan yang cukup baik dalam/gi, 'Mencapai Kompetensi dengan cukup baik dalam hal');
        s = s.replace(/Perlu bimbingan dalam/gi, 'Perlu peningkatan dalam hal');
        s = s.replace(/Perlu pendampingan dalam/gi, 'Perlu peningkatan dalam hal');
        s = s.replace(/Perlu penguatan dalam/gi, 'Perlu peningkatan dalam hal');

        var lines = s.split('\n').filter(function (l) { return l.trim() !== ''; });
        if (lines.length > 1) {
            return lines.map(function (l) { return '<div style="margin-bottom: 4px; line-height: 1.35; white-space: normal !important; word-wrap: break-word !important; overflow-wrap: break-word !important; word-break: normal !important; text-align: justify;">' + l.trim() + '</div>'; }).join('');
        }
        return '<div style="line-height: 1.35; white-space: normal !important; word-wrap: break-word !important; overflow-wrap: break-word !important; word-break: normal !important; text-align: justify;">' + s + '</div>';
    }

    function getFormatNipWali(w, set, fallbackNama) {
        if (set && set.nip_walikelas == 2) return '';
        var nama = (w && w.nama_guru ? w.nama_guru : (fallbackNama || '')).toLowerCase();
        var label = 'NIP';
        if (nama.indexOf('asrofiq') >= 0) {
            label = 'NIP';
        } else if (w && w.jenis_nip && String(w.jenis_nip).trim() !== '') {
            label = String(w.jenis_nip).trim().toUpperCase();
        } else if (w && w.nip && String(w.nip).trim() !== '' && String(w.nip).trim() !== '-') {
            label = 'NIP';
        } else if (set && set.nip_walikelas == 1) {
            label = 'NPK';
        } else {
            label = 'NIP';
        }

        var num = '-';
        if (w && w.nip && String(w.nip).trim() !== '' && String(w.nip).trim() !== '-') {
            num = String(w.nip).trim();
        } else if (w && w.nuptk && String(w.nuptk).trim() !== '' && String(w.nuptk).trim() !== '-') {
            num = String(w.nuptk).trim();
        } else if (w && w.npk && String(w.npk).trim() !== '' && String(w.npk).trim() !== '-') {
            num = String(w.npk).trim();
        } else if (nama.indexOf('asrofiq') >= 0) {
            num = '3953754657200012';
        }

        return label + '. ' + num;
    }

    function getFormatNipKepsek(sek, set) {
        if (set && set.nip_kepsek == 2) return '';
        var nama = (sek && sek.kepsek ? sek.kepsek : '').toLowerCase();
        var label = 'NIP';
        if (sek && sek.label_nip && sek.label_nip !== '') {
            label = sek.label_nip.toUpperCase();
        } else if (set && set.nip_kepsek == 1) {
            label = 'NPK';
        } else {
            label = 'NIP';
        }
        var num = (sek && sek.nip && sek.nip !== '') ? sek.nip : ((sek && sek.nuptk && sek.nuptk !== '') ? sek.nuptk : (sek && sek.npk ? sek.npk : '-'));
        return label + '. ' + num;
    }

    function getFormatFase(k, set) {
        var lvl = 0;
        if (k && k.level_id) {
            lvl = parseInt(k.level_id);
        } else if (k && k.nama_kelas) {
            var match = k.nama_kelas.match(/\d+/);
            if (match) {
                lvl = parseInt(match[0]);
            } else if (/^(XII|12)/i.test(k.nama_kelas)) lvl = 12;
            else if (/^(XI|11)/i.test(k.nama_kelas)) lvl = 11;
            else if (/^(X|10)/i.test(k.nama_kelas)) lvl = 10;
            else if (/^(IX|9)/i.test(k.nama_kelas)) lvl = 9;
            else if (/^(VIII|8)/i.test(k.nama_kelas)) lvl = 8;
            else if (/^(VII|7)/i.test(k.nama_kelas)) lvl = 7;
            else if (/^(VI|6)/i.test(k.nama_kelas)) lvl = 6;
            else if (/^(V|5)/i.test(k.nama_kelas)) lvl = 5;
            else if (/^(IV|4)/i.test(k.nama_kelas)) lvl = 4;
            else if (/^(III|3)/i.test(k.nama_kelas)) lvl = 3;
            else if (/^(II|2)/i.test(k.nama_kelas)) lvl = 2;
            else if (/^(I|1)/i.test(k.nama_kelas)) lvl = 1;
        }

        if (lvl === 1 || lvl === 2) return 'A';
        if (lvl === 3 || lvl === 4) return 'B';
        if (lvl === 5 || lvl === 6) return 'C';
        if (lvl >= 7 && lvl <= 9) return 'D';
        if (lvl === 10) return 'E';
        if (lvl === 11 || lvl === 12) return 'F';

        return (set && set.fase) ? set.fase : 'D';
    }

    function generateTtdRingkasHtml(d, isDiknas, isPts) {
        var set = d.setting || {};
        var sek = d.sekolah || {};
        var w = d.wali || {};
        var tempat = set.tempat || 'Sumberagung';
        var tglRapor = isPts ? (set.tanggal_pts ? formatDateIndo(set.tanggal_pts) : (set.tanggal_rapor ? formatDateIndo(set.tanggal_rapor) : '20 Desember 2025'))
                             : (set.tanggal_rapor ? formatDateIndo(set.tanggal_rapor) : (set.tanggal_pts ? formatDateIndo(set.tanggal_pts) : '20 Desember 2025'));
        var namaWali = w.nama_guru || 'H. ASROFIQ, S. Pd.';
        var nipWali = getFormatNipWali(w, set, namaWali);
        var namaKepsek = sek.kepsek || 'ABD. ROZAK, S.Pd.I.';
        var nipKepsek = getFormatNipKepsek(sek, set);
        var jabatanKepsek = getJabatanKepsek(d, isDiknas);

        var selectedTtd = $('#select-ttd-rapor').length ? $('#select-ttd-rapor').val() : null;
        var ttdMode = selectedTtd || currentTtdMode || (set.ttd_rapor_ringkas || '3');

        if (ttdMode === '2') {
            return '<table style="width: 100%; font-size: 10pt; margin-top: 38px;">' +
                '<tr>' +
                '<td style="width: 45%; text-align: left; vertical-align: top; padding-left: 15px;">' +
                'Mengetahui<br>' + jabatanKepsek +
                '<div style="height: 60px;"></div>' +
                '<b><u>' + namaKepsek + '</u></b><br>' +
                nipKepsek +
                '</td>' +
                '<td style="width: 10%;"></td>' +
                '<td style="width: 45%; text-align: left; vertical-align: top; padding-left: 15px;">' +
                tempat + ', ' + tglRapor + '<br>' +
                'Wali Kelas' +
                '<div style="height: 60px;"></div>' +
                '<b><u>' + namaWali + '</u></b><br>' +
                nipWali +
                '</td>' +
                '</tr>' +
                '</table>';
        } else if (ttdMode === '3_tingkat') {
            return '<table style="width: 100%; font-size: 9.5pt; margin-top: 38px; border-collapse: collapse;">' +
                '<tr>' +
                '<td style="width: 50%; vertical-align: top; text-align: left; padding-left: 15px;">' +
                '<div style="display: inline-block; text-align: left; min-width: 200px;">' +
                '<div style="visibility: hidden;">&nbsp;</div>' +
                '<div>Orang Tua / Wali Murid</div>' +
                '<div style="height: 60px;"></div>' +
                '<div>( .................................... )</div>' +
                '</div>' +
                '</td>' +
                '<td style="width: 50%; vertical-align: top; text-align: right; padding-right: 15px;">' +
                '<div style="display: inline-block; text-align: left; min-width: 200px;">' +
                '<div>' + tempat + ', ' + tglRapor + '</div>' +
                '<div>Wali Kelas</div>' +
                '<div style="height: 60px;"></div>' +
                '<div><b><u>' + namaWali + '</u></b></div>' +
                '<div>' + nipWali + '</div>' +
                '</div>' +
                '</td>' +
                '</tr>' +
                '<tr>' +
                '<td colspan="2" style="text-align: center; padding-top: 20px; vertical-align: top;">' +
                '<div style="display: inline-block; text-align: center; min-width: 220px;">' +
                '<div>Mengetahui,</div>' +
                '<div>' + jabatanKepsek + '</div>' +
                '<div style="height: 60px;"></div>' +
                '<div><b><u>' + namaKepsek + '</u></b></div>' +
                '<div>' + nipKepsek + '</div>' +
                '</div>' +
                '</td>' +
                '</tr></table>';
        } else {
            // Default: 3 TTD Sejajar (Orang Tua / Wali Murid, Kepala Madrasah/Sekolah, Wali Kelas)
            return '<table style="width: 100%; font-size: 9.5pt; margin-top: 38px; border-collapse: collapse;">' +
                '<tr>' +
                '<td style="width: 33.3%; text-align: center; vertical-align: top; padding: 0 4px;">' +
                '<div style="visibility: hidden;">&nbsp;</div>' +
                '<div>Mengetahui,</div>' +
                '<div>Orang Tua / Wali Murid</div>' +
                '<div style="height: 60px;"></div>' +
                '<div>( .................................... )</div>' +
                '<div style="visibility: hidden;">&nbsp;</div>' +
                '</td>' +
                '<td style="width: 33.4%; text-align: center; vertical-align: top; padding: 0 4px;">' +
                '<div style="visibility: hidden;">&nbsp;</div>' +
                '<div>Mengetahui,</div>' +
                '<div>' + jabatanKepsek + '</div>' +
                '<div style="height: 60px;"></div>' +
                '<div><b><u>' + namaKepsek + '</u></b></div>' +
                '<div>' + nipKepsek + '</div>' +
                '</td>' +
                '<td style="width: 33.3%; text-align: center; vertical-align: top; padding: 0 4px;">' +
                '<div>' + tempat + ', ' + tglRapor + '</div>' +
                '<div style="visibility: hidden;">Mengetahui,</div>' +
                '<div>Wali Kelas</div>' +
                '<div style="height: 60px;"></div>' +
                '<div><b><u>' + namaWali + '</u></b></div>' +
                '<div>' + nipWali + '</div>' +
                '</td>' +
                '</tr>' +
                '</table>';
        }
    }

    // ==========================================
    // 1. RENDER RAPOR RINGKAS STS (1 LEMBAR)
    // ==========================================
    function renderRaporRingkasHtml(d) {
        var s = d.siswa || {};
        var set = d.setting || {};
        var sek = d.sekolah || {};
        var k = d.kelas || {};
        var w = d.wali || {};
        var isDiknas = isDiknasFormat(d);

        var smtLabel = getSemesterLabel('<?= esc($smt_active->smt ?? 1) ?>');
        var smtVal = '<?= esc($smt_active->smt ?? 1) ?>';
        var smtLabelDiknas = (smtVal == '2' || String(smtVal).indexOf('genap') >= 0 || String(smtVal).indexOf('dua') >= 0) ? '2 (Genap)' : '1 (Ganjil)';
        var barisDesa = (sek.desa || 'SUMBERAGUNG').toUpperCase();
        var alamatDiknas = sek.alamat ? (sek.alamat + (sek.desa ? (', ' + sek.desa) : '')) : barisDesa;

        var rowsNilai = '';
        var totalNilai = 0;
        var noUrut = 1;

        if (isDiknas) {
            var diknasGroups = groupNilaiMapelDiknas(d.nilai || [], s.agama);

            // 1. Mata Pelajaran Umum
            if (diknasGroups.umum.length > 0) {
                rowsNilai += '<tr style="font-weight: bold;"><td colspan="3" style="background-color: transparent; padding: 4px 6px; font-weight: bold;">Mata Pelajaran Umum</td></tr>';
                diknasGroups.umum.forEach(function (u, idx) {
                    var val = u.sts !== null && u.sts !== undefined && u.sts !== '' ? u.sts : (u.nilai_sts !== null && u.nilai_sts !== undefined && u.nilai_sts !== '' ? u.nilai_sts : u.nilai_akhir);
                    var na = (val !== null && val !== undefined && val !== '' && !isNaN(parseInt(val))) ? parseInt(val) : '-';
                    rowsNilai += '<tr><td class="text-center" style="text-align: center;">' + (idx + 1) + '</td><td>' + u.nama_mapel + '</td><td class="text-center fw-bold" style="text-align: center; font-weight: bold;">' + na + '</td></tr>';
                });
            }

            // 2. Mata Pelajaran Pilihan
            if (diknasGroups.pilihan.length > 0) {
                rowsNilai += '<tr style="font-weight: bold;"><td colspan="3" style="background-color: transparent; padding: 4px 6px; font-weight: bold;">Mata Pelajaran Pilihan</td></tr>';
                diknasGroups.pilihan.forEach(function (p, idx) {
                    var val = p.sts !== null && p.sts !== undefined && p.sts !== '' ? p.sts : (p.nilai_sts !== null && p.nilai_sts !== undefined && p.nilai_sts !== '' ? p.nilai_sts : p.nilai_akhir);
                    var na = (val !== null && val !== undefined && val !== '' && !isNaN(parseInt(val))) ? parseInt(val) : '-';
                    rowsNilai += '<tr><td class="text-center" style="text-align: center;">' + (idx + 1) + '</td><td>' + p.nama_mapel + '</td><td class="text-center fw-bold" style="text-align: center; font-weight: bold;">' + na + '</td></tr>';
                });
            }

            // 3. Muatan Lokal
            if (diknasGroups.mulok.length > 0) {
                rowsNilai += '<tr style="font-weight: bold;"><td colspan="3" style="background-color: transparent; padding: 4px 6px; font-weight: bold;">Muatan Lokal</td></tr>';
                diknasGroups.mulok.forEach(function (m, idx) {
                    var val = m.sts !== null && m.sts !== undefined && m.sts !== '' ? m.sts : (m.nilai_sts !== null && m.nilai_sts !== undefined && m.nilai_sts !== '' ? m.nilai_sts : m.nilai_akhir);
                    var na = (val !== null && val !== undefined && val !== '' && !isNaN(parseInt(val))) ? parseInt(val) : '-';
                    rowsNilai += '<tr><td class="text-center" style="text-align: center;">' + (idx + 1) + '</td><td>' + m.nama_mapel + '</td><td class="text-center fw-bold" style="text-align: center; font-weight: bold;">' + na + '</td></tr>';
                });
            }
        } else {
            var groups = groupNilaiMapel(d.nilai || [], s.agama);

            // PAI
            if (groups.pai.length > 0) {
                rowsNilai += '<tr><td class="text-center fw-bold" style="text-align: center; font-weight: bold;">' + noUrut++ + '</td><td colspan="2" class="fw-bold">Pendidikan Agama Islam</td></tr>';
                var abjad = ['A', 'B', 'C', 'D', 'E', 'F'];
                groups.pai.forEach(function (p, idx) {
                    var val = p.sts !== null && p.sts !== undefined && p.sts !== '' ? p.sts : (p.nilai_sts !== null && p.nilai_sts !== undefined && p.nilai_sts !== '' ? p.nilai_sts : p.nilai_akhir);
                    var na = (val !== null && val !== undefined && val !== '' && !isNaN(parseInt(val))) ? parseInt(val) : '-';
                    if (!isNaN(na)) { totalNilai += na; }
                    rowsNilai += '<tr><td></td><td><span class="ms-2">' + abjad[idx] + '. ' + p.nama_mapel + '</span></td><td class="text-center fw-bold" style="text-align: center; font-weight: bold;">' + na + '</td></tr>';
                });
            }

            // Umum
            groups.umum.forEach(function (u) {
                var val = u.sts !== null && u.sts !== undefined && u.sts !== '' ? u.sts : (u.nilai_sts !== null && u.nilai_sts !== undefined && u.nilai_sts !== '' ? u.nilai_sts : u.nilai_akhir);
                var na = (val !== null && val !== undefined && val !== '' && !isNaN(parseInt(val))) ? parseInt(val) : '-';
                if (!isNaN(na)) { totalNilai += na; }
                rowsNilai += '<tr><td class="text-center fw-bold" style="text-align: center; font-weight: bold;">' + noUrut++ + '</td><td>' + u.nama_mapel + '</td><td class="text-center fw-bold" style="text-align: center; font-weight: bold;">' + na + '</td></tr>';
            });

            // Mulok
            if (groups.mulok.length > 0) {
                rowsNilai += '<tr><td class="text-center fw-bold" style="text-align: center; font-weight: bold;">' + noUrut++ + '</td><td colspan="2" class="fw-bold">Muatan Lokal</td></tr>';
                var abjadM = ['A', 'B', 'C', 'D'];
                groups.mulok.forEach(function (m, idx) {
                    var val = m.sts !== null && m.sts !== undefined && m.sts !== '' ? m.sts : (m.nilai_sts !== null && m.nilai_sts !== undefined && m.nilai_sts !== '' ? m.nilai_sts : m.nilai_akhir);
                    var na = (val !== null && val !== undefined && val !== '' && !isNaN(parseInt(val))) ? parseInt(val) : '-';
                    if (!isNaN(na)) { totalNilai += na; }
                    rowsNilai += '<tr><td></td><td><span class="ms-2">' + abjadM[idx] + '. ' + m.nama_mapel + '</span></td><td class="text-center fw-bold" style="text-align: center; font-weight: bold;">' + na + '</td></tr>';
                });
            }

            rowsNilai += '<tr><td colspan="2" class="text-center fw-bold" style="text-align: center; font-weight: bold;">Jumlah</td><td class="text-center fw-bold" style="text-align: center; font-weight: bold;">' + totalNilai + '</td></tr>';
        }

        // Tanda Tangan
        var tempat = set.tempat || 'Sumberagung';
        var tglRapor = set.tanggal_pts ? formatDateIndo(set.tanggal_pts) : (set.tanggal_rapor ? formatDateIndo(set.tanggal_rapor) : '20 Desember 2025');
        var namaWali = w.nama_guru || 'H. ASROFIQ, S. Pd.';
        var nipWali = getFormatNipWali(w, set, namaWali);
        var namaKepsek = sek.kepsek || 'ABD. ROZAK, S.Pd.I.';
        var nipKepsek = getFormatNipKepsek(sek, set);
        var jabatanKepsek = getJabatanKepsek(d, isDiknas);

        var pageClass = 'rapor-page ' + (isDiknas ? 'format-diknas' : '');
        var watermarkHtml = isDiknas ? '' : '<div class="watermark-logo-center"><img src="<?= base_url('assets/img/kemenag_watermark.png') ?>"></div>';

        var headerHtml = '';
        if (isDiknas) {
            headerHtml = '<table class="tbl-info my-1" style="width: 100%; border-collapse: collapse; font-family: Arial, Helvetica, sans-serif; font-size: 9pt;">' +
                '<tr>' +
                '<td style="width: 16%;">Nama</td><td style="width: 2%;">:</td><td style="width: 44%;"><b>' + (s.nama || '-') + '</b></td>' +
                '<td style="width: 16%;">Kelas</td><td style="width: 2%;">:</td><td style="width: 20%;">' + (k.nama_kelas || 'VII A') + '</td>' +
                '</tr><tr>' +
                '<td>NIS/NISN</td><td>:</td><td>' + (s.nis || '-') + ' / ' + (s.nisn || '-') + '</td>' +
                '<td>Fase</td><td>:</td><td>' + getFormatFase(k, set) + '</td>' +
                '</tr><tr>' +
                '<td>Nama Sekolah</td><td>:</td><td>' + (sek.sekolah || 'SMPN 1 INDONESIA') + '</td>' +
                '<td>Semester</td><td>:</td><td>' + smtLabelDiknas + '</td>' +
                '</tr><tr>' +
                '<td>Alamat</td><td>:</td><td>' + alamatDiknas + '</td>' +
                '<td>Tahun Pelajaran</td><td>:</td><td><?= esc($tp_active->tahun ?? '2025/2026') ?></td>' +
                '</tr></table>' +
                '<div style="border-top: 1.5px solid #000; margin: 4px 0 10px 0;"></div>' +
                '<div style="text-align: center; font-weight: bold; font-size: 11.5pt; margin: 8px 0 8px 0; letter-spacing: 0.5px;">LAPORAN HASIL BELAJAR (TENGAH SEMESTER)</div>';
        } else {
            var kopHtml = generateKopHtml(d);
            headerHtml = kopHtml +
                '<div class="line-divider"></div>' +
                '<div style="text-align: center; font-weight: bold; font-size: 13pt; margin: 10px 0 8px 0; letter-spacing: 0.5px; font-family: Arial, Helvetica, sans-serif;">RAPOR SUMATIF TENGAH SEMESTER ' + smtLabel + '</div>' +
                '<table class="tbl-info my-1">' +
                '<tr>' +
                '<td style="width: 20%;">Nama Peserta Didik</td><td style="width: 2%;">:</td><td style="width: 42%;"><b>' + (s.nama || '-').toUpperCase() + '</b></td>' +
                '<td style="width: 14%;">Kelas</td><td style="width: 2%;">:</td><td style="width: 20%;">' + (k.nama_kelas || 'VII.A') + '</td>' +
                '</tr><tr>' +
                '<td>NIS / NISN</td><td>:</td><td>' + (s.nis || '-') + ' / ' + (s.nisn || '-') + '</td>' +
                '<td>Fase</td><td>:</td><td>' + getFormatFase(k, set) + '</td>' +
                '</tr><tr>' +
                '<td>Madrasah</td><td>:</td><td>' + (sek.sekolah || 'MTsS HIDAYATUL ISLAMIYAH') + '</td>' +
                '<td>Semester</td><td>:</td><td>' + smtLabel + '</td>' +
                '</tr><tr>' +
                '<td>Alamat</td><td>:</td><td>' + barisDesa + '</td>' +
                '<td>Tahun Ajaran</td><td>:</td><td><?= esc($tp_active->tahun ?? '2025/2026') ?></td>' +
                '</tr></table>' +
                '<div class="line-divider"></div>' +
                '<div style="text-align: center; font-weight: bold; font-size: 11.5pt; margin: 8px 0 6px 0; letter-spacing: 0.5px;">CAPAIAN HASIL BELAJAR</div>';
        }

        var colNilaiHeader = isDiknas ? '<th style="width: 13%; text-align: center;">Nilai<br>Akhir</th>' : '<th style="width: 13%;">Nilai Akhir</th>';

        var html = '<div class="' + pageClass + '">' +
            watermarkHtml +
            '<div class="rapor-content-layer">' +
            headerHtml +

            '<table class="tbl-nilai" style="margin-bottom: 8px;">' +
            '<thead><tr>' +
            '<th style="width: 6%;">No</th>' +
            '<th style="width: 81%;">Mata Pelajaran</th>' +
            colNilaiHeader +
            '</tr></thead>' +
            '<tbody>' + rowsNilai + '</tbody></table>' +

            // Tanda Tangan
            generateTtdRingkasHtml(d, isDiknas, true) +
            '</div>' + // closes .rapor-content-layer
            '<div class="rapor-footer-bottom"><span>' + (k.nama_kelas || 'VII.A') + ' _ ' + (s.nama || '') + ' _ ' + (s.nisn || '') + '</span><span>Halaman 1</span></div>' +
            '</div>'; // closes .rapor-page

        $('#rapor-content').html(html);
    }

    // ==========================================
    // 2. RENDER RAPOR LENGKAP STS (2 LEMBAR)
    // ==========================================
    function renderRaporLengkapHtml(d) {
        var s = d.siswa || {};
        var set = d.setting || {};
        var sek = d.sekolah || {};
        var k = d.kelas || {};
        var w = d.wali || {};
        var isDiknas = isDiknasFormat(d);

        var smtLabel = getSemesterLabel('<?= esc($smt_active->smt ?? 1) ?>');
        var smtVal = '<?= esc($smt_active->smt ?? 1) ?>';
        var smtLabelDiknas = (smtVal == '2' || String(smtVal).indexOf('genap') >= 0 || String(smtVal).indexOf('dua') >= 0) ? '2 (Genap)' : '1 (Ganjil)';
        var barisDesa = (sek.desa || 'SUMBERAGUNG').toUpperCase();
        var alamatDiknas = sek.alamat ? (sek.alamat + (sek.desa ? (', ' + sek.desa) : '')) : barisDesa;

        function formatDeskripsiHtml(str) {
            if (!str || str.trim() === '') return '-';
            var lines = str.split('\n').filter(function (l) { return l.trim() !== ''; });
            if (lines.length > 1) {
                return lines.map(function (l) { return '<div style="margin-bottom: 2px;">' + l.trim() + '</div>'; }).join('');
            }
            return str;
        }

        var rowsNilai = '';
        var totalNilai = 0;
        var noUrut = 1;

        if (isDiknas) {
            var diknasGroups = groupNilaiMapelDiknas(d.nilai || [], s.agama);

            // 1. Mata Pelajaran Umum
            if (diknasGroups.umum.length > 0) {
                rowsNilai += '<tr style="font-weight: bold;"><td colspan="4" style="background-color: transparent; padding: 4px 6px; font-weight: bold;">Mata Pelajaran Umum</td></tr>';
                diknasGroups.umum.forEach(function (u, idx) {
                    var val = u.sts !== null && u.sts !== undefined && u.sts !== '' ? u.sts : (u.nilai_sts !== null && u.nilai_sts !== undefined && u.nilai_sts !== '' ? u.nilai_sts : u.nilai_akhir);
                    var na = (val !== null && val !== undefined && val !== '' && !isNaN(parseInt(val))) ? parseInt(val) : '-';
                    var desk = u.deskripsi_sts || u.deskripsi_capaian || '-';
                    rowsNilai += '<tr><td class="text-center" style="text-align: center;">' + (idx + 1) + '</td><td>' + u.nama_mapel + '</td><td class="text-center fw-bold" style="text-align: center; font-weight: bold;">' + na + '</td><td style="font-size: 8.5pt;">' + formatCapaianDiknas(desk) + '</td></tr>';
                });
            }

            // 2. Mata Pelajaran Pilihan
            if (diknasGroups.pilihan.length > 0) {
                rowsNilai += '<tr style="font-weight: bold;"><td colspan="4" style="background-color: transparent; padding: 4px 6px; font-weight: bold;">Mata Pelajaran Pilihan</td></tr>';
                diknasGroups.pilihan.forEach(function (p, idx) {
                    var val = p.sts !== null && p.sts !== undefined && p.sts !== '' ? p.sts : (p.nilai_sts !== null && p.nilai_sts !== undefined && p.nilai_sts !== '' ? p.nilai_sts : p.nilai_akhir);
                    var na = (val !== null && val !== undefined && val !== '' && !isNaN(parseInt(val))) ? parseInt(val) : '-';
                    var desk = p.deskripsi_sts || p.deskripsi_capaian || '-';
                    rowsNilai += '<tr><td class="text-center" style="text-align: center;">' + (idx + 1) + '</td><td>' + p.nama_mapel + '</td><td class="text-center fw-bold" style="text-align: center; font-weight: bold;">' + na + '</td><td style="font-size: 8.5pt;">' + formatCapaianDiknas(desk) + '</td></tr>';
                });
            }

            // 3. Muatan Lokal
            if (diknasGroups.mulok.length > 0) {
                rowsNilai += '<tr style="font-weight: bold;"><td colspan="4" style="background-color: transparent; padding: 4px 6px; font-weight: bold;">Muatan Lokal</td></tr>';
                diknasGroups.mulok.forEach(function (m, idx) {
                    var val = m.sts !== null && m.sts !== undefined && m.sts !== '' ? m.sts : (m.nilai_sts !== null && m.nilai_sts !== undefined && m.nilai_sts !== '' ? m.nilai_sts : m.nilai_akhir);
                    var na = (val !== null && val !== undefined && val !== '' && !isNaN(parseInt(val))) ? parseInt(val) : '-';
                    var desk = m.deskripsi_sts || m.deskripsi_capaian || '-';
                    rowsNilai += '<tr><td class="text-center" style="text-align: center;">' + (idx + 1) + '</td><td>' + m.nama_mapel + '</td><td class="text-center fw-bold" style="text-align: center; font-weight: bold;">' + na + '</td><td style="font-size: 8.5pt;">' + formatCapaianDiknas(desk) + '</td></tr>';
                });
            }
        } else {
            var groups = groupNilaiMapel(d.nilai || [], s.agama);

            // PAI
            if (groups.pai.length > 0) {
                rowsNilai += '<tr><td class="text-center fw-bold" style="text-align: center; font-weight: bold;">' + noUrut++ + '</td><td colspan="3" class="fw-bold">Pendidikan Agama Islam</td></tr>';
                var abjad = ['A', 'B', 'C', 'D', 'E', 'F'];
                groups.pai.forEach(function (p, idx) {
                    var val = p.sts !== null && p.sts !== undefined && p.sts !== '' ? p.sts : (p.nilai_sts !== null && p.nilai_sts !== undefined && p.nilai_sts !== '' ? p.nilai_sts : p.nilai_akhir);
                    var na = (val !== null && val !== undefined && val !== '' && !isNaN(parseInt(val))) ? parseInt(val) : '-';
                    if (!isNaN(na)) { totalNilai += na; }
                    var desk = p.deskripsi_sts || p.deskripsi_capaian || '-';
                    rowsNilai += '<tr><td></td><td><span class="ms-2">' + abjad[idx] + '. ' + p.nama_mapel + '</span></td><td class="text-center fw-bold" style="text-align: center; font-weight: bold;">' + na + '</td><td style="font-size: 8.5pt;">' + formatDeskripsiHtml(desk) + '</td></tr>';
                });
            }

            // Umum
            groups.umum.forEach(function (u) {
                var val = u.sts !== null && u.sts !== undefined && u.sts !== '' ? u.sts : (u.nilai_sts !== null && u.nilai_sts !== undefined && u.nilai_sts !== '' ? u.nilai_sts : u.nilai_akhir);
                var na = (val !== null && val !== undefined && val !== '' && !isNaN(parseInt(val))) ? parseInt(val) : '-';
                if (!isNaN(na)) { totalNilai += na; }
                var desk = u.deskripsi_sts || u.deskripsi_capaian || '-';
                rowsNilai += '<tr><td class="text-center fw-bold" style="text-align: center; font-weight: bold;">' + noUrut++ + '</td><td>' + u.nama_mapel + '</td><td class="text-center fw-bold" style="text-align: center; font-weight: bold;">' + na + '</td><td style="font-size: 8.5pt;">' + formatDeskripsiHtml(desk) + '</td></tr>';
            });

            // Mulok
            if (groups.mulok.length > 0) {
                rowsNilai += '<tr><td class="text-center fw-bold" style="text-align: center; font-weight: bold;">' + noUrut++ + '</td><td colspan="3" class="fw-bold">Muatan Lokal</td></tr>';
                var abjadM = ['A', 'B', 'C', 'D'];
                groups.mulok.forEach(function (m, idx) {
                    var val = m.sts !== null && m.sts !== undefined && m.sts !== '' ? m.sts : (m.nilai_sts !== null && m.nilai_sts !== undefined && m.nilai_sts !== '' ? m.nilai_sts : m.nilai_akhir);
                    var na = (val !== null && val !== undefined && val !== '' && !isNaN(parseInt(val))) ? parseInt(val) : '-';
                    if (!isNaN(na)) { totalNilai += na; }
                    var desk = m.deskripsi_sts || m.deskripsi_capaian || '-';
                    rowsNilai += '<tr><td></td><td><span class="ms-2">' + abjadM[idx] + '. ' + m.nama_mapel + '</span></td><td class="text-center fw-bold" style="text-align: center; font-weight: bold;">' + na + '</td><td style="font-size: 8.5pt;">' + formatDeskripsiHtml(desk) + '</td></tr>';
                });
            }

            rowsNilai += '<tr><td colspan="2" class="text-center fw-bold" style="text-align: center; font-weight: bold;">Jumlah Nilai</td><td class="text-center fw-bold" style="text-align: center; font-weight: bold;">' + totalNilai + '</td><td></td></tr>';
        }

        // Tanda Tangan
        var tempat = set.tempat || 'Sumberagung';
        var tglRapor = set.tanggal_pts ? formatDateIndo(set.tanggal_pts) : (set.tanggal_rapor ? formatDateIndo(set.tanggal_rapor) : '20 Desember 2025');
        var namaWali = w.nama_guru || 'H. ASROFIQ, S. Pd.';
        var nipWali = getFormatNipWali(w, set, namaWali);
        var namaKepsek = sek.kepsek || 'ABD. ROZAK, S.Pd.I.';
        var nipKepsek = getFormatNipKepsek(sek, set);
        var jabatanKepsek = getJabatanKepsek(d, isDiknas);

        var judulRapor = isDiknas ? 'LAPORAN HASIL BELAJAR (TENGAH SEMESTER)' : 'CAPAIAN HASIL BELAJAR';

        // HALAMAN 1 (STS Lengkap)
        var page1Class = 'rapor-page ' + (isDiknas ? 'format-diknas ' : '') + 'page-break';
        var page1Watermark = isDiknas ? '' : '<div class="watermark-logo-center"><img src="<?= base_url('assets/img/kemenag_watermark.png') ?>"></div>';

        var page1Header = '';
        if (isDiknas) {
            page1Header = '<table class="tbl-info my-1" style="width: 100%; border-collapse: collapse; font-family: Arial, Helvetica, sans-serif; font-size: 9pt;">' +
                '<tr>' +
                '<td style="width: 16%;">Nama</td><td style="width: 2%;">:</td><td style="width: 44%;"><b>' + (s.nama || '-') + '</b></td>' +
                '<td style="width: 16%;">Kelas</td><td style="width: 2%;">:</td><td style="width: 20%;">' + (k.nama_kelas || 'VII A') + '</td>' +
                '</tr><tr>' +
                '<td>NIS/NISN</td><td>:</td><td>' + (s.nis || '-') + ' / ' + (s.nisn || '-') + '</td>' +
                '<td>Fase</td><td>:</td><td>' + getFormatFase(k, set) + '</td>' +
                '</tr><tr>' +
                '<td>Nama Sekolah</td><td>:</td><td>' + (sek.sekolah || sek.nama_sekolah || 'Nama Sekolah') + '</td>' +
                '<td>Semester</td><td>:</td><td>' + smtLabelDiknas + '</td>' +
                '</tr><tr>' +
                '<td>Alamat</td><td>:</td><td>' + alamatDiknas + '</td>' +
                '<td>Tahun Pelajaran</td><td>:</td><td><?= esc($tp_active->tahun ?? '2025/2026') ?></td>' +
                '</tr></table>' +
                '<div style="border-top: 1.5px solid #000; margin: 4px 0 10px 0;"></div>';
        } else {
            var kopHtml = generateKopHtml(d);
            page1Header = kopHtml +
                '<div class="line-divider"></div>' +
                '<div style="text-align: center; font-weight: bold; font-size: 13pt; margin: 10px 0 8px 0; letter-spacing: 0.5px; font-family: Arial, Helvetica, sans-serif;">RAPOR SUMATIF TENGAH SEMESTER ' + smtLabel + '</div>' +
                '<table class="tbl-info my-1">' +
                '<tr>' +
                '<td style="width: 20%;">Nama Peserta Didik</td><td style="width: 2%;">:</td><td style="width: 42%;"><b>' + (s.nama || '-').toUpperCase() + '</b></td>' +
                '<td style="width: 14%;">Kelas</td><td style="width: 2%;">:</td><td style="width: 20%;">' + (k.nama_kelas || 'VII.A') + '</td>' +
                '</tr><tr>' +
                '<td>NIS / NISN</td><td>:</td><td>' + (s.nis || '-') + ' / ' + (s.nisn || '-') + '</td>' +
                '<td>Fase</td><td>:</td><td>' + getFormatFase(k, set) + '</td>' +
                '</tr><tr>' +
                '<td>Madrasah</td><td>:</td><td>' + (sek.sekolah || 'MTsS HIDAYATUL ISLAMIYAH') + '</td>' +
                '<td>Semester</td><td>:</td><td>' + smtLabel + '</td>' +
                '</tr><tr>' +
                '<td>Alamat</td><td>:</td><td>' + barisDesa + '</td>' +
                '<td>Tahun Ajaran</td><td>:</td><td><?= esc($tp_active->tahun ?? '2025/2026') ?></td>' +
                '</tr></table>' +
                '<div class="line-divider"></div>';
        }

        var colNilaiHeader = isDiknas ? '<th style="width: 12%; text-align: center;">Nilai<br>Akhir</th>' : '<th style="width: 11%;">Nilai Akhir</th>';

        var page1 = '<div class="' + page1Class + '" id="page-1">' +
            page1Watermark +
            '<div class="rapor-content-layer">' +
            page1Header +
            '<div style="text-align: center; font-weight: bold; font-size: 11.5pt; margin: 8px 0 6px 0; letter-spacing: 0.5px;">' + judulRapor + '</div>' +
            '<table class="tbl-nilai mb-2">' +
            '<thead><tr>' +
            '<th style="width: ' + (isDiknas ? '6%' : '5%') + ';">No</th>' +
            '<th style="width: ' + (isDiknas ? '32%' : '31%') + ';">Mata Pelajaran</th>' +
            colNilaiHeader +
            '<th style="width: ' + (isDiknas ? '50%' : '53%') + ';">Capaian Kompetensi</th>' +
            '</tr></thead>' +
            '<tbody>' + rowsNilai + '</tbody></table>' +
            '</div>' + // closes .rapor-content-layer
            '<div class="rapor-footer-bottom"><span>' + (k.nama_kelas || 'VII.A') + ' _ ' + (s.nama || '') + ' _ ' + (s.nisn || '') + '</span><span>Halaman 1</span></div>' +
            '</div>';

        // HALAMAN 2 (STS Lengkap)
        var ekstraList = d.ekstra || [];
        var prestasiList = d.prestasi || [];
        var kehadiran = d.kehadiran || {};

        var rowsEkstra = '';
        if (ekstraList.length > 0) {
            ekstraList.forEach(function (e, i) {
                rowsEkstra += '<tr><td class="text-center">' + (i + 1) + '</td><td>' + (e.kegiatan || '-') + '</td><td class="text-center">' + (e.nilai || '-') + '</td><td style="word-wrap: break-word; overflow-wrap: break-word; white-space: normal;">' + (e.keterangan || '-') + '</td></tr>';
            });
        } else {
            rowsEkstra = '<tr><td class="text-center">1</td><td>Pramuka</td><td class="text-center">Baik</td><td style="word-wrap: break-word; overflow-wrap: break-word; white-space: normal;">Aktif dalam kegiatan Pramuka</td></tr>' +
                '<tr><td class="text-center">2</td><td>English Club</td><td class="text-center">Belum Optimal</td><td style="word-wrap: break-word; overflow-wrap: break-word; white-space: normal;">Kurang aktif dalam kegiatan English Club</td></tr>';
        }

        var rowsPrestasi = '';
        if (prestasiList.length > 0) {
            prestasiList.forEach(function (pr, i) {
                rowsPrestasi += '<tr><td class="text-center">' + (i + 1) + '</td><td>' + (pr.jenis_prestasi || pr.prestasi || '') + '</td><td>' + (pr.keterangan || '') + '</td></tr>';
            });
            for (var pi = prestasiList.length; pi < 3; pi++) {
                rowsPrestasi += '<tr><td class="text-center">' + (pi + 1) + '</td><td></td><td></td></tr>';
            }
        } else {
            rowsPrestasi = '<tr><td class="text-center">1</td><td></td><td></td></tr>' +
                '<tr><td class="text-center">2</td><td></td><td></td></tr>' +
                '<tr><td class="text-center">3</td><td></td><td></td></tr>';
        }

        var page2Class = 'rapor-page ' + (isDiknas ? 'format-diknas' : '');
        var page2Watermark = isDiknas ? '' : '<div class="watermark-logo-center"><img src="<?= base_url('assets/img/kemenag_watermark.png') ?>"></div>';

        var page2Header = '';
        if (isDiknas) {
            page2Header = '<table class="tbl-info mb-2" style="font-size: 8.5pt; width: 100%; border-collapse: collapse;">' +
                '<tr>' +
                '<td style="width: 15%; padding: 2px 4px;">Nama</td><td style="width: 2%;">:</td><td style="width: 38%; font-weight: normal;">' + (s.nama || '-') + '</td>' +
                '<td style="width: 15%; padding: 2px 4px;">Kelas</td><td style="width: 2%;">:</td><td style="width: 28%;">' + (k.nama_kelas || 'VII A') + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td style="padding: 2px 4px;">NIS/NISN</td><td>:</td><td>' + (s.nis || '-') + ' / ' + (s.nisn || '-') + '</td>' +
                '<td style="padding: 2px 4px;">Fase</td><td>:</td><td>' + getFormatFase(k, set) + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td style="padding: 2px 4px;">Nama Sekolah</td><td>:</td><td>' + (sek.sekolah || sek.nama_sekolah || 'Nama Sekolah') + '</td>' +
                '<td style="padding: 2px 4px;">Semester</td><td>:</td><td>' + smtLabelDiknas + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td style="padding: 2px 4px;">Alamat</td><td>:</td><td>' + alamatDiknas + '</td>' +
                '<td style="padding: 2px 4px;">Tahun Pelajaran</td><td>:</td><td>' + tpText + '</td>' +
                '</tr>' +
                '</table>' +
                '<div style="border-top: 1.5px solid #000; margin: 4px 0 12px 0;"></div>';
        } else {
            page2Header = '<table class="tbl-info mb-2" style="font-size: 9pt;">' +
                '<tr><td style="width: 18%;">Nama Peserta Didik</td><td style="width: 2%;">:</td><td style="width: 44%;"><b>' + (s.nama || '-').toUpperCase() + '</b></td><td style="width: 15%;">Kelas</td><td style="width: 2%;">:</td><td style="width: 19%;">' + (k.nama_kelas || 'VII.A') + '</td></tr>' +
                '<tr><td>NIS / NISN</td><td>:</td><td>' + (s.nis || '-') + ' / ' + (s.nisn || '-') + '</td><td>Fase / Semester</td><td>:</td><td>' + getFormatFase(k, set) + ' / ' + smtLabel + '</td></tr>' +
                '</table>' +
                '<div class="line-divider mb-3"></div>';
        }

        var defaultKemenagKokurikuler = 'Siswa cukup baik dalam Menganalisis interaksi antar komponen ekosisitem dan pengaruhnya terhadap keseimbangan ekosistem ( mata pelajaran IPA) sebagai wujud lingkungan, baik dalam Mempresentasikan gagasan sebagai solusi pemecahan masalah secara kritis dan kreatif berlandasakan al-quran Hadits ( mata pelajaran Bahasa Indonesia dan Al-quran Hadits) dan baik dalam Memahami alam semesta sebagai manifestasi cinta dan kebesaran Allah sehingga tumbuh rasa hormat dan kasih sayang terhadap lingkungan';
        var defaultDiknasKokurikuler = 'Dalam kegiatan Kajian dan Pembiasaan Ibadah, ' + (s.nama || 'Peserta Didik') + ' sangat baik dalam melaksanakan ibadah harian (salat, doa, membaca Al-Qur\'an, dan adab dasar) secara mandiri dan benar. Sudah baik dalam membiasakan sikap religius, seperti disiplin beribadah, menjaga kebersihan, sopan, jujur, dan bertanggung jawab.';

        var kokurikulerHtml = '';
        if (!isDiknas) {
            var kokurikulerText = d.kokurikuler_kemenag || d.kokurikuler || defaultKemenagKokurikuler;
            kokurikulerHtml = '<div class="fw-bold mb-1" style="font-size: 10pt;">Kokurikuler</div>' +
                '<table style="width: 100%; border: 1px solid #000; margin-bottom: 12px; border-collapse: collapse; table-layout: fixed;">' +
                '<tr><td style="padding: 6px 8px; font-size: 8.5pt; text-align: justify; line-height: 1.35; border: 1px solid #000; background: transparent; word-wrap: break-word; overflow-wrap: break-word; white-space: normal;">' +
                kokurikulerText +
                '</td></tr></table>';
        } else {
            var kokurikulerText = d.kokurikuler_diknas || d.kokurikuler || defaultDiknasKokurikuler;
            kokurikulerHtml = '<table style="width: 100%; border-collapse: collapse; margin-bottom: 12px; table-layout: fixed;">' +
                '<thead><tr><th style="border: 1px solid #000; text-align: center; background-color: #f2f2f2; font-weight: bold; padding: 4px 8px; font-size: 9.5pt;">Kokurikuler</th></tr></thead>' +
                '<tbody><tr><td style="border: 1px solid #000; border-top: none; padding: 8px 10px; font-size: 8.5pt; text-align: justify; line-height: 1.45; background: #fff; word-wrap: break-word; overflow-wrap: break-word; white-space: normal;">' +
                kokurikulerText +
                '</td></tr></tbody></table>';
        }

        var page2 = '<div class="' + page2Class + '" id="page-2">' +
            page2Watermark +
            '<div class="rapor-content-layer">' +
            page2Header +
            kokurikulerHtml +

            // Ekstrakurikuler
            '<div class="fw-bold mb-1" style="font-size: 10pt;">Ekstrakurikuler</div>' +
            '<table class="tbl-nilai mb-3" style="font-size: 9pt;">' +
            '<thead><tr><th style="width: 6%;">No</th><th style="width: 38%;">Kegiatan Ekstrakurikuler</th><th style="width: 16%;">Nilai</th><th>Keterangan</th></tr></thead>' +
            '<tbody>' + rowsEkstra + '</tbody></table>' +

            // Prestasi
            '<div class="fw-bold mb-1" style="font-size: 10pt;">Prestasi</div>' +
            '<table class="tbl-nilai mb-3" style="font-size: 9pt;">' +
            '<thead><tr><th style="width: 6%;">No</th><th style="width: 38%;">Jenis Prestasi</th><th>Keterangan</th></tr></thead>' +
            '<tbody>' + rowsPrestasi + '</tbody></table>' +

            // Ketidakhadiran
            '<div class="fw-bold mb-1" style="font-size: 10pt;">Ketidakhadiran</div>' +
            '<table class="tbl-nilai mb-3" style="font-size: 9pt;">' +
            '<tr><td style="width: 40%; padding: 3px 8px;">Sakit</td><td class="text-center" style="width: 15%; padding: 3px 8px;">' + (kehadiran.sakit || 0) + '</td><td style="width: 45%; padding: 3px 8px;">Hari</td></tr>' +
            '<tr><td style="padding: 3px 8px;">Izin</td><td class="text-center" style="padding: 3px 8px;">' + (kehadiran.izin || 0) + '</td><td style="padding: 3px 8px;">Hari</td></tr>' +
            '<tr><td style="padding: 3px 8px;">Alpa</td><td class="text-center" style="padding: 3px 8px;">' + (kehadiran.alpa !== undefined ? kehadiran.alpa : (kehadiran.alpha || 0)) + '</td><td style="padding: 3px 8px;">Hari</td></tr>' +
            '</table>' +

            // Catatan Wali Kelas
            '<div class="fw-bold mb-1" style="font-size: 10pt;">Catatan Wali Kelas</div>' +
            '<div style="border: 1px solid #000; padding: 6px 8px; min-height: 38px; font-size: 8.5pt; font-style: italic; background: transparent; text-align: justify; line-height: 1.35; margin-bottom: 10px;">' +
            (kehadiran.catatan_wali || d.catatan_wali || 'Teruslah tingkatkan motivasi belajarmu agar kamu bisa menjadi siswa yang berprestasi serta membanggakan kedua orang tuamu.') +
            '</div>' +

            // Tanggapan Orang Tua/Wali
            '<div class="fw-bold mb-1" style="font-size: 10pt;">Tanggapan Orang Tua/Wali</div>' +
            '<div style="border: 1px solid #000; padding: 6px 8px; min-height: 42px; font-size: 8.5pt; background: transparent; margin-bottom: 12px;"></div>' +

            // Tanda Tangan
            '<table style="width: 100%; font-size: 9.5pt; margin-top: 20px; border-collapse: collapse;">' +
            '<tr>' +
            '<td style="width: 50%; vertical-align: top; text-align: left; padding-left: 15px;">' +
            '<div style="display: inline-block; text-align: left; min-width: 210px;">' +
            '<div style="visibility: hidden;">&nbsp;</div>' +
            '<div>Orang Tua/Wali</div>' +
            '<div style="height: 68px;"></div>' +
            '<div style="width: 210px; border-bottom: 1.5px solid #000;"></div>' +
            '<div style="visibility: hidden;">&nbsp;</div>' +
            '</div>' +
            '</td>' +
            '<td style="width: 50%; vertical-align: top; text-align: right; padding-right: 15px;">' +
            '<div style="display: inline-block; text-align: left; min-width: 210px;">' +
            '<div>' + tempat + ', ' + tglRapor + '</div>' +
            '<div>Wali Kelas</div>' +
            '<div style="height: 52px;"></div>' +
            '<div><b>' + namaWali + '</b></div>' +
            '<div>' + nipWali + '</div>' +
            '</div>' +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td colspan="2" style="text-align: center; padding-top: 25px; vertical-align: top;">' +
            '<div style="display: inline-block; text-align: center; min-width: 210px;">' +
            '<div>Mengetahui</div>' +
            '<div>' + jabatanKepsek + '</div>' +
            '<div style="height: 55px;"></div>' +
            '<div><b>' + namaKepsek + '</b></div>' +
            '<div>' + nipKepsek + '</div>' +
            '</div>' +
            '</td>' +
            '</tr></table>' +
            '</div>' + // closes .rapor-content-layer
            '<div class="rapor-footer-bottom"><span>' + (k.nama_kelas || 'VII.A') + ' _ ' + (s.nama || '') + ' _ ' + (s.nisn || '') + '</span><span>Halaman 2</span></div>' +
            '</div>';

        $('#rapor-content').html(page1 + page2);
    }

    // ==========================================
    // 3. RENDER SAMPUL RAPOR
    // ==========================================
    function renderSampulHtml(d) {
        var s = d.siswa || {};
        var sek = d.sekolah || {};
        var set = d.setting || {};

        var isDiknas = isDiknasFormat(d);
        var logoGovUrl = isDiknas ? '<?= base_url('assets/img/tutwuri.png') ?>' : '<?= base_url('assets/img/kemenag_logo_kop.jpg') ?>';
        var govCoverTitle = isDiknas ? 'KEMENTERIAN PENDIDIKAN DASAR DAN MENENGAH' : 'KEMENTERIAN AGAMA REPUBLIK INDONESIA';
        var defaultSekolah = '<?= esc($setting->sekolah ?? '') ?>';
        var nmSekolah = (sek.sekolah || defaultSekolah || '').toUpperCase();
        var jenjangSampulText = 'MADRASAH TSANAWIYAH (MTs)';
        if (isDiknas) {
            if (nmSekolah.indexOf('SD') >= 0 || (sek.satuan_nama && sek.satuan_nama.toUpperCase() === 'SD')) {
                jenjangSampulText = 'SEKOLAH DASAR (SD)';
            } else if (nmSekolah.indexOf('SMA') >= 0 || (sek.satuan_nama && sek.satuan_nama.toUpperCase() === 'SMA')) {
                jenjangSampulText = 'SEKOLAH MENENGAH ATAS (SMA)';
            } else if (nmSekolah.indexOf('SMK') >= 0 || (sek.satuan_nama && sek.satuan_nama.toUpperCase() === 'SMK')) {
                jenjangSampulText = 'SEKOLAH MENENGAH KEJURUAN (SMK)';
            } else {
                jenjangSampulText = 'SEKOLAH MENENGAH PERTAMA (SMP)';
            }
        } else {
            if (nmSekolah.indexOf('MI') >= 0 || (sek.satuan_nama && sek.satuan_nama.toUpperCase() === 'MI')) {
                jenjangSampulText = 'MADRASAH IBTIDAIYAH (MI)';
            } else if (nmSekolah.indexOf('MA') >= 0 || (sek.satuan_nama && sek.satuan_nama.toUpperCase() === 'MA')) {
                jenjangSampulText = 'MADRASAH ALIYAH (MA)';
            } else {
                jenjangSampulText = 'MADRASAH TSANAWIYAH (MTs)';
            }
        }

        var logoKemenagUrl = logoGovUrl;
        var logoMadrasahUrl = '';
        if (sek.logo_kanan && sek.logo_kanan.trim() !== '') {
            logoMadrasahUrl = (sek.logo_kanan.indexOf('http') === 0) ? sek.logo_kanan : ('<?= base_url() ?>/' + sek.logo_kanan.replace(/^\/+/, ''));
        } else if (sek.logo_kiri && sek.logo_kiri.trim() !== '' && sek.logo_kiri.indexOf('kemenag') === -1 && sek.logo_kiri.indexOf('tutwuri') === -1) {
            logoMadrasahUrl = (sek.logo_kiri.indexOf('http') === 0) ? sek.logo_kiri : ('<?= base_url() ?>/' + sek.logo_kiri.replace(/^\/+/, ''));
        }
        var coverLogo = logoMadrasahUrl || logoGovUrl;

        var namaKec = sek.kecamatan || '<?= esc($setting->kecamatan ?? '') ?>';
        var namaKota = sek.kota || '<?= esc($setting->kota ?? '') ?>';
        var kec = namaKec ? (namaKec.toLowerCase().indexOf('kec') >= 0 ? namaKec : ('Kecamatan ' + namaKec)) : '';
        var kab = namaKota ? (namaKota.toLowerCase().indexOf('kab') >= 0 || namaKota.toLowerCase().indexOf('kota') >= 0 ? namaKota : ('Kabupaten ' + namaKota)) : '';
        var barisDesa = (sek.desa || '<?= esc($setting->desa ?? '') ?>').toUpperCase();

        var alamatParts = [];
        if (barisDesa) alamatParts.push(barisDesa);
        if (kec) alamatParts.push(kec.toUpperCase());
        if (kab) alamatParts.push(kab.toUpperCase());
        var barisWilayah = alamatParts.join(' - ');

        var html = '<div class="rapor-page rapor-page-sampul" style="background-image: none !important;">' +
            '<div style="border: 3px double #000; height: 260mm; max-height: 260mm; padding: 14mm 14mm 10mm 14mm; box-sizing: border-box; display: flex; flex-direction: column; justify-content: space-between; text-align: center; font-family: \'Times New Roman\', serif;">' +
            '<div>' +
            '<div style="font-size: 19pt; font-weight: bold; letter-spacing: 1.5px; margin-bottom: 3px;">RAPOR</div>' +
            '<div style="font-size: 15pt; font-weight: bold; letter-spacing: 1px; margin-bottom: 4px;">LAPORAN HASIL BELAJAR</div>' +
            '<div style="font-size: 13pt; font-weight: bold; margin-bottom: 15px;">' + jenjangSampulText + '</div>' +
            '<img src="' + coverLogo + '" style="max-width: 115px; max-height: 115px; height: auto; margin: 10px auto; display: block;" onerror="this.src=\'' + logoGovUrl + '\'">' +
            '</div>' +
            '<div>' +
            '<div style="font-size: 11pt; margin-bottom: 8px;">Nama Peserta Didik:</div>' +
            '<div style="margin: 0 auto; width: 85%; border: 1.5px solid #000; padding: 10px 10px; background: #fafafa;">' +
            '<div style="font-size: 14pt; font-weight: bold; margin-bottom: 6px; text-transform: uppercase;">' + (s.nama || '-').toUpperCase() + '</div>' +
            '<div style="font-size: 11pt;">NIS / NISN: ' + (s.nis || '-') + ' / ' + (s.nisn || '-') + '</div>' +
            '</div>' +
            '</div>' +
            '<div style="font-size: 11pt; font-weight: bold; text-transform: uppercase; line-height: 1.4;">' +
            govCoverTitle + '<br>' +
            (nmSekolah || 'SEKOLAH') + '<br>' +
            (barisWilayah ? barisWilayah + '<br>' : '') +
            '<span style="font-weight: normal; font-size: 10pt;">TAHUN AJARAN <?= esc($tp_active->tahun ?? '2025/2026') ?></span>' +
            '</div>' +
            '</div>' +
            '</div>';

        $('#rapor-content').html(html);
    }

    // ==========================================
    // 4. RENDER IDENTITAS PESERTA DIDIK
    // ==========================================
    function renderIdentitasHtml(d) {
        var s = d.siswa || {};
        var sek = d.sekolah || {};
        var set = d.setting || {};
        var k = d.kelas || {};

        var tglLahir = s.tanggal_lahir ? formatDateIndo(s.tanggal_lahir) : '-';
        var fotoUrl = s.foto ? ('<?= base_url() ?>/' + s.foto.replace(/^\/+/, '')) : '';

        var tempat = set.tempat || 'Sumberagung';
        var namaKepsek = sek.kepsek || 'ABD. ROZAK, S.Pd.I.';
        var nipKepsek = getFormatNipKepsek(sek, set);

        var jk = (s.jenis_kelamin === 'P' || s.jenis_kelamin === 'Perempuan') ? 'Perempuan' : 'Laki-laki';
        var alamatSiswa = (s.alamat || '-') + (s.desa ? (', ' + s.desa) : '') + (s.kecamatan ? (', ' + s.kecamatan) : '');

        var isDiknas = isDiknasFormat(d);
        var pageClass = 'rapor-page ' + (isDiknas ? 'format-diknas' : '');
        var pageStyle = isDiknas ? 'style="background-image: none !important;"' : '';
        var watermarkHtml = isDiknas ? '' : '<div class="watermark-logo-center"><img src="<?= base_url('assets/img/kemenag_watermark.png') ?>"></div>';

        var asalSekolahLabel = isDiknas ? 'Sekolah Asal' : 'Madrasah / Sekolah Asal (SD/MI)';
        var diterimaLabel = isDiknas ? 'Diterima di Sekolah ini :' : 'Diterima di Madrasah ini :';
        var jabatanKepsek = getJabatanKepsek(d, isDiknas);

        var html = '<div class="' + pageClass + '" ' + pageStyle + '>' +
            watermarkHtml +
            '<div class="rapor-content-layer" style="font-family: \'Times New Roman\', serif; font-size: 10.5pt; line-height: 1.35;">' +
            '<div style="text-align: center; font-size: 13pt; font-weight: bold; margin-bottom: 18px; letter-spacing: 0.5px;">IDENTITAS PESERTA DIDIK</div>' +
            '<table style="width: 100%; border-collapse: collapse;">' +
            '<tr><td style="width: 5%; padding: 3px 2px; vertical-align: top;">1.</td><td style="width: 36%; padding: 3px 2px; vertical-align: top;">Nama Lengkap</td><td style="width: 2%; padding: 3px 2px; vertical-align: top;">:</td><td style="width: 57%; padding: 3px 2px; vertical-align: top;"><b>' + (s.nama || '-').toUpperCase() + '</b></td></tr>' +
            '<tr><td style="padding: 3px 2px; vertical-align: top;">2.</td><td style="padding: 3px 2px; vertical-align: top;">Nomor Induk / NISN</td><td style="padding: 3px 2px; vertical-align: top;">:</td><td style="padding: 3px 2px; vertical-align: top;">' + (s.nis || '-') + ' / ' + (s.nisn || '-') + '</td></tr>' +
            '<tr><td style="padding: 3px 2px; vertical-align: top;">3.</td><td style="padding: 3px 2px; vertical-align: top;">Tempat, Tanggal Lahir</td><td style="padding: 3px 2px; vertical-align: top;">:</td><td style="padding: 3px 2px; vertical-align: top;">' + (s.tempat_lahir || '-') + ', ' + tglLahir + '</td></tr>' +
            '<tr><td style="padding: 3px 2px; vertical-align: top;">4.</td><td style="padding: 3px 2px; vertical-align: top;">Jenis Kelamin</td><td style="padding: 3px 2px; vertical-align: top;">:</td><td style="padding: 3px 2px; vertical-align: top;">' + jk + '</td></tr>' +
            '<tr><td style="padding: 3px 2px; vertical-align: top;">5.</td><td style="padding: 3px 2px; vertical-align: top;">Agama</td><td style="padding: 3px 2px; vertical-align: top;">:</td><td style="padding: 3px 2px; vertical-align: top;">' + (s.agama || 'Islam') + '</td></tr>' +
            '<tr><td style="padding: 3px 2px; vertical-align: top;">6.</td><td style="padding: 3px 2px; vertical-align: top;">Status dalam Keluarga</td><td style="padding: 3px 2px; vertical-align: top;">:</td><td style="padding: 3px 2px; vertical-align: top;">' + (s.status_keluarga || 'Anak Kandung') + '</td></tr>' +
            '<tr><td style="padding: 3px 2px; vertical-align: top;">7.</td><td style="padding: 3px 2px; vertical-align: top;">Anak ke</td><td style="padding: 3px 2px; vertical-align: top;">:</td><td style="padding: 3px 2px; vertical-align: top;">' + (s.anak_ke || '1') + '</td></tr>' +
            '<tr><td style="padding: 3px 2px; vertical-align: top;">8.</td><td style="padding: 3px 2px; vertical-align: top;">Alamat Peserta Didik</td><td style="padding: 3px 2px; vertical-align: top;">:</td><td style="padding: 3px 2px; vertical-align: top;">' + alamatSiswa + '</td></tr>' +
            '<tr><td style="padding: 3px 2px; vertical-align: top;">9.</td><td style="padding: 3px 2px; vertical-align: top;">Nomor Telepon Rumah / HP</td><td style="padding: 3px 2px; vertical-align: top;">:</td><td style="padding: 3px 2px; vertical-align: top;">' + (s.hp || '-') + '</td></tr>' +
            '<tr><td style="padding: 3px 2px; vertical-align: top;">10.</td><td style="padding: 3px 2px; vertical-align: top;">' + asalSekolahLabel + '</td><td style="padding: 3px 2px; vertical-align: top;">:</td><td style="padding: 3px 2px; vertical-align: top;">' + (s.sekolah_asal || '-') + '</td></tr>' +
            '<tr><td style="padding: 3px 2px; vertical-align: top;">11.</td><td colspan="3" style="padding: 3px 2px; vertical-align: top;">' + diterimaLabel + '</td></tr>' +
            '<tr><td></td><td style="padding: 2px 2px 2px 15px; vertical-align: top;">a. Di kelas</td><td style="padding: 2px 2px; vertical-align: top;">:</td><td style="padding: 2px 2px; vertical-align: top;">' + (k.nama_kelas || 'VII (Tujuh)') + '</td></tr>' +
            '<tr><td></td><td style="padding: 2px 2px 2px 15px; vertical-align: top;">b. Pada tanggal</td><td style="padding: 2px 2px; vertical-align: top;">:</td><td style="padding: 2px 2px; vertical-align: top;">14 Juli 2025</td></tr>' +
            '<tr><td style="padding: 3px 2px; vertical-align: top;">12.</td><td colspan="3" style="padding: 3px 2px; vertical-align: top;">Orang Tua :</td></tr>' +
            '<tr><td></td><td style="padding: 2px 2px 2px 15px; vertical-align: top;">a. Nama Ayah</td><td style="padding: 2px 2px; vertical-align: top;">:</td><td style="padding: 2px 2px; vertical-align: top;">' + (s.nama_ayah || '-') + '</td></tr>' +
            '<tr><td></td><td style="padding: 2px 2px 2px 15px; vertical-align: top;">b. Nama Ibu</td><td style="padding: 2px 2px; vertical-align: top;">:</td><td style="padding: 2px 2px; vertical-align: top;">' + (s.nama_ibu || '-') + '</td></tr>' +
            '<tr><td></td><td style="padding: 2px 2px 2px 15px; vertical-align: top;">c. Alamat Orang Tua</td><td style="padding: 2px 2px; vertical-align: top;">:</td><td style="padding: 2px 2px; vertical-align: top;">' + (s.alamat || '-') + '</td></tr>' +
            '<tr><td></td><td style="padding: 2px 2px 2px 15px; vertical-align: top;">d. Pekerjaan Ayah</td><td style="padding: 2px 2px; vertical-align: top;">:</td><td style="padding: 2px 2px; vertical-align: top;">' + (s.pekerjaan_ayah || '-') + '</td></tr>' +
            '<tr><td></td><td style="padding: 2px 2px 2px 15px; vertical-align: top;">e. Pekerjaan Ibu</td><td style="padding: 2px 2px; vertical-align: top;">:</td><td style="padding: 2px 2px; vertical-align: top;">' + (s.pekerjaan_ibu || '-') + '</td></tr>' +
            '<tr><td style="padding: 3px 2px; vertical-align: top;">13.</td><td colspan="3" style="padding: 3px 2px; vertical-align: top;">Wali Peserta Didik :</td></tr>' +
            '<tr><td></td><td style="padding: 2px 2px 2px 15px; vertical-align: top;">a. Nama Wali</td><td style="padding: 2px 2px; vertical-align: top;">:</td><td style="padding: 2px 2px; vertical-align: top;">' + (s.nama_wali || '-') + '</td></tr>' +
            '<tr><td></td><td style="padding: 2px 2px 2px 15px; vertical-align: top;">b. Pekerjaan Wali</td><td style="padding: 2px 2px; vertical-align: top;">:</td><td style="padding: 2px 2px; vertical-align: top;">' + (s.pekerjaan_wali || '-') + '</td></tr>' +
            '<tr><td></td><td style="padding: 2px 2px 2px 15px; vertical-align: top;">c. Alamat Wali</td><td style="padding: 2px 2px; vertical-align: top;">:</td><td style="padding: 2px 2px; vertical-align: top;">' + (s.alamat_wali || '-') + '</td></tr>' +
            '</table>' +

            '<table style="width: 100%; margin-top: 25px;">' +
            '<tr>' +
            '<td style="width: 32%; text-align: center; vertical-align: top;">' +
            '<div style="width: 30mm; height: 40mm; border: 1px solid #000; margin: 0 auto; display: flex; align-items: center; justify-content: center; font-size: 9pt; color: #666; overflow: hidden;">' +
            (fotoUrl !== '' ? ('<img src="' + fotoUrl + '" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.parentNode.innerHTML=\'Foto Siswa<br>3 x 4\'">') : 'Foto Siswa<br>3 x 4') +
            '</div>' +
            '</td>' +
            '<td style="width: 28%;"></td>' +
            '<td style="width: 40%; text-align: center; vertical-align: top; font-size: 10.5pt;">' +
            tempat + ', 14 Juli 2025<br>' + jabatanKepsek + '<div style="height: 48px;"></div>' +
            '<b><u>' + namaKepsek + '</u></b><br>' + nipKepsek +
            '</td>' +
            '</tr></table>' +
            '</div>' + // closes .rapor-content-layer
            '<div class="rapor-footer-bottom"><span>' + (k.nama_kelas || 'VII.A') + ' _ ' + (s.nama || '') + ' _ ' + (s.nisn || '') + '</span><span>Halaman 1</span></div>' +
            '</div>';

        $('#rapor-content').html(html);
    }

    // ==========================================
    // 5. RENDER REKAP HASIL BELAJAR
    // ==========================================
    function renderRekapHtml(d) {
        var s = d.siswa || {};
        var set = d.setting || {};
        var sek = d.sekolah || {};
        var k = d.kelas || {};
        var groups = isDiknasFormat(d) ? groupNilaiMapelDiknas(d.nilai || [], s.agama) : groupNilaiMapel(d.nilai || [], s.agama);
        var rekapSem = d.rekap_semester || {};

        var kopHtml = generateKopHtml(d);
        var barisDesa = (sek.desa || 'SUMBERAGUNG').toUpperCase();
        var smtNum = parseInt('<?= esc($smt_active->smt ?? 1) ?>');

        var sekName = ((sek.sekolah || sek.nama_sekolah || '') + '').toUpperCase();
        var kName = ((k.nama_kelas || '') + '').toUpperCase();

        var kLevel = 0;
        if (k && k.level_id) {
            kLevel = parseInt(k.level_id);
        } else if (kName) {
            if (/^(XII|12)\b/.test(kName)) kLevel = 12;
            else if (/^(XI|11)\b/.test(kName)) kLevel = 11;
            else if (/^(X|10)\b/.test(kName)) kLevel = 10;
            else if (/^(IX|9)\b/.test(kName)) kLevel = 9;
            else if (/^(VIII|8)\b/.test(kName)) kLevel = 8;
            else if (/^(VII|7)\b/.test(kName)) kLevel = 7;
            else if (/^(VI|6)\b/.test(kName)) kLevel = 6;
            else if (/^(V|5)\b/.test(kName)) kLevel = 5;
            else if (/^(IV|4)\b/.test(kName)) kLevel = 4;
            else if (/^(III|3)\b/.test(kName)) kLevel = 3;
            else if (/^(II|2)\b/.test(kName)) kLevel = 2;
            else if (/^(I|1)\b/.test(kName)) kLevel = 1;
            else {
                var m = kName.match(/\d+/);
                if (m) kLevel = parseInt(m[0]);
            }
        }

        var isSd = false;
        if (d && (d.is_sd === 1 || d.is_sd === true || d.school_type === 'sd')) {
            isSd = true;
        } else if ('<?= !empty($is_sd) ? "1" : "" ?>' === '1') {
            isSd = true;
        } else if ('<?= (isset($satuan_nama) && ($satuan_nama === "SD" || $satuan_nama === "MI")) ? "1" : "" ?>' === '1') {
            isSd = true;
        } else if (sek.is_sd === 1 || sek.is_sd === true || sek.satuan_nama === 'SD' || sek.satuan_nama === 'MI') {
            isSd = true;
        } else if (/\b(SD|SDN|MI|SEKOLAH DASAR|MADRASAH IBTIDAIYAH)\b/.test(sekName)) {
            isSd = true;
        } else if (kLevel >= 1 && kLevel <= 6) {
            isSd = true;
        }

        var isSma = false;
        if (!isSd) {
            if (kLevel >= 10 && kLevel <= 12) {
                isSma = true;
            } else if (/\b(SMA|SMAN|SMK|SMKN|MA|MAS|MAN|MAK)\b/.test(sekName)) {
                isSma = true;
            }
        }

        var curFase = '';
        if (kLevel === 1 || kLevel === 2) curFase = 'A';
        else if (kLevel === 3 || kLevel === 4) curFase = 'B';
        else if (kLevel === 5 || kLevel === 6) curFase = 'C';
        else if (kLevel >= 7 && kLevel <= 9) curFase = 'D';
        else if (kLevel === 10) curFase = 'E';
        else if (kLevel === 11 || kLevel === 12) curFase = 'F';
        else if (set && set.fase) curFase = (set.fase + '').toUpperCase();
        else if (d && d.fase) curFase = (d.fase + '').toUpperCase();
        else if (isSd) curFase = 'A';
        else if (isSma) curFase = 'E';
        else curFase = 'D';

        // Jika jenjang SD tapi curFase D (karena default setting belum diubah admin), arahkan ke fase SD
        if (isSd && (curFase === 'D' || !curFase)) {
            curFase = (set && set.fase && ['A', 'B', 'C'].indexOf(set.fase.toUpperCase()) !== -1) ? set.fase.toUpperCase() : 'A';
        }

        var levelList = [];
        if (curFase === 'A') {
            levelList = [
                { lvl: 1, label: 'Kelas I', short: 'I' },
                { lvl: 2, label: 'Kelas II', short: 'II' }
            ];
        } else if (curFase === 'B') {
            levelList = [
                { lvl: 3, label: 'Kelas III', short: 'III' },
                { lvl: 4, label: 'Kelas IV', short: 'IV' }
            ];
        } else if (curFase === 'C') {
            levelList = [
                { lvl: 5, label: 'Kelas V', short: 'V' },
                { lvl: 6, label: 'Kelas VI', short: 'VI' }
            ];
        } else if (curFase === 'E') {
            levelList = [
                { lvl: 10, label: 'Kelas X', short: 'X' }
            ];
        } else if (curFase === 'F') {
            levelList = [
                { lvl: 11, label: 'Kelas XI', short: 'XI' },
                { lvl: 12, label: 'Kelas XII', short: 'XII' }
            ];
        } else {
            // Default Fase D (MTs / SMP)
            levelList = [
                { lvl: 7, label: 'Kelas VII', short: 'VII' },
                { lvl: 8, label: 'Kelas VIII', short: 'VIII' },
                { lvl: 9, label: 'Kelas IX', short: 'IX' }
            ];
        }

        function getNilaiSemester(mId, lvl, smt) {
            var key = lvl + '_' + smt;
            if (rekapSem[mId] && rekapSem[mId][key] !== undefined && rekapSem[mId][key] !== null) {
                var v = rekapSem[mId][key];
                if (v !== '' && !isNaN(v) && parseFloat(v) > 0) return Math.round(parseFloat(v));
            }
            if (lvl === kLevel && smt === smtNum) {
                var mapelItem = (d.nilai || []).find(function (item) { return item.id_mapel == mId; });
                if (mapelItem) {
                    var val = mapelItem.nilai_akhir || mapelItem.nilai_sas || mapelItem.nilai_sts || mapelItem.sts || mapelItem.sas;
                    if (val !== null && val !== undefined && val !== '' && !isNaN(parseInt(val)) && parseInt(val) > 0) {
                        return parseInt(val);
                    }
                }
            }
            return null;
        }

        var rowsNilai = '';
        var totalRata = 0;
        var noUrut = 1;
        var totalCols = (levelList.length * 2) + 3; // No + Mapel + Semesters + Rata-rata

        function buildMapelRow(item, label, isSub) {
            var valCells = '';
            var validScores = [];

            levelList.forEach(function (lvlItem) {
                var v1 = getNilaiSemester(item.id_mapel, lvlItem.lvl, 1);
                var v2 = getNilaiSemester(item.id_mapel, lvlItem.lvl, 2);
                valCells += '<td class="text-center" style="text-align: center;">' + (v1 !== null ? v1 : '') + '</td>';
                valCells += '<td class="text-center" style="text-align: center;">' + (v2 !== null ? v2 : '') + '</td>';
                if (v1 !== null && !isNaN(v1) && v1 > 0) validScores.push(v1);
                if (v2 !== null && !isNaN(v2) && v2 > 0) validScores.push(v2);
            });

            var rata = '';
            if (validScores.length >= 1) {
                var sum = validScores.reduce(function (a, b) { return a + b; }, 0);
                rata = Math.round(sum / validScores.length);
                totalRata += rata;
            }

            var noText = !isSub ? (noUrut++) : '';
            var padStyle = isSub ? 'padding-left: 15px;' : '';
            var boldClass = !isSub ? 'fw-bold' : '';

            return '<tr>' +
                '<td class="text-center ' + boldClass + '" style="text-align: center;">' + noText + '</td>' +
                '<td class="' + boldClass + '" style="' + padStyle + '">' + label + '</td>' +
                valCells +
                '<td class="text-center fw-bold" style="text-align: center; font-weight: bold;">' + rata + '</td>' +
                '</tr>';
        }

        var isDiknas = isDiknasFormat(d);

        if (isDiknas) {
            if (groups.umum && groups.umum.length > 0) {
                groups.umum.forEach(function (u) {
                    rowsNilai += buildMapelRow(u, u.nama_mapel, false);
                });
            }
            if (groups.pilihan && groups.pilihan.length > 0) {
                groups.pilihan.forEach(function (p) {
                    rowsNilai += buildMapelRow(p, p.nama_mapel, false);
                });
            }
            if (groups.mulok && groups.mulok.length > 0) {
                groups.mulok.forEach(function (m) {
                    rowsNilai += buildMapelRow(m, m.nama_mapel, false);
                });
            }
        } else {
            if (groups.pai && groups.pai.length > 0) {
                rowsNilai += '<tr><td class="text-center fw-bold" style="text-align: center;">' + noUrut++ + '</td><td colspan="' + (totalCols - 1) + '" class="fw-bold">Pendidikan Agama Islam</td></tr>';
                var abjad = ['A', 'B', 'C', 'D', 'E', 'F'];
                groups.pai.forEach(function (p, idx) {
                    rowsNilai += buildMapelRow(p, abjad[idx] + '. ' + p.nama_mapel, true);
                });
            }
            if (groups.umum && groups.umum.length > 0) {
                groups.umum.forEach(function (u) {
                    rowsNilai += buildMapelRow(u, u.nama_mapel, false);
                });
            }
            if (groups.mulok && groups.mulok.length > 0) {
                rowsNilai += '<tr><td class="text-center fw-bold" style="text-align: center;">' + noUrut++ + '</td><td colspan="' + (totalCols - 1) + '" class="fw-bold">Muatan Lokal</td></tr>';
                var abjadM = ['A', 'B', 'C', 'D'];
                groups.mulok.forEach(function (m, idx) {
                    rowsNilai += buildMapelRow(m, abjadM[idx] + '. ' + m.nama_mapel, true);
                });
            }
        }

        // Jumlah baris paling bawah
        rowsNilai += '<tr>' +
            '<td colspan="' + (totalCols - 1) + '" class="text-end fw-bold pe-3" style="text-align: right !important; padding-right: 15px; font-weight: bold;">Jumlah</td>' +
            '<td class="text-center fw-bold" style="text-align: center; font-weight: bold;">' + (totalRata > 0 ? totalRata : '') + '</td>' +
            '</tr>';

        var tempat = set.tempat || 'Sumberagung';
        var tglRapor = set.tanggal_rapor ? formatDateIndo(set.tanggal_rapor) : '20 Desember 2025';
        var namaKepsek = sek.kepsek || 'ABD. ROZAK, S.Pd.I.';
        var nipKepsek = getFormatNipKepsek(sek, set);
        var jabatanKepsek = getJabatanKepsek(d, isDiknas);
        var pageClass = 'rapor-page ' + (isDiknas ? 'format-diknas' : '');
        var pageStyle = isDiknas ? 'style="background-image: none !important;"' : '';
        var watermarkHtml = isDiknas ? '' : '<div class="watermark-logo-center"><img src="<?= base_url('assets/img/kemenag_watermark.png') ?>"></div>';

        // Header Kolom Tabel Sesuai Fase
        var numLevels = levelList.length;
        var classColW = numLevels === 2 ? 20 : (numLevels === 1 ? 24 : 14);
        var subColW = classColW / 2;
        var mapelColW = 100 - 5 - 10 - (classColW * numLevels);

        var thCols = '';
        var thSubCols = '';
        levelList.forEach(function(item) {
            thCols += '<th colspan="2" style="width: ' + classColW + '%; text-align: center; font-weight: bold;">' + item.short + '</th>';
            thSubCols += '<th style="width: ' + subColW + '%; text-align: center; font-size: 8.5pt;">Ganjil</th><th style="width: ' + subColW + '%; text-align: center; font-size: 8.5pt;">Genap</th>';
        });

        var infoTableHtml = '<table class="tbl-info my-1" style="font-size: 9pt;">' +
            '<tr>' +
            '<td style="width: 15%;">NAMA</td><td style="width: 2%;">:</td><td style="width: 48%;"><b>' + (s.nama || '-').toUpperCase() + '</b></td>' +
            '<td style="width: 15%;">' + (isDiknas ? 'Sekolah' : 'Madrasah') + '</td><td style="width: 2%;">:</td><td style="width: 18%;">' + (sek.sekolah || sek.nama_sekolah || '-') + '</td>' +
            '</tr><tr>' +
            '<td>NIS / NISN</td><td>:</td><td>' + (s.nis || '-') + (s.nisn ? ' / ' + s.nisn : '') + '</td>' +
            '<td>Kelas / Fase</td><td>:</td><td>' + (k.nama_kelas || '-') + (curFase ? ' (Fase ' + curFase + ')' : '') + '</td>' +
            '</tr></table>';

        var sigLeftW = '55%';
        var sigRightW = '45%';

        var html = '<div class="' + pageClass + '" ' + pageStyle + '>' +
            watermarkHtml +
            '<div class="rapor-content-layer">' +
            kopHtml +
            '<div class="line-divider"></div>' +
            infoTableHtml +
            '<div class="line-divider"></div>' +
            '<div style="text-align: center; font-weight: bold; font-size: 12pt; margin: 8px 0 6px 0; letter-spacing: 0.5px;">REKAP HASIL BELAJAR</div>' +

            '<table class="tbl-nilai mb-3" style="font-size: 9.5pt; table-layout: fixed !important;">' +
            '<thead>' +
            '<tr>' +
            '<th rowspan="2" style="width: 5%; vertical-align: middle; text-align: center;">No</th>' +
            '<th rowspan="2" style="width: ' + mapelColW + '%; vertical-align: middle;">Mata Pelajaran</th>' +
            thCols +
            '<th rowspan="2" style="width: 10%; vertical-align: middle; text-align: center;">Rata-rata</th>' +
            '</tr>' +
            '<tr>' +
            thSubCols +
            '</tr>' +
            '</thead>' +
            '<tbody>' + rowsNilai + '</tbody>' +
            '</table>' +

            // TTD Kepsek
            '<table style="width: 100%; font-size: 10pt; margin-top: 15px;">' +
            '<tr>' +
            '<td style="width: ' + sigLeftW + ';"></td>' +
            '<td style="width: ' + sigRightW + '; text-align: center; vertical-align: top;">' +
            tempat + ', ' + tglRapor + '<br>' +
            jabatanKepsek +
            '<div style="height: 48px;"></div>' +
            '<b><u>' + namaKepsek + '</u></b><br>' +
            nipKepsek +
            '</td>' +
            '</tr></table>' +
            '</div>' + // closes .rapor-content-layer
            '<div class="rapor-footer-bottom"><span>' + (k.nama_kelas || '') + ' _ ' + (s.nama || '') + ' _ ' + (s.nisn || '') + '</span><span>Halaman 1</span></div>' +
            '</div>';

        $('#rapor-content').html(html);
    }

    function formatDateIndo(dateStr) {
        if (!dateStr) return '';
        var parts = dateStr.split('-');
        if (parts.length !== 3) return dateStr;
        var bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        var bIdx = parseInt(parts[1]);
        return parseInt(parts[2]) + ' ' + (bulan[bIdx] || '') + ' ' + parts[0];
    }

    function printCurrentRapor() {
        if (typeof $('#print-area').print === 'function') {
            $('#print-area').print(document.title);
        } else {
            window.print();
        }
    }

    function downloadLegerExcel() {
        Swal.fire({
            title: 'Mengunduh Legger Excel...',
            html: '<div class="text-center py-2"><i class="fas fa-spinner fa-spin fa-2x text-success mb-2"></i><div>Menyiapkan file Excel legger kelas <?= esc($kelas->nama_kelas ?? 'VII') ?>...</div></div>',
            allowOutsideClick: false,
            showConfirmButton: false,
            timer: 2000
        });
        var iframe = document.getElementById('iframe-download-leger');
        if (!iframe) {
            iframe = document.createElement('iframe');
            iframe.id = 'iframe-download-leger';
            iframe.style.display = 'none';
            document.body.appendChild(iframe);
        }
        iframe.src = '<?= base_url('rapor/cetakleger/' . ($kelas->id_kelas ?? '')) ?>?autodownload=1';
    }

    function getModeTitle() {
        if (currentMode === 'sampul') return 'Sampul Rapor';
        if (currentMode === 'identitas') return 'Identitas Peserta Didik';
        if (currentMode === 'rekap') return 'Rekap Hasil Belajar';
        if (currentMode === 'lengkap') return 'Rapor STS Lengkap';
        return 'Rapor STS Ringkas';
    }

    function printAllRapor() {
        if (allSiswaList.length === 0) {
            Swal.fire('Info', 'Tidak ada daftar siswa pada kelas ini.', 'info');
            return;
        }

        var modeLabel = getModeTitle();
        Swal.fire({
            title: 'Cetak Semua ' + modeLabel + '?',
            text: 'Sistem akan memuat seluruh siswa (' + allSiswaList.length + ' siswa) untuk dokumen ' + modeLabel + ' dan membukanya untuk dicetak.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Cetak Semua',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menyiapkan ' + modeLabel + ' Semua Siswa...',
                    html: '<div class="progress mb-2"><div id="batch-progress" class="progress-bar progress-bar-striped progress-bar-animated bg-warning text-dark fw-bold" style="width: 0%">0%</div></div><div id="batch-status">Memuat data...</div>',
                    allowOutsideClick: false,
                    showConfirmButton: false
                });

                var allHtml = '';
                var completed = 0;

                function fetchNextSiswa(idx) {
                    if (idx >= allSiswaList.length) {
                        Swal.close();
                        $('#all-print-container').html(allHtml);

                        setTimeout(function () {
                            if (typeof $('#all-print-container').print === 'function') {
                                $('#all-print-container').print(modeLabel + ' - Semua Siswa');
                            } else {
                                var printWin = window.open('', '_blank');
                                if (printWin) {
                                    printWin.document.write('<!DOCTYPE html><html><head><title>' + modeLabel + ' Semua Siswa</title>' +
                                        '<link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap/css/bootstrap.min.css') ?>">' +
                                        '<style>' + $('style').text() + '</style></head><body onload="window.print()">' + allHtml + '</body></html>');
                                    printWin.document.close();
                                } else {
                                    window.print();
                                }
                            }
                        }, 500);
                        return;
                    }

                    var sObj = allSiswaList[idx];
                    var percent = Math.round(((idx + 1) / allSiswaList.length) * 100);
                    $('#batch-status').html('Memproses (' + (idx + 1) + '/' + allSiswaList.length + '): <b>' + sObj.nama + '</b>');
                    $('#batch-progress').css('width', percent + '%').text(percent + '%');

                    function processStudentData(data) {
                        if (currentMode === 'sampul') {
                            renderSampulHtml(data);
                        } else if (currentMode === 'identitas') {
                            renderIdentitasHtml(data);
                        } else if (currentMode === 'rekap') {
                            renderRekapHtml(data);
                        } else if (currentMode === 'lengkap') {
                            renderRaporLengkapHtml(data);
                        } else {
                            renderRaporRingkasHtml(data);
                        }
                        allHtml += $('#rapor-content').html();
                        fetchNextSiswa(idx + 1);
                    }

                    if (cachedSiswaData[sObj.id_siswa]) {
                        processStudentData(cachedSiswaData[sObj.id_siswa]);
                    } else {
                        $.ajax({
                            url: '<?= base_url('rapor/getraporsiswalengkap') ?>/' + sObj.id_siswa + '/' + idKelas,
                            type: 'GET',
                            dataType: 'json',
                            success: function (res) {
                                if (res.status && res.data) {
                                    cachedSiswaData[sObj.id_siswa] = res.data;
                                    processStudentData(res.data);
                                } else {
                                    fetchNextSiswa(idx + 1);
                                }
                            },
                            error: function () {
                                fetchNextSiswa(idx + 1);
                            }
                        });
                    }
                }

                fetchNextSiswa(0);
            }
        });
    }

    function zoomIn() {
        currentZoom += 0.1;
        $('#zoom-container').css('transform', 'scale(' + currentZoom + ')');
    }

    function zoomOut() {
        if (currentZoom > 0.4) {
            currentZoom -= 0.1;
            $('#zoom-container').css('transform', 'scale(' + currentZoom + ')');
        }
    }

    function zoomReset() {
        currentZoom = 1;
        $('#zoom-container').css('transform', 'scale(1)');
    }
</script>
<?= $this->endSection() ?>
