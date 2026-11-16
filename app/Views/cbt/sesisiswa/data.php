<?= $this->extend('layout/dashboard_template_bs5') ?>

<?= $this->section('content') ?>
<?php
$jenjang = isset($setting->jenjang) ? $setting->jenjang : 1;
$kelass = ['0' => 'Pilih kelas'] + $kelas;
$ruangs = ['0' => 'Pilih ruang'] + $ruang;
$sesis = ['0' => 'Pilih sesi'] + $sesi;

$countTerplot = 0;
$countBelumTerplot = 0;
if (count($siswas) > 0) {
    foreach ($siswas as $s) {
        $r = isset($s->id_ruang) && $s->id_ruang != null && $s->id_ruang != '0';
        $se = isset($s->id_sesi) && $s->id_sesi != null && $s->id_sesi != '0';
        if ($r && $se) {
            $countTerplot++;
        } else {
            $countBelumTerplot++;
        }
    }
}
?>

<style>
    .elearning-kpi-card {
        border: 1px solid rgba(16, 185, 129, 0.14);
        border-radius: 14px;
        background: #ffffff;
        transition: all 0.2s ease;
    }
    .elearning-kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
    }
    .sesisiswa-filter-container {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px;
    }
    .select2-container--default .select2-selection--single {
        height: 42px !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        display: flex !important;
        align-items: center !important;
        padding-left: 8px !important;
        background-color: #ffffff !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 40px !important;
        color: #1e293b !important;
        font-size: 0.9rem !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px !important;
        right: 8px !important;
    }
    .input-group:focus-within .input-group-text {
        border-color: #10b981 !important;
        color: #10b981 !important;
    }
    #searchSiswaSesiInput:focus {
        border-color: #10b981 !important;
        box-shadow: none !important;
    }

    /* Harmonious Modern Table Styling (Matching Materi) */
    .table-modern {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 10px !important;
        overflow: hidden !important;
    }
    .table-modern thead th {
        background: #f8fafc !important;
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700 !important;
        font-size: 0.82rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        padding: 12px 14px !important;
        border-bottom: 2px solid #e2e8f0 !important;
        border-top: none !important;
        vertical-align: middle !important;
    }
    .table-modern tbody td {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
        font-size: 0.88rem !important;
        color: #1e293b !important;
        padding: 11px 14px !important;
        vertical-align: middle !important;
        border-bottom: 1px solid #f1f5f9 !important;
    }
    .table-modern tbody tr:hover {
        background-color: #f8fafc !important;
    }
    .badge-kelas {
        display: inline-block;
        padding: 4px 10px;
        font-size: 0.82rem;
        font-weight: 700;
        color: #0f172a !important;
        background-color: #e2e8f0 !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 6px !important;
        letter-spacing: 0.3px;
    }
</style>

