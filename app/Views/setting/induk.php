<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<div class="row">
  <div class="col-sm-12">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="me-3 flex-shrink-0">
            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: #ffffff;">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
              </svg>
            </div>
          </div>
          <div>
            <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                <?= $judul ?>
            </h4>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Pengelolaan dan pencetakan data buku induk siswa per kelas dan angkatan.</p>
          </div>
        </div>
      </div>
    </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
          <div class="header-title">
            <h5 class="card-title mb-0 fw-bold"><svg class="icon-24 text-primary me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Cari Siswa</h5>
          </div>
                            <div class="input-group input-group-sm pt-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control" id="cari-siswa">
                            </div>
                        </div>
                        <div class="card-body p-0"
                             style="height: 1000px;overflow-y:auto;-webkit-overflow-scrolling: touch">
                            <ul id="list-siswa" class="nav nav-pills nav-sidebar flex-column nav-child-indent"
                                data-widget="treeview">
                                <?php
                                if (isset($siswas)) :
                                    $n = 1;
                                    foreach ($siswas as $siswa): ?>
                                        <li class="nav-item">
                                            <a href="javascript:void(0)" class="nav-link pt-1 pb-1 ps-2 text-sm siswa"
                                               onclick="preview(<?= $siswa->id_siswa ?>)">
                                                <?= $n . '. ' . $siswa->nama ?>
                                            </a>
                                        </li>
                                        <?php $n++; endforeach; endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header bg-light">
                            <div class="card-title d-flex align-items-center">
    <svg class="icon-24 text-primary me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg><h6><?= $subjudul ?></h6>
</div>
                            <div class="card-tools d-flex gap-2">
                                <button class="btn btn-info text-white shadow-sm" onclick="editSiswa()" disabled>
                                    <i class="fa fa-edit me-1"></i>Edit
                                </button>
                                <button class="btn btn-primary shadow-sm btn-sm" onclick="cetakSemua()" disabled>
                                    <i class="fa fa-print me-1"></i>Cetak
                                </button>
                            </div>
                        </div>

                        <div class="card-body bg-gray-light p-1">
                            <div class="d-flex justify-content-center bg-gray-light pb-5 pt-3"
                                 style="height: 300mm; overflow-y: auto">
                                <div id="zoom" style="transform: scale(0.9); transform-origin: top center">
                                    <div id="print-preview">
                                        <div id="empty"
                                             style="display: flex;-webkit-justify-content: center;justify-content: center;width: 210mm; height: 297mm;padding: 10mm">
                                            Silahkan pilih siswa
                                        </div>
                                        <div id="print-data-1" class="border shadow-sm mb-3 d-none"
                                             style="background: white;width: 210mm; height: 297mm;padding: 5mm 10mm 5mm 10mm">
                                        </div>
                                        <div id="print-data-2" class="border shadow-sm mb-3 d-none"
                                             style="background: white;width: 210mm; height: 297mm;padding: 5mm 10mm 5mm 10mm">
                                        </div>
                                        <div id="print-data-3" class="border shadow-sm mb-3 d-none"
                                             style="background: white;width: 210mm; height: 297mm;padding: 5mm 10mm 5mm 10mm">
                                        </div>
                                        <div id="print-nilai" class="border shadow-sm mb-3 d-none pb-5"
                                             style="background: white;width: 210mm; min-height: 297mm;padding: 5mm 10mm 5mm 10mm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="overlay d-none" id="loading">
                            <div class="spinner-grow"></div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url() ?>/assets/app/js/cetak-area.js"></script>
