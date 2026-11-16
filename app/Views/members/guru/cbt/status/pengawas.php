<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hidayatur Rohman
 * Date: 07/07/20
 * Time: 17:20
 */

$is_pengawas = in_array($guru->id_guru, $ids_pengawas);

?>

<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

<style>
/* Universal Fullscreen Scroll & Position Fix for Status Siswa */
#status-siswa-container:fullscreen,
#status-siswa-container:-webkit-full-screen,
#status-siswa-container:-moz-full-screen,
#status-siswa-container:-ms-fullscreen,
:fullscreen #status-siswa-container,
:-webkit-full-screen #status-siswa-container,
body.fullscreen-active #status-siswa-container {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    bottom: 0 !important;
    width: 100vw !important;
    height: 100vh !important;
    overflow-x: hidden !important;
    overflow-y: scroll !important;
    background-color: #f4f6f8 !important;
    padding: 140px 30px 50px 30px !important;
    box-sizing: border-box !important;
    z-index: 999999 !important;
    -webkit-overflow-scrolling: touch !important;
}

body.fullscreen-active .content-inner,
:fullscreen .content-inner,
:-webkit-full-screen .content-inner {
    margin-top: 0 !important;
}

#status-siswa-container .card:first-child {
    margin-top: 25px !important;
}

:fullscreen body, :-webkit-full-screen body, :-moz-full-screen body, :-ms-fullscreen body,
body.fullscreen-active, html:fullscreen, body:fullscreen {
    overflow: hidden !important;
}

:fullscreen .sidebar, :fullscreen .main-sidebar, :fullscreen .iq-navbar, :fullscreen .iq-navbar-header, :fullscreen footer,
:-webkit-full-screen .sidebar, :-webkit-full-screen .main-sidebar, :-webkit-full-screen .iq-navbar, :-webkit-full-screen .iq-navbar-header, :-webkit-full-screen footer,
body.fullscreen-active .sidebar, body.fullscreen-active .main-sidebar, body.fullscreen-active .iq-navbar, body.fullscreen-active .iq-navbar-header, body.fullscreen-active footer {
    display: none !important;
}

:fullscreen .main-content, :-webkit-full-screen .main-content, body.fullscreen-active .main-content {
    margin-left: 0 !important;
    padding: 0 !important;
}

#status-siswa-container .modal-backdrop,
.modal-backdrop {
    z-index: 9999980 !important;
}
#status-siswa-container .modal,
.modal {
    z-index: 9999990 !important;
}
.swal2-container {
    z-index: 9999999 !important;
}
</style>

