<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hidayatur Rohman
 * Date: 14/07/20
 * Time: 17:46
 */

$pg_belum_komplit = [];
$pg2_belum_komplit = [];
$jodohkan_belum_komplit = [];
$isian_belum_komplit = [];
$essai_belum_komplit = [];

foreach ($soal_belum_komplit as $key => $value) {
    if ($value->jenis == '1') {
        $pg_belum_komplit[] = $value->nomor_soal;
    } elseif ($value->jenis == '2') {
        $pg2_belum_komplit[] = $value->nomor_soal;
    } elseif ($value->jenis == '3') {
        $jodohkan_belum_komplit[] = $value->nomor_soal;
    } elseif ($value->jenis == '4') {
        $isian_belum_komplit[] = $value->nomor_soal;
    } else {
        $essai_belum_komplit[] = $value->nomor_soal;
    }
}

$soal_pg_ada = [];
$soal_pg2_ada = [];
$soal_jodohkan_ada = [];
$soal_isian_ada = [];
$soal_esai_ada = [];

foreach ($soal_ada as $key => $value) {
    if ($value->jenis == '1') {
        $soal_pg_ada[] = $value->nomor_soal;
    } elseif ($value->jenis == '2') {
        $soal_pg2_ada[] = $value->nomor_soal;
    } elseif ($value->jenis == '3') {
        $soal_jodohkan_ada[] = $value->nomor_soal;
    } elseif ($value->jenis == '4') {
        $soal_isian_ada[] = $value->nomor_soal;
    } else {
        $soal_esai_ada[] = $value->nomor_soal;
    }
}
?>

