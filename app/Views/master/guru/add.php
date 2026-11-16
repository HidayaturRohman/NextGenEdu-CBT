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
              <div class="me-3">
                <svg class="icon-32 text-primary" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
              </div>
              <div>
                <h4 class="card-title mb-1 fw-bold d-flex align-items-center" style="color: #333;">
                    <?= $subjudul ?>
                </h4>
                <p class="text-muted mb-0" style="font-size: 0.9rem;">Tambahkan data secara manual atau impor dari file Excel/Word.</p>
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
            <?= form_open('', array('id' => 'formguru')); ?>
            <div class="card  mb-4">
                <div class="card-header d-flex justify-content-between align-items-center border-bottom mb-3 pb-3">
                    <h4 class="card-title fw-bold mb-0">Tambah Manual</h4>
                    <div class="card-tools">
                        <button type="reset" class="btn btn-sm bg-warning text-white">
                            <i class="fa fa-sync me-1"></i> Reset
                        </button>
                        <button type="submit" id="submit" class="btn btn-sm bg-primary text-white">
                            <svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Simpan

                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row mb-3">
                                <div class="col-md-4 col-sm-offset-4">
                                    <label for="nama_guru">Nama Guru :</label>
                                </div>
                                <div class="col-md-8 col-sm-offset-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input id="nama_guru" type="text" class="form-control" name="nama_guru"
                                               placeholder="Nama Guru" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 col-sm-offset-4">
                                    <label for="nip">Nomor ID :</label>
                                </div>
                                <div class="col-md-8 col-sm-offset-8">
                                    <div class="input-group">
                                        <select id="jenis_nip" name="jenis_nip" class="input-group-text bg-white" onchange="document.getElementById('nip').placeholder=this.value;">
                                            <option value="NIP">NIP</option>
                                            <option value="NUPTK">NUPTK</option>
                                            <option value="NPK">NPK</option>
                                            <option value="PegID">PegID</option>
                                        </select>
                                        <input type="text" id="nip" class="form-control" name="nip" placeholder="NIP"
                                               required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row mb-3">
                                <div class="col-md-4 col-sm-offset-4">
                                    <label for="username">Username :</label>
                                </div>
                                <div class="col-md-8 col-sm-offset-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input id="username" type="text" class="form-control" name="username"
                                               placeholder="Username" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 col-sm-offset-4">
                                    <label for="password">Password :</label>
                                </div>
                                <div class="col-md-8 col-sm-offset-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        </div>
                                        <input id="password" class="form-control" name="password" placeholder="Password"
                                               required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= form_close(); ?>
                                    <!-- Top Banner -->
            <div class="card mb-4 import-banner mt-4">
                <div class="card-body p-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div style="z-index: 2; position: relative;">
                        <h4 class="mb-1 d-flex align-items-center">
                            <i class="fas fa-cloud-download-alt me-2" style="color: #1a237e;"></i> Download Template Import
                        </h4>
                        <p class="mb-0 mt-2">
                            Silakan unduh format Excel untuk data teks, atau format Word untuk menyisipkan pas foto guru.
                        </p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="<?= base_url('dataguru/template') ?>" download="format_guru.xlsx" class="btn btn-format d-flex align-items-center">
                            <i class="fas fa-file-excel me-2"></i> Format Excel
                        </a>
                        <a href="<?= base_url('dataguru/template_word') ?>" download="format_guru.docx" class="btn btn-format d-flex align-items-center">
                            <i class="fas fa-file-word me-2"></i> Format Word
                        </a>
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
                        <i class="fas fa-cloud-upload-alt me-2"></i> Mulai Upload
                    </button>
                </div>
                <?= form_close(); ?>
                <div class="card-body">
                    <div id="file-preview" style="min-height: 250px; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #f8f9fa; border-radius: 8px; border: 2px dashed #dee2e6;">
                        <i class="fas fa-inbox fa-3x mb-3" style="color: #cfd8dc;"></i>
                        <span class="text-center text-muted" style="font-weight: 500;">Pastikan anda telah mengisi format yang telah disediakan.</span>
                    </div>
                </div>
            </div>
