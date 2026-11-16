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
        }
        .btn-format:hover {
            background: rgba(255,255,255,0.25);
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
    </style>
    <div class="row mt-2">
  <div class="col-sm-12">
    <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px;">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between w-100">
            <div class="d-flex align-items-center">
              <div class="me-3 flex-shrink-0">
                <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #0d9488 0%, #115e59 100%); color: #ffffff;">
                  <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"></path>
                  </svg>
                </div>
              </div>
              <div>
                <h4 class="card-title mb-1 fw-bold d-flex align-items-center" style="color: #333;">
                    Update Data Guru
                </h4>
                <p class="text-muted mb-0" style="font-size: 0.9rem;">Sinkronisasi masal data PTK/guru pengampu, pembaruan NIP, dan akun login pendidik.</p>
              </div>
            </div>
            <div>
                <a href="<?= base_url('dataguru') ?>" type="button" class="btn btn-sm btn-dark px-3 shadow-sm">
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
            <!-- Top Banner -->
            <div class="card mb-4 import-banner">
                <div class="card-body p-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div style="z-index: 2; position: relative;">
                        <h4 class="mb-1 d-flex align-items-center">
                            <i class="fas fa-cloud-download-alt me-2" style="color: #1a237e;"></i> Download Template Update
                        </h4>
                        <p class="mb-0 mt-2">
                            Silakan unduh format Excel untuk mengubah data teks, atau format Word untuk memperbarui pas foto guru.
                        </p>
                    </div>
                    <div class="d-flex gap-2">
                        <?php if (count($gurus) > 0) : ?>
                        <button onclick="download()" class="btn btn-format d-flex align-items-center">
                            <i class="fas fa-file-excel me-2"></i> Format Excel
                        </button>
                        <button onclick="downloadWord()" class="btn btn-format d-flex align-items-center">
                            <i class="fas fa-file-word me-2"></i> Format Word
                        </button>
                        <?php else: ?>
                        <button disabled class="btn btn-format d-flex align-items-center disabled" title="Belum ada data guru">
                            <i class="fas fa-file-excel me-2"></i> Format Excel
                        </button>
                        <button disabled class="btn btn-format d-flex align-items-center disabled" title="Belum ada data guru">
                            <i class="fas fa-file-word me-2"></i> Format Word
                        </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Upload Cards -->
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100 card-upload">
                        <div class="card-header card-upload-header">
                            <h5 class="upload-title">
                                <span class="icon-circle excel"><i class="fas fa-file-excel"></i></span>
                                Upload Data (Excel)
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-0">
                                <div class="custom-dropzone">
                                    <input type="file" id="input-file-events-excel" name="upload_file" class="custom-file-input-native" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" onchange="document.getElementById('filename-excel').innerText = this.files[0] ? this.files[0].name : ''; document.getElementById('filename-excel').style.display = this.files[0] ? 'block' : 'none';" />
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p>Drag & drop file Excel di sini atau klik</p>
                                    <p class="filename" id="filename-excel"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100 card-upload">
                        <div class="card-header card-upload-header">
                            <h5 class="upload-title">
                                <span class="icon-circle word"><i class="fas fa-file-word"></i></span>
                                Upload Foto (Word)
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-0">
                                <div class="custom-dropzone">
                                    <input type="file" id="input-file-events-word" name="upload_file" class="custom-file-input-native" accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document" onchange="document.getElementById('filename-word').innerText = this.files[0] ? this.files[0].name : ''; document.getElementById('filename-word').style.display = this.files[0] ? 'block' : 'none';" />
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
                </div>
            </div>
            
            <div class="row" id="download-tbl" style="display: none;">
                <div style="display: flex;flex-direction: column">
                    <p style="font-weight: bold; font-size: large" id="doc-title">Update Foto Guru</p>
                    <ul>
                        <li><span>Jangan merubah format tabel!</span></li>
                        <li><span>Jangan merubah kolom Nomor dan ID</span></li>
                        <li><span>Jika NIP kosong, isi NIP dengan angka unik (jangan ada yang sama) </span></li>
                        <li><span>Gunakan format EXCEL untuk merubah data guru selain FOTO</span></li>
                    </ul>
                </div>
                <table style="width:100%; font-size: 11pt; line-height: 1.3; border: 1px solid black; border-collapse: collapse; border-spacing: 0; page-break-after: always">
                    <thead>
                    <tr id="header-table" data-height="60" style="background-color: lightgrey"></tr>
                    </thead>
                    <tbody id="body-table">
                    </tbody>
                </table>
            </div>
        </div>
    </section>
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
    let dataGuru = [];
    let keysExcel = 0;
    let isUploadType;

    $(document).ready(function () {
        ajaxcsrf();
        bsCustomFileInput.init()

    setTimeout(() => {
        $('.dropify-excel').closest('.dropify-wrapper').find('.dropify-message p').text('Drag & drop file Excel di sini atau klik');
        $('.dropify-excel').closest('.dropify-wrapper').find('.dropify-message .file-icon').html('<i class="fas fa-cloud-upload-alt" style="font-size: 36px; color: #cfd8dc; margin-bottom: 10px;"></i>').removeClass('file-icon');
        $('.dropify-word').closest('.dropify-wrapper').find('.dropify-message p').text('Drag & drop file Word di sini atau klik');
        $('.dropify-word').closest('.dropify-wrapper').find('.dropify-message .file-icon').html('<i class="fas fa-cloud-upload-alt" style="font-size: 36px; color: #cfd8dc; margin-bottom: 10px;"></i>').removeClass('file-icon');
    }, 300);


        $('#input-file-events-excel').on('change', async function(e) {
            var files = e.target.files || [];
            if (!files.length) return;

            $('#file-preview').html('<span class="text-center">Pastikan anda telah mengisi format yang telah disediakan.</span>')

            const jsonData = await getDataFromExcel(files[0])
            console.log('json', jsonData)
            $('#submit-excel').attr('disabled', 'disabled');
            $('#download-tbl').html('')
            dataGuru = [];
            isUploadType = null;

            let tbl = $(' <table class="mb-4 table table-sm table-striped table-bordered nowrap w-100"></table>')
            createTable(jsonData[jsonData.sheets[0]], tbl)
        });

        $('#input-file-events-word').on('change', async function(e) {
            var files = e.target.files || [];
            if (!files.length) return;

            $('#file-preview').html('<span class="text-center">Pastikan anda telah mengisi format yang telah disediakan.</span>')

            $('#submit-excel').attr('disabled', 'disabled');
            $('#download-tbl').html('')
            dataGuru = [];
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
                                let nip = $(this).find("td:eq(1)").text().trim();
                                nip = nip.replaceAll("","");
                                var nama_guru = $(this).find("td:eq(2)").text().trim();
                                var jk = $(this).find("td:eq(3)").text().trim();
                                var foto = $(this).find("td:eq(4)").find('img');
                                var id = $(this).find("td:eq(5)").text().trim();
                                foto.each(function (ind, img) {
                                    $(img).attr('width', '100')
                                });
                                if (id && nip) {
                                    let guru = {};
                                    guru['id_guru'] = id;
                                    guru['nip'] = nip;
                                    guru['nama_guru'] = nama_guru;
                                    guru['jenis_kelamin'] = jk;
                                    if (foto.length > 0) {
                                        const ftguru = $(foto[0]).attr('src')
                                        const ext = ftguru.substring("data:image/".length, ftguru.indexOf(";base64"))
                                        guru['foto'] = ftguru.split(';base64')[1];
                                        guru['ext'] = ext;
                                    }
                                    dataGuru.push(guru)
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
            const remapped = remapGuru(list.rows);
            dataGuru = remapped.data
            keysExcel = remapped.length
            isUploadType = 'excel'

            setTimeout(function () {
                swal.close();
            }, 1000)

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

    function download() {
        $.ajax({
            url: base_url +"dataguru/downloaddata/",
            method:"GET",
            success: function (result) {
                console.log("result", result);
                //createTable(kls, result.data)
                downloadTemplate(result)
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

    async function downloadTemplate(res) {
        let response = await fetch(base_url + 'dataguru/template_update');
        if (!response.ok) {
            response = await fetch(base_url + 'uploads/import/format/format_update_guru.xlsx');
        }
        const arrayBuffer = await response.arrayBuffer()
        const excelTemplate = await JsExcelTemplate.fromArrayBuffer(arrayBuffer)
        excelTemplate.set("guru", res.guru);

        const blob = await excelTemplate.toBlob()
        saveAs(blob, `Update Data Guru.xlsx`);
    }

    function downloadWord() {
        swal.fire({
            text: "Mengambil data guru ....",
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => { swal.showLoading(); },
            onOpen: () => { swal.showLoading(); }
        });

        $.ajax({
            url: base_url + "dataguru/downloaddata/",
            method: "GET",
            success: function (result) {
                if (result.guru && result.guru.length > 0) {
                    prosesResult(result.guru);
                } else {
                    swal.fire({
                        title: "Informasi",
                        text: "Tidak ada data guru yang ditemukan",
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

    function prosesResult(dataGuru) {
        swal.fire({
            text: "Menyiapkan data foto guru ....",
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => { swal.showLoading(); },
            onOpen: () => { swal.showLoading(); }
        });

        if (!dataGuru || dataGuru.length === 0) {
            swal.fire({
                icon: "warning",
                title: "Data Kosong",
                text: "Tidak ada data guru yang ditemukan."
            });
            return;
        }

        const headerTbl = [
            {title:"No.", key: 'number', isCenter: true, width: '60px'},
            {title:"NIP", key:"nip", isNumber: true, isCenter: true, width: 'auto'},
            {title:"NAMA GURU", key:"nama_guru", width: 'auto'},
            {title:"JENIS KELAMIN (L/P)", key:"jenis_kelamin", isCenter: true, width: 'auto'},
            {title:"FOTO", key:"foto", isCenter: true, width: '100px'},
            {title:"ID (jangan diedit)", key: 'id_guru', isCenter: true, width: '60px'},
        ];

        let thead = '';
        let tbody = '';
        headerTbl.forEach(function (header) {
            thead += '<th style="width:'+header.width +'; border: 1px solid black;border-collapse: collapse;' +
                ' text-align: center;font-weight: bold;" class="text-center align-middle">'+
                '<span style="margin: 0; padding: 4px">'+header.title+'</span>' +
                '</th>';
        });

        dataGuru.forEach(function (guru, ind) {
            tbody += '<tr>';
            headerTbl.forEach(function (header) {
                if (header.key === 'number') {
                    tbody += '<td style="border: 1px solid black;text-align: center;padding: 4px">' +
                        (ind+1) +
                        '</td>';
                } else if (header.key === 'foto') {
                    tbody += '<td id="avatar-'+guru.nip+'" style="border: 1px solid black;text-align: center;padding: 4px">'+
                        '<img class="avatar" crossOrigin="anonymous" src="'+ (guru.foto || '') +'" alt="User Image" style="max-width: 60px; height: auto"> ' +
                        '</td>';
                } else {
                    const center = header.isCenter ? 'text-align: center;' : '';
                    tbody += '<td style="border: 1px solid black;padding: 4px;'+center+'">'+ (guru[header.key] ?? '') +'</td>';
                }
            });
            tbody += '</tr>';
        });

        $('#header-table').html(thead);
        $('#body-table').html(tbody);

        const avatars = $('#body-table .avatar').toArray();
        if (avatars.length === 0) {
            saveWord();
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
                saveWord();
            }
        }, 4000);

        Promise.all(promises).then(function () {
            if (!saved) {
                saved = true;
                clearTimeout(globalTimer);
                saveWord();
            }
        }).catch(function (e) {
            if (!saved) {
                saved = true;
                clearTimeout(globalTimer);
                saveWord();
            }
        });
    }

    function saveWord() {
        $('#doc-title').text(`Update Foto Guru`)
        swal.close();
        var contentDocument = $('#download-tbl').convertToHtmlFile('detail', '');
        var content = '<!DOCTYPE html>' + contentDocument.documentElement.outerHTML;
        var converted = htmlDocx.asBlob(content, {
            size: 'A4',
            margins: {top: 700, bottom: 700, left: 1000, right: 1000}
        });
        saveAs(converted, `Foto Guru.docx`);
    }

    function onRemoved() {
        $(".dropify-filename-inner").text("");
    }

    const mapping = [
        {"key":"2","value":"nama_guru"},
        {"key":"3","value":"nip"},
        {"key":"4","value":"jenis_kelamin"},
        {"key":"5","value":"username"},
        {"key":"6","value":"password"},
        {"key":"7","value":"id_guru"},
    ]

    function remapGuru(array) {
        let result = [];
        let keys = 0;
        let reqs = [];
        for (const data of array) {
            let guru = {}
            for (const key in data) {
                if (key && data[key] !=="") {
                    const map = mapping.find(function (o) {
                        return o.key === key;
                    });
                    if (map) {
                        if (map.value === 'nip' && data['nip']?.includes("")) {
                            guru['nip'] = data['nip'].replaceAll("","");
                        } else {
                            guru[map.value] = data[key]
                        }
                    }
                }
            }

            const keyGuru = Object.keys(guru);
            const keysLength = keyGuru.length;
            if (keysLength > 0) {
                if (keyGuru.includes('nama_guru') && keyGuru.includes('nip') && keyGuru.includes('username') && keyGuru.includes('password')) {
                    if (keysLength > keys) keys = keysLength
                    result.push(guru)
                } else {
                    reqs.push(guru)
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
        const pages = Math.ceil(dataGuru.length / limit)
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
            const gurus = await paginate(pagePost, limit)
            console.log('guru', gurus)

            let formDataGuru = new FormData($('#formUpload')[0])
            let url = '';
            if (gurus.length > 0 && isUploadType) {
                let inds = 0;
                let ids = [];
                for (const guru of gurus) {
                    for (const key in guru) {
                        ids.push(guru.id_guru)
                        formDataGuru.append(`guru[${guru.id_guru}][${key}]`, guru[key])
                    }
                    inds ++;
                }
                if (isUploadType === 'excel') {
                    formDataGuru.append(`ids`, JSON.stringify(ids))
                    url ="dataguru/update_all"
                } else {
                    url ="dataguru/update_foto"
                }
            }

            try {
                const data = await ajaxPost(url, formDataGuru)
                uploaded += data.user
                console.log("response:", uploaded);
                if (uploaded >= dataGuru.length) {
                    if (data.status) {
                        swal.fire({
                            title:"Berhasil",
                            text:"Data guru berhasil diimpor",
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
        return dataGuru.slice(startIndex, endIndex);
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

The above content shows the entire, complete file contents of the requested file.
