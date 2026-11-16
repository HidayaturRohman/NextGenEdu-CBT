<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<div class="d-contents">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
          <div class="d-flex align-items-center">
            <div class="me-3 flex-shrink-0">
              <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%); color: #ffffff;">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                  <polyline points="14 2 14 8 20 8"></polyline>
                  <line x1="16" y1="13" x2="8" y2="13"></line>
                  <line x1="16" y1="17" x2="8" y2="17"></line>
                  <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
              </div>
            </div>
            <div>
              <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                  <?= $judul ?>
              </h4>
              <p class="text-muted mb-0" style="font-size: 0.9rem;"><?= $subjudul ?? 'Catatan Wali Kelas Per Siswa' ?></p>
            </div>
          </div>
          <button onclick="window.history.back();" type="button" class="btn btn-outline-secondary px-3 py-2 shadow-sm fw-semibold">
              <i class="fas fa-arrow-left me-1"></i> Kembali
          </button>
        </div>
      </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="card-title text-white mb-0 fw-bold"><i class="fas fa-pencil-alt me-2"></i>Catatan Untuk <b><?= $siswa->nama ?></b></h6>
                    <button type="button" class="btn btn-light text-primary btn-sm px-3 shadow-sm fw-bold" data-bs-toggle="modal"
                            data-bs-target="#daftarModal">
                        <i class="fa fa-plus me-1"></i> Buat Catatan
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle mb-0">
                            <thead class="table-light">
                            <tr>
                                <th width="50" class="text-center align-middle text-primary fw-bold">No.</th>
                                <th class="text-center align-middle text-primary fw-bold">Tanggal</th>
                                <th class="text-center align-middle text-primary fw-bold">Jenis</th>
                                <th class="align-middle text-primary fw-bold">Catatan</th>
                                <th class="text-center align-middle text-primary fw-bold" style="width: 120px">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $arrLvl = ['Tidak ada', 'Saran', 'Teguran', 'Peringatan', 'Sangsi'];
                            if (count($catatan_siswa) > 0) :
                                foreach ($catatan_siswa as $key => $value) : ?>
                                    <tr>
                                        <td class="text-center align-middle fw-bold text-secondary"><?= ($key + 1) ?></td>
                                        <td class="text-center align-middle"><?= $value->tgl ?></td>
                                        <td class="text-center align-middle"><span class="badge bg-soft-primary text-primary px-3 py-1"><?= $arrLvl[$value->level] ?></span></td>
                                        <td class="align-middle"><?= $value->text ?></td>
                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-sm btn-outline-danger" data-id="<?= $value->id_catatan ?>" onclick="hapus(this)">
                                                <i class="fa fa-trash me-1"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach;
                            else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-3 text-muted">Belum ada catatan</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="daftarModal" tabindex="-1" role="dialog" aria-labelledby="daftarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="daftarLabel"></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('', array('id' => 'formcatatan')) ?>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Jenis</label>
                                <?php
                                $arrLevel = [1 => 'Saran', 2 => 'Teguran', 3 => 'Peringatan', 4 => 'Sangsi'];
                                echo form_dropdown(
                                    'level',
                                    $arrLevel,
                                    null,
                                    'class="select2 form-control" data-placeholder="Pilih Jenis" required'
                                ); ?>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Catatan</label>
                                <textarea style="min-height: 200px" class="form-control" name="text" id="input_text"
                                          required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_siswa" value="<?= $siswa->id_siswa ?>">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Simpan
                </button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    var idSiswa = <?=$siswa->id_siswa?>;
    var idKelas = <?=$id_kelas?>;
    $(document).ready(function () {

        $('#daftarModal').on('show.bs.modal', function (e) {
            $('#daftarLabel').text('Catatan Untuk Kelas ');
        });

        $('#formcatatan').submit('click', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            console.log("data:", $(this).serialize());

            $.ajax({
                url: base_url + "walicatatan/savecatatansiswa",
                type: "POST",
                dataType: "JSON",
                data: $(this).serialize(),
                success: function (data) {
                    console.log("result", data);
                    $('#daftarModal').modal('hide');
                    $('#daftarModal').on('hidden', function () {
                        $(this).data('modal', null);
                    });

                    if (data) {
                        swal.fire({
                            title: "Sukses",
                            text: "Catatan berhasil disimpan",
                            icon: "success",
                            showCancelButton: false,
                        }).then(result => {
                            if (result.value) {
                                window.location.href = base_url + 'walicatatan/siswa?id_siswa=' + idSiswa + '&id_kelas=' + idKelas;
                            }
                        });
                    } else {
                        swal.fire({
                            title: "ERROR",
                            text: "Catatan Tidak Tersimpan",
                            icon: "error",
                            showCancelButton: false,
                        });
                    }
                }, error: function (xhr, status, error) {
                    $('#daftarModal').modal('hide');
                    $('#daftarModal').on('hidden', function () {
                        $(this).data('modal', null);
                    });
                    console.log("error", xhr.responseText);
                    //showDangerToast('ERROR');
                    swal.fire({
                        title: "ERROR",
                        text: "Catatan Tidak Tersimpan",
                        icon: "error",
                        showCancelButton: false,
                    });
                }
            });
        });
    });

    function hapus(data) {
        var idCatatan = $(data).data('id');
        console.log(idCatatan);

        swal.fire({
            title: "Hapus Catatan?",
            text: "Catatan ini akan dihapus",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Hapus"
        }).then(result => {
            if (result.value) {
                $.ajax({
                    url: base_url + 'walicatatan/hapus/' + idCatatan,
                    method: "GET",
                    success: function (respon) {
                        console.log(respon);
                        if (respon) {
                            window.location.href = base_url + 'walicatatan/siswa?id_siswa=' + idSiswa + '&id_kelas=' + idKelas;
                        } else {
                            swal.fire({
                                title: "Gagal",
                                text: "Tidak bisa menghapus catatan",
                                icon: "error"
                            });
                        }
                    },
                    error: function (xhr, error, status) {
                        console.log(xhr.responseText);
                        swal.fire({
                            title: "Gagal",
                            text: "Tidak bisa menghapus catatan",
                            icon: "error"
                        });
                    }
                });
            }
        });
    }
</script>

<?= $this->endSection() ?>

