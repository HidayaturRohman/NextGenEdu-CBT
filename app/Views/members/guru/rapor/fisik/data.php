<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<div class="d-contents">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="me-3 flex-shrink-0">
            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%); color: #ffffff;">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
              </svg>
            </div>
          </div>
          <div>
            <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                <?= $judul . (isset($kelas->nama_kelas) ? ' - ' . $kelas->nama_kelas : '') ?>
            </h4>
            <p class="text-muted mb-0" style="font-size: 0.9rem;"><?= $subjudul ?? 'Kondisi Fisik & Kesehatan Siswa' ?></p>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <!-- Card 1: Pilihan Deskripsi Kondisi Fisik -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-primary text-white py-3">
                            <h6 class="card-title text-white mb-0 fw-bold"><i class="fas fa-heartbeat me-2"></i>PILIHAN DESKRIPSI KONDISI FISIK</h6>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-soft-primary border-start border-4 border-primary p-3 mb-4 rounded-3" role="alert">
                                <div class="fw-bold mb-1"><i class="fas fa-info-circle me-1"></i> Petunjuk Pengisian:</div>
                                <ul class="mb-0 ps-3 text-secondary" style="font-size: 0.9rem; line-height: 1.6;">
                                    <li>Penulisan deskripsi max 50 huruf</li>
                                    <li>Klik pada tiap teks untuk mengedit deskripsi</li>
                                    <li>Jangan lupa untuk menyimpan perubahan</li>
                                </ul>
                            </div>
                            <div class="table-responsive">
                                <table id="tbl1" class="table table-hover table-bordered align-middle mb-3">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center align-middle text-primary fw-bold" style="width: 50px">No</th>
                                            <th class="text-primary fw-bold">Pendengaran</th>
                                            <th class="text-primary fw-bold">Penglihatan</th>
                                            <th class="text-primary fw-bold">Gigi</th>
                                            <th class="text-primary fw-bold">Lain-lain</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $arrFis = ['telinga', 'mata', 'gigi', 'lain'];
                                        for ($i = 0; $i < 4; $i++) :?>
                                            <tr>
                                                <td class="text-center kode fw-bold text-secondary align-middle"><?= $i + 1 ?></td>
                                                <?php foreach ($deskFisik as $desk) :
                                                    if ($desk->kode == $i + 1) :?>
                                                        <td data-jenis="<?= $desk->jenis ?>" class="editable p-2 align-middle"><?= $desk->deskripsi ?></td>
                                                    <?php endif; endforeach; ?>
                                            </tr>
                                        <?php endfor; ?>
                                    </tbody>
                                </table>
                            </div>

                            <?= form_open('', array('id' => 'editdeskripsi')) ?>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm fw-bold" data-jenis="1">
                                    <i class="fas fa-save me-1"></i>Simpan Deskripsi
                                </button>
                            </div>
                            <?= form_close() ?>
                        </div>
                    </div>

                    <!-- Card 2: Input Kondisi Fisik & Kesehatan Siswa -->
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white py-3">
                            <h6 class="card-title text-white mb-0 fw-bold"><i class="fas fa-edit me-2"></i>INPUT KONDISI FISIK & KESEHATAN SISWA</h6>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-soft-primary border-start border-4 border-primary p-3 mb-4 rounded-3" role="alert">
                                <div class="fw-bold mb-1"><i class="fas fa-info-circle me-1"></i> Petunjuk Pengisian:</div>
                                <ul class="mb-0 ps-3 text-secondary" style="font-size: 0.9rem; line-height: 1.6;">
                                    <li>Jika catatan fisik tidak diisi maka tidak akan muncul di rapor</li>
                                    <li>Jangan lupa untuk menyimpan perubahan</li>
                                </ul>
                            </div>
                            <div id="t-siswa" class="w-100 mb-3"></div>
                            <?= form_open('', array('id' => 'uploadnilai')) ?>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm fw-bold">
                                    <i class="fa fa-save me-1"></i>Simpan Kondisi Fisik
                                </button>
                            </div>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script type="text/javascript" src="<?= base_url() ?>/assets/plugins/jexcel/js/jexcel.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/plugins/jexcel/js/jsuites.js"></script>
