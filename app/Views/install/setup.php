<style>
:root {
    --primary: #4f46e5;
    --primary-hover: #4338ca;
    --bg-body: #f8fafc;
    --text-main: #0f172a;
    --text-muted: #64748b;
    --border: #e2e8f0;
    --shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
}

* {
    box-sizing: border-box;
}

body#page-top {
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background-color: var(--bg-body);
    background-image: radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.05) 0px, transparent 50%),
        radial-gradient(at 100% 100%, rgba(168, 85, 247, 0.05) 0px, transparent 50%);
    color: var(--text-main);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    position: relative;
    overflow-x: hidden;
}

.leaves-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 0;
    overflow: hidden;
}

.leaf {
    position: absolute;
    top: -10%;
    font-size: 1.5rem;
    opacity: 0.6;
    animation: fall linear infinite;
    will-change: transform;
}

.leaf:nth-child(3n) { color: #f59e0b; }
.leaf:nth-child(3n+1) { color: #ef4444; }
.leaf:nth-child(3n+2) { color: #10b981; }

@keyframes fall {
    0% { transform: translate3d(0, -10vh, 0) rotate(0deg); opacity: 0; }
    10% { opacity: 0.6; }
    50% { transform: translate3d(80px, 50vh, 0) rotate(180deg); }
    90% { opacity: 0.6; }
    100% { transform: translate3d(-40px, 110vh, 0) rotate(360deg); opacity: 0; }
}

.leaf:nth-child(1) { left: 5%; font-size: 1rem; animation-duration: 14s; animation-delay: 0s; }
.leaf:nth-child(2) { left: 15%; font-size: 1.4rem; animation-duration: 18s; animation-delay: 2s; }
.leaf:nth-child(3) { left: 25%; font-size: 0.9rem; animation-duration: 12s; animation-delay: 5s; }
.leaf:nth-child(4) { left: 35%; font-size: 1.5rem; animation-duration: 20s; animation-delay: 1s; }
.leaf:nth-child(5) { left: 45%; font-size: 1.1rem; animation-duration: 16s; animation-delay: 7s; }
.leaf:nth-child(6) { left: 55%; font-size: 1.3rem; animation-duration: 15s; animation-delay: 3s; }
.leaf:nth-child(7) { left: 65%; font-size: 1rem; animation-duration: 19s; animation-delay: 8s; }
.leaf:nth-child(8) { left: 75%; font-size: 1.5rem; animation-duration: 13s; animation-delay: 4s; }
.leaf:nth-child(9) { left: 85%; font-size: 1.1rem; animation-duration: 17s; animation-delay: 6s; }
.leaf:nth-child(10) { left: 95%; font-size: 1.2rem; animation-duration: 21s; animation-delay: 0.5s; }
.leaf:nth-child(11) { left: 10%; font-size: 1.4rem; animation-duration: 16s; animation-delay: 9s; }
.leaf:nth-child(12) { left: 30%; font-size: 0.9rem; animation-duration: 14s; animation-delay: 11s; }
.leaf:nth-child(13) { left: 50%; font-size: 1.6rem; animation-duration: 22s; animation-delay: 2.5s; }
.leaf:nth-child(14) { left: 70%; font-size: 1.1rem; animation-duration: 15s; animation-delay: 10s; }
.leaf:nth-child(15) { left: 90%; font-size: 1.3rem; animation-duration: 18s; animation-delay: 4.5s; }

.installer-wrapper {
    width: 100%;
    max-width: 960px;
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
    align-items: center;
    position: relative;
    z-index: 1;
    margin: auto;
}

.brand-content { text-align: center; padding: 0 0.5rem; }
.brand-header { display: flex; align-items: center; justify-content: center; gap: 0.75rem; margin-bottom: 1.5rem; flex-wrap: wrap; }
.brand-header img { width: 80px; height: 80px; filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1)); object-fit: contain; }
.brand-header h1 { font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin: 0; }
.brand-badge { font-size: 0.65rem; font-weight: 600; padding: 0.2rem 0.5rem; background-color: rgba(79, 70, 229, 0.1); color: var(--primary); border-radius: 9999px; animation: pulse-badge 2s infinite; white-space: nowrap; }

@keyframes pulse-badge {
    0% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.4); }
    70% { box-shadow: 0 0 0 6px rgba(79, 70, 229, 0); }
    100% { box-shadow: 0 0 0 0 rgba(79, 70, 229, 0); }
}

