if (typeof pageContents === 'undefined') var pageContents = {};

// ============================================
// DATA SCREENSHOT (CAROUSEL & LIGHTBOX)
// ============================================
var gcScreenshots = [
    { src: 'screenshot/cbt/12_jadwal.png', caption: 'Tampilan Jadwal Ujian' },
    { src: 'screenshot/umum/1_beranda.png', caption: 'Tampilan Beranda' },
    { src: 'screenshot/installer/1_installer.png', caption: 'Tampilan Installer' },
    { src: 'screenshot/installer/4_installer.png', caption: 'Tampilan Finish Installer' },
    { src: 'screenshot/admin/umum/7_siswa.png', caption: 'Tampilan Data Siswa' },
    { src: 'screenshot/admin/umum/8_guru.png', caption: 'Tampilan Data Guru' },
    { src: 'screenshot/admin/cbt/6_bank_soal.png', caption: 'Tampilan Bank Soal' },
    { src: 'screenshot/admin/cbt/11a_jadwal.png', caption: 'Tampilan Jadwal Ujian CBT' },
    { src: 'screenshot/admin/cbt/15_token.png', caption: 'Tampilan Token CBT' }
];

// ============================================
// FUNGSI RENDER CAROUSEL DARI DATA
// ============================================
function gcRenderCarousel() {
    const container = document.getElementById('gc-carousel-container');
    if (!container) return;

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

document.addEventListener('click', function(e) {
    if (e.target && e.target.classList && e.target.classList.contains('gc-zoom-img')) {
        e.preventDefault();
        e.stopPropagation();
        const src = e.target.getAttribute('data-full') || e.target.src;
        const caption = e.target.getAttribute('data-caption') || '';
        window.gcOpenLightbox(src, caption);
    }
});

document.addEventListener('keydown', function(e) {
    const lightbox = document.getElementById('gc-lightbox');
    if (lightbox && lightbox.style.display === 'flex') {
        if (e.key === 'Escape') window.gcCloseLightbox();
        if (e.key === 'ArrowLeft') window.gcSlide(-1);
        if (e.key === 'ArrowRight') window.gcSlide(1);
    }
});

(function() {
    function tryRender() {
        const container = document.getElementById('gc-carousel-container');
        if (container && !container.querySelector('.gc-slide')) {
            gcRenderCarousel();
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', tryRender);
    } else {
        tryRender();
    }

    const observer = new MutationObserver(function(mutations) {
        for (const m of mutations) {
            for (const node of m.addedNodes) {
                if (node.nodeType !== 1) continue;
                if (node.id === 'gc-carousel-container' || (node.querySelector && node.querySelector('#gc-carousel-container'))) {
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
    title: 'Tentang Garuda CBT',
    desc: 'Gabungan Aplikasi Rapor, Ujian dan e-Learning (Garuda CBT)',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-info-circle text-info"></i> Apa itu Garuda CBT</h2>
        <p>
            <strong>Garuda CBT</strong> adalah Gabungan Aplikasi Rapor, Ujian dan e-Learning.
            Aplikasi berbasis web yang dirancang khusus untuk kebutuhan pendidikan di Indonesia, 
            mengintegrasikan berbagai modul penting dalam satu platform yang mudah digunakan — 
            mulai dari pelaksanaan ujian/ulangan, e-learning, hingga manajemen rapor sekolah/madrasah.
        </p>
        <div class="d-flex flex-wrap gap-2 my-3">
            <a href="https://github.com/HidayaturRohman/NextGenEdu-CBT" target="_blank" class="btn btn-primary font-weight-bold mr-2 mb-2" style="padding: 10px 22px; font-size: 14px; letter-spacing: 0.5px;">
                <i class="fab fa-github"></i> GITHUB / DOWNLOAD
            </a>
            <a href="https://t.me/+UbHStB31PjM2YzZl" target="_blank" class="btn btn-info font-weight-bold mb-2" style="background:#229ED9; border-color:#229ED9; color:#fff; padding: 10px 22px; font-size: 14px; letter-spacing: 0.5px;">
                <i class="fab fa-telegram-plane"></i> GABUNG TELEGRAM
            </a>
        </div>
        <div class="info-box info" style="margin-top:16px;">
            <i class="fas fa-info-circle"></i>
            <div>Dikembangkan dengan <strong>CodeIgniter 4</strong>, kompatibel dengan PHP 8.1 hingga PHP 8.4.</div>
        </div>
    </div>

    <div class="content-card">
        <h2><i class="fas fa-th-large"></i> Modul Utama</h2>
        <div class="table-responsive">
            <table class="table-custom">
                <thead><tr><th style="width:28%;">Modul</th><th style="width:72%;">Deskripsi</th></tr></thead>
                <tbody>
                    <tr><td><i class="fas fa-laptop text-primary"></i> <strong>CBT (Ujian Online)</strong></td><td>Sistem ujian berbasis komputer dengan bank soal, jadwal, sesi, ruang, nomor peserta, token dinamis, pengawas, monitoring real-time, rekap dan analisis hasil</td></tr>
                    <tr><td><i class="fas fa-book-open text-info"></i> <strong>E-Learning</strong></td><td>Manajemen pembelajaran online: jadwal pelajaran, distribusi materi, tugas, dan absensi siswa per mata pelajaran</td></tr>
                    <tr><td><i class="fas fa-award text-warning"></i> <strong>Rapor</strong></td><td>Pengolahan nilai rapor lengkap dengan KKM, predikat, catatan, dan cetak rapor otomatis (Kurikulum Merdeka & K13)</td></tr>
                    <tr><td><i class="fas fa-book text-success"></i> <strong>Buku Induk</strong></td><td>Pencatatan data induk siswa secara lengkap dan terstruktur</td></tr>
                    <tr><td><i class="fas fa-users text-primary"></i> <strong>Data Umum & Master</strong></td><td>Kelola data siswa, guru, kelas, mata pelajaran, jurusan, ekstrakurikuler, dan tahun ajaran</td></tr>
                    <tr><td><i class="fas fa-user-graduate text-danger"></i> <strong>Alumni & Kelulusan</strong></td><td>Manajemen data kelulusan massal 1-klik dan penelusuran alumni (Tracer Study)</td></tr>
                    <tr><td><i class="fas fa-chalkboard-teacher text-success"></i> <strong>Wali Kelas</strong></td><td>Fitur khusus wali kelas: daftar siswa, catatan wali kelas, dan struktur organisasi kelas</td></tr>
                    <tr><td><i class="fas fa-sticky-note text-warning"></i> <strong>Catatan Guru</strong></td><td>Pencatatan selama pembelajaran per kelas dan mata pelajaran</td></tr>
                    <tr><td><i class="fas fa-bullhorn text-info"></i> <strong>Pengumuman</strong></td><td>Kelola dan distribusikan pengumuman kepada siswa dan guru</td></tr>
                    <tr><td><i class="fas fa-cog text-secondary"></i> <strong>Pengaturan</strong></td><td>Profil sekolah, manajemen user (admin/guru/siswa), backup & restore database</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="content-card">
        <h2><i class="fas fa-laptop"></i> Computer Based Test (CBT)</h2>
        <p>Modul ujian online yang lengkap untuk mendukung pelaksanaan ujian/ulangan di sekolah/madrasah.</p>
        <ul>
            <li><strong>Bank Soal</strong> — kelola soal per mata pelajaran dengan berbagai format soal (Pilihan Ganda, PG Kompleks, Menjodohkan, Isian Singkat, Uraian)</li>
            <li><strong>Jadwal Ujian</strong> — penjadwalan ujian yang fleksibel per kelas dan mata pelajaran</li>
            <li><strong>Sesi &amp; Ruang Ujian</strong> — alokasi ruang dan sesi ujian yang teratur</li>
            <li><strong>Nomor Peserta &amp; Kartu</strong> — generate nomor peserta dan cetak kartu ujian otomatis dengan barcode/QR code</li>
            <li><strong>Token Dinamis</strong> — sistem token dinamis 15 menit untuk proteksi akses ujian</li>
            <li><strong>Pengawas</strong> — penugasan dan monitoring kehadiran pengawas per ruang ujian</li>
            <li><strong>Monitoring Real-time</strong> — pantau status ujian, sisa waktu, dan rekam jawaban siswa secara langsung</li>
            <li><strong>Rekap Nilai</strong> — kalkulasi nilai otomatis dan rekapitulasi hasil penilaian seluruh peserta</li>
            <li><strong>Analisis Soal</strong> — analisis statistik butir soal untuk evaluasi kualitas ujian</li>
            <li><strong>Cetak Hasil</strong> — cetak daftar hadir, berita acara pelaksanaan, dan rekap nilai resmi</li>
            <li><strong>Offline Mode</strong> — dapat berjalan tanpa koneksi internet setelah loading awal</li>
        </ul>
    </div>

    <div class="content-card">
        <h2><i class="fas fa-book-open"></i> E-Learning</h2>
        <p>Manajemen pembelajaran online yang terintegrasi untuk guru dan siswa.</p>
        <ul>
            <li>Pengelolaan jadwal pelajaran per kelas dan kalender KBM</li>
            <li>Distribusi materi pembelajaran (teks, dokumen, video, link referensi)</li>
            <li>Pengelolaan dan pengumpulan tugas dengan batasan waktu pengumpulan</li>
            <li>Sistem absensi siswa harian dan rekap leger bulanan (1-31)</li>
            <li>Akses materi dan tugas oleh siswa melalui portal KBM responsif</li>
        </ul>
    </div>

    <div class="content-card">
        <h2><i class="fas fa-award"></i> Rapor & Buku Induk</h2>
        <p>Pengolahan nilai dan data siswa yang terstruktur untuk memudahkan penyusunan rapor.</p>
        <ul>
            <li>Pengolahan nilai rapor dengan KKM dan predikat otomatis (Kurikulum Merdeka & K13)</li>
            <li>Input nilai via import file Excel atau input manual langsung</li>
            <li>Catatan deskripsi capaian kompetensi per mata pelajaran</li>
            <li>Cetak rapor massal satu kelas otomatis (format dinas resmi)</li>
            <li>Dual nomenklatur otomatis: <strong>Kepala Madrasah</strong> (Kemenag) vs <strong>Kepala Sekolah</strong> (Kemendikbud)</li>
            <li>Buku induk siswa yang lengkap dan terstruktur</li>
        </ul>
    </div>

    <div class="content-card">
        <h2><i class="fas fa-database"></i> Data Umum & Master</h2>
        <p>Kelola seluruh data master sekolah dari satu tempat.</p>
        <ul>
            <li><strong>Data Siswa</strong> — biodata, foto, NISN, status, dan riwayat kelas</li>
            <li><strong>Data Guru</strong> — biodata, NIP/NUPTK, mata pelajaran ampu, dan tugas tambahan</li>
            <li><strong>Data Kelas</strong> — manajemen kelas per tahun ajaran dan semester</li>
            <li><strong>Data Mata Pelajaran</strong> — kelola mapel reguler dan gabungan</li>
            <li><strong>Data Jurusan</strong> — manajemen jurusan/program keahlian</li>
            <li><strong>Ekstrakurikuler</strong> — kelola jenis dan peserta ekstrakurikuler</li>
            <li><strong>Tahun Ajaran</strong> — pengaturan tahun ajaran dan semester aktif</li>
            <li><strong>Alumni &amp; Kelulusan</strong> — data kelulusan massal 1-klik dan penelusuran alumni</li>
        </ul>
    </div>

    <div class="content-card">
        <h2><i class="fas fa-chalkboard-teacher"></i> Fitur Wali Kelas & Guru</h2>
        <ul>
            <li><strong>Portal Wali Kelas</strong> — daftar siswa, catatan wali kelas, dan struktur organisasi kelas</li>
            <li><strong>Catatan Guru</strong> — pencatatan kejadian/catatan selama pembelajaran per kelas dan mapel</li>
            <li><strong>Pengumuman</strong> — buat dan kelola pengumuman untuk siswa dan guru</li>
        </ul>
    </div>

    <div class="content-card">
        <h2><i class="fas fa-users-cog"></i> Manajemen Akun & Pengaturan</h2>
        <ul>
            <li><strong>Multi-Role Access</strong> — hak akses terpisah untuk admin, guru, dan siswa</li>
            <li><strong>Manajemen Admin</strong> — tambah, edit, dan kelola akun administrator</li>
            <li><strong>Manajemen Akun Guru</strong> — buat dan kelola akun login guru</li>
            <li><strong>Manajemen Akun Siswa</strong> — buat dan kelola akun login siswa</li>
            <li><strong>Profil Sekolah</strong> — atur identitas, logo, kop dinas, dan kepala sekolah</li>
            <li><strong>Backup &amp; Restore</strong> — backup database otomatis dan restore saat diperlukan</li>
            <li><strong>Log Aktivitas</strong> — rekam jejak aktivitas seluruh pengguna di sistem</li>
        </ul>
    </div>

    <div class="content-card">
        <h2><i class="fas fa-star"></i> Keunggulan Teknis</h2>
        <div class="table-responsive">
            <table class="table-custom">
                <thead><tr><th style="width:28%;">Fitur</th><th style="width:72%;">Deskripsi</th></tr></thead>
                <tbody>
                    <tr><td><strong>Framework Modern</strong></td><td>CodeIgniter 4 Engine dengan performa tinggi dan arsitektur aman</td></tr>
                    <tr><td><strong>Dukungan PHP 8.x</strong></td><td>Mendukung PHP 8.1 hingga PHP 8.4 dengan optimasi eksekusi cepat</td></tr>
                    <tr><td><strong>Responsive Design</strong></td><td>Tampilan optimal di desktop, tablet, dan smartphone</td></tr>
                    <tr><td><strong>Import/Export</strong></td><td>Import data siswa/guru/soal dari Excel & Word, export ke Excel, PDF, atau cetak langsung</td></tr>
                    <tr><td><strong>Offline Mode CBT</strong></td><td>Modul CBT dapat berjalan lancar tanpa koneksi internet setelah loading soal awal</td></tr>
                    <tr><td><strong>Analisis Butir Soal</strong></td><td>Analisis statistik butir soal untuk evaluasi daya pembeda dan tingkat kesukaran</td></tr>
                    <tr><td><strong>Web Installer Visual</strong></td><td>Pemandu instalasi 4 langkah tanpa perlu impor database manual lewat phpMyAdmin</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="content-card">
        <h2><i class="fas fa-comments"></i> Komunitas & Bantuan</h2>
        <p>Bergabunglah dengan komunitas resmi pengguna dan pengembang untuk tanya-jawab, diskusi teknis, dan mendapatkan update terbaru:</p>
        <div class="d-flex flex-wrap gap-2 my-2">
            <a href="https://t.me/+UbHStB31PjM2YzZl" target="_blank" class="btn btn-info font-weight-bold mr-2 mb-2" style="background:#229ED9; border-color:#229ED9; color:#fff; padding:10px 20px; border-radius:8px;">
                <i class="fab fa-telegram-plane"></i> Gabung Grup Telegram
            </a>
            <a href="https://github.com/HidayaturRohman/NextGenEdu-CBT" target="_blank" class="btn btn-primary font-weight-bold mr-2 mb-2" style="padding:10px 20px; border-radius:8px;">
                <i class="fab fa-github"></i> Repository GitHub
            </a>
            <a href="https://github.com/HidayaturRohman/NextGenEdu-CBT/issues" target="_blank" class="btn btn-secondary font-weight-bold mb-2" style="padding:10px 20px; border-radius:8px;">
                <i class="fas fa-bug"></i> Laporkan Masalah (Issues)
            </a>
        </div>
    </div>

    <div class="content-card">
        <h2><i class="fas fa-images"></i> Galeri Antarmuka Aplikasi</h2>
        <p>Berikut adalah beberapa tangkapan layar antarmuka aplikasi. <em>Klik gambar untuk memperbesar (zoom).</em></p>
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