<div id="status-siswa-container">
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between w-100">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <svg class="icon-32 text-primary" width="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                            <?= $judul ?>
                        </h4>
                        <p class="text-muted mb-0" style="font-size: 0.9rem;">Ruang Pengawas Pelaksanaan Ujian Berbasis Komputer (CBT).</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" id="btn-fullscreen" onclick="toggleFullScreenStatus();" class="btn btn-sm btn-dark text-white shadow-sm" data-bs-toggle="tooltip" title="Layar Penuh (Sembunyikan Menu)">
                        <i class="fa fa-expand me-1"></i> Fullscreen
                    </button>
                    <button type="button" id="btn-reload-status" onclick="reloadStatusData(this);" class="btn btn-sm btn-primary text-white shadow-sm" data-bs-toggle="tooltip" title="Perbarui Data (Tanpa Keluar Fullscreen)">
                        <i class="fa fa-sync me-1"></i> Reload
                    </button>
                    <button onclick="window.history.back();" type="button" class="btn btn-sm btn-danger text-white shadow-sm">
                        <i class="fas fa-arrow-circle-left me-1"></i> Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card my-shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center pb-3">
            <h5 class="card-title mb-0 fw-bold d-flex align-items-center">
                <i class="fas fa-user-shield text-primary me-2"></i><?= $subjudul ?>
            </h5>
            <button class="btn btn-light border btn-sm" data-bs-toggle="modal" data-bs-target="#infoModal">
                <i class="fas fa-info-circle me-1 text-primary"></i> Info Error
            </button>
        </div>
        <?php $dnone = $is_pengawas ? '' : 'd-none'; ?>
        <div class="card-body">
            <div class="col-12 mb-4">
                <div class="card border-0 text-white shadow-sm overflow-hidden" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); border-radius: 12px;">
                    <div class="card-body p-3 p-md-4">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-4 mb-2 mb-md-0 text-center text-md-start">
                                <div class="d-inline-flex align-items-center">
                                    <div class="p-2 bg-white bg-opacity-20 rounded-3 me-3">
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="badge bg-warning text-dark fw-bold text-uppercase px-2 py-1 mb-1">TOKEN UJIAN</span>
                                        <h6 class="text-white-50 mb-0 small">Rilis token ini kepada siswa</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-5 my-2 my-md-0 text-center">
                                <div class="d-inline-flex align-items-center justify-content-center bg-white bg-opacity-20 px-4 py-2 rounded-3 border border-white border-opacity-25 shadow-sm">
                                    <span id="token-view" class="fw-bold text-warning" style="font-family: 'Arial Black', 'Impact', sans-serif; font-size: 2.8rem; letter-spacing: 8px; text-shadow: 0 2px 4px rgba(0,0,0,0.4);">------</span>
                                    <input id="token-input" type="hidden" readonly="readonly" />
                                </div>
                            </div>
                            <div class="col-12 col-md-3 text-center text-md-end mt-2 mt-md-0" id="kolom-kanan">
                                <span id="interval" class="badge bg-danger fs-6 px-3 py-2 fw-semibold shadow-sm d-none">-- : -- : --</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row" id="info">
                <div class="col-12">
                    <div class="alert alert-info border-info">
                        <h6><i class="icon fas fa-check"></i> Informasi</h6>
                        <div id="info-penggunaan">
                            <ul>
                                <li>Gunakan tombol <span class="badge text-bg-success pt-1 pb-1"><i class="fa fa-sync me-1"></i> Refresh</span> untuk merefresh halaman</li>
                                <li><b>RESET WAKTU.</b> Jika siswa logout sebelum selesai dan tidak melanjutkan sampai waktu ujian habis maka akan ditolak.</li>
                                <li>Aksi <b>RESET IZIN</b> untuk mengizinkan siswa mengerjakan ujian di perangkat berbeda.</li>
                                <li>Aksi <b>PAKSA SELESAI</b> untuk memaksa siswa menyelesaikan ujian.</li>
                                <li>Aksi <b>ULANG</b> untuk mengulang ujian siswa dari awal.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="alert alert-success border-success">
                        <h6><i class="icon fas fa-info-circle"></i> Info Ujian</h6>
                        <div id="info-ujian"></div>
                    </div>
                </div>
                <div class="col-12">
                    <button type="button" class="btn btn-primary btn-sm text-white align-bottom mb-2" onclick="refreshStatus()" data-bs-toggle="tooltip" title="Refresh">
                        <i class="fa fa-sync me-1"></i> Refresh
                    </button>
                    <div class="float-end align-bottom mb-2 d-flex flex-row">
                        <div style="min-width: 150px">
                            <input type="search" id="cari-status-siswa" class="form-control form-control-sm" placeholder="Cari">
                        </div>
                        <button type="button" class="ms-2 btn btn-success btn-sm text-white <?= $dnone ?>" onclick="terapkanAksi()" data-bs-toggle="tooltip" title="Terapkan Aksi pada siswa terpilih">
                            <i class="fa fa-check me-1"></i> Terapkan Aksi
                        </button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-sm table-striped" id="table-status"></table>
            </div>
        </div>
        <div class="overlay d-none" id="loading">
            <div class="spinner-grow"></div>
        </div>
    </div>
</div>

<?= form_open('', array('id' => 'reset')) ?>
<div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="resetLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetLabel">Reset Waktu Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" id="id_cbt_siswa" name="id_cbt_siswa" value="">
                    <div class="icheck-success">
                        <input class="radio" type="radio" name="reset" id="reset1" value="1">
                        <label for="reset1">Reset Waktu dari awal</label>
                    </div>
                    <div class="icheck-success">
                        <input class="radio" type="radio" name="reset" id="reset2" value="2">
                        <label for="reset2">Lanjutkan sisa waktu</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary shadow-sm">OK</button>
                <button type="button" class="btn btn-secondary shadow-sm" data-bs-dismiss="modal">BATAL</button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>

<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoLabel">Kode error siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table w-100">
                    <tr>
                        <td class="fw-bold text-bold">001</td>
                        <td>:</td>
                        <td>Token salah atau token belum digenerate</td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-bold">002</td>
                        <td>:</td>
                        <td>Harus reset izin</td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-bold">003</td>
                        <td>:</td>
                        <td>Harus reset waktu</td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-bold">004</td>
                        <td>:</td>
                        <td>Soal belum dibuat atau belum dipilih</td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-bold">005</td>
                        <td>:</td>
                        <td>Siswa menggunakan browser yang tidak mendukung</td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-bold">006</td>
                        <td>:</td>
                        <td>internet down atau error dari database/server</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary shadow-sm" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="pelanggaranModal" tabindex="-1" role="dialog" aria-labelledby="pelanggaranLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pelanggaranLabel">Pelanggaran Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table w-100 table-bordered">
                    <tr>
                        <th>Jenis Pelanggaran</th>
                        <th>Jumlah</th>
                    </tr>
                    <tr>
                        <td>Pelanggaran Ringan<ul><li>Memulai ujian dengan tampilan tidak fullscreen</li></ul></td>
                        <td class="text-bold align-middle text-center" id="jml-ringan"></td>
                    </tr>
                    <tr>
                        <td>Pelanggaran Sedang<ul><li>Mencoba keluar dari fullscreen</li></ul></td>
                        <td class="text-bold align-middle text-center" id="jml-sedang"></td>
                    </tr>
                    <tr>
                        <td>Pelanggaran Berat<ul><li>Mencoba membuka tab baru</li><li>Keluar dari aplikasi sebelum selesai</li><li>Me-minimize browser</li></ul></td>
                        <td class="text-bold align-middle text-center" id="jml-berat"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary shadow-sm" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pantau Kamera Peserta Ujian -->
