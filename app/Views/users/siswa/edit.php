<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<div class="d-contents">
    <div class="row">
  <div class="col-sm-12">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="me-3 flex-shrink-0">
            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: #ffffff;">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
            </div>
          </div>
          <div>
            <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                <?= $judul ?> - Edit User Siswa
            </h4>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Penyuntingan profil, data pribadi, dan kredensial kata sandi akun siswa.</p>
          </div>
        </div>
      </div>
    </div>
</div></div></div>

                </div>
                <div class="col-md-9">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
          <div class="header-title">
            <h5 class="card-title mb-0 fw-bold"><svg class="icon-24 text-primary me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Ubah Password & Username</h5>
          </div>
                        </div>
                        <div class="card-body">
                            <?= session()->getFlashdata('editsiswa') ?>
                            <?= form_open('usersiswa/update', array('id' => 'editsiswa'), array('method' => 'edit', 'id_siswa' => $siswa->id_siswa)) ?>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend w-40">
                                    <span class="input-group-text">Username</span>
                                </div>
                                <input type="text" class="form-control" name="username" value="<?= $siswa->username ?>"
                                       placeholder="Username" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend w-40">
                                    <span class="input-group-text">Password Lama</span>
                                </div>
                                <input type="text" name="old" class="form-control" value="<?= $siswa->password ?>"
                                       placeholder="Password Lama" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend w-40">
                                    <span class="input-group-text">Password Baru</span>
                                </div>
                                <input type="text" name="new" class="form-control" placeholder="Password Baru">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend w-40">
                                    <span class="input-group-text">Konfirmasi Password</span>
                                </div>
                                <input type="text" name="new_confirm" class="form-control"
                                       placeholder="Konfirmasi Password Baru" required>
                            </div>
                            <button type="submit" id="btn-pass" class="btn btn-success shadow-sm">Ganti Password
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#flashdata").fadeTo(10000, 500).slideUp(500, function () {
            $("#flashdata").slideUp(500);
        });

    })
</script>

<?= $this->endSection() ?>
