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
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">Pengaturan dan cetak daftar kehadiran ujian CBT.</p>
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
                    <h6 class="card-title mb-0">Setting Kop Daftar Kehadiran</h6>
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
                                    Unggah gambar kop surat instansi/madrasah lengkap (seperti contoh banner kop surat). Disarankan format <b>PNG / JPG</b> dengan background putih/transparan dan resolusi tajam.
                                </small>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                     <label class="form-label fw-bold">Judul Dokumen di Bawah Kop Gambar</label>
                                    <textarea class="form-control" name="header_3_img" id="input-judul-img" rows="3" placeholder="DAFTAR HADIR PESERTA&#10;ASESMEN SUMATIF TENGAH SEMESTER GANJIL&#10;TAHUN AJARAN 2026/2027"><?= (!empty($kop->header_3) && $kop->header_3 !== 'DAFTAR HADIR PESERTA') ? esc($kop->header_3) : "DAFTAR HADIR PESERTA\nASESMEN SUMATIF TENGAH SEMESTER GANJIL\nTAHUN AJARAN 2026/2027" ?></textarea>
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
                                    <textarea class="form-control" name="header_3_text" id="input-judul-text" rows="3" placeholder="Header 3"><?= (!empty($kop->header_3) && $kop->header_3 !== 'DAFTAR HADIR PESERTA') ? esc($kop->header_3) : "DAFTAR HADIR PESERTA\nASESMEN SUMATIF TENGAH SEMESTER GANJIL\nTAHUN AJARAN 2026/2027" ?></textarea>
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
                        <div class="col-md-6 mb-3" id="by-mapel">
                            <label>Mapel</label>
                            <?php
                            echo form_dropdown('mapel', $mapel_jadwal, null, 'id="mapel" class="form-control"'); ?>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3 pb-2 align-self-end">
                            <div id="loading-page" class="d-none">
                                <i class="fa fa-spinner fa-spin mr-2"></i> Memuat...
                            </div>
                            <div id="info-page" class="d-none badge bg-info text-dark p-2 fs-6"></div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3 align-self-end text-end">
                            <button type="button" class="btn btn-success btn-sm rounded-pill shadow-sm" id="btn-print-all">
                                <i class="fa fa-print me-1"></i><span>Cetak Semua</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card my-shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="card-title mb-0">
                        <h6>Cetak Per Ruang/Kelas</h6>
                    </div>
                    <div id="selector" class="card-tools btn-group">
                        <button type="button" class="btn active btn-primary" id="btn-mode-ruang">By Ruang</button>
                        <button type="button" class="btn btn-outline-primary" id="btn-mode-kelas">By Kelas</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-md-3 mb-3 d-none" id="by-kelas">
                            <label>Kelas</label>
                            <?php
                            echo form_dropdown('kelas', $kelas, null, 'id="kelas" class="form-control"'); ?>
                        </div>
                        <div class="col-6 col-md-3 mb-3" id="by-ruang">
                            <label>Ruang</label>
                            <?php
                            echo form_dropdown('ruang', $ruang, null, 'id="ruang" class="form-control"'); ?>
                        </div>
                        <div class="col-6 col-md-3 mb-3">
                            <label>Sesi</label>
                            <?php
                            echo form_dropdown('sesi', $sesi, null, 'id="sesi" class="form-control"'); ?>
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
                    <div class="text-end">
                        <button type="button" class="btn btn-success btn-sm rounded-pill shadow-sm" id="btn-print">
                            <i class="fa fa-print me-1"></i><span>Cetak</span>
                        </button>
                        <button type="button" class="btn btn-primary btn-sm rounded-pill shadow-sm ms-1" onclick="exportWord('#print-preview', 'Daftar Hadir Peserta')">
                            <i class="fa fa-file-word me-1"></i><span>Word</span>
                        </button>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center bg-gray-light" style="min-height: 300mm">
                        <div id="print-preview" class="m-4">
                        </div>
                    </div>
                </div>
                <div class="overlay d-none" id="loading">
                    <div class="spinner-grow text-primary"></div>
                </div>
            </div>

            <div id="all-print-preview" class="m-4 d-none"></div>
        </div>
    </section>
</div>

<style>
@page {
    size: auto;
    margin: 0mm;
}
#print-preview, #print-preview *,
#all-print-preview, #all-print-preview *,
.page-print, .page-print *,
table.table-siswa, table.table-siswa *,
table.table-absen, table.table-absen *,
table.table-info, table.table-info *,
.judul-daftar-hadir, .judul-daftar-hadir * {
    font-family: 'Times New Roman', Times, serif !important;
}
table.table-absen {
    width: 100%;
    table-layout: fixed;
    border-collapse: collapse;
}
table.table-absen th, table.table-absen td {
    border: 1px solid black;
    box-sizing: border-box;
    vertical-align: middle;
}
table.table-absen .col-no { width: 35px; text-align: center; }
table.table-absen .col-nopes { width: 135px; text-align: center; white-space: nowrap; }
table.table-absen .col-nama { width: auto; text-align: left; padding: 2px 6px; }
table.table-absen .col-kelas { width: 55px; text-align: center; }
table.table-absen .col-ttd-1 { width: 50px; text-align: left; border-left: 1px solid black; border-right: none; border-top: none; border-bottom: 1px solid black; }
table.table-absen .col-ttd-2 { width: 80px; text-align: left; border-left: none; border-right: 1px solid black; border-top: none; border-bottom: 1px solid black; }
table.table-absen .col-ket { width: 45px; text-align: center; }

