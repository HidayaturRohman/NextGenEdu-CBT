<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<style>
    #file-preview table td, #file-preview table th {
        white-space: normal !important;
        word-wrap: break-word !important;
    }
    #file-preview table {
        width: 100% !important;
        table-layout: auto !important;
    }
</style>

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
    </style>
<div class="d-contents">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="me-3 flex-shrink-0">
            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: #ffffff;">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                <polyline points="17 8 12 3 7 8"></polyline>
                <line x1="12" y1="3" x2="12" y2="15"></line>
              </svg>
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
                            <i class="fas fa-cloud-download-alt me-2" style="color: #1a237e;"></i> Download Template Upload Soal
                        </h4>
                        <p class="mb-0 mt-2">
                            Silakan unduh format Word untuk menyusun dan mengunggah soal.
                        </p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="<?= base_url('uploads/import/format/Template%20Soal.docx') ?>" download="Template Soal <?= $bank->nama_mapel ?> <?= $bank->bank_kode ?>.docx" class="btn btn-format d-flex align-items-center">
                            <i class="fas fa-file-word me-2"></i> Format Word (.docx)
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
                                <span class="icon-circle word"><i class="fas fa-file-word"></i></span>
                                Upload Soal <?= $bank->nama_mapel . " kelas " . $bank->bank_level ?>
                            </h5>
                        </div>
                        <div class="card-body">
                            <?= form_open_multipart('', array('id' => 'formPreviewWord')); ?>
                            <input type="hidden" name="bank_id" id="formInput" class="form-control">
                            <div class="form-group mb-0">
                                <div class="custom-dropzone" id="dropzone-word">
                                    <input type="file" name="upload_file" class="custom-file-input-native" id="upload-word" accept=".doc, .docx" onchange="document.getElementById('filename-word').innerText = this.files[0] ? this.files[0].name : ''; document.getElementById('filename-word').style.display = this.files[0] ? 'block' : 'none';" />
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p>Drag & drop file Word (.docx) di sini atau klik</p>
                                    <p class="filename" id="filename-word" style="display:none;"></p>
                                </div>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preview Card -->
            <div class="card mb-4 card-upload">
                <div class="card-header card-upload-header pb-3 d-flex align-items-center justify-content-between" style="padding-bottom: 0;">
                    <h5 class="upload-title">
                        <span class="icon-circle preview"><i class="fas fa-eye"></i></span>
                        Live Preview Soal
                    </h5>
                    <button type="button" class="btn btn-update shadow-sm" onclick="getData()">
                        <i class="fas fa-cloud-upload-alt me-2"></i> Mulai Upload
                    </button>
                </div>
                
                <div class="card-body">
                    <div id="file-preview" class="table-responsive"
                         data-id="<?= csrf_hash() ?>"
                         data-name="<?= csrf_token() ?>">
                        <div class="alert alert-info align-content-center" role="alert">
                            Sebelum upload, pastikan anda telah mengisi format yang telah disediakan.
                        </div>
                    </div>
                </div>
            </div>
        </div>
                    </div>
            </div>
        </div>
    </section></div>
</div>
<?= form_open('create', array('id' => 'grouping')) ?>
<div id="input-soal-word" class="d-none"></div>
<?= form_close() ?>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script type="text/javascript"
        src="<?= base_url() ?>/assets/plugins/jquery-table2json/src/tabletojson-cell.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/plugins/jquery-table2json/src/tabletojson-row.js"></script>
<script src="<?= base_url() ?>/assets/app/js/mammoth.browser.min.js"></script>
<script src="<?= base_url() ?>/assets/app/js/docx.js"></script>
<script src="<?= base_url() ?>/assets/plugins/katex/katex.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/katex/contrib/auto-render.min.js"></script>
<script src="<?= base_url() ?>/assets/app/js/omml2latex.js"></script>

