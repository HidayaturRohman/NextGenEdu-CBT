<?= $this->extend('layout/dashboard_template_bs5') ?>

<?= $this->section('content') ?>

<?php
function date_sort($a, $b)
{
    return strtotime($a ?? '') - strtotime($b ?? '');
}

$allowedDates = [];
$logo_kiri_url = !empty($setting->logo_kiri) ? (strpos($setting->logo_kiri, 'http') === 0 ? $setting->logo_kiri : base_url(ltrim($setting->logo_kiri, '/'))) : '';
$logo_kanan_url = !empty($setting->logo_kanan) ? (strpos($setting->logo_kanan, 'http') === 0 ? $setting->logo_kanan : base_url(ltrim($setting->logo_kanan, '/'))) : '';
?>
<div class="d-contents">
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
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
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">Daftar hadir dan jadwal pengawas ruang ujian.</p>
                    </div>
                </div>
                <div>
                    <a href="<?= base_url('cbtcetak') ?>" type="button" class="btn btn-sm btn-danger shadow-sm rounded-pill">
                        <i class="fas fa-arrow-circle-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <?= form_open_multipart('', array('id' => 'set-kop')) ?>
            <div class="card my-shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="card-title mb-0">Setting Kop Jadwal Pengawas</h6>
                    <button type="submit" class="btn btn-sm btn-primary rounded-pill shadow-sm">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
                <div class="card-body">
                    <!-- Pilihan Format Kop -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label fw-bold d-block">Pilihan Format Kop Surat:</label>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="kop_mode" id="kop_mode_0" value="0" <?= (!isset($kop->kop_mode) || $kop->kop_mode !== '1') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="kop_mode_0">
                                        <i class="fas fa-font text-primary me-1"></i> <b>Kop Standar</b> (Teks Header & Logo)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kop_mode" id="kop_mode_1" value="1" <?= (isset($kop->kop_mode) && $kop->kop_mode === '1') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="kop_mode_1">
                                        <i class="fas fa-image text-success me-1"></i> <b>Kop Gambar</b> (Upload Banner Kop Surat Lengkap)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mode 1: Upload Kop Gambar Banner -->
                    <div id="wrapper-kop-image" class="<?= (isset($kop->kop_mode) && $kop->kop_mode === '1') ? '' : 'd-none' ?>">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label fw-bold">File Gambar Kop Surat (Banner)</label>
                                <input type="file" id="header-kop-file" name="header_kop_file" class="dropify"
                                       data-max-file-size="3M"
                                       data-allowed-file-extensions="jpg jpeg png"
                                       data-default-file="<?= (!empty($kop->header_kop) && file_exists(FCPATH . $kop->header_kop)) ? base_url($kop->header_kop) : '' ?>"/>
                                <input type="hidden" name="hapus_kop" id="hapus_kop" value="0">
                                <small class="text-muted d-block mt-2">
                                    <i class="fas fa-info-circle text-info me-1"></i>
                                    Unggah gambar kop surat instansi/madrasah lengkap (banner kop surat). Disarankan format <b>PNG / JPG</b>.
                                </small>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                     <label class="form-label fw-bold">Judul Dokumen di Bawah Kop Gambar</label>
                                    <textarea class="form-control" name="header_3_img" id="input-judul-img" rows="3" placeholder="JADWAL PENGAWAS RUANG&#10;ASESMEN SUMATIF TENGAH SEMESTER GANJIL&#10;TAHUN AJARAN 2026/2027"><?= (!empty($kop->header_3)) ? esc($kop->header_3) : "JADWAL PENGAWAS RUANG\nASESMEN SUMATIF TENGAH SEMESTER " . strtoupper($smt_active->smt ?? 'GANJIL') . "\nTAHUN AJARAN " . ($tp_active->tahun ?? '2026/2027') ?></textarea>
                                    <small class="text-muted"><i class="fas fa-info-circle text-info me-1"></i>Format font otomatis <b>Times New Roman Bold</b> bertingkat per baris.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mode 0: Kop Standar (Teks Header 1-4) -->
                    <div id="wrapper-kop-text" class="<?= (!isset($kop->kop_mode) || $kop->kop_mode !== '1') ? '' : 'd-none' ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label>Header 1</label>
                                    <input class="form-control" name="header_1" placeholder="Header 1"
                                           value="<?= isset($kop->header_1) ? $kop->header_1 : '' ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label>Header 2</label>
                                    <input class="form-control" name="header_2" placeholder="Header 2"
                                           value="<?= isset($kop->header_2) ? $kop->header_2 : '' ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label>Header 3 (Judul Dokumen)</label>
                                    <textarea class="form-control" name="header_3_text" id="input-judul-text" rows="3" placeholder="Header 3"><?= (!empty($kop->header_3)) ? esc($kop->header_3) : "JADWAL PENGAWAS RUANG\nASESMEN SUMATIF TENGAH SEMESTER " . strtoupper($smt_active->smt ?? 'GANJIL') . "\nTAHUN AJARAN " . ($tp_active->tahun ?? '2026/2027') ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label>Header 4</label>
                                    <input class="form-control" name="header_4" placeholder="Header 4"
                                           value="<?= isset($kop->header_4) ? $kop->header_4 : '' ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="header_3" id="input-header-3" value="<?= isset($kop->header_3) ? $kop->header_3 : '' ?>">
                </div>
            </div>
            <?= form_close() ?>

            <div class="card my-shadow mb-4">
                <div class="card-header">
                    <h3 class="card-title"><b><?= $subjudul ?></b></h3>
                    <div class="card-tools">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-success rounded-pill shadow-sm" id="btn-print" onclick="printPengawas()" data-toggle="tooltip"
                                    title="Print">
                                <i class="fas fa-print"></i>
                                <span class="d-none d-sm-inline-block ml-1"> Print/PDF</span></button>
                            <button type="button" class="btn btn-sm btn-primary rounded-pill shadow-sm ml-1" id="btn-word" onclick="exportWord()" data-toggle="tooltip"
                                    title="Export As Word">
                                <i class="fa fa-file-word"></i> <span class="d-none d-sm-inline-block ml-1"> Word</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3 col-6">
                            <div class="form-group">
                                <label for="jenis">Jenis</label>
                                <?php
                                echo form_dropdown('jenis', $jenis, $jenis_selected, 'id="jenis" class="form-control"'); ?>
                            </div>
                        </div>
                        <div class="col-md-2 col-4">
                            <div class="form-group">
                                <label for="filter">Filter</label>
                                <?php
                                echo form_dropdown('filter', $filter, $filter_selected, 'id="filter" class="form-control"'); ?>
                            </div>
                        </div>
                        <?php
                        $dnone = $filter_selected == '0' ? 'd-none' : '' ?>
                        <div class='col-md-2 col-4 <?= $dnone ?>' id="tgl-dari">
                            <div class="form-group">
                                <label for="dari">Dari</label>
                                <input type='text' id="dari" name='dari' value="<?= $dari_selected ?>"
                                       class='tgl form-control' autocomplete='off'/>
                            </div>
                        </div>
                        <div class='col-md-2 col-4 <?= $dnone ?>' id="tgl-sampai">
                            <div class="form-group">
                                <label for="sampai">Sampai</label>
                                <input type='text' id="sampai" name='sampai'
                                       class='tgl form-control' value="<?= $sampai_selected ?>"
                                       autocomplete='off'/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center bg-gray-light">
                    <div id="print-preview">
                        <?php
                        if (count($ruang) > 0):
                            foreach ($ruang as $rng) :?>
                                <div class="print-card-wrapper border my-shadow mb-3 p-4 bg-white">
                                    <div class="page-print" style="font-family: 'Times New Roman', serif; justify-content: center; width: 100%; max-width: 195mm; margin: 0 auto; box-sizing: border-box; padding: 0 5px;">
                                        <?php
                                        $isKopImg = (isset($kop->kop_mode) && $kop->kop_mode === '1' && !empty($kop->header_kop) && file_exists(FCPATH . $kop->header_kop));
                                        $judulLines = array_filter(array_map('trim', explode("\n", $kop->header_3 ?? '')));
                                        if (empty($judulLines)) {
                                            $judulLines = [
                                                'JADWAL PENGAWAS RUANG',
                                                'ASESMEN SUMATIF TENGAH SEMESTER ' . strtoupper($smt_active->smt ?? 'GANJIL'),
                                                'TAHUN AJARAN ' . ($tp_active->tahun ?? '2026/2027')
                                            ];
                                        }
                                        ?>
                                        <?php if ($isKopImg): ?>
                                            <div style="width: 100%; margin: 0 0 6px 0; padding: 0; text-align: center;">
                                                <img src="<?= base_url($kop->header_kop) ?>" class="kop-img" style="width: 100%; height: auto; display: block; margin: 0 auto; padding: 0;">
                                            </div>
                                            <div class="judul-daftar-hadir" style="text-align: center; font-family: 'Times New Roman', serif !important; font-weight: bold !important; margin-top: 6px; margin-bottom: 12px; line-height: 1.3;">
                                                <?php foreach ($judulLines as $idx => $line): ?>
                                                    <div style="font-size: <?= $idx === 0 ? '12pt' : '11pt' ?>; font-family: 'Times New Roman', serif !important; font-weight: bold !important; letter-spacing: 0.5px;"><?= esc($line) ?></div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php else: ?>
                                            <table id="table-header-print" style="width: 100%; border: 0; table-layout: fixed;">
                                                <colgroup>
                                                    <col style="width: 15%;">
                                                    <col style="width: 70%;">
                                                    <col style="width: 15%;">
                                                </colgroup>
                                                <tr>
                                                <td style="width:15%;">
                                                    <?php
                                                    $logo_kiri = !empty($kop->logo_kiri) ? $kop->logo_kiri : ($setting->logo_kiri ?? '');
                                                    $logo_kiri_url = !empty($logo_kiri) ? (strpos($logo_kiri, 'http') === 0 ? $logo_kiri : base_url(ltrim($logo_kiri, '/'))) : '';
                                                    if (!empty($logo_kiri_url)): ?>
                                                        <img alt="logo kiri" id="prev-logo-kiri-print" width="85" height="85"
                                                             src="<?= $logo_kiri_url ?>"
                                                             onerror="this.style.display='none'"
                                                             style="width:85px; height:85px; margin: 6px;">
                                                    <?php endif; ?>
                                                </td>
                                                <td style="width:70%; text-align: center;">
                                                    <div style="line-height: 1.1; font-family: 'Times New Roman'; font-size: 14pt"><?= isset($kop->header_1) ? $kop->header_1 : $setting->sekolah ?></div>
                                                    <div style="line-height: 1.1; font-family: 'Times New Roman'; font-size: 16pt"><b><?= isset($kop->header_2) ? $kop->header_2 : '' ?></b></div>
                                                    <div class="judul-daftar-hadir" style="margin-top: 4px; margin-bottom: 4px;">
                                                        <?php foreach ($judulLines as $idx => $line): ?>
                                                            <div style="font-size: <?= $idx === 0 ? '12pt' : '11pt' ?>; font-family: 'Times New Roman', serif !important; font-weight: bold !important; letter-spacing: 0.5px;"><?= esc($line) ?></div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                    <div style="line-height: 1.2; font-family: 'Times New Roman'; font-size: 12pt"><?= isset($kop->header_4) ? $kop->header_4 : ('Tahun Pelajaran: ' . $tp_active->tahun) ?></div>
                                                </td>
                                                <td style="width:15%;">
                                                    <?php
                                                    $logo_kanan = !empty($kop->logo_kanan) ? $kop->logo_kanan : ($setting->logo_kanan ?? '');
                                                    $logo_kanan_url = !empty($logo_kanan) ? (strpos($logo_kanan, 'http') === 0 ? $logo_kanan : base_url(ltrim($logo_kanan, '/'))) : '';
                                                    if (!empty($logo_kanan_url)): ?>
                                                        <img alt="logo kanan" id="prev-logo-kanan-print"
                                                             src="<?= $logo_kanan_url ?>"
                                                             onerror="this.style.display='none'"
                                                             width="85" height="85"
                                                             style="width:85px; height:85px; margin: 6px; border-style: none">
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        </table>
                                        <hr style="border: 1px solid; margin-bottom: 6px; margin-top: 2px">
                                    <?php endif; ?>
                                    <div style="font-size: 11pt; font-weight: bold; margin-bottom: 4px; font-family: 'Times New Roman', Times, serif !important;"><?= $rng->nama_ruang ?></div>
                                    <table class="tbl-pengawas" style="width: 100% !important; max-width: 100% !important; table-layout: fixed !important; border-collapse: collapse !important; font-family: 'Times New Roman', Times, serif !important;">
                                        <colgroup>
                                            <col class="col-hari" style="width: 18%;">
                                            <col class="col-sesi" style="width: 14%;">
                                            <col class="col-jam" style="width: 8%;">
                                            <col class="col-mapel" style="width: 32%;">
                                            <col class="col-pengawas" style="width: 28%;">
                                        </colgroup>
                                        <thead>
                                        <tr style="font-family: 'Times New Roman', Times, serif !important; font-size: 10pt">
                                            <th class="col-hari" style="border: 1px solid black; height: 28px; text-align: center; width: 18%; white-space: normal !important;">Hari &amp; Tanggal</th>
                                            <th class="col-sesi" style="border: 1px solid black; height: 28px; text-align: center; width: 14%; white-space: normal !important;">Sesi</th>
                                            <th class="col-jam" style="border: 1px solid black; height: 28px; text-align: center; width: 8%; white-space: normal !important;">Jam Ke</th>
                                            <th class="col-mapel" style="border: 1px solid black; height: 28px; text-align: center; width: 32%; white-space: normal !important;">Mata Pelajaran</th>
                                            <th class="col-pengawas" style="border: 1px solid black; height: 28px; text-align: center; width: 28%; white-space: normal !important;">Pengawas</th>
                                        </tr>
                                        </thead>
                                        <?php
                                        $byTanggal = [];
                                        foreach ($rng->sesi as $sesi) {
                                            foreach ($sesi->jadwals as $jad) {
                                                $tanggal = $jad->tgl_mulai ?? '';
                                                $byTanggal[$tanggal][$sesi->sesi_id]['sesi'] = $sesi;

                                                $pengawas_jadwal = $pengawas[$jad->id_jadwal][$rng->ruang_id][$sesi->sesi_id] ?? (object)[];
                                                $guru = $pengawas_jadwal->id_guru ?? '';

                                                $nama_guru = explode(',', $guru);
                                                $nama_pengawas = [];
                                                foreach ($nama_guru as $ng) {
                                                    if ($ng != '') {
                                                        $nama_pengawas[] = $gurus[$ng] ?? '';
                                                    }
                                                }
                                                $jad_copy = clone $jad;
                                                $jad_copy->nama_pengawas = $nama_pengawas;
                                                $jad_copy->jam_ke = $pengawas_jadwal->jam_ke ?? '1';

                                                $byTanggal[$tanggal][$sesi->sesi_id]['jadwals'][$jad->id_jadwal] = $jad_copy;
                                            }
                                        }

                                        foreach ($byTanggal as $tanggal => $listSesi):
                                            $rowspanTanggal = array_sum(array_map(function ($s) {
                                                return count($s['jadwals']);
                                            }, $listSesi));
                                            $firstTanggal = true;
                                            ?>
                                            <tbody class="group-tgl" style="page-break-inside: avoid !important; break-inside: avoid !important;">
                                            <?php
                                            foreach ($listSesi as $sesi_id => $dataSesi):
                                                $sesi = $dataSesi['sesi'];
                                                $jadwals = $dataSesi['jadwals'];

                                                usort($jadwals, function ($a, $b) {
                                                    return ($a->jam_ke ?? 0) <=> ($b->jam_ke ?? 0);
                                                });

                                                $rowspanSesi = count($jadwals);
                                                $firstSesi = true;

                                                foreach ($jadwals as $jdw):
                                                    ?>
                                                    <tr style="font-family: 'Times New Roman', Times, serif !important; font-size: 9.5pt; line-height: 1.2; page-break-inside: avoid !important; break-inside: avoid !important;">
                                                        <?php if ($firstTanggal): ?>
                                                            <td class="col-hari" rowspan="<?= $rowspanTanggal ?>" style="border: 1px solid black; text-align: center; vertical-align: middle; padding: 3px 2px; white-space: normal !important; font-family: 'Times New Roman', Times, serif !important;">
                                                                <?= str_replace(',', '<br>', singkat_tanggal(date('D,d M Y', strtotime($tanggal)))) ?>
                                                            </td>
                                                        <?php endif; ?>

                                                        <?php if ($firstSesi): ?>
                                                            <td class="col-sesi" rowspan="<?= $rowspanSesi ?>" style="border: 1px solid black; text-align: center; vertical-align: middle; padding: 3px 2px; white-space: normal !important; font-family: 'Times New Roman', Times, serif !important;">
                                                                <?= $sesi->nama_sesi ?>
                                                            </td>
                                                        <?php endif; ?>

                                                        <td class="col-jam" style="border: 1px solid black; text-align: center; vertical-align: middle; padding: 3px 2px; white-space: normal !important; font-family: 'Times New Roman', Times, serif !important;"><?= $jdw->jam_ke ?></td>
                                                        <td class="col-mapel" style="border: 1px solid black; padding: 3px 6px; vertical-align: middle; text-align: left; white-space: normal !important; word-wrap: break-word !important; word-break: break-word !important; overflow-wrap: break-word !important; font-family: 'Times New Roman', Times, serif !important;"><?= $jdw->nama_mapel ?></td>

                                                        <td class="col-pengawas" style="border: 1px solid black; text-align: center; vertical-align: middle; padding: 3px 4px; white-space: normal !important; word-wrap: break-word !important; word-break: break-word !important; overflow-wrap: break-word !important; font-family: 'Times New Roman', Times, serif !important;">
                                                            <?= implode('<br>', $jdw->nama_pengawas ?? []) ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $firstTanggal = false;
                                                    $firstSesi = false;
                                                endforeach;
                                            endforeach;
                                            ?>
                                            </tbody>
                                            <?php
                                        endforeach;
                                        ?>
                                    </table>
                                    <br>
                                    <div id="konten-copy" class="d-none"></div>
                                    </div>
                                </div>
                                <div style="page-break-after: always"></div>
                            <?php endforeach;
                        else: ?>
                            <div class="alert alert-warning text-center m-4">
                                <i class="fas fa-exclamation-triangle mr-2"></i> Belum ada data jadwal pengawas untuk jenis/filter yang dipilih.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="overlay d-none" id="loading">
                    <div class="spinner-grow"></div>
                </div>
            </div>
        </div>