<div class="d-contents">
    <!-- Header Banner -->
    <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between gap-3 w-100 flex-wrap">
                <div class="d-flex align-items-center min-w-0 me-3">
                    <div class="me-3 flex-shrink-0">
                        <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px; background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%); color: #ffffff;">
                            <i class="fas fa-user-clock fa-lg"></i>
                        </div>
                    </div>
                    <div>
                        <h4 class="card-title mb-1 fw-bold text-dark">
                            <?= esc($judul) ?>
                        </h4>
                        <p class="text-muted mb-0 small" style="font-size: 0.88rem;">
                            Pemetaan dan penempatan lokasi ruang serta jadwal sesi ujian bagi seluruh peserta didik.
                        </p>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="<?= base_url('cbtsesisiswa?kls=' . $kelas_selected) ?>" class="btn btn-sm btn-outline-secondary fw-semibold rounded-pill px-3 py-2 shadow-sm">
                        <i class="fa fa-sync me-1"></i> Reload
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- KPI Ringkasan -->
    <div class="row g-3 mb-3">
        <div class="col-6 col-md-3">
            <div class="card kpi-pastel-card kpi-pastel-blue border-0 shadow-sm h-100">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="kpi-pastel-icon me-3">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="kpi-pastel-title small">Total Kelas Ujian</div>
                        <div class="fs-4 fw-bold kpi-pastel-value mt-1"><?= count($kelas) ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card kpi-pastel-card kpi-pastel-purple border-0 shadow-sm h-100">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="kpi-pastel-icon me-3">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="kpi-pastel-title small">Siswa di Kelas Ini</div>
                        <div class="fs-4 fw-bold kpi-pastel-value mt-1" id="kpi-total-siswa"><?= count($siswas) ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card kpi-pastel-card kpi-pastel-green border-0 shadow-sm h-100">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="kpi-pastel-icon me-3">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="kpi-pastel-title small">Sudah Terplot Lengkap</div>
                        <div class="fs-4 fw-bold kpi-pastel-value mt-1" id="kpi-sudah-plot"><?= $countTerplot ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card kpi-pastel-card kpi-pastel-amber border-0 shadow-sm h-100">
                <div class="card-body p-3 d-flex align-items-center">
                    <div class="kpi-pastel-icon me-3">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="kpi-pastel-title small">Belum Terplot Lengkap</div>
                        <div class="fs-4 fw-bold kpi-pastel-value mt-1" id="kpi-belum-plot"><?= $countBelumTerplot ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Guidance Banner (Hijau Emerald Persis Materi) -->
    <div class="d-flex flex-wrap align-items-center justify-content-between p-3 rounded-3 mb-3 gap-3 shadow-sm text-white" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%); border: 1px solid #047857;">
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle d-flex align-items-center justify-content-center bg-white bg-opacity-25 flex-shrink-0" style="width: 44px; height: 44px;">
                <i class="fas fa-user-clock fa-lg text-white"></i>
            </div>
            <div>
                <h6 class="fw-bold mb-1 text-white" style="font-size: 0.95rem; letter-spacing: -0.2px;">Panduan Penataan Ruang &amp; Sesi Ujian</h6>
                <div class="small" style="color: rgba(255, 255, 255, 0.95); font-size: 0.83rem; line-height: 1.45;">
                    Pastikan mengatur <b>Ruang</b> dan <b>Sesi</b> sebelum konfigurasi <b>Alokasi Waktu dan Pengawas</b>. Gunakan fitur <b>Terapkan Serentak</b> untuk mengisi seluruh siswa di kelas sekaligus, atau sesuaikan per individu pada tabel.
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="card mb-4 shadow-sm border-0" style="border-radius: 14px;">
        <div class="card-header bg-white py-3 d-flex flex-wrap align-items-center justify-content-between gap-2" style="border-radius: 14px 14px 0 0; border-bottom: 1px solid #f1f5f9;">
            <div class="d-flex align-items-center gap-2">
                <h6 class="card-title mb-0 fw-bold text-dark">
                    <i class="fas fa-list-ol text-success me-2"></i>Daftar Siswa, Ruang &amp; Sesi Ujian
                </h6>
            </div>
        </div>

        <div class="card-body">
            <!-- Filter Bar -->
            <div class="sesisiswa-filter-container mb-3">
                <div class="row g-3 align-items-center">
                    <div class="col-lg-4 col-md-5 col-12">
                        <label class="form-label fw-bold small text-dark mb-1 d-flex align-items-center">
                            <i class="fas fa-chalkboard-teacher text-success me-2"></i>Pilih Kelas Ujian
                        </label>
                        <div>
                            <?php
                            echo form_dropdown(
                                'kelas',
                                $kelass,
                                $kelas_selected,
                                'id="dropdown-kelas" class="select2 form-control"'
                            ); ?>
                        </div>
                    </div>

                    <?php if (count($siswas) > 0) : ?>
                        <div class="col-lg-8 col-md-7 col-12">
                            <label class="form-label fw-bold small text-dark mb-1 d-flex align-items-center">
                                <i class="fas fa-magic text-primary me-2"></i>Terapkan Serentak ke Semua Siswa <?= esc($kelass[$kelas_selected] ?? '') ?>:
                            </label>
                            <div class="row g-2 align-items-center">
                                <div class="col-12 col-sm-5">
                                    <?php
                                    echo form_dropdown(
                                        'g-ruang',
                                        $ruangs,
                                        null,
                                        'id="g-ruang" class="form-select shadow-sm" style="height: 42px; border-radius: 8px;"'
                                    ); ?>
                                </div>
                                <div class="col-12 col-sm-5">
                                    <?php
                                    echo form_dropdown(
                                        'g-sesi',
                                        $sesis,
                                        null,
                                        'id="g-sesi" class="form-select shadow-sm" style="height: 42px; border-radius: 8px;"'
                                    ); ?>
                                </div>
                                <div class="col-12 col-sm-2 text-end">
                                    <button type="button" id="undo" class="btn btn-outline-danger shadow-sm w-100 d-inline-flex align-items-center justify-content-center" style="height: 42px; border-radius: 8px;" title="Reset / Kembalikan Pengaturan">
                                        <i class="fas fa-undo-alt me-1"></i><span>Reset</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (count($siswas) > 0) : ?>
                <?= form_open('cbtsesisiswa/editsesisiswa', ['id' => 'editsesisiswa']) ?>
                <!-- Toolbar Pencarian & Simpan -->
                <div class="row g-3 align-items-center mb-3">
                    <div class="col-md-7 col-12">
                        <div class="input-group flex-nowrap" style="height: 42px;">
                            <span class="input-group-text bg-white border-end-0 text-muted px-3" style="border-color: #cbd5e1; border-top-left-radius: 8px; border-bottom-left-radius: 8px;">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" id="searchSiswaSesiInput" class="form-control border-start-0 ps-1" style="height: 42px; border-color: #cbd5e1; border-top-right-radius: 8px; border-bottom-right-radius: 8px; font-size: 0.9rem;" placeholder="Cari nama siswa atau kelas...">
                            <button class="btn btn-outline-secondary border border-start-0 px-3" type="button" id="clearSearchSiswaSesi" style="border-color: #cbd5e1 !important; display: none;" title="Reset Pencarian">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-5 col-12 text-md-end text-start">
                        <button type="submit" class="btn btn-success fw-bold px-4 py-2 rounded-3 shadow-sm" style="height: 42px;">
                            <i class="fas fa-save me-1.5"></i>Simpan Perubahan Ruang &amp; Sesi
                        </button>
                    </div>
                </div>

                <!-- Table Siswa -->
                <div class="table-responsive" id="list-siswa">
                    <table id="sesi-siswa" class="table table-bordered table-hover align-middle mb-0 table-modern">
                        <thead class="table-light">
                            <tr>
                                <th height="45" width="50" class="align-middle text-center">NO.</th>
                                <th class="align-middle" style="min-width: 250px;">NAMA SISWA</th>
                                <th class="align-middle text-center" width="120">KELAS</th>
                                <th class="align-middle text-center" width="220">LOKASI RUANG</th>
                                <th class="align-middle text-center" width="220">JADWAL SESI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $num = 1;
                            foreach ($siswas as $siswa) :
                                $ruangId = isset($siswa->id_ruang) && $siswa->id_ruang != null ? $siswa->id_ruang : '0';
                                $sesiId = isset($siswa->id_sesi) && $siswa->id_sesi != null ? $siswa->id_sesi : '0';
                                $searchKeywords = strtolower(($siswa->nama ?? '') . ' ' . ($siswa->nama_kelas ?? ''));
                                ?>
                                <tr class="siswa-sesi-row" data-search="<?= esc($searchKeywords) ?>">
                                    <td class="align-middle text-center fw-semibold text-muted"><?= $num ?></td>
                                    <td class="align-middle">
                                        <div class="fw-bold text-dark" style="font-size: 0.9rem;"><?= esc($siswa->nama) ?></div>
                                        <div class="text-muted mt-0.5" style="font-size: 0.78rem;">Username: <?= esc($siswa->username ?? '-') ?> &bull; NIS: <?= esc($siswa->nis ?? '-') ?></div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="badge-kelas"><?= esc($siswa->nama_kelas) ?></span>
                                    </td>
                                    <td class="align-middle" data-name="input-ruang">
                                        <?php
                                        echo form_dropdown(
                                            'ruang-sesi[' . $siswa->id_siswa . '][' . $kelas_selected . '][ruang]',
                                            $ruangs,
                                            $ruangId,
                                            'data-ruangid="' . $siswa->id_siswa . '" class="ruangsiswa form-select form-select-sm fw-semibold" style="height: 38px; border-radius: 6px; font-family: \'Inter\', sans-serif !important; font-size: 0.85rem; border-color: #cbd5e1;"'
                                        ); ?>
                                    </td>
                                    <td class="align-middle" data-name="input-sesi">
                                        <?php
                                        echo form_dropdown(
                                            'ruang-sesi[' . $siswa->id_siswa . '][' . $kelas_selected . '][sesi]',
                                            $sesis,
                                            $sesiId,
                                            'data-sesiid="' . $siswa->id_siswa . '" class="sesisiswa form-select form-select-sm fw-semibold" style="height: 38px; border-radius: 6px; font-family: \'Inter\', sans-serif !important; font-size: 0.85rem; border-color: #cbd5e1;"'
                                        ); ?>
                                    </td>
                                </tr>
                                <?php $num++; endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-success fw-bold px-4 py-2 rounded-3 shadow-sm">
                        <i class="fas fa-save me-1.5"></i>Simpan Perubahan Ruang &amp; Sesi
                    </button>
                </div>
                <?= form_close() ?>

            <?php else: ?>
                <!-- Empty State -->
                <div class="text-center py-5 px-3">
                    <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-user-clock fa-3x text-secondary opacity-50"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-1"><?= $kelas_selected == '0' ? 'Belum Ada Kelas yang Dipilih' : 'Tidak Ada Siswa di Kelas Ini' ?></h5>
                    <p class="text-muted small mx-auto mb-0" style="max-width: 450px;">
                        <?= $kelas_selected == '0' ? 'Silakan pilih kelas ujian pada dropdown di atas untuk memuat daftar siswa dan mengatur ruang serta sesi.' : 'Tidak ditemukan data siswa aktif untuk kelas yang dipilih.' ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Overlay Loading Centered -->
