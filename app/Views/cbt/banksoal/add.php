<?php echo $this->extend('layout/dashboard_template_bs5') ?>
<?php echo $this->section('content') ?>
<?php
$kelasSelected = json_encode($bank->bank_kelas ?? '[]');
?>

<div class="d-contents">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="me-3 flex-shrink-0">
            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: #ffffff;">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="12" y1="18" x2="12" y2="12"></line>
                <line x1="9" y1="15" x2="15" y2="15"></line>
              </svg>
            </div>
          </div>
          <div>
            <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                <?= $judul ?> - Buat Bank Soal Baru
            </h4>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Pembuatan paket bank soal baru, penentuan mata pelajaran, kode soal, dan alokasi opsi jawaban.</p>
          </div>
        </div>
      </div>
    </div>
    <div><div class="container-fluid">
            <?= form_open('create', array('id' => 'create')) ?>
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center border-bottom mb-3 pb-3">
                    <h4 class="card-title fw-bold mb-0"><?= esc($subjudul) . (!empty($bank->bank_kode) ? ' - ' . esc($bank->bank_kode) : '') ?></h4>
                    <div class="card-tools">
                        <button type="reset" class="btn btn-sm bg-warning text-white me-1">
                            <i class="fa fa-sync me-1"></i> Reset
                        </button>
                        <button type="submit" id="submit" class="btn btn-sm bg-primary text-white">
                            <svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Simpan
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-2 align-items-end mb-3">
                        <?php
                        echo form_hidden('old_kode', $bank->bank_kode);
                        echo form_hidden('id_bank', $bank->id_bank); ?>
                        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6">
                            <div class="form-group mb-0">
                                <label class="mb-1">Kode Bank Soal</label>
                                <input type="text" class="form-control form-control-sm" name="kode" maxlength="20"
                                       placeholder="Masukan Kode Bank Soal" value="<?= $bank->bank_kode ?>" required>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6">
                            <div class="form-group mb-0">
                                <label class="mb-1">Mata Pelajaran</label>
                                <?php echo form_dropdown('mapel', $mapel, $bank->bank_mapel_id, 'id="select-mapel" class="select2" required'); ?>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12">
                            <div class="form-group mb-0">
                                <label class="mb-1">Guru Pengampu</label>
                                <?php echo form_dropdown('guru', $gurus, $bank->bank_guru_id, 'id="select-guru" class="select2" required'); ?>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-4 col-4">
                            <div class="form-group mb-0">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="mb-0">Level</label>
                                </div>
                                <?php
                                $arrLevel = ['0' => 'Semua Level'];
                                if ($setting->jenjang == "1") {
                                    for ($i = 1; $i < 7; $i++) {
                                        $arrLevel[$i] = $i;
                                    }
                                } else if ($setting->jenjang == "2") {
                                    for ($j = 7; $j < 10; $j++) {
                                        $arrLevel[$j] = $j;
                                    }
                                } else {
                                    for ($k = 10; $k < 13; $k++) {
                                        $arrLevel[$k] = $k;
                                    }
                                }

                                echo form_dropdown('level', $arrLevel, $bank->bank_level, 'id="select-level" class="form-control form-control-sm" data-placeholder="Pilih Level Kelas" required'); ?>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-8 col-8">
                            <div class="form-group mb-0">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="mb-0">Pilih Kelas</label>
                                    <button type="button" id="btn-pilih-semua-kelas" class="btn btn-xs btn-outline-primary py-0 px-2 shadow-none" style="font-size: 0.72rem; border-radius: 4px;">
                                        <i class="fa fa-check-double me-1"></i>Pilih Semua
                                    </button>
                                </div>
                                <select name="kelas[]" id="select-kelas"
                                        class="select2" multiple="multiple"
                                        required=""></select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-7">
                            <div class="card bg-primary text-white">
                                <div class="card-body p-2">
                                    <span><b>Soal Pilihan Ganda</b></span>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label>Jml. Soal</label>
                                                <input id="jml-pg" type='number' name='tampil_pg'
                                                       class='form-control form-control-sm'
                                                       value="<?= $bank->tampil_pg ?>" required/>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Bobot %</label>
                                                <input id="bobot-pg" type='number' name='bobot_pg'
                                                       class='form-control form-control-sm'
                                                       value="<?= $bank->bobot_pg ?>"
                                                       required/>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="form-group">
                                                <label>Opsi Jawaban</label>
                                                <?php
                                                $opsis [''] = 'Pilih Jml Opsi :';
                                                $opsis ['3'] = '3 (A, B, C)';
                                                $opsis ['4'] = '4 (A, B, C, D)';
                                                $opsis ['5'] = '5 (A, B, C, D, E)';

                                                echo form_dropdown('opsi', $opsis, $bank->opsi, 'class="form-control form-control-sm" required'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-5">
                            <div class="card bg-warning text-dark">
                                <div class="card-body p-2">
                                    <span><b>Soal Ganda Kompleks</b></span>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Jml. Soal</label>
                                                <input id="jml-pg2" type='number' name='tampil_kompleks'
                                                       class='form-control form-control-sm'
                                                       value="<?= $bank->tampil_kompleks ?>" required/>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Bobot %</label>
                                                <input id="bobot-pg2" type='number' name='bobot_kompleks'
                                                       class='form-control form-control-sm'
                                                       value="<?= $bank->bobot_kompleks ?>"
                                                       required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="card bg-danger text-white">
                                <div class="card-body p-2">
                                    <span><b>Soal Menjodohkan</b></span>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Jml. Soal</label>
                                                <input id="jml-jodohkan" type='number' name='tampil_jodohkan'
                                                       class='form-control form-control-sm'
                                                       value="<?= $bank->tampil_jodohkan ?>" required/>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Bobot %</label>
                                                <input id="bobot-jodohkan" type='number' name='bobot_jodohkan'
                                                       class='form-control form-control-sm'
                                                       value="<?= $bank->bobot_jodohkan ?>" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-body p-2">
                                    <span><b>Soal Isian Singkat</b></span>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Jml. Soal</label>
                                                <input id="jml-isian" type='number' name='tampil_isian'
                                                       class='form-control form-control-sm'
                                                       value="<?= $bank->tampil_isian ?>" required/>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Bobot %</label>
                                                <input id="bobot-isian" type='number' name='bobot_isian'
                                                       class='form-control form-control-sm'
                                                       value="<?= $bank->bobot_isian ?>" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="card bg-secondary text-white">
                                <div class="card-body p-2">
                                    <span><b>Soal Uraian/Essai</b></span>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Jml. Soal</label>
                                                <input id="jml-essai" type='number' name='tampil_esai'
                                                       class='form-control form-control-sm'
                                                       value="<?= $bank->tampil_esai ?>" required/>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Bobot %</label>
                                                <input id="bobot-essai" type='number' name='bobot_esai'
                                                       class='form-control form-control-sm'
                                                       value="<?= $bank->bobot_esai ?>" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-6">
                            <div class="card">
                                <div class="card-body">
                                    <table class="w-100">
                                        <tr class="text-center">
                                            <th>Total Soal</th>
                                            <th>Total Bobot</th>
                                        </tr>
                                        <tr class="text-center text-bold text-lg">
                                            <td id="total-soal">0</td>
                                            <td id="total-bobot">0</td>
                                        </tr>
                                    </table>
                                    <small></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="form-group">
                                <label>Mapel Agama</label>
                                <?php
                                echo form_dropdown('soal_agama', $mapel_agama, $bank->soal_agama, 'class="form-control form-control-sm" required'); ?>
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="form-group">
                                <label>Status Bank Soal</label>
                                <?php
                                $aktifs [''] = 'Pilih Status :';
                                $aktifs ['1'] = 'Aktif';
                                $aktifs ['0'] = 'Non Aktif';

                                echo form_dropdown('status', $aktifs, $bank->status, 'class="form-control form-control-sm" required'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    var isAdmin  = <?= $is_admin ? 'true' : 'false' ?>;
    var idGuru   = '<?= $id_guru ?>';
    
    // Data sinkronisasi Mapel -> Guru -> Kelas yang sudah diproses di controller!
    // Ini mengeliminasi kebutuhan AJAX dan memastikan tidak ada error saat dropdown dipilih.
    var syncData = <?= $sync_data ?? '{}' ?>;
    var allKelasData = <?= $all_kelas ?? '[]' ?>;

    // Kelas yang sudah tersimpan (mode edit)
    var kelasSelect = <?= $kelasSelected ?: '[]' ?>;
    var selectedKelasIds = kelasSelect.map(function(k){
        return String(k && k.kelas_id !== undefined ? k.kelas_id : k);
    });

    $(document).ready(function () {
        var selMapel = $('#select-mapel');
        var selGuru  = $('#select-guru');
        var selKelas = $('#select-kelas');

        selMapel.select2({theme: 'bootstrap4', width: '100%'});
        selGuru.select2({theme: 'bootstrap4', width: '100%', placeholder: 'Pilih Guru :'});
        selKelas.select2({theme: 'bootstrap4', width: '100%', placeholder: 'Pilih Kelas'});

        function populateKelas(kelasList) {
            selKelas.empty();
            if (kelasList && kelasList.length > 0) {
                var isLevelZero = ($('#select-level').val() === '0');
                var autoSelectAll = isLevelZero || (selectedKelasIds.indexOf('0') !== -1) || (selectedKelasIds.length > 0 && selectedKelasIds.length === kelasList.length);

                $.each(kelasList, function(i, kls) {
                    var kid = kls.id_kelas;
                    var knama = kls.nama_kelas || kls.kode_kelas;
                    var sel = (autoSelectAll || selectedKelasIds.indexOf(String(kid)) !== -1) ? ' selected' : '';
                    selKelas.append('<option value="' + kid + '"' + sel + '>' + knama + '</option>');
                });
            }
            selKelas.trigger('change.select2');
            updateBtnPilihSemuaText();
        }

        selMapel.on('change', function () {
            var mid = $(this).val();
            var prevGuru = selGuru.val() || idGuru;
            
            if (isAdmin) {
                selGuru.empty();
                selGuru.append('<option value="">Pilih Guru :</option>');
                
                if (mid && syncData[mid]) {
                    var totalGurus = Object.keys(syncData[mid]).length;
                    $.each(syncData[mid], function(gid, gdata) {
                        // Jika hanya ada 1 guru untuk mapel ini, otomatis terpilih!
                        var selected = (String(gid) === String(prevGuru) || totalGurus === 1) ? 'selected' : '';
                        selGuru.append('<option value="'+gid+'" '+selected+'>'+gdata.nama_guru+'</option>');
                    });
                }
                selGuru.trigger('change.select2');
                selGuru.trigger('change');
            } else {
                selGuru.trigger('change');
            }
        });

        selGuru.on('change', function () {
            var mid = selMapel.val();
            var gid = $(this).val();
            var lvl = $('#select-level').val();
            
            var kelasList = [];
            
            if (lvl === '0') {
                if (allKelasData && allKelasData.length > 0) {
                    kelasList = allKelasData;
                } else if (mid && syncData[mid]) {
                    var combined = {};
                    $.each(syncData[mid], function(_g, gdata) {
                        $.each(gdata.kelas, function(_i, kls) { combined[kls.id_kelas] = kls; });
                    });
                    kelasList = Object.values(combined);
                }
            } else {
                if (mid && gid && syncData[mid] && syncData[mid][gid]) {
                    kelasList = syncData[mid][gid].kelas;
                } else if (mid && !gid && isAdmin && syncData[mid]) {
                    var combined = {};
                    $.each(syncData[mid], function(_g, gdata) {
                        $.each(gdata.kelas, function(_i, kls) { combined[kls.id_kelas] = kls; });
                    });
                    kelasList = Object.values(combined);
                } else if (allKelasData && allKelasData.length > 0) {
                    kelasList = allKelasData;
                }
                
                if (lvl && lvl !== '0') {
                    kelasList = kelasList.filter(function(k) {
                        return String(k.level_id) === String(lvl);
                    });
                }
            }
            
            populateKelas(kelasList);
        });

        $('#select-level').on('change', function () {
            selGuru.trigger('change');
        });

        function updateBtnPilihSemuaText() {
            var curVals = selKelas.val() || [];
            var totalOpts = selKelas.find('option').length;
            if (totalOpts > 0 && curVals.length === totalOpts) {
                $('#btn-pilih-semua-kelas').html('<i class="fa fa-times me-1"></i>Batal Semua');
            } else {
                $('#btn-pilih-semua-kelas').html('<i class="fa fa-check-double me-1"></i>Pilih Semua');
            }
        }

        $('#btn-pilih-semua-kelas').on('click', function(e) {
            e.preventDefault();
            var curVals = selKelas.val() || [];
            var allVals = [];
            selKelas.find('option').each(function() {
                var v = $(this).val();
                if (v && v !== '0') allVals.push(v);
            });
            if (allVals.length > 0 && curVals.length === allVals.length) {
                selKelas.val([]).trigger('change.select2');
            } else {
                selKelas.val(allVals).trigger('change.select2');
            }
            updateBtnPilihSemuaText();
        });

        selKelas.on('change', function() {
            updateBtnPilihSemuaText();
        });

        if (selMapel.val()) {
            selMapel.trigger('change');
        }

        $('#create').submit(function (e) {
            e.preventDefault();
            swal.fire({
                text: "Silahkan tunggu....",
                allowEscapeKey: false,
                allowOutsideClick: false,
                onOpen: function() { swal.showLoading(); }
            });
            $.ajax({
                url: base_url + "cbtbanksoal/saveBank",
                type: "POST",
                dataType: "JSON",
                data: $(this).serialize(),
                success: function (data) {
                    if (data.status) {
                        swal.fire({
                            title: "Sukses",
                            html: 'Bank soal berhasil disimpan',
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "OK"
                        }).then(function(result) {
                            if (result.value) { window.location.href = base_url + "cbtbanksoal"; }
                        });
                    } else {
                        swal.fire({ title: "Error", text: data.errors, icon: "error" });
                    }
                },
                error: function (xhr) {
                    console.log("error", xhr.responseText);
                    try {
                        var err = JSON.parse(xhr.responseText);
                        swal.fire({ title: "Error", text: err.Message || err.message, icon: "error" });
                    } catch(ex) {
                        swal.fire({ title: "Error", text: "Terjadi kesalahan server", icon: "error" });
                    }
                }
            });
        });

        // ── Kalkulasi bobot & jumlah soal ──
        var valBobotPg       = $('#bobot-pg');
        var valBobotPg2      = $('#bobot-pg2');
        var valBobotJodohkan = $('#bobot-jodohkan');
        var valBobotIsian    = $('#bobot-isian');
        var valBobotEssai    = $('#bobot-essai');
        var totalBobot       = $('#total-bobot');
        var valSoalPg        = $('#jml-pg');
        var valSoalPg2       = $('#jml-pg2');
        var valSoalJodohkan  = $('#jml-jodohkan');
        var valSoalIsian     = $('#jml-isian');
        var valSoalEssai     = $('#jml-essai');
        var totalSoal        = $('#total-soal');

        function onChangeValueBobot() {
            var total = (parseInt(valBobotPg.val())       || 0)
                      + (parseInt(valBobotPg2.val())      || 0)
                      + (parseInt(valBobotJodohkan.val()) || 0)
                      + (parseInt(valBobotIsian.val())    || 0)
                      + (parseInt(valBobotEssai.val())    || 0);
            totalBobot.text(total + '');
        }

        function onChangeValueJumlah() {
            var total = (parseInt(valSoalPg.val())        || 0)
                      + (parseInt(valSoalPg2.val())       || 0)
                      + (parseInt(valSoalJodohkan.val())  || 0)
                      + (parseInt(valSoalIsian.val())     || 0)
                      + (parseInt(valSoalEssai.val())     || 0);
            totalSoal.text(total + '');
        }

        onChangeValueBobot();
        onChangeValueJumlah();

        valBobotPg.on('change keyup',       onChangeValueBobot);
        valBobotPg2.on('change keyup',      onChangeValueBobot);
        valBobotJodohkan.on('change keyup', onChangeValueBobot);
        valBobotIsian.on('change keyup',    onChangeValueBobot);
        valBobotEssai.on('change keyup',    onChangeValueBobot);

        valSoalPg.on('change keyup',        onChangeValueJumlah);
        valSoalPg2.on('change keyup',       onChangeValueJumlah);
        valSoalJodohkan.on('change keyup',  onChangeValueJumlah);
        valSoalIsian.on('change keyup',     onChangeValueJumlah);
        valSoalEssai.on('change keyup',     onChangeValueJumlah);
    });
</script>

<?= $this->endSection() ?>
