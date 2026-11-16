<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

<style>
/* PENGATURAN KERTAS CETAK: A4 LANDSCAPE */
@page {
    size: A4 landscape;
    margin: 8mm 6mm 6mm 6mm;
}

.print-header-spacer {
    display: block;
    height: 10px;
    width: 100%;
}

@media print {
    @page {
        size: A4 landscape;
        margin: 8mm 6mm 6mm 6mm;
    }
    *, *:before, *:after {
        box-sizing: border-box !important;
    }
    body, html {
        background: #ffffff !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    .no-print, 
    .main-sidebar, 
    .sidebar, 
    .iq-navbar, 
    .iq-navbar-header, 
    footer, 
    .btn, 
    .card-header, 
    .alert, 
    .nav-tabs,
    .col-aksi-print {
        display: none !important;
    }
    .main-content, 
    .content-inner, 
    .container-fluid {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
    }
    .card.print-sheet,
    div.card.print-sheet,
    .print-sheet {
        box-shadow: none !important;
        border: none !important;
        padding: 0 !important;
        padding-left: 5mm !important;
        padding-right: 5mm !important;
        margin: 0 auto !important;
        width: 100% !important;
        max-width: 100% !important;
        background: transparent !important;
    }
    .card.print-sheet .card-body,
    .print-sheet .card-body {
        padding: 0 !important;
        margin: 0 !important;
    }
    .print-header-spacer {
        display: block !important;
        height: 14mm !important;
        min-height: 14mm !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        clear: both !important;
    }
    .kop-surat-table,
    table.kop-surat-table {
        margin-top: 0 !important;
        padding-top: 0 !important;
        page-break-inside: avoid !important;
    }
    .kop-surat-table td {
        padding-top: 4px !important;
        padding-bottom: 2px !important;
    }
    thead {
        display: table-header-group !important;
    }
    tr {
        page-break-inside: avoid !important;
    }
    .table-responsive {
        overflow: visible !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    .tbl-susulan {
        width: 100% !important;
        max-width: 100% !important;
        border-collapse: collapse !important;
        table-layout: auto !important;
        font-size: 7.2pt !important;
        margin-top: 3px !important;
    }
    .tbl-susulan th {
        padding: 2.5px 1.5px !important;
        border: 1px solid #000000 !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
        line-height: 1.1 !important;
    }
    .tbl-susulan td {
        padding: 2px 2px !important;
        border: 1px solid #000000 !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
        line-height: 1.15 !important;
    }
    .col-mapel-item {
        width: 20px !important;
        max-width: 24px !important;
        font-size: 6.5pt !important;
        padding: 1.5px 0.5px !important;
        text-align: center !important;
    }
    .col-rincian-mapel {
        font-size: 6.8pt !important;
        line-height: 1.1 !important;
        word-break: break-word !important;
    }
    .col-nama-siswa {
        font-size: 7.2pt !important;
        white-space: nowrap !important;
    }
    .badge-status-selesai,
    .badge-status-belum {
        font-size: 6.8pt !important;
        padding: 0.5px 1.5px !important;
        line-height: 1 !important;
    }
    .tanda-tangan-box {
        margin-top: 8px !important;
        page-break-inside: avoid !important;
        break-inside: avoid !important;
    }
    /* Sembunyikan baris siswa yang di-uncheck saat dicetak */
    tr.baris-siswa-skip {
        display: none !important;
    }
}

.tbl-susulan {
    border-collapse: collapse;
    width: 100%;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 8pt;
    border: 1px solid #000;
}
.tbl-susulan th {
    border: 1px solid #000;
    padding: 3.5px 2px;
    text-align: center;
    vertical-align: middle;
    background-color: #e2e8f0;
}
.tbl-susulan td {
    border: 1px solid #000;
    padding: 2.5px 3px;
    vertical-align: middle;
}
.badge-status-selesai {
    background-color: #d1fae5;
    color: #065f46;
    font-weight: bold;
    padding: 1.5px 3px;
    border-radius: 2px;
    font-size: 7.5pt;
    display: inline-block;
}
.badge-status-belum {
    background-color: #fee2e2;
    color: #991b1b;
    font-weight: bold;
    padding: 1.5px 3px;
    border-radius: 2px;
    font-size: 7.5pt;
    border: 1px solid #f87171;
    display: inline-block;
}
.baris-siswa-skip {
    opacity: 0.35;
    background-color: #f1f5f9 !important;
    text-decoration: line-through;
}
</style>

<div class="d-contents">
    <!-- Action Header / Filter (No Print) -->
    <div class="card mb-4 shadow-sm border-0 no-print">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="me-3 flex-shrink-0">
                        <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #ffffff;">
                            <i class="fas fa-clipboard-list fs-4"></i>
                        </div>
                    </div>
                    <div>
                        <h4 class="card-title mb-1 fw-bold text-dark">
                            Rekap Dokumen Ujian Susulan (Format Legger)
                        </h4>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Daftar nama siswa beserta rincian mata pelajaran ujian yang belum diikuti untuk pengumuman pelaksanaan ujian susulan.
                        </p>
                    </div>
                </div>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="<?= base_url('cbtcetak') ?>" class="btn btn-outline-secondary rounded-pill px-3 shadow-sm">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Cetak
                    </a>
                    <button type="button" onclick="window.print()" class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold">
                        <i class="fas fa-print me-1"></i> Cetak / Print (Landscape)
                    </button>
                </div>
            </div>

            <hr class="my-3">

            <!-- Filter Controls -->
            <form method="get" action="<?= base_url('cbtcetak/susulan') ?>" class="row g-3 align-items-end">
                <div class="col-md-4 col-sm-6">
                    <label class="form-label small fw-bold text-secondary mb-1">Pilih Kelas</label>
                    <select name="kelas" class="form-select form-select-sm" onchange="this.form.submit()">
                        <?php foreach ($kelasList as $k): ?>
                            <option value="<?= $k->id_kelas ?>" <?= ($k->id_kelas == $selectedKelasId) ? 'selected' : '' ?>>
                                Kelas <?= esc($k->nama_kelas) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4 col-sm-6">
                    <label class="form-label small fw-bold text-secondary mb-1">Pilihan Daftar Siswa</label>
                    <select name="mode" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="hanya_susulan" <?= ($filterMode === 'hanya_susulan') ? 'selected' : '' ?>>
                            Hanya Siswa Yang Tidak Masuk / Ada Susulan (Disarankan)
                        </option>
                        <option value="semua" <?= ($filterMode === 'semua') ? 'selected' : '' ?>>
                            Semua Siswa (Termasuk Yang Sudah Lengkap)
                        </option>
                    </select>
                </div>
                <div class="col-md-4 col-sm-12 text-md-end">
                    <?php 
                        $totalSusulanSiswa = 0;
                        foreach ($summarySiswa as $sm) {
                            if (!empty($sm['is_susulan'])) $totalSusulanSiswa++;
                        }
                    ?>
                    <span class="badge bg-warning text-dark px-3 py-2 fs-6 shadow-sm border border-warning">
                        <i class="fas fa-user-clock me-1"></i> Total Siswa Susulan: <strong id="lbl-total-susulan"><?= $totalSusulanSiswa ?></strong> Siswa
                    </span>
                </div>
            </form>
        </div>
    </div>

    <!-- Printable Sheet (A4 Landscape) -->
    <div class="card shadow-sm border-0 mb-4 print-sheet">
        <div class="card-body p-2 p-md-3">

            <!-- Physical Spacer to prevent any clipping from printer hardware / browser margins -->
            <div class="print-header-spacer"></div>

            <!-- ==================== KOP SURAT (FORMAT PERSIS LEGGER) ==================== -->
            <?php
                $schInfo = detectSchoolType($setting);
                $isKemenag = $schInfo->is_kemenag;
                $satuanLabel = $schInfo->satuan_label;
                $kepsekLabel = $schInfo->kepsek_label;
                $kementerianLabel = $schInfo->kementerian;
                $logoGovUrl = $schInfo->logo_gov;

                $smtLabel = (strpos(strtolower($smt_active->nama_smt ?? ($smt_active->smt ?? '')), '2') !== false || strpos(strtolower($smt_active->nama_smt ?? ($smt_active->smt ?? '')), 'genap') !== false) ? 'Genap' : 'Ganjil';
                $barisDesa = strtoupper($setting->desa ?? 'SUMBERAGUNG');
                $kec = $setting->kecamatan ?? 'Plumpang';
                $kab = $setting->kota ?? 'Tuban';
                $prov = $setting->provinsi ?? 'Jawa Timur';
            ?>
            <table class="kop-surat-table" style="width: 100%; border-collapse: collapse; margin-bottom: 2px;">
                <tr>
                    <td style="width: 10%; text-align: center; vertical-align: middle; padding: 6px 0 2px 0;">
                        <img src="<?= $logoGovUrl ?>" alt="Logo <?= $satuanLabel ?>" style="max-height: 50px; max-width: 50px; height: auto; width: auto; object-fit: contain;" onerror="this.src='<?= $logoGovUrl ?>'">
                    </td>
                    <td style="width: 80%; text-align: center; vertical-align: middle; padding: 4px 6px;">
                        <div style="font-size: 11pt; font-weight: bold; letter-spacing: 0.5px; text-transform: uppercase; font-family: 'Times New Roman', serif; line-height: 1.2;"><?= $kementerianLabel ?></div>
                        <div style="font-size: 14pt; font-weight: bold; letter-spacing: 0.5px; margin-top: 1px; text-transform: uppercase; font-family: 'Times New Roman', serif; line-height: 1.2;"><?= esc($setting->sekolah ?? 'SEKOLAH') ?></div>
                        <div style="font-size: 11pt; font-weight: bold; margin-top: 1px; text-transform: uppercase; font-family: 'Times New Roman', serif; line-height: 1.2;"><?= esc($barisDesa) ?></div>
                        <div style="font-size: 9.5pt; font-style: italic; margin-top: 1px; font-family: 'Times New Roman', serif; line-height: 1.2;">Kecamatan <?= esc($kec) ?>, Kabupaten <?= esc($kab) ?> - <?= esc($prov) ?></div>
                    </td>
                    <td style="width: 10%; text-align: center; vertical-align: middle; padding: 6px 0 2px 0;">
                        <?php if (!empty($setting->logo_kiri) && file_exists(FCPATH . $setting->logo_kiri)): ?>
                            <img src="<?= base_url($setting->logo_kiri) ?>" alt="Logo <?= $satuanLabel ?>" style="max-height: 50px; max-width: 50px; height: auto; width: auto; object-fit: contain;">
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
            <div style="border-top: 2.5px solid #000; margin: 4px 0 6px 0;"></div>

            <!-- DATA METADATA (DENGAN DUA GARIS SEPERTI LEGGER) -->
            <table style="width: 100%; font-size: 9.5pt; font-family: 'Times New Roman', serif; font-weight: normal; margin-bottom: 2px; line-height: 1.25;">
                <tr>
                    <td style="width: 13%;">Kelas</td>
                    <td style="width: 2%;">:</td>
                    <td style="width: 45%;"><b><?= esc($kelasInfo->nama_kelas ?? '-') ?></b></td>
                    <td style="width: 18%;">Tahun Pelajaran</td>
                    <td style="width: 2%;">:</td>
                    <td style="width: 20%;"><?= esc($tp_active->tahun ?? '2026/2027') ?></td>
                </tr>
                <tr>
                    <td><?= $satuanLabel ?></td>
                    <td>:</td>
                    <td><?= esc($setting->sekolah ?? '-') ?></td>
                    <td>Semester</td>
                    <td>:</td>
                    <td><?= esc($smtLabel) ?></td>
                </tr>
                <tr>
                    <td>Status Peserta</td>
                    <td>:</td>
                    <td><?= ($filterMode === 'hanya_susulan') ? 'Daftar Khusus Siswa Yang Belum Lengkap Ujian' : 'Daftar Seluruh Siswa' ?></td>
                    <td>Tanggal Cetak</td>
                    <td>:</td>
                    <td><?= date('d F Y') ?></td>
                </tr>
            </table>
            <div style="border-top: 2.5px solid #000; margin: 4px 0 8px 0;"></div>

            <!-- JUDUL DOKUMEN (PERSIS FORMAT LEGGER) -->
            <div style="text-align: center; margin-bottom: 6px;">
                <div style="font-size: 13pt; font-weight: bold; letter-spacing: 0.5px; text-transform: uppercase; font-family: 'Times New Roman', serif;">
                    DAFTAR SISWA & MAPEL UJIAN SUSULAN
                </div>
            </div>

            <?php if (empty($siswas)): ?>
                <div class="alert alert-success text-center py-4 my-3">
                    <i class="fas fa-check-circle fa-2x mb-2 text-success"></i>
                    <h6 class="fw-bold mb-1">Alhamdulillah, Tidak Ada Siswa Susulan!</h6>
                    <p class="mb-0 small text-muted">Seluruh siswa di kelas <?= esc($kelasInfo->nama_kelas ?? '-') ?> telah menyelesaikan seluruh mata pelajaran ujian.</p>
                </div>
            <?php else: ?>
                <!-- TABEL LEGGER SUSULAN -->
                <div class="table-responsive">
                    <table class="tbl-susulan" id="table-susulan-print">
                        <thead>
                            <tr>
                                <th rowspan="2" class="col-aksi-print" style="width: 32px; background-color: #fef08a;" title="Hilangkan centang untuk mengecualikan siswa dari cetakan">
                                    <input type="checkbox" id="check-all-siswa" checked title="Centang / Hapus Semua">
                                </th>
                                <th rowspan="2" style="width: 24px;">NO</th>
                                <th rowspan="2" style="width: 65px;">NISN</th>
                                <th rowspan="2" style="text-align: left; padding-left: 5px; max-width: 160px;">NAMA LENGKAP SISWA</th>
                                <?php if (!empty($mapelSlots)): ?>
                                    <th colspan="<?= count($mapelSlots) ?>" style="background-color: #e2e8f0;">MATA PELAJARAN UJIAN</th>
                                <?php endif; ?>
                                <th rowspan="2" style="width: 48px; background-color: #fee2e2;">BELUM</th>
                                <th rowspan="2" style="text-align: left; padding-left: 5px; background-color: #fef3c7;">RINCIAN MAPEL SUSULAN</th>
                            </tr>
                            <tr>
                                <?php foreach ($mapelSlots as $jId => $j): ?>
                                    <th class="col-mapel-item" title="<?= esc($j->nama_mapel) ?>">
                                        <?= esc($j->kode_mapel ?: substr($j->nama_mapel, 0, 4)) ?>
                                    </th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $nomorUrutTampil = 1;
                            foreach ($siswas as $idx => $s): 
                                $sId = $s->id_siswa;
                                $sum = $summarySiswa[$sId] ?? ['total_mapel' => 0, 'selesai' => 0, 'belum' => 0, 'belum_mapel' => []];
                                $isSusulan = !empty($sum['is_susulan']);
                                $bgRow = $isSusulan ? '#fffbeb' : '#ffffff';
                            ?>
                                <tr class="baris-siswa-item" style="background-color: <?= $bgRow ?>;" data-siswa-id="<?= $sId ?>" data-is-susulan="<?= $isSusulan ? '1' : '0' ?>">
                                    <!-- Checkbox Cetak (No Print) -->
                                    <td class="col-aksi-print text-center" style="background-color: #fef9c3;">
                                        <input type="checkbox" class="cb-ikut-cetak" checked title="Centang untuk menyertakan di cetakan">
                                    </td>
                                    
                                    <!-- Nomor Urut Dinamis -->
                                    <td class="col-nomor-urut" style="text-align: center; font-weight: bold;"><?= $nomorUrutTampil++ ?></td>
                                    
                                    <td style="text-align: center; font-size: 7.5pt;"><?= esc($s->nisn ?: $s->nis ?: '-') ?></td>
                                    <td class="col-nama-siswa" style="font-weight: <?= $isSusulan ? 'bold' : 'normal' ?>; padding-left: 5px;">
                                        <?= esc($s->nama) ?>
                                    </td>

                                    <!-- Status per Mapel -->
                                    <?php foreach ($mapelSlots as $jId => $j): 
                                        $st = $statusUjian[$sId][$jId] ?? ['status' => 0, 'label' => 'Belum'];
                                    ?>
                                        <td class="col-mapel-item" style="text-align: center;">
                                            <?php if ($st['status'] == 2): ?>
                                                <span class="badge-status-selesai" title="Selesai (Nilai: <?= $st['nilai'] ?? '-' ?>)">✓</span>
                                            <?php elseif ($st['status'] == 1): ?>
                                                <span class="badge-status-belum" style="background-color: #fed7aa; color: #9a3412;" title="Sedang mengerjakan / terputus">⏳</span>
                                            <?php else: ?>
                                                <span class="badge-status-belum" title="Belum mengerjakan">✗</span>
                                            <?php endif; ?>
                                        </td>
                                    <?php endforeach; ?>

                                    <!-- Total Belum Ujian -->
                                    <td style="text-align: center; font-weight: bold; <?= $isSusulan ? 'color: #dc2626; background-color: #fee2e2;' : 'color: #16a34a;' ?>">
                                        <?= $sum['belum'] ?> Mapel
                                    </td>

                                    <!-- Rincian Mapel Yang Harus Diikuti -->
                                    <td class="col-rincian-mapel" style="padding-left: 5px; <?= $isSusulan ? 'color: #9a3412;' : 'color: #16a34a;' ?>">
                                        <?php if (!empty($sum['belum_mapel'])): ?>
                                            <strong><?= implode(', ', $sum['belum_mapel']) ?></strong>
                                        <?php else: ?>
                                            <span class="text-success"><i class="fas fa-check me-1"></i>Lengkap (Tidak Susulan)</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- KETERANGAN SIMBOL -->
                <div style="font-size: 7.5pt; margin-top: 5px; color: #475569;" class="d-flex gap-3 align-items-center">
                    <span><strong>Keterangan:</strong></span>
                    <span><span class="badge-status-selesai">✓</span> : Sudah Mengikuti / Selesai</span>
                    <span><span class="badge-status-belum">✗</span> : Belum Mengikuti (Wajib Susulan)</span>
                    <span><span class="badge-status-belum" style="background-color: #fed7aa; color: #9a3412;">⏳</span> : Belum Selesai / Terputus</span>
                </div>

                <!-- TANDA TANGAN DOKUMEN -->
                <div class="tanda-tangan-box" style="margin-top: 10px;">
                    <table style="width: 100%; font-family: Arial, sans-serif; font-size: 8.5pt;">
                        <tr>
                            <td style="width: 50%; vertical-align: top; text-align: left; padding-left: 15px;">
                                Mengetahui,<br>
                                <?= $kepsekLabel ?><br>
                                <div style="height: 38px;"></div>
                                <strong><?= esc($setting->kepsek ?? '-') ?></strong><br>
                                <span>NIP. <?= esc($setting->nip ?? ($setting->nip_kepsek ?? '-')) ?></span>
                            </td>
                            <td style="width: 50%; vertical-align: top; text-align: left; padding-left: 30px;">
                                <?= esc($setting->kota ?? 'Tuban') ?>, <?= date('d F Y') ?><br>
                                Ketua Panitia / Wali Kelas<br>
                                <div style="height: 38px;"></div>
                                <strong><?= esc($kelasInfo->nama_guru ?? 'Wali Kelas') ?></strong><br>
                                <span>NIP. <?= esc($kelasInfo->nip ?? '-') ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    // Fungsi untuk menyusun ulang nomor urut siswa yang aktif dicetak
    function renumberRows() {
        var num = 1;
        var totalSusulanAktif = 0;

        $('#table-susulan-print tbody tr.baris-siswa-item').each(function() {
            var $row = $(this);
            var isChecked = $row.find('.cb-ikut-cetak').is(':checked');
            var isSusulan = $row.data('is-susulan') == '1';

            if (isChecked) {
                $row.removeClass('baris-siswa-skip');
                $row.find('.col-nomor-urut').text(num++);
                if (isSusulan) {
                    totalSusulanAktif++;
                }
            } else {
                $row.addClass('baris-siswa-skip');
                $row.find('.col-nomor-urut').text('-');
            }
        });

        $('#lbl-total-susulan').text(totalSusulanAktif);
    }

    // Toggle centang per siswa
    $(document).on('change', '.cb-ikut-cetak', function() {
        renumberRows();
    });

    // Toggle Check All
    $('#check-all-siswa').on('change', function() {
        var isChecked = $(this).is(':checked');
        $('.cb-ikut-cetak').prop('checked', isChecked);
        renumberRows();
    });
});
</script>
<?= $this->endSection() ?>
