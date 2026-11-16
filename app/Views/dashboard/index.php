<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

<style>
/* === MODERN & SMOOTH UI ENHANCEMENTS === */
html {
    scroll-behavior: smooth;
}

::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}
::-webkit-scrollbar-track {
    background: #f4f6f9;
    border-radius: 10px;
}
::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 10px;
    transition: background 0.3s ease;
}
::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Stat Card Modern Gradients */
.stat-card-gradient {
    border-radius: 16px !important;
    border: none !important;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08) !important;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1) !important;
    overflow: hidden;
    position: relative;
    color: #ffffff !important;
    padding: 1.1rem 1.1rem 0.6rem 1.1rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 115px;
}

.stat-card-gradient:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.16) !important;
}

.stat-card-blue    { background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important; }
.stat-card-cyan    { background: linear-gradient(135deg, #0891b2 0%, #0e7490 100%) !important; }
.stat-card-teal    { background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%) !important; }
.stat-card-fuchsia { background: linear-gradient(135deg, #c026d3 0%, #a21caf 100%) !important; }
.stat-card-green   { background: linear-gradient(135deg, #16a34a 0%, #15803d 100%) !important; }
.stat-card-orange  { background: linear-gradient(135deg, #ea580c 0%, #c2410c 100%) !important; }

.stat-card-value {
    font-size: 1.75rem;
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 0.15rem;
    color: #ffffff !important;
}

.stat-card-title {
    font-size: 0.85rem;
    font-weight: 600;
    opacity: 0.95;
    color: #ffffff !important;
}

.stat-card-icon {
    position: absolute;
    right: 12px;
    top: 10px;
    font-size: 2.4rem;
    opacity: 0.22;
    color: #ffffff !important;
}

.stat-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 0.7rem;
    padding-top: 0.35rem;
    border-top: 1px solid rgba(255, 255, 255, 0.25);
    color: rgba(255, 255, 255, 0.9) !important;
    font-size: 0.78rem;
    font-weight: 600;
    text-decoration: none !important;
    transition: color 0.2s ease;
}

.stat-card-footer:hover {
    color: #ffffff !important;
    text-decoration: none !important;
}

/* Color Palette Utilities for Log Icons & Badges */
.bg-soft-primary   { background-color: #e0e7ff !important; color: #3b82f6 !important; }
.bg-soft-success   { background-color: #dcfce7 !important; color: #16a34a !important; }
.bg-soft-info      { background-color: #e0f2fe !important; color: #0284c7 !important; }
.bg-soft-warning   { background-color: #fef3c7 !important; color: #d97706 !important; }
.bg-soft-danger    { background-color: #fee2e2 !important; color: #dc2626 !important; }
.bg-soft-secondary { background-color: #f1f5f9 !important; color: #475569 !important; }

.hover-bg-light:hover {
    background-color: #f8fafc !important;
}

.transition-all {
    transition: all 0.25s cubic-bezier(0.25, 0.8, 0.25, 1) !important;
}

/* Transitions & modern shadows for cards */
.card,
.modal-content {
    border-radius: 16px !important;
    border: none !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06) !important;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1) !important;
    overflow: hidden;
}

.card:hover {
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1) !important;
}

.btn,
.nav-link {
    transition: all 0.25s cubic-bezier(0.25, 0.8, 0.25, 1) !important;
    border-radius: 8px !important;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12) !important;
}

.table-bordered {
    border-radius: 12px !important;
    overflow: hidden;
    border-collapse: separate !important;
    border-spacing: 0 !important;
    border: none !important;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03) !important;
}

.table-bordered th,
.table-bordered td {
    border: 1px solid #f0f2f5 !important;
    transition: background-color 0.3s ease !important;
}

.table-bordered tbody tr:hover {
    background-color: #f8f9fa !important;
}

.alert,
.badge {
    border-radius: 8px !important;
    border: none !important;
    font-weight: 500 !important;
}

.nav-tabs .nav-link {
    border-radius: 10px !important;
    margin: 2px 0 !important;
    transition: all 0.3s ease !important;
}

.nav-tabs .nav-link.active {
    background-color: #007bff !important;
    color: white !important;
    box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3) !important;
    border-color: #007bff !important;
    transform: translateX(4px);
}

.modal-content {
    border-radius: 20px !important;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2) !important;
}

.modal-header {
    border-bottom: 1px solid rgba(0, 0, 0, 0.05) !important;
    border-top-left-radius: 20px !important;
    border-top-right-radius: 20px !important;
}

.spinner-grow,
.fa-spin {
    animation-duration: 1.2s !important;
}

@media (max-width: 1199.98px) {
    html, body, .content-wrapper, .container-fluid {
        overflow-x: hidden !important;
        max-width: 100vw !important;
    }
    .container-fluid {
        padding-left: 8px !important;
        padding-right: 8px !important;
    }
    .dashboard-row {
        display: flex !important;
        flex-direction: column !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
        width: 100% !important;
    }
    .col-left, .col-right {
        display: contents !important;
    }
    .card {
        width: 100% !important;
        max-width: 100% !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
        box-sizing: border-box !important;
    }
    .card-token { order: 1 !important; }
    .card-penilaian { order: 2 !important; }
    .card-jadwal { order: 3 !important; }
    .card-elearning { order: 4 !important; }
    .card-aktifitas { order: 5 !important; }
    .card-pengumuman { order: 6 !important; }
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-light">

    <!-- === MAIN CONTENT === -->
    <section class="content pt-3 pb-5">
        <div class="container-fluid">
            
            <!-- === STAT BOXES SECTION === -->
            <div class="row g-3 mb-4">
                <?php 
                $icon_map = [
                    'Siswa'           => ['class' => 'stat-card-blue',    'icon' => 'fas fa-user-graduate'],
                    'Rombel'          => ['class' => 'stat-card-cyan',    'icon' => 'fas fa-school'],
                    'Guru'            => ['class' => 'stat-card-teal',    'icon' => 'fas fa-chalkboard-teacher'],
                    'Wali Kelas'      => ['class' => 'stat-card-fuchsia', 'icon' => 'fas fa-user-check'],
                    'Mapel'           => ['class' => 'stat-card-green',   'icon' => 'fas fa-book'],
                    'Ekstrakurikuler' => ['class' => 'stat-card-orange',  'icon' => 'fas fa-trophy']
                ];
                $idx = 0;
                foreach ($info_box as $info) : 
                    $title = $info->title ?? '';
                    $st = $icon_map[$title] ?? ['class' => 'stat-card-blue', 'icon' => 'fa fa-info-circle'];
                ?>
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="stat-card-gradient <?= $st['class'] ?>">
                            <div class="stat-card-icon">
                                <i class="<?= $st['icon'] ?>"></i>
                            </div>
                            <div>
                                <div class="stat-card-value"><?= $info->total; ?></div>
                                <div class="stat-card-title"><?= $info->title; ?></div>
                            </div>
                            <a href="<?= base_url($info->url) ?>" class="stat-card-footer">
                                <span>Detail</span>
                                <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                <?php 
                $idx++;
                endforeach; 
                ?>
            </div>

            <!-- === 2 COLUMN MAIN CONTENT (PC: 2 Columns, Mobile/Tablet: 1 Column) === -->
            <div class="row dashboard-row">

                <!-- ============================================ -->
                <!-- KOLOM KIRI (PC: col-md-4, Tablet/Mobile: col-12) -->
                <!-- ============================================ -->
                <div class="col-md-4 col-left">

                    <!-- 1. CARD: TOKEN UJIAN -->
                    <div class="card my-shadow mb-4 card-token">
                        <div class="card-header bg-primary text-white py-3 d-flex align-items-center">
                            <i class="fas fa-key me-2"></i>
                            <h5 class="card-title m-0 font-weight-bold text-white">Token Ujian</h5>
                        </div>
                        <div class="card-body p-3">
                            <style>
                            @import url('https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@700&family=JetBrains+Mono:wght@700;800&family=Share+Tech+Mono&display=swap');

                            .token-box-wrapper {
                                background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);
                                border: 2px dashed #cbd5e1;
                                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                                box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.02);
                                max-width: 100%;
                                box-sizing: border-box;
                                overflow-x: hidden;
                            }

                            .token-box-wrapper:hover {
                                border-color: #3a57e8;
                                background: linear-gradient(135deg, #ffffff 0%, #ebf3fe 100%);
                                transform: translateY(-2px);
                                box-shadow: 0 10px 25px rgba(58, 87, 232, 0.15);
                            }

                            #token-view {
                                font-family: 'JetBrains Mono', 'Chakra Petch', 'Share Tech Mono', 'Consolas', monospace !important;
                                font-size: clamp(1.4rem, 6vw, 2.3rem) !important;
                                font-weight: 800 !important;
                                letter-spacing: clamp(2px, 2.5vw, 8px) !important;
                                color: #1d4ed8 !important;
                                text-shadow: 0 3px 10px rgba(29, 78, 216, 0.2);
                                line-height: 1.2;
                                display: inline-block;
                                max-width: 100%;
                                word-break: break-all;
                                margin: 4px 0;
                            }
                            </style>
                            <div class="p-3 bg-light rounded-4 border text-center shadow-sm d-flex flex-column justify-content-center">
                                <div>
                                    <div class="badge bg-primary text-white px-3 py-2 rounded-pill mb-2 font-weight-bold shadow-sm" style="font-size: 0.8rem; letter-spacing: 0.5px;">
                                        <i class="fa fa-sync-alt fa-spin me-1" style="animation-duration: 6s;"></i> Auto Generate Token : <span id="interval" class="ms-1 font-monospace">-- : -- : --</span>
                                    </div>
                                </div>
                                <a href="<?= base_url('cbttoken') ?>" class="text-decoration-none d-block">
                                    <div class="token-box-wrapper p-3 rounded-4 mt-1">
                                        <div class="text-muted text-uppercase mb-1 fw-bold" style="font-size: 0.72rem; letter-spacing: 2px; color: #64748b;">TOKEN UJIAN</div>
                                        <div class="font-weight-bold text-primary" id="token-view">
                                            <?= ($token->token != null && $token->token != '') ? $token->token : '- - - - - -' ?>
                                        </div>
                                        <div class="mt-1">
                                            <span class="badge bg-light text-primary border border-primary-subtle px-2 py-1 rounded-pill small fw-semibold" style="font-size: 0.72rem;">
                                                <i class="far fa-copy me-1"></i> Klik untuk kelola
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- 2. CARD: PENILAIAN -->
                    <div class="card my-shadow mb-4 card-penilaian">
                        <div class="card-header bg-danger text-white py-3 d-flex align-items-center">
                            <i class="fas fa-pencil-alt me-2"></i>
                            <h5 class="card-title m-0 font-weight-bold text-white">Penilaian</h5>
                        </div>
                        <div class="card-body p-3">
                            <div class="row g-2">
                                <?php foreach ($ujian_box as $u_box) : ?>
                                    <div class="col-3">
                                        <a href="<?= base_url($u_box->url) ?>" class="text-decoration-none">
                                            <div class="p-2 border rounded-3 text-center bg-light hover-bg-light transition-all">
                                                <div class="text-muted" style="font-size: 0.75rem; font-weight: 600;"><?= $u_box->title ?></div>
                                                <div class="text-danger font-weight-bold m-0" style="font-size: 1.35rem;"><?= $u_box->total ?></div>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- 5. CARD: AKTIFITAS TERBARU -->
                    <div class="card my-shadow mb-4 card-aktifitas">
                        <div class="card-header bg-success text-white py-3 d-flex justify-content-between align-items-center">
                            <h5 class="card-title m-0 text-white font-weight-bold d-flex align-items-center">
                                <i class="fa fa-history me-2"></i> AKTIFITAS TERBARU
                            </h5>
                            <div class="card-tools d-flex align-items-center gap-1">
                                <button type="button" onclick="hapusLogAktivitas()" class="btn btn-sm btn-outline-light rounded-circle p-1 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Hapus Log Aktivitas">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <a href="<?= base_url('datalogs') ?>" class="btn btn-sm btn-light rounded-circle p-1 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Lihat Semua Log">
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div id="log-list" style="max-height: 480px; overflow-y: auto;">
                                <div class="text-center py-4 text-muted">
                                    <div class="spinner-border spinner-border-sm text-success mb-2"></div>
                                    <p class="mb-0" style="font-size: 0.85rem;">Memuat aktifitas...</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- END KOLOM KIRI -->

                <!-- ============================================ -->
                <!-- KOLOM KANAN (PC: col-md-8, Tablet/Mobile: col-12) -->
                <!-- ============================================ -->
                <div class="col-md-8 col-right">

                    <!-- 3. CARD: JADWAL PENILAIAN HARI INI -->
                    <div class="card my-shadow mb-4 card-jadwal">
                        <div class="card-header bg-danger text-white py-3 d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar-alt me-2"></i>
                                <h5 class="card-title m-0 text-white font-weight-bold">JADWAL PENILAIAN HARI INI</h5>
                            </div>
                            <div class="card-tools">
                                <a href="<?= base_url('cbtjadwal') ?>" class="btn btn-sm btn-light rounded-circle p-1 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Lihat Semua Jadwal Ujian">
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="col-12 table-responsive p-0" id="table-container">
                                <div class="py-4 text-center text-muted">
                                    <iconify-icon icon="lucide:calendar-check-2" width="40" height="40" style="display: inline-block; margin-bottom: 8px; opacity: 0.5;"></iconify-icon>
                                    <p class="m-0" style="font-size: 0.88rem;">Tidak ada jadwal penilaian hari ini</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 6. CARD: INFO/PENGUMUMAN -->
                    <div class="card my-shadow mb-4 card-pengumuman">
                        <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-bullhorn me-2"></i>
                                <h5 class="card-title m-0 text-white font-weight-bold">INFO / PENGUMUMAN</h5>
                            </div>
                            <div class="card-tools">
                                <a href="<?= base_url('pengumuman') ?>" class="btn btn-sm btn-light rounded-circle p-1 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Kelola Pengumuman">
                                    <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="konten-pengumuman">
                                <div id="pengumuman">
                                    <div class="py-4 text-center text-muted">
                                        <iconify-icon icon="lucide:megaphone" width="40" height="40" style="display: inline-block; margin-bottom: 8px; opacity: 0.5;"></iconify-icon>
                                        <p class="m-0" style="font-size: 0.88rem;">Tidak ada pengumuman hari ini</p>
                                    </div>
                                </div>
                                <p id="loading-post" class="text-center text-muted py-3 d-none">
                                    <br /><i class="fa fa-spin fa-circle-notch me-1"></i> Memuat pengumuman...
                                </p>
                                <div id="loadmore-post" onclick="getPosts()" class="text-center mt-4 loadmore d-none">
                                    <div class="btn btn-warning shadow-sm">Muat Pengumuman lainnya ...</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- END KOLOM KANAN -->

            </div>
        </div>
    </section>
</div>

<!-- === MODAL: KOMENTAR === -->
<div class="modal fade" id="komentarModal" tabindex="-1" role="dialog" aria-labelledby="komentarLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="komentarLabel">Tulis Komentar</h5>
                <button type="button" class="close btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-start gap-2">
                    <img class="img-fluid img-circle img-sm rounded-circle me-2" src="<?= base_url('assets/img/user.png') ?>" alt="User Avatar" width="40" height="40" onerror="this.onerror=null; this.src='<?= base_url('assets/img/guru.png') ?>';">
                    <div class="w-100">
                        <?= form_open('pengumuman/savekomentar', ['id' => 'komentar']) ?>
                        <input type="hidden" id="id-post" name="id_post" value="">
                        <div class="input-group">
                            <input type="text" name="text" placeholder="Tulis komentar..." class="form-control form-control-sm rounded-start" required>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success btn-sm">Komentari</button>
                            </div>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- === MODAL: BALASAN === -->
<div class="modal fade" id="balasanModal" tabindex="-1" role="dialog" aria-labelledby="balasanLabel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="balasanLabel">Tulis Balasan</h5>
                <button type="button" class="close btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-start gap-2">
                    <img class="img-fluid img-circle img-sm rounded-circle me-2" src="<?= base_url('assets/img/siswa.png') ?>" alt="User Avatar" width="40" height="40">
                    <div class="w-100">
                        <?= form_open('pengumuman/savebalasan', ['id' => 'balasan']) ?>
                        <input type="hidden" id="id-comment" name="id_comment" value="">
                        <div class="input-group">
                            <input type="text" name="text" placeholder="Tulis balasan...." class="form-control form-control-sm rounded-start" required>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success btn-sm">Balas</button>
                            </div>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url() ?>/assets/app/js/rowspanizer.js"></script>
<script>
let halaman = 0;
window.adaJadwalUjian = '<?= count($ada_ujian) ?>' || '0';
localStorage.setItem('nextgenCBT.ada_jadwal_ujian', window.adaJadwalUjian);

async function ajaxGet(url) {
    return new Promise((resolve, reject) => {
        setTimeout(function() {
            $.ajax({
                url: base_url + url,
                type: "GET",
                success: function(respon) {
                    resolve(respon);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: ", status, error);
                    reject(error);
                }
            });
        }, 100);
    });
}

async function createTableFromJSON(data) {
    const tableContainer = document.getElementById('table-container');
    if (!tableContainer) return;
    const allSesi = data.ruangs || [];
    const jsonData = data.jadwals_ujian || [];

    if (!validateData(allSesi, jsonData, tableContainer)) {
        return;
    }

    const groupedSchedules = processAndGroupData(data);

    groupedSchedules.sort((a, b) => {
        if (a.ruang_sesi.ruang_id !== b.ruang_sesi.ruang_id) return a.ruang_sesi.ruang_id - b.ruang_sesi.ruang_id;
        if (a.ruang_sesi.sesi_id !== b.ruang_sesi.sesi_id) return a.ruang_sesi.sesi_id - b.ruang_sesi.sesi_id;
        return a.jam_ke - b.jam_ke;
    });

    const rowCounts = calculateRowCounts(groupedSchedules, 'ruang_sesi.ruang_id');
    const sesiRowCounts = calculateRowCounts(groupedSchedules, 'ruang_sesi.ruang_id', 'ruang_sesi.sesi_id');

    const tableHtml = buildTable(groupedSchedules, data, rowCounts, sesiRowCounts);
    tableContainer.innerHTML = tableHtml;
}

function validateData(allSesi, jsonData, container) {
    if (!jsonData || jsonData.length === 0) {
        container.innerHTML = `<div class="py-4 text-center text-muted"><iconify-icon icon="lucide:calendar-check-2" width="40" height="40" style="display: inline-block; margin-bottom: 8px; opacity: 0.5;"></iconify-icon><p class="m-0" style="font-size: 0.88rem;">Tidak ada jadwal penilaian hari ini</p></div>`;
        return false;
    }
    return true;
}

function processAndGroupData(data) {
    const allSesi = data.ruangs || [];
    const jsonData = data.jadwals_ujian || [];
    const grouped = {};

    jsonData.forEach(jadwal => {
        jadwal.bank.bank_kelas = jadwal.bank.bank_kelas.map(String);
        const ruangFiltered = allSesi?.filter(r =>
            r.kelas_id.some(id => jadwal.bank.bank_kelas.includes(id?.toString()))
        );

        ruangFiltered.forEach(ruang => {
            const siswaRuang = data.sesisiswa.filter(s =>
                s.ruang_id === ruang.ruang_id &&
                s.sesi_id === ruang.sesi_id &&
                jadwal.bank.bank_kelas.includes(s.kelas_id?.toString()) &&
                !(jadwal?.bank?.soal_agama != '-' && jadwal?.bank?.soal_agama != '0' && jadwal?.bank?.soal_agama != s.siswa.agama)
            );
            const jumlahSiswa = siswaRuang.length;

            let belumLogin = 0, sedangLogin = 0, selesai = 0;
            siswaRuang.forEach(s => {
                const cbt = data.cbtsiswa.find(c =>
                    c.id_siswa === s.siswa_id &&
                    c.jadwal.id_jadwal === jadwal.id_jadwal
                );
                if (!cbt || cbt.mulai === null) {
                    belumLogin++;
                } else if (cbt.selesai === null) {
                    sedangLogin++;
                } else {
                    selesai++;
                }
            });
            const pengawasJadwal = data.pengawas[jadwal.id_jadwal]?.[ruang.ruang_id]?.[ruang.sesi_id] || {};
            const key = `${ruang.ruang_id}-${ruang.sesi_id}-${pengawasJadwal.jam_ke || '1'}`;
            if (!grouped[key]) {
                grouped[key] = {
                    key: key,
                    ruang_sesi: ruang,
                    jam_ke: pengawasJadwal.jam_ke || '1',
                    jadwal: [],
                    pengawas: [],
                    peserta: 0,
                    blm_login: 0,
                    sdg_login: 0,
                    selesai: 0
                };
            }
            grouped[key].jadwal.push(jadwal);
            const pengawasList = (pengawasJadwal.id_guru || '').split(',').filter(Boolean);
            for (const string of pengawasList) {
                if (!grouped[key].pengawas.includes(data.gurus[string] || '')) {
                    grouped[key].pengawas.push(data.gurus[string] || '');
                }
            }
            grouped[key].peserta += jumlahSiswa;
            grouped[key].blm_login += belumLogin;
            grouped[key].sdg_login += sedangLogin;
            grouped[key].selesai += selesai;
        });
    });
    return Object.values(grouped);
}

function calculateRowCounts(items, ...keys) {
    const counts = new Map();
    let prevValues = null;
    let currentCount = 0;

    const getValues = (item) => keys.map(key => {
        return key.split('.').reduce((obj, prop) => obj?.[prop], item);
    });

    [...items, null].forEach(item => {
        const currentValues = item ? getValues(item) : null;
        const isSameGroup = prevValues && currentValues &&
            prevValues.every((val, i) => val === currentValues[i]);

        if (!isSameGroup) {
            if (prevValues !== null) {
                const key = prevValues.join('-');
                counts.set(key, currentCount);
            }
            currentCount = 0;
        }
        if (item !== null) {
            currentCount++;
        }
        prevValues = currentValues;
    });

    return counts;
}

function buildTable(groupedSchedules, data, rowCounts, sesiRowCounts) {
    const headerHtml = `
    <thead style="background-color: #f1f5f9; color: #334155;">
        <tr style="font-size: 0.76rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.3px;">
            <th class="text-center align-middle border-end py-2 px-2" rowspan="2">RUANG</th>
            <th class="text-center align-middle border-end py-2 px-2" rowspan="2">SESI</th>
            <th class="text-center align-middle border-end py-2 px-2" rowspan="2">JAM KE</th>
            <th class="text-left align-middle border-end py-2 px-3" rowspan="2">MAPEL (BANK SOAL)</th>
            <th class="text-center align-middle border-end py-2 px-2" rowspan="2">KELAS</th>
            <th class="text-left align-middle border-end py-2 px-2" rowspan="2">PENGAWAS</th>
            <th class="text-center align-middle border-end py-2 px-2" rowspan="2">JML SISWA</th>
            <th class="text-center align-middle py-1 px-2 border-bottom" colspan="3">STATUS SISWA</th>
        </tr>
        <tr style="font-size: 0.72rem; font-weight: 700;">
            <th class="text-center align-middle text-danger border-end py-1 px-2">BLM LOGIN</th>
            <th class="text-center align-middle text-primary border-end py-1 px-2">SDG LOGIN</th>
            <th class="text-center align-middle text-success py-1 px-2">SELESAI</th>
        </tr>
    </thead>`;

    let bodyHtml = '<tbody style="font-size: 0.82rem;">';
    const usedRuangIds = new Set();
    const usedSesiKeys = new Set();

    groupedSchedules.forEach(group => {
        const { ruang_sesi, jam_ke, jadwal, pengawas, peserta, blm_login, sdg_login, selesai } = group;
        
        let infoMapel = ``;
        for (const jad of jadwal) {
            const mapelKode = jad.kode || jad.bank?.mapel?.kode || jad.nama_mapel || 'Mapel';
            const bankKode = jad.bank_kode || jad.bank?.bank_kode || '';
            infoMapel += `<div class="d-flex align-items-center flex-wrap gap-1 mb-1">
                <span class="fw-bold text-dark me-1">${mapelKode}</span>
                ${bankKode ? `<span class="badge bg-soft-primary text-primary border border-primary-subtle px-2 py-1" style="font-size:0.72rem;">${bankKode}</span>` : ''}
            </div>`;
        }

        const bank_kelas = getUniqueClassNames(ruang_sesi, jadwal).join(', ') || '-';
        const idsGuru = jadwal.map(j => j.bank_guru_id || j.bank?.bank_guru_id || '').join(',');

        bodyHtml += `<tr class="hover-bg-light transition-all">`;
        const ruangId = ruang_sesi.ruang_id;
        if (!usedRuangIds.has(ruangId)) {
            const rowspanValue = rowCounts.get(String(ruangId)) || 1;
            bodyHtml += `<td rowspan="${rowspanValue}" class="text-center align-middle fw-bold text-dark border-end bg-white" style="font-size: 0.84rem;">${ruang_sesi.nama_ruang}</td>`;
            usedRuangIds.add(ruangId);
        }

        const sesiKey = `${ruang_sesi.ruang_id}-${ruang_sesi.sesi_id}`;
        if (!usedSesiKeys.has(sesiKey)) {
            const rowspanValue = sesiRowCounts.get(sesiKey) || 1;
            bodyHtml += `<td rowspan="${rowspanValue}" class="text-center align-middle border-end fw-medium text-secondary bg-white">${ruang_sesi.nama_sesi}</td>`;
            usedSesiKeys.add(sesiKey);
        }

        const listPengawas = pengawas.filter(Boolean).length > 0 ? pengawas.filter(Boolean).join('<br>') : '<span class="text-muted fst-italic" style="font-size:0.78rem;">-</span>';

        bodyHtml += `
            <td class="text-center align-middle border-end fw-bold text-secondary">${jam_ke}</td>
            <td class="align-middle border-end px-3">${infoMapel}</td>
            <td class="text-center align-middle border-end"><span class="badge bg-soft-info text-info border px-2 py-1">${bank_kelas}</span></td>
            <td class="align-middle border-end px-2" style="font-size: 0.8rem; line-height: 1.3;" data-guru="${idsGuru}">${listPengawas}</td>
            <td class="text-center align-middle border-end fw-bold text-dark" style="font-size: 0.88rem;">${peserta}</td>
            <td class="text-center align-middle border-end"><span class="badge bg-soft-danger text-danger font-weight-bold px-2 py-1" style="font-size: 0.8rem;">${blm_login}</span></td>
            <td class="text-center align-middle border-end"><span class="badge bg-soft-primary text-primary font-weight-bold px-2 py-1" style="font-size: 0.8rem;">${sdg_login}</span></td>
            <td class="text-center align-middle"><span class="badge bg-soft-success text-success font-weight-bold px-2 py-1" style="font-size: 0.8rem;">${selesai}</span></td>
        </tr>`;
    });

    bodyHtml += '</tbody>';
    return `<div class="table-responsive rounded-3 border shadow-sm"><table class="table table-bordered align-middle mb-0 w-100">${headerHtml}${bodyHtml}</table></div>`;
}

function getUniqueClassNames(ruang_sesi, jadwal) {
    const banks_kelas = [];
    const classIds = ruang_sesi.kelas_id || [];
    for (const j of jadwal) {
        const bKelas = j.bank_kelas || j.bank?.bank_kelas || [];
        for (const klsId of classIds) {
            if (bKelas.includes(String(klsId))) {
                const nama = ruang_sesi.nama_kelas?.[klsId] || klsId;
                if (nama && !banks_kelas.includes(nama)) {
                    banks_kelas.push(nama);
                }
            }
        }
    }
    if (banks_kelas.length === 0 && classIds.length > 0) {
        classIds.forEach(id => {
            const nama = ruang_sesi.nama_kelas?.[id] || id;
            if (nama && !banks_kelas.includes(nama)) banks_kelas.push(nama);
        });
    }
    return [...new Set(banks_kelas)];
}

function formatTanggal(dateString) {
    if (!dateString) return '-';
    const date = new Date(dateString);
    if (isNaN(date.getTime())) return dateString;
    const options = { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' };
    return date.toLocaleDateString('id-ID', options);
}

function createTime(d) {
    if (!d) return '';
    var date = new Date(d);
    if (isNaN(date.getTime())) return d;
    var jam = date.getHours();
    var menit = date.getMinutes();
    var sJam = jam < 10 ? '0' + jam : '' + jam;
    var sMenit = menit < 10 ? '0' + menit : '' + menit;
    var hari = daysdifference(d);
    var time;
    if (hari === 0) {
        time = sJam + ':' + sMenit;
    } else if (hari === 1) {
        time = 'kemarin ' + sJam + ':' + sMenit;
    } else {
        time = (jQuery.timeago ? jQuery.timeago(d) : formatTanggal(d)) + ', ' + sJam + ':' + sMenit;
    }
    return time;
}

function daysdifference(last) {
    var startDay = new Date(last);
    var endDay = new Date();
    var millisBetween = startDay.getTime() - endDay.getTime();
    var days = millisBetween / (1000 * 3600 * 24);
    return Math.round(Math.abs(days));
}

function addComments(id, comments, append) {
    if (!comments) return;
    if (!Array.isArray(comments)) comments = [comments];
    var comm = '';
    $.each(comments, function(i, v) {
        var dari, foto, avatar;
        if (v.dari == '0') {
            dari = 'Admin';
            avatar = v.foto != null ? '<img class="img-circle border" src="' + v.foto + '" alt="Img" width="40px" height="40px">' :
                '<div class="btn-circle-sm btn-success media-left pt-1" style="width: 43px; height: 40px">A</div>';
        } else {
            if (v.dari_group == '2') {
                dari = v.nama_guru || 'Guru';
                foto = v.foto != null ? base_url + v.foto : base_url + 'assets/img/guru.png';
                avatar = '<img class="img-circle border" src="' + foto + '" alt="Img" width="40px" height="40px">';
            } else {
                dari = v.nama_siswa || 'Siswa';
                foto = v.foto_siswa != null ? base_url + v.foto_siswa : base_url + 'assets/img/siswa.png';
                avatar = '<img class="img-circle border" src="' + foto + '" alt="Img" width="40px" height="40px">';
            }
        }

        comm += '<div class="media mt-1" id="parent-reply' + v.id_comment + '">' +
            avatar +
            '     <div class="w-100 ml-2">' +
            '         <div class="media-body border pl-3 bg-light" style="border-radius: 20px">' +
            '             <span class="text-xs text-muted"><b>' + dari + '</b></span>' +
            '             <div class="comment-text pb-1">' + v.text + '</div>' +
            '         </div>' +
            '         <div class="ml-2">' +
            '             <span class="btn-sm mr-2 text-muted">' + createTime(v.tanggal) + '</span>' +
            '             <span id="trigger-reply' + v.id_comment + '" class="btn btn-sm mr-2 text-muted action-collapse" data-toggle="collapse" data-bs-toggle="collapse" aria-expanded="true" aria-controls="collapse-reply' + v.id_comment + '" href="#collapse-reply' + v.id_comment + '"><b>' + (v.jml || 0) + ' balasan</b></span>' +
            '             <span class="btn btn-sm mr-2 text-muted btn-toggle-reply" data-id="' + v.id_comment + '" data-toggle="modal" data-bs-toggle="modal" data-target="#balasanModal" data-bs-target="#balasanModal">' +
            '                 <i class="fas fa-reply"></i>  <b>Balas</b></span>' +
            '             <span class="btn btn-sm text-muted" onclick="hapusKomentar(' + v.id_comment + ')" data-id="' + v.id_comment + '"><i class="fa fa-trash mr-1"></i> Hapus</span>' +
            '         </div>' +
            '         <div id="collapse-reply' + v.id_comment + '" class="p-2 collapse toggle-reply" data-id="' + v.id_comment + '" data-parent="#parent-reply' + v.id_comment + '">';
        if (v.jml != '0' && v.jml) {
            comm += '     <div id="konten-reply' + v.id_comment + '"></div>' +
                '         <div id="loadmore-reply' + v.id_comment + '" onclick="getReplies(' + v.id_comment + ')" class="text-center mb-3 loadmore-reply">' +
                '             <div class="btn btn-default btn-sm border">Muat balasan lainnya...</div>' +
                '         </div>';
        } else {
            comm += '     <div class="text-center text-muted" id="empty-comment" style="font-size: 0.85rem;">Tidak ada balasan</div>';
        }
        comm += '         <div id="loading-reply' + v.id_comment + '" class="text-center d-none">' +
            '             <div class="spinner-grow spinner-grow-sm text-primary"></div>' +
            '         </div>' +
            '     </div>' +
            '     </div>' +
            ' </div>';
    });

    if (append) {
        $(`#konten${id}`).append(comm);
    } else {
        $(`#konten${id}`).prepend(comm);
    }

    $('.toggle-reply').off('shown.bs.collapse').on('shown.bs.collapse', function(e) {
        var konten = $(this);
        var id = konten.data('id');
        var list = $(this).find('.media').length;
        if (list === 0) $(`#loadmore-reply${id}`).click();
    });

    $('#empty-comment').remove();
}

function addReplies(id, replies, append) {
    if (!replies) return;
    if (!Array.isArray(replies)) replies = [replies];
    var repl = '';
    $.each(replies, function(i, v) {
        var sudahAda = $(`.media${v.id_reply}`).length;
        if (!sudahAda) {
            var dari, foto, avatar;
            if (v.dari == '0') {
                dari = 'Admin';
                avatar = v.foto != null ? '<img class="img-circle border" src="' + v.foto + '" alt="Img" width="35px" height="35px">' :
                    '<div class="btn-circle-sm btn-success media-left pt-1 mr-2" style="width: 37px">A</div>';
            } else {
                if (v.dari_group == '2') {
                    dari = v.nama_guru || 'Guru';
                    foto = v.foto != null ? base_url + v.foto : base_url + 'assets/img/guru.png';
                    avatar = '<img class="img-circle border" src="' + foto + '" alt="Img" width="35px" height="35px">';
                } else {
                    dari = v.nama_siswa || 'Siswa';
                    foto = v.foto_siswa != null ? base_url + v.foto_siswa : base_url + 'assets/img/siswa.png';
                    avatar = '<img class="img-circle border" src="' + foto + '" alt="Img" width="35px" height="35px">';
                }
            }

            repl += '<div class="media mt-1 media' + v.id_reply + '">' +
                avatar +
                '     <div class="w-100 ml-2">' +
                '         <div class="media-body border pl-3" style="border-radius: 17px; background-color: #dee2e6">' +
                '             <span class="text-xs text-muted"><b>' + dari + '</b></span>' +
                '             <div class="comment-text">' + v.text + '</div>' +
                '         </div>' +
                '         <div class="ml-2">' +
                '             <small class="btn-sm mr-2 text-muted">' + createTime(v.tanggal) + '</small>' +
                '             <span class="btn btn-sm text-muted" onclick="hapusReply(' + v.id_reply + ')" data-id="' + v.id_reply + '">' +
                '                 <i class="fa fa-trash mr-1"></i> Hapus' +
                '             </span>' +
                '         </div>' +
                '     </div>' +
                ' </div>';
        }
    });

    if (append) {
        $(`#konten-reply${id}`).append(repl);
    } else {
        $(`#konten-reply${id}`).prepend(repl);
    }
}

function getComments(id) {
    $(`#loading${id}`).removeClass('d-none');
    $(`#loadmore${id}`).addClass('d-none');
    var $count = $(`#loadmore${id}`), page = $count.data('count');
    if (!page) page = 0;

    setTimeout(function() {
        $.ajax({
            url: base_url + "pengumuman/getcomment/" + id + "/" + page,
            type: "GET",
            success: function(response) {
                page += 1;
                $count.data('count', page);
                if (response.length === 5) {
                    $(`#loadmore${id}`).removeClass('d-none');
                }
                $(`#loading${id}`).addClass('d-none');
                addComments(id, response, true);
            },
            error: function(xhr, status, error) {
                console.error("error", xhr.responseText);
                $(`#loading${id}`).addClass('d-none');
            }
        });
    }, 400);
}

function getReplies(id) {
    $(`#loading-reply${id}`).removeClass('d-none');
    $(`#loadmore-reply${id}`).addClass('d-none');
    var $count = $(`#loadmore-reply${id}`), page = $count.data('count');
    if (!page) page = 0;

    setTimeout(function() {
        $.ajax({
            url: base_url + "pengumuman/getreplies/" + id + "/" + page,
            type: "GET",
            success: function(response) {
                page += 1;
                $count.data('count', page);
                if (response.length === 5) {
                    $(`#loadmore-reply${id}`).removeClass('d-none');
                }
                $(`#loading-reply${id}`).addClass('d-none');
                addReplies(id, response, true);
            },
            error: function(xhr, status, error) {
                console.error("error", xhr.responseText);
                $(`#loading-reply${id}`).addClass('d-none');
            }
        });
    }, 400);
}

function addPosts(response) {
    var card = '';

    if (response && response.length > 0) {
        $.each(response, function(i, v) {
            var dari, foto, avatar;
            if (v.dari == '0') {
                dari = 'Admin';
                avatar = v.foto != null ? '<img class="img-circle border" src="' + v.foto + '" alt="Img" width="50px" height="50px">' :
                    '<div class="btn-circle btn-success media-left pt-1 align-middle text-center" style="width:50px;height:50px;line-height:50px;border-radius:50%;color:#fff;font-weight:bold;">A</div>';
            } else {
                if (v.dari_group == '2') {
                    dari = v.nama_guru || 'Guru';
                    foto = v.foto != null ? base_url + v.foto : base_url + 'assets/img/guru.png';
                    avatar = '<img class="img-circle border" src="' + foto + '" alt="Img" width="50px" height="50px" onerror="this.onerror=null; this.src=\''+base_url+'assets/img/guru.png\';">';
                } else {
                    dari = v.nama_siswa || 'Siswa';
                    foto = v.foto_siswa != null ? base_url + v.foto_siswa : base_url + 'assets/img/siswa.png';
                    avatar = '<img class="img-circle border" src="' + foto + '" alt="Img" width="50px" height="50px" onerror="this.onerror=null; this.src=\''+base_url+'assets/img/siswa.png\';">';
                }
            }

            card += '<div class="card card-default mb-3 border shadow-sm" style="border-radius: 15px;">' +
                '     <div class="card-body" id="parent' + v.id_post + '">' +
                '         <div class="media d-flex align-items-center mb-2">' +
                avatar +
                '                 <div class="media-body ml-3 ms-3">' +
                '                     <span class="font-weight-bold"><b>' + dari + '</b></span>' +
                '                     <br/>' +
                '                     <small class="text-gray text-muted">' + createTime(v.tanggal) + '</small>' +
                '                 </div>' +
                '         </div>' +
                '         <div class="mt-2 mb-3">' + (v.text || '') + '</div>' +
                '         <div class="text-muted d-flex gap-2 flex-wrap">' +
                '             <button type="button" class="btn btn-primary btn-sm mr-2 btn-toggle"' +
                '                    data-id="' + v.id_post + '" data-toggle="modal" data-bs-toggle="modal"' +
                '                    data-target="#komentarModal" data-bs-target="#komentarModal"><i class="fas fa-reply mr-1"></i> Tulis komentar' +
                '             </button>' +
                '             <button type="button" id="trigger' + v.id_post + '"' +
                '                    class="btn btn-success btn-sm mr-2 action-collapse"' +
                '                    data-toggle="collapse" data-bs-toggle="collapse" aria-expanded="true"' +
                '                    aria-controls="collapse-' + v.id_post + '"' +
                '                    href="#collapse-' + v.id_post + '">' +
                '                 <i class="fa fa-commenting-o mr-1"></i><b>' + (v.jml || 0) + '</b> komentar' +
                '             </button>' +
                '             <button type="button" class="btn btn-danger btn-sm ms-auto" onclick="hapusPost(' + v.id_post + ')" data-id="' + v.id_post + '">' +
                '                 <i class="fa fa-trash mr-1"></i> Hapus' +
                '             </button>' +
                '         </div>' +
                '     </div>' +
                '     <div id="collapse-' + v.id_post + '" class="p-2 collapse toggle-comment border-top bg-light"' +
                '         data-id="' + v.id_post + '" data-parent="#parent' + v.id_post + '">' +
                '         <div id="konten' + v.id_post + '" class="p-3">' +
                '         </div>' +
                '         <div id="loading' + v.id_post + '" class="text-center d-none py-2">' +
                '             <div class="spinner-grow spinner-grow-sm text-primary"></div>' +
                '         </div>';
            if (v.jml == '0' || !v.jml) {
                card += ' <div class="text-center py-2 text-muted" id="empty-comment" style="font-size:0.85rem;">Tidak ada komentar</div>';
            } else {
                card += ' <div id="loadmore' + v.id_post + '"' +
                    '     onclick="getComments(' + v.id_post + ')"' +
                    '     class="text-center mt-2 mb-2 loadmore">' +
                    '     <div class="btn btn-default btn-sm border bg-white shadow-sm">Muat komentar lainnya...</div>' +
                    ' </div>';
            }
            card += ' </div>' +
                ' </div>';
        });
    } else {
        card = '<div class="py-4 text-center text-muted">' +
            '  <iconify-icon icon="lucide:megaphone" width="40" height="40" style="display: inline-block; margin-bottom: 8px; opacity: 0.5;"></iconify-icon>' +
            '  <p class="mb-0" style="font-size: 0.88rem;">Tidak ada pengumuman hari ini</p>' +
            ' </div>';
    }

    $('#pengumuman').html(card);

    $('.toggle-comment').off('shown.bs.collapse').on('shown.bs.collapse', function(e) {
        var konten = $(this);
        var id = konten.data('id');
        var list = $(this).find('.media').length;
        if (list === 0) $(`#loadmore${id}`).click();
    });

    $('#komentarModal').off('show.bs.modal').on('show.bs.modal', function(e) {
        var id = $(e.relatedTarget).data('id');
        $("#id-post").val(id);
        var isVisible = $(`#collapse-${id}`).hasClass('show');
        if (!isVisible) {
            $(`#trigger${id}`).click();
        }
    });

    $('#balasanModal').off('show.bs.modal').on('show.bs.modal', function(e) {
        var id = $(e.relatedTarget).data('id');
        $("#id-comment").val(id);
        var isVisible = $(`#collapse-reply${id}`).hasClass('show');
        if (!isVisible) {
            $(`#trigger-reply${id}`).click();
        }
    });

    $('#komentar').off('submit').on('submit', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        var id = $(this).find('input[name=id_post]').val();
        $.ajax({
            url: base_url + "pengumuman/savekomentar",
            data: $(this).serialize(),
            method: 'POST',
            dataType: "JSON",
            success: function(response) {
                $('#komentarModal').modal('hide');
                addComments(id, response, false);
            },
            error: function(xhr, status, error) {
                $('#komentarModal').modal('hide');
                if (typeof showDangerToast === 'function') showDangerToast('Error, komentar tidak terkirim');
            }
        });
    });

    $('#balasan').off('submit').on('submit', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        var id = $(this).find('input[name=id_comment]').val();
        $.ajax({
            url: base_url + "pengumuman/savebalasan",
            data: $(this).serialize(),
            method: 'POST',
            dataType: "JSON",
            success: function(response) {
                $('#balasanModal').modal('hide');
                addReplies(id, response, false);
            },
            error: function(xhr, status, error) {
                $('#balasanModal').modal('hide');
                if (typeof showDangerToast === 'function') showDangerToast('Error, balasan tidak terkirim');
            }
        });
    });
}

function getPosts() {
    $(`#loading-post`).removeClass('d-none');
    $(`#loadmore-post`).addClass('d-none');

    setTimeout(function() {
        $.ajax({
            url: base_url + "pengumuman/getpost/" + halaman,
            type: "GET",
            success: function(response) {
                halaman += 1;
                if (response && response.length === 5) {
                    $(`#loadmore-post`).removeClass('d-none');
                }
                $(`#loading-post`).addClass('d-none');
                addPosts(response);
            },
            error: function(xhr, status, error) {
                console.error("error", xhr.responseText);
                $(`#loading-post`).addClass('d-none');
            }
        });
    }, 400);
}

function hapusPost(idPost) {
    if (typeof swal !== 'undefined' && swal.fire) {
        swal.fire({
            title: "Hapus Pengumuman",
            text: "Pengumuman ini akan dihapus",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "HAPUS",
            confirmButtonColor: '#dc3545'
        }).then(result => {
            if (result.value) {
                $.ajax({
                    url: base_url + "pengumuman/hapuspost/" + idPost,
                    type: "GET",
                    success: function(data) {
                        if (data) {
                            swal.fire({
                                title: "Sukses",
                                text: "Pengumuman dihapus",
                                icon: "success",
                                showCancelButton: false,
                            }).then(result => {
                                window.location.reload();
                            });
                        } else {
                            swal.fire("ERROR", "Pengumuman tidak dihapus", "error");
                        }
                    },
                    error: function(xhr, status, error) {
                        swal.fire("ERROR", "Pengumuman tidak dihapus", "error");
                    }
                });
            }
        });
    } else {
        if (confirm("Hapus pengumuman ini?")) {
            $.ajax({
                url: base_url + "pengumuman/hapuspost/" + idPost,
                type: "GET",
                success: function() { window.location.reload(); }
            });
        }
    }
}

function hapusKomentar(idKomentar) {
    if (typeof swal !== 'undefined' && swal.fire) {
        swal.fire({
            title: "Hapus Komentar",
            text: "Komentar ini akan dihapus",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "HAPUS",
            confirmButtonColor: '#dc3545'
        }).then(result => {
            if (result.value) {
                $.ajax({
                    url: base_url + "pengumuman/hapuskomentar/" + idKomentar,
                    type: "GET",
                    success: function(data) {
                        if (data) {
                            $(`#parent-reply${idKomentar}`).remove();
                            if (typeof showSuccessToast === 'function') showSuccessToast('Komentar dihapus');
                        } else {
                            swal.fire("ERROR", "Komentar tidak dihapus", "error");
                        }
                    }
                });
            }
        });
    } else {
        if (confirm("Hapus komentar ini?")) {
            $.ajax({
                url: base_url + "pengumuman/hapuskomentar/" + idKomentar,
                type: "GET",
                success: function() { $(`#parent-reply${idKomentar}`).remove(); }
            });
        }
    }
}

function hapusReply(idReply) {
    if (typeof swal !== 'undefined' && swal.fire) {
        swal.fire({
            title: "Hapus Balasan",
            text: "Balasan ini akan dihapus",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "HAPUS",
            confirmButtonColor: '#dc3545'
        }).then(result => {
            if (result.value) {
                $.ajax({
                    url: base_url + "pengumuman/hapusbalasan/" + idReply,
                    type: "GET",
                    success: function(data) {
                        if (data) {
                            $(`.media${idReply}`).remove();
                            if (typeof showSuccessToast === 'function') showSuccessToast('Balasan dihapus');
                        } else {
                            swal.fire("ERROR", "Balasan tidak dihapus", "error");
                        }
                    }
                });
            }
        });
    } else {
        if (confirm("Hapus balasan ini?")) {
            $.ajax({
                url: base_url + "pengumuman/hapusbalasan/" + idReply,
                type: "GET",
                success: function() { $(`.media${idReply}`).remove(); }
            });
        }
    }
}

function hapusLogAktivitas() {
    if (typeof swal !== 'undefined' && swal.fire) {
        swal.fire({
            title: "Hapus Log Aktivitas",
            text: "Apakah Anda yakin ingin menghapus semua log aktivitas?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            confirmButtonColor: '#dc3545'
        }).then(result => {
            if (result.value || result.isConfirmed) {
                $.ajax({
                    url: base_url + "dashboard/hapuslog/all",
                    type: "GET",
                    success: function(data) {
                        if (data && data.status) {
                            swal.fire({
                                title: "Sukses",
                                text: "Semua log aktivitas berhasil dihapus",
                                icon: "success"
                            }).then(() => {
                                load_log();
                            });
                        } else {
                            swal.fire("Gagal", "Gagal menghapus log", "error");
                        }
                    },
                    error: function() {
                        swal.fire("Gagal", "Gagal menghapus log", "error");
                    }
                });
            }
        });
    } else {
        if (confirm("Hapus semua log aktivitas?")) {
            $.ajax({
                url: base_url + "datalogs/hapuslog/all",
                type: "GET",
                success: function() { load_log(); }
            });
        }
    }
}

$(document).ready(async function() {
    if (typeof ajaxcsrf === 'function') ajaxcsrf();

    var badgeTypes = {
        '0': 'primary', '1': 'success', '2': 'info', '3': 'warning', '4': 'danger',
        '5': 'secondary', '6': 'primary', '7': 'success', '8': 'info'
    };

    function load_log() {
        $.ajax({
            url: base_url + "datalogs/getlog",
            data: {
                page: 1,
                limit: 15,
                filter: ['1', '2', '3'],
                search: ''
            },
            method: "GET",
            success: function(data) {
                if (data && data.logs && data.logs.length > 0) {
                    var html = '<ul class="list-group list-group-flush mb-0">';
                    $.each(data.logs, function(key, value) {
                        var nama_lengkap = value?.first_name === value?.last_name ?
                            value?.first_name : ((value?.first_name || '') + ' ' + (value?.last_name || ''));
                        var nama = (value.id_group === '1' ? value.first_name : nama_lengkap) || 'User';
                        var clr = badgeTypes[value.log_type] || 'primary';
                        var tgl = formatTanggal(value.log_time);
                        
                        const guru = data.guru ? data.guru.find(g => (g.id == value.id_user || g.id_user == value.id_user)) : null;
                        const siswa = data.siswa ? data.siswa.find(s => (s.id == value.id_user || s.id_user == value.id_user)) : null;
                        const admin = data.admins ? data.admins.find(a => (a.id == value.id_user || a.id_user == value.id_user)) : null;
                        
                        const fotoUser = guru?.foto || siswa?.foto || admin?.foto || null;
                        const foto = fotoUser ? (base_url + fotoUser.replace(/^\/+/, '')) : null;
                        const initial = nama.trim().charAt(0).toUpperCase();

                        html += '<li class="list-group-item p-3 border-bottom hover-bg-light transition-all">' +
                            '  <div class="d-flex align-items-center">' +
                            '    <div class="position-relative me-3 flex-shrink-0" style="width: 44px; height: 44px;">';
                        
                        if (foto) {
                            html += '      <img class="rounded-circle border shadow-sm object-fit-cover w-100 h-100" src="' + foto + '" alt="" onerror="this.style.display=\'none\'; this.nextElementSibling.classList.remove(\'d-none\');"/>' +
                                '      <div class="rounded-circle bg-soft-' + clr + ' text-' + clr + ' fw-bold d-none align-items-center justify-content-center shadow-sm w-100 h-100" style="font-size: 1.1rem;">' + initial + '</div>';
                        } else {
                            html += '      <div class="rounded-circle bg-soft-' + clr + ' text-' + clr + ' fw-bold d-flex align-items-center justify-content-center shadow-sm w-100 h-100" style="font-size: 1.1rem;">' + initial + '</div>';
                        }

                        html += '    </div>' +
                            '    <div class="flex-grow-1 min-w-0 ms-2">' +
                            '      <div class="d-flex justify-content-between align-items-center mb-1">' +
                            '        <h6 class="fw-bold mb-0 text-dark text-truncate" style="font-size: 0.88rem;">' + nama + '</h6>' +
                            '        <small class="text-muted text-nowrap ms-2" style="font-size: 0.72rem;"><i class="far fa-clock me-1"></i>' + tgl + '</small>' +
                            '      </div>' +
                            '      <div class="text-' + clr + ' fw-medium" style="font-size: 0.82rem; line-height: 1.35;">' + (value.log_desc || 'Aktivitas pengguna') + '</div>' +
                            '    </div>' +
                            '  </div>' +
                            '</li>';
                    });
                    html += '</ul>';
                    $('#log-list').html(html);
                } else {
                    $('#log-list').html('<div class="text-center py-4 text-muted"><iconify-icon icon="lucide:history" width="40" height="40" style="display: block; margin: 0 auto 8px auto; opacity: 0.5;"></iconify-icon><p class="mb-0" style="font-size: 0.85rem;">Tidak ada aktifitas</p></div>');
                }
            },
            error: function() {
                $('#log-list').html('<div class="text-center py-4 text-muted"><iconify-icon icon="lucide:alert-circle" width="40" height="40" class="text-warning" style="display: block; margin: 0 auto 8px auto;"></iconify-icon><p class="mb-0" style="font-size: 0.85rem;">Gagal memuat aktifitas</p></div>');
            }
        });
    }

    load_log();
    getPosts();

    if (typeof getToken === 'function') {
        getToken();
    }

    try {
        const response = await ajaxGet('dashboard/get_status_siswa');
        await createTableFromJSON(response);
    } catch(e) {
        console.log('Error fetching status siswa', e);
    }
});
</script>
<?= $this->endSection() ?>
