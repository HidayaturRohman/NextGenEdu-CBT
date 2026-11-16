<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="d-flex align-items-center">
                        <div class="me-3 flex-shrink-0">
                            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #06b6d4 0%, #0e7490 100%); color: #ffffff;">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                    <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                                    <rect x="6" y="14" width="12" height="8"></rect>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                                <?= $judul ?>
                            </h4>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">Cetak dokumen administrasi ujian, kartu peserta, daftar hadir, dan berita acara pelaksanaan tes.</p>
                        </div>
                    </div>
                    <div>
                        <a type="button" href="<?= base_url('cbtcetak') ?>" class="btn btn-sm btn-primary shadow-sm rounded-pill text-white" data-bs-toggle="tooltip" title="Reload">
                            <i class="fa fa-sync me-1"></i> Reload
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card shadow-sm mb-4">
                    <div class="card-header pb-3">
                        <h5 class="card-title mb-0 fw-bold d-flex align-items-center">
                            <i class="fas fa-print text-primary me-2"></i> Cetak Dokumen Ujian
                        </h5>
                    </div>
                    <?php
                    $isAdmin = $is_admin;
                    if ($isAdmin || (isset($guru) && isset($ids_pengawas) && in_array($guru->id_guru, $ids_pengawas))) :
                    ?>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-lg-3 col-md-6">
                                <a href="<?= base_url('cbtcetak/kartupeserta') ?>" class="text-decoration-none text-body">
                                    <div class="card border h-100 shadow-sm hover-shadow transition">
                                        <div class="card-body d-flex align-items-center">
                                            <div class="p-3 bg-primary text-white rounded me-3 shadow-sm">
                                                <i class="far fa-id-card fa-2x"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">Kartu Peserta</h6>
                                                <small class="text-muted">Cetak kartu ujian siswa</small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="<?= base_url('cbtcetak/absenpeserta') ?>" class="text-decoration-none text-body">
                                    <div class="card border h-100 shadow-sm hover-shadow transition">
                                        <div class="card-body d-flex align-items-center">
                                            <div class="p-3 bg-primary text-white rounded me-3 shadow-sm">
                                                <i class="fas fa-list-ol fa-2x"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">Daftar Hadir</h6>
                                                <small class="text-muted">Cetak absen peserta ujian</small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="<?= base_url('cbtcetak/pengawas') ?>" class="text-decoration-none text-body">
                                    <div class="card border h-100 shadow-sm hover-shadow transition">
                                        <div class="card-body d-flex align-items-center">
                                            <div class="p-3 bg-primary text-white rounded me-3 shadow-sm">
                                                <i class="fas fa-list-ul fa-2x"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">Jadwal Pengawas</h6>
                                                <small class="text-muted">Cetak daftar pengawas</small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="<?= base_url('cbtcetak/pesertaujian') ?>" class="text-decoration-none text-body">
                                    <div class="card border h-100 shadow-sm hover-shadow transition">
                                        <div class="card-body d-flex align-items-center">
                                            <div class="p-3 bg-primary text-white rounded me-3 shadow-sm">
                                                <i class="fas fa-users fa-2x"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">Peserta Ujian</h6>
                                                <small class="text-muted">Daftar peserta per ruang/kelas</small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="<?= base_url('cbtcetak/beritaacara') ?>" class="text-decoration-none text-body">
                                    <div class="card border h-100 shadow-sm hover-shadow transition">
                                        <div class="card-body d-flex align-items-center">
                                            <div class="p-3 bg-primary text-white rounded me-3 shadow-sm">
                                                <i class="far fa-edit fa-2x"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">Berita Acara</h6>
                                                <small class="text-muted">Cetak berita acara ujian</small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <a href="<?= base_url('cbtcetak/susulan') ?>" class="text-decoration-none text-body">
                                    <div class="card border h-100 shadow-sm hover-shadow transition">
                                        <div class="card-body d-flex align-items-center">
                                            <div class="p-3 bg-primary text-white rounded me-3 shadow-sm">
                                                <i class="fas fa-clipboard-list fa-2x"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">Rekap Susulan</h6>
                                                <small class="text-muted">Legger siswa belum ujian</small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="card-body">
                        <div class="alert alert-warning mb-0" role="alert">
                            <h6 class="fw-bold"><i class="fas fa-exclamation-triangle me-2"></i> Akses Dibatasi</h6>
                            <p class="mb-0">Halaman CETAK hanya tersedia untuk Admin dan Guru yang terdaftar sebagai Pengawas Ujian saat jadwal ujian berlangsung.</p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>
</div>
<?= $this->endSection() ?>
