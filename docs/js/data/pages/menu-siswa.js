if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['menu-siswa'] = {
    title: '9 Menu Utama Siswa',
    desc: 'Penjelasan lengkap 9 ubin menu interaktif di beranda siswa, fungsi pembelajaran digital, asesmen CBT, dan akses sumber belajar mandiri di NextGen Garuda CBT Versi 1.5.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-th-large text-primary"></i> 9 Menu Utama Dasbor Siswa</h2>
        <p>Pada beranda (dashboard) peserta didik di <strong>NextGen Garuda CBT Versi 1.5</strong>, siswa disajikan 9 ubin menu modular berikon modern resolusi tinggi yang mencakup seluruh aktivitas belajar daring, pengerjaan tugas, jadwal, presensi, hingga pelaksanaan ujian.</p>

        <div class="screenshot-placeholder">
            <i class="fas fa-th"></i>
            <p>Grid 9 Menu Utama Beranda Siswa (Jadwal, Materi, Tugas, Ujian, Nilai, Presensi, Catatan, Arsip, E-Perpus)</p>
        </div>

        <h3><i class="fas fa-list text-info"></i> Rincian 9 Menu Utama Siswa</h3>
        <table class="table-custom">
            <thead>
                <tr>
                    <th style="width: 20%;">Menu Ubin</th>
                    <th style="width: 25%;">Route / URL</th>
                    <th>Fungsi &amp; Fitur Bagi Siswa</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong><i class="fas fa-calendar-alt text-primary me-2"></i> Jadwal Pelajaran</strong></td>
                    <td><code class="inline">kbm/jadwal_pelajaran</code></td>
                    <td>Menampilkan jadwal tatap muka mingguan lengkap dengan jam pelajaran, nama mata pelajaran, ruang kelas, dan nama guru pengampu.</td>
                </tr>
                <tr>
                    <td><strong><i class="fas fa-pencil-ruler text-success me-2"></i> Materi</strong></td>
                    <td><code class="inline">kbm/materi</code></td>
                    <td>Membuka materi ajar aktif yang dibagikan guru, modul PDF baca langsung di browser, video pembelajaran YouTube/Google Drive, dan instruksi ringkas.</td>
                </tr>
                <tr>
                    <td><strong><i class="fas fa-drafting-compass text-warning me-2"></i> Tugas</strong></td>
                    <td><code class="inline">kbm/tugas</code></td>
                    <td>Menampilkan daftar tugas mandiri atau kelompok, tenggat waktu pengumpulan (deadline), lembar kerja siswa, dan fitur unggah berkas jawaban tugas.</td>
                </tr>
                <tr>
                    <td><strong><i class="fas fa-laptop-code text-danger me-2"></i> Ujian / Ulangan</strong></td>
                    <td><code class="inline">cbtsiswa/cbt</code></td>
                    <td>Ruang tes CBT untuk mengikuti ulangan harian, PTS/STS, PAS/SAS, hingga asesmen madrasah/sekolah lengkap dengan timer mundur dan verifikasi token.</td>
                </tr>
                <tr>
                    <td><strong><i class="fas fa-chart-line text-info me-2"></i> Nilai Hasil</strong></td>
                    <td><code class="inline">kbm/hasil</code></td>
                    <td>Melihat riwayat perolehan nilai hasil ujian CBT yang telah diumumkan guru dan nilai tugas yang telah dinilai.</td>
                </tr>
                <tr>
                    <td><strong><i class="fas fa-clipboard-check text-success me-2"></i> Presensi Siswa</strong></td>
                    <td><code class="inline">kbm/kehadiran</code></td>
                    <td>Melihat rekapitulasi riwayat absensi harian dan jam tatap muka kelas yang telah terekam di sistem.</td>
                </tr>
                <tr>
                    <td><strong><i class="fas fa-comment-dots text-primary me-2"></i> Catatan Guru</strong></td>
                    <td><code class="inline">siswa/catatan</code></td>
                    <td>Melihat pesan bimbingan personal, evaluasi sikap, dan saran perbaikan belajar yang diberikan langsung oleh Guru atau Wali Kelas.</td>
                </tr>
                <tr>
                    <td><strong><i class="fas fa-archive text-secondary me-2"></i> Arsip</strong></td>
                    <td><code class="inline">kbm/arsip</code></td>
                    <td>Mengakses kembali seluruh arsip materi dan tugas dari semester-semester terdahulu untuk keperluan belajar persiapan ujian akhir/kelulusan.</td>
                </tr>
                <tr>
                    <td><strong><i class="fas fa-book-reader text-purple me-2"></i> E-Perpus</strong></td>
                    <td><code class="inline">siswa/perpus</code></td>
                    <td>Perpustakaan digital sekolah/madrasah untuk membaca e-book buku paket kurikulum merdeka, modul pelajaran, dan literatur bacaan lainnya secara online.</td>
                </tr>
            </tbody>
        </table>

        <div class="alert-box alert-success mt-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-mobile-alt fa-2x me-3"></i>
                <div>
                    <strong>Navigasi Mobile Tambahan:</strong>
                    <div>Pada perangkat smartphone, selain 9 menu di atas, siswa juga didukung oleh bilah <strong>Navigasi Bawah Modern</strong> dengan tombol floating scan QR absensi kamera. Pelajari selengkapnya di panduan <em>Navigasi Bawah &amp; Scan QR Siswa</em>.</div>
                </div>
            </div>
        </div>
    </div>
    `
};