</div>
</section>
</div>

<style>
@page {
    size: A4 portrait;
    margin: 0mm;
}

#print-preview, #print-preview *,
.page-print, .page-print *,
table.tbl-pengawas, table.tbl-pengawas *,
.judul-daftar-hadir, .judul-daftar-hadir * {
    font-family: 'Times New Roman', Times, serif !important;
}

/* Enforce table layout & word break on both screen and print */
table.tbl-pengawas {
    width: 100% !important;
    max-width: 100% !important;
    table-layout: fixed !important;
    border-collapse: collapse !important;
    box-sizing: border-box !important;
    margin-top: 6px;
    margin-bottom: 8px;
}
table.tbl-pengawas thead {
    display: table-header-group !important;
}
table.tbl-pengawas tbody.group-tgl {
    page-break-inside: avoid !important;
    break-inside: avoid !important;
}
table.tbl-pengawas tr {
    page-break-inside: avoid !important;
    break-inside: avoid !important;
}
table.tbl-pengawas th,
table.tbl-pengawas td {
    border: 1px solid black !important;
    box-sizing: border-box !important;
    white-space: normal !important;
    word-wrap: break-word !important;
    word-break: break-word !important;
    overflow-wrap: break-word !important;
    vertical-align: middle !important;
    font-family: 'Times New Roman', Times, serif !important;
}
table.tbl-pengawas th {
    height: 28px;
    text-align: center;
    font-weight: bold !important;
    padding: 4px 3px !important;
    font-size: 10pt;
}
table.tbl-pengawas td {
    padding: 3px 5px !important;
    font-size: 9.5pt;
    line-height: 1.2;
}
table.tbl-pengawas .col-hari {
    width: 18% !important;
    text-align: center !important;
}
table.tbl-pengawas .col-sesi {
    width: 14% !important;
    text-align: center !important;
}
table.tbl-pengawas .col-jam {
    width: 8% !important;
    text-align: center !important;
}
table.tbl-pengawas .col-mapel {
    width: 32% !important;
    text-align: left !important;
    padding-left: 6px !important;
    padding-right: 6px !important;
}
table.tbl-pengawas .col-pengawas {
    width: 28% !important;
    text-align: center !important;
}

