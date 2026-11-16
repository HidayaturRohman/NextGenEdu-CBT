<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

<div class="d-contents">
    <!-- Header Banner -->
    <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px; background: #ffffff;">
        <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="me-3 flex-shrink-0">
                        <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" 
                             style="width: 60px; height: 60px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #ffffff;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                            <?= $judul ?>
                            <span class="badge bg-success ms-2 fs-6 px-3 py-1 rounded-pill shadow-sm" id="badgeCurrentVersion">
                                v<?= esc($current_version) ?>
                            </span>
                        </h4>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            <?= $subjudul ?>. Perbarui sistem, perbaikan bug, dan migrasi database tanpa perlu akses FTP manual.
                        </p>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <a href="<?= base_url('settings') ?>" class="btn btn-outline-secondary btn-sm px-3 shadow-sm rounded-pill">
                        <i class="fas fa-arrow-left me-1"></i> Pengaturan
                    </a>
                    <button type="button" class="btn btn-outline-primary btn-sm px-3 shadow-sm rounded-pill" onclick="window.location.reload();">
                        <i class="fas fa-sync-alt me-1"></i> Refresh
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- System Status Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 10px;">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="rounded-circle p-2 bg-primary bg-opacity-10 text-primary me-3">
                        <i class="fas fa-code-branch fa-lg"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Versi CBT Aktif</small>
                        <strong class="fs-5 text-dark">v<?= esc($current_version) ?></strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 10px;">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="rounded-circle p-2 bg-info bg-opacity-10 text-info me-3">
                        <i class="fab fa-php fa-lg"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">PHP Version & Max Upload</small>
                        <strong class="fs-6 text-dark"><?= esc($php_version) ?> (<?= esc($max_upload) ?>)</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 10px;">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="rounded-circle p-2 <?= $zip_enabled ? 'bg-success bg-opacity-10 text-success' : 'bg-danger bg-opacity-10 text-danger' ?> me-3">
                        <i class="fas fa-file-archive fa-lg"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">PHP ZipArchive</small>
                        <strong class="fs-6 <?= $zip_enabled ? 'text-success' : 'text-danger' ?>">
                            <?= $zip_enabled ? 'Aktif (Siap)' : 'Nonaktif (Perlu diaktifkan)' ?>
                        </strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 10px;">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="rounded-circle p-2 <?= ($writable_app && $writable_folder) ? 'bg-success bg-opacity-10 text-success' : 'bg-warning bg-opacity-10 text-warning' ?> me-3">
                        <i class="fas fa-shield-alt fa-lg"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block">Izin Direktori</small>
                        <strong class="fs-6 text-dark">
                            <?= ($writable_app && $writable_folder) ? 'Writable (Aman)' : 'Sebagian Dibatasi' ?>
                        </strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <ul class="nav nav-pills mb-4 gap-2 bg-white p-2 rounded-3 shadow-sm border" id="patchTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active rounded-pill px-4 fw-semibold" id="tab-apply-btn" data-bs-toggle="pill" data-bs-target="#tab-apply" type="button" role="tab">
                <i class="fas fa-cloud-upload-alt me-2"></i> Terapkan Patch
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-pill px-4 fw-semibold" id="tab-history-btn" data-bs-toggle="pill" data-bs-target="#tab-history" type="button" role="tab">
                <i class="fas fa-history me-2"></i> Riwayat & Rollback 
                <span class="badge bg-secondary ms-1"><?= count($history) ?></span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-pill px-4 fw-semibold" id="tab-backups-btn" data-bs-toggle="pill" data-bs-target="#tab-backups" type="button" role="tab">
                <i class="fas fa-database me-2"></i> File Cadangan Server
                <span class="badge bg-info text-dark ms-1"><?= count($disk_backups) ?></span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-pill px-4 fw-semibold" id="tab-builder-btn" data-bs-toggle="pill" data-bs-target="#tab-builder" type="button" role="tab">
                <i class="fas fa-tools me-2"></i> Pembuat Patch (Dev)
            </button>
        </li>
    </ul>

    <div class="tab-content" id="patchTabContent">
        <!-- ========================================== -->
        <!-- TAB 1: TERAPKAN PATCH                      -->
        <!-- ========================================== -->
        <div class="tab-pane fade show active" id="tab-apply" role="tabpanel">
            <div class="row g-4 mb-4">
                <!-- Form Upload Patch -->
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                        <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                            <h5 class="mb-0 fw-bold text-dark">
                                <i class="fas fa-file-upload text-primary me-2"></i> Unggah Paket Pembaruan (.zip)
                            </h5>
                            <span class="badge bg-light text-secondary border">Maks. <?= esc($max_upload) ?></span>
                        </div>
                        <div class="card-body p-4">
                            <form id="formPatch" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-secondary">Pilih File Paket Patch (.zip)</label>
                                    <div class="input-group">
                                        <input type="file" name="patch_file" id="patch_file" class="form-control form-control-lg" accept=".zip" required>
                                    </div>
                                    <small class="text-muted mt-1 d-block">
                                        * Pilih file arsip paket patch resmi (misal: <code>patch-v3.0.6.zip</code>).
                                    </small>
                                </div>

                                <!-- Progress Bar (Hidden by Default) -->
                                <div id="patchProgressWrapper" class="mb-3 d-none">
                                    <div class="d-flex justify-content-between mb-1">
                                        <small class="text-muted" id="patchProgressText">Mengunggah & Memproses...</small>
                                        <small class="fw-bold text-primary" id="patchProgressPercent">0%</small>
                                    </div>
                                    <div class="progress" style="height: 10px; border-radius: 5px;">
                                        <div id="patchProgressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
                                             role="progressbar" style="width: 0%"></div>
                                    </div>
                                </div>

                                <div class="alert alert-info border-0 bg-info bg-opacity-10 text-dark mb-4 py-2 px-3 rounded-3" style="font-size: 0.88rem;">
                                    <i class="fas fa-shield-alt text-info me-2"></i>
                                    <strong>Auto-Backup Otomatis Aktif:</strong> Sebelum file baru ditimpa ke server, sistem secara otomatis mencadangkan file versi lama ke folder <code>writable/patches/backups/</code>. Anda dapat mengunduh atau melakukan <strong>Rollback 1-Klik</strong> kapan saja.
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="button" id="btnPreviewPatch" class="btn btn-outline-primary btn-lg shadow-sm fw-bold flex-fill">
                                        <i class="fas fa-search me-1"></i> Cek & Pratinjau
                                    </button>
                                    <button type="submit" id="btnSubmitPatch" class="btn btn-success btn-lg shadow-sm fw-bold flex-fill">
                                        <i class="fas fa-bolt me-1"></i> Terapkan Sekarang
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Panduan Format Patch -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; background: #f8fafc;">
                        <div class="card-header bg-transparent py-3 border-bottom">
                            <h5 class="mb-0 fw-bold text-dark">
                                <i class="fas fa-book-open text-success me-2"></i> Struktur Paket Patch Resmi
                            </h5>
                        </div>
                        <div class="card-body p-4" style="font-size: 0.88rem;">
                            <p class="text-muted mb-2">Paket patch adalah file <code>.zip</code> fleksibel dengan isi:</p>
                            <pre class="bg-dark text-white p-3 rounded-3 mb-3" style="font-size: 0.8rem; line-height: 1.4;"><code>patch-v3.0.6.zip
