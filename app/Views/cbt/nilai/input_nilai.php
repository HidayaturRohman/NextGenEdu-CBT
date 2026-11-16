<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hidayatur Rohman
 * Date: 07/07/20
 * Time: 17:20
 */

$tampil_pg = $jadwal->bank->tampil_pg ?? $jadwal->bank_soal->tampil_pg;
$tampil_kompleks = $jadwal->bank->tampil_kompleks ?? $jadwal->bank_soal->tampil_kompleks;
$tampil_jodohkan = $jadwal->bank->tampil_jodohkan ?? $jadwal->bank_soal->tampil_jodohkan;
$tampil_isian = $jadwal->bank->tampil_isian ?? $jadwal->bank_soal->tampil_isian;
$tampil_esai = $jadwal->bank->tampil_esai ?? $jadwal->bank_soal->tampil_esai;

$bobot_pg = $jadwal->bank->bobot_pg ?? $jadwal->bank_soal->bobot_pg;
$bobot_kompleks = $jadwal->bank->bobot_kompleks ?? $jadwal->bank_soal->bobot_kompleks;
$bobot_jodohkan = $jadwal->bank->bobot_jodohkan ?? $jadwal->bank_soal->bobot_jodohkan;
$bobot_isian = $jadwal->bank->bobot_isian ?? $jadwal->bank_soal->bobot_isian;
$bobot_esai = $jadwal->bank->bobot_esai ?? $jadwal->bank_soal->bobot_esai;

?>
<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<div class="d-contents">
    <div class="d-contents">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="me-3 flex-shrink-0">
            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: #ffffff;">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
              </svg>
            </div>
          </div>
          <div>
            <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                <?= $judul ?> - Input Nilai Manual
            </h4>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Input manual dan penyesuaian koreksi nilai esai serta nilai susulan peserta ujian.</p>
          </div>
        </div>
      </div>
    </div>
