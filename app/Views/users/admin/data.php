<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<?php helper('form'); ?>
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
                <?= $judul ?>
            </h4>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Manajemen akun administrator sistem, hak akses user, dan keamanan otentikasi login.</p>
          </div>
        </div>
      </div>
    </div>
    
    <div class="card my-shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <div class="header-title">
            <h5 class="card-title mb-0 fw-bold d-flex align-items-center">
                <svg class="icon-24 text-primary me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> <?= isset($subjudul) ? $subjudul : $judul ?>
            </h5>
          </div>
          <div class="card-tools d-flex gap-2">
            <button type="button" onclick="reload_ajax()" class="btn btn-sm btn-default border">
                <i class="fa fa-sync me-1"></i> <span class="d-none d-sm-inline-block">Reload</span>
            </button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#createAdminModal" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i><span class="d-none d-sm-inline-block">Tambah Admin</span>
            </button>
          </div>
        </div>
        <div class="card-body">
                    <div class="table-responsive">
                        <table id="users" class="w-100 table table-striped table-bordered table-hover align-middle">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-center" style="width: 50px;">No.</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                                <th>Created On</th>
                                <th class="text-center">Level</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="width: 100px;">Action</th>
                            </tr>
                            </thead>
                            <tbody style="color: #0f172a; font-weight: 500;">
                            <?php
                            foreach ($admins as $num=>$admin) :
                                $created_date = (is_numeric($admin->created_on) && $admin->created_on > 10000) ? date('d M Y, H:i', $admin->created_on) : '-';
                                $group_str = strtolower($admin->group_name ?? '');
                                $level_badge = ($group_str == 'admin' || $group_str == 'administrator') ? 'bg-primary' : ($group_str == 'guru' ? 'bg-info text-dark' : 'bg-secondary');
                                ?>
                                <tr>
                                    <td class="text-center fw-bold text-dark"><?= $num + 1 ?></td>
                                    <td class="fw-bold text-dark"><?= esc($admin->first_name) ?></td>
                                    <td class="fw-semibold text-dark"><?= esc($admin->last_name) ?></td>
                                    <td><code class="px-2 py-1 bg-light rounded text-primary fw-semibold" style="font-size: 0.9rem;"><?= esc($admin->username) ?></code></td>
                                    <td class="text-dark small fw-medium"><?= esc($admin->created_on) ?></td>
                                    <td class="text-center"><span class="badge bg-primary px-2 py-1 shadow-sm"><?= esc($admin->level ?? $admin->group_name) ?></span></td>
                                    <td class="text-center align-middle">
                                        <?php if ($admin->active == 1) : ?>
                                            <span class="badge bg-success text-white px-3 py-2 rounded-pill shadow-sm" style="font-size: 0.825rem;"><i class="fa fa-check-circle me-1"></i>Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger text-white px-3 py-2 rounded-pill shadow-sm" style="font-size: 0.825rem;"><i class="fa fa-times-circle me-1"></i>Not Active</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center align-middle">
                                        <?php
                                        $current_user_id = is_array($user) ? ($user['id'] ?? null) : (is_object($user) ? ($user->id ?? null) : null);
                                        if ($admin->id == $current_user_id) : ?>
                                            <a class="btn btn-sm btn-primary rounded-circle shadow-sm" href="<?=base_url('useradmin/edit/'. $admin->id)?>" data-bs-toggle="tooltip" title="Edit Profil Saya">
                                                <i class="fa fa-cog fa-spin"></i>
                                            </a>
                                        <?php else:
                                            if ($current_user_id == "1" || $current_user_id == 1) : ?>
                                                <div class="d-flex justify-content-center gap-1">
                                                    <a class="btn btn-sm btn-warning text-white shadow-sm" href="<?=base_url('useradmin/edit/'.$admin->id)?>" data-bs-toggle="tooltip" title="Edit User">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-danger shadow-sm" onclick="hapus(<?=$admin->id?>)" data-bs-toggle="tooltip" title="Hapus User">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-muted"><i class="fa fa-ban text-danger"></i></span>
                                            <?php endif; endif;?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah Admin -->
