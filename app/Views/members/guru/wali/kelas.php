<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<div class="d-contents">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="me-3 flex-shrink-0">
            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%); color: #ffffff;">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
              </svg>
            </div>
          </div>
          <div>
            <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                <?= $judul ?>
            </h4>
            <p class="text-muted mb-0" style="font-size: 0.9rem;"><?= $subjudul ?? 'Daftar Siswa Kelolaan Wali Kelas' ?></p>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h6 class="card-title text-white mb-0 fw-bold"><i class="fas fa-users me-2"></i><?= $subjudul ?></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-siswa" class="w-100 table table-hover table-bordered align-middle">
                            <thead class="table-light">
                            <tr>
                                <th class="text-center align-middle" width="40" height="40">No.</th>
                                <th class="align-middle">Siswa</th>
                                <th class="align-middle">NIS & NISN</th>
                                <th class="align-middle">Username<br>Password</th>
                                <th class="text-center align-middle">Status</th>
                                <th class="text-center align-middle">Aksi</th>
                            </tr>
                            </thead>
                            <tbody id="table-body">
                            <?php
                            if (count($siswas) > 0) :
                                foreach ($siswas as $idx=>$siswa) :
                                    $kls = !empty($siswa->nama_kelas) ? '<span class="badge bg-primary text-white rounded-pill px-2 py-1">Kelas ' . esc($siswa->nama_kelas) . '</span>' : '';
                                    $agama = !empty($siswa->agama) ? '<span class="badge bg-light text-dark border rounded-pill px-2 py-1">' . esc($siswa->agama) . '</span>' : '';
                                    $jk = ($siswa->jenis_kelamin == 'L') 
                                        ? '<span class="badge bg-info text-white rounded-pill px-2 py-1">L</span>' 
                                        : '<span class="badge bg-danger text-white rounded-pill px-2 py-1">P</span>';

                                    $status = ($siswa->active == "1")  
                                        ? '<span class="badge bg-success text-white rounded-pill px-2 py-1 shadow-sm"><i class="fas fa-check-circle me-1"></i>Aktif</span>' 
                                        : '<span class="badge bg-danger text-white rounded-pill px-2 py-1 shadow-sm"><i class="fas fa-times-circle me-1"></i>Nonaktif</span>';
                                    $foto = (!empty($siswa->foto) && file_exists($siswa->foto)) ? base_url($siswa->foto) : base_url('assets/img/siswa.png');
                                    ?>
                                    <tr>
                                        <td class="text-center align-middle fw-bold"><?= $idx + 1 ?></td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center">
                                                <img class="rounded-circle img-thumbnail me-2"
                                                     src="<?=$foto?>" style="width: 50px; height: 50px; object-fit: cover;" alt="Foto Siswa">
                                                <div>
                                                    <div class="fw-bold text-dark mb-1" style="font-size: 1rem;"><?= esc($siswa->nama) ?></div>
                                                    <div class="d-flex flex-wrap gap-1">
                                                        <?= $kls ?>
                                                        <?= $agama ?>
                                                        <?= $jk ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="mb-1"><span class="badge bg-light text-dark border px-2 py-1"><b class="text-muted">NIS:</b> <?= esc($siswa->nis ?: '-') ?></span></div>
                                            <div><span class="badge bg-light text-primary border px-2 py-1"><b class="text-muted">NISN:</b> <?= esc($siswa->nisn ?: '-') ?></span></div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="small"><b class="text-muted">U:</b> <code class="fw-bold text-dark"><?= esc($siswa->username) ?></code></div>
                                            <div class="small"><b class="text-muted">P:</b> <code class="fw-bold text-dark"><?= esc($siswa->password) ?></code></div>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?= $status ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <a class="btn btn-sm btn-warning shadow-sm px-2 py-1 text-white" href="<?= base_url('datasiswa/edit/' . $siswa->id_siswa) ?>">
                                                <i class="fa fa-pencil-alt me-1"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; else: ?>
                            <tr><td colspan="6" class="text-center align-middle py-4 text-muted">Belum ada data siswa di kelas ini</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="overlay d-none" id="loading">
                    <div class="spinner-grow"></div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    $(document).ready(function () {
        $('#table-siswa').dataTable();
    });
</script>
<?= $this->endSection() ?>
