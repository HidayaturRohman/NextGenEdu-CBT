if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['siswa-bottom-nav'] = {
    title: 'Navigasi Bawah & Scan QR Siswa',
    desc: 'Panduan navigasi mobile modern gaya Shopee/SeaBank untuk siswa, floating button scan QR absensi kamera, dan sinkronisasi badge notifikasi real-time.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-mobile-alt text-primary"></i> Navigasi Mobile Siswa &amp; Floating Scan QR</h2>
        <p>Pada <strong>NextGen Garuda CBT Versi 1.5</strong>, antarmuka siswa di smartphone telah dirombak secara menyeluruh dengan desain modern ala aplikasi finansial terkemuka (<strong>ShopeePay / SeaBank Style</strong>). Navigasi bawah selalu menempel di layar bawah (<em>sticky bottom bar</em>) untuk memudahkan akses menu utama dengan satu ibu jari.</p>

        <div class="alert-box alert-info mb-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-qrcode fa-2x me-3"></i>
                <div>
                    <strong>Tombol Tengah Melengkung "Polisi Tidur" (Floating Center Bump):</strong>
                    <div>Di bagian tengah bilah navigasi terdapat tombol bundar menonjol khusus dengan ikon QR Code bercahaya. Tombol ini membuka pemindai kamera (scanner) presensi kehadiran siswa secara instan tanpa perlu mencari menu absensi.</div>
                </div>
            </div>
        </div>

        <div class="screenshot-placeholder">
            <i class="fas fa-mobile"></i>
            <p>Bilah Navigasi Bawah Mobile Siswa dengan Floating Center Bump Scan QR</p>
        </div>

        <h3><i class="fas fa-th text-primary"></i> 5 Menu Bilah Navigasi Bawah</h3>
        <table class="table-custom">
            <thead>
                <tr>
                    <th style="width: 20%;">Menu Navigasi</th>
                    <th style="width: 25%;">Tipe Interaksi</th>
                    <th>Fungsi &amp; Fitur Khusus</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong><i class="fas fa-home text-primary me-1"></i> Home / Beranda</strong></td>
                    <td>Link Halaman</td>
                    <td>Menampilkan halaman dashboard utama siswa, carousel banner slider, 9 menu aplikasi, dan widget cuaca/profil.</td>
                </tr>
                <tr>
                    <td><strong><i class="fas fa-bullhorn text-success me-1"></i> Pengumuman</strong></td>
                    <td>Modal Pop-up Instan</td>
                    <td>Membuka jendela timeline pengumuman terbaru dari madrasah/guru tanpa memuat ulang (reload) halaman. Dilengkapi badge merah jika ada info baru.</td>
                </tr>
                <tr>
                    <td><strong><i class="fas fa-qrcode text-warning me-1"></i> Scan QR (Center)</strong></td>
                    <td>Floating Bump Scanner</td>
                    <td>Tombol utama di tengah dengan kurva lengkung floating. Mengaktifkan kamera HP belakang/depan untuk memindai QR Code presensi harian siswa.</td>
                </tr>
                <tr>
                    <td><strong><i class="fas fa-laptop-code text-info me-1"></i> Ujian CBT</strong></td>
                    <td>Link Halaman + Badge</td>
                    <td>Membuka ruang jadwal ujian CBT. Menampilkan <strong>Badge Merah Angka</strong> real-time yang menunjukkan berapa jumlah ujian aktif hari ini yang belum diselesaikan siswa.</td>
                </tr>
                <tr>
                    <td><strong><i class="fas fa-tasks text-danger me-1"></i> Tugas KBM</strong></td>
                    <td>Link Halaman + Badge</td>
                    <td>Membuka daftar tugas e-learning. Menampilkan <strong>Badge Merah Angka</strong> real-time yang menghitung berapa tugas aktif yang belum dikumpulkan siswa.</td>
                </tr>
            </tbody>
        </table>

        <h3><i class="fas fa-bell text-warning"></i> Sinkronisasi Badge Notifikasi Real-Time</h3>
        <p>Sistem NextGen CBT v1.5 dilengkapi skrip polling latar belakang yang secara berkala memeriksa status siswa ke server setiap 60 detik:</p>
        <ul class="step-list">
            <li><strong>Ujian Baru Terjadwal:</strong> Jika Guru atau Admin merilis jadwal ujian baru yang aktif hari ini, badge notifikasi di menu Ujian langsung muncul angka <code class="inline">1</code>, <code class="inline">2</code>, atau <code class="inline">9+</code>.</li>
            <li><strong>Tugas Baru Masuk:</strong> Begitu Guru mata pelajaran mempublikasikan tugas baru, siswa langsung melihat lingkaran merah notifikasi menyala di navigasi bawah.</li>
            <li><strong>Pengumuman Baru:</strong> Membantu siswa agar tidak ketinggalan informasi mendadak dari madrasah/sekolah.</li>
        </ul>

        <h3><i class="fas fa-shield-alt text-success"></i> Mode Ujian Imersif (Proteksi Anti-Curang)</h3>
        <p>Saat siswa memasuki ruang ujian aktif (mengerjakan soal dengan batas waktu timer), seluruh bilah navigasi bawah secara otomatis <strong>disembunyikan (hidden)</strong>. Hal ini bertujuan:</p>
        <ol class="step-list">
            <li>Mencegah siswa salah pencet keluar dari halaman ujian secara tidak sengaja.</li>
            <li>Memberikan ruang layar penuh (fullscreen view) untuk membaca stimulus soal, tabel, dan gambar ujian.</li>
            <li>Mengaktifkan penjagaan anti-curang pada browser atau aplikasi Exambro resmi v1.5.</li>
        </ol>
    </div>
    `
};
