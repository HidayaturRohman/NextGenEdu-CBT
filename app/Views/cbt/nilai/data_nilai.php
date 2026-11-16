<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hidayatur Rohman
 * Date: 07/07/20
 * Time: 17:20
 */

$colWidth = '';

$cols_name = ["PG", "PK", "JOD", "IS", "ES"];
?>

<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

<style>
.card-modern {
    border: none;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

.card-header-modern {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 12px 12px 0 0 !important;
}

.btn-modern {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.form-control-modern {
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    transition: all 0.3s;
}

.form-control-modern:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.table-modern thead th {
    background-color: #f8fafc;
    color: #475569;
    font-weight: 600;
    border-bottom: 2px solid #e2e8f0;
}

.table-modern tbody tr:hover {
    background-color: #f1f5f9;
    transition: background-color 0.2s;
}

.badge-custom {
    padding: 6px 12px;
    border-radius: 6px;
    font-weight: 600;
}

.alert-info-modern {
    background-color: #e0f2fe;
    border-left: 4px solid #0284c7;
    color: #0369a1;
}
</style>
<div class="card mb-4">
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center">
        <div class="me-3 flex-shrink-0">
          <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #d97706 0%, #b45309 100%); color: #ffffff;">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="18" y1="20" x2="18" y2="10"></line>
              <line x1="12" y1="20" x2="12" y2="4"></line>
              <line x1="6" y1="20" x2="6" y2="14"></line>
            </svg>
          </div>
        </div>
        <div>
          <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
              <?= $judul ?>
          </h4>
          <p class="text-muted mb-0" style="font-size: 0.9rem;">Rekapitulasi perolehan nilai tes CBT, analisis butir soal, koreksi otomatis, dan statistik kelulusan.</p>
        </div>
      </div>
      <?php if (isset($is_rekap)) : ?>
          <button onclick="window.history.back();" type="button" class="btn btn-sm btn-danger text-white">
              <i class="fas fa-arrow-circle-left me-1"></i><span>Kembali</span>
          </button>
      <?php endif; ?>
    </div>
  </div>
</div>

<?= form_open('', array('id' => 'post_data')) ?>
<div class="card card-modern mb-4">
    <div class="card-header card-header-modern align-items-center py-3 d-flex justify-content-between">
        <h6 class="card-title mb-0 fw-bold text-white"><i class="fas fa-chart-bar me-2"></i><?= isset($subjudul) ? $subjudul : $judul ?></h6>
        <div class="card-tools d-none" id="group-btn">
            <div class="d-flex flex-wrap gap-2">
                <button type="button" id="mark-all" class="btn btn-light btn-sm btn-modern me-1" data-bs-toggle="tooltip" title="Tandai semua siswa sudah dikoreksi">
                    <i class="fa fa-check-double text-success me-1"></i><span class="d-none d-md-inline-block fw-bold"> Tandai Sudah Dikoreksi</span>
                </button>
                <button type="button" id="import-essai" class="btn btn-light btn-sm btn-modern me-1" data-bs-toggle="tooltip" title="Input nilai manual tanpa koreksi">
                    <i class="fa fa-pencil text-primary me-1"></i><span class="d-none d-md-inline-block fw-bold"> Input Nilai</span>
                </button>
                <button type="button" class="btn btn-light btn-sm btn-modern me-1" id="btn-katrol">
                    <i class="fa fa-balance-scale-right text-warning me-1"></i><span class="d-none d-sm-inline-block fw-bold text-dark"> Katrol</span>
                </button>
                <div class="dropdown me-1">
                    <button class="btn btn-light btn-sm dropdown-toggle btn-modern fw-bold" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-file-excel text-success me-1"></i><span class="d-none d-md-inline-block"> Excel</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end shadow border-0">
                        <button id="download-nilai" class="btn dropdown-item" type="button"><i class="fas fa-download me-2 text-success"></i>Nilai</button>
                        <button id="download-detail" class="btn dropdown-item" type="button"><i class="fas fa-download me-2 text-info"></i>Detail</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body p-4">
        <div class="mb-3 row">
            <div class="col-12">
                <div class="alert alert-info-modern border-0 shadow-sm rounded p-3 mb-4">
                    <ul class="m-0 ps-3" style="list-style-type: disc;">
                        <li class="mb-1">
                            <span class="badge bg-danger badge-custom"><i class="fa fa-times me-1"></i> Set Fouls</span> untuk mengatur point pengurangan. Hanya aktif jika JADWAL ujian <b>mengaktifkan HITUNG PELANGGARAN.</b>
                        </li>
                        <li class="mb-1">
                            Di dalam tabel untuk mengatur manual pengurangan point per-siswa klik Tombol <span class="badge bg-danger badge-custom"><i class="fa fa-times me-1"></i> Foul</span>.
                        </li>
                        <li class="mb-1">
                            Nilai di kolom ASLI/KATROL yang <b>berwarna merah</b> adalah nilai yang terdampak pengurangan point pelanggaran.
                        </li>
                        <li>Kolom MINUS berisi total pengurangan point yang disebabkan pelanggaran ringan, sedang dan berat.</li>
                    </ul>
                </div>
            </div>

            <!-- Filter Left Side (Kelas, Jadwal, Urutkan) -->
            <div class="col-md-8 mb-3">
                <div class="row">
                    <div class="col-md-4 <?= isset($is_rekap) ? 'd-none' : '' ?>" id="by-kelas">
                        <label class="fw-bold text-secondary small mb-1">Kelas</label>
                        <?php echo form_dropdown('kelas', $kelas, $kelas_selected, 'id="kelas" class="form-select form-control-modern"'); ?>
                    </div>
                    <div class="col-md-4 <?= isset($is_rekap) ? 'd-none' : '' ?>">
                        <label class="fw-bold text-secondary small mb-1">Jadwal</label>
                        <?php echo form_dropdown('jadwal', $jadwal ?? [], $jadwal_selected, 'id="jadwal" class="form-select form-control-modern"'); ?>
                    </div>
                    <div class="col-md-4">
                        <label class="fw-bold text-secondary small mb-1">Urutkan</label>
                        <select id="sort-by" class="form-select form-control-modern">
                            <option value="peserta.nomor_peserta">No. Peserta</option>
                            <option value="siswa.nama">Nama Siswa</option>
                            <option value="siswa.nis">NIS</option>
                            <option value="siswa.nisn">NISN</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Filter Right Side (Cari Siswa, Filter Ketuntasan & Auto Refresh) -->
            <div class="col-md-4 mb-3 align-self-end">
                <div class="bg-light p-3 rounded border" style="border-color: #e2e8f0 !important;">
                    <div class="form-group mb-2">
                        <label class="fw-bold text-secondary small mb-1"><i class="fa fa-search text-primary me-1"></i> Cari Siswa</label>
                        <input type="text" id="searchNilai" class="form-control form-control-modern" placeholder="Ketik Nama, NIS, atau No. Peserta...">
                    </div>
                    <div class="form-group mb-2">
                        <label class="fw-bold text-secondary small mb-1"><i class="fa fa-filter text-info me-1"></i> Status Ketuntasan</label>
                        <select id="filterKetuntasan" class="form-select form-select-sm form-control-modern">
                            <option value="all">Semua Siswa</option>
                            <option value="tuntas">Tuntas (≥ KKM)</option>
                            <option value="remedial">Remedial (< KKM)</option>
                            <option value="belum">Belum Mengerjakan</option>
                        </select>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-3 pt-2 border-top">
                        <div class="form-check form-switch m-0">
                            <input type="checkbox" class="form-check-input" id="autoRefreshSwitch">
                            <label class="form-check-label fw-bold text-secondary small" for="autoRefreshSwitch">Auto Refresh</label>
                        </div>
                        <select id="refreshInterval" class="form-select form-select-sm form-control-modern" style="width: 110px;">
                            <option value="15000" selected>15 Detik</option>
                            <option value="30000">30 Detik</option>
                            <option value="45000">45 Detik</option>
                            <option value="60000">1 Menit</option>
                        </select>
                    </div>

                    <small id="countdown-display" class="text-primary d-block mt-2 d-none" style="font-size: 12px; font-weight: 600;">
                        <i class="fa fa-clock me-1"></i>Refresh berikutnya dalam: <span id="countdown-value">15</span> detik
                    </small>

                    <small class="text-muted d-block mt-1" style="font-size: 11px;"><i class="fa fa-info-circle me-1"></i> Aktif hanya jika Kelas & Jadwal dipilih</small>
                </div>
            </div>

            <div class="col-12 text-end mb-3">
                <button type="button" class="btn btn-outline-primary btn-sm btn-modern bg-white" onclick="refreshStatus()" data-bs-toggle="tooltip" title="Refresh Manual">
                    <i class="fa fa-sync me-1"></i> Refresh
                </button>
                <button type="button" class="btn btn-outline-danger btn-sm btn-modern bg-white" id="set-fouls" data-bs-toggle="modal" data-bs-target="#penguranganModal" title="Pengurangan Nilai">
                    <i class="fa fa-times me-1"></i> Set Fouls
                </button>
                <button type="button" class="btn btn-outline-warning btn-sm btn-modern bg-white" id="reset-fouls" onclick="resetFouls()">
                    <i class="fa fa-undo me-1"></i> Reset
                </button>
            </div>
        </div>

        <!-- Ringkasan Statistik Nilai & Visualisasi Grafik -->
        <div id="stats-wrapper" class="d-none mb-4">
            <div class="row g-3 mb-3">
                <!-- Stat Card: Rata-rata -->
                <div class="col-6 col-lg-3">
                    <div class="card border-0 shadow-sm rounded-3 h-100" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: white;">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-white-50 small fw-bold text-uppercase" style="font-size: 11px;">Rata-rata Nilai</div>
                                    <h3 class="fw-bold mb-0 mt-1 text-white" id="stat-avg">0</h3>
                                    <small class="text-white-50" id="stat-kkm-label" style="font-size: 11px;">KKM: 75</small>
                                </div>
                                <div class="bg-white bg-opacity-25 rounded-circle p-3 text-white">
                                    <i class="fas fa-calculator fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Stat Card: Tertinggi / Terendah -->
                <div class="col-6 col-lg-3">
                    <div class="card border-0 shadow-sm rounded-3 h-100" style="background: linear-gradient(135deg, #10b981 0%, #047857 100%); color: white;">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-white-50 small fw-bold text-uppercase" style="font-size: 11px;">Tertinggi / Terendah</div>
                                    <div class="d-flex align-items-baseline gap-1 mt-1">
                                        <h3 class="fw-bold mb-0 text-white" id="stat-max">0</h3>
                                        <span class="text-white-50 fs-5">/</span>
                                        <h4 class="fw-bold mb-0 text-white-50" id="stat-min">0</h4>
                                    </div>
                                    <small class="text-white-50" style="font-size: 11px;">Max: <span id="stat-max-sub">0</span> | Min: <span id="stat-min-sub">0</span></small>
                                </div>
                                <div class="bg-white bg-opacity-25 rounded-circle p-3 text-white">
                                    <i class="fas fa-trophy fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Stat Card: Tuntas -->
                <div class="col-6 col-lg-3">
                    <div class="card border-0 shadow-sm rounded-3 h-100" style="background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%); color: white;">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-white-50 small fw-bold text-uppercase" style="font-size: 11px;">Tuntas (≥ KKM)</div>
                                    <h3 class="fw-bold mb-0 mt-1 text-white"><span id="stat-tuntas">0</span> <span class="fs-6 fw-normal text-white-50">(<span id="stat-persen-tuntas">0%</span>)</span></h3>
                                    <small class="text-white-50" style="font-size: 11px;"><span id="stat-total-peserta">0</span> Siswa dinilai</small>
                                </div>
                                <div class="bg-white bg-opacity-25 rounded-circle p-3 text-white">
                                    <i class="fas fa-user-check fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Stat Card: Remedial -->
                <div class="col-6 col-lg-3">
                    <div class="card border-0 shadow-sm rounded-3 h-100" style="background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%); color: white;">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-white-50 small fw-bold text-uppercase" style="font-size: 11px;">Remedial (< KKM)</div>
                                    <h3 class="fw-bold mb-0 mt-1 text-white"><span id="stat-remedial">0</span> <span class="fs-6 fw-normal text-white-50">(<span id="stat-persen-remedial">0%</span>)</span></h3>
                                    <small class="text-white-50" style="font-size: 11px;">Perlu tindak lanjut</small>
                                </div>
                                <div class="bg-white bg-opacity-25 rounded-circle p-3 text-white">
                                    <i class="fas fa-user-times fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel Grafik & Pengaturan KKM Interaktif -->
            <div class="card border shadow-sm rounded-3 mb-3">
                <div class="card-header bg-light py-2 px-3 d-flex flex-wrap align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-chart-pie text-primary me-2"></i>
                        <span class="fw-bold text-dark small text-uppercase">Visualisasi Grafik & Ketuntasan Hasil Ujian</span>
                    </div>
                    <div class="d-flex align-items-center gap-2 mt-2 mt-sm-0">
                        <label class="small text-secondary fw-bold mb-0">Batas KKM:</label>
                        <input type="number" id="input-kkm" class="form-control form-control-sm text-center fw-bold form-control-modern" style="width: 70px;" value="75" min="0" max="100" step="1">
                        <button type="button" class="btn btn-sm btn-outline-secondary btn-modern bg-white py-1 px-2" id="btn-toggle-charts" title="Buka/Tutup Grafik">
                            <i class="fas fa-chevron-up" id="icon-toggle-charts"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-3" id="charts-body">
                    <div class="row">
                        <div class="col-md-5 mb-3 mb-md-0 border-end">
                            <h6 class="text-center fw-bold text-secondary small mb-2"><i class="fas fa-chart-pie text-success me-1"></i> Proporsi Ketuntasan Nilai</h6>
                            <div style="position: relative; height: 220px;">
                                <canvas id="chartKetuntasan"></canvas>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <h6 class="text-center fw-bold text-secondary small mb-2"><i class="fas fa-chart-bar text-primary me-1"></i> Distribusi Rentang Perolehan Nilai</h6>
                            <div style="position: relative; height: 220px;">
                                <canvas id="chartDistribusi"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!isset($is_rekap)) { echo '<hr class="my-3" />'; } ?>
        <div id="table-container"></div>
    </div>
    
    <div class="overlay d-none" id="loading" style="position: absolute; top:0; left:0; width:100%; height:100%; background: rgba(255,255,255,0.7); display:flex; justify-content:center; align-items:center; z-index:50;">
        <button class="btn btn-primary" type="button" disabled>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"> </span>
            Loading...
        </button>
    </div>
</div>
<?= form_close(); ?>

<div class="modal fade" id="perbaikanModal" tabindex="-1" role="dialog" aria-labelledby="perbaikanModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="perbaikanModalLabel">Perbaikan Nilai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('', array('id' => 'perbaikan-nilai')) ?>
            <div class="modal-body">
                <div class="form-group row mb-2">
                    <label for="nama_sesi" class="col-md-4 col-form-label">Nilai Tertinggi</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="ya" value="100"
                               placeholder="Nilai tertinggi yang diinginkan" required>
                        <small class="text-muted">diisi nilai puluhan maksimal 100, misal 80 sampai 100</small>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="kode_sesi" class="col-md-4 col-form-label">Nilai Terrendah</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="yb" value="60"
                               placeholder="Nilai terrendah yang diinginkan" required>
                        <small class="text-muted">diisi nilai puluhan dibawah nilai tertinggi, misal 60</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="convert">Katrol <i class="fa fa-arrow-right ms-1"></i>
                </button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="penguranganModal" tabindex="-1" role="dialog" aria-labelledby="penguranganLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="penguranganLabel">Atur Pengurangan Nilai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Pengurangan Point akan diterapkan ke seluruh siswa yang melakukan pelanggaran (Pengurangan Point X jumlah pelanggaran).
                    tetapi masih bisa merubahnya di masing-masing siswa</p>
                <table class="table w-100 table-bordered">
                    <tr class="bg-light">
                        <th class="align-middle">Jenis Pelanggaran</th>
                        <th>Pengurangan Point</th>
                    </tr>
                    <tr>
                        <td class="align-middle">Pelanggaran Ringan</td>
                        <td class="text-center">
                            <input type="number" class="form-control form-control-sm" value="0" step="0.5"
                                   min="0" id="p-ringan" style="max-width: 80px">
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Pelanggaran Sedang</td>
                        <td class="text-center">
                            <input type="number" class="form-control form-control-sm" value="0" step="0.5"
                                   min="0" id="p-sedang" style="max-width: 80px">
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">Pelanggaran Berat</td>
                        <td class="align-middle">
                            <input type="number" class="form-control form-control-sm" value="0" step="0.5"
                                   min="0" id="p-berat" style="max-width: 80px">
                        </td>
                    </tr>
                </table>
                <p>
                    Pengaturan ini tidak akan diterapkan ke siswa yang sudah diatur secara manual.
                </p>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="reset-all" name="reset-all">
                    <label class="form-check-label" for="reset-all">Terapkan juga ke siswa yang sudah diatur manual</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button class="btn btn-primary" id="save-min">Simpan</button>
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
                    <tr class="bg-light">
                        <th class="align-middle">Jenis Pelanggaran</th>
                        <th>Jml. Pelanggaran x Pengurangan Nilai</th>
                    </tr>
                    <tr>
                        <td>
                            Pelanggaran Ringan
                            <ul class="mb-0">
                                <li>Memulai ujian dengan tampilan tidak fullscreen</li>
                            </ul>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex flex-row align-items-center mb-2">
                                <span id="jml-ringan" class="text-nowrap fw-bold"></span><span class="ms-1 fw-bold">x</span>
                                <input type="number" class="form-control form-control-sm mx-2" value="" step="0.5"
                                       min="0" id="np-ringan" style="max-width: 80px">
                            </div>
                            <span class="me-1">dikurangi</span>
                            <span id="t-ringan" class="text-danger fw-bold">0</span> point
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Pelanggaran Sedang
                            <ul class="mb-0">
                                <li>Mencoba keluar dari fullscreen</li>
                            </ul>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex flex-row align-items-center mb-2">
                                <span id="jml-sedang" class="text-nowrap fw-bold"></span><span class="ms-1 fw-bold">x</span>
                                <input type="number" class="form-control form-control-sm mx-2" value="" step="0.5"
                                       min="0" id="np-sedang" style="max-width: 80px">
                            </div>
                            <span class="me-1">dikurangi</span>
                            <span id="t-sedang" class="text-danger fw-bold">0</span> point
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Pelanggaran Berat
                            <ul class="mb-0">
                                <li>Mencoba membuka tab baru</li>
                                <li>Keluar dari aplikasi sebelum selesai</li>
                                <li>Me-minimize browser</li>
                            </ul>
                        </td>
                        <td class="align-middle">
                            <div class="d-flex flex-row align-items-center mb-2">
                                <span id="jml-berat" class="text-nowrap fw-bold"></span><span class="ms-1 fw-bold">x</span>
                                <input type="number" class="form-control form-control-sm mx-2" value="" step="0.5"
                                       min="0" id="np-berat" style="max-width: 80px">
                            </div>
                            <span class="me-1">dikurangi</span>
                            <span id="t-berat" class="text-danger fw-bold">0</span> point
                        </td>
                    </tr>
                    <tr class="bg-light">
                        <td colspan="2">
                            <div>Nilai Siswa: <span id="min-nilai" class="fw-bold"></span></div>
                            <div>Pengurangan Point: <span class="fw-bold text-danger" id="total-pengurangan"></span></div>
                            <div>Nilai siswa setelah pengurangan: <span class="fw-bold text-danger" id="hasil-pengurangan"></span></div>
                        </td>
                    </tr>
                </table>
                <span id="min-idsiswa" class="d-none"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="save-fouls">Simpan</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript" src="<?= base_url() ?>/assets/app/js/tableToExcel.js?v=<?= time() ?>"></script>

<script>
    const limitAntrian = 500;
    const limitPost = 20;

    var colWidthMin = '5,28,14,14,35,8,12,10,15,6,6,10,8,8,8';
    var colWidth = '5,28,14,14,35,8,12,10,15,6,6,10,8,8,8';

    var idJadwal = '<?=$jadwal_selected?>';
    var idKelas = '<?=$kelas_selected?>';
    var isSelected = <?= $kelas_selected ?? 0?>;
    const isRekap = <?=isset($is_rekap) ? 1 : 0?>;
    var kodeMapel = '';
    var namaMapel = '';
    var jenisUjian = '';
    let arr_idSiswa = [];
    let arr_pelanggaran = [];
    let isBackFrom = false;

    let nilai_max = 0;
    let nilai_min = 100;
    let hasil_max = 100;
    let hasil_min = 60;
    let arrNilaiSiswa = [];
    let isConverted = false;
    let result;
    let chartKetuntasan = null;
    let chartDistribusi = null;
    let currentKkm = 75;

    async function ajaxGet(url) {
        return new Promise((resolve, reject) => {
            setTimeout(function () {
                $.ajax({
                    url: base_url + url,
                    type: "GET",
                    success: function (respon) {
                        resolve(respon);
                    },
                    error: function (xhr, status, error) {
                        reject(error);
                    }
                });
            }, 100);
        });
    }

    async function ajaxPost(url, formData) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: base_url + url,
                method: "POST",
                processData: false,
                contentType: false,
                data: formData,
                success: function (respon) {
                    if (typeof respon === 'string') {
                        try { 
                            respon = JSON.parse(respon); 
                        } catch(e) {
                            return reject("Server mengembalikan respons tidak valid (mungkin error 500/404).");
                        }
                    }
                    if (typeof respon === 'object' && respon !== null && respon.success !== false) {
                        resolve(respon);
                    } else {
                        reject(respon ? (respon.message || 'Gagal memuat data') : 'Gagal memuat data');
                    }
                },
                error: function (xhr, status, error) {
                    console.error("ajaxPost error:", xhr.responseText);
                    reject(error);
                }
            });
        });
    }

    function refreshStatus() {
        const jadwal = isRekap ? idJadwal : $('#jadwal').val();
        const kelas = isRekap ? idKelas : $('#kelas').val();
        console.log('refresh', jadwal, kelas);
        if (jadwal && kelas) {
            let post = {
                'id_jadwal': jadwal,
                'id_kelas': kelas
            };
            getNilai(post);
        }
    }

    function lihatJawaban(idSiswa) {
        let post = {
            'id_jadwal': idJadwal,
            'id_kelas': isRekap ? idKelas : $("#kelas").val()
        };
        localStorage.setItem('garudaCBT.convert', JSON.stringify(post));
        localStorage.setItem('garudaCBT.last_url', 'input_nilai');
        if (isRekap) {
            window.location.href = base_url + 'cbtrekap/koreksi?id_siswa=' + idSiswa + '&id_jadwal=' + idJadwal;
        } else {
            window.location.href = base_url + 'cbtnilai/koreksi?id_siswa=' + idSiswa + '&id_jadwal=' + idJadwal;
        }
    }

    function getKelasJadwal(idKelas) {
        if (!idKelas) return;
        $.ajax({
            type: "GET",
            url: base_url + "cbtstatus/getjadwalujianbykelas?id_kelas=" + idKelas,
            cache: false,
            success: function (response) {
                if (typeof response === 'string') {
                    try { response = JSON.parse(response); } catch(e) {}
                }
                var selJadwal = $('#jadwal');
                selJadwal.empty();
                selJadwal.append('<option value="">Pilih Jadwal</option>');
                if (response && typeof response === 'object') {
                    $.each(response, function (k, v) {
                        if (v != null) {
                            selJadwal.append('<option value="' + k + '">' + v + '</option>');
                        }
                    });
                }
                if ($.fn.select2) {
                    selJadwal.trigger('change');
                }
                if (isBackFrom && idJadwal) {
                    selJadwal.val(idJadwal).trigger('change');
                    isBackFrom = false;
                }
            }
        });
    }

    function downloadExcel(detail) {
        $('#no-soal-tile').attr('data-exclude', '' + !detail);
        $('.no-soal').attr('data-exclude', '' + !detail);
        $('.no-soal-siswa').attr('data-exclude', '' + !detail);

        var width = $('#table-status').attr('data-cols-width');
        $('#table-status').attr('data-cols-width', detail ? colWidth : colWidthMin);

        var table = document.querySelector("#table-status");
        const nilaiDetail = detail ? 'Nilai Detail' : 'Nilai';
        if (table != null) {
            TableToExcel.convert(table, {
                name: `${nilaiDetail} ${jenisUjian} ${$("#kelas option:selected").text()} ${namaMapel}.xlsx`,
                sheet: {
                    name: "Sheet 1"
                }
            });
        } else {
            Swal.fire({
                title: "ERROR",
                text: "Isi JADWAL dan KELAS terlebih dulu",
                icon: "error"
            });
        }
    }

    async function getNilai(post) {
        isConverted = false;
        $('#group-btn').addClass('d-none');
        if (!isRekap && (!post || !post.id_jadwal)) {
            $('#loading').addClass('d-none');
            return;
        }

        document.getElementById('table-container').innerHTML = '';
        $('#loading').removeClass('d-none');
        let formEl = document.getElementById('post_data');
        let formData = formEl ? new FormData(formEl) : new FormData();

        if (post) {
            for (const key in post) {
                formData.append(key, post[key]);
            }
        } else {
            formData.append(`id_jadwal`, idJadwal);
            formData.append(`id_kelas`, idKelas);
        }

        try {
            if (isRekap) {
                const response = await ajaxPost('cbtrekap/get_nilai_rekap', formData);
                console.log('responseRekap', response);

                idKelas = response.kelas_selected;
                idJadwal = response.jadwal_selected;
                result = {
                    jadwal: {
                        ...response.rekap?.jadwal,
                        bank: response.rekap?.bank_soal,
                        sesisiswa: response.rekap?.rekapsiswa,
                        soal_pg: response.rekap?.soal_pg
                    },
                    nama_mapel: response.rekap?.nama_mapel,
                    kelas: response.kelas,
                    nama_guru: response.rekap?.nama_guru,
                    kode_jenis: response.rekap?.kode_jenis,
                    durasi_siswa: response.durasi_siswa
                };
            } else {
                const response = await ajaxPost('cbtnilai/get_nilai_siswa', formData);
                console.log('responseCbtSiswa', response);

                idKelas = response.kelas_selected;
                idJadwal = response.jadwal_selected;
                result = response;
            }
            await populateTable($('#sort-by').val());
        } catch (e) {
            console.error('getNilai error:', e);
            $('#loading').addClass('d-none');
        }
    }

    async function populateTable(sortBy = "peserta.nomor_peserta") {
        if (!result || !result.jadwal) {
            $('#loading').addClass('d-none');
            return;
        }

        console.log('populateTable', result.jadwal);
        $('#set-fouls').prop('disabled', result.jadwal?.pelanggaran != '1');
        $('#reset-fouls').prop('disabled', result.jadwal?.pelanggaran != '1');
        const cols_name = ["PG", "PK", "JOD", "IS", "ES"];
        const durasiSiswa = result.durasi_siswa ?? [];
        let rawSiswas = result.jadwal?.sesisiswa || result.jadwal?.siswas || result.jadwal?.siswa || result.siswas || result.siswa || [];
        let siswas = Array.isArray(rawSiswas) ? rawSiswas : (typeof rawSiswas === 'object' && rawSiswas !== null ? Object.values(rawSiswas) : []);
        const info = result.jadwal?.bank || {};
        if (info.kkm && Number(info.kkm) > 0) {
            currentKkm = Number(info.kkm);
        } else {
            let inputKkmVal = Number($('#input-kkm').val());
            if (inputKkmVal > 0) currentKkm = inputKkmVal;
            else currentKkm = 75;
        }
        $('#input-kkm').val(currentKkm);
        $('#stat-kkm-label').text('KKM: ' + currentKkm);
        const kelas = result.kelas || {};
        namaMapel = info.mapel?.nama_mapel ?? result.nama_mapel ?? '';
        kodeMapel = info.mapel?.kode_mapel ?? result.kode_mapel ?? '';
        jenisUjian = result.jadwal?.jenis?.kode_jenis ?? result.kode_jenis ?? '';
        arr_pelanggaran = [];
        if (Array.isArray(siswas) && siswas.length > 0) {
            const sortSplit = sortBy.split('.')
            siswas.sort((a, b) => {
                const valA = a?.[sortSplit[0]]?.[sortSplit[1]] || '';
                const valB = b?.[sortSplit[0]]?.[sortSplit[1]] || '';
                return valA.localeCompare(valB, undefined, {numeric: true});
            });
            if (isRekap) {
                if (sortSplit[1] === 'nomor_peserta') {
                    siswas.sort((a, b) => (a?.no_peserta || '').localeCompare(b?.no_peserta || '', undefined, {numeric: true}))
                }
            }

            let cols = [info.tampil_pg, info.tampil_kompleks, info.tampil_jodohkan, info.tampil_isian, info.tampil_esai];
            cols = cols.filter(function (count){return count != 0});
            let rows = cols.length > 1 ? 1 : 2;

            // Kolom utama: No(5), No.Peserta(28), NIS(14), NISN(14), Nama(35), Sesi(8), Ruang(12), Mulai(10), Durasi(15)
            const baseCols = '5,28,14,14,35,8,12,10,15';
            let scoreCols = '';
            if (info.tampil_pg > 0) {
                scoreCols += ',6,6,10'; // B, S, Skor PG
            }
            if (info.tampil_kompleks > 0) scoreCols += ',8';
            if (info.tampil_jodohkan > 0) scoreCols += ',8';
            if (info.tampil_isian > 0)    scoreCols += ',8';
            if (info.tampil_esai > 0)     scoreCols += ',8';

            scoreCols += ',12,10,8'; // Asli, Katrol, Minus

            colWidthMin = baseCols + scoreCols;

            colWidth = baseCols;
            if (info.tampil_pg > 0) {
                colWidth += ',4'.repeat(info.tampil_pg || 0);
            }
            colWidth += scoreCols;

            let totalSoal = Number(info.tampil_pg || 0) + Number(info.tampil_kompleks || 0) + Number(info.tampil_jodohkan || 0) + Number(info.tampil_isian || 0) + Number(info.tampil_esai || 0);
            let html = `<div class="table-responsive">
                        <table class="w-100 table table-sm table-bordered table-modern" id="table-status" data-cols-width="${colWidthMin}">
                            <tr>
                                <td colspan="2">Mata Pelajaran</td>
                                <td colspan="7">${namaMapel}</td>
                            </tr>
                            <tr>
                                <td colspan="2">Kelas</td>
                                <td colspan="7">${kelas[idKelas] || ''}</td>
                            </tr>
                            <tr>
                                <td colspan="2">Guru</td>
                                <td colspan="7">${result.nama_guru ?? info.guru?.nama_guru ?? ''}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="width: 120px">Soal</td>
                                <td colspan="7">${info.bank_kode || ''}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="align-top">Jumlah Soal</td>
                                <td colspan="7" class="align-top">${totalSoal}</td>
                            </tr>
                            <tr><td class="border-0" height="40"></tr>
                            <tr class="bg-light">
                                <th rowspan="2" class="text-center align-middle" width="40" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true" >No.</th>
                                <th rowspan="2" class="text-center align-middle" width="100" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true" >No. Peserta</th>
                                <th rowspan="2" class="text-center align-middle" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true" >NIS</th>
                                <th rowspan="2" class="text-center align-middle" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true" >NISN</th>
                                <th rowspan="2" class="text-center align-middle" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true" >Nama</th>
                                <th rowspan="2" class="text-center align-middle" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true">Sesi</th>
                                <th rowspan="2" class="text-center align-middle" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true">Ruang</th>
                                <th rowspan="2" class="text-center align-middle" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true">Mulai</th>
                                <th rowspan="2" class="text-center align-middle" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true">Durasi</th>`;

            if (info.tampil_pg > 0) {
                html += `<th id="no-soal-tile" colspan="${info.tampil_pg}" class="text-center align-middle d-none" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true" >Nomor Soal PG</th>
                 <th colspan="2" class="text-center align-middle" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true" >PG</th>`;
            }

            html += `<th colspan="${cols.length}" rowspan="${rows}" class="text-center align-middle" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true" >Skor ${cols.length > 1 ? "" : cols_name[Object.keys(cols)[0]]}</th>
             <th colspan="3" class="text-center align-middle" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true" >Nilai</th>
             <th rowspan="2" class="text-center align-middle" data-exclude="true" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true" >Aksi</th>
             </tr>
             <tr class="bg-light">`;

            for (let js = 0; js < info.tampil_pg; js++) {
                html += `<th class="no-soal text-center align-middle p-1 d-none" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true" >${js + 1}</th>`;
            }

            if (info.tampil_pg > 0) {
                html += `<th class="text-center align-middle" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true" >B</th>
                 <th class="text-center align-middle" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true" >S</th>`;
            }

            if (rows === 1) {
                if (info.tampil_pg > 0) {
                    html += `<th class="text-center align-middle p-1" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true" >PG</th>`;
                }
                if (info.tampil_kompleks > 0) {
                    html += `<th class="text-center align-middle" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true" >PK</th>`;
                }
                if (info.tampil_jodohkan > 0) {
                    html += `<th class="text-center align-middle" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true" >JO</th>`;
                }
                if (info.tampil_isian > 0) {
                    html += `<th class="text-center align-middle" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true" >IS</th>`;
                }
                if (info.tampil_esai > 0) {
                    html += `<th class="text-center align-middle" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true" >ES</th>`;
                }
            }

            html += `<th class="text-center align-middle" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true" >Asli</th>
             <th class="text-center align-middle" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true" >Katrol</th>
             <th class="text-center align-middle" data-fill-color="b8daff" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-f-bold="true" >Minus</th>
             </tr>`;

            const hanyaPg = info.tampil_pg > 0 && info.tampil_kompleks == 0
                && info.tampil_jodohkan == 0 && info.tampil_isian == 0
                && info.tampil_esai == 0;

            arr_idSiswa = [];
            let arrScores = [];
            let no = 1;
            siswas.forEach((siswa) => {
                let idSiswa = siswa?.siswa?.id_siswa || siswa.id_siswa;
                let sudah_selesai = siswa?.durasi?.status === '2' || siswa?.durasi?.status === 2 || (siswa?.durasi?.selesai && siswa?.durasi?.selesai !== '');
                let sudah_hadir = (siswa?.durasi?.mulai && siswa?.durasi?.mulai !== '') || sudah_selesai;

                let disable = !sudah_hadir || (!sudah_selesai && (siswa?.durasi?.mulai_ujian?.includes('-') ?? false));
                let disableKoreksi = disable || (!sudah_selesai && (siswa?.durasi?.selesai === '' || !siswa?.durasi?.selesai));
                let disabled = disableKoreksi ? 'disabled' : '';

                const idDikoreksi = {
                    id_siswa: idSiswa,
                    memulai: disable ? '2' : (siswa?.nilai_akhir?.dikoreksi ? '1' : '0')
                };
                arr_idSiswa.push(idDikoreksi);

                const pel = siswa?.pelanggaran;
                if (pel) {
                    const siswaFoul = {
                        'id_siswa': idSiswa,
                        'id_cbt_siswa': siswa.id_cbt_siswa || '',
                        'id_rekap_siswa': siswa.id_rekap_siswa || '',
                        'pelanggaran': pel
                    };
                    arr_pelanggaran.push(siswaFoul);
                }

                const textColor = result.jadwal?.pelanggaran === '1' && pel?.t_total != null && pel?.t_total > 0 ? 'text-danger' : 'text-body';
                const totalMinus = result?.jadwal?.pelanggaran === '1' ? (pel?.t_total || 0) : 0;
                const skorAsli = siswa?.nilai_akhir?.skor_total || 0;
                const skorTotal = skorAsli - totalMinus;
                let skorKatrol = '';

                if (isConverted) {
                    if (siswa?.durasi?.status_ujian) skorKatrol = (((hasil_max - hasil_min) / 100) * decimalFixed(skorTotal)) + hasil_min;
                    if (skorKatrol !== '') skorKatrol = decimalFixed(skorKatrol);
                    if (skorKatrol < skorTotal) skorKatrol = decimalFixed(skorTotal);
                } else {
                    if (decimalFixed(skorTotal) > nilai_max) {
                        nilai_max = decimalFixed(skorTotal);
                    }
                    if (decimalFixed(skorTotal) < nilai_min) {
                        nilai_min = decimalFixed(skorTotal);
                    }
                }

                let skorFinal = isConverted && skorKatrol !== '' ? parseFloat(skorKatrol) : parseFloat(skorTotal);
                skorFinal = isNaN(skorFinal) ? 0 : Math.round(skorFinal * 100) / 100;

                let statusKetuntasan = 'belum';
                let isTuntas = false;
                if (!disable) {
                    isTuntas = (skorFinal >= currentKkm);
                    statusKetuntasan = isTuntas ? 'tuntas' : 'remedial';
                    arrScores.push(skorFinal);
                }

                let badgeKetuntasan = '';
                if (!disable) {
                    badgeKetuntasan = isTuntas 
                        ? ` <br><span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 badge-ketuntasan" data-exclude="true" style="font-size: 10px; padding: 2px 6px;">Tuntas</span>`
                        : ` <br><span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 badge-ketuntasan" data-exclude="true" style="font-size: 10px; padding: 2px 6px;">Remedial</span>`;
                }

                const mulai = () => {
                    const start = result?.jadwal?.tgl_mulai?.replaceAll('-', '');
                    const time = siswa?.durasi?.mulai?.split(' ')[0].replaceAll('-', '');
                    const timeSiswa = new Date(siswa?.durasi?.mulai ?? '');
                    if (!isNaN(timeSiswa.getTime())) {
                        let susulan = '';
                        if (time > start) susulan = '<br /><span class="text-xs">susulan</span>';
                        return `${zeroPad(timeSiswa.getHours(), 2)}:${zeroPad(timeSiswa.getMinutes(), 2)} ${susulan}`;
                    } else {
                        return '- : -';
                    }
                };

                html += `<tr class="row-siswa" data-status-ketuntasan="${statusKetuntasan}" data-skor="${skorFinal}" data-disable="${disable ? '1' : '0'}">
        <td class="text-center align-middle" data-a-v="middle" data-a-h="center" data-b-a-s="thin">${no}</td>
        <td class="text-center align-middle" data-a-v="middle" data-a-h="center" data-b-a-s="thin">${siswa?.no_peserta ?? siswa?.peserta?.nomor_peserta ?? '-'}</td>
        <td class="text-center align-middle" data-a-v="middle" data-a-h="center" data-b-a-s="thin">${siswa?.siswa?.nis ?? siswa?.nis ?? '-'}</td>
        <td class="text-center align-middle" data-a-v="middle" data-a-h="center" data-b-a-s="thin">${siswa?.siswa?.nisn ?? siswa?.nisn ?? '-'}</td>
        <td class="align-middle" data-a-v="middle" data-b-a-s="thin" style="min-width: 150px">${siswa?.siswa?.nama ?? siswa.nama_siswa}</td>
        <td class="text-center align-middle" data-a-v="middle" data-a-h="center" data-b-a-s="thin">${siswa?.sesi?.kode_sesi ?? siswa?.ruang_sesi?.sesi?.kode_sesi ?? '-'}</td>
        <td class="text-center align-middle" data-a-v="middle" data-a-h="center" data-b-a-s="thin">${siswa?.ruang?.kode_ruang ?? siswa?.ruang_sesi?.ruang?.kode_ruang ?? '-'}</td>
        <td class="text-center align-middle" data-a-v="middle" data-a-h="center" data-b-a-s="thin">${mulai()}</td>
        <td class="text-center align-middle" data-a-v="middle" data-a-h="center" data-b-a-s="thin">${siswa?.durasi?.status_ujian ?? ''}</td>`;

                let benar_pg = 0;
                let salah_pg = 0;
                let jawaban_pg = siswa?.nilai_akhir?.skor_pg?.detail ?? [];

                result?.jadwal?.soal_pg?.forEach((soal) => {
                    const num = soal.nomor_soal;
                    const jwb = jawaban_pg.find(j => (j.nomor == num || (j.id_soal && soal.id_soal && j.id_soal == soal.id_soal)));
                    let bg = '';
                    if (jwb) {
                        if (jwb?.benar) {
                            bg = 'data-fill-color="00E676"';
                            benar_pg++;
                        } else {
                            bg = 'data-fill-color="FF7043"';
                            salah_pg++;
                        }
                    }
                    html += `<td class="no-soal-siswa d-none" data-a-v="middle" data-a-h="center" data-b-a-s="thin" ${bg}>${jwb?.jawaban_siswa ?? ''}</td>`;
                });

                if (info.tampil_pg > 0) {
                    html += `<td class="text-success text-center align-middle" data-a-v="middle" data-a-h="center" data-b-a-s="thin"><b>${disable ? '' : benar_pg}</b></td>
                 <td class="text-danger text-center align-middle" data-a-v="middle" data-a-h="center" data-b-a-s="thin"><b>${disable ? '' : salah_pg}</b></td>
                 <td class="text-center text-info align-middle" data-a-v="middle" data-a-h="center" data-b-a-s="thin"><b>${disable ? '' : (siswa?.nilai_akhir?.skor_pg?.skor_total ?? 0)}</b></td>`;
                }

                if (info.tampil_kompleks > 0) {
                    html += `<td class="text-center text-success align-middle" data-a-v="middle" data-a-h="center" data-b-a-s="thin"><b>${disable ? '' : (siswa?.nilai_akhir?.skor_kompleks?.skor_total ?? 0)}</b></td>`;
                }

                if (info.tampil_jodohkan > 0) {
                    html += `<td class="text-center text-success align-middle" data-a-v="middle" data-a-h="center" data-b-a-s="thin"><b>${disable ? '' : (siswa?.nilai_akhir?.skor_jodohkan?.skor_total ?? 0)}</b></td>`;
                }

                if (info.tampil_isian > 0) {
                    html += `<td class="text-center text-success align-middle" data-a-v="middle" data-a-h="center" data-b-a-s="thin"><b>${disable ? '' : (siswa?.nilai_akhir?.skor_isian?.skor_total ?? 0)}</b></td>`;
                }

                if (info.tampil_esai > 0) {
                    html += `<td class="text-center text-success align-middle" data-a-v="middle" data-a-h="center" data-b-a-s="thin"><b>${disable ? '' : (siswa?.nilai_akhir?.skor_esai?.skor_total ?? 0)}</b></td>`;
                }

                let iconKoreksi = '';
                if (hanyaPg || siswa?.nilai_akhir?.dikoreksi === '1') {
                    iconKoreksi = `<i title="Sudah dikoreksi" class="fa fa-check-circle ms-1 text-success"></i>`;
                } else {
                    iconKoreksi = `<i title="Belum dikoreksi" class="fa fa-exclamation-triangle text-warning ms-1"></i>`;
                }

                let disableBtn = result.jadwal?.pelanggaran !== '1' ? 'disabled' : '';
                if (!isRekap && !siswa.id_cbt_siswa) {
                    disableBtn = 'disabled';
                }

                html += `<td class="text-center align-middle ${textColor}" data-a-v="middle" data-a-h="center" data-b-a-s="thin" data-a-wrap="true"><b>${disable ? '' : skorTotal}</b>${disable ? '' : badgeKetuntasan}</td>
             <td class="text-center align-middle katrol ${textColor}" data-a-v="middle" data-a-h="center" data-b-a-s="thin"><b>${skorKatrol}</b></td>
             <td class="text-center align-middle" data-a-v="middle" data-a-h="center" data-b-a-s="thin"><b>${totalMinus}</b></td>
             <td class="text-center align-middle" data-exclude="true">
                 <button type="button" class="btn btn-sm btn-success shadow-sm mb-1 ${disabled}" onclick="lihatJawaban(${idSiswa})" title="Koreksi Jawaban Siswa" ${disabled}>Koreksi ${iconKoreksi}</button>
                 <button type="button" class="btn btn-sm btn-danger shadow-sm mb-1" data-bs-toggle="modal" data-nilai="${skorAsli}"
                        data-bs-target="#pelanggaranModal" data-siswa="${idSiswa}" ${disableBtn}>
                    <i class="fa fa-scissors"></i> Foul</button>
             </td>
         </tr>`;

                no++;
            });

            html += `</table></div>`;

            document.getElementById('table-container').innerHTML = html;

            // Hitung dan perbarui Ringkasan Statistik Nilai & Grafik
            let totalPeserta = siswas.length;
            let totalDinilai = arrScores.length;
            let maxVal = totalDinilai > 0 ? Math.max(...arrScores) : 0;
            let minVal = totalDinilai > 0 ? Math.min(...arrScores) : 0;
            let avgVal = totalDinilai > 0 ? (arrScores.reduce((a, b) => a + b, 0) / totalDinilai).toFixed(1) : 0;
            let tuntasCount = arrScores.filter(s => s >= currentKkm).length;
            let remedialCount = arrScores.filter(s => s < currentKkm).length;
            let belumCount = totalPeserta - totalDinilai;
            let persenTuntas = totalDinilai > 0 ? Math.round((tuntasCount / totalDinilai) * 100) : 0;
            let persenRemedial = totalDinilai > 0 ? Math.round((remedialCount / totalDinilai) * 100) : 0;

            let r0_49 = arrScores.filter(s => s < 50).length;
            let r50_69 = arrScores.filter(s => s >= 50 && s < 70).length;
            let r70_79 = arrScores.filter(s => s >= 70 && s < 80).length;
            let r80_89 = arrScores.filter(s => s >= 80 && s < 90).length;
            let r90_100 = arrScores.filter(s => s >= 90).length;

            updateStatisticsUI({
                totalPeserta: totalPeserta,
                totalDinilai: totalDinilai,
                maxVal: maxVal,
                minVal: minVal,
                avgVal: avgVal,
                tuntasCount: tuntasCount,
                remedialCount: remedialCount,
                belumCount: belumCount,
                persenTuntas: persenTuntas,
                persenRemedial: persenRemedial,
                distributions: [r0_49, r50_69, r70_79, r80_89, r90_100]
            });

            $('#stats-wrapper').removeClass('d-none');
            applyTableFilter();

            if (isConverted) {
                $('#btn-katrol').html('<i class="fa fa-undo me-1"></i>' +
                    '<span class="d-none d-sm-inline-block ms-1"> Nilai Asli</span>');
            } else {
                $('#btn-katrol').html('<i class="fa fa-balance-scale-right me-1"></i>' +
                    '<span class="d-none d-sm-inline-block ms-1"> Katrol</span>');
            }
            $('#group-btn').removeClass('d-none');
        } else {
            $('#stats-wrapper').addClass('d-none');
            const title = isRekap ? 'Belum ada rekap nilai:' : 'Tidak ada nilai Siswa:';
            const li_2 = isRekap ? 'Ulangi rekap jika semua siswa sudah selesai mengerjakan' : 'Refresh halaman jika siswa sedang mengerjakan';
            document.getElementById('table-container').innerHTML = `<div class="alert alert-warning align-content-center pb-0 m-2" role="alert">
                ${title}
                <ul>
                    <li>Ada siswa belum selesai mengerjakan</li>
                    <li>${li_2}</li>
                </ul>
            </div>`;
        }

        $('#loading').addClass('d-none');
    }

    function perbaikiNilai(fromModal) {
        if (!isConverted && !fromModal) {
            const modalEl = document.getElementById('perbaikanModal');
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
            return;
        }
        isConverted = !isConverted;
        populateTable($('#sort-by').val());
    }

    function decimalFixed(num) {
        return Math.round(num * 100) / 100;
    }

    $(document).ready(function () {
        if (typeof ajaxcsrf === 'function') {
            ajaxcsrf();
        }

        const loading = $('#loading');
        var opsiJadwal = $("#jadwal");
        var opsiKelas = $("#kelas");
        var selected = isSelected === 0 ? "selected='selected'" : "";
        
        opsiJadwal.prepend("<option value='' " + selected + " disabled>Pilih Jadwal</option>");
        opsiKelas.prepend("<option value='' " + selected + " disabled>Pilih Kelas</option>");
        
        if (opsiKelas.val()) {
            opsiKelas.trigger('change');
        }

        $(document).on('change', '#kelas', function () {
            var klsVal = $(this).val();
            if (klsVal) {
                getKelasJadwal(klsVal);
            }
        });

        $(document).on('change', '#jadwal', function () {
            var jadVal = isRekap ? idJadwal : $(this).val();
            var klsVal = isRekap ? idKelas : $("#kelas").val();
            if (jadVal && klsVal) {
                let post = {
                    'id_jadwal': jadVal,
                    'id_kelas': klsVal
                };
                getNilai(post);
            }
        });

        $('#btn-katrol').on('click', function (e) {
            perbaikiNilai(false);
        });

        $("#download-nilai").click(function (event) {
            downloadExcel(false);
        });

        $("#download-detail").click(function (event) {
            downloadExcel(true);
        });

        $('#perbaikan-nilai').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            var $inputs = $('#perbaikanModal :input');
            var values = {};
            $inputs.each(function () {
                if ($(this).val()) values[this.name] = $(this).val();
            });
            hasil_max = Number(values['ya']);
            hasil_min = Number(values['yb']);

            var perbaikanModalEl = document.getElementById('perbaikanModal');
            var modal = bootstrap.Modal.getInstance(perbaikanModalEl);
            if (modal) modal.hide();

            perbaikiNilai(true);
        });

        $("#import-essai").on("click", function () {
            var kls = opsiKelas.val();
            var jad = opsiJadwal.val();
            if (!isRekap && (kls == null || jad == null)) {
                return;
            }
            let post = {
                'id_jadwal': isRekap ? idJadwal : $("#jadwal").val(),
                'id_kelas': isRekap ? idKelas : $("#kelas").val()
            };
            localStorage.setItem('garudaCBT.convert', JSON.stringify(post));
            localStorage.setItem('garudaCBT.last_url', 'input_nilai');
            if (isRekap) {
                window.location.href = base_url + 'cbtrekap/inputessai?id_kelas=' + idKelas + '&id_jadwal=' + idJadwal;
            } else {
                window.location.href = base_url + 'cbtnilai/inputessai?id_kelas=' + opsiKelas.val() + '&id_jadwal=' + opsiJadwal.val();
            }
        });

        $('#mark-all').on('click', function () {
            Swal.fire({
                title: "Tandai Semua",
                text: "Semua hasil siswa akan ditandai sudah dikoreksi",
                icon: "info",
                showCancelButton: true,
                confirmButtonText: "Ya, Tandai",
                cancelButtonText: "Batal"
            }).then(result => {
                if (result.isConfirmed || result.value) {
                    let formEl = document.getElementById('post_data');
                    let dataPost = formEl ? new FormData(formEl) : new FormData();
                    dataPost.append('id_jadwal', idJadwal);
                    dataPost.append('id_kelas', idKelas);
                    dataPost.append('id_siswa', JSON.stringify(arr_idSiswa));
                    loading.removeClass('d-none');
                    Swal.fire({
                        text: "Silahkan tunggu....",
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    $.ajax({
                        url: base_url + "cbtnilai/mark_all",
                        type: "POST",
                        data: dataPost,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            loading.addClass('d-none');
                            console.log('responseMarkAll', data);
                            if (data.success) {
                                refreshStatus();
                                Swal.fire({
                                    title: "Berhasil",
                                    text: "Koreksi nilai berhasil disimpan",
                                    icon: "success"
                                });
                            } else {
                                Swal.fire({
                                    title: "Gagal",
                                    text: 'Tidak ada nilai yang disimpan',
                                    icon: "error"
                                });
                            }
                        }, error: function (xhr, status, error) {
                            loading.addClass('d-none');
                        }, error: function (xhr, ajaxOptions, thrownError) {
                            loading.addClass('d-none');
                            let msg = xhr.responseText;
                            if (msg.includes("<html") || msg.includes("<script")) {
                                msg = "Terjadi kesalahan server (500/404). Silakan periksa log aplikasi.";
                            }
                            Swal.fire({
                                title: "Gagal",
                                text: msg,
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });

        if ($.fn.select2) {
            try {
                opsiKelas.select2({width: '100%', theme: 'bootstrap4'});
                opsiJadwal.select2({width: '100%', theme: 'bootstrap4'});
            } catch(e) {}
        }

        let post;
        const lastUrl = localStorage.getItem('garudaCBT.last_url', '');
        if (lastUrl === 'input_nilai') {
            isBackFrom = true;
            post = localStorage.getItem('garudaCBT.convert', '');
            if (post) {
                localStorage.setItem('garudaCBT.last_url', '');
                post = JSON.parse(post);
                idJadwal = post.id_jadwal;
                idKelas = post.id_kelas;
                isSelected = idKelas;
                if (!isRekap) {
                    opsiKelas.val(idKelas).trigger('change');
                } else {
                    getNilai();
                }
            }
        } else {
            getNilai();
        }

        $('#penguranganModal').on('show.bs.modal', function (e) {
            let temp = localStorage.getItem('garudaCBT.pelanggaran', null);
            if (temp) {
                temp = JSON.parse(temp);
                $(e.currentTarget).find('#p-ringan').val(temp.p_ringan);
                $(e.currentTarget).find('#p-sedang').val(temp.p_sedang);
                $(e.currentTarget).find('#p-berat').val(temp.p_berat);
            }
        });

        $('#save-min').click(function () {
            const pel = {
                'p_ringan': parseFloat($('#p-ringan').val()) || 0,
                'p_sedang': parseFloat($('#p-sedang').val()) || 0,
                'p_berat': parseFloat($('#p-berat').val()) || 0
            };
            localStorage.setItem('garudaCBT.pelanggaran', JSON.stringify(pel));
            const modalEl = document.getElementById('penguranganModal');
            const modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();

            const isReset = $('#reset-all').is(":checked");
            if (!result) {
                Swal.fire({
                    title: "Tidak ada data",
                    text: 'Silahkan pilih jadwal dan kelas terlebih dahulu',
                    icon: "warning"
                });
                return;
            }
            savePengurangan(isReset);
        });

        $('#pelanggaranModal').on('show.bs.modal', function (e) {
            const idSiswa = $(e.relatedTarget).data('siswa');
            const nilai = $(e.relatedTarget).data('nilai');
            const siswa = arr_pelanggaran.find(p => p.id_siswa == idSiswa);

            const ringan = siswa?.pelanggaran?.ringan || 0;
            const sedang = siswa?.pelanggaran?.sedang || 0;
            const berat = siswa?.pelanggaran?.berat || 0;

            const p_ringan = siswa?.pelanggaran?.p_ringan || 0;
            const p_sedang = siswa?.pelanggaran?.p_sedang || 0;
            const p_berat = siswa?.pelanggaran?.p_berat || 0;

            let temp = localStorage.getItem('garudaCBT.pelanggaran', null);
            if (temp) {
                temp = JSON.parse(temp);
            }

            const manual = siswa?.pelanggaran?.manual === 'ya';
            $(e.currentTarget).find('#np-ringan').val(manual ? p_ringan : (temp?.p_ringan || 0));
            $(e.currentTarget).find('#np-sedang').val(manual ? p_sedang : (temp?.p_sedang || 0));
            $(e.currentTarget).find('#np-berat').val(manual ? p_berat : (temp?.p_berat || 0));

            $(e.currentTarget).find('#jml-ringan').text(ringan);
            $(e.currentTarget).find('#jml-sedang').text(sedang);
            $(e.currentTarget).find('#jml-berat').text(berat);

            $(e.currentTarget).find('#min-idsiswa').text(idSiswa);
            $(e.currentTarget).find('#min-nilai').text(nilai);

            $('#np-ringan, #np-sedang, #np-berat').trigger('input');
        });

        $('#save-fouls').click(function () {
            const totalRingan = parseFloat($('#t-ringan').text()) || 0;
            const totalSedang = parseFloat($('#t-sedang').text()) || 0;
            const totalBerat = parseFloat($('#t-berat').text()) || 0;
            const totalMinus = totalRingan + totalSedang + totalBerat;

            const pel = {
                'p_ringan': parseFloat($('#np-ringan').val()),
                'p_sedang': parseFloat($('#np-sedang').val()),
                'p_berat': parseFloat($('#np-berat').val()),
                'manual' : 'ya',
                't_ringan' : totalRingan,
                't_sedang' : totalSedang,
                't_berat' : totalBerat,
                't_total' : totalMinus
            };
            const modalEl = document.getElementById('pelanggaranModal');
            const modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();

            savePengurangan(false, $('#min-idsiswa').text(), pel);
        });

        $('#np-ringan, #np-sedang, #np-berat').on('input', hitungTotalPengurangan);
    });

    function resetFouls() {
        const pel = {
            'p_ringan': 0,
            'p_sedang': 0,
            'p_berat': 0
        };

        Swal.fire({
            title: "Reset Pelanggaran",
            text: "Semua Point pengurangan akan dihapus, nilai siswa akan dikembalikan ke nilai awal",
            icon: "info",
            showCancelButton: true,
            confirmButtonText: "Ya, Reset",
            cancelButtonText: "Batal"
        }).then(result => {
            if (result.isConfirmed || result.value) {
                localStorage.setItem('garudaCBT.pelanggaran', JSON.stringify(pel));
                savePengurangan(true);
            }
        });
    }

    function savePengurangan(isReset, idSiswa, pel) {
        let arrSiswa = [];
        if (idSiswa) {
            let siswa;
            if (isRekap) {
                siswa = arr_pelanggaran.find(p => p.id_siswa == idSiswa && p.id_rekap_siswa !== "");
            } else {
                siswa = arr_pelanggaran.find(p => p.id_siswa == idSiswa && p.id_cbt_siswa !== "");
            }
            console.log('siswa', siswa);
            if (siswa) {
                const objBaru = {
                    ...siswa,
                    pelanggaran: {
                        ...pel,
                        berat: siswa.pelanggaran.berat,
                        sedang: siswa.pelanggaran.sedang,
                        ringan: siswa.pelanggaran.ringan
                    }
                };
                arrSiswa.push(objBaru);
            }
        } else {
            let temp = JSON.parse(localStorage.getItem('garudaCBT.pelanggaran', '{}'));

            arrSiswa = arr_pelanggaran.filter(p => (isReset || !p.manual) && p.id_cbt_siswa !== "");
            arrSiswa.forEach(p => {
                const totalRingan = (p.pelanggaran.ringan || 0) * temp.p_ringan;
                const totalSedang = (p.pelanggaran.sedang || 0) * temp.p_sedang;
                const totalBerat = (p.pelanggaran.berat || 0) * temp.p_berat;
                const totalMinus = totalRingan + totalSedang + totalBerat;

                p.pelanggaran['t_ringan'] = totalRingan;
                p.pelanggaran['t_sedang'] = totalSedang;
                p.pelanggaran['t_berat'] = totalBerat;
                p.pelanggaran['t_total'] = totalMinus;
                p.pelanggaran['p_ringan'] = temp.p_ringan;
                p.pelanggaran['p_sedang'] = temp.p_sedang;
                p.pelanggaran['p_berat'] = temp.p_berat;
                p.pelanggaran['manual'] = 'no';
            });
        }

        if (arrSiswa.length === 0) {
            Swal.fire({
                title: "Gagal",
                text: 'Tidak ada siswa yang dipilih',
                icon: "warning"
            });
            return;
        }

        let formEl = document.getElementById('post_data');
        let formData = formEl ? new FormData(formEl) : new FormData();
        formData.append('arr_point', JSON.stringify(arrSiswa));
        formData.append('id_jadwal', idJadwal);
        formData.append('id_siswa', JSON.stringify(arr_idSiswa));

        $.ajax({
            url: base_url + "cbtnilai/savepengurangan",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log('responseSavePengurangan', data);
                if (data.success) {
                    refreshStatus();
                    Swal.fire({
                        title: "Berhasil",
                        text: "Pengurangan nilai berhasil disimpan",
                        icon: "success"
                    });
                } else {
                    Swal.fire({
                        title: "NOT CHANGED",
                        text: 'Nilai yang disimpan sama seperti sebelumnya',
                        icon: "warning"
                    });
                }
            }, error: function (xhr, status, error) {
                console.log("error", xhr.responseText);
                let msg = "Terjadi kesalahan";
                try {
                    const err = JSON.parse(xhr.responseText);
                    msg = err.Message || err.message || msg;
                } catch(e) {}
                Swal.fire({
                    title: "Error",
                    text: msg,
                    icon: "error"
                });
            }
        });
    }

    function hitungTotalPengurangan() {
        const nilRingan = parseFloat($('#np-ringan').val()) || 0;
        const jmlRingan = parseFloat($('#jml-ringan').text()) || 0;
        const totalRingan = nilRingan * jmlRingan;
        $('#t-ringan').text(totalRingan);

        const nilSedang = parseFloat($('#np-sedang').val()) || 0;
        const jmlSedang = parseFloat($('#jml-sedang').text()) || 0;
        const totalSedang = nilSedang * jmlSedang;
        $('#t-sedang').text(totalSedang);

        const nilBerat = parseFloat($('#np-berat').val()) || 0;
        const jmlBerat = parseFloat($('#jml-berat').text()) || 0;
        const totalBerat = nilBerat * jmlBerat;
        $('#t-berat').text(totalBerat);

        const totalMinus = totalRingan + totalSedang + totalBerat;

        const nilai = parseFloat($('#min-nilai').text()) || 0;
        const totalNilai = nilai - totalMinus;

        $('#total-pengurangan').text(totalMinus);
        $('#hasil-pengurangan').text(totalNilai);
    }

    function zeroPad(no) {
        return no < 10 ? '0' + no : no;
    }

    // === FITUR BARU: LOGIKA AUTO REFRESH & COUNTDOWN ===
let refreshTimer = null;
let countdownTimer = null;
let countdownValue = 15;

function updateCountdownDisplay() {
    const display = document.getElementById('countdown-display');
    const valueSpan = document.getElementById('countdown-value');
    const isSwitchOn = $('#autoRefreshSwitch').is(':checked');

    if (isSwitchOn && display && valueSpan) {
        display.classList.remove('d-none');
        valueSpan.textContent = countdownValue;
    } else if (display) {
        display.classList.add('d-none');
    }
}

function setupAutoRefresh() {
    if (refreshTimer) clearInterval(refreshTimer);
    if (countdownTimer) clearInterval(countdownTimer);

    const isSwitchOn = $('#autoRefreshSwitch').is(':checked');
    const intervalMs = parseInt($('#refreshInterval').val());
    countdownValue = intervalMs / 1000; 

    const currentKelas = isRekap ? idKelas : $('#kelas').val();
    const currentJadwal = isRekap ? idJadwal : $('#jadwal').val();
    const hasKelas = currentKelas && currentKelas !== '' && currentKelas !== '0';
    const hasJadwal = currentJadwal && currentJadwal !== '' && currentJadwal !== '0';

    if (isSwitchOn && hasKelas && hasJadwal) {
        updateCountdownDisplay();

        countdownTimer = setInterval(() => {
            countdownValue--;
            if (countdownValue <= 0) {
                countdownValue = intervalMs / 1000;
            }
            updateCountdownDisplay();
        }, 1000);

        refreshTimer = setInterval(() => {
            console.log("Melakukan auto-refresh data...");
            refreshStatus();
            countdownValue = intervalMs / 1000;
            updateCountdownDisplay();
        }, intervalMs);
    } else {
        updateCountdownDisplay();
    }
}

$('#autoRefreshSwitch, #refreshInterval').on('change', setupAutoRefresh);
$('#kelas, #jadwal').on('change', function() {
    setupAutoRefresh();
});

const originalRefreshStatus = refreshStatus;
refreshStatus = function() {
    originalRefreshStatus();
    if ($('#autoRefreshSwitch').is(':checked')) {
        const intervalMs = parseInt($('#refreshInterval').val());
        countdownValue = intervalMs / 1000;
        updateCountdownDisplay();
    }
}

// === FITUR STATISTIK RINGKASAN & GRAFIK HASIL UJIAN ===
function updateStatisticsUI(stats) {
    $('#stat-avg').text(stats.avgVal);
    $('#stat-kkm-label').text('KKM: ' + currentKkm);
    $('#stat-max').text(stats.maxVal);
    $('#stat-min').text(stats.minVal);
    $('#stat-max-sub').text(stats.maxVal);
    $('#stat-min-sub').text(stats.minVal);
    $('#stat-tuntas').text(stats.tuntasCount);
    $('#stat-persen-tuntas').text(stats.persenTuntas + '%');
    $('#stat-total-peserta').text(stats.totalDinilai);
    $('#stat-remedial').text(stats.remedialCount);
    $('#stat-persen-remedial').text(stats.persenRemedial + '%');

    renderCharts(stats.tuntasCount, stats.remedialCount, stats.belumCount, stats.distributions);
}

function renderCharts(tuntas, remedial, belum, dist) {
    var ctxKet = document.getElementById('chartKetuntasan');
    if (ctxKet) {
        if (chartKetuntasan) {
            chartKetuntasan.destroy();
        }
        chartKetuntasan = new Chart(ctxKet.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Tuntas (≥ ' + currentKkm + ')', 'Remedial (< ' + currentKkm + ')', 'Belum Mengerjakan'],
                datasets: [{
                    data: [tuntas, remedial, belum],
                    backgroundColor: ['#10b981', '#ef4444', '#cbd5e1'],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        fontSize: 11,
                        padding: 10
                    }
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var dataset = data.datasets[tooltipItem.datasetIndex];
                            var total = dataset.data.reduce(function(prev, cur) { return prev + cur; }, 0);
                            var currentValue = dataset.data[tooltipItem.index];
                            var percentage = total > 0 ? Math.round((currentValue / total) * 100) : 0;
                            return data.labels[tooltipItem.index] + ': ' + currentValue + ' Siswa (' + percentage + '%)';
                        }
                    }
                }
            }
        });
    }

    var ctxDist = document.getElementById('chartDistribusi');
    if (ctxDist) {
        if (chartDistribusi) {
            chartDistribusi.destroy();
        }
        chartDistribusi = new Chart(ctxDist.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['0-49 (Sgt Kurang)', '50-69 (Kurang)', '70-79 (Cukup)', '80-89 (Baik)', '90-100 (Sgt Baik)'],
                datasets: [{
                    label: 'Jumlah Siswa',
                    data: dist,
                    backgroundColor: [
                        'rgba(239, 68, 68, 0.85)',
                        'rgba(249, 115, 22, 0.85)',
                        'rgba(245, 158, 11, 0.85)',
                        'rgba(59, 130, 246, 0.85)',
                        'rgba(16, 185, 129, 0.85)'
                    ],
                    borderColor: [
                        '#ef4444',
                        '#f97316',
                        '#f59e0b',
                        '#3b82f6',
                        '#10b981'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1,
                            precision: 0
                        },
                        gridLines: {
                            color: '#f1f5f9'
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            fontSize: 11
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return tooltipItem.yLabel + ' Siswa';
                        }
                    }
                }
            }
        });
    }
}