@media print {
    @page {
        size: auto;
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
    .print-card-wrapper, .border, .my-shadow, .p-4 {
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
    table.table-siswa, table.table-absen {
        width: 100% !important;
        table-layout: fixed !important;
        border-collapse: collapse !important;
    }
    table.table-absen th, table.table-absen td {
        border: 1px solid black !important;
        vertical-align: middle !important;
        box-sizing: border-box !important;
    }
    table.table-absen .col-no { width: 35px !important; text-align: center !important; }
    table.table-absen .col-nopes { width: 135px !important; text-align: center !important; white-space: nowrap !important; }
    table.table-absen .col-nama { width: auto !important; text-align: left !important; padding-left: 6px !important; padding-right: 6px !important; }
    table.table-absen .col-kelas { width: 55px !important; text-align: center !important; }
    table.table-absen .col-ttd-1 { width: 50px !important; text-align: left !important; border-left: 1px solid black !important; border-right: none !important; border-top: none !important; border-bottom: 1px solid black !important; }
    table.table-absen .col-ttd-2 { width: 80px !important; text-align: left !important; border-left: none !important; border-right: 1px solid black !important; border-top: none !important; border-bottom: 1px solid black !important; }
    table.table-absen .col-ket { width: 45px !important; text-align: center !important; }
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

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/app/js/cetak-area.js') ?>?v=<?= @filemtime(FCPATH . 'assets/app/js/cetak-area.js') ?: time() ?>"></script>

<script>
    // --- 1. CONFIGURATION & STATE ---
    const config = {
        headers: {
            h1: <?= json_encode($kop->header_1 ?? '') ?>,
            h2: <?= json_encode($kop->header_2 ?? '') ?>,
            h3: <?= json_encode($kop->header_3 ?? '') ?>,
            h4: <?= json_encode($kop->header_4 ?? '') ?>
        },
        images: {
            logoLeft: "<?= isset($kop->logo_kiri) ? rtrim(base_url(), '/') . '/' . ltrim($kop->logo_kiri, '/') : '' ?>",
            logoRight: "<?= isset($kop->logo_kanan) ? rtrim(base_url(), '/') . '/' . ltrim($kop->logo_kanan, '/') : '' ?>",
            signature: "<?= isset($kop->tanda_tangan) ? rtrim(base_url(), '/') . '/' . ltrim($kop->tanda_tangan, '/') : '' ?>",
            headerKop: "<?= !empty($kop->header_kop) ? rtrim(base_url(), '/') . '/' . ltrim($kop->header_kop, '/') : '' ?>"
        },
        kopMode: <?= json_encode($kop->kop_mode ?? '0') ?>,
        apiUrl: "<?= rtrim(base_url(), '/') ?>/",
        rowsPerPage: 28
    };

    let state = {
        printBy: 1, // 1 = Ruang, 2 = Kelas
        currJadwal: [],
        arrSiswa: [],
        info: null
    };

    // --- 2. HELPER FUNCTIONS ---
    const eqId = (a, b) => String(a ?? '') === String(b ?? '');
    const hasId = (arr, id) => Array.isArray(arr) && arr.some((x) => eqId(x, id));
    const handleNull = (value) => (value == null || value == "0" || value == "") ? "-" : value;

    const handleTanggal = (tgl) => {
        if (handleNull(tgl) === "-") return "-";
        const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
        const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        const d = new Date(tgl);
        return `${days[d.getDay()]}, ${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;
    };

    const formatTanggalShort = (dateString) => {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' });
    };

    const findPengawas = (allPengawas, jadwalIds, ruangId, sesiId) => {
        if (!Array.isArray(allPengawas) || allPengawas.length === 0) return [];
        let p = allPengawas.find(x => 
            (!ruangId || eqId(x.id_ruang, ruangId)) &&
            (!sesiId || eqId(x.id_sesi, sesiId)) &&
            hasId(jadwalIds, x.id_jadwal)
        );
        if (!p) {
            p = allPengawas.find(x => 
                (!ruangId || eqId(x.id_ruang, ruangId)) &&
                (!sesiId || eqId(x.id_sesi, sesiId))
            );
        }
        return p?.pengawas || [];
    };

    // --- 3. HTML GENERATORS ---
    const getJudulHtml = (rawText) => {
        let text = (rawText && String(rawText).trim() !== '') ? String(rawText).trim() : '';
        if (!text || text === 'DAFTAR HADIR PESERTA') {
            text = "DAFTAR HADIR PESERTA\nASESMEN SUMATIF TENGAH SEMESTER GANJIL\nTAHUN AJARAN 2026/2027";
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

    const generateHeaderKop = (isAllPrint = false) => {
        if (config.kopMode === '1' && config.images.headerKop) {
            return `
                <div style="width: 100%; margin: 0 0 6px 0; padding: 0; text-align: center;">
                    <img src="${config.images.headerKop}" class="kop-img" onerror="this.style.display='none'" style="width: 100%; height: auto; display: block; margin: 0 auto; padding: 0;">
                </div>
                ${getJudulHtml(config.headers.h3)}
            `;
        }

        const kop = config.headers;
        return `
            <table style="width: 100%; border: 0; table-layout: fixed;">
                <colgroup>
                    <col style="width: 15%;">
                    <col style="width: 70%;">
                    <col style="width: 15%;">
                </colgroup>
                <tr>
                    <td style="width:15%;"><img src="${config.images.logoLeft}" onerror="this.style.display='none'" style="width:85px; height:85px; margin: 6px;"></td>
                    <td style="width:70%; text-align: center;">
                        <div style="line-height: 1.1; font-family: 'Times New Roman'; font-size: 14pt">${kop.h1}</div>
                        <div style="line-height: 1.1; font-family: 'Times New Roman'; font-size: 16pt"><b>${kop.h2}</b></div>
                        ${getJudulHtml(kop.h3)}
                        <div style="line-height: 1.2; font-family: 'Times New Roman'; font-size: 12pt">${kop.h4}</div>
                    </td>
                    <td style="width:15%;"><img src="${config.images.logoRight}" onerror="this.style.display='none'" style="width:85px; height:85px; margin: 6px; border-style: none"></td>
                </tr>
            </table>
            <hr style="border: 1px solid; margin-bottom: 6px">
        `;
    };

    const createRowStudent = (index, student, isMultiPage) => {
        const genap = (index + 1) % 2 === 0;
        const forGenap = genap ? (index + 1) + '.' : '';
        const forGanjil = genap ? '' : (index + 1) + '.';

        return `
            <tr style="font-family: 'Times New Roman'; font-size: 9.5pt">
                <td class="ts col-no" style="line-height: 1.1; border: 1px solid black; text-align: center;">${index + 1}</td>
                <td class="ts col-nopes" style="line-height: 1.1; border: 1px solid black; text-align: center; padding: 2px 4px;">${handleNull(student?.nomor_peserta)}</td>
                <td class="ts col-nama" style="line-height: 1.1; border: 1px solid black; padding: 2px 6px; text-align: left; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${student?.nama || '-'}</td>
                <td class="ts col-kelas" style="line-height: 1.1; border: 1px solid black; text-align: center; padding: 2px 4px;">${student?.kode_kelas || '-'}</td>
                <td class="ts col-ttd-1" style="line-height: 1.1; border-left: 1px solid black; border-bottom: 1px solid black; border-top: none; border-right: none; padding: 2px 4px;">${forGanjil}</td>
                <td class="ts col-ttd-2" style="line-height: 1.1; border-right: 1px solid black; border-bottom: 1px solid black; border-top: none; border-left: none; padding: 2px 4px;">${forGenap}</td>
                <td class="ts col-ket" style="line-height: 1.1; border: 1px solid black; text-align: center;"> </td>
            </tr>
        `;
    };

    // --- 4. PREVIEW TUNGGAL (RUANG / KELAS) ---
    function createPrintPreview(data) {
        $('#print-preview').html('');
        const opsiTgl = $('#select-tgl');
        const mplTgl = $('#mapel-tgl');

        opsiTgl.addClass('d-none');
        mplTgl.html('');

        state.arrSiswa = data.siswa || [];
        state.info = data.info || {};
        state.currJadwal = [];

        const isKelas = state.printBy === 2;
        const targetTitle = isKelas ? 'Kelas' : 'Ruang';
        const targetVal = isKelas 
            ? (state.info.kelas?.nama_kelas || '-') 
            : `${state.info.ruang?.nama_ruang || '-'} (${state.info.ruang?.kode_ruang || '-'})`;
        const sesiName = state.info.sesi?.nama_sesi || 'Semua Sesi';

        const allTgl = data.all_tgl || {};
        const allPengawas = data.all_pengawas || [];

        // Filter siswa sesuai mode
        let filteredSiswa = [];
        if (isKelas) {
            filteredSiswa = state.arrSiswa.filter(s => 
                eqId(s.id_kelas, state.info.kelas?.id_kelas) &&
                (!state.info.sesi?.id_sesi || eqId(s.sesi_id, state.info.sesi?.id_sesi))
            );
        } else {
            filteredSiswa = state.arrSiswa.filter(s => 
                eqId(s.ruang_id, state.info.ruang?.id_ruang) &&
                eqId(s.sesi_id, state.info.sesi?.id_sesi)
            );
        }

        // Susun jadwal dari all_tgl
        for (const tgl in allTgl) {
            const schedules = allTgl[tgl] || [];
            let matchingJadwals = [];
            if (isKelas) {
                matchingJadwals = schedules.filter(j => 
                    (j.bank_kelas || []).some(k => eqId(k, state.info.kelas?.id_kelas))
                );
            } else {
                const studentKelasIds = new Set(filteredSiswa.map(s => String(s.id_kelas)));
                matchingJadwals = schedules.filter(j => 
                    (j.bank_kelas || []).some(k => studentKelasIds.has(String(k)))
                );
                if (matchingJadwals.length === 0 && schedules.length > 0) {
                    matchingJadwals = schedules;
                }
            }

            if (matchingJadwals.length > 0) {
                const primary = matchingJadwals[0];
                const jIds = matchingJadwals.map(j => j.id_jadwal);
                const pengawas = findPengawas(
                    allPengawas, 
                    jIds, 
                    isKelas ? null : state.info.ruang?.id_ruang, 
                    state.info.sesi?.id_sesi
                );

                state.currJadwal.push({
                    jadwal: primary,
                    nama_mapel: primary.nama_mapel,
                    tgl_mulai: primary.tgl_mulai || tgl,
                    dari: state.info.sesi?.waktu_mulai || primary.jam_mulai || '-',
                    sampai: state.info.sesi?.waktu_akhir || primary.jam_akhir || '-',
                    nama_sesi: state.info.sesi?.nama_sesi || primary.nama_sesi || '-',
                    nama_ruang: state.info.ruang?.nama_ruang || '-',
                    kode_ruang: state.info.ruang?.kode_ruang || '-',
                    nama_kelas: state.info.kelas?.nama_kelas || '-',
                    kode_kelas: state.info.kelas?.kode_kelas || '-',
                    siswa: filteredSiswa,
                    pengawas: pengawas
                });
            }
        }

        if (state.currJadwal.length === 0) {
            $('#print-preview').html(`<b>Tidak ada data jadwal untuk ${targetTitle} ${targetVal} sesi ${sesiName}, atau jadwal belum diatur</b>`);
            $('#loading').addClass('d-none');
            return;
        }

        if (state.currJadwal.length > 1) {
            opsiTgl.removeClass('d-none');
            mplTgl.prepend("<option value='' selected='selected'>Pilih Tanggal</option>");
            state.currJadwal.forEach(item => {
                mplTgl.append(`<option value="${item.tgl_mulai}">${formatTanggalShort(item.tgl_mulai)}</option>`);
            });
        } else {
            buildTableSingle(state.currJadwal[0], state.info);
        }

        $('#loading').addClass('d-none');
    }

    function buildTableSingle(item, info) {
        const all_siswa = (item.siswa || []).slice();
        all_siswa.sort((a, b) => (a.nomor_peserta || "").localeCompare(b.nomor_peserta || "", undefined, {numeric: true}));

        const pages = Math.ceil(all_siswa.length / config.rowsPerPage) || 1;
        const isKelas = state.printBy === 2;
        const targetTitle = isKelas ? 'Kelas' : 'Ruang';
        const targetVal = isKelas 
            ? (info.kelas?.nama_kelas || item.nama_kelas || '-') 
            : `${info.ruang?.nama_ruang || item.nama_ruang || '-'} (${info.ruang?.kode_ruang || item.kode_ruang || '-'})`;

        document.title = 'Daftar Hadir ' + (item.nama_mapel || '') + ' ' + targetVal + ' ' + (item.nama_sesi || '');

        const p1 = (item.pengawas || [])[0] || {nama_guru: '', nip: '', jenis_nip: 'NIP'};
        const p2 = (item.pengawas || [])[1] || {nama_guru: '', nip: '', jenis_nip: 'NIP'};
        const lblP1 = p1.jenis_nip || 'NIP';
        const lblP2 = p2.jenis_nip || 'NIP';

        const pengawasSection = p2.nama_guru ? `
            <td style="text-align: center; vertical-align: top;">Pengawas 1<br><br><br><br><u>${p1.nama_guru}</u><br>${lblP1}: ${p1.nip || '-'}</td>
            <td style="text-align: center; vertical-align: top;">Pengawas 2<br><br><br><br><u>${p2.nama_guru}</u><br>${lblP2}: ${p2.nip || '-'}</td>
        ` : `
            <td style="text-align: center; vertical-align: top;"></td>
            <td style="text-align: center; vertical-align: top;">Pengawas<br><br><br><br><u>${p1.nama_guru}</u><br>${lblP1}: ${p1.nip || '-'}</td>
        `;

        if (all_siswa.length === 0) {
            $('#print-preview').html(`<b>Tidak ada data siswa untuk ${targetTitle} ${targetVal} ${item.nama_sesi || ''}</b>`);
            return;
        }

        let card = '';
        for (let a = 0; a < pages; a++) {
            const start = a * config.rowsPerPage;
            const end = (a + 1) < pages ? start + config.rowsPerPage : all_siswa.length;

            let rowsHtml = '';
            for (let i = start; i < end; i++) {
                rowsHtml += createRowStudent(i, all_siswa[i], pages > 1);
            }

            card += `
                <div class="print-card-wrapper border my-shadow mb-3 p-4 bg-white">
                    <div class="page-print" style="font-family: 'Times New Roman'; justify-content: center; width: 100%; max-width: 195mm; margin: 0 auto; box-sizing: border-box; padding: 0 5px;">
                        ${generateHeaderKop()}

                        <div style="display: flex;align-items: stretch; margin-bottom: 6px;">
                            <div style="flex: 50%">
                                <table class="table-info" style="width: 100%; border: 0;">
                                    <tbody>
                                        <tr style="line-height: 1.1;font-family: 'Times New Roman';">
                                            <td style="width: 85px; vertical-align: top;">${targetTitle}</td>
                                            <td style="width: 10px; vertical-align: top;">:</td>
                                            <td style="vertical-align: top;">${targetVal}</td>
                                        </tr>
                                        <tr style="line-height: 1.1;font-family: 'Times New Roman';">
                                            <td style="vertical-align: top;">Sesi</td>
                                            <td style="vertical-align: top;">:</td>
                                            <td style="vertical-align: top;">${item.nama_sesi}</td>
                                        </tr>
                                        <tr style="line-height: 1.1;font-family: 'Times New Roman';">
                                            <td style="vertical-align: top;">Waktu</td>
                                            <td style="vertical-align: top;">:</td>
                                            <td style="vertical-align: top;">${item.dari} s/d ${item.sampai}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div style="flex: 50%; padding-left: 75px;">
                                <table class="table-info" style="width: 100%; border: 0;">
                                    <tbody>
                                        <tr style="line-height: 1.1;font-family: 'Times New Roman';">
                                            <td style="width: 95px; vertical-align: top;">Hari/Tanggal</td>
                                            <td style="width: 10px; vertical-align: top;">:</td>
                                            <td style="vertical-align: top;">${handleTanggal(item.tgl_mulai)}</td>
                                        </tr>
                                        <tr style="line-height: 1.1;font-family: 'Times New Roman';">
                                            <td style="width: 95px; vertical-align: top;">Mata Pelajaran</td>
                                            <td style="width: 10px; vertical-align: top;">:</td>
                                            <td style="vertical-align: top;">${item.nama_mapel}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <table class="table-siswa table-absen" style="width: 100%; border-collapse: collapse; table-layout: fixed;">
                            <colgroup>
                                <col class="col-no" style="width: 35px;">
                                <col class="col-nopes" style="width: 135px;">
                                <col class="col-nama" style="width: auto;">
                                <col class="col-kelas" style="width: 55px;">
                                <col class="col-ttd-1" style="width: 50px;">
                                <col class="col-ttd-2" style="width: 80px;">
                                <col class="col-ket" style="width: 45px;">
                            </colgroup>
                            <thead>
                                <tr style="font-family: 'Times New Roman'; font-size: 10pt; height: 32px;">
                                    <th class="col-no" style="border: 1px solid black; text-align: center;">No.</th>
                                    <th class="col-nopes" style="border: 1px solid black; text-align: center;">No. Peserta</th>
                                    <th class="col-nama" style="border: 1px solid black; text-align: center;">Nama Peserta</th>
                                    <th class="col-kelas" style="border: 1px solid black; text-align: center;">Kelas</th>
                                    <th colspan="2" style="border: 1px solid black; width: 130px; text-align: center;">Tanda Tangan</th>
                                    <th class="col-ket" style="border: 1px solid black; text-align: center;">Ket.</th>
                                </tr>
                            </thead>
                            <tbody>${rowsHtml}</tbody>
                        </table>
            `;

            if (a === (pages - 1)) {
                card += `
                    <br><br>
                    <table style="width: 100%; table-layout: fixed; border-collapse: collapse;">
                        <colgroup>
                            <col style="width: 54%;">
                            <col style="width: 23%;">
                            <col style="width: 23%;">
                        </colgroup>
                        <tr style="line-height: 1.25; font-family: 'Times New Roman'; font-size: 10pt">
                            <td style="text-align: left; vertical-align: top; padding-right: 15px;">
                                <table style="width: 100%; border: 1px solid black; border-collapse: collapse; font-family: 'Times New Roman'; font-size: 10pt;">
                                    <tr>
                                        <td style="padding: 7px 10px 3px 10px !important; line-height: 1.3 !important; width: 62%;">Jumlah peserta yang seharusnya hadir</td>
                                        <td style="padding: 7px 2px 3px 2px !important; line-height: 1.3 !important; width: 10px; text-align: center;">:</td>
                                        <td style="padding: 7px 10px 3px 6px !important; line-height: 1.3 !important; text-align: right; white-space: nowrap;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u> orang</td>
                                    </tr>
                                    <tr>
                                        <td style="border-bottom: 1px solid black !important; padding: 3px 10px 7px 10px !important; line-height: 1.3 !important;">Jumlah peserta yang tidak hadir</td>
                                        <td style="border-bottom: 1px solid black !important; padding: 3px 2px 7px 2px !important; line-height: 1.3 !important; width: 10px; text-align: center;">:</td>
                                        <td style="border-bottom: 1px solid black !important; padding: 3px 10px 7px 6px !important; line-height: 1.3 !important; text-align: right; white-space: nowrap;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u> orang</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 6px 10px 6px 10px !important; line-height: 1.3 !important;">Jumlah peserta hadir</td>
                                        <td style="padding: 6px 2px 6px 2px !important; line-height: 1.3 !important; width: 10px; text-align: center;">:</td>
                                        <td style="padding: 6px 10px 6px 6px !important; line-height: 1.3 !important; text-align: right; white-space: nowrap;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u> orang</td>
                                    </tr>
                                </table>
                            </td>
                            ${pengawasSection}
                        </tr>
                    </table>
                `;
            }

            card += `</div></div>`;
            if (a < (pages - 1)) {
                card += `<div style="page-break-after: always; break-after: page;"></div>`;
            }
        }

        $('#print-preview').html(card);
        if (pages > 1) $('.ts').height('23px');
        else $('.ts').height('20px');
    }

    // --- 5. CETAK SEKALIGUS (ALL PREVIEW - BEBAS GANDA) ---
    function populateAllPreview(data) {
        $('#all-print-preview').html('');
        let allPages = 0;
        const allRuang = Array.isArray(data.all_ruang) ? data.all_ruang : [];
        const allTgl = data.all_tgl || {};
        const allPengawas = data.all_pengawas || [];
        const allSiswa = data.siswa || [];

        for (const tgl in allTgl) {
            const schedulesOnDate = allTgl[tgl] || [];
            if (schedulesOnDate.length === 0) continue;

            // Kumpulkan ID kelas yang mengikuti mapel pada tanggal ini
            const activeKelasSet = new Set();
            schedulesOnDate.forEach(j => {
                (j.bank_kelas || []).forEach(k => {
                    if (k) activeKelasSet.add(String(k));
                });
            });

            const namaMapel = schedulesOnDate[0]?.nama_mapel || '-';
            const jadwalIds = schedulesOnDate.map(j => j.id_jadwal);

            // Tepat SATU dokumen per kombinasi (ruang_id, sesi_id)
            for (const ruangSesi of allRuang) {
                const studentsInRoom = allSiswa.filter(s => 
                    eqId(s.ruang_id, ruangSesi.ruang_id) &&
                    eqId(s.sesi_id, ruangSesi.sesi_id) &&
                    activeKelasSet.has(String(s.id_kelas))
                );

                if (studentsInRoom.length === 0) continue;

                // Sort peserta berdasarkan nomor peserta
                studentsInRoom.sort((a, b) => (a.nomor_peserta || "").localeCompare(b.nomor_peserta || "", undefined, {numeric: true}));

                const pengawasArr = findPengawas(allPengawas, jadwalIds, ruangSesi.ruang_id, ruangSesi.sesi_id);
                const p1 = pengawasArr[0] || {nama_guru: '', nip: '', jenis_nip: 'NIP'};
                const p2 = pengawasArr[1] || {nama_guru: '', nip: '', jenis_nip: 'NIP'};
                const lblP1 = p1.jenis_nip || 'NIP';
                const lblP2 = p2.jenis_nip || 'NIP';

                const waktuMulai = ruangSesi.waktu_mulai || schedulesOnDate[0]?.jam_mulai || '-';
                const waktuAkhir = ruangSesi.waktu_akhir || schedulesOnDate[0]?.jam_akhir || '-';

                const pages = Math.ceil(studentsInRoom.length / config.rowsPerPage);

                for (let a = 0; a < pages; a++) {
                    const start = a * config.rowsPerPage;
                    const end = (a + 1) < pages ? start + config.rowsPerPage : studentsInRoom.length;

                    let rowsHtml = '';
                    for (let i = start; i < end; i++) {
                        rowsHtml += createRowStudent(i, studentsInRoom[i], pages > 1);
                    }

                    const pengawasSection = p2.nama_guru ? `
                        <td style="text-align: center; vertical-align: top;">Pengawas 1<br><br><br><br><u>${p1.nama_guru}</u><br>${lblP1}: ${p1.nip || '-'}</td>
                        <td style="text-align: center; vertical-align: top;">Pengawas 2<br><br><br><br><u>${p2.nama_guru}</u><br>${lblP2}: ${p2.nip || '-'}</td>
                    ` : `
                        <td style="text-align: center; vertical-align: top;"></td>
                        <td style="text-align: center; vertical-align: top;">Pengawas<br><br><br><br><u>${p1.nama_guru}</u><br>${lblP1}: ${p1.nip || '-'}</td>
                    `;

                    const pageHtml = `
                        <div class="print-card-wrapper mb-3 bg-white page-print" style="font-family: 'Times New Roman'; width: 100%; max-width: 195mm; margin: 0 auto; box-sizing: border-box; padding: 0 5px;">
                            ${generateHeaderKop(true)}

                            <div style="display: flex;align-items: stretch; margin-bottom: 6px;">
                                <div style="flex: 50%">
                                    <table class="table-info" style="width: 100%; border: 0;">
                                        <tbody>
                                            <tr style="line-height: 1.1; font-family: 'Times New Roman';">
                                                <td style="width: 85px; vertical-align: top;">Ruang</td>
                                                <td style="width: 10px; vertical-align: top;">:</td>
                                                <td style="vertical-align: top;">${ruangSesi.nama_ruang} (${ruangSesi.kode_ruang})</td>
                                            </tr>
                                            <tr style="line-height: 1.1; font-family: 'Times New Roman';">
                                                <td style="vertical-align: top;">Sesi</td>
                                                <td style="vertical-align: top;">:</td>
                                                <td style="vertical-align: top;">${ruangSesi.nama_sesi}</td>
                                            </tr>
                                            <tr style="line-height: 1.1; font-family: 'Times New Roman';">
                                                <td style="vertical-align: top;">Waktu</td>
                                                <td style="vertical-align: top;">:</td>
                                                <td style="vertical-align: top;">${waktuMulai} s/d ${waktuAkhir}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="flex: 50%; padding-left: 75px;">
                                    <table class="table-info" style="width: 100%; border: 0;">
                                        <tbody>
                                            <tr style="line-height: 1.1; font-family: 'Times New Roman';">
                                                <td style="width: 95px; vertical-align: top;">Hari/Tanggal</td>
                                                <td style="width: 10px; vertical-align: top;">:</td>
                                                <td style="vertical-align: top;">${handleTanggal(tgl)}</td>
                                            </tr>
                                            <tr style="line-height: 1.1; font-family: 'Times New Roman';">
                                                <td style="width: 95px; vertical-align: top;">Mata Pelajaran</td>
                                                <td style="width: 10px; vertical-align: top;">:</td>
                                                <td style="vertical-align: top;">${namaMapel}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <table class="table-siswa table-absen" style="width: 100%; border-collapse: collapse; table-layout: fixed;">
                                <colgroup>
                                    <col class="col-no" style="width: 35px;">
                                    <col class="col-nopes" style="width: 135px;">
                                    <col class="col-nama" style="width: auto;">
                                    <col class="col-kelas" style="width: 55px;">
                                    <col class="col-ttd-1" style="width: 50px;">
                                    <col class="col-ttd-2" style="width: 80px;">
                                    <col class="col-ket" style="width: 45px;">
                                </colgroup>
                                <thead>
                                    <tr style="font-family: 'Times New Roman'; font-size: 10pt; height: 32px;">
                                        <th class="col-no" style="border: 1px solid black; text-align: center;">No.</th>
                                        <th class="col-nopes" style="border: 1px solid black; text-align: center;">No. Peserta</th>
                                        <th class="col-nama" style="border: 1px solid black; text-align: center;">Nama Peserta</th>
                                        <th class="col-kelas" style="border: 1px solid black; text-align: center;">Kelas</th>
                                        <th colspan="2" style="border: 1px solid black; width: 130px; text-align: center;">Tanda Tangan</th>
                                        <th class="col-ket" style="border: 1px solid black; text-align: center;">Ket.</th>
                                    </tr>
                                </thead>
                                <tbody>${rowsHtml}</tbody>
                            </table>
                    `;

                    let finalHtml = pageHtml;

                    if (a === (pages - 1)) {
                        finalHtml += `
                            <br><br>
                            <table style="width: 100%; table-layout: fixed; border-collapse: collapse;">
                                <colgroup>
                                    <col style="width: 54%;">
                                    <col style="width: 23%;">
                                    <col style="width: 23%;">
                                </colgroup>
                                <tr style="line-height: 1.25; font-family: 'Times New Roman'; font-size: 10pt">
                                    <td style="text-align: left; vertical-align: top; padding-right: 15px;">
                                        <table style="width: 100%; border: 1px solid black; border-collapse: collapse; font-family: 'Times New Roman'; font-size: 10pt;">
                                            <tr>
                                                <td style="padding: 7px 10px 3px 10px !important; line-height: 1.3 !important; width: 62%;">Jumlah peserta yang seharusnya hadir</td>
                                                <td style="padding: 7px 2px 3px 2px !important; line-height: 1.3 !important; width: 10px; text-align: center;">:</td>
                                                <td style="padding: 7px 10px 3px 6px !important; line-height: 1.3 !important; text-align: right; white-space: nowrap;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u> orang</td>
                                            </tr>
                                            <tr>
                                                <td style="border-bottom: 1px solid black !important; padding: 3px 10px 7px 10px !important; line-height: 1.3 !important;">Jumlah peserta yang tidak hadir</td>
                                                <td style="border-bottom: 1px solid black !important; padding: 3px 2px 7px 2px !important; line-height: 1.3 !important; width: 10px; text-align: center;">:</td>
                                                <td style="border-bottom: 1px solid black !important; padding: 3px 10px 7px 6px !important; line-height: 1.3 !important; text-align: right; white-space: nowrap;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u> orang</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 6px 10px 6px 10px !important; line-height: 1.3 !important;">Jumlah peserta hadir</td>
                                                <td style="padding: 6px 2px 6px 2px !important; line-height: 1.3 !important; width: 10px; text-align: center;">:</td>
                                                <td style="padding: 6px 10px 6px 6px !important; line-height: 1.3 !important; text-align: right; white-space: nowrap;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u> orang</td>
                                            </tr>
                                        </table>
                                    </td>
                                    ${pengawasSection}
                                </tr>
                            </table>
                        `;
                    }

                    finalHtml += `</div>`;
                    if (allPages > 0) {
                        $('#all-print-preview').append(`<div style="page-break-after: always; break-after: page;"></div>`);
                    }
                    $('#all-print-preview').append(finalHtml);
                    allPages++;
                }
            }
        }

        $('#loading-page').addClass('d-none');
        $('#info-page').removeClass('d-none');
        $('#info-page').text(`${allPages} Halaman`);
    }

    // --- 6. INITIALIZATION & EVENT LISTENERS ---
    $(document).ready(function () {
        ajaxcsrf();

        const el = {
            mapel: $("#mapel"),
            mapelJadwal: $("#mapel-jadwal"),
            ruang: $("#ruang"),
            sesi: $("#sesi"),
            kelas: $("#kelas"),
            preview: $('#print-preview'),
            allPreview: $('#all-print-preview'),
            loading: $('#loading'),
            loadingPage: $('#loading-page'),
            infoPage: $('#info-page'),
            mplTgl: $('#mapel-tgl')
        };

        // Initialize Select2
        $('select').select2({ width: '100%', theme: 'bootstrap4' });

        // Default Options
        el.mapel.prepend("<option value='' selected='selected'>Pilih Mapel</option>");
        el.mapelJadwal.prepend("<option value='' selected='selected'>Pilih Jadwal</option>");
        el.ruang.prepend("<option value='' selected='selected'>Pilih Ruang</option>");
        el.sesi.prepend("<option value='' selected='selected'>Pilih Sesi</option>");
        el.kelas.prepend("<option value='' selected='selected'>Pilih Kelas</option>");

        // Load Cetak Sekaligus
        const loadAllSiswaRuang = (mapel) => {
            if (!mapel) {
                el.allPreview.html('');
                el.infoPage.addClass('d-none');
                return;
            }
            el.loadingPage.removeClass('d-none');
            el.infoPage.addClass('d-none');
            $.ajax({
                type: "GET",
                url: config.apiUrl + "cbtcetak/getalljadwal?mapel=" + mapel,
                success: populateAllPreview,
                error: (xhr) => {
                    el.loadingPage.addClass('d-none');
                    el.infoPage.removeClass('d-none').text('Error memuat data');
                    console.error(xhr.responseText);
                }
            });
        };

        // Load Preview Tunggal
        const loadPreviewData = () => {
            const ruang = el.ruang.val();
            const sesi = el.sesi.val();
            const jadwal = el.mapelJadwal.val();
            const kelas = el.kelas.val();

            const isValid = state.printBy === 1 ? (ruang && sesi && jadwal) : (kelas && sesi && jadwal);
            if (!isValid) {
                el.preview.html('');
                $('#select-tgl').addClass('d-none');
                el.mplTgl.html('');
                return;
            }

            el.loading.removeClass('d-none');

            const url = state.printBy === 1
                ? `${config.apiUrl}cbtcetak/getruang?ruang=${ruang}&sesi=${sesi}&mapel=${jadwal}`
                : `${config.apiUrl}cbtcetak/getkelas?kelas=${kelas}&sesi=${sesi}&mapel=${jadwal}`;

            $.ajax({
                type: "GET",
                url: url,
                success: createPrintPreview,
                error: (xhr) => {
                    el.loading.addClass('d-none');
                    console.error(xhr.responseText);
                    el.preview.html('<div class="alert alert-danger">Gagal memuat data jadwal/peserta.</div>');
                }
            });
        };

        // Cetak Sekaligus Trigger
        $("#btn-print-all").on('click', function (e) {
            e.preventDefault();
            if (!el.mapel.val()) {
                return Swal.fire("ERROR", "Isi Mapel terlebih dulu", "error");
            }
            if (!el.allPreview.html() || !String(el.allPreview.html()).trim()) {
                return Swal.fire("ERROR", "Dokumen belum siap. Pilih Mapel dan tunggu sampai muncul jumlah halaman.", "error");
            }
            document.title = 'Daftar Hadir ' + el.mapel.find("option:selected").text();
            if (typeof el.allPreview.print === 'function') {
                el.allPreview.print(document.title);
            } else {
                window.print();
            }
        });

        // Cetak Per Ruang/Kelas Trigger
        $("#btn-print").on('click', function (e) {
            e.preventDefault();
            const isEmpty = state.printBy === 2
                ? (!el.kelas.val() || !el.sesi.val() || !el.mapelJadwal.val())
                : (!el.ruang.val() || !el.sesi.val() || !el.mapelJadwal.val());

            if (isEmpty) return Swal.fire("ERROR", "Isi semua pilihan terlebih dulu", "error");
            if (!el.preview.html() || !String(el.preview.html()).trim()) {
                return Swal.fire("ERROR", "Preview kosong. Pilih Ruang/Sesi/Jadwal terlebih dulu.", "error");
            }
            if (typeof el.preview.print === 'function') {
                el.preview.print(document.title);
            } else {
                window.print();
            }
        });

        el.mapel.change(function() {
            loadAllSiswaRuang($(this).val());
        });
        el.mapelJadwal.change(loadPreviewData);
        el.sesi.change(loadPreviewData);
        el.ruang.change(loadPreviewData);
        el.kelas.change(loadPreviewData);

        // Toggle Mode (Ruang vs Kelas)
        $('#btn-mode-ruang').click(function () {
            if (state.printBy === 1) return;
            state.printBy = 1;
            $(this).addClass('active btn-primary').removeClass('btn-outline-primary');
            $('#btn-mode-kelas').removeClass('active btn-primary').addClass('btn-outline-primary');

            $('#by-ruang').removeClass('d-none');
            $('#by-kelas').addClass('d-none');

            state.currJadwal = [];
            el.preview.html('');
            $('#select-tgl').addClass('d-none');
            el.mplTgl.html('');

            loadPreviewData();
        });

        $('#btn-mode-kelas').click(function () {
            if (state.printBy === 2) return;
            state.printBy = 2;
            $(this).addClass('active btn-primary').removeClass('btn-outline-primary');
            $('#btn-mode-ruang').removeClass('active btn-primary').addClass('btn-outline-primary');

            $('#by-kelas').removeClass('d-none');
            $('#by-ruang').addClass('d-none');

            state.currJadwal = [];
            el.preview.html('');
            $('#select-tgl').addClass('d-none');
            el.mplTgl.html('');

            loadPreviewData();
        });

        // Dropify Setup
        var drKop = $('#header-kop-file').dropify({
            messages: {
                'default': 'Seret gambar kop ke sini atau klik untuk memilih file',
                'replace': 'Seret atau klik untuk mengganti gambar kop',
                'remove':  'Hapus Gambar Kop',
                'error':   'Terjadi kesalahan saat memuat file.'
            }
        });

        drKop.on('dropify.afterClear', function () {
            $('#hapus_kop').val('1');
        });

        drKop.on('change', function () {
            $('#hapus_kop').val('0');
        });

        // Toggle Format Kop
        $('input[name="kop_mode"]').on('change', function () {
            if ($(this).val() === '1') {
                $('#wrapper-kop-image').removeClass('d-none');
                $('#wrapper-kop-text').addClass('d-none');
            } else {
                $('#wrapper-kop-image').addClass('d-none');
                $('#wrapper-kop-text').removeClass('d-none');
            }
        });

        // Simpan Kop Surat
        $('#set-kop').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            if ($('input[name="kop_mode"]:checked').val() === '1') {
                $('#input-header-3').val($('#input-judul-img').val());
            } else {
                $('#input-header-3').val($('#input-judul-text').val());
            }

            Swal.fire({
                title: "Menyimpan...",
                text: "Silahkan tunggu....",
                allowOutsideClick: false,
                didOpen: function() { Swal.showLoading(); }
            });

            $.ajax({
                url: '<?= base_url('cbtcetak/savekop') ?>',
                type: 'POST',
                processData: false,
                contentType: false,
                data: new FormData(this),
                success: function () {
                    Swal.fire({ title: 'Sukses', text: "Template KOP berhasil disimpan", icon: 'success' }).then(function() {
                        window.location.reload();
                    });
                },
                error: function () {
                    Swal.fire("Error", "Gagal menyimpan Kop Daftar Kehadiran", "error");
                }
            });
        });

        el.mplTgl.on('change', function() {
            const tgl = $(this).val();
            const jadwalSelected = state.currJadwal.find(e => e.tgl_mulai === tgl);
            if (jadwalSelected) {
                buildTableSingle(jadwalSelected, state.info);
            } else {
                el.preview.html(`<b>Tidak ada data jadwal untuk tanggal terpilih</b>`);
            }
        });

    });
</script>

<?= $this->endSection() ?>