.brand-content h2 { font-size: 1.75rem; font-weight: 700; margin-bottom: 0.75rem; color: var(--text-main); }
.brand-content h2 span { background: linear-gradient(to right, #4f46e5, #a855f7); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.brand-content p { font-size: 0.9rem; color: var(--text-muted); max-width: 450px; margin: 0 auto; line-height: 1.6; }

.install-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid var(--border);
    border-radius: 1rem;
    box-shadow: var(--shadow);
    padding: 1.5rem;
}

.card-title { font-size: 1.1rem; font-weight: 700; margin-bottom: 1.25rem; color: var(--text-main); text-align: center; }
.form-group { margin-bottom: 1rem; }
.form-label { display: block; font-size: 0.8rem; font-weight: 600; color: var(--text-main); margin-bottom: 0.4rem; }
.form-control { width: 100%; padding: 0.75rem 0.875rem; font-size: 1rem; color: var(--text-main); background-color: rgba(255, 255, 255, 0.95); border: 1.5px solid var(--border); border-radius: 0.625rem; transition: all 0.2s ease; outline: none; }
.form-control:focus { background-color: #fff; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); }
.form-text { font-size: 0.7rem; color: var(--text-muted); margin-top: 0.375rem; display: block; line-height: 1.4; }

.btn-primary-custom {
    display: flex; align-items: center; justify-content: center; width: 100%; padding: 0.875rem 1.25rem; font-size: 1rem; font-weight: 600; color: #fff; background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); border: none; border-radius: 0.625rem; cursor: pointer; transition: all 0.3s ease; margin-top: 1.25rem; box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2); min-height: 48px;
}
.btn-primary-custom:hover { transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3); }

/* CUSTOM PROGRESS MODAL */
.progress-modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.75); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); z-index: 9999; display: none; align-items: center; justify-content: center; padding: 1rem; animation: fadeIn 0.3s ease; }
.progress-modal-overlay.active { display: flex; }
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

