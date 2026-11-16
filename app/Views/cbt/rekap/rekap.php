<?php
function sortir($a, $b)
{
    return strcmp($a->tgl_mulai, $b->tgl_mulai) * -1;
}

function my_array_unique($array, $keep_key_assoc = false)
{
    $duplicate_keys = array();
    $tmp = array();

    foreach ($array as $key => $val) {
        if (is_object($val))
            $val = (array)$val;

        if (!in_array($val['id_jadwal'], $tmp))
            $tmp[] = $val['id_jadwal'];
        else
            $duplicate_keys[] = $key;
    }

    foreach ($duplicate_keys as $key)
        unset($array[$key]);

    return $keep_key_assoc ? $array : array_values($array);
}
?>

<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

<style>
.card-rekap {
    border: none;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(149, 157, 165, 0.1);
}

.btn-rekap {
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    border-width: 2px;
}

.btn-rekap:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.form-control-rekap {
    border-radius: 8px;
    border: 1px solid #cbd5e1;
    transition: all 0.3s;
}

.form-control-rekap:focus {
    border-color: #11998e;
    box-shadow: 0 0 0 3px rgba(17, 153, 142, 0.15);
}

.table-rekap thead th {
    background-color: #f0fdf4;
    color: #166534;
    font-weight: 700;
    border-bottom: 2px solid #bbf7d0;
}

.table-rekap tbody tr {
    transition: background-color 0.2s;
}

.table-rekap tbody tr:hover {
    background-color: #f0fdf4;
}

.alert-info-custom {
    background-color: #ecfeff;
    border-left: 4px solid #06b6d4;
    color: #155e75;
}

.alert-warning-custom {
    background-color: #fffbeb;
    border-left: 4px solid #f59e0b;
    color: #92400e;
}
</style>

