<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

<div class="d-contents">
    <!-- Header Page -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="me-3 flex-shrink-0">
                        <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: #ffffff;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="card-title mb-1 fw-bold d-flex align-items-center text-dark">
                            Kelola & Revisi Mapel Rapor
                        </h4>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">
                            Sesuaikan mata pelajaran yang tampil di lembar rapor STS dan SAS/SAT agar otomatis sesuai dengan mapel yang diujikan & diajarkan di kelas.
                        </p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="<?= base_url('rapor') ?>" class="btn btn-outline-secondary rounded-pill shadow-sm">
                        <i class="fas fa-arrow-left me-1"></i> Pengaturan Rapor
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Panel Kontrol & Aksi Cepat -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h6 class="card-title mb-0 fw-bold text-dark d-flex align-items-center">
                <i class="fas fa-sliders-h text-primary me-2"></i> Pengaturan Penampilan Mapel Rapor
            </h6>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2 rounded-pill">
                    Semester <?= esc($smt_active->nama_smt ?? 'Ganjil') ?> TP <?= esc($tp_active->tahun ?? '') ?>
                </span>
            </div>
        </div>
        <div class="card-body p-4">
            <?= form_open('', ['id' => 'form-mapel-rapor']) ?>
            
            <div class="row g-3 mb-4">
                <div class="col-md-7">
                    <label class="form-label fw-bold text-dark mb-2">Mode Penentuan Mapel Rapor:</label>
                    <div class="row g-2">
                        <div class="col-sm-6">
                            <label class="card h-100 p-3 border rounded-3 mode-box <?= ($mode_mapel ?? 'otomatis') === 'otomatis' ? 'border-primary bg-primary bg-opacity-10 shadow-sm' : 'bg-light' ?>" style="cursor: pointer;">
                                <div class="d-flex align-items-start">
                                    <input type="radio" name="mode" value="otomatis" class="form-check-input me-2 mt-1" <?= ($mode_mapel ?? 'otomatis') === 'otomatis' ? 'checked' : '' ?>>
                                    <div>
                                        <b class="text-dark d-block">Otomatis Sesuai Ujian</b>
                                        <small class="text-muted" style="font-size: 0.8rem;">Deteksi otomatis mapel ujian CBT, ditambah mapel manual yang Anda centang di bawah.</small>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="col-sm-6">
                            <label class="card h-100 p-3 border rounded-3 mode-box <?= ($mode_mapel ?? '') === 'kustom' ? 'border-primary bg-primary bg-opacity-10 shadow-sm' : 'bg-light' ?>" style="cursor: pointer;">
                                <div class="d-flex align-items-start">
                                    <input type="radio" name="mode" value="kustom" class="form-check-input me-2 mt-1" <?= ($mode_mapel ?? '') === 'kustom' ? 'checked' : '' ?>>
                                    <div>
                                        <b class="text-dark d-block">Kustom Pilihan Admin</b>
                                        <small class="text-muted" style="font-size: 0.8rem;">Mengikuti checklist mapel yang Anda centang pada tabel di bawah ini (termasuk mapel manual/kertas).</small>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <label class="form-label fw-bold text-dark mb-2">Aksi Cepat & Sinkronisasi:</label>
                    <div class="d-flex flex-column gap-2">
                        <button type="button" class="btn btn-outline-success btn-sm rounded-pill text-start px-3 py-2" id="btn-sync-ujian">
                            <i class="fas fa-magic me-2 text-success"></i> <b>Sesuaikan Otomatis dengan Mapel yang Diujikan</b>
                            <div class="small text-muted ps-4" style="font-size: 0.76rem;">Deteksi otomatis dari jadwal CBT, bank soal & guru pengampu semester ini.</div>
                        </button>
                        <button type="button" class="btn btn-outline-primary btn-sm rounded-pill text-start px-3 py-2" id="btn-reset-mts">
                            <i class="fas fa-university me-2 text-primary"></i> <b>Terapkan Standar MTs Kemenag</b>
                            <div class="small text-muted ps-4" style="font-size: 0.76rem;">Aktifkan 15 mapel standar MTs & nonaktifkan mapel tingkat SMA/MA.</div>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tabel Daftar Mapel -->
            <div class="card border rounded-3 overflow-hidden">
                <div class="card-header bg-light py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <b class="text-dark"><i class="fas fa-list me-1 text-primary"></i> Daftar Mata Pelajaran Rapor</b>
                        <span class="badge bg-secondary rounded-pill" id="count-selected">0 Mapel Dipilih</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" id="btn-select-all">Pilih Semua</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" id="btn-deselect-all">Batal Semua</button>
                        <input type="text" id="search-mapel" class="form-control form-control-sm" placeholder="Cari nama / kode mapel..." style="max-width: 220px;">
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle mb-0" id="table-mapel-rapor">
                            <thead class="table-light">
                                <tr class="text-secondary small fw-bold">
                                    <th class="text-center" style="width: 45px;">No</th>
                                    <th class="text-center" style="width: 70px;">Tampil di Rapor</th>
                                    <th style="min-width: 140px;">Status di CBT</th>
                                    <th style="width: 80px;" class="text-center">Urutan</th>
                                    <th style="width: 90px;">Kode</th>
                                    <th style="min-width: 200px;">Nama Asli di Master</th>
                                    <th style="min-width: 240px;">Revisi Nama Tampil di Rapor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($mapel_list)): ?>
                                    <?php foreach ($mapel_list as $idx => $m): ?>
                                        <tr class="mapel-row <?= $m->is_active_rapor ? 'table-active-row' : '' ?>">
                                            <td class="text-center fw-bold text-secondary"><?= $idx + 1 ?></td>
                                            <td class="text-center">
                                                <div class="form-check form-switch d-inline-block">
                                                    <input class="form-check-input chk-mapel" type="checkbox" name="active_mapels[]" value="<?= $m->id_mapel ?>" <?= $m->is_active_rapor ? 'checked' : '' ?> style="cursor: pointer; transform: scale(1.2);">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-1">
                                                    <?php if ($m->is_diujikan): ?>
                                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25" title="Ada jadwal ujian / bank soal aktif di CBT">
                                                            <i class="fas fa-check-circle me-1"></i> Diujikan CBT
                                                        </span>
                                                    <?php endif; ?>
                                                    <?php if ($m->is_diajarkan): ?>
                                                        <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25" title="Ada guru yang mengajar mapel ini">
                                                            <i class="fas fa-chalkboard-teacher me-1"></i> Pengampu
                                                        </span>
                                                    <?php endif; ?>
                                                    <?php if ($m->has_nilai): ?>
                                                        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25" title="Ada nilai siswa yang tersimpan di rapor">
                                                            <i class="fas fa-star me-1"></i> Ada Nilai
                                                        </span>
                                                    <?php endif; ?>
                                                    <?php if (!$m->is_diujikan && !$m->is_diajarkan && !$m->has_nilai): ?>
                                                        <span class="badge bg-secondary bg-opacity-10 text-muted border border-secondary border-opacity-25">
                                                            Tidak Diujikan
                                                        </span>
                                                    <?php endif; ?>
                                                    <?php if ($m->jenjang == 3): ?>
                                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25" title="Tingkat MA / SMA">
                                                            Tingkat MA
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <input type="number" name="custom_order[<?= $m->id_mapel ?>]" value="<?= esc($m->revisi_urutan) ?>" class="form-control form-control-sm text-center shadow-none" style="width: 65px; margin: 0 auto;">
                                            </td>
                                            <td>
                                                <span class="badge bg-light text-dark border px-2 py-1 font-monospace"><?= esc($m->kode) ?></span>
                                            </td>
                                            <td>
                                                <div class="fw-semibold text-dark"><?= esc($m->nama_mapel) ?></div>
                                                <small class="text-muted" style="font-size: 0.78rem;">Kelompok: <?= esc($m->kelompok ?? '-') ?></small>
                                            </td>
                                            <td>
                                                <input type="text" name="custom_names[<?= $m->id_mapel ?>]" value="<?= esc($m->revisi_nama) ?>" class="form-control form-control-sm shadow-none" placeholder="<?= esc($m->nama_mapel) ?>">
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">
                                            Tidak ada data mata pelajaran di sistem.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tombol Simpan Form -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="<?= base_url('rapor') ?>" class="btn btn-light rounded-pill px-4">
                    <i class="fas fa-times me-1"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm fw-bold">
                    <i class="fas fa-save me-1"></i> Simpan Perubahan Mapel Rapor
                </button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    ajaxcsrf();

    function updateCount() {
        var cnt = $('.chk-mapel:checked').length;
        $('#count-selected').text(cnt + ' Mapel Dipilih');
    }
    updateCount();

    $('.chk-mapel').on('change', function () {
        var row = $(this).closest('tr');
        if ($(this).is(':checked')) {
            row.addClass('table-active-row');
        } else {
            row.removeClass('table-active-row');
        }
        updateCount();
        // Otomatis aktifkan mode 'kustom' jika admin mencentang atau membatalkan pilihan mapel
        $('input[name="mode"][value="kustom"]').prop('checked', true).trigger('change');
    });

    $('input[name="mode"]').on('change', function () {
        $('.mode-box').removeClass('border-primary bg-primary bg-opacity-10 shadow-sm').addClass('bg-light');
        $(this).closest('.mode-box').removeClass('bg-light').addClass('border-primary bg-primary bg-opacity-10 shadow-sm');
    });

    $('#btn-select-all').on('click', function () {
        $('.chk-mapel').prop('checked', true).closest('tr').addClass('table-active-row');
        updateCount();
    });

    $('#btn-deselect-all').on('click', function () {
        $('.chk-mapel').prop('checked', false).closest('tr').removeClass('table-active-row');
        updateCount();
    });

    $('#search-mapel').on('keyup', function () {
        var val = $(this).val().toLowerCase();
        $('#table-mapel-rapor tbody tr').filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(val) > -1);
        });
    });

    // Simpan Form Mapel Rapor
    $('#form-mapel-rapor').on('submit', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Menyimpan...',
            text: 'Silakan tunggu...',
            allowOutsideClick: false,
            didOpen: function () { Swal.showLoading(); }
        });

        $.ajax({
            url: '<?= base_url('rapor/savemapelrapor') ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (res) {
                if (res.status) {
                    Swal.fire({
                        title: 'Berhasil',
                        text: res.message || 'Pengaturan mapel rapor berhasil disimpan',
                        icon: 'success'
                    }).then(function () {
                        location.reload();
                    });
                } else {
                    Swal.fire('Gagal', res.message || 'Gagal menyimpan', 'error');
                }
            },
            error: function () {
                Swal.fire('Error', 'Terjadi kesalahan sistem saat menyimpan data', 'error');
            }
        });
    });

    // Sinkronisasi Otomatis Mapel Ujian
    $('#btn-sync-ujian').on('click', function () {
        Swal.fire({
            title: 'Sesuaikan Otomatis?',
            text: 'Sistem akan memeriksa jadwal ujian CBT, bank soal, dan guru pengampu semester ini lalu memilih mapel yang diujikan saja.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Sesuaikan Sekarang',
            cancelButtonText: 'Batal'
        }).then(function (result) {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Memproses...',
                    allowOutsideClick: false,
                    didOpen: function () { Swal.showLoading(); }
                });

                $.ajax({
                    url: '<?= base_url('rapor/syncmapelujian') ?>',
                    type: 'POST',
                    dataType: 'json',
                    success: function (res) {
                        if (res.status) {
                            Swal.fire('Berhasil', res.message, 'success').then(function () {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Gagal', res.message, 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
                    }
                });
            }
        });
    });

    // Reset Standar MTs
    $('#btn-reset-mts').on('click', function () {
        Swal.fire({
            title: 'Terapkan Standar MTs?',
            text: 'Sistem akan mengaktifkan 15 mapel standar MTs Kemenag dan mematikan mapel tingkat SMA/MA.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Terapkan Standar MTs',
            cancelButtonText: 'Batal'
        }).then(function (result) {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menerapkan...',
                    allowOutsideClick: false,
                    didOpen: function () { Swal.showLoading(); }
                });

                $.ajax({
                    url: '<?= base_url('rapor/resetstandarmts') ?>',
                    type: 'POST',
                    dataType: 'json',
                    success: function (res) {
                        if (res.status) {
                            Swal.fire('Berhasil', res.message, 'success').then(function () {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Gagal', res.message, 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
                    }
                });
            }
        });
    });
});
</script>

<?= $this->endSection() ?>
