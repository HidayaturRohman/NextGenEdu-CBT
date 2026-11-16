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
    </style>    <section class="content pt-2">
        <div class="container-fluid">
            <!-- Header Card -->
            <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px;">
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="d-flex align-items-center">
                      <div class="me-3 flex-shrink-0">
                        <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%); color: #ffffff;">
                          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="17 8 12 3 7 8"></polyline>
                            <line x1="12" y1="3" x2="12" y2="15"></line>
                          </svg>
                        </div>
                      </div>
                      <div>
                        <h4 class="card-title mb-1 fw-bold d-flex align-items-center" style="color: #333;">
                            <?= $subjudul ?> <?= isset($kelas) ? 'Kelas '.$kelas->nama_kelas : ''?>
                        </h4>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">Fasilitas impor data kolektif peserta didik melalui berkas Excel/CSV dan registrasi akun siswa.</p>
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

            <!-- Top Banner -->
            <div class="card mb-4 import-banner">
                <div class="card-body p-4 d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div style="z-index: 2; position: relative;">
                        <h4 class="mb-1 d-flex align-items-center">
                            <i class="fas fa-cloud-download-alt me-2" style="color: #1a237e;"></i> Download Template Import
                        </h4>
                        <p class="mb-0 mt-2">
                            Silakan unduh format Excel untuk mengimpor data teks siswa.
                        </p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="<?= base_url('datasiswa/template') ?>" download="format_siswa.xlsx" class="btn btn-format d-flex align-items-center">
                            <i class="fas fa-file-excel me-2"></i> Format Excel
                        </a>
                    </div>
                </div>
            </div>

            <!-- Upload Cards -->
            <div class="row">
                <div class="col-md-12 mb-4">
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
                                    <input type="file" id="input-file-events-excel" name="upload_file" class="custom-file-input-native" accept=".xlsx, .xls, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" onchange="document.getElementById('filename-excel').innerText = this.files[0] ? this.files[0].name : ''; document.getElementById('filename-excel').style.display = this.files[0] ? 'block' : 'none';" />
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p>Drag & drop file Excel di sini atau klik</p>
                                    <p class="filename" id="filename-excel"></p>
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
                                        <?php if (!isset($kelas) && !empty($kelass)) : ?>
                        <div class="row mb-3 align-items-center">
                            <div class="col-md-3">
                                <label class="form-label fw-bold mb-0"><i class="fas fa-school me-2 text-primary"></i>Pilih Kelas Tujuan :</label>
                            </div>
                            <div class="col-md-5">
                                <select id="select_kelas_import" class="form-select form-select-sm">
                                    <option value="0">-- Sesuai Kolom Excel / Tanpa Kelas --</option>
                                    <?php foreach ($kelass as $k => $v) : ?>
                                        <option value="<?= $k ?>"><?= $v ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted">Pilih kelas jika ingin langsung memasukkan siswa ke kelas tertentu.</small>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($kelas)) : ?>
                        <div class="alert alert-info py-2 mb-3" style="border-radius: 8px;"><i class="fas fa-info-circle me-2"></i>Siswa akan otomatis masuk ke <b>Kelas: <?= $kelas->nama_kelas ?></b></div>
                    <?php endif; ?>
                    
                    <div class="alert alert-danger d-none" id="error-excel"></div>
                    
                    <div id="file-preview" style="min-height: 250px; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: #f8f9fa; border-radius: 8px; border: 2px dashed #dee2e6;">
                        <i class="fas fa-inbox fa-3x mb-3" style="color: #cfd8dc;"></i>
                        <span class="text-center text-muted" style="font-weight: 500;">Pastikan anda telah mengisi format yang telah disediakan.</span>
                    </div>
                    
                    <div class="table-responsive bg-light p-3 rounded border mt-3" id="table-wrapper" style="display: none;">
                        <table id="tableprev" class="table table-sm table-striped table-bordered nowrap w-100 mb-0"></table>
                    </div>
                </div>
            </div>
        </div>
    </section><?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript" src="<?= base_url() ?>/assets/app/js/FileSaver.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/app/js/excel/exceljs.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/app/js/excel/js-excel-template.min.js"></script>

