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
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">Cetak daftar peserta dan foto pelaksanaan ujian CBT.</p>
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
                    <h6 class="card-title mb-0">Setting Kop Peserta Ujian</h6>
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
                                    <textarea class="form-control" name="header_3_img" id="input-judul-img" rows="3" placeholder="DAFTAR PESERTA UJIAN&#10;ASESMEN SUMATIF TENGAH SEMESTER GANJIL&#10;TAHUN AJARAN 2026/2027"><?= (!empty($kop->header_3)) ? esc($kop->header_3) : "DAFTAR PESERTA UJIAN\nASESMEN SUMATIF TENGAH SEMESTER " . strtoupper($smt_active->smt ?? 'GANJIL') . "\nTAHUN AJARAN " . ($tp_active->tahun ?? '2026/2027') ?></textarea>
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
                                    <textarea class="form-control" name="header_3_text" id="input-judul-text" rows="3" placeholder="Header 3"><?= (!empty($kop->header_3)) ? esc($kop->header_3) : "DAFTAR PESERTA UJIAN\nASESMEN SUMATIF TENGAH SEMESTER " . strtoupper($smt_active->smt ?? 'GANJIL') . "\nTAHUN AJARAN " . ($tp_active->tahun ?? '2026/2027') ?></textarea>
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
                        <h6>Cetak</h6>
                    </div>
                    <div class="card-tools">
                        <div id="selector" class="card-tools btn-group">
                            <?php
                            if ($mode == null || $mode == '1') {
                                $bgR = 'btn-primary';
                                $bgK = 'btn-outline-primary';
                            } else {
                                $bgR = 'btn-outline-primary';
                                $bgK = 'btn-primary';
                            }
                            ?>
                            <a href="<?= base_url('cbtcetak/pesertaujian/1') ?>" type="button" class="btn <?= $bgR ?>">By
                                Ruang</a>
                            <a href="<?= base_url('cbtcetak/pesertaujian/2') ?>" type="button" class="btn <?= $bgK ?>">By
                                Kelas</a>
                        </div>

                        <button type="button" class="btn btn-success btn-sm rounded-pill shadow-sm" id="btn-print">
                            <i class="fa fa-print"></i><span class="ml-1">Cetak</span>
                        </button>
                        <button type="button" class="btn btn-primary btn-sm rounded-pill shadow-sm ml-1" onclick="exportWord('#print-preview', 'Daftar Peserta Ujian')">
                            <i class="fa fa-file-word"></i><span class="ml-1">Word</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label>Jenis Ujian</label>
                            <?php
                            echo form_dropdown(
                                'jenis',
                                $ujian,
                                null,
                                'id="jenis" class="form-control"'
                            ); ?>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center bg-gray-light">
                        <div id="print-preview" class="m-2">
                            <?php
                            //echo '<pre>';
                            //print_r($siswa);
                            //echo '</pre>';
                            if ($mode == null || $mode == '1'):
                                foreach ($siswa as $ruang => $sesi):
                                    foreach ($sesi as $ses => $sis):?>
                                        <div class="print-card-wrapper border my-shadow mb-3 p-4 bg-white">
                                            <div class="page-print" style="font-family: 'Times New Roman', serif; min-height: 297mm; justify-content: center; background: white; width: 100%; max-width: 195mm; margin: 0 auto; box-sizing: border-box; padding: 0 5px;">
                                                <?php
                                                $isKopImg = (isset($kop->kop_mode) && $kop->kop_mode === '1' && !empty($kop->header_kop) && file_exists(FCPATH . $kop->header_kop));
                                                $judulLines = array_filter(array_map('trim', explode("\n", $kop->header_3 ?? '')));
                                                if (empty($judulLines)) {
                                                    $judulLines = [
                                                        'DAFTAR PESERTA UJIAN',
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
                                                    <div style="display: flex; justify-content: center; align-items: center;">
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
                                                                        <img src="<?= $logo_kiri_url ?>"
                                                                             onerror="this.style.display='none'"
                                                                             style="width:85px; height:85px; margin: 6px;">
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td style="width:70%; text-align: center;">
                                                                    <div style="line-height: 1.1; font-family: 'Times New Roman'; font-size: 13pt"><?= isset($kop->header_1) ? $kop->header_1 : $kop->sekolah ?></div>
                                                                    <div style="line-height: 1.1; font-family: 'Times New Roman'; font-size: 16pt"><b><?= isset($kop->header_2) ? $kop->header_2 : '' ?></b></div>
                                                                    <div class="judul-daftar-hadir" style="margin-top: 4px; margin-bottom: 4px;">
                                                                        <?php foreach ($judulLines as $idx => $line): ?>
                                                                            <div style="font-size: <?= $idx === 0 ? '12pt' : '11pt' ?>; font-family: 'Times New Roman', serif !important; font-weight: bold !important; letter-spacing: 0.5px;"><?= esc($line) ?></div>
                                                                        <?php endforeach; ?>
                                                                    </div>
                                                                    <div style="line-height: 1.1; font-family: 'Times New Roman'; font-size: 12pt"><?= isset($kop->header_4) ? $kop->header_4 : ('Tahun Pelajaran: ' . $tp_active->tahun) ?></div>
                                                                </td>
                                                                <td style="width:15%;">
                                                                    <?php
                                                                    $logo_kanan = !empty($kop->logo_kanan) ? $kop->logo_kanan : ($setting->logo_kanan ?? '');
                                                                    $logo_kanan_url = !empty($logo_kanan) ? (strpos($logo_kanan, 'http') === 0 ? $logo_kanan : base_url(ltrim($logo_kanan, '/'))) : '';
                                                                    if (!empty($logo_kanan_url)): ?>
                                                                        <img src="<?= $logo_kanan_url ?>"
                                                                             onerror="this.style.display='none'"
                                                                             style="width:85px; height:85px; margin: 6px; border-style: none">
                                                                    <?php endif; ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <hr style="border: 1px solid; margin-bottom: 6px; margin-top: 2px">
                                                <?php endif; ?>
                                                <?php
                                                $se = !empty($sis[0]->kode_sesi) && isset($sesis[$sis[0]->kode_sesi]) ? $sesis[$sis[0]->kode_sesi] : null;
                                                $nama_ruang = !empty($sis[0]->nama_ruang) ? $sis[0]->nama_ruang : ($ruang !== '-' && $ruang !== 'Belum Diatur' ? $ruang : '(Belum Diatur)');
                                                $nama_sesi = !empty($sis[0]->nama_sesi) ? $sis[0]->nama_sesi : ($se->nama_sesi ?? ($ses !== '-' ? $ses : '-'));
                                                $mulai_sesi = !empty($se->waktu_mulai) ? date('H:i', strtotime($se->waktu_mulai)) : '';
                                                $akhir_sesi = !empty($se->waktu_akhir) ? date('H:i', strtotime($se->waktu_akhir)) : '';
                                                $waktu_text = ($mulai_sesi && $akhir_sesi) ? "$mulai_sesi sampai $akhir_sesi" : '-';
                                                ?>
                                                <table class="table-info" style="margin-top: 6px; margin-bottom: 6px; font-family: 'Times New Roman', Times, serif !important; font-size: 10pt; line-height: 1.2;">
                                                    <tr style="line-height: 1.2;">
                                                        <td style="width: 100px; padding: 1px 0;">RUANG</td>
                                                        <td style="width: 15px; padding: 1px 0;"> : </td>
                                                        <td style="padding: 1px 0;"><b><?= $nama_ruang ?></b></td>
                                                    </tr>
                                                    <tr style="line-height: 1.2;">
                                                        <td style="padding: 1px 0;">SESI</td>
                                                        <td style="padding: 1px 0;"> : </td>
                                                        <td style="padding: 1px 0;"><b><?= $nama_sesi ?></b></td>
                                                    </tr>
                                                    <tr style="line-height: 1.2;">
                                                        <td style="padding: 1px 0;">WAKTU</td>
                                                        <td style="padding: 1px 0;"> : </td>
                                                        <td style="padding: 1px 0;"><b><?= $waktu_text ?></b></td>
                                                    </tr>
                                                </table>
                                                <table class="table-siswa" style="width: 100%; border: 1px solid black; border-collapse: collapse; font-size: 9.5pt; margin-top: 6px; table-layout: fixed; font-family: 'Times New Roman', Times, serif !important;">
                                                    <colgroup>
                                                        <col class="col-no" style="width: 5%;">
                                                        <col class="col-nopes" style="width: 18%;">
                                                        <col class="col-nama" style="width: 41%;">
                                                        <col class="col-kelas" style="width: 12%;">
                                                        <col class="col-ruang" style="width: 11%;">
                                                        <col class="col-sesi" style="width: 13%;">
                                                    </colgroup>
                                                    <thead>
                                                    <tr style="height: 28px; font-family: 'Times New Roman', Times, serif !important; font-size: 10pt;">
                                                        <th class="col-no" style="border: 1px solid black; width: 5%; text-align: center; vertical-align: middle;">
                                                            NO
                                                        </th>
                                                        <th class="col-nopes" style="border: 1px solid black; width: 18%; text-align: center; vertical-align: middle;">NO.
                                                            PESERTA
                                                        </th>
                                                        <th class="col-nama" style="border: 1px solid black; width: 41%; text-align: center; vertical-align: middle;">NAMA
                                                            PESERTA
                                                        </th>
                                                        <th class="col-kelas" style="border: 1px solid black; width: 12%; text-align: center; vertical-align: middle;">KELAS
                                                        </th>
                                                        <th class="col-ruang" style="border: 1px solid black; width: 11%; text-align: center; vertical-align: middle;">RUANG
                                                        </th>
                                                        <th class="col-sesi" style="border: 1px solid black; width: 13%; text-align: center; vertical-align: middle;">SESI
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $no = 1;
                                                    foreach ($sis as $s) :?>
                                                        <tr style="font-family: 'Times New Roman', Times, serif !important; font-size: 9.5pt; line-height: 1.15;">
                                                            <td class="col-no" style="border: 1px solid black; text-align: center; padding: 2px 4px; width: 5%; vertical-align: middle;">
                                                                <?= $no ?>
                                                            </td>
                                                            <td class="col-nopes" style="border: 1px solid black; text-align: center; padding: 2px 4px; width: 18%; white-space: nowrap !important; vertical-align: middle;"><?= !empty($s->nomor_peserta) ? $s->nomor_peserta : '-' ?></td>
                                                            <td class="col-nama" style="border: 1px solid black; text-align: left; padding: 2px 6px; width: 41%; vertical-align: middle; white-space: normal !important; word-wrap: break-word !important; overflow-wrap: break-word !important;"><?= $s->nama ?></td>
                                                            <td class="col-kelas" style="border: 1px solid black; text-align: center; padding: 2px 4px; width: 12%; vertical-align: middle; white-space: normal !important; word-wrap: break-word !important; overflow-wrap: break-word !important;"><?= !empty($s->nama_kelas) ? $s->nama_kelas : '-' ?></td>
                                                            <td class="col-ruang" style="border: 1px solid black; text-align: center; padding: 2px 4px; width: 11%; vertical-align: middle; white-space: normal !important; word-wrap: break-word !important; overflow-wrap: break-word !important;"><?= !empty($s->nama_ruang) ? $s->nama_ruang : '-' ?></td>
                                                            <td class="col-sesi" style="border: 1px solid black; text-align: center; padding: 2px 4px; width: 13%; vertical-align: middle; white-space: normal !important; word-wrap: break-word !important; overflow-wrap: break-word !important;"><?= !empty($s->nama_sesi) ? $s->nama_sesi : '-' ?></td>
                                                        </tr>
                                                        <?php $no++; endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div style="page-break-after: always"></div>
                                    <?php endforeach; ?>
                                <?php endforeach;
                            else:
                                foreach ($siswa as $kelas => $sis): ?>
                                    <div class="print-card-wrapper border my-shadow mb-3 p-4 bg-white">
                                        <div class="page-print" style="font-family: 'Times New Roman', serif; min-height: 297mm; justify-content: center; background: white; width: 100%; max-width: 195mm; margin: 0 auto; box-sizing: border-box; padding: 0 5px;">
                                            <?php
                                            $isKopImg = (isset($kop->kop_mode) && $kop->kop_mode === '1' && !empty($kop->header_kop) && file_exists(FCPATH . $kop->header_kop));
                                            $judulLines = array_filter(array_map('trim', explode("\n", $kop->header_3 ?? '')));
                                            if (empty($judulLines)) {
                                                $judulLines = [
                                                    'DAFTAR PESERTA UJIAN',
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
                                                <div style="display: flex; justify-content: center; align-items: center;">
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
                                                                    <img src="<?= $logo_kiri_url ?>"
                                                                         onerror="this.style.display='none'"
                                                                         style="width:85px; height:85px; margin: 6px;">
                                                                <?php endif; ?>
                                                            </td>
                                                            <td style="width:70%; text-align: center;">
                                                                <div style="line-height: 1.1; font-family: 'Times New Roman'; font-size: 13pt"><?= isset($kop->header_1) ? $kop->header_1 : $kop->sekolah ?></div>
                                                                <div style="line-height: 1.1; font-family: 'Times New Roman'; font-size: 16pt"><b><?= isset($kop->header_2) ? $kop->header_2 : '' ?></b></div>
                                                                <div class="judul-daftar-hadir" style="margin-top: 4px; margin-bottom: 4px;">
                                                                    <?php foreach ($judulLines as $idx => $line): ?>
                                                                        <div style="font-size: <?= $idx === 0 ? '12pt' : '11pt' ?>; font-family: 'Times New Roman', serif !important; font-weight: bold !important; letter-spacing: 0.5px;"><?= esc($line) ?></div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                                <div style="line-height: 1.1; font-family: 'Times New Roman'; font-size: 12pt"><?= isset($kop->header_4) ? $kop->header_4 : ('Tahun Pelajaran: ' . $tp_active->tahun) ?></div>
                                                            </td>
                                                            <td style="width:15%;">
                                                                <?php
                                                                $logo_kanan = !empty($kop->logo_kanan) ? $kop->logo_kanan : ($setting->logo_kanan ?? '');
                                                                $logo_kanan_url = !empty($logo_kanan) ? (strpos($logo_kanan, 'http') === 0 ? $logo_kanan : base_url(ltrim($logo_kanan, '/'))) : '';
                                                                if (!empty($logo_kanan_url)): ?>
                                                                    <img src="<?= $logo_kanan_url ?>"
                                                                         onerror="this.style.display='none'"
                                                                         style="width:85px; height:85px; margin: 6px; border-style: none">
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <hr style="border: 1px solid; margin-bottom: 6px; margin-top: 2px">
                                            <?php endif; ?>
                                            <table class="table-info" style="margin-top: 6px; margin-bottom: 6px; font-family: 'Times New Roman', Times, serif !important; font-size: 10pt; line-height: 1.2;">
                                                <tr style="line-height: 1.2;">
                                                    <td style="width: 100px; padding: 1px 0;">Kelas</td>
                                                    <td style="width: 15px; padding: 1px 0;"> :</td>
                                                    <td style="padding: 1px 0;"> <b><?= !empty($sis[0]->nama_kelas) ? $sis[0]->nama_kelas : '-' ?></b></td>
                                                </tr>
                                                <?php foreach ($sesis as $sss) : ?>
                                                    <tr style="line-height: 1.2;">
                                                        <td style="padding: 1px 0;"><?= $sss->nama_sesi ?></td>
                                                        <td style="padding: 1px 0;"> :</td>
                                                        <td style="padding: 1px 0;">
                                                            <?php
                                                            $sm = !empty($sss->waktu_mulai) ? date('H:i', strtotime($sss->waktu_mulai)) : '';
                                                            $sa = !empty($sss->waktu_akhir) ? date('H:i', strtotime($sss->waktu_akhir)) : '';
                                                            echo ($sm && $sa) ? "$sm sampai $sa" : '-';
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </table>
                                            <table class="table-siswa" style="width: 100%; border: 1px solid black; border-collapse: collapse; font-size: 9.5pt; margin-top: 6px; table-layout: fixed; font-family: 'Times New Roman', Times, serif !important;">
                                                <colgroup>
                                                    <col class="col-no" style="width: 5%;">
                                                    <col class="col-nopes" style="width: 18%;">
                                                    <col class="col-nama" style="width: 41%;">
                                                    <col class="col-kelas" style="width: 12%;">
                                                    <col class="col-ruang" style="width: 11%;">
                                                    <col class="col-sesi" style="width: 13%;">
                                                </colgroup>
                                                <thead>
                                                <tr style="height: 28px; font-family: 'Times New Roman', Times, serif !important; font-size: 10pt;">
                                                    <th class="col-no" style="border: 1px solid black; width: 5%; text-align: center; vertical-align: middle;">
                                                        NO
                                                    </th>
                                                    <th class="col-nopes" style="border: 1px solid black; width: 18%; text-align: center; vertical-align: middle;">NO.
                                                        PESERTA
                                                    </th>
                                                    <th class="col-nama" style="border: 1px solid black; width: 41%; text-align: center; vertical-align: middle;">NAMA
                                                        PESERTA
                                                    </th>
                                                    <th class="col-kelas" style="border: 1px solid black; width: 12%; text-align: center; vertical-align: middle;">KELAS
                                                    </th>
                                                    <th class="col-ruang" style="border: 1px solid black; width: 11%; text-align: center; vertical-align: middle;">RUANG
                                                    </th>
                                                    <th class="col-sesi" style="border: 1px solid black; width: 13%; text-align: center; vertical-align: middle;">SESI
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $no = 1;
                                                foreach ($sis as $s) :?>
                                                    <tr style="font-family: 'Times New Roman', Times, serif !important; font-size: 9.5pt; line-height: 1.15;">
                                                        <td class="col-no" style="border: 1px solid black; text-align: center; padding: 2px 4px; width: 5%; vertical-align: middle;"><?= $no ?></td>
                                                        <td class="col-nopes" style="border: 1px solid black; text-align: center; padding: 2px 4px; width: 18%; white-space: nowrap !important; vertical-align: middle;"><?= !empty($s->nomor_peserta) ? $s->nomor_peserta : '-' ?></td>
                                                        <td class="col-nama" style="border: 1px solid black; text-align: left; padding: 2px 6px; width: 41%; vertical-align: middle; white-space: normal !important; word-wrap: break-word !important; overflow-wrap: break-word !important;"><?= $s->nama ?></td>
                                                        <td class="col-kelas" style="border: 1px solid black; text-align: center; padding: 2px 4px; width: 12%; vertical-align: middle; white-space: normal !important; word-wrap: break-word !important; overflow-wrap: break-word !important;"><?= !empty($s->nama_kelas) ? $s->nama_kelas : '-' ?></td>
                                                        <td class="col-ruang" style="border: 1px solid black; text-align: center; padding: 2px 4px; width: 11%; vertical-align: middle; white-space: normal !important; word-wrap: break-word !important; overflow-wrap: break-word !important;"><?= !empty($s->nama_ruang) ? $s->nama_ruang : '-' ?></td>
                                                        <td class="col-sesi" style="border: 1px solid black; text-align: center; padding: 2px 4px; width: 13%; vertical-align: middle; white-space: normal !important; word-wrap: break-word !important; overflow-wrap: break-word !important;"><?= !empty($s->nama_sesi) ? $s->nama_sesi : '-' ?></td>
                                                    </tr>
                                                    <?php $no++; endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div style="page-break-after: always"></div>
                                <?php endforeach; endif; ?>
                        </div>
                    </div>
                    <div class="overlay d-none" id="loading">
                        <div class="spinner-grow"></div>
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
table.table-siswa, table.table-siswa *,
table.table-info, table.table-info *,
.judul-daftar-hadir, .judul-daftar-hadir * {
    font-family: 'Times New Roman', Times, serif !important;
}

table.table-siswa {
    width: 100% !important;
    table-layout: fixed !important;
    border-collapse: collapse !important;
    margin-top: 6px !important;
}
table.table-siswa th, table.table-siswa td {
    border: 1px solid black !important;
    vertical-align: middle !important;
    box-sizing: border-box !important;
    white-space: normal !important;
    word-wrap: break-word !important;
    overflow-wrap: break-word !important;
    font-family: 'Times New Roman', Times, serif !important;
}
table.table-siswa th {
    background-color: transparent !important;
    font-weight: bold !important;
    text-align: center !important;
    font-size: 10pt !important;
    height: 28px !important;
    padding: 4px 4px !important;
}
table.table-siswa td {
    padding: 2px 5px !important;
    font-size: 9.5pt !important;
    line-height: 1.15 !important;
    height: auto !important;
}
table.table-siswa .col-no {
    width: 5% !important;
    max-width: 5% !important;
    text-align: center !important;
}
table.table-siswa .col-nopes {
    width: 18% !important;
    max-width: 18% !important;
    text-align: center !important;
    white-space: nowrap !important;
}
table.table-siswa .col-nama {
    width: 41% !important;
    max-width: 41% !important;
    text-align: left !important;
    padding-left: 6px !important;
    padding-right: 6px !important;
}
table.table-siswa .col-kelas {
    width: 12% !important;
    max-width: 12% !important;
    text-align: center !important;
}
table.table-siswa .col-ruang {
    width: 11% !important;
    max-width: 11% !important;
    text-align: center !important;
}
table.table-siswa .col-sesi {
    width: 13% !important;
    max-width: 13% !important;
    text-align: center !important;
    white-space: normal !important;
    word-wrap: break-word !important;
    overflow-wrap: break-word !important;
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
    table.table-siswa {
        width: 100% !important;
        table-layout: fixed !important;
        border-collapse: collapse !important;
    }
    table.table-siswa th {
        background-color: transparent !important;
        height: 28px !important;
        padding: 4px 4px !important;
        font-size: 10pt !important;
    }
    table.table-siswa td {
        padding: 2px 5px !important;
        font-size: 9.5pt !important;
        line-height: 1.15 !important;
        height: auto !important;
    }
    table.table-siswa .col-no {
        width: 5% !important;
        text-align: center !important;
    }
    table.table-siswa .col-nopes {
        width: 18% !important;
        text-align: center !important;
        white-space: nowrap !important;
    }
    table.table-siswa .col-nama {
        width: 41% !important;
        text-align: left !important;
        padding-left: 6px !important;
        padding-right: 6px !important;
    }
    table.table-siswa .col-kelas {
        width: 12% !important;
        text-align: center !important;
    }
    table.table-siswa .col-ruang {
        width: 11% !important;
        text-align: center !important;
    }
    table.table-siswa .col-sesi {
        width: 13% !important;
        text-align: center !important;
        white-space: normal !important;
        word-wrap: break-word !important;
        overflow-wrap: break-word !important;
    }
    table.table-info {
        width: 100% !important;
        table-layout: auto !important;
        border-collapse: collapse !important;
    }
    .judul-daftar-hadir, .judul-daftar-hadir div {
        font-family: 'Times New Roman', serif !important;
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

<script src="<?= rtrim(base_url(), '/') ?>/assets/app/js/cetak-area.js?v=<?= @filemtime(FCPATH . 'assets/app/js/cetak-area.js') ?: time() ?>"></script>
<script src="<?= rtrim(base_url(), '/') ?>/assets/app/js/html-docx.js"></script>
<script src="<?= rtrim(base_url(), '/') ?>/assets/app/js/convert-area.js"></script>
<script src="<?= rtrim(base_url(), '/') ?>/assets/app/js/FileSaver.min.js"></script>
<script src="<?= rtrim(base_url(), '/') ?>/assets/app/js/jquery.wordexport.js"></script>
<script>
    var logoKanan = "<?= isset($kop->logo_kiri) ? base_url() . $kop->logo_kiri : "" ?>";
    var logoKiri = "<?= isset($kop->logo_kanan) ? base_url() . $kop->logo_kanan : ""?>";
    var sklh = "<?= isset($kop->sekolah) ? $kop->sekolah : "" ?>";

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

        // Submit Kop Peserta Ujian
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
                url: '<?= base_url('cbtcetak/savekoppeserta') ?>',
                type: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function (response) {
                    Swal.fire({
                        title: 'Sukses', text: "Template KOP Peserta Ujian berhasil disimpan", icon: 'success',
                    }).then(function() { window.location.reload(); });
                },
                error: function (xhr) {
                    Swal.fire({ title: "Error", text: "Gagal menyimpan Kop Peserta Ujian", icon: "error" });
                }
            });
        });

        var opsiJenis = $("#jenis");

        opsiJenis.change(function () {
            var val = $(this).val();
            var text = $("#jenis option:selected").text().trim();
            if (val !== "" && text !== "") {
                $('.jenis-ujian').text(text.toUpperCase());
            }
        });

        opsiJenis.select2({width: '100%', theme: 'bootstrap4'});

        if (opsiJenis.val() !== "") {
            var initialText = $("#jenis option:selected").text().trim();
            if (initialText !== "") {
                $('.jenis-ujian').text(initialText.toUpperCase());
            }
        }

        $("#btn-print").click(function () {
            if (opsiJenis.val() === '') {
                Swal.fire({
                    title: "ERROR",
                    text: "Isi semua pilihan terlebih dulu",
                    icon: "error"
                });
            } else {
                if (typeof $('#print-preview').print === 'function') {
                    $('#print-preview').print(document.title);
                } else {
                    window.print();
                }
            }
        });
    });

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
