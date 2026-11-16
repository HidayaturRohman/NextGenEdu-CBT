<?= $this->extend('layout/dashboard_template_bs5') ?>

<?= $this->section('content') ?>
<style>
    .elearning-kpi-card {
        border: 1px solid rgba(16, 185, 129, 0.14);
        border-radius: 14px;
        background: #ffffff;
        transition: all 0.2s ease;
    }
    .elearning-kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
    }
    .nomorpeserta-filter-container {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px;
    }
    .select2-container--default .select2-selection--multiple {
        min-height: 42px !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        padding: 4px 8px !important;
        background-color: #ffffff !important;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: #059669 !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #ecfdf5 !important;
        border: 1px solid #a7f3d0 !important;
        color: #065f46 !important;
        border-radius: 6px !important;
        padding: 2px 8px !important;
        font-weight: 600 !important;
        font-size: 0.82rem !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #065f46 !important;
        margin-right: 4px !important;
    }

    /* Harmonious Modern Table Styling (Matching Materi) */
    .table-modern {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 10px !important;
        overflow: hidden !important;
    }
    .table-modern thead th {
        background: #f8fafc !important;
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700 !important;
        font-size: 0.82rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        padding: 12px 14px !important;
        border-bottom: 2px solid #e2e8f0 !important;
        border-top: none !important;
        vertical-align: middle !important;
    }
    .table-modern tbody td {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
        font-size: 0.88rem !important;
        color: #1e293b !important;
        padding: 11px 14px !important;
        vertical-align: middle !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }
    html[data-bs-theme="dark"] .table-modern tbody td,
    html[data-bs-theme="dark"] .table-modern tbody td .text-dark {
        color: #f1f5f9 !important;
        border-bottom-color: #334155 !important;
    }
    .table-modern tbody tr:hover {
        background-color: #f8fafc !important;
    }
    html[data-bs-theme="dark"] .table-modern tbody tr:hover {
        background-color: #273549 !important;
    }
    .badge-kelas {
        display: inline-block;
        padding: 4px 10px;
        font-size: 0.82rem;
        font-weight: 700;
        color: #0f172a !important;
        background-color: #e2e8f0 !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 6px !important;
        letter-spacing: 0.3px;
    }

    td.editable {
        background-color: #f8fafc;
        transition: all 0.15s ease;
        position: relative;
    }
    td.editable:hover {
        background-color: #f0fdf4;
        box-shadow: inset 0 0 0 1px #86efac;
    }
    td.editable:focus {
        background-color: #ffffff;
        box-shadow: inset 0 0 0 2px #10b981 !important;
        outline: none;
    }
    html[data-bs-theme="dark"] td.editable {
        background-color: #162032 !important;
        color: #60a5fa !important;
    }
    html[data-bs-theme="dark"] td.editable:hover {
        background-color: #1e293b !important;
        box-shadow: inset 0 0 0 1px #34d399;
    }
    html[data-bs-theme="dark"] td.editable:focus {
        background-color: #0f172a !important;
        color: #f8fafc !important;
        box-shadow: inset 0 0 0 2px #10b981 !important;
    }
    #searchSiswaInput:focus {
        border-color: #10b981 !important;
        box-shadow: none !important;
    }
    .input-group:focus-within .input-group-text {
        border-color: #10b981 !important;
        color: #10b981 !important;
    }
    .modal-code-item {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 8px 12px;
        margin-bottom: 8px;
        transition: border-color 0.2s ease;
    }
    .modal-code-item:hover {
        border-color: #cbd5e1;
    }
</style>

