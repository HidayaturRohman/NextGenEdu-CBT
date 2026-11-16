<?= $this->extend('layout/dashboard_template_bs5') ?>

<?= $this->section('content') ?>
<?php
$isNurulHakim = (strpos($_SERVER['HTTP_HOST'] ?? '', 'nurulhakim.sch.id') !== false || strpos(base_url(), 'nurulhakim.sch.id') !== false);
$isAdmin = isset($is_admin) ? $is_admin : ((string)session()->get('role') === '1');
$allBanksIds = [];
$jenjang = isset($setting->jenjang) ? $setting->jenjang : 1; 
$tp_id = isset($tp_active->id_tp) ? $tp_active->id_tp : '';
$smt_id = isset($smt_active->id_smt) ? $smt_active->id_smt : '';

// Flatten banks array
$flatBanks = [];
if (isset($banks) && is_array($banks)) {
    foreach ($banks as $tp_banks) {
        if (is_array($tp_banks)) {
            foreach ($tp_banks as $smt_banks) {
                if (is_array($smt_banks)) {
                    foreach ($smt_banks as $bank) {
                        $flatBanks[] = $bank;
                    }
                }
            }
        }
    }
}

// Calculate KPI statistics
$totalBankCount = count($flatBanks);
$countSiswa = 0;
$countJadwal = 0;
$countBebas = 0;
$totalButirSoal = 0;

foreach ($flatBanks as $b) {
    $totalButirSoal += (int)($b->total_soal ?? 0);
    if (isset($b->digunakan) && $b->digunakan == '0') {
        $countBebas++;
    } else {
        if (isset($total_siswa[$b->id_bank])) {
            $countSiswa++;
        } else {
            $countJadwal++;
        }
    }
}
?>

