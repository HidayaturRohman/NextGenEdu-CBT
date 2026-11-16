<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<?php
$isKemenagMode = isset($is_kemenag) ? $is_kemenag : true;
?>
<div class="d-contents">
    <!-- Header Banner -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="me-3 flex-shrink-0">
                        <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, <?= $isKemenagMode ? '#10b981 0%, #059669' : '#3b82f6 0%, #1d4ed8' ?> 100%); color: #ffffff;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                                <line x1="9" y1="9" x2="9.01" y2="9"></line>
                                <line x1="15" y1="9" x2="15.01" y2="9"></line>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="card-title mb-1 fw-bold d-flex align-items-center text-dark">
                            Penilaian Kokurikuler
                        </h4>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            <?php if ($isKemenagMode): ?>
                                Penilaian Kokurikuler Kelas <strong><?= esc($kelas->nama_kelas ?? '-') ?></strong> berbasis <strong>Kemenag (RDM / DPL & Panca Cinta Madrasah)</strong>.
                            <?php else: ?>
                                Penilaian Kokurikuler Kelas <strong><?= esc($kelas->nama_kelas ?? '-') ?></strong> berbasis <strong>Kemendiknas (P5 Kurikulum Merdeka)</strong>.
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <?php if ($isKemenagMode): ?>
                        <span class="badge bg-soft-success text-success px-3 py-2 rounded-pill fw-bold">
                            <i class="fas fa-mosque me-1 text-warning"></i> Format Kemenag Aktif
                        </span>
                    <?php else: ?>
                        <span class="badge bg-soft-primary text-primary px-3 py-2 rounded-pill fw-bold">
                            <i class="fas fa-graduation-cap me-1 text-primary"></i> Format Diknas Aktif
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Navigasi Sesuai Format Lembaga (Kemenag vs Kemendiknas) -->
    <ul class="nav nav-pills mb-3 gap-2" id="kokurikulerTabs" role="tablist">
        <?php if ($isKemenagMode): ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link active rounded-pill px-4 py-2 fw-bold d-flex align-items-center shadow-sm" id="tab-kemenag-nav" data-bs-toggle="pill" data-bs-target="#tab-kemenag" type="button" role="tab">
                    <i class="fas fa-mosque me-2 text-warning"></i> Format Kemenag (RDM - DPL / Panca Cinta)
                </button>
            </li>
        <?php else: ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link active rounded-pill px-4 py-2 fw-bold d-flex align-items-center shadow-sm" id="tab-kemendiknas-nav" data-bs-toggle="pill" data-bs-target="#tab-kemendiknas" type="button" role="tab">
                    <i class="fas fa-graduation-cap me-2 text-primary"></i> Format Diknas (P5 Projek Profil)
                </button>
            </li>
        <?php endif; ?>
    </ul>

    <div class="tab-content" id="kokurikulerTabsContent">
        <?php if ($isKemenagMode): ?>
        <!-- ====================================================================
             TAB 1: VERSI KEMENAG (RDM - DPL / PANCA CINTA)
             Sesuai persis dengan tangkapan layar RDM Kemenag
             ==================================================================== -->
        <div class="tab-pane fade show active" id="tab-kemenag" role="tabpanel">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <h6 class="card-title mb-0 fw-bold text-dark">
                            Penilaian Kokurikuler
                        </h6>
                        <small class="text-muted">Dimensi Profil Lulusan (DPL) dan Panca Cinta Madrasah</small>
                    </div>
                    <div>
                        <span class="badge bg-soft-success text-success px-3 py-2 rounded-pill fw-bold" title="Nilai otomatis tersimpan dan tersinkron ke rapor">
                            <i class="fas fa-check-circle me-1"></i> Tersimpan Otomatis ke Rapor
                        </span>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Action Toolbar & Search -->
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <button type="button" class="btn btn-outline-secondary btn-sm rounded-1 px-3" onclick="copyKemenagTable()">
                                <i class="far fa-copy me-1"></i> Copy
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm rounded-1 px-3" onclick="printKemenagTable()">
                                <i class="fas fa-print me-1"></i> Print
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm rounded-1 px-3" onclick="exportKemenagExcel()">
                                <i class="far fa-file-excel me-1 text-success"></i> Excel
                            </button>
                            <button type="button" class="btn btn-primary btn-sm rounded-pill px-3 ms-2 shadow-sm" onclick="modalTambahKegiatan()">
                                <i class="fas fa-plus-circle me-1"></i> Tambah DPL / Panca Cinta
                            </button>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <label class="small text-muted mb-0">Search:</label>
                            <input type="search" id="searchKemenag" class="form-control form-control-sm" placeholder="Cari kegiatan..." style="max-width: 200px;">
                        </div>
                    </div>

                    <!-- Tabel Kokurikuler Kemenag -->
                    <div class="table-responsive rounded-3 border">
                        <table class="table table-bordered table-hover align-middle mb-0" id="tableKemenag">
                            <thead class="table-light">
                                <tr class="small fw-bold text-secondary text-center">
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 25%; text-align: start;">DPL/Panca Cinta</th>
                                    <th style="width: 45%; text-align: start;">Deskripsi</th>
                                    <th style="width: 10%;">Nilai</th>
                                    <th style="width: 15%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($kemenag_kegiatan)): ?>
                                    <?php foreach ($kemenag_kegiatan as $idx => $k): ?>
                                        <tr class="kemenag-row">
                                            <td class="text-center fw-bold text-secondary"><?= $idx + 1 ?></td>
                                            <td class="fw-semibold text-dark kemenag-dpl">
                                                <?= esc($k->dpl_panca_cinta) ?>
                                            </td>
                                            <td class="small text-secondary kemenag-desc" style="line-height: 1.5;">
                                                <?= esc($k->deskripsi) ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if (!empty($k->has_nilai)): ?>
                                                    <span class="badge bg-success p-2 rounded-2 shadow-sm" title="Sudah Dinilai (<?= $k->jumlah_dinilai ?> siswa)">
                                                        <i class="fas fa-check"></i>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary p-2 rounded-2" title="Belum Dinilai">
                                                        <i class="fas fa-minus"></i>
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <button type="button" class="btn btn-primary px-2 py-1 shadow-sm" title="Input Nilai Siswa" onclick="bukaModalPenilaian(<?= $k->id_kegiatan ?>, '<?= esc(addslashes($k->dpl_panca_cinta)) ?>')">
                                                        <i class="fas fa-th-list me-1"></i> Penilaian
                                                    </button>
                                                    <button type="button" class="btn btn-secondary px-2 py-1 shadow-sm" style="background-color: #6f42c1; border-color: #6f42c1;" title="Edit DPL & Deskripsi" onclick="modalEditKegiatan(<?= $k->id_kegiatan ?>, '<?= esc(addslashes($k->dpl_panca_cinta)) ?>', '<?= esc(addslashes($k->deskripsi)) ?>')">
                                                        <i class="fas fa-edit me-1"></i> Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger px-2 py-1 shadow-sm" title="Hapus Kegiatan" onclick="hapusKegiatanKemenag(<?= $k->id_kegiatan ?>, '<?= esc(addslashes($k->dpl_panca_cinta)) ?>')">
                                                        <i class="fas fa-trash-alt me-1"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            Belum ada kegiatan kokurikuler DPL / Panca Cinta. Silakan klik tombol "Tambah DPL / Panca Cinta".
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2 text-muted small" id="kemenagCountInfo">
                        Showing 1 to <?= count($kemenag_kegiatan ?? []) ?> of <?= count($kemenag_kegiatan ?? []) ?> entries
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>
        <!-- ====================================================================
             TAB 2: VERSI KEMENDIKNAS (P5 PROJEK PROFIL)
             Pengaturan Tema & Deskripsi Capaian Siswa
             ==================================================================== -->
        <div class="tab-pane fade show active" id="tab-kemendiknas" role="tabpanel">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <h6 class="card-title mb-0 fw-bold text-dark">
                            <i class="fas fa-graduation-cap text-primary me-2"></i> Penilaian Kokurikuler &amp; Deep Learning Kurikulum Merdeka
                        </h6>
                        <small class="text-muted">Kelola Kegiatan, Indikator Capaian Akhir, Predikat Nilai, dan Deskripsi Capaian Rapor Siswa</small>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm" onclick="modalEditKegiatanDiknas()">
                            <i class="fas fa-edit me-1"></i> Pengaturan Kegiatan
                        </button>
                        <button type="button" class="btn btn-warning btn-sm rounded-pill px-3 shadow-sm text-dark fw-bold" onclick="modalBukaCatatanDiknas()">
                            <i class="fas fa-file-alt me-1"></i> Deskripsi Capaian (Rapor)
                        </button>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Informasi Ringkasan Kegiatan -->
                    <div class="bg-light p-3 rounded-3 border mb-4">
                        <div class="row g-2 align-items-center">
                            <div class="col-md-3">
                                <div class="small text-muted">Nama Kelompok:</div>
                                <div class="fw-bold text-dark" id="display-nama-kelompok"><?= esc($diknas_kegiatan->nama_kelompok ?? (($kelas->nama_kelas ?? 'VII A') . ' - 1')) ?></div>
                            </div>
                            <div class="col-md-2">
                                <div class="small text-muted">Kelas:</div>
                                <div class="fw-bold text-dark"><?= esc($kelas->nama_kelas ?? '-') ?></div>
                            </div>
                            <div class="col-md-3">
                                <div class="small text-muted">Guru / Koordinator:</div>
                                <div class="fw-bold text-dark" id="display-koordinator"><?= esc($diknas_kegiatan->koordinator ?? 'Nama Guru, S.Pd') ?></div>
                            </div>
                            <div class="col-md-4">
                                <div class="small text-muted">Nama Kegiatan:</div>
                                <div class="fw-bold text-primary" id="display-nama-kegiatan"><?= esc($diknas_kegiatan->nama_kegiatan ?? 'Kajian dan Pembiasaan Ibadah') ?></div>
                            </div>
                        </div>
                    </div>

                    <!-- Petunjuk Capaian Akhir -->
                    <div class="alert alert-info py-2 px-3 small mb-3 border-0 rounded-3 shadow-none d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <i class="fas fa-info-circle me-1"></i> Capaian akhir digunakan sebagai indikator penilaian kokurikuler. Disarankan mencantumkan dua capaian akhir per kegiatan.
                        </div>
                        <button type="button" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm" onclick="modalTambahCapaianDiknas()">
                            <i class="fas fa-plus-circle me-1"></i> Tambah Capaian Akhir
                        </button>
                    </div>

                    <!-- Tabel Capaian Akhir -->
                    <div class="table-responsive rounded-3 border mb-4">
                        <table class="table table-bordered table-hover align-middle mb-0" id="tableDiknasCapaian">
                            <thead class="table-light">
                                <tr class="small fw-bold text-secondary text-center">
                                    <th style="width: 6%;">No</th>
                                    <th style="width: 28%; text-align: start;">Dimensi Profil Pelajar</th>
                                    <th style="width: 48%; text-align: start;">Capaian Akhir</th>
                                    <th style="width: 18%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($diknas_capaian)): ?>
                                    <?php foreach ($diknas_capaian as $idx => $cap): ?>
                                        <tr>
                                            <td class="text-center fw-bold text-secondary"><?= $idx + 1 ?></td>
                                            <td class="fw-semibold text-dark"><?= esc($cap->dimensi) ?></td>
                                            <td class="small text-muted" style="line-height: 1.4;"><?= esc($cap->capaian_akhir) ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-warning btn-sm rounded-pill px-3 py-1 shadow-sm text-dark fw-bold mb-1" onclick="modalInputNilaiDiknas(<?= $cap->id_capaian ?>, '<?= esc(addslashes($cap->capaian_akhir)) ?>')">
                                                    <i class="fas fa-pencil-alt me-1"></i> Input Nilai
                                                </button>
                                                <button type="button" class="btn btn-outline-danger btn-sm rounded-circle p-1 ms-1" title="Hapus Capaian" onclick="hapusCapaianDiknas(<?= $cap->id_capaian ?>)">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            Belum ada capaian akhir. Silakan klik tombol "Tambah Capaian Akhir".
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Preview Narasi Hasil Belajar Rapor Siswa -->
                    <div class="card border border-light-subtle rounded-3 mt-4">
                        <div class="card-header bg-light py-2 px-3 d-flex justify-content-between align-items-center">
                            <span class="small fw-bold text-secondary">
                                <i class="fas fa-magic me-1 text-primary"></i> Preview Deskripsi Narasi Capaian Rapor Siswa (Otomatis dari Nilai)
                            </span>
                            <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3" onclick="modalBukaCatatanDiknas()">
                                <i class="fas fa-edit me-1"></i> Edit Narasi Rapor
                            </button>
                        </div>
                        <div class="card-body p-3">
                            <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                                <table class="table table-sm table-striped align-middle mb-0">
                                    <thead>
                                        <tr class="small fw-bold text-secondary">
                                            <th style="width: 5%;">No</th>
                                            <th style="width: 25%;">Nama Siswa</th>
                                            <th style="width: 70%;">Deskripsi Narasi Kokurikuler</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($siswas as $idx => $s): 
                                            $descText = $diknas_catatan[$s->id_siswa] ?? ('Dalam kegiatan ' . ($diknas_kegiatan->nama_kegiatan ?? 'Kajian dan Pembiasaan Ibadah') . ', ' . $s->nama . ' sangat baik dalam melaksanakan ibadah harian (salat, doa, membaca Al-Qur\'an, dan adab dasar) secara mandiri dan benar. Sudah baik dalam membiasakan sikap religius, seperti disiplin beribadah, menjaga kebersihan, sopan, jujur, dan bertanggung jawab.');
                                        ?>
                                            <tr>
                                                <td class="text-center small text-muted"><?= $idx + 1 ?></td>
                                                <td class="fw-bold small text-dark"><?= esc($s->nama) ?></td>
                                                <td class="small text-muted" style="line-height: 1.35;"><?= esc($descText) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- ====================================================================
     MODAL TAMBAH PENILAIAN SISWA KEMENAG (SB, B, C, K)
     Sesuai persis dengan tangkapan layar modal RDM Kemenag
     ==================================================================== -->