@media print {
    @page {
        size: A4 portrait;
        margin: 0mm;
    }
    *, *::before, *::after {
        font-family: 'Times New Roman', Times, serif !important;
    }
    html, body {
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        background: #fff !important;
        font-family: 'Times New Roman', Times, serif !important;
    }
    .print-card-wrapper, .border, .my-shadow, .p-4, .p-5, .pt-4, .m-4, .m-2 {
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
        margin: 0 !important;
        background: transparent !important;
    }
    .page-print {
        width: 100% !important;
        max-width: 100% !important;
        min-height: auto !important;
        height: auto !important;
        margin: 0 !important;
        padding: 8mm 8mm 6mm 8mm !important;
        box-sizing: border-box !important;
    }
    thead {
        display: table-header-group !important;
    }
    tfoot {
        display: table-footer-group !important;
    }
    table {
        width: 100% !important;
        border-collapse: collapse !important;
    }
    table.tbl-pengawas {
        width: 100% !important;
        max-width: 100% !important;
        table-layout: fixed !important;
        border-collapse: collapse !important;
    }
    table.tbl-pengawas tbody.group-tgl {
        page-break-inside: avoid !important;
        break-inside: avoid !important;
    }
    table.tbl-pengawas tr {
        page-break-inside: avoid !important;
        break-inside: avoid !important;
    }
    table.tbl-pengawas th {
        height: 28px !important;
        padding: 4px 3px !important;
        font-size: 10pt !important;
        white-space: normal !important;
    }
    table.tbl-pengawas td {
        padding: 3px 5px !important;
        font-size: 9.5pt !important;
        line-height: 1.2 !important;
        white-space: normal !important;
        word-wrap: break-word !important;
        word-break: break-word !important;
        overflow-wrap: break-word !important;
    }
    .judul-daftar-hadir, .judul-daftar-hadir div {
        font-family: 'Times New Roman', Times, serif !important;
        font-weight: bold !important;
    }
    img.kop-img {
        width: 100% !important;
        max-width: 100% !important;
        display: block !important;
        margin: 0 !important;
        padding: 0 !important;
    }
}
</style>

