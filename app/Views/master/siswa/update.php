<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

        <!-- CSS khusus untuk halaman ini agar mirip mockup -->
    <style>
        body {
            background-color: #f4f6f9;
        }
        .import-banner {
            background: linear-gradient(90deg, #0264A7, #06BBE1);
            border-radius: 8px;
            color: #fff;
            position: relative;
            overflow: hidden;
            border: none;
            box-shadow: none;
        }
        .import-banner::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 40%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1) 50%, transparent);
            transform: skewX(-20deg);
        }
        .import-banner h4 {
            color: #1a237e;
            font-weight: 800;
            font-size: 1.25rem;
        }
        .import-banner p {
            color: #ffffff;
            font-size: 0.9rem;
            opacity: 0.95;
        }
        .btn-format {
            background: rgba(255,255,255,0.15);
            border: 1.5px solid #ffffff;
            color: #fff !important;
            border-radius: 6px;
            font-weight: 600;
            padding: 6px 16px;
            z-index: 2;
            position: relative;
            cursor: pointer;
            font-size: 0.9rem;
            text-decoration: none;
        }
        .btn-format:hover {
            background: rgba(255,255,255,0.25);
            color: #fff !important;
        }
        .btn-format:disabled, .btn-format.disabled {
            background: rgba(255,255,255,0.05);
            opacity: 0.6;
            cursor: not-allowed;
        }
        .card-upload {
            border-radius: 12px;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            background: #fff;
        }
        .card-upload-header {
            background: transparent;
            border-bottom: none;
            padding: 20px 20px 0 20px;
        }
        .icon-circle {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 14px;
        }
        .icon-circle.excel {
            background-color: #e8f5e9;
            color: #2e7d32;
        }
        .icon-circle.word {
            background-color: #e3f2fd;
            color: #1565c0;
        }
        .icon-circle.preview {
            background-color: #e0f7fa;
            color: #00838f;
        }
        .upload-title {
            color: #232d42;
            font-weight: 700;
            font-size: 1.05rem;
            margin: 0;
            display: flex;
            align-items: center;
        }
        
        .btn-update {
            background: #7c4dff;
            border: none;
            border-radius: 20px;
            padding: 6px 20px;
            font-weight: 600;
            color: #fff;
            font-size: 0.9rem;
        }
        .btn-update:hover {
            background: #651fff;
            color: #fff;
        }
        .btn-update:disabled {
            background: #b0bec5;
        }
        .custom-dropzone {
            border: 1px dashed #cfd8dc;
            border-radius: 8px;
            background-color: #fcfcfc;
            height: 160px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            transition: all 0.2s ease;
        }
        .custom-dropzone:hover {
            background-color: #f4f6f9;
            border-color: #b0bec5;
        }
        .custom-dropzone i {
            font-size: 36px;
            color: #cfd8dc;
            margin-bottom: 12px;
        }
        .custom-dropzone p {
            color: #607d8b;
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 0;
            pointer-events: none;
        }
        .custom-dropzone p.filename {
            color: #0264A7;
            margin-top: 5px;
            font-size: 0.85rem;
            display: none;
        }
        .custom-file-input-native {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }
    </style><div class="row mt-2">
  <div class="col-sm-12">
    <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px;">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between w-100">
            <div class="d-flex align-items-center">
              <div class="me-3 flex-shrink-0">
                <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%); color: #ffffff;">
                  <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"></path>
                  </svg>
                </div>
              </div>
              <div>
                <h4 class="card-title mb-1 fw-bold d-flex align-items-center" style="color: #333;">
                    <?= $subjudul ?>
                </h4>
                <p class="text-muted mb-0" style="font-size: 0.9rem;">Sinkronisasi masal data induk siswa, pembaruan rombel, dan penyesuaian akun login peserta didik.</p>
              </div>
            </div>
            <div>
                <a href="<?= base_url('datasiswa') ?>" type="button" class="btn btn-sm btn-dark px-3 shadow-sm">
                    <i class="fas fa-arrow-circle-left"></i><span class="d-none d-sm-inline-block ms-1">Kembali</span>
                </a>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
    <section class="content">
                <div class="container-fluid">
            
                        <div class="card mb-4 import-banner mt-4">
                <div class="card-body p-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div style="z-index: 2; position: relative;">
                        <h4 class="mb-1 d-flex align-items-center">
                            <i class="fas fa-cloud-download-alt me-2" style="color: #1a237e;"></i> Download Template Update
                        </h4>
                        <p class="mb-0 mt-2">
                            Pilih kelas di bawah ini untuk mengunduh format Excel / Word sesuai kelas.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- EXCEL COLUMN -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100 card-upload">
                        <div class="card-header card-upload-header">
                            <h5 class="upload-title">
                                <span class="icon-circle excel"><i class="fas fa-file-excel"></i></span>
                                Update Data Siswa (Excel)
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="fw-semibold mb-2" style="color: #555;">Download Template per Kelas</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <?php
                                    if (count($kelas) > 0) :
                                        foreach ($kelas as $id => $kls) : ?>
                                            <button type="button" onclick="download(this)" data-kelas="<?= $kls ?>" data-id="<?=$id?>" class="btn btn-format shadow-sm" style="background-color: #0264A7;">
                                                <i class="fas fa-download me-1"></i> <?= $kls ?>
                                            </button>
                                        <?php endforeach;
                                    else: ?>
                                        <div class="alert alert-warning w-100 py-2"><i class="fas fa-exclamation-triangle me-2"></i>Belum ada data siswa dan kelas</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <hr class="text-muted">

                            <div class="form-group mb-0">
                                <label class="fw-semibold mb-2" style="color: #555;">Upload Data Excel</label>
                                <div class="custom-dropzone" id="dropzone-excel">
                                    <input type="file" name="upload_file" id="input-file-events-excel" class="custom-file-input-native" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" onchange="document.getElementById('filename-excel').innerText = this.files[0] ? this.files[0].name : ''; document.getElementById('filename-excel').style.display = this.files[0] ? 'block' : 'none';" />
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p>Drag & drop file Excel di sini atau klik</p>
                                    <p class="filename" id="filename-excel"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- WORD COLUMN -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100 card-upload">
                        <div class="card-header card-upload-header">
                            <h5 class="upload-title">
                                <span class="icon-circle word"><i class="fas fa-file-word"></i></span>
                                Update Foto Siswa (Word)
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="fw-semibold mb-2" style="color: #555;">Download Template per Kelas</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <?php
                                    if (count($kelas) > 0) :
                                        foreach ($kelas as $id => $kls) : ?>
                                            <button type="button" onclick="downloadWord(this)" data-kelas="<?= $kls ?>" data-id="<?=$id?>" class="btn btn-format shadow-sm" style="background-color: #0264A7;">
                                                <i class="fas fa-download me-1"></i> <?= $kls ?>
                                            </button>
                                        <?php endforeach;
                                    else: ?>
                                        <div class="alert alert-warning w-100 py-2"><i class="fas fa-exclamation-triangle me-2"></i>Belum ada data siswa dan kelas</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <hr class="text-muted">

                            <div class="form-group mb-0">
                                <label class="fw-semibold mb-2" style="color: #555;">Upload File Word</label>
                                <div class="custom-dropzone" id="dropzone-word">
                                    <input type="file" name="upload_file" id="input-file-events-word" class="custom-file-input-native" accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document" onchange="document.getElementById('filename-word').innerText = this.files[0] ? this.files[0].name : ''; document.getElementById('filename-word').style.display = this.files[0] ? 'block' : 'none';" />
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p>Drag & drop file Word di sini atau klik</p>
                                    <p class="filename" id="filename-word"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preview Card -->
            <div class="card mb-4 card-upload">
                <?= form_open('', array('id' => 'formUpload')); ?>
                <div class="card-header card-upload-header pb-3 d-flex align-items-center justify-content-between" style="padding-bottom: 0;">
                    <h5 class="upload-title">
                        <span class="icon-circle preview"><i class="fas fa-eye"></i></span>
                        Live Preview Data
                    </h5>
                    <button id="submit-excel" name="preview" type="submit" class="btn btn-update shadow-sm" disabled="disabled">
                        <i class="fas fa-cloud-upload-alt me-2"></i> Mulai Update
                    </button>
                </div>
                <?= form_close(); ?>
                <div class="card-body">
                    <div id="info-error"></div>
                    <div id="file-preview" style="min-height: 250px; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #f8f9fa; border-radius: 8px; border: 2px dashed #dee2e6;">
                        <i class="fas fa-inbox fa-3x mb-3" style="color: #cfd8dc;"></i>
                        <span class="text-center text-muted" style="font-weight: 500;">Pastikan anda telah mengisi format yang telah disediakan.</span>
                    </div>
                    
                    <!-- WRAPPER FOR TABLE -->
                    <div class="table-responsive bg-light p-3 rounded border mt-3" id="table-wrapper" style="display: none;">
                        <table id="tableprev" class="table table-sm table-striped table-bordered nowrap w-100 mb-0"></table>
                    </div>
                </div>
            </div>
            