.progress-modal { background: #fff; border-radius: 1.25rem; padding: 2rem 1.75rem; width: 100%; max-width: 420px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); animation: slideUp 0.4s ease; }
@keyframes slideUp { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

.progress-icon { width: 64px; height: 64px; margin: 0 auto 1.25rem; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #8e8bd2 0%, #7c3aed 100%); border-radius: 50%; color: #fff; font-size: 1.75rem; animation: pulseIcon 2s infinite; }
@keyframes pulseIcon { 0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(79, 70, 229, 0.4); } 50% { transform: scale(1.05); box-shadow: 0 0 0 12px rgba(79, 70, 229, 0); } }

.progress-title { font-size: 1.15rem; font-weight: 700; text-align: center; color: var(--text-main); margin-bottom: 0.5rem; }
.progress-message { font-size: 0.85rem; color: var(--text-muted); text-align: center; margin-bottom: 1.5rem; min-height: 2.5em; line-height: 1.5; word-break: break-word; }
.progress-bar-wrapper { width: 100%; height: 12px; background: #e2e8f0; border-radius: 9999px; overflow: hidden; position: relative; margin-bottom: 0.75rem; }
.progress-bar-fill { height: 100%; width: 0%; background: linear-gradient(90deg, #4f46e5 0%, #7c3aed 50%, #a855f7 100%); border-radius: 9999px; transition: width 0.4s ease; position: relative; overflow: hidden; }
.progress-bar-fill::after { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent); animation: shimmer 1.5s infinite; }
@keyframes shimmer { 0% { transform: translateX(-100%); } 100% { transform: translateX(100%); } }
.progress-percent { font-size: 1.5rem; font-weight: 700; text-align: center; color: var(--primary); font-variant-numeric: tabular-nums; }
.progress-percent .percent-symbol { font-size: 1rem; color: var(--text-muted); margin-left: 2px; }

.progress-modal.success .progress-icon { background: linear-gradient(135deg, #10b981 0%, #059669 100%); animation: none; }
.progress-modal.success .progress-bar-fill { background: linear-gradient(90deg, #10b981 0%, #059669 100%); }
.progress-modal.success .progress-percent { color: #10b981; }

.progress-modal.error .progress-icon { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); animation: none; }
.progress-modal.error .progress-bar-fill { background: linear-gradient(90deg, #ef4444 0%, #dc2626 100%); }
.progress-modal.error .progress-percent { color: #ef4444; }

@media (min-width: 768px) {
    .installer-wrapper { grid-template-columns: 1.1fr 1fr; gap: 3rem; }
    .brand-content { text-align: left; padding: 0; }
    .brand-header { justify-content: flex-start; margin-bottom: 2rem; }
    .brand-header img { width: 100px; height: 100px; }
    .brand-header h1 { font-size: 1.75rem; }
    .brand-content h2 { font-size: 2.25rem; margin-bottom: 1rem; }
    .brand-content p { font-size: 1rem; margin: 0; }
    .install-card { border-radius: 1.5rem; padding: 2rem; }
    .card-title { font-size: 1.25rem; text-align: left; }
}
</style>

<div class="leaves-container" aria-hidden="true">
    <span class="leaf">🍂</span><span class="leaf">🍃</span><span class="leaf">🍁</span>
    <span class="leaf">🍂</span><span class="leaf">🍃</span><span class="leaf">🍁</span>
    <span class="leaf">🍂</span><span class="leaf">🍃</span><span class="leaf">🍁</span>
    <span class="leaf">🍂</span><span class="leaf">🍃</span><span class="leaf">🍁</span>
    <span class="leaf">🍂</span><span class="leaf">🍃</span><span class="leaf">🍁</span>
</div>

<!-- CUSTOM PROGRESS MODAL -->
<div class="progress-modal-overlay" id="progressOverlay">
    <div class="progress-modal" id="progressModal">
        <div class="progress-icon" id="progressIcon">🔐</div>
        <div class="progress-title">Generate Database</div>
        <div class="progress-message" id="progressMessage">Memulai proses...</div>
        <div class="progress-bar-wrapper">
            <div class="progress-bar-fill" id="progressBarFill"></div>
        </div>
        <div class="progress-percent">
            <span id="progressPercent">0</span><span class="percent-symbol">%</span>
        </div>
    </div>
</div>

<div class="installer-wrapper">
    <div class="brand-content">
        <div class="brand-header">
            <img src="<?= base_url('assets/img/garuda_white.svg') ?>" alt="Logo">
            <h1>aruda CBT</h1>
            <span class="brand-badge">Project-Mod</span>
        </div>
        <h2>Installer <span>Database</span></h2>
        <p><b>G</b>abungan <b>A</b>plikasi <b>R</b>apor, <b>U</b>jian dan <b>E</b>-learning. Silakan masukkan konfigurasi database Anda untuk memulai instalasi.</p>
    </div>

    <div class="install-card">
        <h3 class="card-title">Konfigurasi Koneksi</h3>
        <form action="<?= base_url('installer/install.php') ?>" id="create" method="post" accept-charset="utf-8">
            <div class="form-group">
                <label for="input-nama-host" class="form-label">Host Name</label>
                <input type="text" class="form-control" id="input-nama-host" name="hostname" value="" placeholder="localhost" required autocomplete="off">
                <small class="form-text">Contoh: localhost, 127.0.0.1, dll.</small>
            </div>
            <div class="form-group">
                <label for="input-user-host" class="form-label">Username</label>
                <input type="text" class="form-control" id="input-user-host" name="username" value="" placeholder="root" autocomplete="off">
                <small class="form-text">Username database MySQL.</small>
            </div>
            <div class="form-group">
                <label for="input-pass-host" class="form-label">Password</label>
                <input type="password" class="form-control" id="input-pass-host" value="" name="password" placeholder="••••••••" autocomplete="off">
                <small class="form-text">Kosongkan jika tidak menggunakan password.</small>
            </div>
            <div class="form-group">
                <label for="input-nama-db" class="form-label">Nama Database</label>
                <input type="text" class="form-control" id="input-nama-db" name="database" value="" placeholder="garuda_cbt" autocomplete="off">
                <small class="form-text">Pastikan database sudah dibuat di phpMyAdmin atau akan dibuat otomatis.</small>
            </div>
            <button type="submit" id="install-db" class="btn-primary-custom">
                Install & Setup Database
            </button>
        </form>
    </div>
</div>

<script>
let reason = 0;
let progressInterval = null;
let installRequest = null;
const stepUrl = '<?= base_url('install/step') ?>';
const handlerUrl = '<?= base_url('installer/install.php') ?>';

function showProgressModal() {
    $('#progressOverlay').addClass('active');
    $('#progressModal').removeClass('success error');
    $('#progressIcon').text('🔐');
    updateProgressUI(0, 'Memulai proses...');
}

function hideProgressModal() {
    $('#progressOverlay').removeClass('active');
    stopProgressPolling();
}

function updateProgressUI(percent, message, status) {
    percent = Math.max(0, Math.min(100, parseInt(percent) || 0));
    $('#progressBarFill').css('width', percent + '%');
    $('#progressPercent').text(percent);
    $('#progressMessage').text(message || 'Memproses...');

    if (status === 'success') {
        $('#progressModal').addClass('success').removeClass('error');
        $('#progressIcon').text('✓');
    } else if (status === 'error') {
        $('#progressModal').addClass('error').removeClass('success');
        $('#progressIcon').text('✕');
    }
}

function startProgressPolling() {
    stopProgressPolling();
    progressInterval = setInterval(function() {
        $.ajax({
            url: handlerUrl + '?action=progress',
            method: 'GET',
            dataType: 'json',
            cache: false,
            success: function(data) {
                if (data && typeof data.percent !== 'undefined') {
                    updateProgressUI(data.percent, data.message, data.status);
                }
            }
        });
    }, 500);
}

function stopProgressPolling() {
    if (progressInterval) {
        clearInterval(progressInterval);
        progressInterval = null;
    }
}

function resetForm() {
    $('#input-nama-host').val('');
    $('#input-user-host').val('');
    $('#input-pass-host').val('');
    $('#input-nama-db').val('');
    if (reason === 0) {
        reason = 1;
    }
}

$(document).ready(function() {
    $('#create').submit(function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        let formData = new FormData($(this)[0]);
        formData.append('cond', reason);

        showProgressModal();
        startProgressPolling();

        if (installRequest) {
            installRequest.abort();
        }

        installRequest = $.ajax({
            url: handlerUrl,
            method: 'POST',
            processData: false,
            contentType: false,
            data: formData,
            success: function(res) {
                let response;
                try {
                    response = JSON.parse(res);
                } catch (e) {
                    stopProgressPolling();
                    updateProgressUI(0, 'Respons server tidak valid', 'error');
                    setTimeout(function() {
                        hideProgressModal();
                        Swal.fire({
                            title: "Data Tidak Valid, Reset Form...!",
                            html: "Cek kembali parameter form Anda.<br>Respons server tidak valid.",
                            icon: "error",
                            confirmButtonColor: "#4f46e5",
                            confirmButtonText: "OK"
                        }).then(function() {
                            resetForm();
                        });
                    }, 1500);
                    return;
                }

                if (response.data) {
                    $('#input-nama-host').val(response.data.hostname || '');
                    $('#input-user-host').val(response.data.username || '');
                    $('#input-pass-host').val(response.data.password || '');
                    $('#input-nama-db').val(response.data.database || '');
                }

                reason = response.cond;

                stopProgressPolling();

                var isSuccess = (response.cond == 9);
                var isFirst = (response.cond == 1);
                var isNext = (response.cond == 2 || response.cond == 3);
                var isError = (response.cond >= 4 && response.cond <= 8);

                if (isError) {
                    updateProgressUI(0, response.message, 'error');
                    setTimeout(function() {
                        hideProgressModal();
                        Swal.fire({
                            title: "Data Tidak Valid, Reset Form...!",
                            html: response.message,
                            icon: "error",
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            confirmButtonColor: "#4f46e5",
                            confirmButtonText: "OK"
                        }).then(function(result) {
                            if (result.isConfirmed || result.value) {
                                resetForm();
                            }
                        });
                    }, 1500);

                } else if (isSuccess) {
                    updateProgressUI(100, 'Instalasi berhasil! ✓', 'success');
                    setTimeout(function() {
                        hideProgressModal();
                        Swal.fire({
                            title: "Status System",
                            html: response.message,
                            icon: "success",
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            confirmButtonColor: "#4f46e5",
                            confirmButtonText: "OK"
                        }).then(function(result) {
                            if (result.isConfirmed || result.value) {
                                window.location.href = stepUrl;
                            }
                        });
                    }, 1200);

                } else if (isNext) {
                    setTimeout(function() {
                        hideProgressModal();
                        Swal.fire({
                            title: "Portal Installer GarudaCBT",
                            html: response.message,
                            icon: response.type || "info",
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            confirmButtonColor: "#4f46e5",
                            confirmButtonText: "OK"
                        }).then(function(result) {
                            if (result.isConfirmed || result.value) {
                                repost();
                            }
                        });
                    }, 500);

                } else if (isFirst) {
                    setTimeout(function() {
                        hideProgressModal();
                        Swal.fire({
                            title: "Portal Installer GarudaCBT",
                            html: response.message,
                            icon: response.type || "info",
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            confirmButtonColor: "#4f46e5",
                            confirmButtonText: "OK"
                        }).then(function(result) {
                            if (result.isConfirmed || result.value) {
                                reason = 1;
                            }
                        });
                    }, 500);

                } else {
                    updateProgressUI(0, response.message || 'Terjadi kesalahan', 'error');
                    setTimeout(function() {
                        hideProgressModal();
                        Swal.fire({
                            title: "Data Tidak Valid, Reset Database...!",
                            html: response.message || "Terjadi kesalahan yang tidak diketahui.",
                            icon: "error",
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            confirmButtonColor: "#4f46e5",
                            confirmButtonText: "OK"
                        }).then(function(result) {
                            if (result.isConfirmed || result.value) {
                                resetForm();
                            }
                        });
                    }, 1500);
                }
            },
            error: function(xhr, error, status) {
                stopProgressPolling();
                updateProgressUI(0, 'Gagal terhubung ke server', 'error');
                setTimeout(function() {
                    hideProgressModal();
                    Swal.fire({
                        title: "Data Tidak Valid, Reset Database...!",
                        html: "Gagal terhubung ke server. Periksa kembali koneksi dan kredensial Anda.<br><small>" + error + ": " + status + "</small>",
                        icon: "error",
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        confirmButtonColor: "#4f46e5",
                        confirmButtonText: "OK"
                    }).then(function(result) {
                        if (result.isConfirmed || result.value) {
                            resetForm();
                        }
                    });
                }, 1500);
            }
        });
    });

    repost();
});

function repost() {
    $('#create').submit();
}
</script>
