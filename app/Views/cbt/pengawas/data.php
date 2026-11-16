<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

<div class="d-contents">
    <!-- Top Header Card (Diseragamkan dengan Token & Sesi Ujian) -->
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="me-3 flex-shrink-0">
            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #0f766e 0%, #115e59 100%); color: #ffffff;">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
              </svg>
            </div>
          </div>
          <div>
            <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                <?= $judul ?>
            </h4>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Penugasan guru pengawas ruang ujian, pencatatan berita acara, dan daftar hadir pengawas.</p>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Main Card Header & Content (Diseragamkan dengan Token & Sesi Ujian) -->
    <div class="card my-shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <div class="header-title">
            <h4 class="card-title d-flex align-items-center mb-0">
                <svg class="icon-24 text-primary me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> <?= isset($subjudul) ? $subjudul : $judul ?>
            </h4>
          </div>
        </div>

        <div class="card-body p-4">
            <!-- Kotak Deskripsi Warna Kuning -->
            <div class="alert alert-warning border-warning m-2 mb-4 p-3 shadow-sm rounded" style="background-color: #fff3cd; border-color: #ffeeba; color: #856404;" role="alert">
                Menu pengaturan pengawas Ujian untuk Tahun Pelajaran <b><?= esc($tp_active->tahun ?? '2026/2027') ?></b> Semester: <b><?= esc($smt_active->smt ?? 'Ganjil') ?></b>
                <ul class="mb-0 ps-3 mt-1" style="list-style-type: disc;">
                    <li class="mb-1"><span class="badge bg-primary me-1" style="background-color: #007bff !important;">Generate</span> Guru Mata Pelajaran dijadikan pengawas.</li>
                    <li>Jika Guru Mata Pelajaran membuat jadwal ujian, maka pengawas akan terisi otomatis.</li>
                </ul>
            </div>

            <!-- Filter Controls -->
            <div class="row mb-3 align-items-end">
                <div class="col-12 col-sm-6 col-md-4 mb-2 mb-md-0">
                    <div class="form-group">
                        <label for="jenis" class="form-label fw-bold small">Jenis</label>
                        <?php
                        echo form_dropdown('jenis', ['' => 'Jenis Penilaian :'] + $jenis, null, 'id="jenis" class="form-select form-select-sm"'); ?>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 mb-2 mb-md-0">
                    <div class="form-group">
                        <label for="tanggal" class="form-label fw-bold small">Tanggal</label>
                        <select name="tanggal" id="tanggal" class="form-select form-select-sm"></select>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 d-flex flex-column">
                    <strong class="mb-2 small">Otomatis</strong>
                    <button id="btn-auto" class="btn btn-primary btn-sm" disabled style="width: fit-content; min-width: 100px;">Generate</button>
                </div>
            </div>

            <!-- Dynamic Table Container -->
            <div class="table-responsive" id="table-container"></div>
            
            <form id="savepengawas" action="<?= base_url('cbtpengawas/savepengawas') ?>" method="post">
                <button type="submit" id="btn-simpan" class="btn btn-primary shadow-sm d-none float-end mt-3 mb-2">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url() ?>/assets/app/js/jquery.rowspanizer.js?v=<?php echo time(); ?>"></script>
