<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<div class="d-contents">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
          <div class="d-flex align-items-center">
            <div class="me-3 flex-shrink-0">
              <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #0891b2 0%, #0e7490 100%); color: #ffffff;">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                  <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
              </div>
            </div>
            <div>
              <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                  <?= $judul . (isset($kelas['nama_kelas']) ? ' - ' . $kelas['nama_kelas'] : '') ?>
              </h4>
              <p class="text-muted mb-0" style="font-size: 0.9rem;"><?= $subjudul ?? 'Input & Kelola Nilai PAS Rapor' ?></p>
            </div>
          </div>
          <button onclick="window.history.back();" type="button" class="btn btn-outline-secondary px-3 py-2 shadow-sm fw-semibold">
              <i class="fas fa-arrow-left me-1"></i> Kembali
          </button>
        </div>
      </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h6 class="card-title text-white mb-0 fw-bold"><i class="fas fa-edit me-2"></i>Nilai PAS - <?= $mapel['nama_mapel'] ?></h6>
                </div>
                <div class="card-body">
                    <?php if ($kkm == null): ?>
                        <div class="alert alert-soft-danger border-start border-4 border-danger p-3 mb-4 rounded-3" role="alert">
                            <div class="fw-bold mb-1"><i class="fas fa-exclamation-triangle me-1"></i> Perhatian:</div>
                            <span class="text-secondary">Download template tidak tersedia. Anda harus mengisi KKM terlebih dahulu di menu <b>DATA RAPOR > KKM DAN BOBOT</b>.</span>
                        </div>
                    <?php else: ?>
                        <div class="row align-items-center mb-4">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <button type="button" class="btn btn-primary w-100 py-2 shadow-sm fw-bold" onclick="processDownload(<?= $mapel['id_mapel'] ?>, <?= $kelas['id_kelas'] ?>)">
                                    <i class="fa fa-download me-1"></i> Download Template
                                </button>
                            </div>

                            <div class="col-md-8">
                                <?= form_open_multipart('', array('id' => 'uploadfile')); ?>
                                <div class="input-group shadow-sm">
                                    <input type="file" name="upload_file" class="form-control" id="custom-file">
                                    <button id="upload" type="submit" class="btn btn-success px-4 fw-bold">
                                        <i class="fa fa-upload me-1"></i> Upload Excel
                                    </button>
                                </div>
                                <?= form_close(); ?>
                            </div>
                        </div>

                        <?php if ($kkm == null) : ?>
                            <div class="alert alert-soft-warning border-start border-4 border-warning p-3 mb-4 rounded-3" role="alert">
                                KKM dan Bobot belum diatur
                            </div>
                        <?php endif; ?>
                        <?php
                        $multi = $setting_rapor->kkm_tunggal == "0" ? "MULTI" : "TUNGGAL";
                        $isi = $kkm->kkm;
                        $d = 0;
                        $dsd = $isi - 1;
                        $c = $isi;
                        $csd = floor($isi + (100 - $isi) / 3);
                        $b = $csd + 1;
                        $bsd = floor($b + (100 - $b) / 2);
                        $a = $bsd + 1;
                        $asd = 100;
                        ?>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle mb-4">
                                <thead class="table-light">
                                    <tr class="text-center text-primary fw-bold">
                                        <th style="width: 20%">KKM</th>
                                        <th style="width: 20%">Jenis KKM</th>
                                        <th style="width: 40%">Interval Predikat Berdasarkan KKM</th>
                                        <th style="width: 20%">Bobot Nilai PAS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center text-dark">
                                        <td class="fw-bold"><?= $kkm->kkm ?></td>
                                        <td><?= $multi ?></td>
                                        <td>
                                            <span class="badge bg-danger p-1">0 ~ <?= $dsd ?> : D</span>
                                            <span class="badge bg-warning p-1"><?= $c . ' ~ ' . $csd ?> : C</span>
                                            <span class="badge bg-info p-1"><?= $b . ' ~ ' . $bsd ?> : B</span>
                                            <span class="badge bg-success p-1"><?= $a ?> ~ 100 : A</span>
                                        </td>
                                        <td class="fw-bold"><?= $kkm->bobot_pas ?> %</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div id="t-siswa" class="w-100 mb-3"></div>
                        <?= form_open('', array('id' => 'uploadnilai')) ?>
                        <input type="hidden" name="id_kelas" class="form-control" value="<?= $mapel['id_mapel'] ?>">
                        <input type="hidden" name="id_mapel" class="form-control" value="<?= $kelas['id_kelas'] ?>">
                        <div class="d-flex justify-content-end mt-3 mb-2">
                            <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm fw-bold">
                                <i class="fa fa-save me-1"></i>Simpan Nilai PAS
                            </button>
                        </div>
                        <div id="for-upload" class="d-none row"></div>
                        <?= form_close() ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?= form_open('', array('id' => 'uploadpas')); ?>
    <input type="hidden" name="id_mapel" class="form-control" value="<?= $mapel['id_mapel'] ?>">
    <input type="hidden" name="id_kelas" class="form-control" value="<?= $kelas['id_kelas'] ?>">
    <?= form_close(); ?>