<div class="modal fade" id="modalPantauKamera" tabindex="-1" aria-labelledby="modalPantauKameraLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
        <div class="modal-content shadow border-0" style="border-radius: 14px; overflow: hidden;">
            <div class="modal-header bg-dark text-white py-2 px-3">
                <h6 class="modal-title fw-bold mb-0 d-flex align-items-center" id="modalPantauKameraLabel">
                    <i class="fas fa-video text-danger me-2"></i> Pengawasan Kamera Peserta
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" onclick="tutupPantauKamera()"></button>
            </div>
            <div class="modal-body p-3 bg-light">
                <div class="d-flex justify-content-between align-items-center mb-2 px-1">
                    <div>
                        <div class="fw-bold text-dark fs-6" id="pantau-nama-siswa">-</div>
                        <small class="text-muted" id="pantau-nomor-siswa">-</small>
                    </div>
                    <div>
                        <span id="pantau-badge-status" class="badge bg-secondary px-2 py-1">Menghubungkan...</span>
                    </div>
                </div>
                <div class="position-relative rounded shadow-sm overflow-hidden" style="background: #111; min-height: 280px; display: flex; align-items: center; justify-content: center;">
                    <img id="pantau-video-frame" src="" style="width: 100%; height: auto; max-height: 340px; display: none; object-fit: cover; transform: scaleX(-1);" alt="Live Feed">
                    <div id="pantau-loading-placeholder" class="text-white p-4 text-center">
                        <i class="fas fa-spinner fa-spin fa-2x mb-2 text-primary"></i>
                        <div class="small text-white-50">Menghubungkan ke kamera siswa...</div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-2 px-1" style="font-size: 0.78rem;">
                    <span class="text-muted" id="pantau-last-update">Menunggu sinyal...</span>
                    <span class="text-success fw-bold"><i class="fas fa-shield-alt me-1"></i> Live Proctoring</span>
                </div>
            </div>
            <div class="modal-footer py-2 px-3 bg-white d-flex justify-content-between">
                <button type="button" class="btn btn-sm btn-secondary" onclick="tutupPantauKamera()" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Tutup
                </button>
                <small class="text-muted" style="font-size: 0.75rem;">Kamera hanya aktif saat dipantau</small>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url()?>/assets/app/js/ajax_request.js" type="text/javascript"></script>

