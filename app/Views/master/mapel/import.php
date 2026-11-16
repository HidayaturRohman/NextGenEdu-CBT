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
                <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #10b981 0%, #047857 100%); color: #ffffff;">
                  <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="17 8 12 3 7 8"></polyline>
                    <line x1="12" y1="3" x2="12" y2="15"></line>
                  </svg>
                </div>
              </div>
              <div>
                <h4 class="card-title mb-1 fw-bold d-flex align-items-center" style="color: #333;">
                    <?= $judul ?>
                </h4>
                <p class="text-muted mb-0" style="font-size: 0.9rem;">Fasilitas impor masal kurikulum mata pelajaran dari format Excel/CSV ke dalam sistem.</p>
              </div>
            </div>
            <div>
                <button onclick="window.history.back();" type="button" class="btn btn-sm btn-dark px-3 shadow-sm">
                    <i class="fas fa-arrow-circle-left"></i><span class="d-none d-sm-inline-block ms-1">Kembali</span>
                </button>
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
                            <i class="fas fa-cloud-download-alt me-2" style="color: #1a237e;"></i> Download Template Import
                        </h4>
                        <p class="mb-0 mt-2">
                            Silakan unduh format Excel untuk data teks, atau format Word untuk menyisipkan data lainnya.
                        </p>
                    </div>
                    <div class="d-flex gap-2">
                        <button onclick="download()" class="btn btn-format d-flex align-items-center">
                            <i class="fas fa-file-excel me-2"></i> Format Excel
                        </button>
                        <button onclick="downloadWord()" class="btn btn-format d-flex align-items-center">
                            <i class="fas fa-file-word me-2"></i> Format Word
                        </button>
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
                            <?= form_open('', array('id' => 'formUpload')) ?>
                            <div class="form-group mb-0">
                                <div class="custom-dropzone" id="dropzone-excel">
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
                                Upload Data (Word)
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-0">
                                <div class="custom-dropzone" id="dropzone-word">
                                    <input type="file" id="input-file-events-word" name="upload_file" class="custom-file-input-native" accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document" onchange="document.getElementById('filename-word').innerText = this.files[0] ? this.files[0].name : ''; document.getElementById('filename-word').style.display = this.files[0] ? 'block' : 'none';" />
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p>Drag & drop file Word di sini atau klik</p>
                                    <p class="filename" id="filename-word"></p>
                                </div>
                            </div>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preview Card -->
            <div class="card mb-4 card-upload">
                <div class="card-header card-upload-header pb-3 d-flex align-items-center justify-content-between" style="padding-bottom: 0;">
                    <h5 class="upload-title">
                        <span class="icon-circle preview"><i class="fas fa-eye"></i></span>
                        Live Preview Data
                    </h5>
                    <button id="btn-upload" type="button" class="btn btn-update shadow-sm">
                        <i class="fas fa-cloud-upload-alt me-2"></i> Mulai Upload
                    </button>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive bg-light p-3 rounded border mt-3" id="file-preview">
                        <div class="text-center text-muted py-3"><i class="fas fa-table me-2"></i>Data preview akan muncul di sini setelah file diunggah.</div>
                    </div>
                </div>
            </div>
<div class="d-none" id="download-tbl"></div>
        </div>    </section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url() ?>/assets/app/js/mammoth.browser.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/app/js/FileSaver.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/app/js/excel/exceljs.js"></script>
