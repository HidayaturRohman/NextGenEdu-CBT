<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <!-- Header Banner -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body p-4">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3 flex-shrink-0">
                            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 58px; height: 58px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: #ffffff;">
                                <i class="fa fa-sync-alt fa-2x"></i>
                            </div>
                        </div>
                        <div>
                            <h4 class="card-title mb-1 fw-bold text-dark">
                                <?= $judul ?>
                            </h4>
                            <p class="text-muted mb-0" style="font-size: 0.92rem;">
                                Ekstrak gambar <span class="badge bg-secondary-subtle text-secondary font-monospace">Base64</span> yang tersimpan di dalam database menjadi file fisik di folder server demi stabilitas dan kecepatan ujian CBT.
                            </p>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-outline-primary shadow-sm" id="btn-refresh-status" onclick="checkStatusAll()">
                            <i class="fa fa-redo me-1" id="icon-refresh"></i> Cek Ulang Status
                        </button>
                        <button type="button" class="btn btn-success shadow-sm" id="btn-convert-all" onclick="convertAllTables()">
                            <i class="fa fa-play-circle me-1"></i> Convert Semua Tabel
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Summary Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle p-3 bg-primary-subtle text-primary me-3">
                            <i class="fa fa-database fa-2x"></i>
                        </div>
                        <div>
                            <div class="text-muted small fw-semibold">TOTAL BARIS DATA</div>
                            <div class="fs-4 fw-bold text-dark" id="stat-total-rows"><?= number_format($total_rows_all ?? 0, 0, ',', '.') ?></div>
                            <div class="text-muted" style="font-size: 0.8rem;">Tersebar di 4 tabel naskah & hasil</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle p-3 <?= ($total_base64_all > 0) ? 'bg-warning-subtle text-warning' : 'bg-success-subtle text-success' ?> me-3" id="stat-b64-icon-container">
                            <i class="fa <?= ($total_base64_all > 0) ? 'fa-exclamation-triangle' : 'fa-check-circle' ?> fa-2x" id="stat-b64-icon"></i>
                        </div>
                        <div>
                            <div class="text-muted small fw-semibold">STATUS BASE64</div>
                            <div class="fs-4 fw-bold <?= ($total_base64_all > 0) ? 'text-warning-emphasis' : 'text-success' ?>" id="stat-total-base64">
                                <?= $total_base64_all > 0 ? number_format($total_base64_all, 0, ',', '.') . ' baris perlu dikonversi' : 'Bersih (0 Base64)' ?>
                            </div>
                            <div class="text-muted" style="font-size: 0.8rem;" id="stat-b64-desc">
                                <?= $total_base64_all > 0 ? 'Gambar masih tertanam di database' : 'Semua gambar tersimpan sebagai file' ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle p-3 <?= ($is_writable ?? true) ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' ?> me-3">
                            <i class="fa fa-folder-open fa-2x"></i>
                        </div>
                        <div>
                            <div class="text-muted small fw-semibold">FOLDER PENYIMPANAN</div>
                            <div class="fw-bold text-dark font-monospace" style="font-size: 0.95rem;"><?= $upload_dir ?? 'uploads/bank_soal/' ?></div>
                            <div class="text-muted" style="font-size: 0.8rem;">
                                <?= ($is_writable ?? true) ? '<span class="badge bg-success-subtle text-success border border-success-subtle">Folder Siap & Dapat Ditulis</span>' : '<span class="badge bg-danger">Folder Tidak Dapat Ditulis</span>' ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Conversion Table Card -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="fa fa-tasks text-primary me-2 fs-5"></i>
                    <h6 class="mb-0 fw-bold text-dark">Daftar Tabel Naskah & Hasil Ujian</h6>
                </div>
                <div class="text-muted small">
                    Batch: <span class="badge bg-light text-dark border">50 baris / request</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="table-converter">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;" class="text-center">#</th>
                                <th style="min-width: 240px;">Tabel & Deskripsi</th>
                                <th style="width: 140px;" class="text-center">Total Baris</th>
                                <th style="width: 190px;" class="text-center">Status Base64</th>
                                <th style="width: 130px;" class="text-center">Aksi</th>
                                <th style="min-width: 320px;">Progress & Hasil</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($tables as $tblName => $tdata) : 
                                $count = (int) ($tdata['total_rows'] ?? 0);
                                $b64Count = (int) ($tdata['base64_rows'] ?? 0);
                                $label = $tdata['label'] ?? $tblName;
                            ?>
                            <tr id="row_<?= $tblName ?>">
                                <td class="text-center text-muted fw-bold"><?= $no++ ?></td>
                                <td>
                                    <div class="fw-bold font-monospace text-primary" style="font-size: 0.95rem;"><?= $tblName ?></div>
                                    <div class="text-muted small"><?= $label ?></div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border fs-6 px-3 py-2 fw-semibold" id="count_<?= $tblName ?>">
                                        <?= number_format($count, 0, ',', '.') ?>
                                    </span>
                                </td>
                                <td class="text-center" id="status_container_<?= $tblName ?>">
                                    <?php if ($count === 0) : ?>
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-1">
                                            <i class="fa fa-minus-circle me-1"></i> Data Kosong
                                        </span>
                                    <?php elseif ($b64Count > 0) : ?>
                                        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1 fw-bold">
                                            <i class="fa fa-exclamation-triangle me-1"></i> <?= number_format($b64Count, 0, ',', '.') ?> baris Base64
                                        </span>
                                    <?php else : ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                            <i class="fa fa-check-circle me-1"></i> Bersih (0 Base64)
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($count === 0) : ?>
                                        <button class="btn btn-sm btn-secondary opacity-50" disabled style="min-width: 90px;">
                                            Kosong
                                        </button>
                                    <?php else : ?>
                                        <button class="btn btn-sm btn-primary shadow-sm btn-action-convert" id="btn_<?= $tblName ?>" onclick="startConvertSingle('<?= $tblName ?>', <?= $count ?>)" style="min-width: 90px;">
                                            <i class="fa fa-play me-1"></i> Convert
                                        </button>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div id="progress_box_<?= $tblName ?>">
                                        <!-- Progress Bar Container -->
                                        <div class="progress mb-1 d-none" id="pb_wrap_<?= $tblName ?>" style="height: 16px; border-radius: 8px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" id="pb_bar_<?= $tblName ?>" role="progressbar" style="width: 0%; font-size: 0.72rem; font-weight: bold;">
                                                0%
                                            </div>
                                        </div>
                                        <!-- Subtext Status & Log -->
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="text-muted small" id="log_<?= $tblName ?>" style="font-size: 0.83rem;">
                                                <?php if ($count === 0) : ?>
                                                    <span class="text-muted fst-italic">Tidak ada data untuk diproses</span>
                                                <?php elseif ($b64Count > 0) : ?>
                                                    <span class="text-warning-emphasis"><i class="fa fa-info-circle me-1"></i> Siap dikonversi ke file</span>
                                                <?php else : ?>
                                                    <span class="text-muted fst-italic">Tabel dalam kondisi optimal</span>
                                                <?php endif; ?>
                                            </div>
                                            <div id="retry_box_<?= $tblName ?>"></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-light p-3">
                <div class="d-flex align-items-start gap-2 text-muted small">
                    <i class="fa fa-lightbulb text-warning mt-1 fs-6"></i>
                    <div>
                        <strong>Mengapa konversi Base64 sangat penting?</strong>
                        <p class="mb-0 text-secondary" style="font-size: 0.82rem; line-height: 1.45;">
                            Saat guru atau admin mengimpor soal bergambar dari Word/Summernote, gambar kerap tertanam sebagai kode teks Base64 yang sangat panjang di dalam database.
                            Ketika puluhan hingga ratusan siswa membuka ujian secara bersamaan, server dipaksa mengirim megabyte teks Base64 yang dapat menyebabkan <em>database timeout</em>, <em>max_allowed_packet error</em>, dan aplikasi melambat.
                            Fitur ini mengekstrak gambar Base64 menjadi berkas fisik di folder <code class="text-dark">uploads/bank_soal/</code> sehingga browser siswa dapat menyimpan cache gambar secara mandiri dan koneksi ujian menjadi jauh lebih ringan dan stabil.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    const CONVERT_URL = '<?= base_url('dbconvert/convert') ?>';
    const STATUS_URL  = '<?= base_url('dbconvert/status') ?>';
    const CSRF_NAME   = '<?= csrf_token() ?>';
    let   CSRF_HASH   = '<?= csrf_hash() ?>';

    // State konversi
    let isConverting = false;
    let tableCounts = {
        <?php foreach ($tables as $tblName => $tdata) : ?>
        '<?= $tblName ?>': <?= (int) ($tdata['total_rows'] ?? 0) ?>,
        <?php endforeach; ?>
    };

    $(document).ready(function () {
        if (typeof ajaxcsrf === 'function') {
            ajaxcsrf();
        }
    });

    // 1. Cek Ulang Status Semua Tabel via AJAX
    function checkStatusAll() {
        const icon = $('#icon-refresh');
        icon.addClass('fa-spin');
        $('#btn-refresh-status').prop('disabled', true);

        $.ajax({
            url: STATUS_URL,
            type: 'GET',
            dataType: 'json',
            success: function (res) {
                icon.removeClass('fa-spin');
                $('#btn-refresh-status').prop('disabled', false);

                if (res.success && res.tables) {
                    let totalRows = 0;
                    let totalB64  = 0;

                    for (const tbl in res.tables) {
                        const item = res.tables[tbl];
                        tableCounts[tbl] = item.total;
                        totalRows += item.total;
                        totalB64  += item.base64;

                        // Update tampilan badge total baris
                        $(`#count_${tbl}`).text(new Intl.NumberFormat('id-ID').format(item.total));

                        // Update tampilan status Base64
                        const statusContainer = $(`#status_container_${tbl}`);
                        if (item.total === 0) {
                            statusContainer.html(`
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-1">
                                    <i class="fa fa-minus-circle me-1"></i> Data Kosong
                                </span>
                            `);
                        } else if (item.base64 > 0) {
                            statusContainer.html(`
                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1 fw-bold">
                                    <i class="fa fa-exclamation-triangle me-1"></i> ${new Intl.NumberFormat('id-ID').format(item.base64)} baris Base64
                                </span>
                            `);
                        } else {
                            statusContainer.html(`
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                    <i class="fa fa-check-circle me-1"></i> Bersih (0 Base64)
                                </span>
                            `);
                        }
                    }

                    // Update ringkasan atas
                    $('#stat-total-rows').text(new Intl.NumberFormat('id-ID').format(totalRows));
                    if (totalB64 > 0) {
                        $('#stat-total-base64')
                            .removeClass('text-success')
                            .addClass('text-warning-emphasis')
                            .text(`${new Intl.NumberFormat('id-ID').format(totalB64)} baris perlu dikonversi`);
                        $('#stat-b64-desc').text('Gambar masih tertanam di database');
                        $('#stat-b64-icon-container').removeClass('bg-success-subtle text-success').addClass('bg-warning-subtle text-warning');
                        $('#stat-b64-icon').removeClass('fa-check-circle').addClass('fa-exclamation-triangle');
                    } else {
                        $('#stat-total-base64')
                            .removeClass('text-warning-emphasis')
                            .addClass('text-success')
                            .text('Bersih (0 Base64)');
                        $('#stat-b64-desc').text('Semua gambar tersimpan sebagai file');
                        $('#stat-b64-icon-container').removeClass('bg-warning-subtle text-warning').addClass('bg-success-subtle text-success');
                        $('#stat-b64-icon').removeClass('fa-exclamation-triangle').addClass('fa-check-circle');
                    }
                }
            },
            error: function () {
                icon.removeClass('fa-spin');
                $('#btn-refresh-status').prop('disabled', false);
            }
        });
    }

    // 2. Eksekusi Konversi Satu Tabel (dengan promise)
    function runConvertTable(tableName, totalRows) {
        return new Promise((resolve, reject) => {
            const limit = 50;
            const totalPages = Math.ceil(totalRows / limit);
            const pbWrap = $(`#pb_wrap_${tableName}`);
            const pbBar  = $(`#pb_bar_${tableName}`);
            const logBox = $(`#log_${tableName}`);
            const btn    = $(`#btn_${tableName}`);
            const retryBox = $(`#retry_box_${tableName}`);

            retryBox.empty();

            if (totalRows <= 0) {
                pbWrap.addClass('d-none');
                logBox.html('<span class="text-muted fst-italic">Data kosong, dilewati.</span>');
                resolve({ converted: 0, updated: 0 });
                return;
            }

            pbWrap.removeClass('d-none');
            pbBar.removeClass('bg-success bg-danger').addClass('bg-primary progress-bar-animated');
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Proses');

            let page = 1;
            let totalImages = 0;
            let totalUpdated = 0;

            function sendPage() {
                if (page > totalPages) {
                    // Selesai seluruh halaman
                    pbBar.css('width', '100%').text('100%').removeClass('bg-primary progress-bar-animated').addClass('bg-success');
                    btn.prop('disabled', false).html('<i class="fa fa-check me-1"></i> Selesai');

                    let summaryText = `<span class="text-success fw-bold"><i class="fa fa-check-circle me-1"></i> Selesai!</span> `;
                    if (totalImages > 0 || totalUpdated > 0) {
                        summaryText += `<span class="badge bg-success-subtle text-success">${totalImages} gambar diekstrak</span> <span class="badge bg-info-subtle text-info">${totalUpdated} baris diupdate</span>`;
                    } else {
                        summaryText += `<span class="text-muted">Tidak ditemukan Base64 baru (sudah optimal).</span>`;
                    }
                    logBox.html(summaryText);

                    // Update status badge menjadi bersih
                    $(`#status_container_${tableName}`).html(`
                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                            <i class="fa fa-check-circle me-1"></i> Bersih (0 Base64)
                        </span>
                    `);

                    resolve({ converted: totalImages, updated: totalUpdated });
                    return;
                }

                const offset = (page - 1) * limit;
                const currentPercent = Math.min(100, Math.round(((page - 1) / totalPages) * 100));
                pbBar.css('width', currentPercent + '%').text(currentPercent + '%');

                const endRow = Math.min(totalRows, offset + limit);
                logBox.html(`<span class="text-primary"><i class="fa fa-spinner fa-spin me-1"></i> Memproses baris ${offset + 1} - ${endRow} (${page}/${totalPages})...</span>`);

                let formData = new FormData();
                formData.append('table', tableName);
                formData.append('limit', limit);
                formData.append('offset', offset);
                if (CSRF_NAME && CSRF_HASH) {
                    formData.append(CSRF_NAME, CSRF_HASH);
                }

                $.ajax({
                    url: CONVERT_URL,
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data: formData,
                    dataType: 'json',
                    success: function (res) {
                        if (res.csrf_token) {
                            CSRF_HASH = res.csrf_token;
                        }

                        if (res.success) {
                            totalImages += (res.converted_images || 0);
                            totalUpdated += (res.updated_rows || 0);
                            page++;
                            setTimeout(sendPage, 120); // Jeda aman 120ms
                        } else {
                            handleError(res.message || 'Gagal memproses batch.');
                        }
                    },
                    error: function (xhr, status, error) {
                        handleError(`Error server (${xhr.status}): ${error || 'Koneksi terputus'}`);
                    }
                });

                function handleError(msg) {
                    pbBar.removeClass('bg-primary progress-bar-animated').addClass('bg-danger');
                    btn.prop('disabled', false).html('<i class="fa fa-redo me-1"></i> Convert');
                    logBox.html(`<span class="text-danger fw-semibold"><i class="fa fa-exclamation-circle me-1"></i> Terhenti di hal ${page}: ${msg}</span>`);
                    retryBox.html(`
                        <button class="btn btn-xs btn-outline-danger shadow-sm ms-2" onclick="startConvertSingle('${tableName}', ${totalRows})" title="Ulangi dari awal">
                            <i class="fa fa-redo"></i> Ulangi
                        </button>
                    `);
                    reject(new Error(msg));
                }
            }

            sendPage();
        });
    }

    // 3. Tombol Convert Tunggal
    function startConvertSingle(tableName, totalRows) {
        if (isConverting) {
            Swal.fire({
                icon: 'warning',
                title: 'Proses Sedang Berjalan',
                text: 'Harap tunggu proses konversi yang sedang berjalan hingga selesai.'
            });
            return;
        }

        isConverting = true;
        $('.btn-action-convert, #btn-convert-all, #btn-refresh-status').prop('disabled', true);

        runConvertTable(tableName, totalRows)
            .then(res => {
                isConverting = false;
                $('.btn-action-convert, #btn-convert-all, #btn-refresh-status').prop('disabled', false);
                checkStatusAll();
                Swal.fire({
                    icon: 'success',
                    title: 'Konversi Selesai',
                    text: `Tabel ${tableName} selesai diproses. ${res.converted} gambar Base64 diekstrak menjadi file.`,
                    timer: 3000,
                    showConfirmButton: false
                });
            })
            .catch(err => {
                isConverting = false;
                $('.btn-action-convert, #btn-convert-all, #btn-refresh-status').prop('disabled', false);
            });
    }

    // 4. Tombol Convert Semua Tabel Sekaligus
    async function convertAllTables() {
        if (isConverting) {
            Swal.fire({
                icon: 'warning',
                title: 'Proses Sedang Berjalan',
                text: 'Harap tunggu proses konversi yang sedang berlangsung.'
            });
            return;
        }

        const tablesToRun = [];
        for (const tbl in tableCounts) {
            if (tableCounts[tbl] > 0) {
                tablesToRun.push({ name: tbl, count: tableCounts[tbl] });
            }
        }

        if (tablesToRun.length === 0) {
            Swal.fire({
                icon: 'info',
                title: 'Tidak Ada Data',
                text: 'Semua tabel kosong atau tidak memiliki baris untuk dikonversi.'
            });
            return;
        }

        const confirmResult = await Swal.fire({
            title: 'Konversi Semua Tabel?',
            text: `Sistem akan memproses ${tablesToRun.length} tabel secara berurutan. Gambar Base64 akan diekstrak ke folder uploads/bank_soal/.`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2563eb',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Jalankan Sekarang!',
            cancelButtonText: 'Batal'
        });

        if (!confirmResult.isConfirmed) return;

        isConverting = true;
        $('.btn-action-convert, #btn-convert-all, #btn-refresh-status').prop('disabled', true);
        $('#btn-convert-all').html('<i class="fa fa-spinner fa-spin me-1"></i> Memproses Semua...');

        let grandConverted = 0;
        let grandUpdated = 0;
        let hasError = false;

        for (const t of tablesToRun) {
            try {
                const res = await runConvertTable(t.name, t.count);
                grandConverted += (res.converted || 0);
                grandUpdated   += (res.updated || 0);
            } catch (e) {
                console.error(`Gagal pada tabel ${t.name}:`, e);
                hasError = true;
                break;
            }
        }

        isConverting = false;
        $('.btn-action-convert, #btn-convert-all, #btn-refresh-status').prop('disabled', false);
        $('#btn-convert-all').html('<i class="fa fa-play-circle me-1"></i> Convert Semua Tabel');

        checkStatusAll();

        if (hasError) {
            Swal.fire({
                icon: 'error',
                title: 'Konversi Terhenti',
                text: 'Terjadi kendala pada salah satu tabel. Silakan periksa log progress tabel terkait.'
            });
        } else {
            Swal.fire({
                icon: 'success',
                title: 'Semua Tabel Selesai!',
                html: `Seluruh naskah & hasil ujian telah berhasil diperiksa dan dikonversi.<br><br>
                       <strong>${grandConverted}</strong> gambar Base64 diekstrak ke file.<br>
                       <strong>${grandUpdated}</strong> baris database diperbarui.`,
                confirmButtonColor: '#2563eb'
            });
        }
    }
</script>
<?= $this->endSection() ?>