<script>
    $(document).ready(async function () {
        ajaxcsrf();
        var opsiJenis = $("#jenis");
        var opsiTgl = $("#tanggal");
        opsiTgl.prepend("<option value=''>Pilih Tanggal</option>");

        opsiJenis.change(function () {
            opsiTgl.empty();
            opsiTgl.prepend("<option value=''>Pilih Tanggal</option>");
            getTglJadwal();
        });

        opsiTgl.change(function () {
            getAllJadwal();
        });

        function getTglJadwal() {
            var jenis = opsiJenis.val();
            var kosong = jenis == "";
            var url = base_url + 'cbtpengawas/get_tanggal?jenis=' + jenis;
            if (!kosong) {
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function (respon) {
                        console.log(respon)
                        for (const tgl in respon) {
                            const mulai = new Date(tgl).toLocaleDateString('id-ID', {
                                year: "numeric",
                                month: "short",
                                day: "2-digit",
                            })

                            console.log(mulai)
                            opsiTgl.append(
                                `<option value="${tgl}">${mulai}</option>`
                            );
                        }
                    },
                    error: function (xhr, status, error) {
                    }
                });
            }
        }

        function getAllJadwal() {
            var jenis = opsiJenis.val();
            var kosong = jenis == "" || opsiTgl.val() == "";

            let formData = new FormData($('#savepengawas')[0]);
            formData.append('jenis', jenis)
            formData.append('tanggal', opsiTgl.val())

            if (!kosong) {
                swal.fire({
                    title: "Memuat data pengawas",
                    text: "Silahkan tunggu....",
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    onOpen: () => {
                        swal.showLoading();
                    }
                });

                $.ajax({
                    url: base_url + 'cbtpengawas/get_pengawas',
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: async function (respon) {
                        await createTableFromJSON(respon);
                        setTimeout(() => {
                            swal.close();
                        }, 500);
                    },
                    error: function (xhr, status, error) {
                    }
                });
            }
        }

        $('#savepengawas').on('submit', function (e) {
            e.stopPropagation();
            e.preventDefault();
            e.stopImmediatePropagation();

            var jenis = opsiJenis.val();
            var kosong = jenis == "";
            if (kosong) return;

            swal.fire({
                title: "Menyimpan pengawas ujian",
                text: "Silahkan tunggu....",
                allowEscapeKey: false,
                allowOutsideClick: false,
                onOpen: () => {
                    swal.showLoading();
                }
            });

            const tables = $('#table-pengawas');
            var jsonObj = [];
            const $rows1 = $(tables).find('tr'), headers1 = $rows1.splice(0, 1);
            $rows1.each((i, row) => {
                const ruang = $(row).find('.jadwal').data('ruang');
                const sesi = $(row).find('.jadwal').data('sesi');
                const idJadwals = ($(row).find('.jadwal').data('id')).toString();
                const jadwals = idJadwals?.split(',');
                const guru = $(row).find('.pengawas').val();

                for (const jadwal of jadwals) {
                    let item = {};
                    item ["jadwal"] = jadwal;
                    item ["ruang"] = ruang;
                    item ["sesi"] = sesi;
                    item ["guru"] = guru;

                    jsonObj.push(item);
                }
            });

            console.log('table', jsonObj);
            var dataPost = $(this).serialize() + "&data=" + JSON.stringify(jsonObj);

            setTimeout(() => {
                $.ajax({
                    url: base_url + "cbtpengawas/savepengawas",
                    type: "POST",
                    dataType: "JSON",
                    data: dataPost,
                    success: function (data) {
                        console.log("response:", data);
                        if (data.status) {
                            swal.fire({
                                title: "Sukses",
                                html: "Pengawas ujian berhasil disimpan",
                                icon: "success",
                                showCancelButton: false,
                                confirmButtonColor: "#3085d6",
                                confirmButtonText: "OK"
                            }).then(result => {
                                if (result.value) {
                                    getAllJadwal()
                                }
                            });
                        } else {
                            swal.fire({
                                title: "Info",
                                text: "Tidak ada data yang disimpan",
                                icon: "info"
                            });
                        }
                    }, error: function (xhr, status, error) {
                        console.log("response:", xhr.responseText);
                        const err = JSON.parse(xhr.responseText)
                        swal.fire({
                            title: "Error",
                            text: err.Message,
                            icon: "error"
                        });
                    }
                });
            }, 1000);
        });

        $('#btn-auto').on('click', function () {
            swal.fire({
                title: "Mengatur pengawas ujian",
                text: "Silahkan tunggu....",
                allowEscapeKey: false,
                allowOutsideClick: false,
                onOpen: () => {
                    swal.showLoading();
                }
            });

            const tdp = $('.td-pengawas');
            tdp.each((ind, td) => {
                const jadwal_guru = ($(td).data('guru')).toString();
                const splited = jadwal_guru?.split(',');
                console.log('split', splited)
                const select = $(td).find('select.pengawas');
                const oldVal = select.val();
                console.log('sel', oldVal)
                for (const guru of splited) {
                    if (guru && !oldVal.includes(guru)) {
                        oldVal.push(guru);
                    }
                }
                select.val(oldVal).trigger('change');
            });

            setTimeout(() => { $('#savepengawas').submit(); }, 500);
        });

        opsiJenis.val('').trigger('change');
    })

    async function createTableFromJSON(data) {
        console.log('data', data)
        const tableContainer = document.getElementById('table-container');
        const allSesi = data.ruangs || [];
        const jsonData = data.jadwals_ujian || [];

        if (!validateData(allSesi, jsonData, tableContainer)) {
            return;
        }

        const flatSchedules = processDataToFlatList(jsonData, allSesi, data);
        console.log('flatSchedules', flatSchedules)

        flatSchedules.sort((a, b) => {
            if (a.ruang_id !== b.ruang_id) return a.ruang_id - b.ruang_id;
            if (a.sesi_id !== b.sesi_id) return a.sesi_id - b.sesi_id;
            return a.jam_ke - b.jam_ke;
        });

        const ruangRowCounts = calculateRowCounts(flatSchedules, 'ruang_id');
        const sesiRowCounts = calculateRowCounts(flatSchedules, 'ruang_id', 'sesi_id');

        const tableHtml = buildTable(flatSchedules, data, ruangRowCounts, sesiRowCounts);
        tableContainer.innerHTML = tableHtml;

        initializeUI(flatSchedules);
    }

    function validateData(allSesi, jsonData, container) {
        if (allSesi.length === 0 || jsonData.length === 0) {
            container.innerHTML = `<table class="w-100 table-bordered"><tr><td class="text-center p-3 alert alert-warning" style="background-color: #fff3cd; color: #856404;">Tidak ada jadwal penilaian hari ini</td></tr></table>`;
            return false;
        }
        return true;
    }

    function processDataToFlatList(jsonData, allSesi, data) {
        const flatList = [];

        jsonData.forEach(jadwal => {
            jadwal.bank_kelas = jadwal.bank_kelas.map(String)
            const ruangFiltered = allSesi.filter(r =>
                r.kelas_id.some(id => jadwal.bank_kelas.includes(id?.toString()))
            );

            console.log('ruangFiltered', ruangFiltered)

            ruangFiltered.forEach(ruang => {
                const pengawasJadwal = data.pengawas[jadwal.id_jadwal]?.[ruang.ruang_id]?.[ruang.sesi_id] || {};
                const pengawasList = (pengawasJadwal.id_guru || '').split(',').filter(Boolean);
                const jamJadwal = () => {
                    if (pengawasJadwal?.jam_ke && pengawasJadwal?.jam_ke > 0) {
                        return pengawasJadwal?.jam_ke;
                    } else if (jadwal.jam_ke && jadwal.jam_ke > 0) {
                        return jadwal.jam_ke;
                    }
                    return '1';
                };

                flatList.push({
                    ruang_id: ruang.ruang_id,
                    nama_ruang: ruang.nama_ruang,
                    sesi_id: ruang.sesi_id,
                    nama_sesi: ruang.nama_sesi,
                    kelas_id: ruang.kelas_id,
                    nama_kelas: ruang.nama_kelas,
                    jam_ke: jamJadwal(),
                    jadwal: jadwal,
                    pengawas: pengawasList
                });
            });
        });

        return flatList;
    }

    function calculateRowCounts(items, ...keys) {
        const counts = new Map();
        let prevValues = null;
        let currentCount = 0;

        const getValues = (item) => keys.map(key => item?.[key]);

        [...items, null].forEach(item => {
            const currentValues = item ? getValues(item) : null;

            const isSameGroup = prevValues && currentValues &&
                prevValues.every((val, i) => val === currentValues[i]);

            if (!isSameGroup) {
                if (prevValues !== null) {
                    const key = prevValues.join('-');
                    counts.set(key, currentCount);
                }
                currentCount = 0;
            }

            if (item !== null) {
                currentCount++;
            }
            prevValues = currentValues;
        });

        return counts;
    }

    function buildTable(flatSchedules, data, ruangRowCounts, sesiRowCounts) {
        const headerHtml = `
        <thead id="table-head">
            <tr class="bg-light">
                <th class="text-center align-middle alert-default-info">HARI/TANGGAL</th>
                <th class="text-center align-middle alert-default-warning">RUANG</th>
                <th class="text-center align-middle alert-default-primary">SESI</th>
                <th class="text-center align-middle alert-default-info">JAM KE</th>
                <th class="text-center align-middle alert-default-success">MAPEL<br>BANK SOAL</th>
                <th class="text-center align-middle alert-default-primary">KELAS</th>
                <th class="text-center align-middle alert-default-danger" style="width: 400px; max-width: 400px">PENGAWAS</th>
            </tr>
        </thead>`;

        let bodyHtml = '<tbody id="table-body">';
        const usedRuangKeys = new Set();
        const usedSesiKeys = new Set();
        let currentRow = 0;
        let ruang = '';
        let curSesi = 0;
        let bgRow = '';
        let bold = false;

        flatSchedules.forEach(item => {
            const { ruang_id, nama_ruang, sesi_id, nama_sesi, kelas_id, nama_kelas, jam_ke, jadwal, pengawas } = item;
            const tgl = formatTanggal(jadwal.tgl_mulai);

            const uniqueClassNames = [...new Set(jadwal.bank_kelas.filter(id => kelas_id.includes(id)).map(id => nama_kelas[id]))];
            const bank_kelas = uniqueClassNames.join(', ');

            const idsJadwal = jadwal.id_jadwal;
            const idsGuru = jadwal.bank_guru_id;
            const optionGuru = createPengawasSelect(data.gurus, pengawas);
            const bank_kode = `<span class="badge bg-primary text-white">${jadwal.bank_kode}</span>`;

            bodyHtml += `<tr>`;

            if (currentRow === 0) {
                bodyHtml += `<td rowspan="${flatSchedules.length}" class="text-center align-middle td-sesi">${tgl}</td>`;
            }
            bold = ruang !== nama_ruang

            const ruangKey = String(ruang_id);
            if (!usedRuangKeys.has(ruangKey)) {
                const rowspanValue = ruangRowCounts.get(ruangKey) || 1;
                bodyHtml += `<td rowspan="${rowspanValue}" class="text-center align-middle td-ruang
                                border-top-bold border-left-bold border-bottom-bold">${nama_ruang}</td>`;
                usedRuangKeys.add(ruangKey);
                ruang = nama_ruang;
            }

            var genap = curSesi % 2 === 0;
            const bBold = bold ? 'border-top-bold' : '';
            const sesiKey = `${ruang_id}-${sesi_id}`;
            if (!usedSesiKeys.has(sesiKey)) {
                bgRow = genap ? 'bg-gray-light' : '';
                const rowspanValue = sesiRowCounts.get(sesiKey) || 1;
                bodyHtml += `<td rowspan="${rowspanValue}" class="text-center align-middle td-sesi ${bgRow} ${bBold}">${nama_sesi}</td>`;
                usedSesiKeys.add(sesiKey);
                curSesi++;
            }

            bodyHtml += `
            <td class="text-center align-middle td-jam ${bgRow} ${bBold}">${jam_ke}</td>
            <td class="text-center align-middle td-mapel jadwal ${bgRow} ${bBold}" data-ruang="${ruang_id}" data-sesi="${sesi_id}" data-id="${idsJadwal}">
                ${jadwal.nama_mapel}<br>${bank_kode}
            </td>
            <td class="text-center align-middle ${bgRow} ${bBold}">${bank_kelas}</td>
            <td class="td-pengawas border-rigt-bold ${bgRow} ${bBold}" data-guru="${idsGuru}">${optionGuru}</td>
        </tr>`;

            currentRow++;
        });

        bodyHtml += '</tbody>';
        return `<table class="table table-bordered table-sm w-100" id="table-pengawas">${headerHtml}${bodyHtml}</table>`;
    }

    function initializeUI(schedules) {
        if (schedules.length > 0) {
            $('#btn-auto').removeAttr('disabled');
        }
        $('.select2').select2({ width: '100%' });
        $('button[type="submit"]').removeClass('d-none');
    }

    function createPengawasSelect(gurus, selectedPengawas) {
        let options = '';
        for (const id_guru in gurus) {
            if (id_guru > 0) {
                const isSelected = selectedPengawas.includes(id_guru) ? 'selected' : '';
                options += `<option value="${id_guru}" ${isSelected}>${gurus[id_guru]}</option>`;
            }
        }
        return `<select name="pengawas[]" style="width: 100%" class="select2 form-select form-select-sm pengawas" multiple="multiple" data-placeholder="Pilih Pengawas" required>${options}</select>`;
    }

    function formatTanggal(dateString) {
        const date = new Date(dateString);
        const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
        return date.toLocaleDateString('id-ID', options);
    }
</script>
<?= $this->endSection() ?>