<div class="overlay d-none d-flex align-items-center justify-content-center" id="loading" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.45); z-index: 9999; backdrop-filter: blur(2px);">
    <div class="bg-white p-4 rounded-4 shadow-lg text-center" style="min-width: 200px;">
        <div class="spinner-border text-success mb-3" style="width: 3rem; height: 3rem;" role="status"></div>
        <div class="fw-bold text-dark">Memproses Data...</div>
        <small class="text-muted">Mohon tunggu sebentar</small>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    let tp_id = '<?= isset($tp_active->id_tp) ? $tp_active->id_tp : '' ?>';
    let smt_id = '<?= isset($smt_active->id_smt) ? $smt_active->id_smt : '' ?>';
    var kelas_id = '<?=$kelas_selected?>';
    var jsonRuang = [];
    var jsonSesi = [];

    function recalculateSesiRuangStats() {
        let terplot = 0;
        const total = $('.ruangsiswa').length;
        if (total === 0) return;
        $('.ruangsiswa').each(function () {
            const rVal = $(this).val();
            const sId = $(this).data('ruangid');
            const sVal = $('.sesisiswa[data-sesiid="' + sId + '"]').val();
            if (rVal && rVal !== '0' && sVal && sVal !== '0') {
                terplot++;
            }
        });
        $('#kpi-sudah-plot').text(terplot);
        $('#kpi-belum-plot').text(total - terplot);
    }

    $(document).ready(function () {
        if (typeof ajaxcsrf === 'function') ajaxcsrf();
        
        var opsiKelas = $('#dropdown-kelas');
        var opsiGruang = $('#g-ruang');
        var opsiGsesi = $('#g-sesi');

        if (opsiKelas.length > 0) {
            opsiKelas.select2({width: '100%'});
        }
        
        opsiKelas.on('change', function (e) {
            var id = $(this).val();
            if (id != kelas_id) {
                $('#loading').removeClass('d-none');
                window.location.href = base_url + 'cbtsesisiswa?kls=' + id;
            }
        });

        // Instant search siswa
        $('#searchSiswaSesiInput').on('input', function () {
            const q = $(this).val().toLowerCase().trim();
            if (q) {
                $('#clearSearchSiswaSesi').show();
            } else {
                $('#clearSearchSiswaSesi').hide();
            }
            if (!q) {
                $('.siswa-sesi-row').show();
                return;
            }
            $('.siswa-sesi-row').each(function () {
                const text = ($(this).data('search') || '') + ' ' + $(this).text().toLowerCase();
                $(this).toggle(text.indexOf(q) !== -1);
            });
        });

        $('#clearSearchSiswaSesi').on('click', function () {
            $('#searchSiswaSesiInput').val('').trigger('input').focus();
        });

        let isResetting = false;

        if (opsiGruang.length > 0) {
            opsiGruang.on('change', function () {
                if (isResetting) return;
                var val = $(this).val();
                const $ruangSelect = $('.ruangsiswa');
                if (jsonRuang.length === 0) {
                    $ruangSelect.each((i, row) => {
                        jsonRuang.push({
                            id: $(row).data('ruangid'),
                            val: $(row).val()
                        });
                    });
                }
                $ruangSelect.val(val);
                recalculateSesiRuangStats();
            });
        }

        if (opsiGsesi.length > 0) {
            opsiGsesi.on('change', function () {
                if (isResetting) return;
                var val = $(this).val();
                const $sesiSelect = $('.sesisiswa');
                if (jsonSesi.length === 0) {
                    $sesiSelect.each((i, row) => {
                        jsonSesi.push({
                            id: $(row).data('sesiid'),
                            val: $(row).val()
                        });
                    });
                }
                $sesiSelect.val(val);
                recalculateSesiRuangStats();
            });
        }

        $('.ruangsiswa, .sesisiswa').on('change', function () {
            recalculateSesiRuangStats();
        });

        function doUndoLocal() {
            if (jsonRuang.length > 0) {
                $.each(jsonRuang, function (i, v) {
                    $('select[data-ruangid="' + v.id + '"]').val(v.val);
                });
            }

            if (jsonSesi.length > 0) {
                $.each(jsonSesi, function (i, v) {
                    $('select[data-sesiid="' + v.id + '"]').val(v.val);
                });
            }

            isResetting = true;
            if (opsiGruang.length > 0) {
                opsiGruang.val('0');
            }
            if (opsiGsesi.length > 0) {
                opsiGsesi.val('0');
            }
            jsonRuang = [];
            jsonSesi = [];
            isResetting = false;
            recalculateSesiRuangStats();

            if (typeof showSuccessToast === 'function') {
                showSuccessToast('Pengaturan lokal dikembalikan.');
            }
        }

        function doResetDatabase() {
            $('#loading').removeClass('d-none');
            let postData = {
                kelas: kelas_id
            };
            let csrfName = '<?= csrf_token() ?>';
            let csrfHash = $('input[name="' + csrfName + '"]').val();
            if (csrfName && csrfHash) {
                postData[csrfName] = csrfHash;
            }

            $.ajax({
                url: base_url + 'cbtsesisiswa/resetsesisiswa',
                type: 'POST',
                data: postData,
                dataType: 'JSON',
                success: function (res) {
                    $('#loading').addClass('d-none');
                    if (res && res.status) {
                        swal.fire({
                            title: 'Berhasil!',
                            text: 'Pengaturan ruang dan sesi kelas berhasil direset.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                        setTimeout(function () {
                            window.location.reload();
                        }, 1200);
                    } else {
                        swal.fire({
                            title: 'Gagal',
                            text: (res && res.message) ? res.message : 'Gagal mereset data.',
                            icon: 'error'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    $('#loading').addClass('d-none');
                    console.error('Reset error:', xhr);
                    swal.fire({
                        title: 'Terjadi Kesalahan',
                        text: 'Gagal memproses reset di server.',
                        icon: 'error'
                    });
                }
            });
        }

        $('#undo').on('click', function (e) {
            e.preventDefault();
            var namaKelas = opsiKelas.find('option:selected').text().trim();

            if (jsonRuang.length > 0 || jsonSesi.length > 0) {
                swal.fire({
                    title: 'Pilihan Reset',
                    html: 'Pilih tindakan untuk ruang dan sesi kelas <b>' + namaKelas + '</b>:',
                    icon: 'question',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    denyButtonColor: '#3085d6',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Kosongkan Semua (Reset DB)',
                    denyButtonText: 'Batal Gabung (Undo)',
                    cancelButtonText: 'Tutup'
                }).then((result) => {
                    if (result.isConfirmed) {
                        doResetDatabase();
                    } else if (result.isDenied) {
                        doUndoLocal();
                    }
                });
            } else {
                swal.fire({
                    title: 'Reset Ruang dan Sesi?',
                    html: 'Pengaturan ruang dan sesi untuk seluruh siswa di kelas <b>' + namaKelas + '</b> akan dikosongkan.<br><small class="text-danger">Alokasi ruang dan sesi kelas ini akan dihapus dari database.</small>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Reset Sekarang!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed || result.value) {
                        doResetDatabase();
                    }
                });
            }
        });

        $("#editsesisiswa").on("submit", function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $('#loading').removeClass('d-none');
            let formData = new FormData($(this)[0]);
            formData.append('kelas', opsiKelas.val());

            $.ajax({
                url: base_url + 'cbtsesisiswa/editsesisiswa',
                method: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                success: function (data) {
                    $('#loading').addClass('d-none');
                    if (data.status) {
                        swal.fire({
                            title: 'Sukses!',
                            text: 'Pengaturan ruang dan sesi berhasil disimpan.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(function(){ window.location.reload(); }, 1200);
                    } else {
                        swal.fire({
                            title: 'Gagal',
                            text: data.message || 'Gagal menyimpan data.',
                            icon: 'error'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    $('#loading').addClass('d-none');
                    swal.fire({
                        title: 'Error',
                        text: 'Terjadi kesalahan sistem saat menyimpan.',
                        icon: 'error'
                    });
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>