<div class="modal fade" id="modalPenilaianKemenag" tabindex="-1" aria-labelledby="modalPenilaianLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="modal-title fw-bold text-dark mb-0" id="modalPenilaianLabel">
                        Tambah Penilaian
                    </h5>
                    <small class="text-muted" id="modalPenilaianDPLSubtitle">DPL / Panca Cinta</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">

                <!-- Search Box Modal -->
                <div class="d-flex justify-content-end mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <label class="small text-muted mb-0">Search:</label>
                        <input type="text" id="modalSearchSiswa" class="form-control form-control-sm" placeholder="Cari NISN / Nama..." style="width: 220px;">
                    </div>
                </div>

                <!-- Form Penilaian -->
                <form id="formPenilaianKemenag">
                    <input type="hidden" name="id_kegiatan" id="modal_id_kegiatan" value="">
                    <div class="table-responsive rounded-3 border">
                        <table class="table table-bordered table-hover align-middle mb-0" id="tableModalNilai">
                            <thead class="table-light">
                                <tr class="small fw-bold text-secondary text-center">
                                    <th rowspan="2" class="align-middle" style="width: 6%;">No</th>
                                    <th rowspan="2" class="align-middle" style="width: 24%; text-align: start;">NISN</th>
                                    <th rowspan="2" class="align-middle" style="width: 38%; text-align: start;">Nama</th>
                                    <th colspan="4" class="text-center" style="width: 32%;">Nilai</th>
                                </tr>
                                <tr class="small fw-bold text-secondary text-center">
                                    <!-- Header Checkbox Kolom SB, B, C, K untuk ceklis massal sekelas -->
                                    <th style="width: 8%;">
                                        SB<br>
                                        <input type="checkbox" class="form-check-input mt-1 chk-col-all" data-predikat="SB" title="Centang Semua SB">
                                    </th>
                                    <th style="width: 8%;">
                                        B<br>
                                        <input type="checkbox" class="form-check-input mt-1 chk-col-all" data-predikat="B" title="Centang Semua B">
                                    </th>
                                    <th style="width: 8%;">
                                        C<br>
                                        <input type="checkbox" class="form-check-input mt-1 chk-col-all" data-predikat="C" title="Centang Semua C">
                                    </th>
                                    <th style="width: 8%;">
                                        K<br>
                                        <input type="checkbox" class="form-check-input mt-1 chk-col-all" data-predikat="K" title="Centang Semua K">
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="modalNilaiTbody">
                                <!-- Populated dynamically via JS -->
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light py-2 px-3">
                <button type="button" class="btn btn-secondary btn-sm rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm" id="btnSimpanNilaiKemenag" onclick="simpanNilaiKemenag()">
                    <i class="fas fa-save me-1"></i> Simpan Penilaian
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ====================================================================
     MODAL TAMBAH / EDIT KEGIATAN DPL / PANCA CINTA KEMENAG
     ==================================================================== -->