├── manifest.json       (Metadata versi)
├── update.sql          (Opsional skrip SQL)
└── files/              (Atau langsung app/ & public/)
    ├── app/
    │   └── Controllers/...
    └── public/
        └── assets/...</code></pre>
                            <div class="accordion accordion-flush" id="accordionHelp">
                                <div class="accordion-item bg-transparent">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed bg-transparent py-2 px-0 text-primary fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                            Contoh Format manifest.json
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionHelp">
                                        <div class="accordion-body px-0 py-2">
                                            <pre class="bg-white p-2 rounded border" style="font-size: 0.75rem;"><code>{
  "name": "CBT Patch v3.0.6",
  "version": "3.0.6",
  "min_version": "3.0.5",
  "description": "Perbaikan perpustakaan, zoom pc, dan menu scroll",
  "release_date": "<?= date('Y-m-d') ?>"
}</code></pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- TAB 2: RIWAYAT PATCH & ROLLBACK            -->
        <!-- ========================================== -->
        <div class="tab-pane fade" id="tab-history" role="tabpanel">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="fas fa-history text-secondary me-2"></i> Riwayat Patch Terpasang
                    </h5>
                    <span class="badge bg-secondary rounded-pill px-3"><?= count($history) ?> Catatan</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-secondary" style="font-size: 0.85rem;">
                                <tr>
                                    <th class="ps-4" style="width: 50px;">No</th>
                                    <th style="width: 120px;">Versi</th>
                                    <th>Deskripsi & Nama Patch</th>
                                    <th style="width: 100px;">Status</th>
                                    <th style="width: 100px;">File Diubah</th>
                                    <th style="width: 90px;">Database</th>
                                    <th style="width: 150px;">Tanggal Pasang</th>
                                    <th style="width: 110px;">Oleh</th>
                                    <th class="text-end pe-4" style="width: 220px;">Aksi & Backup</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 0.9rem;">
                                <?php if (empty($history)): ?>
                                    <tr>
                                        <td colspan="9" class="text-center py-5 text-muted">
                                            <i class="fas fa-box-open fa-3x mb-3 d-block text-secondary opacity-50"></i>
                                            Belum ada riwayat patch yang terpasang melalui sistem ini.
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($history as $idx => $h): ?>
                                        <tr>
                                            <td class="ps-4 fw-semibold text-muted"><?= $idx + 1 ?></td>
                                            <td>
                                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 fs-6">
                                                    v<?= esc($h['version']) ?>
                                                </span>
                                                <?php if (!empty($h['prev_version'])): ?>
                                                    <small class="text-muted d-block" style="font-size: 0.72rem;">
                                                        dari v<?= esc($h['prev_version']) ?>
                                                    </small>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="fw-semibold text-dark"><?= esc($h['name'] ?: 'Patch v' . $h['version']) ?></div>
                                                <small class="text-muted"><?= esc($h['description']) ?></small>
                                            </td>
                                            <td>
                                                <?php if (($h['status'] ?? 'applied') === 'rolled_back'): ?>
                                                    <span class="badge bg-secondary">Di-Rollback</span>
                                                <?php else: ?>
                                                    <span class="badge bg-success">Aktif</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark border px-2 py-1">
                                                    <?= esc($h['files_count']) ?> file
                                                </span>
                                            </td>
                                            <td>
                                                <?php if ($h['has_sql']): ?>
                                                    <span class="badge bg-warning text-dark"><i class="fas fa-database me-1"></i> Ada SQL</span>
                                                <?php else: ?>
                                                    <span class="badge bg-light text-muted border">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    <i class="far fa-clock me-1"></i> <?= date('d M Y H:i', strtotime($h['applied_at'])) ?>
                                                </small>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-secondary border">
                                                    <?= esc($h['applied_by'] ?? 'admin') ?>
                                                </span>
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="btn-group btn-group-sm">
                                                    <?php if (!empty($h['backup_file'])): ?>
                                                        <a href="<?= base_url('patch/download_backup/' . esc($h['backup_file'])) ?>" 
                                                           class="btn btn-outline-primary btn-sm"
                                                           title="Unduh file backup ZIP">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                        <?php if (($h['status'] ?? 'applied') !== 'rolled_back'): ?>
                                                            <button type="button" 
                                                                    class="btn btn-outline-warning btn-sm btn-rollback" 
                                                                    data-id="<?= esc($h['id_patch']) ?>"
                                                                    data-version="<?= esc($h['version']) ?>"
                                                                    data-prev="<?= esc($h['prev_version'] ?? 'sebelumnya') ?>"
                                                                    title="Rollback (kembalikan versi)">
                                                                <i class="fas fa-undo-alt me-1"></i> Rollback
                                                            </button>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <span class="text-muted small me-2">-</span>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- TAB 3: FILE CADANGAN SERVER               -->
        <!-- ========================================== -->
        <div class="tab-pane fade" id="tab-backups" role="tabpanel">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">
                            <i class="fas fa-hdd text-info me-2"></i> Arsip Cadangan di Server
                        </h5>
                        <small class="text-muted">Lokasi direktori: <code>writable/patches/backups/</code></small>
                    </div>
                    <span class="badge bg-light text-dark border"><?= count($disk_backups) ?> Arsip Ditemukan</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-secondary" style="font-size: 0.85rem;">
                                <tr>
                                    <th class="ps-4">Nama File Arsip</th>
                                    <th>Ukuran File</th>
                                    <th>Waktu Dibuat</th>
                                    <th class="text-end pe-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 0.9rem;">
                                <?php if (empty($disk_backups)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">
                                            <i class="fas fa-archive fa-3x mb-3 d-block text-secondary opacity-50"></i>
                                            Belum ada arsip cadangan tersimpan di direktori server.
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($disk_backups as $bk): ?>
                                        <tr>
                                            <td class="ps-4 fw-semibold text-dark">
                                                <i class="fas fa-file-archive text-warning me-2"></i> <?= esc($bk['name']) ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-secondary border"><?= esc($bk['size']) ?></span>
                                            </td>
                                            <td>
                                                <small class="text-muted"><i class="far fa-clock me-1"></i> <?= esc($bk['time']) ?></small>
                                            </td>
                                            <td class="text-end pe-4">
                                                <a href="<?= base_url('patch/download_backup/' . esc($bk['name'])) ?>" class="btn btn-outline-primary btn-sm rounded-pill px-3 me-1">
                                                    <i class="fas fa-download me-1"></i> Unduh
                                                </a>
                                                <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3 btn-delete-backup" data-filename="<?= esc($bk['name']) ?>">
                                                    <i class="fas fa-trash-alt me-1"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- TAB 4: PEMBUAT PATCH (DEVELOPER TOOL)      -->
        <!-- ========================================== -->
        <div class="tab-pane fade" id="tab-builder" role="tabpanel">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="mb-0 fw-bold text-dark">
                        <i class="fas fa-box text-primary me-2"></i> Generator Pembuat Paket Patch (.zip)
                    </h5>
                    <small class="text-muted">Gunakan modul ini untuk mengemas berkas perubahan menjadi paket patch resmi yang siap didistribusikan ke server lain.</small>
                </div>
                <div class="card-body p-4">
                    <form id="formCreatePatch">
                        <?= csrf_field() ?>
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Nomor Versi Target <span class="text-danger">*</span></label>
                                <input type="text" name="version" class="form-control" placeholder="Contoh: 3.0.7" required>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label fw-semibold">Deskripsi Singkat Patch</label>
                                <input type="text" name="description" class="form-control" placeholder="Contoh: Perbaikan modul perpus & update patch system">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Daftar File Relatif yang Dimasukkan <span class="text-danger">*</span></label>
                            <textarea name="file_list" class="form-control font-monospace" rows="6" placeholder="app/Controllers/Patch.php&#10;app/Views/setting/patch.php&#10;app/Config/Routes.php" required style="font-size: 0.85rem;"></textarea>
                            <small class="text-muted">* Satu file per baris, path relatif terhadap ROOTPATH (misal: <code>app/Controllers/Patch.php</code>).</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Skrip SQL Tambahan (Opsional)</label>
                            <textarea name="sql_query" class="form-control font-monospace" rows="4" placeholder="ALTER TABLE cbt_settings ADD COLUMN IF NOT EXISTS sample_col VARCHAR(100);&#10;-- query update jika ada" style="font-size: 0.85rem;"></textarea>
                            <small class="text-muted">* Akan disimpan sebagai <code>update.sql</code> dan dieksekusi saat patch dipasang.</small>
                        </div>

                        <button type="submit" id="btnCreatePatch" class="btn btn-primary fw-bold px-4 py-2 shadow-sm rounded-pill">
                            <i class="fas fa-cube me-1"></i> Buat & Unduh Paket Patch (.zip)
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pratinjau Patch (Preview Modal) -->
<div class="modal fade" id="modalPreviewPatch" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light py-3 border-bottom">
                <h5 class="modal-title fw-bold text-dark">
                    <i class="fas fa-search text-primary me-2"></i> Pratinjau Paket Patch
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="previewModalBody">
                <!-- Diisi secara dinamis oleh JavaScript -->
            </div>
            <div class="modal-footer bg-light py-2 border-top">
                <button type="button" class="btn btn-secondary rounded-pill px-3" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success fw-bold rounded-pill px-4" id="btnConfirmApplyFromPreview">
                    <i class="fas fa-bolt me-1"></i> Terapkan Sekarang
                </button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- SweetAlert2 Fallback jika belum ter-load -->
<script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
<script>
$(document).ready(function() {
    function getCleanUrl(endpoint) {
        let full = '<?= base_url() ?>/' + endpoint;
        return full.replace(/([^:]\/)\/+/g, "$1");
    }

    // ==========================================
    // 1. PRATINJAU / CEK PATCH SEBELUM DITERAPKAN
    // ==========================================
    $('#btnPreviewPatch').on('click', function() {
        const fileInput = $('#patch_file')[0];
        if (!fileInput.files.length) {
            Swal.fire({
                icon: 'warning',
                title: 'Pilih File Terlebih Dahulu',
                text: 'Silakan pilih file paket patch (.zip) sebelum melakukan pratinjau.'
            });
            return;
        }

        const formData = new FormData($('#formPatch')[0]);
        const btn = $(this);
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i> Memeriksa...');

        $.ajax({
            url: getCleanUrl('patch/preview'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                btn.prop('disabled', false).html('<i class="fas fa-search me-1"></i> Cek & Pratinjau');
                if (typeof res === 'string') {
                    try { res = JSON.parse(res); } catch(e) {}
                }

                if (res && res.status) {
                    renderPreviewModal(res);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Validasi Gagal',
                        text: (res && res.message) ? res.message : 'File patch tidak dapat dibaca atau struktur tidak sesuai.'
                    });
                }
            },
            error: function(xhr) {
                btn.prop('disabled', false).html('<i class="fas fa-search me-1"></i> Cek & Pratinjau');
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan Server',
                    text: 'Gagal menghubungi server (Error: ' + xhr.status + ')'
                });
            }
        });
    });

    function renderPreviewModal(data) {
        let html = `
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded border">
                        <small class="text-muted d-block">Versi Target Patch</small>
                        <h4 class="fw-bold text-success mb-0">v${data.target_version}</h4>
                        <small class="text-muted">Sistem Saat Ini: v${data.current_version}</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded border">
                        <small class="text-muted d-block">Ringkasan Berkas</small>
                        <div class="d-flex justify-content-between mt-1">
                            <span>Total File: <strong>${data.files_count}</strong></span>
                            <span class="text-warning">Update: <strong>${data.files_to_update}</strong></span>
                            <span class="text-primary">Baru: <strong>${data.files_new}</strong></span>
                        </div>
                        <small class="text-muted">Skrip Database SQL: <strong>${data.has_sql ? data.sql_queries_count + ' query' : 'Tidak ada'}</strong></small>
                    </div>
                </div>
            </div>
        `;

        if (data.version_warning) {
            html += `<div class="alert alert-warning py-2 mb-3"><i class="fas fa-exclamation-triangle me-1"></i> ${data.version_warning}</div>`;
        }

        if (data.unwritable_count > 0) {
            html += `<div class="alert alert-danger py-2 mb-3">
                <i class="fas fa-times-circle me-1"></i> <strong>Peringatan Izin Server:</strong> Ditemukan ${data.unwritable_count} berkas/folder yang tidak memiliki izin tulis (write-protected).
                <ul class="mb-0 mt-1" style="font-size:0.8rem;">
                    ${data.unwritable_paths.map(p => `<li>${p}</li>`).join('')}
                </ul>
            </div>`;
        }

        html += `
            <h6 class="fw-bold text-dark mb-2">Daftar File yang Terpengaruh:</h6>
            <div class="table-responsive border rounded" style="max-height: 220px; overflow-y: auto;">
                <table class="table table-sm table-striped mb-0" style="font-size: 0.82rem;">
                    <thead class="table-light">
                        <tr>
                            <th>Status</th>
                            <th>Jalur File Relatif</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${data.sample_files.map(f => `
                            <tr>
                                <td style="width: 100px;">
                                    ${f.is_update ? '<span class="badge bg-warning text-dark">Update</span>' : '<span class="badge bg-success">File Baru</span>'}
                                </td>
                                <td><code>${f.rel_path}</code></td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            </div>
            ${data.files_count > 15 ? `<small class="text-muted mt-1 d-block">... dan ${data.files_count - 15} file lainnya.</small>` : ''}
        `;

        $('#previewModalBody').html(html);
        const modal = new bootstrap.Modal(document.getElementById('modalPreviewPatch'));
        modal.show();

        $('#btnConfirmApplyFromPreview').off('click').on('click', function() {
            modal.hide();
            applyPatchProcess();
        });
    }

    // ==========================================
    // 2. EKSEKUSI PENERAPAN PATCH
    // ==========================================
    $('#formPatch').on('submit', function(e) {
        e.preventDefault();
        const fileInput = $('#patch_file')[0];
        if (!fileInput.files.length) {
            Swal.fire({
                icon: 'warning',
                title: 'Pilih File',
                text: 'Silakan pilih file paket patch (.zip) terlebih dahulu.'
            });
            return;
        }

        const fileName = fileInput.files[0].name;
        Swal.fire({
            title: 'Terapkan Patch?',
            html: `Anda akan menerapkan file patch: <br><strong>${fileName}</strong><br><br><small class="text-muted">Sistem akan mencadangkan file lama secara otomatis sebelum melakukan penimpaan.</small>`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#6b7280',
            confirmButtonText: '<i class="fas fa-bolt me-1"></i> Ya, Terapkan Sekarang',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                applyPatchProcess();
            }
        });
    });

    function applyPatchProcess() {
        const formData = new FormData($('#formPatch')[0]);
        const btnSubmit = $('#btnSubmitPatch');
        const progressWrapper = $('#patchProgressWrapper');
        const progressBar = $('#patchProgressBar');
        const progressPercent = $('#patchProgressPercent');
        const progressText = $('#patchProgressText');

        btnSubmit.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i> Menerapkan Patch...');
        progressWrapper.removeClass('d-none');
        progressBar.css('width', '25%');
        progressPercent.text('25%');
        progressText.text('Mengunggah berkas patch...');

        $.ajax({
            url: getCleanUrl('patch/apply'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            xhr: function() {
                const xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        const percentComplete = Math.round((evt.loaded / evt.total) * 75);
                        progressBar.css('width', Math.max(25, percentComplete) + '%');
                        progressPercent.text(Math.max(25, percentComplete) + '%');
                    }
                }, false);
                return xhr;
            },
            success: function(response) {
                progressBar.css('width', '100%');
                progressPercent.text('100%');
                progressText.text('Patch berhasil diterapkan!');

                if (typeof response === 'string') {
                    try { response = JSON.parse(response); } catch(e) {}
                }

                if (response && response.status) {
                    const successHtml = `<strong>${response.message}</strong><br><br>` +
                          `<div class="text-start bg-light p-3 rounded" style="font-size:0.85rem;">` +
                          `Versi baru: <strong>v${response.version}</strong><br>` +
                          `Total file diperbarui: <strong>${response.files_count} file</strong><br>` +
                          `Cadangan lama: <code>${response.backup_file}</code>` +
                          (response.has_sql ? `<br>Eksekusi Database: <strong>${response.sql_status ? response.sql_status.executed : 0} query berhasil</strong>` : '') +
                          `</div>`;

                    Swal.fire({
                        icon: 'success',
                        title: 'Pembaruan Berhasil!',
                        html: successHtml,
                        confirmButtonText: 'Segarkan Halaman',
                        confirmButtonColor: '#10b981'
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    btnSubmit.prop('disabled', false).html('<i class="fas fa-bolt me-1"></i> Terapkan Sekarang');
                    progressWrapper.addClass('d-none');
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Memasang Patch',
                        text: (response && response.message) ? response.message : 'Terjadi kendala saat memproses patch.'
                    });
                }
            },
            error: function(xhr) {
                btnSubmit.prop('disabled', false).html('<i class="fas fa-bolt me-1"></i> Terapkan Sekarang');
                progressWrapper.addClass('d-none');
                let errText = 'Gagal menghubungi server.';
                if (xhr.status === 413) {
                    errText = 'Ukuran file melebihi batas upload server (Error 413).';
                } else if (xhr.status === 403) {
                    errText = 'Sesi kedaluwarsa atau token ditolak (Error 403). Silakan refresh halaman.';
                } else {
                    try {
                        const json = JSON.parse(xhr.responseText);
                        if (json.message) errText = json.message;
                    } catch(e) {}
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan Sistem',
                    html: `Terjadi kendala (Kode: ${xhr.status}):<br><code class="d-block text-start p-2 bg-light mt-2 rounded" style="font-size:0.8rem;">${errText}</code>`
                });
            }
        });
    }

    // ==========================================
    // 3. ROLLBACK PATCH 1-KLIK
    // ==========================================
    $('.btn-rollback').on('click', function() {
        const idPatch = $(this).data('id');
        const version = $(this).data('version');
        const prevVersion = $(this).data('prev');

        Swal.fire({
            title: 'Kembalikan (Rollback) Patch?',
            html: `Anda akan membatalkan Patch <strong>v${version}</strong> dan mengembalikan sistem ke <strong>v${prevVersion}</strong>.<br><br><small class="text-danger fw-semibold">File yang dicadangkan saat patch ini dipasang akan dipulihkan secara otomatis.</small>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f59e0b',
            cancelButtonColor: '#6b7280',
            confirmButtonText: '<i class="fas fa-undo-alt me-1"></i> Ya, Rollback Sekarang',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Memulihkan Sistem...',
                    text: 'Sedang mengekstrak berkas cadangan, mohon tunggu...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: getCleanUrl('patch/rollback'),
                    type: 'POST',
                    data: {
                        id_patch: idPatch,
                        <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                    },
                    success: function(res) {
                        if (typeof res === 'string') {
                            try { res = JSON.parse(res); } catch(e) {}
                        }
                        if (res && res.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Rollback Berhasil!',
                                text: res.message,
                                confirmButtonColor: '#10b981'
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Rollback Gagal',
                                text: (res && res.message) ? res.message : 'Terjadi kesalahan saat memulihkan berkas.'
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Kesalahan Jaringan',
                            text: 'Gagal melakukan rollback (Kode: ' + xhr.status + ')'
                        });
                    }
                });
            }
        });
    });

    // ==========================================
    // 4. HAPUS FILE CADANGAN DI DISK
    // ==========================================
    $('.btn-delete-backup').on('click', function() {
        const filename = $(this).data('filename');

        Swal.fire({
            title: 'Hapus Arsip Cadangan?',
            text: 'File ' + filename + ' akan dihapus permanen dari direktori server.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: getCleanUrl('patch/delete_backup'),
                    type: 'POST',
                    data: {
                        filename: filename,
                        <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                    },
                    success: function(res) {
                        if (typeof res === 'string') {
                            try { res = JSON.parse(res); } catch(e) {}
                        }
                        if (res && res.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Terhapus',
                                text: res.message,
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire('Gagal', res.message || 'Gagal menghapus file.', 'error');
                        }
                    }
                });
            }
        });
    });

    // ==========================================
    // 5. PEMBUAT PAKET PATCH (DEVELOPER TOOL)
    // ==========================================
    $('#formCreatePatch').on('submit', function(e) {
        e.preventDefault();
        const btn = $('#btnCreatePatch');
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i> Membuat Paket ZIP...');

        $.ajax({
            url: getCleanUrl('patch/create'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(res) {
                btn.prop('disabled', false).html('<i class="fas fa-cube me-1"></i> Buat & Unduh Paket Patch (.zip)');
                if (typeof res === 'string') {
                    try { res = JSON.parse(res); } catch(e) {}
                }
                if (res && res.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Paket Patch Siap!',
                        html: `File <strong>${res.filename}</strong> berhasil dibuat (${res.files_count} berkas).<br>Unduhan akan segera dimulai otomatis.`,
                        confirmButtonText: 'Tutup'
                    });
                    if (res.download_url) {
                        window.location.href = res.download_url;
                    }
                } else {
                    Swal.fire('Gagal Membuat Patch', res.message || 'Terjadi kesalahan.', 'error');
                }
            },
            error: function(xhr) {
                btn.prop('disabled', false).html('<i class="fas fa-cube me-1"></i> Buat & Unduh Paket Patch (.zip)');
                Swal.fire('Kesalahan Server', 'Gagal memproses (Kode: ' + xhr.status + ')', 'error');
            }
        });
    });
});
</script>
<?= $this->endSection() ?>