<script>
    var siswaSelected = null;
    var klsSelected = '<?= isset($kelas_selected) ? $kelas_selected : '';?>';

    var siswas = JSON.parse(JSON.stringify(<?=isset($siswas) ? json_encode($siswas) : "[]"?>));
    var arrSiswa = JSON.parse(JSON.stringify(<?=isset($detail) ? json_encode($detail) : "[]"?>));
    var setting = JSON.parse(JSON.stringify(<?= json_encode($setting) ?>));
    var test = JSON.parse(JSON.stringify(<?=isset($arr_test) ? json_encode($arr_test) : "[]"?>));

    var arrMapel = null;

    console.log(arrSiswa);

    var z = 0.9;

    function perbesar() {
        var prev = $('#zoom');
        var scala = prev.css('transform');
        console.log(z);
        if (z < 1) {
            z += 0.1;
            prev.css('transform', 'scale(' + z + ')');
        }
        //cell.style.fontSize = 'small';
    }

    function perkecil() {
        var prev = $('#zoom');
        console.log(z);
        //if (z === 10)
        if (z > 0.2) {
            z -= 0.1;
            prev.css({'transform': 'scale(' + z + ')', 'transform-origin': 'top center'});
        }
        //cell.style.fontSize = 'small';
    }

    function handleNull(value) {
        if (value == null || value == '0' || value == '') return '-';
        else return value;
    }

    function handleAlamat(almt, rt, rw, kelurahan, kecamatan, kabupaten, provinsi) {
        var alamat = '';
        alamat += handleNull(almt);
        if (handleNull(rt) != '-' && handleNull(rw) != '-') {
            alamat += ' RT/RW: ' + handleNull(rt) + '/' + handleNull(rw);
        }
        if (handleNull(kelurahan) != '-') {
            alamat += ' Desa/Kel. ' + handleNull(kelurahan);
        }
        if (handleNull(kecamatan) != '-') {
            alamat += ' Kec. ' + handleNull(kecamatan);
        }
        if (handleNull(kabupaten) != '-') {
            alamat += ' Kota/Kab. ' + handleNull(kabupaten);
        }
        if (handleNull(provinsi) != '-') {
            alamat += ' ' + handleNull(provinsi);
        }

        return alamat;
    }

    function handleNisn(nis, nisn) {
        var induk = '';
        if (handleNull(nis) != '-') {
            induk += handleNull(nis);
        }
        if (handleNull(nisn) != '-') {
            induk += ' / ' + handleNull(nisn);
        }
        return induk;
    }

    function handleGender(jk) {
        var klm = handleNull(jk);
        if (klm != '-') {
            if (klm == 'L') klm = 'Laki-laki';
            else if (klm == 'P') klm = 'Perempuan';
        }
        return klm;
    }

    function handlePredikat(pred) {
        if (pred == 'A') return 'Sangat Baik';
        else if (pred == 'B') return 'Baik';
        else if (pred == 'C') return 'Cukup';
        else if (pred == 'D') return 'Kurang';
        else return '';
    }

    function handleTanggal(tgl) {
        var bulans = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        var ttl = '';
        if (handleNull(tgl) != '-') {
            var tanggal = tgl.split("-")[2];
            var bulan = tgl.split("-")[1];
            var tahun = tgl.split("-")[0];

            ttl += tanggal + " " + bulans[Math.abs(bulan)] + " " + tahun;
        }
        return ttl;
    }

    function ellipsisText(text) {
        if (text == null) {
            return '';
        } else {
            var splitted = text.split(',');
            if (splitted.length > 2) {
                var s1 = splitted[0];
                var s2 = splitted[1];
                //return s1.split('dan')[0] + ',' + s2.split('dan')[0];

                var limit = 30;
                var len = s2.length;
                if (len >= limit) {
                    s2 = s2.substring(0, limit) + '...';
                }
                return s1 + ',' + s2;
            } else {
                //return text.split('dan')[0];
                return text;
            }
        }
    }

    function inArray(val, array) {
        var found = $.inArray(val, array);
        return found >= 0;
        /*
        if (found >= 0) {
            // Element was found, remove it.
        } else {
            // Element was not found, add it.
        }
        */
    }

    function createPage1(idSiswa) {
        var siswa = arrSiswa[idSiswa];
        var arrIdNo = [
            '1.', '2.', '3.', '4.', '5.', '6.', '7.', '8.', '9.', '10.', '11.', '', '', '12.',
            '', '', '', '', '', '', '', '', '13.', '', '', '', ''];

        var identitas = '<p class="text-center text-dark mt-4"' +
            '   style="text-align: center;font-family: \'Arial\';font-size: 16pt;font-weight: bold">' +
            '    LEMBAR BUKU INDUK SISWA' +
            '</p>' +
            '<table style="margin-top: 40px;font-size: 11pt;font-weight: bold;font-family: \'Tahoma\';width: 100%; border: 0;">' +
            '    <tr>' +
            '        <td style="width: 40%">' +
            '            Nomor Induk Siswa' +
            '        </td>' +
            '        <td style="width: 2%">:</td>' +
            '        <td>' + handleNull(siswa.nis) + '</td>' +
            '    </tr>' +
            '    <tr>' +
            '        <td>' +
            '            Nomor Induk Siswa Nasional' +
            '        </td>' +
            '        <td style="width: 2%">:</td>' +
            '        <td>' + handleNull(siswa.nisn) + '</td>' +
            '    </tr>' +
            '</table>' +
            '<br/>';
        identitas += '<table style="font-family: \'Tahoma\';width: 100%; border: 0;table-layout: fixed;line-height: 1">' +
            '    <tr>' +
            '        <td style="width: auto">' +
            '            <table style="font-family: \'Tahoma\';border: 0;">';
        let nomor = 1;
        $.each(siswa.page1, function (abjad, header) {
            identitas += '<tr style="font-size: 11pt;font-weight: bold;">' +
                '    <td style="width: 3%; border: 0;padding-top: 12px">' + abjad + '.</td>' +
                '    <td colspan="5" style="padding-top: 12px">' + header.title + '</td>' +
                '</tr>';

            var tableFisik = '';
            if (header.table != null) {
                tableFisik = '<td colspan="5"><table style="width: 100%;border: 1px solid black; border-collapse: collapse;font-size: 10pt;">' +
                    '    <tr>' +
                    '        <td style="border: 1px solid black; border-collapse: collapse;text-align: center">Tahun</td>';

                var cols = 0;
                $.each(header.table.tahun, function (k, tahun) {
                    cols++;
                    tableFisik += '<td style="border: 1px solid black; border-collapse: collapse;text-align: center">' + tahun + '</td>';
                });
                tableFisik += '    </tr>' +
                    '    <tr>' +
                    '        <td style="border: 1px solid black; border-collapse: collapse;text-align: center">Berat Badan</td>';
                for (let i = 0; i < cols; i++) {
                    tableFisik += '<td style="border: 1px solid black; border-collapse: collapse;text-align: center"></td>';
                }
                tableFisik += '    </tr>' +
                    '    <tr>' +
                    '        <td style="border: 1px solid black; border-collapse: collapse;text-align: center">Tinggi Badan</td>';
                for (let i = 0; i < cols; i++) {
                    tableFisik += '<td style="border: 1px solid black; border-collapse: collapse;text-align: center"></td>';
                }
                tableFisik += '    </tr>' +
                    '    <tr>' +
                    '        <td style="border: 1px solid black; border-collapse: collapse;text-align: center">Penyakit</td>';
                for (let i = 0; i < cols; i++) {
                    tableFisik += '<td style="border: 1px solid black; border-collapse: collapse;text-align: center"></td>';
                }
                tableFisik += '    </tr>' +
                    '    <tr>' +
                    '        <td style="border: 1px solid black; border-collapse: collapse;text-align: center">Kelainan Jasmani</td>';
                for (let i = 0; i < cols; i++) {
                    tableFisik += '<td style="border: 1px solid black; border-collapse: collapse;text-align: center"></td>';
                }
                tableFisik += '    </tr>' +
                    '</table></td></tr>';
            }

            $.each(header.value, function (judul, isi) {
                if (isi != null && typeof isi === 'object') {
                    identitas += '<tr>' +
                        '    <td></td>' +
                        '    <td style="width: 4%; border: 0;vertical-align: top;">' + nomor + '.' + '</td>' +
                        '    <td colspan="2" style="vertical-align: top; width: 30%">' + judul + '</td>' +
                        '    <td style="width: 2%; border: 0;vertical-align: top;">:</td>' +
                        '    <td></td>' +
                        '</tr>';
                    const abjads = ['a', 'b', 'c', 'd', 'e', 'f'];
                    let noAbjads = 0;
                    $.each(isi, function (subjudul, subisi) {
                        const isisub = subjudul == "Tanggal" ? handleTanggal(subisi) : handleNull(subisi);
                        identitas += '    <tr>' +
                            '        <td></td>' +
                            '        <td></td>' +
                            '        <td style="width: 3%; border: 0;vertical-align: top;">' + abjads[noAbjads] + '.</td>' +
                            '        <td style="vertical-align: top;">' + subjudul +
                            '        </td>' +
                            '        <td style="vertical-align: top;">: </td>' +
                            '        <td style="vertical-align: top;">' + isisub + '</td>' +
                            '    </tr>';
                        noAbjads++;
                    })
                } else {
                    identitas += '<tr>' +
                        '    <td></td>' +
                        '    <td style="width: 4%; border: 0;vertical-align: top;">' +
                        nomor + '.' +
                        '    </td>' +
                        '    <td colspan="2" style="vertical-align: top;">' +
                        judul +
                        '    </td>' +
                        '    <td style="vertical-align: top;">: </td>';
                    if (isi == "[table]") {
                        identitas += '</tr><tr><td>' + tableFisik + '</td>';
                        //identitas += '<td style="vertical-align: top;">' + header.tahun.join("<br>") + '</td>';
                    } else {
                        identitas += '<td style="vertical-align: top;">' + handleNull(isi) + '</td>';
                    }
                    identitas += '</tr>';

                }
                nomor++;
            });

        });
        identitas += '</table></td>';

        identitas += '        <td style="width: 30mm;vertical-align: top">' +
            '            <div style="display: block; width: 30mm; height: 35mm;border: 1px solid #0a0a0a; text-align: center; padding-top: 10px">Foto ketika masuk<br>3 x 4</div>' +
            '            <div style="display: block; width: 30mm; height: 5cm;"></div>' +
            '            <div style="display: block; width: 30mm; height: 35mm;border: 1px solid #0a0a0a; text-align: center; padding-top: 10px">Foto ketika bersekolah<br>3 x 4</div>' +
            '            <div style="display: block; width: 30mm; height: 5cm;"></div>' +
            '            <div style="display: block; width: 30mm; height: 35mm; border: 1px solid #0a0a0a; text-align: center; padding-top: 10px">Foto ketika lulus<br>3 x 4</div>' +
            '        </td>' +
            '    </tr>' +
            '</table>';

        return identitas;
    }

    function createPage2(idSiswa) {
        var siswa = arrSiswa[idSiswa];
        var identitas = '<table style="font-family: \'Tahoma\';width: 100%; border: 0;table-layout: fixed;">' +
            '    <tr>' +
            '        <td style="width: auto">' +
            '            <table style="font-family: \'Tahoma\';border: 0;">';
        let nomor = 1;
        $.each(siswa.page2, function (abjad, header) {
            identitas += '<tr style="font-size: 12pt;font-weight: bold;">' +
                '    <td style="width: 3%; border: 0;padding-top: 12px">' + abjad + '.</td>' +
                '    <td colspan="5" style="padding-top: 12px">' + header.title + '</td>' +
                '</tr>';
            $.each(header.value, function (judul, isi) {
                if (isi != null && typeof isi === 'object') {
                    identitas += '<tr>' +
                        '    <td></td>' +
                        '    <td style="width: 4%; border: 0;vertical-align: top;">' + nomor + '.' + '</td>' +
                        '    <td colspan="2" style="vertical-align: top; width: 30%">' + judul + '</td>' +
                        '    <td style="width: 2%; border: 0;vertical-align: top;">:</td>' +
                        '    <td></td>' +
                        '</tr>';
                    const abjads = ['a', 'b', 'c', 'd', 'e', 'f'];
                    let noAbjads = 0;
                    $.each(isi, function (subjudul, subisi) {
                        const isisub = subjudul == "Tanggal" ? handleTanggal(subisi) : handleNull(subisi);
                        identitas += '    <tr>' +
                            '        <td></td>' +
                            '        <td></td>' +
                            '        <td style="width: 3%; border: 0;vertical-align: top;">' + abjads[noAbjads] + '.</td>' +
                            '        <td style="vertical-align: top;">' + subjudul +
                            '        </td>' +
                            '        <td style="vertical-align: top;">: </td>' +
                            '        <td style="vertical-align: top;">' + isisub + '</td>' +
                            '    </tr>';
                        noAbjads++;
                    })
                } else {
                    identitas += '<tr>' +
                        '    <td></td>' +
                        '    <td style="width: 4%; border: 0;vertical-align: top;">' +
                        nomor + '.' +
                        '    </td>' +
                        '    <td colspan="2" style="vertical-align: top;">' +
                        judul +
                        '    </td>' +
                        '    <td style="vertical-align: top;">: </td>';
                    if (header.tahun != null) {
                        identitas += '<td style="vertical-align: top;">' + header.tahun.join("<br>") + '</td>';
                    } else {
                        identitas += '        <td style="vertical-align: top;">' + handleNull(isi) + '</td>';
                    }
                    identitas += '</tr>';

                }
                nomor++;
            });

        });
        identitas += '</table>';

        return identitas;
    }

    function createPage3(idSiswa) {
        var siswa = arrSiswa[idSiswa];
        var identitas = '<table style="font-family: \'Tahoma\';width: 100%; border: 0;table-layout: fixed;">' +
            '    <tr>' +
            '        <td style="width: auto">' +
            '            <table style="font-family: \'Tahoma\';border: 0;">';
        let nomor = 1;
        $.each(siswa.page3, function (abjad, header) {
            identitas += '<tr style="font-size: 12pt;font-weight: bold;">' +
                '    <td style="width: 3%; border: 0;padding-top: 12px">' + abjad + '.</td>' +
                '    <td colspan="5" style="padding-top: 12px">' + header.title + '</td>' +
                '</tr>';
            $.each(header.value, function (judul, isi) {
                if (isi != null && typeof isi === 'object') {
                    identitas += '<tr>' +
                        '    <td></td>' +
                        '    <td style="width: 4%; border: 0;vertical-align: top;">' + nomor + '.' + '</td>' +
                        '    <td colspan="2" style="vertical-align: top; width: 30%">' + judul + '</td>' +
                        '    <td style="width: 2%; border: 0;vertical-align: top;">:</td>' +
                        '    <td></td>' +
                        '</tr>';
                    const abjads = ['a', 'b', 'c', 'd', 'e', 'f'];
                    let noAbjads = 0;
                    $.each(isi, function (subjudul, subisi) {
                        const isisub = subjudul == "Tanggal" ? handleTanggal(subisi) : handleNull(subisi);
                        identitas += '    <tr>' +
                            '        <td></td>' +
                            '        <td></td>' +
                            '        <td style="width: 3%; border: 0;vertical-align: top;">' + abjads[noAbjads] + '.</td>' +
                            '        <td style="vertical-align: top;">' + subjudul +
                            '        </td>' +
                            '        <td style="vertical-align: top;">: </td>' +
                            '        <td style="vertical-align: top;">' + isisub + '</td>' +
                            '    </tr>';
                        noAbjads++;
                    })
                } else {
                    identitas += '<tr>' +
                        '    <td></td>' +
                        '    <td style="width: 4%; border: 0;vertical-align: top;">' +
                        nomor + '.' +
                        '    </td>' +
                        '    <td colspan="2" style="vertical-align: top;">' +
                        judul +
                        '    </td>' +
                        '    <td style="vertical-align: top;">: </td>';
                    if (header.tahun != null) {
                        identitas += '<td style="vertical-align: top;">' + header.tahun.join("<br>") + '</td>';
                    } else {
                        identitas += '        <td style="vertical-align: top;">' + handleNull(isi) + '</td>';
                    }
                    identitas += '</tr>';

                }
                nomor++;
            });

        });
        identitas += '</table>';

        return identitas;
    }

    function preview(idSiswa) {
        siswaSelected = arrSiswa[idSiswa];
        arrMapel = siswaSelected.setting_mapel;
        console.log('siswa', siswaSelected);

        $('#loading').removeClass('d-none');

        $('#print-data-1').html(createPage1(idSiswa));
        $('#print-data-2').html(createPage2(idSiswa));
        $('#print-data-3').html(createPage3(idSiswa));

        setTimeout(function () {
            $('#loading').addClass('d-none');
            $('#empty').addClass('d-none');
            $('#print-data-1').removeClass('d-none');
            $('#print-data-2').removeClass('d-none');
            $('#print-data-3').removeClass('d-none');
            $('#print-nilai').removeClass('d-none');
            $('.btn').removeAttr('disabled');
        }, 500);
    }

    function cetakSemua() {
        var div = '<div>';
        div += $('#print-data-1').html();
        div += '<div style="page-break-after: always"></div>';
        div += $('#print-data-2').html();
        div += '<div style="page-break-after: always"></div>';
        div += $('#print-data-3').html();
        div += '<div style="page-break-after: always"></div>';
        div += $('#print-nilai').html();
        div += '</div>';

        setTimeout(function () {
            $(div).print(siswaSelected.nama);
        }, 500);
    }

    $(document).ready(function () {
        console.log('test', test);
        $('input#cari-siswa').quicksearch('ul#list-siswa li');

        var opsiKelas = $('#id-kelas');
        console.log(klsSelected);
        var kslctd = klsSelected == '' ? "selected='selected'" : "";
        opsiKelas.prepend("<option value='0' " + kslctd + " disabled='disabled'>Pilih Kelas</option>");
        opsiKelas.change(function () {
            //getDataSiswa($(this).val());
            //console.log(kelas);
            window.location.href = base_url + 'bukuinduk?kelas=' + $(this).val();
        });

        $('.siswa').click(function (e) {
            e.stopPropagation();
            e.preventDefault();
            e.stopImmediatePropagation();
            $('.siswa').removeClass('active');
            $(this).toggleClass('active');
        })
    })
</script>


<?= $this->endSection() ?>
