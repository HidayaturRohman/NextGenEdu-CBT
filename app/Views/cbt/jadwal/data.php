<?= $this->extend('layout/dashboard_template_bs5') ?>

<?= $this->section('content') ?>
<?php
$isNurulHakim = (strpos($_SERVER['HTTP_HOST'] ?? '', 'nurulhakim.sch.id') !== false || strpos(base_url(), 'nurulhakim.sch.id') !== false);
$isAdmin = isset($is_admin) ? $is_admin : ((string)session()->get('role') === '1');
// Flatten jadwals array for KPI statistics and quick access
$flatJadwals = [];
if (isset($jadwals) && is_array($jadwals)) {
    foreach ($jadwals as $title => $arrjadwal) {
        if (is_array($arrjadwal)) {
            foreach ($arrjadwal as $lvl => $sjadwal) {
                if (is_array($sjadwal)) {
                    foreach ($sjadwal as $jdw) {
                        $flatJadwals[] = $jdw;
                    }
                }
            }
        }
    }
}

$today = strtotime(date('Y-m-d'));
$totalJadwalCount = count($flatJadwals);
$countSedang = 0;
$countBelum = 0;
$countSelesai = 0;
$countNonAktif = 0;

foreach ($flatJadwals as $jdw) {
    $sDay = strtotime($jdw->tgl_mulai ?? '');
    $eDay = strtotime($jdw->tgl_selesai ?? '');
    if ($jdw->status == '0') {
        $countNonAktif++;
    } else {
        if ($today < $sDay) {
            $countBelum++;
        } elseif ($today > $eDay) {
            $countSelesai++;
        } else {
            $countSedang++;
        }
    }
}
?>

