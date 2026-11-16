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
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">Pengaturan dan cetak kartu ujian peserta CBT.</p>
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
            <div class="row">
                <div class="col-md-5">
                    <div class="card my-shadow card-primary card-outline">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title mb-0">Setting Kartu</h6>
                            <button type="button" class="btn btn-sm btn-primary rounded-pill shadow-sm" onclick="submitKartu()">
                                <i class="fas fa-save me-1"></i> Simpan
                            </button>
                        </div>
                        <div class="card-body">
                            <?= form_open('', array('id' => 'set-kartu')) ?>
                            <div class="form-group">
                                <label>Header 1</label>
                                <textarea id="header-1" class="form-control" name="header_1" rows="2"
                                          placeholder="Header baris 1"
                                          required><?= isset($kartu->header_1) ? $kartu->header_1 : '' ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Header 2</label>
                                <textarea id="header-2" class="form-control" name="header_2" rows="2"
                                          placeholder="Header baris 2"
                                          required><?= isset($kartu->header_2) ? $kartu->header_2 : '' ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Header 3</label>
                                <textarea id="header-3" class="form-control" name="header_3" rows="2"
                                          placeholder="Header baris 3"
                                          required><?= isset($kartu->header_3) ? $kartu->header_3 : '' ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Header 4</label>
                                <textarea id="header-4" class="form-control" name="header_4" rows="2"
                                          placeholder="Header baris 4"
                                          required><?= isset($kartu->header_4) ? $kartu->header_4 : '' ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input id="input-tanggal" class="form-control" name="tanggal" placeholder="Titimangsa"
                                       value="<?= isset($kartu->tanggal) ? $kartu->tanggal : '' ?>" required>
                            </div>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card my-shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title fw-bold">
                                Preview
                            </div>
                            <div class="btn-group btn-group-sm" role="group" id="toggle-tipe-group">
                                <button type="button" class="btn btn-primary active text-white" id="btn-tipe-1" onclick="switchTipe(1)">Tipe 1</button>
                                <button type="button" class="btn btn-outline-primary" id="btn-tipe-2" onclick="switchTipe(2)">Tipe 2</button>
                                <button type="button" class="btn btn-outline-primary" id="btn-tipe-3" onclick="switchTipe(3)">Tipe 3</button>
                            </div>
                        </div>
                        <div class="card-body pb-4">
                            <?php
                            $sch = detectSchoolType($setting);
                            $satuanPend = $sch->satuan_label;
                            $kepsekLabel = $sch->kepsek_label;
                            $logoKiriUrl = !empty($setting->logo_kiri) ? rtrim(base_url(), '/') . '/' . ltrim($setting->logo_kiri, '/') : '';
                            $logoKananUrl = !empty($setting->logo_kanan) ? rtrim(base_url(), '/') . '/' . ltrim($setting->logo_kanan, '/') : '';
                            $ttdUrl = !empty($setting->tanda_tangan) ? rtrim(base_url(), '/') . '/' . ltrim($setting->tanda_tangan, '/') : '';
                            $bgTtd = !empty($ttdUrl) ? "background: url('" . $ttdUrl . "') no-repeat center / contain !important;" : "";
                            ?>
                            <div id="prev-top-wrapper" style="display: flex; justify-content: center; overflow-x: auto;">
                                <div id="prev-top-card" class="kartu-item" style="position: relative; box-sizing: border-box; border: 1px solid #000; width: 360px; min-width: 200px; overflow: hidden; background: #fff;">
                                    <div class="kartu-watermark" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; display: flex; justify-content: center; align-items: center; opacity: 0.15; pointer-events: none; z-index: 0;">
                                        <img src="<?= $logoKiriUrl ?>" onerror="this.style.display='none'" style="width: 120px; height: auto; margin-top: 50px;">
                                    </div>
                                    <table style="width: 100%; table-layout: fixed; border-collapse: collapse; background: transparent !important; position: relative; z-index: 1;">
                                        <tr>
                                            <td style="width: 18%; border-bottom: 1px solid #000; vertical-align: middle; text-align: center; padding: 1px 3px 3px 3px;">
                                                <img id="prev-logo-kiri" src="<?= $logoKiriUrl ?>" onerror="this.style.display='none'" style="width: 44px; height: 44px; object-fit: contain;">
                                            </td>
                                            <td style="width: 64%; border-bottom: 1px solid #000; vertical-align: top; text-align: center; overflow: hidden; padding: 1px 2px 0 2px;">
                                                <div id="prev-header-1" style="font-family: 'Times New Roman', serif; font-size: 7.5pt; line-height: 1.1;"><?= isset($kartu->header_1) ? $kartu->header_1 : '' ?></div>
                                                <div id="prev-header-2" style="font-family: 'Times New Roman', serif; font-size: 8.5pt; font-weight: bold; line-height: 1.1;"><?= isset($kartu->header_2) ? $kartu->header_2 : '' ?></div>
                                                <div id="prev-header-3" style="font-family: 'Times New Roman', serif; font-size: 7pt; line-height: 1.1;"><?= isset($kartu->header_3) ? $kartu->header_3 : '' ?></div>
                                                <div id="prev-header-4" style="font-family: 'Times New Roman', serif; font-size: 7pt; line-height: 1.1;"><?= isset($kartu->header_4) ? $kartu->header_4 : '' ?></div>
                                            </td>
                                            <td style="width: 18%; border-bottom: 1px solid #000; vertical-align: middle; text-align: center; padding: 1px 3px 3px 3px;">
                                                <img id="prev-logo-kanan" src="<?= $logoKananUrl ?>" onerror="this.style.display='none'" style="width: 44px; height: 44px; object-fit: contain;">
                                            </td>
                                        </tr>
                                    </table>
                                    <table id="table-body" style="width: 100%; table-layout: fixed; border-collapse: collapse; background: transparent !important; position: relative; z-index: 1;">
                                        <tr>
                                            <td style="padding: 1px 0 1px 12px; width: 30%; white-space: nowrap; font-family: 'Times New Roman', serif; font-size: 8pt; vertical-align: top;">No. Peserta</td>
                                            <td style="padding: 1px 3px; width: 5%; font-family: 'Times New Roman', serif; font-size: 8pt; vertical-align: top;">:</td>
                                            <td style="padding: 1px 5px 1px 0; width: 65%; word-break: break-word; font-family: 'Times New Roman', serif; font-size: 8pt; vertical-align: top;">0000.00.000</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 1px 0 1px 12px; font-family: 'Times New Roman', serif; font-size: 8pt; vertical-align: top;">Nama</td>
                                            <td style="padding: 1px 3px; font-family: 'Times New Roman', serif; font-size: 8pt; vertical-align: top;">:</td>
                                            <td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: 'Times New Roman', serif; font-size: 8pt; vertical-align: top;"><b>Nama Siswa</b></td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 1px 0 1px 12px; font-family: 'Times New Roman', serif; font-size: 8pt; vertical-align: top;">NIS/NISN</td>
                                            <td style="padding: 1px 3px; font-family: 'Times New Roman', serif; font-size: 8pt; vertical-align: top;">:</td>
                                            <td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: 'Times New Roman', serif; font-size: 8pt; vertical-align: top;">012334455</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 1px 0 1px 12px; font-family: 'Times New Roman', serif; font-size: 8pt; vertical-align: top;">Kelas</td>
                                            <td style="padding: 1px 3px; font-family: 'Times New Roman', serif; font-size: 8pt; vertical-align: top;">:</td>
                                            <td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: 'Times New Roman', serif; font-size: 8pt; vertical-align: top;">IX-A</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 1px 0 1px 12px; font-family: 'Times New Roman', serif; font-size: 8pt; vertical-align: top;">Ruang/Sesi</td>
                                            <td style="padding: 1px 3px; font-family: 'Times New Roman', serif; font-size: 8pt; vertical-align: top;">:</td>
                                            <td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: 'Times New Roman', serif; font-size: 8pt; vertical-align: top;">LAB-KOM/S1</td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 1px 0 1px 12px; font-family: 'Times New Roman', serif; font-size: 8pt; vertical-align: top;">Username</td>
                                            <td style="padding: 1px 3px; font-family: 'Times New Roman', serif; font-size: 8pt; vertical-align: top;">:</td>
                                            <td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: 'Times New Roman', serif; font-size: 8pt; vertical-align: top;"><b>umbk001</b></td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 1px 0 1px 12px; font-family: 'Times New Roman', serif; font-size: 8pt; vertical-align: top;">Password</td>
                                            <td style="padding: 1px 3px; font-family: 'Times New Roman', serif; font-size: 8pt; vertical-align: top;">:</td>
                                            <td style="padding: 1px 5px 1px 0; font-family: 'Times New Roman', serif; font-size: 8pt; vertical-align: top;"><div style="word-break: break-all;"><b>umbk001</b></div></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding: 5px 0 5px 12px; vertical-align: middle;">
                                                <img style="width: 52px; height: 62px; object-fit: cover; object-position: center; border: 1px solid #000;" src="<?= base_url('assets/img/siswa.png') ?>">
                                            </td>
                                            <td class="ttd-cell" style="text-align: center; vertical-align: middle; font-family: 'Times New Roman', serif; font-size: 7.5pt; <?= $bgTtd ?>">
                                                <span id="prev-kota"><?= $setting->kota ?></span>, <span id="prev-tanggal"><?= isset($kartu->tanggal) ? $kartu->tanggal : '' ?></span><br>
                                                <?= $kepsekLabel ?><br><br><br>
                                                <span id="prev-kepsek"><u><?= $setting->kepsek ?></u></span><br>
                                                <span id="prev-nip" style="font-size: 7pt;"><?= esc($setting->label_nip ?? 'NIP') ?>: <?= ($setting->nip != null && trim($setting->nip) != '') ? esc($setting->nip) : '-' ?></span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>

                    <div class="card my-shadow">
                        <div class="card-header">
                            <div class="card-title fw-bold">
                                Cetak
                            </div>
                        </div>
                        <div class="card-body pb-4">
                            <div class="row align-items-center">
                                <div class="col-md-7 col-12 mb-3 mb-md-0">
                                    <div class="input-group">
                                        <?php
                                        echo form_dropdown(
                                            'kelas',
                                            $kelas,
                                            null,
                                            'id="kelas" class="form-control select2"'
                                        ); ?>
                                    </div>
                                    <div class="input-group">
                                        <?php
                                        echo form_dropdown(
                                            'ruang',
                                            $ruang,
                                            null,
                                            'id="ruang" class="form-control d-none"'
                                        ); ?>
                                    </div>
                                    <div class="mt-2">
                                        <small class="text-muted" style="font-size: 0.78rem; line-height: 1.45; display: block;">
                                            <b>Tipe 1:</b> Kartu Siswa lengkap (foto, nama, NIS, username, password)<br>
                                            <b>Tipe 2:</b> Kartu Meja simpel (Nomor Ujian 14pt besar samping tanda tangan)<br>
                                            <b>Tipe 3:</b> Kartu Meja sensor (Format sama Tipe 1, Nama, User, PW disensor ***)
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-5 col-12">
                                    <div class="d-flex flex-column gap-2">
                                        <button type="button" class="btn btn-success fw-bold shadow-sm d-flex align-items-center justify-content-center py-2" id="btn-print-tipe1" onclick="cetakKartu(1)">
                                            <i class="fa fa-print me-1.5"></i> Cetak Tipe 1
                                        </button>
                                        <button type="button" class="btn text-white fw-bold shadow-sm d-flex align-items-center justify-content-center py-2" id="btn-print-tipe2" onclick="cetakKartu(2)" style="background-color: #f97316; border-color: #ea580c;">
                                            <i class="fa fa-print me-1.5"></i> Cetak Tipe 2
                                        </button>
                                        <button type="button" class="btn text-white fw-bold shadow-sm d-flex align-items-center justify-content-center py-2" id="btn-print-tipe3" onclick="cetakKartu(3)" style="background-color: #6366f1; border-color: #4f46e5;">
                                            <i class="fa fa-print me-1.5"></i> Cetak Tipe 3 (Sensor ***)
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card my-shadow">
                        <div class="card-header">
                            <div class="card-title">
                                Preview
                            </div>
                        </div>
                        <div class="card-body pb-4">
                            <div class="bg-gray-light" style="min-height: 200px; overflow-x: auto; padding: 16px; display: flex; justify-content: center;">
                                <div id="print-preview" style="transform-origin: top center;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?= rtrim(base_url(), '/') ?>/assets/app/js/cetak-area.js?v=<?= time() ?>"></script>