function recalculateWithNewKkm(newKkm) {
    currentKkm = parseFloat(newKkm) || 75;
    $('#stat-kkm-label').text('KKM: ' + currentKkm);

    let arrScores = [];
    let totalPeserta = 0;

    $('.row-siswa').each(function() {
        totalPeserta++;
        let isDisable = $(this).attr('data-disable') === '1';
        let skor = parseFloat($(this).attr('data-skor'));
        
        if (!isDisable && !isNaN(skor)) {
            arrScores.push(skor);
            let isTuntas = (skor >= currentKkm);
            let newStatus = isTuntas ? 'tuntas' : 'remedial';
            $(this).attr('data-status-ketuntasan', newStatus);
            
            let badge = $(this).find('.badge-ketuntasan');
            if (badge.length) {
                if (isTuntas) {
                    badge.removeClass('bg-danger text-danger border-danger').addClass('bg-success text-success border-success').text('Tuntas');
                } else {
                    badge.removeClass('bg-success text-success border-success').addClass('bg-danger text-danger border-danger').text('Remedial');
                }
            }
        }
    });

    let totalDinilai = arrScores.length;
    let maxVal = totalDinilai > 0 ? Math.max(...arrScores) : 0;
    let minVal = totalDinilai > 0 ? Math.min(...arrScores) : 0;
    let avgVal = totalDinilai > 0 ? (arrScores.reduce((a, b) => a + b, 0) / totalDinilai).toFixed(1) : 0;
    let tuntasCount = arrScores.filter(s => s >= currentKkm).length;
    let remedialCount = arrScores.filter(s => s < currentKkm).length;
    let belumCount = totalPeserta - totalDinilai;
    let persenTuntas = totalDinilai > 0 ? Math.round((tuntasCount / totalDinilai) * 100) : 0;
    let persenRemedial = totalDinilai > 0 ? Math.round((remedialCount / totalDinilai) * 100) : 0;

    let r0_49 = arrScores.filter(s => s < 50).length;
    let r50_69 = arrScores.filter(s => s >= 50 && s < 70).length;
    let r70_79 = arrScores.filter(s => s >= 70 && s < 80).length;
    let r80_89 = arrScores.filter(s => s >= 80 && s < 90).length;
    let r90_100 = arrScores.filter(s => s >= 90).length;

    updateStatisticsUI({
        totalPeserta: totalPeserta,
        totalDinilai: totalDinilai,
        maxVal: maxVal,
        minVal: minVal,
        avgVal: avgVal,
        tuntasCount: tuntasCount,
        remedialCount: remedialCount,
        belumCount: belumCount,
        persenTuntas: persenTuntas,
        persenRemedial: persenRemedial,
        distributions: [r0_49, r50_69, r70_79, r80_89, r90_100]
    });

    applyTableFilter();
}

