<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hidayatur Rohman
 * Date: 07/07/20
 * Time: 17:20
 */

if (isset($jadwal_kbm)) {
    $jmlIst = $jadwal_kbm->istirahat;
}
?>
<div class="d-contents">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="me-3 flex-shrink-0">
            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #3a57e8 0%, #1a3aba 100%); color: #ffffff;">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
              </svg>
            </div>
          </div>
          <div>
            <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                <?= $judul ?>
            </h4>
            <p class="text-muted mb-0" style="font-size: 0.9rem;"><?= $subjudul ?? 'Jadwal Pelajaran Kelas' ?></p>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h6 class="card-title"><?= $subjudul ?></h6>
                    <div class="card-tools">
                        <button type="button" onclick="reload()" class="btn btn-sm btn-default">
                            <i class="fa fa-sync"></i> <span class="d-none d-sm-inline-block ms-1">Reload</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col">
                        Pilih Kelas:
                        <br>
                        <?php
                        if (count($kelas) > 0) :
                            foreach ($kelas as $key => $value) :?>
                                <a href="<?= base_url('kelasjadwal/kelas/' . $key) ?>"
                                   class="mt-1 btn <?= $id_kelas == $key ? 'btn-success' : 'btn-outline-success' ?>"
                                   id="btn-<?= $key ?>"><?= $value ?>
                                </a>
                            <?php endforeach;
                        else: ?>
                            <div class="col-12 p-0">
                                <div class="alert alert-default-warning shadow align-content-center" role="alert">
                                    Belum ada data kelas untuk Tahun Pelajaran <b><?= $tp_active->tahun ?></b> Semester:
                                    <b><?= $smt_active->smt ?></b>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <hr>

                    <?php
                    if (isset($jadwal_mapel)) :
                        foreach ($jadwal_mapel as $k) {
                            foreach ($k['jadwal'] as $j) {
                                $arrRes[$j->jam_ke][] = [
                                    'id_tp' => $j->id_tp,
                                    'id_smt' => $j->id_smt,
                                    'id_kelas' => $j->id_kelas,
                                    'id_hari' => $j->id_hari,
                                    'jam_ke' => $j->jam_ke,
                                    'id_mapel' => $j->id_mapel,
                                    'kode' => $j->kode
                                ];
                            }
                        }

                        $arrIst = [];
                        foreach ($jmlIst as $istirahat) {
                            $arrIst[] = $istirahat->ist;
                            $arrDur[$istirahat->ist] = $istirahat->dur;
                        };
                        if (isset($jadwal_kbm->ada)) : ?>
                            <div class="col-lg-12 p-0">
                                <div class="alert alert-default-warning align-content-center" role="alert">
                                    Jadwal <strong>Kelas <?= $kelas[$id_kelas] ?> </strong> Tahun Pelajaran
                                    <strong><?= $jadwal_kbm->id_tp ?>
                                        Smt <?= $jadwal_kbm->id_smt ?></strong> belum di set.
                                </div>
                            </div>
                        <?php endif;
                        ?>
                        <hr>
                        <?php
                        if (isset($jadwal_kbm->ada)) : ?>
                            <div class="col-lg-12 p-0">
                                <div class="alert align-content-center" role="alert">
                                    <strong>Jadwal belum dibuat.</strong> .
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table id="jadwal-pelajaran" class="w-100 table table-striped table-bordered">
                                    <thead class="alert alert-primary">
                                    <tr>
                                        <th height="50" class="align-middle text-center p-0">WAKTU</th>
                                        <th class="align-middle text-center p-0">SENIN</th>
                                        <th class="align-middle text-center p-0">SELASA</th>
                                        <th class="align-middle text-center p-0">RABU</th>
                                        <th class="align-middle text-center p-0">KAMIS</th>
                                        <th class="align-middle text-center p-0">JUM'AT</th>
                                        <th class="align-middle text-center p-0">SABTU</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $jamMulai = new DateTime($jadwal_kbm->kbm_jam_mulai);
                                    $jamSampai = new DateTime($jadwal_kbm->kbm_jam_mulai);
                                    for ($i = 0; $i < $jadwal_kbm->kbm_jml_mapel_hari; $i++) :
                                        $jamke = $i + 1;
                                        if (in_array($jamke, $arrIst)) :
                                            $jamSampai->add(new DateInterval('PT' . $arrDur[$jamke] . 'M'));
                                            ?>
                                            <tr class="jam bg-gradient-red" data-jamke="<?= $jamke ?>">
                                                <td class="align-middle text-center">
                                                    <?= $jamMulai->format('H:i') ?> - <?= $jamSampai->format('H:i') ?>
                                                </td>
                                                <td class="align-middle text-center p-0">ISTIRAHAT</td>
                                                <td class="align-middle text-center p-0">ISTIRAHAT</td>
                                                <td class="align-middle text-center p-0">ISTIRAHAT</td>
                                                <td class="align-middle text-center p-0">ISTIRAHAT</td>
                                                <td class="align-middle text-center p-0">ISTIRAHAT</td>
                                                <td class="align-middle text-center p-0">ISTIRAHAT</td>
                                            </tr>
                                            <?php
                                            $jamMulai->add(new DateInterval('PT' . $arrDur[$jamke] . 'M'));
                                        else :
                                            $jamSampai->add(new DateInterval('PT' . $jadwal_kbm->kbm_jam_pel . 'M'));
                                            ?>
                                            <tr class="jam" data-jamke="<?= $jamke ?>">
                                                <td class="align-middle text-center bg-gradient-primary">
                                                    <?= $jamMulai->format('H:i') ?> - <?= $jamSampai->format('H:i') ?>
                                                </td>
                                                <?php
                                                if (isset($arrRes[$jamke])) :
                                                    foreach ($arrRes[$jamke] as $value) :?>
                                                        <td class="text-center align-middle">
                                                            <?= $value['kode'] ?>
                                                        </td>
                                                    <?php
                                                    endforeach;
                                                else:
                                                    for ($d = 0; $d < 6; $d++) :
                                                        ?>
                                                        <td class="align-middle"></td>
                                                    <?php
                                                    endfor;
                                                endif; ?>
                                            </tr>
                                            <?php
                                            $jamMulai->add(new DateInterval('PT' . $jadwal_kbm->kbm_jam_pel . 'M'));
                                        endif;
                                    endfor; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif;
                        ?>
                    <?php else: ?>
                        <div class="col-lg-12 p-0">
                            <div class="alert alert-default-info shadow align-content-center" role="alert">
                                Silakan Pilih Kelas.
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>