<style>
    .banksoal-kpi-card {
        border: 1px solid rgba(37, 99, 235, 0.15) !important;
        border-radius: 12px;
        background: #ffffff;
        transition: all 0.2s ease;
    }
    .banksoal-kpi-card:hover {
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
    .banksoal-filter-card {
        background: #f8fafc;
        border: 1px solid #cbd5e1 !important;
        border-radius: 12px;
        padding: 16px;
    }
    .banksoal-filter-card .select2-container--default .select2-selection--single {
        height: 40px !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        display: flex !important;
        align-items: center !important;
        padding-left: 8px !important;
        background-color: #ffffff !important;
    }
    .banksoal-filter-card .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 38px !important;
        color: #1e293b !important;
        font-size: 0.88rem !important;
    }
    .banksoal-filter-card .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px !important;
        right: 8px !important;
    }
    .banksoal-filter-card .input-group {
        display: flex !important;
        flex-wrap: nowrap !important;
        height: 40px !important;
    }
    .banksoal-filter-card .input-group-text {
        height: 40px !important;
        border: 1px solid #cbd5e1 !important;
        border-right: none !important;
        background: #ffffff !important;
        border-top-left-radius: 8px !important;
        border-bottom-left-radius: 8px !important;
    }
    .banksoal-filter-card #searchBankInput {
        height: 40px !important;
        border: 1px solid #cbd5e1 !important;
        border-left: none !important;
        border-top-right-radius: 8px !important;
        border-bottom-right-radius: 8px !important;
        font-size: 0.88rem !important;
    }
    .banksoal-filter-card #searchBankInput:focus {
        border-color: #2563eb !important;
        box-shadow: none !important;
    }
    .banksoal-filter-card .input-group:focus-within .input-group-text {
        border-color: #2563eb !important;
        color: #2563eb !important;
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
        padding: 16px 20px !important;
        background-color: #ffffff;
        border-top: 1px solid #e2e8f0;
        text-align: center;
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
          <div class="d-flex align-items-center min-w-0 me-2">
            <div class="me-3 flex-shrink-0">
              <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: #ffffff;">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                  <line x1="12" y1="11" x2="12" y2="17"></line>
                  <line x1="9" y1="14" x2="15" y2="14"></line>
                </svg>
              </div>
            </div>
            <div class="min-w-0">
              <h4 class="card-title mb-1 fw-bold text-dark text-truncate">
                  <?= $judul ?>
              </h4>
              <p class="text-muted mb-0 text-truncate" style="font-size: 0.88rem;">
                  Penyusunan naskah soal ujian, pilihan ganda, esai, pembobotan nilai, dan pengacakan butir soal.
              </p>
            </div>
          </div>
          <div class="d-flex align-items-center justify-content-end flex-wrap gap-2 flex-shrink-0">
            <a href="<?= base_url('cbtbanksoal?id=' . $id_guru . '&mode=' . $mode) ?>" class="btn btn-secondary shadow-sm d-inline-flex align-items-center" style="height: 40px; padding: 0.5rem 1rem; font-weight: 500; font-size: 0.88rem; border-radius: 8px;">
                <svg class="me-1.5" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.92-10.26l5.08 5.08"></path></svg> Reload
            </a>
            <button type="button" data-bs-toggle="modal" data-bs-target="#openAllBankSoal" class="btn btn-success shadow-sm d-inline-flex align-items-center" style="height: 40px; padding: 0.5rem 1rem; font-weight: 500; font-size: 0.88rem; border-radius: 8px;">
                <svg class="me-1.5" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg> Copy Bank Soal
            </button>
            <a href="<?= base_url('cbtbanksoal/addBank') ?>" class="btn btn-primary shadow-sm d-inline-flex align-items-center" style="height: 40px; padding: 0.5rem 1rem; font-weight: 500; font-size: 0.88rem; border-radius: 8px;">
                <svg class="me-1.5" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Tambah Bank Soal
            </a>
            <div class="btn-group shadow-sm ms-1" role="group">
                <?php $activeTable = $mode == '1' ? ' active btn-primary' : ' btn-outline-primary'; ?>
                <?php $activeGrid = $mode == '2' ? ' active btn-primary' : ' btn-outline-primary'; ?>
                <a href="<?= base_url('cbtbanksoal?mode=1&id=' . $id_guru) ?>" class="btn<?= $activeTable ?> d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 40px; padding: 0;" title="Tampilan Tabel">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>
                </a>
                <a href="<?= base_url('cbtbanksoal?mode=2&id=' . $id_guru) ?>" class="btn<?= $activeGrid ?> d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 40px; padding: 0;" title="Tampilan Kartu">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
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
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                    </div>
                    <div class="min-w-0">
                        <div class="kpi-pastel-title small">Total Bank Soal</div>
                        <div class="fs-4 fw-bold kpi-pastel-value"><?= $totalBankCount ?></div>
                        <div class="kpi-pastel-sub text-truncate" style="font-size: 0.72rem;">Semua mata pelajaran</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card kpi-pastel-card kpi-pastel-red border-0 shadow-sm h-100">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="kpi-pastel-icon me-3">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    </div>
                    <div class="min-w-0">
                        <div class="kpi-pastel-title small">Aktif Ujian Siswa</div>
                        <div class="fs-4 fw-bold kpi-pastel-value"><?= $countSiswa ?></div>
                        <div class="kpi-pastel-sub text-truncate" style="font-size: 0.72rem;">Siswa sedang mengerjakan</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card kpi-pastel-card kpi-pastel-amber border-0 shadow-sm h-100">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="kpi-pastel-icon me-3">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    </div>
                    <div class="min-w-0">
                        <div class="kpi-pastel-title small">Terjadwal Ujian</div>
                        <div class="fs-4 fw-bold kpi-pastel-value"><?= $countJadwal ?></div>
                        <div class="kpi-pastel-sub text-truncate" style="font-size: 0.72rem;">Menunggu jadwal pelaksanaan</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card kpi-pastel-card kpi-pastel-green border-0 shadow-sm h-100">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="kpi-pastel-icon me-3">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                    </div>
                    <div class="min-w-0">
                        <div class="kpi-pastel-title small">Draft / Siap Pakai</div>
                        <div class="fs-4 fw-bold kpi-pastel-value"><?= $countBebas ?></div>
                        <div class="kpi-pastel-sub text-truncate" style="font-size: 0.72rem;">Bisa diedit atau dihapus</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Filter, Legend & Bulk Action Toolbar Card -->
    <div class="banksoal-filter-card mb-4 shadow-sm">
        <!-- Top Row: Legend & Live Search -->
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 pb-3 mb-3 border-bottom">
            <div class="d-flex flex-wrap align-items-center gap-2">
                <span class="small fw-bold text-dark me-1"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1 text-primary"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle><line x1="4.93" y1="4.93" x2="9.17" y2="9.17"></line><line x1="14.83" y1="14.83" x2="19.07" y2="19.07"></line><line x1="14.83" y1="9.17" x2="19.07" y2="4.93"></line><line x1="4.93" y1="19.07" x2="9.17" y2="14.83"></line></svg> Status Bank:</span>
                <span class="legend-pill" title="Siswa sedang mengikuti ujian dengan bank soal ini">
                    <span class="legend-dot" style="background-color: #dc3545;"></span>
                    <span>Aktif Siswa</span>
                </span>
                <span class="legend-pill" title="Telah dijadwalkan pada kalender ujian">
                    <span class="legend-dot" style="background-color: #ffc107;"></span>
                    <span>Terjadwal</span>
                </span>
                <span class="legend-pill" title="Belum masuk jadwal, bebas diedit atau dihapus">
                    <span class="legend-dot" style="background-color: #6c757d;"></span>
                    <span>Draft / Bebas</span>
                </span>
            </div>
            <div class="flex-grow-1" style="max-width: 320px;">
                <div class="input-group">
                    <span class="input-group-text"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-muted"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></span>
                    <input type="text" id="searchBankInput" class="form-control" placeholder="Cari kode, mapel, guru, kelas...">
                </div>
            </div>
        </div>

        <!-- Bottom Row: Dropdown Filters & Bulk Actions -->
        <div class="row g-3 align-items-center" id="row-filter">
            <div class="col-12 col-md-7">
                <div class="d-flex flex-wrap align-items-center gap-2">
                    <div style="min-width: 170px;">
                        <select name="f" id="filter" class="form-control select2" data-placeholder="Filter berdasarkan:">
                            <option value=""></option>
                            <?php foreach ($filters as $k => $v): ?>
                                <option value="<?= $k ?>" <?= $id_filter === (string)$k ? 'selected' : '' ?>><?= $v ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div id="select-guru" class="d-none flex-grow-1" style="min-width: 200px;">
                        <select name="guru" id="guru" class="sel form-control select2" data-placeholder="Pilih guru:">
                            <option value=""></option>
                            <?php if (isset($gurus)) foreach ($gurus as $k => $v): ?>
                                <option value="<?= $k ?>" <?= $id_guru === (string)$k ? 'selected' : '' ?>><?= $v ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div id="select-mapel" class="d-none flex-grow-1" style="min-width: 200px;">
                        <select name="mapel" id="mapel" class="sel form-control select2" data-placeholder="Pilih mapel:">
                            <option value=""></option>
                            <?php if (isset($mapels)) foreach ($mapels as $k => $v): ?>
                                <option value="<?= $k ?>" <?= $id_mapel === (string)$k ? 'selected' : '' ?>><?= $v ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div id="select-level" class="d-none flex-grow-1" style="min-width: 200px;">
                        <select name="level" id="level" class="sel form-control select2" data-placeholder="Pilih level:">
                            <option value=""></option>
                            <?php if (isset($levels)) foreach ($levels as $k => $v): ?>
                                <option value="<?= $k ?>" <?= $id_level === (string)$k ? 'selected' : '' ?>><?= $v ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <?php if (!$isNurulHakim || $isAdmin): ?><div class="col-12 col-md-5 text-md-end">
                <form id="hapus_semua" class="d-inline-flex align-items-center gap-2">
                    <button id="submit-hapus" type="submit" class="btn btn-sm btn-outline-danger shadow-xs" disabled>
                        <i class="far fa-trash-alt me-1"></i> Hapus Terpilih
                    </button>
                    <div class="d-flex align-items-center gap-1.5 bg-white border px-2.5 py-1.5 rounded-3 shadow-xs">
                        <label for="check-all" class="small fw-semibold text-muted mb-0 user-select-none" style="font-size: 0.78rem; cursor: pointer;">Pilih Semua</label>
                        <input class="form-check-input check-all m-0" id="check-all" type="checkbox" style="width: 18px; height: 18px; cursor: pointer;">
                    </div>
                </form>
            </div><?php endif; ?>
        </div>
    </div>
    
    <!-- Items Container -->
    <div class="row" id="konten">
        <?php if (count($flatBanks) > 0) : ?>
            <?php if ($mode == '1'): ?>
            <!-- MODE 1: MODERN TABLE VIEW -->
            <div class="col-12 mb-4">
                <div class="table-responsive w-100 rounded-3 border bg-white shadow-sm">
                    <table class="w-100 table table-hover table-bordered table-modern align-middle mb-0" id="table-bank">
                        <thead>
                        <tr>
                            <th class="text-center align-middle p-2" style="width: 50px">No.</th>
                            <th class="align-middle">Kode &amp; Status</th>
                            <th class="align-middle">Mata Pelajaran</th>
                            <th class="align-middle">Target Kelas</th>
                            <th class="text-center align-middle" style="width: 100px">Butir Soal</th>
                            <th class="text-center align-middle p-2">Aksi</th>
                            <?php if (!$isNurulHakim || $isAdmin): ?><th class="text-center align-middle p-2" style="width: 45px">
                                <i class="far fa-check-square text-muted"></i>
                            </th><?php endif; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        foreach ($flatBanks as $bank): ?>
                            <?php
                            $jumlahKelas = is_string($bank->bank_kelas) ? json_decode($bank->bank_kelas) : $bank->bank_kelas;
                            $kelasbank = '';
                            $kelasSearchText = '';
                            $hasSemua = (isset($bank->bank_level) && ($bank->bank_level === '0' || $bank->bank_level === 0));
                            if (is_array($jumlahKelas) || is_object($jumlahKelas)) {
                                foreach ($jumlahKelas as $j) {
                                    $j = is_array($j) ? (object) $j : $j;
                                    if (isset($j->kelas_id) && ($j->kelas_id === '0' || $j->kelas_id === 0 || $j->kelas_id === 'all')) {
                                        $hasSemua = true;
                                        break;
                                    }
                                }
                                if ($hasSemua) {
                                    $kelasbank = '<span class="badge" style="background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>Semua Kelas</span>';
                                    $kelasSearchText = 'Semua Kelas';
                                } else {
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
                            }
                            
                            $isBebas = (isset($bank->digunakan) && $bank->digunakan == '0');
                            $isSedangUjian = !$isBebas && isset($total_siswa[$bank->id_bank]);
                            $isTerjadwal = !$isBebas && !$isSedangUjian;

                            if ($isBebas) {
                                $dotBg = 'background-color: #6c757d;';
                                $badgeStatus = '<span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">Draft / Bebas</span>';
                                $disable_edit = '';
                            } elseif ($isSedangUjian) {
                                $dotBg = 'background-color: #dc3545;';
                                $badgeStatus = '<span class="badge bg-danger-subtle text-danger border border-danger-subtle">Aktif Siswa</span>';
                                $disable_edit = 'disabled';
                            } else {
                                $dotBg = 'background-color: #ffc107;';
                                $badgeStatus = '<span class="badge bg-warning-subtle text-warning border border-warning-subtle">Terjadwal</span>';
                                $disable_edit = '';
                            }
                            ?>
                            <tr class="bank-row-item" data-search="<?= esc(strtolower($bank->bank_kode . ' ' . $bank->nama_mapel . ' ' . ($bank->nama_guru ?? '') . ' ' . $kelasSearchText)) ?>">
                                <td class="text-center align-middle fw-semibold text-muted"><?= $no ?></td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center gap-2">
                                        <div style="width: 12px; height: 12px; border-radius: 50%; flex-shrink: 0; <?= $dotBg ?>"></div>
                                        <div>
                                            <span class="fw-bold text-dark"><?= $bank->bank_kode ?></span>
                                            <div class="mt-0.5"><?= $badgeStatus ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div class="fw-bold text-dark"><?= $bank->nama_mapel ?></div>
                                    <div class="text-muted small mt-0.5">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1 text-primary"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg><?= $bank->nama_guru ?? 'N/A' ?>
                                        <span class="badge bg-light text-secondary border ms-1" style="font-size: 0.7rem;"><?= (isset($bank->soal_agama) && $bank->soal_agama != '-') ? $bank->soal_agama : 'Umum' ?></span>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex flex-wrap gap-1">
                                        <?= $kelasbank ?: '<span class="text-muted small">-</span>' ?>
                                    </div>
                                </td>
                                <td class="text-center align-middle">
                                    <?php if (isset($bank->total_soal) && $bank->total_soal == 0) : ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>0 Soal
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><polyline points="20 6 9 17 4 12"></polyline></svg><?= $bank->total_soal ?> Butir
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td class="text-center align-middle">
                                    <div class="d-inline-flex flex-wrap align-items-center justify-content-center gap-1">
                                        <span data-bs-toggle="tooltip" title="<?= $disable_edit == '' ? 'Edit Bank Soal' : 'Sedang dipakai ujian (tidak bisa diedit)' ?>">
                                            <a href="<?= $disable_edit == '' ? base_url('cbtbanksoal/editBank?id_bank=' . $bank->id_bank . '&id_guru=' . $bank->id_guru) : 'javascript:void(0)' ?>" 
                                               class="btn btn-outline-warning btn-sm <?= $disable_edit ?>" style="<?= $disable_edit == '' ? '' : 'cursor: not-allowed;' ?>">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                            </a>
                                        </span>
                                        <span data-bs-toggle="tooltip" title="Import Butir Soal">
                                            <button data-total="<?= $bank->total_soal ?? 0 ?>"
                                                    data-id="<?= $bank->id_bank ?>" onclick="importSoal(this)"
                                                    type="button" class="btn btn-warning btn-sm <?= $disable_edit ?>" <?= $disable_edit == '' ? '' : 'disabled' ?>>
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>Import
                                            </button>
                                        </span>
                                        <span data-bs-toggle="tooltip" title="Sinkronkan ke Ujian Siswa">
                                            <button onclick="syncBankToUjian(<?= $bank->id_bank ?>)" type="button" class="btn btn-outline-info btn-sm">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg>
                                            </button>
                                        </span>
                                        <span data-bs-toggle="tooltip" title="Detail / Kelola Soal">
                                            <a href="<?= base_url('cbtbanksoal/detail/' . $bank->id_bank) ?>" type="button" class="btn btn-primary btn-sm shadow-xs">
                                                <?php if (isset($bank->total_soal) && $bank->total_soal == 0) : ?>
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>Buat Soal
                                                <?php else: ?>
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>Detail
                                                <?php endif; ?>
                                            </a>
                                        </span>
                                        <span data-bs-toggle="tooltip" title="Download Ujian Kertas Word/Docx">
                                            <button data-id="<?= $bank->id_bank ?>"
                                                    data-kelas="<?= htmlspecialchars(is_array($bank->bank_kelas) ? json_encode($bank->bank_kelas) : $bank->bank_kelas) ?>"
                                                    data-mapel="<?= htmlspecialchars($bank->nama_mapel) ?>"
                                                    data-kode="<?= htmlspecialchars($bank->bank_kode) ?>"
                                                    data-level="<?= htmlspecialchars($bank->bank_level) ?>"
                                                    data-essai="<?= htmlspecialchars($bank->tampil_esai) ?>"
                                                    onclick="getSoal(this)" type="button"
                                                    class="btn btn-outline-secondary btn-sm">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                                <?php if (!$isNurulHakim || $isAdmin): ?>
                                <td class="text-center align-middle">
                                    <div class="form-check m-0 d-flex justify-content-center">
                                        <input name="checked[]" value="<?= $bank->id_bank ?>" class="form-check-input check-bank m-0" type="checkbox" style="width: 18px; height: 18px; cursor: pointer;">
                                    </div>
                                </td>
                                <?php endif; ?>
                            </tr>
                            <?php
                            $no++;
                        endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php else: ?>
                <!-- MODE 2: ELEGANT & SPACIOUS GRID VIEW -->
                <?php foreach ($flatBanks as $bank): ?>
                    <?php
                    $jumlahKelas = is_string($bank->bank_kelas) ? json_decode($bank->bank_kelas) : $bank->bank_kelas;
                    $kelasbank = '';
                    $kelasSearchText = '';
                    $hasSemua = (isset($bank->bank_level) && ($bank->bank_level === '0' || $bank->bank_level === 0));
                    if (is_array($jumlahKelas) || is_object($jumlahKelas)) {
                        foreach ($jumlahKelas as $j) {
                            $j = is_array($j) ? (object) $j : $j;
                            if (isset($j->kelas_id) && ($j->kelas_id === '0' || $j->kelas_id === 0 || $j->kelas_id === 'all')) {
                                $hasSemua = true;
                                break;
                            }
                        }
                        if ($hasSemua) {
                            $kelasbank = '<span class="badge" style="background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; font-size: 0.78rem;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>Semua Kelas</span>';
                            $kelasSearchText = 'Semua Kelas';
                        } else {
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
                    }
                    
                    $isBebas = (isset($bank->digunakan) && $bank->digunakan == '0');
                    $isSedangUjian = !$isBebas && isset($total_siswa[$bank->id_bank]);
                    $isTerjadwal = !$isBebas && !$isSedangUjian;

                    if ($isBebas) {
                        $bgHeader = 'background-color: #6c757d !important; color: #ffffff !important;';
                        $statusBadge = '<span class="badge bg-white text-secondary fw-bold shadow-xs" style="padding: 6px 10px; font-size: 0.8rem; border-radius: 6px;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="me-1" style="vertical-align: -2px;"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>Draft / Bebas</span>';
                        $disable_edit = '';
                    } elseif ($isSedangUjian) {
                        $bgHeader = 'background-color: #dc3545 !important; color: #ffffff !important;';
                        $statusBadge = '<span class="badge bg-white text-danger fw-bold shadow-xs" style="padding: 6px 10px; font-size: 0.8rem; border-radius: 6px;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="me-1" style="vertical-align: -2px;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>Aktif Siswa</span>';
                        $disable_edit = 'disabled';
                    } else {
                        $bgHeader = 'background-color: #ffc107 !important; color: #1e293b !important;';
                        $statusBadge = '<span class="badge bg-white text-dark fw-bold shadow-xs" style="padding: 6px 10px; font-size: 0.8rem; border-radius: 6px;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="me-1 text-warning" style="vertical-align: -2px;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>Terjadwal</span>';
                        $disable_edit = '';
                    }

                    $total_seharusnya = (int)$bank->tampil_pg + (int)$bank->tampil_kompleks + (int)$bank->tampil_jodohkan + (int)$bank->tampil_isian + (int)$bank->tampil_esai;
                    $total_ada = (int)($bank->total_soal ?? 0);

                    if ($total_ada == 0) {
                        $badgeSoal = '<span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1" style="font-size: 0.8rem;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>Belum dibuat</span>';
                    } elseif ($total_seharusnya > 0 && $total_ada < $total_seharusnya) {
                        $badgeSoal = '<span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1" style="font-size: 0.8rem;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>' . $total_ada . ' / ' . $total_seharusnya . ' Butir</span>';
                    } else {
                        $badgeSoal = '<span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1" style="font-size: 0.8rem;"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><polyline points="20 6 9 17 4 12"></polyline></svg>' . ($total_seharusnya > 0 ? $total_seharusnya : $total_ada) . ' Butir</span>';
                    }
                    ?>
                    <div class="col-md-6 col-lg-4 mb-4 bank-card-item" data-search="<?= esc(strtolower($bank->bank_kode . ' ' . $bank->nama_mapel . ' ' . ($bank->nama_guru ?? '') . ' ' . $kelasSearchText)) ?>">
                        <div class="card card-bank-soal h-100 d-flex flex-column">
                            <!-- Header: High-visibility solid bar with rounded top corners & generous padding -->
                            <div class="card-bank-header" style="<?= $bgHeader ?>">
                                <div class="bank-title-box">
                                    <?= $statusBadge ?>
                                    <span class="m-0 fw-bold text-truncate" style="font-size: 1.05rem;" title="<?= esc($bank->bank_kode) ?>">
                                        <?= esc($bank->bank_kode) ?>
                                    </span>
                                </div>
                                <div class="bank-actions-box">
                                    <span data-bs-toggle="tooltip" title="<?= $disable_edit == '' ? 'Edit Bank Soal' : 'Sedang dipakai ujian (tidak bisa diedit)' ?>">
                                        <a href="<?= $disable_edit == '' ? base_url('cbtbanksoal/editBank?id_bank=' . $bank->id_bank . '&id_guru=' . $bank->id_guru) : 'javascript:void(0)' ?>"
                                           class="btn btn-light shadow-xs d-flex align-items-center justify-content-center <?= $disable_edit ?>"
                                           style="width: 36px; height: 36px; padding: 0; border-radius: 8px; border: 1px solid rgba(0,0,0,0.08); <?= $disable_edit == '' ? '' : 'opacity: 0.5; cursor: not-allowed;' ?>">
                                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="#1e293b" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                            </svg>
                                        </a>
                                    </span>
                                    <?php if (!$isNurulHakim || $isAdmin): ?>
                                    <div class="bg-white rounded shadow-xs d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; padding: 0; border-radius: 8px; border: 1px solid rgba(0,0,0,0.08);">
                                        <input name="checked[]" value="<?= $bank->id_bank ?>"
                                               class="form-check-input check-bank m-0" type="checkbox"
                                               style="width: 19px; height: 19px; cursor: pointer;">
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Body: Full 7-Row Key-Value Details with Distinct Borders -->
                            <div class="card-body p-0 flex-grow-1">
                                <ul class="list-group list-group-flush mb-0">
                                    <li class="card-bank-item-row list-group-item">
                                        <span class="text-muted fw-semibold" style="font-size: 0.85rem;">
                                            <svg class="me-2 text-primary opacity-75" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>Guru
                                        </span>
                                        <span class="fw-bold text-dark text-end text-break ms-2" style="font-size: 0.88rem;">
                                            <?= esc($bank->nama_guru ?? 'N/A') ?>
                                        </span>
                                    </li>
                                    <li class="card-bank-item-row list-group-item">
                                        <span class="text-muted fw-semibold" style="font-size: 0.85rem;">
                                            <svg class="me-2 text-primary opacity-75" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>Mapel
                                        </span>
                                        <span class="fw-bold text-dark text-end text-break ms-2" style="font-size: 0.88rem;">
                                            <?= esc($bank->nama_mapel) ?>
                                        </span>
                                    </li>
                                    <li class="card-bank-item-row list-group-item">
                                        <span class="text-muted fw-semibold flex-shrink-0" style="font-size: 0.85rem;">
                                            <svg class="me-2 text-primary opacity-75" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>Kelas
                                        </span>
                                        <div class="text-end d-flex flex-wrap justify-content-end gap-1 ms-2">
                                            <?= $kelasbank ?: '<span class="text-muted small">-</span>' ?>
                                        </div>
                                    </li>
                                    <li class="card-bank-item-row list-group-item">
                                        <span class="text-muted fw-semibold" style="font-size: 0.85rem;">
                                            <svg class="me-2 text-primary opacity-75" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path><path d="M2 12l10 5 10-5"></path></svg>Agama
                                        </span>
                                        <span class="badge bg-light text-secondary border px-2 py-1 ms-2" style="font-size: 0.78rem;">
                                            <?= (isset($bank->soal_agama) && $bank->soal_agama != '-') ? $bank->soal_agama : 'Umum' ?>
                                        </span>
                                    </li>
                                    <li class="card-bank-item-row list-group-item">
                                        <span class="text-muted fw-semibold" style="font-size: 0.85rem;">
                                            <svg class="me-2 text-primary opacity-75" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3.01" y2="6"></line><line x1="3" y1="12" x2="3.01" y2="12"></line><line x1="3" y1="18" x2="3.01" y2="18"></line></svg>Jumlah Soal
                                        </span>
                                        <div class="ms-2">
                                            <?= $badgeSoal ?>
                                        </div>
                                    </li>
                                    <li class="card-bank-item-row list-group-item">
                                        <span class="text-muted fw-semibold" style="font-size: 0.85rem;">
                                            <svg class="me-2 text-primary opacity-75" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>Dibuat
                                        </span>
                                        <span class="text-muted text-end small fw-medium ms-2">
                                            <?= date('d M Y - H:i', strtotime($bank->date)) ?>
                                        </span>
                                    </li>
                                    <li class="card-bank-item-row list-group-item">
                                        <span class="text-muted fw-semibold" style="font-size: 0.85rem;">
                                            <svg class="me-2 text-primary opacity-75" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>Status
                                        </span>
                                        <div class="ms-2">
                                            <?php if (isset($bank->status) && $bank->status == '0'): ?>
                                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1" style="font-size: 0.78rem;">
                                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor" class="me-1"><circle cx="12" cy="12" r="10"></circle></svg>Non Aktif
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1" style="font-size: 0.78rem;">
                                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor" class="me-1"><circle cx="12" cy="12" r="10"></circle></svg>Aktif
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <!-- Footer: Spacious, Clearly Spaced Action Buttons -->
                            <div class="card-bank-footer">
                                <div class="row g-2 mb-2">
                                    <div class="col-6">
                                        <button data-total="<?= $bank->total_soal ?? 0 ?>"
                                                data-id="<?= $bank->id_bank ?>" onclick="importSoal(this)"
                                                type="button" <?= $disable_edit == '' ? '' : 'disabled' ?>
                                                class="btn btn-warning w-100 shadow-sm d-flex align-items-center justify-content-center <?= $disable_edit ?>"
                                                style="height: 38px; font-weight: 600; font-size: 0.85rem; border-radius: 8px;">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg> Import
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <a href="<?= base_url('cbtbanksoal/detail/' . $bank->id_bank) ?>"
                                           class="btn btn-success w-100 shadow-sm d-flex align-items-center justify-content-center"
                                           style="height: 38px; font-weight: 600; font-size: 0.85rem; border-radius: 8px;">
                                            <?php if (isset($bank->total_soal) && $bank->total_soal == 0) : ?>
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Buat Soal
                                            <?php else: ?>
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg> Detail Soal
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                </div>
                                <button onclick="syncBankToUjian(<?= $bank->id_bank ?>)" type="button"
                                        class="btn btn-outline-info w-100 mb-2 d-flex align-items-center justify-content-center"
                                        style="height: 36px; font-weight: 500; font-size: 0.82rem; border-radius: 8px;"
                                        title="Sinkronkan ke Ujian Siswa">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-2"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path></svg> Sinkronkan ke Ujian Siswa
                                </button>
                                <button data-id="<?= $bank->id_bank ?>"
                                        data-kelas="<?= htmlspecialchars(is_array($bank->bank_kelas) ? json_encode($bank->bank_kelas) : $bank->bank_kelas) ?>"
                                        data-mapel="<?= htmlspecialchars($bank->nama_mapel) ?>"
                                        data-kode="<?= htmlspecialchars($bank->bank_kode) ?>"
                                        data-level="<?= htmlspecialchars($bank->bank_level) ?>"
                                        data-essai="<?= htmlspecialchars($bank->tampil_esai) ?>"
                                        onclick="getSoal(this)" type="button"
                                        class="btn btn-primary w-100 shadow-sm d-flex align-items-center justify-content-center"
                                        style="height: 38px; font-weight: 600; font-size: 0.85rem; border-radius: 8px;"
                                        title="Download Ujian Kertas Word/Docx">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> Download Ujian Kertas
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php else: ?>
            <div class="col-12 mb-4">
                <div class="alert alert-warning text-center p-4 border shadow-sm" style="border-radius: 12px;" role="alert">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="mb-2 text-warning d-block mx-auto"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    <div class="fw-bold">Belum Ada Bank Soal</div>
                    <div class="text-muted small mt-1">Silakan sesuaikan pilihan filter di atas atau klik tombol <b>Tambah Bank Soal</b> untuk membuat bank soal baru.</div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
$allBanks = [];
if (isset($tp) && isset($smt)) {
    foreach ($tp as $thn) {
        foreach ($smt as $sem) {
            if (isset($banks[$thn->id_tp]) && isset($banks[$thn->id_tp][$sem->id_smt])) {
                $allBanks[] = [
                    'tahun' => $thn->tahun . ' SMT ' . $sem->smt,
                    'banks' => $banks[$thn->id_tp][$sem->id_smt]
                ];
            }
        }
    }
}
usort($allBanks, function ($a, $b) {
    return $b['tahun'] <=> $a['tahun'];
});
?>
<!-- Modal Copy Bank Soal -->
<div class="modal fade" id="openAllBankSoal" tabindex="-1" role="dialog" aria-labelledby="openBankSoalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content" style="border-radius: 14px; overflow: hidden;">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold" id="openBankSoalLabel">
                    <svg class="me-2 text-success" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>Copy Bank Soal dari Arsip
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <?php if (count($allBanks) > 0) : foreach ($allBanks as $allBank) : ?>
                    <div class="d-flex align-items-center gap-2 mb-2 mt-3">
                        <span class="badge bg-primary px-2.5 py-1.5 fw-semibold" style="font-size: 0.8rem;">
                            <svg class="me-1" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg><?= $allBank['tahun'] ?>
                        </span>
                        <div class="border-bottom flex-grow-1"></div>
                    </div>
                    <div class="table-responsive mb-4 rounded-3 border">
                        <table class="table table-striped table-bordered table-hover table-modern align-middle mb-0">
                            <thead>
                            <tr>
                                <th class="text-center align-middle p-2" style="width: 50px;">No.</th>
                                <th>Kode</th>
                                <th>Mapel</th>
                                <th>Target Kelas</th>
                                <th>TP/SMT</th>
                                <th class="text-center align-middle p-2" style="width: 100px">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($allBank['banks'] as $ab) : ?>
                                    <tr>
                                        <td class="text-center text-muted fw-semibold"><?= $no ?></td>
                                        <td><span class="fw-bold"><?= $ab->bank_kode ?></span></td>
                                        <td><?= $ab->nama_mapel ?></td>
                                        <td>
                                        <?php
                                        $jumlahKls = is_string($ab->bank_kelas) ? json_decode($ab->bank_kelas) : $ab->bank_kelas;
                                        $kls = '';
                                        if (is_array($jumlahKls) || is_object($jumlahKls)) {
                                            foreach ($jumlahKls as $j) {
                                                if (isset($kelas) && is_array($kelas)) {
                                                    foreach ($kelas as $k) {
                                                        if (isset($j->kelas_id) && $j->kelas_id == $k->id_kelas) {
                                                            $nama = $k->nama_kelas ?? $k->kode_kelas ?? $k->id_kelas;
                                                            $kls .= '<span class="badge-kelas me-1">' . $nama . '</span>';
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        echo $kls ?: '<span class="text-muted small">-</span>';
                                        ?>
                                        </td>
                                        <td><span class="badge bg-light text-dark border"><?= $allBank['tahun'] ?></span></td>
                                        <td class="text-center">
                                            <button onclick="copyBank(<?= $ab->id_bank ?>)" type="button" class="btn btn-sm btn-success shadow-xs">
                                                <svg class="me-1" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg> Copy
                                            </button>
                                        </td>
                                    </tr>
                                <?php $no++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endforeach; else: ?>
                    <div class="alert alert-info border-0 shadow-sm rounded-3">Belum ada data arsip bank soal pada tahun ajaran lain.</div>
                <?php endif; ?>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary shadow-xs" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Print Preview Area (Word Export) -->
<div id="for-siswa" class="d-none" style="width: 100%">
    <table id="table-header-print" style="width: 100%">
        <tr>
            <td>
                <img id="prev-logo-kiri-print" src="<?= base_url() . $setting->logo_kiri ?>" width="80px" height="80px">
            </td>
            <td class="text-center" style="text-align: center;">
                <div class="text-center" id="jenis-ujian" style="line-height: 1.1; font-family: 'Times New Roman'; font-size: 16pt"></div>
                <div class="text-center" style="line-height: 1.1; font-family: 'Times New Roman'; font-size: 14pt">
                    <b><?= $setting->sekolah ?></b>
                </div>
                <div class="text-center" style="line-height: 1.2; font-family: 'Times New Roman'; font-size: 13pt">
                    <b>KECAMATAN <?= strtoupper($setting->kecamatan ?? '') . ' KABUPATEN ' . strtoupper($setting->kota ?? '') ?></b>
                </div>
                <div class="text-center" style="line-height: 1.2; font-family: 'Times New Roman'; font-size: 12pt">
                    <b>TAHUN PELAJARAN: <?= strtoupper($tp_active->tahun ?? '') . ' SEMESTER ' . strtoupper($smt_active->smt ?? '') ?></b>
                </div>
            </td>
            <td>
                <img id="prev-logo-kanan-print" src="<?= base_url() . $setting->logo_kanan ?>" width="80px" height="80px">
            </td>
        </tr>
    </table>
    <hr style="border: 1px solid; margin-bottom: 6px; margin-top: 0px">
    <br>
    <p><b>I. Soal Pilihan Ganda</b></p>
    <ol id="list-pg"></ol>

    <p>&nbsp;</p>
    <p><b>II. Soal Pilihan Ganda Kompleks</b></p>
    <ol id="list-pg2"></ol>

    <p>&nbsp;</p>
    <p><b>III. Soal Menjodohkan</b></p>
    <ol id="list-jodohkan"></ol>

    <p>&nbsp;</p>
    <p><b>IV. Soal Isian Singkat</b></p>
    <ol id="list-isian"></ol>

    <p>&nbsp;</p>
    <p><b>V. Soal Uraian / Essai</b></p>
    <ol id="list-essai"></ol>

    <table id="jawaban-soal-siswa"></table>
</div>

<script type="text/javascript" src="<?= rtrim(base_url(), '/') ?>/assets/app/js/FileSaver.min.js"></script>
<script type="text/javascript" src="<?= rtrim(base_url(), '/') ?>/assets/app/js/html-docx.js"></script>
<script type="text/javascript" src="<?= rtrim(base_url(), '/') ?>/assets/app/js/convert-area.js"></script>
<script type="text/javascript" src="<?= rtrim(base_url(), '/') ?>/assets/app/js/jquery.wordexport.js"></script>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    var mode = '<?= $mode ?>';
    var idFilter = '<?= $id_filter ?>';
    var idMapel = '<?= $id_mapel ?>';
    var idLevel = '<?= $id_level ?>';
    var idGuru = '<?= $id_guru ?>';

    function syncBankToUjian(id) {
        Swal.fire({
            title: "Sinkronkan Bank Soal?",
            html: "Sistem akan memperbarui butir soal pada jadwal ujian terkait dan sesi siswa yang belum menjawab.",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3a57e8",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Sinkronkan",
            cancelButtonText: "Batal"
        }).then(result => {
            if (result.value || result.isConfirmed) {
                Swal.fire({
                    title: "Menyinkronkan...",
                    text: "Silakan tunggu proses sinkronisasi...",
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                $.ajax({
                    url: base_url + 'cbtbanksoal/syncToUjian/' + id,
                    type: "POST",
                    dataType: "json",
                    success: function (res) {
                        if (res && res.status) {
                            Swal.fire({
                                title: "Berhasil Disinkronkan",
                                text: res.message || "Bank Soal berhasil disinkronkan ke jadwal ujian!",
                                icon: "success"
                            });
                        } else {
                            Swal.fire({
                                title: "Perhatian",
                                text: (res && res.message) ? res.message : "Tidak ada jadwal ujian terkait untuk disinkronkan.",
                                icon: "info"
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            title: "Error",
                            text: "Gagal menyinkronkan ke jadwal ujian.",
                            icon: "error"
                        });
                    }
                });
            }
        });
    }

    function getSoal(e) {
        var id = $(e).data('id');
        var mapel = $(e).data('mapel') || 'Mata Pelajaran';
        var kode = $(e).data('kode') || '';
        var level = $(e).data('level') || '';

        Swal.fire({
            title: "Arsip Naskah Soal Ujian",
            html: '<div class="text-start" style="font-size: 13.5px; color: #334155;">' +
                  '  <p style="margin-bottom: 14px;">Pilih format dokumen untuk arsip hard file sekolah atau cetak fisik naskah soal:<br><b style="color: #1e40af;">' + mapel + ' (' + kode + ')</b></p>' +
                  '  <div class="d-grid gap-2 mb-2">' +
                  '    <a href="' + base_url + 'cbtbanksoal/downloadsoal/' + id + '" class="btn btn-primary text-white d-flex align-items-center justify-content-center py-2.5 shadow-sm" style="font-weight: 600; border-radius: 8px; font-size: 13.5px;" onclick="Swal.close()">' +
                  '      <i class="fa fa-file-word me-2"></i> Unduh Dokumen Word (.doc)' +
                  '    </a>' +
                  '    <a href="' + base_url + 'cbtbanksoal/cetaksoal/' + id + '" target="_blank" class="btn btn-outline-primary d-flex align-items-center justify-content-center py-2.5 shadow-sm" style="font-weight: 600; border-radius: 8px; font-size: 13.5px;" onclick="Swal.close()">' +
                  '      <i class="fa fa-print me-2"></i> Cetak / Print Langsung (Hard Copy)' +
                  '    </a>' +
                  '  </div>' +
                  '  <div class="p-2 rounded mt-2" style="background: #f8fafc; border: 1px solid #e2e8f0; font-size: 11px; color: #64748b; line-height: 1.45;">' +
                  '    <i class="fa fa-info-circle text-primary me-1"></i> Dokumen sudah rapi standar dinas: Dilengkapi Kop Resmi, Info Ujian, Butir Soal lengkap, dan Kunci Jawaban di halaman akhir.' +
                  '  </div>' +
                  '</div>',
            icon: "info",
            showConfirmButton: false,
            showCloseButton: true
        });
    }

    function importSoal(btn) {
        var idBank = $(btn).data('id');
        var total = $(btn).data('total');
        if (total > 0) {
            Swal.fire({
                title: "Import Soal?",
                html: "Soal sudah ada, mengimport soal baru akan menghapus soal terdahulu.<br>Lanjutkan import soal?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Lanjut"
            }).then(result => {
                if (result.value || result.isConfirmed) {
                    window.location.href = base_url + 'cbtbanksoal/importsoal/' + idBank;
                }
            });
        } else {
            window.location.href = base_url + 'cbtbanksoal/importsoal/' + idBank;
        }
    }

    $(document).ready(function () {
        var selectedF = idFilter == '' ? 'selected' : '';
        var selectedM = idMapel == '' ? 'selected' : '';
        var selectedL = idLevel == '' ? 'selected' : '';

        var opsiFilter = $('#filter');
        var opsiGuru = $('#guru');
        var opsiMapel = $('#mapel');
        var opsiLevel = $('#level');

        if ($.fn.select2) {
            opsiFilter.select2({width: '100%'});
            opsiGuru.select2({width: '100%'});
            opsiMapel.select2({width: '100%'});
            opsiLevel.select2({width: '100%'});
        }

        opsiGuru.prepend("<option value='' " + (idGuru == '' ? 'selected' : '') + " disabled='disabled'>Pilih guru:</option>");
        opsiMapel.prepend("<option value='' " + selectedM + " disabled='disabled'>Pilih mapel:</option>");
        opsiLevel.prepend("<option value='' " + selectedL + " disabled='disabled'>Pilih level:</option>");

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
            if (type == '0' && idFilter != '0') {
                window.location.href = base_url + 'cbtbanksoal?type=0&mode=' + mode;
            } else {
                onChangeFilter(type);
            }
        });

        $('.sel').on('change', function () {
            var id = $(this).val();
            window.location.href = base_url + 'cbtbanksoal?id=' + id + '&type=' + opsiFilter.val() + '&mode=' + mode;
        });

        onChangeFilter(opsiFilter.val());

        // Instant Live Search for Cards & Table Rows
        $('#searchBankInput').on('keyup input', function () {
            var keyword = $(this).val().toLowerCase().trim();
            if (mode == '1') {
                $('.bank-row-item').each(function () {
                    var str = $(this).data('search') || '';
                    $(this).toggle(str.indexOf(keyword) > -1);
                });
            } else {
                $('.bank-card-item').each(function () {
                    var str = $(this).data('search') || '';
                    $(this).toggle(str.indexOf(keyword) > -1);
                });
            }
        });
        
        var count = $('#konten .check-bank').length;
        var unchecked = [];
        var checked = [];

        function findUnchecked() {
            unchecked = [];
            checked = [];

            $("#konten .check-bank:not(:checked)").each(function () {
                unchecked.push($(this).val());
            });
            $("#konten .check-bank:checked").each(function () {
                checked.push($(this).val());
            });
            var countChecked = $("#konten .check-bank:checked").length;
            $("#check-all").prop("checked", countChecked > 0 && countChecked == count);
            $("#submit-hapus").prop('disabled', countChecked == 0);
        }

        $("#konten").on("change", ".check-bank", function () {
            findUnchecked();
        });

        $("#check-all").on("click", function () {
            if (count > 0) {
                var isChecked = this.checked;
                $(".check-bank").each(function () {
                    $(this).prop("checked", isChecked);
                });
                findUnchecked();
            }
        });

        $('#hapus_semua').on('submit', function (e) {
            e.preventDefault();
            if (checked.length == 0) {
                Swal.fire({
                    title: "",
                    text: "Pilih Bank Soal yang akan dihapus",
                    icon: "warning"
                });
                return;
            }

            Swal.fire({
                title: "Anda yakin?",
                text: "Semua Bank Soal yang terpilih akan dihapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then(result => {
                if (result.value || result.isConfirmed) {
                    Swal.fire({
                        text: "Silakan tunggu....",
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    var dataPost = $(this).serialize() + "&ids=" + JSON.stringify(checked);
                    $.ajax({
                        url: base_url + 'cbtbanksoal/deleteallbank',
                        type: "POST",
                        data: dataPost,
                        success: function (respon) {
                            if (respon.status) {
                                Swal.fire({
                                    title: "Berhasil",
                                    text: "Semua Bank soal terpilih berhasil dihapus",
                                    icon: "success"
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: "Gagal",
                                    text: "Tidak bisa menghapus: " + respon.message,
                                    icon: "error"
                                });
                            }
                        },
                        error: function () {
                            Swal.fire({
                                title: "Error",
                                text: "Terjadi kesalahan pada server",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });
    });

    function copyBank(id) {
        Swal.fire({
            title: "Copy Bank Soal?",
            html: "Bank Soal ini akan dicopy.<br />Periksa kembali kelas bank soal setelah copy.",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Copy"
        }).then(result => {
            if (result.value || result.isConfirmed) {
                Swal.fire({
                    text: "Silakan tunggu....",
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                $.ajax({
                    url: base_url + 'cbtbanksoal/copybanksoal/' + id,
                    type: "GET",
                    success: function (respon) {
                        if (respon.status || respon == true || respon == 'true' || respon == 1) {
                            Swal.fire({
                                title: "Berhasil",
                                text: "Bank Soal berhasil dicopy",
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: "Gagal",
                                text: "Tidak bisa mengcopy bank soal",
                                icon: "error"
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            title: "Error",
                            text: "Terjadi kesalahan",
                            icon: "error"
                        });
                    }
                });
            }
        });
    }
</script>
<?= $this->endSection() ?>