</div></div></div>


    <div>
        <div class="container-fluid">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <?php
                    if (isset($is_rekap)) {
                        $cols = [$jadwal->bank_soal->tampil_pg, $jadwal->bank_soal->tampil_kompleks,
                            $jadwal->bank_soal->tampil_jodohkan, $jadwal->bank_soal->tampil_isian,
                            $jadwal->bank_soal->tampil_esai];
                    } else {
                        $cols = [$jadwal->bank->tampil_pg, $jadwal->bank->tampil_kompleks,
                            $jadwal->bank->tampil_jodohkan, $jadwal->bank->tampil_isian,
                            $jadwal->bank->tampil_esai];
                    }

                    $cols = array_filter($cols);
                    ?>
                    <div class="alert alert-danger">
                        <ul>
                            <li>
                                Halaman ini digunakan jika ingin menginput nilai tanpa koreksi.
                            </li>
                            <li>
                                <b>Nilai Pilihan Ganda</b> tidak bisa diinput manual.
                            </li>
                            <li>
                                Jika hasil siswa sudah dikoreksi dan diberi nilai, maka nilai di halaman ini akan
                                mengganti nilai hasil koreksi.
                            </li>
                            <li>
                                Nilai 0 di halaman ini tidak akan mengganti nilai hasil koreksi.
                            </li>
                        </ul>
                    </div>
                    <div class="alert alert-success border-success">
                        <h6><i class="icon fas fa-check"></i> Info Soal</h6>
                        <div class="row" id="info">
                            <div class="col-12 col-md-6 mb-2">
                                <table>
                                    <tr>
                                        <td>Jenis Penilaian</td>
                                        <td> :</td>
                                        <td><span class="text-bold"><?= $jadwal->jenis->nama_jenis ?? $jadwal->kode_jenis ?></span></td>
                                    </tr>
                                    <tr>
                                        <td>Mata Pelajaran</td>
                                        <td> :</td>
                                        <td><span class="text-bold"><?= $jadwal->bank->mapel->nama_mapel ?? $jadwal->nama_mapel ?></span></td>
                                    </tr>
                                    <tr>
                                        <td>Kelas</td>
                                        <td> :</td>
                                        <td><span class="text-bold"><?= $kelas->nama_kelas ?></span></td>
                                    </tr>
                                    <tr>
                                        <td>Pengampu</td>
                                        <td> :</td>
                                        <td><span class="text-bold"><?= $jadwal->bank->guru->nama_guru ?? $jadwal->nama_guru ?></span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12 col-md-6">
                                <table class="table table-bordered table-striped table-sm">
                                    <tr><td colspan="<?=count($cols)?>" class="text-center" style="border-color:black;">
                                            Jumlah Soal
                                        </td>
                                    </tr>
                                    <tr>
                                        <?php if ($tampil_pg != '0') : ?>
                                            <td class="text-center" style="border-color:black;">
                                                PG
                                            </td>
                                        <?php endif;
                                        if ($tampil_kompleks != '0') :?>
                                            <td class="text-center" style="border-color:black;">
                                                PGK
                                            </td>
                                        <?php endif;
                                        if ($tampil_jodohkan != '0') :?>
                                            <td class="text-center" style="border-color:black;">
                                                Jodohkan
                                            </td>
                                        <?php endif;
                                        if ($tampil_isian != '0') :?>
                                            <td class="text-center" style="border-color:black;">
                                                Isian
                                            </td>
                                        <?php endif;
                                        if ($tampil_esai != '0') :?>
                                            <td class="text-center" style="border-color:black;">
                                                Essai
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <?php if ($tampil_pg != '0') : ?>
                                            <td class="text-center" style="border-color:black;">
                                                <span class="text-bold"
                                                      style="font-size: 16pt"><?= $tampil_pg ?></span>
                                            </td>
                                        <?php endif;
                                        if ($tampil_kompleks != '0') :?>
                                            <td class="text-center" style="border-color:black;">
                                                <span class="text-bold"
                                                      style="font-size: 16pt"><?= $tampil_kompleks ?></span>
                                            </td>
                                        <?php endif;
                                        if ($tampil_jodohkan != '0') :?>
                                            <td class="text-center" style="border-color:black;">
                                                <span class="text-bold"
                                                      style="font-size: 16pt"><?= $tampil_jodohkan ?></span>
                                            </td>
                                        <?php endif;
                                        if ($tampil_isian != '0') :?>
                                            <td class="text-center" style="border-color:black;">
                                                <span class="text-bold"
                                                      style="font-size: 16pt"><?= $tampil_isian ?></span>
                                            </td>
                                        <?php endif;
                                        if ($tampil_esai != '0') :?>
                                            <td class="text-center" style="border-color:black;">
                                                <span class="text-bold"
                                                      style="font-size: 16pt"><?= $tampil_esai ?></span>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-sm w-100" id="table-essai">
                            <tr>
                                <th class="text-center align-middle">
                                    No.
                                </th>
                                <th class="text-center align-middle">
                                    No. Peserta
                                </th>
                                <th class="align-middle">
                                    Nama
                                </th>
                                <?php if ($tampil_pg != '0') : ?>
                                    <th class="text-center align-middle">
                                        Nilai PG<br>
                                        Max. Point: <?= $bobot_pg ?>
                                    </th>
                                <?php endif;
                                if ($tampil_kompleks != '0') :?>
                                    <th class="text-center align-middle">
                                        Nilai PG Kompleks<br>
                                        Max. Point: <?= $bobot_kompleks ?>
                                    </th>
                                <?php endif;
                                if ($tampil_jodohkan != '0') :?>
                                    <th class="text-center align-middle">
                                        Nilai Menjodohkan<br>
                                        Max. Point: <?= $bobot_jodohkan ?>
                                    </th>
                                <?php endif;
                                if ($tampil_isian != '0') :?>
                                    <th class="text-center align-middle">
                                        Nilai Isisan Singkat<br>
                                        Max.Point: <?= $bobot_isian ?>
                                    </th>
                                <?php endif;
                                if ($tampil_esai != '0') :?>
                                    <th class="text-center align-middle">
                                        Nilai Essai<br>
                                        Max.Point: <?= $bobot_esai ?>
                                    </th>
                                <?php endif; ?>
                            </tr>
                            <?php
                            $no = 1;
                            $all_siswa = isset($is_rekap) ? $jadwal->rekapsiswa : $jadwal->sesisiswa;
                            foreach ($all_siswa as $val_siswa) :
                                $siswa = $val_siswa->siswa;
                                $peserta = isset($is_rekap) ? ($val_siswa->no_peserta ?? '-') : ($val_siswa->peserta->nomor_peserta ?? '-');
                                $idSiswa = $siswa->id_siswa;
                                ?>
                                <tr class="nilai" data-idsiswa="<?= $idSiswa ?>">
                                    <td class="text-center align-middle"> <?= $no ?> </td>
                                    <td class="text-center align-middle"> <?= $peserta ?> </td>
                                    <td class="align-middle"> <?= $siswa->nama ?> </td>
                                    <?php
                                    if (isset($val_siswa->nilai_akhir)) :
                                        $nilai = $val_siswa->nilai_akhir;
                                        if ($tampil_pg != '0') : ?>
                                            <td class="text-center text-success align-middle">
                                                <?= $nilai->pg_nilai ?? '' ?>
                                            </td>
                                        <?php endif;
                                        if ($tampil_kompleks != '0') :?>
                                            <td class="text-center text-success align-middle">
                                                <?php if (isset($nilai->skor_kompleks['skor_asli'])) :?>
                                                <div>
                                                    <span>Nilai Asal:</span>
                                                    <span class="text-bold"><?= $nilai->skor_kompleks['skor_asli'] ?? '' ?></span>
                                                </div>
                                                <input class="form-control npg2" name="input-pg2"
                                                       value="<?= $nilai->kompleks_nilai ?? '' ?>"
                                                       type="number" min="0"
                                                       max="<?= $bobot_kompleks ?>"
                                                       step="0.10"/>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif;
                                        if ($tampil_jodohkan != '0') :?>
                                            <td class="text-success align-middle">
                                                <?php if (isset($nilai->skor_jodohkan['skor_asli'])) :?>
                                                <div>
                                                    <span>Nilai Asal:</span>
                                                    <span class="text-bold"><?= $nilai->skor_jodohkan['skor_asli'] ?? '' ?></span>
                                                </div>
                                                <input class="form-control njodohkan" name="input-jodohkan"
                                                       value="<?= $nilai->jodohkan_nilai ?? '' ?>"
                                                       type="number" min="0"
                                                       max="<?= $bobot_jodohkan ?>"
                                                       step="0.10"/>
                                                       <?php endif; ?>
                                            </td>
                                        <?php endif;
                                        if ($tampil_isian != '0') :?>
                                            <td class="text-center text-success align-middle">
                                                <?php if (isset($nilai->skor_isian['skor_asli'])) :?>
                                                <div>
                                                    <span>Nilai Asal:</span>
                                                    <span class="text-bold"><?= $nilai->skor_isian['skor_asli'] ?? '' ?></span>
                                                </div>
                                                <input class="form-control nisian" name="input-isian"
                                                       value="<?= $nilai->isian_nilai ?? '' ?>"
                                                       type="number" min="0"
                                                       max="<?= $bobot_isian ?>"
                                                       step="0.10"/>
                                                       <?php endif; ?>
                                            </td>
                                        <?php endif;
                                        if ($tampil_esai != '0') :?>
                                            <td class="text-center text-success align-middle">
                                                <?php if (isset($nilai->skor_essai['skor_asli'])) :?>
                                                <div>
                                                    <span>Nilai Asal:</span>
                                                    <span class="text-bold"><?= $nilai->skor_essai['skor_asli'] ?></span>
                                                </div>
                                                <input class="form-control nessai" name="input-essai"
                                                       value="<?= $nilai->essai_nilai ?? '' ?>"
                                                       type="number" min="0"
                                                       max="<?= $bobot_esai ?>"
                                                       step="0.10"/>
                                                       <?php endif; ?>
                                            </td>
                                        <?php endif;
                                    else :?>
                                        <td colspan="<?=count($cols)?>" class="text-center align-middle">Belum mengerjakan</td>
                                    <?php endif ?>
                                </tr>
                                <?php $no++; endforeach; ?>
                        </table>
                    </div>
                    <button onclick="window.history.back();" type="button" class="btn btn-sm btn-danger float-right">
                        <i class="fas fa-arrow-circle-left"></i><span
                                class="d-none d-sm-inline-block ml-1">Kembali</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default my-shadow mb-4">
                <div class="card-body">
                    <?php
                    if (isset($is_rekap)) {
                        $cols = [$jadwal->bank_soal->tampil_pg, $jadwal->bank_soal->tampil_kompleks,
                            $jadwal->bank_soal->tampil_jodohkan, $jadwal->bank_soal->tampil_isian,
                            $jadwal->bank_soal->tampil_esai];
                    } else {
                        $cols = [$jadwal->bank->tampil_pg, $jadwal->bank->tampil_kompleks,
                            $jadwal->bank->tampil_jodohkan, $jadwal->bank->tampil_isian,
                            $jadwal->bank->tampil_esai];
                    }

                    $cols = array_filter($cols);
                    ?>
                    <div class="alert alert-default-danger">
                        <ul>
                            <li>
                                Halaman ini digunakan jika ingin menginput nilai tanpa koreksi.
                            </li>
                            <li>
                                <b>Nilai Pilihan Ganda</b> tidak bisa diinput manual.
                            </li>
                            <li>
                                Jika hasil siswa sudah dikoreksi dan diberi nilai, maka nilai di halaman ini akan
                                mengganti nilai hasil koreksi.
                            </li>
                            <li>
                                Nilai 0 di halaman ini tidak akan mengganti nilai hasil koreksi.
                            </li>
                        </ul>
                    </div>
                    <div class="alert alert-default-success border-success">
                        <h6><i class="icon fas fa-check"></i> Info Soal</h6>
                        <div class="row" id="info">
                            <div class="col-12 col-md-6 mb-2">
                                <table>
                                    <tr>
                                        <td>Jenis Penilaian</td>
                                        <td> :</td>
                                        <td><span class="text-bold"><?= $jadwal->jenis->nama_jenis ?? $jadwal->kode_jenis ?></span></td>
                                    </tr>
                                    <tr>
                                        <td>Mata Pelajaran</td>
                                        <td> :</td>
                                        <td><span class="text-bold"><?= $jadwal->bank->mapel->nama_mapel ?? $jadwal->nama_mapel ?></span></td>
                                    </tr>
                                    <tr>
                                        <td>Kelas</td>
                                        <td> :</td>
                                        <td><span class="text-bold"><?= $kelas->nama_kelas ?></span></td>
                                    </tr>
                                    <tr>
                                        <td>Pengampu</td>
                                        <td> :</td>
                                        <td><span class="text-bold"><?= $jadwal->bank->guru->nama_guru ?? $jadwal->nama_guru ?></span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12 col-md-6">
                                <table class="table table-bordered table-striped table-sm">
                                    <tr><td colspan="<?=count($cols)?>" class="text-center" style="border-color:black;">
                                            Jumlah Soal
                                        </td>
                                    </tr>
                                    <tr>
                                        <?php if ($tampil_pg != '0') : ?>
                                            <td class="text-center" style="border-color:black;">
                                                PG
                                            </td>
                                        <?php endif;
                                        if ($tampil_kompleks != '0') :?>
                                            <td class="text-center" style="border-color:black;">
                                                PGK
                                            </td>
                                        <?php endif;
                                        if ($tampil_jodohkan != '0') :?>
                                            <td class="text-center" style="border-color:black;">
                                                Jodohkan
                                            </td>
                                        <?php endif;
                                        if ($tampil_isian != '0') :?>
                                            <td class="text-center" style="border-color:black;">
                                                Isian
                                            </td>
                                        <?php endif;
                                        if ($tampil_esai != '0') :?>
                                            <td class="text-center" style="border-color:black;">
                                                Essai
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <?php if ($tampil_pg != '0') : ?>
                                            <td class="text-center" style="border-color:black;">
                                                <span class="text-bold"
                                                      style="font-size: 16pt"><?= $tampil_pg ?></span>
                                            </td>
                                        <?php endif;
                                        if ($tampil_kompleks != '0') :?>
                                            <td class="text-center" style="border-color:black;">
                                                <span class="text-bold"
                                                      style="font-size: 16pt"><?= $tampil_kompleks ?></span>
                                            </td>
                                        <?php endif;
                                        if ($tampil_jodohkan != '0') :?>
                                            <td class="text-center" style="border-color:black;">
                                                <span class="text-bold"
                                                      style="font-size: 16pt"><?= $tampil_jodohkan ?></span>
                                            </td>
                                        <?php endif;
                                        if ($tampil_isian != '0') :?>
                                            <td class="text-center" style="border-color:black;">
                                                <span class="text-bold"
                                                      style="font-size: 16pt"><?= $tampil_isian ?></span>
                                            </td>
                                        <?php endif;
                                        if ($tampil_esai != '0') :?>
                                            <td class="text-center" style="border-color:black;">
                                                <span class="text-bold"
                                                      style="font-size: 16pt"><?= $tampil_esai ?></span>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-sm w-100" id="table-essai">
                            <tr>
                                <th class="text-center align-middle">
                                    No.
                                </th>
                                <th class="text-center align-middle">
                                    No. Peserta
                                </th>
                                <th class="align-middle">
                                    Nama
                                </th>
                                <?php if ($tampil_pg != '0') : ?>
                                    <th class="text-center align-middle">
                                        Nilai PG<br>
                                        Max. Point: <?= $bobot_pg ?>
                                    </th>
                                <?php endif;
                                if ($tampil_kompleks != '0') :?>
                                    <th class="text-center align-middle">
                                        Nilai PG Kompleks<br>
                                        Max. Point: <?= $bobot_kompleks ?>
                                    </th>
                                <?php endif;
                                if ($tampil_jodohkan != '0') :?>
                                    <th class="text-center align-middle">
                                        Nilai Menjodohkan<br>
                                        Max. Point: <?= $bobot_jodohkan ?>
                                    </th>
                                <?php endif;
                                if ($tampil_isian != '0') :?>
                                    <th class="text-center align-middle">
                                        Nilai Isisan Singkat<br>
                                        Max.Point: <?= $bobot_isian ?>
                                    </th>
                                <?php endif;
                                if ($tampil_esai != '0') :?>
                                    <th class="text-center align-middle">
                                        Nilai Essai<br>
                                        Max.Point: <?= $bobot_esai ?>
                                    </th>
                                <?php endif; ?>
                            </tr>
                            <?php
                            $no = 1;
                            $all_siswa = isset($is_rekap) ? $jadwal->rekapsiswa : $jadwal->sesisiswa;
                            foreach ($all_siswa as $val_siswa) :
                                $siswa = $val_siswa->siswa;
                                $peserta = isset($is_rekap) ? ($val_siswa->no_peserta ?? '-') : ($val_siswa->peserta->nomor_peserta ?? '-');
                                $idSiswa = $siswa->id_siswa;
                                ?>
                                <tr class="nilai" data-idsiswa="<?= $idSiswa ?>">
                                    <td class="text-center align-middle"> <?= $no ?> </td>
                                    <td class="text-center align-middle"> <?= $peserta ?> </td>
                                    <td class="align-middle"> <?= $siswa->nama ?> </td>
                                    <?php
                                    if (isset($val_siswa->nilai_akhir)) :
                                        $nilai = $val_siswa->nilai_akhir;
                                        if ($tampil_pg != '0') : ?>
                                            <td class="text-center text-success align-middle">
                                                <?= $nilai->pg_nilai ?? '' ?>
                                            </td>
                                        <?php endif;
                                        if ($tampil_kompleks != '0') :?>
                                            <td class="text-center text-success align-middle">
                                                <?php if (isset($nilai->skor_kompleks['skor_asli'])) :?>
                                                <div>
                                                    <span>Nilai Asal:</span>
                                                    <span class="text-bold"><?= $nilai->skor_kompleks['skor_asli'] ?? '' ?></span>
                                                </div>
                                                <input class="form-control npg2" name="input-pg2"
                                                       value="<?= $nilai->kompleks_nilai ?? '' ?>"
                                                       type="number" min="0"
                                                       max="<?= $bobot_kompleks ?>"
                                                       step="0.10"/>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif;
                                        if ($tampil_jodohkan != '0') :?>
                                            <td class="text-success align-middle">
                                                <?php if (isset($nilai->skor_jodohkan['skor_asli'])) :?>
                                                <div>
                                                    <span>Nilai Asal:</span>
                                                    <span class="text-bold"><?= $nilai->skor_jodohkan['skor_asli'] ?? '' ?></span>
                                                </div>
                                                <input class="form-control njodohkan" name="input-jodohkan"
                                                       value="<?= $nilai->jodohkan_nilai ?? '' ?>"
                                                       type="number" min="0"
                                                       max="<?= $bobot_jodohkan ?>"
                                                       step="0.10"/>
                                                       <?php endif; ?>
                                            </td>
                                        <?php endif;
                                        if ($tampil_isian != '0') :?>
                                            <td class="text-center text-success align-middle">
                                                <?php if (isset($nilai->skor_isian['skor_asli'])) :?>
                                                <div>
                                                    <span>Nilai Asal:</span>
                                                    <span class="text-bold"><?= $nilai->skor_isian['skor_asli'] ?? '' ?></span>
                                                </div>
                                                <input class="form-control nisian" name="input-isian"
                                                       value="<?= $nilai->isian_nilai ?? '' ?>"
                                                       type="number" min="0"
                                                       max="<?= $bobot_isian ?>"
                                                       step="0.10"/>
                                                       <?php endif; ?>
                                            </td>
                                        <?php endif;
                                        if ($tampil_esai != '0') :?>
                                            <td class="text-center text-success align-middle">
                                                <?php if (isset($nilai->skor_essai['skor_asli'])) :?>
                                                <div>
                                                    <span>Nilai Asal:</span>
                                                    <span class="text-bold"><?= $nilai->skor_essai['skor_asli'] ?></span>
                                                </div>
                                                <input class="form-control nessai" name="input-essai"
                                                       value="<?= $nilai->essai_nilai ?? '' ?>"
                                                       type="number" min="0"
                                                       max="<?= $bobot_esai ?>"
                                                       step="0.10"/>
                                                       <?php endif; ?>
                                            </td>
                                        <?php endif;
                                    else :?>
                                        <td colspan="<?=count($cols)?>" class="text-center align-middle">Belum mengerjakan</td>
                                    <?php endif ?>
                                </tr>
                                <?php $no++; endforeach; ?>
                        </table>
                    </div>
                    <button id="essai" class="float-end btn btn-primary shadow-sm shadow-sm" onclick="simpan()"><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg><span class="d-none d-sm-inline-block ms-1">Simpan</span></button>
                </div>
                <div class="overlay d-none" id="loading">
                    <div class="spinner-grow"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= form_open('update', array('id' => 'koreksi')) ?>