<script>
    const bank_id = '<?= $bank->id_bank ?>';
    const jenjang = '<?= $setting->jenjang ?>';
    $(function () {
        bsCustomFileInput.init();
    });

    let filename = '';
    $(document).ready(function () {
        ajaxcsrf();

        $('#upload-word').on('change', function (e) {
            if (e.target.files && e.target.files[0]) {
                filename = e.target.files[0].name;
            }
            parseWordDocxFile(e.target.files, '#file-preview');
        });
    });

    function normalizeDigits(str) {
        if (!str) return '';
        return str.toString()
            .replace(/[\u0660-\u0669]/g, function (d) { return String.fromCharCode(d.charCodeAt(0) - 1632 + 48); })
            .replace(/[\u06F0-\u06F9]/g, function (d) { return String.fromCharCode(d.charCodeAt(0) - 1776 + 48); });
    }

    function isKunciIndikator(indikator, pilihan) {
        if (!indikator) return false;
        var ind = indikator.toString().trim().replace(/[\s\u00A0]/g, '').toUpperCase();
        if (['V', '✓', '✔', '☑', '√', '1', 'X', '*', 'TRUE', 'BENAR', 'YA', 'OK'].includes(ind)) {
            return true;
        }
        if (pilihan) {
            var pil = pilihan.toString().trim().replace(/[\s\u00A0]/g, '').toUpperCase();
            if (ind === pil || ind === pil + '.' || ind === pil + ')') {
                return true;
            }
        }
        return false;
    }

    async function parseWordDocxFile(inputElement, showDiv) {
        const files = inputElement || [];
        if (!files.length) return;

        swal.fire({
            title: "Mempersiapkan pratinjau",
            text: "Sedang membaca file Word, silakan tunggu....",
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
                swal.showLoading();
            }
        });

        const file = files[0];
        filename = file.name;

        try {
            const arrayBuffer = await file.arrayBuffer();
            const zip = await JSZip.loadAsync(arrayBuffer);

            // 1. Bersihkan document.xml & convert Word Math (OMML) ke LaTeX
            const documentXmlPath = "word/document.xml";
            let documentXml = await zip.file(documentXmlPath).async("string");

            // Convert Office Math (OMML) ke LaTeX \( ... \)
            if (typeof OmmlToLatex !== 'undefined' && OmmlToLatex.preprocessDocumentXml) {
                documentXml = OmmlToLatex.preprocessDocumentXml(documentXml);
            }

            documentXml = documentXml
                .replace(/<w:altChunk[^>]*\/>/g, "")
                .replace(/<w:altChunk[\s\S]*?<\/w:altChunk>/g, "");
            zip.file(documentXmlPath, documentXml);

            // 2. Bersihkan document.xml.rels
            const relsPath = "word/_rels/document.xml.rels";
            if (zip.file(relsPath)) {
                let relsXml = await zip.file(relsPath).async("string");
                relsXml = relsXml.replace(/<Relationship[^>]+Type="[^"]*aFChunk[^"]*"[^>]*\/>/g, "");
                zip.file(relsPath, relsXml);
            }

            // 3. Generate ulang file docx
            const cleanedDocxBlob = await zip.generateAsync({ type: "blob" });

            const options = {
                styleMap: ["u => u", "strike => del"]
            };
            const resultObject = await mammoth.convertToHtml({ arrayBuffer: await cleanedDocxBlob.arrayBuffer() }, options);
            if (!resultObject || resultObject.value === "") {
                let html = '<div class="alert alert-warning" role="alert">' +
                    '<h6 class="fw-bold mb-2"><i class="fas fa-exclamation-triangle me-2"></i> File Word tidak terbaca</h6>' +
                    '<ul>' +
                    '<li>Pastikan file Word (.docx) tidak kosong atau corrupt</li>' +
                    '<li>Lakukan <b>Save As</b> di Microsoft Word untuk membuat salinan baru, lalu upload kembali</li>' +
                    '</ul></div>';
                $(showDiv).html(html);
                swal.close();
                return;
            }

            let rawHtml = resultObject.value;

            // Smart Free-form parser: Jika Word tidak berbentuk tabel CBT, parse otomatis menjadi tabel CBT
            if (typeof OmmlToLatex !== 'undefined' && OmmlToLatex.parseFreeformToCbtTables) {
                rawHtml = OmmlToLatex.parseFreeformToCbtTables(rawHtml, jenjang);
            }

            $(showDiv).html(rawHtml);
            $(showDiv).children().not("table").remove();

            let sectionStats = { '1': 0, '2': 0, '3': 0, '4': 0, '5': 0 };
            let totalRealQuestions = 0;
            let fourColCount = 0;

            $(showDiv).children('table').each(function () {
                const $tbl = $(this);
                $tbl.addClass('table table-bordered w-100 table-soal mb-4');

                const $trs = $tbl.find('tr');
                if ($trs.length === 0) return;

                // Tentukan default jenis tabel ini
                let tblJenis = "";
                let maxCols = 0;
                $trs.each(function () {
                    const l = $(this).find('td').length;
                    if (l > maxCols) maxCols = l;
                    if (!tblJenis) {
                        const jCandidate = $(this).find('td').eq(2).text().trim();
                        if (['1', '2', '3', '4', '5'].includes(jCandidate)) tblJenis = jCandidate;
                    }
                });

                if (!tblJenis) {
                    const headerTxt = $tbl.find('tr:first').text().toLowerCase();
                    if (headerTxt.includes('kompleks')) tblJenis = "2";
                    else if (headerTxt.includes('jodoh')) tblJenis = "3";
                    else if (headerTxt.includes('singkat') || headerTxt.includes('isian')) tblJenis = "4";
                    else if (headerTxt.includes('urai') || headerTxt.includes('esai')) tblJenis = "5";
                    else if (maxCols === 4) {
                        fourColCount++;
                        tblJenis = (fourColCount === 1) ? "4" : "5";
                    } else if (maxCols >= 9) {
                        tblJenis = "3";
                    } else {
                        tblJenis = "1";
                    }
                }

                let curActiveNo = "";
                let tblQuestionCount = 0;

                $trs.each(function (idx, tr) {
                    const $tds = $(tr).find('td');
                    if ($tds.length === 0) return;
                    const tdLen = $tds.length;

                    $(tr).addClass('tr-soal');
                    $tds.addClass('td-soal');
                    $tds.find('table').addClass('table table-bordered table-inner');

                    const rawCol0 = $tds.eq(0).text().trim();
                    const cleanCol0 = normalizeDigits(rawCol0.replace(/[\.\)\s\u00A0]/g, ''));
                    const isNum = /^\d+$/.test(cleanCol0);
                    const cleanCol0Upper = cleanCol0.toUpperCase();
                    const rawCol1Upper = $tds.length > 1 ? $tds.eq(1).text().trim().toUpperCase() : '';

                    // Header row
                    if (cleanCol0Upper === 'NO' || cleanCol0Upper === 'KODE' || rawCol1Upper === 'SOAL' || rawCol1Upper === 'NAMA BARIS' || rawCol1Upper === 'BARIS') {
                        $(tr).addClass('bg-light font-weight-bold table-active');
                        $tds.css({ 'font-weight': 'bold', 'text-align': 'center' });
                        return;
                    }

                    // --- KHUSUS TABEL MENJODOHKAN (JENIS 3) ---
                    if (tblJenis === "3") {
                        // Sub-row 6 kolom (Mammoth vMerge output: Col 0, 1, 2 di-merge)
                        if (tdLen >= 6 && tdLen < 8) {
                            if (curActiveNo !== "") {
                                $tds.eq(0).css({ 'text-align': 'center', 'direction': 'ltr', 'font-weight': 'bold', 'width': '45px' });
                                $tds.eq(2).css({ 'text-align': 'center', 'direction': 'ltr', 'font-weight': 'bold', 'width': '45px' });
                                $tds.eq(4).css({ 'text-align': 'center', 'direction': 'ltr', 'font-weight': 'bold', 'width': '55px' });
                                $tds.eq(5).css({ 'text-align': 'center', 'direction': 'ltr', 'font-weight': 'bold', 'width': '55px' });
                            } else {
                                $(tr).hide();
                            }
                            return;
                        }

                        // Baris lengkap 8-9 kolom
                        if (tdLen >= 8) {
                            const col1Text = $tds.eq(1).text().trim();
                            const col1Img = $tds.eq(1).find('img').length;
                            const hasContent = (col1Text !== '' || col1Img > 0);
                            const barisText = $tds.length > 4 ? $tds.eq(4).text().trim() : '';

                            if (isNum && hasContent) {
                                // Butir Soal Baru Menjodohkan
                                curActiveNo = cleanCol0;
                                totalRealQuestions++;
                                tblQuestionCount++;
                                sectionStats['3']++;

                                $tds.eq(0).css({
                                    'text-align': 'center',
                                    'direction': 'ltr',
                                    'font-weight': 'bold',
                                    'width': '55px',
                                    'background-color': '#f8f9fa'
                                });
                                $(tr).css('background-color', '#fcfdff');
                            } else if (!isNum && curActiveNo !== "") {
                                // Baris pasangan lanjutan (bisa 1 s/d 15 baris)
                                if (barisText !== '') {
                                    $tds.eq(3).css({ 'text-align': 'center', 'direction': 'ltr', 'font-weight': 'bold', 'width': '45px' });
                                    $tds.eq(5).css({ 'text-align': 'center', 'direction': 'ltr', 'font-weight': 'bold', 'width': '45px' });
                                } else {
                                    $(tr).hide();
                                }
                            } else {
                                // Baris template kosong
                                curActiveNo = "";
                                $(tr).hide();
                            }
                        }
                        return;
                    }

                    // --- TABEL NON-MENJODOHKAN (PG, PGK, ISIAN, ESAI) ---
                    if (isNum) {
                        const col1Text = $tds.length > 1 ? $tds.eq(1).text().trim() : '';
                        const col1Img = $tds.length > 1 ? $tds.eq(1).find('img').length : 0;
                        const hasContent = (col1Text !== '' || col1Img > 0);

                        if (hasContent) {
                            curActiveNo = cleanCol0;
                            totalRealQuestions++;
                            tblQuestionCount++;
                            const detectedJ = detectJenisFromText($tds.length > 2 ? $tds.eq(2).text() : '', tblJenis);
                            if (sectionStats[detectedJ] !== undefined) sectionStats[detectedJ]++;

                            // Style header baris nomor soal
                            $tds.eq(0).css({
                                'text-align': 'center',
                                'direction': 'ltr',
                                'font-weight': 'bold',
                                'width': '55px',
                                'background-color': '#f8f9fa'
                            });
                            $(tr).css('background-color', '#fcfdff');
                        } else {
                            // Row is an empty template placeholder!
                            curActiveNo = "";
                            $(tr).hide(); // Sembunyikan baris template kosong agar pratinjau rapi
                            return;
                        }
                    } else {
                        // Sub-row PG / PGK
                        if (curActiveNo !== "") {
                            // Sub-row belongs to active question
                            if ($tds.length >= 6) {
                                const optLetter = $tds.eq(3).text().trim().toUpperCase();
                                const optText = $tds.eq(4).text().trim();
                                const optImg = $tds.eq(4).find('img').length;
                                if (['A', 'B', 'C', 'D', 'E'].includes(optLetter) && optText === '' && optImg === 0) {
                                    $(tr).hide();
                                    return;
                                }
                                $tds.eq(3).css({ 'text-align': 'center', 'direction': 'ltr', 'font-weight': 'bold', 'width': '45px' });
                                $tds.eq(5).css({ 'text-align': 'center', 'direction': 'ltr', 'font-weight': 'bold', 'width': '60px' });
                            }
                        } else {
                            // Sub-row belongs to a hidden placeholder question -> HIDE
                            $(tr).hide();
                            return;
                        }
                    }

                    // Format teks Arab bila ada pada sel isi soal atau jawaban
                    $tds.each(function (tdIdx) {
                        // Kolom nomor (0) dan opsi huruf (3) jangan di-RTL
                        if (tdIdx === 0 || ($tds.length >= 6 && (tdIdx === 3 || tdIdx === 5))) {
                            return;
                        }
                        const $cell = $(this);
                        const cellText = $cell.text();
                        if (/[\u0600-\u06FF]/.test(cellText)) {
                            $cell.css({
                                'font-size': '14pt',
                                'font-family': "'Amiri', 'Traditional Arabic', 'Calibri', serif",
                                'direction': 'rtl',
                                'text-align': 'right'
                            });
                        }
                    });
                });

                if (tblQuestionCount === 0) {
                    $tbl.hide(); // Sembunyikan tabel yang sama sekali tidak ada soalnya
                }
            });

            const attrId = document.getElementById("formInput");
            if (attrId) {
                attrId.setAttribute("value", bank_id);
            }

            // Summary banner
            let detailParts = [];
            if (sectionStats['1'] > 0) detailParts.push(`<b>${sectionStats['1']}</b> PG`);
            if (sectionStats['2'] > 0) detailParts.push(`<b>${sectionStats['2']}</b> PG Kompleks`);
            if (sectionStats['3'] > 0) detailParts.push(`<b>${sectionStats['3']}</b> Menjodohkan`);
            if (sectionStats['4'] > 0) detailParts.push(`<b>${sectionStats['4']}</b> Isian`);
            if (sectionStats['5'] > 0) detailParts.push(`<b>${sectionStats['5']}</b> Uraian`);
            const detailsStr = detailParts.length > 0 ? " (" + detailParts.join(', ') + ")" : "";

            const alertClass = totalRealQuestions > 0 ? 'alert-success' : 'alert-warning';
            const alertIcon = totalRealQuestions > 0 ? 'fa-check-circle text-success' : 'fa-exclamation-triangle text-warning';
            const alertTitle = totalRealQuestions > 0 ? 'Pratinjau Soal Siap Diunggah' : 'Peringatan Format';

            $(showDiv).prepend(`
                <div class="alert ${alertClass} align-content-center shadow-sm mb-3" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas ${alertIcon} fa-2x me-3"></i>
                        <div>
                            <h6 class="mb-1 fw-bold">${alertTitle}</h6>
                            <span>Total Soal komplit dan siap diupload: <b>${totalRealQuestions}</b> butir soal${detailsStr}</span>
                            <div class="mt-1 text-muted" style="font-size: 0.85rem;"><i class="fas fa-file-word me-1"></i> File: <b>${file.name}</b></div>
                        </div>
                    </div>
                </div>
            `);

            // KaTeX
            if (typeof OmmlToLatex !== 'undefined' && OmmlToLatex.renderMath) {
                OmmlToLatex.renderMath(showDiv);
            }
            swal.close();

        } catch (err) {
            console.error("Error parsing Word docx:", err);
            $(showDiv).html(`
                <div class="alert alert-danger" role="alert">
                    <h6 class="fw-bold"><i class="fas fa-times-circle me-2"></i> Gagal Membaca File Word</h6>
                    <p class="mb-0">Terjadi kesalahan saat memproses file: ${err.message || err}</p>
                </div>
            `);
            swal.close();
        }
    }

    function detectJenisFromText(text, fallback) {
        if (!text) return fallback || '1';
        const t = text.toString().trim().toLowerCase();
        if (['1', '2', '3', '4', '5'].includes(t)) return t;
        if (t.includes('kompleks')) return '2';
        if (t.includes('ganda') || t.includes('pg')) return '1';
        if (t.includes('jodoh')) return '3';
        if (t.includes('singkat') || t.includes('isian')) return '4';
        if (t.includes('urai') || t.includes('esai') || t.includes('essai')) return '5';
        return fallback || '1';
    }

    function getData() {
        if (!filename) {
            showDangerToast('Pilih file Word terlebih dahulu');
            return;
        }

        var $tables = $('.table-soal:visible');
        if ($tables.length === 0) {
            $tables = $('.table-soal');
        }
        if ($tables.length === 0) {
            swal.fire({
                title: "Peringatan",
                text: "Tidak ada tabel soal yang terdeteksi. Silakan pilih dan pratinjau file Word terlebih dahulu.",
                icon: "warning"
            });
            return;
        }

        swal.fire({
            title: "Import soal ke database",
            text: "Silahkan tunggu....",
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
                swal.showLoading();
            }
        });

        let soalObject = {}; // Format: { [jenis]: { [nomor]: { soal: '', opsi: {}, kunci: [], ... } } }

        function initSoal(jenis, nomor, soalHtml) {
            if (!soalObject[jenis]) soalObject[jenis] = {};
            if (!soalObject[jenis][nomor]) {
                soalObject[jenis][nomor] = {
                    soal: soalHtml || '',
                    opsi: {},
                    kunci: []
                };
            } else if (soalHtml) {
                soalObject[jenis][nomor].soal = soalHtml;
            }
        }

        function addOpsi(jenis, nomor, opsiHuruf, opsiHtml, kunciText) {
            if (!soalObject[jenis]) soalObject[jenis] = {};
            if (!soalObject[jenis][nomor]) {
                soalObject[jenis][nomor] = { soal: '', opsi: {}, kunci: [] };
            }
            if (opsiHuruf) {
                const cleanText = (opsiHtml || '').replace(/<[^>]+>/g, '').trim();
                const hasImg = (opsiHtml || '').includes('<img');
                // Jangan masukkan opsi jika benar-benar kosong kecuali A, B, C, D
                if (cleanText !== '' || hasImg || ['A', 'B', 'C', 'D'].includes(opsiHuruf)) {
                    soalObject[jenis][nomor].opsi[opsiHuruf] = opsiHtml || '';
                    if (isKunciIndikator(kunciText, opsiHuruf)) {
                        if (!soalObject[jenis][nomor].kunci.includes(opsiHuruf)) {
                            soalObject[jenis][nomor].kunci.push(opsiHuruf);
                        }
                    }
                }
            }
        }

        function addJodohkan(jenis, nomor, soalHtml, kdBaris, barisHtml, kdKolom, kolomHtml, kdKunci, kunciVal) {
            if (!soalObject[jenis]) soalObject[jenis] = {};
            if (!soalObject[jenis][nomor]) {
                soalObject[jenis][nomor] = {
                    soal: soalHtml || '',
                    baris: {},
                    kolom: {},
                    kunci: {}
                };
            } else if (soalHtml) {
                soalObject[jenis][nomor].soal = soalHtml;
            }

            const cleanKdBaris = (kdBaris || '').toString().trim().replace(/[\s\u00A0]/g, '');
            const cleanBarisText = (barisHtml || '').replace(/<[^>]+>/g, '').replace(/[\s\u00A0]/g, '');
            const cleanKdKolom = (kdKolom || '').toString().trim().replace(/[\s\u00A0]/g, '').toUpperCase();
            const cleanKolomText = (kolomHtml || '').replace(/<[^>]+>/g, '').replace(/[\s\u00A0]/g, '');
            const cleanKdKunci = (kdKunci || '').toString().trim().replace(/[\s\u00A0]/g, '');
            const cleanKunciVal = (kunciVal || '').toString().trim().replace(/[\s\u00A0]/g, '').toUpperCase();

            if (cleanKdBaris !== '' && cleanBarisText !== '') {
                soalObject[jenis][nomor].baris[cleanKdBaris] = barisHtml;
            }
            if (cleanKdKolom !== '' && cleanKolomText !== '') {
                soalObject[jenis][nomor].kolom[cleanKdKolom] = kolomHtml;
            }
            if (cleanKdKunci !== '' && cleanKunciVal !== '') {
                soalObject[jenis][nomor].kunci[cleanKdKunci] = cleanKunciVal;
            }
        }

        function addIsianEsai(jenis, nomor, soalHtml, kunciVal) {
            if (!soalObject[jenis]) soalObject[jenis] = {};
            soalObject[jenis][nomor] = {
                soal: soalHtml || '',
                kunci: kunciVal || ''
            };
        }

        let fourColTableCount = 0;

        $tables.each(function () {
            const $table = $(this);
            const $trs = $table.find('tr.tr-soal');
            if ($trs.length === 0) return;

            let tableDefaultJenis = "";
            let colCount = 0;

            $trs.each(function () {
                const $tds = $(this).find('td');
                if ($tds.length > colCount) colCount = $tds.length;

                const jVal = $tds.eq(2).text().trim().toLowerCase();
                if (!tableDefaultJenis && jVal) {
                    const detected = detectJenisFromText(jVal, '');
                    if (detected) tableDefaultJenis = detected;
                }
            });

            if (!tableDefaultJenis) {
                const headerText = $table.find('tr:first').text().toLowerCase();
                if (headerText.includes('kompleks')) tableDefaultJenis = "2";
                else if (headerText.includes('jodoh')) tableDefaultJenis = "3";
                else if (headerText.includes('singkat') || headerText.includes('isian')) tableDefaultJenis = "4";
                else if (headerText.includes('urai') || headerText.includes('esai')) tableDefaultJenis = "5";
                else if (colCount === 4) {
                    fourColTableCount++;
                    tableDefaultJenis = (fourColTableCount === 1) ? "4" : "5";
                } else if (colCount >= 9) {
                    tableDefaultJenis = "3";
                } else {
                    tableDefaultJenis = "1";
                }
            }

            let currentNo = "";
            let currentJenis = tableDefaultJenis;

            $trs.each(function () {
                const $tds = $(this).find('td');
                const tdLen = $tds.length;
                if (tdLen === 0) return;

                const rawCol0 = $tds.eq(0).text().trim();
                const cleanCol0 = normalizeDigits(rawCol0.replace(/[\.\)\s\u00A0]/g, ''));
                const isNumericCol0 = /^\d+$/.test(cleanCol0);
                const isOptionCol0 = ['A', 'B', 'C', 'D', 'E'].includes(cleanCol0.toUpperCase());

                // Skip header
                const cleanCol0Upper = cleanCol0.toUpperCase();
                const rawCol1Upper = tdLen > 1 ? $tds.eq(1).text().trim().toUpperCase() : '';
                if (cleanCol0Upper === 'NO' || cleanCol0Upper === 'KODE' || rawCol1Upper === 'SOAL' || rawCol1Upper === 'NAMA BARIS' || rawCol1Upper === 'BARIS') {
                    return;
                }

                // --- KHUSUS TABEL MENJODOHKAN (JENIS 3) ---
                if (tableDefaultJenis === "3") {
                    // Sub-row 6 kolom (Mammoth vMerge output: [0: kdBaris, 1: barisHtml, 2: kdKolom, 3: kolomHtml, 4: kdKunci, 5: kunciVal])
                    if (tdLen >= 6 && tdLen < 8) {
                        if (currentNo !== "") {
                            const kdBaris = $tds.eq(0).text().trim().replace(/[\s\u00A0]/g, '');
                            const barisHtml = removeUrl($tds.eq(1).html());
                            const kdKolom = $tds.eq(2).text().trim().replace(/[\s\u00A0]/g, '').toUpperCase();
                            const kolomHtml = removeUrl($tds.eq(3).html());
                            const kdKunci = $tds.eq(4).text().trim().replace(/[\s\u00A0]/g, '');
                            const kunciVal = $tds.eq(5).text().trim().replace(/[\s\u00A0]/g, '').toUpperCase();
                            if (kdBaris || barisHtml || kdKolom || kolomHtml || kdKunci || kunciVal) {
                                addJodohkan("3", currentNo, '', kdBaris, barisHtml, kdKolom, kolomHtml, kdKunci, kunciVal);
                            }
                        }
                        return;
                    }

                    // Baris lengkap 8-9 kolom
                    if (tdLen >= 8) {
                        const soalText = $tds.eq(1).text().trim();
                        const soalHtml = removeUrl($tds.eq(1).html());
                        const imgCount = $tds.eq(1).find('img').length;
                        const kdBaris = $tds.eq(3).text().trim().replace(/[\s\u00A0]/g, '');
                        const barisHtml = removeUrl($tds.eq(4).html());
                        const kdKolom = $tds.eq(5).text().trim().replace(/[\s\u00A0]/g, '').toUpperCase();
                        const kolomHtml = removeUrl($tds.eq(6).html());
                        const kdKunci = $tds.eq(7).text().trim().replace(/[\s\u00A0]/g, '');
                        const kunciVal = $tds.eq(8).text().trim().replace(/[\s\u00A0]/g, '').toUpperCase();

                        // Butir soal baru Menjodohkan
                        if (isNumericCol0 && (soalText !== '' || imgCount > 0)) {
                            currentNo = cleanCol0;
                            currentJenis = "3";
                            addJodohkan(currentJenis, currentNo, soalHtml, kdBaris, barisHtml, kdKolom, kolomHtml, kdKunci, kunciVal);
                            return;
                        }

                        // Baris pasangan lanjutan (bisa 1 s/d 15 baris!)
                        if (!isNumericCol0 && currentNo !== "") {
                            if (kdBaris || barisHtml || kdKolom || kolomHtml || kdKunci || kunciVal) {
                                addJodohkan("3", currentNo, '', kdBaris, barisHtml, kdKolom, kolomHtml, kdKunci, kunciVal);
                            }
                            return;
                        }

                        // Baris template kosong
                        if (isNumericCol0 && soalText === '' && imgCount === 0 && !barisHtml) {
                            currentNo = "";
                            return;
                        }
                    }
                    return;
                }

                // --- TABEL NON-MENJODOHKAN (PG, PGK, ISIAN, ESAI) ---
                if (isNumericCol0) {
                    const soalText = tdLen > 1 ? $tds.eq(1).text().trim() : '';
                    const soalHtml = tdLen > 1 ? removeUrl($tds.eq(1).html()) : '';
                    const imgCount = tdLen > 1 ? $tds.eq(1).find('img').length : 0;
                    const col2Text = tdLen > 2 ? $tds.eq(2).text().trim() : '';

                    if (soalText !== '' || imgCount > 0) {
                        currentNo = cleanCol0;
                        currentJenis = detectJenisFromText(col2Text, tableDefaultJenis);

                        if (currentJenis === "1" || currentJenis === "2") {
                            initSoal(currentJenis, currentNo, soalHtml);
                            let opsiHuruf = 'A';
                            let opsiHtml = '';
                            let kunciText = '';
                            if (tdLen >= 6) {
                                opsiHuruf = ($tds.eq(3).text().trim().replace(/[\.\)\s\u00A0]/g, '').toUpperCase()) || 'A';
                                opsiHtml = removeUrl($tds.eq(4).html());
                                kunciText = $tds.eq(5).text().trim();
                            } else if (tdLen === 5) {
                                opsiHuruf = ($tds.eq(2).text().trim().replace(/[\.\)\s\u00A0]/g, '').toUpperCase()) || 'A';
                                opsiHtml = removeUrl($tds.eq(3).html());
                                kunciText = $tds.eq(4).text().trim();
                            }
                            addOpsi(currentJenis, currentNo, opsiHuruf, opsiHtml, kunciText);
                        } else if (currentJenis === "4" || currentJenis === "5") {
                            const kunciVal = tdLen > 3 ? $tds.eq(3).text().trim() : (tdLen > 2 ? $tds.eq(2).text().trim() : '');
                            addIsianEsai(currentJenis, currentNo, soalHtml, kunciVal);
                        }
                    } else {
                        // Empty placeholder question -> RESET currentNo!
                        currentNo = "";
                    }
                    return;
                }

                // Sub-rows PG / PGK
                if (currentNo !== "") {
                    if (currentJenis === "1" || currentJenis === "2") {
                        // Kasus A: 3 atau 4 kolom (rowspan)
                        if (tdLen <= 4 && isOptionCol0) {
                            const opsiHuruf = cleanCol0Upper;
                            const opsiHtml = tdLen > 1 ? removeUrl($tds.eq(1).html()) : '';
                            const kunciText = tdLen > 2 ? $tds.eq(2).text().trim() : '';
                            addOpsi(currentJenis, currentNo, opsiHuruf, opsiHtml, kunciText);
                            return;
                        }
                        // Kasus B: 6 kolom penuh
                        if (tdLen >= 6) {
                            const col3Letter = $tds.eq(3).text().trim().replace(/[\.\)\s\u00A0]/g, '').toUpperCase();
                            if (['A', 'B', 'C', 'D', 'E'].includes(col3Letter)) {
                                const opsiHuruf = col3Letter;
                                const opsiHtml = tdLen > 4 ? removeUrl($tds.eq(4).html()) : '';
                                const kunciText = tdLen > 5 ? $tds.eq(5).text().trim() : '';
                                addOpsi(currentJenis, currentNo, opsiHuruf, opsiHtml, kunciText);
                                return;
                            }
                        }
                        // Kasus C: 5 kolom penuh tanpa jenis [NO, SOAL, OPSI, JAWABAN, KUNCI]
                        if (tdLen === 5) {
                            const col2Letter = $tds.eq(2).text().trim().replace(/[\.\)\s\u00A0]/g, '').toUpperCase();
                            if (['A', 'B', 'C', 'D', 'E'].includes(col2Letter)) {
                                const opsiHuruf = col2Letter;
                                const opsiHtml = removeUrl($tds.eq(3).html());
                                const kunciText = $tds.eq(4).text().trim();
                                addOpsi(currentJenis, currentNo, opsiHuruf, opsiHtml, kunciText);
                                return;
                            }
                        }
                    }
                }
            });
        });

        // Verifikasi kelengkapan kunci pada soal PG/PGK
        for (const j in soalObject) {
            if (j === "1" || j === "2") {
                for (const n in soalObject[j]) {
                    const q = soalObject[j][n];
                    if ((!q.kunci || q.kunci.length === 0) && q.opsi) {
                        const optKeys = Object.keys(q.opsi);
                        if (optKeys.length > 0) {
                            q.kunci = [optKeys[0]]; // Defaultkan ke opsi pertama jika tidak ada tanda centang
                        }
                    }
                }
            }
        }

        // Hitung total butir soal yang berhasil diparsing
        let totalSoalCount = 0;
        for (const j in soalObject) {
            for (const n in soalObject[j]) {
                const item = soalObject[j][n];
                if (item.soal || (item.opsi && Object.keys(item.opsi).length > 0) || (item.baris && Object.keys(item.baris).length > 0) || item.kunci) {
                    totalSoalCount++;
                }
            }
        }

        if (totalSoalCount === 0) {
            swal.fire({
                title: "Peringatan",
                text: "Tidak ada butir soal valid yang dapat dibaca dari file Word. Pastikan file Word telah dimuat dan sesuai format template.",
                icon: "warning"
            });
            return;
        }

        let formData = new FormData($('#grouping')[0]);
        formData.append("id_bank", bank_id);
        formData.append("soal_json", JSON.stringify(soalObject));

        for (const j in soalObject) {
            for (const n in soalObject[j]) {
                const item = soalObject[j][n];
                formData.append(`soal[${j}][${n}][soal]`, encodeURIComponent(item.soal));
                if (item.opsi) {
                    for (const o in item.opsi) {
                        formData.append(`soal[${j}][${n}][opsi][${o}]`, encodeURIComponent(item.opsi[o]));
                    }
                }
                if (item.kunci) {
                    if (Array.isArray(item.kunci)) {
                        item.kunci.forEach(k => {
                            formData.append(`soal[${j}][${n}][kunci][]`, k);
                        });
                    } else if (typeof item.kunci === 'object') {
                        for (const k in item.kunci) {
                            formData.append(`soal[${j}][${n}][kunci][${k}]`, item.kunci[k]);
                        }
                    } else {
                        formData.append(`soal[${j}][${n}][kunci]`, encodeURIComponent(item.kunci));
                    }
                }
                if (item.baris) {
                    for (const b in item.baris) {
                        formData.append(`soal[${j}][${n}][baris][${b}]`, encodeURIComponent(item.baris[b]));
                    }
                }
                if (item.kolom) {
                    for (const c in item.kolom) {
                        formData.append(`soal[${j}][${n}][kolom][${c}]`, encodeURIComponent(item.kolom[c]));
                    }
                }
            }
        }

        setTimeout(function () {
            sendData(formData);
        }, 300);
    }

    function sendData(datapost) {
        swal.fire({
            text: "Sedang mengimpor dan memperbarui bank soal ke database....",
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
                swal.showLoading();
            }
        });
        $.ajax({
            url: base_url + "cbtbanksoal/uploadsoal",
            method: "POST",
            processData: false,
            contentType: false,
            data: datapost,
            success: function (result) {
                console.log("result", result);
                const isSuccess = (result && (result.status === true || (parseInt(result.insert) > 0 && parseInt(result.total) > 0)));
                if (!isSuccess) {
                    swal.fire({
                        title: "Gagal Mengimpor Soal",
                        html: (result.message ? result.message + "<br><br>" : "") +
                              "Total terbaca: <b>" + (result.total || 0) + "</b><br>" +
                              "Total diimpor: <b>" + (result.insert || 0) + "</b><br><br>" +
                              "<small class='text-danger'>Tidak ada soal baru yang disimpan. Soal lama tetap aman dan tidak berubah.</small>",
                        icon: "warning",
                        confirmButtonColor: "#d33"
                    });
                    return;
                }

                let detailInfo = "";
                if (result.details) {
                    detailInfo = `<br><small class="text-muted">Rincian: <b>${result.details}</b></small>`;
                }
                swal.fire({
                    title: "Berhasil Diimpor!",
                    html: "Total isi soal: <b>" + result.total + "</b><br>Total soal diperbarui: <b>" + result.insert + "</b>" + detailInfo + "<br><br><small class='text-success'>Soal baru berhasil diimpor dan langsung disinkronkan ke ujian siswa.</small>",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#3085d6",
                }).then(res => {
                    if (res.value || res.isConfirmed) {
                        window.location.href = base_url + 'cbtbanksoal';
                    }
                });
            }, error: function (xhr, status, error) {
                console.log("error", xhr.responseText);
                var msg = "Gagal mengunggah bank soal.";
                try {
                    const err = JSON.parse(xhr.responseText);
                    msg = err.message || err.Message || (err.messages ? (typeof err.messages === 'string' ? err.messages : JSON.stringify(err.messages)) : msg);
                } catch(e) {
                    if (xhr.statusText) msg = xhr.statusText;
                }
                swal.fire({
                    title: "Error",
                    text: msg,
                    icon: "error"
                });
            }
        });
    }

    function appendFileAndSubmit(id, imageURL, fileName) {
        var datapost = $('#grouping').serialize() + "&src=" + imageURL.replace(/\+/g, "%2B") + "&name=" + fileName;
        $.ajax({
            url: base_url + "cbtbanksoal/uploadsoalimage",
            data: datapost,
            type: "POST",
            error: function (err) {
                console.error(err);
            },
            success: function (data) {
                $(id).attr('src', base_url + data.src);
                //$(id).attr('data-imgsrc', data.src);
                //console.log(data);
            },
            complete: function () {
                //console.log("Request finished.");
            }
        });
    }

    function removeUrl(str) {
        return str.replace(base_url, '');
    }

</script>

<?= $this->endSection() ?>