<div class="d-contents">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
              <div class="me-3 flex-shrink-0">
                <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: #ffffff;">
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
                    <?= $judul ?> - Buat & Edit Butir Soal
                </h4>
                <p class="text-muted mb-0" style="font-size: 0.9rem;">Penyuntingan butir soal, pembuatan opsi pilihan ganda, jawaban singkat, dan kunci jawaban.</p>
              </div>
            </div>
            <div>
                <button onclick="window.history.back();" type="button" class="btn btn-sm btn-dark px-3 shadow-sm">
                    <i class="fas fa-arrow-circle-left"></i><span class="d-none d-sm-inline-block ms-1">Kembali</span>
                </button>
            </div>
        </div>
      </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card my-shadow">
                <div class="card-body">
                    <div class="row">
                        <h6 class="col-md-6"><b>Bank
                                Soal:</b> <?= $bank->bank_kode . ' | PG: ' . $bank->tampil_pg . ', Essai: ' . $bank->tampil_esai ?></h6><div class="col-md-6 text-md-end mt-2 mt-md-0"><button type="button" onclick="bukaModalGeminiSoal()" class="btn btn-sm text-white fw-bold px-3 shadow-sm" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 50%, #2563eb 100%); border: none; border-radius: 8px;"><i class="fas fa-magic me-1"></i> Bantu Buat Soal dengan Gemini AI</button></div><h6>
                        </h6>
                    </div>
                </div>
            </div>
            <?= form_open('create', array('id' => 'create')) ?>
            <div class="card my-shadow">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link <?= $tab_active == '1' ? 'active' : '' ?>"
                                                href="<?= base_url('cbtbanksoal/buatsoal/' . $bank->id_bank . '?tab=1') ?>">Pilihan
                                Ganda</a></li>
                        <li class="nav-item"><a class="nav-link <?= $tab_active == '2' ? 'active' : '' ?>"
                                                href="<?= base_url('cbtbanksoal/buatsoal/' . $bank->id_bank . '?tab=2') ?>">Pilihan
                                Ganda Kompleks</a></li>
                        <li class="nav-item"><a class="nav-link <?= $tab_active == '3' ? 'active' : '' ?>"
                                                href="<?= base_url('cbtbanksoal/buatsoal/' . $bank->id_bank . '?tab=3') ?>">Menjodohkan</a>
                        </li>
                        <li class="nav-item"><a class="nav-link <?= $tab_active == '4' ? 'active' : '' ?>"
                                                href="<?= base_url('cbtbanksoal/buatsoal/' . $bank->id_bank . '?tab=4') ?>">Isian
                                Singkat</a></li>
                        <li class="nav-item"><a class="nav-link <?= $tab_active == '5' ? 'active' : '' ?>"
                                                href="<?= base_url('cbtbanksoal/buatsoal/' . $bank->id_bank . '?tab=5') ?>">Essai/Uraian</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <input type="hidden" id="jenis-id" name="jenis" value="1" class="form-control">
                    <input type="hidden" id="bank-id" name="bank_id" value="<?= $bank->id_bank ?>" class="form-control">
                    <input type="hidden" id="soal-id" name="soal_id"
                           value="<?= is_null($soal) ? '0' : $soal->id_soal ?>" class="form-control">
                    <input type="hidden" id="method" name="method" value="<?= is_null($soal) ? 'add' : 'edit' ?>"
                           class="form-control">

                    <div class="tab-content">
                        <div class="tab-pane  <?= $tab_active == '1' ? 'active' : '' ?>" id="ganda">
                            <div class="alert alert-success align-content-center" role="alert">
                                Pilihan Ganda, jumlah soal seharusnya: <b><?= $bank->tampil_pg ?></b>
                            </div>
                            <span><b>PG NOMOR: </b></span><br>
                            <?php
                            $no = 1;
                            $tpg = !isset($jml_pg) || $jml_pg == null || $jml_pg->nomor_soal == null ? 0 : $jml_pg->nomor_soal;
                            for ($i = 0; $i < $tpg; $i++) : ?>
                                <a href="javascript:void(0)"
                                   class="mt-1 btn btn-circle-sm <?= !in_array($no, $pg_belum_komplit) ? 'btn-success' : 'btn-outline-danger' ?> <?= is_null($soal) ? ($no == 1 ? 'active' : '') : ($no == $soal->nomor_soal ? 'active' : '') ?>"
                                   onclick="getSoalById(<?= $bank->id_bank ?>, <?= $no ?>, <?= '1' . $no ?>, '1')"
                                   id="btn-<?= '1' . $no ?>"><?= $no ?>
                                </a>
                                <?php
                                $no++;
                            endfor; ?>
                            <a href="javascript:void(0)" class="pt-1 btn btn-oval-sm btn-outline-success"
                               data-mapel="<?= $bank->bank_mapel_id ?>" data-bank="<?= $bank->id_bank ?>"
                               data-nomor="<?= $no ?>" onclick="tambahSoalPg(this)" id="btn-add-new-pg"><i
                                        class="fa fa-plus"></i> Tambah PG</a>
                        </div>
                        <div class="tab-pane <?= $tab_active == '2' ? 'active' : '' ?>" id="kompleks">
                            <div class="alert alert-success align-content-center" role="alert">
                                Pilihan Ganda Kompleks, jumlah soal seharusnya: <b><?= $bank->tampil_kompleks ?></b>
                            </div>
                            <span><b>SOAL NOMOR: </b></span><br>
                            <?php

                            $tpg2 = !isset($jml_pg2) || $jml_pg2 == null || $jml_pg2->nomor_soal == null ? 0 : $jml_pg2->nomor_soal;
                            $no2 = 1;
                            for ($i = 0; $i < $tpg2; $i++) : ?>
                                <a href="javascript:void(0)"
                                   class="mt-1 btn btn-circle-sm <?= !in_array($no2, $pg2_belum_komplit) ? 'btn-success' : 'btn-outline-danger' ?> <?= is_null($soal) ? ($no2 == 1 ? 'active' : '') : ($no2 == $soal->nomor_soal ? 'active' : '') ?>"
                                   onclick="getSoalById(<?= $bank->id_bank ?>, <?= $no2 ?>, <?= '2' . $no2 ?>, '2')"
                                   id="btn-<?= '2' . $no2 ?>"><?= $no2 ?>
                                </a>
                                <?php
                                $no2++;
                            endfor; ?>
                            <a href="javascript:void(0)" class="pt-1 btn btn-oval-sm btn-outline-success"
                               data-mapel="<?= $bank->bank_mapel_id ?>" data-bank="<?= $bank->id_bank ?>"
                               data-nomor="<?= $no2 ?>" onclick="tambahSoalPg2(this)" id="btn-add-new-pg"><i
                                        class="fa fa-plus"></i> Tambah PG Kompleks</a>
                        </div>
                        <div class="tab-pane <?= $tab_active == '3' ? 'active' : '' ?>" id="jodoh">
                            <div class="alert alert-success align-content-center" role="alert">
                                Soal Menjodohkan, jumlah soal seharusnya: <b><?= $bank->tampil_jodohkan ?></b>
                            </div>
                            <span><b>SOAL NOMOR: </b></span><br>
                            <?php $noj = 1;
                            $tej = !isset($jml_jodohkan) || $jml_jodohkan == null || $jml_jodohkan->nomor_soal == null ? 0 : $jml_jodohkan->nomor_soal;
                            for ($i = 0; $i < $tej; $i++) : ?>
                                <a href="javascript:void(0)"
                                   class="mt-1 btn btn-circle-sm <?= !in_array($noj, $jodohkan_belum_komplit) ? 'btn-primary' : 'btn-outline-danger' ?>"
                                   onclick="getSoalById(<?= $bank->id_bank ?>, <?= $noj ?>, <?= '3' . $noj ?>, '3')"
                                   id="btn-<?= '3' . $noj ?>"><?= $noj ?>
                                </a>
                                <?php $noj++; endfor; ?>
                            <a href="javascript:void(0)" class="pt-1 btn btn-oval-sm btn-outline-primary"
                               data-mapel="<?= $bank->bank_mapel_id ?>" data-bank="<?= $bank->id_bank ?>"
                               data-nomor="<?= $noj ?>" onclick="tambahSoalJodohkan(this)" id="btn-add-new-essai"><i
                                        class="fa fa-plus"></i> Tambah Soal Menjodohkan</a>
                        </div>
                        <div class="tab-pane <?= $tab_active == '4' ? 'active' : '' ?>" id="isian">
                            <div class="alert alert-success align-content-center" role="alert">
                                Soal Isian Singkat, jumlah soal seharusnya: <b><?= $bank->tampil_isian ?></b>
                            </div>
                            <span><b>SOAL NOMOR: </b></span><br>
                            <?php $noi = 1;
                            $tei = !isset($jml_isian) || $jml_isian == null || $jml_isian->nomor_soal == null ? 0 : $jml_isian->nomor_soal;
                            for ($i = 0; $i < $tei; $i++) : ?>
                                <a href="javascript:void(0)"
                                   class="mt-1 btn btn-circle-sm <?= !in_array($noi, $isian_belum_komplit) ? 'btn-primary' : 'btn-outline-danger' ?>"
                                   onclick="getSoalById(<?= $bank->id_bank ?>, <?= $noi ?>, <?= '4' . $noi ?>, '4')"
                                   id="btn-<?= '4' . $noi ?>"><?= $noi ?>
                                </a>
                                <?php $noi++; endfor; ?>
                            <a href="javascript:void(0)" class="pt-1 btn btn-oval-sm btn-outline-primary"
                               data-mapel="<?= $bank->bank_mapel_id ?>" data-bank="<?= $bank->id_bank ?>"
                               data-nomor="<?= $noi ?>" onclick="tambahSoalIsian(this)" id="btn-add-new-essai"><i
                                        class="fa fa-plus"></i> Tambah Soal Isian</a>
                        </div>
                        <div class="tab-pane <?= $tab_active == '5' ? 'active' : '' ?>" id="essai">
                            <div class="alert alert-success align-content-center" role="alert">
                                Soal Uraian/Essai, jumlah soal seharusnya: <b><?= $bank->tampil_esai ?></b>
                            </div>
                            <span><b>ESSAI NOMOR: </b></span><br>
                            <?php $noe = 1;
                            $tes = !isset($jml_essai) || $jml_essai == null || $jml_essai->nomor_soal == null ? 0 : $jml_essai->nomor_soal;
                            for ($i = 0; $i < $tes; $i++) : ?>
                                <a href="javascript:void(0)"
                                   class="mt-1 btn btn-circle-sm <?= !in_array($noe, $essai_belum_komplit) ? 'btn-primary' : 'btn-outline-danger' ?>"
                                   onclick="getSoalById(<?= $bank->id_bank ?>, <?= $noe ?>, <?= '5' . $noe ?>, '5')"
                                   id="btn-<?= '5' . $noe ?>"><?= $noe ?>
                                </a>
                                <?php $noe++; endfor; ?>
                            <a href="javascript:void(0)" class="pt-1 btn btn-oval-sm btn-outline-primary"
                               data-mapel="<?= $bank->bank_mapel_id ?>" data-bank="<?= $bank->id_bank ?>"
                               data-nomor="<?= $noe ?>" onclick="tambahSoalEssai(this)" id="btn-add-new-essai"><i
                                        class="fa fa-plus"></i> Tambah Essai</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $pg_none = $tab_active == '1' ? '' : 'd-none';
            $pg2_none = $tab_active == '2' ? '' : 'd-none';
            $jodohkan_none = $tab_active == '3' ? '' : 'd-none';
            $isian_none = $tab_active == '4' ? '' : 'd-none';
            $essai_none = $tab_active == '5' ? '' : 'd-none';
            ?>
            <div class="alert alert-info" id="empty-soal" class="alert alert-info mt-4">
                <span>Belum ada soal</span>
            </div>
            <?php $isHotsInitial = !empty($soal) && !empty($soal->is_hots) && (int)$soal->is_hots === 1; ?>
            <div class="card my-shadow d-none" id="not-empty-soal">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <div class="card-title d-flex flex-wrap align-items-center gap-2 mb-0">
                        <h6 id="nomor-soal" class="mb-0"><b>Soal Nomor: 1</b></h6>
                        <span id="badge-hots-editor" class="badge bg-danger text-white rounded-pill px-2 py-1 <?= $isHotsInitial ? '' : 'd-none' ?>" style="font-size: 0.72rem; letter-spacing: 0.5px; background-color: #dc2626 !important; color: #ffffff !important; font-weight: 700;">HOTS</span>
                        <div class="form-check form-switch d-inline-flex align-items-center mb-0 ms-1" style="gap: 0.45rem;">
                            <input class="form-check-input mt-0" type="checkbox" role="switch" id="toggle-hots" name="is_hots" value="1" <?= $isHotsInitial ? 'checked' : '' ?> style="width: 2.35em; height: 1.25em; cursor: pointer;">
                            <label class="form-check-label fw-semibold text-dark mb-0" for="toggle-hots" style="cursor: pointer; font-size: 0.875rem; user-select: none;">Tandai HOTS</label>
                        </div>
                    </div>
                    <div class="card-tools">
                        <button type="button" onclick="bukaModalGeminiGambarSoal('textsoal')" class="btn btn-sm text-white fw-semibold me-1" style="background: linear-gradient(135deg, #0d9488 0%, #059669 100%); border: none;" title="Generate Gambar Ilustrasi AI untuk Soal Ini"><i class="fas fa-image me-1"></i> Gambar AI</button>
                        <button type="button" onclick="bukaModalGeminiSoal()" class="btn btn-sm text-white fw-semibold me-1" style="background: linear-gradient(135deg, #6366f1 0%, #2563eb 100%); border: none;"><i class="fas fa-robot me-1"></i> Gemini AI</button>
                        <button type="submit" class="btn btn-primary btn-sm me-1">
                            <i class="fa fa-plus me-1"></i>Simpan
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="soal-area mt-4">
                        <div class="row">
                            <div class="col-md-6" id="soal-area">
                                <div class="form-group">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="mb-0">Soal</label>
                                        <button type="button" onclick="bukaModalGeminiGambarSoal('textsoal')" class="btn btn-xs text-white fw-semibold px-2 py-1 shadow-sm" style="background: linear-gradient(135deg, #0d9488 0%, #059669 100%); border: none; border-radius: 6px; font-size: 11px;">
                                            <i class="fas fa-image me-1"></i> + Gambar AI ke Soal ini
                                        </button>
                                    </div>
                                    <textarea class="textsoal" id="textsoal"
                                              data-id="<?= csrf_hash() ?>"
                                              data-name="<?= csrf_token() ?>" name="soal"
                                              placeholder="Tulis soal disini"
                                              style="width:100%;"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6" id="jawaban-area">
                                <?php
                                $opsis [''] = 'Pilih Jawaban Benar :';
                                $opsis ['a'] = 'A';
                                $opsis ['b'] = 'B';
                                $opsis ['c'] = 'C';

                                if ($bank->opsi == 4) {
                                    $opsis ['d'] = 'D';
                                    $rangeAbjad = range('a', 'd');
                                } elseif ($bank->opsi == 5) {
                                    $opsis ['d'] = 'D';
                                    $opsis ['e'] = 'E';
                                    $rangeAbjad = range('a', 'e');
                                } else {
                                    $rangeAbjad = range('a', 'c');
                                };
                                ?>
                                <div id="root-opsi-pg" class="<?= $pg_none ?>">
                                    <?php
                                    foreach ($rangeAbjad as $abjad) :
                                        ?>
                                        <div class="mb-3 ms-3">
                                            <label>Jawaban <?= strtoupper($abjad ?? '') ?></label>
                                            <textarea class="textjawaban" id="textjawaban_<?= $abjad ?>"
                                                      name="jawaban_<?= $abjad ?>"
                                                      placeholder="Place some text here"
                                                      style="width:100%;"></textarea>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div id="root-opsi-pg2" class="<?= $pg2_none ?>">
                                    <div id="opsi-pg2"></div>
                                    <div class="mb-3 ms-3">
                                        <button id="tambah-jawaban-pg2" type="button" class="btn btn-success">Tambah
                                            Jawaban
                                        </button>
                                    </div>
                                </div>

                                <div class="<?= $jodohkan_none ?> mt-3 mt-md-0 ms-md-3" id="root-opsi-jodohkan">
                                    <hr>
                                    <p><b>Jawaban</b></p>
                                    <div id="jawaban-jodohkan">
                                    </div>
                                    <div class="alert alert-warning">
                                        Maksimal <b>20 KOLOM</b> dan <b>20 BARIS</b>
                                    </div>
                                </div>

                                <div class="mt-1 ms-3" id="jawaban-benar">
                                    <label>Jawaban Benar</label>
                                    <div id="root-jawaban-pg" class="<?= $pg_none ?>">
                                        <?php
                                        echo form_dropdown(
                                            'jawaban_pg',
                                            $opsis,
                                            '',
                                            'id="jawaban" class="select2 form-control" required'
                                        ); ?>
                                    </div>
                                    <div class="<?= $isian_none ?>" id="root-jawaban-isian">
                                        <input type="text" id="jawaban-isian" name="jawaban_isian" class="form-control"
                                               value="" disabled="disabled"/>
                                    </div>
                                    <div class="<?= $essai_none ?>" id="root-jawaban-essai">
										<textarea class="textjawaban-essai" id="jawaban-essai" name="jawaban_essai"
                                                  placeholder="Place some text here" style="width:100%;"
                                                  disabled="disabled">
										</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overlay d-none" id="loading">
                    <div class="spinner-grow"></div>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </section></div>
