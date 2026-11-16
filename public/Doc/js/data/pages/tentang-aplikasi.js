if (typeof pageContents === 'undefined') var pageContents = {};

// ============================================
// DATA SCREENSHOT (MUDAH DITAMBAH/DIEDIT)
// ============================================
var gcScreenshots = [
    { src: 'screenshot/installer/1_installer.png',     caption: 'Tampilan Installer' },
    { src: 'screenshot/installer/2_installer.png',     caption: 'Tampilan Install Admin' },
    { src: 'screenshot/installer/3_installer.png',     caption: 'Tampilan Install Profile' },
    { src: 'screenshot/installer/4_installer.png',     caption: 'Tampilan Finish Installer' },
    { src: 'screenshot/installer/1_init.png',          caption: 'Tampilan Update Database' },
    { src: 'screenshot/installer/2_init.png',          caption: 'Tampilan Info Update' },
    { src: 'screenshot/installer/3_init.png',          caption: 'Tampilan Konfirmasi Update' },
    { src: 'screenshot/installer/4_init.png',          caption: 'Tampilan Proses Update' },
    { src: 'screenshot/admin/login/kunci.png',               caption: 'Tampilan Kunci Aplikasi' },
    { src: 'screenshot/admin/login/login.png',               caption: 'Tampilan Login' },
    { src: 'screenshot/admin/umum/1_beranda.png',            caption: 'Tampilan Beranda' },
    { src: 'screenshot/admin/umum/2_tp_smt.png',             caption: 'Tampilan Tahun Pelajaran' },
    { src: 'screenshot/admin/umum/3_mapel.png',              caption: 'Tampilan Mata Pelajaran' },
    { src: 'screenshot/admin/umum/3a_mapel.png',             caption: 'Tampilan Mata Pelajaran' },
    { src: 'screenshot/admin/umum/4_jurusan.png',            caption: 'Tampilan Jurusan' },
    { src: 'screenshot/admin/umum/5_kelas.png',              caption: 'Tampilan Kelas' },
    { src: 'screenshot/admin/umum/6_ekstra.png',             caption: 'Tampilan Ekstrakurikuler' },
    { src: 'screenshot/admin/umum/7_siswa.png',              caption: 'Tampilan Siswa' },
	{ src: 'screenshot/admin/umum/7a_siswa.png',             caption: 'Tampilan Add Siswa' },
    { src: 'screenshot/admin/umum/7b_siswa.png',             caption: 'Tampilan Edit Siswa' },
	{ src: 'screenshot/admin/umum/7c_siswa.png',             caption: 'Tampilan Update Siswa' },
    { src: 'screenshot/admin/umum/8_guru.png',               caption: 'Tampilan Guru' },
    { src: 'screenshot/admin/umum/8a_guru.png',              caption: 'Tampilan Add Guru' },
	{ src: 'screenshot/admin/umum/8b_guru.png',              caption: 'Tampilan Edit Guru' },
	{ src: 'screenshot/admin/umum/8c_guru.png',              caption: 'Tampilan Jabatan Guru' },
	{ src: 'screenshot/admin/umum/8d_guru.png',              caption: 'Tampilan Update Guru' },
    { src: 'screenshot/admin/kelas/1_jadwal.png',            caption: 'Tampilan Jadwal E-Learning' },
    { src: 'screenshot/admin/kelas/2_materi.png',            caption: 'Tampilan Jadwal Materi' },
    { src: 'screenshot/admin/kelas/2a_materi_edit.png',      caption: 'Tampilan Materi' },
    { src: 'screenshot/admin/kelas/3_jadwal_materi.png',     caption: 'Tampilan Tanggal Materi' },
    { src: 'screenshot/admin/kelas/4_tugas.png',             caption: 'Tampilan Jadwal Tugas' },
    { src: 'screenshot/admin/kelas/4a_tugas_edit.png',       caption: 'Tampilan Jadwal Tugas' },
    { src: 'screenshot/admin/kelas/4b_jadwal_tugas.png',     caption: 'Tampilan Jadwal Tugas' },
    { src: 'screenshot/admin/kelas/5_perpustakaan.png',      caption: 'Tampilan Perpustakaan' },
    { src: 'screenshot/admin/cbt/1_jenis.png',               caption: 'Tampilan Jenis Ujian' },
    { src: 'screenshot/admin/cbt/2_sesi.png',                caption: 'Tampilan Sesi Ujian' },
    { src: 'screenshot/admin/cbt/3_ruang.png',               caption: 'Tampilan Ruangan Ujian' },
    { src: 'screenshot/admin/cbt/4_no_peserta.png',          caption: 'Tampilan Nomor Peserta' },
    { src: 'screenshot/admin/cbt/4a_no_peserta.png',         caption: 'Tampilan Parameter Peserta' },
    { src: 'screenshot/admin/cbt/5_ruang_kelas.png',         caption: 'Tampilan Ruangan-Kelas' },
    { src: 'screenshot/admin/cbt/6_bank_soal.png',           caption: 'Tampilan List Bank Soal' },
    { src: 'screenshot/admin/cbt/6a_bank_soal.png',          caption: 'Tampilan Grid Bank Soal' },
    { src: 'screenshot/admin/cbt/7_edit_bank.png',           caption: 'Tampilan Edit Bank Soal' },
	{ src: 'screenshot/admin/cbt/8_import_bank.png',         caption: 'Tampilan Import Bank Soal' },
	{ src: 'screenshot/admin/cbt/9a_Detail_soal.png',        caption: 'Tampilan Detail Bank Soal' },
	{ src: 'screenshot/admin/cbt/9b_Detail_soal.png',        caption: 'Tampilan Detail Bank Soal' },
	{ src: 'screenshot/admin/cbt/10_add_soal.png',        	 caption: 'Tampilan Add/Edit Bank Soal' },
    { src: 'screenshot/admin/cbt/11a_jadwal.png',            caption: 'Tampilan List Jadwal Ujian' },
	{ src: 'screenshot/admin/cbt/11b_jadwal.png',            caption: 'Tampilan List Jadwal Ujian' },
    { src: 'screenshot/admin/cbt/12_edit_jadwal.png',        caption: 'Tampilan Edit Jadwal Ujian' },
	{ src: 'screenshot/admin/cbt/13_alokasi.png',            caption: 'Tampilan Alokasi Waktu Ujian' },
	{ src: 'screenshot/admin/cbt/14_Pengawas.png',        	 caption: 'Tampilan Pengawas Ujian' },
	{ src: 'screenshot/admin/cbt/15_token.png',        	 	 caption: 'Tampilan Pengawas Ujian' },
	{ src: 'screenshot/admin/umum/Pengumuman.png',        	 caption: 'Tampilan Pengawas Ujian' },
	{ src: 'screenshot/admin/umum/Log_aktifitas.png',        caption: 'Tampilan Log Aktifitas' }
];