<div class="modal fade" id="createAdminModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-primary text-white py-3 px-4">
                <h5 class="modal-title fw-bold text-white mb-0" id="createModalLabel">
                    <i class="fas fa-user-shield me-2"></i>Tambah Administrator
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('useradmin/create', array('id' => 'create')) ?>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="form-label fw-semibold text-dark">Nama Depan <span class="text-danger">*</span></label>
                    <input type="text" name="first_name" class="form-control" placeholder="Contoh: Budi" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold text-dark">Nama Belakang</label>
                    <input type="text" name="last_name" class="form-control" placeholder="Contoh: Santoso" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold text-dark">Username <span class="text-danger">*</span></label>
                    <input type="text" name="username" class="form-control" placeholder="Username untuk login" required autocomplete="off">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold text-dark">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="opsional (cth: admin@sekolah.sch.id)" autocomplete="off">
                </div>
                <div class="row g-2 mb-2">
                    <div class="col-md-6 mb-2">
                        <label class="form-label fw-semibold text-dark">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="input_password" class="form-control" placeholder="Minimal 4 karakter" required minlength="4">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label fw-semibold text-dark">Ulangi Password <span class="text-danger">*</span></label>
                        <input type="password" name="confirm_password" id="input_confirm_password" class="form-control" placeholder="Ulangi password" required minlength="4">
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light py-2.5 px-4 d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-semibold" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="submit" id="btnSubmitAdmin" class="btn btn-primary btn-sm rounded-pill px-4 fw-semibold shadow-sm">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?=base_url()?>/assets/app/js/ajax_request.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        if (typeof ajaxcsrf === 'function') ajaxcsrf();
        $("#users").DataTable();

        $('#create').on('submit', function (e) {
            e.preventDefault();
            
            var pass = $('#input_password').val();
            var conf = $('#input_confirm_password').val();
            if (pass !== conf) {
                var sweet = (typeof Swal !== 'undefined') ? Swal : ((typeof swal !== 'undefined') ? swal : null);
                if (sweet) {
                    sweet.fire({
                        title: "Perhatian",
                        text: "Password dan Konfirmasi Password tidak cocok!",
                        icon: "warning"
                    });
                } else {
                    alert("Password dan Konfirmasi Password tidak cocok!");
                }
                return false;
            }

            var btn = $('#btnSubmitAdmin');
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...');

            var formData = new FormData(this);
            var sweet = (typeof Swal !== 'undefined') ? Swal : ((typeof swal !== 'undefined') ? swal : null);

            $.ajax({
                url: base_url + "useradmin/create",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    btn.prop('disabled', false).html('<i class="fas fa-save me-1"></i> Simpan');
                    
                    if (response && response.status) {
                        $('#createAdminModal').modal('hide');
                        if (sweet) {
                            sweet.fire({
                                title: "Sukses",
                                text: response.msg || "Administrator baru berhasil dibuat.",
                                icon: "success"
                            }).then(function(result) {
                                window.location.reload();
                            });
                        } else {
                            alert(response.msg || "Administrator baru berhasil dibuat.");
                            window.location.reload();
                        }
                    } else {
                        var errMsg = (response && response.msg) ? response.msg : "Gagal membuat user admin.";
                        if (sweet) {
                            sweet.fire({
                                title: "Gagal Menyimpan",
                                html: errMsg,
                                icon: "error"
                            });
                        } else {
                            alert(errMsg);
                        }
                    }
                },
                error: function (xhr, status, error) {
                    btn.prop('disabled', false).html('<i class="fas fa-save me-1"></i> Simpan');
                    var errMsg = "Terjadi kendala saat menghubungi server.";
                    try {
                        var json = JSON.parse(xhr.responseText);
                        if (json && json.msg) errMsg = json.msg;
                    } catch(ex) {}

                    if (sweet) {
                        sweet.fire({
                            title: "Error Server",
                            html: errMsg,
                            icon: "error"
                        });
                    } else {
                        alert(errMsg);
                    }
                }
            });
        });
    });

    function hapus(id) {
        swal.fire({
            title: "Anda yakin?",
            text: "Data akan dihapus.",
            type: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Hapus!"
        }).then(async result => {
            if (result.value) {
                ajaxGet(base_url + "useradmin/delete/" + id, function(error, response) {
                    if (error) {
                        console.log('error', error);
                        swal.fire({
                            title: "Gagal",
                            text: "User gagal dihapus",
                            type: "error"
                        });
                    } else {
                        console.log('response', response);
                        swal.fire({
                            title: response.status ? "Berhasil" : "Gagal",
                            text: response.status ? "User berhasil dihapus" : "User gagal dihapus",
                            type: response.status ? "success" : "error"
                        }).then(result => {
                            if (result.value) {
                                window.location.reload();
                            }
                        });
                    }
                });
            }
        });
    }

    function aktifkan(id, status) {
        swal.fire({
            title: status === 1 ? "Aktifkan User?" : "Nonaktifkan User?",
            text: status === 1 ? "User akan diaktifkan." : "User akan dinonaktifkan.",
            type: "question",
            showCancelButton: true,
            confirmButtonText: "Ya!"
        }).then(async result => {
            if (result.value) {
                let formData = new FormData();
                formData.append('status', status);
                await ajaxPost(base_url + "useradmin/edit_status/" + id, formData, function(error, response) {
                    if (error) {
                        console.log('error', error);
                        swal.fire({
                            title: "Gagal",
                            text: "Status gagal diubah",
                            type: "error"
                        });
                    } else {
                        console.log('response', response);
                        swal.fire({
                            title: response.status ? "Berhasil" : "Gagal",
                            text: response.status ? "Status berhasil diubah" : "Status gagal diubah",
                            type: response.status ? "success" : "error"
                        }).then(result => {
                            if (result.value) {
                                window.location.reload();
                            }
                        });
                    }
                });
            }
        });
    }
</script>


<?= $this->endSection() ?>
