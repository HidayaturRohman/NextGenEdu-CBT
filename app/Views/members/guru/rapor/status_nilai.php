<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

<div class="d-contents">
    <!-- Header Page -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center">
                    <div class="me-3 flex-shrink-0">
                        <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: #ffffff;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 11l3 3L22 4"></path>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="card-title mb-1 fw-bold d-flex align-items-center text-dark">
                            Status Nilai
                        </h4>
                        <p class="text-muted mb-0" style="font-size: 0.9rem; font-weight: 500;">
                            <?= esc($kelas->nama_kelas ?? 'Pilih Kelas') ?> &bull; Semester <?= esc($smt_active->nama_smt ?? 'Ganjil') ?> TP <?= esc($tp_active->tahun ?? '') ?>
                        </p>
                    </div>
                </div>

                <!-- Dropdown Pilih Kelas -->
                <div class="d-flex align-items-center gap-2">
                    <label class="form-label mb-0 fw-semibold text-secondary small text-nowrap">Pilih Kelas:</label>
                    <select class="form-select form-select-sm shadow-sm" style="min-width: 140px;" onchange="location.href='<?= base_url('rapor/statusnilai') ?>/' + this.value">
                        <?php if (!empty($kelasList)): ?>
                            <?php foreach ($kelasList as $kls): ?>
                                <option value="<?= $kls->id_kelas ?>" <?= ($kelas && $kelas->id_kelas == $kls->id_kelas) ? 'selected' : '' ?>>
                                    Kelas <?= esc($kls->nama_kelas) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Progres Nilai Rapor -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-4">
            <h6 class="card-title fw-bold text-dark mb-3 d-flex align-items-center">
                <i class="fas fa-chart-line text-primary me-2"></i> Progres Nilai
            </h6>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="fw-semibold text-secondary small">Rapor</span>
                    <span class="fw-bold <?= $progresRapor == 100 ? 'text-success' : 'text-primary' ?> small"><?= $progresRapor ?>%</span>
                </div>
                <div class="progress" style="height: 18px; border-radius: 8px; background-color: #f1f5f9;">
                    <div class="progress-bar <?= $progresRapor == 100 ? 'bg-success' : 'bg-primary' ?> progress-bar-striped progress-bar-animated fw-bold" 
                         role="progressbar" 
                         style="width: <?= $progresRapor ?>%; font-size: 0.78rem;" 
                         aria-valuenow="<?= $progresRapor ?>" aria-valuemin="0" aria-valuemax="100">
                        <?= $progresRapor ?>%
                    </div>
                </div>
            </div>

            <div class="row g-2 mt-2 pt-2 border-top text-center">
                <div class="col-6 col-md-3">
                    <div class="p-2 border rounded bg-light">
                        <small class="text-muted d-block" style="font-size: 0.75rem;">Total Siswa</small>
                        <b class="text-dark fs-6"><?= $totalSiswa ?></b> <small class="text-muted">Siswa</small>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-2 border rounded bg-light">
                        <small class="text-muted d-block" style="font-size: 0.75rem;">Total Mapel</small>
                        <b class="text-dark fs-6"><?= $totalMapel ?></b> <small class="text-muted">Mapel</small>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-2 border rounded bg-light">
                        <small class="text-muted d-block" style="font-size: 0.75rem;">Mapel Selesai</small>
                        <b class="text-success fs-6"><?= $mapelSelesai ?></b> <small class="text-success">Tuntas</small>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="p-2 border rounded bg-light">
                        <small class="text-muted d-block" style="font-size: 0.75rem;">Belum Lengkap</small>
                        <b class="<?= ($totalMapel - $mapelSelesai) > 0 ? 'text-warning' : 'text-muted' ?> fs-6"><?= $totalMapel - $mapelSelesai ?></b> <small class="text-muted">Mapel</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Status Nilai -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h6 class="card-title mb-0 fw-bold text-dark">
                <i class="fas fa-list-alt text-primary me-2"></i> Status Keterisian Nilai Mata Pelajaran
            </h6>
            <div class="d-flex align-items-center gap-2">
                <input type="text" id="search-table" class="form-control form-control-sm" placeholder="Cari mapel / guru..." style="max-width: 220px;">
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0" id="table-status-nilai">
                    <thead class="table-light">
                        <tr class="text-secondary small fw-bold">
                            <th class="text-center" style="width: 50px;">No</th>
                            <th style="min-width: 200px;">Mapel</th>
                            <th style="min-width: 220px;">Guru</th>
                            <th class="text-center" style="min-width: 160px;">Nilai</th>
                            <th class="text-center" style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($mapelStatus)): ?>
                            <?php foreach ($mapelStatus as $idx => $m): ?>
                                <tr>
                                    <td class="text-center fw-bold text-secondary"><?= $idx + 1 ?></td>
                                    <td>
                                        <div class="fw-bold text-dark" style="font-size: 0.92rem;"><?= esc($m['nama_mapel']) ?></div>
                                    </td>
                                    <td>
                                        <div class="text-dark fw-semibold" style="font-size: 0.88rem;">
                                            <i class="fas fa-chalkboard-teacher text-muted me-1"></i>
                                            <?= esc($m['nama_guru']) ?>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($m['is_selesai']): ?>
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 rounded-pill fw-semibold">
                                                <i class="fas fa-check-circle me-1"></i> Selesai (<?= $m['terisi'] ?>/<?= $m['total_siswa'] ?>)
                                            </span>
                                        <?php elseif ($m['terisi'] > 0): ?>
                                            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-3 py-2 rounded-pill fw-semibold">
                                                <i class="fas fa-hourglass-half me-1"></i> Progres (<?= $m['terisi'] ?>/<?= $m['total_siswa'] ?>) - <?= $m['persen'] ?>%
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 px-3 py-2 rounded-pill fw-semibold">
                                                <i class="fas fa-times-circle me-1"></i> Belum Dinilai (0/<?= $m['total_siswa'] ?>)
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url('rapor/inputharian/' . $m['id_mapel'] . '/' . ($kelas->id_kelas ?? 0)) ?>" 
                                           class="btn btn-sm btn-outline-primary rounded-pill px-3 shadow-none"
                                           title="Lihat / Input Nilai Asesmen">
                                            <i class="fas fa-external-link-alt me-1"></i> Buka
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="fas fa-info-circle me-1 fs-5 d-block mb-2 text-secondary"></i>
                                    Tidak ada data mata pelajaran yang diajarkan pada kelas ini.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    $('#search-table').on('keyup', function () {
        var value = $(this).val().toLowerCase();
        $('#table-status-nilai tbody tr').filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});
</script>

<?= $this->endSection() ?>
