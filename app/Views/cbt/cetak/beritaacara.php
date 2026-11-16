<?= $this->extend('layout/dashboard_template_bs5') ?>

<?= $this->section('content') ?>

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
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">Pengaturan dan cetak berita acara pelaksanaan ujian CBT.</p>
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
            <div class="card my-shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="card-title mb-0">Setting Kop Berita Acara</h6>
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
                                    <textarea class="form-control" name="header_3_img" id="input-judul-img" rows="3" placeholder="BERITA ACARA PELAKSANAAN&#10;ASESMEN SUMATIF TENGAH SEMESTER GANJIL&#10;TAHUN AJARAN 2026/2027"><?= (!empty($kop->header_3)) ? esc($kop->header_3) : "BERITA ACARA PELAKSANAAN\nASESMEN SUMATIF TENGAH SEMESTER " . strtoupper($smt_active->smt ?? 'GANJIL') . "\nTAHUN AJARAN " . ($tp_active->tahun ?? '2026/2027') ?></textarea>
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
                                    <textarea class="form-control" name="header_3_text" id="input-judul-text" rows="3" placeholder="Header 3"><?= (!empty($kop->header_3)) ? esc($kop->header_3) : "BERITA ACARA PELAKSANAAN\nASESMEN SUMATIF TENGAH SEMESTER " . strtoupper($smt_active->smt ?? 'GANJIL') . "\nTAHUN AJARAN " . ($tp_active->tahun ?? '2026/2027') ?></textarea>
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

            <div class="card my-shadow">
                <div class="card-header">
                    <div class="card-title">
                        <h6>Cetak Sekaligus</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-5 mb-3" id="by-mapel">
                            <label>Mapel</label>
                            <?php
                            echo form_dropdown('mapel', $mapel_jadwal, null, 'id="mapel" class="form-control"'); ?>
                        </div>
                        <div class="col-sm-3 col-6 mb-3 pb-2 align-self-end">
                            <div id="loading-page" class="d-none">
                                <i class="fa fa-spinner fa-spin mr-2"></i> Memuat...
                            </div>
                            <div id="info-page" class="d-none"></div>
                        </div>
                        <div class="col-sm-4 col-6 mb-3 align-self-end text-right">
                            <button type="button" class="btn btn-success btn-sm rounded-pill shadow-sm" id="btn-print-all">
                                <i class="fa fa-print"></i><span class="ml-1">Cetak Semua</span>
                            </button>
                            <button type="button" class="btn btn-primary btn-sm rounded-pill shadow-sm ml-1" id="btn-word-all" onclick="exportWord('#all-print-preview', 'Berita Acara Global')">
                                <i class="fa fa-file-word"></i><span class="ml-1">Word</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card my-shadow">
                <div class="card-header">
                    <div class="card-title">
                        <h6>Cetak</h6>
                    </div>
                    <div id="selector" class="card-tools btn-group">
                        <button type="button" class="btn active btn-primary">By Ruang</button>
                        <button type="button" class="btn btn-outline-primary">By Kelas</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-sm-3 d-none" id="by-kelas">
                            <label>Kelas</label>
                            <?php
                            echo form_dropdown(
                                'kelas',
                                $kelas,
                                null,
                                'id="kelas" class="form-control"'
                            ); ?>
                        </div>
                        <div class="col-6 col-sm-3" id="by-ruang">
                            <label>Ruang</label>
                            <?php
                            echo form_dropdown(
                                'ruang',
                                $ruang,
                                null,
                                'id="ruang" class="form-control"'
                            ); ?>
                        </div>
                        <div class="col-6 col-sm-3">
                            <label>Sesi</label>
                            <?php
                            echo form_dropdown(
                                'sesi',
                                $sesi,
                                null,
                                'id="sesi" class="form-control"'
                            ); ?>
                        </div>
                        <div class="col-6 col-md-3 mb-3">
                            <label>Jadwal</label>
                            <?php
                            echo form_dropdown('mapel', $mapel_jadwal, null, 'id="mapel-jadwal" class="form-control"');
                            ?>
                        </div>
                        <div class="col-6 col-md-3 mb-3 d-none" id="select-tgl">
                            <label>Tanggal</label>
                            <select name="tanggal" id="mapel-tgl" class="form-control select2"></select>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 mr-3">
                            <div class="alert alert-default-danger d-none" id="empty-jadwal">
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-success btn-sm rounded-pill shadow-sm" id="btn-print">
                                <i class="fa fa-print"></i><span class="ml-1">Cetak</span>
                            </button>
                            <button type="button" class="btn btn-primary btn-sm rounded-pill shadow-sm ml-1" onclick="exportWord('#print-preview', 'Berita Acara')">
                                <i class="fa fa-file-word"></i><span class="ml-1">Word</span>
                            </button>
                        </div>
                    </div>
                    <br>
                    <div class="p-4 bg-gray-light">
                        <div style="display: flex; justify-content: center; align-items: center;">
                            <div id="print-preview">
                                <div class="print-card-wrapper border my-shadow mb-3 p-4 bg-white">
                                    <div class="page-print" style="font-family: 'Times New Roman', serif; justify-content: center; width: 100%; max-width: 195mm; min-height: 297mm; margin: 0 auto; box-sizing: border-box; padding: 0 5px;">
                                        <?php
                                        $sch = function_exists('detectSchoolType') ? detectSchoolType($setting) : null;
                                        $kepsekLabel = $sch->kepsek_label ?? 'Kepala Sekolah';
                                        $satuanLabel = $sch->satuan_label ?? 'Sekolah/Madrasah';
                                        $isKopImg = (isset($kop->kop_mode) && $kop->kop_mode === '1' && !empty($kop->header_kop) && file_exists(FCPATH . $kop->header_kop));
                                        $judulLines = array_filter(array_map('trim', explode("\n", $kop->header_3 ?? '')));
                                        if (empty($judulLines)) {
                                            $judulLines = [
                                                'BERITA ACARA PELAKSANAAN',
                                                'ASESMEN SUMATIF TENGAH SEMESTER ' . strtoupper($smt_active->smt ?? 'GANJIL'),
                                                'TAHUN AJARAN ' . ($tp_active->tahun ?? '2026/2027')
                                            ];
                                        }
                                        ?>
                                        <?php if ($isKopImg): ?>
                                            <div style="width: 100%; margin: 0 0 6px 0; padding: 0; text-align: center;">
                                                <img src="<?= base_url($kop->header_kop) ?>" class="kop-img" style="width: 100%; height: auto; display: block; margin: 0 auto; padding: 0;">
                                            </div>
                                            <div class="judul-daftar-hadir" style="text-align: center; font-family: 'Times New Roman', serif !important; font-weight: bold !important; margin-top: 6px; margin-bottom: 10px; line-height: 1.3;">
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
                                                        <img alt="logo kiri" id="prev-logo-kanan-print"
                                                             src="<?= !empty($kop->logo_kiri) ? base_url(ltrim($kop->logo_kiri, '/')) : '' ?>"
                                                             onerror="this.style.display='none'"
                                                             style="width:85px; height:85px; margin: 6px;">
                                                    </td>
                                                    <td style="width:70%; text-align: center;">
                                                        <div style="line-height: 1.1; font-family: 'Times New Roman'; font-size: 14pt"><?= isset($kop->header_1) ? $kop->header_1 : '' ?></div>
                                                        <div style="line-height: 1.1; font-family: 'Times New Roman'; font-size: 16pt"><b><?= isset($kop->header_2) ? $kop->header_2 : '' ?></b></div>
                                                        <div class="judul-daftar-hadir" style="margin-top: 4px; margin-bottom: 4px;">
                                                            <?php foreach ($judulLines as $idx => $line): ?>
                                                                <div style="font-size: <?= $idx === 0 ? '12pt' : '11pt' ?>; font-family: 'Times New Roman', serif !important; font-weight: bold !important; letter-spacing: 0.5px;"><?= esc($line) ?></div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                        <div style="line-height: 1.2; font-family: 'Times New Roman'; font-size: 12pt"><?= isset($kop->header_4) ? $kop->header_4 : '' ?></div>
                                                    </td>
                                                    <td style="width:15%;">
                                                        <img alt="logo kanan" id="prev-logo-kiri-print"
                                                             src="<?= !empty($kop->logo_kanan) ? base_url(ltrim($kop->logo_kanan, '/')) : '' ?>"
                                                             onerror="this.style.display='none'"
                                                             style="width:85px; height:85px; margin: 6px; border-style: none">
                                                    </td>
                                                </tr>
                                            </table>
                                            <hr style="border: 1px solid; margin-bottom: 10px">
                                        <?php endif; ?>
                                        <div style="text-align: justify; font-family: 'Times New Roman', Times, serif !important; font-size: 11pt; line-height: 1.4; margin-top: 6px; margin-bottom: 10px;">
                                            Pada hari ini <span class="editable bg-gray-light" id="edit-hari"
                                                                style="display: inline-block;min-width: 20px"><?= buat_tanggal(date('D')) ?></span>
                                            tanggal <span class="editable bg-gray-light" id="edit-tanggal"
                                                          style="display: inline-block;min-width: 20px"><?= buat_tanggal(date('d')) ?></span>
                                            bulan <span class="editable bg-gray-light" id="edit-bulan"
                                                        style="display: inline-block;min-width: 20px"><?= buat_tanggal(date('M')) ?></span>
                                            tahun <span class="editable bg-gray-light" id="edit-tahun"
                                                        style="display: inline-block;min-width: 20px"><?= buat_tanggal(date('Y')) ?></span>
                                            telah diselenggarakan <span class="editable bg-gray-light" id="edit-jenis-ujian"
                                                                        style="display: inline-block;min-width: 20px">............................................</span>
                                            untuk Mata Pelajaran <span class="editable bg-gray-light" id="edit-mapel"
                                                                       style="display: inline-block;min-width: 20px">.....................................</span>
                                            dari pukul <span class="editable bg-gray-light" id="edit-waktu-mulai"
                                                             style="display: inline-block;min-width: 20px">.............</span>
                                            sampai dengan pukul <span class="editable bg-gray-light" id="edit-waktu-akhir"
                                                                      style="display: inline-block;min-width: 20px">...........</span>
                                        </div>
                                        <table class="table-berita-info" style="width: 100%; font-family: 'Times New Roman', Times, serif !important; font-size: 11pt; line-height: 1.35; table-layout: fixed;">
                                            <colgroup>
                                                <col style="width: 30px;">
                                                <col style="width: 230px;">
                                                <col style="width: 15px;">
                                                <col style="width: auto;">
                                            </colgroup>
                                            <tr>
                                                <td style="width: 30px;">1.</td>
                                                <td style="width: 230px;">
                                                    Pada Sekolah/Madrasah
                                                </td>
                                                <td style="width: 15px; text-align: center;">:</td>
                                                <td class="editable bg-gray-light"
                                                    id="edit-nama_sekolah"><?= isset($kop->sekolah) ? $kop->sekolah : '' ?></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td id="title-ruang">
                                                    Ruang
                                                </td>
                                                <td style="text-align: center;">:</td>
                                                <td class="editable bg-gray-light" id="edit-ruang">
                                                    .................................................................
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>Sesi</td>
                                                <td style="text-align: center;">:</td>
                                                <td class="editable bg-gray-light" id="edit-sesi">
                                                    .................................................................
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    Jumlah Peserta Seharusnya
                                                </td>
                                                <td style="text-align: center;">:</td>
                                                <td class="editable bg-gray-light" id="edit-jml-peserta">
                                                    .................................................................
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    Jumlah Peserta Hadir
                                                </td>
                                                <td style="text-align: center;">:</td>
                                                <td class="editable bg-gray-light" id="edit-hadir">
                                                    .................................................................
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    Jumlah Peserta Tidak Hadir
                                                </td>
                                                <td style="text-align: center;">:</td>
                                                <td class="editable bg-gray-light" id="edit-tidak-hadir">
                                                    .................................................................
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    Nomor Peserta Tidak Hadir
                                                </td>
                                                <td style="text-align: center;">:</td>
                                                <td class="editable bg-gray-light" id="edit-username">
                                                    .................................................................
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top: 12px">2.</td>
                                                <td style="padding-top: 12px" colspan="3">
                                                    Catatan selama <span class="editable bg-gray-light" id="edit-nama-ujian"
                                                                         style="display: inline-block;min-width: 20px">.......</span>
                                                    berlangsung :
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td colspan="3" style="height: 100px; border: 1px solid black; padding: 12px"
                                                    class="editable bg-gray-light" id="edit-catatan"></td>
                                            </tr>
                                        </table>
                                        <div id="berita-ttd" style="margin-top: 20px;">
                                            <table class="table-berita-ttd" style="width: 100%; font-family: 'Times New Roman', Times, serif !important; font-size: 11pt; line-height: 1.35; table-layout: fixed; margin-top: 20px;">
                                                <colgroup>
                                                    <col style="width: 30px;">
                                                    <col style="width: 140px;">
                                                    <col style="width: 15px;">
                                                    <col style="width: 220px;">
                                                    <col style="width: 200px;">
                                                </colgroup>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th style="text-align: center">TTD</th>
                                                </tr>
                                                <tr>
                                                    <td style="width: 30px;">1.</td>
                                                    <td>Pengawas 1</td>
                                                    <td style="text-align: center;">:</td>
                                                    <td class="editable bg-gray-light" id="edit-pengawas1">_________________________</td>
                                                    <td style="padding-left: 20px" rowspan="2">1. _________________________</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <span class="lbl-nip-p1">NIP</span>
                                                    </td>
                                                    <td style="text-align: center;">:</td>
                                                    <td class="editable bg-gray-light">_________________________</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-top: 12px">2.</td>
                                                    <td style="padding-top: 12px">Pengawas 2</td>
                                                    <td style="padding-top: 12px; text-align: center;">:</td>
                                                    <td style="padding-top: 12px" class="editable bg-gray-light" id="edit-pengawas2">_________________________</td>
                                                    <td style="padding-left: 20px" rowspan="2">2. _________________________</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <span class="lbl-nip-p2">NIP</span>
                                                    </td>
                                                    <td style="text-align: center;">:</td>
                                                    <td class="editable bg-gray-light">_________________________</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-top: 12px">3.</td>
                                                    <td style="padding-top: 12px">
                                                        <?= esc($kepsekLabel) ?>
                                                    </td>
                                                    <td style="padding-top: 12px; text-align: center;">:</td>
                                                    <td style="padding-top: 12px"
                                                        class="editable bg-gray-light"><?= isset($kop->kepsek) && $kop->kepsek != '' ? $kop->kepsek : '_________________________' ?></td>
                                                    <td style="padding-left: 20px" rowspan="2">3. _________________________</td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <?= esc($setting->label_nip ?? 'NIP') ?>
                                                    </td>
                                                    <td style="text-align: center;">:</td>
                                                    <td class="editable bg-gray-light"><?= isset($kop->nip) && $kop->nip != '' ? $kop->nip : '_________________________' ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overlay d-none" id="loading">
                    <div class="spinner-grow"></div>
                </div>
            </div>

            <div id="all-print-preview" class="m-4 d-none"></div>
        </div>
    </section>