<div class="modal fade" id="modalKegiatanKemenag" tabindex="-1" aria-labelledby="modalKegiatanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header bg-primary text-white py-3">
                <h5 class="modal-title fw-bold" id="modalKegiatanLabel">
                    <i class="fas fa-edit me-2"></i> Tambah DPL / Panca Cinta
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formKegiatanKemenag">
                <input type="hidden" name="id_kelas" value="<?= $id_kelas ?>">
                <input type="hidden" name="id_kegiatan" id="kegiatan_id" value="">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-dark">DPL / Panca Cinta <span class="text-danger">*</span></label>
                        <select name="dpl_panca_cinta" id="kegiatan_dpl" class="form-select shadow-sm" required>
                            <option value="">-- Pilih DPL / Panca Cinta --</option>
                            <optgroup label="Dimensi Profil Lulusan (DPL)">
                                <option value="Penalaran Kritis">Penalaran Kritis</option>
                                <option value="Komunikasi">Komunikasi</option>
                                <option value="Kolaborasi">Kolaborasi</option>
                                <option value="Kreativitas">Kreativitas</option>
                                <option value="Kemandirian">Kemandirian</option>
                                <option value="Kewargaan">Kewargaan</option>
                            </optgroup>
                            <optgroup label="Panca Cinta Madrasah">
                                <option value="Cinta Allah dan Rasul-Nya">Cinta Allah dan Rasul-Nya</option>
                                <option value="Cinta Ilmu">Cinta Ilmu</option>
                                <option value="Cinta Lingkungan">Cinta Lingkungan</option>
                                <option value="Cinta Diri dan Sesama">Cinta Diri dan Sesama</option>
                                <option value="Cinta Tanah Air">Cinta Tanah Air</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-dark">Deskripsi Capaian <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" id="kegiatan_deskripsi" class="form-control shadow-sm" rows="4" placeholder="Tuliskan deskripsi kompetensi kokurikuler kegiatan ini..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2 px-3">
                    <button type="button" class="btn btn-secondary btn-sm rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ====================================================================
     MODAL EDIT KEGIATAN KOKURIKULER DIKNAS
     ==================================================================== -->
