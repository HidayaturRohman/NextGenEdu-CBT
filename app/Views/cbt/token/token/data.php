<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hidayatur Rohman
 * Date: 07/07/20
 * Time: 17:20
 */
?>

<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>
<div class="d-contents">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="me-3 flex-shrink-0">
            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #c026d3 0%, #9333ea 100%); color: #ffffff;">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.778-7.778zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path>
              </svg>
            </div>
          </div>
          <div>
            <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                <?= $judul ?>
            </h4>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Pengaturan token keamanan ujian, auto-generate rilis token, dan durasi keaktifan token.</p>
          </div>
        </div>
      </div>
    </div>
    
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <div class="header-title">
            <h4 class="card-title d-flex align-items-center">
                <svg class="icon-24 text-primary me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> <?= isset($subjudul) ? $subjudul : $judul ?>
            </h4>
          </div>
          <div class="card-tools d-flex gap-2">
                        <button id="generate" onclick="simpanToken('1')" class="btn btn-success">
                            GENERATE NEW TOKEN
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="alert border border-success alert-default-success pt-3">
                                <ul>
                                    <li>
                                        Jika mengklik <span class="badge badge-btn btn-success"> GENERATE NEW TOKEN</span>
                                        segera beritahukan guru/admin lain yang sedang login agar merefresh token untuk
                                        mendapatkan token terbaru.
                                    </li>
                                    <li>
                                        Token akan digenerate otomatis jika :
                                        <ul>
                                            <li>
                                                pilihan <b>Otomatis: YA</b>.
                                            </li>
                                            <li>
                                                ada jadwal ujian pada hari ini.
                                            </li>
                                            <li>
                                                ada akun Admin/Pengawas yang login minimal 1 akun.
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 p-1">
                            <div class="card border border-light" id="card-set">
                                <div class="row card-body">
                                    <div class="col-6">
                                        <label>Otomatis ?</label>
                                        <?php
                                        $arrVal = ["TIDAK", "YA"];
                                        echo form_dropdown(
                                            'auto',
                                            $arrVal,
                                            $token->auto,
                                            'id="auto" class="form-control"'
                                        ); ?>
                                    </div>
                                    <div class="col-6">
                                        <label>Interval (menit)</label>
                                        <input id="jarak" type="number" class="form-control" name="jarak"
                                               value="<?= $token->jarak ?>" <?= $token->auto == '0' ? 'disabled="disabled"' : '' ?>>
                                        <button id="generate" onclick="simpanToken('1')" class="shadow-sm btn-sm btn btn-primary"><svg class="icon-20 me-1" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg><span class="d-none d-sm-inline-block ms-1">Simpan</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 p-1">
                            <div class="card card-light p-4" id="card-view">
                                <div class="text-center my-auto">
                                    <span>TOKEN SAAT INI</span>
                                    <h1 id="token-view"><?= $token->token ?></h1>
                                    <small id="info-interval" class="mt-3 text-center d-none">Token akan dibuat otomatis dalam <b
                                                id="interval">-- : -- : --</b></small>
                                </div>
                            </div>
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
    function simpanToken(force) {
        var auto = $('#auto').val();
        var jarak = $('#jarak').val();
        if (auto == '1' && jarak == '0') {
            swal.fire({
                title: "Ups!",
                text: "Interval menit harus diisi",
                icon: "warning"
            });
        } else {
            if (force === '1') {
                forceGenerate = 1;
            } else {
                if (auto === globalToken.auto && jarak === globalToken.jarak) {
                    forceGenerate = 0;
                } else {
                    forceGenerate = 1
                }
            }

            globalToken.auto = auto;
            globalToken.jarak = jarak;
            generateToken();
            showSuccessToast('Token berhasil disimpan')
        }
    }

    $(document).ready(function () {
        $('#auto').on('change', function () {
            var idAuto = $(this).val();
            var token = {};
            token ["token"] = globalToken.token;
            token ["auto"] = idAuto;
            $('#jarak').prop('disabled', idAuto == '0');
        });

        console.log('height', $("#card-set").height());
        $("#card-view").css({'height':($("#card-set").height()+'px')});
    });
</script>


<?= $this->endSection() ?>