<div class="d-contents">
    <!-- Top Header Card (Diseragamkan dengan Token & Sesi Ujian) -->
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="me-3 flex-shrink-0">
            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; background: linear-gradient(135deg, #059669 0%, #047857 100%); color: #ffffff;">
              <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="3" y1="9" x2="21" y2="9"></line>
                <line x1="3" y1="15" x2="21" y2="15"></line>
                <line x1="9" y1="3" x2="9" y2="21"></line>
                <line x1="15" y1="3" x2="15" y2="21"></line>
              </svg>
            </div>
          </div>
          <div>
            <h4 class="card-title mb-1 fw-bold d-flex align-items-center">
                <?= $judul ?>
            </h4>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Laporan komprehensif rekap nilai ujian semester, ekspor Excel, dan pengolahan nilai rapor.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Card Header & Content -->
    <div class="card card-rekap my-shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
          <div class="header-title">
            <h4 class="card-title d-flex align-items-center mb-0 fw-bold">
                <svg class="icon-24 text-primary me-2" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg> <?= isset($subjudul) ? $subjudul : $judul ?>
            </h4>
          </div>
          <div class="card-tools">
            <button type="button" id="reload" class="btn btn-outline-success btn-sm btn-rekap">
                <i class="fa fa-sync me-1"></i> Reload
            </button>
          </div>
        </div>

        <div class="card-body p-4">
            <!-- Alert Info Box -->
            <div class="alert alert-info-custom align-content-center shadow-sm rounded p-3 mb-4" role="alert">
                <strong><i class="fa fa-info-circle me-1"></i> Rekap hanya menyalin data ujian sesuai status ujian sudah/belum koreksi.</strong>
                <br />
                <strong class="mt-2 d-block">Rekap bertujuan agar:</strong>
                <ul class="mb-2 ps-3" style="list-style-type: disc;">
                    <li>Hasil ujian siswa bisa dihapus jika diperlukan</li>
                    <li>Jadwal ujian bisa dihapus jika diperlukan</li>
                    <li>Bank soal bisa dihapus jika diperlukan</li>
                </ul>
                <strong>Klik tombol <span class="badge bg-white text-success border me-1"><i class="fa fa-sync"></i> Reload</span> untuk mendapatkan status terbaru</strong>
            </div>

            <div class="row">
                <!-- Search & Filter Controls -->
                <div class="col-md-4 mb-3">
                    <label for="filterby" class="fw-bold text-secondary small mb-1">Filter Status</label>
                    <select name="filterby" id="filterby" class="form-select form-control-rekap">
                        <option value="all" selected="selected">Semua</option>
                        <option value="0">Jadwal belum rekap</option>
                        <option value="1">Jadwal sudah rekap</option>
                        <option value="2">Rekap tanpa jadwal</option>
                    </select>
                </div>
                <div class="col-md-8 mb-3">
                    <label for="searchRekap" class="fw-bold text-secondary small mb-1">Pencarian Cepat</label>
                    <div class="d-flex align-items-stretch rounded-3 overflow-hidden" style="border: 1px solid #cbd5e1; background-color: #fff;">
                        <div class="d-flex align-items-center justify-content-center px-3 text-white" style="background-color: #059669; min-width: 46px;">
                            <i class="fa fa-search"></i>
                        </div>
                        <input type="text" id="searchRekap" class="form-control border-0 shadow-none px-3" style="height: 38px; border-radius: 0;" placeholder="Cari Mapel, Kode, atau Kelas...">
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="col-12 mb-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <div>
                        <button id="hapusterpilih" onclick="bulk_delete()" type="button" class="btn btn-outline-danger btn-rekap me-1" data-bs-toggle="tooltip" title="Hapus Terpilih" disabled="disabled">
                            <i class="far fa-trash-alt me-1"></i> Hapus Terpilih
                        </button>
                        <button id="rekapterpilih" onclick="bulk_rekap()" type="button" class="btn btn-outline-success btn-rekap me-1" data-bs-toggle="tooltip" title="Rekap Terpilih" disabled="disabled">
                            <i class="fa fa-database me-1"></i> Rekap Terpilih
                        </button>
                    </div>
                    <div>
                        <a href="<?= base_url('cbtrekap/export_all') ?>" type="button" class="btn btn-success btn-rekap">
                            <i class="fa fa-download me-1"></i> Ekspor Semua
                        </a>
                    </div>
                </div>

                <!-- Table Content Container -->
                <div class="table-responsive" id="konten"></div>
            </div>
        </div>

        <div class="overlay d-none" id="loading">
            <div class="spinner-grow text-success"></div>
        </div>
    </div>
</div>

<?= form_open('', array('id' => 'bulk')) ?>
<?= form_close(); ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    const infoRekap = <?= json_encode($rekaps) ?>;
    const infoKelas = <?= json_encode($kelas_guru ?? []) ?>;
    const currentUser = '<?=$session_id?>';
    const idGuru = '<?= $id_guru ?? "" ?>';
    let lastUser;
    const limitAntrian = 1000;
    const limitPost = 20;
    let totalSoalSiswa = 0;
    let idsRekap = {};
    let db;
    let request = indexedDB.open("GarudaCbtRekap", 2);
    const table = {
        cbtPengawas: 'cbt_pengawas',
        masterKelas: 'master_kelas',
        cbtJadwal: 'cbt_jadwal',
        rekapJadwal: 'cbt_rekap_jadwal',
    }
    function closeSwal() {
        if (typeof Swal !== 'undefined' && Swal.close) {
            Swal.close();
        }
        if (typeof swal !== 'undefined' && swal.close) {
            swal.close();
        }
    }

    request.onerror = function(event) {
        console.warn("IndexedDB Gagal dibuka, menggunakan fallback:", event);
        closeSwal();
    };
    request.onblocked = function(event) {
        console.warn("IndexedDB diblokir:", event);
        closeSwal();
    };
    request.onsuccess = function(event) {
        db = event.target.result;
    };
    request.onupgradeneeded = function(event) {
        db = event.target.result;
        if (!db.objectStoreNames.contains(table.cbtPengawas)) {
            db.createObjectStore(table.cbtPengawas, { keyPath: "id_pengawas" });
        }
        if (!db.objectStoreNames.contains(table.masterKelas)) {
            db.createObjectStore(table.masterKelas, { keyPath: "id_kelas" });
        }
        if (!db.objectStoreNames.contains(table.cbtJadwal)) {
            const soalStore = db.createObjectStore(table.cbtJadwal, { keyPath: "id_jadwal" });
            soalStore.createIndex("id_jadwal", "id_jadwal", { unique: false });
        }
        if (!db.objectStoreNames.contains(table.rekapJadwal)) {
            const soalStore = db.createObjectStore(table.rekapJadwal, { keyPath: "id_rekap" });
            soalStore.createIndex("id_jadwal", "id_jadwal", { unique: false });
        }
    };

    // LOGIKA PENCARIAN (SEARCH) UNTUK REKAP
    $(document).on('keyup', '#searchRekap', function() {
        var value = $(this).val().toLowerCase();
        $("#data-table tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    let jadwals;
    let filterBy = 'all';
    $(document).ready(async function() {
        ajaxcsrf();
        $("#flashdata").fadeTo(8000, 500).slideUp(500, function() {
            $("#flashdata").slideUp(500);
        });
        const opsiFilterBy = $("#filterby");
        opsiFilterBy.change(function() {
            filterBy = $(this).val();
            $('#loading').removeClass('d-none');
            populateTableJadwal();
        });
        $("#reload").on("click", function() {
            reloadPage(true);
        });
        lastUser = localStorage.getItem('garudaCBT.sessionId');
        const lastGuru = localStorage.getItem('garudaCBT.idGuru');
        if (!lastUser || lastUser !== currentUser || lastGuru !== idGuru) {
            localStorage.setItem('garudaCBT.sessionId', currentUser);
            localStorage.setItem('garudaCBT.idGuru', idGuru);
            localStorage.removeItem('garudaCBT.rekap');
            await clearAllStores();
        }
        setTimeout(async function() {
            localStorage.setItem('garudaCBT.sessionId', currentUser);
            localStorage.setItem('garudaCBT.idGuru', idGuru);
            await reloadPage(true, true);
        }, 300);
    });

    async function reloadPage(force, showDialog = true) {
        const lastStr = localStorage.getItem('garudaCBT.rekap');
        const last = lastStr ? new Date(lastStr) : null;
        const now = new Date();
        const cekMenit = last && !isNaN(last.getTime()) ? minutesDiff(now, last) : 999;
        
        try {
            if (force || cekMenit > 15) {
                localStorage.setItem('garudaCBT.rekap', now.toISOString());
                await getJadwal(showDialog);
            } else {
                if (showDialog) {
                    swal.fire({
                        text: "Memuat jadwal ujian....",
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            if (typeof swal !== 'undefined' && swal.showLoading) swal.showLoading();
                            else if (typeof Swal !== 'undefined' && Swal.showLoading) Swal.showLoading();
                        },
                        onOpen: () => {
                            if (typeof swal !== 'undefined' && swal.showLoading) swal.showLoading();
                        }
                    });
                }
                await populateTableJadwal();
            }
        } catch (err) {
            console.error("Gagal reloadPage:", err);
            await populateTableJadwal();
        } finally {
            closeSwal();
            $('#loading').addClass('d-none');
        }
    }

    async function getTable(count, storeName, url) {
        const ITEMS_PER_PAGE = 50;
        const pages = Math.ceil(count / ITEMS_PER_PAGE);
        const BATCH_PAGES = 10;
        for (let i = 0; i < pages; i += BATCH_PAGES) {
            const batchPromises = [];
            let pagePost = 1;
            for (let j = i; j < i + BATCH_PAGES && j < pages; j++) {
                pagePost = j + 1;
                batchPromises.push(ajaxGet(url + '?page=' + pagePost + '&limit=' + ITEMS_PER_PAGE + '&table=' + storeName));
            }
            const results = await Promise.all(batchPromises);
            for (const result of results) {
                if (storeName === table.cbtJadwal) {
                    await saveJadwal(false, result, pagePost);
                } else {
                    await saveRekap(false, result, pagePost);
                }
            }
        }
    }

    async function clearAllStores() {
        const stores = Object.values(table);
        for (const storeName of stores) {
            try {
                await clearItems(storeName);
            } catch (err) {
                console.warn(`Gagal mengosongkan store ${storeName}:`, err);
            }
        }
    }

    async function getJadwal(showDialog) {
        if (showDialog) {
            swal.fire({
                text: "Memuat jadwal ujian....",
                allowEscapeKey: false,
                allowOutsideClick: false,
                didOpen: () => {
                    if (typeof swal !== 'undefined' && swal.showLoading) swal.showLoading();
                    else if (typeof Swal !== 'undefined' && Swal.showLoading) Swal.showLoading();
                },
                onOpen: () => {
                    if (typeof swal !== 'undefined' && swal.showLoading) swal.showLoading();
                }
            });
        }
        try {
            await clearAllStores();
            const count = await ajaxGet(`cbtrekap/get_count?id=${idGuru}`);
            if (count && count.jadwal !== undefined) {
                await getTable(count.jadwal, table.cbtJadwal, 'cbtrekap/get_jadwal');
                await getTable(count.rekap, table.rekapJadwal, 'cbtrekap/get_rekap');
            }
            await populateTableJadwal();
        } catch (err) {
            console.error("Gagal getJadwal:", err);
            await populateTableJadwal();
        } finally {
            closeSwal();
            $('#loading').addClass('d-none');
        }
    }

    let tempcbtJadwal = [];
    let tempcbtPengawas = [];
    let tempcbtKelas = [];
    async function saveJadwal(update, response, page) {
        if (update || page === 1) {
            tempcbtJadwal = [];
            tempcbtPengawas = [];
            tempcbtKelas = [];
        }
        for (const jadwal of (response.jadwal || [])) {
            for (const sesisiswa of (jadwal.sesisiswa || [])) {
                const sid = String(sesisiswa.id_siswa ?? sesisiswa.siswa_id ?? '');
                sesisiswa.cbtsiswa = (response.cbtsiswa || []).find(cbt =>
                    String(cbt.id_jadwal) === String(jadwal.id_jadwal) && String(cbt.id_siswa) === sid
                );
            }
        }
        const mapJadwal = new Map();
        tempcbtJadwal.forEach(item => mapJadwal.set(item.id_jadwal, item));
        (response.jadwal || []).forEach(item => mapJadwal.set(item.id_jadwal, item));
        tempcbtJadwal = Array.from(mapJadwal.values());
        const mapPengawas = new Map();
        tempcbtPengawas.forEach(item => mapPengawas.set(item.id_pengawas, item));
        (response.pengawas || []).forEach(item => mapPengawas.set(item.id_pengawas, item));
        tempcbtPengawas = Array.from(mapPengawas.values());
        const map = new Map();
        const kelases = response?.kelases || [];
        [...tempcbtKelas, ...kelases].forEach(obj => {
            map.set(obj.id_kelas, obj);
        });
        tempcbtKelas = Array.from(map.values());
        if (update || tempcbtJadwal.length >= response.total) {
            await addItems(table.cbtJadwal, tempcbtJadwal);
            await addItems(table.cbtPengawas, tempcbtPengawas);
            await addItems(table.masterKelas, tempcbtKelas);
        }
    }

    let temprekapJadwal = [];
    async function saveRekap(update, response, page) {
        if (update) {
            temprekapJadwal = [];
        } else if (page === 1) {
            await clearItems(table.rekapJadwal);
            temprekapJadwal = [];
        }
        const mapRekap = new Map();
        temprekapJadwal.forEach(item => {
            if (item && item.id_rekap !== undefined && item.id_rekap !== '') mapRekap.set(item.id_rekap, item);
        });
        (response.rekap || []).forEach(item => {
            if (item && item.id_rekap !== undefined && item.id_rekap !== '') mapRekap.set(item.id_rekap, item);
        });
        temprekapJadwal = Array.from(mapRekap.values());
        const map = new Map();
        const kelases = response?.kelases || [];
        [...tempcbtKelas, ...kelases].forEach(obj => {
            map.set(obj.id_kelas, obj);
        });
        tempcbtKelas = Array.from(map.values());
        if (update || temprekapJadwal.length >= response.total) {
            await addItems(table.rekapJadwal, temprekapJadwal);
            await addItems(table.masterKelas, tempcbtKelas);
        }
    }

    async function populateTableJadwal() {
        const cbtjadwals = await getItems(table.cbtJadwal) || [];
        const arrIdJadwal = cbtjadwals.map(item => item.id_jadwal);
        const pengawas = await getItems(table.cbtPengawas || [])
        const rekaps = await getItems(table.rekapJadwal) || [];
        const idJadwalRekap = rekaps.map(item => item.id_jadwal);
        idsRekap = new Map(rekaps.map(item => [item.id_jadwal, item.id_rekap]));
        const kelases = await getItems(table.masterKelas) || [];
        const kelasMap = Object.fromEntries(kelases.map(k => [k.id_kelas, k]));
        const jadwalNotRekap = cbtjadwals.filter(jadwal => !idJadwalRekap.includes(jadwal.id_jadwal))
        const jadwalWithRekap = cbtjadwals.filter(jadwal => idJadwalRekap.includes(jadwal.id_jadwal))
        const rekapNonJadwal = rekaps.filter(jadwal => !arrIdJadwal.includes(jadwal.id_jadwal))

        switch (filterBy) {
            case '0':
                jadwals = [...jadwalNotRekap.map(jadwal => ({
                    ...jadwal,
                    pengawas: pengawas.filter(p => p.id_jadwal === jadwal.id_jadwal),
                    rekap: 0,
                }))];
                break;
            case '1':
                jadwals = [...jadwalWithRekap.map(jadwal => ({
                    ...jadwal,
                    pengawas: pengawas.filter(p => p.id_jadwal === jadwal.id_jadwal),
                    rekap: 1,
                }))];
                break;
            case '2':
                jadwals = [...rekapNonJadwal.map(jadwal => ({
                    ...jadwal,
                    rekap: 2,
                }))];
                break;
            case 'all':
                jadwals = [
                    ...jadwalWithRekap.map(jadwal => ({
                        ...jadwal,
                        pengawas: pengawas.filter(p => p.id_jadwal === jadwal.id_jadwal),
                        rekap: 1,
                    })),
                    ...jadwalNotRekap.map(jadwal => ({
                        ...jadwal,
                        pengawas: pengawas.filter(p => p.id_jadwal === jadwal.id_jadwal),
                        rekap: 0,
                    })),
                    ...rekapNonJadwal.map(jadwal => ({
                        ...jadwal,
                        rekap: 2,
                    }))
                ];
                break;
        }
        jadwals.sort((a, b) => {
            const dateDiff = new Date(b.tgl_mulai) - new Date(a.tgl_mulai);
            return dateDiff !== 0 ? dateDiff : b.id_jadwal - a.id_jadwal;
        });
        const konten = document.getElementById("konten");
        let tableHtml = ``;
        if (jadwals.length > 0) {
            tableHtml = `<table id="data-table" class="w-100 table table-bordered table-sm table-rekap">
    <thead>
    <tr class="bg-light">
    <th style="min-width: 40px" class="align-middle"><div class="text-center"><input id="check-all" class="check-all form-check-input" type="checkbox"></div></th>
    <th class="text-center align-middle p-0" style="min-width: 40px; height: 50px">No.</th>
    <th class="align-middle">Bank Soal</th>
    <th class="align-middle">Mapel</th>
    <th class="align-middle">Pelaksanaan</th>
    <th class="text-center align-middle p-0"><span>Rekap</span></th>
    <th class="text-center align-middle">Kelas</th>
    <th class="text-center align-middle p-0" style="min-width: 160px"><span>Aksi</span></th>
    </tr>
    </thead>
    <tbody id="table-body">`;
            jadwals.forEach((item, no) => {
                const genap = (no + 1) % 2 === 0;
                const bgRow = genap ? '#f8fafc' : '#ffffff'
                const idJadwal = item.id_jadwal;
                const bankKelasIds = item.bank_kelas.map(bk => bk.kelas_id).filter(id => id !== null);
                const hanyaPg = item.bank?.tampil_esai == 0 && item.bank?.tampil_isian == 0 && item.bank?.tampil_jodohkan == 0 && item.bank?.tampil_kompleks == 0 && item.bank?.tampil_pg > 0;
                let allSiswa = [];
                let all_mengerjakan = [];
                let all_dikoreksi = [];
                let all_kelas_siswa = {};
                let all_kelas_mengerjakan = {};
                let all_kelas_dikoreksi = {};
                if (item.rekap === 2) {
                    allSiswa = item.rekapsiswa || [];
                    all_mengerjakan = allSiswa?.filter(s => s.mulai && !(item.bank?.soal_agama !== '-' && item.bank?.soal_agama !== '0' && item.bank?.soal_agama !== s.siswa?.agama));
                    all_dikoreksi = hanyaPg ? all_mengerjakan : all_mengerjakan?.filter(s => String(s.nilai_input?.dikoreksi ?? '') === '1');
                    bankKelasIds.forEach(kelasId => {
                        const kStr = String(kelasId);
                        all_kelas_siswa[kelasId] = allSiswa?.filter(s => String(s.kelas_id) === kStr);
                        all_kelas_mengerjakan[kelasId] = all_mengerjakan?.filter(s => String(s.kelas_id) === kStr && s.mulai != null);
                        all_kelas_dikoreksi[kelasId] = all_mengerjakan?.filter(s => String(s.kelas_id) === kStr && String(s.nilai_input?.dikoreksi ?? '') === '1');
                    });
                } else {
                    allSiswa = item.sesisiswa || [];
                    all_mengerjakan = allSiswa?.filter(s => s.cbtsiswa?.mulai && !(item.bank?.soal_agama !== '-' && item.bank?.soal_agama !== '0' && item.bank?.soal_agama !== s.siswa?.agama));
                    all_dikoreksi = hanyaPg ? all_mengerjakan : all_mengerjakan?.filter(s => String(s.cbtsiswa?.nilai_input?.dikoreksi ?? '') === '1');
                    bankKelasIds.forEach(kelasId => {
                        const kStr = String(kelasId);
                        all_kelas_siswa[kelasId] = allSiswa?.filter(s => String(s.kelas_id) === kStr);
                        all_kelas_mengerjakan[kelasId] = all_mengerjakan?.filter(s => String(s.kelas_id) === kStr && s.cbtsiswa?.mulai != null);
                        all_kelas_dikoreksi[kelasId] = all_mengerjakan?.filter(s => String(s.kelas_id) === kStr && String(s.cbtsiswa?.nilai_input?.dikoreksi ?? '') === '1');
                    });
                }
                let agm = item.bank?.soal_agama !== '-' && item.bank?.soal_agama !== '0' ? item.bank?.soal_agama : 'Umum';
                all_mengerjakan?.sort((a, b) => a.id_siswa - b.id_siswa);
                const jumlahKelas = item.bank_kelas
                let kelasbank = [];
                if (jumlahKelas && Array.isArray(jumlahKelas) && jumlahKelas.length > 0) {
                    jumlahKelas.forEach(j => {
                        if (j.kelas_id == null) return;
                        const k = kelasMap[j.kelas_id];
                        const namaKls = k ? k.nama_kelas : (j.nama_kelas || j.kode_kelas || (j.kelas ? j.kelas : 'Kelas ' + (j.kelas_id || '')));
                        kelasbank.push({
                            id: k ? k.id_kelas : (j.kelas_id || 'NA'),
                            nama: namaKls,
                            siswa: all_kelas_siswa[j.kelas_id] || [],
                            mengerjakan: all_kelas_mengerjakan[j.kelas_id] || [],
                            dikoreksi: all_kelas_dikoreksi[j.kelas_id] || []
                        });
                    });
                }
                const mulai = new Date(item.tgl_mulai).toLocaleDateString('id-ID', {
                    year: "numeric",
                    month: "short",
                    day: "2-digit",
                })
                let selesai = mulai
                if (item.tgl_selesai) {
                    selesai = new Date(item.tgl_selesai).toLocaleDateString('id-ID', {
                        year: "numeric",
                        month: "short",
                        day: "2-digit",
                    })
                }
                const pelaksanaan = mulai === selesai ?
                    `<span class="badge bg-secondary" style="font-size: 90%;font-weight: 500;">${mulai}</span>` :
                    `<span class="badge bg-secondary" style="font-size: 90%;font-weight: 500;">${mulai}</span> ~ <span class="badge bg-secondary" style="font-size: 90%;font-weight: 500;">${selesai}</span>`
                const rows = kelasbank.length;
                for (let i = 0; i < rows; i++) {
                    const filterSiswaKelas = kelasbank[i]?.siswa || [];
                    const mengerjakan = kelasbank[i]?.mengerjakan || [];
                    const dikoreksi = kelasbank[i]?.dikoreksi || [];
                    let rekap = ``;
                    if (item.rekap === 1) {
                        rekap = `<div class="btn-group" data-jadwal="${item.id_jadwal}">
    <button class="btn btn-primary btn-sm" onclick="backup(${idJadwal})">Ulangi</button>
    <button class="btn btn-success btn-sm btn-aksi" data-type="a">Analisis</button>
    <button class="btn btn-danger btn-sm btn-aksi" data-type="h" title="Hapus"><i class="fa fa-trash"></i></button></div>`;
                    } else if (item.rekap === 2) {
                        rekap = `<div class="btn-group" data-jadwal="${item.id_jadwal}">
    <button class="btn btn-success btn-sm btn-aksi" data-type="a">Analisis</button>
    <button class="btn btn-danger btn-sm btn-aksi" data-type="h" title="Hapus"><i class="fa fa-trash"></i></button></div>`;
                    } else {
                        rekap = `<div class="btn-group" data-jadwal="${item.id_jadwal}">
    <button class="btn btn-primary btn-sm" onclick="backup(${idJadwal})">Rekap</button>
    <button class="btn btn-success btn-sm btn-aksi" data-type="a">Analisis</button>
    <button class="btn btn-danger btn-sm btn-aksi" data-type="h" title="Hapus"><i class="fa fa-trash"></i></button></div>`;
                    }
                    let badgeJenis = hanyaPg ? 'bg-success' : 'bg-danger';
                    let btnKoreksi = hanyaPg ? 'btn-success' : 'btn-warning';
                    if (!hanyaPg) {
                        btnKoreksi = mengerjakan.length === dikoreksi.length ? 'btn-success' : 'btn-warning';
                        badgeJenis = mengerjakan.length === dikoreksi.length ? 'bg-success' : 'bg-danger';
                        rekap += '<br>';
                        rekap += `<span class="badge ${badgeJenis} mt-1">dikoreksi ${all_dikoreksi?.length} dari ${all_mengerjakan?.length}</span>`;
                    }
                    const emptySiswa = mengerjakan.length === 0;
                    let enableEkspor = item.rekap > 0;
                    const enableBtnKoreksi = enableEkspor && !emptySiswa ? '' : 'disabled'
                    const enableBtnEkspor = enableEkspor && !emptySiswa ? '' : 'disabled'
                    if (i === 0) {
                        tableHtml += `<tr style="background: ${bgRow}">
    <td rowspan="${rows}"><div class="text-center"><input class="check form-check-input" value="${item.id_jadwal}" type="checkbox"></div></td>
    <td rowspan="${rows}" class="text-center">${no + 1}</td>
    <td rowspan="${rows}">${item?.kode_jenis || (item?.jenis?.kode_jenis || 'deleted')} <br /> <span class="fw-bold small text-muted">${item.bank?.bank_kode || 'deleted'}</span></td>
    <td rowspan="${rows}">${item?.nama_mapel || item?.bank?.mapel?.nama_mapel || 'deleted'}<br /><span class="badge bg-info mt-1">${agm || 'Umum'}</span></td>
    <td rowspan="${rows}">${pelaksanaan}</td>
    <td rowspan="${rows}" class="text-center">${rekap}</td>
    <td class="text-center"><span class="badge bg-secondary" style="font-size: 90%;font-weight: 500;">${kelasbank[i]?.nama}</span><br/><span class="badge bg-info mt-1">${mengerjakan.length} siswa</span></td>
    <td class="text-center align-middle" data-jadwal="${item.id_jadwal}" data-kelas="${kelasbank[i]?.id}">
    <button class="btn ${btnKoreksi} btn-sm me-1 btn-aksi" data-type="k" ${enableBtnKoreksi}>Koreksi</button>
    <button class="btn btn-success btn-sm me-1 btn-aksi" data-type="e" ${enableBtnEkspor}>Ekspor</button></td>
    </tr>`;
                    } else {
                        tableHtml += `<tr style="background: ${bgRow}">
    <td class="text-center"><span class="badge bg-secondary" style="font-size: 90%;font-weight: 500;">${kelasbank[i]?.nama}</span><br/><span class="badge bg-info mt-1">${mengerjakan.length} siswa</span></td>
    <td class="text-center align-middle" data-jadwal="${item.id_jadwal}" data-kelas="${kelasbank[i]?.id}">
    <button class="btn ${btnKoreksi} btn-sm me-1 btn-aksi" data-type="k" ${enableBtnKoreksi}>Koreksi</button>
    <button class="btn btn-success btn-sm me-1 btn-aksi" data-type="e" ${enableBtnEkspor}>Ekspor</button></td>
    </tr>`;
                    }
                }
            });
            tableHtml += '</tbody></table>';
        } else {
            tableHtml = `<div class="alert alert-warning-custom shadow align-content-center p-3 rounded" role="alert">
    Belum ada jadwal penilaian untuk Tahun Pelajaran <b>2026/2027</b> Semester: <b>Ganjil</b>
    </div>`;
        }
        konten.innerHTML = tableHtml;
        $('.btn-aksi').click(function() {
            const idJadwal = $(this).parent().data('jadwal')
            const idKelas = $(this).parent().data('kelas')
            const type = $(this).data('type')
            const linkAnalisa = `${base_url}cbtanalisis/analisis?id_jadwal=${idJadwal}`
            const linkKoreksi = `${base_url}cbtrekap/view_koreksi?id_jadwal=${idJadwal}&id_kelas=${idKelas}`
            const linkEkspor = `${base_url}cbtrekap/ekspor_rekap?id_jadwal=${idJadwal}&id_kelas=${idKelas}`
            if (type === 'k') {
                window.location.href = linkKoreksi;
            } else if (type === 'a') {
                window.location.href = linkAnalisa;
            } else if (type === 'e') {
                window.location.href = linkEkspor;
            } else if (type === 'h') {
                var jsonId = [`${idJadwal}`];
                delete_rekap(jsonId)
            }
        });
        $("#check-all").on("click", function() {
            if (this.checked) {
                $(".check").each(function() {
                    this.checked = true;
                    $("#check-all").prop("checked", true);
                    $("#hapusterpilih").removeAttr("disabled");
                    $("#rekapterpilih").removeAttr("disabled");
                });
            } else {
                $(".check").each(function() {
                    this.checked = false;
                    $("#check-all").prop("checked", false);
                    $("#hapusterpilih").attr("disabled", "disabled");
                    $("#rekapterpilih").attr("disabled", "disabled");
                });
            }
        });
        $("#data-table tbody").on("click", "tr .check", function() {
            var check = $("#data-table tbody tr .check").length;
            var checked = $("#data-table tbody tr .check:checked").length;
            if (check === checked) {
                $("#check-all").prop("checked", true);
            } else {
                $("#check-all").prop("checked", false);
            }
            if (checked === 0) {
                $("#hapusterpilih").attr("disabled", "disabled");
                $("#rekapterpilih").attr("disabled", "disabled");
            } else {
                $("#hapusterpilih").removeAttr("disabled");
                $("#rekapterpilih").removeAttr("disabled");
            }
        });
        $('#loading').addClass('d-none');
        swal.close()
    }

    function bulk_rekap() {
        const $rows = $('#data-table').find('tr'),
            headers = $rows.splice(0, 1);
        const jsonId = [];
        $rows.each((i, row) => {
            const $selected = $(row).find('.check:checked');
            if ($selected.val() != null) {
                jsonId.push($selected.val());
            }
        });
        if ($("#data-table tbody tr .check:checked").length === 0) {
            swal.fire({
                title: "Gagal",
                text: "Tidak ada data yang dipilih",
                icon: "error"
            });
        } else {
            backup(jsonId)
        }
    }

    async function backup(ids) {
        swal.fire({
            title: "Merekap Nilai Siswa",
            text: "Silahkan tunggu....",
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
                swal.showLoading();
            }
        });
        let arrId = ids;
        if (!Array.isArray(ids)) {
            arrId = [`${ids}`];
        }
        let arrTp = [];
        let arrSmt = [];
        let success = false;
        let response;
        try {
            const jadwal = jadwals.filter(j => arrId.includes(j.id_jadwal.toString()))
            const pages = Math.ceil(jadwal.length / 50)
            if (pages === 0) return
            for (let i = 0; i < pages; i++) {
                let pagePost = i + 1;
                const jadwalPost = await paginate(pagePost, 50, jadwal)
                let formData = new FormData($('#bulk')[0]);
                let arrIdBank = [];
                jadwalPost.forEach((item, index) => {
                    const idRekap = idsRekap.get(item.id_jadwal) || '';
                    arrIdBank.push(item.id_bank)
                    if (!arrTp.includes(item.id_tp)) arrTp.push(item.id_tp)
                    if (!arrSmt.includes(item.id_smt)) arrSmt.push(item.id_smt)
                    const propsjadwal = {
                        "id_jadwal": item.id_jadwal,
                        "id_bank": item.id_bank,
                        "id_jenis": item.id_jenis,
                        "tgl_mulai": item.tgl_mulai,
                        "tgl_selesai": item.tgl_selesai,
                        "jam_ke": item.jam_ke,
                        "durasi_ujian": item.durasi_ujian,
                        "acak_soal": item.acak_soal,
                        "acak_opsi": item.acak_opsi,
                        "kode_jenis": item.kode_jenis || item.jenis?.kode_jenis || '',
                        "pelanggaran": item.pelanggaran
                    }
                    const idsObj = {
                        'id_rekap': idRekap,
                        'id_tp': item.id_tp,
                        'tp': (typeof item.tp === 'object' ? item.tp?.tahun : item.tp) || '',
                        'id_smt': item.id_smt,
                        'smt': (typeof item.smt === 'object' ? item.smt?.nama_smt : item.smt) || '',
                        'id_jadwal': item.id_jadwal,
                        'id_bank': item.id_bank,
                        'kode_bank': item.bank?.kode_bank || item.bank?.bank_kode || item.kode_bank || '',
                        'id_jenis': item.id_jenis,
                        'tgl_mulai': item.tgl_mulai,
                        'tgl_selesai': item.tgl_selesai,
                    }
                    formData.append(`rekap[${index}][ids]`, JSON.stringify(idsObj));
                    formData.append(`rekap[${index}][jadwal]`, JSON.stringify(propsjadwal));
                    formData.append(`rekap[${index}][pengawas]`, JSON.stringify(item.pengawas));
                });
                formData.append(`ids_bank`, JSON.stringify(arrIdBank));
                formData.append(`ids_jadwal`, JSON.stringify(arrId));
                response = await ajaxPost('cbtrekap/rekap', formData);
                if (response.success) {
                    if (pagePost >= pages) {
                        await backupNilaiSiswa(arrId)
                    }
                } else {
                    swal.fire({
                        title: "Gagal",
                        text: "Gagal merekap jadwal",
                        icon: "error"
                    });
                }
            }
        } catch (error) {
            console.error('Error in postBackup:', error);
            swal.fire({
                title: "Gagal",
                text: error,
                icon: "error"
            });
        }
    }

    async function paginate(pageNumber, itemsPerPage, arrayData) {
        const startIndex = (pageNumber - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        return arrayData.slice(startIndex, endIndex);
    }

    async function backupNilaiSiswa(idJadwal) {
        const ukuranBatch = 3;
        const totalData = idJadwal.length;
        let totalCbtProcessed = 0;
        let totalRekapProcessed = 0;
        let isError = false;
        for (let i = 0; i < totalData; i += ukuranBatch) {
            const chunk = idJadwal.slice(i, i + ukuranBatch);
            let formData = new FormData($('#bulk')[0]);
            formData.append(`idjadwal`, JSON.stringify(chunk));
            try {
                const response = await ajaxPost('cbtrekap/rekap_nilai_siswa', formData);
                if (response.success) {
                    totalCbtProcessed += (response.cbt || 0);
                    totalRekapProcessed += (response.rekap_siswa || 0);
                } else {
                    isError = true;
                    break;
                }
            } catch (err) {
                console.error('Error saat backup batch:', err);
                isError = true;
                break;
            }
        }
        if (!isError) {
            await getUpdatedTable(idJadwal, table.cbtJadwal);
            await getUpdatedTable(idJadwal, table.rekapJadwal);
        } else {
            swal.fire({
                title: "Rekap nilai siswa",
                text: "Terjadi kesalahan pada salah satu kelompok rekap. Proses dihentikan.",
                icon: "error",
            });
        }
    }

    async function getUpdatedTable(ids, tbl) {
        const ukuranBatch = tbl === table.cbtJadwal ? 50 : 3;
        const totalData = ids.length;
        let totalProcessed = 0;
        let isError = false;
        for (let i = 0; i < totalData; i += ukuranBatch) {
            const chunk = ids.slice(i, i + ukuranBatch);
            try {
                let response;
                if (tbl == 'cbt_jadwal') {
                    response = await ajaxGet('cbtrekap/get_jadwal?ids=' + JSON.stringify(chunk))
                    if (response.success) {
                        totalProcessed += (response.total || 0);
                        await saveJadwal(true, response, 2)
                    } else {
                        isError = true;
                        break;
                    }
                } else {
                    response = await ajaxGet('cbtrekap/get_rekap?ids=' + JSON.stringify(chunk))
                    if (response.success) {
                        totalProcessed += (response.total || 0);
                        await saveRekap(true, response, 2)
                    } else {
                        isError = true;
                        break;
                    }
                }
            } catch (err) {
                console.error('Error saat reload:', err);
                isError = true;
                break;
            }
        }
        if (!isError) {
            await populateTableJadwal();
        } else {
            swal.fire({
                title: "Rekap nilai siswa",
                text: "Terjadi kesalahan pada salah satu kelompok rekap. Proses dihentikan.",
                icon: "error",
            });
        }
    }

    function bulk_delete() {
        const $rows = $('#data-table').find('tr'),
            headers = $rows.splice(0, 1);
        var jsonId = [];
        $rows.each((i, row) => {
            const $selected = $(row).find('.check:checked');
            if ($selected.val() != null) jsonId.push($selected.val());
        });
        if ($("#data-table tbody tr .check:checked").length === 0) {
            swal.fire({
                title: "Gagal",
                text: "Tidak ada data yang dipilih",
                icon: "error"
            });
        } else {
            delete_rekap(jsonId)
        }
    }

    function delete_rekap(jsonId) {
        swal.fire({
            title: "Hapus Rekap / Jadwal",
            html: "Pilih jenis penghapusan data:<br><br><small class='text-muted'>Pilih <b>Hapus Jadwal & Nilai</b> jika ujian sudah tidak digunakan lagi dan ingin dihapus permanen dari daftar.</small>",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            confirmButtonText: "<i class='fa fa-trash'></i> Hapus Jadwal & Nilai",
            showDenyButton: true,
            denyButtonColor: "#f39c12",
            denyButtonText: "<i class='fa fa-undo'></i> Reset Nilai Rekap Saja",
            cancelButtonText: "Batal"
        }).then(result => {
            if (result.isConfirmed || result.value === true || result.isDenied) {
                const hapusJadwal = (result.isDenied ? '0' : '1');
                swal.fire({
                    title: "Memproses Penghapusan...",
                    text: "Silahkan tunggu....",
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    onOpen: () => {
                        swal.showLoading();
                    }
                });
                $.ajax({
                    url: base_url + 'cbtrekap/hapusrekap',
                    data: $('#bulk').serialize() + '&ids=' + JSON.stringify(jsonId) + '&hapus_jadwal=' + hapusJadwal,
                    type: "POST",
                    success: async function(respon) {
                        if (respon.success) {
                            await deleteItems(table.rekapJadwal, 'id_jadwal', jsonId);
                            if (hapusJadwal === '1') {
                                await deleteItems(table.cbtJadwal, 'id_jadwal', jsonId);
                            }
                            localStorage.removeItem('garudaCBT.rekap');
                            await reloadPage(true, false);
                            swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: hapusJadwal === '1' ? 'Jadwal dan rekap berhasil dihapus permanen' : 'Rekap nilai berhasil direset',
                                timer: 1500,
                                showConfirmButton: false
                            });
                        } else {
                            swal.fire({
                                title: "Gagal",
                                text: respon.message || "Tidak ada data yang dihapus",
                                icon: "error"
                            });
                        }
                    },
                    error: function() {
                        swal.fire({
                            title: "Gagal",
                            text: "Terjadi kesalahan saat menghapus data",
                            icon: "error"
                        });
                    }
                });
            }
        });
    }

    async function getItems(table) {
        if (!db) {
            console.warn("Database belum siap, menunggu...");
            await waitForDbReady();
        }
        return new Promise((resolve, reject) => {
            const transaction = db.transaction([table], "readonly");
            const objectStore = transaction.objectStore(table);
            const request = objectStore.getAll();
            request.onsuccess = function(event) {
                resolve(event.target.result);
            };
            request.onerror = function(event) {
                reject("Gagal membaca data: " + event.target.errorCode);
            };
        })
    }

    async function addItems(table, items) {
        if (!db) {
            console.warn("Database belum siap, menunggu...");
            await waitForDbReady();
        }
        const transaction = db.transaction([table], "readwrite");
        const objectStore = transaction.objectStore(table);
        items.forEach(item => {
            const request = objectStore.put(item);
            request.onerror = function(event) {
                console.log(`Gagal menambahkan data: ${table}`, item, event);
            };
        });
    }

    async function clearItems(table) {
        if (!db) {
            console.warn("Database belum siap, menunggu...");
            await waitForDbReady();
        }
        const transaction = db.transaction([table], "readwrite");
        const objectStore = transaction.objectStore(table);
        const request = objectStore.clear();
    }

    function deleteItems(table, indexName, ids) {
        return new Promise((resolve) => {
            if (!db) { resolve(); return; }
            try {
                const transaction = db.transaction([table], "readwrite");
                const objectStore = transaction.objectStore(table);
                ids.forEach((idVal) => {
                    objectStore.delete(idVal);
                    if (!isNaN(idVal)) objectStore.delete(Number(idVal));
                    if (indexName && objectStore.indexNames && objectStore.indexNames.contains(indexName)) {
                        const index = objectStore.index(indexName);
                        const req = index.getAllKeys(idVal);
                        req.onsuccess = function(e) {
                            (e.target.result || []).forEach(k => objectStore.delete(k));
                        };
                        if (!isNaN(idVal)) {
                            const reqNum = index.getAllKeys(Number(idVal));
                            reqNum.onsuccess = function(e) {
                                (e.target.result || []).forEach(k => objectStore.delete(k));
                            };
                        }
                    }
                });
                transaction.oncomplete = () => resolve();
                transaction.onerror = () => resolve();
            } catch (e) {
                console.warn("deleteItems error:", e);
                resolve();
            }
        });
    }

    async function ajaxGet(url) {
        return new Promise((resolve, reject) => {
            setTimeout(function() {
                $.ajax({
                    url: base_url + url,
                    type: "GET",
                    success: function(respon) {
                        resolve(respon);
                    },
                    error: function(xhr, status, error) {
                        reject(error);
                    }
                });
            }, 100)
        });
    }

    async function ajaxPost(url, formData) {
        return new Promise((resolve, reject) => {
            setTimeout(function() {
                $.ajax({
                    url: base_url + url,
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(respon) {
                        if (respon.success) {
                            resolve(respon);
                        } else {
                            reject(respon.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        reject(error);
                    }
                });
            }, 200)
        });
    }

    function minutesDiff(now, last) {
        let differenceValue = (now.getTime() - last.getTime()) / 1000;
        differenceValue /= 60;
        return Math.abs(Math.round(differenceValue));
    }

    function waitForDbReady() {
        return new Promise((resolve) => {
            let attempts = 0;
            const interval = setInterval(() => {
                attempts++;
                if (db || attempts > 15) {
                    clearInterval(interval);
                    resolve(!!db);
                }
            }, 200);
        });
    }
</script>
<?= $this->endSection() ?>