<div class="modal fade" id="modalEditKegiatanDiknas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            <div class="modal-header bg-white py-3 border-bottom">
                <h5 class="modal-title fw-bold text-dark mb-0">
                    <i class="fas fa-edit text-primary me-2"></i> Pengaturan Kegiatan Kokurikuler
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditKegiatanDiknas">
                <input type="hidden" name="id_kelas" value="<?= $id_kelas ?>">
                <input type="hidden" name="id_kegiatan" value="<?= $diknas_kegiatan->id_kegiatan ?? '' ?>">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Nama Kelompok Kegiatan:</label>
                        <input type="text" name="nama_kelompok" id="edit_nama_kelompok" class="form-control" value="<?= esc($diknas_kegiatan->nama_kelompok ?? (($kelas->nama_kelas ?? 'VII A') . ' - 1')) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Tema Projek (P5):</label>
                        <select name="tema" id="edit_tema" class="form-select">
                            <?php 
                            $temas = [
                                'Gaya Hidup Berkelanjutan', 'Kearifan Lokal', 'Bhinneka Tunggal Ika',
                                'Bangunlah Jiwa dan Raganya', 'Suara Demokrasi', 'Rekayasa dan Teknologi',
                                'Kewirausahaan', 'Kebekerjaan'
                            ];
                            $curTema = $diknas_kegiatan->tema ?? 'Kearifan Lokal';
                            foreach ($temas as $t): ?>
                                <option value="<?= $t ?>" <?= ($t == $curTema) ? 'selected' : '' ?>><?= $t ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Nama Kegiatan:</label>
                        <input type="text" name="nama_kegiatan" id="edit_nama_kegiatan" class="form-control" value="<?= esc($diknas_kegiatan->nama_kegiatan ?? 'Kajian dan Pembiasaan Ibadah') ?>" placeholder="Contoh: Kajian dan Pembiasaan Ibadah" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Guru / Koordinator:</label>
                        <input type="text" name="koordinator" id="edit_koordinator" class="form-control" value="<?= esc($diknas_kegiatan->koordinator ?? 'Nama Guru, S.Pd') ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Deskripsi Ringkas Kegiatan:</label>
                        <textarea name="deskripsi" id="edit_deskripsi_kegiatan" rows="2" class="form-control" placeholder="Tuliskan gambaran pelaksanaan kegiatan..."><?= esc($diknas_kegiatan->deskripsi ?? 'Penguatan karakter spiritual dan religius melalui pembiasaan ibadah harian.') ?></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2 px-4 border-top">
                    <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm fw-bold">Simpan Kegiatan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ====================================================================
     MODAL TAMBAH / EDIT CAPAIAN AKHIR DIKNAS
     ==================================================================== -->
<div class="modal fade" id="modalTambahCapaianDiknas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px;">
            <div class="modal-header bg-white py-3 border-bottom">
                <h5 class="modal-title fw-bold text-dark mb-0">
                    <i class="fas fa-plus-circle text-primary me-2"></i> Tambah Capaian Akhir
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formTambahCapaianDiknas">
                <input type="hidden" name="id_kegiatan" value="<?= $diknas_kegiatan->id_kegiatan ?? '' ?>">
                <input type="hidden" name="id_capaian" id="capaian_id_capaian" value="">
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Dimensi Profil Pelajar Pancasila:</label>
                        <select name="dimensi_id" id="capaian_dimensi_id" class="form-select" onchange="updateDimensiText(this)" required>
                            <option value="1">1. Keimanan dan Ketakwaan terhadap Tuhan YME</option>
                            <option value="2">2. Kewargaan</option>
                            <option value="3">3. Penalaran Kritis</option>
                            <option value="4">4. Kreativitas</option>
                            <option value="5">5. Kolaborasi</option>
                            <option value="6">6. Kemandirian</option>
                            <option value="7">7. Kesehatan</option>
                            <option value="8">8. Komunikasi</option>
                        </select>
                        <input type="hidden" name="dimensi" id="capaian_dimensi_text" value="Keimanan dan Ketakwaan terhadap Tuhan YME">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Capaian Akhir (Indikator):</label>
                        <textarea name="capaian_akhir" id="capaian_akhir_text" rows="3" class="form-control" placeholder="Contoh: melaksanakan ibadah harian (salat, doa, membaca Al-Qur'an, dan adab dasar) secara mandiri dan benar." required></textarea>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold text-secondary">Urutan Capaian:</label>
                        <select name="urutan" id="capaian_urutan" class="form-select" style="max-width: 120px;">
                            <option value="1">Capaian 1</option>
                            <option value="2">Capaian 2</option>
                            <option value="3">Capaian 3</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2 px-4 border-top">
                    <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm fw-bold">Simpan Capaian</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ====================================================================
     MODAL INPUT NILAI PREDIKAT DIKNAS (DENGAN TERAPKAN PREDIKAT RATA)
     ==================================================================== -->
<div class="modal fade" id="modalNilaiDiknas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="modal-title fw-bold text-dark mb-0">
                        <i class="fas fa-pencil-alt text-warning me-2"></i> Input Nilai Kokurikuler
                    </h5>
                    <small class="text-muted" id="modalNilaiDiknasSubtitle">Capaian Profil</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <!-- Toolbar Terapkan Predikat Rata -->
                <div class="bg-light p-3 rounded-3 border mb-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <label class="small fw-bold text-secondary mb-0">Terapkan Predikat Rata:</label>
                        <select id="selectPredikatRata" class="form-select form-select-sm" style="width: 140px;">
                            <option value="SB">Sangat Baik (SB)</option>
                            <option value="B" selected>Baik (B)</option>
                            <option value="C">Cukup (C)</option>
                            <option value="K">Kurang (K)</option>
                        </select>
                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold" onclick="terapkanPredikatRataDiknas()">
                            <i class="fas fa-check-double me-1"></i> Terapkan Semua
                        </button>
                    </div>
                    <div>
                        <input type="text" id="searchSiswaDiknas" class="form-control form-control-sm" placeholder="Cari Siswa..." style="width: 200px;">
                    </div>
                </div>

                <form id="formSimpanNilaiDiknas">
                    <input type="hidden" name="id_kegiatan" id="nilai_diknas_id_kegiatan" value="<?= $diknas_kegiatan->id_kegiatan ?? '' ?>">
                    <input type="hidden" name="id_capaian" id="nilai_diknas_id_capaian" value="">

                    <div class="table-responsive rounded-3 border">
                        <table class="table table-bordered table-hover align-middle mb-0" id="tableModalNilaiDiknas">
                            <thead class="table-light">
                                <tr class="small fw-bold text-secondary text-center">
                                    <th style="width: 6%;">No</th>
                                    <th style="width: 22%; text-align: start;">NIS / NISN</th>
                                    <th style="width: 44%; text-align: start;">Nama Siswa</th>
                                    <th style="width: 8%;">L/P</th>
                                    <th style="width: 20%;">Predikat</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyModalNilaiDiknas">
                                <!-- Terisi otomatis lewat JavaScript -->
                            </tbody>
                        </table>
                    </div>

                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" id="confirmNilaiDiknas" required>
                        <label class="form-check-label small fw-bold text-secondary" for="confirmNilaiDiknas">
                            Saya yakin sudah mengisi penilaian dengan benar
                        </label>
                    </div>

                    <div class="mt-3 text-end">
                        <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3 me-2" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm fw-bold">
                            <i class="fas fa-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ====================================================================
     MODAL DESKRIPSI CAPAIAN KOKURIKULER (RAPOR)
     ==================================================================== -->
