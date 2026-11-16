<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<?php
$current_mode = $current_mode ?? 'semua';
$setting_mode = $setting_mode ?? 'semua';
?>
<div class="d-contents">
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="me-3 flex-shrink-0">
                        <?php if ($current_mode === 'pts'): ?>
                        <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #ffffff;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                            </svg>
                        </div>
                        <?php elseif ($current_mode === 'sas'): ?>
                        <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: #ffffff;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                            </svg>
                        </div>
                        <?php else: ?>
                        <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #0891b2 0%, #0e7490 100%); color: #ffffff;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <h4 class="card-title mb-1 fw-bold d-flex align-items-center text-dark">
                            <?= esc($judul) ?>
                        </h4>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            <?php if ($current_mode === 'pts'): ?>
                                Input Nilai PTS (Tengah Semester) & Nilai Akhir (terisi otomatis dari hasil CBT PTS atau isi manual).
                            <?php elseif ($current_mode === 'sas'): ?>
                                Input Nilai Sumatif LM 1-4, Nilai SAS (terisi otomatis dari CBT), Nilai Akhir, dan Capaian Kompetensi.
                            <?php else: ?>
                                Pilih mode penilaian yang ingin diinput: Nilai PTS (Tengah Semester) atau Nilai SAS (Akhir Semester).
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <?php if ($setting_mode !== 'sas'): ?>
                    <a href="<?= base_url('rapor/cetakpts') ?>" class="btn btn-outline-warning text-dark shadow-sm rounded-pill">
                        <i class="fas fa-print me-1"></i> Cetak STS
                    </a>
                    <?php endif; ?>
                    <?php if ($setting_mode !== 'sts'): ?>
                    <a href="<?= base_url('rapor/cetakakhir') ?>" class="btn btn-primary shadow-sm rounded-pill">
                        <i class="fas fa-book me-1"></i> Cetak Rapor Akhir
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Mode Selector Tabs (jika admin membuka kedua mode) -->
    <?php if ($setting_mode === 'semua'): ?>
    <div class="d-flex align-items-center gap-2 mb-4 bg-white p-2 rounded-pill shadow-sm border" style="width: fit-content;">
        <a href="<?= base_url('rapor/rapornilai') ?>" class="btn btn-sm rounded-pill px-3 <?= $current_mode === 'semua' ? 'btn-primary shadow-sm fw-bold' : 'btn-light text-secondary' ?>">
            <i class="fas fa-layer-group me-1"></i> Semua Mode
        </a>
        <a href="<?= base_url('rapor/rapornilai/pts') ?>" class="btn btn-sm rounded-pill px-3 <?= $current_mode === 'pts' ? 'btn-warning text-dark shadow-sm fw-bold' : 'btn-light text-secondary' ?>">
            <i class="fas fa-pencil-alt text-warning me-1"></i> Mode Nilai PTS
        </a>
        <a href="<?= base_url('rapor/rapornilai/sas') ?>" class="btn btn-sm rounded-pill px-3 <?= $current_mode === 'sas' ? 'btn-success shadow-sm fw-bold' : 'btn-light text-secondary' ?>">
            <i class="fas fa-book-reader text-success me-1"></i> Mode Nilai SAS
        </a>
    </div>
    <?php endif; ?>

    <div class="row g-4">
        <?php if (empty($mapel)): ?>
            <div class="col-12">
                <div class="alert alert-warning p-4 rounded-3 shadow-sm" role="alert">
                    <h5 class="fw-bold mb-2"><i class="fas fa-exclamation-circle me-2"></i>Tidak ada Mata Pelajaran Diampu</h5>
                    <p class="mb-0">Akun Anda saat ini belum memiliki penugasan mata pelajaran atau kelas pada semester aktif. Silakan hubungi Administrator Madrasah.</p>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($mapel as $id_mapel => $nama_mapel): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm border-0 h-100 rounded-3 overflow-hidden">
                        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                            <h6 class="card-title mb-0 fw-bold text-dark text-truncate" title="<?= esc($nama_mapel) ?>">
                                <i class="fas fa-book-open text-primary me-2"></i><?= esc($nama_mapel) ?>
                            </h6>
                            <span class="badge bg-soft-primary text-primary rounded-pill">Fase D</span>
                        </div>
                        <div class="card-body p-3">
                            <div class="small fw-semibold text-secondary mb-2">Daftar Kelas Diampu:</div>
                            <?php if (!empty($kelas[$id_mapel])): ?>
                                <div class="list-group list-group-flush border rounded-2">
                                    <?php foreach ($kelas[$id_mapel] as $kls): ?>
                                        <div class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                                            <span class="fw-bold text-dark"><?= esc($kls['nama_kelas']) ?></span>
                                            <div class="d-flex gap-1">
                                                <?php if ($current_mode === 'pts' || ($current_mode === 'semua' && $setting_mode !== 'sas')): ?>
                                                <a href="<?= base_url('rapor/inputpts/' . $id_mapel . '/' . $kls['id_kelas']) ?>" class="btn btn-sm btn-outline-warning text-dark rounded-pill px-2 shadow-sm" title="Input Nilai PTS">
                                                    <i class="fas fa-pencil-alt me-1 text-warning"></i> Nilai PTS
                                                </a>
                                                <?php endif; ?>
                                                <?php if ($current_mode === 'sas' || ($current_mode === 'semua' && $setting_mode !== 'sts')): ?>
                                                <a href="<?= base_url('rapor/inputsas/' . $id_mapel . '/' . $kls['id_kelas']) ?>" class="btn btn-sm btn-primary rounded-pill px-2 shadow-sm" title="Input Nilai SAS">
                                                    <i class="fas fa-edit me-1"></i> Nilai SAS
                                                </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <p class="text-muted small mb-0">Belum ada pembagian kelas untuk mata pelajaran ini.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>