// ============================================
// FUNGSI RENDER CAROUSEL DARI DATA
// ============================================
function gcRenderCarousel() {
    const container = document.getElementById('gc-carousel-container');
    if (!container) return;

    // Hindari render ulang jika sudah ada slide
    if (container.querySelector('.gc-slide')) return;

    let slidesHtml = '';
    gcScreenshots.forEach(function(item) {
        slidesHtml += `
            <div class="gc-slide" style="min-width:100%; box-sizing:border-box; padding:15px; text-align:center;">
                <img src="${item.src}" class="gc-zoom-img"
                     style="width:100%; max-height:500px; object-fit:contain; cursor:zoom-in; border-radius:4px;"
                     data-full="${item.src}" data-caption="${item.caption}">
                <p style="margin-top:8px; font-size:14px; color:#555;">${item.caption}</p>
            </div>
        `;
    });

    container.innerHTML = `
        <div class="gc-slides" style="display:flex; transition:transform 0.5s ease-in-out;">
            ${slidesHtml}
        </div>
        <button onclick="gcSlide(-1)" style="position:absolute; top:50%; left:10px; transform:translateY(-50%); background:rgba(0,0,0,0.5); color:white; border:none; padding:10px 15px; cursor:pointer; border-radius:50%; font-size:18px; z-index:2;">&#10094;</button>
        <button onclick="gcSlide(1)" style="position:absolute; top:50%; right:10px; transform:translateY(-50%); background:rgba(0,0,0,0.5); color:white; border:none; padding:10px 15px; cursor:pointer; border-radius:50%; font-size:18px; z-index:2;">&#10095;</button>
    `;
}

