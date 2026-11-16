<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

    <div class="row">
  <div class="col-sm-12">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between w-100">
            <div class="d-flex align-items-center">
              <div class="me-3 flex-shrink-0">
                <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #06b6d4 0%, #0e7490 100%); color: #ffffff;">
                  <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 22v-4a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v4"></path>
                    <path d="M18 22V6l-6-4-6 4v16"></path>
                    <path d="M6 12h12"></path>
                    <path d="M6 16h12"></path>
                  </svg>
                </div>
              </div>
              <div>
                <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                    <?= $judul ?>
                </h4>
                <p class="text-muted mb-0" style="font-size: 0.9rem;">Pemetaan rombongan belajar (rombel) dan alokasi tempat siswa per semester aktif.</p>
              </div>
            </div>
            <div>
                <button onclick="window.history.back();" type="button" class="btn btn-secondary shadow-sm float-end"><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg><span class="d-none d-sm-inline-block ms-1">Kembali</span>
                    </button>
            </div>
        </div>
      </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card  mb-4">
                <div class="card-header">
                    <div class="card-title">
                        <?= $subjudul ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-default-info align-content-center" role="alert">
                        Fitur ini digunakan untuk menyalin semua kelas dan siswa TP:<?= $tp_active->tahun ?> dari semester 1 ke
                        semester 2
                        <br>
                        <ul>
                            <li>
                                Hanya kelas yang BELUM ADA di semester II yang akan disalin
                            </li>
                            <li>
                                Pilih Kelas yang akan dicopy
                            </li>
                            <li>
                                Klik SIMPAN untuk menyalin semua data kelas dari SMT I ke SMT II
                            </li>
                        </ul>
                    </div>
                    <?php
                    if (count($kelas) == 0) : ?>
                        <div class="alert alert-default-danger" role="alert">
                            <span>Tidak ada kelas di SMT sebelumnya</span>
                        </div>
                    <?php else : ?>
                    <?= form_open('', array('id' => 'managekelas')) ?>
                    <div class="row">
                        <div class='col-12 text-right mb-3'>
                            <button type="submit" class="btn btn-primary" id="save-all" disabled><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg><span class="ms-1">Simpan</span>
                            </button>
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-center align-middle" style="height: 40px">No</th>
                                <th class="align-middle">Kelas SMT 1</th>
                                <th class="align-middle">Kelas SMT 2</th>
                                <th class="align-middle">Keterangan</th>
                                <th class="text-center align-middle">
                                    Copy<br/>
                                    <input class="check my-checkbox" type="checkbox" id="check-all">
                                </th>
                            </tr>
                            </thead>
                            <tbody id="table-body">
                            <?php
                            $no = 0;
                            foreach ($kelas as $key => $kls) :?>
                                <tr>
                                    <td class="text-center align-middle">
                                        <?= $no + 1 ?>
                                    </td>
                                    <td>
                                        <?= $kls ?>
                                    </td>
                                    <td>
                                        <?= $kls ?>
                                        <?php if (!in_array($kls, $kelas2)) :?>
                                            <input type="hidden" name="kelas_dua[<?= $key ?>]" value="<?= $kls ?>"/>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (in_array($kls, $kelas2)) :?>
                                            <span class="text-success">Kelas sudah ada</span>
                                        <?php else: ?>
                                            <span class="text-danger">Kelas belum ada</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center align-middle">
                                        <?php if (!in_array($kls, $kelas2)) :?>
                                            <input type="checkbox" name="kelas_satu[]" value="<?= $key ?>" class="check check-kelas my-checkbox"/>
                                        <?php else: ?>
                                            <span class="text-success"><i class="fa fa-check"></i></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php
                            $no ++;
                            endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?= form_close(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    const arrKelas = JSON.parse(JSON.stringify(<?= json_encode($kelas)?>));
    let uncheckedKelas = [];
    let checkedKelas = [];

    $(document).ready(function () {
        $("#check-all").prop("checked", false);
        $('#check-all').prop('indeterminate', false)

        var selKelas = $('#opsi-kelas2');
        $('#opsi-kelas1').prepend("<option value='' selected='selected' disabled='disabled'>Pilih Kelas</option>");
        selKelas.prepend("<option value='' selected='selected' disabled='disabled'>Pilih Kelas</option>");

        $('#opsi-kelas1').change(function () {
            $('#kelas-baru').val($('#opsi-kelas1 option:selected').text());
        });

        $("#check-all").on("click", function () {
            const count = $('#table-body .check-kelas').length;
            console.log('check', count)
            if (count > 0) {
                if (this.checked) {
                    $(".check-kelas").each(function () {
                        this.checked = true;
                    });
                } else {
                    $(".check-kelas").each(function () {
                        this.checked = false;
                    });
                }
                findUnchecked()
            }
        });

        $("#table-body").on("change",".check-kelas", function () {
            console.log('change')
            findUnchecked();
        });

        $('#managekelas').submit(function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            swal.fire({
                title:"Salin Kelas",
                text:"Kelas yang dipilih akan dicopy ke SMT II",
                icon:"warning",
                showCancelButton: true,
                confirmButtonText:"Copy"
            }).then(result => {
                if (result.value) {
                    $.ajax({
                        url: base_url + 'datakelas/copyallfromsmt1',
                        type:"POST",
                        data: $(this).serialize(),
                        success: function (data) {
                            console.log(data);
                            swal.fire({
                                title:"Berhasil",
                                text:"Kelas berhasil disalin",
                                icon:"success"
                            }).then(result => {
                                if (result.value) {
                                    window.location.reload();
                                }
                            });
                        },
                        error: function (xhr, status, error) {
                            console.log(xhr.responseText);
                            swal.fire({
                                title:"Gagal",
                                text: JSON.stringify(xhr),
                                icon:"error"
                            });
                        }
                    });
                }
            });
        });
    });

    function findUnchecked() {
        uncheckedKelas = [];
        checkedKelas = [];
        const count = $('#table-body tr:visible .check-kelas').length;

        $("#table-body tr:visible .check-kelas:not(:checked)").each(function () {
            uncheckedKelas.push($(this).val());
        });
        $("#table-body tr:visible .check-kelas:checked").each(function () {
            checkedKelas.push($(this).val());
        });
        const countChecked = $("#table-body tr:visible .check-kelas:checked").length;

        $("#check-all").prop({
            checked: countChecked === count,
            indeterminate: countChecked > 0 && countChecked < count
        });

        console.log('checked', checkedKelas.length, uncheckedKelas.length)
        $("#save-all").attr('disabled', countChecked === 0);
    }

</script>

<?= $this->endSection() ?>
