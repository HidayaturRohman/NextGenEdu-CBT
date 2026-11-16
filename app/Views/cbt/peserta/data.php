<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<div class="d-contents">
        <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between w-100">
            <div class="d-flex align-items-center">
              <div class="me-3 flex-shrink-0">
                <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%); color: #ffffff;">
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
                <p class="text-muted mb-0" style="font-size: 0.9rem;">Monitoring status keaktifan peserta tes CBT, progres pengerjaan, dan reset login peserta.</p>
              </div>
            </div>
        </div>
      </div>
    </div>

    <div>
        <div class="container-fluid">
            <?php
            //echo '<pre>';
            //var_dump($siswas);
            //echo '</pre>';
            $ruang_aktif = $btn_aktif == 1 ? 'active btn-primary' : 'btn-outline-primary';
            $kelas_aktif = $btn_aktif == 2 ? 'active btn-primary' : 'btn-outline-primary';

            $ruang_none = $btn_aktif == 1 ? '' : 'd-none';
            $kelas_none = $btn_aktif == 2 ? '' : 'd-none';
            ?>
            <div class="card my-shadow">
                <div class="card-header with-border">
                    <h4 class="card-title mb-0 fw-bold d-flex align-items-center">
    <svg class="icon-24 text-primary me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Master <?= $subjudul ?>
</h3>
                    <div id="selector" class="card-tools d-flex gap-2">
                        <button type="button" class="btn btn-success shadow-sm">By Ruang</button>
                        <button type="button" class="btn <?= $kelas_aktif ?>">By Kelas</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 <?= $ruang_none ?>" id="by-ruang">
                            <div class="input-group">
                                <div class="input-group-prepend w-30">
                                    <span class="input-group-text">Ruang</span>
                                </div>
                                <?php
                                echo form_dropdown(
                                    'ruang',
                                    $ruang,
                                    $ruang_selected,
                                    'id="ruang" class="form-control"'
                                ); ?>
                            </div>
                        </div>

                        <div class="col-3 <?= $ruang_none ?>" id="by-sesi">
                            <div class="input-group">
                                <div class="input-group-prepend w-30">
                                    <span class="input-group-text">Sesi</span>
                                </div>
                                <?php
                                echo form_dropdown(
                                    'sesi',
                                    $sesi,
                                    $sesi_selected,
                                    'id="sesi" class="form-control"'
                                ); ?>
                            </div>
                        </div>

                        <div class="col-md-3 <?= $kelas_none ?>" id="by-kelas">
                            <div class="input-group">
                                <div class="input-group-prepend w-30">
                                    <span class="input-group-text">Kelas</span>
                                </div>
                                <?php
                                echo form_dropdown('kelas', $kelas, $kelas_selected, 'id="kelas" class="form-control"'); ?>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <button class="btn btn-success shadow-sm" id="download-word">Ekspor ke Word</button>
                        </div>
                    </div>
                    <hr>

                    <div class="row" id="for-export">
                        <table>
                            <?php
                            foreach ($siswas as $siswa) : ?>
                                <tr>
                                    <td rowspan="6">
                                        <img width="100" height="120" src="<?= base_url() . $siswa->foto ?>"
                                             style="object-fit: cover;object-position: center;outline: 1px solid;"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        1
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        2
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        3
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        4
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        5
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
                <div class="overlay d-none" id="loading">
                    <div class="spinner-grow"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript" src="<?= base_url() ?>/assets/app/js/FileSaver.min.js?v=<?php echo time(); ?>"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/app/js/jquery.wordexport.js?v=<?php echo time(); ?>"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/app/js/tableToExcel.js?v=<?php echo time(); ?>"></script>
<script type="text/javascript">
    var user_id = '<?=$user->id?>';
    var kelas = '<?=$kelas_selected == null ? '0' : $kelas_selected?>';
    var ruang = '<?=$ruang_selected == null ? '0' : $ruang_selected?>';
    var sesi = '<?=$sesi_selected == null ? '0' : $sesi_selected?>';

    $(document).ready(function () {
        ajaxcsrf();

        var opsiRuang = $("#ruang");
        var opsiSesi = $("#sesi");
        var opsiKelas = $("#kelas");

        var selRuang = ruang === '0' ? 'selected' : '';
        var selSesi = sesi === '0' ? 'selected' : '';
        var selKelas = kelas === '0' ? 'selected' : '';
        opsiRuang.prepend("<option value='' " + selRuang + " disabled>Pilih Ruang</option>");
        opsiSesi.prepend("<option value='' " + selSesi + " disabled>Pilih Sesi</option>");
        opsiKelas.prepend("<option value='' " + selKelas + " disabled>Pilih Kelas</option>");

        $('#selector button').click(function () {
            $(this).addClass('active').siblings().addClass('btn-outline-primary').removeClass('active btn-primary');

            if (!$('#by-kelas').is(':hidden')) {
                $('#by-kelas').addClass('d-none');
                $('#by-ruang').removeClass('d-none');
                $('#by-sesi').removeClass('d-none');
            } else {
                $('#by-kelas').removeClass('d-none');
                $('#by-ruang').addClass('d-none');
                $('#by-sesi').addClass('d-none');
            }
        });

        function loadSiswaRuang(ruang, sesi) {
            var notempty = ruang && sesi;
            if (notempty) {
                window.location.href = base_url + "cbtpeserta?ruang=" + ruang + '&sesi=' + sesi;
            } else {
                console.log('empty')
            }
        }

        function loadSiswaKelas(kelas) {
            if (kelas) {
                window.location.href = base_url + "cbtpeserta?kelas=" + kelas;
            } else {
                console.log('empty')
            }
        }

        opsiKelas.change(function () {
            kelas = $(this).val();
            loadSiswaKelas(kelas);
        });

        opsiRuang.change(function () {
            ruang = $(this).val();
            loadSiswaRuang(ruang, opsiSesi.val());
        });

        opsiSesi.change(function () {
            sesi = $(this).val();
            loadSiswaRuang(opsiRuang.val(), sesi);
        });

        $("#download-word").click(function (event) {
            $("#for-export").wordExport(`test`);
        });
    });
</script>
<?= $this->endSection() ?>