</div>

<style>
@page {
    size: A4 portrait;
    margin: 0mm;
}
#print-preview, #print-preview *,
#all-print-preview, #all-print-preview *,
.page-print, .page-print *,
table.table-berita-info, table.table-berita-info *,
table.table-berita-ttd, table.table-berita-ttd *,
.judul-daftar-hadir, .judul-daftar-hadir * {
    font-family: 'Times New Roman', Times, serif !important;
}
table.table-berita-info td,
table.table-berita-ttd th,
table.table-berita-ttd td {
    white-space: normal !important;
    font-family: 'Times New Roman', Times, serif !important;
    font-size: 11pt;
    line-height: 1.35;
    padding-top: 2px;
    padding-bottom: 2px;
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
    table {
        width: 100% !important;
        border-collapse: collapse !important;
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

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/app/js/cetak-area.js') ?>?v=<?= @filemtime(FCPATH . 'assets/app/js/cetak-area.js') ?: time() ?>"></script>
<script src="<?= base_url('assets/app/js/html-docx.js') ?>"></script>
<script src="<?= base_url('assets/app/js/convert-area.js') ?>"></script>
<script src="<?= base_url('assets/app/js/FileSaver.min.js') ?>"></script>
<script src="<?= base_url('assets/app/js/jquery.wordexport.js') ?>"></script>

<script>
    (function($) {
        // --- 1. KONFIGURASI DAN STATE ---
        const config = {
            baseUrl: "<?= rtrim(base_url(), '/') ?>/",
            kepsekLabel: <?= json_encode($kepsekLabel ?? 'Kepala Sekolah') ?>,
            labelNipKepsek: <?= json_encode($setting->label_nip ?? 'NIP') ?>,
            kop: {
                kepsek: <?= json_encode(isset($kop->kepsek) && $kop->kepsek != "" ? $kop->kepsek : "_________________________") ?>,
                nip: <?= json_encode(isset($kop->nip) && $kop->nip != "" ? $kop->nip : "_________________________") ?>,
                header1: <?= json_encode($kop->header_1 ?? "") ?>,
                header2: <?= json_encode($kop->header_2 ?? "") ?>,
                header3: <?= json_encode($kop->header_3 ?? "") ?>,
                header4: <?= json_encode($kop->header_4 ?? "") ?>
            },
            images: {
                logoLeft: "<?= !empty($kop->logo_kiri) ? (strpos($kop->logo_kiri, 'http') === 0 ? $kop->logo_kiri : rtrim(base_url(), '/') . '/' . ltrim($kop->logo_kiri, '/')) : '' ?>",
                logoRight: "<?= !empty($kop->logo_kanan) ? (strpos($kop->logo_kanan, 'http') === 0 ? $kop->logo_kanan : rtrim(base_url(), '/') . '/' . ltrim($kop->logo_kanan, '/')) : '' ?>",
                headerKop: "<?= !empty($kop->header_kop) ? (strpos($kop->header_kop, 'http') === 0 ? $kop->header_kop : rtrim(base_url(), '/') . '/' . ltrim($kop->header_kop, '/')) : '' ?>"
            },
            kopMode: <?= json_encode($kop->kop_mode ?? '0') ?>,
            kopAbsensi: <?= json_encode($kop_absensi ?? null) ?>,
            smtActive: <?= json_encode(strtoupper($smt_active->smt ?? 'GANJIL')) ?>,
            tpActive: <?= json_encode($tp_active->tahun ?? '2026/2027') ?>,
            allJadwal: JSON.parse(JSON.stringify(<?= json_encode($jadwal ?? []) ?>))
        };

        let state = {
            printBy: 1, // 1 = Ruang, 2 = Kelas
            currJadwal: [],
            arrSiswa: [],
            info: null
        };

        // CI4 JSON sering mengembalikan ID sebagai number; .includes() / === gagal jika tipe beda.
        const eqId = (a, b) => String(a ?? '') === String(b ?? '');
        const hasId = (arr, id) => Array.isArray(arr) && arr.some((x) => eqId(x, id));
        const resolveSiswaList = (group, allSiswa) => {
            if (Array.isArray(group?.siswaRuang) && group.siswaRuang.length) {
                return group.siswaRuang.slice();
            }
            if (Array.isArray(group?.siswa) && group.siswa.length) {
                return group.siswa.slice();
            }
            if (Array.isArray(group?.ids_siswa) && Array.isArray(allSiswa)) {
                return allSiswa.filter((e) => hasId(group.ids_siswa, e.id_siswa));
            }
            if (Array.isArray(group?.ruang_sesi?.ids_siswa) && Array.isArray(allSiswa)) {
                return allSiswa.filter((e) => hasId(group.ruang_sesi.ids_siswa, e.id_siswa));
            }
            return Array.isArray(allSiswa) ? allSiswa.slice() : [];
        };

        const DOM = {
            opsiMapel: $("#mapel"),
            opsiJadwal: $("#mapel-jadwal"),
            opsiRuang: $("#ruang"),
            opsiSesi: $("#sesi"),
            opsiKelas: $("#kelas"),
            opsiTgl: $('#select-tgl'),
            mplTgl: $('#mapel-tgl'),
            empty: $('#empty-jadwal'),
            loadingPage: $('#loading-page'),
            infoPage: $('#info-page'),
            allPrintPreview: $('#all-print-preview')
        };

        // --- 2. HELPER FUNCTIONS ---

        function handleNull(value) {
            return (value == null || value == "0" || value == "") ? "-" : value;
        }

        function handleTanggal(tgl) {
            const hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
            const bulans = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

            if (handleNull(tgl) !== "-") {
                const d = new Date(tgl);
                return {
                    HARI: hari[d.getDay()],
                    TANGGAL: d.getDate(),
                    BULAN: bulans[d.getMonth()],
                    TAHUN: d.getFullYear(),
                }
            }
            return null;
        }

        function formatTanggal(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
        }

        // Helper untuk membuat elemen DOM agar tidak terlalu verbose
        function createEl(tag, options = {}) {
            const el = document.createElement(tag);
            if (options.className) el.className = options.className;
            if (options.style) Object.assign(el.style, options.style);
            if (options.text) el.textContent = options.text;
            if (options.html) el.innerHTML = options.html;
            if (options.props) Object.keys(options.props).forEach(key => el[key] = options.props[key]);
            return el;
        }

        // --- 3. LOGIKA UTAMA ---
        function populateBeritaAcara(data) {
            DOM.allPrintPreview.html('');
            const kop = data.kop.kop_berita;
            const alokasiSesi = alokasiJam(data, true);
            let allPages = 0;

            for (const key in alokasiSesi) {
                for (const group of alokasiSesi[key]) {
                    const cardWrapper = createEl('div', {
                        className: 'print-card-wrapper border my-shadow mb-3 p-4 bg-white'
                    });
                    const pageContainer = createEl('div', {
                        className: 'page-print',
                        style: { width: "100%", maxWidth: "195mm", margin: "0 auto", minHeight: "297mm", fontFamily: "'Times New Roman'", boxSizing: "border-box", padding: "0 5px" }
                    });
                    cardWrapper.appendChild(pageContainer);

                    // 1. Header Section
                    pageContainer.appendChild(createHeaderSection(kop));

                    // 2. Content Paragraph
                    const tgl = handleTanggal(group.jadwal.tgl_mulai);
                    const paragraph = createEl('div', {
                        style: { marginBottom: "12px", textAlign: "justify", fontFamily: "'Times New Roman'" },
                        html: `Pada hari ini <b>${tgl?.HARI}</b> tanggal <b>${tgl?.TANGGAL}</b> bulan <b>${tgl?.BULAN}</b> tahun <b>${tgl?.TAHUN}</b>
                        telah diselenggarakan <b>${group.jadwal.nama_jenis}</b> untuk Mata Pelajaran <b>${group.jadwal.nama_mapel}</b>
                        dari pukul <b>${group.dari}</b> sampai dengan pukul <b>${group.sampai}</b>`
                    });
                    pageContainer.appendChild(paragraph);

                    // 3. Data Table
                    const all_siswa_ruang = resolveSiswaList(group, data.siswa);
                    pageContainer.appendChild(createInfoTable(kop, group, all_siswa_ruang));

                    // 4. Signature Table
                    pageContainer.appendChild(createSignatureTable(group, kop));

                    if (allPages > 0) {
                        const pb = createEl('div', { style: { pageBreakAfter: 'always', breakAfter: 'page' } });
                        DOM.allPrintPreview.append(pb);
                    }
                    DOM.allPrintPreview.append(cardWrapper);
                    allPages++;
                }
            }

            DOM.loadingPage.addClass('d-none');
            DOM.infoPage.removeClass('d-none');
            DOM.infoPage.text(`${allPages} Halaman`);
            document.title = 'Berita Acara ' + DOM.opsiMapel.find('option:selected').text() + '.pdf';
        }

        const getJudulHtml = (rawText) => {
            let text = (rawText && String(rawText).trim() !== '') ? String(rawText).trim() : '';
            if (!text || text === 'BERITA ACARA PELAKSANAAN' || text === 'BERITA ACARA') {
                text = `BERITA ACARA PELAKSANAAN\nASESMEN SUMATIF TENGAH SEMESTER ${config.smtActive}\nTAHUN AJARAN ${config.tpActive}`;
            }
            const lines = text.split('\n').map(l => l.trim()).filter(l => l.length > 0);
            return `
                <div class="judul-daftar-hadir" style="text-align: center; font-family: 'Times New Roman', serif !important; font-weight: bold !important; margin-top: 6px; margin-bottom: 10px; line-height: 1.3;">
                    ${lines.map((line, idx) => {
                        const fontSize = (idx === 0) ? '12pt' : '11pt';
                        return `<div style="font-size: ${fontSize}; font-family: 'Times New Roman', serif !important; font-weight: bold !important; letter-spacing: 0.5px;">${line}</div>`;
                    }).join('')}
                </div>
            `;
        };

        function createHeaderSection(kop) {
            const container = createEl('div');
            const kopImg = config.images.headerKop;
            const kopMode = config.kopMode;

            if (kopMode === '1' && kopImg) {
                const imgWrap = createEl('div', { style: { width: "100%", margin: "0 0 6px 0", padding: "0", textAlign: "center" } });
                const img = createEl('img', {
                    props: { src: kopImg, alt: "kop" },
                    style: { width: "100%", height: "auto", display: "block", margin: "0 auto", padding: "0" }
                });
                img.className = 'kop-img';
                imgWrap.appendChild(img);
                container.appendChild(imgWrap);

                const judulWrap = createEl('div');
                judulWrap.innerHTML = getJudulHtml(config.kop.header3 || kop?.header_3);
                container.appendChild(judulWrap);
                return container;
            }

            const table = createEl('table', { style: { width: "100%", border: "0", tableLayout: "fixed" } });
            const colgroup = createEl('colgroup');
            colgroup.appendChild(createEl('col', { style: { width: "15%" } }));
            colgroup.appendChild(createEl('col', { style: { width: "70%" } }));
            colgroup.appendChild(createEl('col', { style: { width: "15%" } }));
            table.appendChild(colgroup);

            const row = createEl('tr');

            const createLogoTd = (src) => {
                const td = createEl('td', { style: { width: "15%" } });
                if (src && String(src).trim()) {
                    const fullSrc = String(src).startsWith('http') ? src : (config.baseUrl + String(src).replace(/^\/+/, ''));
                    const img = createEl('img', {
                        props: { src: fullSrc, alt: "logo" },
                        style: { width: "85px", height: "85px", margin: "6px" }
                    });
                    img.onerror = function() { this.style.display = 'none'; };
                    td.appendChild(img);
                }
                return td;
            };

            const centerTd = createEl('td', { style: { width: "70%", textAlign: "center" } });
            centerTd.appendChild(createEl('div', {
                style: { lineHeight: "1.1", fontFamily: "'Times New Roman'", fontSize: "14pt" },
                text: kop?.header_1 || config.kop.header1 || ''
            }));
            centerTd.appendChild(createEl('div', {
                style: { lineHeight: "1.1", fontFamily: "'Times New Roman'", fontSize: "16pt", fontWeight: "bold" },
                text: kop?.header_2 || config.kop.header2 || ''
            }));

            const judulWrap = createEl('div');
            judulWrap.innerHTML = getJudulHtml(kop?.header_3 || config.kop.header3);
            centerTd.appendChild(judulWrap);

            centerTd.appendChild(createEl('div', {
                style: { lineHeight: "1.2", fontFamily: "'Times New Roman'", fontSize: "12pt" },
                text: kop?.header_4 || config.kop.header4 || ''
            }));

            row.appendChild(createLogoTd(kop?.logo_kiri || config.images.logoLeft));
            row.appendChild(centerTd);
            row.appendChild(createLogoTd(kop?.logo_kanan || config.images.logoRight));
            table.appendChild(row);

            container.appendChild(table);
            container.appendChild(createEl('hr', { style: { border: "1px solid", marginBottom: "10px" } }));
            return container;
        }

        function createInfoTable(kop, group, siswaList) {
            const table = createEl('table', {
                className: 'table-berita-info',
                style: { width: "100%", fontFamily: "'Times New Roman'", tableLayout: "fixed" }
            });

            const colgroup = createEl('colgroup');
            colgroup.appendChild(createEl('col', { style: { width: "30px" } }));
            colgroup.appendChild(createEl('col', { style: { width: "230px" } }));
            colgroup.appendChild(createEl('col', { style: { width: "15px" } }));
            colgroup.appendChild(createEl('col', { style: { width: "auto" } }));
            table.appendChild(colgroup);

            // Helper untuk baris data sederhana
            const addRow = (num, label, content) => {
                const tr = createEl('tr');
                tr.appendChild(createEl('td', { style: { width: "30px" }, text: num }));
                tr.appendChild(createEl('td', { style: { width: "230px" }, text: label }));
                tr.appendChild(createEl('td', { style: { width: "15px", textAlign: "center" }, text: ":" }));
                tr.appendChild(createEl('td', { text: content }));
                table.appendChild(tr);
            };

            addRow("1.", "Pada Sekolah/Madrasah", kop?.sekolah || 'Nama Sekolah');
            addRow("", "Ruang", group.nama_ruang);
            addRow("", "Sesi", group.nama_sesi);
            addRow("", "Jumlah Peserta Seharusnya", siswaList.length);
            addRow("", "Jumlah Peserta Hadir", ".................................................................");
            addRow("", "Jumlah Peserta Tidak Hadir", ".................................................................");
            addRow("", "Nomor Peserta Tidak Hadir", ".................................................................");

            // Baris Catatan
            const noteRow = createEl('tr');
            noteRow.appendChild(createEl('td', { style: { paddingTop: "12px" }, text: "2." }));
            noteRow.appendChild(createEl('td', {
                props: { colSpan: "3" },
                style: { paddingTop: "12px" },
                html: `Catatan selama <b>${group.jadwal.nama_jenis}</b> berlangsung :`
            }));
            table.appendChild(noteRow);

            const noteRow2 = createEl('tr');
            noteRow2.appendChild(createEl('td')); // Kosong
            const noteCell = createEl('td', {
                props: { colSpan: "3" },
                style: { height: "100px", border: "1px solid black", padding: "12px" }
            });
            noteRow2.appendChild(noteCell);
            table.appendChild(noteRow2);

            return table;
        }

        function createSignatureTable(group, kop) {
            const table = createEl('table', {
                className: 'table-berita-ttd',
                style: { width: "100%", fontFamily: "'Times New Roman'", marginTop: "20px", tableLayout: "fixed" }
            });

            const colgroup = createEl('colgroup');
            colgroup.appendChild(createEl('col', { style: { width: "30px" } }));
            colgroup.appendChild(createEl('col', { style: { width: "140px" } }));
            colgroup.appendChild(createEl('col', { style: { width: "15px" } }));
            colgroup.appendChild(createEl('col', { style: { width: "220px" } }));
            colgroup.appendChild(createEl('col', { style: { width: "200px" } }));
            table.appendChild(colgroup);

            // Header TTD
            const headRow = createEl('tr');
            for (let i = 0; i < 5; i++) {
                const th = createEl('th', {
                    text: (i === 4 ? "TTD" : ""),
                    style: { textAlign: i === 4 ? "center" : "left" }
                });
                headRow.appendChild(th);
            }
            table.appendChild(headRow);

            const p_arr = group.pengawas || [];
            let data = [
                { label: "Pengawas 1", val: p_arr[0]?.nama_guru || '_________________________', nip: p_arr[0]?.nip || '_________________________', jenis_nip: p_arr[0]?.jenis_nip || 'NIP', id: "1." },
            ];

            if (p_arr[1]?.nama_guru) {
                data.push({ label: "Pengawas 2", val: p_arr[1].nama_guru, nip: p_arr[1].nip || '_________________________', jenis_nip: p_arr[1]?.jenis_nip || 'NIP', id: "2." });
            } else {
                data.push({ label: "Pengawas 2", val: '_________________________', nip: '_________________________', jenis_nip: 'NIP', id: "2." });
            }

            data.push({ label: config.kepsekLabel || "Kepala Sekolah", val: kop?.kepsek || "_________________________", nip: kop?.nip || "_________________________", jenis_nip: config.labelNipKepsek || "NIP", id: "3." });

            data.forEach((item, index) => {
                const paddingTop = index === 0 ? "0" : "12px";

                const tr = createEl('tr');
                tr.appendChild(createEl('td', { style: { paddingTop }, text: item.id }));
                tr.appendChild(createEl('td', { style: { paddingTop }, text: item.label }));
                tr.appendChild(createEl('td', { style: { paddingTop, textAlign: "center" }, text: ":" }));
                tr.appendChild(createEl('td', { style: { paddingTop }, text: item.val }));

                const ttdCell = createEl('td', {
                    props: { rowSpan: 2 },
                    style: { paddingLeft: '20px' },
                    text: `${item.id} _________________________`
                });
                tr.appendChild(ttdCell);

                table.appendChild(tr);

                // Baris NIP
                const nipTr = createEl('tr');
                nipTr.appendChild(createEl('td')); // No
                nipTr.appendChild(createEl('td', { text: item.jenis_nip || "NIP" }));
                nipTr.appendChild(createEl('td', { style: { textAlign: "center" }, text: ":" }));
                nipTr.appendChild(createEl('td', { text: item.nip }));
                table.appendChild(nipTr);
            });

            return table;
        }

        // --- 4. AJAX & DATA FETCHING ---
        function loadDataPeserta(type, idKelas, idRuang, idSesi, idMapel) {
            const isRuang = type === 'ruang';
            const url = config.baseUrl + (isRuang ? "cbtcetak/getruang" : "cbtcetak/getkelas");

            if ((!isRuang && !idKelas) || (isRuang && !idRuang) || !idSesi || !idMapel) return;

            $('#loading').removeClass('d-none');
            DOM.empty.addClass('d-none');
            DOM.opsiTgl.addClass('d-none');
            DOM.mplTgl.html('');

            const params = isRuang
                ? `?ruang=${idRuang}&sesi=${idSesi}&mapel=${idMapel}`
                : `?kelas=${idKelas}&sesi=${idSesi}&mapel=${idMapel}`;

            $.ajax({
                type: "GET",
                url: url + params,
                success: function (response) {
                    state.info = response.info;
                    state.arrSiswa = response.siswa;
                    $('#loading').addClass('d-none');

                    const sesi = response.info.sesi;
                    const ruang = response.info.ruang;
                    const kelas = response.info.kelas;

                    const alokasiJadwal = alokasiJam(response, false);
                    state.currJadwal = []; // Reset current jadwal

                    // Cari jadwal yang cocok
                    for (const tanggal in alokasiJadwal) {
                        const arrJadwal = alokasiJadwal[tanggal];
                        for (const jadwal of arrJadwal) {
                            let match = false;
                            if (isRuang) {
                                match = eqId(jadwal.id_mapel, response.info.mapel) &&
                                    eqId(jadwal.sesi_id, sesi.id_sesi) &&
                                    eqId(jadwal.ruang_id, ruang.id_ruang);
                            } else {
                                match = hasId(jadwal.kelas_id, kelas.id_kelas) &&
                                    eqId(jadwal.id_mapel, response.info.mapel) &&
                                    eqId(jadwal.sesi_id, sesi.id_sesi);
                            }

                            if (match) {
                                const found = state.currJadwal.find(e =>
                                    eqId(e.id_mapel, jadwal.id_mapel) &&
                                    eqId(e.sesi_id, jadwal.sesi_id) &&
                                    eqId(e.ruang_id, jadwal.ruang_id) &&
                                    e.jadwal.tgl_mulai === jadwal.jadwal.tgl_mulai
                                );
                                if (!found) state.currJadwal.push(jadwal);
                            }
                        }
                    }

                    if (state.currJadwal.length === 0) {
                        const mapelText = DOM.opsiJadwal.find('option:selected').text();
                        const locText = isRuang
                            ? `${ruang.nama_ruang} (${ruang.kode_ruang})`
                            : kelas.nama_kelas;

                        DOM.empty.html(`Tidak ada jadwal <b>${mapelText}</b> untuk ${isRuang ? 'Ruang' : 'Kelas'} <b>${locText}</b> sesi <b>${sesi.nama_sesi}</b>`);
                        DOM.empty.removeClass('d-none');
                        return;
                    }

                    if (state.currJadwal.length > 1) {
                        DOM.opsiTgl.removeClass('d-none');
                        DOM.mplTgl.prepend("<option value='' selected='selected'>Pilih Tanggal</option>");
                        state.currJadwal.forEach(j => {
                            DOM.mplTgl.append(`<option value="${j.jadwal.tgl_mulai}">${formatTanggal(j.jadwal.tgl_mulai)}</option>`);
                        });
                    } else {
                        applyJadwal(state.currJadwal[0]);
                    }
                },
                error: function (xhr) {
                    $('#loading').addClass('d-none');
                    console.error("Error:", xhr.responseText);
                }
            });
        }

        function loadAllSiswaRuang(mapel) {
            if (!mapel) return;
            DOM.loadingPage.removeClass('d-none');
            DOM.infoPage.addClass('d-none');

            setTimeout(function () {
                $.ajax({
                    type: "GET",
                    url: config.baseUrl + "cbtcetak/getalljadwal?mapel=" + mapel,
                    success: function (response) {
                        populateBeritaAcara(response);
                    },
                    error: function (xhr) {
                        DOM.loadingPage.addClass('d-none');
                        DOM.infoPage.removeClass('d-none');
                        DOM.infoPage.text(`Error`);
                        console.error("Error", xhr.responseText);
                    }
                });
            }, 500);
        }

        function loadPreviewData() {
            const ruang = DOM.opsiRuang.val();
            const sesi = DOM.opsiSesi.val();
            const jadwal = DOM.opsiJadwal.val();
            const kelas = DOM.opsiKelas.val();

            if (state.printBy === 1) {
                loadDataPeserta('ruang', null, ruang, sesi, jadwal);
            } else {
                loadDataPeserta('kelas', kelas, null, sesi, jadwal);
            }
        }

        // --- 5. ALGORITMA ALOKASI JAM (Dikumpulkan namun Logika Dipertahankan) ---
        function alokasiJam(data, is_all) {
            const timeToMinutes = (time) => {
                if (!time || !time.includes(':')) return 0;
                const [h, m] = time.split(':').map(Number);
                return h * 60 + m;
            };
            const minutesToTime = (totalMinutes) => {
                const hours = Math.floor(totalMinutes / 60);
                const minutes = totalMinutes % 60;
                return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}`;
            };

            const sesis = Array.isArray(data.all_ruang) ? data.all_ruang : [];
            const results = processAndGroupData(data, is_all);
            const resultsArray = {};

            for (const key in results) {
                resultsArray[key] = [];
                const alokasi = results[key];

                // Jika tidak ada alokasi sama sekali, skip
                if (!alokasi.alokasi || alokasi.alokasi.length === 0) {
                    continue;
                }

                const mapelByJamKe = {};

                // PERUBAHAN: Normalisasi jam_ke di sini sebelum diproses
                alokasi.alokasi.forEach(mapel => {
                    let jamKe = mapel.jam_ke;

                    // Jika jam_ke adalah 0, null, atau string kosong, kita paksa menjadi '1'
                    // Ini agar data tetap muncul di jam pertama.
                    if (!jamKe || jamKe == 0) {
                        jamKe = '1';
                    }

                    if (!mapelByJamKe[jamKe]) {
                        mapelByJamKe[jamKe] = [];
                    }

                    mapelByJamKe[jamKe].push({
                        ...mapel,
                        ...alokasi.ruang_sesi,
                        siswa: alokasi.siswaRuang,
                        // Update jam_ke di object mapel agar sinkron dengan key mapelByJamKe
                        jam_ke: jamKe
                    });
                });

                // Hitung maxJamKe berdasarkan jam_ke yang sudah dinormalisasi
                const jamKeys = Object.keys(mapelByJamKe).map(Number);
                let maxJamKe = jamKeys.length > 0 ? Math.max(...jamKeys) : 1;

                sesis.forEach(sesi => {
                    const totalDuration = timeToMinutes(sesi.waktu_akhir) - timeToMinutes(sesi.waktu_mulai);

                    // Hitung durasi per slot
                    const durationPerSlot = totalDuration / maxJamKe;

                    // Loop dari 1 sampai maxJamKe
                    for (let i = 1; i <= maxJamKe; i++) {
                        const jamKe = String(i);
                        const startMinutes = timeToMinutes(sesi.waktu_mulai) + (i - 1) * durationPerSlot;
                        const start_time = minutesToTime(startMinutes);
                        const end_time = minutesToTime(startMinutes + durationPerSlot);

                        if (mapelByJamKe[jamKe]) {
                            mapelByJamKe[jamKe].forEach(mapel => {
                                const found = resultsArray[key].find(m =>
                                    m.jadwal?.id_jadwal === mapel.jadwal.id_jadwal &&
                                    m?.jam_ke === mapel.jam_ke
                                );

                                if (!found) {
                                    resultsArray[key].push({
                                        ...mapel,
                                        dari: start_time,
                                        sampai: end_time,
                                        durasi: durationPerSlot
                                    });
                                }
                            });
                        }
                    }
                });
            }
            return resultsArray;
        }

        function processAndGroupData(data, is_all) {
            const allSesi = data.all_ruang || [];
            const jsonData = data.all_tgl || [];
            const grouped = {};

            for (const tgl in jsonData) {
                jsonData[tgl].forEach(jadwal => {
                    jadwal.bank_kelas = (jadwal.bank_kelas || []).map(String);
                    const ruangFiltered = allSesi.filter(r => (r.kelas_id || []).some(id => hasId(jadwal.bank_kelas, id)));

                    ruangFiltered.forEach(ruang => {
                        const siswaRuang = data.siswa.filter(s => {
                            if (is_all) {
                                return eqId(s.ruang_id, ruang.ruang_id) && eqId(s.sesi_id, ruang.sesi_id) && hasId(jadwal.bank_kelas, s.id_kelas);
                            } else {
                                if (state.printBy === 2) {
                                    return eqId(s.sesi_id, ruang.sesi_id) && hasId(jadwal.bank_kelas, s.id_kelas);
                                } else {
                                    return eqId(s.ruang_id, ruang.ruang_id) && eqId(s.sesi_id, ruang.sesi_id) && hasId(jadwal.bank_kelas, s.id_kelas);
                                }
                            }
                        });

                        const key = `${tgl}-${ruang.ruang_id}-${ruang.sesi_id}`;
                        if (!grouped[key]) {
                            grouped[key] = { key, ruang_sesi: ruang, siswaRuang, jam_ke: [], id_mapel: [], alokasi: [] };
                        }

                        if (!grouped[key].id_mapel.includes(jadwal.id_mapel)) grouped[key].id_mapel.push(jadwal.id_mapel);

                        const pengawasJadwal = (data.all_pengawas || []).find(p =>
                            eqId(p.id_jadwal, jadwal.id_jadwal) &&
                            eqId(p.id_ruang, ruang.ruang_id) &&
                            eqId(p.id_sesi, ruang.sesi_id)
                        ) || {
                            pengawas: [],
                            jam_ke: jadwal.jam_ke || '1',
                            id_guru: ''
                        };

                        if (!grouped[key].jam_ke.includes(pengawasJadwal.jam_ke)) grouped[key].jam_ke.push(pengawasJadwal.jam_ke);

                        if (!grouped[key].alokasi.find(a => a.id_mapel === jadwal.id_mapel && a.jam_ke === jadwal.jam_ke)) {
                            grouped[key].alokasi.push({ id_mapel: jadwal.id_mapel, nama_mapel: jadwal.nama_mapel, jam_ke: pengawasJadwal.jam_ke, pengawas: pengawasJadwal.pengawas, jadwal });
                        }
                    });
                });
            }
            return grouped;
        }

        // --- 6. LOGIKA UI & EVENT HANDLERS ---
        function applyJadwal(jadwal) {
            if (!jadwal) return;
            const tgl = handleTanggal(jadwal.jadwal?.tgl_mulai || '');
            const all_siswa_ruang = resolveSiswaList(jadwal, state.arrSiswa);

            $('#edit-hari').html('<b>' + tgl.HARI + '</b>');
            $('#edit-tanggal').html('<b>' + tgl.TANGGAL + '</b>');
            $('#edit-bulan').html('<b>' + tgl.BULAN + '</b>');
            $('#edit-tahun').html('<b>' + tgl.TAHUN + '</b>');
            $('#edit-jml-peserta').html('<b>' + all_siswa_ruang.length + '</b>');

            $('#edit-jenis-ujian').html('<b>' + (jadwal.jadwal.nama_jenis || '') + '</b>');
            $('#edit-nama-ujian').html('<b>' + (jadwal.jadwal.nama_jenis || '') + '<b>');
            $('#edit-waktu-mulai').html('<b>' + (jadwal.dari || '') + '</b>');
            $('#edit-waktu-akhir').html('<b>' + (jadwal.sampai || '') + '</b>');
            $('#edit-mapel').html('<b>' + (jadwal.jadwal.nama_mapel || '') + '</b>');
            
            $('#edit-ruang').html('<b>' + (jadwal.nama_ruang || '') + '</b>');
            $('#edit-sesi').html('<b>' + (jadwal.nama_sesi || '') + '</b>');

            // Sinkronisasi Pengawas
            const kop = {
                kepsek: "<?= isset($kop->kepsek) ? $kop->kepsek : '' ?>",
                nip: "<?= isset($kop->nip) ? $kop->nip : '' ?>"
            };
            const sigTable = createSignatureTable(jadwal, kop);
            $('#berita-ttd').empty().append(sigTable);

            document.title = 'Berita Acara ' + jadwal.jadwal.kode + ' ' + $('#edit-ruang').text() + ' ' + $('#edit-sesi').text();
        }

        $(document).ready(function () {
            if (typeof ajaxcsrf === 'function') ajaxcsrf();

            DOM.opsiMapel.prepend("<option value='' selected='selected'>Pilih Mapel</option>");
            DOM.opsiJadwal.prepend("<option value='' selected='selected'>Pilih Jadwal</option>");
            DOM.opsiRuang.prepend("<option value='' selected='selected'>Pilih Ruang</option>");
            DOM.opsiSesi.prepend("<option value='' selected='selected'>Pilih Sesi</option>");
            DOM.opsiKelas.prepend("<option value='' selected='selected'>Pilih Kelas</option>");

            if ($.fn.select2) {
                $('select').select2({ width: '100%', theme: 'bootstrap4' });
            }

            DOM.opsiMapel.change(function() {
                loadAllSiswaRuang($(this).val());
            });
            DOM.opsiJadwal.change(loadPreviewData);
            DOM.opsiSesi.change(loadPreviewData);
            DOM.opsiRuang.change(loadPreviewData);
            DOM.opsiKelas.change(loadPreviewData);

            if (DOM.opsiMapel.val()) {
                loadAllSiswaRuang(DOM.opsiMapel.val());
            }

            DOM.mplTgl.on('change', function() {
                const tgl = $(this).val();
                const jadwalSelected = state.currJadwal.find(e => e.jadwal.tgl_mulai === tgl);
                if (jadwalSelected) {
                    applyJadwal(jadwalSelected);
                } else {
                    DOM.empty.removeClass('d-none').html(`<b>Tidak ada data jadwal...</b>`);
                }
            });

            // 3. Print Buttons
            $("#btn-print-all").click(async function (e) {
                e.preventDefault();
                if (!DOM.opsiMapel.val()) {
                    return Swal.fire({ title: "ERROR", text: "Isi Mapel terlebih dulu", icon: "error" });
                }
                if (!DOM.allPrintPreview.html() || !String(DOM.allPrintPreview.html()).trim()) {
                    return Swal.fire({ title: "ERROR", text: "Dokumen belum siap. Pilih Mapel dan tunggu sampai muncul jumlah halaman.", icon: "error" });
                }
                if (typeof DOM.allPrintPreview.print === 'function') {
                    DOM.allPrintPreview.print(document.title);
                } else {
                    window.print();
                }
            });

            $("#btn-print").click(function (e) {
                e.preventDefault();
                const isEmpty = state.printBy === 2
                    ? (!DOM.opsiKelas.val() || !DOM.opsiSesi.val() || !DOM.opsiJadwal.val())
                    : (!DOM.opsiRuang.val() || !DOM.opsiSesi.val() || !DOM.opsiJadwal.val());

                if (isEmpty) return Swal.fire({ title: "ERROR", text: "Isi semua pilihan terlebih dulu", icon: "error" });
                if (!$('#print-preview').html() || !String($('#print-preview').html()).trim()) {
                    return Swal.fire({ title: "ERROR", text: "Preview kosong. Pilih Ruang/Sesi/Jadwal terlebih dulu.", icon: "error" });
                }

                if (typeof $('#print-preview').print === 'function') {
                    $('#print-preview').print(document.title);
                } else {
                    window.print();
                }
            });

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

            // 5. Submit Kop
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
                    url: '<?= base_url('cbtcetak/savekopberita') ?>',
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function (response) {
                        Swal.fire({
                            title: 'Sukses', text: "Template KOP Berita Acara berhasil disimpan", icon: 'success',
                        }).then(function() { window.location.reload(); });
                    },
                    error: function (xhr) {
                        Swal.fire({ title: "Error", text: "Gagal menyimpan Kop Berita Acara", icon: "error" });
                    }
                });
            });

            // 6. Switcher (Ruang/Kelas)
            $('#selector button').click(function () {
                $(this).addClass('active btn-primary').removeClass('btn-outline-primary').siblings().addClass('btn-outline-primary').removeClass('active btn-primary');

                const isRuangView = $('#by-kelas').is(':hidden');

                if (isRuangView) {
                    $('#by-kelas').removeClass('d-none');
                    $('#by-ruang').addClass('d-none');
                    $('#title-ruang').text('Kelas');
                    state.printBy = 2;
                    loadPreviewData();
                } else {
                    $('#by-kelas').addClass('d-none');
                    $('#by-ruang').removeClass('d-none');
                    $('#title-ruang').text('Ruang');
                    state.printBy = 1;
                    loadPreviewData();
                }
            });
        });

    })(jQuery);

    function exportWord(selector, title) {
        var contentDocument = $(selector).convertToHtmlFile(title, '');
        var content = '<!DOCTYPE html>' + contentDocument.documentElement.outerHTML;
        var converted = htmlDocx.asBlob(content, {
            size: 'A4',
            margins: {top: 720, bottom: 720, left: 720, right: 720}
        });
        saveAs(converted, title + '.docx');
    }
</script>

<?= $this->endSection() ?>