<script>
    var arrSiswa = JSON.parse(JSON.stringify(<?= json_encode($siswa)?>));
    var arrNilai = JSON.parse(JSON.stringify(<?= json_encode($nilai)?>));
    var arrFisik = JSON.parse(JSON.stringify(<?= json_encode($deskFisik)?>));
    var idKelas = '<?=$kelas->id_kelas?>';
    var smt = '<?=$smt_active->id_smt?>';

    function inRange(n, start, end) {
        return n >= start && n <= end;
    }

    function setDesk(desk) {
        desk = $.grep(desk, function (n, i) {
            return (n !== '' && n != null);
        });

        if (desk.length === 0) return '';

        var result = '';
        for (let i = 0; i < arrFisik.length; i++) {
            var n1 = parseInt(arrFisik[i].kode);
            var n2 = arrFisik[(i + 1)] != null && arrFisik[(i + 1)].kode != null ? parseInt(arrFisik[(i + 1)].kode) : (n1 + 100);
            if (inRange(desk, n1, (n2 - 1))) {
                result += '\n' + arrFisik[i].deskripsi;
            }
        }
        return result;
    }

    $(document).ready(function () {
        //console.log('siswa',arrSiswa);
        console.log('nilai', arrNilai);
        //console.log('absen',smt);

        var arrTelinga = [];
        var arrMata = [];
        var arrGigi = [];
        var arrLain = [];

        $.each(arrFisik, function (i, v) {
            if (v.jenis == '1') {
                arrTelinga.push(v.deskripsi)
            } else if (v.jenis == '2') {
                arrMata.push(v.deskripsi)
            } else if (v.jenis == '3') {
                arrGigi.push(v.deskripsi)
            } else {
                arrLain.push(v.deskripsi)
            }
        });

        $('.editable').attr('contentEditable', true);
        var tableSize = $('#t-siswa');
        var dataSiswa = [];
        var row = 1;
        $.each(arrSiswa, function (i, v) {
            var telinga = arrNilai[v.id_siswa].kondisi.telinga;
            var mata = arrNilai[v.id_siswa].kondisi.mata;
            var gigi = arrNilai[v.id_siswa].kondisi.gigi;
            var lainnya = arrNilai[v.id_siswa].kondisi.lain;
            var tinggi1 = arrNilai[v.id_siswa].smt1.tinggi;
            if (tinggi1 === '0') tinggi1 = '';
            var tinggi2 = arrNilai[v.id_siswa].smt2.tinggi;
            if (tinggi2 === '0') tinggi2 = '';
            var berat1 = arrNilai[v.id_siswa].smt1.berat;
            if (berat1 === '0') berat1 = '';
            var berat2 = arrNilai[v.id_siswa].smt2.berat;
            if (berat2 === '0') berat2 = '';

            var noInduk = v.nisn == null || v.nisn == '' ? v.nis : v.nisn;
            dataSiswa.push(
                [
                    noInduk, v.nama,
                    tinggi1, tinggi2, berat1, berat2,
                    telinga, mata, gigi, lainnya,
                    v.id_siswa,
                ]
            );
            row++;
        });

        var arrCol = [];
        for (let i = 0; i < 11; i++) {
            var item = {};
            if (i === 0) {
                item['title'] = 'N I S N';
                item['width'] = 160;
            } else if (i === 1) {
                item['title'] = 'NAMA SISWA';
                item['width'] = 250;
            } else if (i === 2 || i === 4) {
                item['title'] = 'SMT I';
                item['width'] = 50;
            } else if (i === 3 || i === 5) {
                item['title'] = 'SMT II';
                item['width'] = 50;
            } else if (i === 6) {
                item['title'] = 'Pendengaran';
                item['type'] = 'dropdown';
                item['source'] = arrTelinga;
                item['wordWrap'] = true;
                item['width'] = 150;
            } else if (i === 7) {
                item['title'] = 'Penglihatan';
                item['type'] = 'dropdown';
                item['source'] = arrMata;
                item['wordWrap'] = true;
                item['width'] = 150;
            } else if (i === 8) {
                item['title'] = 'Gigi';
                item['type'] = 'dropdown';
                item['source'] = arrGigi;
                item['wordWrap'] = true;
                item['width'] = 150;
            } else if (i === 9) {
                item['title'] = 'Lain-lain';
                item['type'] = 'dropdown';
                item['source'] = arrLain;
                item['wordWrap'] = true;
                item['width'] = 150;
            } else if (i === 10) {
                item['title'] = 'id';
                item['width'] = 1;
            }

            arrCol.push(item);
        }

        var tableSiswa = $('#t-siswa').jexcel({
            data: dataSiswa,
            minDimensions: [11],
            //defaultColWidth: 100,
            tableOverflow: true,
            tableWidth: '' + tableSize.width() + 'px',
            tableHeight: (80 * dataSiswa.length) + 'px',
            search: true,
            freezeColumns: 2,
            //rowResize: true,
            columnResize: false,
            columns: arrCol,
            /*[
            {width: 100},
            {width: 300},       ],*/
            nestedHeaders: [
                [
                    {title: 'DATA SISWA', colspan: '2'},
                    {title: 'TINGGI', colspan: '2'},
                    {title: 'BERAT', colspan: '2'},
                    {title: 'KONDISI KESEHATAN', colspan: '5'},
                ]
            ],
            updateTable: function (instance, cell, col, row, val, label, cellName) {
                if (col === 0 || col === 1) {
                    cell.className = '';
                    cell.style.backgroundColor = '#f8d7da';
                    cell.style.textAlign = 'left';
                    cell.classList.add('readonly');
                }

                if (col === 2 || col === 3 || col === 4 || col === 5) {
                    cell.style.backgroundColor = '#b9f6ca';
                }

                if (smt === 1) {
                    if (col === 2 || col === 4) {
                        cell.classList.add('readonly');
                    }
                } else {
                    if (col === 3 || col === 5) {
                        cell.classList.add('readonly');
                    }
                }

                if (col === 0 || col === 2 || col === 4 || col === 6) {
                    cell.style.borderLeft = '3px solid #9e9e9e';
                }

                if (col === 6 || col === 7 || col === 8 || col === 9) {
                    cell.style.backgroundColor = '#e0f7fa';
                    cell.style.fontSize = 'small';
                }

                if (col === 6 || col === 7 || col === 8 || col === 9) {
                    cell.style.textAlign = 'left';
                    cell.style.fontSize = 'small';
                }

                if (col === 10) {
                    cell.className = '';
                    cell.style.backgroundColor = '#fff3cd';
                    cell.classList.add('readonly');
                    cell.style.fontSize = 'small';
                }
            },
            onchange: function (instance, cell, col, row, value, label) {
                /*
                var cellName = jexcel.getColumnNameFromId([col,row]);
                if (inRange(col, 2, 7)) {
                    if (cellName != 'I' + row) {
                        console.log(cellName + ', val:' + value + 'col:' + col + 'row:'+row);
                        //changed(parseInt(row)+1);
                        changed(parseInt(row));
                    }
                }*/
            }
        });

        function changed(row) {
            var d1 = [];
            for (let i = 2; i < 5; i++) {
                if (inRange(i, 2, 4)) {
                    var values1 = $(`td[data-x="${i}"][data-y="${row}"]`).text();
                    d1.push(values1);
                }
            }
            console.log(d1);
            var values2 = $(`td[data-x="7"][data-y="${row}"]`).text();
            console.log(values2);
            tableSiswa.setValue('I' + (row + 1), setDesk(d1, 1) + setDesk([values2], 2), true);
        }

        $('#uploadnilai').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            var tbl = $('table.jexcel tr').get().map(function (row) {
                return $(row).find('td').get().map(function (cell) {
                    return $(cell).html();
                });
            });
            tbl.shift();
            tbl.shift();
            console.log($(this).serialize() + '&nilai=' + JSON.stringify(tbl));

            $.ajax({
                type: "POST",
                url: base_url + 'rapor/importfisik/' + idKelas,
                data: $(this).serialize() + '&nilai=' + JSON.stringify(tbl),
                cache: false,
                success: function (data) {
                    console.log(data);
                    swal.fire({
                        title: "Sukses",
                        html: "<b>" + data + "<b> nilai berhasil disimpan",
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                    }).then(result => {
                        if (result.value) {
                            window.location.href = base_url + 'rapor/raporfisik'
                        }
                    });
                },
                error: function (e) {
                    console.log("error", e.responseText);
                    showDangerToast(e.responseText);
                }
            });
        });

        $('#editdeskripsi').on('submit', function (e) {
            e.stopPropagation();
            e.preventDefault();
            e.stopImmediatePropagation();

            var tbl = $('table#tbl1 tr').get().map(function (row) {
                return $(row).find('td').get().map(function (cell) {
                    return $(cell).html();
                });
            });
            tbl.shift();
            var dataPost = $(this).serialize() + "&kelas=" + idKelas + "&fisik=" + JSON.stringify(tbl);
            console.log(dataPost);

            $.ajax({
                url: base_url + "rapor/savefisik",
                type: "POST",
                dataType: "JSON",
                data: dataPost,
                success: function (data) {
                    console.log("response:", data);
                    if (data.status) {
                        //showSuccessToast('Data berhasil disimpan')
                        window.location.href = base_url + 'rapor/raporfisik'
                    } else {
                        showDangerToast('gagal disimpan')
                    }
                }, error: function (xhr, status, error) {
                    console.log("response:", xhr.responseText);
                    showDangerToast('gagal disimpan')
                }
            });
        });

    });
</script>

<?= $this->endSection() ?>

