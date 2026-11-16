<?= $this->extend('layout/dashboard_template_bs5_siswa') ?>
<?= $this->section('content') ?>

<?php
/**
 * Refactored CBT Ujian / Ulangan Siswa View matching CI3 layout & Hope UI theme
 */
?>
<style>
.my-shadow {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05) !important;
}
.alert-default-danger {
    background-color: #fef2f2 !important;
    border: 1px solid #fecaca !important;
    color: #991b1b !important;
    border-radius: 12px;
}
.alert-default-warning {
    background-color: #fff8e6 !important;
    border: 1px solid #fde68a !important;
    color: #b45309 !important;
    border-radius: 12px;
}
.cbt-exam-card {
    border-radius: 15px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.cbt-exam-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 25px rgba(58, 87, 232, 0.15) !important;
}
</style>

<div class="d-contents">
    <div class="sticky"></div>
    <div class="app-content overlap pb-5">
        <div class="container">
            <!-- Top Hero Banner & Student Widget -->
                    <?= $this->include('members/siswa/templates/top') ?>



            <div class="row">
                <!-- Card 1: INFO ULANGAN / UJIAN -->
                <div class="col-12">
                    <div class="card my-shadow mb-4 border-0" style="border-radius: 15px; overflow: hidden;">
                        <div class="card-header py-3 border-bottom bg-white">
                            <h6 class="text-center fw-bold mb-0 text-uppercase" style="letter-spacing: 0.05em; color: #232D42;">
                                INFO ULANGAN/UJIAN
                            </h6>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-4">
                                <div class="col-md-5">
                                    <div class="card border border-light-subtle rounded-3 shadow-none d-none mb-0" id="info-siswa">
                                        <div class="card-header bg-light border-bottom-0 d-flex align-items-center justify-content-center py-3" style="min-height: 52px;">
                                            <h5 class="fw-bold mb-0 text-dark text-center" style="line-height: 1.3; letter-spacing: 0.5px;"><?= esc($siswa->nama ?? session()->get('nama') ?? 'Peserta Ujian') ?></h5>
                                        </div>
                                        <div class="card-body pt-2 pb-2">
                                            <ul class="list-group list-group-flush list-group-unbordered"></ul>
                                        </div>
                                    </div>
                                    <div class="alert alert-default-warning d-none mb-0" id="no-sesisiswa">
                                        <div class="text-center fw-semibold"><i class="fas fa-exclamation-circle me-1"></i> Anda belum terdaftar sebagai peserta ujian</div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="alert alert-default-danger mb-0 p-3.5">
                                        <div class="text-center fw-bold mb-2">** INFORMASI PENTING **</div>
                                        <div class="small fw-semibold mb-1">Selama melaksanakan ULANGAN/UJIAN <u>Siswa DILARANG:</u></div>
                                        <ul class="small mb-0 ps-3">
                                            <li class="mb-1">Meninggalkan ruang ujian tanpa izin pengawas</li>
                                            <li class="mb-1">Logout/Keluar dari aplikasi tanpa izin dari pengawas</li>
                                            <li class="mb-1">Saling memberitahukan jawaban sesama peserta</li>
                                            <li class="mb-1">Membawa makanan dan minuman</li>
                                            <li>Membawa handphone ke ruangan ujian</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: JADWAL PENILAIAN HARI INI -->
                <div class="col-12">
                    <div class="card my-shadow mb-4 border-0" style="border-radius: 15px; overflow: hidden;">
                        <div class="card-header d-flex justify-content-between align-items-center py-3 border-bottom bg-white">
                            <h6 class="text-center w-100 fw-bold mb-0 text-uppercase" style="letter-spacing: 0.05em; color: #232D42;">
                                JADWAL PENILAIAN HARI INI<br/>
                                <span class="small text-muted font-normal text-capitalize mt-1 d-block"><?= buat_tanggal(date('D, d M Y')) ?></span>
                            </h6>
                        </div>
                        <div class="card-body p-4" style="min-height: 200px;">
                            <div class="row g-4" id="jadwal-content">
                                <!-- Populated dynamically by JS -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card 3: JADWAL PENILAIAN SEBELUMNYA -->
                <div class="col-12">
                    <div class="card my-shadow mb-4 border-0" style="border-radius: 15px; overflow: hidden;">
                        <div class="card-header d-flex justify-content-between align-items-center py-3 border-bottom bg-white">
                            <h6 class="text-center w-100 fw-bold mb-0 text-uppercase" style="letter-spacing: 0.05em; color: #232D42;">
                                JADWAL PENILAIAN SEBELUMNYA
                            </h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0" id="table-container"></table>
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
    $(document).ready(async function () {
        const idSiswa = <?= (int)($siswa->id_siswa ?? session()->get('id_siswa') ?? session()->get('id_user') ?? 0) ?>;
        const data = await ajaxGet('cbtsiswa/get_cbt_siswa?id_siswa=' + idSiswa);
        console.log('cbtSiswa', data)
        await populateDataSiswa(data)
    })

    async function populateDataSiswa(data) {
        const siswa = data.siswa
        const listContainer = document.querySelector('.list-group-unbordered');
        const arrTitle = ['No. Peserta', 'Ruang', 'Sesi', 'Dari', 'Sampai'];
        
        const noPeserta = siswa?.sesisiswa?.peserta?.nomor_peserta || siswa?.nis || siswa?.nisn || siswa?.username || '-';
        const ruang = siswa?.sesisiswa?.ruang?.nama_ruang || 'Ruang 1';
        const sesi = siswa?.sesisiswa?.sesi?.nama_sesi || 'Sesi 1';
        const dari = (siswa?.sesisiswa?.sesi?.waktu_mulai || '06:00:00').slice(0, 5);
        const sampai = (siswa?.sesisiswa?.sesi?.waktu_akhir || '23:59:00').slice(0, 5);

        const arrSub = [noPeserta, ruang, sesi, dari, sampai];

        if (listContainer) {
            listContainer.innerHTML = '';
            arrTitle.forEach((title, index) => {
                const listItem = `
                    <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-1 border-bottom">
                        <span class="small text-muted fw-semibold">${title}</span>
                        <span class="fw-bold text-dark small">${arrSub[index]}</span>
                    </li>
                `;
                listContainer.innerHTML += listItem;
            });
        }

        // Tampilkan kartu info siswa dan pastikan peringatan belum terdaftar disembunyikan
        $('#info-siswa').removeClass('d-none');
        $('#no-sesisiswa').addClass('d-none');

        await populateJadwalHariIni(data.jadwal_today || {}, siswa, data.today);
        await populateJadwalSebelumnya(data.jadwal_before || {}, siswa, data.today);
    }

    async function populateJadwalHariIni(jadwals, siswa, skrg) {
        let arrJadwalSelesai = []
        const tableContainer = document.getElementById('jadwal-content')
        if (jadwals && Object.keys(jadwals).length > 0) {
            let konten = '';
            for (const tanggal in jadwals) {
                jadwals[tanggal].sort(sortByJam)
                let indJam = 1;
                let jadwalSebelumnya;
                for (const bank of jadwals[tanggal]) {
                    const jadwal = bank.jadwal;
                    const jamKe = jadwal.jam_ke === '0' ? '1' : jadwal.jam_ke;
                    const cbtSiswa = (siswa.cbtsiswa || []).find(cbt => cbt.id_jadwal === jadwal.id_jadwal)

                    const startDay = (jadwal.tgl_mulai || '').replaceAll('-', '');
                    const endDay = (jadwal.tgl_selesai || '').replaceAll('-', '');
                    const today = (skrg.split(' ')[0] || '').replaceAll('-', '');

                    const waktuMulai = siswa?.sesisiswa?.sesi?.waktu_mulai || '00:00:00';
                    const waktuAkhir = siswa?.sesisiswa?.sesi?.waktu_akhir || '23:59:59';
                    const sesiMulai = waktuMulai.replaceAll(':', '');
                    const sesiSampai = waktuAkhir.replaceAll(":", '');
                    const now = (skrg.split(' ')[1] || '').replaceAll(':', '');

                    const jamSebelumnya = jadwalSebelumnya?.jam_ke;
                    const idSebelumnya = jadwalSebelumnya?.id_jadwal
                    const cbtSebelumnya = siswa.cbtsiswa.find(cbt => cbt.id_jadwal === idSebelumnya)
                    const selesaiSebelumnya = jamSebelumnya == '0' || jamSebelumnya === jamKe ? true : cbtSebelumnya?.selesai

                    let selesai, lanjutkan, resetWaktu, cardHeaderBg, badgeBg;
                    if (cbtSiswa) {
                        selesai = cbtSiswa.selesai !== null;
                        lanjutkan = cbtSiswa.lama_ujian !== null;
                        resetWaktu = cbtSiswa.reset_waktu;
                        if (lanjutkan && !selesai) {
                            if (indJam > 1 && !selesaiSebelumnya) {
                                cardHeaderBg = 'bg-secondary text-white';
                                badgeBg = 'bg-secondary';
                            } else {
                                cardHeaderBg = 'bg-warning text-dark';
                                badgeBg = 'bg-warning text-dark';
                            }
                        } else {
                            if (selesai) {
                                cardHeaderBg = 'bg-success text-white';
                                badgeBg = 'bg-success';
                            } else {
                                cardHeaderBg = 'bg-danger text-white';
                                badgeBg = 'bg-danger';
                            }
                        }
                    } else {
                        selesai = false;
                        lanjutkan = false;
                        resetWaktu = "0";
                        cardHeaderBg = 'bg-danger text-white';
                        badgeBg = 'bg-danger';
                    }

                    let jadwalCard = `
                <div class="jadwal-cbt col-md-6 col-lg-4">
                    <div class="card border my-shadow h-100 cbt-exam-card overflow-hidden">
                        <div class="card-header bg-light d-flex align-items-center justify-content-between px-3 border-bottom" style="height: 46px !important; padding-top: 0 !important; padding-bottom: 0 !important;">
                            <span class="fw-bold text-dark small d-flex align-items-center mb-0" style="line-height: 1;"><i class="far fa-clock me-1 text-primary"></i> Jam ke: ${jamKe} ${(parseInt(jadwal.lock_browser || 0) > 0) ? '<span class="badge bg-danger bg-opacity-10 text-danger border border-danger-subtle rounded-pill small ms-1.5" style="font-size:0.7rem; padding:2px 7px;"><i class="fas fa-shield-alt me-1"></i>Exambro</span>' : ''}</span>
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill small d-flex align-items-center mb-0" style="line-height: 1; padding: 5px 10px;"><i class="fas fa-stopwatch me-1"></i> ${jadwal.durasi_ujian} mnt</span>
                        </div>
                        <div class="card-body p-3 pt-2.5">
                            <div class="p-3 rounded-3 ${cardHeaderBg} mb-3 shadow-sm">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="w-100 text-truncate">
                                        <h6 class="fw-bold mb-1 text-truncate" style="color: inherit;">${bank.mapel.nama_mapel}</h6>
                                        <small class="opacity-75 d-block text-truncate">${bank.bank_kode}</small>
                                        <span class="badge bg-white bg-opacity-25 text-white mt-1 border border-white border-opacity-25 small">${jadwal.jenis.nama_jenis}</span>
                                    </div>
                                    <div class="ms-2 opacity-50">
                                        <i class="fas fa-book-open fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid mt-2">`;

                    if (!lanjutkan && resetWaktu === "0" && !selesai) {
                        if (today < startDay) {
                            jadwalCard += `<div class="btn btn-sm btn-light border fw-bold disabled">BELUM DIMULAI</div>`;
                        } else if (today > endDay) {
                            jadwalCard += `<div class="btn btn-sm btn-light border fw-bold disabled">WAKTU UJIAN BERAKHIR</div>`;
                        } else {
                            if (now < sesiMulai) {
                                jadwalCard += `<div class="btn btn-sm btn-light border fw-bold disabled">BELUM DIMULAI</div>`;
                            } else if (now > sesiSampai) {
                                jadwalCard += `<div class="btn btn-sm btn-light border fw-bold disabled">SUDAH BERAKHIR</div>`;
                            } else {
                                if (indJam > 1 && !selesaiSebelumnya) {
                                    jadwalCard += `<button class="btn btn-sm btn-secondary fw-bold disabled" disabled>MENUNGGU</button>`;
                                } else {
                                    jadwalCard += `<button class="btn btn-sm btn-primary fw-bold shadow-sm" onclick="location.href='${base_url}cbtsiswa/konfirmasi/${jadwal.id_jadwal}'">KERJAKAN <i class="fas fa-arrow-right ms-1"></i></button>`;
                                }
                            }
                        }
                    } else if (lanjutkan && !selesai) {
                        if (indJam > 1 && !selesaiSebelumnya) {
                            jadwalCard += `<button class="btn btn-sm btn-secondary fw-bold disabled" disabled>MENUNGGU</button>`;
                        } else {
                            jadwalCard += `<button class="btn btn-sm btn-warning fw-bold text-dark shadow-sm" onclick="location.href='${base_url}cbtsiswa/konfirmasi/${jadwal.id_jadwal}'">LANJUTKAN <i class="fas fa-redo ms-1"></i></button>`;
                        }
                    } else {
                        if (String(jadwal.hasil_tampil) === '1') {
                            jadwalCard += `
                                <div class="d-flex flex-column gap-2">
                                    <div class="d-flex align-items-center justify-content-center p-2 rounded-2 bg-success bg-opacity-10 border border-success">
                                        <span class="fw-bold text-success small"><i class="fas fa-check-circle me-1"></i> SELESAI</span>
                                    </div>
                                    <button class="btn btn-sm btn-success text-white fw-bold shadow-sm" onclick="showDetailNilai('${jadwal.id_jadwal}', '${siswa.id_siswa}')">
                                        <i class="fas fa-file-invoice me-1"></i> LIHAT RINCIAN NILAI
                                    </button>
                                </div>`;
                        } else {
                            jadwalCard += `<div class="btn btn-sm btn-success fw-bold disabled"><i class="fas fa-check-circle me-1"></i> SUDAH SELESAI</div>`;
                        }
                    }

                    jadwalCard += `</div></div></div></div>`;
                    konten += jadwalCard;
                    indJam ++;
                    jadwalSebelumnya = jadwal;
                }
            }
            tableContainer.innerHTML = konten;
        } else {
            tableContainer.innerHTML = `
            <div class="col-12">
                <div class="alert alert-warning border-0 rounded-3 text-center py-4 mb-0">
                    <i class="fas fa-info-circle fa-2x mb-2 text-warning d-block opacity-75"></i>
                    <div class="fw-semibold">Tidak ada jadwal penilaian hari ini.</div>
                </div>
            </div>`;
        }
    }

    async function populateJadwalSebelumnya(jadwals, siswa, skrg) {
        const tableContainer = document.getElementById('table-container')
        if (Object.keys(jadwals).length > 0) {
            let tableHTML = '';
            for (const tanggal in jadwals) {
                const tgl = new Date(tanggal).toLocaleDateString('id-ID', {
                    year: "numeric",
                    month: "short",
                    day: "2-digit",
                })

                tableHTML += `
            <tr class="table-secondary">
                <td colspan="4" class="tgl-ujian text-center fw-bold py-2 text-uppercase" data-tgl="${tanggal}">
                    <i class="far fa-calendar-alt me-1"></i> ${tgl}
                </td>
            </tr>
            <tr class="bg-light text-muted small fw-bold">
                <th class="text-center align-middle" style="width: 100px;">Jam ke</th>
                <th class="align-middle">Mapel</th>
                <th class="align-middle d-none d-md-table-cell">Jenis Penilaian</th>
                <th class="align-middle text-center" style="width: 160px;">Status</th>
            </tr>
        `;
                let indJam = 1;
                let jadwalSebelumnya;
                jadwals[tanggal].sort(sortByJam)
                for (const bank of jadwals[tanggal]) {
                    const jadwal = bank.jadwal;
                    const jamKe = jadwal.jam_ke === '0' ? '1' : jadwal.jam_ke;
                    const cbtSiswa = (siswa.cbtsiswa || []).find(cbt => cbt.id_jadwal === jadwal.id_jadwal)

                    const startDay = (jadwal.tgl_mulai || '').replaceAll('-', '');
                    const endDay = (jadwal.tgl_selesai || '').replaceAll('-', '');
                    const today = (skrg.split(' ')[0] || '').replaceAll('-', '');

                    const waktuMulai = siswa?.sesisiswa?.sesi?.waktu_mulai || '00:00:00';
                    const waktuAkhir = siswa?.sesisiswa?.sesi?.waktu_akhir || '23:59:59';
                    const sesiMulai = waktuMulai.replaceAll(':', '');
                    const sesiSampai = waktuAkhir.replaceAll(":", '');
                    const now = (skrg.split(' ')[1] || '').replaceAll(':', '');

                    const jamSebelumnya = jadwalSebelumnya?.jam_ke;
                    const idSebelumnya = jadwalSebelumnya?.id_jadwal
                    const cbtSebelumnya = siswa.cbtsiswa.find(cbt => cbt.id_jadwal === idSebelumnya)
                    const selesaiSebelumnya = jamSebelumnya == '0' || jamSebelumnya === jamKe ? true : cbtSebelumnya?.selesai

                    let selesai, lanjutkan, resetWaktu, bg;
                    if (cbtSiswa) {
                        selesai = cbtSiswa.selesai !== null;
                        lanjutkan = cbtSiswa.lama_ujian !== null;
                        resetWaktu = cbtSiswa.reset_waktu;
                        if (lanjutkan && !selesai) {
                            if (indJam > 1 && !selesaiSebelumnya) {
                                bg = 'btn-secondary';
                            } else {
                                bg = 'btn-warning text-dark';
                            }
                        } else {
                            bg = selesai ? 'btn-success' : 'btn-danger';
                        }
                    } else {
                        selesai = false;
                        lanjutkan = false;
                        resetWaktu = "0";
                        bg = 'btn-danger';
                    }

                    let status = '';
                    if (!lanjutkan && resetWaktu === "0" && !selesai) {
                        if (today < startDay) {
                            status = `<button id="${jadwal.id_jadwal}" class="status-table btn btn-sm border w-100 disabled" data-tgl="${jadwal.tgl_mulai}" data-jamke="${jadwal.jam_ke}">
                        <b>BELUM DIMULAI</b>
                    </button>`;
                        } else if (today > endDay) {
                            status = `<button id="${jadwal.id_jadwal}" class="status-table btn btn-sm border w-100 disabled" data-tgl="${jadwal.tgl_mulai}" data-jamke="${jadwal.jam_ke}">
                        <b>WAKTU UJIAN BERAKHIR</b>
                    </button>`;
                        } else {
                            if (now < sesiMulai) {
                                status = `<button id="${jadwal.id_jadwal}" class="status-table btn btn-sm border w-100 disabled" data-tgl="${jadwal.tgl_mulai}" data-jamke="${jadwal.jam_ke}">
                            <b>BELUM DIMULAI</b>
                        </button>`;
                            } else if (now > sesiSampai) {
                                status = `<button id="${jadwal.id_jadwal}" class="status-table btn btn-sm border w-100 disabled" data-tgl="${jadwal.tgl_mulai}" data-jamke="${jadwal.jam_ke}">
                            <b>SUDAH BERAKHIR</b>
                        </button>`;
                            } else {
                                if (indJam > 1 && !selesaiSebelumnya) {
                                    status = `<button id="${jadwal.id_jadwal}" class="status-table btn btn-sm btn-secondary w-100 disabled" disabled>
                                    <b>MENUNGGU</b></button>`;
                                } else {
                                    status = `<button id="${jadwal.id_jadwal}" class="status-table btn btn-sm btn-primary w-100 shadow-sm" onclick="location.href='${base_url}cbtsiswa/konfirmasi/${jadwal.id_jadwal}'">
                                <b>KERJAKAN</b></button>`;
                                }
                            }
                        }
                    } else if (lanjutkan && !selesai) {
                        if (indJam > 1 && !selesaiSebelumnya) {
                            status = `<button id="${jadwal.id_jadwal}" class="status-table btn btn-sm btn-secondary w-100 disabled" disabled><b>MENUNGGU</b></button>`;
                        } else {
                            status = `<button id="${jadwal.id_jadwal}" class="status-table btn btn-sm btn-warning w-100 text-dark shadow-sm" onclick="location.href='${base_url}cbtsiswa/konfirmasi/${jadwal.id_jadwal}'"><b>LANJUTKAN</b></button>`;
                        }
                    } else {
                        if (String(jadwal.hasil_tampil) === '1') {
                            status = `<button class="status-table btn btn-sm btn-outline-success fw-bold w-100 shadow-sm" onclick="showDetailNilai('${jadwal.id_jadwal}', '${siswa.id_siswa}')">
                                <i class="fas fa-file-invoice me-1"></i> <b>RINCIAN NILAI</b>
                            </button>`;
                        } else {
                            status = `<button id="${jadwal.id_jadwal}" class="status-table btn btn-sm btn-success w-100 disabled" data-tgl="${jadwal.tgl_mulai}" data-jamke="${jadwal.jam_ke}"><b>SUDAH SELESAI</b></button>`;
                        }
                    }

                    tableHTML += `
                <tr>
                    <td class="text-center fw-semibold small align-middle">${jamKe}<br><span class="text-muted" style="font-size: 0.75rem;">${jadwal.durasi_ujian} mnt</span></td>
                    <td class="align-middle">
                        <div class="fw-bold text-dark small">${bank.mapel.nama_mapel}</div>
                        <small class="text-muted">${bank.bank_kode}</small>
                        <small class="d-block d-md-none text-primary fw-semibold">${jadwal.jenis.nama_jenis}</small>
                    </td>
                    <td class="d-none d-md-table-cell align-middle"><span class="badge bg-light text-dark border small">${jadwal.jenis.nama_jenis}</span></td>
                    <td class="align-middle text-center">${status}</td>
                </tr>`;

                    indJam ++;
                    jadwalSebelumnya = jadwal;
                }
            }
            tableContainer.innerHTML = tableHTML;
        } else {
            tableContainer.innerHTML = `
            <tr>
                <td colspan="4" class="text-center py-4 text-muted">
                    <i class="fas fa-info-circle me-1"></i> Tidak ada jadwal penilaian sebelumnya.
                </td>
            </tr>`;
        }
    }

    function sortByJam(a, b) {
        var a_jam = a.jadwal.jam_ke;
        var b_jam = b.jadwal.jam_ke;
        return ((a_jam < b_jam) ? -1 : ((a_jam > b_jam) ? 1 : 0));
    }

    async function ajaxGet(url) {
        return new Promise((resolve, reject) => {
            setTimeout(function () {
                $.ajax({
                    url: base_url + url,
                    type: "GET",
                    success: function (respon) {
                        resolve(respon);
                    },
                    error: function (xhr, status, error) {
                        reject(error);
                    }
                });
            }, 100)
        });
    }

    async function showDetailNilai(idJadwal, idSiswa) {
        swal.fire({
            title: 'Memuat Rincian Nilai...',
            text: 'Harap tunggu sejenak',
            allowOutsideClick: false,
            didOpen: () => {
                swal.showLoading();
            }
        });

        try {
            const res = await ajaxGet(`kbm/get_nilai_jadwal?jadwal=${idJadwal}&siswa=${idSiswa}`);
            if (res && res.success && res.jadwal) {
                const j = res.jadwal;
                const b = j.bank || {};
                const ss = j.sesisiswa || {};
                const skor = ss.nilai_akhir || {};
                const dur = ss.durasi || {};

                const totalSkor = Math.round((Number(skor.skor_total != null ? skor.skor_total : (skor.skor_asli ?? skor.pg_nilai ?? 0)) + Number.EPSILON) * 100) / 100;
                const mapelNama = b?.mapel?.nama_mapel || b?.mapel?.kode || 'Mata Pelajaran';
                const kodeBank = b?.bank_kode || '';

                const tampilPg = parseInt(b.tampil_pg || '0');
                const tampilKompleks = parseInt(b.tampil_kompleks || '0');
                const tampilJodohkan = parseInt(b.tampil_jodohkan || '0');
                const tampilIsian = parseInt(b.tampil_isian || '0');
                const tampilEsai = parseInt(b.tampil_esai || '0');

                let rowsHtml = '';
                let totalBenar = 0;
                let totalSoal = 0;

                if (tampilPg > 0) {
                    const benarPg = Number(skor.pg_benar ?? 0);
                    const nilaiPg = Math.round((Number(skor.skor_pg?.skor_total ?? (skor.pg_nilai ?? 0)) + Number.EPSILON) * 100) / 100;
                    totalBenar += benarPg;
                    totalSoal += tampilPg;
                    rowsHtml += `
                        <tr>
                            <td class="text-start ps-2">Pilihan Ganda</td>
                            <td>${tampilPg}</td>
                            <td class="text-success fw-bold">${benarPg}</td>
                            <td class="text-end pe-2 fw-bold">${nilaiPg}</td>
                        </tr>
                    `;
                }

                if (tampilKompleks > 0) {
                    const benarKomp = Math.round((Number(skor.skor_kompleks?.jml_benar ?? 0) + Number.EPSILON) * 100) / 100;
                    const nilaiKomp = Math.round((Number(skor.skor_kompleks?.skor_total ?? 0) + Number.EPSILON) * 100) / 100;
                    totalBenar += benarKomp;
                    totalSoal += tampilKompleks;
                    rowsHtml += `
                        <tr>
                            <td class="text-start ps-2">PG Kompleks</td>
                            <td>${tampilKompleks}</td>
                            <td class="text-success fw-bold">${benarKomp}</td>
                            <td class="text-end pe-2 fw-bold">${nilaiKomp}</td>
                        </tr>
                    `;
                }

                if (tampilJodohkan > 0) {
                    const benarJod = Math.round((Number(skor.skor_jodohkan?.jml_benar ?? 0) + Number.EPSILON) * 100) / 100;
                    const nilaiJod = Math.round((Number(skor.skor_jodohkan?.skor_total ?? 0) + Number.EPSILON) * 100) / 100;
                    totalBenar += benarJod;
                    totalSoal += tampilJodohkan;
                    rowsHtml += `
                        <tr>
                            <td class="text-start ps-2">Menjodohkan</td>
                            <td>${tampilJodohkan}</td>
                            <td class="text-success fw-bold">${benarJod}</td>
                            <td class="text-end pe-2 fw-bold">${nilaiJod}</td>
                        </tr>
                    `;
                }

                if (tampilIsian > 0) {
                    const benarIsian = Math.round((Number(skor.skor_isian?.jml_benar ?? 0) + Number.EPSILON) * 100) / 100;
                    const nilaiIsian = Math.round((Number(skor.skor_isian?.skor_total ?? 0) + Number.EPSILON) * 100) / 100;
                    totalBenar += benarIsian;
                    totalSoal += tampilIsian;
                    rowsHtml += `
                        <tr>
                            <td class="text-start ps-2">Isian Singkat</td>
                            <td>${tampilIsian}</td>
                            <td class="text-success fw-bold">${benarIsian}</td>
                            <td class="text-end pe-2 fw-bold">${nilaiIsian}</td>
                        </tr>
                    `;
                }

                if (tampilEsai > 0) {
                    const nilaiEsai = Math.round((Number(skor.skor_essai?.skor_total ?? 0) + Number.EPSILON) * 100) / 100;
                    totalSoal += tampilEsai;
                    rowsHtml += `
                        <tr>
                            <td class="text-start ps-2">Uraian / Esai</td>
                            <td>${tampilEsai}</td>
                            <td class="text-muted">-</td>
                            <td class="text-end pe-2 fw-bold">${nilaiEsai}</td>
                        </tr>
                    `;
                }

                if (!rowsHtml) {
                    const benarFallback = skor.pg_benar != null ? skor.pg_benar : '-';
                    const nilaiFallback = Math.round((Number(skor.pg_nilai ?? totalSkor) + Number.EPSILON) * 100) / 100;
                    rowsHtml = `
                        <tr>
                            <td class="text-start ps-2">Pilihan Ganda</td>
                            <td>${b.jml_soal || '-'}</td>
                            <td class="text-success fw-bold">${benarFallback}</td>
                            <td class="text-end pe-2 fw-bold">${nilaiFallback}</td>
                        </tr>
                    `;
                }

                swal.fire({
                    title: 'Hasil Penilaian Siswa',
                    html: `
                        <div class="my-2 text-center">
                            <h6 class="fw-bold mb-1">${mapelNama}</h6>
                            <p class="text-muted small mb-2">${kodeBank}</p>
                            <p class="text-muted mb-0 small text-uppercase fw-bold">Nilai Akhir Siswa</p>
                            <div class="display-4 fw-bold text-success mb-2">${totalSkor}</div>
                            <div class="table-responsive mb-2">
                                <table class="table table-bordered table-sm align-middle text-center mb-0" style="font-size: 0.85rem;">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="text-start ps-2">Tipe Soal</th>
                                            <th style="width: 70px;">Soal</th>
                                            <th style="width: 65px;">Benar</th>
                                            <th class="text-end pe-2" style="width: 75px;">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${rowsHtml}
                                    </tbody>
                                    <tfoot class="table-light">
                                        <tr>
                                            <th colspan="3" class="text-end pe-2 fw-bold">TOTAL NILAI</th>
                                            <th class="text-end pe-2 text-success fw-bolder fs-6">${totalSkor}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="card bg-light border-0 p-2 text-start small">
                                <div class="d-flex justify-content-between mb-1">
                                    <span><i class="fas fa-stopwatch text-info me-1"></i> Durasi Pengerjaan:</span>
                                    <b>${dur.durasi || dur.lama_ujian || '-'}</b>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span><i class="fas fa-calendar-check text-primary me-1"></i> Selesai pada:</span>
                                    <b>${dur.selesai || '-'}</b>
                                </div>
                            </div>
                        </div>
                    `,
                    icon: 'success',
                    confirmButtonText: 'Tutup',
                    confirmButtonColor: '#3085d6'
                });
            } else {
                swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: res?.message || 'Data rincian nilai belum tersedia.',
                    confirmButtonText: 'Tutup'
                });
            }
        } catch (e) {
            swal.fire({
                icon: 'error',
                title: 'Gagal Memuat Nilai',
                text: 'Terjadi kendala saat memuat data nilai dari server.',
                confirmButtonText: 'Tutup'
            });
        }
    }
</script>
<?= $this->endSection() ?>
