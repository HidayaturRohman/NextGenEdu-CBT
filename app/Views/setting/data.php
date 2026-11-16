<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<?php
$satuan = ["1" => ["SD", "MI"], "2" => ["SMP", "MTS"], "3" => ["SMA", "MA", "SMK"]];
$schInfo = detectSchoolType($setting);
$kepsekText = $schInfo->kepsek_label ?? 'Kepala Sekolah';
?>
<div class="d-contents">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="me-3 flex-shrink-0">
            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: #ffffff;">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="3"></circle>
                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
              </svg>
            </div>
          </div>
          <div>
            <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                <?= $judul ?>
            </h4>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Konfigurasi profil sekolah, preferensi aplikasi CBT, kustomisasi logo, dan pengaturan server.</p>
          </div>
        </div>
      </div>
    </div>

  <div class="app-content">
        <div class="container-fluid">
            <div class="card my-shadow">
                <div class="card-header">
                    <div class="card-title">
                        <h6>Setting</h6>
                    </div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary btn-sm" onclick="submitSetting()">
                            <i class="fa fa-save me-1"></i>Simpan
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <?= form_open('', array('id' => 'savesetting')) ?>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label>Nama Aplikasi *</label>
                            <input type="text" name="nama_aplikasi" class="form-control required"
                                   value="<?= $setting->nama_aplikasi ?>">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label>Nama Sekolah *</label>
                            <input type="text" name="nama_sekolah" class="form-control required"
                                   value="<?= $setting->sekolah ?>" required>
                        </div>
                        <div class="col-md-3 mb-4">
                            <label>NSS/NSM</label>
                            <input type="number" name="nss" class="form-control" value="<?= $setting->nss ?>">
                        </div>
                        <div class="col-md-3 mb-4">
                            <label>NPSN</label>
                            <input type="number" name="npsn" class="form-control" value="<?= $setting->npsn ?>">
                        </div>
                        <div class="col-md-3 mb-4">
                            <label>Jenjang *</label>
                            <select id="jenjang" class="form-control required" data-placeholder="Pilih Jenjang"
                                    name="jenjang" required>
                                <option value="" disabled>Pilih Jenjang</option>
                                <?php
                                $jenjang = ["SD/MI", "SMP/MTS", "SMA/MA/SMK"];
                                for ($i = 0; $i < 3; $i++) {
                                    $arrJenjang[$i + 1] = $jenjang[$i];
                                }
                                foreach ($arrJenjang as $key => $val) :
                                    $selected = $setting->jenjang == $key ? 'selected' : '';
                                    ?>
                                    <option value="<?= $key ?>" <?= $selected ?>><?= $val ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-4">
                            <label>Satuan Pend. *</label>
                            <select id="satuan-pend" class="form-control required" data-placeholder="Satuan Pendidikan"
                                    name="satuan_pendidikan" required>
                                <option value="0" disabled>Satuan Pendidikan</option>
                                <?php
                                $satuan_selected = $satuan[$setting->jenjang];
                                $arrSatuan = [];
                                for ($i = 0; $i < count($satuan_selected); $i++) {
                                    $arrSatuan[$i + 1] = $satuan_selected[$i];
                                }
                                foreach ($arrSatuan as $keys => $vals) :
                                    $selecteds = $setting->satuan_pendidikan == $keys ? 'selected' : '';
                                    ?>
                                    <option value="<?= $keys ?>" <?= $selecteds ?>><?= $vals ?></option>
                                <?php endforeach; ?>
                            </select>
                            <small class="form-text text-muted mt-1 d-block" style="font-size: 11px;">
                                <i class="fas fa-info-circle text-info me-1"></i>Pilihan ini otomatis mengaktifkan format Rapor, Kokurikuler, & Kartu Presensi (SD/SMP/SMA = Diknas, MI/MTs/MA = Kemenag).
                            </small>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label>Alamat *</label>
                            <br>
                            <textarea class="w-100 p-2 required" name="alamat" rows="5" required><?= $setting->alamat ?></textarea>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label>Desa/Kelurahan *</label>
                                    <input type="text" name="desa" class="form-control required" value="<?= $setting->desa ?>" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label>Kecamatan *</label>
                                    <input type="text" name="kec" class="form-control required" value="<?= $setting->kecamatan ?>" required>
                                </div>
                                <div class="col-md-5 mb-4">
                                    <label>Kabupaten/Kota *</label>
                                    <input type="text" name="kota" class="form-control required" value="<?= $setting->kota ?>" required>
                                </div>
                                <div class="col-md-2 mb-4">
                                    <label>Kode Pos</label>
                                    <input type="text" name="kode_pos" class="form-control" value="<?= $setting->kode_pos ?>">
                                </div>
                                <div class="col-md-5 mb-4">
                                    <label>Provinsi *</label>
                                    <input type="text" name="provinsi" class="form-control required" value="<?= $setting->provinsi ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <label>Faksimili</label>
                            <input type="text" name="fax" class="form-control" value="<?= $setting->fax ?>">
                        </div>
                        <div class="col-md-3 mb-4">
                            <label>Website</label>
                            <input type="text" name="web" class="form-control" value="<?= $setting->web ?>">
                        </div>
                        <div class="col-md-3 mb-4">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="<?= $setting->email ?>">
                        </div>
                        <div class="col-md-3 mb-4">
                            <label>Nomor Telepon</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">+62</span>
                                </div>
                                <input type="number" name="tlp" class="form-control" value="<?= $setting->telp ?>">
                            </div>
                        </div>
                        <div class="col-md-5 mb-4">
                            <label><?= esc($kepsekText) ?> *</label>
                            <input type="text" name="kepsek" class="form-control required" value="<?= $setting->kepsek ?>" required>
                        </div>
                        <div class="col-md-3 mb-4">
                            <label><span id="label-nip-text"><?= esc($setting->label_nip ?? 'NIP') ?></span> <?= esc($kepsekText) ?></label>
                            <input type="text" name="nip" class="form-control" value="<?= esc($setting->nip ?? '') ?>" placeholder="Nomor ID <?= esc($kepsekText) ?>">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label>Jenis ID Guru & <?= esc($kepsekText) ?>
                                <small class="text-muted">(NIP, NUPTK, NPK, PegID, dsb)</small>
                            </label>
                            <?php
                            $currentLabel = $setting->label_nip ?? 'NIP';
                            $presets = ['NIP', 'NUPTK', 'NPK', 'PegID'];
                            $isCustom = !in_array($currentLabel, $presets);
                            ?>
                            <div class="input-group">
                                <select id="select-label-nip" class="form-control"
                                        onchange="var val=this.value==='Lainnya'?'':this.value; document.getElementById('input-label-nip').value=val; document.getElementById('custom-label-nip').style.display=this.value==='Lainnya'?'block':'none'; document.getElementById('label-nip-text').innerText=val||'NIP';">
                                    <option value="NIP"    <?= $currentLabel==='NIP'    ?'selected':'' ?>>NIP</option>
                                    <option value="NUPTK"  <?= $currentLabel==='NUPTK'  ?'selected':'' ?>>NUPTK</option>
                                    <option value="NPK"    <?= $currentLabel==='NPK'    ?'selected':'' ?>>NPK</option>
                                    <option value="PegID"  <?= $currentLabel==='PegID'  ?'selected':'' ?>>PegID</option>
                                    <option value="Lainnya" <?= $isCustom?'selected':'' ?>>Lainnya (custom)...</option>
                                </select>
                            </div>
                            <div id="custom-label-nip" class="mt-1" style="display:<?= $isCustom?'block':'none' ?>">
                                <input type="text" id="input-label-nip" name="label_nip"
                                       class="form-control"
                                       placeholder="Ketik label, misal: No Registrasi"
                                       value="<?= htmlspecialchars($currentLabel) ?>"
                                       oninput="document.getElementById('label-nip-text').innerText=this.value||'NIP';">
                                <small class="text-muted">Digunakan di seluruh dokumen cetak, kartu, & rapor.</small>
                            </div>
                        </div>
                    </div>
                    <?= form_close() ?>
                    <?php
                    $checkLogoUrl = function($val) {
                        if (empty($val) || trim($val) === '') return '';
                        $clean = preg_replace('/\?.*$/', '', $val);
                        $clean = ltrim(trim($clean), '/');
                        if ($clean === 'uploads/settings' || $clean === 'uploads/settings/') return '';
                        $baseName = basename($clean);
                        $dirs = [
                            rtrim(FCPATH, '/\\') . '/uploads/settings/',
                            rtrim(ROOTPATH, '/\\') . '/uploads/settings/',
                            rtrim(ROOTPATH, '/\\') . '/public/uploads/settings/',
                        ];
                        $found = false;
                        $mtime = 0;
                        foreach ($dirs as $d) {
                            if (is_file($d . $baseName) && filesize($d . $baseName) > 0) {
                                $found = true;
                                $mtime = @filemtime($d . $baseName);
                                break;
                            }
                        }
                        if (!$found) return '';
                        return base_url('uploads/settings/' . $baseName);
                    };

                    $urlTanda = $checkLogoUrl($setting->tanda_tangan ?? '');
                    $urlKiri  = $checkLogoUrl($setting->logo_kiri ?? '');
                    $urlKanan = $checkLogoUrl($setting->logo_kanan ?? '');
                    ?>
                    <div class="row">
                        <div class="col-md-4">
                            <?= form_open_multipart('', array('id' => 'set-tandatangan')) ?>
                            <div class="form-group pb-2">
                                <label for="logo-kiri">Tandatangan</label>
                                <input type="file" id="tanda-tangan" name="logo" class="dropify"
                                       data-max-file-size-preview="2M" data-allowed-file-extensions="jpg jpeg png"
                                       <?= $urlTanda ? 'data-default-file="' . $urlTanda . '"' : '' ?>/>
                            </div>
                            <?= form_close() ?>
                        </div>
                        <div class="col-md-4">
                            <?= form_open_multipart('', array('id' => 'set-logo-kiri')) ?>
                            <div class="form-group pb-2">
                                <label for="logo-kiri">Logo Kiri / Logo Aplikasi</label>
                                <input type="file" id="logo-kiri" name="logo" class="dropify"
                                       data-max-file-size-preview="2M"
                                       data-allowed-file-extensions="jpg jpeg png"
                                       <?= $urlKiri ? 'data-default-file="' . $urlKiri . '"' : '' ?>/>
                            </div>
                            <?= form_close() ?>
                        </div>
                        <div class="col-md-4">
                            <?= form_open_multipart('', array('id' => 'set-logo-kanan')) ?>
                            <div class="form-group pb-2">
                                <label for="logo-kanan">Logo Kanan</label>
                                <input type="file" id="logo-kanan" name="logo" class="dropify"
                                       data-max-file-size-preview="2M"
                                       data-allowed-file-extensions="jpg jpeg png"
                                       <?= $urlKanan ? 'data-default-file="' . $urlKanan . '"' : '' ?>/>
                            </div>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    var logoKanan = "<?= $urlKanan ? ($setting->logo_kanan ?? '') : '' ?>";
    var logoKiri = "<?= $urlKiri ? ($setting->logo_kiri ?? '') : '' ?>";
    var tandatangan = "<?= $urlTanda ? ($setting->tanda_tangan ?? '') : '' ?>";
    var satuanPend = [[], ["SD", "MI"], ["SMP", "MTs"], ["SMA", "MA", "SMK"]];

    function submitSetting() {
        $('#savesetting').submit();
    }

    $(document).ready(function () {
        ajaxcsrf();

        var drEvent = $('.dropify').dropify();

        drEvent.on('dropify.errors', function (event, element) {
            console.log('Has Errors');
            $.toast({
                heading: "Error",
                text: "file rusak",
                icon: 'warning',
                showHideTransition: 'fade',
                allowToastClose: true,
                hideAfter: 5000,
                position: 'top-right'
            });
        });

        drEvent.on('dropify.afterClear', function (event, element) {
            var inputId = $(element.element).attr('id');
            if (inputId === 'logo-kiri') {
                logoKiri = '';
            } else if (inputId === 'logo-kanan') {
                logoKanan = '';
            } else if (inputId === 'tanda-tangan') {
                tandatangan = '';
            }
        });

        $('#jenjang').change(function () {
            var htmlOptions = '<option value="0" disabled="">Satuan Pendidikan</option>\n';
            var satSelected = satuanPend[$(this).val()];
            for (let i = 0; i < satSelected.length; i++) {
                htmlOptions += '<option value="' + (i + 1) + '">' + satSelected[i] + '</option>';
            }
            $('#satuan-pend').html(htmlOptions);
        });

        $('#savesetting').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            // Pastikan nilai label_nip tersinkronisasi jika preset dipilih
            var selLabel = $('#select-label-nip').val();
            if (selLabel && selLabel !== 'Lainnya') {
                $('#input-label-nip').val(selLabel);
            }

            var hasInput = true;
            $('.required').each(function () {
                if ($.trim($(this).val()) === "") {
                    hasInput = false;
                    $(this).focus();
                    return false;
                }
            });

            if (!hasInput) {
                Swal.fire({
                    title: "Peringatan",
                    text: "Isi semua pilihan yang bertanda bintang (*)",
                    icon: "warning"
                });
                return false;
            }

            Swal.fire({
                title: "Menyimpan...",
                text: "Silakan tunggu sebentar....",
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: function () {
                    Swal.showLoading();
                }
            });

            var postData = $(this).serialize() + '&logo_kanan=' + encodeURIComponent(logoKanan) + '&logo_kiri=' + encodeURIComponent(logoKiri) + '&tanda_tangan=' + encodeURIComponent(tandatangan);

            $.ajax({
                url: base_url + 'sekolah/savesetting',
                type: 'POST',
                data: postData,
                dataType: 'json',
                success: function (response) {
                    Swal.fire({
                        title: "Sukses",
                        text: (response && response.message) ? response.message : "Berhasil menyimpan pengaturan",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                    }).then(result => {
                        window.location.href = base_url + 'sekolah';
                    });
                },
                error: function (xhr, error, status) {
                    console.log('Error savesetting:', xhr.responseText);
                    var msg = "Gagal menyimpan pengaturan";
                    try {
                        var err = JSON.parse(xhr.responseText);
                        if (err && err.message) msg = err.message;
                    } catch (ex) {
                        if (xhr.statusText) msg += ' (' + xhr.statusText + ')';
                    }
                    Swal.fire({
                        title: "Error",
                        text: msg,
                        icon: "error"
                    });
                }
            });
        });

        $("#logo-kanan").change(function () {
            var input = $(this)[0];
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#prev-logo-kanan').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);

                var form = new FormData($('#set-logo-kanan')[0]);
                uploadAttach(base_url + 'sekolah/uploadfile/logo_kanan', form);
            }
        });

        $("#logo-kiri").change(function () {
            var input = $(this)[0];
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#prev-logo-kiri').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);

                var form = new FormData($('#set-logo-kiri')[0]);
                uploadAttach(base_url + 'sekolah/uploadfile/logo_kiri', form);
            }
        });

        $("#tanda-tangan").change(function () {
            var input = $(this)[0];
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    //style="font-family: 'Times New Roman'; font-size: 10pt; background: url('<?=base_url('assets/img/user.jpg')?>') no-repeat center; background-size: 100px 60px
                    $('#prev-tandatangan').css({'background': 'url(' + e.target.result + ') no-repeat center'}, {'font-family': 'Times New Roman'}, {'font-size': '10pt'}, {'background-size': '100px 60px'});
                    //$('#prev-tandatangan').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);

                var form = new FormData($('#set-tandatangan')[0]);
                uploadAttach(base_url + 'sekolah/uploadfile/tandatangan', form);
            }
        });

        function uploadAttach(action, data) {
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: action,
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    if (data && data.status) {
                        $.toast({
                            heading: "Sukses",
                            text: "File logo berhasil diunggah",
                            icon: 'success',
                            showHideTransition: 'fade',
                            allowToastClose: true,
                            hideAfter: 3500,
                            position: 'top-right'
                        });
                        var srcStr = String(data.rel || data.src || '');
                        var cleanStr = srcStr.split('?')[0];
                        if (srcStr.includes('kanan')) {
                            logoKanan = cleanStr;
                        } else if (srcStr.includes('kiri')) {
                            logoKiri = cleanStr;
                        } else if (srcStr.includes('tanda')) {
                            tandatangan = cleanStr;
                        }
                    } else {
                        var errMsg = (data && data.src) ? data.src : 'Gagal mengunggah file';
                        $.toast({
                            heading: "Gagal Unggah",
                            text: errMsg,
                            icon: 'error',
                            showHideTransition: 'fade',
                            allowToastClose: true,
                            hideAfter: 5000,
                            position: 'top-right'
                        });
                    }
                },
                error: function (e) {
                    console.log("error", e.responseText);
                    $.toast({
                        heading: "ERROR!!",
                        text: "File tidak terbaca atau server error",
                        icon: 'error',
                        showHideTransition: 'fade',
                        allowToastClose: true,
                        hideAfter: 5000,
                        position: 'top-right'
                    });
                }
            });
        }

        function deleteImage(src) {
            console.log(src);
            $.ajax({
                data: {src: src},
                type: "POST",
                url: base_url + "sekolah/deletefile",
                cache: false,
                success: function (response) {
                    console.log(response);
                }
            });
        }
    });

    // Removed obsolete JS for label_nip
</script>


<?= $this->endSection() ?>