<script>
    const idKelasAktif = '<?= isset($kelas) ? $kelas->id_kelas : 0 ?>';
    let dataSiswa = [];
    let keysExcel = 45;
    let errorSiswa = [];

    $(document).ready(function () {
        ajaxcsrf();
        if (typeof bsCustomFileInput !== "undefined") bsCustomFileInput.init();

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
            createTable(jsonData[jsonData.sheets[0]], '#tableprev')
        });

        $('#formUpload').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            const limit = 900 / keysExcel
            uploadData(limit);
            return false;
        });

    });

    function onRemoved() {
        $(".dropify-filename-inner").text("");
    }

    function createTable(list, selector) {
        errorSiswa = []
        //console.log('len', list.rows.length)
        if (list.rows.length === 0) {
            $('#submit-excel').attr('disabled', 'disabled');
            swal.fire({
                title:"Tidak ada data",
                text:"File tidak berisi data siswa",
                icon:"warning"
            });

            return;
        }
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

        const valRequired = [2,3,4,5,6,7]
        for (let i = 0; i < len; i++) {
            let novalid = 0;
            for (const number of valRequired) {
                if (!list.rows[i][number]) {
                    novalid ++
                }
            }

            if (novalid === 0) {
                let row = $('<tr/>')
                for (let colIndex = 0; colIndex < cols.cols.length; colIndex++) {
                    let val = list.rows[i][cols.cols[colIndex]] ||"";
                    //console.log('col', colIndex, val)
                    if (colIndex === 3 || colIndex > 8) {
                        row.append($('<td/>').html(val));
                    } else {
                        let isValid = true;
                        if (colIndex === 5 && val.length < 5) {
                            isValid = false;
                            //console.log(list.rows[i][4], val)
                            errorSiswa.push({
                                'nama': list.rows[i][4],
                                'username': val,
                            })
                        } else if (colIndex === 6 && val.length < 5) {
                            isValid = false;
                            //console.log(list.rows[i][4], val)
                            errorSiswa.push({
                                'nama': list.rows[i][4],
                                'password': val
                            })
                        }
                        row.append($(`<td class="text-center ${isValid ? '' : 'bg-danger'}" />`).html(val));
                    }
                }
                $(selector).append(row);
            }
        }

        dataSiswa = [] //new FormData($('#formUpload')[0])
        if (list.rows.length > 0) {
            console.log('siswa', list.rows)
            const remapped = remapSiswa(list.rows);
            dataSiswa = remapped.data
            dataSiswa.sort((a, b) => a.nama?.localeCompare(b.nama, undefined, {numeric: true}))
            console.log('remap', remapped)
            if (remapped.error.length > 0) {
                let errorInfo = `WARNING`
                errorInfo += `<ul>
                        <li>Total data dari file Excel: <b>${list.rows.length}</b></li>
                        <li>Siswa yang akan diupload: <b>${remapped.data.length}</b></li>
                        <li>Siswa dihilangkan karena tidak lengkap: <b>${remapped.error.length}</b></li>
                        <li>Data tidak valid: <b>${list.rows.length - remapped.data.length}</b></li>
                    </ul>`;
                $('#error-excel').html(errorInfo).removeClass('d-none')
            }
            if (dataSiswa.length > 0) {
                $(selector).prepend(cols.header);
                $('#submit-excel').removeAttr('disabled');
            }

            setTimeout(function () {
                swal.close();
            }, 500)
        } else {
            $('#submit-excel').attr('disabled', 'disabled');
        }
    }

    function Headers(list, selector) {
        let columns = [];
        let title = $('<tr/>');

        for (let i = 0; i < list.length; i++) {
            let row = list[i];
            for (let k in row) {
                if (k === 'label') {
                    title.append($('<th class="text-center align-middle" />').html(row[k]));
                } else {
                    if ($.inArray(row[k], columns) == -1) {
                        columns.push(row[k]);
                    }
                }
            }
        }
        //$(selector).append(header);
        return {
            cols: columns,
            header: title
        }
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
                                            console.log('val', val)
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
                                        } else if (i===13) {
                                            val = capitalizeFirstLetter(val);
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

    const mapping = [
        {"key":"2","value":"nisn","req": true,"min": 6,"max": 30},
        {"key":"3","value":"nis","req": true,"min": 6,"max": 20},
        {"key":"4","value":"nama","req": true,"min": 6,"max": 30},
        {"key":"5","value":"jenis_kelamin","req": true},
        {"key":"6","value":"username","req": true,"min": 5},
        {"key":"7","value":"password","req": true,"min": 5},
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
                const map = mapping.find(function (o) {
                    return o.key === key;
                });
                if (map) {
                    siswa[map.value] = data[key]
                }
            }

            console.log('keys', siswa)
            const keySiswa = Object.keys(siswa);
            const keysLength = keySiswa.length;
            if (keysLength > 0) {
                if (keySiswa.includes('nama') && keySiswa.includes('nis')
                    && keySiswa.includes('nisn') && keySiswa.includes('jenis_kelamin')
                    && keySiswa.includes('username') && keySiswa.includes('password')) {
                    const sNisn = String(siswa.nisn || '');
                    const sNis = String(siswa.nis || '');
                    const sNama = String(siswa.nama || '');
                    if ((sNisn.length > 2 || sNis.length > 2) && sNama.length > 0
                        || siswa.username.length > 0 || siswa.password.length > 0) {
                        if (keysLength > keys) keys = keysLength
                        siswa['foto'] = siswa.nis || '00'
                        siswa['uid'] = generateUUID()
                        keys += 2;
                        result.push(siswa)
                    }
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
        console.log('pages', limit, pages, keysExcel)
        if (pages === 0) return

        if (errorSiswa.length > 0) {
            swal.fire({
                title:"Gagal",
                text: `ada ${errorSiswa.length} Username dan Password kurang dari 5 karakter`,
                icon:"error"
            });
            return
        }
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
            console.log('paginate', siswas)
            let targetKelas = idKelasAktif;
            if ($('#select_kelas_import').length && $('#select_kelas_import').val() !== '0') {
                targetKelas = $('#select_kelas_import').val();
            }
            let formDataSiswa = new FormData($('#formUpload')[0]);
            formDataSiswa.append('id_kelas', targetKelas);
            const url ="datasiswa/do_import";
            if (siswas.length > 0) {
                let inds = 0;
                let ids = [];
                for (const siswa of siswas) {
                    for (const key in siswa) {
                        ids.push(siswa.id_siswa)
                        formDataSiswa.append(`siswa[${inds}][${key}]`, siswa[key])
                    }
                    inds ++;
                }
            }

            try {
                const data = await ajaxPost(url, formDataSiswa)
                uploaded += data.user
                console.log("response:", data);
                if (data.status) {
                    if (uploaded >= dataSiswa.length) {
                        swal.fire({
                            title:"Berhasil",
                            text:"Data siswa berhasil diimpor",
                            icon:"success"
                        }).then(result => {
                            if (result.value) {
                                window.history.back();
                            }
                        });
                    }
                } else {
                    console.log(data.errors);
                    let er = '<table class="table table-sm table-borderless">';
                    if (data.wrong) {
                        er += '<tr><td>Anda menggunakan Excel untuk update data siswa</td></tr>'
                    } else {
                        er += '<tr><td colspan="2" class="text-left">cek kembali nomor berikut:</td></tr>'
                        for (const num in data.errors) {
                            const o = data.errors[num]
                            er +="<tr><td class='text-sm text-center'>" + num +".</td><td class='text-left text-sm'>";
                            if (o.nama !=="") er +="" + o.nama
                            if (o.nisn !=="") er +="" + o.nisn
                            if (o.nis !=="") er +="" + o.nis
                            if (o.username !=="") er +="" + o.username
                            if (o.password !=="") er +="" + o.password
                            er +="</td></tr>"
                        }
                    }
                    er += '</table>';
                    swal.fire({
                        title:"Gagal",
                        html: er,
                        icon:"error"
                    }).then(result => {});
                    break;
                }
            } catch (error) {
                console.log("Error occurred:", error);
                swal.fire({
                    title:"Gagal",
                    text: 'Gagal menyimpan data',
                    icon:"error"
                });
                break
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

    function generateUUID() {
        return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c =>
            (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & (15 >> (c / 4))).toString(16)
        );
    }

    function capitalizeFirstLetter(str) {
        if (!str) return '';
        return str.charAt(0).toUpperCase() + str.toLowerCase().slice(1);
    }

</script>
<?= $this->endSection() ?>
