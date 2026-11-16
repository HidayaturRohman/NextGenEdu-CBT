<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

<div class="row mb-5 pb-5">
  <div class="col-sm-12">
    <!-- Header Card -->
    <div class="card mb-4 border-0 shadow-sm" style="border-radius: 14px;">
      <div class="card-body p-4">
        <div class="d-flex align-items-center">
          <div class="me-3 flex-shrink-0">
            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 62px; height: 62px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: #ffffff;">
              <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
              </svg>
            </div>
          </div>
          <div>
            <h4 class="card-title mb-1 fw-bold text-dark d-flex align-items-center">
                <?= $judul ?? 'Backup dan Restore' ?>
            </h4>
            <p class="text-muted mb-0" style="font-size: 0.92rem;">
              Pusat manajemen pencadangan (backup) dan pemulihan (restore) basis data MySQL (.sql) serta berkas unggahan (.zip) secara aman dan terstruktur.
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Row: Card Backup & Card Restore -->
    <div class="row g-4 mb-4">
      <!-- Card 1: PENCADANGAN (BACKUP) -->
      <div class="col-12 col-xl-7">
        <div class="card shadow-sm border-0 h-100" style="border-radius: 14px;">
          <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
              <span class="badge bg-primary-subtle text-primary p-2 rounded-circle me-2">
                <i class="fas fa-download fa-fw"></i>
              </span>
              <h6 class="mb-0 fw-bold text-dark">Pencadangan Data (Backup)</h6>
            </div>
            <button class="btn btn-outline-danger btn-sm fw-bold shadow-sm" onclick="hapusSemua()" <?= count($list) == 0 ? 'disabled' : '' ?> title="Hapus seluruh berkas backup di server">
              <i class="fas fa-trash me-1"></i> Hapus Semua
            </button>
          </div>
          <div class="card-body p-4 d-flex flex-column justify-content-between">
            <div>
              <p class="text-muted small mb-3">
                Buat salinan data terbaru secara mandiri atau menyeluruh. Sistem menggunakan teknologi *memory-safe streaming* sehingga aman untuk basis data besar tanpa risiko kehabisan memori server.
              </p>

              <!-- Tombol Aksi Backup -->
              <div class="d-flex flex-wrap gap-2 mb-3">
                <button type="button" class="btn btn-primary fw-bold shadow-sm px-3" onclick="processBackupDb()">
                  <i class="fas fa-database me-1"></i> Backup Database (.sql)
                </button>
                <button type="button" class="btn btn-info text-white fw-bold shadow-sm px-3" onclick="processBackupData()">
                  <i class="fas fa-file-archive me-1"></i> Backup Berkas Upload (.zip)
                </button>
                <button type="button" class="btn btn-success fw-bold shadow-sm px-3" onclick="processBackupSemua()">
                  <i class="fas fa-cloud-download-alt me-1"></i> Backup Semua Data
                </button>
              </div>

              <!-- Progress Bar -->
              <div class="d-none" id="backup-progress-wrapper">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <span class="small fw-bold text-primary" id="backup-progress-label">Menyiapkan...</span>
                  <span class="small fw-bold text-muted" id="backup-progress-percent">0%</span>
                </div>
                <div class="progress" style="height: 16px; border-radius: 8px;">
                  <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                       id="backup-progress-bar"
                       role="progressbar"
                       style="width: 0%;"
                       aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                  </div>
                </div>
              </div>
            </div>

            <div class="alert alert-light border py-2 px-3 mt-3 mb-0 small text-muted rounded-3">
              <i class="fas fa-info-circle text-primary me-1"></i>
              Berkas yang dicadangkan akan disimpan di folder cadangan server dan otomatis diunduh ke komputer Anda.
            </div>
          </div>
        </div>
      </div>

      <!-- Card 2: PEMULIHAN (RESTORE DARI KOMPUTER) -->
      <div class="col-12 col-xl-5">
        <div class="card shadow-sm border-0 h-100" style="border-radius: 14px;">
          <div class="card-header bg-white py-3 border-bottom d-flex align-items-center">
            <span class="badge bg-warning-subtle text-warning p-2 rounded-circle me-2">
              <i class="fas fa-undo-alt fa-fw"></i>
            </span>
            <h6 class="mb-0 fw-bold text-dark">Pemulihan dari Komputer (Restore)</h6>
          </div>
          <div class="card-body p-4 d-flex flex-column justify-content-between">
            <div>
              <div class="alert alert-warning border-0 py-2 px-3 mb-3 small rounded-3" style="background-color: #fffbeb; color: #92400e;">
                <div class="d-flex">
                  <i class="fas fa-exclamation-triangle mt-1 me-2 text-warning"></i>
                  <div>
                    <strong>PENTING:</strong> Memulihkan database (<code>.sql</code>) akan menimpa data yang sedang berjalan. Berkas <code>.zip</code> akan diekstrak ke direktori uploads.
                  </div>
                </div>
              </div>

              <!-- Upload Area -->
              <input type="file" id="input-restore-file" accept=".sql,.zip" class="d-none" onchange="onFileSelected(this)">
              <div id="dropzone-restore"
                   onclick="$('#input-restore-file').click()"
                   class="border border-2 border-dashed rounded-3 p-3 text-center mb-3"
                   style="background: #f8fafc; cursor: pointer; transition: all 0.2s ease;">
                <div id="dropzone-empty-view">
                  <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-2"></i>
                  <div class="fw-bold text-dark small">Pilih atau Seret Berkas Cadangan</div>
                  <div class="text-muted" style="font-size: 0.78rem;">Mendukung berkas <b>.sql</b> (Database) atau <b>.zip</b> (Uploads)</div>
                </div>
                <div id="dropzone-selected-view" class="d-none">
                  <div class="d-flex align-items-center justify-content-center mb-1">
                    <span id="selected-file-badge" class="badge bg-primary me-2">SQL</span>
                    <strong id="selected-file-name" class="text-dark small text-truncate" style="max-width: 220px;">file.sql</strong>
                  </div>
                  <div class="text-muted" style="font-size: 0.75rem;" id="selected-file-size">0 KB</div>
                  <button type="button" class="btn btn-link btn-sm text-danger p-0 mt-1" onclick="event.stopPropagation(); resetSelectedFile();" style="font-size: 0.75rem;">
                    <i class="fas fa-times me-1"></i> Ganti Berkas
                  </button>
                </div>
              </div>

              <!-- Progress Upload/Restore -->
              <div class="d-none mb-3" id="restore-progress-wrapper">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <span class="small fw-bold text-warning" id="restore-progress-label">Memproses pemulihan...</span>
                  <span class="small fw-bold text-muted" id="restore-progress-percent">0%</span>
                </div>
                <div class="progress" style="height: 14px; border-radius: 8px;">
                  <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning"
                       id="restore-progress-bar"
                       role="progressbar"
                       style="width: 0%;"
                       aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                  </div>
                </div>
              </div>
            </div>

            <button type="button" id="btn-submit-restore" class="btn btn-warning text-dark fw-bold shadow-sm w-100" onclick="processUploadRestore()" disabled>
              <i class="fas fa-play-circle me-1"></i> Pulihkan (Restore) File Ini
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Card 3: RIWAYAT CADANGAN -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 14px;">
      <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
          <span class="badge bg-success-subtle text-success p-2 rounded-circle me-2">
            <i class="fas fa-history fa-fw"></i>
          </span>
          <h6 class="mb-0 fw-bold text-dark">Riwayat Berkas Cadangan di Server</h6>
        </div>
        <span class="badge bg-light text-dark border px-2 py-1">
          Total: <strong><?= count($list) ?></strong> berkas
        </span>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table id="table-backup-list" class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th width="60" class="text-center">No.</th>
                <th>Nama Berkas</th>
                <th class="text-center" width="160">Jenis Data</th>
                <th class="text-center" width="130">Ukuran</th>
                <th class="text-center" width="200">Waktu Dibuat</th>
                <th class="text-center" width="260">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if (empty($list)): ?>
                <tr>
                  <td colspan="6" class="text-center py-5 text-muted">
                    <i class="fas fa-box-open fa-3x mb-3 text-secondary opacity-50 d-block"></i>
                    Belum ada berkas cadangan di server. Silakan buat cadangan baru pada menu di atas.
                  </td>
                </tr>
              <?php else: ?>
                <?php foreach ($list as $key => $item): ?>
                  <tr>
                    <td class="text-center fw-bold text-muted"><?= $key + 1 ?></td>
                    <td>
                      <div class="d-flex align-items-center">
                        <?php if ($item['type'] === 'sql'): ?>
                          <i class="fas fa-database text-primary fs-5 me-2"></i>
                        <?php else: ?>
                          <i class="fas fa-file-archive text-warning fs-5 me-2"></i>
                        <?php endif; ?>
                        <div>
                          <strong class="text-dark font-monospace"><?= esc($item['src']) ?></strong>
                        </div>
                      </div>
                    </td>
                    <td class="text-center">
                      <?php if ($item['type'] === 'sql'): ?>
                        <span class="badge bg-primary text-white px-2 py-1">
                          <i class="fas fa-table me-1"></i> Database (.sql)
                        </span>
                      <?php else: ?>
                        <span class="badge bg-info text-dark px-2 py-1">
                          <i class="fas fa-images me-1"></i> Berkas Uploads (.zip)
                        </span>
                      <?php endif; ?>
                    </td>
                    <td class="text-center">
                      <span class="badge bg-light text-dark border px-2 py-1 font-monospace"><?= esc($item['size']) ?></span>
                    </td>
                    <td class="text-center small text-muted">
                      <?= buat_tanggal(date('D, d M Y H:i:s', $item['tgl'])) ?>
                    </td>
                    <td class="text-center">
                      <div class="btn-group btn-group-sm shadow-sm" role="group">
                        <!-- Download -->
                        <a href="<?= base_url('dbmanager/download/' . $item['src']) ?>"
                           class="btn btn-outline-success fw-bold"
                           title="Unduh berkas ke komputer">
                          <i class="fas fa-download me-1"></i> Unduh
                        </a>
                        <!-- Restore langsung dari server -->
                        <button type="button"
                                class="btn btn-warning text-dark fw-bold"
                                onclick="restoreExistingFile('<?= esc($item['src']) ?>', '<?= esc($item['type']) ?>')"
                                title="Pulihkan data langsung dari berkas cadangan ini">
                          <i class="fas fa-undo-alt me-1"></i> Restore
                        </button>
                        <!-- Hapus -->
                        <button type="button"
                                class="btn btn-outline-danger fw-bold"
                                onclick="hapusFile('<?= esc($item['src']) ?>')"
                                title="Hapus berkas ini dari server">
                          <i class="fas fa-trash"></i>
                        </button>
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
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    var selectedRestoreFile = null;

    // ==========================================
    // SELEKSI & DRAG DROP FILE RESTORE
    // ==========================================
    function onFileSelected(input) {
        if (input.files && input.files[0]) {
            selectedRestoreFile = input.files[0];
            var name = selectedRestoreFile.name;
            var size = formatBytesJs(selectedRestoreFile.size);
            var ext = name.split('.').pop().toLowerCase();

            if (ext !== 'sql' && ext !== 'zip') {
                swal.fire({
                    title: "Format Tidak Didukung",
                    text: "Hanya berkas .sql (database) atau .zip (berkas upload) yang dapat dipulihkan.",
                    icon: "error"
                });
                resetSelectedFile();
                return;
            }

            $('#dropzone-empty-view').addClass('d-none');
            $('#dropzone-selected-view').removeClass('d-none');
            $('#selected-file-name').text(name);
            $('#selected-file-size').text(size);

            if (ext === 'sql') {
                $('#selected-file-badge').removeClass('bg-info text-dark').addClass('bg-primary text-white').text('SQL (Database)');
            } else {
                $('#selected-file-badge').removeClass('bg-primary text-white').addClass('bg-info text-dark').text('ZIP (Uploads)');
            }

            $('#btn-submit-restore').removeAttr('disabled');
        }
    }

    function resetSelectedFile() {
        selectedRestoreFile = null;
        $('#input-restore-file').val('');
        $('#dropzone-selected-view').addClass('d-none');
        $('#dropzone-empty-view').removeClass('d-none');
        $('#btn-submit-restore').attr('disabled', 'disabled');
    }

    function formatBytesJs(bytes, decimals = 2) {
        if (bytes === 0) return '0 B';
        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['B', 'KB', 'MB', 'GB', 'TB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }

    // Drag and Drop Effects
    const dropzone = document.getElementById('dropzone-restore');
    if (dropzone) {
        ['dragenter', 'dragover'].forEach(eventName => {
            dropzone.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropzone.style.borderColor = '#2563eb';
                dropzone.style.background = '#eff6ff';
            }, false);
        });
        ['dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
                dropzone.style.borderColor = '#cbd5e1';
                dropzone.style.background = '#f8fafc';
            }, false);
        });
        dropzone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            if (files && files.length) {
                document.getElementById('input-restore-file').files = files;
                onFileSelected(document.getElementById('input-restore-file'));
            }
        }, false);
    }

    // ==========================================
    // BACKUP DATABASE (.SQL)
    // ==========================================
    function processBackupDb() {
        showBackupProgress('Membuat cadangan database MySQL (.sql)...', 10);
        swal.fire({
            title: "Membackup Database",
            html: "Sedang mengekspor seluruh tabel dan struktur database...<br><small class='text-muted'>Mohon tunggu beberapa saat.</small>",
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => { swal.showLoading(); }
        });

        $.ajax({
            url: base_url + 'dbmanager/backupdb',
            type: 'POST',
            dataType: 'json',
            success: function(res) {
                if (res && res.status) {
                    setBackupProgress('Database berhasil dicadangkan!', 100);
                    triggerAutoDownload(base_url + 'dbmanager/download/' + res.file, res.file);

                    swal.fire({
                        title: "Backup Selesai!",
                        html: `<b>${res.file}</b> (${res.size}) berhasil dibuat dan diunduh ke komputer Anda.`,
                        icon: "success"
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    hideBackupProgress();
                    swal.fire({
                        title: "Gagal Backup Database",
                        text: res.message || "Terjadi kesalahan saat membackup database.",
                        icon: "error"
                    });
                }
            },
            error: function(xhr) {
                hideBackupProgress();
                swal.fire({
                    title: "Error",
                    text: "Koneksi terputus atau terjadi kesalahan server saat backup database.",
                    icon: "error"
                });
            }
        });
    }

    // ==========================================
    // BACKUP BERKAS UPLOADS (.ZIP)
    // ==========================================
    function processBackupData() {
        showBackupProgress('Mengompresi berkas foto, materi, dan gambar (.zip)...', 20);
        swal.fire({
            title: "Membackup Berkas Upload",
            html: "Sedang mengarsipkan folder uploads (foto siswa, guru, materi, bank soal)...<br><small class='text-muted'>Mohon tunggu beberapa saat.</small>",
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => { swal.showLoading(); }
        });

        $.ajax({
            url: base_url + 'dbmanager/backupdata',
            type: 'POST',
            dataType: 'json',
            success: function(res) {
                if (res && res.status) {
                    setBackupProgress('Berkas uploads berhasil diarsipkan!', 100);
                    triggerAutoDownload(base_url + 'dbmanager/download/' + res.file, res.file);

                    swal.fire({
                        title: "Backup Selesai!",
                        html: `<b>${res.file}</b> (${res.size}) berhasil dibuat dan diunduh ke komputer Anda.`,
                        icon: "success"
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    hideBackupProgress();
                    swal.fire({
                        title: "Gagal Backup Berkas",
                        text: res.message || "Terjadi kesalahan saat mengarsipkan berkas uploads.",
                        icon: "error"
                    });
                }
            },
            error: function(xhr) {
                hideBackupProgress();
                swal.fire({
                    title: "Error",
                    text: "Koneksi terputus atau terjadi kesalahan server saat backup berkas upload.",
                    icon: "error"
                });
            }
        });
    }

    // ==========================================
    // BACKUP SEMUA DATA (SQL + ZIP)
    // ==========================================
    function processBackupSemua() {
        showBackupProgress('Langkah 1/2: Membackup Database (.sql)...', 15);
        swal.fire({
            title: "Backup Semua Data",
            html: "Langkah 1/2: Mengekspor basis data (.sql)...",
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => { swal.showLoading(); }
        });

        $.ajax({
            url: base_url + 'dbmanager/backupdb',
            type: 'POST',
            dataType: 'json',
            success: function(resDb) {
                if (resDb && resDb.status) {
                    setBackupProgress('Langkah 2/2: Mengarsipkan Berkas Uploads (.zip)...', 55);
                    triggerAutoDownload(base_url + 'dbmanager/download/' + resDb.file, resDb.file);

                    swal.update({
                        html: "Langkah 2/2: Mengompresi berkas uploads (.zip)..."
                    });

                    $.ajax({
                        url: base_url + 'dbmanager/backupdata',
                        type: 'POST',
                        dataType: 'json',
                        success: function(resZip) {
                            if (resZip && resZip.status) {
                                setBackupProgress('Pencadangan semua data selesai!', 100);
                                setTimeout(function() {
                                    triggerAutoDownload(base_url + 'dbmanager/download/' + resZip.file, resZip.file);
                                }, 600);

                                swal.fire({
                                    title: "Pencadangan Berhasil!",
                                    html: `Basis data (<b>${resDb.file}</b>) dan Berkas Upload (<b>${resZip.file}</b>) berhasil dicadangkan dan diunduh.`,
                                    icon: "success"
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                hideBackupProgress();
                                swal.fire({
                                    title: "Peringatan",
                                    text: "Database berhasil dicadangkan, tetapi gagal mengarsipkan berkas upload: " + (resZip.message || ''),
                                    icon: "warning"
                                }).then(() => { window.location.reload(); });
                            }
                        },
                        error: function() {
                            hideBackupProgress();
                            swal.fire({
                                title: "Peringatan",
                                text: "Database berhasil dicadangkan, namun terjadi kesalahan saat mengarsipkan berkas uploads.",
                                icon: "warning"
                            }).then(() => { window.location.reload(); });
                        }
                    });
                } else {
                    hideBackupProgress();
                    swal.fire({
                        title: "Gagal",
                        text: resDb.message || "Gagal membackup database.",
                        icon: "error"
                    });
                }
            },
            error: function() {
                hideBackupProgress();
                swal.fire({
                    title: "Error",
                    text: "Terjadi kesalahan saat memulai pencadangan database.",
                    icon: "error"
                });
            }
        });
    }

    // ==========================================
    // RESTORE DARI FILE RIWAYAT SERVER
    // ==========================================
    function restoreExistingFile(filename, type) {
        var isSql = (type === 'sql');
        var warningText = isSql
            ? `Anda akan memulihkan data dari <b>${filename}</b>.<br><br><span class="text-danger fw-bold">PERINGATAN:</span> Seluruh tabel dan data saat ini akan ditimpa dengan data dari berkas cadangan ini. Pastikan Anda sudah membuat backup terbaru sebelum melanjutkan!`
            : `Anda akan mengekstrak kembali berkas <b>${filename}</b> ke folder uploads. File yang sama akan diperbarui dengan berkas cadangan ini.`;

        swal.fire({
            title: isSql ? "Pulihkan Basis Data?" : "Pulihkan Berkas Uploads?",
            html: warningText,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#f59e0b",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Ya, Lanjutkan Restore!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.value) {
                swal.fire({
                    title: "Sedang Memulihkan Data",
                    html: "Mohon tunggu, proses pemulihan sedang berlangsung di server...<br><small class='text-muted'>Jangan menutup atau memuat ulang halaman ini.</small>",
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => { swal.showLoading(); }
                });

                $.ajax({
                    url: base_url + 'dbmanager/restore_file',
                    type: 'POST',
                    data: { filename: filename },
                    dataType: 'json',
                    success: function(res) {
                        if (res && res.status) {
                            swal.fire({
                                title: "Pemulihan Berhasil!",
                                text: res.message,
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            swal.fire({
                                title: "Gagal Memulihkan Data",
                                text: res.message || "Terjadi kesalahan saat memulihkan berkas cadangan.",
                                icon: "error"
                            });
                        }
                    },
                    error: function() {
                        swal.fire({
                            title: "Error",
                            text: "Koneksi terputus saat mengeksekusi pemulihan data.",
                            icon: "error"
                        });
                    }
                });
            }
        });
    }

    // ==========================================
    // UNGGAH & RESTORE FILE DARI KOMPUTER
    // ==========================================
    function processUploadRestore() {
        if (!selectedRestoreFile) {
            swal.fire({
                title: "Pilih Berkas",
                text: "Silakan pilih berkas .sql atau .zip terlebih dahulu.",
                icon: "warning"
            });
            return;
        }

        var fileName = selectedRestoreFile.name;
        var ext = fileName.split('.').pop().toLowerCase();
        var isSql = (ext === 'sql');

        var confirmMsg = isSql
            ? `Anda akan mengunggah dan memulihkan <b>${fileName}</b>.<br><br><span class="text-danger fw-bold">PERINGATAN:</span> Seluruh data dan tabel aplikasi saat ini akan ditimpa dengan basis data dari berkas ini!`
            : `Anda akan mengunggah dan mengekstrak berkas <b>${fileName}</b> ke folder uploads server.`;

        swal.fire({
            title: isSql ? "Konfirmasi Restore Database" : "Konfirmasi Restore Berkas",
            html: confirmMsg,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#f59e0b",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Ya, Unggah & Pulihkan!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.value) {
                $('#restore-progress-wrapper').removeClass('d-none');
                $('#btn-submit-restore').attr('disabled', 'disabled');

                var formData = new FormData();
                formData.append('backup_file', selectedRestoreFile);

                swal.fire({
                    title: "Mengunggah & Memulihkan",
                    html: "<div id='swal-restore-status'>Mengunggah berkas ke server...</div>",
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => { swal.showLoading(); }
                });

                $.ajax({
                    url: base_url + 'dbmanager/upload_restore',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                                $('#restore-progress-bar').css('width', percentComplete + '%').attr('aria-valuenow', percentComplete);
                                $('#restore-progress-percent').text(percentComplete + '%');
                                if (percentComplete >= 100) {
                                    $('#restore-progress-label').text('Mengeksekusi pemulihan data di server...');
                                    $('#swal-restore-status').text('Berkas terunggah, sedang mengeksekusi pemulihan data...');
                                } else {
                                    $('#restore-progress-label').text('Mengunggah berkas (' + percentComplete + '%)...');
                                }
                            }
                        }, false);
                        return xhr;
                    },
                    success: function(res) {
                        $('#restore-progress-wrapper').addClass('d-none');
                        $('#btn-submit-restore').removeAttr('disabled');

                        if (res && res.status) {
                            swal.fire({
                                title: "Pemulihan Berhasil!",
                                text: res.message,
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            swal.fire({
                                title: "Gagal Memulihkan",
                                text: res.message || "Terjadi kesalahan saat memulihkan berkas unggahan.",
                                icon: "error"
                            });
                        }
                    },
                    error: function(xhr) {
                        $('#restore-progress-wrapper').addClass('d-none');
                        $('#btn-submit-restore').removeAttr('disabled');

                        let errMsg = "Koneksi terputus atau berkas melebihi batas upload server.";
                        try {
                            var json = JSON.parse(xhr.responseText);
                            if (json && json.message) errMsg = json.message;
                        } catch(e) {}

                        swal.fire({
                            title: "Error Unggah / Pemulihan",
                            text: errMsg,
                            icon: "error"
                        });
                    }
                });
            }
        });
    }

    // ==========================================
    // HAPUS SATU BERKAS
    // ==========================================
    function hapusFile(filename) {
        swal.fire({
            title: "Hapus Berkas Cadangan?",
            html: `Berkas <b>${filename}</b> akan dihapus secara permanen dari server.`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ef4444",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.value) {
                swal.fire({
                    title: "Menghapus Berkas",
                    text: "Mohon tunggu...",
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => { swal.showLoading(); }
                });

                $.ajax({
                    url: base_url + 'dbmanager/hapusbackup/' + filename,
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        if (res && res.status) {
                            swal.fire({
                                title: "Berhasil Dihapus",
                                text: res.message,
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            swal.fire({
                                title: "Gagal",
                                text: res.message || "Gagal menghapus berkas.",
                                icon: "error"
                            });
                        }
                    },
                    error: function() {
                        swal.fire({
                            title: "Error",
                            text: "Terjadi kesalahan jaringan saat menghapus berkas.",
                            icon: "error"
                        });
                    }
                });
            }
        });
    }

    // ==========================================
    // HAPUS SEMUA BERKAS
    // ==========================================
    function hapusSemua() {
        swal.fire({
            title: "Hapus Seluruh Cadangan?",
            html: "<span class='text-danger fw-bold'>Semua berkas cadangan di server akan dihapus secara permanen dan tidak dapat dikembalikan!</span>",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ef4444",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Ya, Hapus Semua!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.value) {
                swal.fire({
                    title: "Menghapus Semua Cadangan",
                    text: "Mohon tunggu...",
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    didOpen: () => { swal.showLoading(); }
                });

                $.ajax({
                    url: base_url + 'dbmanager/del_backup',
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        if (res && res.status) {
                            swal.fire({
                                title: "Semua Terhapus",
                                text: res.message,
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            swal.fire({
                                title: "Gagal",
                                text: res.message || "Gagal menghapus berkas cadangan.",
                                icon: "error"
                            });
                        }
                    },
                    error: function() {
                        swal.fire({
                            title: "Error",
                            text: "Terjadi kesalahan saat menghapus semua cadangan.",
                            icon: "error"
                        });
                    }
                });
            }
        });
    }

    // ==========================================
    // HELPER PROGRESS & AUTO-DOWNLOAD
    // ==========================================
    function showBackupProgress(label, percent) {
        $('#backup-progress-wrapper').removeClass('d-none');
        setBackupProgress(label, percent);
    }

    function setBackupProgress(label, percent) {
        $('#backup-progress-label').text(label);
        $('#backup-progress-percent').text(percent + '%');
        $('#backup-progress-bar').css('width', percent + '%').attr('aria-valuenow', percent);
    }

    function hideBackupProgress() {
        $('#backup-progress-wrapper').addClass('d-none');
        setBackupProgress('Menyiapkan...', 0);
    }

    function triggerAutoDownload(url, filename) {
        var a = document.createElement('a');
        a.href = url;
        a.download = filename;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }
</script>
<?= $this->endSection() ?>