// ============================================
// LOGIKA SLIDESHOW & ZOOM (GLOBAL)
// ============================================
let gcCurrentSlide = 0;
window.gcSlide = function(n) {
    const slides = document.querySelectorAll('.gc-slide');
    if (slides.length === 0) return;
    gcCurrentSlide += n;
    if (gcCurrentSlide >= slides.length) gcCurrentSlide = 0;
    if (gcCurrentSlide < 0) gcCurrentSlide = slides.length - 1;
    const track = document.querySelector('.gc-slides');
    if (track) track.style.transform = 'translateX(-' + (gcCurrentSlide * 100) + '%)';
};
window.gcOpenLightbox = function(imgSrc, caption) {
    const lightbox = document.getElementById('gc-lightbox');
    const img = document.getElementById('gc-lightbox-img');
    const cap = document.getElementById('gc-lightbox-caption');
    if (lightbox && img && cap) {
        img.src = imgSrc;
        cap.innerText = caption || '';
        lightbox.style.display = 'flex';
    }
};
window.gcCloseLightbox = function() {
    const lightbox = document.getElementById('gc-lightbox');
    if (lightbox) lightbox.style.display = 'none';
};

// Event delegation untuk klik gambar zoom
document.addEventListener('click', function(e) {
    if (e.target && e.target.classList && e.target.classList.contains('gc-zoom-img')) {
        e.preventDefault();
        e.stopPropagation();
        const src = e.target.getAttribute('data-full') || e.target.src;
        const caption = e.target.getAttribute('data-caption') || '';
        window.gcOpenLightbox(src, caption);
    }
});

// Shortcut keyboard
document.addEventListener('keydown', function(e) {
    const lightbox = document.getElementById('gc-lightbox');
    if (lightbox && lightbox.style.display === 'flex') {
        if (e.key === 'Escape') window.gcCloseLightbox();
        if (e.key === 'ArrowLeft') window.gcSlide(-1);
        if (e.key === 'ArrowRight') window.gcSlide(1);
    }
});

// ============================================
// AUTO-DETECT: Render carousel saat container muncul di DOM
// Menggunakan MutationObserver agar TIDAK PERLU mengubah renderer
// ============================================
(function() {
    function tryRender() {
        const container = document.getElementById('gc-carousel-container');
        if (container && !container.querySelector('.gc-slide')) {
            gcRenderCarousel();
        }
    }

    // Jalankan sekali saat script di-load (untuk kasus halaman sudah ada)
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', tryRender);
    } else {
        tryRender();
    }

    // Observasi perubahan DOM — otomatis render saat container di-inject
    const observer = new MutationObserver(function(mutations) {
        for (const m of mutations) {
            for (const node of m.addedNodes) {
                if (node.nodeType !== 1) continue;
                if (node.id === 'gc-carousel-container' || (node.querySelector && node.querySelector('#gc-carousel-container'))) {
                    // Beri jeda agar HTML selesai di-inject
                    setTimeout(tryRender, 10);
                    return;
                }
            }
        }
    });
    observer.observe(document.body || document.documentElement, { childList: true, subtree: true });
})();