</div>

<?= form_open('create', array('id' => 'addfile')) ?>
<div class="modal fade" id="pickerModal" tabindex="-1" role="dialog" aria-labelledby="pickerModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <h5 id="pickerModalLabel">Pilih File</h5>
                    <br> hanya untuk file audio dan video
                </div>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <ul id="media-list" class="clearfix">
                        <li class="myupload">
                                    <span>
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                        <input name="file_uploads" type="file" id="picupload"
                                               class="picupload">
                                    </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>

<div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="noteModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <h5 id="noteModalLabel">Edit Field</h5>
                </div>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea id="edit-dialog" style="width:100%;"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="simpanValue()">OK</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script src="<?= base_url() ?>/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?= base_url() ?>/assets/app/js/mediastyler.js"></script>

<script src="<?= base_url() ?>/assets/app/js/linker-list.js?v=<?= time() ?>"></script>
<script src="<?= base_url() ?>/assets/plugins/element-queries/ElementQueries.js"></script>
<script src="<?= base_url() ?>/assets/plugins/element-queries/ResizeSensor.js"></script>
<script src="<?= base_url() ?>/assets/plugins/katex/katex.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/katex/contrib/auto-render.min.js"></script>
<script src="<?= base_url() ?>/assets/app/js/omml2latex.js"></script>

<script type="text/javascript">
    var nomor_soal = '<?=$p_no?>';
    let soal_ada = '<?=is_null($soal) ? 'n' : 'y'?>';
    let idBank = '<?= $bank->id_bank ?>';
    let idSoal = '<?= is_null($soal) ? 0 : $soal->id_soal ?>';
    let jenis = '<?= $tab_active ?>';
    console.log('jns', jenis);

    var adaPg = JSON.parse('<?= json_encode($soal_pg_ada)?>');
    var adaPg2 = JSON.parse('<?= json_encode($soal_pg2_ada)?>');
    var adaJodohkan = JSON.parse('<?= json_encode($soal_jodohkan_ada)?>');
    var adaIsian = JSON.parse('<?= json_encode($soal_isian_ada)?>');
    var adaEssai = JSON.parse('<?= json_encode($soal_esai_ada)?>');
    console.log('adaPg', adaIsian);

    $(function () {
        bsCustomFileInput.init();
    });
</script>
<script src="<?= base_url() ?>/assets/app/js/cbt/banksoal/soal.js?v=<?= @filemtime(FCPATH . 'assets/app/js/cbt/banksoal/soal.js') ?: time() ?>"></script>