<div class="modal fade" id="modalCatatanDiknas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            <div class="modal-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="modal-title fw-bold text-dark mb-0">
                        <i class="fas fa-file-alt text-primary me-2"></i> Deskripsi Capaian Kokurikuler (Rapor)
                    </h5>
                    <small class="text-muted">Narasi hasil belajar yang dicetak pada kotak Kokurikuler di Rapor Siswa</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="alert alert-info py-2 px-3 small mb-3 border-0 rounded-3 shadow-none">
                    <i class="fas fa-magic me-1 text-primary"></i> Deskripsi capaian terisi otomatis berdasarkan input predikat nilai kokurikuler. Anda dapat menyesuaikan teks narasi per siswa di bawah ini jika diperlukan.
                </div>

                <form id="formSimpanCatatanDiknas">
                    <input type="hidden" name="id_kegiatan" value="<?= $diknas_kegiatan->id_kegiatan ?? '' ?>">
                    <div class="table-responsive rounded-3 border">
                        <table class="table table-bordered table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr class="small fw-bold text-secondary text-center">
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 18%; text-align: start;">NIS / NISN</th>
                                    <th style="width: 25%; text-align: start;">Nama Siswa</th>
                                    <th style="width: 52%; text-align: start;">Deskripsi Capaian Kokurikuler</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyModalCatatanDiknas">
                                <!-- Terisi otomatis lewat JavaScript -->
                            </tbody>
                        </table>
                    </div>

                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" id="confirmCatatanDiknas" required>
                        <label class="form-check-label small fw-bold text-secondary" for="confirmCatatanDiknas">
                            Saya yakin sudah memeriksa deskripsi dengan benar
                        </label>
                    </div>

                    <div class="mt-3 text-end">
                        <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3 me-2" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm fw-bold">
                            <i class="fas fa-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function () {
        ajaxcsrf();

        // -------------------------------------------------------------
        // SEARCH FILTER TABEL KEMENAG
        // -------------------------------------------------------------
        $('#searchKemenag').on('keyup', function () {
            var val = $(this).val().toLowerCase().trim();
            var visible = 0;
            $('.kemenag-row').each(function () {
                var dpl = $(this).find('.kemenag-dpl').text().toLowerCase();
                var desc = $(this).find('.kemenag-desc').text().toLowerCase();
                if (!val || dpl.includes(val) || desc.includes(val)) {
                    $(this).show();
                    visible++;
                } else {
                    $(this).hide();
                }
            });
            $('#kemenagCountInfo').text('Showing 1 to ' + visible + ' entries');
        });

        // -------------------------------------------------------------
        // SEARCH FILTER DI MODAL PENILAIAN SISWA
        // -------------------------------------------------------------
        $('#modalSearchSiswa').on('keyup', function () {
            var val = $(this).val().toLowerCase().trim();
            $('.modal-siswa-row').each(function () {
                var nama = $(this).find('.m-nama').text().toLowerCase();
                var nisn = $(this).find('.m-nisn').text().toLowerCase();
                if (!val || nama.includes(val) || nisn.includes(val)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // -------------------------------------------------------------
        // SUBMIT MODAL TAMBAH/EDIT KEGIATAN KEMENAG
        // -------------------------------------------------------------
        $('#formKegiatanKemenag').on('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Menyimpan...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            $.ajax({
                url: '<?= base_url('rapor/savekemenagkegiatan') ?>',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (res) {
                    if (res.status) {
                        Swal.fire('Berhasil!', res.message, 'success').then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Gagal', res.message || 'Gagal menyimpan kegiatan', 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
                }
            });
        });

        // -------------------------------------------------------------
        // CHECKBOX MASSAL PER KOLOM DI HEADER MODAL (SB, B, C, K)
        // -------------------------------------------------------------
        $(document).on('change', '.chk-col-all', function () {
            var pred = $(this).data('predikat');
            var isChecked = $(this).is(':checked');

            if (isChecked) {
                // Uncheck header checkboxes lain
                $('.chk-col-all').not(this).prop('checked', false);

                // Set kolom ini tercentang untuk semua baris siswa yang sedang terlihat
                $('.modal-siswa-row:visible').each(function () {
                    var $row = $(this);
                    $row.find('.chk-nilai').prop('checked', false);
                    $row.find('.chk-nilai[data-predikat="' + pred + '"]').prop('checked', true);
                });
            } else {
                // Uncheck semua
                $('.modal-siswa-row:visible').each(function () {
                    $(this).find('.chk-nilai[data-predikat="' + pred + '"]').prop('checked', false);
                });
            }
        });

        // -------------------------------------------------------------
        // CHECKBOX DI BARIS SISWA: BEKERJA SEPERTI RADIO BUTTON BERSIH
        // -------------------------------------------------------------
        $(document).on('change', '.chk-nilai', function () {
            var $row = $(this).closest('tr');
            if ($(this).is(':checked')) {
                // Uncheck nilai lain di baris siswa yang sama
                $row.find('.chk-nilai').not(this).prop('checked', false);
            }
        });

        // -------------------------------------------------------------
        // FORM P5 KEMENDIKNAS
        // -------------------------------------------------------------
        $('#form-p5').on('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Menyimpan...',
                text: 'Silakan tunggu...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            $.ajax({
                url: '<?= base_url('rapor/savep5') ?>',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (res) {
                    if (res.status) {
                        Swal.fire('Tersimpan', 'Catatan kokurikuler P5 berhasil disimpan', 'success')
                            .then(() => { location.reload(); });
                    } else {
                        Swal.fire('Gagal', res.message || 'Gagal menyimpan P5', 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
                }
            });
        });

        // -------------------------------------------------------------
        // FORM PENGATURAN KEGIATAN DIKNAS
        // -------------------------------------------------------------
        $('#formEditKegiatanDiknas').on('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Menyimpan Kegiatan...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            $.ajax({
                url: '<?= base_url('rapor/savediknaskegiatan') ?>',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (res) {
                    if (res.status) {
                        Swal.fire('Berhasil!', res.message, 'success').then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Gagal', res.message || 'Gagal menyimpan kegiatan', 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'Terjadi kesalahan sistem saat menyimpan kegiatan', 'error');
                }
            });
        });

        // -------------------------------------------------------------
        // FORM TAMBAH CAPAIAN AKHIR DIKNAS
        // -------------------------------------------------------------
        $('#formTambahCapaianDiknas').on('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Menyimpan Capaian...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            $.ajax({
                url: '<?= base_url('rapor/savediknascapaian') ?>',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (res) {
                    if (res.status) {
                        Swal.fire('Berhasil!', res.message, 'success').then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Gagal', res.message || 'Gagal menyimpan capaian', 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'Terjadi kesalahan sistem saat menyimpan capaian', 'error');
                }
            });
        });

        // -------------------------------------------------------------
        // FORM SIMPAN NILAI PREDIKAT DIKNAS
        // -------------------------------------------------------------
        $('#formSimpanNilaiDiknas').on('submit', function (e) {
            e.preventDefault();
            if (!$('#confirmNilaiDiknas').is(':checked')) {
                Swal.fire('Perhatian', 'Silakan centang konfirmasi sebelum menyimpan', 'warning');
                return;
            }

            Swal.fire({
                title: 'Menyimpan Nilai & Menghasilkan Narasi...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            $.ajax({
                url: '<?= base_url('rapor/savediknasnilai') ?>',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (res) {
                    if (res.status) {
                        Swal.fire('Berhasil!', res.message, 'success').then(() => {
                            $('#modalNilaiDiknas').modal('hide');
                            location.reload();
                        });
                    } else {
                        Swal.fire('Gagal', res.message || 'Gagal menyimpan nilai', 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'Terjadi kesalahan sistem saat menyimpan nilai', 'error');
                }
            });
        });

        // -------------------------------------------------------------
        // FORM SIMPAN CATATAN NARASI DIKNAS
        // -------------------------------------------------------------
        $('#formSimpanCatatanDiknas').on('submit', function (e) {
            e.preventDefault();
            if (!$('#confirmCatatanDiknas').is(':checked')) {
                Swal.fire('Perhatian', 'Silakan centang konfirmasi sebelum menyimpan', 'warning');
                return;
            }

            Swal.fire({
                title: 'Menyimpan Catatan Rapor...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            $.ajax({
                url: '<?= base_url('rapor/savediknascatatan') ?>',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (res) {
                    if (res.status) {
                        Swal.fire('Berhasil!', res.message, 'success').then(() => {
                            $('#modalCatatanDiknas').modal('hide');
                            location.reload();
                        });
                    } else {
                        Swal.fire('Gagal', res.message || 'Gagal menyimpan catatan', 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'Terjadi kesalahan sistem saat menyimpan catatan', 'error');
                }
            });
        });

        // -------------------------------------------------------------
        // PENCARIAN SISWA DI MODAL NILAI DIKNAS
        // -------------------------------------------------------------
        $('#searchSiswaDiknas').on('keyup', function () {
            var val = $(this).val().toLowerCase().trim();
            $('.diknas-siswa-nilai-row').each(function () {
                var text = $(this).text().toLowerCase();
                if (!val || text.includes(val)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });

    // -------------------------------------------------------------
    // MODAL TAMBAH & EDIT KEGIATAN
    // -------------------------------------------------------------
    function modalTambahKegiatan() {
        $('#modalKegiatanLabel').html('<i class="fas fa-plus-circle me-2"></i> Tambah DPL / Panca Cinta');
        $('#formKegiatanKemenag')[0].reset();
        $('#kegiatan_id').val('');
        $('#modalKegiatanKemenag').modal('show');
    }

    function modalEditKegiatan(id, dpl, desc) {
        $('#modalKegiatanLabel').html('<i class="fas fa-edit me-2"></i> Edit DPL / Panca Cinta');
        $('#kegiatan_id').val(id);
        $('#kegiatan_dpl').val(dpl);
        $('#kegiatan_deskripsi').val(desc);
        $('#modalKegiatanKemenag').modal('show');
    }

    function hapusKegiatanKemenag(id, dpl) {
        Swal.fire({
            title: 'Hapus Kegiatan?',
            text: 'DPL / Panca Cinta "' + dpl + '" beserta nilai siswa akan dihapus.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menghapus...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                $.ajax({
                    url: '<?= base_url('rapor/deletekemenagkegiatan') ?>',
                    type: 'POST',
                    data: { id_kegiatan: id },
                    dataType: 'json',
                    success: function (res) {
                        if (res.status) {
                            Swal.fire('Terhapus!', res.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Gagal', res.message, 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Error', 'Terjadi kesalahan server', 'error');
                    }
                });
            }
        });
    }

    // -------------------------------------------------------------
    // MODAL PENILAIAN SISWA KEMENAG (SB, B, C, K)
    // -------------------------------------------------------------
    function bukaModalPenilaian(idKegiatan, dplTitle) {
        $('#modal_id_kegiatan').val(idKegiatan);
        $('#modalPenilaianDPLSubtitle').text(dplTitle);
        $('#modalSearchSiswa').val('');
        $('.chk-col-all').prop('checked', false);

        Swal.fire({
            title: 'Memuat Siswa...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        $.ajax({
            url: '<?= base_url('rapor/getkemenagnilai') ?>/' + idKegiatan,
            type: 'GET',
            dataType: 'json',
            success: function (res) {
                Swal.close();
                if (res.status) {
                    var siswas = res.siswas || [];
                    var nilaiMap = res.nilai_map || {};
                    var html = '';

                    siswas.forEach(function (s, idx) {
                        var val = nilaiMap[s.id_siswa] || '';
                        var isSB = (val === 'SB') ? 'checked' : '';
                        var isB  = (val === 'B')  ? 'checked' : '';
                        var isC  = (val === 'C')  ? 'checked' : '';
                        var isK  = (val === 'K')  ? 'checked' : '';

                        html += '<tr class="modal-siswa-row" data-siswa="' + s.id_siswa + '">';
                        html += '<td class="text-center fw-bold text-secondary">' + (idx + 1) + '</td>';
                        html += '<td class="m-nisn text-muted">' + (s.nisn || '-') + '</td>';
                        html += '<td class="m-nama fw-semibold text-dark">' + s.nama + '</td>';

                        // 4 Kolom Predikat: SB, B, C, K
                        html += '<td class="text-center">';
                        html += '<input type="checkbox" class="form-check-input chk-nilai" name="nilai[' + s.id_siswa + ']" value="SB" data-predikat="SB" ' + isSB + '>';
                        html += '</td>';
                        html += '<td class="text-center">';
                        html += '<input type="checkbox" class="form-check-input chk-nilai" name="nilai[' + s.id_siswa + ']" value="B" data-predikat="B" ' + isB + '>';
                        html += '</td>';
                        html += '<td class="text-center">';
                        html += '<input type="checkbox" class="form-check-input chk-nilai" name="nilai[' + s.id_siswa + ']" value="C" data-predikat="C" ' + isC + '>';
                        html += '</td>';
                        html += '<td class="text-center">';
                        html += '<input type="checkbox" class="form-check-input chk-nilai" name="nilai[' + s.id_siswa + ']" value="K" data-predikat="K" ' + isK + '>';
                        html += '</td>';
                        html += '</tr>';
                    });

                    if (siswas.length === 0) {
                        html = '<tr><td colspan="7" class="text-center py-3 text-muted">Belum ada siswa dalam kelas ini.</td></tr>';
                    }

                    $('#modalNilaiTbody').html(html);
                    $('#modalPenilaianKemenag').modal('show');
                } else {
                    Swal.fire('Gagal', res.message || 'Gagal memuat data nilai siswa', 'error');
                }
            },
            error: function () {
                Swal.fire('Error', 'Terjadi kesalahan sistem saat memuat data siswa', 'error');
            }
        });
    }

    function simpanNilaiKemenag() {
        var idKegiatan = $('#modal_id_kegiatan').val();
        var formData = $('#formPenilaianKemenag').serialize();

        Swal.fire({
            title: 'Menyimpan Nilai...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        $.ajax({
            url: '<?= base_url('rapor/savekemenagnilai') ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (res) {
                if (res.status) {
                    Swal.fire('Berhasil!', res.message, 'success').then(() => {
                        $('#modalPenilaianKemenag').modal('hide');
                        location.reload();
                    });
                } else {
                    Swal.fire('Gagal', res.message, 'error');
                }
            },
            error: function () {
                Swal.fire('Error', 'Terjadi kesalahan sistem saat menyimpan nilai', 'error');
            }
        });
    }

    // -------------------------------------------------------------
    // TOGGLE KIRIM / BATAL KIRIM NILAI KEMENAG
    // -------------------------------------------------------------
    function toggleKirimKemenag(status) {
        var aksiText = (status === 1) ? 'Kirim Nilai Kokurikuler' : 'Batal Kirim Nilai Kokurikuler';
        var descText = (status === 1)
            ? 'Nilai kokurikuler DPL / Panca Cinta akan dikirimkan dan siap dicetak ke rapor.'
            : 'Pengiriman nilai akan dibatalkan sehingga proses penilaian dapat disunting kembali.';

        Swal.fire({
            title: aksiText + '?',
            text: descText,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: (status === 1) ? '#198754' : '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: (status === 1) ? 'Ya, Kirim Nilai!' : 'Ya, Batalkan Kirim!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Memproses...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                $.ajax({
                    url: '<?= base_url('rapor/togglekemenagkirim') ?>',
                    type: 'POST',
                    data: {
                        id_kelas: '<?= $id_kelas ?>',
                        status: status
                    },
                    dataType: 'json',
                    success: function (res) {
                        if (res.status) {
                            Swal.fire('Berhasil!', res.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Gagal', res.message, 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
                    }
                });
            }
        });
    }

    // -------------------------------------------------------------
    // EXPORT TOOLS (COPY, PRINT, EXCEL)
    // -------------------------------------------------------------
    function copyKemenagTable() {
        var text = "No\tDPL/Panca Cinta\tDeskripsi\tNilai\n";
        $('.kemenag-row:visible').each(function (i) {
            var dpl = $(this).find('.kemenag-dpl').text().trim();
            var desc = $(this).find('.kemenag-desc').text().trim();
            text += (i + 1) + "\t" + dpl + "\t" + desc + "\tSudah Dinilai\n";
        });

        navigator.clipboard.writeText(text).then(function() {
            Swal.fire({ title: 'Tersalin!', text: 'Tabel kokurikuler berhasil disalin ke clipboard.', icon: 'success', timer: 1500, showConfirmButton: false });
        }).catch(function() {
            Swal.fire('Info', 'Gagal menyalin teks ke clipboard.', 'info');
        });
    }

    function printKemenagTable() {
        var printContents = document.getElementById('tableKemenag').outerHTML;
        var originalContents = document.body.innerHTML;
        var w = window.open('', '_blank');
        w.document.write('<html><head><title>Cetak Penilaian Kokurikuler Kemenag</title>');
        w.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">');
        w.document.write('</head><body class="p-4">');
        w.document.write('<h4 class="fw-bold mb-3">Penilaian Kokurikuler Kelas <?= esc($kelas->nama_kelas ?? '-') ?></h4>');
        w.document.write(printContents);
        w.document.write('</body></html>');
        w.document.close();
        w.focus();
        setTimeout(function() { w.print(); }, 500);
    }

    function exportKemenagExcel() {
        var csv = "No,DPL/Panca Cinta,Deskripsi,Nilai\n";
        $('.kemenag-row:visible').each(function (i) {
            var dpl = '"' + $(this).find('.kemenag-dpl').text().trim().replace(/"/g, '""') + '"';
            var desc = '"' + $(this).find('.kemenag-desc').text().trim().replace(/"/g, '""') + '"';
            csv += (i + 1) + "," + dpl + "," + desc + ",Sudah Dinilai\n";
        });

        var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        var link = document.createElement("a");
        var url = URL.createObjectURL(blob);
        link.setAttribute("href", url);
        link.setAttribute("download", "Kokurikuler_Kemenag_Kelas_<?= esc($kelas->nama_kelas ?? '-') ?>.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    function applyToAll() {
        var tema = $('#global-tema').val();
        var desc = $('#global-desc').val();
        $('.tema-input').val(tema);
        $('.desc-input').val(desc);
        Swal.fire({ title: 'Diterapkan', text: 'Tema dan deskripsi diterapkan ke seluruh siswa. Jangan lupa klik tombol Simpan.', icon: 'info', timer: 1500, showConfirmButton: false });
    }

    // =============================================================
    // FUNGSI KOKURIKULER KEMENDIKNAS (DEEP LEARNING KURMER)
    // =============================================================
    function updateDimensiText(el) {
        var text = $(el).find('option:selected').text();
        text = text.replace(/^\d+\.\s*/, '').trim();
        $('#capaian_dimensi_text').val(text);
    }

    function modalEditKegiatanDiknas() {
        $('#modalEditKegiatanDiknas').modal('show');
    }

    function modalTambahCapaianDiknas() {
        var idKegiatan = '<?= $diknas_kegiatan->id_kegiatan ?? '' ?>';
        if (!idKegiatan) {
            Swal.fire({
                title: 'Perhatian',
                text: 'Harap simpan pengaturan kegiatan terlebih dahulu sebelum menambah capaian akhir.',
                icon: 'warning'
            });
            $('#modalEditKegiatanDiknas').modal('show');
            return;
        }
        $('#formTambahCapaianDiknas')[0].reset();
        $('#capaian_id_capaian').val('');
        $('#capaian_dimensi_id').val('1').trigger('change');
        $('#modalTambahCapaianDiknas').modal('show');
    }

    function hapusCapaianDiknas(id) {
        Swal.fire({
            title: 'Hapus Capaian Akhir?',
            text: 'Capaian akhir beserta data penilaian siswa untuk capaian ini akan dihapus.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menghapus...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                $.ajax({
                    url: '<?= base_url('rapor/deletediknascapaian') ?>',
                    type: 'POST',
                    data: { id_capaian: id },
                    dataType: 'json',
                    success: function (res) {
                        if (res.status) {
                            Swal.fire('Terhapus!', res.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Gagal', res.message || 'Gagal menghapus capaian', 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Error', 'Terjadi kesalahan sistem saat menghapus capaian', 'error');
                    }
                });
            }
        });
    }

    function modalInputNilaiDiknas(idCapaian, capaianText) {
        var idKegiatan = '<?= $diknas_kegiatan->id_kegiatan ?? '' ?>';
        if (!idKegiatan) {
            Swal.fire('Perhatian', 'Harap simpan pengaturan kegiatan terlebih dahulu', 'warning');
            return;
        }

        $('#nilai_diknas_id_kegiatan').val(idKegiatan);
        $('#nilai_diknas_id_capaian').val(idCapaian);
        $('#modalNilaiDiknasSubtitle').text(capaianText);
        $('#searchSiswaDiknas').val('');
        $('#confirmNilaiDiknas').prop('checked', false);

        Swal.fire({
            title: 'Memuat Siswa...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        $.ajax({
            url: '<?= base_url('rapor/getdiknasnilai') ?>/' + idKegiatan + '/' + idCapaian,
            type: 'GET',
            dataType: 'json',
            success: function (res) {
                Swal.close();
                if (res.status) {
                    var siswas = res.siswas || [];
                    var nilaiMap = res.nilai_map || {};
                    var html = '';

                    siswas.forEach(function (s, idx) {
                        var curVal = (nilaiMap[s.id_siswa] !== undefined && nilaiMap[s.id_siswa] !== null && nilaiMap[s.id_siswa] !== '') ? nilaiMap[s.id_siswa] : 'B';
                        var jk = s.jenis_kelamin || s.jk || '-';
                        var nis = s.nis || '-';
                        var nisn = s.nisn || '-';

                        html += '<tr class="diknas-siswa-nilai-row">';
                        html += '<td class="text-center fw-bold text-secondary">' + (idx + 1) + '</td>';
                        html += '<td class="small text-muted">' + nis + ' / ' + nisn + '</td>';
                        html += '<td class="diknas-nama fw-semibold text-dark">' + s.nama + '</td>';
                        html += '<td class="text-center small text-secondary">' + jk + '</td>';
                        html += '<td class="text-center">';
                        html += '<select name="nilai[' + s.id_siswa + ']" class="form-select form-select-sm diknas-predikat-select">';
                        html += '<option value="SB"' + (curVal === 'SB' ? ' selected' : '') + '>Sangat Baik (SB)</option>';
                        html += '<option value="B"' + (curVal === 'B' ? ' selected' : '') + '>Baik (B)</option>';
                        html += '<option value="C"' + (curVal === 'C' ? ' selected' : '') + '>Cukup (C)</option>';
                        html += '<option value="K"' + (curVal === 'K' ? ' selected' : '') + '>Kurang (K)</option>';
                        html += '</select>';
                        html += '</td>';
                        html += '</tr>';
                    });

                    if (siswas.length === 0) {
                        html = '<tr><td colspan="5" class="text-center py-4 text-muted">Belum ada siswa dalam kelas ini.</td></tr>';
                    }

                    $('#tbodyModalNilaiDiknas').html(html);
                    $('#modalNilaiDiknas').modal('show');
                } else {
                    Swal.fire('Gagal', res.message || 'Gagal memuat nilai siswa', 'error');
                }
            },
            error: function () {
                Swal.fire('Error', 'Terjadi kesalahan sistem saat memuat siswa', 'error');
            }
        });
    }

    function terapkanPredikatRataDiknas() {
        var val = $('#selectPredikatRata').val();
        $('.diknas-predikat-select').val(val);
        Swal.fire({
            title: 'Diterapkan!',
            text: 'Semua siswa telah diatur ke predikat ' + val + '. Klik Simpan Perubahan untuk menyimpan.',
            icon: 'success',
            timer: 1500,
            showConfirmButton: false
        });
    }

    function modalBukaCatatanDiknas() {
        var idKegiatan = '<?= $diknas_kegiatan->id_kegiatan ?? '' ?>';
        if (!idKegiatan) {
            Swal.fire('Perhatian', 'Harap simpan pengaturan kegiatan terlebih dahulu', 'warning');
            return;
        }

        $('#confirmCatatanDiknas').prop('checked', false);

        Swal.fire({
            title: 'Memuat Narasi Rapor...',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        $.ajax({
            url: '<?= base_url('rapor/getdiknascatatan') ?>/' + idKegiatan,
            type: 'GET',
            dataType: 'json',
            success: function (res) {
                Swal.close();
                if (res.status) {
                    var siswas = res.siswas || [];
                    var catatanMap = res.catatan_map || {};
                    var html = '';

                    siswas.forEach(function (s, idx) {
                        var desc = catatanMap[s.id_siswa] || '';
                        var nis = s.nis || '-';
                        var nisn = s.nisn || '-';

                        html += '<tr>';
                        html += '<td class="text-center fw-bold text-secondary align-top pt-3">' + (idx + 1) + '</td>';
                        html += '<td class="small text-muted align-top pt-3">' + nis + ' / ' + nisn + '</td>';
                        html += '<td class="fw-bold small text-dark align-top pt-3">' + s.nama + '</td>';
                        html += '<td>';
                        html += '<textarea name="catatan[' + s.id_siswa + ']" rows="3" class="form-control form-control-sm" placeholder="Deskripsi capaian...">' + $('<div>').text(desc).html() + '</textarea>';
                        html += '</td>';
                        html += '</tr>';
                    });

                    if (siswas.length === 0) {
                        html = '<tr><td colspan="4" class="text-center py-4 text-muted">Belum ada siswa dalam kelas ini.</td></tr>';
                    }

                    $('#tbodyModalCatatanDiknas').html(html);
                    $('#modalCatatanDiknas').modal('show');
                } else {
                    Swal.fire('Gagal', res.message || 'Gagal memuat catatan narasi', 'error');
                }
            },
            error: function () {
                Swal.fire('Error', 'Terjadi kesalahan sistem saat memuat catatan', 'error');
            }
        });
    }
</script>
<?= $this->endSection() ?>