</div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script type="text/javascript" src="<?= base_url() ?>/assets/app/js/excel/js-excel-template.min.js"></script>

<script type="text/javascript" src="<?= base_url() ?>/assets/plugins/jexcel/js/jexcel.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/plugins/jexcel/js/jsuites.js"></script>
<script>
    var arrSiswa = JSON.parse(JSON.stringify(<?= json_encode($siswa)?>));
    var arrNilai = JSON.parse(JSON.stringify(<?= json_encode($nilai)?>));
    var kkmGuru = JSON.parse(JSON.stringify(<?= json_encode($kkm)?>));
    var kkmSetting = JSON.parse(JSON.stringify(<?= json_encode($setting_rapor)?>));
    var idMapel = '<?=$mapel['id_mapel']?>';
    var idKelas = '<?=$kelas['id_kelas']?>';
    var namaMapel = '<?=$mapel['nama_mapel']?>';
    var namaKelas = '<?=$kelas['nama_kelas']?>';
    var tpActive = '<?=$tp_active->id_tp?>';
    var smtActive = '<?=$smt_active->id_smt?>';

    var isi;
    var bobotPH, bobotPTS, bobotPAS;
    if (kkmSetting.kkm_tunggal == '1') {
        isi = parseInt(kkmSetting.kkm);
        bobotPH = parseInt(kkmSetting.bobot_ph);
        bobotPTS = parseInt(kkmSetting.bobot_pts);
        bobotPAS = parseInt(kkmSetting.bobot_pas);
    } else {
        isi = parseInt(kkmGuru.kkm);
        bobotPH = parseInt(kkmGuru.bobot_ph);
        bobotPTS = parseInt(kkmGuru.bobot_pts);
        bobotPAS = parseInt(kkmGuru.bobot_pas);
    }
    var pre_d = 0;
    var pre_dsd = isi - 1;
    var pre_c = isi;
    var pre_csd = Math.floor(isi + (100 - isi) / 3);
    var pre_b = pre_csd + 1;
    var pre_bsd = Math.floor(pre_b + (100 - pre_b) / 2);
    var pre_a = pre_bsd + 1;
    var pre_asd = 100;

    var arrIndic = ["P1", "P2", "P3", "P4", "P5", "P6", "P7", "P8"];
    var cols = [];

    $(function () {
        bsCustomFileInput.init();
    });

    $(document).ready(function () {
        console.log('a:' + pre_a + ' b:' + pre_b + ' bd:' + pre_bsd + ' c:' + pre_c + ' cd:' + pre_csd + ' dd:' + pre_dsd);
        console.log('ph:' + bobotPH + ' PTS:' + bobotPTS + ' pas:' + bobotPAS);
        var dataSiswa = [];
        var row = 1;
        $.each(arrSiswa, function (i, v) {
            var noInduk = v.nisn == null || v.nisn == '' ? v.nis : v.nisn;
            var nilai = arrNilai[v.id_siswa];
            dataSiswa.push(
                [
                    noInduk, v.nama, nilai.nhar, nilai.npts, nilai.npas,
                    '=IFERROR(ROUND((((C' + row + '*' + bobotPH + ')/100)+((D' + row + '*' + bobotPTS + ')/100)+((E' + row + '*' + bobotPAS + ')/100)),0),"")',
                    '=IF(F' + row + '>' + pre_bsd + ',"A",IF(F' + row + '>' + pre_csd + ',"B",IF(F' + row + '>' + pre_dsd + ',"C",IF(F' + row + '<' + pre_c + ',"D",""))))',
                    nilai.p_deskripsi, nilai.k_rata_rata, nilai.k_predikat, nilai.k_deskripsi, v.id_siswa
                ]
            );
            row++;
        });

        var tableSiswa = $('#t-siswa');

        var arrCol = [];

        var pno = 1;
        var kno = 1;
        var char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for (let i = 0; i < 12; i++) {
            var item = {};

            if (i === 0) {
                item['title'] = 'NIS/NISN\n' + char.charAt(i);
                item['width'] = 160;
            } else if (i === 1) {
                item['title'] = 'NAMA SISWA\n' + char.charAt(i);
                item['width'] = 250;
            } else if (i === 2) {
                item['title'] = 'RPH\n' + char.charAt(i);
                item['width'] = 50;
                pno++;
            } else if (i === 3) {
                item['title'] = 'PTS\n' + char.charAt(i);
                item['width'] = 50;
            } else if (i === 4) {
                item['title'] = 'PAS\n' + char.charAt(i);
                item['width'] = 50;
            } else if (i === 5) {
                item['title'] = 'AKHIR\n' + char.charAt(i);
                item['width'] = 70;
            } else if (i === 6) {
                item['title'] = 'PRED\n' + char.charAt(i);
                item['width'] = 70;
            } else if (i === 7) {
                item['title'] = 'DESKRIPSI\n' + char.charAt(i);
                item['width'] = 300;
                item['wordWrap'] = true;
            } else if (i === 8) {
                item['title'] = 'NILAI\n' + char.charAt(i);
                item['width'] = 50;
            } else if (i === 9) {
                item['title'] = 'PRED\n' + char.charAt(i);
                item['width'] = 50;
            } else if (i === 10) {
                item['title'] = 'DESKRIPSI\n' + char.charAt(i);
                item['width'] = 300;
                item['wordWrap'] = true;
            } else if (i === 11) {
                item['title'] = 'ID';
                item['width'] = 1;
            }
            item['colspan'] = '1';

            arrCol.push(item);
        }

        tableSiswa.jexcel({
            data: dataSiswa,
            minDimensions: [12],
            //defaultColWidth: 100,
            tableOverflow: true,
            tableWidth: '' + tableSiswa.width() + 'px',
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
                    {
                        title: 'DATA SISWA',
                        colspan: '2',
                    },
                    {
                        title: 'NILAI PENGETAHUAN',
                        colspan: '6',
                    },
                    {
                        title: 'NILAI KETERAMPILAN',
                        colspan: '4',
                    },
                ],
            ],
            updateTable: function (instance, cell, col, row, val, label, cellName) {
                if (col === 0) {
                    cell.className = '';
                    cell.style.backgroundColor = '#f8d7da';
                    cell.style.textAlign = 'center';
                    cell.classList.add('readonly');
                }

                if (col === 1) {
                    cell.className = '';
                    cell.style.backgroundColor = '#f8d7da';
                    cell.style.textAlign = 'left';
                    cell.classList.add('readonly');
                }

                if (col === 4) {
                    cell.style.backgroundColor = '#b9f6ca';
                }


                if (col === 7 || col === 10 || col === 11) {
                    cell.className = '';
                    cell.style.backgroundColor = '#fff3cd';
                    cell.classList.add('readonly');
                    cell.style.fontSize = 'small';
                }

                if (col === 2 || col === 3 || col === 5 || col === 6 || col === 8 || col === 9) {
                    cell.className = '';
                    cell.style.backgroundColor = '#ffebee';
                    cell.classList.add('readonly');
                }

                if (col === 5 || col === 6 || col === 8 || col === 9) {
                    cell.style.fontWeight = '600'
                }
            },
            onchange: function (instance, cell, col, row, value, label) {
                //var cellName = jexcel.getColumnNameFromId([col,row]);
                //console.log(col, cell);
            }
        });

        function cellRef(cel) {
            var x = cel.replace(/[A-Za-z]/g, "");
            x = x.charCodeAt(0) - 65;
            var y = cel.replace(/\D/g, "");
            y = y - 1;

            return x + "," + y;
        }

        /*
        $('#uploadpas').submit('click', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            var form = new FormData($('#uploadpas')[0]);

            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: base_url + 'rapor/uploadpas/' + idMapel + '/' + idKelas,
                data: form,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    console.log(data);
                    window.location.href = base_url + 'rapor/inputpas/' + idMapel + '/' + idKelas
                },
                error: function (e) {
                    console.log("error", e.responseText);
                    showDangerToast(e.responseText);
                }
            });
        });
         */

        $('#uploadnilai').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            swal.fire({
                title: "Menyimpan nilai akhir",
                text: "Silahkan tunggu....",
                allowEscapeKey: false,
                allowOutsideClick: false,
                onOpen: () => {
                    swal.showLoading();
                }
            });
            var tbl = $('table.jexcel tr').get().map(function (row) {
                return $(row).find('td').get().map(function (cell) {
                    return $(cell).html();
                });
            });
            tbl.shift();
            tbl.shift();
            var inputs = '';
            $.each(tbl, function (idx, s) {
                var idSiswa = s[12];
                inputs += '<input type="text" name="siswa[' + idSiswa + '][id_nilai_akhir]" value="' + idMapel + idKelas + idSiswa + tpActive + smtActive + '" class="form-control col-1">';
                inputs += '<input type="text" name="siswa[' + idSiswa + '][id_siswa]" value="' + idSiswa + '" class="form-control col-1">';
                inputs += '<input type="text" name="siswa[' + idSiswa + '][id_tp]" value="' + tpActive + '" class="form-control col-1">';
                inputs += '<input type="text" name="siswa[' + idSiswa + '][id_smt]" value="' + smtActive + '" class="form-control col-1">';
                inputs += '<input type="text" name="siswa[' + idSiswa + '][id_mapel]" value="' + idMapel + '" class="form-control col-1">';
                inputs += '<input type="text" name="siswa[' + idSiswa + '][id_kelas]" value="' + idKelas + '" class="form-control col-1">';
                inputs += '<input type="text" name="siswa[' + idSiswa + '][nilai]" value="' + s[5] + '" class="form-control col-1">';
                inputs += '<input type="text" name="siswa[' + idSiswa + '][akhir]" value="' + s[6] + '" class="form-control col-1">';
                inputs += '<input type="text" name="siswa[' + idSiswa + '][predikat]" value="' + s[7] + '" class="form-control col-1">';
            });
            $('#for-upload').html(inputs);

            $.ajax({
                type: "POST",
                url: base_url + 'rapor/importpas',
                data: $(this).serialize(),
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
                            window.location.href = base_url + 'rapor/inputpas/' + idMapel + '/' + idKelas
                        }
                    });
                },
                error: function (e) {
                    console.log("error", e.responseText);
                    swal.fire({
                        title: "Error",
                        html: "Gagal menyimpan",
                        icon: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                    })
                }
            });
        });

        $('#custom-file').on('change', async function (e) {
            var files = e.target.files || [];
            if (!files.length) return;

            const jsonData = await getDataFromExcel(files[0])
            console.log('parse', jsonData)
        });

        $('#upload').on('click', function (e) {
            const input = $('#custom-file')
            const files = input[0].files
            //console.log('files',files)
            if (!files.length) {
                swal.fire({
                    title: "INFO",
                    text: 'Tidak ada file untuk diupload',
                    icon: "info"
                });
            } else {
                parseFile(files[0]);
            }
        })
    });

    async function downloadTemplate(res) {
        const response = await fetch(base_url + 'uploads/import/format/template_pas_client.xlsx')
        const arrayBuffer = await response.arrayBuffer()
        const excelTemplate = await JsExcelTemplate.fromArrayBuffer(arrayBuffer)
        excelTemplate.set("mapel", namaMapel);
        excelTemplate.set("kelas", namaKelas);
        excelTemplate.set("siswa", res.siswa);

        const blob = await excelTemplate.toBlob()
        saveAs(blob, `Nilai Akhir ${namaMapel} ${namaKelas}.xlsx`);
    }

    async function processDownload(idMapel, idKelas) {
        $.ajax({
            url: base_url + "rapor/downloadtemplatepas/"+idMapel+"/"+idKelas,
            method: "GET",
            success: function (result) {
                console.log("result", result);
                downloadTemplate(result)
            }, error: function (xhr, status, error) {
                console.log("error", xhr.responseText);
                const err = JSON.parse(xhr.responseText)
                swal.fire({
                    title: "Error",
                    text: err,
                    icon: "error"
                });
            }
        });
    }

    function getDataFromExcel(file) {
        return new Promise((resolve, reject) => {
            const wb = new ExcelJS.Workbook();
            const reader = new FileReader()
            reader.onload = async () => {
                try {
                    const buffer = reader.result;
                    wb.xlsx.load(buffer).then(workbook => {
                        let dataFiles = {}
                        workbook.eachSheet((sheet, id) => {
                            let cols = {
                                'name': sheet.name,
                                'header': [],
                                'rows': []
                            }
                            let head = []
                            sheet.eachRow({includeEmpty: true}, (row, rowIndex) => {
                                let obj = {}
                                for (let i = 0; i < row.values.length; i++) {
                                    if (rowIndex === 5) {
                                        let val = row.values[i] ? (row.values[i] === 'N I S N' ? 'NISN' : row.values[i].replaceAll(' ', '').replaceAll('.', '')) : ''
                                        if (val.includes('/')) val = val.split('/')[1]
                                        head.push(val.toLowerCase())
                                        if (row.values[i]) {
                                            let h = {
                                                label: row.values[i],
                                                value: val.toLowerCase(),
                                            }
                                            cols.header.push(h)
                                        }
                                    } else if (rowIndex > 5){
                                        obj[head[i]] = row.values[i]
                                    }
                                }
                                cols.rows.push(obj)
                            })
                            cols.rows = removeEmptyObjects(cols.rows)
                            dataFiles[sheet.name] = cols
                        })
                        resolve(dataFiles)
                    })
                } catch (err) {
                    reject(err)
                }
            }
            reader.onerror = (error) => {
                reject(error)
            };
            reader.readAsArrayBuffer(file)
        });
    }

    function removeEmptyObjects(array) {
        return array.filter(element => {
            delete element.undefined
            return Object.keys(element).length !== 0;
        });
    }

    function uploadNilaiPAS(jsonData) {
        swal.fire({
            title: "Menyimpan nilai PAS",
            text: "Silahkan tunggu....",
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
                swal.showLoading();
            }
        });

        let formData = new FormData($('#uploadpas')[0])

        const nilaiSiswa = jsonData.NILAI.rows
        nilaiSiswa.forEach(function (siswa, ind) {
            for (const key in siswa) {
                if (key && key !== 'no') {
                    formData.append('siswa['+ind+']['+key+']', siswa[key])
                }
            }
        })

        $.ajax({
            type: "POST",
            url: base_url + 'rapor/uploadnilaipas/',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (data) {
                console.log(data);
                window.location.href = base_url + 'rapor/inputpas/' + idMapel + '/' + idKelas
            },
            error: function (e) {
                console.log("error", e.responseText);
                showDangerToast(e.responseText);
            }
        });
    }

    async function parseFile(file) {
        const jsonData = await getDataFromExcel(file)
        console.log('parse', jsonData)
        if (jsonData) {
            swal.fire({
                title: "UPLOAD",
                html: "Nilai yang sudah ada akan ditimpa. Lanjutkan?",
                icon: "warning",
                showCancelButton: 'Batal',
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK"
            }).then(result => {
                if (result.value) {
                    uploadNilaiPAS(jsonData)
                }
            });
        }
    }

</script>

<?= $this->endSection() ?>

