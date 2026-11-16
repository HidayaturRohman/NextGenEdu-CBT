<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row mb-3">
        <div class="col-sm-6">
            <h3 class="fw-bold text-white"><?= $judul ?></h3>
        </div>
        <div class="col-sm-6 text-end">
            <button onclick="window.history.back();" type="button" class="btn btn-sm btn-light shadow-sm">
                <svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                Kembali
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <td class="fw-bold" style="width: 120px">Nama</td>
                                    <td>: <?= $siswa->nama ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">N I S</td>
                                    <td>: <?= $siswa->nis ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Kelas</td>
                                    <td>: <?= $siswa->nama_kelas ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">No. Peserta</td>
                                    <td>: <?= $siswa->nomor_peserta ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Sesi</td>
                                    <td>: <?= $siswa->kode_sesi ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-5 mb-3">
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <td class="fw-bold" style="width: 130px">Ruang</td>
                                    <td>: <?= $siswa->kode_ruang ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Mata Pelajaran</td>
                                    <td>: <?= $info->kode ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Guru</td>
                                    <td>: <?= $info->nama_guru ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Jenis Ujian</td>
                                    <td>: <?= $info->kode_jenis ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Tahun Pelajaran</td>
                                    <td>: <?= isset($tp_active) ? $tp_active->tahun : "--/--" ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="p-3 bg-light rounded shadow-sm border mb-2">
                                <div class="fw-bold text-secondary">NILAI TOTAL</div>
                                <h1 class="fw-bold text-primary mb-0"><?= round($skor->skor_total ?? 0, 2) ?></h1>
                                <small class="badge bg-<?= isset($skor->dikoreksi) && $skor->dikoreksi ? 'success' : 'warning' ?> mt-1">
                                    <?= isset($skor->dikoreksi) && $skor->dikoreksi ? "Sudah dikoreksi" : "Belum dikoreksi" ?>
                                </small>
                            </div>
                            <button class="btn btn-sm btn-success w-100 shadow-sm" id="btn-marked">
                                <i class="fa fa-check-circle me-1"></i>Tandai Sudah Dikoreksi
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="konten-soal">
                <?php if (isset($soal[1]) && count($soal[1]) > 0 && $info->bobot_pg > 0) : ?>
                    <div class="card shadow-sm mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0 fw-bold">I. PILIHAN GANDA</h4>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info" role="alert">
                                <ul class="mb-0">
                                    <li>Bobot soal: <b><?= $info->bobot_pg ?></b>. Jumlah soal: <b><?= $info->tampil_pg ?></b>. Max point persoal: <b><?= round($info->bobot_pg / $info->tampil_pg, 2) ?></b>.</li>
                                    <li>Point soal PG tidak bisa diedit</li>
                                </ul>
                            </div>
                            <div class="table-responsive">
                                <table id="table-pg" class="w-100 table table-striped table-bordered border-success nowrap">
                                    <thead>
                                    <tr>
                                        <th class="text-center align-middle bg-primary text-white" style="width: 50px">No. Soal</th>
                                        <th class="text-center align-middle bg-primary text-white">Soal</th>
                                        <th class="text-center align-middle bg-primary text-white">Pilihan</th>
                                        <th class="text-center align-middle bg-primary text-white" style="width: 50px">Jawaban Benar</th>
                                        <th class="text-center align-middle bg-info text-white" style="width: 50px">Jawaban Siswa</th>
                                        <th class="text-center align-middle bg-info text-white" style="width: 50px">Analisa</th>
                                        <th class="text-center align-middle bg-info text-white" style="width: 50px">Point<br>Max. <?= round($info->bobot_pg / $info->tampil_pg, 2) ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $ns = 1;
                                    foreach ($soal[1] as $s) :
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $ns ?></td>
                                            <td><?= $s->soal ?></td>
                                            <td>
                                                <ol type="A">
                                                    <li><?= $s->opsi_a ?></li>
                                                    <li><?= $s->opsi_b ?></li>
                                                    <?php if ($info->opsi == 3) : ?>
                                                        <li><?= $s->opsi_c ?></li>
                                                    <?php elseif ($info->opsi == 4) : ?>
                                                        <li><?= $s->opsi_c ?></li>
                                                        <li><?= $s->opsi_d ?></li>
                                                    <?php else : ?>
                                                        <li><?= $s->opsi_c ?></li>
                                                        <li><?= $s->opsi_d ?></li>
                                                        <li><?= $s->opsi_e ?></li>
                                                    <?php endif; ?>
                                                </ol>
                                            </td>
                                            <td class="text-center"><?= strtoupper($s->jawaban ?? '') ?></td>
                                            <td class="text-center"><?= strtoupper($s->jawaban_siswa ?? '') ?></td>
                                            <td class="text-center"><?= $s->analisa ?></td>
                                            <td class="text-center"><?= $s->point ?></td>
                                        </tr>
                                        <?php $ns++; endforeach; ?>
                                    <tr>
                                        <td colspan="6" class="text-end fw-bold">TOTAL SCORE PILIHAN GANDA</td>
                                        <td class="text-center fw-bold"><?= round($skor->skor_pg ?? 0, 2) ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (isset($soal[2]) && count($soal[2]) > 0 && $info->bobot_kompleks > 0) : ?>
                    <div class="card shadow-sm mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0 fw-bold">II. PILIHAN GANDA KOMPLEKS</h4>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info" role="alert">
                                <ul class="mb-0">
                                    <li>Bobot soal: <b><?= $info->bobot_kompleks ?></b>. Jumlah soal: <b><?= $info->tampil_kompleks ?></b>. Max point persoal: <b><?= round($info->bobot_kompleks / $info->tampil_kompleks, 2) ?></b>.</li>
                                    <li>Point soal PG Kompleks bisa diedit</li>
                                    <li>Klik <i class="fa fa-pencil"></i> untuk mengedit point. Klik <i class="fa fa-undo"></i> untuk mengembalikan ke point otomatis</li>
                                    <li>Klik tombol <b>SIMPAN</b> untuk menyimpan perubahan point</li>
                                </ul>
                            </div>
                            <div class="table-responsive">
                                <table id="table-pg2" class="w-100 table table-striped table-bordered border-success nowrap">
                                    <thead>
                                    <tr>
                                        <th class="text-center align-middle bg-primary text-white" style="width: 50px">No. Soal</th>
                                        <th class="text-center align-middle bg-primary text-white">Soal</th>
                                        <th class="text-center align-middle bg-primary text-white">Pilihan</th>
                                        <th class="text-center align-middle bg-primary text-white" style="width: 100px">Jawaban Benar</th>
                                        <th class="text-center align-middle bg-info text-white" style="width: 100px">Jawaban Siswa</th>
                                        <th class="text-center align-middle bg-info text-white" style="width: 50px">Analisa</th>
                                        <th class="text-center align-middle bg-info text-white" style="width: 80px">Point<br>Max. <?= round($info->bobot_kompleks / $info->tampil_kompleks, 2) ?></th>
                                        <th class="text-center align-middle bg-info text-white" style="width: 80px">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $ns = 1;
                                    foreach ($soal[2] as $s) :?>
                                        <tr>
                                            <td class="text-center"><?= $ns ?></td>
                                            <td><?= $s->soal ?></td>
                                            <td>
                                                <ol type="A">
                                                    <?php foreach ($s->opsi_a as $abc => $opsi) : ?>
                                                        <li><?= $opsi ?></li>
                                                    <?php endforeach; ?>
                                                </ol>
                                            </td>
                                            <td class="text-center"><?= strtoupper(implode(", ", $s->jawaban_benar ?? [''])) ?></td>
                                            <td class="text-center"><?= $s->jawaban_siswa ? strtoupper(implode(", ", $s->jawaban_siswa ?? '')) : '' ?></td>
                                            <td class="text-center"><?= $s->analisa ?></td>
                                            <td class="text-center">
                                                <input id="input<?= $s->id_soal_siswa ?>" name="input<?= $s->id_soal_siswa ?>" value="<?= $s->point ?>" type="number" min="0" max="<?= round($info->bobot_kompleks / $info->tampil_kompleks, 2) ?>" step="0.1" style="width: 100%; display: none"/>
                                                <span class="pg2" data-idsoal="<?= $s->id_soal_siswa ?>" id="span<?= $s->id_soal_siswa ?>"><?= $s->point ?></span>
                                            </td>
                                            <td>
                                                <button id="edit<?= $s->id_soal_siswa ?>" type="button" class="btn btn-sm btn-outline-primary" onclick="edit(<?= $s->id_soal_siswa ?>)"><i class="fa fa-pencil"></i></button>
                                                <button id="undo<?= $s->id_soal_siswa ?>" type="button" class="btn btn-sm btn-outline-secondary" onclick="undo(<?= $s->id_soal_siswa ?>, <?= $s->point_otomatis ?? 0 ?>)"><i class="fa fa-undo"></i></button>
                                            </td>
                                        </tr>
                                        <?php $ns++; endforeach; ?>
                                    <tr>
                                        <td colspan="6" class="text-end fw-bold">TOTAL SCORE PILIHAN GANDA KOMPLEKS</td>
                                        <td class="text-center fw-bold"><?= round($skor->skor_kompleks ?? 0, 2) ?></td>
                                        <td>
                                            <button id="pg2" data-max="<?= round($info->bobot_kompleks / $info->tampil_kompleks, 2) ?>" class="btn btn-sm btn-primary shadow-sm" onclick="simpan(this)">
                                                <i class="fa fa-save me-1"></i>Simpan
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (isset($soal[3]) && count($soal[3]) > 0 && $info->bobot_jodohkan > 0) : ?>
                    <div class="card shadow-sm mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0 fw-bold">III. MENJODOHKAN</h4>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info" role="alert">
                                <ul class="mb-0">
                                    <li>Bobot soal: <b><?= $info->bobot_jodohkan ?></b>. Jumlah soal: <b><?= $info->tampil_jodohkan ?></b>. Max point persoal: <b><?= round($info->bobot_jodohkan / $info->tampil_jodohkan, 2) ?></b>.</li>
                                    <li>Point soal menjodohkan bisa diedit</li>
                                    <li>Klik <i class="fa fa-pencil"></i> untuk mengedit point. Klik <i class="fa fa-undo"></i> untuk mengembalikan ke point otomatis</li>
                                    <li>Klik tombol <b>SIMPAN</b> untuk menyimpan perubahan point</li>
                                </ul>
                            </div>
                            <div class="table-responsive">
                                <table id="table-jodohkan" class="w-100 table table-striped table-bordered border-success nowrap">
                                    <thead>
                                    <tr>
                                        <th class="text-center align-middle bg-primary text-white" style="width: 50px">No. Soal</th>
                                        <th class="text-center align-middle bg-primary text-white">Soal</th>
                                        <th class="text-center align-middle bg-primary text-white">Jawaban Benar</th>
                                        <th class="text-center align-middle bg-info text-white">Jawaban Siswa</th>
                                        <th class="text-center align-middle bg-info text-white" style="width: 50px">Analisa</th>
                                        <th class="text-center align-middle bg-info text-white" style="width: 80px">Point<br>Max. <?= round($info->bobot_jodohkan / $info->tampil_jodohkan, 2) ?></th>
                                        <th class="text-center align-middle bg-info text-white" style="width: 80px">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $ns = 1;
                                    foreach ($soal[3] as $s) :
                                        $rows = count($s->tabel_soal ?? []);
                                        ?>
                                        <tr>
                                            <td class="text-center" rowspan="<?=$rows?>"><?= $ns ?></td>
                                            <td rowspan="<?=$rows?>"><?= $s->soal ?></td>
                                            <td>
                                                <?php
                                                $jwb = $s->tabel_soal[0] ?? (object)[];
                                                if (($s->type_soal ?? '1') == '1') :?>
                                                    <span><?= $jwb->title ?? '' ?></span>
                                                    <?php if (isset($jwb->subtitle)) : ?>
                                                        <ul>
                                                            <?php foreach ($jwb->subtitle as $sub) : ?>
                                                                <li><?= $sub ?></li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    <?php endif; ?>
                                                <?php else:?>
                                                    <p><?= $jwb->title ?? '' ?><br><?= isset($jwb->subtitle) ? $jwb->subtitle[0] : '' ?></p>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php
                                                $jwb = isset($s->tabel_jawab[0]) ? $s->tabel_jawab[0] : (object)[];
                                                if (($s->type_soal ?? '1') == '1') :?>
                                                    <span><?= $jwb->title ?? '' ?></span>
                                                    <?php if (isset($jwb->subtitle)) : ?>
                                                        <ul>
                                                            <?php foreach ($jwb->subtitle as $sub) : ?>
                                                                <li><?= $sub ?></li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    <?php endif; ?>
                                                <?php else:?>
                                                    <p><?= $jwb->title ?? '' ?><br><?= isset($jwb->subtitle) ? $jwb->subtitle[0] : '--' ?></p>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center" rowspan="<?=$rows?>"><?= $s->analisa ?></td>
                                            <td class="text-center" rowspan="<?=$rows?>">
                                                <input id="input<?= $s->id_soal_siswa ?>" name="input<?= $s->id_soal_siswa ?>" value="<?= $s->point ?>" type="number" min="0" max="<?= round($info->bobot_jodohkan / $info->tampil_jodohkan, 2) ?>" step="0.10" style="width: 100%; display: none"/>
                                                <span class="jodohkan" data-idsoal="<?= $s->id_soal_siswa ?>" id="span<?= $s->id_soal_siswa ?>"><?= $s->point ?></span>
                                            </td>
                                            <td rowspan="<?=$rows?>">
                                                <button id="edit<?= $s->id_soal_siswa ?>" type="button" class="btn btn-sm btn-outline-primary" onclick="edit(<?= $s->id_soal_siswa ?>)"><i class="fa fa-pencil"></i></button>
                                                <button id="undo<?= $s->id_soal_siswa ?>" type="button" class="btn btn-sm btn-outline-secondary" onclick="undo(<?= $s->id_soal_siswa ?>, <?= $s->point_otomatis ?? 0 ?>)"><i class="fa fa-undo"></i></button>
                                            </td>
                                        </tr>
                                        <?php for ($t = 1, $tMax = count($s->tabel_soal ?? []); $t < $tMax; $t++):?>
                                        <tr>
                                            <td>
                                                <?php
                                                $jwb = $s->tabel_soal[$t] ?? (object)[];
                                                if (($s->type_soal ?? '1') == '1') : ?>
                                                    <span><?= $jwb->title ?? '' ?></span>
                                                    <?php if (isset($jwb->subtitle)) : ?>
                                                        <ul>
                                                            <?php foreach ($jwb->subtitle as $sub) : ?>
                                                                <li><?= $sub ?></li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <p><?= $jwb->title ?? '' ?><br><?= isset($jwb->subtitle) ? $jwb->subtitle[0] : '' ?></p>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php
                                                $jwb = $s->tabel_jawab[$t] ?? (object)[];
                                                if (($s->type_soal ?? '1') == '1') : ?>
                                                    <span><?= $jwb->title ?? '' ?></span>
                                                    <?php if (isset($jwb->subtitle)) : ?>
                                                        <ul>
                                                            <?php foreach ($jwb->subtitle as $sub) : ?>
                                                                <li><?= $sub ?></li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <p><?= $jwb->title ?? '' ?><br><?= isset($jwb->subtitle) ? $jwb->subtitle[0] : '--' ?></p>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endfor; ?>
                                        <?php $ns++; endforeach; ?>
                                    <tr>
                                        <td colspan="5" class="text-end fw-bold">TOTAL SCORE MENJODOHKAN</td>
                                        <td class="text-center fw-bold"><?= round($skor->skor_jodohkan ?? 0, 2) ?></td>
                                        <td>
                                            <button id="jodohkan" data-max="<?= round($info->bobot_jodohkan / $info->tampil_jodohkan, 2) ?>" class="btn btn-sm btn-primary shadow-sm" onclick="simpan(this)">
                                                <i class="fa fa-save me-1"></i>Simpan
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (isset($soal[4]) && count($soal[4]) > 0 && $info->bobot_isian > 0) : ?>
                    <div class="card shadow-sm mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0 fw-bold">IV. ISIAN SINGKAT</h4>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info" role="alert">
                                <ul class="mb-0">
                                    <li>Bobot soal: <b><?= $info->bobot_isian ?></b>. Jumlah soal: <b><?= $info->tampil_isian ?></b>. Max point persoal: <b><?= round($info->bobot_isian / $info->tampil_isian, 2) ?></b>.</li>
                                    <li>Point soal isian singkat bisa diedit</li>
                                    <li>Klik <i class="fa fa-pencil"></i> untuk mengedit point. Klik <i class="fa fa-undo"></i> untuk mengembalikan ke point otomatis</li>
                                    <li>Klik tombol <b>SIMPAN</b> untuk menyimpan perubahan point</li>
                                </ul>
                            </div>
                            <div class="table-responsive">
                                <table id="table-isian" class="w-100 table table-striped table-bordered border-success nowrap">
                                    <thead>
                                    <tr>
                                        <th class="text-center align-middle bg-primary text-white" style="width: 50px">No. Soal</th>
                                        <th class="text-center align-middle bg-primary text-white">Soal</th>
                                        <th class="text-center align-middle bg-primary text-white" style="width: 150px">Jawaban Benar</th>
                                        <th class="text-center align-middle bg-info text-white" style="width: 150px">Jawaban Siswa</th>
                                        <th class="text-center align-middle bg-info text-white" style="width: 50px">Analisa</th>
                                        <th class="text-center align-middle bg-info text-white" style="width: 80px">Point<br>Max. <?= round($info->bobot_isian / $info->tampil_isian, 2) ?></th>
                                        <th class="text-center align-middle bg-info text-white" style="width: 80px">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $ns = 1;
                                    foreach ($soal[4] as $s) :?>
                                        <tr>
                                            <td class="text-center"><?= $ns ?></td>
                                            <td><?= $s->soal ?></td>
                                            <td class="text-center"><?= $s->jawaban_benar ?></td>
                                            <td class="text-center"><?= $s->jawaban_siswa ?></td>
                                            <td class="text-center"><?= $s->analisa ?></td>
                                            <td class="text-center">
                                                <input id="input<?= $s->id_soal_siswa ?>" name="input<?= $s->id_soal_siswa ?>" value="<?= $s->point ?>" type="number" min="0" max="<?= round($info->bobot_isian / $info->tampil_isian, 2) ?>" step="0.1" style="width: 100%; display: none"/>
                                                <span class="isian" data-idsoal="<?= $s->id_soal_siswa ?>" id="span<?= $s->id_soal_siswa ?>"><?= $s->point ?></span>
                                            </td>
                                            <td>
                                                <button id="edit<?= $s->id_soal_siswa ?>" type="button" class="btn btn-sm btn-outline-primary" onclick="edit(<?= $s->id_soal_siswa ?>)"><i class="fa fa-pencil"></i></button>
                                                <button id="undo<?= $s->id_soal_siswa ?>" type="button" class="btn btn-sm btn-outline-secondary" onclick="undo(<?= $s->id_soal_siswa ?>, <?= $s->point_otomatis ?? 0 ?>)"><i class="fa fa-undo"></i></button>
                                            </td>
                                        </tr>
                                        <?php $ns++; endforeach; ?>
                                    <tr>
                                        <td colspan="5" class="text-end fw-bold">TOTAL SCORE ISIAN SINGKAT</td>
                                        <td class="text-center fw-bold"><?= round($skor->skor_isian ?? 0, 2) ?></td>
                                        <td>
                                            <button id="isian" data-max="<?= round($info->bobot_isian / $info->tampil_isian, 2) ?>" class="btn btn-sm btn-primary shadow-sm" onclick="simpan(this)">
                                                <i class="fa fa-save me-1"></i>Simpan
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (isset($soal[5]) && count($soal[5]) > 0 && $info->bobot_esai > 0) : ?>
                    <div class="card shadow-sm mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0 fw-bold">V. URAIAN</h4>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info" role="alert">
                                <ul class="mb-0">
                                    <li>Bobot soal: <b><?= $info->bobot_esai ?></b>. Jumlah soal: <b><?= $info->tampil_esai ?></b>. Max point persoal: <b><?= round($info->bobot_esai / $info->tampil_esai) ?></b>.</li>
                                    <li>Point soal uraian bisa diedit</li>
                                    <li>Klik <i class="fa fa-pencil"></i> untuk mengedit point. Klik <i class="fa fa-undo"></i> untuk mengembalikan ke point otomatis</li>
                                    <li>Klik tombol <b>SIMPAN</b> untuk menyimpan perubahan point</li>
                                </ul>
                            </div>
                            <div class="table-responsive">
                                <table id="table-essai" class="w-100 table table-striped table-bordered border-success nowrap">
                                    <thead>
                                    <tr>
                                        <th class="text-center align-middle bg-primary text-white" style="width: 50px">No. Soal</th>
                                        <th class="text-center align-middle bg-primary text-white">Soal</th>
                                        <th class="text-center align-middle bg-primary text-white" style="width: 150px">Jawaban Benar</th>
                                        <th class="text-center align-middle bg-info text-white" style="width: 150px">Jawaban Siswa</th>
                                        <th class="text-center align-middle bg-info text-white" style="width: 50px">Analisa</th>
                                        <th class="text-center align-middle bg-info text-white" style="width: 80px">Point<br>Max. <?= round($info->bobot_esai / $info->tampil_esai) ?></th>
                                        <th class="text-center align-middle bg-info text-white" style="width: 80px">Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $ns = 1;
                                    foreach ($soal[5] as $s) :?>
                                        <tr>
                                            <td class="text-center"><?= $ns ?></td>
                                            <td><?= $s->soal ?></td>
                                            <td class="text-center"><?= $s->jawaban_benar ?></td>
                                            <td class="text-center"><?= $s->jawaban_siswa ?></td>
                                            <td class="text-center"><?= $s->analisa ?></td>
                                            <td class="text-center">
                                                <input id="input<?= $s->id_soal_siswa ?>" name="input<?= $s->id_soal_siswa ?>" value="<?= $s->point ?>" type="number" min="0" max="<?= round($info->bobot_esai / $info->tampil_esai) ?>" step="0.1" style="width: 100%; display: none"/>
                                                <span class="essai" data-idsoal="<?= $s->id_soal_siswa ?>" id="span<?= $s->id_soal_siswa ?>"><?= $s->point ?></span>
                                            </td>
                                            <td>
                                                <button id="edit<?= $s->id_soal_siswa ?>" type="button" class="btn btn-sm btn-outline-primary" onclick="edit(<?= $s->id_soal_siswa ?>)"><i class="fa fa-pencil"></i></button>
                                                <button id="undo<?= $s->id_soal_siswa ?>" type="button" class="btn btn-sm btn-outline-secondary" onclick="undo(<?= $s->id_soal_siswa ?>, <?= $s->point_otomatis ?? 0 ?>)"><i class="fa fa-undo"></i></button>
                                            </td>
                                        </tr>
                                        <?php $ns++; endforeach; ?>
                                    <tr>
                                        <td colspan="5" class="text-end fw-bold">TOTAL SCORE URAIAN</td>
                                        <td class="text-center fw-bold"><?= round($skor->skor_essai ?? 0, 2) ?></td>
                                        <td>
                                            <button id="essai" data-max="<?= round($info->bobot_esai / $info->tampil_esai) ?>" class="btn btn-sm btn-primary shadow-sm" onclick="simpan(this)">
                                                <i class="fa fa-save me-1"></i>Simpan
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<form id="koreksi"></form>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function edit(id) {
        var input = $(`#input${id}`);
        var span = $(`#span${id}`);
        var btnedit = $(`#edit${id}`);

        if (input.is(":visible")) {
            input.hide();
            span.text(input.val()).show();
            btnedit.html(`<i class="fa fa-pencil"></i>`);
        } else {
            span.hide();
            input.val(span.text()).show();
            btnedit.html(`<i class="fa fa-check"></i>`);
        }
    }

    function undo(id, nilai) {
        var input = $(`#input${id}`);
        var span = $(`#span${id}`);
        input.val(nilai);
        span.text(nilai);
    }

    function simpan(btn) {
        var id = $(btn).attr('id');
        var key;
        if (id === 'pg') {
            key = 'pg_nilai';
        } else if (id === 'pg2') {
            key = 'kompleks_nilai';
        } else if (id === 'jodohkan') {
            key = 'jodohkan_nilai';
        } else if (id === 'isian') {
            key = 'isian_nilai';
        } else if (id === 'essai') {
            key = 'essai_nilai';
        }

        var loading = $(`#loading-${id}`);
        var max = parseFloat($(btn).data('max')) || 0;
        var $nilai = $(`#table-${id}`).find(`.${id}`);
        var json = [];
        $.each($nilai, function () {
            var n = parseFloat($(this).text().trim()) || 0;
            if (n > max) {
                Swal.fire({icon: 'warning', text: "Point persoal tidak boleh melebihi " + max});
                json = [];
                return false;
            }
            if ($(this).is(":hidden")) {
                Swal.fire({icon: 'info', text: "Klik tombol centang dulu pada baris yang diedit"});
                json = [];
                return false;
            }

            var item = {};
            item['id_soal'] = $(this).data('idsoal');
            item['koreksi'] = $(this).text();
            json.push(item);
        });

        var dataPost = $('#koreksi').serialize() + '&siswa=<?=$siswa->id_siswa?>&jadwal=<?=$info->id_jadwal?>&jenis=' + key +
            '&nilai=' + JSON.stringify(json);

        if (json.length > 0) {
            Swal.fire({
                text: "Silahkan tunggu....",
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: base_url + "cbtnilai/simpankoreksi",
                type: "POST",
                data: dataPost,
                success: function (data) {
                    if (data.success) {
                        Swal.fire({
                            title: "Berhasil",
                            text: "Nilai berhasil disimpan",
                            icon: "success"
                        }).then(result => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: "Gagal",
                            text: data.message || 'Gagal menyimpan nilai',
                            icon: "error"
                        });
                    }
                }, error: function (xhr) {
                    Swal.fire({
                        title: "Error",
                        text: "Terjadi kesalahan sistem",
                        icon: "error"
                    });
                }
            });
        }
    }

    $(document).ready(function () {
        $('#btn-marked').on('click', function () {
            $(this).prop('disabled', true);
            var dataPost = $('#koreksi').serialize() + '&siswa=<?=$siswa->id_siswa?>&jadwal=<?=$info->id_jadwal?>';
            
            Swal.fire({
                text: "Silahkan tunggu....",
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: base_url + "cbtnilai/tandaikoreksi",
                type: "POST",
                data: dataPost,
                success: function (data) {
                    $('#btn-marked').prop('disabled', false);
                    if (data.success) {
                        Swal.fire({
                            title: "Berhasil",
                            text: "Jawaban berhasil ditandai",
                            icon: "success"
                        }).then(result => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: "Gagal",
                            text: 'Tidak bisa menandai',
                            icon: "error"
                        });
                    }
                }, error: function (xhr) {
                    $('#btn-marked').prop('disabled', false);
                    Swal.fire({
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