<?= form_close() ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function simpan() {
        var loading = $(`#loading`);

        var maxpg2 = parseFloat(<?= $bobot_kompleks ?>) || 0;
        var maxjod = parseFloat(<?= $bobot_jodohkan ?>) || 0;
        var maxis = parseFloat(<?= $bobot_isian ?>) || 0;
        var maxes = parseFloat(<?= $bobot_esai ?>) || 0;

        var $nilai = $(`#table-essai`).find('.nilai');
        var json = [];
        let idsSiswa = [];
        $.each($nilai, function () {
            const npg2 = parseFloat($(this).find('.npg2').val()) || 0;
            const njod = parseFloat($(this).find('.njodohkan').val()) || 0;
            const nis = parseFloat($(this).find('.nisian').val()) || 0;
            const nes = parseFloat($(this).find('.nessai').val()) || 0;
            const id_siswa = $(this).data('idsiswa');
            idsSiswa.push(id_siswa);
            if (npg2 > maxpg2 || njod > maxjod || nis > maxis || nes > maxes) {
                showDangerToast("Point persoal tidak boleh melebihi nilai maksimal.");
                json = [];
                return false;
            }

            let item = {};
            item['id_siswa'] = id_siswa;
            item['id_jadwal'] = '<?= $jadwal->id_jadwal ?>';
            item['kompleks_nilai'] = npg2;
            item['jodohkan_nilai'] = njod;
            item['isian_nilai'] = nis;
            item['essai_nilai'] = nes;
            json.push(item);
        });

        let dataPost = new FormData($('#koreksi')[0])
        dataPost.append('jadwal', <?=$jadwal->id_jadwal?>)
        dataPost.append('bank_soal', <?=$jadwal->id_bank ?>)
        dataPost.append('nilai', JSON.stringify(json))
        dataPost.append('id_siswa', JSON.stringify(idsSiswa))

        if (json.length > 0) {
            loading.removeClass('d-none');
            swal.fire({
                text: "Silahkan tunggu....",
                allowEscapeKey: false,
                allowOutsideClick: false,
                onOpen: () => {
                    swal.showLoading();
                }
            });
            $.ajax({
                url: base_url + "cbtnilai/simpannilaiinput",
                type: "POST",
                data: dataPost,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data);
                    if (data.success > 0) {
                        swal.fire({
                            title: "Berhasil",
                            text: "Nilai berhasil disimapn",
                            icon: "success"
                        }).then(result => {
                            if (result.value) {
                                window.location.reload();
                            }
                        });
                    } else {
                        loading.addClass('d-none');
                        swal.fire({
                            title: "Gagal",
                            text: 'Tidak ada nilai yang disimpan',
                            icon: "error"
                        });
                    }
                }, error: function (xhr, status, error) {
                    loading.addClass('d-none');
                    console.log("error", xhr.responseText);
                    const err = JSON.parse(xhr.responseText)
                    swal.fire({
                        title: "Error",
                        text: err.Message,
                        icon: "error"
                    });
                }
            });
        }
    }
</script>
<?= $this->endSection() ?>

