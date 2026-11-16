<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<div class="d-contents">
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="me-3 flex-shrink-0">
                        <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); color: #ffffff;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="card-title mb-1 fw-bold d-flex align-items-center text-dark">
                            Kehadiran & Catatan Wali Kelas <?= esc($kelas->nama_kelas ?? '-') ?>
                        </h4>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">Input rekap ketidakhadiran (Sakit, Izin, Alpa) dan catatan motivasi wali kelas untuk dicetak pada Rapor Kurikulum Merdeka.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= form_open('', ['id' => 'form-kehadiran']) ?>
    <input type="hidden" name="id_kelas" value="<?= $kelas->id_kelas ?? '' ?>">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h6 class="card-title mb-0 fw-bold text-primary">
                <i class="fas fa-user-check me-2"></i> Rekap Ketidakhadiran & Catatan Perkembangan Siswa
            </h6>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 shadow-sm" id="btn-tarik-presensi">
                    <i class="fas fa-sync-alt me-1"></i> Tarik Otomatis dari Presensi Harian
                </button>
                <button type="submit" class="btn btn-sm btn-primary rounded-pill px-4 shadow-sm">
                    <i class="fas fa-save me-1"></i> Simpan Kehadiran & Catatan
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-center small fw-bold text-secondary">
                            <th rowspan="2" style="width: 40px;" class="align-middle">No</th>
                            <th rowspan="2" style="min-width: 180px;" class="align-middle text-start">Nama Siswa</th>
                            <th colspan="3" style="min-width: 300px;" class="bg-soft-info text-info">Ketidakhadiran (Hari)</th>
                            <th rowspan="2" style="min-width: 320px;" class="align-middle text-start">Catatan Wali Kelas</th>
                        </tr>
                        <tr class="text-center small fw-bold">
                            <th style="width: 100px; min-width: 95px;" class="bg-soft-info text-center">Sakit</th>
                            <th style="width: 100px; min-width: 95px;" class="bg-soft-info text-center">Izin</th>
                            <th style="width: 100px; min-width: 95px;" class="bg-soft-info text-center">Alpa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($siswas as $idx => $s): 
                            $kRow = $kehadiran[$s->id_siswa] ?? null;
                            $valS = $kRow->sakit ?? 0;
                            $valI = $kRow->izin ?? 0;
                            $valA = $kRow->alpa ?? 0;
                            $valCatatan = $kRow->catatan_wali ?? 'Pertahankan prestasi belajar dan tingkatkan terus keaktifan dalam kegiatan di madrasah.';
                        ?>
                            <tr>
                                <td class="text-center fw-bold text-secondary small"><?= $idx + 1 ?></td>
                                <td>
                                    <div class="fw-bold text-dark" style="font-size: 0.88rem;"><?= esc($s->nama) ?></div>
                                    <small class="text-muted">NISN: <?= esc($s->nisn ?: '-') ?></small>
                                    <input type="hidden" name="siswa[<?= $s->id_siswa ?>][id_siswa]" value="<?= $s->id_siswa ?>">
                                </td>
                                <td class="p-2 text-center" style="width: 100px;">
                                    <input type="number" min="0" max="100" class="form-control form-control-sm text-center fw-bold mx-auto" 
                                           style="max-width: 80px; font-size: 0.95rem; border-radius: 6px;"
                                           name="siswa[<?= $s->id_siswa ?>][sakit]" value="<?= esc($valS) ?>">
                                </td>
                                <td class="p-2 text-center" style="width: 100px;">
                                    <input type="number" min="0" max="100" class="form-control form-control-sm text-center fw-bold mx-auto" 
                                           style="max-width: 80px; font-size: 0.95rem; border-radius: 6px;"
                                           name="siswa[<?= $s->id_siswa ?>][izin]" value="<?= esc($valI) ?>">
                                </td>
                                <td class="p-2 text-center" style="width: 100px;">
                                    <input type="number" min="0" max="100" class="form-control form-control-sm text-center fw-bold mx-auto" 
                                           style="max-width: 80px; font-size: 0.95rem; border-radius: 6px;"
                                           name="siswa[<?= $s->id_siswa ?>][alpa]" value="<?= esc($valA) ?>">
                                </td>
                                <td class="p-1">
                                    <textarea rows="2" class="form-control form-control-sm" 
                                              name="siswa[<?= $s->id_siswa ?>][catatan_wali]" 
                                              placeholder="Catatan motivasi dari wali kelas..."><?= esc($valCatatan) ?></textarea>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white py-3 text-end border-top">
            <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">
                <i class="fas fa-save me-1"></i> Simpan Kehadiran & Catatan
            </button>
        </div>
    </div>
    <?= form_close() ?>
</div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    $(document).ready(function () {
        ajaxcsrf();

        $('#btn-tarik-presensi').on('click', function() {
            Swal.fire({
                title: 'Tarik dari Presensi Harian?',
                text: 'Hitungan Sakit, Izin, dan Alpa akan diakumulasikan otomatis dari modul Presensi Harian semester ini.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-sync-alt me-1"></i> Ya, Tarik Data',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#198754'
            }).then(function(result) {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menyinkronkan...',
                        text: 'Silakan tunggu...',
                        allowOutsideClick: false,
                        didOpen: function() { Swal.showLoading(); }
                    });

                    $.ajax({
                        url: '<?= base_url('presensi/synctorapor') ?>',
                        type: 'POST',
                        data: {
                            id_kelas: '<?= $kelas->id_kelas ?? '' ?>'
                        },
                        dataType: 'json',
                        success: function(res) {
                            if (res.status) {
                                Swal.fire({
                                    title: 'Sinkronisasi Berhasil',
                                    text: res.message,
                                    icon: 'success'
                                }).then(function() {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Perhatian', res.message || 'Gagal sinkronisasi data', 'warning');
                            }
                        },
                        error: function() {
                            Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
                        }
                    });
                }
            });
        });

        $('#form-kehadiran').on('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Menyimpan...',
                text: 'Silakan tunggu...',
                allowOutsideClick: false,
                didOpen: function () { Swal.showLoading(); }
            });

            $.ajax({
                url: '<?= base_url('rapor/savekehadirancatatan') ?>',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (res) {
                    if (res.status) {
                        Swal.fire({ title: 'Tersimpan', text: 'Data kehadiran dan catatan wali kelas berhasil disimpan', icon: 'success' })
                            .then(function () { location.reload(); });
                    } else {
                        Swal.fire('Gagal', res.message || 'Gagal menyimpan data', 'error');
                    }
                },
                error: function () {
                    Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>
