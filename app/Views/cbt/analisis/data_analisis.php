<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<div class="d-contents">
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="me-3 flex-shrink-0">
                        <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%); color: #ffffff;">
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
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">Analisis tingkat kesukaran butir soal, daya pembeda, dan keandalan instrumen tes CBT.</p>
                    </div>
                </div>
                <div>
                    <button onclick="window.history.back()" type="button" class="btn btn-sm btn-danger shadow-sm">
                        <i class="fas fa-arrow-circle-left me-1"></i> Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.05);
        border-radius: 12px;
    }
    .filter-card {
        background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
        border-left: 4px solid #3a57e8;
    }
    .stat-box {
        border-radius: 12px;
        padding: 20px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 140px;
    }
    .stat-box:hover {
        transform: translateY(-5px);
    }
    .stat-box.bg-primary-grad { background: linear-gradient(135deg, #3a57e8, #1a3aba); }
    .stat-box.bg-success-grad { background: linear-gradient(135deg, #10b981, #047857); }
    .stat-box.bg-warning-grad { background: linear-gradient(135deg, #f59e0b, #d97706); }
    .stat-box.bg-danger-grad { background: linear-gradient(135deg, #ef4444, #b91c1c); }
    
    .stat-box i {
        position: absolute;
        right: 15px;
        bottom: 10px;
        font-size: 3rem;
        opacity: 0.2;
    }
    
    .stat-title {
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.9;
    }
    .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        margin: 4px 0;
        line-height: 1.2;
    }

    .alert-default-success {
        background-color: #e6f4ea !important;
        border: 1px solid #a7f3d0 !important;
        color: #15803d !important;
        border-radius: 6px;
    }
    .alert-default-danger {
        background-color: #fef2f2 !important;
        border: 1px solid #fecaca !important;
        color: #991b1b !important;
        border-radius: 6px;
    }
    .alert-default-warning {
        background-color: #fff8e6 !important;
        border: 1px solid #fde68a !important;
        color: #b45309 !important;
        border-radius: 6px;
    }
    .alert-default-info {
        background-color: #ebf3fe !important;
        border: 1px solid #c7dbfc !important;
        color: #1e40af !important;
        border-radius: 6px;
    }

    .table-analisis {
        width: 100% !important;
        border-collapse: collapse !important;
        table-layout: fixed !important;
    }

    .table-analisis th,
    .table-analisis td {
        overflow-wrap: break-word !important;
        word-wrap: break-word !important;
        word-break: break-word !important;
        white-space: normal !important;
        vertical-align: top !important;
        height: auto !important;
    }

    .table-analisis th {
        text-align: center !important;
        vertical-align: middle !important;
        padding: 6px 4px !important;
        font-weight: bold !important;
        background-color: #f2f4f5 !important;
        white-space: normal !important;
    }

    .table-analisis td.col-soal,
    .table-analisis td.col-soal p,
    .table-analisis td.col-soal div,
    .table-analisis td.col-soal span {
        text-align: justify !important;
        white-space: normal !important;
        overflow-wrap: break-word !important;
        word-break: break-word !important;
        margin-bottom: 4px !important;
    }

    .table-analisis td.col-opsi,
    .table-analisis td.col-opsi p,
    .table-analisis td.col-opsi div,
    .table-analisis td.col-opsi span {
        text-align: justify !important;
        white-space: normal !important;
        overflow-wrap: break-word !important;
        word-break: break-word !important;
        margin-bottom: 0 !important;
    }

    .table-analisis img {
        max-width: 100% !important;
        height: auto !important;
    }
</style>

<div class="container-fluid p-0">
    <!-- Filter Section -->
    <div class="card glass-card filter-card mb-4">
        <div class="card-body p-4">
            <form id="filterForm" action="<?= base_url('cbtanalisis') ?>" method="GET">
                <div class="row align-items-end g-3">
                    <div class="col-md-3">
                        <label class="form-label text-sm text-muted fw-bold mb-1">Tahun Pelajaran</label>
                        <select name="thn" id="tahun" class="form-select select2">
                            <?php foreach ($tp as $thn) :
                                $selected = $tp_selected == $thn->id_tp ? 'selected="selected"' : ''; ?>
                                <option value="<?= $thn->id_tp ?>" <?= $selected ?>><?= $thn->tahun ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label text-sm text-muted fw-bold mb-1">Semester</label>
                        <select name="smt" id="smt" class="form-select select2">
                            <?php foreach ($smt as $sm) :
                                $selected = $smt_selected == $sm->id_smt ? 'selected="selected"' : ''; ?>
                                <option value="<?= $sm->id_smt ?>" <?= $selected ?>><?= $sm->nama_smt ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-sm text-muted fw-bold mb-1">Jadwal Ujian</label>
                        <select name="jadwal" id="jadwal" class="form-select select2" required>
                            <option value="">-- Pilih Jadwal --</option>
                            <?php foreach ($kodejadwal as $id_j => $kode) :
                                $selected = $jadwal_selected == $id_j ? 'selected="selected"' : ''; ?>
                                <option value="<?= $id_j ?>" <?= $selected ?>><?= $kode ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary rounded-pill w-100 shadow-sm">
                            <i class="fas fa-sync-alt me-1"></i> Proses Analisis
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php if (isset($info) && isset($jadwal_selected)): ?>
    <!-- Summary Stats Boxes -->
    <div class="row g-3 mb-4 align-items-stretch">
        <div class="col-md-3 col-sm-6">
            <div class="stat-box bg-primary-grad h-100">
                <div>
                    <div class="stat-title">Total Peserta</div>
                    <div class="stat-value"><?= $siswa ?? 0 ?></div>
                </div>
                <div class="text-sm opacity-75">Siswa ikuti ujian</div>
                <i class="fas fa-users"></i>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stat-box bg-success-grad h-100">
                <div>
                    <div class="stat-title">Mata Pelajaran</div>
                    <div class="stat-value text-truncate" style="font-size: 1.3rem;" title="<?= esc($info->nama_mapel ?? '-') ?>"><?= $info->nama_mapel ?? '-' ?></div>
                </div>
                <div class="text-sm opacity-75 text-truncate">Kode: <?= $info->bank_kode ?></div>
                <i class="fas fa-book"></i>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stat-box bg-warning-grad h-100">
                <div>
                    <div class="stat-title">Reliabilitas (KR-20)</div>
                    <div class="stat-value"><?= $analisis['reliabilitas']['kr20'] ?? '0.00' ?></div>
                </div>
                <div class="text-sm opacity-75 text-truncate" title="<?= esc($analisis['reliabilitas']['ket'] ?? 'Sangat Baik') ?>"><?= $analisis['reliabilitas']['ket'] ?? 'Sangat Baik' ?></div>
                <i class="fas fa-check-double"></i>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stat-box bg-danger-grad h-100">
                <div>
                    <div class="stat-title">Jumlah Soal</div>
                    <div class="stat-value"><?= $info->tampil_pg ?? 0 ?></div>
                </div>
                <div class="text-sm opacity-75">Tipe Soal Pilihan Ganda</div>
                <i class="fas fa-list-ol"></i>
            </div>
        </div>
    </div>

    <?php
    $totSoal = count($soal_pg ?? []);
    $totDiterima = 0;
    $totRevisi = 0;
    $totDitolak = 0;

    foreach ($soal_pg ?? [] as $s) {
        $an = $analisis[$s->id_soal] ?? null;
        if ($an) {
            $dp = (float)($an['daya_pembeda'] ?? 0);
            $tk = (float)($an['tingkat_kesulitan'] ?? 0);
            $val = ($an['level_validitas'] ?? '');
            if ($dp < 0.00 || ($dp < 0.20 && $val != 'Valid')) {
                $totDitolak++;
            } elseif ($dp < 0.30 || $tk < 0.20 || $tk > 0.85 || $val != 'Valid') {
                $totRevisi++;
            } else {
                $totDiterima++;
            }
        } else {
            $totDiterima++;
        }
    }
    ?>

    <!-- Executive Quality Summary -->
    <div class="card glass-card shadow-sm mb-4 p-3 border-0" style="background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <h6 class="fw-bold mb-0 text-dark d-flex align-items-center">
                <i class="fas fa-microscope text-primary me-2"></i> Diagnosis & Rekomendasi Kelayakan Butir Soal
            </h6>
            <span class="badge bg-light text-muted border">Total: <?= $totSoal ?> Butir Soal PG</span>
        </div>
        <div class="row g-2">
            <div class="col-md-4">
                <div class="p-3 rounded-3 border d-flex align-items-center justify-content-between" style="background-color: #f0fdf4; border-color: #bbf7d0 !important;">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-3" style="width: 42px; height: 42px; font-size: 1.2rem;">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <div class="fw-bold text-success" style="font-size: 0.95rem;">Diterima (Kualitas Baik)</div>
                            <small class="text-muted">Daya pembeda & kesukaran ideal</small>
                        </div>
                    </div>
                    <div class="text-end">
                        <span class="fs-4 fw-bold text-success"><?= $totDiterima ?></span>
                        <small class="text-muted d-block"><?= $totSoal > 0 ? round(($totDiterima / $totSoal) * 100) : 0 ?>%</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 rounded-3 border d-flex align-items-center justify-content-between" style="background-color: #fffbeb; border-color: #fde68a !important;">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-warning text-dark d-flex align-items-center justify-content-center me-3" style="width: 42px; height: 42px; font-size: 1.2rem;">
                            <i class="fas fa-tools"></i>
                        </div>
                        <div>
                            <div class="fw-bold text-dark" style="font-size: 0.95rem;">Perlu Revisi</div>
                            <small class="text-muted">Perbaiki pengecoh / redaksi</small>
                        </div>
                    </div>
                    <div class="text-end">
                        <span class="fs-4 fw-bold text-warning"><?= $totRevisi ?></span>
                        <small class="text-muted d-block"><?= $totSoal > 0 ? round(($totRevisi / $totSoal) * 100) : 0 ?>%</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 rounded-3 border d-flex align-items-center justify-content-between" style="background-color: #fef2f2; border-color: #fecaca !important;">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center me-3" style="width: 42px; height: 42px; font-size: 1.2rem;">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div>
                            <div class="fw-bold text-danger" style="font-size: 0.95rem;">Ditolak / Kunci Tertukar</div>
                            <small class="text-muted">Pembeda negatif / tidak valid</small>
                        </div>
                    </div>
                    <div class="text-end">
                        <span class="fs-4 fw-bold text-danger"><?= $totDitolak ?></span>
                        <small class="text-muted d-block"><?= $totSoal > 0 ? round(($totDitolak / $totSoal) * 100) : 0 ?>%</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card glass-card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
            <h5 class="card-title mb-0 fw-bold d-flex align-items-center text-dark">
                <i class="fas fa-chart-pie text-primary me-2"></i> Analisis Butir Soal
            </h5>
            <div class="d-flex gap-2">
                <button onclick="window.history.back()" type="button" class="btn btn-danger btn-sm rounded-pill shadow-sm">
                    <i class="fas fa-arrow-circle-left me-1"></i> Kembali
                </button>
                <button type="button" id="download-word" class="btn btn-primary btn-sm rounded-pill shadow-sm" data-bs-toggle="tooltip" title="Download Word">
                    <i class="fa fa-file-word me-1"></i> Ekspor ke Word
                </button>
            </div>
        </div>
        
        <div class="card-body p-4" id="print-word">
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <table class="table table-bordered table-sm m-0" style="font-size: 0.9rem;">
                        <tr>
                            <td style="min-width: 140px;" class="bg-light fw-bold">Soal</td>
                            <td><b><?= $info->bank_kode ?></b></td>
                        </tr>
                        <tr>
                            <td class="bg-light fw-bold">Mata Pelajaran</td>
                            <td><b><?= $info->nama_mapel ?? '-' ?></b></td>
                        </tr>
                        <tr>
                            <td class="bg-light fw-bold">Guru Pengampu</td>
                            <td><b><?= $info->nama_guru ?? '-' ?></b></td>
                        </tr>
                        <tr>
                            <td class="bg-light fw-bold">Jumlah Soal</td>
                            <td>
                                PG: <b><?= $info->tampil_pg ?? 0 ?></b>, 
                                PGKompleks: <b><?= $info->tampil_kompleks ?? 0 ?></b>, 
                                Menjodohkan: <b><?= $info->tampil_jodohkan ?? 0 ?></b>, 
                                IsianSingkat: <b><?= $info->tampil_isian ?? 0 ?></b>, 
                                Uraian: <b><?= $info->tampil_esai ?? 0 ?></b>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered table-sm m-0" style="font-size: 0.9rem;">
                        <tr>
                            <td style="min-width: 140px;" class="bg-light fw-bold">Jenis Penilaian</td>
                            <td><b><?= $info->kode_jenis ?? '-' ?></b></td>
                        </tr>
                        <tr>
                            <td class="bg-light fw-bold">Kelas</td>
                            <td><b><?= $kelas ?? '-' ?></b></td>
                        </tr>
                        <tr>
                            <td class="bg-light fw-bold">Jumlah Siswa</td>
                            <td><b><?= $siswa ?? 0 ?></b></td>
                        </tr>
                        <tr>
                            <td class="bg-light fw-bold">Waktu Pelaksanaan</td>
                            <td>
                                <b><?= isset($info->tgl_mulai) ? date('d M Y', strtotime($info->tgl_mulai)) : '-' ?></b>
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-light fw-bold">TP / SMT</td>
                            <td>
                                <b><?= $tp_active->tahun ?></b> smt: <b><?= $smt_active->smt ?></b>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <?php if (!empty($soal_pg)) : ?>
            <p class="mt-4 fw-bold">1. Soal Pilihan Ganda</p>
            <div class="table-responsive">
                <table class="w-100 table-analisis" style="font-size: 0.88rem; border-collapse: collapse; table-layout: fixed;">
                    <colgroup>
                        <col style="width: 35px;">
                        <col style="width: 28%;">
                        <col style="width: 25px;">
                        <col style="width: 20%;">
                        <col style="width: 75px;">
                        <col style="width: 115px;">
                        <col style="width: 135px;">
                        <col style="width: 130px;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th style="border: 1px solid black; border-collapse: collapse; text-align: center; background-color: #f2f4f5; padding: 6px;">NO.</th>
                            <th style="border: 1px solid black; border-collapse: collapse; text-align: center; background-color: #f2f4f5; padding: 6px;">SOAL</th>
                            <th style="border: 1px solid black; border-collapse: collapse; text-align: center; background-color: #f2f4f5; padding: 6px;" colspan="2">OPSI</th>
                            <th style="border: 1px solid black; border-collapse: collapse; text-align: center; background-color: #f2f4f5; padding: 6px;">JAWABAN<br />SISWA</th>
                            <th style="border: 1px solid black; border-collapse: collapse; text-align: center; background-color: #f2f4f5; padding: 6px;">Indeks Kesukaran Distraktor</th>
                            <th style="border: 1px solid black; border-collapse: collapse; text-align: center; background-color: #f2f4f5; padding: 6px;">ANALISA</th>
                            <th style="border: 1px solid black; border-collapse: collapse; text-align: center; background-color: #f2f4f5; padding: 6px;">RELIABILITAS</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    $jml_opsi = (int)($info->opsi ?? 5);
                    $opsis = ['a', 'b', 'c', 'd', 'e'];

                    foreach ($soal_pg as $soal) :
                        $idSoal = $soal->id_soal;
                        $jawaban_siswa = $jawab_siswa[$idSoal] ?? null;
                        $analisa = $analisis[$idSoal] ?? null;

                        for ($i = 0; $i < $jml_opsi; $i++) :
                            $opChar = strtoupper($opsis[$i]);
                            $isKunci = (strtoupper($soal->jawaban ?? '') == $opChar);
                            $bgClass = $isKunci ? 'table-success' : 'table-danger';
                            ?>
                            <tr>
                                <?php if ($i === 0) : ?>
                                    <td rowspan="<?= $jml_opsi ?>" style="border: 1px solid black; border-collapse: collapse; vertical-align: top; padding: 6px; text-align: center; font-weight: bold;">
                                        <?= $no ?>
                                    </td>
                                    <td rowspan="<?= $jml_opsi ?>" class="col-soal" style="border: 1px solid black; border-collapse: collapse; vertical-align: top; padding: 6px;">
                                        <div><?= $soal->soal ?></div>
                                        <p class="mb-0 mt-2 text-start">JAWABAN: <b><?= strtoupper($soal->jawaban ?? '') ?></b></p>
                                    </td>
                                <?php endif; ?>

                                <td class="<?= $bgClass ?>" style="border: 1px solid black; border-collapse: collapse; border-right: 0; vertical-align: top; padding: 6px; font-weight: bold; width: 25px; text-align: center;">
                                    <?= $opChar ?>.
                                </td>
                                <td class="<?= $bgClass ?> col-opsi" style="border: 1px solid black; border-collapse: collapse; border-left: 0; vertical-align: top; padding: 6px;">
                                    <?= $soal->{'opsi_' . $opsis[$i]} ?? '' ?>
                                </td>
                                <td class="<?= $bgClass ?>" style="border: 1px solid black; border-collapse: collapse; vertical-align: top; padding: 6px; text-align: center; white-space: nowrap;">
                                    <?= isset($jawaban_siswa['jawab_' . $opsis[$i]]) ? count($jawaban_siswa['jawab_' . $opsis[$i]]) : 0 ?> siswa
                                </td>
                                <td style="border: 1px solid black; border-collapse: collapse; vertical-align: top; padding: 6px; white-space: nowrap;">
                                    <?php if ($analisa && isset($analisa['distraktor'][$opChar])) :
                                        $dis = $analisa['distraktor'][$opChar]; ?>
                                        <span>Atas: <b><?= $dis['IKD_top'] ?></b></span><br/>
                                        <span>Bawah: <b><?= $dis['IKD_bottom'] ?></b></span><br/>
                                        <span>Total: <b><?= $dis['IKD_total'] ?></b></span>
                                    <?php endif; ?>
                                </td>

                                <?php if ($i === 0) : ?>
                                    <td rowspan="<?= $jml_opsi ?>" style="border: 1px solid black; border-collapse: collapse; vertical-align: top; padding: 6px;">
                                        <?php if ($analisa) :
                                            $dp = (float)($analisa['daya_pembeda'] ?? 0);
                                            $tk = (float)($analisa['tingkat_kesulitan'] ?? 0);
                                            $val = ($analisa['level_validitas'] ?? '');

                                            if ($dp < 0.00 || ($dp < 0.20 && $val != 'Valid')) {
                                                $statusTag = 'Ditolak / Cek Kunci';
                                                $statusBadge = 'bg-danger text-white';
                                            } elseif ($dp < 0.30 || $tk < 0.20 || $tk > 0.85 || $val != 'Valid') {
                                                $statusTag = 'Perlu Revisi';
                                                $statusBadge = 'bg-warning text-dark';
                                            } else {
                                                $statusTag = 'Diterima (Baik)';
                                                $statusBadge = 'bg-success text-white';
                                            }

                                            $w_kesukaran = ($analisa['tingkat_kesulitan'] >= 0.70) ? 'alert-default-success' : (($analisa['tingkat_kesulitan'] < 0.30) ? 'alert-default-danger' : 'alert-default-warning');
                                            $w_valid = ($analisa['level_validitas'] == 'Valid') ? 'alert-default-success' : 'alert-default-danger';
                                            $w_daya = ($analisa['daya_pembeda'] >= 0.40) ? 'alert-default-success' : (($analisa['daya_pembeda'] >= 0.20) ? 'alert-default-warning' : 'alert-default-danger');

                                            $payload = [
                                                'id_soal' => $idSoal,
                                                'nomor' => $no,
                                                'soal' => $soal->soal,
                                                'opsi_a' => $soal->opsi_a ?? '',
                                                'opsi_b' => $soal->opsi_b ?? '',
                                                'opsi_c' => $soal->opsi_c ?? '',
                                                'opsi_d' => $soal->opsi_d ?? '',
                                                'opsi_e' => $soal->opsi_e ?? '',
                                                'jawaban' => strtoupper($soal->jawaban ?? ''),
                                                'status_tag' => $statusTag,
                                                'status_badge' => $statusBadge,
                                                'kesukaran' => ($analisa['tingkat_kesulitan'] ?? 0) . ' (' . ($analisa['level_kesulitan'] ?? '-') . ')',
                                                'validitas' => round($analisa['validitas'] ?? 0, 2) . ' (' . ($analisa['level_validitas'] ?? '-') . ')',
                                                'pembeda' => round($analisa['daya_pembeda'] ?? 0, 2) . ' (' . ($analisa['level_pembeda'] ?? '-') . ')',
                                                'mapel' => $info->nama_mapel ?? '',
                                                'jadwal' => $jadwal_selected,
                                                'stats_pemilih' => [
                                                    'A' => isset($jawaban_siswa['jawab_a']) ? count($jawaban_siswa['jawab_a']) : 0,
                                                    'B' => isset($jawaban_siswa['jawab_b']) ? count($jawaban_siswa['jawab_b']) : 0,
                                                    'C' => isset($jawaban_siswa['jawab_c']) ? count($jawaban_siswa['jawab_c']) : 0,
                                                    'D' => isset($jawaban_siswa['jawab_d']) ? count($jawaban_siswa['jawab_d']) : 0,
                                                    'E' => isset($jawaban_siswa['jawab_e']) ? count($jawaban_siswa['jawab_e']) : 0,
                                                ]
                                            ];
                                            $jsonPayload = htmlspecialchars(json_encode($payload, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP), ENT_QUOTES, 'UTF-8');
                                        ?>
                                            <div class="mb-2 text-center">
                                                <span class="badge <?= $statusBadge ?> px-2 py-1 w-100" style="font-size: 0.74rem;">
                                                    <?= $statusTag ?>
                                                </span>
                                            </div>
                                            <p class="alert <?= $w_kesukaran ?> p-1 mb-1 text-center" style="font-size: 0.8rem;">
                                                Kesukaran:<br>
                                                <b><?= $analisa['tingkat_kesulitan'] ?></b> <?= $analisa['level_kesulitan'] ?>
                                            </p>
                                            <p class="alert <?= $w_valid ?> p-1 mb-1 text-center" style="font-size: 0.8rem;">
                                                Validasi:<br>
                                                <b><?= round($analisa['validitas'], 2) ?></b> <?= $analisa['level_validitas'] ?>
                                            </p>
                                            <p class="alert <?= $w_daya ?> p-1 mb-2 text-center" style="font-size: 0.8rem;">
                                                Pembeda:<br>
                                                <b><?= round($analisa['daya_pembeda'], 2) ?></b> <?= $analisa['level_pembeda'] ?>
                                            </p>
                                            <button type="button" class="btn btn-sm btn-primary w-100 shadow-sm py-1 btn-revisi-modal d-print-none" data-json='<?= $jsonPayload ?>' style="font-size: 0.76rem;">
                                                <i class="fas fa-edit me-1"></i> Perbaiki Soal
                                            </button>
                                        <?php endif; ?>
                                    </td>

                                    <?php if ($no === 1) : ?>
                                        <td rowspan="<?= $jml_opsi * count($soal_pg) ?>" style="border: 1px solid black; border-collapse: collapse; vertical-align: top; padding: 6px;">
                                            <?php if (isset($analisis['reliabilitas'])) : ?>
                                                <p class="alert alert-default-info p-1 mb-2">
                                                    Alpha Cronbach: <b><?= $analisis['reliabilitas']['alpha_cronbach'] ?></b>
                                                </p>
                                                <p class="alert alert-default-success p-1 mb-2">
                                                    KR 20: <b><?= $analisis['reliabilitas']['kr20'] ?></b>
                                                </p>
                                                <p class="small mb-0">
                                                    <?= $analisis['reliabilitas']['ket'] ?>
                                                </p>
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </tr>
                        <?php endfor; $no++; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="overlay d-none position-absolute w-100 h-100 top-0 start-0 d-flex justify-content-center align-items-center bg-white bg-opacity-75" id="loading" style="z-index: 10;">
            <div class="spinner-grow text-primary"></div>
        </div>
    </div>
    
    <?php else: ?>
    <!-- State when no schedule selected -->
    <div class="card shadow-sm text-center py-5">
        <div class="card-body">
            <i class="fas fa-chart-pie fa-3x text-muted mb-3 opacity-50"></i>
            <h5 class="fw-bold text-dark mb-1">Pilih Jadwal Ujian</h5>
            <p class="text-muted">Silakan pilih Tahun Pelajaran, Semester, dan Jadwal Ujian di atas untuk melihat analisis butir soal.</p>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Modal Revisi Soal & AI Assistant -->
<div class="modal fade" id="modalRevisiSoal" tabindex="-1" aria-labelledby="modalRevisiSoalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white py-3">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center me-2 shadow-sm" style="width: 34px; height: 34px;">
                        <i class="fas fa-edit"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold text-white mb-0" id="modalRevisiSoalLabel">Revisi & Analisis Soal No. <span id="rev-nomor">1</span></h5>
                        <small class="text-white-50">Perbaiki redaksi, opsi pengecoh, dan kunci jawaban langsung di Bank Soal</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <!-- Info Status Soal -->
                <div class="card mb-3 border-0 bg-light">
                    <div class="card-body p-3">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-2">
                            <div class="d-flex align-items-center gap-2">
                                <span class="fw-bold text-dark">Status Butir:</span>
                                <span id="rev-status-badge" class="badge bg-danger">Ditolak / Cek Kunci</span>
                            </div>
                            <div class="d-flex gap-2">
                                <span class="badge bg-white text-dark border">Kunci Sekarang: <b id="rev-kunci-curr" class="text-primary">-</b></span>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap gap-2 mb-2" style="font-size: 0.85rem;">
                            <span class="badge bg-white text-secondary border">Kesukaran: <b id="rev-kesukaran" class="text-dark">-</b></span>
                            <span class="badge bg-white text-secondary border">Validitas: <b id="rev-validitas" class="text-dark">-</b></span>
                            <span class="badge bg-white text-secondary border">Daya Pembeda: <b id="rev-pembeda" class="text-dark">-</b></span>
                        </div>
                        <div class="d-flex align-items-center gap-2 p-2 rounded bg-white border" style="font-size: 0.82rem;">
                            <span class="text-muted fw-bold"><i class="fas fa-users me-1"></i>Distribusi Pemilih Siswa:</span>
                            <span class="badge bg-light text-dark border" id="chip-pemilih-a">A: 0</span>
                            <span class="badge bg-light text-dark border" id="chip-pemilih-b">B: 0</span>
                            <span class="badge bg-light text-dark border" id="chip-pemilih-c">C: 0</span>
                            <span class="badge bg-light text-dark border" id="chip-pemilih-d">D: 0</span>
                            <span class="badge bg-light text-dark border" id="chip-pemilih-e">E: 0</span>
                        </div>
                    </div>
                </div>

                <!-- Info Petunjuk Status & AI -->
                <div class="alert alert-info py-2 px-3 mb-3 border-0 rounded-3 d-flex align-items-start gap-2" style="font-size: 0.82rem; background: #e0f2fe; color: #0369a1;">
                    <i class="fas fa-info-circle fs-5 mt-1 text-primary"></i>
                    <div>
                        <b>Petunjuk Status & AI:</b> Status "Ditolak / Cek Kunci" adalah hasil kalkulasi psikometri dari lembar jawaban siswa pada ujian kemarin (Daya Pembeda / Pengecoh).
                        <ul class="mb-0 ps-3 mt-1">
                            <li>Jika <b>Kunci Jawaban Salah / Tertukar:</b> Ganti kunci di bawah & aktifkan <i>Hitung Ulang</i>, maka status langsung berubah jadi <b>Diterima</b>.</li>
                            <li>Jika <b>Kunci Sudah Benar:</b> Siswa kemarin terkecoh oleh pengecoh/redaksi. Saran revisi AI disimpan ke <b>Bank Soal</b> untuk menyempurnakan ujian berikutnya.</li>
                        </ul>
                    </div>
                </div>

                <!-- Tombol Trigger Gemini AI Assistant -->
                <div class="mb-3">
                    <button type="button" class="btn btn-warning w-100 fw-bold py-2 shadow-sm d-flex align-items-center justify-content-center" id="btn-minta-saran-ai">
                        <i class="fas fa-magic me-2"></i> Minta Analisis & Solusi Gemini AI
                    </button>
                </div>

                <!-- Box Hasil Gemini AI (Hidden by default) -->
                <div id="box-saran-ai" class="card mb-4 border-primary shadow-sm d-none" style="background: linear-gradient(135deg, #f0fdf4 0%, #eff6ff 100%);">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="fw-bold text-primary d-flex align-items-center">
                                <i class="fas fa-robot me-2 fs-5"></i> Diagnosa & Solusi AI
                            </div>
                            <span class="badge bg-success" id="badge-ai-kunci">Rekomendasi Kunci: B</span>
                        </div>
                        <div class="p-2 rounded bg-white border mb-2" style="font-size: 0.88rem;">
                            <div class="fw-bold text-dark mb-1"><i class="fas fa-stethoscope text-danger me-1"></i> Diagnosa Masalah:</div>
                            <div id="ai-diagnosa-text" class="text-secondary mb-2">...</div>
                            <div class="fw-bold text-dark mb-1"><i class="fas fa-key text-warning me-1"></i> Alasan Kunci:</div>
                            <div id="ai-alasan-text" class="text-secondary">...</div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-sm btn-success fw-bold shadow-sm" id="btn-terapkan-ai">
                                <i class="fas fa-check-double me-1"></i> Terapkan Saran AI ke Form Bawah
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Form Edit Soal -->
                <form id="formRevisiSoal">
                    <input type="hidden" name="id_soal" id="form-id-soal">
                    <input type="hidden" name="jadwal_id" id="form-jadwal-id">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark">Teks Soal</label>
                        <textarea class="form-control" name="soal" id="form-soal-text" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark mb-1">Pilihan Jawaban (Opsi A - E)</label>
                        <div class="row g-2">
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-text fw-bold bg-light" style="width: 40px; justify-content: center;">A</span>
                                    <input type="text" class="form-control" name="opsi_a" id="form-opsi-a" placeholder="Teks Opsi A">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-text fw-bold bg-light" style="width: 40px; justify-content: center;">B</span>
                                    <input type="text" class="form-control" name="opsi_b" id="form-opsi-b" placeholder="Teks Opsi B">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-text fw-bold bg-light" style="width: 40px; justify-content: center;">C</span>
                                    <input type="text" class="form-control" name="opsi_c" id="form-opsi-c" placeholder="Teks Opsi C">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-text fw-bold bg-light" style="width: 40px; justify-content: center;">D</span>
                                    <input type="text" class="form-control" name="opsi_d" id="form-opsi-d" placeholder="Teks Opsi D">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-text fw-bold bg-light" style="width: 40px; justify-content: center;">E</span>
                                    <input type="text" class="form-control" name="opsi_e" id="form-opsi-e" placeholder="Teks Opsi E">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 p-3 rounded-3 bg-light border">
                        <label class="form-label fw-bold text-dark d-block mb-2">Kunci Jawaban Benar:</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jawaban" id="radioKunciA" value="A">
                                <label class="form-check-label fw-bold" for="radioKunciA">A</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jawaban" id="radioKunciB" value="B">
                                <label class="form-check-label fw-bold" for="radioKunciB">B</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jawaban" id="radioKunciC" value="C">
                                <label class="form-check-label fw-bold" for="radioKunciC">C</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jawaban" id="radioKunciD" value="D">
                                <label class="form-check-label fw-bold" for="radioKunciD">D</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jawaban" id="radioKunciE" value="E">
                                <label class="form-check-label fw-bold" for="radioKunciE">E</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-check form-switch p-3 rounded-3 bg-warning-subtle border border-warning mb-2">
                        <input class="form-check-input ms-0 me-2" type="checkbox" role="switch" id="checkHitungUlang" name="hitung_ulang" value="1" checked>
                        <label class="form-check-label fw-bold text-dark" for="checkHitungUlang">
                            Hitung Ulang Nilai Seluruh Siswa Otomatis
                        </label>
                        <small class="d-block text-muted mt-1">
                            Jika kunci jawaban diubah atau diperbaiki, sistem akan otomatis mengoreksi riwayat ujian siswa pada jadwal ini dan memperbarui nilai CBT secara instan.
                        </small>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light py-2">
                <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm" id="btn-submit-revisi">
                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript" src="<?= base_url() ?>/assets/app/js/FileSaver.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/app/js/html-docx.js"></script>
<script src="<?= base_url() ?>/assets/app/js/convert-area.js"></script>
<script>
    $(document).ready(function () {
        ajaxcsrf();
        $('.select2').select2({ width: '100%' });

        var opsiThn = $("#tahun");
        var opsiSmt = $("#smt");
        var opsiJadwal = $("#jadwal");

        function loadJadwalTahun(thn, smt) {
            window.location.href = base_url + "cbtanalisis?thn=" + thn + "&smt=" + smt;
        }

        opsiSmt.change(function () {
            loadJadwalTahun(opsiThn.val(), $(this).val());
        });

        opsiThn.change(function () {
            loadJadwalTahun($(this).val(), opsiSmt.val());
        });

        $('table tbody tr img').each(function () {
            var curSrc = $(this).attr('src');
            if (curSrc && curSrc.indexOf("http") === -1 && curSrc.indexOf("data:image") === -1) {
                $(this).attr('src', base_url + curSrc);
            } else if (curSrc && curSrc.indexOf(base_url) === -1) {
                var pathUpload = 'uploads';
                var forReplace = curSrc.split(pathUpload);
                if (forReplace.length > 1) {
                    $(this).attr('src', base_url + pathUpload + forReplace[1]);
                }
            }
            $(this).css('max-width', '400px');
        });

        // Modal Revisi Soal
        var modalRevisi = null;
        window.currentSoalPayload = null;
        window.currentAiSuggestion = null;

        $(document).on('click', '.btn-revisi-modal', function() {
            var rawData = $(this).attr('data-json');
            if (!rawData) return;
            var payload = JSON.parse(rawData);
            window.currentSoalPayload = payload;
            window.currentAiSuggestion = null;

            $('#rev-nomor').text(payload.nomor);
            $('#rev-status-badge')
                .attr('class', 'badge ' + payload.status_badge)
                .text(payload.status_tag);
            $('#rev-kunci-curr').text(payload.jawaban);
            $('#rev-kesukaran').text(payload.kesukaran);
            $('#rev-validitas').text(payload.validitas);
            $('#rev-pembeda').text(payload.pembeda);

            // Distribution
            var pPem = payload.stats_pemilih || {};
            $('#chip-pemilih-a').text('A: ' + (pPem.A || 0) + ' siswa');
            $('#chip-pemilih-b').text('B: ' + (pPem.B || 0) + ' siswa');
            $('#chip-pemilih-c').text('C: ' + (pPem.C || 0) + ' siswa');
            $('#chip-pemilih-d').text('D: ' + (pPem.D || 0) + ' siswa');
            $('#chip-pemilih-e').text('E: ' + (pPem.E || 0) + ' siswa');

            // Populate form
            $('#form-id-soal').val(payload.id_soal);
            $('#form-jadwal-id').val(payload.jadwal);
            $('#form-soal-text').val(payload.soal);
            $('#form-opsi-a').val(payload.opsi_a || '');
            $('#form-opsi-b').val(payload.opsi_b || '');
            $('#form-opsi-c').val(payload.opsi_c || '');
            $('#form-opsi-d').val(payload.opsi_d || '');
            $('#form-opsi-e').val(payload.opsi_e || '');

            // Radio key
            $('input[name="jawaban"]').prop('checked', false);
            if (payload.jawaban) {
                $('input[name="jawaban"][value="' + payload.jawaban + '"]').prop('checked', true);
            }

            // Reset AI box
            $('#box-saran-ai').addClass('d-none');
            $('#btn-minta-saran-ai').html('<i class="fas fa-magic me-2"></i> Minta Analisis & Solusi Gemini AI').prop('disabled', false);

            if (!modalRevisi) {
                modalRevisi = new bootstrap.Modal(document.getElementById('modalRevisiSoal'));
            }
            modalRevisi.show();
        });

        // Minta Saran AI
        $('#btn-minta-saran-ai').on('click', function() {
            var p = window.currentSoalPayload;
            if (!p) return;

            var pPem = p.stats_pemilih || {};
            var statsStr = "A: " + (pPem.A || 0) + ", B: " + (pPem.B || 0) + ", C: " + (pPem.C || 0) + ", D: " + (pPem.D || 0) + ", E: " + (pPem.E || 0);

            var $btn = $(this);
            $btn.html('<i class="fas fa-spinner fa-spin me-2"></i> Gemini AI sedang menganalisis...').prop('disabled', true);

            $.ajax({
                url: base_url + 'cbtanalisis/saranai',
                type: 'POST',
                data: {
                    id_soal: p.id_soal,
                    soal: $('#form-soal-text').val(),
                    opsi_a: $('#form-opsi-a').val(),
                    opsi_b: $('#form-opsi-b').val(),
                    opsi_c: $('#form-opsi-c').val(),
                    opsi_d: $('#form-opsi-d').val(),
                    opsi_e: $('#form-opsi-e').val(),
                    kunci: $('input[name="jawaban"]:checked').val() || p.jawaban,
                    kesukaran: p.kesukaran,
                    pembeda: p.pembeda,
                    validitas: p.validitas,
                    stats: statsStr,
                    mapel: p.mapel
                },
                dataType: 'json',
                success: function(res) {
                    $btn.html('<i class="fas fa-magic me-2"></i> Minta Analisis & Solusi Gemini AI').prop('disabled', false);
                    if (res && res.status && res.data) {
                        var d = res.data;
                        window.currentAiSuggestion = d;
                        $('#badge-ai-kunci').text('Rekomendasi Kunci: ' + (d.rekomendasi_kunci || '-'));
                        $('#ai-diagnosa-text').html(d.diagnosa || '-');
                        $('#ai-alasan-text').html(d.alasan_kunci || '-');
                        $('#box-saran-ai').removeClass('d-none');
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Pemberitahuan',
                            text: res.message || 'Tidak dapat memproses saran AI.'
                        });
                    }
                },
                error: function() {
                    $btn.html('<i class="fas fa-magic me-2"></i> Minta Analisis & Solusi Gemini AI').prop('disabled', false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kendala saat menghubungi server.'
                    });
                }
            });
        });

        // Terapkan Saran AI
        $('#btn-terapkan-ai').on('click', function() {
            var d = window.currentAiSuggestion;
            if (!d) return;

            if (d.rekomendasi_kunci) {
                var rekKey = d.rekomendasi_kunci.toUpperCase().trim();
                $('input[name="jawaban"][value="' + rekKey + '"]').prop('checked', true);
            }
            if (d.soal_revisi && d.soal_revisi.trim() !== '') {
                $('#form-soal-text').val(d.soal_revisi);
            }
            if (d.opsi_a) $('#form-opsi-a').val(d.opsi_a);
            if (d.opsi_b) $('#form-opsi-b').val(d.opsi_b);
            if (d.opsi_c) $('#form-opsi-c').val(d.opsi_c);
            if (d.opsi_d) $('#form-opsi-d').val(d.opsi_d);
            if (d.opsi_e) $('#form-opsi-e').val(d.opsi_e);

            Swal.fire({
                icon: 'success',
                title: 'Diterapkan!',
                text: 'Saran perbaikan dan rekomendasi kunci berhasil dimasukkan ke formulir di bawah.',
                timer: 2000,
                showConfirmButton: false
            });
        });

        // Submit Simpan Perubahan
        $('#btn-submit-revisi').on('click', function() {
            var soalVal = $('#form-soal-text').val().trim();
            var kunciVal = $('input[name="jawaban"]:checked').val();

            if (!soalVal) {
                Swal.fire({icon: 'warning', title: 'Perhatian', text: 'Teks butir soal tidak boleh kosong.'});
                return;
            }
            if (!kunciVal) {
                Swal.fire({icon: 'warning', title: 'Perhatian', text: 'Silakan pilih salah satu Kunci Jawaban Benar.'});
                return;
            }

            var $btn = $(this);
            $btn.html('<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan & Mengkalkulasi...').prop('disabled', true);

            var postData = $('#formRevisiSoal').serialize();

            $.ajax({
                url: base_url + 'cbtanalisis/updatesoal',
                type: 'POST',
                data: postData,
                dataType: 'json',
                success: function(res) {
                    $btn.html('<i class="fas fa-save me-1"></i> Simpan Perubahan').prop('disabled', false);
                    if (res && res.status) {
                        var msgDetail = res.message;
                        if (!res.recalculated && res.kunci_lama === res.kunci_baru) {
                            msgDetail += '\n\n(Catatan: Kunci jawaban tidak diubah. Riwayat nilai siswa kemarin tetap, revisi butir soal & opsi telah tersimpan di Bank Soal untuk ujian berikutnya).';
                        }
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil Diperbarui!',
                            text: msgDetail,
                            confirmButtonText: 'Segarkan Halaman'
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Menyimpan',
                            text: res.message || 'Terjadi kesalahan sistem.'
                        });
                    }
                },
                error: function(xhr) {
                    $btn.html('<i class="fas fa-save me-1"></i> Simpan Perubahan').prop('disabled', false);
                    var msg = 'Gagal menghubungi server.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error (' + xhr.status + ')',
                        text: msg
                    });
                }
            });
        });

        $("#download-word").click(function (event) {
            event.preventDefault();
            var $clone = $('#print-word').clone();
            $clone.find('.btn-revisi-modal, .d-print-none').remove();
            var contentDocument = $clone.convertToHtmlFile('analisis', '');
            var content = '<!DOCTYPE html>' + contentDocument.documentElement.outerHTML;
            var converted = htmlDocx.asBlob(content, {
                orientation: 'landscape',
                size: 'A4',
                margins: {top: 700, bottom: 700, left: 1000, right: 1000}
            });
            var kodeJadwal = '<?= isset($info->bank_kode) ? esc($info->bank_kode) : "Soal" ?>';
            saveAs(converted, `Analisis ${kodeJadwal}.docx`);
        });
    });
</script>
<?= $this->endSection() ?>
