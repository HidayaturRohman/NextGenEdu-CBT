<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hidayatur Rohman
 * Date: 14/07/20
 * Time: 17:46
 */
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
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
              </svg>
            </div>
          </div>
          <div>
            <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                <?= $judul ?> - Tambah Jadwal Ujian
            </h4>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Penetapan jadwal ujian baru, tanggal mulai, durasi pengerjaan, dan pengacakan soal.</p>
          </div>
        </div>
      </div>
    </div>
</div>

    <div>
        <div class="container-fluid">
            <?= form_open('create', array('id' => 'create')) ?>
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header d-flex justify-content-between align-items-center border-bottom mb-3 pb-3">
                    <div class="card-title d-flex align-items-center">
                        <svg class="icon-24 text-primary me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                        <h4 class="card-title fw-bold mb-0"><?= $judul ?></h4>
                    </div>
                    <div class="card-tools d-flex gap-2">
                        <input type="hidden" id="id-jadwal" name='id_jadwal' value="<?= $jadwal->id_jadwal ?>" class='form-control d-none'/>
                        <button type="reset" class="btn btn-sm bg-warning text-white me-1">
                            <i class="fa fa-sync me-1"></i> Reset
                        </button>
                        <button type="submit" name="tambahjadwal" id="submit" class="btn btn-sm bg-primary text-white">
                            <svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg> Simpan
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                    $disabled_option = $disable_opsi ? 'disabled="disabled"' : '';
                    ?>
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label>Mata Pelajaran</label>
                            <?php
                            echo form_dropdown(
                                'mapel',
                                $mapel,
                                isset($jadwal->id_mapel) ? $jadwal->id_mapel : '',
                                $disabled_option . ' id="id-mapel" class="form-control form-control-sm" required'
                            ); ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Bank Soal</label>
                            <select <?= $disabled_option ?> name="bank_id" id="bank-id"
                                                            class="form-control form-control-sm" required=""></select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Jenis</label>
                            <?php
                            echo form_dropdown(
                                'jenis_id',
                                $jenis,
                                $jadwal->id_jenis,
                                $disabled_option . ' id="jenis-id" class="form-control form-control-sm" required'
                            ); ?>
                        </div>
                        <div class='col-6 col-md-3 mb-3'>
                            <label>Tanggal Mulai</label>
                            <input type='text' id="tgl-mulai" name='tgl_mulai' value="<?= $jadwal->tgl_mulai ?>"
                                   class='tgl form-control form-control-sm' autocomplete='off' required='true'/>
                        </div>
                        <div class='col-6 col-md-3 mb-3'>
                            <label>Tanggal Expired</label>
                            <input type='text' id="tgl-selesai" name='tgl_selesai' value="<?= $jadwal->tgl_selesai ?>"
                                   class='tgl form-control form-control-sm'
                                   autocomplete='off' required='true'/>
                        </div>
                        <div class='col-6 col-md-3 mb-3'>
                            <label>Durasi (menit)</label>
                            <input type='number' id="durasi-ujian" name='durasi_ujian'
                                   class='form-control form-control-sm' value="<?= $jadwal->durasi_ujian ?>"
                                   required='true'/>
                        </div>
                        <div class='col-6 col-md-3 mb-3'>
                            <label>Durasi minimal (mnt)</label>
                            <input type='number' id="jarak-ujian" name='jarak'
                                   class='form-control form-control-sm' value="<?= $jadwal->jarak ?>"
                                   required='true'/>
                        </div>
                    </div>
                    <div class='form-group'>
                        <div class='row'>
                            <div class="col-md-8 mb-3">
                                <div class="row">
                                    <div class='col-6 col-md-4'>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" role="switch" id="check-soal" name="acak_soal"
                                                   value='1' <?= $jadwal->acak_soal == 1 ? 'checked' : '' ?> <?= $disabled_option ?>/>
                                            <label class="form-check-label" for="check-soal">Acak Soal</label>
                                        </div>
                                    </div>
                                    <div class='col-6 col-md-4'>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" role="switch" id="check-opsi" name="acak_opsi"
                                                   value='1' <?= $jadwal->acak_opsi == 1 ? 'checked' : '' ?> <?= $disabled_option ?>/>
                                            <label class="form-check-label" for="check-opsi">Acak Jawaban</label>
                                        </div>
                                    </div>
                                    <div class='col-6 col-md-4'>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" role="switch" id="check-token" name="token"
                                                   value='1' <?= $jadwal->token == 1 ? 'checked' : '' ?> />
                                            <label class="form-check-label" for="check-token">Gunakan Token</label>
                                        </div>
                                    </div>
                                    <div class='col-6 col-md-4'>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" role="switch" id="check-hasil" name="hasil_tampil"
                                                   value='1' <?= $jadwal->hasil_tampil == 1 ? 'checked' : '' ?> />
                                            <label class="form-check-label" for="check-hasil">Tampilkan Hasil</label>
                                        </div>
                                    </div>
                                    <div class='col-6 col-md-4'>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" role="switch" id="check-login" name="reset_login"
                                                   value='1' <?= $jadwal->reset_login == 1 ? 'checked' : '' ?> />
                                            <label class="form-check-label" for="check-login">Reset Izin</label>
                                        </div>
                                    </div>
                                    <div class='col-6 col-md-4'>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" role="switch" id="check-pelanggaran" name="pelanggaran"
                                                   value='1' <?= $jadwal->pelanggaran == 1 ? 'checked' : '' ?>/>
                                            <label class="form-check-label" for="check-pelanggaran">Hitung Pelanggaran</label>
                                        </div>
                                    </div>
                                    <div class='col-6 col-md-4'>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" role="switch" id="check-kamera" name="kamera"
                                                   value='1' <?= (isset($jadwal->kamera) && $jadwal->kamera == 1) ? 'checked' : '' ?>/>
                                            <label class="form-check-label" for="check-kamera">Pengawasan Kamera</label>
                                        </div>
                                    </div>
                                    <div class='col-6 col-md-4'>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" role="switch" id="check-status" name="status"
                                                   value='1' <?= $jadwal->status == 1 ? 'checked' : '' ?> <?= $disabled_option ?>/>
                                            <label class="form-check-label" for="check-status">Aktif</label>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3 pt-2 border-top">
                                        <label class="form-label fw-bold text-dark d-flex align-items-center justify-content-between mb-2">
                                            <span class="d-flex align-items-center gap-2">
                                                <i class="fas fa-shield-alt text-primary"></i>
                                                <span>Penguncian Browser / Exambro</span>
                                            </span>
                                            <a href="<?= base_url('cbtexambro') ?>" target="_blank" class="small text-primary text-decoration-none fw-semibold">
                                                <i class="fas fa-cog me-1"></i>Setting Exambro
                                            </a>
                                        </label>
                                        <?php $lock_val = $jadwal->lock_browser ?? 0; ?>
                                        <div class="row g-2">
                                            <div class="col-sm-6 col-md-3">
                                                <div class="form-check border rounded-3 p-2.5 h-100 bg-light" style="padding-left: 2.2rem !important;">
                                                    <input class="form-check-input" type="radio" name="lock_browser" id="lock-0" value="0" <?= $lock_val == 0 ? 'checked' : '' ?>>
                                                    <label class="form-check-label fw-semibold text-dark small" for="lock-0">
                                                        Bebas (Semua Browser)
                                                    </label>
                                                    <small class="d-block text-muted" style="font-size: 0.75rem;">Chrome, Safari, Firefox, Edge, dll</small>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                                <div class="form-check border rounded-3 p-2.5 h-100" style="padding-left: 2.2rem !important; border-color: #3b82f6 !important; background-color: #eff6ff;">
                                                    <input class="form-check-input" type="radio" name="lock_browser" id="lock-1" value="1" <?= $lock_val == 1 ? 'checked' : '' ?>>
                                                    <label class="form-check-label fw-bold text-primary small" for="lock-1">
                                                        Wajib Exambro (Android & PC Resmi)
                                                    </label>
                                                    <small class="d-block text-muted" style="font-size: 0.75rem;">Blokir semua browser biasa</small>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                                <div class="form-check border rounded-3 p-2.5 h-100" style="padding-left: 2.2rem !important; border-color: #10b981 !important; background-color: #f0fdf4;">
                                                    <input class="form-check-input" type="radio" name="lock_browser" id="lock-2" value="2" <?= $lock_val == 2 ? 'checked' : '' ?>>
                                                    <label class="form-check-label fw-bold text-success small" for="lock-2">
                                                        Hanya Exambro Android
                                                    </label>
                                                    <small class="d-block text-muted" style="font-size: 0.75rem;">Hanya smartphone/tablet Android</small>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-3">
                                                <div class="form-check border rounded-3 p-2.5 h-100" style="padding-left: 2.2rem !important; border-color: #06b6d4 !important; background-color: #ecfeff;">
                                                    <input class="form-check-input" type="radio" name="lock_browser" id="lock-3" value="3" <?= $lock_val == 3 ? 'checked' : '' ?>>
                                                    <label class="form-check-label fw-bold text-info small" for="lock-3">
                                                        Hanya Exambro PC
                                                    </label>
                                                    <small class="d-block text-muted" style="font-size: 0.75rem;">Hanya komputer PC / SEB</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <?php
                                $jumlahKelas = $jadwal->bank_kelas;
                                $kelasbank = '';
                                $no = 1;
                                foreach ($jumlahKelas as $j) {
                                    foreach ($kelas as $k) {
                                        if ($j->kelas_id == $k->id_kelas) {
                                            $kelasbank .= ' <span class="badge text-bg-btn text-bg-info">' . $k->nama_kelas . '</span> ';
                                            $no++;
                                        }
                                    }
                                }
                                $dnone = $kelasbank === '' ? 'd-none' : '';
                                ?>
                                <div class="alert alert-primary m-0 <?= $dnone ?>" id="info-kelas">
                                    <span class="text-bold">Jadwal Kelas:</span>
                                    <br>
                                    <div id="info-kelas-bank" class="mb-2"><?= $kelasbank ?></div>
                                    <p class="text-xs m-0">Untuk merubah kelas silahkan edit <b>Bank Soal</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <ul>
                        <?php
                        if ($jadwal->id_jadwal != "") :
                            ?>
                            <li>
                                Beberapa opsi <b>tidak bisa diedit</b> karena jadwal ujian <b>sedang berlangsung</b>.
                            </li>
                        <?php endif; ?>
                        <li>
                            Jadwal ujian akan ditampilkan di siswa pada rentang waktu antara <b>tanggal mulai</b> dan
                            <b>tanggal expired</b>.
                        </li>
                        <li>
                            <b>Durasi minimal</b> untuk mengizinkan siswa menyelesaikan ujian pada menit yg ditentukan.
                        </li>
                        <li><b>Reset Izin</b> jika aktif maka siswa tidak bisa mengerjakan ujian di beberapa komputer
                            kecuali setelah diizinkan. Siswa juga akan otomatis logut jika membuka tab baru di browser.
                        </li>
                        <li><b>Hitung Pelanggaran</b> jika aktif maka pelanggaran akan dihitung dan siswa terkena
                            pengurangan point sebanyak pelanggaran yang dilakukan siswa. <b>Siswa akan diberi notifikasi
                                ketika melakukan pelanggaran</b>.
                            <p class="m-0"><span class="text-bold font-italic">Pelanggaran meliputi:</span>
                                Pelanggaran BERAT (membuka tab baru, keluar aplikasi sebelum selesai, me-minimize browser),
                                Pelanggaran SEDANG (me-nonaktifkan fullscreen) dan
                                Pelanggaran RINGAN (memulai ujian dengan tampilan tidak fullscreen) </p>
                        </li>
                    </ul>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    var digunakan = <?= $disable_opsi ? '1' : '0' ?>;
    var idBank = '<?=$jadwal->id_bank?>';
    let kelasBank = [];
    let allKelas = [];
    $(document).ready(function () {
        ajaxcsrf();
        //console.log('used',digunakan);

        $('#jenis-id').select2({width: '100%', });
        var selMapel = $('#id-mapel');
        selMapel.select2({width: '100%', });
        var selec = idBank == '' ? 'selected' : '';
        selMapel.prepend('<option value="" ' + selec + '>Pilih Mata Pelajaran</option>');
        var selBank = $('#bank-id');
        selBank.select2({width: '100%', });

        $('.tgl').datetimepicker({
            icons:
                {
                    next: 'fa fa-angle-right',
                    previous: 'fa fa-angle-left'
                },
            timepicker: false,
            scrollInput: false,
            scrollMonth: false,
            format: 'Y-m-d',
            //disabledWeekDays: [0],
            widgetPositioning: {
                horizontal: 'left',
                vertical: 'bottom'
            }
        });

        function reEnable(disable) {
            if (digunakan == '1') {
                $('#id-guru').prop('disabled', disable);
                $('#bank-id').prop('disabled', disable);
                $('#jenis-id').prop('disabled', disable);
                $('#check-soal').prop('disabled', disable);
                $('#check-opsi').prop('disabled', disable);
                $('#check-token').prop('disabled', disable);
                $('#check-hasil').prop('disabled', disable);
                $('#check-login').prop('disabled', disable);
                $('#check-status').prop('disabled', disable);
                $('#check-pelanggaran').prop('disabled', disable);
            }
        }

        $('#create').submit(function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            reEnable(false);
            console.log("data:", $(this).serialize());

            swal.fire({
                text: "Silahkan tunggu....",
                allowEscapeKey: false,
                allowOutsideClick: false,
                onOpen: () => {
                    swal.showLoading();
                }
            });
            $.ajax({
                url: base_url + "cbtjadwal/saveJadwal",
                type: "POST",
                data: $(this).serialize(),
                success: function (data) {
                    reEnable(true);
                    if (data.success) {
                        swal.fire({
                            title: "Sukses",
                            text: data.message,
                            icon: "success",
                            showCancelButton: false,
                        }).then(result => {
                            if (result.value) {
                                window.location.href = base_url + 'cbtjadwal';
                            }
                        });
                    } else {
                        swal.fire({
                            title: "Error",
                            text: data.message,
                            icon: "error"
                        });
                    }
                }, error: function (xhr, status, error) {
                    console.log("error", xhr.responseText);
                    reEnable(true);
                    swal.fire({
                        title: "Error",
                        text: "Terjadi kesalahan",
                        icon: "error"
                    });
                }
            });
        });

        function getBankMapel(mapel) {
            if (!mapel) {
                selBank.html('<option value="" ' + selec + '>Pilih Bank Soal:</option>');
                return;
            }
            $.ajax({
                url: base_url + "cbtjadwal/getbankmapel/" + mapel,
                type: "GET",
                success: function (data) {
                    console.log('bank', data);
                    selBank.html('<option value="" ' + selec + '>Pilih Bank Soal:</option>');
                    $.each(data.bank, function (i, v) {
                        var selected = i === idBank ? 'selected' : '';
                        const digunakan = data.jadwal.includes(i);
                        const disable = digunakan && i !== idBank ? ' disabled="disabled"': '';
                        const terjadwal = digunakan ? ' (terjadwal)' : '';
                        if (i !== '') selBank.append('<option value="' + i + '" ' + selected + disable + '>' + v + ' ' + terjadwal + '</option>');
                    });
                    allKelas = data.all_kelas || [];
                    kelasBank = data.kelas || [];
                }, error: function (xhr, status, error) {
                    console.log("error", xhr.responseText);
                }
            });
        }

        selMapel.on('change', function () {
            getBankMapel($(this).val());
        });

        selBank.on('change', function () {
            let kelas = '';
            let no = 1;
            if (kelasBank[$(this).val()]) {
                console.log('kelas', kelasBank[$(this).val()])
                kelasBank[$(this).val()].forEach(k => {
                    const kls = allKelas.find(x => x.id_kelas == k.kelas_id);
                    if (kls) {
                        kelas += ` <span class="badge text-bg-btn text-bg-info">${kls.nama_kelas}</span> `;
                        no++;
                    }
                });
            }
            console.log(kelas)
            if (kelas !== '') {
                $('#info-kelas').removeClass('d-none');
                $('#info-kelas-bank').html(kelas);
            } else {
                $('#info-kelas').addClass('d-none');
                $('#info-kelas-bank').html('');
            }
        });

        getBankMapel(selMapel.val());
    });
</script>
<?= $this->endSection() ?>
