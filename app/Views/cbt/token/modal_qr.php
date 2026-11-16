<!-- Modal QR Code Token Ujian (Admin / Pengawas / Guru) -->
<div class="modal fade" id="modalQrToken" tabindex="-1" aria-labelledby="modalQrTokenLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg text-center" style="border-radius: 18px; overflow: hidden; background: #ffffff;">
            <div class="modal-header text-white py-3 border-0" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);">
                <div class="w-100 position-relative">
                    <h5 class="modal-title fw-bold text-white d-flex align-items-center justify-content-center mb-0" id="modalQrTokenLabel">
                        <i class="fa fa-qrcode me-2"></i> QR CODE TOKEN UJIAN
                    </h5>
                    <button type="button" class="btn-close btn-close-white position-absolute top-50 end-0 translate-middle-y" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-4 bg-light">
                <p class="text-muted small mb-3">Tampilkan QR Code ini di layar atau proyektor ruangan agar siswa dapat melakukan <b>Scan QR</b> pada halaman Konfirmasi Ujian.</p>

                <!-- QR Container Box -->
                <div class="d-inline-flex p-3 bg-white rounded-4 shadow-sm border mx-auto mb-3" style="min-width: 250px; min-height: 250px; align-items: center; justify-content: center;">
                    <div id="modal-qrcode-target"></div>
                </div>

                <!-- Token Text Display -->
                <div class="my-2">
                    <span class="text-muted small text-uppercase fw-bold d-block mb-1" style="letter-spacing: 1.5px;">TOKEN SAAT INI</span>
                    <div class="d-inline-block bg-white px-4 py-2 rounded-3 border shadow-sm">
                        <span id="modal-token-text" class="fw-bold text-primary" style="font-family: 'JetBrains Mono', 'Arial Black', Impact, monospace; font-size: 2.4rem; letter-spacing: 8px;">------</span>
                    </div>
                </div>

                <!-- Live Countdown Timer Info -->
                <div id="modal-token-timer-box" class="mt-3">
                    <span class="badge bg-danger fs-6 px-3 py-2 shadow-sm rounded-pill">
                        <i class="fa fa-clock me-1"></i> Berganti otomatis dalam: <b id="modal-token-timer">-- : -- : --</b>
                    </span>
                </div>
            </div>
            <div class="modal-footer bg-white py-2 px-3 border-top justify-content-between">
                <button type="button" class="btn btn-outline-primary btn-sm fw-semibold shadow-sm" onclick="toggleQrFullscreen()">
                    <i class="fa fa-expand me-1"></i> Mode Layar Penuh (Proyektor)
                </button>
                <button type="button" class="btn btn-secondary btn-sm px-4 fw-bold shadow-sm" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal QR Code Buka Kunci / Keluar Ujian (Admin / Pengawas / Guru) -->
<div class="modal fade" id="modalQrExit" tabindex="-1" aria-labelledby="modalQrExitLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg text-center" style="border-radius: 18px; overflow: hidden; background: #ffffff;">
            <div class="modal-header text-white py-3 border-0" style="background: linear-gradient(135deg, #065f46 0%, #047857 100%);">
                <div class="w-100 position-relative">
                    <h5 class="modal-title fw-bold text-white d-flex align-items-center justify-content-center mb-0" id="modalQrExitLabel">
                        <i class="fa fa-qrcode me-2"></i> QR CODE BUKA KUNCI UJIAN
                    </h5>
                    <button type="button" class="btn-close btn-close-white position-absolute top-50 end-0 translate-middle-y" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body p-4 bg-light">
                <p class="text-muted small mb-3">Tampilkan QR Code ini agar siswa/pengawas dapat melakukan <b>Pindai QR Pengawas</b> pada aplikasi ujian di HP/Tablet siswa.</p>

                <!-- QR Container Box -->
                <div class="d-inline-flex p-3 bg-white rounded-4 shadow-sm border mx-auto mb-3" style="min-width: 250px; min-height: 250px; align-items: center; justify-content: center;">
                    <div id="modal-qrcode-exit-target"></div>
                </div>

                <!-- Exit Code Text Display -->
                <div class="my-2">
                    <span class="text-muted small text-uppercase fw-bold d-block mb-1" style="letter-spacing: 1.5px;">KODE BUKA KUNCI SAAT INI</span>
                    <div class="d-inline-block bg-white px-4 py-2 rounded-3 border shadow-sm">
                        <span id="modal-exit-code-text" class="fw-bold text-success" style="font-family: 'JetBrains Mono', 'Arial Black', Impact, monospace; font-size: 2.4rem; letter-spacing: 8px;">------</span>
                    </div>
                </div>

                <div class="text-muted small mt-3">
                    <i class="fa fa-info-circle me-1 text-success"></i> Sinkron realtime dengan APK Android. Pengawas/siswa tinggal arahkan kamera.
                </div>
            </div>
            <div class="modal-footer bg-white py-2 px-3 border-top justify-content-between">
                <button type="button" class="btn btn-outline-success btn-sm fw-semibold shadow-sm" onclick="toggleQrExitFullscreen()">
                    <i class="fa fa-expand me-1"></i> Mode Layar Penuh (Proyektor)
                </button>
                <button type="button" class="btn btn-secondary btn-sm px-4 fw-bold shadow-sm" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/app/js/qrcode.min.js') ?>"></script>
