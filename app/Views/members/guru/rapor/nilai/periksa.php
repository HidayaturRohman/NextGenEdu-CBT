<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<?php
$mapelNone = $filter_selected != '1' ? 'd-none' : '';
$extraNone = $filter_selected != '2' ? 'd-none' : '';
?>
<div class="d-contents">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="me-3 flex-shrink-0">
            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #0891b2 0%, #0e7490 100%); color: #ffffff;">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
              </svg>
            </div>
          </div>
          <div>
            <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                <?= $judul ?>
            </h4>
            <p class="text-muted mb-0" style="font-size: 0.9rem;"><?= $subjudul ?? 'Pemeriksaan & Verifikasi Nilai Rapor Siswa' ?></p>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend w-30">
                                    <span class="input-group-text">Filter</span>
                                </div>
                                <?php
                                echo form_dropdown('filter', $filter, $filter_selected, 'id="filter" class="form-control"'); ?>
                            </div>
                        </div>
                        <div id="opmapel" class="col-md-5 mb-3 <?= $mapelNone ?>">
                            <div class="input-group">
                                <div class="input-group-prepend w-30">
                                    <span class="input-group-text">Mata Pelajaran</span>
                                </div>
                                <?php
                                echo form_dropdown('mapel', $mapel, $mapel_selected, 'id="mapel" class="form-control"'); ?>
                            </div>
                        </div>
                        <div id="opekstra" class="col-md-5 mb-3 <?= $extraNone ?>">
                            <div class="input-group">
                                <div class="input-group-prepend w-30">
                                    <span class="input-group-text">Ekstrakurikuler</span>
                                </div>
                                <?php
                                echo form_dropdown('ekstra', $ekstra, $ekstra_selected, 'id="ekstra" class="form-control"'); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    //echo '<pre>';
                    //var_dump($guru_mapel);
                    //var_dump($guru_mapels[7]->nama_guru);
                    //var_dump($guru_mapels[7]->mapel_kelas);
                    //var_dump($guru_mapels[7]->mapel_kelas[0]['id_mapel']);
                    //var_dump($guru_mapels[7]->mapel_kelas[0]['kelas_mapel'][0]['kelas']);
                    //echo '</pre>';
                    if (isset($siswa)) : ?>
                        <div class="overflow-auto">
                            <table id="table-nilai" class="table table-bordered table-striped text-sm"
                                   style="width: 2000px">
                                <thead>
                                <tr class="bg-gray">
                                    <th rowspan="2" class="text-center align-middle">NO</th>
                                    <th rowspan="2" class="text-center align-middle">NIS/NISN</th>
                                    <th rowspan="2" class="text-center align-middle" style="width: 10%;">NAMA</th>
                                    <?php if ($extraNone) : ?>
                                        <th colspan="8" class="text-center">NILAI PENGETAHUAN</th>
                                        <th rowspan="2" class="text-center align-middle">RPH P</th>
                                        <th rowspan="2" class="text-center align-middle">PRED P</th>
                                        <th rowspan="2" class="text-center align-middle" style="width: 20%">DESKRIPSI
                                            PENGETAHUAN
                                        </th>
                                        <th colspan="8" class="text-center">NILAI KETERAMPILAN</th>
                                        <th rowspan="2" class="text-center align-middle">RPH K</th>
                                        <th rowspan="2" class="text-center align-middle">PRED K</th>
                                        <th rowspan="2" class="text-center align-middle" style="width: 20%">DESKRIPSI
                                            KETERAMPILAN
                                        </th>
                                    <?php else: ?>
                                        <th rowspan="2" class="text-center">NILAI</th>
                                        <th rowspan="2" class="text-center align-middle">PRED</th>
                                        <th rowspan="2" class="text-center align-middle">DESKRIPSI</th>
                                    <?php endif; ?>
                                </tr>
                                <tr class="bg-gray">
                                    <?php if ($extraNone) : ?>
                                        <th class="text-center">P1</th>
                                        <th class="text-center">P2</th>
                                        <th class="text-center">P3</th>
                                        <th class="text-center">P4</th>
                                        <th class="text-center">P5</th>
                                        <th class="text-center">P6</th>
                                        <th class="text-center">P7</th>
                                        <th class="text-center">P8</th>
                                        <th class="text-center">K1</th>
                                        <th class="text-center">K2</th>
                                        <th class="text-center">K3</th>
                                        <th class="text-center">K4</th>
                                        <th class="text-center">K5</th>
                                        <th class="text-center">K6</th>
                                        <th class="text-center">K7</th>
                                        <th class="text-center">K8</th>
                                    <?php endif; ?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $no = 1;
                                foreach ($siswa as $s) :
                                    $ns = $nilai[$s->id_siswa]; ?>
                                    <tr>
                                        <td class="text-center"><?= $no ?></td>
                                        <td class="text-center"><?= $s->nis ?></td>
                                        <td><?= $s->nama ?></td>
                                        <?php if ($extraNone) : ?>
                                            <td class="text-center"><?= $ns->p1 != null ? $ns->p1 : '' ?></td>
                                            <td class="text-center"><?= $ns->p2 ?></td>
                                            <td class="text-center"><?= $ns->p3 ?></td>
                                            <td class="text-center"><?= $ns->p4 ?></td>
                                            <td class="text-center"><?= $ns->p5 ?></td>
                                            <td class="text-center"><?= $ns->p6 ?></td>
                                            <td class="text-center"><?= $ns->p7 ?></td>
                                            <td class="text-center"><?= $ns->p8 ?></td>
                                            <td class="text-center text-bold"><?= $ns->p_rata_rata ?></td>
                                            <td class="text-center text-bold"><?= $ns->p_predikat ?></td>
                                            <td style="font-size: 8pt"><?= $ns->p_deskripsi ?></td>
                                            <td class="text-center"><?= $ns->k1 ?></td>
                                            <td class="text-center"><?= $ns->k2 ?></td>
                                            <td class="text-center"><?= $ns->k3 ?></td>
                                            <td class="text-center"><?= $ns->k4 ?></td>
                                            <td class="text-center"><?= $ns->k5 ?></td>
                                            <td class="text-center"><?= $ns->k6 ?></td>
                                            <td class="text-center"><?= $ns->k7 ?></td>
                                            <td class="text-center"><?= $ns->k8 ?></td>
                                            <td class="text-center text-bold"><?= $ns->k_rata_rata ?></td>
                                            <td class="text-center text-bold"><?= $ns->k_predikat ?></td>
                                            <td style="font-size: 8pt"><?= $ns->k_deskripsi ?></td>
                                        <?php else: ?>
                                            <td class="text-center"><?= $ns->nilai ?></td>
                                            <td class="text-center"><?= $ns->predikat ?></td>
                                            <td class="text-center"><?= $ns->deskripsi ?></td>
                                        <?php endif; ?>
                                    </tr>
                                    <?php $no++; endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script>
    $(document).ready(function () {
        ajaxcsrf();

        //$('#table-nilai').dataTable();

        var opsiFilter = $("#filter");
        var opsiMapel = $("#mapel");
        var opsiEskul = $("#ekstra");

        function loadSiswaKelas(filter, id) {
            var empty = id === null;
            if (!empty) {
                $('#loading').removeClass('d-none');
                window.location.href = base_url + 'rapor/rapornilaiguru/' + filter + '/' + id;
            } else {
                console.log('empty')
            }
        }

        opsiFilter.change(function () {
            if ($(this).val() == '1') {
                $('#opmapel').removeClass('d-none');
                $('#opekstra').addClass('d-none');
                opsiMapel.val('');
                opsiEskul.val('');
            } else if ($(this).val() == '2') {
                $('#opekstra').removeClass('d-none');
                $('#opmapel').addClass('d-none');
                opsiMapel.val('');
                opsiEskul.val('');
            } else {
                $('#opmapel').addClass('d-none');
                $('#opekstra').addClass('d-none');
                opsiMapel.val('');
                opsiEskul.val('');
            }
        });

        opsiMapel.change(function () {
            loadSiswaKelas(opsiFilter.val(), $(this).val())
        });

        opsiEskul.change(function () {
            loadSiswaKelas(opsiFilter.val(), $(this).val())
        });

    })

</script>

<?= $this->endSection() ?>

