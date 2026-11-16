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
                <polyline points="16 11 18 13 22 9"></polyline>
              </svg>
            </div>
          </div>
          <div>
            <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                <?= $judul ?>
            </h4>
            <p class="text-muted mb-0" style="font-size: 0.9rem;"><?= $subjudul ?? 'Keputusan Kenaikan / Kelulusan Kelas' ?></p>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white py-3">
                    <h6 class="card-title text-white mb-0 fw-bold"><i class="fas fa-user-check me-2"></i><?= $subjudul ?></h6>
                </div>
                <div class="card-body">
                    <div class="alert alert-soft-primary border-start border-4 border-primary p-3 mb-4 rounded-3" role="alert">
                        <div class="fw-bold mb-1"><i class="fas fa-info-circle me-1"></i> Petunjuk Pengisian:</div>
                        <ul class="mb-0 ps-3 text-secondary" style="font-size: 0.9rem; line-height: 1.6;">
                            <li>Semua siswa otomatis diset "Naik / Lulus"</li>
                            <li>Siswa yang tidak naik / tidak lulus harus diset secara manual</li>
                            <li>Jangan lupa untuk menyimpan perubahan</li>
                        </ul>
                    </div>

                    <?php
                    $naik = 'Naik';
                    $tdkNaik = 'Tidak Naik';
                    if ($guru->level == '6' || $guru->level == '9' || $guru->level == '12') {
                        $naik = 'Lulus';
                        $tdkNaik = 'Tidak Lulus';
                    }
                    $naiks = ['1' => $naik, '0' => $tdkNaik];
                    ?>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle mb-3" id="tbl-siswa">
                            <thead class="table-light">
                            <tr>
                                <th width="50" class="text-center align-middle text-primary fw-bold">No.</th>
                                <th class="text-center align-middle text-primary fw-bold">NISN</th>
                                <th class="text-center align-middle text-primary fw-bold">NIS</th>
                                <th class="align-middle text-primary fw-bold">Nama Siswa</th>
                                <th class="text-center align-middle text-primary fw-bold" style="width: 200px">Keputusan Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            foreach ($siswas as $siswa) :
                                ?>
                                <tr>
                                    <td class="d-none id-siswa"><?= $siswa->id_siswa ?></td>
                                    <td class="text-center align-middle fw-bold text-secondary"><?= $no ?></td>
                                    <td class="text-center align-middle"><?= $siswa->nisn ?></td>
                                    <td class="text-center align-middle"><?= $siswa->nis ?></td>
                                    <td class="align-middle fw-bold text-dark"><?= $siswa->nama ?></td>
                                    <td class="align-middle">
                                        <?php
                                        echo form_dropdown('naik', $naiks, $siswa->naik != null ? $siswa->naik : '', 'class="form-select form-select-sm naik shadow-sm"'); ?>
                                    </td>
                                </tr>
                                <?php $no++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <?= form_open('', array('id' => 'formkenaikan')) ?>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm fw-bold">
                            <i class="fas fa-save me-2"></i>Simpan Kenaikan / Kelulusan
                        </button>
                    </div>
                    <?= form_close() ?>

                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    $(document).ready(function () {
        $('#formkenaikan').submit('click', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            console.log("data:", $(this).serialize());

            const $rows1 = $('#tbl-siswa').find('tr'), headers1 = $rows1.splice(0, 1);
            var jsonObj = [];
            $rows1.each((i, row) => {
                const id_siswa = $(row).find('.id-siswa').text();
                const naik = $(row).find('.naik').val();

                let item = {};
                item ["id_siswa"] = id_siswa;
                item ["naik"] = naik;

                jsonObj.push(item);
            });

            console.log($(this).serialize() + '&naik=' + JSON.stringify(jsonObj));

            $.ajax({
                url: base_url + "rapor/savenaik",
                type: "POST",
                dataType: "JSON",
                data: $(this).serialize() + '&naik=' + JSON.stringify(jsonObj),
                success: function (data) {
                    console.log("result", data);
                    swal.fire({
                        title: "Sukses",
                        text: data + " Data berhasil disimpan",
                        icon: "success",
                        showCancelButton: false,
                    }).then(result => {
                        if (result.value) {
                            window.location.reload()
                        }
                    });
                }, error: function (xhr, status, error) {
                    console.log("error", xhr.responseText);
                    swal.fire({
                        title: "ERROR",
                        text: "Data Tidak Tersimpan",
                        icon: "error",
                        showCancelButton: false,
                    });
                }
            });
        });

    });
</script>

<?= $this->endSection() ?>