<script>
    var base_url = "<?= rtrim(base_url(), '/') ?>/";
    var oldVal1 = "<?= isset($kartu->header_1) ? $kartu->header_1 : "" ?>";
    var oldVal2 = "<?= isset($kartu->header_2) ? $kartu->header_2 : "" ?>";
    var oldVal3 = "<?= isset($kartu->header_3) ? $kartu->header_3 : "" ?>";
    var oldVal4 = "<?= isset($kartu->header_4) ? $kartu->header_4 : "" ?>";
    var oldTgl = "<?= isset($kartu->tanggal) ? $kartu->tanggal : "" ?>";
    var oldKota = "<?=$setting->kota?>";
    var logoKanan = "<?= $logoKananUrl ?>";
    var logoKiri = "<?= $logoKiriUrl ?>";
    var tandatangan = "<?= $ttdUrl ?>";
    var kepsek = "<?= $setting->kepsek ?>";
    var nip = "<?= $setting->nip ?>";
    var labelNip = "<?= $setting->label_nip ?? 'NIP' ?>";
    var satuanPend = "<?= $satuanPend ?>";
    var kepsekLabel = "<?= $kepsekLabel ?>";
    var printBy = 1;

    var raporSetting = JSON.parse(JSON.stringify(<?= json_encode($setting_rapor) ?>));
    var nipKepsek = nip != null && nip.trim() !== "" ? nip : " -";

    function submitKartu() {
        $('#set-kartu').submit();
    }

    var activeTipe = 1; // 1 = Kartu Siswa, 2 = Kartu Meja
    var lastResponseData = null;

    function renderTopPreview(tipe) {
        var h1 = $('#header-1').val() || oldVal1 || 'Header 1';
        var h2 = $('#header-2').val() || oldVal2 || 'Header 2';
        var h3 = $('#header-3').val() || oldVal3 || 'Header 3';
        var h4 = $('#header-4').val() || oldVal4 || 'Header 4';
        var tgl = $('#input-tanggal').val() || oldTgl || '';
        var bgSignature = tandatangan ? "background: url('" + tandatangan + "') no-repeat center / contain !important;" : "";

        var headerTable = '<table style="width: 100%; table-layout: fixed; border-collapse: collapse; background: transparent !important; position: relative; z-index: 1;">' +
            '<tr>' +
            '<td style="width: 18%; border-bottom: 1px solid #000; vertical-align: middle; text-align: center; padding: 1px 3px 3px 3px;">' +
            '<img id="prev-logo-kiri" src="' + logoKiri + '" onerror="this.style.display=\'none\'" style="width: 44px; height: 44px; object-fit: contain;">' +
            '</td>' +
            '<td style="width: 64%; border-bottom: 1px solid #000; vertical-align: top; text-align: center; overflow: hidden; padding: 1px 2px 0 2px;">' +
            '<div id="prev-header-1" style="font-family: \'Times New Roman\', serif; font-size: 7.5pt; line-height: 1.1;">' + h1 + '</div>' +
            '<div id="prev-header-2" style="font-family: \'Times New Roman\', serif; font-size: 8.5pt; font-weight: bold; line-height: 1.1;">' + h2 + '</div>' +
            '<div id="prev-header-3" style="font-family: \'Times New Roman\', serif; font-size: 7pt; line-height: 1.1;">' + h3 + '</div>' +
            '<div id="prev-header-4" style="font-family: \'Times New Roman\', serif; font-size: 7pt; line-height: 1.1;">' + h4 + '</div>' +
            '</td>' +
            '<td style="width: 18%; border-bottom: 1px solid #000; vertical-align: middle; text-align: center; padding: 1px 3px 3px 3px;">' +
            '<img id="prev-logo-kanan" src="' + logoKanan + '" onerror="this.style.display=\'none\'" style="width: 44px; height: 44px; object-fit: contain;">' +
            '</td>' +
            '</tr>' +
            '</table>';

        var watermark = '<div class="kartu-watermark" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; display: flex; justify-content: center; align-items: center; opacity: 0.15; pointer-events: none; z-index: 0;">' +
            '<img src="' + logoKiri + '" onerror="this.style.display=\'none\'" style="width: 120px; height: auto; margin-top: 50px;">' +
            '</div>';

        var html = '';
        if (tipe === 2) {
            html = '<div id="prev-top-card" class="kartu-item" style="position: relative; box-sizing: border-box; border: 1px solid #000; width: 360px; min-width: 200px; overflow: hidden; background: #fff;">' +
                watermark +
                headerTable +
                '<table style="width: 100%; table-layout: fixed; border-collapse: collapse; border-bottom: 1px solid #000; background: transparent !important; position: relative; z-index: 1;">' +
                '<tr>' +
                '<td style="padding: 2px 0 1px 12px; width: 25%; font-family: \'Times New Roman\', serif; font-size: 8.5pt; vertical-align: middle;">Kelas</td>' +
                '<td style="padding: 2px 3px; width: 4%; font-family: \'Times New Roman\', serif; font-size: 8.5pt; vertical-align: middle;">:</td>' +
                '<td style="padding: 2px 5px 1px 0; width: 71%; font-family: \'Times New Roman\', serif; font-size: 8.5pt; vertical-align: middle;"><b>IX A</b></td>' +
                '</tr><tr>' +
                '<td style="padding: 1px 0 2px 12px; font-family: \'Times New Roman\', serif; font-size: 8.5pt; vertical-align: middle;">Ruang/Sesi</td>' +
                '<td style="padding: 1px 3px 2px; font-family: \'Times New Roman\', serif; font-size: 8.5pt; vertical-align: middle;">:</td>' +
                '<td style="padding: 1px 5px 2px 0; font-family: \'Times New Roman\', serif; font-size: 8.5pt; vertical-align: middle;">1/2</td>' +
                '</tr>' +
                '</table>' +
                '<table style="width: 100%; table-layout: fixed; border-collapse: collapse; background: transparent !important; position: relative; z-index: 1;">' +
                '<tr>' +
                '<td style="width: 53%; vertical-align: middle; text-align: center; padding: 16px 4px; border-right: 1px solid #000;">' +
                '<div style="font-family: \'Times New Roman\', serif; font-size: 8.5pt; color: #222; margin-bottom: 4px;">Nomor Ujian</div>' +
                '<div style="font-family: \'Times New Roman\', serif; font-size: 14pt; font-weight: bold; letter-spacing: 0.5px; color: #000;">03-137-081-8</div>' +
                '</td>' +
                '<td class="ttd-cell" style="width: 47%; text-align: center; vertical-align: middle; padding: 4px 2px; font-family: \'Times New Roman\', serif; font-size: 7.5pt; ' + bgSignature + '">' +
                oldKota + ', <span id="prev-tanggal">' + tgl + '</span><br>' + kepsekLabel + '<br><br><br>' +
                '<u>' + kepsek + '</u><br>' + labelNip + ': ' + nipKepsek +
                '</td>' +
                '</tr>' +
                '</table>' +
                '</div>';
        } else if (tipe === 3) {
            html = '<div id="prev-top-card" class="kartu-item" style="position: relative; box-sizing: border-box; border: 1px solid #000; width: 360px; min-width: 200px; overflow: hidden; background: #fff;">' +
                watermark +
                headerTable +
                '<table id="table-body" style="width: 100%; table-layout: fixed; border-collapse: collapse; background: transparent !important; position: relative; z-index: 1;">' +
                '<tr>' +
                '<td style="padding: 1px 0 1px 12px; width: 30%; white-space: nowrap; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">Nomor Peserta</td>' +
                '<td style="padding: 1px 3px; width: 5%; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">:</td>' +
                '<td style="padding: 1px 5px 1px 0; width: 65%; word-break: break-word; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;"><b>0000.00.000</b></td>' +
                '</tr>' +
                '<tr>' +
                '<td style="padding: 1px 0 1px 12px; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">Nama</td>' +
                '<td style="padding: 1px 3px; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">:</td>' +
                '<td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;"><b style="letter-spacing: 2px;">***</b></td>' +
                '</tr>' +
                '<tr>' +
                '<td style="padding: 1px 0 1px 12px; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">NIS/NISN</td>' +
                '<td style="padding: 1px 3px; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">:</td>' +
                '<td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">012334455</td>' +
                '</tr>' +
                '<tr>' +
                '<td style="padding: 1px 0 1px 12px; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">Kelas</td>' +
                '<td style="padding: 1px 3px; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">:</td>' +
                '<td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">IXA</td>' +
                '</tr>' +
                '<tr>' +
                '<td style="padding: 1px 0 1px 12px; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">Ruang/Sesi</td>' +
                '<td style="padding: 1px 3px; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">:</td>' +
                '<td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">1/2</td>' +
                '</tr>' +
                '<tr>' +
                '<td style="padding: 1px 0 1px 12px; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">Username</td>' +
                '<td style="padding: 1px 3px; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">:</td>' +
                '<td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;"><b style="letter-spacing: 2px;">***</b></td>' +
                '</tr>' +
                '<tr>' +
                '<td style="padding: 1px 0 1px 12px; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">Password</td>' +
                '<td style="padding: 1px 3px; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">:</td>' +
                '<td style="padding: 1px 5px 1px 0; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;"><div style="word-break: break-all;"><b style="letter-spacing: 2px;">***</b></div></td>' +
                '</tr>' +
                '<tr>' +
                '<td colspan="2" style="padding: 5px 0 5px 12px; vertical-align: middle;">' +
                '<img style="width: 52px; height: 62px; object-fit: cover; object-position: center; border: 1px solid #000;" src="' + base_url + 'assets/img/siswa.png">' +
                '</td>' +
                '<td class="ttd-cell" style="text-align: center; vertical-align: middle; font-family: \'Times New Roman\', serif; font-size: 7.5pt; ' + bgSignature + '">' +
                oldKota + ', <span id="prev-tanggal">' + tgl + '</span><br>' + kepsekLabel + '<br><br><br>' +
                '<u>' + kepsek + '</u><br>' + labelNip + ': ' + nipKepsek +
                '</td>' +
                '</tr>' +
                '</table>' +
                '</div>';
        } else {
            html = '<div id="prev-top-card" class="kartu-item" style="position: relative; box-sizing: border-box; border: 1px solid #000; width: 360px; min-width: 200px; overflow: hidden; background: #fff;">' +
                watermark +
                headerTable +
                '<table id="table-body" style="width: 100%; table-layout: fixed; border-collapse: collapse; background: transparent !important; position: relative; z-index: 1;">' +
                '<tr>' +
                '<td style="padding: 1px 0 1px 12px; width: 30%; white-space: nowrap; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">Nomor Peserta</td>' +
                '<td style="padding: 1px 3px; width: 5%; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">:</td>' +
                '<td style="padding: 1px 5px 1px 0; width: 65%; word-break: break-word; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">0000.00.000</td>' +
                '</tr>' +
                '<tr>' +
                '<td style="padding: 1px 0 1px 12px; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">Nama</td>' +
                '<td style="padding: 1px 3px; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">:</td>' +
                '<td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;"><b>Nama Siswa</b></td>' +
                '</tr>' +
                '<tr>' +
                '<td style="padding: 1px 0 1px 12px; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">NIS/NISN</td>' +
                '<td style="padding: 1px 3px; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">:</td>' +
                '<td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">012334455</td>' +
                '</tr>' +
                '<tr>' +
                '<td style="padding: 1px 0 1px 12px; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">Kelas</td>' +
                '<td style="padding: 1px 3px; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">:</td>' +
                '<td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">IXA</td>' +
                '</tr>' +
                '<tr>' +
                '<td style="padding: 1px 0 1px 12px; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">Ruang/Sesi</td>' +
                '<td style="padding: 1px 3px; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">:</td>' +
                '<td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">1/2</td>' +
                '</tr>' +
                '<tr>' +
                '<td style="padding: 1px 0 1px 12px; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">Username</td>' +
                '<td style="padding: 1px 3px; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">:</td>' +
                '<td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;"><b>umbk001</b></td>' +
                '</tr>' +
                '<tr>' +
                '<td style="padding: 1px 0 1px 12px; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">Password</td>' +
                '<td style="padding: 1px 3px; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;">:</td>' +
                '<td style="padding: 1px 5px 1px 0; font-family: \'Times New Roman\', serif; font-size: 8pt; vertical-align: top;"><div style="word-break: break-all;"><b>umbk001</b></div></td>' +
                '</tr>' +
                '<tr>' +
                '<td colspan="2" style="padding: 5px 0 5px 12px; vertical-align: middle;">' +
                '<img style="width: 52px; height: 62px; object-fit: cover; object-position: center; border: 1px solid #000;" src="' + base_url + 'assets/img/siswa.png">' +
                '</td>' +
                '<td class="ttd-cell" style="text-align: center; vertical-align: middle; font-family: \'Times New Roman\', serif; font-size: 7.5pt; ' + bgSignature + '">' +
                oldKota + ', <span id="prev-tanggal">' + tgl + '</span><br>' + kepsekLabel + '<br><br><br>' +
                '<u>' + kepsek + '</u><br>' + labelNip + ': ' + nipKepsek +
                '</td>' +
                '</tr>' +
                '</table>' +
                '</div>';
        }
        $('#prev-top-wrapper').html(html);
    }

    function switchTipe(tipe) {
        activeTipe = tipe;
        $('#btn-tipe-1, #btn-tipe-2, #btn-tipe-3').removeClass('btn-primary active text-white').addClass('btn-outline-primary');
        $('#btn-tipe-' + tipe).addClass('btn-primary active text-white').removeClass('btn-outline-primary');
        renderTopPreview(tipe);
        if (lastResponseData) {
            createPrintPreview(lastResponseData, tipe);
        }
    }

    function cetakKartu(tipe) {
        if (!$('#kelas').val() && !$('#ruang').val()) {
            Swal.fire({
                title: "Peringatan",
                text: "Silakan pilih kelas terlebih dahulu.",
                icon: "warning"
            });
            return;
        }
        switchTipe(tipe);
        setTimeout(function() {
            if (typeof $('#print-preview').print === 'function') {
                $('#print-preview').print(document.title);
            } else {
                window.print();
            }
        }, 250);
    }

    function buildCardTipe1(d, ruang, sesi) {
        return '<div class="kartu-item" style="position: relative; box-sizing: border-box; border: 1px solid #000; overflow: hidden; background: #fff;">' +
            '<div class="kartu-watermark" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; display: flex; justify-content: center; align-items: center; opacity: 0.15; pointer-events: none; z-index: 0;">' +
            '<img src="' + logoKiri + '" onerror="this.style.display=\'none\'" style="width: 120px; height: auto; margin-top: 50px;">' +
            '</div>' +
            '<table style="width: 100%; table-layout: fixed; border-collapse: collapse; background: transparent !important; position: relative; z-index: 1;">' +
            '<tr>' +
            '<td style="width: 18%; border-bottom: 1px solid #000; vertical-align: middle; text-align: center; padding: 1px 3px 3px 3px;">' +
            '<img src="' + logoKiri + '" onerror="this.style.display=\'none\'" style="width: 44px; height: 44px; object-fit: contain;">' +
            '</td>' +
            '<td style="width: 64%; border-bottom: 1px solid #000; text-align: center; vertical-align: top; overflow: hidden; padding: 1px 2px 0 2px;">' +
            '<div style="font-family: Times New Roman, serif; font-size: 7.5pt; line-height: 1.1;">' + oldVal1 + '</div>' +
            '<div style="font-family: Times New Roman, serif; font-size: 8.5pt; font-weight: bold; line-height: 1.1;">' + oldVal2 + '</div>' +
            '<div style="font-family: Times New Roman, serif; font-size: 7pt; line-height: 1.1;">' + oldVal3 + '</div>' +
            '<div style="font-family: Times New Roman, serif; font-size: 7pt; line-height: 1.1;">' + oldVal4 + '</div>' +
            '</td>' +
            '<td style="width: 18%; border-bottom: 1px solid #000; vertical-align: middle; text-align: center; padding: 1px 3px 3px 3px;">' +
            '<img src="' + logoKanan + '" onerror="this.style.display=\'none\'" style="width: 44px; height: 44px; object-fit: contain;">' +
            '</td>' +
            '</tr>' +
            '</table>' +
            '<table style="width: 100%; table-layout: fixed; border-collapse: collapse; background: transparent !important; position: relative; z-index: 1;">' +
            '<tr>' +
            '<td style="padding: 1px 0 1px 12px; width: 30%; white-space: nowrap; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">Nomor Peserta</td>' +
            '<td style="padding: 1px 3px; width: 5%; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">:</td>' +
            '<td style="padding: 1px 5px 1px 0; width: 65%; word-break: break-word; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">' + (d?.nomor_peserta || '') + '</td>' +
            '</tr><tr>' +
            '<td style="padding: 1px 0 1px 12px; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">Nama</td>' +
            '<td style="padding: 1px 3px; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">:</td>' +
            '<td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;"><b>' + (d?.nama || '') + '</b></td>' +
            '</tr><tr>' +
            '<td style="padding: 1px 0 1px 12px; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">NIS/NISN</td>' +
            '<td style="padding: 1px 3px; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">:</td>' +
            '<td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">' + (d?.nis || '') + '/' + (d?.nisn || '') + '</td>' +
            '</tr><tr>' +
            '<td style="padding: 1px 0 1px 12px; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">Kelas</td>' +
            '<td style="padding: 1px 3px; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">:</td>' +
            '<td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">' + (d?.nama_kelas || '') + '</td>' +
            '</tr><tr>' +
            '<td style="padding: 1px 0 1px 12px; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">Ruang/Sesi</td>' +
            '<td style="padding: 1px 3px; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">:</td>' +
            '<td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">' + (ruang || '') + '/' + (sesi || '') + '</td>' +
            '</tr><tr>' +
            '<td style="padding: 1px 0 1px 12px; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">Username</td>' +
            '<td style="padding: 1px 3px; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">:</td>' +
            '<td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;"><b>' + (d?.username || '') + '</b></td>' +
            '</tr><tr>' +
            '<td style="padding: 1px 0 1px 12px; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">Password</td>' +
            '<td style="padding: 1px 3px; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">:</td>' +
            '<td style="padding: 1px 5px 1px 0; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;"><div style="word-break: break-all;"><b>' + (d?.password || '') + '</b></div></td>' +
            '</tr><tr>' +
            '<td colspan="2" style="padding: 5px 0 5px 12px; vertical-align: middle;">' +
            '<img style="width: 52px; height: 62px; object-fit: cover; object-position: center; border: 1px solid #000;" src="' + base_url + (d?.foto ? String(d.foto).replace(/^\/+/, '') : 'assets/img/siswa.png') + '" onerror="this.src=\'' + base_url + 'assets/img/siswa.png\'">' +
            '</td>' +
            '<td class="ttd-cell" style="text-align: center; vertical-align: middle; font-family: Times New Roman, serif; font-size: 7.5pt; ' + (tandatangan ? 'background: url(\'' + tandatangan + '\') no-repeat center / contain !important;' : '') + '">' +
            oldKota + ', ' + oldTgl + '<br>' + kepsekLabel + '<br><br><br>' +
            '<u>' + kepsek + '</u><br>' + labelNip + ': ' + nipKepsek +
            '</td>' +
            '</tr>' +
            '</table>' +
            '</div>';
    }

    function buildCardTipe2(d, ruang, sesi) {
        var noPeserta = (d && d.nomor_peserta && d.nomor_peserta.trim() !== '') ? d.nomor_peserta : '-';
        var namaKelas = (d && d.nama_kelas) ? d.nama_kelas : '';
        var ruangSesi = (ruang || '-') + ' / ' + (sesi || '-');

        return '<div class="kartu-item" style="position: relative; box-sizing: border-box; border: 1px solid #000; overflow: hidden; background: #fff;">' +
            '<div class="kartu-watermark" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; display: flex; justify-content: center; align-items: center; opacity: 0.15; pointer-events: none; z-index: 0;">' +
            '<img src="' + logoKiri + '" onerror="this.style.display=\'none\'" style="width: 120px; height: auto; margin-top: 30px;">' +
            '</div>' +
            '<table style="width: 100%; table-layout: fixed; border-collapse: collapse; background: transparent !important; position: relative; z-index: 1;">' +
            '<tr>' +
            '<td style="width: 18%; border-bottom: 1px solid #000; vertical-align: middle; text-align: center; padding: 1px 3px 3px 3px;">' +
            '<img src="' + logoKiri + '" onerror="this.style.display=\'none\'" style="width: 44px; height: 44px; object-fit: contain;">' +
            '</td>' +
            '<td style="width: 64%; border-bottom: 1px solid #000; text-align: center; vertical-align: top; overflow: hidden; padding: 1px 2px 0 2px;">' +
            '<div style="font-family: Times New Roman, serif; font-size: 7.5pt; line-height: 1.1;">' + oldVal1 + '</div>' +
            '<div style="font-family: Times New Roman, serif; font-size: 8.5pt; font-weight: bold; line-height: 1.1;">' + oldVal2 + '</div>' +
            '<div style="font-family: Times New Roman, serif; font-size: 7pt; line-height: 1.1;">' + oldVal3 + '</div>' +
            '<div style="font-family: Times New Roman, serif; font-size: 7pt; line-height: 1.1;">' + oldVal4 + '</div>' +
            '</td>' +
            '<td style="width: 18%; border-bottom: 1px solid #000; vertical-align: middle; text-align: center; padding: 1px 3px 3px 3px;">' +
            '<img src="' + logoKanan + '" onerror="this.style.display=\'none\'" style="width: 44px; height: 44px; object-fit: contain;">' +
            '</td>' +
            '</tr>' +
            '</table>' +
            '<table style="width: 100%; table-layout: fixed; border-collapse: collapse; border-bottom: 1px solid #000; background: transparent !important; position: relative; z-index: 1;">' +
            '<tr>' +
            '<td style="padding: 2px 0 1px 12px; width: 25%; font-family: Times New Roman, serif; font-size: 8.5pt; vertical-align: middle;">Kelas</td>' +
            '<td style="padding: 2px 3px; width: 4%; font-family: Times New Roman, serif; font-size: 8.5pt; vertical-align: middle;">:</td>' +
            '<td style="padding: 2px 5px 1px 0; width: 71%; font-family: Times New Roman, serif; font-size: 8.5pt; vertical-align: middle;"><b>' + namaKelas + '</b></td>' +
            '</tr><tr>' +
            '<td style="padding: 1px 0 2px 12px; font-family: Times New Roman, serif; font-size: 8.5pt; vertical-align: middle;">Ruang/Sesi</td>' +
            '<td style="padding: 1px 3px 2px; font-family: Times New Roman, serif; font-size: 8.5pt; vertical-align: middle;">:</td>' +
            '<td style="padding: 1px 5px 2px 0; font-family: Times New Roman, serif; font-size: 8.5pt; vertical-align: middle;">' + ruangSesi + '</td>' +
            '</tr>' +
            '</table>' +
            '<table style="width: 100%; table-layout: fixed; border-collapse: collapse; background: transparent !important; position: relative; z-index: 1;">' +
            '<tr>' +
            '<td style="width: 53%; vertical-align: middle; text-align: center; padding: 10px 4px; border-right: 1px solid #000;">' +
            '<div style="font-family: Times New Roman, serif; font-size: 8.5pt; color: #222; margin-bottom: 4px;">Nomor Ujian</div>' +
            '<div style="font-family: Times New Roman, serif; font-size: 14pt; font-weight: bold; letter-spacing: 0.5px; color: #000;">' + noPeserta + '</div>' +
            '</td>' +
            '<td class="ttd-cell" style="width: 47%; text-align: center; vertical-align: middle; padding: 4px 2px; font-family: Times New Roman, serif; font-size: 7.5pt; ' + (tandatangan ? 'background: url(\'' + tandatangan + '\') no-repeat center / contain !important;' : '') + '">' +
            oldKota + ', ' + oldTgl + '<br>' + kepsekLabel + '<br><br><br>' +
            '<u>' + kepsek + '</u><br>' + labelNip + ': ' + nipKepsek +
            '</td>' +
            '</tr>' +
            '</table>' +
            '</div>';
    }

    function buildCardTipe3(d, ruang, sesi) {
        return '<div class="kartu-item" style="position: relative; box-sizing: border-box; border: 1px solid #000; overflow: hidden; background: #fff;">' +
            '<div class="kartu-watermark" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; display: flex; justify-content: center; align-items: center; opacity: 0.15; pointer-events: none; z-index: 0;">' +
            '<img src="' + logoKiri + '" onerror="this.style.display=\'none\'" style="width: 120px; height: auto; margin-top: 50px;">' +
            '</div>' +
            '<table style="width: 100%; table-layout: fixed; border-collapse: collapse; background: transparent !important; position: relative; z-index: 1;">' +
            '<tr>' +
            '<td style="width: 18%; border-bottom: 1px solid #000; vertical-align: middle; text-align: center; padding: 1px 3px 3px 3px;">' +
            '<img src="' + logoKiri + '" onerror="this.style.display=\'none\'" style="width: 44px; height: 44px; object-fit: contain;">' +
            '</td>' +
            '<td style="width: 64%; border-bottom: 1px solid #000; text-align: center; vertical-align: top; overflow: hidden; padding: 1px 2px 0 2px;">' +
            '<div style="font-family: Times New Roman, serif; font-size: 7.5pt; line-height: 1.1;">' + oldVal1 + '</div>' +
            '<div style="font-family: Times New Roman, serif; font-size: 8.5pt; font-weight: bold; line-height: 1.1;">' + oldVal2 + '</div>' +
            '<div style="font-family: Times New Roman, serif; font-size: 7pt; line-height: 1.1;">' + oldVal3 + '</div>' +
            '<div style="font-family: Times New Roman, serif; font-size: 7pt; line-height: 1.1;">' + oldVal4 + '</div>' +
            '</td>' +
            '<td style="width: 18%; border-bottom: 1px solid #000; vertical-align: middle; text-align: center; padding: 1px 3px 3px 3px;">' +
            '<img src="' + logoKanan + '" onerror="this.style.display=\'none\'" style="width: 44px; height: 44px; object-fit: contain;">' +
            '</td>' +
            '</tr>' +
            '</table>' +
            '<table style="width: 100%; table-layout: fixed; border-collapse: collapse; background: transparent !important; position: relative; z-index: 1;">' +
            '<tr>' +
            '<td style="padding: 1px 0 1px 12px; width: 30%; white-space: nowrap; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">Nomor Peserta</td>' +
            '<td style="padding: 1px 3px; width: 5%; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">:</td>' +
            '<td style="padding: 1px 5px 1px 0; width: 65%; word-break: break-word; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;"><b>' + (d?.nomor_peserta || '-') + '</b></td>' +
            '</tr><tr>' +
            '<td style="padding: 1px 0 1px 12px; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">Nama</td>' +
            '<td style="padding: 1px 3px; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">:</td>' +
            '<td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;"><b style="letter-spacing: 2px;">***</b></td>' +
            '</tr><tr>' +
            '<td style="padding: 1px 0 1px 12px; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">NIS/NISN</td>' +
            '<td style="padding: 1px 3px; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">:</td>' +
            '<td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">' + (d?.nis || '-') + '/' + (d?.nisn || '-') + '</td>' +
            '</tr><tr>' +
            '<td style="padding: 1px 0 1px 12px; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">Kelas</td>' +
            '<td style="padding: 1px 3px; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">:</td>' +
            '<td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">' + (d?.nama_kelas || '') + '</td>' +
            '</tr><tr>' +
            '<td style="padding: 1px 0 1px 12px; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">Ruang/Sesi</td>' +
            '<td style="padding: 1px 3px; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">:</td>' +
            '<td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">' + (ruang || '-') + '/' + (sesi || '-') + '</td>' +
            '</tr><tr>' +
            '<td style="padding: 1px 0 1px 12px; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">Username</td>' +
            '<td style="padding: 1px 3px; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">:</td>' +
            '<td style="padding: 1px 5px 1px 0; word-break: break-word; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;"><b style="letter-spacing: 2px;">***</b></td>' +
            '</tr><tr>' +
            '<td style="padding: 1px 0 1px 12px; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">Password</td>' +
            '<td style="padding: 1px 3px; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;">:</td>' +
            '<td style="padding: 1px 5px 1px 0; font-family: Times New Roman, serif; font-size: 8pt; vertical-align: top;"><div style="word-break: break-all;"><b style="letter-spacing: 2px;">***</b></div></td>' +
            '</tr><tr>' +
            '<td colspan="2" style="padding: 5px 0 5px 12px; vertical-align: middle;">' +
            '<img style="width: 52px; height: 62px; object-fit: cover; object-position: center; border: 1px solid #000;" src="' + base_url + 'assets/img/siswa.png">' +
            '</td>' +
            '<td class="ttd-cell" style="text-align: center; vertical-align: middle; font-family: Times New Roman, serif; font-size: 7.5pt; ' + (tandatangan ? 'background: url(\'' + tandatangan + '\') no-repeat center / contain !important;' : '') + '">' +
            oldKota + ', ' + oldTgl + '<br>' + kepsekLabel + '<br><br><br>' +
            '<u>' + kepsek + '</u><br>' + labelNip + ': ' + nipKepsek +
            '</td>' +
            '</tr>' +
            '</table>' +
            '</div>';
    }

    function buildCard(d, ruang, sesi, tipe) {
        var t = (typeof tipe !== 'undefined') ? tipe : activeTipe;
        if (t === 2) return buildCardTipe2(d, ruang, sesi);
        if (t === 3) return buildCardTipe3(d, ruang, sesi);
        return buildCardTipe1(d, ruang, sesi);
    }

    function createPrintPreview(response, tipe) {
        if (!response) return;
        lastResponseData = response;
        if (typeof tipe !== 'undefined') {
            activeTipe = tipe;
        }

        const data = response.siswa;
        var konten = '';
        if (data && data.length > 0) {
            // A4 at 96dpi = 794px, minus 10mm (38px) margins each side = 718px usable
            var pageW = 718;
            var pages = Math.ceil(data.length / 8);
            for (let a = 0; a < pages; a++) {
                let t = a * 8;
                let end = Math.min(t + 8, data.length);
                var isLastPage = (a === pages - 1);
                var breakStyle = isLastPage ? 'page-break-after: avoid; break-after: avoid;' : 'page-break-after: always; break-after: page;';

                var pageHtml = '<div class="kartu-cetak-card' + (isLastPage ? ' last-page' : '') + '" style="width: ' + pageW + 'px; background: white; padding: 0; box-sizing: border-box; margin: 0 auto 8px auto; ' + breakStyle + '">';
                pageHtml += '<table style="width: 100%; table-layout: fixed; border-collapse: collapse; border-spacing: 0; background: transparent !important;">';

                for (let i = t; i < end; i += 2) {
                    var setSiswa0 = data[i]?.set_siswa === '1';
                    var ruang0 = setSiswa0 ? data[i]?.ruang_kelas : data[i]?.kode_ruang;
                    var sesi0 = setSiswa0 ? data[i]?.sesi_kelas : data[i]?.kode_sesi;

                    var cardHtml0 = buildCard(data[i], ruang0, sesi0, activeTipe);

                    pageHtml += '<tr>';
                    pageHtml += '<td style="width: 50%; vertical-align: top; padding: 4px; box-sizing: border-box;">' + cardHtml0 + '</td>';

                    if (i + 1 < end) {
                        var setSiswa1 = data[i+1]?.set_siswa === '1';
                        var ruang1 = setSiswa1 ? data[i+1]?.ruang_kelas : data[i+1]?.kode_ruang;
                        var sesi1 = setSiswa1 ? data[i+1]?.sesi_kelas : data[i+1]?.kode_sesi;
                        var cardHtml1 = buildCard(data[i+1], ruang1, sesi1, activeTipe);
                        pageHtml += '<td style="width: 50%; vertical-align: top; padding: 4px; box-sizing: border-box;">' + cardHtml1 + '</td>';
                    } else {
                        pageHtml += '<td style="width: 50%;"></td>';
                    }
                    pageHtml += '</tr>';
                }

                pageHtml += '</table></div>';

                if (!isLastPage) {
                    pageHtml += '<div class="no-print" style="border-top: 2px dashed #aaa; margin: 8px auto; width: ' + pageW + 'px; text-align: center; color: #aaa; font-size: 11px; padding: 3px 0;">--- Halaman Baru ---</div>';
                }

                konten += pageHtml;
            }

            // Scale preview to fit the column width
            var colWidth = $('#print-preview').parent().width() - 32;
            var scale = Math.min(1, colWidth / pageW);
            $('#print-preview').css({
                'transform': 'scale(' + scale + ')',
                'transform-origin': 'top center',
                'width': pageW + 'px',
                'margin-left': 'auto',
                'margin-right': 'auto'
            });
            $('#print-preview').parent().css('min-height', '');
        } else {
            konten = '<div style="padding: 20px; text-align: center; color: #666;">Tidak ada data siswa di kelas ' + (response.info?.kelas?.nama_kelas || '') + ', atau nomor peserta belum diatur</div>';
            $('#print-preview').css({'transform': '', 'width': ''});
        }

        $("#print-preview").html(konten);
    }

    $(document).ready(function () {
        $("#header-1").on("change keyup paste", function () {
            var currentVal = $(this).val();
            if (currentVal === oldVal1) {
                return;
            }

            oldVal1 = currentVal;
            $('#prev-header-1').html(currentVal);
            renderTopPreview(activeTipe);
        });
        $("#header-2").on("change keyup paste", function () {
            var currentVal = $(this).val();
            if (currentVal === oldVal2) {
                return;
            }

            oldVal2 = currentVal;
            $('#prev-header-2').text(currentVal);
            renderTopPreview(activeTipe);
        });
        $("#header-3").on("change keyup paste", function () {
            var currentVal = $(this).val();
            if (currentVal === oldVal3) {
                return;
            }

            oldVal3 = currentVal;
            $('#prev-header-3').text(currentVal);
            renderTopPreview(activeTipe);
        });
        $("#header-4").on("change keyup paste", function () {
            var currentVal = $(this).val();
            if (currentVal === oldVal4) {
                return;
            }

            oldVal4 = currentVal;
            $('#prev-header-4').text(currentVal);
            renderTopPreview(activeTipe);
        });

        $('#input-tanggal').on('input', function (e) {
            var tgl = $(this).val();
            $('#prev-tanggal').text(tgl);
            oldTgl = tgl;
            renderTopPreview(activeTipe);
        });

        $('#set-kartu').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            Swal.fire({
                title: "Menyimpan...",
                text: "Silahkan tunggu....",
                allowOutsideClick: false,
                didOpen: function() { Swal.showLoading(); }
            });
            let form = new FormData($('#set-kartu')[0]);
            $.ajax({
                url: base_url + 'cbtcetak/savekartu',
                type: 'POST',
                processData: false,
                contentType: false,
                data: form,
                success: function (response) {
                    Swal.fire({
                        title: 'Sukses',
                        text: "Header kartu berhasil disimpan",
                        icon: 'success',
                    }).then(function() {
                        window.location.reload();
                    });
                },
                error: function (xhr, error, status) {
                    Swal.fire({
                        title: "Error",
                        text: "Gagal menyimpan setting kartu",
                        icon: "error"
                    });
                }
            });
        });

        function uploadAttach(action, data) {
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: action,
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    if (data.src.includes('kanan')) {
                        logoKanan = data.src;
                    } else if (data.src.includes('kiri')) {
                        logoKiri = data.src;
                    } else if (data.src.includes('tanda')) {
                        tandatangan = data.src;
                    }
                },
                error: function (xhr, error, status) {
                    console.log("error", xhr.responseText);
                    const err = JSON.parse(xhr.responseText)
                    swal.fire({
                        title: "Error",
                        text: err.Message,
                        icon: "error"
                    });
                }
            });
        }

        function deleteImage(src) {
            $.ajax({
                data: {src: src},
                type: "POST",
                url: base_url + "cbtcetak/deletefile",
                cache: false,
                success: function (response) {
                    console.log(response);
                }
            });
        }

        function loadSiswaKelas(kelas) {
            $.ajax({
                type: "GET",
                url: base_url + "cbtcetak/getsiswakelas?kelas=" + kelas,
                success: function (response) {
                    createPrintPreview(response, activeTipe);
                }
            });
        }

        function loadSiswaRuang(ruang) {
            $.ajax({
                type: "GET",
                url: base_url + "cbtcetak/getsiswaruang?ruang=" + ruang,
                success: function (response) {
                    createPrintPreview(response, activeTipe);
                }
            });
        }

        $("#kelas").prepend("<option value='' selected='selected' disabled>Pilih Kelas</option>");
        $("#ruang").prepend("<option value='' selected='selected' disabled>Pilih Ruang</option>");
        $("#kelas").change(function () {
            loadSiswaKelas($(this).val());
        });

        $("#ruang").change(function () {
            loadSiswaRuang($(this).val());
        });

        $('#kelas').select2({width: '100%', theme: 'bootstrap4'});

        $("#btn-print").click(function () {
            if ($('#kelas').val() === '' && $('#ruang').val() === '') {
                Swal.fire({
                    title: "ERROR",
                    text: "Pilih kelas atau ruang dulu",
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

        $('#selector button').click(function () {
            $(this).addClass('active').siblings().addClass('btn-outline-primary').removeClass('active btn-primary');

            if (!$('#kelas').is(':hidden')) {
                $('#kelas').addClass('d-none');
                $('#ruang').removeClass('d-none');
                printBy = 2;
            } else {
                $('#kelas').removeClass('d-none');
                $('#ruang').addClass('d-none');
                printBy = 1;
            }
        });
    })
</script>

<style>
    /* Screen-only: Scale preview parent height to match scaled content */
    #print-preview {
        transition: none;
    }
    .print-only { display: none; }

    /* Ensure table backgrounds inside cards are transparent so the watermark is always visible */
    #prev-top-card,
    .kartu-cetak-card .kartu-item {
        background-color: #ffffff !important;
        position: relative !important;
    }
    #prev-top-card .kartu-watermark,
    .kartu-cetak-card .kartu-watermark {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        opacity: 0.15 !important;
        pointer-events: none !important;
        z-index: 0 !important;
    }
    #prev-top-card table,
    #prev-top-card tr,
    #prev-top-card td:not(.ttd-cell),
    .kartu-cetak-card table,
    .kartu-cetak-card tr,
    .kartu-cetak-card td:not(.ttd-cell) {
        background: transparent !important;
        background-color: transparent !important;
    }
    #prev-top-card td,
    .kartu-cetak-card td {
        white-space: normal !important;
    }

    @media print {
        @page {
            size: A4 portrait;
            margin: 10mm;
        }
        body, html {
            margin: 0 !important;
            padding: 0 !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        /* Reset the JS transform for print */
        #print-preview {
            transform: none !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        .no-print {
            display: none !important;
        }
        .print-only {
            display: none !important;
        }
        /* Each page group of cards */
        .kartu-cetak-card {
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            background: white !important;
            page-break-after: always !important;
            break-after: page !important;
            page-break-inside: avoid !important;
            break-inside: avoid !important;
            box-shadow: none !important;
        }
        .kartu-cetak-card:last-of-type,
        .kartu-cetak-card.last-page {
            page-break-after: avoid !important;
            break-after: avoid !important;
        }
        /* Keep table borders visible in print */
        .kartu-cetak-card table {
            border-collapse: collapse !important;
            width: 100% !important;
            background: transparent !important;
        }
        .kartu-cetak-card td {
            border-color: #000 !important;
        }
        /* Avoid page break inside each individual card */
        .kartu-cetak-card table tr {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }
    }
</style>

<?= $this->endSection() ?>

