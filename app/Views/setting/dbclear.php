<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

<div class="row">
  <div class="col-sm-12">
    <!-- Top Header Card -->
    <div class="card mb-4 border-0 shadow-sm">
      <div class="card-body p-4">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
          <div class="d-flex align-items-center">
            <div class="me-3 flex-shrink-0">
              <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 58px; height: 58px; background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); color: #ffffff;">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                  <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                  <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                </svg>
              </div>
            </div>
            <div>
              <h4 class="card-title mb-1 fw-bold text-dark d-flex align-items-center gap-2">
                <?= esc($judul) ?>
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle fs-7 fw-semibold">CI4 Enterprise</span>
              </h4>
              <p class="text-muted mb-0" style="font-size: 0.88rem;">Pembersihan data transaksi, rekapitulasi ujian, nilai semester, log aktivitas, serta pemeliharaan database secara terkontrol dan aman.</p>
            </div>
          </div>

          <!-- Quick Navigation / Shortcut to Backup -->
          <div class="d-flex align-items-center gap-2">
            <a href="<?= base_url('dbmanager') ?>" class="btn btn-outline-primary d-inline-flex align-items-center gap-2 shadow-sm">
              <i class="fas fa-database"></i>
              <span>Menu Backup / Restore</span>
            </a>
          </div>
        </div>

        <!-- Mini Stats Bar -->
        <div class="row g-3 mt-3 pt-3 border-top">
          <div class="col-6 col-md-3">
            <div class="p-3 rounded-3 bg-light border d-flex align-items-center gap-3">
              <div class="rounded-circle p-2 bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="fas fa-table fs-6"></i>
              </div>
              <div>
                <div class="text-muted small fw-medium">Total Tabel Sistem</div>
                <div class="fs-5 fw-bold text-dark"><?= esc($stats['total_tables']) ?> <span class="fs-7 text-muted fw-normal">tabel</span></div>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="p-3 rounded-3 bg-light border d-flex align-items-center gap-3">
              <div class="rounded-circle p-2 bg-success text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="fas fa-layer-group fs-6"></i>
              </div>
              <div>
                <div class="text-muted small fw-medium">Total Baris / Record</div>
                <div class="fs-5 fw-bold text-dark"><?= number_format($stats['total_records'], 0, ',', '.') ?> <span class="fs-7 text-muted fw-normal">baris</span></div>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="p-3 rounded-3 bg-light border d-flex align-items-center gap-3">
              <div class="rounded-circle p-2 bg-info text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="fas fa-sparkles fs-6"></i>
              </div>
              <div>
                <div class="text-muted small fw-medium">Tabel Fitur Baru</div>
                <div class="fs-5 fw-bold text-info"><?= esc($stats['total_new']) ?> <span class="fs-7 text-muted fw-normal">terdaftar</span></div>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="p-3 rounded-3 bg-light border d-flex align-items-center gap-3">
              <div class="rounded-circle p-2 <?= $stats['total_legacy'] > 0 ? 'bg-danger' : 'bg-secondary' ?> text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="fas fa-trash-alt fs-6"></i>
              </div>
              <div>
                <div class="text-muted small fw-medium">Tabel Usang (Legacy)</div>
                <div class="fs-5 fw-bold <?= $stats['total_legacy'] > 0 ? 'text-danger' : 'text-success' ?>">
                  <?= $stats['total_legacy'] > 0 ? esc($stats['total_legacy']) . ' <span class="fs-7 text-danger fw-normal">ditemukan</span>' : '0 <span class="fs-7 text-success fw-normal">Bersih</span>' ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Security Alert Banner -->
    <div class="alert alert-warning border-warning-subtle shadow-sm d-flex align-items-start gap-3 p-3 mb-4 rounded-3" role="alert">
      <div class="text-warning flex-shrink-0 mt-1">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
          <line x1="12" y1="9" x2="12" y2="13"></line>
          <line x1="12" y1="17" x2="12.01" y2="17"></line>
        </svg>
      </div>
      <div class="flex-grow-1" style="font-size: 0.9rem;">
        <strong class="d-block mb-1 text-dark">Petunjuk Keamanan & Pencegahan Kehilangan Data:</strong>
        <ul class="mb-0 ps-3 text-muted">
          <li>Pengosongan data (<strong>Truncate</strong>) akan menghapus seluruh isi baris data pada tabel yang dipilih, namun struktur tabel dan kolom tetap dipertahankan.</li>
          <li>Sangat disarankan membuat salinan basis data terlebih dahulu di menu <a href="<?= base_url('dbmanager') ?>" class="fw-bold text-primary text-decoration-underline">Backup/Restore Database</a> sebelum melakukan pengosongan semesteran atau tahunan.</li>
          <li>Tabel dengan tanda <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Dilindungi Sistem</span> tidak dapat dikosongkan untuk menjamin kelangsungan aplikasi.</li>
        </ul>
      </div>
    </div>

    <!-- Main Content Card with Tabs -->
    <div class="card shadow-sm border-0 mb-4">
      <div class="card-header bg-white border-bottom p-3">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
          <!-- Search input -->
          <div class="input-group" style="max-width: 360px;">
            <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-search"></i></span>
            <input type="text" id="searchTable" class="form-control bg-light border-start-0" placeholder="Cari nama tabel atau fungsi..." autocomplete="off">
            <button class="btn btn-outline-secondary d-none" type="button" id="clearSearch"><i class="fas fa-times"></i></button>
          </div>

          <div class="text-muted small">
            <i class="fas fa-info-circle text-primary me-1"></i> Pilih modul untuk melihat tabel dan aksi pengosongan.
          </div>
        </div>

        <!-- Navigation Tabs -->
        <ul class="nav nav-pills mt-3 gap-2 flex-wrap" id="dbTabs" role="tablist">
          <?php 
          $firstTab = true;
          foreach ($modules as $modKey => $mod): 
              $tabActive = $firstTab ? 'active' : '';
              $firstTab = false;
          ?>
            <li class="nav-item" role="presentation">
              <button class="nav-link <?= $tabActive ?> d-flex align-items-center gap-2 px-3 py-2" id="tab-btn-<?= $modKey ?>" data-bs-toggle="pill" data-bs-target="#tab-<?= $modKey ?>" type="button" role="tab">
                <i class="<?= esc($mod['icon']) ?>"></i>
                <span><?= esc($mod['badge']) ?></span>
                <span class="badge rounded-pill bg-dark-subtle text-dark ms-1"><?= count($mod['tables']) ?></span>
              </button>
            </li>
          <?php endforeach; ?>

          <?php if (!empty($legacy_tables)): ?>
            <li class="nav-item" role="presentation">
              <button class="nav-link d-flex align-items-center gap-2 px-3 py-2 text-danger" id="tab-btn-legacy" data-bs-toggle="pill" data-bs-target="#tab-legacy" type="button" role="tab">
                <i class="fas fa-trash-alt"></i>
                <span>Tabel Usang</span>
                <span class="badge rounded-pill bg-danger text-white ms-1"><?= count($legacy_tables) ?></span>
              </button>
            </li>
          <?php endif; ?>

          <?php if (!empty($extra_tables)): ?>
            <li class="nav-item" role="presentation">
              <button class="nav-link d-flex align-items-center gap-2 px-3 py-2" id="tab-btn-extra" data-bs-toggle="pill" data-bs-target="#tab-extra" type="button" role="tab">
                <i class="fas fa-cube"></i>
                <span>Tabel Lainnya</span>
                <span class="badge rounded-pill bg-secondary text-white ms-1"><?= count($extra_tables) ?></span>
              </button>
            </li>
          <?php endif; ?>
        </ul>
      </div>

      <div class="card-body p-4">
        <div class="tab-content" id="dbTabsContent">
          <?php 
          $firstPane = true;
          foreach ($modules as $modKey => $mod): 
              $paneActive = $firstPane ? 'show active' : '';
              $firstPane = false;
          ?>
            <div class="tab-pane fade <?= $paneActive ?>" id="tab-<?= $modKey ?>" role="tabpanel">
              <!-- Module Description & Batch Action Bar -->
              <div class="d-flex flex-wrap align-items-center justify-content-between p-3 mb-4 rounded-3 bg-light border gap-3">
                <div>
                  <h5 class="fw-bold mb-1 text-dark d-flex align-items-center gap-2">
                    <i class="<?= esc($mod['icon']) ?> text-primary"></i>
                    <span><?= esc($mod['title']) ?></span>
                  </h5>
                  <p class="text-muted mb-0 small"><?= esc($mod['desc']) ?></p>
                </div>

                <!-- Batch Actions per Module -->
                <div class="d-flex align-items-center gap-2 flex-wrap">
                  <?php if ($modKey === 'cbt'): ?>
                    <button type="button" class="btn btn-sm btn-outline-warning d-inline-flex align-items-center gap-1 shadow-sm" onclick="runBatchClear('cbt_pelaksanaan', 'Kosongkan Riwayat Pelaksanaan Ujian', 'Aksi ini akan mengosongkan data peserta ujian, sesi siswa, nomor peserta, pengawas, stream kamera, rekap nilai, dan log ujian. Bank soal dan jadwal tetap tersimpan.')">
                      <i class="fas fa-broom"></i>
                      <span>Reset Pelaksanaan Ujian</span>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1 shadow-sm" onclick="runBatchClear('cbt_all', 'Kosongkan Seluruh Pelaksanaan CBT & Bank Soal', 'Aksi ini akan mengosongkan SELURUH data ujian termasuk bank soal dan butir soal. Pastikan Anda telah memiliki cadangan backup!')">
                      <i class="fas fa-trash-alt"></i>
                      <span>Kosongkan Seluruh CBT</span>
                    </button>
                  <?php elseif ($modKey === 'elearning'): ?>
                    <button type="button" class="btn btn-sm btn-outline-warning d-inline-flex align-items-center gap-1 shadow-sm" onclick="runBatchClear('elearning_log', 'Kosongkan Log Pembelajaran & Catatan', 'Aksi ini akan mengosongkan log pembacaan materi daring serta catatan guru mapel dan wali kelas.')">
                      <i class="fas fa-broom"></i>
                      <span>Kosongkan Log & Catatan</span>
                    </button>
                  <?php elseif ($modKey === 'presensi'): ?>
                    <button type="button" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1 shadow-sm" onclick="runBatchClear('presensi', 'Kosongkan Seluruh Data Presensi Harian', 'Aksi ini akan mengosongkan seluruh riwayat presensi harian siswa dan guru madrasah.')">
                      <i class="fas fa-trash-alt"></i>
                      <span>Kosongkan Presensi Harian</span>
                    </button>
                  <?php elseif ($modKey === 'rapor_kurmer'): ?>
                    <button type="button" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1 shadow-sm" onclick="runBatchClear('rapor_kurmer_nilai', 'Kosongkan Seluruh Nilai Rapor Kurmer & Kokurikuler P5', 'Aksi ini akan mengosongkan seluruh data nilai formatif, sumatif, capaian P5, kehadiran, dan ekstrakurikuler Kurikulum Merdeka. Data TP dan KKTP tetap aman tersimpan.')">
                      <i class="fas fa-broom"></i>
                      <span>Kosongkan Nilai Rapor Kurmer</span>
                    </button>
                  <?php elseif ($modKey === 'rapor_k13'): ?>
                    <button type="button" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1 shadow-sm" onclick="runBatchClear('rapor_k13_nilai', 'Kosongkan Seluruh Nilai Rapor K13', 'Aksi ini akan mengosongkan seluruh nilai harian, PTS, akhir semester, sikap, fisik, dan ekstrakurikuler K13. Data KKM dan KI-KD tetap aman tersimpan.')">
                      <i class="fas fa-broom"></i>
                      <span>Kosongkan Nilai Rapor K13</span>
                    </button>
                  <?php elseif ($modKey === 'log'): ?>
                    <button type="button" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1 shadow-sm" onclick="runBatchClear('logs', 'Kosongkan Seluruh Log Sistem & Sesi', 'Aksi ini akan membersihkan log aktivitas aplikasi, riwayat percobaan login, dan sesi pengguna yang aktif.')">
                      <i class="fas fa-broom"></i>
                      <span>Bersihkan Seluruh Log</span>
                    </button>
                  <?php endif; ?>
                </div>
              </div>

              <!-- Module Table List -->
              <div class="table-responsive rounded-3 border">
                <table class="table table-hover align-middle mb-0 data-manager-table">
                  <thead class="table-light">
                    <tr>
                      <th class="text-center" style="width: 50px;">No</th>
                      <th>Nama Tabel & Fungsi</th>
                      <th style="width: 140px;" class="text-center">Kategori</th>
                      <th style="width: 130px;" class="text-center">Total Baris</th>
                      <th style="width: 160px;" class="text-center">Aksi Pengosongan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach ($mod['tables'] as $tbl): 
                    ?>
                      <tr class="table-row-item" data-table-name="<?= esc($tbl['table']) ?>" data-search-text="<?= strtolower(esc($tbl['table'] . ' ' . $tbl['name'] . ' ' . $tbl['desc'])) ?>">
                        <td class="text-center text-muted fw-semibold"><?= $no++ ?></td>
                        <td>
                          <div class="d-flex align-items-center gap-2 mb-1">
                            <code class="text-primary fw-bold fs-7 px-2 py-0 bg-primary-subtle rounded"><?= esc($tbl['table']) ?></code>
                            <span class="fw-semibold text-dark"><?= esc($tbl['name']) ?></span>
                            <?php if ($tbl['is_new']): ?>
                              <span class="badge bg-success-subtle text-success border border-success-subtle fs-8">
                                <i class="fas fa-star me-1"></i>Fitur Baru
                              </span>
                            <?php endif; ?>
                          </div>
                          <div class="text-muted small" style="line-height: 1.35;"><?= esc($tbl['desc']) ?></div>
                        </td>
                        <td class="text-center">
                          <?php if ($tbl['is_protected']): ?>
                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle"><i class="fas fa-lock me-1"></i>Dilindungi</span>
                          <?php elseif ($tbl['type'] === 'transaksi'): ?>
                            <span class="badge bg-info-subtle text-info border border-info-subtle">Transaksi</span>
                          <?php elseif ($tbl['type'] === 'log'): ?>
                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">Log</span>
                          <?php elseif ($tbl['type'] === 'pengaturan'): ?>
                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle">Pengaturan</span>
                          <?php else: ?>
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle">Master Data</span>
                          <?php endif; ?>
                        </td>
                        <td class="text-center">
                          <?php if ($tbl['size'] > 0): ?>
                            <span class="badge bg-primary fs-7 px-3 py-1"><?= number_format($tbl['size'], 0, ',', '.') ?> data</span>
                          <?php else: ?>
                            <span class="badge bg-light text-muted border fs-7 px-3 py-1">0 data</span>
                          <?php endif; ?>
                        </td>
                        <td class="text-center">
                          <?php if ($tbl['is_protected']): ?>
                            <button class="btn btn-sm btn-light text-muted border shadow-none" disabled title="Tabel sistem inti dilindungi dan tidak boleh dikosongkan">
                              <i class="fas fa-shield-alt text-danger me-1"></i> Terproteksi
                            </button>
                          <?php else: ?>
                            <button class="btn btn-sm btn-warning text-dark fw-medium shadow-sm d-inline-flex align-items-center gap-1"
                                    onclick="confirmTruncateTable('<?= esc($tbl['table']) ?>', '<?= esc($tbl['name']) ?>', <?= (int)$tbl['size'] ?>)"
                                    <?= $tbl['size'] == 0 ? 'disabled' : '' ?>>
                              <i class="fas fa-trash-alt"></i>
                              <span>Kosongkan</span>
                            </button>
                          <?php endif; ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          <?php endforeach; ?>

          <!-- Tab Legacy Tables (Only visible if legacy tables exist) -->
          <?php if (!empty($legacy_tables)): ?>
            <div class="tab-pane fade" id="tab-legacy" role="tabpanel">
              <div class="alert alert-danger border-danger-subtle d-flex align-items-start gap-3 p-3 mb-4 rounded-3 shadow-sm">
                <div class="text-danger flex-shrink-0 mt-1">
                  <i class="fas fa-exclamation-triangle fs-4"></i>
                </div>
                <div class="flex-grow-1" style="font-size: 0.9rem;">
                  <strong class="d-block mb-1 text-danger">Peringatan: Tabel Usang dari Versi Terdahulu (Legacy CI3) Terdeteksi!</strong>
                  <p class="mb-2 text-muted">Tabel-tabel di bawah ini merupakan sisa dari versi CI3 atau hasil impor basis data terdahulu yang sudah digantikan oleh struktur tabel CI4 yang baru. Tabel ini tidak lagi digunakan oleh sistem dan aman untuk dihapus secara permanen guna menghemat penyimpanan database Anda.</p>
                  <button type="button" class="btn btn-sm btn-danger shadow-sm d-inline-flex align-items-center gap-1" onclick="runBatchClear('drop_all_legacy', 'Hapus Permanen Semua Tabel Usang', 'PERINGATAN KERAS: Aksi ini akan menghapus tabel fisik (DROP TABLE) secara permanen dari basis data MySQL!')">
                    <i class="fas fa-trash-alt"></i>
                    <span>Hapus Permanen Semua Tabel Usang</span>
                  </button>
                </div>
              </div>

              <div class="table-responsive rounded-3 border">
                <table class="table table-hover align-middle mb-0 data-manager-table">
                  <thead class="table-light">
                    <tr>
                      <th class="text-center" style="width: 50px;">No</th>
                      <th>Nama Tabel Usang & Deskripsi</th>
                      <th style="width: 140px;" class="text-center">Status</th>
                      <th style="width: 130px;" class="text-center">Total Baris</th>
                      <th style="width: 160px;" class="text-center">Aksi Penghapusan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $noLeg = 1;
                    foreach ($legacy_tables as $lt): 
                    ?>
                      <tr class="table-row-item" data-table-name="<?= esc($lt['table']) ?>" data-search-text="<?= strtolower(esc($lt['table'] . ' ' . $lt['name'] . ' ' . $lt['desc'])) ?>">
                        <td class="text-center text-muted fw-semibold"><?= $noLeg++ ?></td>
                        <td>
                          <div class="d-flex align-items-center gap-2 mb-1">
                            <code class="text-danger fw-bold fs-7 px-2 py-0 bg-danger-subtle rounded"><?= esc($lt['table']) ?></code>
                            <span class="fw-semibold text-dark"><?= esc($lt['name']) ?></span>
                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle fs-8">Usang / Deprecated</span>
                          </div>
                          <div class="text-muted small" style="line-height: 1.35;"><?= esc($lt['desc']) ?></div>
                        </td>
                        <td class="text-center">
                          <span class="badge bg-danger">Legacy CI3</span>
                        </td>
                        <td class="text-center">
                          <span class="badge bg-light text-muted border fs-7 px-3 py-1"><?= number_format($lt['size'], 0, ',', '.') ?> data</span>
                        </td>
                        <td class="text-center">
                          <button class="btn btn-sm btn-danger shadow-sm d-inline-flex align-items-center gap-1"
                                  onclick="confirmDropTable('<?= esc($lt['table']) ?>', '<?= esc($lt['name']) ?>')">
                            <i class="fas fa-trash-alt"></i>
                            <span>Hapus Tabel (DROP)</span>
                          </button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          <?php endif; ?>

          <!-- Tab Extra / Unmapped Tables -->
          <?php if (!empty($extra_tables)): ?>
            <div class="tab-pane fade" id="tab-extra" role="tabpanel">
              <div class="p-3 mb-4 rounded-3 bg-light border">
                <h5 class="fw-bold mb-1 text-dark"><i class="fas fa-cube text-primary me-2"></i>Tabel Tambahan / Khusus</h5>
                <p class="text-muted mb-0 small">Daftar tabel database yang belum terpetakan dalam modul standar sistem namun aktif di basis data Anda.</p>
              </div>

              <div class="table-responsive rounded-3 border">
                <table class="table table-hover align-middle mb-0 data-manager-table">
                  <thead class="table-light">
                    <tr>
                      <th class="text-center" style="width: 50px;">No</th>
                      <th>Nama Tabel</th>
                      <th style="width: 140px;" class="text-center">Kategori</th>
                      <th style="width: 130px;" class="text-center">Total Baris</th>
                      <th style="width: 160px;" class="text-center">Aksi Pengosongan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $noExt = 1;
                    foreach ($extra_tables as $ext): 
                    ?>
                      <tr class="table-row-item" data-table-name="<?= esc($ext['table']) ?>" data-search-text="<?= strtolower(esc($ext['table'] . ' ' . $ext['name'])) ?>">
                        <td class="text-center text-muted fw-semibold"><?= $noExt++ ?></td>
                        <td>
                          <code class="text-primary fw-bold fs-7 px-2 py-0 bg-primary-subtle rounded me-2"><?= esc($ext['table']) ?></code>
                          <span class="fw-semibold text-dark"><?= esc($ext['name']) ?></span>
                        </td>
                        <td class="text-center">
                          <span class="badge bg-secondary-subtle text-secondary border">Tabel Khusus</span>
                        </td>
                        <td class="text-center">
                          <span class="badge bg-light text-muted border fs-7 px-3 py-1"><?= number_format($ext['size'], 0, ',', '.') ?> data</span>
                        </td>
                        <td class="text-center">
                          <button class="btn btn-sm btn-warning text-dark fw-medium shadow-sm d-inline-flex align-items-center gap-1"
                                  onclick="confirmTruncateTable('<?= esc($ext['table']) ?>', '<?= esc($ext['name']) ?>', <?= (int)$ext['size'] ?>)"
                                  <?= $ext['size'] == 0 ? 'disabled' : '' ?>>
                            <i class="fas fa-trash-alt"></i>
                            <span>Kosongkan</span>
                          </button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Live Search Functionality across tables
    document.getElementById('searchTable').addEventListener('input', function() {
        const query = this.value.trim().toLowerCase();
        const clearBtn = document.getElementById('clearSearch');
        if (query.length > 0) {
            clearBtn.classList.remove('d-none');
        } else {
            clearBtn.classList.add('d-none');
        }

        const activePane = document.querySelector('.tab-pane.active');
        if (activePane) {
            const rows = activePane.querySelectorAll('.table-row-item');
            rows.forEach(row => {
                const text = row.getAttribute('data-search-text') || '';
                if (query === '' || text.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    });

    document.getElementById('clearSearch').addEventListener('click', function() {
        const searchInput = document.getElementById('searchTable');
        searchInput.value = '';
        this.classList.add('d-none');
        searchInput.dispatchEvent(new Event('input'));
        searchInput.focus();
    });

    // Reset search on tab switch
    const tabButtons = document.querySelectorAll('#dbTabs button[data-bs-toggle="pill"]');
    tabButtons.forEach(btn => {
        btn.addEventListener('shown.bs.tab', function() {
            document.getElementById('searchTable').dispatchEvent(new Event('input'));
        });
    });

    /**
     * Konfirmasi dan eksekusi pengosongan data satu tabel (TRUNCATE)
     */
    function confirmTruncateTable(tableName, tableLabel, rowCount) {
        swal.fire({
            title: "Kosongkan Data Tabel?",
            html: `Apakah Anda yakin ingin mengosongkan tabel <strong><code>${tableName}</code></strong> (${tableLabel})?<br><br>
                   <div class="alert alert-warning text-start py-2 px-3 small mb-0">
                     <i class="fas fa-exclamation-triangle me-1"></i> Sebanyak <strong>${rowCount.toLocaleString('id-ID')} data</strong> akan dihapus permanen. Struktur tabel tetap tersimpan.
                   </div>`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#eab308",
            cancelButtonColor: "#64748b",
            confirmButtonText: "<i class='fas fa-trash-alt me-1'></i> Ya, Kosongkan Data",
            cancelButtonText: "Batal"
        }).then(result => {
            if (result.value) {
                swal.fire({
                    title: "Memproses Pengosongan Data...",
                    text: "Mohon tunggu sejenak...",
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        swal.showLoading();
                    }
                });

                $.ajax({
                    url: base_url + 'dbclear/hapustable',
                    type: "POST",
                    dataType: "json",
                    data: { table: tableName },
                    success: function (res) {
                        if (res.status !== false && res.type !== 'error') {
                            swal.fire({
                                title: "Berhasil!",
                                text: res.message || `Tabel ${tableName} berhasil dikosongkan.`,
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            swal.fire({
                                title: "Gagal Mengosongkan",
                                text: res.message || "Terjadi kesalahan saat memproses data.",
                                icon: "error"
                            });
                        }
                    },
                    error: function (xhr) {
                        let errMsg = "Terjadi kesalahan pada server.";
                        try {
                            const parsed = JSON.parse(xhr.responseText);
                            if (parsed.message) errMsg = parsed.message;
                        } catch(e) {}
                        swal.fire({
                            title: "Kesalahan Sistem",
                            text: errMsg,
                            icon: "error"
                        });
                    }
                });
            }
        });
    }

    /**
     * Konfirmasi dan eksekusi penghapusan fisik tabel usang (DROP TABLE)
     */
    function confirmDropTable(tableName, tableLabel) {
        swal.fire({
            title: "Hapus Fisik Tabel Usang?",
            html: `Anda akan menghapus tabel fisik <strong><code>${tableName}</code></strong> (${tableLabel}) dari MySQL secara PERMANEN.<br><br>
                   <div class="alert alert-danger text-start py-2 px-3 small mb-0">
                     <i class="fas fa-skull-crossbones me-1"></i> Tabel fisik beserta strukturnya akan di-<strong>DROP</strong> dan tidak dapat dikembalikan lagi.
                   </div>`,
            icon: "error",
            showCancelButton: true,
            confirmButtonColor: "#dc2626",
            cancelButtonColor: "#64748b",
            confirmButtonText: "<i class='fas fa-trash-alt me-1'></i> Ya, Hapus Fisik Tabel Ini!",
            cancelButtonText: "Batal"
        }).then(result => {
            if (result.value) {
                swal.fire({
                    title: "Menghapus Tabel Fisik...",
                    text: "Mohon tunggu sejenak...",
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        swal.showLoading();
                    }
                });

                $.ajax({
                    url: base_url + 'dbclear/droptable',
                    type: "POST",
                    dataType: "json",
                    data: { table: tableName },
                    success: function (res) {
                        if (res.status !== false && res.type !== 'error') {
                            swal.fire({
                                title: "Tabel Dihapus!",
                                text: res.message || `Tabel fisik ${tableName} berhasil dihapus.`,
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            swal.fire({
                                title: "Gagal Menghapus Tabel",
                                text: res.message || "Terjadi kesalahan saat menghapus tabel.",
                                icon: "error"
                            });
                        }
                    },
                    error: function (xhr) {
                        let errMsg = "Terjadi kesalahan pada server.";
                        try {
                            const parsed = JSON.parse(xhr.responseText);
                            if (parsed.message) errMsg = parsed.message;
                        } catch(e) {}
                        swal.fire({
                            title: "Kesalahan Sistem",
                            text: errMsg,
                            icon: "error"
                        });
                    }
                });
            }
        });
    }

    /**
     * Batch Clear per modul
     */
    function runBatchClear(actionKey, actionTitle, warningDetail) {
        swal.fire({
            title: actionTitle,
            html: `<div class="text-start">
                     <p class="mb-2">Apakah Anda yakin ingin menjalankan aksi pengosongan massal ini?</p>
                     <div class="alert alert-warning py-2 px-3 small mb-0">
                       <i class="fas fa-exclamation-triangle me-1"></i> ${warningDetail}
                     </div>
                   </div>`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d97706",
            cancelButtonColor: "#64748b",
            confirmButtonText: "<i class='fas fa-broom me-1'></i> Ya, Jalankan Pengosongan",
            cancelButtonText: "Batal"
        }).then(result => {
            if (result.value) {
                swal.fire({
                    title: "Memproses Pengosongan Massal...",
                    text: "Mohon tidak menutup halaman ini...",
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        swal.showLoading();
                    }
                });

                $.ajax({
                    url: base_url + 'dbclear/clearmodule',
                    type: "POST",
                    dataType: "json",
                    data: { action: actionKey },
                    success: function (res) {
                        if (res.status !== false && res.type !== 'error') {
                            swal.fire({
                                title: "Berhasil!",
                                text: res.message || "Pengosongan modul berhasil dijalankan.",
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            swal.fire({
                                title: "Gagal Memproses",
                                text: res.message || "Terjadi kendala saat melakukan pengosongan.",
                                icon: res.type === 'warning' ? 'warning' : 'error'
                            });
                        }
                    },
                    error: function (xhr) {
                        let errMsg = "Terjadi kesalahan pada server.";
                        try {
                            const parsed = JSON.parse(xhr.responseText);
                            if (parsed.message) errMsg = parsed.message;
                        } catch(e) {}
                        swal.fire({
                            title: "Kesalahan Sistem",
                            text: errMsg,
                            icon: "error"
                        });
                    }
                });
            }
        });
    }
</script>
<?= $this->endSection() ?>