<script>
    const isPengawas = '<?= $is_pengawas ? "1" : "0"?>';
    const jadwalId = '<?=$jadwal_id?>';
    const ruangId = '<?=$ruang_id?>';
    const sesiId = '<?=$sesi_id?>';
    const dnone = isPengawas == "1" ? '' : 'd-none';

    function toggleFullScreenStatus() {
        var elem = document.documentElement;

        if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) {
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.msRequestFullscreen) {
                elem.msRequestFullscreen();
            } else if (elem.mozRequestFullScreen) {
                elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullscreen) {
                elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            }
        }
    }

    document.addEventListener("fullscreenchange", updateFullscreenBtn);
    document.addEventListener("webkitfullscreenchange", updateFullscreenBtn);
    document.addEventListener("mozfullscreenchange", updateFullscreenBtn);
    document.addEventListener("MSFullscreenChange", updateFullscreenBtn);

    function updateFullscreenBtn() {
        var isFull = document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement;
        var btn = $('#btn-fullscreen');
        if (isFull) {
            btn.html('<i class="fa fa-compress me-1"></i> Keluar Fullscreen');
            btn.removeClass('btn-dark').addClass('btn-danger');
            $('body').addClass('fullscreen-active');
            try { sessionStorage.setItem('cbt_status_fullscreen', '1'); } catch (e) {}
            $('#fullscreen-restore-toast').remove();
        } else {
            btn.html('<i class="fa fa-expand me-1"></i> Fullscreen');
            btn.removeClass('btn-danger').addClass('btn-dark');
            $('body').removeClass('fullscreen-active');
            try { sessionStorage.setItem('cbt_status_fullscreen', '0'); } catch (e) {}
        }
    }

    $(document).ready(function () {
        try {
            if (sessionStorage.getItem('cbt_status_fullscreen') === '1' && !document.fullscreenElement) {
                var restoreHtml = `
                <div id="fullscreen-restore-toast" class="position-fixed top-0 start-50 translate-middle-x mt-3 shadow-lg" style="z-index: 99999999;">
                    <div class="alert alert-primary d-flex align-items-center gap-2 py-2 px-3 mb-0 rounded-pill border-0 shadow">
                        <i class="fa fa-expand text-primary"></i>
                        <span class="small">Mode Layar Penuh (Fullscreen) sebelumnya aktif:</span>
                        <button type="button" class="btn btn-sm btn-primary rounded-pill px-3 py-1 fw-bold" onclick="toggleFullScreenStatus(); $('#fullscreen-restore-toast').remove();">
                            Lanjut Fullscreen
                        </button>
                        <button type="button" class="btn btn-sm btn-link text-muted p-0 ms-1" onclick="$(this).closest('#fullscreen-restore-toast').remove(); sessionStorage.setItem('cbt_status_fullscreen', '0');">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>`;
                $('body').append(restoreHtml);

                var restoreFsOnInteraction = function() {
                    if (sessionStorage.getItem('cbt_status_fullscreen') === '1' && !document.fullscreenElement) {
                        toggleFullScreenStatus();
                    }
                    $('#fullscreen-restore-toast').remove();
                    $(document).off('click.fsRestore keydown.fsRestore');
                };
                $(document).on('click.fsRestore keydown.fsRestore', restoreFsOnInteraction);
            }
        } catch (e) {}
        var idSiswa = '';
        var idCbtSiswa = '';

        $('#resetModal').on('show.bs.modal', function (e) {
            idSiswa = $(e.relatedTarget).data('siswa');
            idCbtSiswa = $(e.relatedTarget).data('cbt');
            $('#id_cbt_siswa').val(idCbtSiswa)
        });

        $('#reset').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            $('#resetModal').modal('hide').data('bs.modal', null);

            let formData = new FormData($('#reset')[0]);

            $.ajax({
                url: base_url + "cbtstatus/resettimer",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status) refreshStatus();
                    else showDangerToast('tidak bisa mereset waktu');
                }, error: function (xhr, status, error) {
                    console.log('error');
                }
            });
        });

        getToken(function (result) {
            getGlobalToken();
        });

        function getGlobalToken() {
            if (globalToken != null) {
                const viewToken = $('#token-input');
                if (viewToken.length) viewToken.val(globalToken.token);
                const viewTokenSpan = $('#token-view');
                if (viewTokenSpan.length) viewTokenSpan.text(globalToken.token);
            }
        }

        $('#pelanggaranModal').on('show.bs.modal', function (e) {
            const ringan = $(e.relatedTarget).data('ringan');
            const sedang = $(e.relatedTarget).data('sedang');
            const berat = $(e.relatedTarget).data('berat');

            $(e.currentTarget).find('#jml-ringan').text(ringan + ' x');
            $(e.currentTarget).find('#jml-sedang').text(sedang + ' x');
            $(e.currentTarget).find('#jml-berat').text(berat + ' x');
        });

        loadSiswaRuang();
    });

    function terapkanAksi() {
        const $rows = $('#table-status').find('tr:visible'), headers = $rows.splice(0, 2);
        let itemJadwal = { reset: [], force: [], ulang: [] }
        let jmlSiswaReset = [];
        let jmlSiswaForce = [];
        let jmlSiswaUlang = [];

        $rows.each((i, row) => {
            const $colReset = $(row).find('.input-reset');
            const $colForce = $(row).find('.input-force');
            const $colUlang = $(row).find('.input-ulang');
            if ($colReset.prop("checked") === true) {
                const jadwal_id = $colReset.parent().data('jadwal')
                const cbt_id = $colReset.parent().data('cbt')
                const siswa_id = $colForce.parent().data('siswa')
                if (!jmlSiswaReset.includes(siswa_id)) jmlSiswaReset.push(siswa_id)

                const item = itemJadwal.force.find(j => j.id_jadwal?.toString() === jadwal_id?.toString())
                if (item) {
                    item.id_cbt_siswa.push(cbt_id)
                } else {
                    let reset = { id_jadwal: jadwal_id, id_cbt_siswa: [cbt_id] }
                    itemJadwal.reset.push(reset)
                }
            }
            if ($colForce.prop("checked") === true) {
                const cbt_id = $colForce.parent().data('cbt')
                const jadwal_id = $colForce.parent().data('jadwal')
                const siswa_id = $colForce.parent().data('siswa')
                if (!jmlSiswaForce.includes(siswa_id)) jmlSiswaForce.push(siswa_id)

                const item = itemJadwal.force.find(j => j.id_jadwal?.toString() === jadwal_id?.toString())
                if (item) {
                    item.id_cbt_siswa.push(cbt_id)
                    item.id_siswa.push(siswa_id)
                } else {
                    let force = { id_jadwal: jadwal_id, id_cbt_siswa: [cbt_id], id_siswa: [siswa_id] }
                    itemJadwal.force.push(force)
                }
            }
            if ($colUlang.prop("checked") === true) {
                const jadwal_id = $colUlang.parent().data('jadwal')
                const cbt_id = $colUlang.parent().data('cbt')
                const siswa_id = $colUlang.parent().data('siswa')
                if (!jmlSiswaUlang.includes(siswa_id)) jmlSiswaUlang.push(siswa_id)

                const item = itemJadwal.ulang.find(j => j.id_jadwal?.toString() === jadwal_id?.toString())
                if (item) {
                    item.id_cbt_siswa.push(cbt_id)
                    item.id_siswa.push(siswa_id)
                } else {
                    let ulang = { id_jadwal: jadwal_id, id_cbt_siswa: [cbt_id], id_siswa: [siswa_id] }
                    itemJadwal.ulang.push(ulang)
                }
            }
        });

        const jmlReset = jmlSiswaReset.length === 0 ? '' : '<b>' + jmlSiswaReset.length + '</b> siswa akan direset<br>';
        const jmlForce = jmlSiswaForce.length === 0 ? '' : '<b>' + jmlSiswaForce.length + '</b> siswa akan dipaksa selesai<br>';
        const jmlUlang = jmlSiswaUlang.length === 0 ? '' : '<b>' + jmlSiswaUlang.length + '</b> siswa akan mengulang ujian';

        const resReset = jmlSiswaReset.length === 0 ? '' : '<b>' + jmlSiswaReset.length + '</b> siswa berhasil direset<br>';
        const resForce = jmlSiswaForce.length === 0 ? '' : '<b>' + jmlSiswaForce.length + '</b> siswa berhasil dipaksa selesai<br>';
        const resUlang = jmlSiswaUlang.length === 0 ? '' : '<b>' + jmlSiswaUlang.length + '</b> siswa harus mengulang ujian';

        if (itemJadwal.reset.length === 0 && itemJadwal.force.length === 0 && itemJadwal.ulang.length === 0) {
            showWarningToast('Silahkan pilih siswa terlebih dulu');
            return;
        }

        let formData = new FormData($('#reset')[0]);
        formData.append("data", JSON.stringify(itemJadwal));

        swal.fire({
            title: "Terapkan Aksi",
            html: jmlReset + jmlForce + jmlUlang,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Apply"
        }).then(result => {
            if (result.value) {
                $.ajax({
                    url: base_url + "cbtstatus/applyaction",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        swal.fire({
                            title: "Sukses",
                            html: resForce + resReset + resUlang,
                            icon: "success"
                        }).then(result => {
                            loadSiswaRuang()
                        });
                    }, error: function (xhr, status, error) {
                        swal.fire({ "title": "Error", "html": xhr.responseText, "icon": "error" });
                    }
                });
            }
        });
    }

    function refreshStatus() {
        $('#cari-status-siswa').val('');
        $('#loading').removeClass('d-none');
        if (typeof getToken === 'function') {
            try { getToken(); } catch(e){}
        }
        loadSiswaRuang();
    }

    function reloadStatusData(btn) {
        var $btn = $(btn || '#btn-reload-status');
        var originalHtml = $btn.html();
        $btn.prop('disabled', true).html('<i class="fa fa-sync fa-spin me-1"></i> Memuat...');

        refreshStatus();

        setTimeout(function () {
            $btn.prop('disabled', false).html(originalHtml);
            if (typeof showSuccessToast === 'function') {
                showSuccessToast('Data status ujian berhasil diperbarui');
            }
        }, 500);
    }

    function loadSiswaRuang() {
        ajaxGet(`${base_url}cbtstatus/get_status_ruang?ruang=${ruangId}&sesi=${sesiId}&jadwal=${jadwalId}`,
            function (error, response) {
                $('#loading').addClass('d-none')
                if (!error) populateTable(response)
            });
    }

    function populateTable(data) {
        const jadwal = data.jadwal
        let htmlInfo = `<table class="table table-sm">
        <thead>
            <tr>
                <th class="text-center align-middle">Jam Ke</th>
                <th>Mapel</th>
                <th>Soal Agama</th>
                <th>Pengampu</th>
                <th>Jml. Soal</th>
                <th>Pengawas</th>
            </tr>
        </thead><tbody>`;

        const bankSoal = jadwal.bank
        const pengawas = jadwal.pengawas?.find(p => p.id_ruang === ruangId && p.id_sesi === sesiId)
        const totalSoal = (Number(bankSoal.tampil_pg) + Number(bankSoal.tampil_kompleks)) +
            (Number(bankSoal.tampil_jodohkan) + Number(bankSoal.tampil_isian)) +
            Number(bankSoal.tampil_esai);
        htmlInfo += `<tr>
                <td class="text-center align-middle">${pengawas?.jam_ke || '1'}</td>
                <td>${bankSoal.mapel.kode}</td>
                <td>${bankSoal.soal_agama}</td>
                <td>${bankSoal.guru.nama_guru}</td>
                <td>${totalSoal} soal</td>
                <td>${data.pengawas.length > 0 ? data.pengawas.map(p => p.nama_guru).join(', ') : "Tidak diatur"}</td>`;
        htmlInfo += `</tbody></table>`

        const infoUjian = document.getElementById("info-ujian");
        if (infoUjian) infoUjian.innerHTML = htmlInfo;

        const disabled = data.is_empty ? 'disabled' : '';
        let tbody = '<thead class="alert-light">' +
            '<tr>' +
            '<th rowspan="2" class="text-center align-middle">No.</th>' +
            '<th rowspan="2" class="text-center align-middle" style="min-width: 220px">Data Siswa</th>' +
            '<th colspan="2" class="text-center align-middle">Jadwal Ujian</th>' +
            '<th colspan="3" class="text-center align-middle">Status Siswa</th>' +
            '<th colspan="4" class="text-center align-middle ' + dnone + '">Aksi</th>' +
            '</tr>' +
            '<tr>' +
            '<th class="text-center align-middle">Mapel</th>' +
            '<th class="text-center align-middle">Kode & <br/>Status Jadwal</th>' +
            '<th class="text-center align-middle p-1">Mulai</th>' +
            '<th class="text-center align-middle">Durasi</th>' +
            '<th class="text-center align-middle">Fouls</th>' +
            '<th class="text-center align-middle ' + dnone + '">Reset<br/>Waktu</th>' +
            '<th class="text-center align-middle ' + dnone + '">Reset<br/>Izin' +
            '<br><input id="input-reset-all" class="check" type="checkbox" ' + disabled + '>' +
            '</th>' +
            '<th class="text-center align-middle ' + dnone + '">Paksa<br/>Selesai' +
            '<br><input id="input-force-all" class="check" type="checkbox" ' + disabled + '>' +
            '</th>' +
            '<th class="text-center align-middle ' + dnone + '">Ulang' +
            '<br><input id="input-ulang-all" class="check" type="checkbox" ' + disabled + '>' +
            '</th>' +
            '</tr></thead><tbody>';

        let ind = 1;
        if (data.sesisiswa.length > 0) {
            const filterSiswa = data.sesisiswa.filter(sis =>
                !(bankSoal.soal_agama !== '-' && bankSoal.soal_agama !== '0' && bankSoal.soal_agama !== sis.siswa.agama)
                && bankSoal.bank_kelas.some(k => k.kelas_id?.toString() === sis.kelas_id?.toString()))

            filterSiswa.sort((a, b) => a.siswa.nama.localeCompare(b.siswa.nama))

            for (const sesiSiswa of filterSiswa) {
                const idSiswa = sesiSiswa?.siswa_id;
                var sesi = sesiSiswa?.sesi?.kode_sesi;
                var ruang = sesiSiswa?.ruang?.kode_ruang;
                var kelas = sesiSiswa?.kelas?.kode_kelas || '';
                const nama = sesiSiswa?.siswa?.nama || '';
                const agama = sesiSiswa?.siswa?.agama;

                const akhirUjian = ((jadwal.tgl_selesai).split(' ')[0]).replaceAll('-', '')
                const now = ((data.today).split(' ')[0]).replaceAll('-', '')
                const tglBerkahir = now > akhirUjian
                const tersedia = tglBerkahir ? '<i class="fa fa-times-circle text-danger me-1 ms-1"></i>' : '<i class="fa fa-check-circle text-success me-1 ms-1"></i>'
                let rowJadwal = '<td class="align-middle text-center">' + bankSoal.mapel.kode + '</td>' +
                    '<td class="align-middle text-center"><div class="d-flex flex-row justify-content-between">' +
                    '<span>' + bankSoal.bank_kode + '</span>' +
                    '<span>' + tersedia + '</span></div></td>';

                const cbtSiswa = sesiSiswa?.cbtsiswa?.[jadwal.id_jadwal] ?? null;
                if (cbtSiswa) {
                    const hitungDurasi = kalkulasiWaktu(cbtSiswa)
                    const durasi = hitungDurasi.durasi || '0m';
                    var sudahSelesai = cbtSiswa.selesai || false;
                    var loading = sudahSelesai ? '<i class="fa fa-check me-2 text-success"></i>' : '<i class="fa fa-spinner fa-spin me-2 text-primary"></i>';

                    var disabledResetWaktu = !tglBerkahir && !sudahSelesai && cbtSiswa.reset_waktu === '0' ? '' : 'disabled';
                    var disabledResetIzin = !sudahSelesai && cbtSiswa.reset_izin != null && cbtSiswa.reset_izin === '0' ? '' : 'disabled';
                    var disabledSelesai = !sudahSelesai ? '' : 'disabled';
                    var disabledUlang = sudahSelesai ? '' : 'disabled';

                    const mulai = () => {
                        const start = new Date(bankSoal.tgl_mulai)
                        const time = new Date(cbtSiswa?.mulai)
                        if (time) {
                            let susulan = '';
                            if (time > start) susulan = '<br /><span class="text-xs">susulan</span>'
                            return `${zeroPad(time.getHours(), 2)}:${zeroPad(time.getMinutes(), 2)}${susulan}`
                        } else {
                            return '- -  :  - -';
                        }
                    }

                    const totalPelanggaran = (cbtSiswa.pelanggaran?.ringan || 0) + (cbtSiswa.pelanggaran?.sedang || 0) + (cbtSiswa.pelanggaran?.berat || 0);
                    const btn = `<button class="btn btn-outline-danger btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#pelanggaranModal" data-ringan="${cbtSiswa.pelanggaran?.ringan || 0 }" data-sedang="${cbtSiswa.pelanggaran?.sedang || 0}" data-berat="${cbtSiswa.pelanggaran?.berat || 0}">${totalPelanggaran} x</button>`

                    const btnKamera = (jadwal?.kamera == '1' && !sudahSelesai) ? 
                        '<br/><button type="button" class="btn btn-outline-primary btn-sm fw-bold px-2 py-0 mt-1 shadow-sm" onclick="bukaPantauKamera(\''+idSiswa+'\', \''+jadwal.id_jadwal+'\', \''+(nama || '').replace(/'/g, "\\'")+'\', \''+(sesiSiswa?.peserta?.nomor_peserta || '')+'\')" title="Pantau Kamera Peserta"><i class="fas fa-video me-1"></i>Pantau</button>' : '';

                    rowJadwal += '<td class="text-center align-middle">' + mulai() + '</td>' +
                        '<td class="text-center align-middle">' + loading + durasi + btnKamera + '</td>' +
                        '<td class="text-center align-middle">' + btn + '</td>' +
                        '<td class="text-center align-middle ' + dnone + '">' +
                        '	<button type="button" class="btn btn-warning text-white btn-sm px-2" ' +
                        'data-siswa="' + idSiswa + '" data-cbt="' + cbtSiswa.id_cbt_siswa + '" ' +
                        'data-bs-toggle="modal" data-bs-target="#resetModal" ' + disabledResetWaktu + '> <i class="fa fa-sync me-1"></i> Reset</button>' +
                        '</td>' +
                        '<td class="text-center text-success align-middle ' + dnone + '" data-siswa="' + idSiswa + '" data-cbt="' + cbtSiswa.id_cbt_siswa + '" data-jadwal="' + cbtSiswa.id_jadwal + '">' +
                        '<input class="check input-reset" type="checkbox" ' + disabledResetIzin + '>' +
                        '</td>' +
                        '<td class="text-center text-danger align-middle ' + dnone + '" data-siswa="' + idSiswa + '" data-cbt="' + cbtSiswa.id_cbt_siswa + '" data-jadwal="' + cbtSiswa.id_jadwal + '">' +
                        '<input class="check input-force" type="checkbox" ' + disabledSelesai + '>' +
                        '</td>' +
                        '<td class="text-center text-danger align-middle ' + dnone + '" data-siswa="' + idSiswa + '" data-cbt="' + cbtSiswa.id_cbt_siswa + '" data-jadwal="' + cbtSiswa.id_jadwal + '">' +
                        '<input class="check input-ulang" type="checkbox" ' + disabledUlang + '>' +
                        '</td>' +
                        '</tr>';
                } else {
                    rowJadwal += '<td colspan="7" class="align-middle text-center text-warning">Belum mengerjakan</td></tr>'
                }
                tbody += '<tr data-siswa="' + idSiswa + '">' +
                    '<td class="text-center align-middle">' + ind + '</td>' +
                    '<td class="align-middle">' +
                    '<div class="d-flex flex-column">' +
                    '<span class="fw-bold">' + nama + '</span>' +
                    '<span>' + sesiSiswa?.peserta?.nomor_peserta + '</span>' +
                    '<div class="m-0">';
                if (agama) {
                    tbody += '<span class="badge bg-primary me-1">' + agama + '</span>';
                }
                tbody += '<span class="badge bg-primary me-1">' + kelas + '</span>' +
                    '<span class="badge bg-primary me-1">' + ruang + '</span>' +
                    '<span class="badge bg-primary">' + sesi + '</span></div>' +
                    '</td>';
                tbody += rowJadwal + '</tr>';

                ind++;
            }
        } else {
            tbody += '<tr><td colspan="12" class="text-center">Tidak ada siswa tergabung disini!</td></tr>'
        }
        tbody += '</tbody>';
        $('#table-status').html(tbody);

        $("#input-reset-all").on("click", function () {
            if (this.checked) {
                $(".input-reset").each(function () {
                    if (!$(this).prop('disabled')) this.checked = true;
                });
                $("#input-reset-all").prop("checked", true);
            } else {
                $(".input-reset").each(function () {
                    if (!$(this).prop('disabled')) this.checked = false;
                });
                $("#input-reset-all").prop("checked", false);
            }
        });

        $("#input-force-all").on("click", function () {
            if (this.checked) {
                $(".input-force").each(function () {
                    if (!$(this).prop('disabled')) this.checked = true;
                });
                $("#input-force-all").prop("checked", true);
            } else {
                $(".input-force").each(function () {
                    if (!$(this).prop('disabled')) this.checked = false;
                });
                $("#input-force-all").prop("checked", false);
            }
        });

        $("#input-ulang-all").on("click", function () {
            if (this.checked) {
                $(".input-ulang").each(function () {
                    if (!$(this).prop('disabled')) this.checked = true;
                });
                $("#input-ulang-all").prop("checked", true);
            } else {
                $(".input-ulang").each(function () {
                    if (!$(this).prop('disabled')) this.checked = false;
                });
                $("#input-ulang-all").prop("checked", false);
            }
        });
    }

    function kalkulasiWaktu(durasi) {
        let mulai = new Date(durasi.mulai).getTime();
        let lamanya = durasi.lama_ujian;
        if (!lamanya || !lamanya.includes(':')) {
            const selesai = new Date(durasi.selesai).getTime();
            const lama = selesai - mulai;
            lamanya = new Date(lama).toISOString().substring(11, 19);
        }
        durasi.lama_ujian = lamanya

        const elap = lamanya ? lamanya.split(':') : [];
        const ej = elap[0] === "00" ? '' : Number(elap[0]) + ' jam ';
        const em = elap[1] === "00" ? '' : Number(elap[1]) + ' mnt ';
        const ed = elap[2] === "00" ? '' : Number(elap[2]) + ' dtk';
        if (ej === '' && em === '') {
            durasi.durasi = ed;
        } else {
            durasi.durasi = ej + em;
        }
        return durasi;
    }

    function zeroPad(no) {
        return no < 10 ? '0' + no : no;
    }

    var activePantauTimer = null;
    var activePantauJadwal = null;
    var activePantauSiswa = null;

    function bukaPantauKamera(idSiswa, idJadwal, namaSiswa, nomorPeserta) {
        activePantauJadwal = idJadwal;
        activePantauSiswa = idSiswa;

        $('#pantau-nama-siswa').text(namaSiswa || 'Siswa');
        $('#pantau-nomor-siswa').text(nomorPeserta ? ('No. Peserta: ' + nomorPeserta) : 'No. Peserta: -');
        $('#pantau-badge-status').removeClass('bg-success bg-danger').addClass('bg-secondary').text('Menghubungkan...');
        $('#pantau-last-update').text('Meminta izin streaming...');
        $('#pantau-video-frame').hide().attr('src', '');
        $('#pantau-loading-placeholder').show();

        var modalEl = document.getElementById('modalPantauKamera');
        var modalObj = bootstrap.Modal.getOrCreateInstance(modalEl);
        modalObj.show();

        startPollingPantauFrame(idJadwal, idSiswa);

        $.ajax({
            url: base_url + 'cbtstatus/request_pantau',
            type: 'POST',
            data: { id_jadwal: idJadwal, id_siswa: idSiswa },
            dataType: 'json'
        });
    }

    var isFetchingPantau = false;
    function startPollingPantauFrame(idJadwal, idSiswa) {
        if (activePantauTimer) clearInterval(activePantauTimer);
        isFetchingPantau = false;

        function fetchFrame() {
            if (isFetchingPantau || !activePantauJadwal || !activePantauSiswa) return;
            isFetchingPantau = true;

            $.ajax({
                url: base_url + 'cbtstatus/get_pantau_frame',
                type: 'GET',
                cache: false,
                data: { id_jadwal: idJadwal, id_siswa: idSiswa, _t: Date.now() },
                dataType: 'json',
                success: function(res) {
                    if (res && res.frame) {
                        $('#pantau-loading-placeholder').hide();
                        $('#pantau-video-frame').attr('src', res.frame).show();
                        $('#pantau-badge-status').removeClass('bg-secondary bg-danger').addClass('bg-success').html('<i class="fas fa-circle me-1 text-white"></i> LIVE');
                        $('#pantau-last-update').text('Terhubung • ' + (res.updated_at || 'Baru saja'));
                    } else if (res && (res.stream_status === 'requested' || res.stream_status === 'standby')) {
                        $('#pantau-last-update').text('Menunggu kamera siswa aktif...');
                    }
                },
                complete: function() {
                    isFetchingPantau = false;
                }
            });
        }

        fetchFrame();
        activePantauTimer = setInterval(fetchFrame, 900);
    }

    function tutupPantauKamera() {
        if (activePantauTimer) {
            clearInterval(activePantauTimer);
            activePantauTimer = null;
        }
        if (activePantauJadwal && activePantauSiswa) {
            $.ajax({
                url: base_url + 'cbtstatus/stop_pantau',
                type: 'POST',
                data: { id_jadwal: activePantauJadwal, id_siswa: activePantauSiswa }
            });
        }
        activePantauJadwal = null;
        activePantauSiswa = null;
        $('#pantau-video-frame').hide().attr('src', '');
        $('#pantau-loading-placeholder').show();
    }
</script>

<?= $this->endSection() ?>
