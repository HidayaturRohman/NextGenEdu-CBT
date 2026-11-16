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
        <div class="d-flex align-items-center justify-content-between w-100">
            <div class="d-flex align-items-center">
              <div class="me-3 flex-shrink-0">
                <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%); color: #ffffff;">
                  <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                  </svg>
                </div>
              </div>
              <div>
                <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                    <?= $judul ?>
                </h4>
                <p class="text-muted mb-0" style="font-size: 0.9rem;">Monitoring real-time status ujian siswa yang sedang berlangsung, durasi tersisa, dan reset ujian.</p>
              </div>
            </div>
        </div>
      </div>
    </div>

    <div>
        <div class="container-fluid">
            <div class="card my-shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center pb-3">
                    <h4 class="card-title mb-0 fw-bold d-flex align-items-center">
    <svg class="icon-24 text-primary me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg><?= $subjudul ?>
</h6>
                    <button class="card-tools d-flex gap-2 btn btn-light border btn-sm me-2 btn-toggle" data-bs-toggle="modal"
                            data-bs-target="#infoModal"><i class="fas fa-info-circle me-1"></i> Info Error
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="card border-0 text-white shadow-sm overflow-hidden" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); border-radius: 12px;">
                                <div class="card-body p-3 d-flex flex-wrap align-items-center justify-content-between gap-3">
                                    <div class="d-flex align-items-center">
                                        <div class="p-2 bg-white bg-opacity-20 rounded-3 me-3 text-white">
                                            <i class="fa fa-key fa-2x"></i>
                                        </div>
                                        <div>
                                            <span class="badge bg-warning text-dark fw-bold text-uppercase px-2 py-1 mb-1">TOKEN UJIAN AKTIF</span>
                                            <div class="d-flex align-items-center gap-2">
                                                <span id="token-view" class="fw-bold text-warning" style="font-family: 'Arial Black', Impact, monospace; font-size: 2.2rem; letter-spacing: 6px; text-shadow: 0 2px 4px rgba(0,0,0,0.4);">------</span>
                                                <input id="token-input" type="hidden" readonly="readonly"/>
                                                <span id="interval" class="badge bg-danger fs-6 px-2 py-1 fw-semibold shadow-sm d-none">--:--:--</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <button type="button" class="btn btn-warning fw-bold text-dark shadow-sm px-3 py-2" onclick="showQrTokenModal()">
                                            <i class="fa fa-qrcode me-1"></i> Tampilkan QR Code Token
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8 col-md-4 mb-3">
                            <label>Jadwal</label>
                            <?php
                            echo form_dropdown(
                                'jadwal',
                                $jadwal,
                                null,
                                'id="jadwal" class="form-control"'
                            ); ?>
                        </div>
                        <div class="col-8 col-md-2 mb-3">
                            <label for="printby">Filter</label>
                            <select name="printby" id="printby" class="form-control">
                                <option value="1" selected="selected">By Ruang</option>
                                <option value="2">By Kelas</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-3 d-none" id="by-kelas">
                            <label for="kelas">Kelas</label>
                            <select name="kelas" id="kelas" class="form-control"></select>
                        </div>
                        <div class="col-6 mb-3 col-md-3 by-ruang">
                            <label for="ruang">Ruang</label>
                            <select name="ruang" id="ruang" class="form-control"></select>
                        </div>
                        <div class="col-6 mb-3 col-md-3 by-ruang">
                            <label for="sesi">Sesi</label>
                            <select name="sesi" id="sesi" class="form-control"></select>
                        </div>
                    </div>
                    <hr>
                    <div class="row d-none" id="info">
                        <div class="col-md-5">
                            <div class="alert alert-success border-success">
                                <h6><i class="icon fas fa-check"></i> Info Ujian</h6>
                                <div id="info-ujian"></div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="alert alert-info border-info">
                                <div id="info-penggunaan">
                                    <ul>
                                        <li>
                                            Gunakan tombol <span class="badge text-bg-success pt-1 pb-1"><i
                                                        class="fa fa-sync ms-1 me-1"></i> Refresh</span>
                                            untuk merefresh halaman
                                        </li>
                                        <li>
                                            <b>RESET WAKTU.</b> Jika siswa logout sebelum selesai dan tidak melanjutkan
                                            sampai waktu ujian habis maka akan ditolak, jika ingin melanjutkan maka
                                            harus reset waktu.
                                        </li>
                                        <li>
                                            Aksi <b>RESET IZIN</b> untuk mengizinkkan siswa mengerjakan ujian di
                                            perangkat berbeda.
                                        </li>
                                        <li>
                                            Aksi <b>PAKSA SELESAI</b> untuk memaksa siswa menyelesaikan ujian.
                                        </li>
                                        <li>
                                            Aksi <b>ULANG</b> untuk mengulang ujian siswa dari awal.
                                        </li>
                                        <li>
                                            <span class="badge text-bg-success"><i class="fa fa-check ms-1 me-1"></i> Terapkan Aksi</span>
                                            untuk menerapkan aksi terpilih ke setiap siswa yang dipilih
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="button" class="btn btn-success shadow-sm align-bottom mb-2"
                                    onclick="refreshStatus()"
                                    data-bs-toggle="tooltip"
                                    title="Refresh">
                                <i class="fa fa-sync ms-1 me-1"></i> Refresh
                            </button>
                            <?php
                            $dnone = $is_admin ? '' : 'd-none';
                            ?>
                            <div class="float-end align-bottom mb-2">
                                <label><input type="search" id="cari-status-siswa"
                                              class="form-control form-control-sm" placeholder="Cari">
                                </label>
                                <button type="button" class="btn btn-success shadow-sm ms-2 <?= $dnone ?>"
                                        onclick="terapkanAksi()"
                                        data-bs-toggle="tooltip"
                                        title="Terapkan Aksi pada siswa terpilih">
                                    <i class="fa fa-check ms-1 me-1"></i> Terapkan Aksi
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table-status">
                        </table>
                    </div>
                </div>
                <div class="overlay d-none" id="loading">
                    <div class="spinner-grow"></div>
                </div>
            </div>
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
    <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoLabel">Kode error siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table w-100">
                    <tr>
                        <td class="text-bold">001</td>
                        <td>:</td>
                        <td>Token salah atau token belum digenerate</td>
                    </tr>
                    <tr>
                        <td class="text-bold">002</td>
                        <td>:</td>
                        <td>Harus reset izin</td>
                    </tr>
                    <tr>
                        <td class="text-bold">003</td>
                        <td>:</td>
                        <td>Harus reset waktu</td>
                    </tr>
                    <tr>
                        <td class="text-bold">004</td>
                        <td>:</td>
                        <td>Soal belum dibuat atau belum dipilih</td>
                    </tr>
                    <tr>
                        <td class="text-bold">005</td>
                        <td>:</td>
                        <td>Siswa menggunakan browser yang tidak mendukung</td>
                    </tr>
                    <tr>
                        <td class="text-bold">006</td>
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

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    const ruangs = JSON.parse('<?=json_encode($ruang)?>');
    const arrRuang = JSON.parse('<?=json_encode($ruangs)?>');
    var dnone = '<?= $is_admin ? "" : "d-none" ?>';
    var printBy = '1';
    var url = '';

    var kelas;
    var jadwal, ruang, sesi;

    function terapkanAksi() {
        const $rows = $('#table-status').find('tr:visible'), headers = $rows.splice(0, 2);
        let item = {};
        item ["reset"] = [];
        //item ["id_logs"] = [];
        item ["force"] = [];
        item ["log"] = [];
        item ["ulang"] = [];
        item ["hapus"] = [];
        $rows.each((i, row) => {
            console.log('test', i)
            var siswa_id = $(row).attr("data-id");

            const $colReset = $(row).find('.input-reset');
            const $colForce = $(row).find('.input-force');
            const $colUlang = $(row).find('.input-ulang');
            if ($colReset.prop("checked") === true) {
                item ["reset"].push(siswa_id + '0' + jadwal + '1');
                //item ["id_logs"].push(siswa_id+''+jadwal);
            }
            if ($colForce.prop("checked") === true) {
                item ["force"].push(siswa_id + '0' + jadwal);
                item ["log"].push(siswa_id);
            }
            if ($colUlang.prop("checked") === true) {
                item ["ulang"].push(siswa_id);
                item ["hapus"].push(siswa_id + '0' + jadwal);
            }
        });

        var dataSiswa = $('#reset').serialize() + '&jadwal=' + jadwal + "&aksi=" + JSON.stringify(item);
        console.log(dataSiswa);

        var jmlReset = item.reset.length === 0 ? '' : '<b>' + item.reset.length + '</b> siswa akan direset<br>';
        var jmlForce = item.force.length === 0 ? '' : '<b>' + item.force.length + '</b> siswa akan dipaksa selesai<br>';
        var jmlUlang = item.ulang.length === 0 ? '' : '<b>' + item.ulang.length + '</b> siswa akan mengulang ujian';

        if (item.reset.length === 0 && item.force.length === 0 && item.ulang.length === 0) {
            showWarningToast('Silahkan pilih siswa terlebih dulu');
            return;
        }

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
                    data: dataSiswa,
                    success: function (data) {
                        console.log(data);
                        if (printBy === '1') {
                            url = base_url + "cbtstatus/getsiswaruang?ruang=" + ruang + '&sesi=' + sesi + '&jadwal=' + jadwal;
                        } else {
                            url = base_url + "cbtstatus/getsiswakelas?kelas=" + kelas + '&jadwal=' + jadwal;
                        }
                        refreshStatus();
                    }, error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    }

    function refreshStatus() {
        $('#cari-status-siswa').val('')
        $('#loading').removeClass('d-none');
        setTimeout(function () {
            $.ajax({
                type: "GET",
                url: url,
                success: function (response) {
                    console.log(response);
                    createPreview(response)
                }
            });
        }, 500);
    }

    function createPreview(data) {
        var tbody = '<thead class="alert-light">' +
            '<tr>' +
            '<th rowspan="2" class="text-center align-middle" width="40">No.</th>' +
            '<th rowspan="2" class="text-center align-middle" width="100">No. Peserta</th>' +
            '<th rowspan="2" class="text-center align-middle">Nama</th>' +
            '<th rowspan="2" class="text-center align-middle">Kelas</th>' +
            '<th rowspan="2" class="text-center align-middle">Sesi</th>' +
            '<th rowspan="2" class="text-center align-middle">Ruang</th>' +
            '<th colspan="2" class="text-center align-middle">Status</th>' +
            '<th rowspan="2" class="text-center align-middle ' + dnone + '">Reset<br>Waktu</th>' +
            '<th colspan="3" class="text-center align-middle ' + dnone + '">Aksi</th>' +
            '</tr>' +
            '<tr>' +
            '<th class="text-center align-middle p-1">Mulai</th>' +
            '<th class="text-center align-middle">Durasi</th>' +
            '<th class="text-center align-middle ' + dnone + '">Reset<br>Izin<br><input id="input-reset-all" class="check" type="checkbox"></th>' +
            '<th class="text-center align-middle ' + dnone + '">Paksa<br>Selesai<br><input id="input-force-all" class="check" type="checkbox"></th>' +
            '<th class="text-center align-middle ' + dnone + '">Ulang<br><input id="input-ulang-all" class="check" type="checkbox"></th>' +
            '</tr></thead><tbody>';

        if (data.siswa.length > 0) {
            for (let i = 0; i < data.siswa.length; i++) {
                var idSiswa = data.siswa[i].id_siswa;
                var durasi = data.durasi[idSiswa].dur != null ? data.durasi[idSiswa].dur.lama_ujian : ' - -';
                var adaWaktu = data.durasi[idSiswa].dur != null ? data.durasi[idSiswa].dur.ada_waktu : true;

                var logging = data.durasi[idSiswa].log;
                var mulai = '- -  :  - -';
                var selesai = '- -  :  - -';
                var reset = null;
                for (let k = 0; k < logging.length; k++) {
                    if (logging[k].log_type === '1') {
                        if (logging[k] != null) {
                            reset = logging[k].reset;
                            var t = logging[k].log_time.split(/[- :]/);
                            //var d = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
                            mulai = t[3] + ':' + t[4];
                        }
                    } else {
                        if (logging[k] != null) {
                            var ti = logging[k].log_time.split(/[- :]/);
                            selesai = ti[3] + ':' + ti[4];
                        }
                    }
                }

                var belumUjian = data.durasi[idSiswa].dur == null;
                var sudahSelesai = !belumUjian && data.durasi[idSiswa].dur.selesai != null;
                var loading = belumUjian ? '' : (sudahSelesai ? "" : '<i class="fa fa-spinner fa-spin me-2"></i>');

                var disabledResetWaktu = !sudahSelesai && !adaWaktu ? '' : 'disabled';
                var disabledReset = !sudahSelesai && reset != null && reset == '0' ? '' : 'disabled';
                var disabledSelesai = !sudahSelesai && !belumUjian ? '' : 'disabled';
                var disabledUlang = belumUjian ? 'disabled' : (sudahSelesai ? '' : 'disabled');

                // jika ingin selalu aktif
                // var disabledResetWaktu = '';     // reset waktu selalu aktif
                // var disabledReset = '';          // reset izin selalu aktif
                // var disabledSelesai = '';        // paksa selesai selalu aktif
                // var disabledUlang = '';         // ulangi selalu aktif

                var sesi = data.siswa[i].kode_sesi;
                var ruang = data.siswa[i].kode_ruang;
                var kelas = data.siswa[i].kode_kelas;

                tbody += '<tr data-id="' + idSiswa + '">' +
                    '<td class="text-center align-middle">' + (i + 1) + '</td>' +
                    '<td class="text-center align-middle">' + data?.siswa[i]?.nomor_peserta + '</td>' +
                    '<td class="align-middle">' + data.siswa[i].nama + '</td>' +
                    '<td class="text-center align-middle">' + kelas + '</td>' +
                    '<td class="text-center align-middle">' + sesi + '</td>' +
                    '<td class="text-center align-middle">' + ruang + '</td>' +
                    '<td class="text-center align-middle">' + mulai + '</td>' +
                    '<td class="text-center align-middle">' + loading + durasi + '</td>' +
                    '<td class="text-center align-middle '+dnone+'">' +
                    '	<button type="button" class="btn btn-light border" ' +
                    'data-siswa="' + idSiswa + '" data-jadwal="' + data.info.id_jadwal + '" ' +
                    'data-bs-toggle="modal" data-bs-target="#resetModal" ' + disabledReset + '><i class="fa fa-refresh"></i></button>' +
                    '</td>' +
                    '<td class="text-center text-success align-middle ' + dnone + '">' +
                    '<input class="check input-reset" type="checkbox" ' + disabledReset + '>' +
                    '</td>' +
                    '<td class="text-center text-danger align-middle ' + dnone + '">' +
                    '<input class="check input-force" type="checkbox" ' + disabledSelesai + '>' +
                    '</td>' +
                    '<td class="text-center text-danger align-middle ' + dnone + '">' +
                    '<input class="check input-ulang" type="checkbox" ' + disabledUlang + '>' +
                    '</td>' +
                    '</tr>';
            }
        } else {
            tbody += '<tr><td colspan="12" class="text-center">Tidak ada siswa tergabung disini!</td></tr>'
        }

        tbody += '</tbody>';
        $('#table-status').html(tbody);
        $('#info').removeClass('d-none');

        var infoJadwal = '<div class="row">' +
            '<div class="col-4">Mapel</div>' +
            '<div class="col-8">' +
            '<b>' + data.info.nama_mapel + '</b>' +
            '</div>' +
            '<div class="col-4">Guru</div>' +
            '<div class="col-8">' +
            '<b>' + data.info.nama_guru + '</b>' +
            '</div>' +
            '<div class="col-4">Jenis Ujian</div>' +
            '<div class="col-8">' +
            '<b>'+data.info.kode_jenis+'</b>' +
            '</div>' +
            '<div class="col-4">Jml. Soal</div>' +
            '<div class="col-8">' +
            '<b>' + (parseInt(data.info.tampil_pg) + parseInt(data.info.tampil_kompleks) +
                parseInt(data.info.tampil_jodohkan) + parseInt(data.info.tampil_isian) +
                parseInt(data.info.tampil_esai)) + '</b>' +
            '</div>';

        $('#info-ujian').html(infoJadwal);
        $('#loading').addClass('d-none');

        $("#input-reset-all").on("click", function () {
            if (this.checked) {
                $(".input-reset").each(function () {
                    if (!$(this).prop('disabled')) {
                        this.checked = true;
                    }
                    $("#input-reset-all").prop("checked", true);
                });
            } else {
                $(".input-reset").each(function () {
                    if (!$(this).prop('disabled')) {
                        this.checked = false;
                    }
                    $("#input-reset-all").prop("checked", false);
                });
            }
        });

        $("#input-force-all").on("click", function () {
            if (this.checked) {
                $(".input-force").each(function () {
                    if (!$(this).prop('disabled')) {
                        this.checked = true;
                    }
                    $("#input-force-all").prop("checked", true);
                });
            } else {
                $(".input-force").each(function () {
                    if (!$(this).prop('disabled')) {
                        this.checked = false;
                    }
                    $("#input-force-all").prop("checked", false);
                });
            }
        });

        $("#input-ulang-all").on("click", function () {
            if (this.checked) {
                $(".input-ulang").each(function () {
                    if (!$(this).prop('disabled')) {
                        this.checked = true;
                    }
                    $("#input-ulang-all").prop("checked", true);
                });
            } else {
                $(".input-ulang").each(function () {
                    if (!$(this).prop('disabled')) {
                        this.checked = false;
                    }
                    $("#input-ulang-all").prop("checked", false);
                });
            }
        });

        $('#cari-status-siswa').quicksearch('#table-status tbody tr');
    }

    function getDetailJadwal(idJadwal) {
        $.ajax({
            type: "GET",
            url: base_url + "cbtstatus/getjadwalujianbyjadwal?id_jadwal=" + idJadwal,
            cache: false,
            success: function (response) {
                console.log(response);
                var selKelas = $('#kelas');
                selKelas.html('');
                selKelas.append('<option value="">Pilih Kelas</option>');
                $.each(response, function (k, v) {
                    if (v != null) {
                        selKelas.append('<option value="' + k + '">' + v + '</option>');
                    }
                });
            }
        });
    }

    $(document).ready(function () {
        ajaxcsrf();

        var opsiPrintBy = $("#printby");
        var opsiJadwal = $("#jadwal");
        var opsiRuang = $("#ruang");
        var opsiSesi = $("#sesi");
        var opsiKelas = $("#kelas");

        opsiJadwal.prepend("<option value='' selected='selected'>Pilih Jadwal</option>");
        opsiRuang.prepend("<option value='' selected='selected'>Pilih Ruang</option>");
        opsiSesi.prepend("<option value='' selected='selected'>Pilih Sesi</option>");
        opsiKelas.prepend("<option value='' selected='selected'>Pilih Kelas</option>");

        function loadSiswaRuang(ruang, sesi, jadwal) {
            var empty = ruang === '' || sesi === '' || jadwal === '';
            if (!empty) {
                url = base_url + "cbtstatus/getsiswaruang?ruang=" + ruang + '&sesi=' + sesi + '&jadwal=' + jadwal;
                refreshStatus();
            } else {
                console.log('empty')
            }
        }

        function loadSiswaKelas(kelas, jadwal) {
            var empty = kelas === '' || jadwal === '';
            if (!empty) {
                url = base_url + "cbtstatus/getsiswakelas?kelas=" + kelas + '&jadwal=' + jadwal;
                refreshStatus();
            } else {
                console.log('empty')
            }
        }

        opsiPrintBy.change(function () {
            printBy = $(this).val();
            if (printBy === '1') {
                $('#by-kelas').addClass('d-none');
                $('.by-ruang').removeClass('d-none');
                if (ruang && sesi && jadwal) loadSiswaRuang(ruang, sesi, jadwal)
            } else {
                $('#by-kelas').removeClass('d-none');
                $('.by-ruang').addClass('d-none');
                if (kelas && jadwal) loadSiswaKelas(kelas, jadwal)
            }
        });

        opsiJadwal.change(function () {
            getDetailJadwal($(this).val());
            opsiRuang.html("<option value='' selected='selected'>Pilih Ruang</option>");
            if ($(this).val()) {
                $.each(arrRuang, function (k, v) {
                    opsiRuang.append("<option value='"+k+"'>"+ruangs[k]+"</option>");
                })
            }
        });

        opsiKelas.change(function () {
            kelas = $(this).val();
            jadwal = opsiJadwal.val();
            loadSiswaKelas(kelas, jadwal)
        });

        opsiRuang.change(function () {
            opsiSesi.html("<option value='' selected='selected'>Pilih Sesi</option>");
            if ($(this).val()) {
                $.each(arrRuang[$(this).val()], function (k, v) {
                    opsiSesi.append("<option value='"+k+"'>"+v.nama_sesi+"</option>");
                })
            }
        });

        opsiSesi.change(function () {
            sesi = $(this).val();
            ruang = opsiRuang.val();
            jadwal = opsiJadwal.val();
            loadSiswaRuang(ruang, $(this).val(), jadwal)
        })

        var idSiswa = '';
        var idJadwal = '';
        $('#resetModal').on('show.bs.modal', function (e) {
            idSiswa = $(e.relatedTarget).data('siswa');
            idJadwal = $(e.relatedTarget).data('jadwal');

            console.log('siswa:' + idSiswa, 'jadwal:' + idJadwal);
        });

        $('#reset').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            $('#resetModal').modal('hide');
            $('#resetModal').on('hidden', function () {
                $(this).data('modal', null);
            });

            $.ajax({
                url: base_url + "cbtstatus/resettimer",
                type: 'POST',
                data: $(this).serialize() + '&id_durasi=' + idSiswa + '0' + idJadwal,
                success: function (data) {
                    console.log(data.status);
                    if (data.status) refreshStatus();
                    else showDangerToast('tidak bisa mereset waktu');
                }, error: function (xhr, status, error) {
                    console.log('error');
                }
            });
        });

        opsiKelas.select2({width: '100%', theme: 'bootstrap4', minimumResultsForSearch: Infinity});
        opsiRuang.select2({width: '100%', theme: 'bootstrap4', minimumResultsForSearch: Infinity});
        opsiSesi.select2({width: '100%', theme: 'bootstrap4', minimumResultsForSearch: Infinity});
        opsiJadwal.select2({width: '100%', theme: 'bootstrap4'});

    });

</script>
<?= $this->include('cbt/token/modal_qr') ?>
<?= $this->endSection() ?>