<style>
    .jadwal-kpi-card {
        border: 1px solid rgba(16, 185, 129, 0.15) !important;
        border-radius: 12px;
        background: #ffffff;
        transition: all 0.2s ease;
    }
    .jadwal-kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
    }
    .card-bank-soal {
        border: 1px solid #cbd5e1 !important;
        border-radius: 12px !important;
        background: #ffffff;
        box-shadow: 0 3px 12px rgba(15, 23, 42, 0.05);
        transition: all 0.2s ease;
        overflow: hidden;
    }
    .card-bank-soal:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.09);
        border-color: #94a3b8 !important;
    }
    .badge-kelas {
        background: #e2e8f0 !important;
        color: #0f172a !important;
        border: 1px solid #cbd5e1 !important;
        font-weight: 600;
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
        display: inline-block;
    }
    .table-modern thead th {
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-weight: 600 !important;
        font-size: 0.85rem !important;
        border-bottom: 2px solid #e2e8f0 !important;
    }
    .jadwal-filter-card {
        background: #f8fafc;
        border: 1px solid #cbd5e1 !important;
        border-radius: 12px;
        padding: 16px;
    }
    .jadwal-filter-card .select2-container--default .select2-selection--single {
        height: 40px !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        display: flex !important;
        align-items: center !important;
        padding-left: 8px !important;
        background-color: #ffffff !important;
    }
    .jadwal-filter-card .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 38px !important;
        color: #1e293b !important;
        font-size: 0.88rem !important;
    }
    .jadwal-filter-card .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px !important;
        right: 8px !important;
    }
    .jadwal-filter-card .input-group {
        display: flex !important;
        flex-wrap: nowrap !important;
        height: 40px !important;
    }
    .jadwal-filter-card .input-group-text {
        height: 40px !important;
        border: 1px solid #cbd5e1 !important;
        border-right: none !important;
        background: #ffffff !important;
        border-top-left-radius: 8px !important;
        border-bottom-left-radius: 8px !important;
    }
    .jadwal-filter-card #searchJadwalInput {
        height: 40px !important;
        border: 1px solid #cbd5e1 !important;
        border-left: none !important;
        border-top-right-radius: 8px !important;
        border-bottom-right-radius: 8px !important;
        font-size: 0.88rem !important;
    }
    .jadwal-filter-card #searchJadwalInput:focus {
        border-color: #10b981 !important;
        box-shadow: none !important;
    }
    .jadwal-filter-card .input-group:focus-within .input-group-text {
        border-color: #10b981 !important;
        color: #10b981 !important;
    }
    .legend-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 500;
        background: #ffffff;
        border: 1px solid #cbd5e1;
        color: #334155;
    }
    .legend-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
    }
    .card-bank-header {
        padding: 14px 22px !important;
        min-height: 62px;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .card-bank-header .bank-title-box {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
        margin-right: 12px;
    }
    .card-bank-header .bank-actions-box {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }
    .card-bank-item-row {
        padding: 12px 20px !important;
        border-bottom: 1px solid #e2e8f0 !important;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .card-bank-footer {
        padding: 14px 20px !important;
        background-color: #ffffff;
        border-top: 1px solid #e2e8f0;
    }
    .list-group-flush > .list-group-item {
        border-bottom: 1px solid #e2e8f0 !important;
    }
    .list-group-flush > .list-group-item:last-child {
        border-bottom: none !important;
    }
</style>

<div class="d-contents">
    <!-- Header Banner -->
    <div class="card mb-4 border shadow-sm" style="border-radius: 12px; border-color: #cbd5e1 !important;">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 w-100">
          <div class="d-flex align-items-center min-w-0" style="flex: 1 1 280px;">
            <div class="me-3 flex-shrink-0">
              <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 48px; height: 48px; background: linear-gradient(135deg, #10b981 0%, #047857 100%); color: #ffffff;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                  <line x1="16" y1="2" x2="16" y2="6"></line>
                  <line x1="8" y1="2" x2="8" y2="6"></line>
                  <line x1="3" y1="10" x2="21" y2="10"></line>
                  <polyline points="12 14 14 16 18 12"></polyline>
                </svg>
              </div>
            </div>
            <div class="min-w-0">
              <h4 class="card-title mb-1 fw-bold text-dark text-truncate">
                  <?= $judul ?>
              </h4>
              <p class="text-muted mb-0 text-truncate" style="font-size: 0.86rem;">
                  Kelola jadwal rilis dan durasi pelaksanaan ujian siswa.
              </p>
            </div>
          </div>
          <div class="d-flex align-items-center justify-content-end flex-wrap gap-2 flex-shrink-0">
            <a href="<?= base_url('cbtjadwal?mode=' . $mode) ?>" class="btn btn-sm btn-secondary shadow-sm d-inline-flex align-items-center text-nowrap" style="height: 38px; padding: 0.35rem 0.85rem; font-weight: 500; font-size: 0.84rem; border-radius: 8px; gap: 6px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.92-10.26l5.08 5.08"></path></svg> Reload
            </a>
            <?php if ($isAdmin): ?>
            <a href="<?= base_url('cbtjadwal/add/0') ?>" class="btn btn-sm btn-primary shadow-sm d-inline-flex align-items-center text-nowrap" style="height: 38px; padding: 0.35rem 0.85rem; font-weight: 500; font-size: 0.84rem; border-radius: 8px; gap: 6px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Tambah Jadwal
            </a>
            <?php endif; ?>
            <div class="btn-group shadow-sm ms-1" role="group">
                <?php $activeTable = $mode == '1' ? ' active btn-primary' : ' btn-outline-primary'; ?>
                <?php $activeGrid = $mode == '2' ? ' active btn-primary' : ' btn-outline-primary'; ?>
                <a href="<?= base_url('cbtjadwal?mode=1') ?>" class="btn btn-sm<?= $activeTable ?> d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px; padding: 0;" title="Tampilan Tabel">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
                </a>
                <a href="<?= base_url('cbtjadwal?mode=2') ?>" class="btn btn-sm<?= $activeGrid ?> d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px; padding: 0;" title="Tampilan Kartu">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- KPI Ringkasan Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card kpi-pastel-card kpi-pastel-blue border-0 shadow-sm h-100">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="kpi-pastel-icon me-3">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    </div>
                    <div class="min-w-0">
                        <div class="kpi-pastel-title small">Total Jadwal Ujian</div>
                        <div class="fs-4 fw-bold kpi-pastel-value"><?= $totalJadwalCount ?></div>
                        <div class="kpi-pastel-sub text-truncate" style="font-size: 0.72rem;">Semua mata pelajaran</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card kpi-pastel-card kpi-pastel-amber border-0 shadow-sm h-100">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="kpi-pastel-icon me-3">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                    </div>
                    <div class="min-w-0">
                        <div class="kpi-pastel-title small">Sedang Dilaksanakan</div>
                        <div class="fs-4 fw-bold kpi-pastel-value"><?= $countSedang ?></div>
                        <div class="kpi-pastel-sub text-truncate" style="font-size: 0.72rem;">Ujian aktif hari ini</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card kpi-pastel-card kpi-pastel-red border-0 shadow-sm h-100">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="kpi-pastel-icon me-3">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    </div>
                    <div class="min-w-0">
                        <div class="kpi-pastel-title small">Belum Dimulai</div>
                        <div class="fs-4 fw-bold kpi-pastel-value"><?= $countBelum ?></div>
                        <div class="kpi-pastel-sub text-truncate" style="font-size: 0.72rem;">Jadwal mendatang</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card kpi-pastel-card kpi-pastel-green border-0 shadow-sm h-100">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="kpi-pastel-icon me-3">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </div>
                    <div class="min-w-0">
                        <div class="kpi-pastel-title small">Selesai Pelaksanaan</div>
                        <div class="fs-4 fw-bold kpi-pastel-value"><?= $countSelesai ?></div>
                        <div class="kpi-pastel-sub text-truncate" style="font-size: 0.72rem;">Pelaksanaan tuntas</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter, Legend & Bulk Action Toolbar Card -->
    <div class="jadwal-filter-card mb-4 shadow-sm">
        <!-- Top Row: Legend & Live Search -->
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 pb-3 mb-3 border-bottom">
            <div class="d-flex flex-wrap align-items-center gap-2">
                <span class="small fw-bold text-dark me-1">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1 text-primary"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle><line x1="4.93" y1="4.93" x2="9.17" y2="9.17"></line><line x1="14.83" y1="14.83" x2="19.07" y2="19.07"></line><line x1="14.83" y1="9.17" x2="19.07" y2="4.93"></line><line x1="4.93" y1="19.07" x2="9.17" y2="14.83"></line></svg> Status Jadwal:
                </span>
                <span class="legend-pill" title="Jadwal sedang berlangsung hari ini">
                    <span class="legend-dot" style="background-color: #7c3aed;"></span>
                    <span>Sedang Dilaksanakan</span>
                </span>
                <span class="legend-pill" title="Ujian selesai dan nilai sudah direkap">
                    <span class="legend-dot" style="background-color: #059669;"></span>
                    <span>Selesai (Sudah Rekap)</span>
                </span>
                <span class="legend-pill" title="Ujian selesai namun nilai belum direkap">
                    <span class="legend-dot" style="background-color: #c026d3;"></span>
                    <span>Selesai (Belum Rekap)</span>
                </span>
                <span class="legend-pill" title="Tanggal ujian belum dimulai">
                    <span class="legend-dot" style="background-color: #e11d48;"></span>
                    <span>Belum Dimulai</span>
                </span>
                <span class="legend-pill" title="Jadwal ujian belum/tidak memiliki peserta">
                    <span class="legend-dot" style="background-color: #d97706;"></span>
                    <span>Tidak Digunakan</span>
                </span>
                <span class="legend-pill" title="Jadwal dinonaktifkan oleh administrator/guru">
                    <span class="legend-dot" style="background-color: #64748b;"></span>
                    <span>Tidak Aktif</span>
                </span>
            </div>
            <div class="flex-grow-1" style="max-width: 320px;">
                <div class="input-group">
                    <span class="input-group-text"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-muted"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></span>
                    <input type="text" id="searchJadwalInput" class="form-control" placeholder="Cari mapel, kode soal, jenis, kelas...">
                </div>
            </div>
        </div>

        <!-- Bottom Row: Dropdown Filters & Bulk Actions -->
        <div class="row g-3 align-items-center" id="row-filter">
            <div class="col-12 col-md-7">
                <div class="d-flex flex-wrap align-items-center gap-2">
                    <div style="min-width: 170px;">
                        <?= form_dropdown(
                            'f',
                            $filters,
                            $id_filter,
                            'id="filter" class="form-control select2"'
                        ); ?>
                    </div>
                    <div id="select-guru" class="d-none flex-grow-1" style="min-width: 200px;">
                        <?= form_dropdown(
                            'guru',
                            ['' => 'Pilih guru:'] + (isset($gurus) ? $gurus : []),
                            $id_guru,
                            'id="guru" class="sel form-control select2"'
                        ); ?>
                    </div>
                    <div id="select-mapel" class="d-none flex-grow-1" style="min-width: 200px;">
                        <?= form_dropdown(
                            'mapel',
                            ['' => 'Pilih mapel:'] + (isset($mapels) ? $mapels : []),
                            $id_mapel,
                            'id="mapel" class="sel form-control select2"'
                        ); ?>
                    </div>
                    <div id="select-level" class="d-none flex-grow-1" style="min-width: 200px;">
                        <?= form_dropdown(
                            'level',
                            ['' => 'Pilih level:'] + (isset($levels) ? $levels : []),
                            $id_level,
                            'id="level" class="sel form-control select2"'
                        ); ?>
                    </div>
                </div>
            </div>
            <?php if (!$isNurulHakim || $isAdmin): ?><div class="col-12 col-md-5 text-md-end">
                <?= form_open('', array('id' => 'hapus_semua', 'class' => 'd-inline-flex align-items-center gap-2')) ?>
                    <button id="submit-hapus" type="submit" class="btn btn-sm btn-outline-danger shadow-xs" disabled>
                        <svg class="me-1" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> Hapus Terpilih
                    </button>
                    <div class="d-flex align-items-center gap-1.5 bg-white border px-2.5 py-1.5 rounded-3 shadow-xs">
                        <label for="check-all" class="small fw-semibold text-muted mb-0 user-select-none" style="font-size: 0.78rem; cursor: pointer;">Pilih Semua</label>
                        <input class="form-check-input check-all m-0" id="check-all" type="checkbox" style="width: 18px; height: 18px; cursor: pointer;">
                    </div>
                <?= form_close() ?>
            </div><?php endif; ?>
        </div>
    </div>

    <!-- Main Content: Empty State or Items -->
    <?php if (count($jadwals) === 0) : ?>
        <?php if (!isset($tp_active) || !isset($smt_active)) : ?>
            <div class="alert alert-warning d-flex align-items-center p-3 rounded-3 shadow-sm border border-warning-subtle" role="alert">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-3 text-warning flex-shrink-0"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                <div>Tahun Pelajaran atau Semester belum di-set. Silakan atur pada data master.</div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning d-flex align-items-center p-3 rounded-3 shadow-sm border border-warning-subtle" role="alert">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-3 text-warning flex-shrink-0"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                <div>Belum ada jadwal penilaian untuk Tahun Pelajaran <b><?= $tp_active->tahun ?></b> Semester: <b><?= $smt_active->smt ?></b></div>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div id="konten-jadwal">
            <?php if ($mode == '1') : ?>
                <!-- ==================== MODE 1: MODERN TABLE VIEW ==================== -->
                <?php foreach ($jadwals as $title => $arrjadwal) : 
                    $cleanTitle = trim(preg_replace('/\s+\d{4}\/\d{4}.*$/i', '', strip_tags($title)));
                    if (empty($cleanTitle)) {
                        $cleanTitle = strip_tags($title);
                    }
                ?>
                    <div class="card border mb-4 shadow-sm jadwal-group-card" style="border-radius: 12px; border-color: #cbd5e1 !important; overflow: hidden;">
                        <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center border-bottom">
                            <h5 class="card-title fw-bold text-dark m-0 d-flex align-items-center">
                                <span class="rounded-3 bg-primary-subtle text-primary me-2.5 d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                                </span>
                                <span><?= esc($cleanTitle) ?></span>
                            </h5>
                        </div>
                        <?php foreach ($arrjadwal as $lvl => $sjadwal) : ?>
                            <div class="card-body p-4 border-bottom last-border-0">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="badge bg-light text-dark border px-3 py-2 fw-bold" style="font-size: 0.85rem; border-radius: 8px;">
                                        <svg class="me-1 text-primary" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                        Sasaran Tingkat / Kelas: <?= esc($lvl) ?>
                                    </span>
                                    <span class="text-muted small"><?= count($sjadwal) ?> Jadwal Ujian</span>
                                </div>
                                <div class="table-responsive w-100 rounded-3 border bg-white shadow-xs">
                                    <table class="w-100 table table-hover table-bordered table-modern align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center align-middle p-2" style="width: 45px">No.</th>
                                                <th class="align-middle">Kode &amp; Status</th>
                                                <th class="align-middle">Mata Pelajaran</th>
                                                <th class="align-middle">Target Kelas</th>
                                                <th class="align-middle">Pelaksanaan &amp; Durasi</th>
                                                <th class="text-center align-middle" style="width: 140px;">Status Ujian</th>
                                                <th class="text-center align-middle" style="width: 150px;">Aksi</th>
                                                <?php if (!$isNurulHakim || $isAdmin): ?><th class="text-center align-middle p-2" style="width: 45px">
                                                    <i class="far fa-check-square text-muted"></i>
                                                </th><?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $nomer = 1;
                                            $currTgl = '';
                                            foreach ($sjadwal as $jadwal) :
                                                $jumlahKelas = $jadwal->bank_kelas;
                                                $kelasbank = '';
                                                $kelasSearchText = '';
                                                if (is_array($jumlahKelas) || is_object($jumlahKelas)) {
                                                    foreach ($jumlahKelas as $j) {
                                                        $j = is_array($j) ? (object) $j : $j;
                                                        if (isset($kelas) && is_array($kelas)) {
                                                            foreach ($kelas as $k) {
                                                                if (isset($j->kelas_id) && $j->kelas_id == $k->id_kelas) {
                                                                    $nama = $k->nama_kelas ?? $k->kode_kelas ?? $k->id_kelas;
                                                                    $kelasbank .= '<span class="badge-kelas me-1 mb-1">' . $nama . '</span>';
                                                                    $kelasSearchText .= ' ' . $nama;
                                                                }
                                                            }
                                                        }
                                                    }
                                                }

                                                $startDay = strtotime($jadwal->tgl_mulai ?? '');
                                                $endDay = strtotime($jadwal->tgl_selesai ?? '');

                                                $enableEdit = true;
                                                $sedangdikerjakan = 0;
                                                $terpakai = isset($total_siswa[$jadwal->id_jadwal]);
                                                $deletable = true;
                                                
                                                if ($jadwal->status == '0') {
                                                    $dotColor = '#64748b';
                                                    $statusLabel = 'Tidak Aktif';
                                                } else {
                                                    if ($today < $startDay) {
                                                        $dotColor = '#e11d48';
                                                        $statusLabel = 'Belum Dimulai';
                                                    } elseif ($today > $endDay) {
                                                        if ($jadwal->rekap == '1') {
                                                            $dotColor = $terpakai ? '#059669' : '#d97706';
                                                            $statusLabel = $terpakai ? 'Selesai (Sudah Rekap)' : 'Tidak Digunakan';
                                                        } else {
                                                            $dotColor = $terpakai ? '#c026d3' : '#d97706';
                                                            $statusLabel = $terpakai ? 'Selesai (Belum Rekap)' : 'Tidak Digunakan';
                                                        }
                                                    } else {
                                                        $dotColor = $terpakai ? '#7c3aed' : '#d97706';
                                                        $statusLabel = $terpakai ? 'Sedang Dilaksanakan' : 'Tidak Digunakan';
                                                        $sedangdikerjakan = $terpakai ? 1 : 0;
                                                    }
                                                }

                                                $total_seharusnya = ($jadwal->tampil_pg + $jadwal->tampil_kompleks + $jadwal->tampil_jodohkan + $jadwal->tampil_isian + $jadwal->tampil_esai);
                                                $total_soal = $jadwal->total_soal == 0 ? '<span class="text-danger small">Soal belum dibuat</span>' :
                                                    ($jadwal->total_soal < $total_seharusnya ? '<span class="text-warning small">' . $jadwal->total_soal . '/' . $total_seharusnya . ' Soal</span>' :
                                                        '<span class="text-success small fw-bold">' . $total_seharusnya . ' Butir</span>');
                                                $disableDelete = $deletable ? '' : 'disabled';
                                                $searchString = esc(strtolower($jadwal->bank_kode . ' ' . $jadwal->nama_mapel . ' ' . $jadwal->kode_jenis . ' ' . $kelasSearchText));
                                            ?>
                                            <?php if ($currTgl != $jadwal->tgl_mulai) :
                                                $currTgl = $jadwal->tgl_mulai; ?>
                                                <tr class="table-light">
                                                    <td colspan="8" class="fw-bold text-dark ps-3 py-2" style="font-size: 0.85rem; background-color: #f1f5f9;">
                                                        <svg class="me-1.5 text-primary" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                                        Hari / Tanggal Mulai: <?= singkat_tanggal(date('D, d M Y', strtotime($jadwal->tgl_mulai ?? ''))) ?>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            <tr class="jadwal-row-item" data-search="<?= $searchString ?>">
                                                <td class="text-center align-middle p-2 fw-semibold text-muted"><?= $nomer ?></td>
                                                <td class="align-middle">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="legend-dot flex-shrink-0" style="background-color: <?= $dotColor ?>;" title="<?= $statusLabel ?>"></span>
                                                        <div>
                                                            <div class="fw-bold text-dark" style="font-size: 0.9rem;"><?= esc($jadwal->bank_kode) ?></div>
                                                            <div class="text-muted small" style="font-size: 0.75rem;"><?= $statusLabel ?></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="fw-semibold text-dark"><?= esc($jadwal->nama_mapel) ?></div>
                                                    <div class="mt-1 d-flex align-items-center gap-1">
                                                        <span class="badge bg-light text-secondary border px-2 py-0.5" style="font-size: 0.72rem;"><?= (isset($jadwal->soal_agama) && $jadwal->soal_agama != '-') ? $jadwal->soal_agama : 'Umum' ?></span>
                                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-0.5" style="font-size: 0.72rem;"><?= esc($jadwal->kode_jenis) ?></span>
                                                        <?php
                                                        $lockMode = (int)($jadwal->lock_browser ?? 0);
                                                        if ($lockMode === 1) {
                                                            echo '<span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-0.5" style="font-size: 0.72rem;" title="Wajib Exambro (Android & PC)"><i class="fas fa-shield-alt me-1"></i>Exambro</span>';
                                                        } elseif ($lockMode === 2) {
                                                            echo '<span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-0.5" style="font-size: 0.72rem;" title="Hanya Exambro Android"><i class="fab fa-android me-1"></i>Exambro Android</span>';
                                                        } elseif ($lockMode === 3) {
                                                            echo '<span class="badge bg-info-subtle text-info-emphasis border border-info-subtle px-2 py-0.5" style="font-size: 0.72rem;" title="Hanya Exambro PC"><i class="fas fa-desktop me-1"></i>Exambro PC</span>';
                                                        }
                                                        ?>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex flex-wrap gap-1">
                                                        <?= $kelasbank ?: '<span class="text-muted small">-</span>' ?>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="small fw-semibold text-dark">
                                                        <?= singkat_tanggal(date('d M Y', strtotime($jadwal->tgl_mulai ?? ''))) ?> s/d <?= singkat_tanggal(date('d M Y', strtotime($jadwal->tgl_selesai ?? ''))) ?>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-2 mt-1">
                                                        <span class="badge bg-light text-dark border px-2 py-0.5" style="font-size: 0.72rem;">
                                                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg><?= $jadwal->durasi_ujian ?> Menit
                                                        </span>
                                                        <span><?= $total_soal ?></span>
                                                    </div>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div class="d-flex flex-column align-items-center gap-1">
                                                        <span class="badge <?= $jadwal->status == '1' ? 'bg-success-subtle text-success border border-success-subtle' : 'bg-warning-subtle text-warning border border-warning-subtle' ?> px-2 py-1" style="font-size: 0.78rem;">
                                                            <?= $jadwal->status == '1' ? 'Aktif' : 'Non Aktif' ?>
                                                        </span>
                                                        <button type="button" class="btn btn-xs <?= $jadwal->status == '1' ? 'btn-outline-warning' : 'btn-outline-success' ?> shadow-xs" style="font-size: 0.75rem; padding: 2px 8px; border-radius: 6px;" onclick="aktifkanJadwal(<?= $jadwal->id_jadwal ?>, <?= $jadwal->status ?>)">
                                                            <?= $jadwal->status == '1' ? 'Nonaktifkan' : 'Aktifkan' ?>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div class="d-inline-flex align-items-center justify-content-center gap-1">
                                                        <button type="button" class="btn btn-primary shadow-xs text-white" title="Detail Jadwal"
                                                           data-bs-toggle="modal" data-bs-target="#detailModal"
                                                           data-jenis="<?= $jadwal->kode_jenis ?>"
                                                           data-kode="<?= $jadwal->bank_kode ?>"
                                                           data-mulai="<?= singkat_tanggal(date('D, d M Y', strtotime($jadwal->tgl_mulai ?? ''))) ?>"
                                                           data-sampai="<?= singkat_tanggal(date('D, d M Y', strtotime($jadwal->tgl_selesai ?? ''))) ?>"
                                                           data-durasi="<?= $jadwal->durasi_ujian ?>"
                                                           data-lockbrowser="<?= (int)($jadwal->lock_browser ?? 0) ?>" data-acaksoal="<?= $jadwal->acak_soal == '1' ? 'Ya' : 'Tidak' ?>"
                                                           data-acakjawaban="<?= $jadwal->acak_opsi == '1' ? 'Ya' : 'Tidak' ?>"
                                                           data-hasiltampil="<?= $jadwal->hasil_tampil == '1' ? 'Ya' : 'Tidak' ?>"
                                                           data-pelanggaran="<?= $jadwal->pelanggaran == '1' ? 'Ya' : 'Tidak' ?>"
                                                           data-kamera="<?= (isset($jadwal->kamera) && $jadwal->kamera == '1') ? 'Ya' : 'Tidak' ?>"
                                                           data-token="<?= $jadwal->token == '1' ? 'Ya' : 'Tidak' ?>"
                                                           data-reset="<?= $jadwal->reset_login == '1' ? 'Ya' : 'Tidak' ?>"
                                                           data-status="<?= ($jadwal->status === '0') ? 'Non Aktif' : 'Aktif' ?>"
                                                           data-rekap="<?= $jadwal->rekap == '1' ? 'Sudah' : 'Belum' ?>"
                                                           data-total="<?= isset($total_siswa[$jadwal->id_jadwal]) ? $total_siswa[$jadwal->id_jadwal] : '0'; ?>">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                        <?php if (!$isNurulHakim || $isAdmin): ?><a href="<?= $enableEdit ? base_url('cbtjadwal/add/' . $jadwal->id_jadwal . '?enable=' . $sedangdikerjakan) : 'javascript:void(0)' ?>"
                                                           class="btn btn-warning shadow-xs text-white <?= $enableEdit ? '' : 'disabled' ?>" title="Edit Jadwal">
                                                            <i class="fa fa-pencil-alt"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-danger shadow-xs text-white" title="Hapus Jadwal"
                                                                onclick="hapus(<?= $jadwal->id_jadwal ?>)" <?= $disableDelete ?>>
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                         <?php endif; ?>
                                                    </div>
                                                </td>
                                                <?php if (!$isNurulHakim || $isAdmin): ?><td class="text-center align-middle p-2">
                                                    <input name="checked[]" value="<?= $jadwal->id_jadwal ?>"
                                                           class="form-check-input check-jadwal m-0" type="checkbox"
                                                           style="width: 18px; height: 18px; cursor: pointer;">
                                                </td><?php endif; ?>
                                            </tr>
                                            <?php $nomer++; endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <!-- ==================== MODE 2: MODERN CARD / GRID VIEW ==================== -->
                <?php foreach ($jadwals as $title => $arrjadwal) : 
                    $cleanTitle = trim(preg_replace('/\s+\d{4}\/\d{4}.*$/i', '', strip_tags($title)));
                    if (empty($cleanTitle)) {
                        $cleanTitle = strip_tags($title);
                    }
                ?>
                    <div class="card border mb-4 shadow-sm jadwal-group-card" style="border-radius: 12px; border-color: #cbd5e1 !important; overflow: hidden;">
                        <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center border-bottom">
                            <h5 class="card-title fw-bold text-dark m-0 d-flex align-items-center">
                                <span class="rounded-3 bg-primary-subtle text-primary me-2.5 d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                                </span>
                                <span><?= esc($cleanTitle) ?></span>
                            </h5>
                        </div>
                        <?php foreach ($arrjadwal as $lvl => $sjadwal) : ?>
                            <div class="card-body p-4 border-bottom last-border-0">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="badge bg-light text-dark border px-3 py-2 fw-bold" style="font-size: 0.85rem; border-radius: 8px;">
                                        <svg class="me-1 text-primary" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                        Sasaran Tingkat / Kelas: <?= esc($lvl) ?>
                                    </span>
                                    <span class="text-muted small"><?= count($sjadwal) ?> Jadwal Ujian</span>
                                </div>
                                <div class="row g-4">
                                    <?php foreach ($sjadwal as $jadwal) :
                                        $jumlahKelas = $jadwal->bank_kelas;
                                        $kelasbank = '';
                                        $kelasSearchText = '';
                                        if (is_array($jumlahKelas) || is_object($jumlahKelas)) {
                                            foreach ($jumlahKelas as $j) {
                                                $j = is_array($j) ? (object) $j : $j;
                                                if (isset($kelas) && is_array($kelas)) {
                                                    foreach ($kelas as $k) {
                                                        if (isset($j->kelas_id) && $j->kelas_id == $k->id_kelas) {
                                                            $nama = $k->nama_kelas ?? $k->kode_kelas ?? $k->id_kelas;
                                                            $kelasbank .= '<span class="badge-kelas me-1 mb-1">' . $nama . '</span>';
                                                            $kelasSearchText .= ' ' . $nama;
                                                        }
                                                    }
                                                }
                                            }
                                        }

                                        $startDay = strtotime($jadwal->tgl_mulai ?? '');
                                        $endDay = strtotime($jadwal->tgl_selesai ?? '');

                                        $enableEdit = true;
                                        $sedangdikerjakan = 0;
                                        $terpakai = isset($total_siswa[$jadwal->id_jadwal]);
                                        $deletable = true;

                                        if ($jadwal->status == '0') {
                                            $bgHeader = 'background: linear-gradient(135deg, #64748b 0%, #475569 100%) !important; color: #ffffff !important;';
                                            $statusBadge = '<span class="badge bg-white text-secondary fw-bold shadow-xs" style="padding: 6px 10px; font-size: 0.8rem; border-radius: 6px;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="me-1" style="vertical-align: -2px;"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>Tidak Aktif</span>';
                                        } else {
                                            if ($today < $startDay) {
                                                $bgHeader = 'background: linear-gradient(135deg, #e11d48 0%, #be123c 100%) !important; color: #ffffff !important;';
                                                $statusBadge = '<span class="badge bg-white text-danger fw-bold shadow-xs" style="padding: 6px 10px; font-size: 0.8rem; border-radius: 6px;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="me-1" style="vertical-align: -2px;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>Belum Dimulai</span>';
                                            } elseif ($today > $endDay) {
                                                if ($jadwal->rekap == '1') {
                                                    $bgHeader = $terpakai 
                                                        ? 'background: linear-gradient(135deg, #059669 0%, #047857 100%) !important; color: #ffffff !important;'
                                                        : 'background: linear-gradient(135deg, #d97706 0%, #b45309 100%) !important; color: #ffffff !important;';
                                                    $statusBadge = $terpakai 
                                                        ? '<span class="badge bg-white text-success fw-bold shadow-xs" style="padding: 6px 10px; font-size: 0.8rem; border-radius: 6px;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="me-1" style="vertical-align: -2px;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>Selesai (Sudah Rekap)</span>'
                                                        : '<span class="badge bg-white text-warning fw-bold shadow-xs" style="padding: 6px 10px; font-size: 0.8rem; border-radius: 6px;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="me-1" style="vertical-align: -2px;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>Tidak Digunakan</span>';
                                                    $deletable = $terpakai;
                                                } else {
                                                    $bgHeader = $terpakai 
                                                        ? 'background: linear-gradient(135deg, #c026d3 0%, #a21caf 100%) !important; color: #ffffff !important;'
                                                        : 'background: linear-gradient(135deg, #d97706 0%, #b45309 100%) !important; color: #ffffff !important;';
                                                    $statusBadge = $terpakai 
                                                        ? '<span class="badge bg-white fw-bold shadow-xs" style="color: #c026d3; padding: 6px 10px; font-size: 0.8rem; border-radius: 6px;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="me-1" style="vertical-align: -2px;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 14 10"></polyline></svg>Selesai (Belum Rekap)</span>'
                                                        : '<span class="badge bg-white text-warning fw-bold shadow-xs" style="padding: 6px 10px; font-size: 0.8rem; border-radius: 6px;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="me-1" style="vertical-align: -2px;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>Tidak Digunakan</span>';
                                                }
                                            } else {
                                                $bgHeader = $terpakai 
                                                    ? 'background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%) !important; color: #ffffff !important;'
                                                    : 'background: linear-gradient(135deg, #d97706 0%, #b45309 100%) !important; color: #ffffff !important;';
                                                $statusBadge = $terpakai 
                                                    ? '<span class="badge bg-white fw-bold shadow-xs" style="color: #7c3aed; padding: 6px 10px; font-size: 0.8rem; border-radius: 6px;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="me-1" style="vertical-align: -2px;"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>Sedang Dilaksanakan</span>'
                                                    : '<span class="badge bg-white text-warning fw-bold shadow-xs" style="padding: 6px 10px; font-size: 0.8rem; border-radius: 6px;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="me-1" style="vertical-align: -2px;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>Tidak Digunakan</span>';
                                                $sedangdikerjakan = $terpakai ? 1 : 0;
                                                $deletable = $terpakai;
                                            }
                                        }

                                        $total_seharusnya = ($jadwal->tampil_pg + $jadwal->tampil_kompleks + $jadwal->tampil_jodohkan + $jadwal->tampil_isian + $jadwal->tampil_esai);
                                        $total_soal = $jadwal->total_soal == 0 ? '<span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1" style="font-size: 0.78rem;">Belum dibuat</span>' :
                                            ($jadwal->total_soal < $total_seharusnya ? '<span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1" style="font-size: 0.78rem;">' . $jadwal->total_soal . '/' . $total_seharusnya . ' Butir</span>' :
                                                '<span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1" style="font-size: 0.78rem;">' . $total_seharusnya . ' Butir</span>');
                                        
                                        $disableDelete = $deletable ? '' : 'disabled';
                                        $searchString = esc(strtolower($jadwal->bank_kode . ' ' . $jadwal->nama_mapel . ' ' . $jadwal->kode_jenis . ' ' . $kelasSearchText));
                                    ?>
                                        <div class="col-md-6 col-lg-4 jadwal-card-item" data-search="<?= $searchString ?>">
                                            <div class="card card-bank-soal h-100 d-flex flex-column">
                                                <!-- Header: High-visibility solid bar with rounded top corners & generous padding -->
                                                <div class="card-bank-header" style="<?= $bgHeader ?>">
                                                    <div class="bank-title-box">
                                                        <?= $statusBadge ?>
                                                        <span class="m-0 fw-bold text-truncate text-white" style="font-size: 1.05rem;" title="<?= esc($jadwal->bank_kode) ?>">
                                                            <?= esc($jadwal->bank_kode) ?>
                                                        </span>
                                                    </div>
                                                    <?php if (!$isNurulHakim || $isAdmin): ?><div class="bank-actions-box">
                                                        <a href="<?= $enableEdit ? base_url('cbtjadwal/add/' . $jadwal->id_jadwal . '?enable=' . $sedangdikerjakan) : 'javascript:void(0)' ?>"
                                                           class="btn btn-light shadow-xs d-flex align-items-center justify-content-center <?= $enableEdit ? '' : 'disabled opacity-50' ?>"
                                                           style="width: 36px; height: 36px; padding: 0; border-radius: 8px; border: 1px solid rgba(0,0,0,0.08);" title="Edit Jadwal">
                                                            <i class="fa fa-pencil-alt text-dark" style="font-size: 0.95rem;"></i>
                                                        </a>
                                                        <div class="bg-white rounded shadow-xs d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; padding: 0; border-radius: 8px; border: 1px solid rgba(0,0,0,0.08);">
                                                            <input name="checked[]" value="<?= $jadwal->id_jadwal ?>"
                                                                   class="form-check-input check-jadwal m-0" type="checkbox"
                                                                   style="width: 19px; height: 19px; cursor: pointer;">
                                                        </div>
     <?php endif; ?>                                               </div>
                                                </div>

                                                <!-- Body: Full 7-Row Key-Value Details with Distinct Borders -->
                                                <div class="card-body p-0 flex-grow-1">
                                                    <ul class="list-group list-group-flush mb-0">
                                                        <li class="card-bank-item-row list-group-item">
                                                            <span class="text-muted fw-semibold" style="font-size: 0.85rem;">
                                                                <svg class="me-2 text-primary opacity-75" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>Mapel &amp; Jenis
                                                            </span>
                                                            <div class="text-end text-break ms-2" style="font-size: 0.88rem;">
                                                                <span class="fw-bold text-dark"><?= esc($jadwal->nama_mapel) ?></span>
                                                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle ms-1" style="font-size: 0.72rem;"><?= esc($jadwal->kode_jenis) ?></span>
                                                            </div>
                                                        </li>
                                                        <li class="card-bank-item-row list-group-item">
                                                            <span class="text-muted fw-semibold flex-shrink-0" style="font-size: 0.85rem;">
                                                                <svg class="me-2 text-primary opacity-75" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>Target Kelas
                                                            </span>
                                                            <div class="text-end d-flex flex-wrap justify-content-end gap-1 ms-2">
                                                                <?= $kelasbank ?: '<span class="text-muted small">-</span>' ?>
                                                            </div>
                                                        </li>
                                                        <li class="card-bank-item-row list-group-item">
                                                            <span class="text-muted fw-semibold" style="font-size: 0.85rem;">
                                                                <svg class="me-2 text-primary opacity-75" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>Pelaksanaan
                                                            </span>
                                                            <span class="small fw-semibold text-dark text-end ms-2">
                                                                <?= singkat_tanggal(date('d M Y', strtotime($jadwal->tgl_mulai ?? ''))) ?> s/d <?= singkat_tanggal(date('d M Y', strtotime($jadwal->tgl_selesai ?? ''))) ?>
                                                            </span>
                                                        </li>
                                                        <li class="card-bank-item-row list-group-item">
                                                            <span class="text-muted fw-semibold" style="font-size: 0.85rem;">
                                                                <svg class="me-2 text-primary opacity-75" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>Durasi &amp; Soal
                                                            </span>
                                                            <div class="ms-2 d-flex align-items-center gap-1">
                                                                <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 0.78rem;"><?= $jadwal->durasi_ujian ?> Menit</span>
                                                                <?= $total_soal ?>
                                                            </div>
                                                        </li>
                                                        <li class="card-bank-item-row list-group-item">
                                                            <span class="text-muted fw-semibold" style="font-size: 0.85rem;">
                                                                <svg class="me-2 text-primary opacity-75" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 3 21 3 21 8"></polyline><line x1="4" y1="20" x2="21" y2="3"></line><polyline points="21 16 21 21 16 21"></polyline><line x1="15" y1="15" x2="21" y2="21"></line><line x1="4" y1="4" x2="9" y2="9"></line></svg>Acak &amp; Hasil
                                                            </span>
                                                            <span class="small text-dark text-end ms-2">
                                                                Soal: <b><?= $jadwal->acak_soal == '1' ? 'Ya' : 'Tdk' ?></b> | Opsi: <b><?= $jadwal->acak_opsi == '1' ? 'Ya' : 'Tdk' ?></b> | Skor: <b><?= $jadwal->hasil_tampil == '1' ? 'Ya' : 'Tdk' ?></b>
                                                            </span>
                                                        </li>
                                                        
                                                        <li class="card-bank-item-row list-group-item">
                                                            <span class="text-muted fw-semibold" style="font-size: 0.85rem;">
                                                                <svg class="me-2 text-primary opacity-75" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>Kunci Browser
                                                            </span>
                                                            <span class="text-end ms-2">
                                                                <?php
                                                                $lkm = (int)($jadwal->lock_browser ?? 0);
                                                                if ($lkm === 1) {
                                                                    echo '<span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-0.5" style="font-size: 0.75rem;"><i class="fas fa-shield-alt me-1"></i>Wajib Exambro</span>';
                                                                } elseif ($lkm === 2) {
                                                                    echo '<span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-0.5" style="font-size: 0.75rem;"><i class="fab fa-android me-1"></i>Exambro Android</span>';
                                                                } elseif ($lkm === 3) {
                                                                    echo '<span class="badge bg-info-subtle text-info-emphasis border border-info-subtle px-2 py-0.5" style="font-size: 0.75rem;"><i class="fas fa-desktop me-1"></i>Exambro PC</span>';
                                                                } else {
                                                                    echo '<span class="badge bg-light text-muted border px-2 py-0.5" style="font-size: 0.75rem;"><i class="fas fa-globe me-1"></i>Semua Browser</span>';
                                                                }
                                                                ?>
                                                            </span>
                                                        </li>
<li class="card-bank-item-row list-group-item">
                                                            <span class="text-muted fw-semibold" style="font-size: 0.85rem;">
                                                                <svg class="me-2 text-primary opacity-75" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>Token &amp; Kamera
                                                            </span>
                                                            <span class="small text-dark text-end ms-2">
                                                                Token: <b><?= $jadwal->token == '1' ? 'Ya' : 'Tdk' ?></b> | Reset: <b><?= $jadwal->reset_login == '1' ? 'Ya' : 'Tdk' ?></b> | Cam: <b><?= (isset($jadwal->kamera) && $jadwal->kamera == '1') ? 'Ya' : 'Tdk' ?></b>
                                                            </span>
                                                        </li>
                                                        <li class="card-bank-item-row list-group-item">
                                                            <span class="text-muted fw-semibold" style="font-size: 0.85rem;">
                                                                <svg class="me-2 text-primary opacity-75" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><polyline points="16 11 18 13 22 9"></polyline></svg>Mengerjakan &amp; Rekap
                                                            </span>
                                                            <div class="ms-2 d-flex align-items-center gap-1.5">
                                                                <span class="badge bg-light text-dark border px-2 py-0.5" style="font-size: 0.78rem;">
                                                                    <b><?= isset($total_siswa[$jadwal->id_jadwal]) ? $total_siswa[$jadwal->id_jadwal] : '0'; ?></b> Siswa
                                                                </span>
                                                                <?= $jadwal->rekap == '1' 
                                                                    ? '<span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-0.5" style="font-size: 0.75rem;">Sudah Rekap</span>' 
                                                                    : '<span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-0.5" style="font-size: 0.75rem;">Belum Rekap</span>' ?>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <!-- Footer: Symmetrical action buttons -->
                                                <div class="card-bank-footer">
                                                    <div class="d-flex align-items-center justify-content-between gap-2">
                                                        <button type="button" class="btn btn-outline-info btn-sm shadow-xs flex-grow-1 d-inline-flex align-items-center justify-content-center"
                                                           data-bs-toggle="modal" data-bs-target="#detailModal"
                                                           data-jenis="<?= $jadwal->kode_jenis ?>"
                                                           data-kode="<?= $jadwal->bank_kode ?>"
                                                           data-mulai="<?= singkat_tanggal(date('D, d M Y', strtotime($jadwal->tgl_mulai ?? ''))) ?>"
                                                           data-sampai="<?= singkat_tanggal(date('D, d M Y', strtotime($jadwal->tgl_selesai ?? ''))) ?>"
                                                           data-durasi="<?= $jadwal->durasi_ujian ?>"
                                                           data-lockbrowser="<?= (int)($jadwal->lock_browser ?? 0) ?>" data-acaksoal="<?= $jadwal->acak_soal == '1' ? 'Ya' : 'Tidak' ?>"
                                                           data-acakjawaban="<?= $jadwal->acak_opsi == '1' ? 'Ya' : 'Tidak' ?>"
                                                           data-hasiltampil="<?= $jadwal->hasil_tampil == '1' ? 'Ya' : 'Tidak' ?>"
                                                           data-pelanggaran="<?= $jadwal->pelanggaran == '1' ? 'Ya' : 'Tidak' ?>"
                                                           data-kamera="<?= (isset($jadwal->kamera) && $jadwal->kamera == '1') ? 'Ya' : 'Tidak' ?>"
                                                           data-token="<?= $jadwal->token == '1' ? 'Ya' : 'Tidak' ?>"
                                                           data-reset="<?= $jadwal->reset_login == '1' ? 'Ya' : 'Tidak' ?>"
                                                           data-status="<?= ($jadwal->status === '0') ? 'Non Aktif' : 'Aktif' ?>"
                                                           data-rekap="<?= $jadwal->rekap == '1' ? 'Sudah' : 'Belum' ?>"
                                                           data-total="<?= isset($total_siswa[$jadwal->id_jadwal]) ? $total_siswa[$jadwal->id_jadwal] : '0'; ?>"
                                                           style="height: 34px; font-size: 0.82rem; border-radius: 8px;">
                                                            <i class="fa fa-eye me-1"></i> Detail
                                                        </button>
                                                        <?php if (!$isNurulHakim || $isAdmin): ?>
                                                        <button type="button" class="btn <?= $jadwal->status == '1' ? 'btn-outline-warning' : 'btn-outline-success' ?> btn-sm shadow-xs flex-grow-1 d-inline-flex align-items-center justify-content-center"
                                                                onclick="aktifkanJadwal(<?= $jadwal->id_jadwal ?>, <?= $jadwal->status ?>)"
                                                                style="height: 34px; font-size: 0.82rem; border-radius: 8px;">
                                                            <?= $jadwal->status == '1' ? 'Nonaktifkan' : 'Aktifkan' ?>
                                                        </button>
                                                        <a href="<?= $enableEdit ? base_url('cbtjadwal/add/' . $jadwal->id_jadwal . '?enable=' . $sedangdikerjakan) : 'javascript:void(0)' ?>"
                                                           class="btn btn-outline-primary btn-sm shadow-xs flex-grow-1 d-inline-flex align-items-center justify-content-center <?= $enableEdit ? '' : 'disabled opacity-50' ?>"
                                                           style="height: 34px; font-size: 0.82rem; border-radius: 8px;">
                                                            <i class="fa fa-pencil-alt me-1"></i> Edit
                                                        </a>
                                                        <button type="button" class="btn btn-outline-danger btn-sm shadow-xs d-inline-flex align-items-center justify-content-center"
                                                                onclick="hapus(<?= $jadwal->id_jadwal ?>)" <?= $disableDelete ?>
                                                                style="height: 34px; width: 38px; padding: 0; border-radius: 8px;" title="Hapus Jadwal">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<!-- Modal Detail Jadwal Ujian -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
                <h5 class="modal-title fw-bold d-flex align-items-center" id="createModalLabel">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg> Detail Jadwal Ujian
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <table class="table table-striped table-hover align-middle mb-0" style="font-size: 0.9rem;">
                    <tbody>
                        <tr><td class="ps-3 text-muted" style="width: 42%;">Jenis Ujian</td><td id="modal_kode_jenis" class="pe-3 fw-bold text-dark"></td></tr>
                        <tr><td class="ps-3 text-muted">Kode Naskah Soal</td><td id="modal_bank_kode" class="pe-3 fw-bold text-primary"></td></tr>
                        <tr><td class="ps-3 text-muted">Waktu Mulai</td><td id="modal_mulai" class="pe-3 fw-bold text-dark"></td></tr>
                        <tr><td class="ps-3 text-muted">Waktu Selesai</td><td id="modal_sampai" class="pe-3 fw-bold text-dark"></td></tr>
                        <tr><td class="ps-3 text-muted">Durasi Pengerjaan</td><td id="modal_durasi" class="pe-3 fw-bold text-dark"></td></tr>
                        <tr><td class="ps-3 text-muted">Acak Urutan Soal</td><td id="modal_acak_soal" class="pe-3 fw-bold text-dark"></td></tr>
                        <tr><td class="ps-3 text-muted">Acak Opsi Jawaban</td><td id="modal_acak_opsi" class="pe-3 fw-bold text-dark"></td></tr>
                        <tr><td class="ps-3 text-muted">Tampilkan Skor Hasil</td><td id="modal_hasil_tampil" class="pe-3 fw-bold text-dark"></td></tr>
                        <tr><td class="ps-3 text-muted">Gunakan Token Masuk</td><td id="modal_token" class="pe-3 fw-bold text-dark"></td></tr>
                        <tr><td class="ps-3 text-muted">Izin Reset Login Siswa</td><td id="modal_reset" class="pe-3 fw-bold text-dark"></td></tr>
                        <tr><td class="ps-3 text-muted">Hitung Pelanggaran Layar</td><td id="modal_pelanggaran" class="pe-3 fw-bold text-dark"></td></tr>
                        <tr><td class="ps-3 text-muted">Pengawasan Kamera Siswa</td><td id="modal_kamera" class="pe-3 fw-bold text-dark"></td></tr>
                        <tr><td class="ps-3 text-muted">Penguncian Browser / Exambro</td><td id="modal_lock_browser" class="pe-3 fw-bold text-dark"></td></tr>
                        <tr><td class="ps-3 text-muted">Status Jadwal Ujian</td><td id="modal_status" class="pe-3 fw-bold text-dark"></td></tr>
                        <tr><td class="ps-3 text-muted">Status Rekapitulasi Nilai</td><td id="modal_rekap" class="pe-3 fw-bold text-dark"></td></tr>
                        <tr><td class="ps-3 text-muted">Jumlah Siswa Mengikuti</td><td id="modal_total" class="pe-3 fw-bold text-success"></td></tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer bg-light p-2">
                <button type="button" class="btn btn-secondary shadow-sm" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<?= form_open('', array('id' => 'check')) ?>
<?= form_close(); ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    var idFilter = '<?=$id_filter?>';
    var idMapel = '<?=$id_mapel?>';
    var idLevel = '<?=$id_level?>';
    var idGuru = '<?=$id_guru?>';
    var mode = '<?=$mode?>';

    const infoRekap = <?= json_encode($rekaps) ?>;
    adaJadwalUjian = '<?=count($ada_ujian)?>';
    localStorage.setItem('nextgenCBT.ada_jadwal_ujian', adaJadwalUjian);

    $('.btn-disabled').click(function (e) {
        e.preventDefault();
    });

    function hapus(id) {
        swal.fire({
            title: "Anda yakin?",
            text: "Jadwal Ujian akan dihapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Hapus!"
        }).then(result => {
            if (result.value) {
                swal.fire({
                    text: "Silahkan tunggu....",
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    onOpen: () => {
                        swal.showLoading();
                    }
                });
                $.ajax({
                    url: base_url + 'cbtjadwal/deletejadwal?id_jadwal=' + id,
                    type: "GET",
                    success: function (respon) {
                        console.log(respon);
                        if (respon.status) {
                            swal.fire({
                                title: "Berhasil",
                                text: "Jadwal Ujian berhasil dihapus",
                                icon: "success"
                            }).then(result => {
                                if (result.value) {
                                    window.location.reload();
                                }
                            });
                        } else {
                            swal.fire({
                                title: "Gagal",
                                text: "Tidak bisa menghapus, " + respon.message,
                                icon: "error"
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr, status, error)
                        const err = JSON.parse(xhr.responseText)
                        swal.fire({
                            title: "Error",
                            text: err.Message,
                            icon: "error"
                        });
                    }
                });
            }
        });
    }

    function aktifkanJadwal(id, status) {
        if (status == '1') {
            swal.fire({
                title: "Anda yakin?",
                text: "Jadwal akan dinonaktifkan!",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Nonaktifkan"
            }).then(result => {
                if (result.value) {
                    aktifkan(id, status);
                }
            })
        } else {
            aktifkan(id, status);
        }
    }

    function aktifkan(id, status) {
        $.ajax({
            url: base_url + 'cbtjadwal/aktifkan_jadwal',
            data: {id_jadwal: id, method: status},
            type: "POST",
            success: function (respon) {
                location.reload();
            },
            error: function () {
                swal.fire({
                    title: "Gagal",
                    text: "Ada data yang sedang digunakan",
                    icon: "error"
                });
            }
        });
    }

    $(document).ready(function () {
        ajaxcsrf();
        if ($('.jam').length > 0) {
            $('.jam').datetimepicker({
                datepicker: false,
                format: 'H:i',
                step: 15,
                minTime: '06:00',
                maxTime: '17:00'
            });
        }

        if ($('.tgl').length > 0) {
            $('.tgl').datetimepicker({
                i18n: {
                    id: {
                        months: [
                            'Januari', 'Februari', 'Maret', 'April', 'Mei',
                            'Juni', 'Juli', 'Agustus', 'September',
                            'Oktober', 'November', 'Desember'
                        ],
                        dayOfWeek: [
                            'Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'
                        ]
                    }
                },
                icons: {
                    next: 'fa fa-angle-right',
                    previous: 'fa fa-angle-left'
                },
                timepicker: false,
                scrollInput: false,
                scrollMonth: false,
                format: 'Y-m-d',
                widgetPositioning: {
                    horizontal: 'left',
                    vertical: 'bottom'
                }
            });
        }

        var count = $('#konten-jadwal .check-jadwal').length;

        var opsiFilter = $('#filter');
        var opsiGuru = $('#guru');
        var opsiMapel = $('#mapel');
        var opsiLevel = $('#level');

        opsiFilter.select2({width: '100%'});
        opsiGuru.select2({width: '100%'});
        opsiMapel.select2({width: '100%'});
        opsiLevel.select2({width: '100%'});

        function onChangeFilter(type) {
            if (type == '1') {
                $('#select-guru').removeClass('d-none');
                $('#select-mapel').addClass('d-none');
                $('#select-level').addClass('d-none');
            } else if (type == '2') {
                $('#select-guru').addClass('d-none');
                $('#select-mapel').removeClass('d-none');
                $('#select-level').addClass('d-none');
            } else if (type == '3') {
                $('#select-guru').addClass('d-none');
                $('#select-mapel').addClass('d-none');
                $('#select-level').removeClass('d-none');
            } else {
                $('#select-guru').addClass('d-none');
                $('#select-mapel').addClass('d-none');
                $('#select-level').addClass('d-none');
            }
        }

        opsiFilter.on('change', function () {
            var type = $(this).val();
            console.log(type);
            if (type == '0' && idFilter != '0') {
                window.location.href = base_url + 'cbtjadwal?type=0&mode=' + mode;
            } else {
                onChangeFilter(type);
            }
        });

        $('.sel').on('change', function () {
            var id = $(this).val();
            window.location.href = base_url + 'cbtjadwal?id=' + id + '&type=' + opsiFilter.val() + '&mode=' + mode;
        });

        onChangeFilter(opsiFilter.val());

        // Instant Live Search
        $('#searchJadwalInput').on('keyup', function () {
            var query = $(this).val().toLowerCase();
            if (mode == '2') {
                $('.jadwal-card-item').each(function () {
                    var str = $(this).data('search') || $(this).text().toLowerCase();
                    $(this).toggle(str.indexOf(query) > -1);
                });
            } else {
                $('.jadwal-row-item').each(function () {
                    var str = $(this).data('search') || $(this).text().toLowerCase();
                    $(this).toggle(str.indexOf(query) > -1);
                });
            }
        });

        var unchecked = [];
        var checked = [];

        function findUnchecked() {
            unchecked = [];
            checked = [];
            var count = $('#konten-jadwal .check-jadwal').length;

            $("#konten-jadwal .check-jadwal:not(:checked)").each(function () {
                unchecked.push($(this).val());
            });
            $("#konten-jadwal .check-jadwal:checked").each(function () {
                checked.push($(this).val());
            });
            var countChecked = $("#konten-jadwal .check-jadwal:checked").length;
            $("#check-all").prop("checked", countChecked == count && count > 0);
            $("#submit-hapus").prop('disabled', countChecked == 0);
        }

        $("#konten-jadwal").on("change", ".check-jadwal", function () {
            findUnchecked();
        });

        $("#check-all").on("click", function () {
            var totalBoxes = $('#konten-jadwal .check-jadwal').length;
            if (totalBoxes > 0) {
                var isChecked = this.checked;
                $(".check-jadwal").each(function () {
                    this.checked = isChecked;
                });
                findUnchecked();
            }
        });

        $('#hapus_semua').on('submit', function (e) {
            e.stopPropagation();
            e.preventDefault();
            e.stopImmediatePropagation();

            var dataPost = $(this).serialize() + '&checked=' + JSON.stringify(checked);
            console.log(dataPost);

            swal.fire({
                title: "Anda yakin?",
                text: "Semua Jadwal Ujian yang dipilih akan dihapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hapus!"
            }).then(result => {
                if (result.value) {
                    swal.fire({
                        text: "Silahkan tunggu....",
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        onOpen: () => {
                            swal.showLoading();
                        }
                    });
                    $.ajax({
                        url: base_url + 'cbtjadwal/deletealljadwal',
                        type: "POST",
                        data: dataPost,
                        success: function (respon) {
                            console.log(respon);
                            if (respon.status) {
                                swal.fire({
                                    title: "Berhasil",
                                    text: "Jadwal berhasil dihapus",
                                    icon: "success"
                                }).then(result => {
                                    if (result.value) {
                                        window.location.reload();
                                    }
                                });
                            } else {
                                swal.fire({
                                    title: "Gagal",
                                    text: "Tidak bisa menghapus, " + respon.message,
                                    icon: "error"
                                });
                            }
                        },
                        error: function (xhr) {
                            console.log(xhr.responseText)
                            const err = JSON.parse(xhr.responseText)
                            swal.fire({
                                title: "Error",
                                text: err.Message,
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });

        $('#detailModal').on('show.bs.modal', function (e) {
            var jenis = $(e.relatedTarget).data('jenis');
            var kode = $(e.relatedTarget).data('kode');
            var mulai = $(e.relatedTarget).data('mulai');
            var sampai = $(e.relatedTarget).data('sampai');
            var durasi = $(e.relatedTarget).data('durasi');
            var acak_soal = $(e.relatedTarget).data('acaksoal');
            var acak_jawaban = $(e.relatedTarget).data('acakjawaban');
            var hasil_tampil = $(e.relatedTarget).data('hasiltampil');
            var pelanggaran = $(e.relatedTarget).data('pelanggaran');
            var kamera = $(e.relatedTarget).data('kamera');
            var token = $(e.relatedTarget).data('token');
            var reset = $(e.relatedTarget).data('reset');
            var status = $(e.relatedTarget).data('status');
            var rekap = $(e.relatedTarget).data('rekap');
            var total = $(e.relatedTarget).data('total');

            $('#modal_kode_jenis').text(jenis || '-');
            $('#modal_bank_kode').text(kode || '-');
            $('#modal_mulai').text(mulai || '-');
            $('#modal_sampai').text(sampai || '-');
            $('#modal_durasi').text((durasi ? durasi + ' menit' : '-'));
            $('#modal_acak_soal').text(acak_soal || '-');
            $('#modal_acak_opsi').text(acak_jawaban || '-');
            $('#modal_hasil_tampil').text(hasil_tampil || '-');
            $('#modal_pelanggaran').text(pelanggaran || '-');
            $('#modal_kamera').text(kamera || 'Tidak');
            var lk = parseInt($(e.relatedTarget).data('lockbrowser') || 0);
            var lkTxt = 'Bebas (Semua Browser)';
            if (lk === 1) lkTxt = 'Wajib Exambro Resmi (Android & PC)';
            else if (lk === 2) lkTxt = 'Hanya Exambro Android';
            else if (lk === 3) lkTxt = 'Hanya Exambro PC';
            $('#modal_lock_browser').text(lkTxt);
            $('#modal_token').text(token || '-');
            $('#modal_reset').text(reset || '-');
            $('#modal_status').text(status || '-');
            $('#modal_rekap').text(rekap || '-');
            $('#modal_total').text((total || '0') + ' Siswa');
        });

        if (infoRekap && infoRekap.ids_jadwal && infoRekap.ids_jadwal.length > 0) {
            swal.fire({
                text: "Silahkan tunggu....",
                allowEscapeKey: false,
                allowOutsideClick: false,
                onOpen: () => {
                    swal.showLoading();
                }
            });
            updateAgain(infoRekap.ids_jadwal);
        }
    });

    async function updateAgain(idsJadwal) {
        console.log('rekaps', infoRekap);
        let formData = new FormData($('#check')[0]);
        formData.append('ids_jadwal', JSON.stringify(idsJadwal));
        const checkRespons = await ajaxPost('cbtjadwal/get_all_norekap', formData);

        if (checkRespons.rekap.length > 0) {
            const result = await getAllItemsAndGroupByJadwalAndSiswa(checkRespons.rekap);

            const grouped = [];
            let lastJadwal = '0';
            result?.forEach((value) => {
                const idJadwal = value.id_jadwal || '0';
                const idBank = value.id_bank || '0';

                if (lastJadwal !== idJadwal) {
                    lastJadwal = idJadwal;
                }

                for (const siswa of value.siswaGroup || []) {
                    const idSiswa = siswa.id_siswa || '0';

                    let jawaban = [];
                    let nilai = [];
                    const soal = siswa.items[0];
                    jawaban[idJadwal] = jawaban[idJadwal] || [];
                    jawaban[idJadwal].push({
                        id_jadwal: idJadwal,
                        id_bank: idBank,
                        id_soal: soal.id_soal || '',
                        jenis: soal.jenis_soal || '',
                        no_soal_alias: soal.no_soal_alias || '',
                        opsi_alias_a: soal.opsi_alias_a || '',
                        opsi_alias_b: soal.opsi_alias_b || '',
                        opsi_alias_c: soal.opsi_alias_c || '',
                        opsi_alias_d: soal.opsi_alias_d || '',
                        opsi_alias_e: soal.opsi_alias_e || '',
                        jawaban_alias: soal.jawaban_alias || '',
                        jawaban_siswa: soal.jawaban_siswa || '',
                        jawaban_benar: soal.jawaban_benar || ''
                    });

                    nilai[idJadwal] = nilai[idJadwal] || [];
                    nilai[idJadwal].push({
                        id_jadwal: idJadwal,
                        id_bank: idBank,
                        id_soal: soal.id_soal || '',
                        point_soal: soal.point_soal || '',
                        nilai_koreksi: soal.nilai_koreksi || '',
                        nilai_otomatis: soal.nilai_otomatis || ''
                    });

                    let nilaiSiswa = {};
                    if (soal.id_nilai) {
                        nilaiSiswa = {
                            "id_nilai": soal.id_nilai,
                            "pg_benar": soal.pg_benar,
                            "pg_nilai": soal.pg_nilai,
                            "essai_nilai": soal.essai_nilai,
                            "id_siswa": soal.id_siswa,
                            "id_jadwal": soal.id_jadwal,
                            "kompleks_nilai": soal.kompleks_nilai,
                            "jodohkan_nilai": soal.jodohkan_nilai,
                            "isian_nilai": soal.isian_nilai,
                            "dikoreksi": soal.dikoreksi
                        };
                    }

                    let newSoalSiswa = {
                        id_siswa: idSiswa,
                        id_jadwal: idJadwal,
                        id_bank: idBank,
                        jawaban: JSON.stringify(jawaban[lastJadwal] || []),
                        nilai: JSON.stringify(nilai[lastJadwal] || []),
                        nilai_input: JSON.stringify(nilaiSiswa || {}),
                        reset_waktu: soal.reset_waktu || 0,
                        reset_izin: soal.reset_izin || 0,
                    };

                    if (soal.status) newSoalSiswa['status'] = soal.status;
                    if (soal.mulai) newSoalSiswa['mulai'] = soal.mulai;
                    if (soal.selesai) newSoalSiswa['selesai'] = soal.selesai;
                    if (soal.lama_ujian) newSoalSiswa['lama_ujian'] = soal.lama_ujian;

                    grouped.push(newSoalSiswa);
                }
            });

            console.log('grup', grouped);
            if (grouped.length > 0) {
                await postConvertedRekapNilai(grouped);
            }
        } else {
            swal.close();
        }
    }

    async function getAllItemsAndGroupByJadwalAndSiswa(allItems) {
        return new Promise((resolve, reject) => {
            const groupedByJadwal = allItems.reduce((acc, item) => {
                const id_jadwal = item.id_jadwal;
                const id_bank = item.id_bank;

                if (!acc[id_jadwal]) {
                    acc[id_jadwal] = {
                        id_bank,
                        siswaGroup: {}
                    };
                }
                const id_siswa = item.id_siswa;
                if (!acc[id_jadwal].siswaGroup[id_siswa]) {
                    acc[id_jadwal].siswaGroup[id_siswa] = [];
                }

                acc[id_jadwal].siswaGroup[id_siswa].push(item);
                return acc;
            }, {});

            const resultArray = Object.entries(groupedByJadwal).map(([id_jadwal, value]) => {
                return {
                    id_jadwal,
                    id_bank: value.id_bank,
                    siswaGroup: Object.entries(value.siswaGroup).map(([id_siswa, items]) => ({
                        id_siswa,
                        items
                    }))
                };
            });

            resolve(resultArray);
        });
    }

    async function postConvertedRekapNilai(data) {
        const pages = Math.ceil(data.length / 99);
        console.log('pages', pages);

        for (let i = 0; i < pages; i++) {
            let pagePost = i+1;
            const jadwals = await paginate(data, pagePost, 99);
            let formData = new FormData($('#check')[0]);
            let index = 0;
            for (const rekap of jadwals) {
                const ids = {
                    id_tp: rekap.id_tp || 0,
                    tp: rekap.tp || '',
                    id_smt: rekap.id_smt || 0,
                    smt: rekap.smt || '',
                    id_siswa: rekap.id_siswa || 0,
                    id_jadwal: rekap.id_jadwal || 0,
                    id_bank: rekap.id_bank || 0,
                    id_kelas: rekap.id_kelas || 0,
                    kelas: rekap.kelas || '',
                    mulai: rekap.mulai || '',
                    selesai: rekap.selesai || '',
                    lama_ujian: rekap.lama_ujian || 0,
                    status: rekap.status || 0,
                    nama_siswa: rekap.nama_siswa || '',
                    no_peserta: rekap.no_peserta || '',
                };
                formData.append(`nilai[${index}][ids]`, JSON.stringify(ids));
                formData.append(`nilai[${index}][jawaban]`, rekap.jawaban || '[]');
                formData.append(`nilai[${index}][nilai]`, rekap.nilai || '[]');
                formData.append(`nilai[${index}][ruang_sesi]`, rekap.ruang_sesi);
                formData.append(`nilai[${index}][nilai_input]`, rekap.nilai_input || '{}');
                index++;
            }
            const result = await ajaxPost('migrate/convert_rekap_nilai', formData);
            console.log('result', result);
        }
        swal.close();
    }

    async function paginate(data, pageNumber, itemsPerPage) {
        const startIndex = (pageNumber - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        return data.slice(startIndex, endIndex);
    }

    async function ajaxPost(url, formData) {
        return new Promise((resolve, reject) => {
            setTimeout(function () {
                $.ajax({
                    url: base_url + url,
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function (respon) {
                        if (respon.success) {
                            resolve(respon);
                        } else {
                            reject(respon.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        reject(error);
                    }
                });
            }, 500);
        });
    }
</script>
<?= $this->endSection() ?>