<div class="row d-none" id="download-tbl">
                <div style="display: flex;flex-direction: column">
                    <p style="font-weight: bold; font-size: large" id="doc-title">Update Foto Siswa</p>
                    <ul>
                        <li>
                            <span>Jangan merubah format tabel!</span>
                        </li>
                        <li>
                            <span>Hanya kolom NIS dan FOTO yang bisa diedit, jangan merubah isi kolom lain!</span>
                        </li>
                        <li>
                            <span>Jika NIS kosong, isi NIS dengan angka unik (jangan ada yang sama) </span>
                        </li>
                        <li>
                            <span>Gunakan format EXCEL untuk merubah data siswa selain FOTO</span>
                        </li>
                    </ul>
                </div>
        </div></section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url() ?>/assets/app/js/mammoth.browser.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/app/js/FileSaver.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/app/js/excel/exceljs.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/app/js/excel/js-excel-template.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/app/js/html-docx.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/app/js/convert-area.js"></script>
<script>
    const typeImport = '<?=$tipe?>';
    let dataSiswa = [];
    let keysExcel = 0;
    let isUploadType;

    $(document).ready(function () {
        ajaxcsrf();
        bsCustomFileInput.init()

        $('#input-file-events-excel').on('change', async function(e) {
            var files = e.target.files || [];
            if (!files.length) {
                $('#filename-excel').text("");
                $('#dropzone-excel').removeClass('has-file');
                return;
            }
            $('#filename-excel').text(files[0].name);
            $('#dropzone-excel').addClass('has-file');
            var files = e.target.files || [];
            if (!files.length) return;

            $('#file-preview').hide(); $('#table-wrapper').show(); $('#tableprev').html('')

            const jsonData = await getDataFromExcel(files[0])
            console.log('json', jsonData)
            $('#submit-excel').attr('disabled', 'disabled');
            $('#download-tbl').html('')
            dataSiswa = [];
            isUploadType = null;

            let tbl = $(' <table class="mb-4 table table-sm table-striped table-bordered nowrap w-100"></table>')
            createTable(jsonData[jsonData.sheets[0]], tbl)
        });

        $('#input-file-events-word').on('change', async function(e) {
            var files = e.target.files || [];
            if (!files.length) {
                $('#filename-word').text("");
                $('#dropzone-word').removeClass('has-file');
                return;
            }
            $('#filename-word').text(files[0].name);
            $('#dropzone-word').addClass('has-file');
            var files = e.target.files || [];
            if (!files.length) return;

            $('#file-preview').hide(); $('#table-wrapper').show(); $('#tableprev').html('')

            $('#submit-excel').attr('disabled', 'disabled');
            $('#download-tbl').html('')
            dataSiswa = [];
            isUploadType = null;
            parseWordDocxFile(files[0])
        });

        $('#formUpload').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            const limit = 900 / keysExcel
            uploadData(limit);
            return false;
        });

    });

    function parseWordDocxFile(file) {
        var showDiv = $('#file-preview')
        $('#info-error').html('')

        swal.fire({
            title:"Memuat file",
            text:"Silahkan tunggu....",
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
                swal.showLoading();
            }
        });
        console.time();
        var reader = new FileReader();

        reader.onloadend = function (event) {
            var arrayBuffer = reader.result;
            mammoth.convertToHtml({arrayBuffer: arrayBuffer}).then(function (resultObject) {
                //console.log('file', resultObject)
                if (resultObject.value ==="") {
                    let html = '<div class="alert alert-default-warning" role="alert">' +
                        '<p class="mb-1 text-bold">Warning</p> <ul>';
                    for (const msg of resultObject.messages) {
                        html += '<li>'+msg.message+'</li>'
                    }
                    html += '</ul>' +
                        '<p class="mb-1 text-bold">File Word tidak terbaca,</p>' +
                        '<ul>' +
                        '<li>Edit dan save kembali file word</li>' +
                        '<li>Jika masih tidak terbaca, lakukan <b>Save As</b> untuk membuat salinan</li>' +
                        '</ul></div>';
                    $('#info-error').html(html)
                }
                showDiv.html(resultObject.value);
                setTimeout(function () {
                    showDiv.children().not("table").remove();
                    showDiv.children('table').each(function (i, v) {
                        $(this).addClass('table table-bordered w-100 table-soal');
                        const $trs = $(this).find('tr'), headers = $trs.splice(0, 1); // header rows
                        $trs.each(function (index, tr) {
                            var cekTbl = $(tr).parent().closest('td');
                            if (cekTbl.length === 0) {
                                var id = $(this).find("td:eq(1)").text().trim();
                                var nis = $(this).find("td:eq(2)").text().trim();
                                var nama = $(this).find("td:eq(3)").text().trim();
                                var foto = $(this).find("td:eq(5)").find('img');
                                foto.each(function (ind, img) {
                                    $(img).attr('width', '100')
                                });
                                if (id && nis) {
                                    let siswa = {};
                                    siswa['id_siswa'] = id;
                                    siswa['nis'] = nis;
                                    siswa['nama'] = nama;
                                    if (foto.length > 0) {
                                        const ftsiswa = $(foto[0]).attr('src')
                                        const ext = ftsiswa.substring("data:image/".length, ftsiswa.indexOf(";base64"))
                                        siswa['foto'] = ftsiswa.split(';base64')[1];
                                        siswa['ext'] = ext;
                                    }
                                    dataSiswa.push(siswa)
                                    $('#submit-excel').removeAttr('disabled');
                                } else {
                                    $(this).remove();
                                }
                            }
                        });
                    });
                    swal.close();
                    isUploadType = 'word'
                    keysExcel = 5;
                }, 500);
            });
        };
        reader.readAsArrayBuffer(file);
    }

    function createTable(list, selector) {
        swal.fire({
            title:"Memuat file",
            text:"Silahkan tunggu....",
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
                swal.showLoading();
            }
        });

        let cols = Headers(list.header, selector);
        let len = list.rows.length;
        if (list.rows.length > 50) len = 50;
        for (let i = 0; i < len; i++) {
            let row = $('<tr/>');
            for (let colIndex = 0; colIndex < cols.length; colIndex++) {
                let val = list.rows[i][cols[colIndex]] || '';
                if (colIndex === 3 || colIndex > 8) {
                    row.append($('<td/>').html(val));
                } else {
                    row.append($('<td class="text-center" />').html(val));
                }
            }
            $(selector).append(row);
        }
        $('#file-preview').prepend(selector)

        if (list.rows.length > 0) {
            $('#submit-excel').removeAttr('disabled');
            const remapped = remapSiswa(list.rows);
            dataSiswa = remapped.data
            keysExcel = remapped.length
            isUploadType = 'excel'

            setTimeout(function () {
                swal.close();
            }, 1000)

            // cek data required
            /*
            let arrNisnDup = [];
            let arrNisDup = [];
            let arrUserDup = [];
            $.each(data.errors, function (idx, o) {
                console.log(idx, o);
                if (o.nisn !=="") arrNisnDup.push("<br />" + idx +":" +o.nisn);
                if (o.nis !=="") arrNisDup.push("<br />" + idx +":" +o.nis);
                if (o.username !=="") arrUserDup.push("<br />" + idx +":" +o.username);
            });
            let err = arrNisnDup.length ? `<b>${arrNisnDup.join("'")}</b>` : '';
            err += arrNisDup.length ? `<br /><b>${arrNisDup.join("'")}</b>` : '';
            err += arrUserDup.length ? `<br /><b>${arrUserDup.join("'")}</b>` : '';
            swal.fire({
                title:"Gagal",
                html: 'cek kembali siswa berikut: <br />'+err+'',
                icon:"error"
            }).then(result => {});
             */

        } else {
            $('#submit-excel').attr('disabled', 'disabled');
        }
    }

    function Headers(list, selector) {
        let columns = [];
        let header = $('<tr/>');

        for (let i = 0; i < list.length; i++) {
            let row = list[i];
            for (let k in row) {
                if (k === 'label') {
                    header.append($('<th class="text-center align-middle" />').html(row[k]));
                } else {
                    if ($.inArray(row[k], columns) == -1) {
                        columns.push(row[k]);
                    }
                }
            }
        }
        $(selector).append(header);
        return columns;
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
                            if (!dataFiles['sheets']) dataFiles['sheets'] = []
                            dataFiles['sheets'].push(sheet.name)
                            let cols = {
                                'name': sheet.name,
                                'header': [],
                                'rows': []
                            }
                            //let head = []
                            sheet.eachRow({includeEmpty: true}, (row, rowIndex) => {
                                let obj = {}
                                for (let i = 0; i < row.values.length; i++) {
                                    if (rowIndex === 1) {
                                        if (row.values[i]) {
                                            let val = row.values[i] || 'val-'+i;
                                            if (isRichValue(row.values[i])) {
                                                val = richToString(row.values[i])
                                            }
                                            if (val && val.includes('|')) val = val.split('|')[0]
                                            let h = {
                                                label: val,
                                                value: i//key,
                                            }
                                            cols.header.push(h)
                                        }
                                    } else {
                                        let val = row.values[i] || '';
                                        if (isRichValue(row.values[i])) {
                                            val = richToString(row.values[i])
                                        }
                                        if (i===2||i===3||i===14||i===19||i===20||i===30||i===36||i===42) {
                                            val = val.toString().replace("'","")
                                            console.log('index', i, val)
                                        }
                                        obj[i] = val
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

    function isRichValue(value) {
        return Boolean(value && Array.isArray(value.richText));
    }

    function richToString(rich) {
        return rich.richText.map(({ text }) => text).join('|');
    }

    async function downloadTemplate(kls, res) {
        let response = await fetch(base_url + 'datasiswa/template_update');
        if (!response.ok) {
            response = await fetch(base_url + 'uploads/import/format/format_update_siswa.xlsx');
        }
        const arrayBuffer = await response.arrayBuffer()
        const excelTemplate = await JsExcelTemplate.fromArrayBuffer(arrayBuffer)
        excelTemplate.set("siswa", res.siswa);

        const blob = await excelTemplate.toBlob()
        saveAs(blob, `Update Data Siswa ${kls}.xlsx`);
    }

    function download(btn) {
        const idKls = $(btn).data('id');
        const kls = $(btn).data('kelas')
        //console.log('download', idKls)

        $.ajax({
            url: base_url +"datasiswa/downloaddata/"+idKls,
            method:"GET",
            success: function (result) {
                console.log("result", result);
                //createTable(kls, result.data)
                downloadTemplate(kls, result)
            }, error: function (xhr, status, error) {
                console.log("error", xhr.responseText);
                const err = JSON.parse(xhr.responseText)
                swal.fire({
                    title:"Error",
                    text: err.Message,
                    icon:"error"
                });
            }
        });
    }

    function downloadWord(btn) {
        const idKls = $(btn).data('id');
        const kls = $(btn).data('kelas');

        swal.fire({
            text: "Mengambil data siswa kelas " + kls + " ....",
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => { swal.showLoading(); },
            onOpen: () => { swal.showLoading(); }
        });

        $.ajax({
            url: base_url + "datasiswa/downloaddata/" + idKls,
            method: "GET",
            success: function (result) {
                if (result.siswa && result.siswa.length > 0) {
                    prosesResult(result.siswa, kls);
                } else {
                    swal.fire({
                        title: "Informasi",
                        text: "Tidak ada data siswa terdaftar di kelas " + kls,
                        icon: "info"
                    });
                }
            },
            error: function (xhr, status, error) {
                console.log("error", xhr.responseText);
                let msg = "Gagal mengambil data dari server.";
                try {
                    const err = JSON.parse(xhr.responseText);
                    if (err.Message) msg = err.Message;
                } catch(e) {}
                swal.fire({
                    title: "Error",
                    text: msg,
                    icon: "error"
                });
            }
        });
    }

    function prosesResult(dataSiswa, kelas) {
        swal.fire({
            text: "Menyiapkan data foto kelas " + kelas + " ....",
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => { swal.showLoading(); },
            onOpen: () => { swal.showLoading(); }
        });

        if (!dataSiswa || dataSiswa.length === 0) {
            swal.fire({
                icon: "warning",
                title: "Data Kosong",
                text: "Tidak ada data siswa di kelas " + kelas
            });
            return;
        }

        const headerTbl = [
            {title:"No.", key: 'number', isCenter: true, width: '60px'},
            {title:"ID", key: 'id_siswa', isCenter: true, width: '60px'},
            {title:"NIS", key:"nis", isNumber: true, isCenter: true, width: 'auto'},
            {title:"NAMA SISWA", key:"nama", width: 'auto'},
            {title:"JENIS KELAMIN (L/P)", key:"jenis_kelamin", isCenter: true, width: 'auto'},
            {title:"FOTO", key:"foto", isCenter: true, width: '100px'},
        ];

        let thead = '';
        let tbody = '';
        headerTbl.forEach(function (header) {
            thead += '<th style="width:'+header.width +'; border: 1px solid black;border-collapse: collapse;' +
                ' text-align: center;font-weight: bold;" class="text-center align-middle">'+
                '<span style="margin: 0; padding: 4px">'+header.title+'</span>' +
                '</th>';
        });

        dataSiswa.forEach(function (siswa, ind) {
            tbody += '<tr>';
            headerTbl.forEach(function (header) {
                if (header.key === 'number') {
                    tbody += '<td style="border: 1px solid black;text-align: center;padding: 4px">' +
                        (ind+1) +
                        '</td>';
                } else if (header.key === 'foto') {
                    tbody += '<td id="avatar-'+siswa.nis+'" style="border: 1px solid black;text-align: center;padding: 4px">'+
                        '<img class="avatar" crossOrigin="anonymous" src="'+ (siswa.foto || '') +'" alt="User Image" style="max-width: 60px; height: auto"> ' +
                        '</td>';
                } else {
                    const center = header.isCenter ? 'text-align: center;' : '';
                    tbody += '<td style="border: 1px solid black;padding: 4px;'+center+'">'+ (siswa[header.key] ?? '') +'</td>';
                }
            });
            tbody += '</tr>';
        });

        $('#header-table').html(thead);
        $('#body-table').html(tbody);

        const avatars = $('#body-table .avatar').toArray();
        if (avatars.length === 0) {
            saveWord(kelas);
            return;
        }

        const promises = avatars.map(function (v, i) {
            return new Promise(function (resolve) {
                const timer = setTimeout(function () {
                    finalizeAvatar();
                    resolve({pos: i, timeout: true});
                }, 2500);

                function finalizeAvatar() {
                    clearTimeout(timer);
                    try {
                        if (v.src && v.src.indexOf('data:image') === 0) {
                            resolve({pos: i, ok: true});
                            return;
                        }
                        if (v.naturalWidth > 0 && v.naturalHeight > 0) {
                            const canvas = document.createElement("canvas");
                            const ctx = canvas.getContext("2d");
                            const targetW = 100;
                            const ratio = v.naturalHeight / v.naturalWidth;
                            const targetH = Math.round(targetW * ratio) || 120;
                            canvas.width = targetW;
                            canvas.height = targetH;
                            ctx.drawImage(v, 0, 0, targetW, targetH);
                            v.src = canvas.toDataURL("image/png");
                        }
                    } catch (err) {
                        console.warn("Avatar canvas conversion skipped:", err);
                    }
                    resolve({pos: i, ok: true});
                }

                function handleFail() {
                    clearTimeout(timer);
                    try {
                        $(v).parent().html('<span>&nbsp;&nbsp;</span>');
                    } catch (e) {}
                    resolve({pos: i, error: true});
                }

                if (v.complete) {
                    if (v.naturalWidth > 0) {
                        finalizeAvatar();
                    } else {
                        handleFail();
                    }
                } else {
                    $(v).one('load', finalizeAvatar).one('error', handleFail);
                }
            });
        });

        let saved = false;
        const globalTimer = setTimeout(function () {
            if (!saved) {
                saved = true;
                saveWord(kelas);
            }
        }, 4000);

        Promise.all(promises).then(function () {
            if (!saved) {
                saved = true;
                clearTimeout(globalTimer);
                saveWord(kelas);
            }
        }).catch(function (e) {
            if (!saved) {
                saved = true;
                clearTimeout(globalTimer);
                saveWord(kelas);
            }
        });
    }

    function saveWord(kelas) {
        $('#doc-title').text(`Update Foto Siswa Kelas ${kelas}`)
        swal.close();
        var contentDocument = $('#download-tbl').convertToHtmlFile('detail', '');
        var content = '<!DOCTYPE html>' + contentDocument.documentElement.outerHTML;
        var converted = htmlDocx.asBlob(content, {
            size: 'A4',
            margins: {top: 700, bottom: 700, left: 1000, right: 1000}
        });
        saveAs(converted, `Foto Siswa Kelas ${kelas}.docx`);
    }

    function onRemoved() {
        $(".dropify-filename-inner").text("");
    }

    const mapping = [
        {"key":"2","value":"nisn"},
        {"key":"3","value":"nis"},
        {"key":"4","value":"nama"},
        {"key":"5","value":"jenis_kelamin"},
        {"key":"6","value":"username"},
        {"key":"7","value":"password"},
        {"key":"8","value":"kelas_awal"},
        {"key":"9","value":"tahun_masuk"},
        {"key":"10","value":"sekolah_asal"},
        {"key":"11","value":"tempat_lahir"},
        {"key":"12","value":"tanggal_lahir"},
        {"key":"13","value":"agama"},
        {"key":"14","value":"hp"},
        {"key":"15","value":"email"},
        {"key":"16","value":"anak_ke"},
        {"key":"17","value":"status_keluarga"},
        {"key":"18","value":"alamat"},
        {"key":"19","value":"rt"},
        {"key":"20","value":"rw"},
        {"key":"21","value":"kelurahan"},
        {"key":"22","value":"kecamatan"},
        {"key":"23","value":"kabupaten"},
        {"key":"24","value":"provinsi"},
        {"key":"25","value":"kode_pos"},
        {"key":"26","value":"nama_ayah"},
        {"key":"27","value":"tgl_lahir_ayah"},
        {"key":"28","value":"pendidikan_ayah"},
        {"key":"29","value":"pekerjaan_ayah"},
        {"key":"30","value":"nohp_ayah"},
        {"key":"31","value":"alamat_ayah"},
        {"key":"32","value":"nama_ibu"},
        {"key":"33","value":"tgl_lahir_ibu"},
        {"key":"34","value":"pendidikan_ibu"},
        {"key":"35","value":"pekerjaan_ibu"},
        {"key":"36","value":"nohp_ibu"},
        {"key":"37","value":"alamat_ibu"},
        {"key":"38","value":"nama_wali"},
        {"key":"39","value":"tgl_lahir_wali"},
        {"key":"40","value":"pendidikan_wali"},
        {"key":"41","value":"pekerjaan_wali"},
        {"key":"42","value":"nohp_wali"},
        {"key":"43","value":"alamat_wali"},
        {"key":"44","value":"id_siswa"},
    ]

    function remapSiswa(array) {
        let result = [];
        let keys = 0;
        let reqs = [];
        for (const data of array) {
            let siswa = {}
            for (const key in data) {
                if (key && data[key] !=="") {
                    const map = mapping.find(function (o) {
                        return o.key === key;
                    });
                    if (map) siswa[map.value] = data[key]
                }
            }

            const keySiswa = Object.keys(siswa);
            const keysLength = keySiswa.length;
            if (keysLength > 0) {
                if (keySiswa.includes('nama') && keySiswa.includes('nis')
                    && keySiswa.includes('nisn') && keySiswa.includes('jenis_kelamin')
                    && keySiswa.includes('username') && keySiswa.includes('password')) {
                    if (keysLength > keys) keys = keysLength
                    result.push(siswa)
                } else {
                    reqs.push(siswa)
                }
            }
        }
        return {
            data: result,
            length: keys,
            error: reqs
        }
    }

    async function uploadData(limit) {
        const pages = Math.ceil(dataSiswa.length / limit)
        console.log('pages', pages)
        if (!page) return

        swal.fire({
            text:"Silahkan tunggu....",
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
                swal.showLoading();
            }
        });
        let uploaded = 0;
        for (let i = 0; i < pages; i++) {
            let pagePost = i + 1;
            const siswas = await paginate(pagePost, limit)
            console.log('siswa', siswas)

            let formDataSiswa = new FormData($('#formUpload')[0])
            let url = '';
            if (siswas.length > 0 && isUploadType) {
                let inds = 0;
                let ids = [];
                for (const siswa of siswas) {
                    for (const key in siswa) {
                        ids.push(siswa.id_siswa)
                        formDataSiswa.append(`siswa[${siswa.id_siswa}][${key}]`, siswa[key])
                    }
                    inds ++;
                }
                if (isUploadType === 'excel') {
                    formDataSiswa.append(`ids`, JSON.stringify(ids))
                    url ="datasiswa/updateall"
                } else {
                    url ="datasiswa/update_foto"
                }
            }

            try {
                const data = await ajaxPost(url, formDataSiswa)
                uploaded += data.user
                console.log("response:", uploaded);
                if (uploaded >= dataSiswa.length) {
                    if (data.status) {
                        swal.fire({
                            title:"Berhasil",
                            text:"Data siswa berhasil diimpor",
                            icon:"success"
                        }).then(result => {
                            if (result.value) {
                                window.history.back();
                            }
                        });
                    } else {
                        swal.fire({
                            title:"Gagal",
                            html: 'Gagal menyimpan data',
                            icon:"error"
                        });
                    }
                }
            } catch (error) {
                console.log("Error occurred:", error);
                swal.fire({
                    title:"Gagal",
                    text: 'Gagal menyimpan data',
                    icon:"error"
                });
            }
        }
    }

    async function paginate(pageNumber, itemsPerPage) {
        const startIndex = (pageNumber - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        return dataSiswa.slice(startIndex, endIndex);
    }

    async function ajaxPost(url, formData) {
        return new Promise((resolve, reject) => {
            setTimeout(function () {
                $.ajax({
                    url: base_url + url,
                    method:"POST",
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function (respon) {
                        resolve(respon);
                    },
                    error: function (xhr, status, error) {
                        reject(error);
                    }
                });
            }, 500)
        });
    }

</script>
<?= $this->endSection() ?>