// === LOGIKA PENCARIAN & FILTER KETUNTASAN ===
function applyTableFilter() {
    var searchVal = ($('#searchNilai').val() || '').toLowerCase();
    var filterStatus = $('#filterKetuntasan').val() || 'all';

    $("#table-status tbody tr").filter(function() {
        if ($(this).hasClass('bg-light') || $(this).find('td').length < 3) return;
        
        var textMatch = $(this).text().toLowerCase().indexOf(searchVal) > -1;
        var rowStatus = $(this).attr('data-status-ketuntasan') || 'unknown';
        var statusMatch = (filterStatus === 'all') || (rowStatus === filterStatus);

        $(this).toggle(textMatch && statusMatch);
    });
}

$(document).on('keyup', '#searchNilai', applyTableFilter);
$(document).on('change', '#filterKetuntasan', applyTableFilter);

// Listener input KKM
let kkmDebounce = null;
$(document).on('input change', '#input-kkm', function() {
    clearTimeout(kkmDebounce);
    var val = $(this).val();
    kkmDebounce = setTimeout(function() {
        recalculateWithNewKkm(val);
    }, 300);
});

// Listener toggle panel grafik
$(document).on('click', '#btn-toggle-charts', function() {
    $('#charts-body').slideToggle(200, function() {
        if ($('#charts-body').is(':visible')) {
            $('#icon-toggle-charts').removeClass('fa-chevron-down').addClass('fa-chevron-up');
        } else {
            $('#icon-toggle-charts').removeClass('fa-chevron-up').addClass('fa-chevron-down');
        }
    });
});

$('#sort-by').change(function() {
    $('#loading').removeClass('d-none');
    setTimeout(function() {
        populateTable($('#sort-by').val())
    }, 200)
});
</script>
<?= $this->endSection() ?>
