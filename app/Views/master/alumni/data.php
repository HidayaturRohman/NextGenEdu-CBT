<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <!-- Header Banner -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-body p-4">
                <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3 flex-shrink-0">
                            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 58px; height: 58px; background: linear-gradient(135deg, #f59e0b 0%, #b45309 100%); color: #ffffff;">
                                <i class="fa fa-user-graduate fa-2x"></i>
                            </div>
                        </div>
                        <div>
                            <h4 class="card-title mb-1 fw-bold text-dark">
                                <?= $judul ?>
                            </h4>
                            <p class="text-muted mb-0" style="font-size: 0.92rem;">
                                Manajemen data kelulusan siswa, arsip alumni per angkatan, mutasi pindah, dan penelusuran ijazah.
                            </p>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-outline-secondary shadow-sm" onclick="window.location.reload()">
                            <i class="fa fa-sync-alt me-1"></i> Reload
                        </button>
                        <a href="<?= base_url('dataalumni/add') ?>" class="btn btn-outline-primary shadow-sm">
                            <i class="fa fa-file-excel me-1"></i> Import Excel/Word
                        </a>
                        <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#createAlumniModal">
                            <i class="fa fa-plus-circle me-1"></i> Tambah Alumni
                        </button>
                        <button type="button" class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#modalLuluskan">
                            <i class="fa fa-graduation-cap me-1"></i> Luluskan Siswa
                        </button>
                        <a href="<?= base_url('dataalumni/excel?filter=' . ($filter_selected ?? 2) . ($tahun_selected ? '&tahun=' . $tahun_selected : '') . ($kelas_selected ? '&kelas=' . $kelas_selected : '')) ?>" class="btn btn-outline-success shadow-sm">
                            <i class="fa fa-download me-1"></i> Ekspor Excel
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Summary Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-3 col-sm-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle p-3 bg-success-subtle text-success me-3">
                            <i class="fa fa-user-graduate fa-2x"></i>
                        </div>
                        <div>
                            <div class="text-muted small fw-semibold">TOTAL ALUMNI (LULUS)</div>
                            <div class="fs-4 fw-bold text-dark"><?= number_format($total_alumni ?? 0, 0, ',', '.') ?></div>
                            <div class="text-muted small">Tercatat di Buku Induk</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle p-3 bg-primary-subtle text-primary me-3">
                            <i class="fa fa-users fa-2x"></i>
                        </div>
                        <div>
                            <div class="text-muted small fw-semibold">SISWA KELAS AKHIR AKTIF</div>
                            <div class="fs-4 fw-bold text-dark"><?= number_format($total_aktif_akhir ?? 0, 0, ',', '.') ?></div>
                            <div class="text-muted small">Tingkat <?= $level_akhir ?? 'Akhir' ?> Siap Diluluskan</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle p-3 bg-warning-subtle text-warning me-3">
                            <i class="fa fa-exchange-alt fa-2x"></i>
                        </div>
                        <div>
                            <div class="text-muted small fw-semibold">MUTASI PINDAH</div>
                            <div class="fs-4 fw-bold text-dark"><?= number_format($total_pindah ?? 0, 0, ',', '.') ?></div>
                            <div class="text-muted small">Siswa Pindah Sekolah</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle p-3 bg-danger-subtle text-danger me-3">
                            <i class="fa fa-user-times fa-2x"></i>
                        </div>
                        <div>
                            <div class="text-muted small fw-semibold">MUTASI KELUAR</div>
                            <div class="fs-4 fw-bold text-dark"><?= number_format($total_keluar ?? 0, 0, ',', '.') ?></div>
                            <div class="text-muted small">Berhenti / Dikeluarkan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if (!empty($jumlah_lulus) && $jumlah_lulus > 0 && !empty($tp_before)) : ?>
        <div class="alert alert-warning border-warning-subtle shadow-sm d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center">
                <i class="fa fa-bell fa-2x me-3 text-warning"></i>
                <div>
                    <h6 class="mb-0 fw-bold">Sinkronisasi Kelulusan Rapor Ditemukan!</h6>
                    <small>Ada <strong><?= $jumlah_lulus ?> Siswa LULUS</strong> pada hasil Rapor Tahun Pelajaran <strong><?= $tp_before->tahun ?></strong> yang dapat langsung dimasukkan ke alumni.</small>
                </div>
            </div>
            <button type="button" class="btn btn-warning shadow-sm" onclick="generateFromRapor()">
                <i class="fa fa-sync me-1"></i> Generate Alumni Rapor
            </button>
        </div>
        <?php endif; ?>

        <!-- Main Card with Filters and Data -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3 border-bottom">
                <div class="row g-2 align-items-center">
                    <div class="col-md-3 col-sm-6">
                        <label class="form-label small fw-semibold text-muted mb-1"><i class="fa fa-filter me-1 text-primary"></i>Status Data</label>
                        <select name="filter" id="opsi-filter" class="form-select form-select-sm" onchange="applyFilter()">
                            <option value="2" <?= $filter_selected == '2' ? 'selected' : '' ?>>Siswa Lulus (Alumni)</option>
                            <option value="3" <?= $filter_selected == '3' ? 'selected' : '' ?>>Siswa Pindah</option>
                            <option value="4" <?= $filter_selected == '4' ? 'selected' : '' ?>>Siswa Keluar</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-6 <?= $filter_selected == '2' ? '' : 'd-none' ?>" id="wrap-tahun">
                        <label class="form-label small fw-semibold text-muted mb-1"><i class="fa fa-calendar me-1 text-primary"></i>Tahun Lulus</label>
                        <select name="tahun" id="opsi-tahun" class="form-select form-select-sm" onchange="applyFilter()">
                            <option value="all">-- Semua Tahun Kelulusan --</option>
                            <?php foreach ($tahun_lulus as $k => $v) : ?>
                                <option value="<?= $k ?>" <?= $tahun_selected == $k ? 'selected' : '' ?>><?= $v ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-6 <?= $filter_selected == '2' ? '' : 'd-none' ?>" id="wrap-kelas">
                        <label class="form-label small fw-semibold text-muted mb-1"><i class="fa fa-school me-1 text-primary"></i>Kelas Akhir</label>
                        <select name="kelas" id="opsi-kelas" class="form-select form-select-sm" onchange="applyFilter()">
                            <option value="all">-- Semua Kelas Akhir --</option>
                            <?php foreach ($kelas_akhir as $k => $v) : ?>
                                <option value="<?= $v ?>" <?= $kelas_selected == $v ? 'selected' : '' ?>><?= $v ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-6 text-md-end mt-md-4">
                        <a href="<?= base_url('dataalumni') ?>" class="btn btn-sm btn-outline-secondary">
                            <i class="fa fa-redo me-1"></i> Reset Filter
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <?php if (!empty($alumnis) && count($alumnis) > 0) : 
                    $titleStatus = ($filter_selected == '3') ? 'Pindah' : (($filter_selected == '4') ? 'Keluar' : 'Lulus');
                ?>
                <div class="table-responsive p-3">
                    <table class="table table-hover align-middle border mb-0" id="tbl-alumni">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 45px;" class="text-center">No</th>
                                <th style="width: 50px;" class="text-center">Foto</th>
                                <th style="width: 110px;">NISN</th>
                                <th style="width: 100px;">NIS</th>
                                <th style="min-width: 200px;">Nama Lengkap Siswa</th>
                                <th style="width: 50px;" class="text-center">JK</th>
                                <th style="width: 120px;" class="text-center">Kelas Akhir</th>
                                <th style="width: 110px;" class="text-center">Tahun <?= $titleStatus ?></th>
                                <th style="width: 150px;" class="<?= $filter_selected == '2' ? '' : 'd-none' ?>">Nomor Ijazah</th>
                                <th style="width: 140px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($alumnis as $alumni) : 
                                $fotoSrc = (!empty($alumni->foto) && file_exists(FCPATH . $alumni->foto)) 
                                    ? base_url($alumni->foto) 
                                    : base_url('assets/img/siswa.png');
                            ?>
                            <tr>
                                <td class="text-center text-muted fw-bold"><?= $no++ ?></td>
                                <td class="text-center">
                                    <img src="<?= $fotoSrc ?>" alt="foto" class="rounded-circle border" style="width: 36px; height: 36px; object-fit: cover;" onerror="this.src='<?= base_url('assets/img/siswa.png') ?>'">
                                </td>
                                <td class="font-monospace fw-semibold text-primary"><?= esc($alumni->nisn ?? '-') ?></td>
                                <td class="font-monospace"><?= esc($alumni->nis ?? '-') ?></td>
                                <td>
                                    <div class="fw-bold text-dark"><?= esc($alumni->nama) ?></div>
                                    <?php if (!empty($alumni->tempat_lahir) || !empty($alumni->tanggal_lahir)) : ?>
                                        <small class="text-muted"><?= esc($alumni->tempat_lahir ?? '') ?>, <?= esc($alumni->tanggal_lahir ?? '') ?></small>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <span class="badge <?= $alumni->jenis_kelamin == 'L' ? 'bg-primary-subtle text-primary' : 'bg-danger-subtle text-danger' ?> px-2">
                                        <?= esc($alumni->jenis_kelamin ?? '-') ?>
                                    </span>
                                </td>
                                <td class="text-center fw-semibold"><?= esc($alumni->kelas_akhir ?? '-') ?></td>
                                <td class="text-center">
                                    <?php if ($filter_selected == '2') : ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 font-monospace">
                                            <?= esc($alumni->tahun_lulus ?? '-') ?>
                                        </span>
                                    <?php else : ?>
                                        <span class="badge bg-secondary-subtle text-secondary px-2 py-1">
                                            <?= esc($alumni->tgl_pindah ?? '-') ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="<?= $filter_selected == '2' ? '' : 'd-none' ?> font-monospace text-muted small">
                                    <?= esc($alumni->no_ijazah ?? '-') ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="<?= base_url('dataalumni/edit?id=' . $alumni->id_siswa) ?>" class="btn btn-outline-warning" title="Edit Profil Lengkap">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <?php if ($filter_selected == '2') : ?>
                                        <button type="button" class="btn btn-outline-primary" onclick="bukaModalEditKelulusan(<?= $alumni->id_siswa ?>, '<?= esc($alumni->nama, 'js') ?>', '<?= esc($alumni->tahun_lulus ?? '', 'js') ?>', '<?= esc($alumni->kelas_akhir ?? '', 'js') ?>', '<?= esc($alumni->no_ijazah ?? '', 'js') ?>')" title="Edit Ijazah & Kelulusan">
                                            <i class="fa fa-id-card"></i>
                                        </button>
                                        <?php endif; ?>
                                        <button type="button" class="btn btn-outline-info" onclick="batalkan(<?= $alumni->id_siswa ?>, '<?= esc($alumni->nama, 'js') ?>', '<?= $titleStatus ?>')" title="Batalkan dan Aktifkan Kembali">
                                            <i class="fa fa-undo"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger" onclick="hapus(<?= $alumni->id_siswa ?>, '<?= esc($alumni->nama, 'js') ?>')" title="Hapus Permanen">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php else : ?>
                <!-- Empty State Card -->
                <div class="p-5 text-center">
                    <div class="mb-3">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center p-4 bg-light text-muted border">
                            <i class="fa fa-user-graduate fa-3x" style="color: #adb5bd;"></i>
                        </div>
                    </div>
                    <h5 class="fw-bold text-dark">Belum Ada Data Alumni</h5>
                    <p class="text-muted mx-auto mb-4" style="max-width: 500px;">
                        Belum ada siswa yang berstatus alumni pada kriteria yang dipilih. Anda dapat meluluskan siswa kelas akhir secara langsung, menambah alumni manual, atau mengimport dari file Excel/Word.
                    </p>
                    <div class="d-flex justify-content-center flex-wrap gap-2">
                        <button type="button" class="btn btn-success shadow-sm" data-bs-toggle="modal" data-bs-target="#modalLuluskan">
                            <i class="fa fa-graduation-cap me-1"></i> Luluskan Siswa Kelas Akhir
                        </button>
                        <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#createAlumniModal">
                            <i class="fa fa-plus-circle me-1"></i> Tambah Alumni Manual
                        </button>
                        <a href="<?= base_url('dataalumni/add') ?>" class="btn btn-outline-primary shadow-sm">
                            <i class="fa fa-file-excel me-1"></i> Import dari Excel / Word
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal 1: Tambah Alumni Manual -->
<div class="modal fade" id="createAlumniModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <?= form_open('', ['id' => 'formalumni']); ?>
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold" id="createModalLabel"><i class="fa fa-user-plus me-2"></i>Tambah Data Alumni</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap Alumni <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nama_alumni" placeholder="Nama lengkap siswa" required>
                </div>
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <label class="form-label fw-semibold">NIS</label>
                        <input type="text" class="form-control font-monospace" name="nis" placeholder="Nomor Induk Siswa">
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-semibold">NISN</label>
                        <input type="text" class="form-control font-monospace" name="nisn" placeholder="Nomor Induk Siswa Nasional">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select class="form-select" name="jenis_kelamin" required>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <label class="form-label fw-semibold">Tahun Lulus <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="tahun_lulus" value="<?= date('Y') ?>" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-semibold">Kelas Akhir</label>
                        <input type="text" class="form-control" name="kelas_akhir" placeholder="Misal: IX-A atau 9 (Sembilan)">
                    </div>
                </div>
                <div class="mb-2">
                    <label class="form-label fw-semibold">Nomor Ijazah</label>
                    <input type="text" class="form-control font-monospace" name="no_ijazah" placeholder="Contoh: DN-01/M-MTs/24/0001234">
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="btn-submit-alumni">
                    <i class="fa fa-save me-1"></i> Simpan Alumni
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!-- Modal 2: Luluskan Siswa Tingkat Akhir Masal -->
<div class="modal fade" id="modalLuluskan" tabindex="-1" aria-labelledby="modalLuluskanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <?= form_open('', ['id' => 'formLuluskanMasal']); ?>
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title fw-bold" id="modalLuluskanLabel"><i class="fa fa-graduation-cap me-2"></i>Luluskan Siswa Tingkat Akhir</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="alert alert-info py-2 mb-3 small">
                    <i class="fa fa-info-circle me-1"></i>
                    Fitur ini akan menandai siswa aktif pada kelas tingkat akhir sebagai <strong>LULUS (Alumni)</strong> di Buku Induk tanpa perlu menunggu proses e-Rapor.
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Pilih Kelas yang Diluluskan <span class="text-danger">*</span></label>
                    <select class="form-select" name="id_kelas" id="luluskan_id_kelas" required>
                        <option value="all">-- Semua Siswa Tingkat Akhir (Tingkat <?= $level_akhir ?? '9' ?>) --</option>
                        <?php if (!empty($kelas_akhir_aktif)) : ?>
                            <?php foreach ($kelas_akhir_aktif as $ka) : ?>
                                <option value="<?= $ka->id_kelas ?>">Kelas <?= esc($ka->nama_kelas) ?> (<?= (int)$ka->jml_siswa ?> siswa aktif)</option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tahun Kelulusan <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="tahun_lulus" id="luluskan_tahun" value="<?= date('Y') ?>" required>
                    <small class="text-muted">Tahun yang akan tercatat di Buku Induk dan ijazah siswa.</small>
                </div>

                <div class="mb-2">
                    <label class="form-label fw-semibold">Nomor / Format Ijazah (Opsional)</label>
                    <input type="text" class="form-control font-monospace" name="no_ijazah" id="luluskan_ijazah" placeholder="Bisa diisi nanti atau dikosongkan (- -)">
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success" id="btn-proses-luluskan">
                    <i class="fa fa-check me-1"></i> Proses Kelulusan Siswa
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!-- Modal 3: Edit Cepat Kelulusan Alumni -->
<div class="modal fade" id="modalEditKelulusan" tabindex="-1" aria-labelledby="modalEditKelulusanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <?= form_open('', ['id' => 'formEditKelulusan']); ?>
            <input type="hidden" name="id_siswa" id="ek_id_siswa">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title fw-bold" id="modalEditKelulusanLabel"><i class="fa fa-id-card me-2"></i>Ubah Data Kelulusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Alumni</label>
                    <input type="text" class="form-control bg-light" id="ek_nama" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tahun Lulus <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="tahun_lulus" id="ek_tahun" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kelas Akhir</label>
                    <input type="text" class="form-control" name="kelas_akhir" id="ek_kelas" placeholder="Contoh: IX-A">
                </div>
                <div class="mb-2">
                    <label class="form-label fw-semibold">Nomor Ijazah</label>
                    <input type="text" class="form-control font-monospace" name="no_ijazah" id="ek_ijazah">
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-warning" id="btn-save-kelulusan">
                    <i class="fa fa-save me-1"></i> Simpan Perubahan
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function () {
        if (typeof ajaxcsrf === 'function') {
            ajaxcsrf();
        }

        // Initialize DataTable jika tabel ada
        if ($('#tbl-alumni').length > 0) {
            $('#tbl-alumni').DataTable({
                responsive: true,
                language: {
                    search: "Cari Alumni:",
                    lengthMenu: "Tampilkan _MENU_ baris",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ alumni",
                    infoEmpty: "Menampilkan 0 alumni",
                    zeroRecords: "Tidak ada data alumni yang cocok",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "Lanjut",
                        previous: "Kembali"
                    }
                },
                order: [[0, 'asc']],
                pageLength: 25
            });
        }

        // Submit Tambah Alumni Manual
        $('#formalumni').on('submit', function (e) {
            e.preventDefault();
            const btn = $('#btn-submit-alumni');
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Menyimpan...');

            $.ajax({
                url: base_url + "dataalumni/create",
                type: 'POST',
                data: $(this).serialize(),
                dataType: "json",
                success: function (res) {
                    btn.prop('disabled', false).html('<i class="fa fa-save me-1"></i> Simpan Alumni');
                    if (res.insert) {
                        $('#createAlumniModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: res.text,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Menyimpan',
                            text: res.text || 'Terjadi kesalahan validasi.'
                        });
                    }
                },
                error: function (xhr) {
                    btn.prop('disabled', false).html('<i class="fa fa-save me-1"></i> Simpan Alumni');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error Server',
                        text: 'Gagal menghubungi server (' + xhr.status + ').'
                    });
                }
            });
        });

        // Submit Luluskan Siswa Tingkat Akhir Masal
        $('#formLuluskanMasal').on('submit', function (e) {
            e.preventDefault();
            const btn = $('#btn-proses-luluskan');

            Swal.fire({
                title: 'Konfirmasi Kelulusan',
                text: 'Apakah Anda yakin ingin memproses kelulusan siswa pada kelas yang dipilih?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Luluskan Siswa!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Memproses...');
                    $.ajax({
                        url: base_url + "dataalumni/luluskankelas",
                        type: 'POST',
                        data: $('#formLuluskanMasal').serialize(),
                        dataType: 'json',
                        success: function (res) {
                            btn.prop('disabled', false).html('<i class="fa fa-check me-1"></i> Proses Kelulusan Siswa');
                            if (res.status) {
                                $('#modalLuluskan').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Kelulusan Berhasil!',
                                    text: res.message,
                                    confirmButtonColor: '#10b981'
                                }).then(() => {
                                    window.location.href = base_url + 'dataalumni?filter=2';
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: res.message
                                });
                            }
                        },
                        error: function (xhr) {
                            btn.prop('disabled', false).html('<i class="fa fa-check me-1"></i> Proses Kelulusan Siswa');
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Server',
                                text: 'Gagal memproses kelulusan (' + xhr.status + ').'
                            });
                        }
                    });
                }
            });
        });

        // Submit Edit Cepat Kelulusan
        $('#formEditKelulusan').on('submit', function (e) {
            e.preventDefault();
            const btn = $('#btn-save-kelulusan');
            btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Menyimpan...');

            $.ajax({
                url: base_url + "dataalumni/editkelulusan",
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function (res) {
                    btn.prop('disabled', false).html('<i class="fa fa-save me-1"></i> Simpan Perubahan');
                    if (res.status) {
                        $('#modalEditKelulusan').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: res.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: res.message || 'Gagal mengubah data kelulusan.'
                        });
                    }
                },
                error: function (xhr) {
                    btn.prop('disabled', false).html('<i class="fa fa-save me-1"></i> Simpan Perubahan');
                    Swal.fire({
                        icon: 'error',
                        title: 'Error Server',
                        text: 'Gagal menghubungi server (' + xhr.status + ').'
                    });
                }
            });
        });
    });

    // Terapkan Filter Dropdown
    function applyFilter() {
        const filter = $('#opsi-filter').val();
        const tahun  = $('#opsi-tahun').val();
        const kelas  = $('#opsi-kelas').val();

        let url = base_url + 'dataalumni?filter=' + filter;
        if (filter == '2') {
            if (tahun && tahun !== 'all') {
                url += '&tahun=' + tahun;
            }
            if (kelas && kelas !== 'all') {
                url += '&kelas=' + encodeURIComponent(kelas);
            }
        }
        window.location.href = url;
    }

    // Modal Edit Kelulusan
    function bukaModalEditKelulusan(idSiswa, nama, tahun, kelas, ijazah) {
        $('#ek_id_siswa').val(idSiswa);
        $('#ek_nama').val(nama);
        $('#ek_tahun').val(tahun || '<?= date('Y') ?>');
        $('#ek_kelas').val(kelas || '');
        $('#ek_ijazah').val(ijazah || '');
        $('#modalEditKelulusan').modal('show');
    }

    // Batalkan Status Kelulusan / Pindah / Keluar
    function batalkan(id, nama, title) {
        Swal.fire({
            title: `Batalkan Status ${title}?`,
            text: `Apakah Anda yakin ingin mengembalikan ${nama} menjadi siswa aktif?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#2563eb',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Aktifkan Kembali',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + "dataalumni/batalkan",
                    type: "POST",
                    data: { id: id },
                    dataType: "json",
                    success: function (res) {
                        if (res.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: res.message,
                                confirmButtonColor: '#2563eb'
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: res.message
                            });
                        }
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Gagal memproses (' + xhr.status + ').'
                        });
                    }
                });
            }
        });
    }

    // Hapus Alumni Permanen
    function hapus(id, nama) {
        Swal.fire({
            title: 'Hapus Data Alumni?',
            html: `Apakah Anda yakin akan menghapus data alumni <strong>${nama}</strong>?<br><span class="text-danger small">Tindakan ini permanen dan akan menghapus data di buku induk.</span>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus Permanen',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + "dataalumni/delete",
                    type: "POST",
                    data: { id: id },
                    dataType: "json",
                    success: function (res) {
                        if (res.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Terhapus',
                                text: res.message,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: res.message
                            });
                        }
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Gagal menghapus (' + xhr.status + ').'
                        });
                    }
                });
            }
        });
    }

    // Generate dari Rapor
    function generateFromRapor() {
        Swal.fire({
            title: 'Generate Alumni dari Rapor',
            text: 'Sedang memproses data kelulusan siswa...',
            allowEscapeKey: false,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: base_url + "dataalumni/generatealumni",
            type: "GET",
            dataType: "json",
            success: function (res) {
                if (res.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: res.message,
                        confirmButtonColor: '#2563eb'
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Tidak ada data kelulusan yang dapat digenerate.'
                    });
                }
            },
            error: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error Server',
                    text: 'Gagal memproses data alumni (' + xhr.status + ').'
                });
            }
        });
    }
</script>
<?= $this->endSection() ?>
