<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<?php
$user = is_array($user ?? null) ? (object)$user : $user;
$users = is_array($users ?? null) ? (object)$users : $users;
?>
<div class="row justify-content-center pt-3">
    <div class="col-md-8 col-lg-6">
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center py-3">
                <i class="fas fa-key fa-lg me-3"></i>
                <div>
                    <h5 class="card-title mb-0 fw-bold text-white"><?= esc($judul) ?></h5>
                    <small class="text-white-50"><?= esc($subjudul) ?></small>
                </div>
            </div>
            <div class="card-body p-4">
                <?= form_open('useradmin/change_password', array('id' => 'change_password'), array('id' => $users->id, 'username' => $users->username)) ?>
                
                <div class="mb-3">
                    <label for="username" class="form-label fw-bold">Username</label>
                    <input type="text" name="username" class="form-control bg-light" value="<?= esc($users->username) ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="old" class="form-label fw-bold">Password Lama</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock text-muted"></i></span>
                        <input type="password" placeholder="Masukkan Password Lama" name="old" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="new" class="form-label fw-bold">Password Baru</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-key text-muted"></i></span>
                        <input type="password" placeholder="Masukkan Password Baru" name="new" class="form-control" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="new_confirm" class="form-label fw-bold">Konfirmasi Password Baru</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-check-circle text-muted"></i></span>
                        <input type="password" placeholder="Ulangi Password Baru" name="new_confirm" class="form-control" required>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="<?= base_url('useradmin/profile') ?>" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Ke Profil
                    </a>
                    <button type="submit" id="btn-pass" class="btn btn-primary px-4 shadow-sm">
                        <i class="fas fa-save me-1"></i> Simpan Password
                    </button>
                </div>

                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function () {
    $('#change_password').submit(function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        let btn = $('#btn-pass');
        let oldPass = $('[name="old"]').val();
        let newPass = $('[name="new"]').val();
        let confirmPass = $('[name="new_confirm"]').val();

        if (newPass !== confirmPass) {
            swal.fire({
                title: "Gagal",
                text: "Konfirmasi password baru tidak cocok!",
                icon: "warning"
            });
            return false;
        }

        btn.attr('disabled', 'disabled').html('<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...');

        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                btn.removeAttr('disabled').html('<i class="fas fa-save me-1"></i> Simpan Password');
                if (data.status) {
                    swal.fire({
                        title: "Berhasil!",
                        text: "Password berhasil diubah",
                        icon: "success"
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    let msg = data.msg || "Gagal mengubah password";
                    if (data.errors) {
                        msg = Object.values(data.errors).join("<br>");
                    }
                    swal.fire({
                        title: "Gagal",
                        html: msg,
                        icon: "error"
                    });
                }
            },
            error: function () {
                btn.removeAttr('disabled').html('<i class="fas fa-save me-1"></i> Simpan Password');
                swal.fire({
                    title: "Error",
                    text: "Terjadi kesalahan sistem",
                    icon: "error"
                });
            }
        });
    });
});
</script>
<?= $this->endSection() ?>