<script>
    var isUploadType = '';
    var dataMapel = [];

    const mapping = [
        {"key":"2","value":"nama_mapel"},
        {"key":"3","value":"kode"},
        {"key":"4","value":"kelompok"},
        {"key":"5","value":"urutan_tampil"},
        {"key":"6","value":"jenjang"},
    ];

    $(document).ready(function() {
        $('#input-file-events-excel').on('change', function(e) {
            var files = e.target.files || [];
            if (!files.length) {
                $('#filename-excel').text("");
                $('#dropzone-excel').removeClass('has-file');
                return;
            }
            $('#filename-excel').text(files[0].name);
            $('#dropzone-excel').addClass('has-file');
            isUploadType = 'excel';
            readExcel(e);
        });

        $('#input-file-events-word').on('change', function(e) {
            var files = e.target.files || [];
            if (!files.length) {
                $('#filename-word').text("");
                $('#dropzone-word').removeClass('has-file');
                return;
            }
            $('#filename-word').text(files[0].name);
            $('#dropzone-word').addClass('has-file');
            isUploadType = 'word';
            readWord(e);
        });

        $('#btn-upload').click(function() {
            if (dataMapel.length === 0) {
                swal.fire("Error", "Belum ada data untuk diimport", "error");
                return;
            }
            uploadData();
        });
    });

    function readExcel(e) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var data = new Uint8Array(e.target.result);
            var workbook = new ExcelJS.Workbook();
            workbook.xlsx.load(data).then(function() {
                var worksheet = workbook.getWorksheet(1);
                var html = '<table class="table table-bordered table-striped">';
                dataMapel = [];
                worksheet.eachRow(function(row, rowNumber) {
                    html += '<tr>';
                    var rowData = {};
                    row.eachCell(function(cell, colNumber) {
                        html += '<td>' + (cell.value ? cell.value : '') + '</td>';
                        var mapped = mapping.find(m => m.key == colNumber);
                        if (mapped && rowNumber > 1) {
                            rowData[mapped.value] = cell.value;
                        }
                    });
                    if (rowNumber > 1) {
                        dataMapel.push(rowData);
                    }
                    html += '</tr>';
                });
                html += '</table>';
                $('#file-preview').html(html);
            });
        };
        reader.readAsArrayBuffer(e.target.files[0]);
    }

    function readWord(e) {
        var reader = new FileReader();
        reader.onload = function(e) {
            mammoth.convertToHtml({arrayBuffer: e.target.result})
                .then(displayResult)
                .done();
        };
        reader.readAsArrayBuffer(e.target.files[0]);
    }

    function displayResult(result) {
        $('#file-preview').html(result.value);
        $('#file-preview table').addClass('table table-bordered table-striped');
        dataMapel = [];
        $('#file-preview table tr').each(function(rowIndex) {
            if (rowIndex > 0) {
                var rowData = {};
                var cols = $(this).find('td');
                if (cols.length >= 4) {
                    rowData['nama_mapel'] = $(cols[1]).text().trim();
                    rowData['kode'] = $(cols[2]).text().trim();
                    rowData['kelompok'] = $(cols[3]).text().trim();
                    if (cols.length >= 5) {
                        rowData['urutan_tampil'] = $(cols[4]).text().trim();
                    }
                    if (cols.length >= 6) {
                        rowData['jenjang'] = $(cols[5]).text().trim();
                    }
                    if (rowData['nama_mapel']) {
                        dataMapel.push(rowData);
                    }
                }
            }
        });
    }

    function uploadData() {
        swal.fire({
            text:"Sedang mengimport data...",
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
                swal.showLoading();
            }
        });
        
        let formData = new FormData();
        dataMapel.forEach((mapel, index) => {
            for (let key in mapel) {
                formData.append('mapel[' + index + '][' + key + ']', mapel[key]);
            }
        });

        $.ajax({
            url: base_url + "datamapel/do_import",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response) {
                    swal.fire("Berhasil", "Data berhasil diimport", "success").then(() => {
                        window.history.back();
                    });
                } else {
                    swal.fire("Gagal", "Terjadi kesalahan saat import", "error");
                }
            },
            error: function() {
                swal.fire("Gagal", "Terjadi kesalahan server", "error");
            }
        });
    }

    function download() {
        var workbook = new ExcelJS.Workbook();
        var worksheet = workbook.addWorksheet('Mata Pelajaran');
        worksheet.columns = [
            { header: 'NO', key: 'no', width: 6 },
            { header: 'NAMA MATA PELAJARAN', key: 'nama_mapel', width: 35 },
            { header: 'KODE', key: 'kode', width: 15 },
            { header: 'KELOMPOK', key: 'kelompok', width: 20 },
            { header: 'NO URUT RAPOR', key: 'urutan_tampil', width: 18 },
            { header: 'JENJANG', key: 'jenjang', width: 12 }
        ];
        worksheet.addRow({ no: 1, nama_mapel: 'Pendidikan Agama Islam', kode: 'PAI', kelompok: 'A', urutan_tampil: 1, jenjang: 1 });
        worksheet.addRow({ no: 2, nama_mapel: 'Bahasa Indonesia', kode: 'BIND', kelompok: 'A', urutan_tampil: 2, jenjang: 1 });
        worksheet.addRow({ no: 3, nama_mapel: 'Matematika', kode: 'MTK', kelompok: 'A', urutan_tampil: 3, jenjang: 1 });

        worksheet.getRow(1).font = { bold: true };
        worksheet.getRow(1).alignment = { vertical: 'middle', horizontal: 'center' };

        workbook.xlsx.writeBuffer().then(function(buffer) {
            var blob = new Blob([buffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
            saveAs(blob, 'format_mapel.xlsx');
        });
    }
    
    function downloadWord() {
        var content = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns="http://www.w3.org/TR/REC-html40">' +
            '<head><meta charset="utf-8"><title>Format Mapel</title></head><body>' +
            '<table border="1" style="border-collapse:collapse;width:100%">' +
            '<tr style="background:#f2f2f2;font-weight:bold;text-align:center;">' +
            '<th>NO</th><th>NAMA MATA PELAJARAN</th><th>KODE</th><th>KELOMPOK</th><th>NO URUT RAPOR</th><th>JENJANG</th>' +
            '</tr>' +
            '<tr><td>1</td><td>Pendidikan Agama Islam</td><td>PAI</td><td>A</td><td>1</td><td>1</td></tr>' +
            '<tr><td>2</td><td>Bahasa Indonesia</td><td>BIND</td><td>A</td><td>2</td><td>1</td></tr>' +
            '<tr><td>3</td><td>Matematika</td><td>MTK</td><td>A</td><td>3</td><td>1</td></tr>' +
            '</table></body></html>';
        var blob = new Blob(['\ufeff' + content], { type: 'application/msword' });
        saveAs(blob, 'format_mapel.doc');
    }
</script>
<?= $this->endSection() ?>