<div class="d-contents">
    <!-- Header Banner -->
    <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="me-3 flex-shrink-0">
                    <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px; background: linear-gradient(135deg, #e11d48 0%, #be123c 100%); color: #ffffff;">
                        <i class="fas fa-id-card fa-lg"></i>
                    </div>
                </div>
                <div>
                    <h4 class="card-title mb-1 fw-bold text-dark">
                        <?= esc($judul) ?>
                    </h4>
                    <p class="text-muted mb-0 small" style="font-size: 0.88rem;">
                        Generasi dan kelola nomor peserta ujian resmi berbasis NISN, kode sekolah, dan identitas siswa.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- KPI Ringkasan -->
    <div class="row g-3 mb-3">
        <div class="col-6 col-md-3">
            <div class="card kpi-pastel-card kpi-pastel-blue border-0 shadow-sm h-100">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="kpi-pastel-icon me-3">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="kpi-pastel-title small">Total Kelas Penilaian</div>
                        <div class="fs-4 fw-bold kpi-pastel-value mt-1" id="kpi-total-kelas"><?= count($kelas) ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card kpi-pastel-card kpi-pastel-purple border-0 shadow-sm h-100">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="kpi-pastel-icon me-3">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="kpi-pastel-title small">Siswa Terpilih</div>
                        <div class="fs-4 fw-bold kpi-pastel-value mt-1" id="kpi-total-siswa">0</div>
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
                    <div class="min-w-0">
                        <div class="kpi-pastel-title small">Nomor Berstatus Aktif</div>
                        <div class="fs-4 fw-bold kpi-pastel-value mt-1" id="kpi-sudah-nomor">0</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card kpi-pastel-card kpi-pastel-amber border-0 shadow-sm h-100">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="kpi-pastel-icon me-3">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="kpi-pastel-title small">Belum Memiliki Nomor</div>
                        <div class="fs-4 fw-bold kpi-pastel-value mt-1" id="kpi-belum-nomor">0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Guidance Banner -->
    <div class="d-flex flex-wrap align-items-center justify-content-between p-3 rounded-3 mb-3 gap-3 shadow-sm text-white" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%); border: 1px solid #047857;">
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle d-flex align-items-center justify-content-center bg-white bg-opacity-25 flex-shrink-0" style="width: 44px; height: 44px;">
                <i class="fas fa-id-card fa-lg text-white"></i>
            </div>
            <div>
                <h6 class="fw-bold mb-1 text-white" style="font-size: 0.95rem; letter-spacing: -0.2px;">Format Penomoran Peserta Ujian (Otomatis &amp; Fleksibel)</h6>
                <div class="small" style="color: rgba(255, 255, 255, 0.95); font-size: 0.83rem; line-height: 1.45;">
                    Pilih kelas penilaian di bawah, lalu klik <b>Generate Nomor</b> untuk membuat kode peserta seragam (contoh: <code>24-02-01-001-8</code>). Nomor juga dapat diedit langsung per siswa pada tabel.
                </div>
            </div>
        </div>
        <div class="flex-shrink-0">
            <button type="button" class="btn btn-sm btn-light text-success fw-bold rounded-pill px-3 py-2 shadow-sm text-nowrap" data-bs-toggle="modal" data-bs-target="#nomorModal" id="btnQuickGenerate" disabled>
                <i class="fas fa-magic me-1.5 text-success"></i> Buka Generator Nomor
            </button>
        </div>
    </div>

    <!-- Main Card -->
    <div class="card mb-4 shadow-sm border-0" style="border-radius: 14px;">
        <div class="card-header bg-white py-3 d-flex flex-wrap align-items-center justify-content-between gap-2" style="border-radius: 14px 14px 0 0; border-bottom: 1px solid #f1f5f9;">
            <div class="d-flex align-items-center gap-2">
                <h6 class="card-title mb-0 fw-bold text-dark">
                    Generate Nomor Peserta Ujian
                </h6>
            </div>
        </div>

        <div class="card-body">
            <!-- Filter & Action Card -->
            <div class="nomorpeserta-filter-container mb-3">
                <div class="row g-3 align-items-center">
                    <div class="col-lg-7 col-md-12">
                        <label class="form-label fw-bold small text-dark mb-1 d-flex align-items-center">
                            <i class="fas fa-chalkboard-teacher text-success me-2"></i>Pilih Kelas Penilaian
                        </label>
                        <div>
                            <?php echo form_dropdown(
                                'kelas[]',
                                $kelas,
                                null,
                                'id="kelas" class="form-control select2" multiple="multiple" data-placeholder="Pilih kelas penilaian"'
                            ); ?>
                        </div>
                        <div class="mt-1">
                            <small class="text-warning fw-semibold" style="font-size: 0.82rem; color: #d97706 !important;">Pilih semua kelas yang akan melaksanakan penilaian</small>
                        </div>
                        <div class="d-flex flex-wrap align-items-center gap-2 mt-2">
                            <button type="button" class="btn btn-xs btn-outline-success rounded-pill px-2.5 py-1" onclick="pilihSemuaKelas()" style="font-size: 0.78rem;">
                                <i class="fas fa-check-double me-1"></i>Pilih Semua Kelas
                            </button>
                            <button type="button" class="btn btn-xs btn-outline-secondary rounded-pill px-2.5 py-1" onclick="resetPilihKelas()" style="font-size: 0.78rem;">
                                <i class="fas fa-times me-1"></i>Kosongkan Pilihan
                            </button>
                            <small class="text-muted ms-auto fst-italic">Pilih satu atau lebih kelas untuk memuat daftar siswa</small>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12">
                        <div class="d-flex justify-content-end align-items-center mb-1">
                            <label class="form-label fw-bold small text-dark mb-1">
                                Aksi Kelas Terpilih
                            </label>
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <!-- Row 1: Generate Nomor (Blue) & Hapus Nomor (Red) -->
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary fw-semibold px-3 py-2 shadow-sm rounded-2 flex-fill text-nowrap" id="btnModalGenerate" data-bs-toggle="modal" data-bs-target="#nomorModal" disabled style="background-color: #0d6efd; border-color: #0d6efd;">
                                    Generate Nomor
                                </button>
                                <button type="button" class="btn btn-danger fw-semibold px-3 py-2 shadow-sm rounded-2 flex-fill text-nowrap" id="btnResetNomor" onclick="resetNumber()" disabled style="background-color: #dc3545; border-color: #dc3545;">
                                    Hapus Nomor
                                </button>
                            </div>

                            <!-- Row 2: Download Template (Green) & Import XLS (Yellow/Orange) -->
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-success fw-semibold px-3 py-2 shadow-sm rounded-2 flex-fill text-nowrap" id="btnDownloadTemplate" onclick="downloadTemplate()" disabled style="background-color: #198754; border-color: #198754;">
                                    <i class="fas fa-file-download me-1.5"></i>Download Template
                                </button>
                                <button type="button" class="btn btn-warning text-white fw-semibold px-3 py-2 shadow-sm rounded-2 flex-fill text-nowrap" id="btnImportXls" onclick="$('#fileUploadXls').click()" disabled style="background-color: #eab308; border-color: #eab308;">
                                    <i class="fas fa-file-excel me-1.5"></i>Import XLS
                                </button>
                                <input type="file" id="fileUploadXls" accept=".xlsx, .xls, .csv" style="display:none;" onchange="importExcelNomor(this)">
                            </div>

                            <!-- Row 3: Batalkan perubahan (Red) & Simpan (Blue) -->
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-danger fw-semibold px-3 py-2 shadow-sm rounded-2 flex-fill text-nowrap" id="btnUndoNumber" onclick="undoNumber()" disabled style="background-color: #dc3545; border-color: #dc3545;">
                                    <i class="fas fa-undo me-1.5"></i>Batalkan perubahan
                                </button>
                                <button type="button" class="btn btn-primary fw-semibold px-3 py-2 shadow-sm rounded-2 flex-fill text-nowrap" id="btnSaveNomorTop" onclick="$('#setNomor').submit()" disabled style="background-color: #0d6efd; border-color: #0d6efd;">
                                    <i class="fas fa-save me-1.5"></i>Simpan
                                </button>
                            </div>
                        </div>
                        <div class="mt-2 text-end" id="kelasHelpText">
                            <small class="text-muted"><i class="fas fa-info-circle text-info me-1"></i>Pilih kelas di sebelah kiri untuk mengaktifkan aksi.</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hidden Form for CSRF and Ajax Submission -->
            <?= form_open('setNomor', array('id' => 'setNomor', 'class' => 'd-none')); ?>
            <?= form_close() ?>

            <!-- Search Bar -->
            <div id="searchContainer" class="d-none mb-3">
                <div class="row g-3 align-items-center">
                    <div class="col-12">
                        <div class="input-group flex-nowrap" style="height: 42px;">
                            <span class="input-group-text bg-white border-end-0 text-muted px-3" style="border-color: #cbd5e1; border-top-left-radius: 8px; border-bottom-left-radius: 8px;">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" id="searchSiswaInput" class="form-control border-start-0 ps-1" style="height: 42px; border-color: #cbd5e1; border-top-right-radius: 8px; border-bottom-right-radius: 8px; font-size: 0.9rem;" placeholder="Cari cepat nama siswa, NISN, NIS, kelas, atau nomor peserta...">
                            <button class="btn btn-outline-secondary border border-start-0 px-3" type="button" id="clearSearchSiswa" style="border-color: #cbd5e1 !important; display: none;" title="Reset Pencarian">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empty State Container -->
            <div id="emptyStateContainer" class="text-center py-5 px-3">
                <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                    <i class="fas fa-id-card fa-3x text-secondary opacity-50"></i>
                </div>
                <h5 class="fw-bold text-dark mb-1">Belum Ada Kelas yang Dipilih</h5>
                <p class="text-muted small mx-auto mb-0" style="max-width: 450px;">
                    Silakan pilih kelas penilaian pada menu di atas untuk menampilkan daftar siswa dan mengelola nomor peserta ujian.
                </p>
            </div>

            <!-- Table Wrapper -->
            <div id="tableNomorWrapper" class="d-none table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0 table-modern" id="table-nomor">
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Generator Nomor Peserta -->
<div class="modal fade" id="nomorModal" tabindex="-1" role="dialog" aria-labelledby="nomorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px;">
            <div class="modal-header bg-light py-3" style="border-radius: 14px 14px 0 0;">
                <h5 class="modal-title fw-bold text-dark d-flex align-items-center" id="nomorModalLabel">
                    <i class="fas fa-magic text-success me-2"></i>Konfigurasi Generator Nomor Peserta
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <!-- Live Preview Box -->
                <div class="p-3 mb-3 rounded-3 shadow-sm" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #ffffff;">
                    <div class="small text-white-50 text-uppercase fw-bold mb-1" style="font-size: 0.72rem; letter-spacing: 0.5px;">Live Preview Format Nomor Ujian</div>
                    <div class="fs-4 fw-bold text-warning" id="liveModalPreview" style="letter-spacing: 0.5px;">24-02-01-001-8</div>
                    <div class="small text-white-50 mt-1" style="font-size: 0.75rem;">*Nomor urut, tingkat kelas, NIS, dan nomor unik akan disesuaikan otomatis untuk tiap siswa.</div>
                </div>

                <div class="mb-3">
                    <!-- 1 Separator -->
                    <div class="modal-code-item">
                        <div class="row g-2 align-items-center">
                            <div class="col-auto">
                                <div class="form-check form-switch mb-0">
                                    <input id="check1" class="form-check-input my-checkbox" type="checkbox" checked style="cursor: pointer;">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-white fw-semibold" style="min-width: 160px;">Pemisah (Separator)</span>
                                    <input id="input1" class="form-control form-control-sm fw-bold" value="-" type="text" placeholder="Contoh: - atau /">
                                </div>
                                <div class="small text-muted mt-1" style="font-size: 0.76rem;">Pemisah antara tiap kode, seperti: <b>-</b>, <b>_</b>, atau <b>/</b></div>
                            </div>
                        </div>
                    </div>

                    <!-- 2 sampai 11 Kode Generator -->
                    <?php for ($i = 2; $i <= 11; $i++): ?>
                    <div class="modal-code-item">
                        <div class="row g-2 align-items-center">
                            <div class="col-auto">
                                <div class="form-check form-switch mb-0">
                                    <input id="check<?= $i ?>" class="form-check-input my-checkbox" type="checkbox" checked style="cursor: pointer;">
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group input-group-sm">
                                    <select id="opt<?= $i ?>" class="form-select form-select-sm for-option bg-white fw-semibold" style="max-width: 170px;">
                                    </select>
                                    <input id="input<?= $i ?>" class="form-control form-control-sm fw-bold" type="text" placeholder="Nilai kode...">
                                </div>
                                <div class="small text-muted mt-1" style="font-size: 0.76rem;" id="info<?= $i ?>"></div>
                            </div>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>

                <!-- Guidance Note -->
                <div class="alert alert-info border-0 rounded-3 p-3 mb-0" style="background: #eff6ff; color: #1e40af;">
                    <div class="d-flex align-items-start gap-2">
                        <i class="fas fa-info-circle fa-lg mt-0.5 text-primary flex-shrink-0"></i>
                        <div class="small" style="font-size: 0.82rem; line-height: 1.45;">
                            <b>Petunjuk Generator:</b>
                            <ul class="mb-0 ps-3 mt-1">
                                <li>Centang elemen kode yang ingin disertakan ke dalam format nomor peserta.</li>
                                <li>Pilihan kode yang <b>tidak dicentang</b> atau inputnya kosong akan dilewati.</li>
                                <li>Tingkat kelas, NIS, dan NISN akan otomatis diambil dari profil siswa.</li>
                                <li>Nomor urut akan disusun otomatis berurutan dari nomor awal yang ditentukan.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light py-2.5" style="border-radius: 0 0 14px 14px;">
                <button type="button" class="btn btn-secondary rounded-pill px-3 py-1.5" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success fw-bold rounded-pill px-4 py-1.5 shadow-sm" onclick="generateNomorUjian()">
                    <i class="fas fa-bolt me-1"></i>Generate Nomor Sekarang
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Overlay Loading Centered -->
<div class="overlay d-none d-flex align-items-center justify-content-center" id="loading" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.45); z-index: 9999; backdrop-filter: blur(2px);">
    <div class="bg-white p-4 rounded-4 shadow-lg text-center" style="min-width: 200px;">
        <div class="spinner-border text-success mb-3" style="width: 3rem; height: 3rem;" role="status"></div>
        <div class="fw-bold text-dark">Memproses Data...</div>
        <small class="text-muted">Mohon tunggu sebentar</small>
    </div>