</div>    </section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url() ?>/assets/app/js/mammoth.browser.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/app/js/FileSaver.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/app/js/excel/exceljs.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/app/js/excel/js-excel-template.min.js"></script>
<script src="<?= base_url() ?>/assets/app/js/jquery.htmlparser.min.js"></script>
<script>
    let formDataGuru;
    let errorGuru = [];

    $(document).ready(function () {
        ajaxcsrf();
        bsCustomFileInput.init()

        $('#formguru').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            console.log('klik submit');
            var btn = $('#submit');

            btn.attr('disabled', 'disabled').text('Wait...');
            swal.fire({
                text:"Silahkan tunggu....",
                allowEscapeKey: false,
                allowOutsideClick: false,
                onOpen: () => {
                    swal.showLoading();
                }
            });
            $.ajax({
                url: base_url +"dataguru/create",
                data: $(this).serialize(),
                dataType:"JSON",
                type: 'POST',
                success: function (response) {
                    console.log('sukses', response);
                    btn.removeAttr('disabled').text('Simpan');
                    if (response.status) {
                        swal.fire('Sukses', 'Data Berhasil disimpan', 'success')
                            .then((result) => {
                                if (result.value) {
                                    $("#nama_guru").val("");
                                    $("#nip").val("");
                                    $("#username").val("");
                                    $('#password').val("");
                                    //window.location.href = base_url+'dataguru';
                                }
                            });
                    } else {
                        let errs = '';
                        $.each(response.errors, function (key, val) {
                            errs += val
                            $('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                            $('[name="' + key + '"]').nextAll('.help-block').eq(0).text(val);
                            if (val === '') {
                                $('[name="' + key + '"]').closest('.form-group').removeClass('has-error').addClass('has-success');
                                $('[name="' + key + '"]').nextAll('.help-block').eq(0).text('');
                            }
                        });
                        swal.fire({
                            title:"Gagal",
                            html: errs,
                            icon:"error"
                        });
                    }
                },error: function (xhr, status, error) {
                    console.log("error", xhr ? xhr.responseText : e);
                    swal.fire({
                        title:"Gagal",
                        html: 'Gagal menyimpan data',
                        icon:"error"
                    });
                }
            })
        });

        $('#input-file-events-excel').on('change', async function(e) {
            var files = e.target.files || [];
            if (!files.length) {
                $('#filename-excel').text("");
                $('#dropzone-excel').removeClass('has-file');
                $('#submit-excel').attr('disabled', 'disabled').prop('disabled', true);
                return;
            }
            $('#filename-excel').text(files[0].name);
            $('#dropzone-excel').addClass('has-file');
            errorGuru = [];
            formDataGuru = null;
            $('#submit-excel').attr('disabled', 'disabled').prop('disabled', true);
            $('#file-preview').html('<span class="text-center">Pastikan anda telah mengisi format yang telah disediakan.</span>');
            const jsonData = await getDataFromExcel(files[0]);
            let tbl = $('<table class="table table-bordered w-100" />');
            createTable(jsonData[jsonData.sheets[0]], tbl);
        });

        $('#input-file-events-word').on('change', async function(e) {
            var files = e.target.files || [];
            if (!files.length) {
                $('#filename-word').text("");
                $('#dropzone-word').removeClass('has-file');
                $('#submit-excel').attr('disabled', 'disabled').prop('disabled', true);
                return;
            }
            $('#filename-word').text(files[0].name);
            $('#dropzone-word').addClass('has-file');
            errorGuru = [];
            formDataGuru = null;
            $('#submit-excel').attr('disabled', 'disabled').prop('disabled', true);
            $('#file-preview').html('<span class="text-center">Pastikan anda telah mengisi format yang telah disediakan.</span>');
            parseWordDocxFile(files[0]);
        });

        $('#formUpload').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            if (!formDataGuru) {
                swal.fire({
                    title: "Peringatan",
                    text: "Silakan pilih file Word atau Excel terlebih dahulu.",
                    icon: "warning"
                });
                return false;
            }

            if (errorGuru.length > 0) {
                swal.fire({
                    title: "Gagal",
                    text: `Ada ${errorGuru.length} Username dan Password kurang dari 5 karakter`,
                    icon: "error"
                });
                return false;
            }

            $('#submit-excel').attr('disabled', 'disabled').prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i> Mengunggah...');

            swal.fire({
                title: "Menyimpan Data",
                text: "Silakan tunggu, sedang memproses data guru...",
                allowEscapeKey: false,
                allowOutsideClick: false,
                onOpen: () => {
                    swal.showLoading();
                }
            });

            $.ajax({
                url: base_url + "dataguru/do_import",
                type: "POST",
                processData: false,
                contentType: false,
                data: formDataGuru,
                success: function (data) {
                    $('#submit-excel').removeAttr('disabled').prop('disabled', false).html('<i class="fas fa-cloud-upload-alt me-2"></i> Mulai Upload');
                    if (data.status) {
                        swal.fire({
                            title: "Berhasil",
                            text: data.message || "Data guru berhasil diimpor",
                            icon: "success"
                        }).then(result => {
                            window.location.href = base_url + "dataguru";
                        });
                    } else {
                        console.log("error", data);
                        let errs = '';
                        if (data.errors && data.errors.length) {
                            $.each(data.errors, function (key, val) {
                                let er = '<ul>';
                                if (val.nama) er += `<li>${val.nama}</li>`;
                                if (val.nip) er += `<li>${val.nip}</li>`;
                                if (val.username) er += `<li>${val.username}</li>`;
                                if (val.password) er += `<li>${val.password}</li>`;
                                er += '</ul>';
                                errs += er;
                            });
                        } else {
                            errs = data.message || 'Gagal mengimpor data';
                        }
                        swal.fire({
                            title: "Gagal",
                            html: errs,
                            icon: "error"
                        });
                    }
                },
                error: function (xhr, status, error) {
                    $('#submit-excel').removeAttr('disabled').prop('disabled', false).html('<i class="fas fa-cloud-upload-alt me-2"></i> Mulai Upload');
                    console.log("error", xhr ? xhr.responseText : error);
                    swal.fire({
                        title: "Gagal",
                        text: "Terjadi kesalahan saat mengunggah file ke server.",
                        icon: "error"
                    });
                }
            });

            return false;
        });

        $.fn.toJson = function(){
            if(!this.is('table')){
                return;
            }

            var results = [];

            this.find('table tr').each(function(indx, obj){
                var tds = $(obj).children('td');
                results.push(tds);
            });

            return results;
        }
    });

    function parseWordDocxFile(file) {
        errorGuru = [];
        var showDiv = $('#file-preview')

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
                showDiv.html(resultObject.value);
                setTimeout(function () {
                    formDataGuru = new FormData($('#formUpload')[0])

                    showDiv.children().not("table").remove();
                    showDiv.children('table').each(function (i, v) {
                        $(this).addClass('table table-bordered w-100 table-soal');
                        const $trs = $(this).find('tr'), headers = $trs.splice(0, 1); // header rows
                        $trs.each(function (index, tr) {
                            var cekTbl = $(tr).parent().closest('td');
                            if (cekTbl.length === 0) {
                                var nama = $(this).find("td:eq(1)").text().trim();
                                var nip = $(this).find("td:eq(2)").text().trim();
                                var kode = $(this).find("td:eq(3)").text().trim();
                                var username = $(this).find("td:eq(4)").text().trim();
                                var password = $(this).find("td:eq(5)").text().trim();
                                var foto = $(this).find("td:eq(6)").find('img');
                                foto.each(function (ind, img) {
                                    $(img).attr('width', '100')
                                });
                                if (nama && (username || password || nip)) {
                                    if (username && username.length < 5) {
                                        errorGuru.push({
                                            'nama': nama,
                                            'username': username,
                                        })
                                        $(this).find("td:eq(4)").addClass('bg-danger');
                                    }
                                    if (password && password.length < 5) {
                                        errorGuru.push({
                                            'nama': nama,
                                            'password': password
                                        })
                                        $(this).find("td:eq(5)").addClass('bg-danger');
                                    }

                                    formDataGuru.append('guru['+index+'][2]', nama)
                                    formDataGuru.append('guru['+index+'][3]', nip)
                                    formDataGuru.append('guru['+index+'][4]', kode)
                                    formDataGuru.append('guru['+index+'][5]', username)
                                    formDataGuru.append('guru['+index+'][6]', password)
                                    if (foto.length > 0) {
                                        const ftGuru = $(foto[0]).attr('src')
                                        const ext = ftGuru.substring("data:image/".length, ftGuru.indexOf(";base64"))
                                        const base64 = ftGuru.split(';base64')[1]
                                        //console.log('file', ftGuru)
                                        formDataGuru.append('guru['+index+'][7]', base64)
                                        formDataGuru.append('guru['+index+'][8]', ext)
                                    }
                                } else {
                                    $(this).remove();
                                }
                            }
                        });
                    });
                    if (formDataGuru && showDiv.find('table tr').length > 1) {
                        $('#submit-excel').removeAttr('disabled').prop('disabled', false);
                    } else {
                        $('#submit-excel').attr('disabled', 'disabled').prop('disabled', true);
                    }
                    swal.close();
                }, 500);
            });
        };
        reader.readAsArrayBuffer(file);
    }

    function createTable(list, selector) {
        let cols = Headers(list.header, selector);
        let len = list.rows.length;
        if (list.rows.length > 50) len = 50;
        for (let i = 0; i < len; i++) {
            let row = $('<tr/>');
            for (let colIndex = 0; colIndex < cols.length; colIndex++) {
                let val = list.rows[i][cols[colIndex]] || '';
                console.log('col', colIndex, val)
                if (colIndex === 3 || colIndex > 8) {
                    row.append($('<td/>').html(val));
                } else {
                    let isValid = true;
                    if (colIndex === 4 && val.length < 5) {
                        isValid = false;
                        errorGuru.push({
                            'nama': list.rows[i][1],
                            'username': val,
                        })
                    } else if (colIndex === 5 && val.length < 5) {
                        isValid = false;
                        errorGuru.push({
                            'nama': list.rows[i][1],
                            'password': val
                        })
                    }
                    row.append($(`<td class="text-center ${isValid ? '' : 'bg-danger'}" />`).html(val));
                }
            }
            $(selector).append(row);
        }
        $('#file-preview').prepend(selector)

        if (list.rows.length > 0) {
            formDataGuru = new FormData($('#formUpload')[0])
            list.rows.forEach(function (siswa, ind) {
                for (const key in siswa) {
                    if (key) {
                        formDataGuru.append('guru['+ind+']['+key+']', siswa[key])
                    }
                }
            })
            $('#submit-excel').removeAttr('disabled').prop('disabled', false);
        } else {
            $('#submit-excel').attr('disabled', 'disabled').prop('disabled', true);
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
                                        if (i===3) {
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

    function onRemoved() {
        $(".dropify-filename-inner").text("");
    }
</script>

<?= $this->endSection() ?>