<script src="<?= base_url('assets/app/js/cetak-area.js') ?>?v=<?= @filemtime(FCPATH . 'assets/app/js/cetak-area.js') ?: time() ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/app/js/html-docx.js') ?>"></script>
<script src="<?= base_url('assets/app/js/convert-area.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/app/js/FileSaver.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/app/js/jquery.wordexport.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/app/js/tableToExcel.js') ?>"></script>
<script>
    var base_url = "<?= rtrim(base_url(), '/') ?>/";
    var docTitle = "Cetak Jadwal Pengawas";

    $(document).ready(function () {
        ajaxcsrf();

        // Toggle Format Kop (Standar vs Gambar)
        $('input[name="kop_mode"]').on('change', function () {
            if ($(this).val() === '1') {
                $('#wrapper-kop-image').removeClass('d-none');
                $('#wrapper-kop-text').addClass('d-none');
            } else {
                $('#wrapper-kop-image').addClass('d-none');
                $('#wrapper-kop-text').removeClass('d-none');
            }
        });

        // Initialize Dropify
        if (typeof $.fn.dropify === 'function') {
            var drKop = $('.dropify').dropify({
                messages: {
                    'default': 'Seret dan lepas gambar di sini atau klik',
                    'replace': 'Seret dan lepas atau klik untuk mengganti',
                    'remove':  'Hapus',
                    'error':   'Ada kesalahan pada file.'
                }
            });

            drKop.on('dropify.afterClear', function(event, element){
                $('#hapus_kop').val('1');
            });
        }

        // Submit Kop Pengawas
        $('#set-kop').on('submit', function (e) {
            e.preventDefault();
            var selectedMode = $('input[name="kop_mode"]:checked').val() || '0';
            if (selectedMode === '1') {
                $('#input-header-3').val($('#input-judul-img').val());
            } else {
                $('#input-header-3').val($('#input-judul-text').val());
            }

            var formData = new FormData(this);
            if (typeof ajaxcsrf === 'function') ajaxcsrf();

            Swal.fire({
                title: "Menyimpan...",
                text: "Silahkan tunggu....",
                allowOutsideClick: false,
                didOpen: function() { Swal.showLoading(); }
            });

            $.ajax({
                url: base_url + 'cbtcetak/savekoppengawas',
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function (response) {
                    Swal.fire({
                        title: 'Sukses', text: "Template KOP Jadwal Pengawas berhasil disimpan", icon: 'success',
                    }).then(function() { window.location.reload(); });
                },
                error: function (xhr) {
                    Swal.fire({ title: "Error", text: "Gagal menyimpan Kop Jadwal Pengawas", icon: "error" });
                }
            });
        });

        var allowed = JSON.parse("<?=json_encode($allowedDates)?>");
        $('.tgl').datetimepicker({
            icons:
                {
                    next: 'fa fa-angle-right',
                    previous: 'fa fa-angle-left'
                },
            timepicker: false,
            scrollInput: false,
            scrollMonth: false,
            format: 'Y-m-d',
            formatDate: 'Y-m-d',
            widgetPositioning: {
                horizontal: 'left',
                vertical: 'bottom'
            }
        });

        var opsiJenis = $("#jenis");
        var opsiFilter = $("#filter");
        var opsiDari = $("#dari");
        var opsiSampai = $("#sampai");

        opsiFilter.change(function () {
            if ($(this).val() == '0') {
                $('#tgl-dari').addClass('d-none');
                $('#tgl-sampai').addClass('d-none');
                var jenis = opsiJenis.val();
                var url = base_url + 'cbtcetak/pengawas?jenis=' + jenis + '&filter=0';
                if (jenis != "") {
                    $('#loading').removeClass('d-none');
                    window.location.href = url;
                }
            } else {
                $('#tgl-dari').removeClass('d-none');
                $('#tgl-sampai').removeClass('d-none');
            }
        });

        var old = "<?=$jenis_selected?>";
        opsiJenis.change(function () {
            getAllJadwal();
        });

        var dariold = "<?=$dari_selected?>";
        opsiDari.change(function () {
            var dari = $(this).val();
            if (dari != "" && dari !== dariold) {
                getAllJadwal();
            }
        });

        var sampaiold = "<?=$sampai_selected?>";
        opsiSampai.change(function () {
            var sampai = $(this).val();
            if (sampai != "" && sampai !== sampaiold) {
                getAllJadwal();
            }
        });

        opsiJenis.select2({width: '100%', theme: 'bootstrap4'});

        function getAllJadwal() {
            var dari = opsiDari.val();
            var sampai = opsiSampai.val();
            var jenis = opsiJenis.val();
            var fil = opsiFilter.val();

            var tglKosong = fil == '1' && (dari == "" || sampai == "");
            var url = base_url + 'cbtcetak/pengawas?jenis=' + jenis + '&filter=' + opsiFilter.val() + '&dari=' + dari + '&sampai=' + sampai;
            if (jenis != "" && !tglKosong) {
                $('#loading').removeClass('d-none');
                window.location.href = url;
            }
        }

        $('#btn-print').on('click', function () {
            printPengawas();
        });

        // $('#btn-word').on('click', function () {
        //     exportWord();
        // });
    });

    function print() {
        var title = document.title;
        document.title = docTitle;
        $('#print-preview').print(docTitle);
        document.title = title;
    }

    function printPengawas() {
        print();
    }

    function exportWord() {
        var contentDocument = $('#print-preview').convertToHtmlFile(docTitle, '');
        var content = '<!DOCTYPE html>' + contentDocument.documentElement.outerHTML;
        var converted = htmlDocx.asBlob(content, {
            size: 'A4',
            margins: {top: 700, bottom: 700, left: 1000, right: 1000}
        });
        saveAs(converted, docTitle + '.docx');
    }
</script>

<?= $this->endSection() ?>