</div>

<script src="<?= base_url('assets/app/js/excel/xlsx.full.min.js') ?>"></script>
<script>
    var arrKelas = JSON.parse('<?=json_encode($kelas)?>');
    var tahun = '<?=$tp_active->tahun?>';
    var thn = tahun.split('/');
    var smt = '<?=$smt_active->id_smt?>';

    const opsi = {
        "2": "Kode Tahun",
        "3": "Kode Provinsi",
        "4": "Kode Kota/Kab",
        "5": "Kode Sekolah",
        "6": "Kode Jenjang",
        "7": "Kode Tingkat Kls",
        "8": "NIS",
        "9": "NISN",
        "10": "Nomor Urut",
        "11": "Nomor Unik"
    }

    const twoDigitYear = smt == '1' ? thn[0].substring(2, 4) : thn[1].substring(2, 4);
    const values = {
        "2": twoDigitYear,
        "3": "",
        "4": "",
        "5": "",
        "6": "",
        "7": "Tingkat Kelas",
        "8": "NIS siswa",
        "9": "NISN siswa",
        "10": "001",
        "11": "8"
    }
    const info = {
        "2": "2 digit tahun sekarang",
        "3": "Silahkan isi dengan Kode Provinsi Anda",
        "4": "Silahkan isi dengan Kode Kota/Kab",
        "5": "Silahkan isi dengan Kode Sekolah",
        "6": "SD/MI = 01, SMP/MTs = 02, SMA/MA = 03 atau sesuai jenjang sekolah",
        "7": "Otomatis 2 digit tingkat kelas siswa (07, 08, 10, dst), atau isi kode kustom",
        "8": "NIS diambil dari data siswa jika tersedia",
        "9": "NISN diambil dari data siswa jika tersedia",
        "10": "Diisi dengan nomor awal misalnya 001, nomor otomatis diurutkan",
        "11": "Biasanya diisi dengan angka 8 dan diurutkan secara menurun sampai angka 2"
    }

    function sortByName(a, b) {
        var aName = a.nama.toLowerCase();
        var bName = b.nama.toLowerCase();
        return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
    }

    function sortByNumber(a, b) {
        if (a.nomor === '') return 1;
        if (b.nomor === '') return -1;
        return a.nomor.localeCompare(b.nomor, 'en', { numeric: true });
    }

    function pad(str, max) {
        str = str.toString();
        return str.length < max ? pad("0" + str, max) : str;
    }

    function extractTingkatKelas(rawLevel, kelasStr) {
        if (rawLevel !== null && rawLevel !== undefined && rawLevel !== '' && rawLevel !== '0' && rawLevel !== 0) {
            let num = parseInt(rawLevel, 10);
            if (!isNaN(num) && num > 0) {
                return num.toString().padStart(2, '0');
            }
            let strLvl = String(rawLevel).trim().toUpperCase();
            const romanMap = {
                'I': '01', 'II': '02', 'III': '03', 'IV': '04', 'V': '05', 'VI': '06',
                'VII': '07', 'VIII': '08', 'IX': '09', 'X': '10', 'XI': '11', 'XII': '12'
            };
            if (romanMap[strLvl]) return romanMap[strLvl];
            if (strLvl.length === 1 && !isNaN(parseInt(strLvl, 10))) return strLvl.padStart(2, '0');
            if (strLvl.length > 0) return strLvl;
        }

        if (kelasStr) {
            let cleanKelas = String(kelasStr).trim().toUpperCase();
            const romanRegex = /\b(XII|XI|VIII|VII|III|IV|IX|VI|II|X|V|I)\b/;
            const matchRoman = cleanKelas.match(romanRegex);
            if (matchRoman) {
                const romanMap = {
                    'I': '01', 'II': '02', 'III': '03', 'IV': '04', 'V': '05', 'VI': '06',
                    'VII': '07', 'VIII': '08', 'IX': '09', 'X': '10', 'XI': '11', 'XII': '12'
                };
                if (romanMap[matchRoman[0]]) return romanMap[matchRoman[0]];
            }

            const numMatch = cleanKelas.match(/\b(1[0-2]|[1-9])\b/);
            if (numMatch) {
                return parseInt(numMatch[0], 10).toString().padStart(2, '0');
            }

            const leadingNum = cleanKelas.match(/^([0-9]{1,2})/);
            if (leadingNum) {
                let n = parseInt(leadingNum[1], 10);
                if (n >= 1 && n <= 12) return n.toString().padStart(2, '0');
            }
        }

        return '07';
    }

    var arrayNomor = [];
    var original = [];

    function updateKpiStats() {
        const total = arrayNomor.length;
        let berNomor = 0;
        for (let i = 0; i < total; i++) {
            if (arrayNomor[i].nomor && arrayNomor[i].nomor.trim() !== '') {
                berNomor++;
            }
        }
        const belumNomor = total - berNomor;
        $('#kpi-total-siswa').text(total);
        $('#kpi-sudah-nomor').text(berNomor);
        $('#kpi-belum-nomor').text(belumNomor);

        if (total > 0) {
            $('#btnQuickGenerate').removeAttr('disabled');
            $('#btnModalGenerate').removeAttr('disabled');
            $('#btnResetNomor').removeAttr('disabled');
            $('#btnDownloadTemplate').removeAttr('disabled');
            $('#btnImportXls').removeAttr('disabled');
            $('#btnUndoNumber').removeAttr('disabled');
            $('#btnSaveNomorTop').removeAttr('disabled');
            $('#kelasHelpText').html('<span class="text-success fw-semibold"><i class="fas fa-check-circle me-1"></i> ' + total + ' siswa siap dikelola.</span>');
            $('#searchContainer').removeClass('d-none');
        } else {
            $('#btnQuickGenerate').attr('disabled', 'disabled');
            $('#btnModalGenerate').attr('disabled', 'disabled');
            $('#btnResetNomor').attr('disabled', 'disabled');
            $('#btnDownloadTemplate').attr('disabled', 'disabled');
            $('#btnImportXls').attr('disabled', 'disabled');
            $('#btnUndoNumber').attr('disabled', 'disabled');
            $('#btnSaveNomorTop').attr('disabled', 'disabled');
            $('#kelasHelpText').html('<small class="text-muted"><i class="fas fa-info-circle text-info me-1"></i>Pilih kelas di sebelah kiri untuk mengaktifkan aksi.</small>');
            $('#searchContainer').addClass('d-none');
        }
    }

    function getNomorPeserta(arr) {
        if (arr && arr.length > 0) {
            $('#loading').removeClass('d-none');
            setTimeout(function () {
                let dataPost = new FormData($('#setNomor')[0]);
                dataPost.append('kelas', JSON.stringify(arr));
                $.ajax({
                    url: base_url + "cbtnomorpeserta/getsiswakelas",
                    type: "POST",
                    data: dataPost,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        original = response;
                        var newArr = [];
                        $.map(response.siswa, function (value, index) {
                            var item = {};
                            item['id'] = value.id_siswa;
                            item['username'] = value.username;
                            item['nama'] = value.nama;
                            item['nis'] = value.nis;
                            item['nisn'] = value.nisn;
                            item['level'] = value.level;
                            item['kelas'] = value.nama_kelas || value.kode_kelas || '-';
                            item['nomor'] = response.nomor[value.id_siswa] != null ? response.nomor[value.id_siswa]?.nomor_peserta : '';
                            newArr.push(item);
                        });
                        newArr.sort(sortByNumber);
                        arrayNomor = newArr;
                        createPreview();
                    },
                    error: function() {
                        $('#loading').addClass('d-none');
                    }
                });
            }, 300);
        } else {
            arrayNomor = [];
            createPreview();
        }
    }

    function resetNumber() {
        swal.fire({
            title: "Hapus Nomor Peserta?",
            html: "Nomor Peserta dari kelas terpilih akan dihapus dari database.<br>Anda dapat membuat ulang nomor peserta kapan saja.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#e11d48",
            cancelButtonColor: "#64748b",
            confirmButtonText: "Ya, Hapus Nomor"
        }).then(result => {
            if (result.value) {
                var val = $('#kelas').val();
                if (val && val.length > 0) {
                    $('#loading').removeClass('d-none');
                    setTimeout(function () {
                        var arrStr = encodeURIComponent(JSON.stringify(val));
                        $.ajax({
                            url: base_url + "cbtnomorpeserta/resetnomor?kelas=" + arrStr,
                            type: "GET",
                            success: function (data) {
                                if (data.status) {
                                    getNomorPeserta(val);
                                } else {
                                    $('#loading').addClass('d-none');
                                    swal.fire({
                                        title: "Gagal",
                                        text: "Data Tidak Tersimpan",
                                        icon: "error"
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                $('#loading').addClass('d-none');
                                let msg = error;
                                try {
                                    const err = JSON.parse(xhr.responseText);
                                    msg = err.Message || err.message || error;
                                } catch(e) {}
                                swal.fire({
                                    title: "Error",
                                    text: msg,
                                    icon: "error"
                                });
                            }
                        });
                    }, 300);
                }
            }
        });
    }

    function generateUnikPattern(total) {
        const urutan = [8, 7, 6, 5, 4, 3, 2];
        const result = [];
        let i = 0;
        while (result.length < total) {
            result.push(urutan[i % urutan.length]);
            i++;
        }
        return result;
    }

    function updateModalPreview() {
        const sparator = $('#check1').is(':checked') ? ($('#input1').val() || '-') : ' ';
        let previewParts = [];
        const sampleYear = smt == '1' ? thn[0].substring(2, 4) : thn[1].substring(2, 4);

        for (let j = 2; j <= 11; j++) {
            if (!$(`#check${j}`).is(':checked')) continue;
            const selectedVal = $(`#opt${j}`).val();
            let val = $(`#input${j}`).val().trim();
            if (!val && values[selectedVal]) val = values[selectedVal];

            if (selectedVal === '2') {
                val = val || sampleYear;
            } else if (selectedVal === '7') {
                if (val && val !== 'Tingkat Kelas' && val !== '[tingkat]' && val !== 'Nilai kode...') {
                    if (!isNaN(parseInt(val, 10)) && parseInt(val, 10) > 0 && val.length <= 2) {
                        val = parseInt(val, 10).toString().padStart(2, '0');
                    }
                } else {
                    let sampleLvl = (arrayNomor && arrayNomor.length > 0) ? extractTingkatKelas(arrayNomor[0].level, arrayNomor[0].kelas) : '07';
                    val = sampleLvl;
                }
            } else if (selectedVal === '8') {
                val = (arrayNomor && arrayNomor.length > 0 && arrayNomor[0].nis) ? arrayNomor[0].nis : '12345';
            } else if (selectedVal === '9') {
                val = (arrayNomor && arrayNomor.length > 0 && arrayNomor[0].nisn) ? arrayNomor[0].nisn : '0012345678';
            } else if (selectedVal === '10') {
                val = val || '001';
            } else if (selectedVal === '11') {
                val = '8';
            }

            if (val) previewParts.push(val);
        }
        const result = previewParts.join(sparator) || '-';
        $('#liveModalPreview').text(result);
    }

    function generateNomorUjian() {
        arrayNomor.sort(sortByNumber);
        const totalSiswa = arrayNomor.length;
        const sparator = $('#check1').is(':checked') ? ($('#input1').val() || '-') : ' ';

        let nomorAwal = 1;
        for (let j = 2; j <= 11; j++) {
            if (!$(`#check${j}`).is(':checked')) continue;
            const selectedVal = $(`#opt${j}`).val();
            if (selectedVal === "10") {
                const val = parseInt($(`#input${j}`).val());
                if (!isNaN(val)) {
                    nomorAwal = val;
                }
                break;
            }
        }

        const nomorUnik = generateUnikPattern(totalSiswa);

        arrayNomor.forEach((siswa, i) => {
            let nomor = [];
            for (let j = 2; j <= 11; j++) {
                if (!$(`#check${j}`).is(':checked')) continue;

                const kode = $(`#opt${j}`).val();
                const inputEl = $(`#input${j}`);
                let val = inputEl.val().trim();

                if (val === '' && values[kode]) {
                    val = values[kode];
                }

                switch (kode) {
                    case "7":
                        if (val && val !== 'Tingkat Kelas' && val !== '[tingkat]' && val !== 'Nilai kode...') {
                            if (!isNaN(parseInt(val, 10)) && parseInt(val, 10) > 0 && val.length <= 2) {
                                val = parseInt(val, 10).toString().padStart(2, '0');
                            }
                        } else {
                            val = extractTingkatKelas(siswa.level, siswa.kelas);
                        }
                        break;
                    case "8":
                        val = siswa.nis || '[nis]';
                        break;
                    case "9":
                        val = siswa.nisn || '[nisn]';
                        break;
                    case "10":
                        const lengthPadding = val.length > 0 ? val.length : 3;
                        val = (nomorAwal + i).toString().padStart(lengthPadding, '0');
                        break;
                    case "11":
                        val = nomorUnik[i].toString();
                        break;
                }

                if (val) nomor.push(val);
            }
            siswa.nomor = nomor.join(sparator);
        });

        $('#nomorModal').modal('hide');
        createPreview();
    }

    function undoNumber() {
        var newArr = [];
        $.map(original.siswa, function (value, index) {
            var item = {};
            item['id'] = value.id_siswa;
            item['username'] = value.username;
            item['nama'] = value.nama;
            item['nis'] = value.nis;
            item['nisn'] = value.nisn;
            item['level'] = value.level;
            item['kelas'] = value.nama_kelas || value.kode_kelas || '-';
            item['nomor'] = original.nomor[value.id_siswa] != null ? original.nomor[value.id_siswa]?.nomor_peserta : '';
            newArr.push(item);
        });
        newArr.sort(sortByNumber);
        arrayNomor = newArr;
        createPreview();
    }

    function createPreview() {
        updateKpiStats();
        $('#table-nomor').html('');
        if (arrayNomor.length === 0) {
            $('#emptyStateContainer').removeClass('d-none');
            $('#tableNomorWrapper').addClass('d-none');
            $('#searchContainer').addClass('d-none');
            $('#loading').addClass('d-none');
            return;
        }

        $('#emptyStateContainer').addClass('d-none');
        $('#tableNomorWrapper').removeClass('d-none');
        $('#searchContainer').removeClass('d-none');

        var tbody = '<thead style="background-color: #0d6efd; color: #ffffff;">' +
            '<tr>' +
            '<th class="text-center align-middle text-white fw-bold" width="60" style="background-color: #0d6efd; border-color: #0b5ed7;">No.</th>' +
            '<th class="text-center align-middle text-white fw-bold" width="160" style="background-color: #0d6efd; border-color: #0b5ed7;">USERNAME</th>' +
            '<th class="align-middle text-white fw-bold" style="min-width: 260px; background-color: #0d6efd; border-color: #0b5ed7;">NAMA</th>' +
            '<th class="text-center align-middle text-white fw-bold" width="130" style="background-color: #0d6efd; border-color: #0b5ed7;">KELAS</th>' +
            '<th class="text-center align-middle text-white fw-bold" style="min-width: 250px; background-color: #0d6efd; border-color: #0b5ed7;">NO. PESERTA UJIAN</th>' +
            '</tr></thead><tbody>';

        for (let i = 0; i < arrayNomor.length; i++) {
            const item = arrayNomor[i];
            const searchKeywords = (item.username + ' ' + item.nama + ' ' + (item.nis || '') + ' ' + (item.nisn || '') + ' ' + item.kelas + ' ' + (item.nomor || '')).toLowerCase();
            const hasNomor = item.nomor && item.nomor.trim() !== '';

            tbody += '<tr class="siswa-row-item" data-search="' + searchKeywords.replace(/"/g, '&quot;') + '">' +
                '<td class="text-center fw-semibold text-muted align-middle">' + (i + 1) + '</td>' +
                '<td class="text-center align-middle"><span class="fw-semibold text-dark" style="letter-spacing: 0.3px;">' + (item.username || '-') + '</span></td>' +
                '<td class="align-middle">' +
                    '<div class="fw-bold text-dark" style="font-size: 0.92rem;">' + (item.nama || '-') + '</div>' +
                '</td>' +
                '<td class="text-center align-middle"><span class="badge-kelas">' + item.kelas + '</span></td>' +
                '<td class="text-center align-middle editable" id="' + item.id + '" style="font-size: 0.92rem; font-weight: 700; color: ' + (hasNomor ? '#3b82f6' : '#94a3b8') + '; cursor: text; letter-spacing: 0.5px;" title="Klik langsung untuk mengedit nomor">' +
                    (item.nomor || '') +
                '</td>' +
                '</tr>';
        }

        tbody += '</tbody>';
        $('#table-nomor').html(tbody);
        $('#loading').addClass('d-none');

        $('.editable').attr('contentEditable', true);
        $('.editable').on('input', function () {
            const currentId = $(this).attr('id');
            const newText = $(this).text().trim();
            for (let j = 0; j < arrayNomor.length; j++) {
                if (arrayNomor[j].id == currentId) {
                    arrayNomor[j].nomor = newText;
                    break;
                }
            }
            updateKpiStats();
        });
    }

    function downloadTemplate() {
        if (!arrayNomor || arrayNomor.length === 0) {
            swal.fire({
                title: "Peringatan",
                text: "Silakan pilih kelas penilaian terlebih dahulu untuk mengunduh template siswa.",
                icon: "warning"
            });
            return;
        }

        const data = [
            ['NO', 'USERNAME', 'NAMA', 'KELAS', 'NO. PESERTA UJIAN']
        ];

        for (let i = 0; i < arrayNomor.length; i++) {
            const item = arrayNomor[i];
            data.push([
                i + 1,
                item.username || '',
                item.nama || '',
                item.kelas || '',
                item.nomor || ''
            ]);
        }

        const wb = XLSX.utils.book_new();
        const ws = XLSX.utils.aoa_to_sheet(data);

        // Set column widths matching standard template
        ws['!cols'] = [
            { wch: 6 },
            { wch: 20 },
            { wch: 35 },
            { wch: 15 },
            { wch: 28 }
        ];

        XLSX.utils.book_append_sheet(wb, ws, 'Nomor Peserta');

        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const fileName = 'Template_Nomor_Peserta_' + year + '-' + month + '-' + day + '.xlsx';

        XLSX.writeFile(wb, fileName);
    }

    function importExcelNomor(input) {
        if (!input.files || input.files.length === 0) return;
        const file = input.files[0];

        if (!arrayNomor || arrayNomor.length === 0) {
            swal.fire({
                title: "Peringatan",
                text: "Silakan pilih kelas penilaian terlebih dahulu sebelum mengimpor file Excel.",
                icon: "warning"
            });
            input.value = '';
            return;
        }

        $('#loading').removeClass('d-none');

        const reader = new FileReader();
        reader.onload = function(e) {
            try {
                const data = new Uint8Array(e.target.result);
                const workbook = XLSX.read(data, { type: 'array' });

                const sheetName = workbook.SheetNames.includes('Nomor Peserta') 
                    ? 'Nomor Peserta' 
                    : workbook.SheetNames[0];
                const worksheet = workbook.Sheets[sheetName];

                if (!worksheet) {
                    $('#loading').addClass('d-none');
                    swal.fire({
                        title: "Lembar Kerja Tidak Ditemukan",
                        text: "Lembar kerja (sheet) tidak ditemukan dalam file Excel.",
                        icon: "error"
                    });
                    input.value = '';
                    return;
                }

                const rows = XLSX.utils.sheet_to_json(worksheet, { defval: '', header: 1 });
                if (!rows || rows.length < 2) {
                    $('#loading').addClass('d-none');
                    swal.fire({
                        title: "File Kosong / Format Salah",
                        text: "File Excel tidak memiliki baris data siswa yang valid.",
                        icon: "error"
                    });
                    input.value = '';
                    return;
                }

                // Find header indexes
                const headerRow = (rows[0] || []).map(h => String(h || '').trim().toUpperCase());
                let colUsername = headerRow.findIndex(h => h.includes('USERNAME') || h === 'USER');
                let colNama = headerRow.findIndex(h => h.includes('NAMA'));
                let colNomor = headerRow.findIndex(h => h.includes('NO. PESERTA') || h.includes('NOMOR PESERTA') || h.includes('NO PESERTA') || h === 'NOMOR');

                if (colUsername === -1) colUsername = 1;
                if (colNama === -1) colNama = 2;
                if (colNomor === -1) colNomor = 4;

                let updatedCount = 0;
                for (let r = 1; r < rows.length; r++) {
                    const row = rows[r];
                    if (!row || row.length === 0) continue;

                    const uName = String(row[colUsername] !== undefined && row[colUsername] !== null ? row[colUsername] : '').trim().toLowerCase();
                    const sName = String(row[colNama] !== undefined && row[colNama] !== null ? row[colNama] : '').trim().toLowerCase();
                    const nomorVal = String(row[colNomor] !== undefined && row[colNomor] !== null ? row[colNomor] : '').trim();

                    if (!uName && !sName) continue;

                    for (let j = 0; j < arrayNomor.length; j++) {
                        const item = arrayNomor[j];
                        const itemUName = String(item.username || '').trim().toLowerCase();
                        const itemNama = String(item.nama || '').trim().toLowerCase();

                        let isMatch = false;
                        if (uName && itemUName && uName === itemUName) {
                            isMatch = true;
                        } else if (sName && itemNama && sName === itemNama) {
                            isMatch = true;
                        }

                        if (isMatch) {
                            item.nomor = nomorVal;
                            updatedCount++;
                            break;
                        }
                    }
                }

                $('#loading').addClass('d-none');
                input.value = '';

                if (updatedCount > 0) {
                    createPreview();
                    swal.fire({
                        title: "Import Berhasil!",
                        html: `<b>${updatedCount}</b> nomor peserta berhasil dimuat ke tabel.<br><small class="text-muted">Periksa kembali data di tabel, lalu klik tombol <b>Simpan</b> untuk menyimpan ke database.</small>`,
                        icon: "success"
                    });
                } else {
                    swal.fire({
                        title: "Tidak Ada Siswa Cocok",
                        text: "Tidak ada data siswa yang cocok antara file Excel dan kelas yang dipilih. Pastikan USERNAME atau NAMA siswa sesuai dengan template.",
                        icon: "warning"
                    });
                }
            } catch(err) {
                $('#loading').addClass('d-none');
                input.value = '';
                swal.fire({
                    title: "Gagal Membaca File",
                    text: "Terjadi kesalahan saat memproses file Excel: " + err.message,
                    icon: "error"
                });
            }
        };

        reader.onerror = function() {
            $('#loading').addClass('d-none');
            input.value = '';
            swal.fire({
                title: "Error",
                text: "Gagal membaca file dari komputer Anda.",
                icon: "error"
            });
        };

        reader.readAsArrayBuffer(file);
    }

    function pilihSemuaKelas() {
        var allVals = [];
        $('#kelas option').each(function () {
            var v = $(this).val();
            if (v && v !== 'Semua') {
                allVals.push(v);
            }
        });
        $('#kelas').val(allVals).trigger('change');
    }

    function resetPilihKelas() {
        $('#kelas').val([]).trigger('change');
        arrayNomor = [];
        createPreview();
    }

    $(document).ready(function () {
        ajaxcsrf();

        var opsiKelas = $("#kelas");
        opsiKelas.select2({
            width: '100%',
            placeholder: "Pilih satu atau beberapa kelas penilaian..."
        });

        if (Object.keys(arrKelas).length > 0) {
            opsiKelas.prepend("<option value='Semua'>Semua Level Kelas</option>");
        }

        opsiKelas.change(function () {
            var val = $(this).val();
            getNomorPeserta(val);
        });

        // Search instan siswa
        $('#searchSiswaInput').on('input', function () {
            const q = $(this).val().toLowerCase().trim();
            if (q) {
                $('#clearSearchSiswa').show();
            } else {
                $('#clearSearchSiswa').hide();
            }
            if (!q) {
                $('.siswa-row-item').show();
                return;
            }
            $('.siswa-row-item').each(function () {
                const text = ($(this).data('search') || '') + ' ' + $(this).text().toLowerCase();
                $(this).toggle(text.indexOf(q) !== -1);
            });
        });

        $('#clearSearchSiswa').on('click', function () {
            $('#searchSiswaInput').val('').trigger('input').focus();
        });

        $(".my-checkbox").on("click change", function () {
            const id = $(this).attr('id').replace('check', '');
            if ($(this).is(":checked")) {
                const optVal = $(`#opt${id}`).val();
                if (optVal === '8' || optVal === '9') {
                    $(`#input${id}`).prop('disabled', 'disabled');
                } else {
                    $(`#input${id}`).removeAttr('disabled');
                }
            } else {
                $(`#input${id}`).prop('disabled', 'disabled');
            }
            updateModalPreview();
        });

        $('.for-option').append('<option value="">Pilih Kode</option>');

        for (const value in opsi) {
            $('.for-option').append('<option value="' + value + '">' + opsi[value] + '</option>');
        }

        $('.for-option').each(function (ind, val) {
            val.selectedIndex = ind + 1;
            const id = ind + 2;
            $(`#info${id}`).text(info[id]);
            $(`#input${id}`).val(values[id]);

            if (id === 8 || id === 9) {
                $(`#input${id}`).prop('disabled', 'disabled');
            }
        });

        $('.for-option').change(function () {
            const id = $(this).attr('id').replace('opt', '');
            const val = $(this).val();
            $(`#input${id}`).val(values[val]);
            if (val == '8' || val == '9') {
                $(`#input${id}`).prop('disabled', 'disabled');
            } else {
                $(`#input${id}`).removeAttr('disabled');
            }

            if (val != '') {
                $(`#info${id}`).text(info[val]);
            } else {
                $(`#info${id}`).text('');
            }
            updateModalPreview();
        });

        $('#nomorModal input').on('input change', function () {
            updateModalPreview();
        });

        $('#nomorModal').on('shown.bs.modal', function () {
            updateModalPreview();
        });

        $('#setNomor').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            if (arrayNomor.length > 0) {
                const $rows1 = $('#table-nomor').find('tr'), headers1 = $rows1.splice(0, 1);
                $rows1.each((i, row) => {
                    const id = $(row).find('td.editable').attr('id');
                    const nomor = $(row).find('td.editable').text().trim();
                    for (let j = 0; j < arrayNomor.length; j++) {
                        if (arrayNomor[j].id == id) {
                            arrayNomor[j].nomor = nomor;
                        }
                    }
                });

                swal.fire({
                    text: "Menyimpan perubahan nomor peserta...",
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    onOpen: () => {
                        swal.showLoading();
                    }
                });
                $.ajax({
                    url: base_url + "cbtnomorpeserta/savenomor",
                    type: "POST",
                    dataType: "JSON",
                    data: $(this).serialize() + "&siswa=" + JSON.stringify(arrayNomor),
                    success: function (data) {
                        if (data.status) {
                            if (original && original.nomor) {
                                for (let k = 0; k < arrayNomor.length; k++) {
                                    if (original.nomor[arrayNomor[k].id]) {
                                        original.nomor[arrayNomor[k].id].nomor_peserta = arrayNomor[k].nomor;
                                    } else {
                                        original.nomor[arrayNomor[k].id] = { nomor_peserta: arrayNomor[k].nomor };
                                    }
                                }
                            }
                            swal.fire({
                                title: "Sukses!",
                                text: data.msg || "Nomor Peserta berhasil disimpan",
                                icon: "success",
                                showCancelButton: false,
                            });
                            updateKpiStats();
                        } else {
                            swal.fire({
                                title: "ERROR",
                                html: data.msg || "Data Tidak Tersimpan<br>Nomor tidak boleh sama",
                                icon: "error",
                                showCancelButton: false,
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        let msg = error;
                        try {
                            const err = JSON.parse(xhr.responseText);
                            msg = err.message || err.Message || err.msg || err.title || error;
                        } catch(e) {
                            msg = xhr.statusText || error;
                        }
                        swal.fire({
                            title: "Error",
                            text: msg,
                            icon: "error"
                        });
                    }
                });
            }
        });
    });
</script>

<?= $this->endSection() ?>