<script>
    var qrGeneratorObj = null;
    var qrExitGeneratorObj = null;

    function showQrTokenModal() {
        var currentToken = '';
        if ($('#token-view').length && $('#token-view').text().trim() && $('#token-view').text().trim() !== '------') {
            currentToken = $('#token-view').text().trim();
        } else if ($('#token-input').length && $('#token-input').val()) {
            currentToken = $('#token-input').val().trim();
        } else if (window.globalToken && window.globalToken.token) {
            currentToken = window.globalToken.token;
        } else if (typeof globalToken !== 'undefined' && globalToken && globalToken.token) {
            currentToken = globalToken.token;
        }

        if (!currentToken || currentToken === '------') {
            currentToken = 'GARUDA';
        }

        $('#modal-token-text').text(currentToken);

        var target = document.getElementById("modal-qrcode-target");
        if (target && typeof QRCode !== 'undefined') {
            target.innerHTML = '';
            qrGeneratorObj = new QRCode(target, {
                text: currentToken,
                width: 220,
                height: 220,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
        }

        if ($('#interval').length && !$('#interval').hasClass('d-none')) {
            $('#modal-token-timer-box').show();
            $('#modal-token-timer').text($('#interval').text());
        } else {
            $('#modal-token-timer-box').hide();
        }

        var modalEl = document.getElementById('modalQrToken');
        if (modalEl && typeof bootstrap !== 'undefined') {
            var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.show();
        }
    }

    function showQrExitModal() {
        var currentExitCode = '';
        if ($('#kiosk-exit-code-view').length && $('#kiosk-exit-code-view').text().trim() && $('#kiosk-exit-code-view').text().trim() !== '------') {
            currentExitCode = $('#kiosk-exit-code-view').text().trim();
        }

        if (!currentExitCode || currentExitCode === '------') {
            currentExitCode = '123456';
        }

        $('#modal-exit-code-text').text(currentExitCode);

        var target = document.getElementById("modal-qrcode-exit-target");
        if (target && typeof QRCode !== 'undefined') {
            target.innerHTML = '';
            qrExitGeneratorObj = new QRCode(target, {
                text: currentExitCode,
                width: 220,
                height: 220,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
        }

        var modalEl = document.getElementById('modalQrExit');
        if (modalEl && typeof bootstrap !== 'undefined') {
            var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.show();
        }
    }

    function updateQrModalToken(tokenStr, timerStr) {
        var modalEl = document.getElementById('modalQrToken');
        if (modalEl && modalEl.classList.contains('show')) {
            if (tokenStr && $('#modal-token-text').text() !== tokenStr) {
                $('#modal-token-text').text(tokenStr);
                var target = document.getElementById("modal-qrcode-target");
                if (target && typeof QRCode !== 'undefined') {
                    target.innerHTML = '';
                    new QRCode(target, {
                        text: tokenStr,
                        width: 220,
                        height: 220,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H
                    });
                }
            }
            if (timerStr) {
                $('#modal-token-timer').text(timerStr);
            }
        }
    }

    function toggleQrFullscreen() {
        var elem = document.querySelector("#modalQrToken .modal-content");
        if (!elem) return;
        if (!document.fullscreenElement) {
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.webkitRequestFullscreen) {
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) {
                elem.msRequestFullscreen();
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            }
        }
    }

    function toggleQrExitFullscreen() {
        var elem = document.querySelector("#modalQrExit .modal-content");
        if (!elem) return;
        if (!document.fullscreenElement) {
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.webkitRequestFullscreen) {
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) {
                elem.msRequestFullscreen();
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            }
        }
    }
</script>
