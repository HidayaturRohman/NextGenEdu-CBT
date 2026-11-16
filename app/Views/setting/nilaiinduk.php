<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<div class="row">
  <div class="col-sm-12">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="me-3 flex-shrink-0">
            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: #ffffff;">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="8" r="7"></circle>
                <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
              </svg>
            </div>
          </div>
          <div>
            <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                <?= $judul ?>
            </h4>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Rekapitulasi dan pengelolaan kumulatif nilai buku induk siswa per semester.</p>
          </div>
        </div>
      </div>
    </div>
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <div class="card-title d-flex align-items-center">
    <svg class="icon-24 text-primary me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg><?= $subjudul ?>
</div>
                </div>
                <div class="card-body">
                    <div class="alert alert-info align-content-center" role="alert">
                        Fitur ini digunakan untuk menyalin semua siswa TP:<?= $tp_active->tahun ?> dari semester 1 ke
                        semester 2
                        <br>
                        <ul>
                            <li>
                                Pilih kelas dari semester I
                            </li>
                            <li>
                                Klik SIMPAN untuk menyalin semua data kelas
                            </li>
                        </ul>
                        Untuk menyalin siswa antar Tahun Pelajaran, gunakan halaman KENAIKAN KELAS
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <div class="mb-3">
                                <label>Pilih Tahun Pelajaran</label>
                                <select name="tahun" id="id-tahun" class="form-control form-control-sm">
                                    <?php
                                    foreach ($tahun as $key => $value) :
                                        $selected = $key == $tahun_selected ? 'selected="selected"' : ''; ?>
                                        <option value="<?= $key ?>" <?= $selected ?>><?= $value ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Pilih Semester</label>
                                <select name="semester" id="id-smt" class="form-control form-control-sm">
                                    <?php
                                    foreach ($semester as $key => $value) :
                                        $selected = $key == $smt_selected ? 'selected="selected"' : ''; ?>
                                        <option value="<?= $key ?>" <?= $selected ?>><?= $value ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Pilih Kelas</label>
                                <?php
                                echo form_dropdown(
                                    'kelas',
                                    $kelases,
                                    isset($kelas_selected) ? $kelas_selected : null,
                                    'id="id-kelas" class="form-control form-control-sm"'
                                ); ?>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    var thnSelected = '<?= isset($tahun_selected) ? $tahun_selected : '';?>';
    var smtSelected = '<?= isset($smt_selected) ? $smt_selected : '';?>';
    var klsSelected = '<?= isset($kelas_selected) ? $kelas_selected : '';?>';

    $(document).ready(function () {

        var opsiTahun = $('#id-tahun');
        var tslctd = thnSelected == '' ? "selected='selected'" : "";
        opsiTahun.prepend("<option value='0' " + tslctd + " disabled='disabled'>Pilih Tahun Pelajaran</option>");
        opsiTahun.change(function () {
            getDataSiswa($(this).val(), opsiSmt.val(), opsiKelas.val());
        });

        var opsiSmt = $('#id-smt');
        var sslctd = smtSelected == '' ? "selected='selected'" : "";
        opsiSmt.prepend("<option value='0' " + sslctd + " disabled='disabled'>Pilih Semester</option>");
        opsiSmt.change(function () {
            getDataSiswa(opsiTahun.val(), $(this).val(), opsiKelas.val());
        });

        var opsiKelas = $('#id-kelas');
        console.log(klsSelected);
        var kslctd = klsSelected == '' ? "selected='selected'" : "";
        opsiKelas.prepend("<option value='0' " + kslctd + " disabled='disabled'>Pilih Kelas</option>");
        opsiKelas.change(function () {
            getDataSiswa(opsiTahun.val(), opsiSmt.val(), $(this).val());
        });

        function getDataSiswa(tahun, smt, kelas) {
            console.log(tahun, smt, kelas);
            if (tahun != null && smt != null) {
                window.location.href = base_url + 'bukuinduk?backupnilai=' + tahun + '&semester=' + smt + '&kelas=' + kelas;
            }
        }
    })

</script>


<?= $this->endSection() ?>