<!-- Modal Generate Gambar AI Per-Soal untuk Bank Soal -->
<div class="modal fade" id="modalGeminiGambarSoal" tabindex="-1" aria-labelledby="modalGeminiGambarSoalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px;">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #0d9488 0%, #059669 100%);">
                <h5 class="modal-title fw-bold text-white d-flex align-items-center" id="modalGeminiGambarSoalLabel">
                    <i class="fas fa-image me-2"></i> Generate Gambar Ilustrasi AI (Per Soal)
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="alert border-0 py-2 px-3 mb-3 d-flex align-items-center justify-content-between flex-wrap gap-2" style="background: #ecfdf5; color: #065f46;">
                    <div class="small">
                        <i class="fas fa-bullseye me-1"></i>
                        Soal Aktif: <strong id="aiImgLabelNomorSoal">Soal Nomor 1</strong>
                        <span class="mx-1">|</span>
                        Gambar hanya ditambahkan ke soal yang Anda pilih.
                    </div>
                    <button type="button" onclick="ambilIdeGambarDariSoal()" class="btn btn-xs btn-outline-success fw-semibold px-2 py-1">
                        <i class="fas fa-lightbulb me-1"></i> Ambil Ide dari Teks Soal
                    </button>
                </div>

                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label fw-semibold small text-dark mb-1">
                            Deskripsi Gambar yang Diinginkan <span class="text-danger">*</span>
                        </label>
                        <textarea id="aiPromptGambarSoalInput" rows="3" class="form-control"
                                  placeholder="Contoh: Diagram sistem pencernaan manusia dengan organ mulut, kerongkongan, lambung, dan usus secara jelas bergaya ilustrasi buku IPA SMP..."></textarea>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold small text-dark mb-1">Mode Mesin Gambar AI</label>
                        <select id="aiModeRenderGambarSoal" class="form-select form-select-sm" style="color: #1e293b;">
                            <option value="auto" selected>Otomatis Cerdas (Provider Gambar Aktif &rarr; Fallback Diagram Vektor AI)</option>
                            <option value="vector">Diagram / Ilustrasi Vektor AI (Gratis Pakai Key Gemini Aktif)</option>
                            <option value="cloudflare">Cloudflare Workers AI &mdash; FLUX.1-schnell (Gratis Jika Diatur di Pengaturan AI)</option>
                            <option value="huggingface">Hugging Face Router &mdash; FLUX.1-schnell (Gratis Jika Token Diatur)</option>
                            <option value="pollinations_anon">Foto/Lukisan Gratis Tanpa Daftar (Pollinations &mdash; Kuota Terbatas)</option>
                            <option value="native">Google Gemini Image Native (Perlu Billing Aktif)</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label fw-semibold small text-dark mb-1">Sisipkan ke Editor Bagian</label>
                        <select id="aiTargetGambarSoal" class="form-select form-select-sm">
                            <option value="textsoal" selected>Pertanyaan / Stimulus Soal (Utama)</option>
                            <option value="textjawaban_a">Pilihan Jawaban A (PG)</option>
                            <option value="textjawaban_b">Pilihan Jawaban B (PG)</option>
                            <option value="textjawaban_c">Pilihan Jawaban C (PG)</option>
                            <option value="textjawaban_d">Pilihan Jawaban D (PG)</option>
                            <option value="textjawaban_e">Pilihan Jawaban E (PG)</option>
                            <option value="jawaban-essai">Kunci / Pembahasan Essai</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold small text-dark mb-1">Gaya Visual Gambar</label>
                        <select id="aiGayaGambarSoal" class="form-select form-select-sm">
                            <option value="Ilustrasi Edukasi Buku Paket (Bersih & Informatif)" selected>Ilustrasi Buku Paket Sekolah</option>
                            <option value="Diagram / Bagan Sains, Biologi, atau Geometri">Diagram / Bagan Sains &amp; Geometri</option>
                            <option value="Kartun Edukatif Ramah Siswa">Kartun Pendidikan</option>
                            <option value="Foto Realistis Kontekstual">Foto Realistis Kontekstual</option>
                            <option value="Sketsa Garis Hitam-Putih Siap Cetak">Sketsa Hitam-Putih Siap Cetak</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small text-dark mb-1">Posisi Gambar</label>
                        <select id="aiPosisiGambarSoal" class="form-select form-select-sm">
                            <option value="prepend" selected>Atas Teks Soal</option>
                            <option value="cursor">Kursor / Bawah Teks</option>
                        </select>
                    </div>
                </div>

                <div id="aiImgStatusAlert" class="alert d-none mt-3 mb-0 small" role="alert"></div>

                <div id="wrapAiImgPreview" class="d-none mt-3 p-3 border rounded text-center" style="background: #f8fafc;">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> Pratinjau Gambar AI</span>
                        <small id="aiImgModelInfo" class="text-muted"></small>
                    </div>
                    <img id="aiImgPreviewEl" src="" alt="Preview Gambar AI" class="img-fluid rounded shadow-sm border bg-white" style="max-height: 290px;">
                    <div class="mt-3 d-flex justify-content-center gap-2 flex-wrap">
                        <button type="button" onclick="prosesGenerateGambarSoal()" class="btn btn-sm btn-outline-secondary px-3">
                            <i class="fas fa-redo me-1"></i> Buat Ulang
                        </button>
                        <button type="button" onclick="sisipkanGambarAiKeSoal()" class="btn btn-sm btn-success fw-bold px-4 shadow-sm">
                            <i class="fas fa-check me-1"></i> Sisipkan ke Soal Ini
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light py-2 px-3 d-flex justify-content-between">
                <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">Tutup</button>
                <button type="button" id="btnSubmitAiImgSoal" onclick="prosesGenerateGambarSoal()" class="btn btn-sm text-white fw-bold px-4 shadow-sm" style="background: linear-gradient(135deg, #0d9488 0%, #059669 100%); border: none;">
                    <i class="fas fa-wand-magic-sparkles me-1"></i> Generate Gambar Sekarang
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Mandiri Gemini AI Generator untuk Bank Soal (100% Terisolasi) -->
<div class="modal fade" id="modalGeminiSoal" tabindex="-1" aria-labelledby="modalGeminiSoalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 14px;">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 50%, #2563eb 100%);">
                <h5 class="modal-title fw-bold text-white d-flex align-items-center" id="modalGeminiSoalLabel">
                    <i class="fas fa-robot me-2"></i> Asisten Pembuat Soal — Google Gemini AI
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="alert alert-primary border-0 py-2 px-3 mb-3 d-flex align-items-center justify-content-between flex-wrap gap-2" style="background: #eef2ff; color: #1e3a8a;">
                    <div class="small">
                        <i class="fas fa-sparkles me-1"></i>
                        Jenis Soal Aktif: <strong id="aiLabelJenisSoal">Pilihan Ganda</strong>
                        <span class="mx-1">|</span>
                        Kode Bank: <strong><?= esc($bank->bank_kode ?? '') ?></strong>
                    </div>
                    <?php if (session()->get('role') == '1'): ?>
                        <a href="<?= base_url('aigenerator') ?>" class="badge bg-primary text-white text-decoration-none">
                            <i class="fas fa-cog me-1"></i> Pengaturan API Key
                        </a>
                    <?php endif; ?>
                </div>

                <div class="row g-3">
                    <div class="col-md-7">
                        <label class="form-label fw-semibold small text-dark mb-1">Mode Pembuatan Soal</label>
                        <select id="aiModeGenerate" class="form-select form-select-sm" onchange="onChangeAiModeSoal()">
                            <option value="single">Buat 1 Soal &amp; Isi ke Editor Nomor Aktif (Tinjau Sebelum Simpan)</option>
                            <option value="batch">Buat Paket Banyak Soal Sekaligus (Otomatis Masuk Bank Soal)</option>
                        </select>
                    </div>
                    <div class="col-md-5 d-none" id="wrapAiJumlahSoal">
                        <label class="form-label fw-semibold small text-dark mb-1">Jumlah Soal Sekaligus</label>
                        <select id="aiJumlahSoal" class="form-select form-select-sm">
                            <option value="3">3 Butir Soal</option>
                            <option value="5" selected>5 Butir Soal</option>
                            <option value="10">10 Butir Soal</option>
                            <option value="15">15 Butir Soal</option>
                            <option value="20">20 Butir Soal</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold small text-dark mb-1">
                            Topik / Materi Pokok / Tujuan Pembelajaran <span class="text-danger">*</span>
                        </label>
                        <textarea id="aiTopikSoal" rows="2" class="form-control"
                                  placeholder="Contoh: Sistem Pencernaan Manusia, Enzim Pencernaan, dan Gangguan pada Saluran Pencernaan Kelas VIII..."></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small text-dark mb-1">Tingkat Kesulitan Kognitif</label>
                        <select id="aiKesulitanSoal" class="form-select form-select-sm">
                            <option value="Mudah (LOTS - C1/C2 Pemahaman Dasar)">Mudah (LOTS — C1/C2 Pemahaman Dasar)</option>
                            <option value="Sedang (MOTS - C3 Penerapan & Konsep)" selected>Sedang (MOTS — C3 Penerapan &amp; Konsep)</option>
                            <option value="Sulit (HOTS - C4/C5 Analisis & Penalaran Studi Kasus)">Sulit (HOTS — C4/C5 Analisis &amp; Penalaran)</option>
                            <option value="Campuran Proporsional (Mudah, Sedang, dan HOTS)">Campuran Proporsional (LOTS, MOTS &amp; HOTS)</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small text-dark mb-1">Instruksi Khusus (Opsional)</label>
                        <input type="text" id="aiInstruksiSoal" class="form-control form-control-sm"
                               placeholder="Contoh: Sertakan stimulus cerita singkat / tabel...">
                    </div>
                </div>

                <div id="wrapAiGambarSingle" class="mt-3 p-3 rounded border" style="background: #f0fdf4; border-color: #bbf7d0 !important;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="aiIncludeGambarSoal" onchange="$('#wrapAiPromptGambarOpt').toggleClass('d-none', !this.checked)">
                        <label class="form-check-label fw-semibold small text-dark" for="aiIncludeGambarSoal">
                            <i class="fas fa-image text-success me-1"></i> Sertakan Gambar Ilustrasi AI untuk Soal Ini (Opsional)
                        </label>
                    </div>
                    <div id="wrapAiPromptGambarOpt" class="d-none mt-2">
                        <input type="text" id="aiPromptGambarSoal" class="form-control form-control-sm"
                               placeholder="Deskripsi gambar khusus (opsional, kosongkan agar AI otomatis membuat ilustrasi sesuai soal)">
                    </div>
                </div>

                <div id="aiSoalStatusAlert" class="alert d-none mt-3 mb-0 small" role="alert"></div>
            </div>
            <div class="modal-footer bg-light py-2 px-3 d-flex justify-content-between">
                <button type="button" class="btn btn-sm btn-secondary px-3" data-bs-dismiss="modal">Tutup</button>
                <button type="button" id="btnSubmitAiSoal" onclick="prosesGenerateSoalAi()" class="btn btn-sm text-white fw-bold px-4 shadow-sm" style="background: linear-gradient(135deg, #6366f1 0%, #2563eb 100%); border: none;">
                    <i class="fas fa-magic me-1"></i> Generate Soal Sekarang
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        var mapNamaJenis = {
            '1': 'Pilihan Ganda',
            '2': 'Pilihan Ganda Kompleks',
            '3': 'Menjodohkan',
            '4': 'Isian Singkat',
            '5': 'Essai / Uraian'
        };

        window.bukaModalGeminiSoal = function() {
            try {
                var curJns = String($('#jenis-id').val() || jenis || '1');
                $('#aiLabelJenisSoal').text((mapNamaJenis[curJns] || 'Pilihan Ganda') + ' (Nomor ' + (nomor_soal || 1) + ')');
                $('#aiSoalStatusAlert').addClass('d-none');
                var modalEl = document.getElementById('modalGeminiSoal');
                if (modalEl && typeof bootstrap !== 'undefined') {
                    var m = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                    m.show();
                } else {
                    $('#modalGeminiSoal').modal('show');
                }
            } catch (e) {
                console.warn('[GeminiAI] Error membuka modal:', e);
            }
        };

        window.onChangeAiModeSoal = function() {
            var mode = $('#aiModeGenerate').val();
            if (mode === 'batch') {
                $('#wrapAiJumlahSoal').removeClass('d-none');
                $('#wrapAiGambarSingle').addClass('d-none');
            } else {
                $('#wrapAiJumlahSoal').addClass('d-none');
                $('#wrapAiGambarSingle').removeClass('d-none');
            }
        };

        window.prosesGenerateSoalAi = function() {
            try {
                var topik     = ($('#aiTopikSoal').val() || '').trim();
                var mode      = $('#aiModeGenerate').val() || 'single';
                var jmlSoal   = $('#aiJumlahSoal').val() || '5';
                var kesulitan = $('#aiKesulitanSoal').val() || 'Sedang';
                var instruksi = ($('#aiInstruksiSoal').val() || '').trim();
                var curJenis  = String($('#jenis-id').val() || jenis || '1');
                var curNomor  = parseInt(nomor_soal || 1, 10) || 1;
                var alertBox  = $('#aiSoalStatusAlert');
                var btn       = $('#btnSubmitAiSoal');

                if (!topik) {
                    alertBox.removeClass('d-none alert-info alert-success').addClass('alert-warning')
                            .html('<i class="fas fa-exclamation-circle me-1"></i> Silakan tuliskan Topik / Materi Soal terlebih dahulu.');
                    $('#aiTopikSoal').focus();
                    return;
                }

                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i> Gemini AI Sedang Menyusun Soal...');
                alertBox.removeClass('d-none alert-warning alert-danger alert-success').addClass('alert-info')
                        .html('<i class="fas fa-spinner fa-spin me-1"></i> Mohon tunggu beberapa detik, Gemini AI sedang menyusun butir soal beserta kunci jawaban...');

                $.ajax({
                    url: base_url + 'aigenerator/generatesoal',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        bank_id: idBank,
                        jenis: curJenis,
                        nomor_soal: curNomor,
                        mode: mode,
                        jumlah_soal: jmlSoal,
                        topik: topik,
                        kesulitan: kesulitan,
                        instruksi_tambahan: instruksi
                    },
                    success: function(res) {
                        btn.prop('disabled', false).html('<i class="fas fa-magic me-1"></i> Generate Soal Sekarang');
                        if (!res || !res.status) {
                            var errMsg = (res && res.message) ? res.message : 'Gagal membuat soal dengan AI.';
                            alertBox.removeClass('alert-info alert-success').addClass('alert-danger')
                                    .html('<i class="fas fa-exclamation-triangle me-1"></i> ' + errMsg);
                            return;
                        }

                        if (res.mode === 'batch') {
                            var modalEl = document.getElementById('modalGeminiSoal');
                            if (modalEl && typeof bootstrap !== 'undefined') {
                                var m = bootstrap.Modal.getInstance(modalEl);
                                if (m) m.hide();
                            }
                            if (typeof swal !== 'undefined') {
                                swal.fire({
                                    icon: 'success',
                                    title: 'Paket Soal Berhasil Dibuat!',
                                    text: res.message || 'Soal berhasil ditambahkan ke Bank Soal.',
                                    confirmButtonText: 'Muat Ulang & Lihat Soal'
                                }).then(function() {
                                    window.location.href = base_url + 'cbtbanksoal/buatsoal/' + idBank + '?tab=' + curJenis;
                                });
                            } else {
                                window.location.href = base_url + 'cbtbanksoal/buatsoal/' + idBank + '?tab=' + curJenis;
                            }
                            return;
                        }

                        // Mode Single: Terapkan langsung ke Editor
                        terapkanSoalAiKeEditor(res);

                        var wantAutoImg = $('#aiIncludeGambarSoal').is(':checked');
                        if (wantAutoImg) {
                            var autoImgPrompt = ($('#aiPromptGambarSoal').val() || '').trim();
                            var rawSoalTxt = $('<div>').html((res.data && res.data.soal) ? res.data.soal : '').text().replace(/\s+/g, ' ').trim();
                            if (!autoImgPrompt) {
                                autoImgPrompt = 'Ilustrasi pendidikan yang relevan untuk soal tentang ' + topik + (rawSoalTxt ? (': ' + rawSoalTxt.substring(0, 180)) : '');
                            }
                            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i> Membuat Gambar Ilustrasi AI...');
                            alertBox.removeClass('d-none alert-warning alert-danger alert-success').addClass('alert-info')
                                    .html('<i class="fas fa-spinner fa-spin me-1"></i> Teks soal sudah diterapkan ke editor. Sedang membuat gambar ilustrasi AI...');

                            $.ajax({
                                url: base_url + 'aigenerator/generateimage',
                                type: 'POST',
                                dataType: 'JSON',
                                data: {
                                    prompt: autoImgPrompt,
                                    context: 'bank_soal',
                                    style: 'Ilustrasi Edukasi Buku Paket (Bersih & Informatif)',
                                    render_mode: 'auto',
                                    context_text: rawSoalTxt || topik
                                },
                                success: function(imgRes) {
                                    if (!imgRes || !imgRes.status || !imgRes.url) {
                                        btn.prop('disabled', false).html('<i class="fas fa-magic me-1"></i> Generate Soal Sekarang');
                                        var imgErr = (imgRes && imgRes.message) ? imgRes.message : 'Gambar AI gagal dibuat.';
                                        alertBox.removeClass('alert-info alert-success').addClass('alert-warning')
                                                .html('<i class="fas fa-exclamation-triangle me-1"></i> <strong>Teks soal berhasil diterapkan</strong>, namun gambar AI gagal dibuat: ' + imgErr);
                                        return;
                                    }
                                    finalizeAiSoalImageAsset(imgRes, function(finalImgRes) {
                                        btn.prop('disabled', false).html('<i class="fas fa-magic me-1"></i> Generate Soal Sekarang');
                                        var safeUrl = String(finalImgRes.url).replace(/"/g, '&quot;');
                                        var imgTag = '<p class="text-center my-2"><img src="' + safeUrl + '" alt="Ilustrasi Soal" class="img-fluid rounded" style="max-width:100%; width:420px; height:auto;"></p>';
                                        var curHtml = $('#textsoal').summernote('code') || '';
                                        $('#textsoal').summernote('code', imgTag + curHtml);

                                        var modalElImg2 = document.getElementById('modalGeminiSoal');
                                        if (modalElImg2 && typeof bootstrap !== 'undefined') {
                                            var mImg2 = bootstrap.Modal.getInstance(modalElImg2);
                                            if (mImg2) mImg2.hide();
                                        } else {
                                            $('#modalGeminiSoal').modal('hide');
                                        }
                                        if (typeof showSuccessToast === 'function') {
                                            showSuccessToast('Soal & gambar ilustrasi AI berhasil diterapkan! Silakan tinjau lalu klik Simpan.');
                                        }
                                    });
                                },
                                error: function() {
                                    btn.prop('disabled', false).html('<i class="fas fa-magic me-1"></i> Generate Soal Sekarang');
                                    alertBox.removeClass('alert-info alert-success').addClass('alert-warning')
                                            .html('<i class="fas fa-exclamation-triangle me-1"></i> Teks soal sudah masuk ke editor, namun gagal menghubungi server saat membuat gambar AI.');
                                }
                            });
                            return;
                        }

                        var modalEl2 = document.getElementById('modalGeminiSoal');
                        if (modalEl2 && typeof bootstrap !== 'undefined') {
                            var m2 = bootstrap.Modal.getInstance(modalEl2);
                            if (m2) m2.hide();
                        } else {
                            $('#modalGeminiSoal').modal('hide');
                        }
                        if (typeof showSuccessToast === 'function') {
                            showSuccessToast('Soal hasil Gemini AI berhasil diterapkan ke editor! Silakan tinjau lalu klik Simpan.');
                        }
                    },
                    error: function() {
                        btn.prop('disabled', false).html('<i class="fas fa-magic me-1"></i> Generate Soal Sekarang');
                        alertBox.removeClass('alert-info alert-success').addClass('alert-danger')
                                .html('<i class="fas fa-exclamation-triangle me-1"></i> Gagal menghubungi server saat menyusun soal.');
                    }
                });
            } catch (err) {
                console.warn('[GeminiAI] Exception:', err);
            }
        };

        function terapkanSoalAiKeEditor(res) {
            try {
                var item     = res.data || {};
                var curJenis = String(res.jenis || $('#jenis-id').val() || '1');

                $('#empty-soal').addClass('d-none');
                $('#not-empty-soal').removeClass('d-none');

                if (res.id_soal && parseInt(res.id_soal, 10) > 0) {
                    $('#soal-id').val(res.id_soal);
                    $('#method').val('edit');
                }

                // Terapkan status HOTS jika tersedia dari AI
                var aiIsHots = parseInt((item && item.is_hots !== undefined ? item.is_hots : (res && res.is_hots ? res.is_hots : 0)) || 0, 10) === 1;
                $('#toggle-hots').prop('checked', aiIsHots).trigger('change');

                // Isi Pertanyaan ke Summernote
                $('#textsoal').summernote('code', item.soal || '');

                if (curJenis === '1') {
                    var abjads = ['a', 'b', 'c', 'd', 'e'];
                    for (var i = 0; i < abjads.length; i++) {
                        var abj = abjads[i];
                        var elOpsi = $('#textjawaban_' + abj);
                        if (elOpsi.length) {
                            elOpsi.summernote('code', item['opsi_' + abj] || '');
                        }
                    }
                    var kunci = String(item.jawaban || 'a').toLowerCase().trim();
                    var idxKunci = abjads.indexOf(kunci);
                    if (idxKunci >= 0) {
                        $('#jawaban').prop('selectedIndex', idxKunci + 1).trigger('change');
                    }
                } else if (curJenis === '2') {
                    var opsiPg2 = item.opsi_pg2 || {};
                    var jwbPg2  = Array.isArray(item.jawaban_pg2) ? item.jawaban_pg2 : ['a'];
                    var htmlPg2 = '';
                    $.each(opsiPg2, function(k, v) {
                        var kLow = String(k).toLowerCase();
                        var isChecked = jwbPg2.indexOf(kLow) !== -1 ? 'checked="checked"' : '';
                        htmlPg2 += '<div class="pg-kompleks mb-4 ml-3">' +
                            '<div class="row mb-2">' +
                            '<div class="col-6">' +
                            '<button type="button" class="btn btn-sm btn-default mr-4" onclick="deleteOpsiPg2(this)"><i class="fa fa-trash"></i></button>' +
                            '<span class="abjad-pg2"><b>Jawaban ' + kLow.toUpperCase() + '</b></span></div>' +
                            '<div class="col-6 text-right d-flex justify-content-end">' +
                            '<b>Jawaban benar</b>' +
                            '<input class="check-pg2" type="checkbox" style="width: 24px; height: 24px; margin-left: 8px;" name="jawaban_benar_pg2[]" value="' + kLow + '" ' + isChecked + '>' +
                            '</div></div>' +
                            '<textarea class="textjawaban2" id="textjawaban2_' + kLow + '" name="jawaban2_' + kLow + '" style="width:100%;">' + (v || '') + '</textarea>' +
                            '</div>';
                    });
                    if (htmlPg2 !== '') {
                        $('#opsi-pg2').html(htmlPg2);
                        if (typeof initTextArea === 'function') {
                            initTextArea();
                        }
                    }
                } else if (curJenis === '3') {
                    var jData = item.jodohkan_data || { model: '1', type: '2', jawaban: [] };
                    var konten = $('#jawaban-jodohkan');
                    konten.html('');
                    dataJodohkan = jData;
                    adaJawaban = true;
                    if (typeof konten.linkerList === 'function') {
                        konten.linkerList({
                            data: jData,
                            id: nomor_soal,
                            viewMode: '3',
                            callback: function(id, data, hasLinks) {
                                dataJodohkan = data;
                                adaJawaban = hasLinks;
                            }
                        });
                    }
                } else if (curJenis === '4') {
                    $('#jawaban-isian').removeAttr('disabled').val(item.jawaban || '');
                } else {
                    $('#jawaban-essai').removeAttr('disabled').summernote('code', item.jawaban || '');
                }
            } catch (err) {
                console.warn('[GeminiAI] Gagal menerapkan ke editor:', err);
            }
        }

        var lastSoalImgData = null;
        var lastSoalImgNomor = null;

        function hideSoalModalSafe(id) {
            var el = document.getElementById(id);
            if (el && typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                var m = bootstrap.Modal.getInstance(el);
                if (m) { m.hide(); return; }
            }
            $('#' + id).modal('hide');
        }

        function showSoalModalSafe(id) {
            var el = document.getElementById(id);
            if (el && typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                var m = bootstrap.Modal.getInstance(el) || new bootstrap.Modal(el);
                m.show();
            } else {
                $('#' + id).modal('show');
            }
        }

        window.bukaModalGeminiGambarSoal = function(defaultTarget) {
            try {
                if ($('#not-empty-soal').hasClass('d-none')) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire('Info', 'Pilih atau tambah nomor soal terlebih dahulu sebelum menambahkan gambar.', 'info');
                    } else {
                        alert('Pilih atau tambah nomor soal terlebih dahulu sebelum menambahkan gambar.');
                    }
                    return;
                }

                var curJns = String($('#jenis-id').val() || jenis || '1');
                var curNo  = String(typeof nomor_soal !== 'undefined' && nomor_soal ? nomor_soal : '1');
                $('#aiImgLabelNomorSoal').text((mapNamaJenis[curJns] || 'Soal') + ' — Nomor ' + curNo);

                // Sesuaikan pilihan target sesuai jenis soal aktif
                var isPg1 = (curJns === '1');
                var isEssai = (curJns === '5');
                ['a', 'b', 'c', 'd', 'e'].forEach(function(abj) {
                    var opt = $('#aiTargetGambarSoal option[value="textjawaban_' + abj + '"]');
                    var hasEditor = ($('#textjawaban_' + abj).next('.note-editor').length > 0);
                    opt.prop('disabled', !(isPg1 && hasEditor));
                });
                $('#aiTargetGambarSoal option[value="jawaban-essai"]').prop('disabled', !isEssai);

                var targetId = defaultTarget || 'textsoal';
                if ($('#aiTargetGambarSoal option[value="' + targetId + '"]').prop('disabled')) {
                    targetId = 'textsoal';
                }
                $('#aiTargetGambarSoal').val(targetId);

                try {
                    if ($('#' + targetId).next('.note-editor').length) {
                        $('#' + targetId).summernote('editor.saveRange');
                    }
                } catch (eR) {}

                $('#aiImgStatusAlert').addClass('d-none');
                if (lastSoalImgNomor !== curNo) {
                    lastSoalImgData = null;
                    lastSoalImgNomor = curNo;
                    $('#wrapAiImgPreview').addClass('d-none');
                    $('#aiPromptGambarSoalInput').val('');
                } else if (!lastSoalImgData) {
                    $('#wrapAiImgPreview').addClass('d-none');
                }

                // Isi otomatis saran prompt dari isi teks soal jika masih kosong
                if (!($('#aiPromptGambarSoalInput').val() || '').trim()) {
                    window.ambilIdeGambarDariSoal(true);
                }

                showSoalModalSafe('modalGeminiGambarSoal');
            } catch (e) {
                console.warn('[GeminiAI] Error membuka modal gambar soal:', e);
            }
        };

        window.ambilIdeGambarDariSoal = function(quiet) {
            var rawHtml = '';
            try {
                rawHtml = $('#textsoal').summernote('code') || '';
            } catch (eC) {
                rawHtml = $('#textsoal').val() || '';
            }
            var plainTxt = $('<div>').html(rawHtml).text().replace(/\s+/g, ' ').trim();
            if (!plainTxt || plainTxt.length < 5) {
                if (!quiet) {
                    $('#aiImgStatusAlert').removeClass('d-none alert-info alert-success alert-danger').addClass('alert-warning')
                        .html('<i class="fas fa-info-circle me-1"></i> Teks soal masih kosong. Silakan tulis soal dulu atau ketik deskripsi gambar secara manual.');
                    $('#aiPromptGambarSoalInput').focus();
                }
                return;
            }
            $('#aiImgStatusAlert').addClass('d-none');
            $('#aiPromptGambarSoalInput').val('Ilustrasi edukasi yang jelas dan informatif untuk membantu siswa memahami soal berikut: ' + plainTxt.substring(0, 260));
        };

        function finalizeAiSoalImageAsset(res, onDone) {
            if (!res || !res.status || !res.url || !res.is_vector || !res.svg_code) {
                onDone(res);
                return;
            }
            try {
                var svgText = String(res.svg_code);
                var w = 800, h = 480;
                var mVb = svgText.match(/viewBox\s*=\s*["']\s*[-\d.]+\s+[-\d.]+\s+([\d.]+)\s+([\d.]+)\s*["']/i);
                if (mVb) {
                    w = Math.max(300, Math.min(1600, Math.round(parseFloat(mVb[1]) || 800)));
                    h = Math.max(200, Math.min(1200, Math.round(parseFloat(mVb[2]) || 480)));
                }
                var scale = 1.5;
                var svgBlob = new Blob([svgText], { type: 'image/svg+xml;charset=utf-8' });
                var blobUrl = URL.createObjectURL(svgBlob);
                var img = new Image();
                img.onload = function() {
                    try {
                        var canvas = document.createElement('canvas');
                        canvas.width = Math.round(w * scale);
                        canvas.height = Math.round(h * scale);
                        var ctx = canvas.getContext('2d');
                        ctx.fillStyle = '#ffffff';
                        ctx.fillRect(0, 0, canvas.width, canvas.height);
                        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                        URL.revokeObjectURL(blobUrl);
                        var pngDataUrl = canvas.toDataURL('image/png');
                        $.ajax({
                            url: base_url + 'aigenerator/savecanvasimage',
                            type: 'POST',
                            dataType: 'JSON',
                            data: {
                                image_base64: pngDataUrl,
                                context: 'bank_soal',
                                replace_filename: res.filename || ''
                            },
                            success: function(pngRes) {
                                if (pngRes && pngRes.status && pngRes.url) {
                                    res.url = pngRes.url;
                                    res.filename = pngRes.filename || res.filename;
                                }
                                onDone(res);
                            },
                            error: function() {
                                onDone(res);
                            }
                        });
                    } catch (eCnv) {
                        try { URL.revokeObjectURL(blobUrl); } catch (e0) {}
                        onDone(res);
                    }
                };
                img.onerror = function() {
                    try { URL.revokeObjectURL(blobUrl); } catch (e0) {}
                    onDone(res);
                };
                img.src = blobUrl;
            } catch (eAll) {
                onDone(res);
            }
        }

        window.prosesGenerateGambarSoal = function() {
            try {
                var promptVal  = ($('#aiPromptGambarSoalInput').val() || '').trim();
                var styleVal   = $('#aiGayaGambarSoal').val() || 'Ilustrasi Edukasi Buku Paket (Bersih & Informatif)';
                var renderMode = $('#aiModeRenderGambarSoal').val() || 'auto';
                var alertBox   = $('#aiImgStatusAlert');
                var btn        = $('#btnSubmitAiImgSoal');

                if (!promptVal) {
                    alertBox.removeClass('d-none alert-info alert-success alert-danger alert-warning').addClass('alert-warning')
                            .html('<i class="fas fa-exclamation-circle me-1"></i> Silakan tuliskan deskripsi gambar atau klik "Ambil Ide dari Teks Soal".');
                    $('#aiPromptGambarSoalInput').focus();
                    return;
                }

                var rawHtml = '';
                try { rawHtml = $('#textsoal').summernote('code') || ''; } catch (eC) {}
                var plainTxt = $('<div>').html(rawHtml).text().replace(/\s+/g, ' ').trim();

                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i> Membuat Gambar AI...');
                alertBox.removeClass('d-none alert-warning alert-danger alert-success').addClass('alert-info')
                        .html('<i class="fas fa-spinner fa-spin me-1"></i> Sedang memproses pembuatan ilustrasi AI dengan Google Gemini, mohon tunggu...');

                $.ajax({
                    url: base_url + 'aigenerator/generateimage',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        prompt: promptVal,
                        context: 'bank_soal',
                        style: styleVal,
                        render_mode: renderMode,
                        context_text: plainTxt
                    },
                    success: function(res) {
                        if (!res || !res.status || !res.url) {
                            btn.prop('disabled', false).html('<i class="fas fa-wand-magic-sparkles me-1"></i> Generate Gambar Sekarang');
                            var errMsg = (res && res.message) ? res.message : 'Gagal membuat gambar AI.';
                            alertBox.removeClass('alert-info alert-success alert-warning').addClass('alert-danger')
                                    .html('<i class="fas fa-exclamation-triangle me-1"></i> ' + errMsg);
                            return;
                        }

                        finalizeAiSoalImageAsset(res, function(finalRes) {
                            btn.prop('disabled', false).html('<i class="fas fa-wand-magic-sparkles me-1"></i> Generate Gambar Sekarang');
                            lastSoalImgData = finalRes;
                            $('#aiImgPreviewEl').attr('src', finalRes.url);
                            $('#aiImgModelInfo').text((finalRes.is_vector ? 'Ilustrasi Vektor/Diagram (' : 'Model: ') + (finalRes.model_used || 'gemini') + (finalRes.is_vector ? ')' : ''));
                            $('#wrapAiImgPreview').removeClass('d-none');

                            if (finalRes.fallback_used && finalRes.fallback_notice) {
                                alertBox.removeClass('alert-info alert-danger alert-success').addClass('alert-warning')
                                        .html('<i class="fas fa-info-circle me-1"></i> ' + finalRes.fallback_notice + '<br><strong class="text-success d-block mt-1"><i class="fas fa-check-circle me-1"></i> Pratinjau siap! Klik "Sisipkan ke Soal Ini" jika sudah sesuai.</strong>');
                            } else {
                                alertBox.removeClass('alert-info alert-warning alert-danger').addClass('alert-success')
                                        .html('<i class="fas fa-check-circle me-1"></i> Gambar siap! Klik <strong>Sisipkan ke Soal Ini</strong> untuk menempelkan ke editor.');
                            }
                        });
                    },
                    error: function() {
                        btn.prop('disabled', false).html('<i class="fas fa-wand-magic-sparkles me-1"></i> Generate Gambar Sekarang');
                        alertBox.removeClass('alert-info alert-success alert-warning').addClass('alert-danger')
                                .html('<i class="fas fa-exclamation-triangle me-1"></i> Gagal menghubungi server saat membuat gambar AI.');
                    }
                });
            } catch (err) {
                console.warn('[GeminiAI] Exception generate gambar soal:', err);
            }
        };

        window.sisipkanGambarAiKeSoal = function() {
            if (!lastSoalImgData || !lastSoalImgData.url) {
                return;
            }
            var targetId = $('#aiTargetGambarSoal').val() || 'textsoal';
            var posisi   = $('#aiPosisiGambarSoal').val() || 'prepend';
            var elTarget = $('#' + targetId);

            if (!elTarget.length || !elTarget.next('.note-editor').length) {
                $('#aiImgStatusAlert').removeClass('d-none alert-info alert-success').addClass('alert-warning')
                    .html('<i class="fas fa-exclamation-triangle me-1"></i> Editor bagian target belum aktif. Silakan pilih "Pertanyaan / Stimulus Soal (Utama)".');
                return;
            }

            var safeUrl = String(lastSoalImgData.url).replace(/"/g, '&quot;');
            var imgTag  = '<p class="text-center my-2"><img src="' + safeUrl + '" alt="Ilustrasi Soal" class="img-fluid rounded" style="max-width:100%; width:420px; height:auto;"></p>';
            var curHtml = elTarget.summernote('code') || '';

            if (posisi === 'prepend') {
                elTarget.summernote('code', imgTag + curHtml);
            } else {
                try {
                    elTarget.summernote('editor.restoreRange');
                    elTarget.summernote('editor.focus');
                    elTarget.summernote('editor.pasteHTML', imgTag);
                } catch (ePaste) {
                    elTarget.summernote('code', curHtml + imgTag);
                }
                var afterHtml = elTarget.summernote('code') || '';
                if (afterHtml.indexOf(lastSoalImgData.url) === -1) {
                    elTarget.summernote('code', curHtml + imgTag);
                }
            }

            hideSoalModalSafe('modalGeminiGambarSoal');
            var curNo = String(typeof nomor_soal !== 'undefined' && nomor_soal ? nomor_soal : '1');
            if (typeof showSuccessToast === 'function') {
                showSuccessToast('Gambar AI berhasil disisipkan ke Soal Nomor ' + curNo + '! Klik Simpan untuk menyimpan perubahan.');
            }
        };

        // Buka otomatis jika ada parameter ?ai=1 dari halaman Detail Bank Soal
        $(document).ready(function() {
            try {
                if (window.location.search.indexOf('ai=1') !== -1) {
                    setTimeout(function() {
                        bukaModalGeminiSoal();
                    }, 600);
                }
            } catch (e) {}
        });
    })();
</script>

<?= $this->endSection() ?>
