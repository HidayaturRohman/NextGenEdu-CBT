<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

<div class="d-contents">
    <!-- Top Header Card (Diseragamkan dengan Sesi Ujian) -->
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
    
    <!-- Main Card (Diseragamkan dengan Sesi Ujian) -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <div class="header-title">
            <h4 class="card-title d-flex align-items-center mb-0">
                <svg class="icon-24 text-primary me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.778-7.778zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path></svg> <?= isset($subjudul) ? $subjudul : $judul ?>
            </h4>
          </div>
        </div>

        <div class="card-body p-4">
            <!-- Top Green Alert Box -->
            <div class="alert alert-success border-success text-success mb-4 p-3 shadow-sm rounded" style="background-color: #e8f8f0; border-color: #b7ebcd; color: #155724;">
                <ul class="mb-0 ps-3" style="list-style-type: disc;">
                    <li class="mb-1">
                        Jika mengklik <span class="badge bg-success" style="background-color: #28a745 !important;"><i class="fa fa-bolt me-1"></i> GENERATE</span> segera beritahukan guru/admin lain yang sedang login agar merefresh token untuk mendapatkan token terbaru.
                    </li>
                    <li>
                        Token akan digenerate otomatis jika :
                        <ul class="ps-3 mt-1" style="list-style-type: circle;">
                            <li>pilihan <b>Otomatis: YA</b>.</li>
                            <li>ada jadwal ujian pada hari ini.</li>
                            <li>ada akun Admin/Pengawas yang login minimal 1 akun.</li>
                        </ul>
                    </li>
                </ul>
            </div>

            <!-- Blue Header Section: Pengaturan Token -->
            <div class="bg-primary text-white p-3 rounded-top d-flex align-items-center fw-bold" style="background-color: #007bff !important;">
                <i class="fa fa-cog me-2"></i> Pengaturan Token
            </div>

            <!-- Content Body Box -->
            <div class="border border-top-0 rounded-bottom p-4 bg-white mb-2">
                <div class="row align-items-center">
                    <!-- Left Column: Settings -->
                    <div class="col-12 col-lg-4 border-end-lg pe-lg-4 mb-4 mb-lg-0">
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-dark mb-1"><i class="fa fa-cog me-1 text-secondary"></i> Otomatis ?</label>
                            <?php
                            $arrVal = ["TIDAK", "YA"];
                            echo form_dropdown(
                                'auto',
                                $arrVal,
                                $token->auto,
                                'id="auto" class="form-select"'
                            ); ?>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-dark mb-1"><i class="fa fa-info-circle me-1 text-secondary"></i> Interval (menit)</label>
                            <input id="jarak" type="number" min="1" class="form-control" name="jarak"
                                   value="<?= $token->jarak ?>" <?= $token->auto == '0' ? 'disabled="disabled"' : '' ?>>
                        </div>

                        <button id="btn-simpan" type="button" onclick="simpanToken('0')" class="btn text-white w-100 fw-bold shadow-sm" style="background-color: #008b8b; border-color: #008b8b;">
                            <i class="fa fa-save me-1"></i> Simpan Interval Token
                        </button>
                    </div>

                    <!-- Middle Column: Current Token View -->
                    <div class="col-12 col-lg-4 text-center my-auto py-3 border-end-lg pe-lg-4 mb-4 mb-lg-0">
                        <span class="text-muted fw-bold small text-uppercase" style="letter-spacing: 1.5px; color: #64748b;">TOKEN SAAT INI</span>
                        <h1 id="token-view" class="display-3 fw-bold text-primary my-2" style="font-family: 'JetBrains Mono', 'Chakra Petch', monospace; letter-spacing: 8px; font-weight: 800; text-shadow: 0 3px 10px rgba(29, 78, 216, 0.2);">
                            <?= $token->token != '' ? $token->token : 'GARUDA' ?>
                        </h1>
                        <small id="info-interval" class="mt-2 text-center <?= $token->auto == '0' ? 'd-none' : '' ?> text-muted">
                            Token akan dibuat otomatis dalam <b id="interval" class="text-danger fw-bold">-- : -- : --</b>
                        </small>
                        <div class="mt-3">
                            <button type="button" class="btn btn-outline-primary btn-sm fw-semibold shadow-sm px-3" onclick="showQrTokenModal()">
                                <i class="fa fa-qrcode me-1"></i> Tampilkan QR Code
                            </button>
                        </div>
                    </div>

                    <!-- Right Column: Manual Generate -->
                    <div class="col-12 col-lg-4 ps-lg-4 my-auto">
                        <label class="form-label fw-bold text-warning mb-2" style="color: #ff9900 !important;">
                            <i class="fa fa-key me-1"></i> Generate Manual
                        </label>
                        <div class="input-group mb-2">
                            <input type="text" id="custom_token" class="form-control text-uppercase" placeholder="INPUT TOKEN . . ." style="letter-spacing: 1px; font-weight: 600;">
                            <button id="generate" onclick="generateManual()" class="btn btn-success fw-bold px-3" style="background-color: #28a745; border-color: #28a745;">
                                <i class="fa fa-bolt me-1"></i> GENERATE
                            </button>
                        </div>
                        <small class="text-muted d-block mt-1" style="font-size: 0.82rem;">
                            <i class="fa fa-info-circle text-primary me-1"></i> Isi token custom atau kosongkan untuk acak
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('cbt/token/modal_qr') ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    var globalToken = window.globalToken || null;
    var customToken = '';
    var forceGenerate = 0;

    function getSafeGlobalToken() {
        if (!window.globalToken || typeof window.globalToken !== 'object') {
            window.globalToken = {
                token: '<?= $token->token ?>',
                auto: '<?= $token->auto ?>',
                jarak: '<?= $token->jarak ?>',
                updated: '<?= $token->updated ?>',
                now: '<?= $token->now ?? date('Y-m-d H:i:s') ?>'
            };
        }
        globalToken = window.globalToken;
        return window.globalToken;
    }

    function generateManual() {
        customToken = $('#custom_token').val().trim();
        forceGenerate = 1;
        getSafeGlobalToken();
        generateTokenCustom('generate');
        $('#custom_token').val('');
    }

    function generateTokenCustom(source) {
        if (typeof ajaxcsrf === 'function') ajaxcsrf();
        var tokenData = getSafeGlobalToken();
        var btnSimpan = $('#btn-simpan');
        var btnGenerate = $('#generate');

        if (source === 'simpan') {
            btnSimpan.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Menyimpan...');
        } else if (source === 'generate') {
            btnGenerate.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> GENERATING...');
        }

        var postUrl = (typeof base_url !== 'undefined' ? base_url : '<?= rtrim(base_url(), '/') . '/' ?>') + "cbttoken/generatetoken";

        $.ajax({
            url: postUrl,
            type: "POST",
            dataType: "JSON",
            data: {
                data: JSON.stringify(tokenData),
                action: source,
                source: source,
                auto: tokenData.auto,
                jarak: tokenData.jarak,
                force: forceGenerate,
                custom: customToken
            },
            success: function (response) {
                btnSimpan.prop('disabled', false).html('<i class="fa fa-save me-1"></i> Simpan Interval Token');
                btnGenerate.prop('disabled', false).html('<i class="fa fa-bolt me-1"></i> GENERATE');

                if (typeof response === 'string') {
                    try { response = JSON.parse(response); } catch(e) {}
                }
                if (!response || !response.token) {
                    console.error('Invalid token response', response);
                    return;
                }

                window.globalToken = response;
                globalToken = response;
                localStorage.setItem('nextgenCBT.token', JSON.stringify(response));

                if (response.ada_ujian !== undefined) {
                    window.adaJadwalUjian = response.ada_ujian;
                    localStorage.setItem('nextgenCBT.ada_jadwal_ujian', response.ada_ujian);
                }

                $('#token-view').text(response.token || 'GARUDA');
                $('#auto').val(response.auto);
                $('#jarak').val(response.jarak);

                if (String(response.auto) === '0') {
                    $('#jarak').prop('disabled', true);
                    $('#info-interval').addClass('d-none');
                    $('#interval').addClass('d-none');
                    if (window.timerToken) {
                        clearTimeout(window.timerToken);
                        window.timerToken = null;
                    }
                } else {
                    $('#jarak').prop('disabled', false);
                    $('#info-interval').removeClass('d-none');
                    $('#interval').removeClass('d-none');
                    if (typeof createIntervalToken === 'function') {
                        createIntervalToken();
                    }
                }

                var sweet = (typeof Swal !== 'undefined') ? Swal : ((typeof swal !== 'undefined') ? swal : null);

                if (source === 'simpan') {
                    if (sweet && typeof sweet.fire === 'function') {
                        sweet.fire({
                            icon: 'success',
                            title: 'Berhasil Disimpan',
                            text: (String(response.auto) === '1')
                                ? 'Interval token otomatis berhasil disimpan: per ' + response.jarak + ' menit.'
                                : 'Pengaturan berhasil disimpan: Token Otomatis dimatikan.',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else if (typeof showSuccessToast === 'function') {
                        showSuccessToast('Pengaturan Token berhasil disimpan');
                    }
                } else if (source === 'generate') {
                    if (sweet && typeof sweet.fire === 'function') {
                        sweet.fire({
                            icon: 'success',
                            title: 'Token Baru',
                            html: 'Token ujian saat ini: <strong class="fs-4 text-primary">' + response.token + '</strong>',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else if (typeof showSuccessToast === 'function') {
                        showSuccessToast('Token berhasil digenerate');
                    }
                }
            },
            error: function (xhr, status, error) {
                console.error('Error saving token:', xhr);
                btnSimpan.prop('disabled', false).html('<i class="fa fa-save me-1"></i> Simpan Interval Token');
                btnGenerate.prop('disabled', false).html('<i class="fa fa-bolt me-1"></i> GENERATE');

                var sweet = (typeof Swal !== 'undefined') ? Swal : ((typeof swal !== 'undefined') ? swal : null);
                if (sweet && typeof sweet.fire === 'function') {
                    sweet.fire({
                        icon: 'error',
                        title: 'Gagal Menyimpan',
                        text: 'Terjadi kesalahan pada server saat menyimpan token (' + (xhr.statusText || status) + ')'
                    });
                } else if (typeof showDangerToast === 'function') {
                    showDangerToast('Gagal menyimpan pengaturan token');
                }
            }
        });
    }

    function simpanToken(force) {
        customToken = '';
        var auto = $('#auto').val();
        var jarak = $('#jarak').val();

        if (String(auto) === '1' && (!jarak || parseInt(jarak) < 1)) {
            var sweet = (typeof Swal !== 'undefined') ? Swal : ((typeof swal !== 'undefined') ? swal : null);
            if (sweet && typeof sweet.fire === 'function') {
                sweet.fire({
                    title: "Perhatian",
                    text: "Interval menit harus diisi dan minimal 1 menit",
                    icon: "warning"
                });
            } else {
                alert("Interval menit harus diisi dan minimal 1 menit");
            }
            return;
        }

        var tokenData = getSafeGlobalToken();
        forceGenerate = 0;
        tokenData.auto = String(auto);
        tokenData.jarak = String(jarak || '15');
        generateTokenCustom('simpan');
    }

    window.simpanToken = simpanToken;
    window.generateManual = generateManual;
    window.generateTokenCustom = generateTokenCustom;

    $(document).ready(function () {
        var tokenData = getSafeGlobalToken();
        window.adaJadwalUjian = '<?= $ada_ujian ?? 1 ?>';
        localStorage.setItem('nextgenCBT.ada_jadwal_ujian', window.adaJadwalUjian);

        $('#auto').val(tokenData.auto);
        $('#jarak').val(tokenData.jarak);
        $('#jarak').prop('disabled', String(tokenData.auto) === '0');

        if (String(tokenData.auto) === '0') {
            $('#info-interval').addClass('d-none');
            $('#interval').addClass('d-none');
            if (window.timerToken) {
                clearTimeout(window.timerToken);
                window.timerToken = null;
            }
        } else {
            $('#info-interval').removeClass('d-none');
            $('#interval').removeClass('d-none');
            if (typeof createIntervalToken === 'function') {
                createIntervalToken();
            }
        }

        $('#auto').on('change', function () {
            var idAuto = $(this).val();
            var tData = getSafeGlobalToken();
            tData.auto = idAuto;
            $('#jarak').prop('disabled', String(idAuto) === '0');
            if (String(idAuto) === '0') {
                $('#info-interval').addClass('d-none');
                $('#interval').addClass('d-none');
                if (window.timerToken) {
                    clearTimeout(window.timerToken);
                    window.timerToken = null;
                }
            } else {
                $('#info-interval').removeClass('d-none');
                $('#interval').removeClass('d-none');
                if (typeof createIntervalToken === 'function') {
                    createIntervalToken();
                }
            }
        });

        $('#btn-simpan').off('click').on('click', function (e) {
            e.preventDefault();
            simpanToken('0');
        });
    });
</script>
<?= $this->endSection() ?>
