<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<div class="d-contents">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="me-3 flex-shrink-0">
            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%); color: #ffffff;">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="8" r="7"></circle>
                <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
              </svg>
            </div>
          </div>
          <div>
            <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                <?= $judul . (isset($kelas->nama_kelas) ? ' - ' . $kelas->nama_kelas : '') ?>
            </h4>
            <p class="text-muted mb-0" style="font-size: 0.9rem;"><?= $subjudul ?? 'Prestasi & Penghargaan Siswa' ?></p>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <!-- Card 1: Pilihan Deskripsi Prestasi Siswa -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-primary text-white py-3">
                            <h6 class="card-title text-white mb-0 fw-bold"><i class="fas fa-list-ol me-2"></i>PILIHAN DESKRIPSI PRESTASI SISWA</h6>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-soft-primary border-start border-4 border-primary p-3 mb-4 rounded-3" role="alert">
                                <div class="fw-bold mb-1"><i class="fas fa-info-circle me-1"></i> Petunjuk Pengisian:</div>
                                <ul class="mb-0 ps-3 text-secondary" style="font-size: 0.9rem; line-height: 1.6;">
                                    <li>Penulisan deskripsi max 100 huruf</li>
                                    <li>Klik pada tiap teks untuk mengedit deskripsi</li>
                                    <li>Jangan lupa untuk menyimpan perubahan</li>
                                </ul>
                            </div>
                            <div class="table-responsive">
                                <table id="tbl1" class="table table-hover table-bordered align-middle mb-3">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-center align-middle text-primary fw-bold" style="width: 120px">Ranking</th>
                                            <th class="text-primary fw-bold">Edit Saran / Dorongan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($i = 0; $i < count($deskRanking); $i++): $skp = $deskRanking[$i]; ?>
                                            <tr>
                                                <td class="text-center rank fw-bold text-secondary align-middle"><?= $skp->rank ?></td>
                                                <td class="editable p-2 align-middle"><?= $skp->deskripsi ?></td>
                                            </tr>
                                        <?php endfor; ?>
                                    </tbody>
                                </table>
                            </div>

                            <?= form_open('', array('id' => 'editdeskripsi')) ?>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm fw-bold" data-jenis="1">
                                    <i class="fas fa-save me-1"></i>Simpan Deskripsi
                                </button>
                            </div>
                            <?= form_close() ?>
                        </div>
                    </div>

                    <!-- Card 2: Input Prestasi & Catatan Siswa -->
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white py-3">
                            <h6 class="card-title text-white mb-0 fw-bold"><i class="fas fa-trophy me-2"></i>INPUT PRESTASI & CATATAN SISWA</h6>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-soft-primary border-start border-4 border-primary p-3 mb-4 rounded-3" role="alert">
                                <div class="fw-bold mb-1"><i class="fas fa-info-circle me-1"></i> Petunjuk Pengisian:</div>
                                <ul class="mb-0 ps-3 text-secondary" style="font-size: 0.9rem; line-height: 1.6;">
                                    <li>Jumlah nilai otomatis diambil dari nilai akhir tiap mapel</li>
                                    <li>Prestasi siswa diisi manual</li>
                                    <li>Jangan lupa untuk menyimpan perubahan</li>
                                </ul>
                            </div>
                            <div id="t-siswa" class="w-100 mb-3"></div>
                            <?= form_open('', array('id' => 'uploadnilai')) ?>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm fw-bold">
                                    <i class="fa fa-save me-1"></i>Simpan Prestasi Siswa
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
    var arrRanking = JSON.parse(JSON.stringify(<?= json_encode($deskRanking)?>));
    var idKelas = '<?=$kelas->id_kelas?>';
    var arrMapel = JSON.parse(JSON.stringify(<?= json_encode($mapels)?>));

    var arrNilaiHarian = JSON.parse(JSON.stringify(<?= json_encode($nilaiHarian)?>));
    var arrNilaiRataP = JSON.parse(JSON.stringify(<?= json_encode($nilaiRata_p)?>));
    var arrNilaiRataK = JSON.parse(JSON.stringify(<?= json_encode($nilaiRata_k)?>));

    var arrNilaiRata = JSON.parse(JSON.stringify(<?= json_encode($nilaiRata)?>));

    var arrNilaiPts = JSON.parse(JSON.stringify(<?= json_encode($nilaiPts)?>));
    var arrNilaiPas = JSON.parse(JSON.stringify(<?= json_encode($nilaiPas)?>));
    var jmlNilai = [];

    function inRange(n, start, end) {
        return n >= start && n <= end;
    }

    function setDesk(desk) {
        if (desk === '') return '';
        var result = '';
        for (let i = 0; i < arrRanking.length; i++) {
            var n1 = parseInt(arrRanking[i].kode);
            var n2 = arrRanking[(i + 1)] != null && arrRanking[(i + 1)].kode != null ? parseInt(arrRanking[(i + 1)].kode) : (n1 + 100);
            if (inRange(parseInt(desk), n1, (n2 - 1))) {
                result += '' + arrRanking[i].deskripsi;
                console.log('desk', parseInt(desk));
            }
        }
        return result;
    }

    function calcNilai(id_siswa) {
        jmlNilai = [];
        jmlNilaik = [];
        $.each(arrMapel, function (k, val) {
            jmlNilai.push(parseInt(arrNilaiPas[id_siswa][val.id_mapel]) + parseInt(arrNilaiRataK[id_siswa][val.id_mapel]));
            //jmlNilai.push(arrNilaiRata[id_siswa]);
        });
    }

    $(document).ready(function () {
        //console.log('siswa',arrSiswa);
        //console.log('nilai',arrNilai);
        //console.log('ranking',arrRanking);
        //console.log('mapel',arrMapel);
        //console.log('harian',arrNilaiHarian);
        //console.log('pts',arrNilaiPts);
        console.log('pas', arrNilaiPas);
        console.log("rata_harian", arrNilaiRataK);


        var totalR = 0;
        var totalK = 0;

        $('.editable').attr('contentEditable', true);
        var tableSize = $('#t-siswa');
        var dataSiswa = [];
        var row = 1;
        $.each(arrSiswa, function (i, v) {
            var noInduk = v.nisn == null || v.nisn == '' ? v.nis : v.nisn;
            var n1 = arrNilai[v.id_siswa].ranking;
            var n3 = arrNilai[v.id_siswa].p1;
            var n4 = arrNilai[v.id_siswa].p1_desk;
            var n5 = arrNilai[v.id_siswa].p2;
            var n6 = arrNilai[v.id_siswa].p2_desk;
            var n7 = arrNilai[v.id_siswa].p3;
            var n8 = arrNilai[v.id_siswa].p3_desk;

            calcNilai(v.id_siswa);

            var arrData = [
                noInduk, v.nama,
                '=SUM(M' + row + ':AZ' + row + ')',
                '',//'=RANK_EQ(C'+row+',[C1:C'+arrSiswa.length+'])',
                '',//setDesk(n1),
                n3, n4, n5, n6, n7, n8,
                v.id_siswa,
            ];
            $.merge(arrData, jmlNilai);

            dataSiswa.push(
                arrData
            );
            row++;
        });
        //console.log('arrNilai',dataSiswa);

        var arrCol = [];
        for (let i = 0; i < (12 + arrMapel.length); i++) {
            var item = {};
            if (i === 0) {
                item['title'] = 'N I S N';
                item['width'] = 160;
            } else if (i === 1) {
                item['title'] = 'NAMA SISWA';
                item['width'] = 250;
            } else if (i === 2) {
                item['title'] = 'JML NILAI';
                item['width'] = 80;
            } else if (i === 3) {
                item['title'] = 'RANKING';
                item['width'] = 80;
            } else if (i === 4) {
                item['title'] = 'DESKRIPSI';
                item['width'] = 200;
                item['wordWrap'] = true;
            } else if (i === 5 || i === 7 || i === 9) {
                item['title'] = 'JENIS';
                item['width'] = 100;
                item['wordWrap'] = true;
            } else if (i === 6 || i === 8 || i === 10) {
                item['title'] = 'KETERANGAN';
                item['width'] = 200;
                item['wordWrap'] = true;
            } else if (i === 11) {
                item['title'] = 'id';
                item['width'] = 3;
            } else {
                item['width'] = 1;
            }

            arrCol.push(item);
        }

        var tableSiswa = $('#t-siswa').jexcel({
            data: dataSiswa,
            minDimensions: [(11 + arrMapel.length)],
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
                    {title: 'PERINGKAT KELAS (otomatis)', colspan: '3'},
                    {title: 'PRESTASI (diisi manual)', colspan: '7'},
                ]
            ],
            updateTable: function (instance, cell, col, row, val, label, cellName) {
                if (col === 0 || col === 1) {
                    cell.className = '';
                    cell.style.backgroundColor = '#f8d7da';
                    cell.style.textAlign = 'left';
                    cell.classList.add('readonly');
                }

                if (col === 2) {
                    cell.className = 'total';
                    changed(col, row);
                }

                if (col === 3) {
                    cell.className = 'ranking';
                }

                if (col === 2 || col === 3 || col === 4) {
                    cell.style.backgroundColor = '#fff3cd';
                    cell.classList.add('readonly');
                }

                if (col === 4) {
                    cell.style.fontSize = 'small';
                    cell.style.textAlign = 'left';
                }

                if (col === 0 || col === 2 || col === 5 || col === 7 || col === 9) {
                    cell.style.borderLeft = '3px solid #9e9e9e';
                }

                if (col === 5 || col === 6 || col === 7 || col === 8 || col === 9 || col === 10) {
                    cell.style.backgroundColor = '#e0f7fa';
                }

                if (col === 11) {
                    cell.className = '';
                    cell.style.backgroundColor = '#fff3cd';
                    cell.classList.add('readonly');
                    cell.style.fontSize = 'small';
                    cell.style.textAlign = 'left';
                    cell.style.borderRight = '3px solid #9e9e9e';
                }

                if (col > 11) {
                    $(cell).hide();
                }

            },
            onchange: function (instance, cell, col, row, value, label) {
                var cellName = jexcel.getColumnNameFromId([col, row]);
                if (col === 2) {
                    changed(col, row);
                }
            }
        });

        function changed(col, row) {
            let totalList = $(".total")
                .map(function () {
                    return $(this).text()
                })
                .get()
                .sort(function (a, b) {
                    return a - b
                })
                .reduce(function (a, b) {
                    if (b != a[0]) a.unshift(b);
                    return a
                }, []);

            totalList.forEach((v, i) => {
                $('.total').filter(function () {
                    if (v == 0) {
                        return '';
                    } else {
                        return $(this).text() == v;
                    }
                }).next().text(i + 1);
            });

            setTimeout(function () {
                var values1 = $(`td[data-x="3"][data-y="${row}"]`).text();
                $(`td[data-x="4"][data-y="${row}"]`).text(setDesk(values1));
            }, 1000);
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
                url: base_url + 'rapor/importprestasi/' + idKelas,
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
                            window.location.href = base_url + 'rapor/raporprestasi/';
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

            var jsonObj = [];

            var table1 = $('#tbl1');
            const $rows1 = table1.find('tr'), headers1 = $rows1.splice(0, 1);
            $rows1.each((i, row) => {
                const desk = $(row).find('.editable').text();
                const rank = $(row).find('.rank').text();
                var nomor = rank.split(' ');
                console.log(nomor);

                if (rank.length > 0) {
                    let item = {};
                    item ["id_prestasi"] = idKelas + '1' + nomor[0].trim();
                    item ["jenis"] = '1';
                    item ["kelas"] = idKelas;
                    item ["rank"] = rank;
                    item ["kode"] = nomor[0].trim();
                    item ["deskripsi"] = desk;

                    jsonObj.push(item);
                }
            });

            var table2 = $('#tbl2');
            const $rows2 = table2.find('tr'), headers2 = $rows2.splice(0, 1);
            $rows2.each((i, row) => {
                const desk = $(row).find('.editable').text();
                const nomor = $(row).find('.kode').text();

                let item = {};
                item ["id_prestasi"] = idKelas + '2' + nomor;
                item ["jenis"] = '2';
                item ["kelas"] = idKelas;
                item ["rank"] = '';
                item ["kode"] = nomor;
                item ["deskripsi"] = desk;

                jsonObj.push(item);
            });

            var dataPost = $(this).serialize() + "&prestasi=" + JSON.stringify(jsonObj);
            console.log(dataPost);

            $.ajax({
                url: base_url + "rapor/saveprestasi",
                type: "POST",
                dataType: "JSON",
                data: dataPost,
                success: function (data) {
                    console.log("response:", data);
                    if (data.status) {
                        //showSuccessToast('Data berhasil disimpan')
                        window.location.href = base_url + 'rapor/raporprestasi/' + idKelas
                    } else {
                        showDangerToast('gagal disimpan')
                    }
                }, error: function (xhr, status, error) {
                    console.log("response:", xhr.responseText);
                    showDangerToast('gagal disimpan')
                }
            });
        });

        $(`thead tr`).each(function (i, row) {
            const $cols = $(this).find('td');
            $cols.each((j, v) => {
                //console.log('parent:' + i + ', '+j, v);
                if (i === 1) {
                    if (j > 0) {
                        v.style.borderLeft = '3px solid #9e9e9e';
                        v.style.borderTop = '3px solid #9e9e9e';
                    }
                    if (j === 3) {
                        v.style.borderRight = '3px solid #9e9e9e';
                    }
                } else if (i === 2) {
                    if (j === 1 || j === 3 || j === 6 || j === 8 || j === 10) v.style.borderLeft = '3px solid #9e9e9e';
                    else if (j === 12) v.style.borderRight = '3px solid #9e9e9e';
                    else if (j > 12) v.style.display = 'none';
                }
            })
        });

        /*
        setTimeout(function () {
            for (let i = 0; i < arrSiswa.length; i++) {
                var values1 = $(`td[data-x="3"][data-y="${i}"]`).text();
                $(`td[data-x="4"][data-y="${i}"]`).text(setDesk(values1));
            }
        }, 1000);
        */

    });
</script>

<?= $this->endSection() ?>