// ============================================
// KONTEN HALAMAN
// ============================================
pageContents['tentang-aplikasi'] = {
    title: 'Tentang NextGen Garuda CBT Versi 1.5',
    desc: 'Platform Pendidikan Terpadu: CBT Anti-Curang, E-Learning Terstruktur, Buku Rapor Kurmer & K13, Serta Manajemen Alumni.',
    html: `
        <div class="content-card">
            <h2><i class="fas fa-rocket"></i> NextGen Garuda CBT Versi 1.5</h2>
            <p>
                <strong>NextGen Garuda CBT Versi 1.5</strong> adalah platform ekosistem digital komprehensif 
                yang memadukan sistem pelaksanaan Asesmen/Ujian Berbasis Komputer (CBT), Pembelajaran Daring (E-Learning), 
                Pengolahan Buku Rapor Digital (Kurikulum Merdeka & K13), Presensi Kehadiran Bulanan, serta Manajemen Purna Studi (Alumni).
            </p>
            <p>
                Aplikasi ini dirancang khusus untuk memenuhi regulasi pendidikan nasional di Indonesia, mendukung sepenuhnya 
                sekolah di bawah naungan <strong>Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi (Kemendikbudristek)</strong> 
                maupun madrasah di bawah naungan <strong>Kementerian Agama (Kemenag RI)</strong> dengan tata kelola nomenklatur 
                yang otomatis dan cerdas (Kepala Sekolah vs Kepala Madrasah).
            </p>
            <div class="d-flex flex-wrap gap-2 my-3">
                <span class="badge badge-primary p-2 mr-2 mb-2"><i class="fas fa-check-double"></i> CodeIgniter 4.7 Enterprise</span>
                <span class="badge badge-success p-2 mr-2 mb-2"><i class="fab fa-php"></i> PHP 8.3+ High Performance</span>
                <span class="badge badge-info p-2 mr-2 mb-2"><i class="fas fa-shield-alt"></i> Exambro Kiosk v1.5 Protected</span>
                <span class="badge badge-warning p-2 mr-2 mb-2"><i class="fas fa-image"></i> WebP Media Engine</span>
            </div>
            <div class="info-box info" style="margin-top:16px;">
                <i class="fas fa-info-circle"></i>
                <div>
                    <strong>Pembaruan Rilis Versi 1.5:</strong> Rekap Nilai Siswa Semester (Dual Mode Ringkas & Detail), Presensi Bulanan Matriks 1-31, Fitur Kelulusan Massal 1-Klik Alumni, Exambro Android v1.5 dengan Anti-Split Screen & QR Scanner, serta Image Converter WebP.
                </div>
            </div>
        </div>

        <div class="content-card">
            <h2><i class="fas fa-cubes"></i> 6 Pilar Utama Sistem</h2>
            <div class="table-responsive">
                <table class="table-custom">
                    <thead><tr><th style="width: 25%;">Pilar Modul</th><th style="width: 75%;">Kapabilitas Unggulan</th></tr></thead>
                    <tbody>
                        <tr>
                            <td><i class="fas fa-laptop text-primary"></i> <strong>CBT Engine Modern</strong></td>
                            <td>
                                5 Model Soal (Pilihan Ganda, PG Kompleks, Menjodohkan, Isian Singkat, Uraian), Editor Rumus Matematika (KaTeX) & Simbol Kimia, Audio Listening, Token Dinamis 15 Menit, Ruang Ujian, Pengawas, Real-Time Live Monitoring, serta Analisis Butir Soal Interaktif dengan visualisasi Chart.js.
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fab fa-android text-success"></i> <strong>NextGen Exambro v1.5</strong></td>
                            <td>
                                Aplikasi Kiosk Lock-down untuk smartphone Android (mematikan tombol navigasi, anti split-screen, blokir floating window, deteksi screenshot & screen recorder) dilengkapi kamera pemindai QR Code untuk login cepat dari Kartu Peserta Ujian.
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-book-reader text-info"></i> <strong>E-Learning & KBM</strong></td>
                            <td>
                                Distribusi materi ajar terstruktur, penugasan berbatas waktu, presensi kehadiran harian, <strong>Presensi Leger Bulanan (1-31)</strong> berformula persentase, dan <strong>Rekap Nilai Siswa Semester</strong> dengan dual-mode (Ringkas Bulanan vs Detail Harian) serta KKM dinamis real-time.
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-award text-warning"></i> <strong>Buku Rapor Kurmer & K13</strong></td>
                            <td>
                                Mendukung Kurikulum Merdeka (Asesmen Formatif, Sumatif Lingkup Materi, Sumatif Akhir Semester, Nilai Rapor P5/P2RA) dan K13. Dilengkapi sistem pencetakan cetak massal satu kelas, kop dinas resmi, dan deteksi otomatis gelar <strong>Kepala Madrasah</strong> (MI/MTs/MA) vs <strong>Kepala Sekolah</strong> (SD/SMP/SMA).
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-user-graduate text-danger"></i> <strong>Data Alumni & Kelulusan</strong></td>
                            <td>
                                Modul purna studi dengan fitur <strong>Kelulusan Massal (Bulk Graduation)</strong> per rombel kelas akhir dalam 1 klik tanpa merusak arsip nilai lama, pelacakan lulusan (Tracer Study), dan ekspor data alumni ke spreadsheet.
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-tools text-secondary"></i> <strong>Image Converter WebP</strong></td>
                            <td>
                                Utilitas kompresi gambar massal (JPG/PNG/GIF ke WebP) dengan efisiensi hingga 80-85% untuk menjaga kecepatan akses server saat ribuan siswa login ujian secara bersamaan.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="content-card">
            <h2><i class="fas fa-balance-scale"></i> Dual Nomenklatur Otomatis (Madrasah vs Sekolah)</h2>
            <p>
                NextGen Garuda CBT Versi 1.5 secara cerdas mendeteksi entitas satuan pendidikan Anda:
            </p>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="p-3 border rounded" style="background: rgba(40, 167, 69, 0.05); border-color: rgba(40, 167, 69, 0.3) !important;">
                        <h5 class="text-success font-weight-bold"><i class="fas fa-mosque"></i> Jenjang Kementerian Agama (Kemenag)</h5>
                        <p class="mb-1"><strong>Jenjang:</strong> MI (Madrasah Ibtidaiyah), MTs (Madrasah Tsanawiyah), MA (Madrasah Aliyah).</p>
                        <p class="mb-0"><strong>Title Tanda Tangan:</strong> Otomatis tercetak sebagai <code>Kepala Madrasah</code> pada seluruh dokumen Rapor, Rekap Nilai, Berita Acara CBT, dan Leger.</p>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="p-3 border rounded" style="background: rgba(0, 123, 255, 0.05); border-color: rgba(0, 123, 255, 0.3) !important;">
                        <h5 class="text-primary font-weight-bold"><i class="fas fa-school"></i> Jenjang Dinas Pendidikan (Kemendikbud)</h5>
                        <p class="mb-1"><strong>Jenjang:</strong> SD (Sekolah Dasar), SMP (Sekolah Menengah Pertama), SMA/SMK.</p>
                        <p class="mb-0"><strong>Title Tanda Tangan:</strong> Otomatis tercetak sebagai <code>Kepala Sekolah</code> pada seluruh dokumen Rapor, Rekap Nilai, Berita Acara CBT, dan Leger.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-card">
            <h2><i class="fas fa-server"></i> Spesifikasi Arsitektur Sistem</h2>
            <table class="table-custom">
                <thead><tr><th>Komponen</th><th>Spesifikasi Rekomendasi</th></tr></thead>
                <tbody>
                    <tr><td><strong>Bahasa Pemrograman</strong></td><td>PHP 8.2 / PHP 8.3 / PHP 8.4 (Direkomendasikan PHP 8.3+)</td></tr>
                    <tr><td><strong>Framework Inti</strong></td><td>CodeIgniter 4.7 Engine (Fast Routing & Scalable MVC)</td></tr>
                    <tr><td><strong>Database Server</strong></td><td>MariaDB 10.4+ atau MySQL 8.0+ dengan InnoDB Engine</td></tr>
                    <tr><td><strong>Ekstensi Wajib PHP</strong></td><td>intl, mbstring, gd (dengan dukungan WebP), curl, json, xml</td></tr>
                    <tr><td><strong>Web Server</strong></td><td>Apache 2.4+ (mod_rewrite aktif) atau Nginx + PHP-FPM</td></tr>
                    <tr><td><strong>Client Browser</strong></td><td>Google Chrome 100+, Edge 100+, Mozilla Firefox 100+, Android Webview 90+</td></tr>
                </tbody>
            </table>
        </div>

        <div class="content-card">
            <h2><i class="fas fa-images"></i> Galeri Antarmuka Aplikasi</h2>
            <p>Berikut adalah beberapa tangkapan layar antarmuka NextGen Garuda CBT Versi 1.5. <em>Klik gambar untuk memperbesar (zoom).</em></p>

            <!-- Container kosong, akan di-render otomatis oleh MutationObserver -->
            <div id="gc-carousel-container" style="position:relative; max-width:100%; margin:0 auto; overflow:hidden; border-radius:8px; background:#f9f9f9; border:1px solid #ddd;"></div>

            <!-- Lightbox -->
            <div id="gc-lightbox" style="display:none; position:fixed; z-index:9999; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.9); justify-content:center; align-items:center; flex-direction:column; cursor:zoom-out;" onclick="gcCloseLightbox()">
                <span style="position:absolute; top:20px; right:30px; color:#fff; font-size:40px; font-weight:bold; cursor:pointer;">&times;</span>
                <img id="gc-lightbox-img" src="" style="max-width:90%; max-height:85vh; border-radius:8px; box-shadow:0 4px 20px rgba(0,0,0,0.5);">
                <p id="gc-lightbox-caption" style="color:#fff; margin-top:15px; font-size:16px; text-align:center;"></p>
            </div>
        </div>
    `
};