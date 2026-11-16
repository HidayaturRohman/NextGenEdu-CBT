if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['db-clear-cleanup'] = {
    title: 'Data Manager & Cleanup DB',
    desc: 'Panduan pemeliharaan, pembersihan log transaksi, dan optimasi ruang penyimpanan database melalui menu Data Manager di NextGen Garuda CBT Versi 1.5.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-broom text-primary"></i> Data Manager &amp; Pembersihan Database</h2>
        <p>Seiring berjalannya kegiatan ujian CBT dan aktivitas pembelajaran e-learning harian, database dapat menampung ratusan ribu baris data transaksi sementara seperti log login, log aktivitas klik siswa, riwayat token usang, dan session kedaluwarsa. Menu <strong>Data Manager</strong> (<code class="inline">/dbclear</code>) dirancang untuk memelihara performa server database agar tetap ringan, cepat, dan responsif.</p>

        <div class="alert-box alert-warning mb-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-shield-alt fa-2x me-3"></i>
                <div>
                    <strong>Proteksi Mutlak Data Utama (Anti Kehilangan Data):</strong>
                    <div>Sistem dilengkapi proteksi berlapis (Strict Protected Tables). Tabel-tabel master seperti data guru, data siswa, akun login admin/guru/siswa, setting sekolah, tahun pelajaran, semester aktif, dan konfigurasi rapor tidak akan pernah terhapus secara tidak sengaja.</div>
                </div>
            </div>
        </div>

        <div class="screenshot-placeholder">
            <i class="fas fa-database"></i>
            <p>Antarmuka Data Manager &amp; Pembersihan Tabel Database (/dbclear)</p>
        </div>

        <h3><i class="fas fa-layer-group text-info"></i> 3 Kategori Pengelompokan Tabel</h3>
        <table class="table-custom">
            <thead>
                <tr>
                    <th style="width: 25%;">Kategori</th>
                    <th style="width: 35%;">Contoh Tabel</th>
                    <th>Kebijakan Keamanan &amp; Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="badge bg-success">Tabel Master (Dilindungi)</span></td>
                    <td><code class="inline">users</code>, <code class="inline">setting</code>, <code class="inline">master_tp</code>, <code class="inline">master_smt</code>, <code class="inline">master_kelas</code>, <code class="inline">buku_induk</code></td>
                    <td><strong>Terkunci Mutlak.</strong> Tombol hapus/kosongkan dinonaktifkan secara permanen untuk mencegah kerusakan sistem.</td>
                </tr>
                <tr>
                    <td><span class="badge bg-warning text-dark">Tabel Transaksional</span></td>
                    <td><code class="inline">log</code>, <code class="inline">cbt_token</code>, <code class="inline">cbt_siswa</code>, <code class="inline">ci_sessions</code>, <code class="inline">cbt_soal_siswa</code></td>
                    <td><strong>Dapat Dikosongkan Selektif.</strong> Admin dapat mengosongkan log ujian yang sudah selesai lewat tombol <em>Kosongkan Tabel (Truncate)</em>.</td>
                </tr>
                <tr>
                    <td><span class="badge bg-danger">Tabel Usang (Legacy CI3)</span></td>
                    <td><code class="inline">cbt_durasi_siswa</code>, <code class="inline">cbt_rekap_nilai</code>, <code class="inline">kelas_jadwal_tugas</code>, <code class="inline">users_profile</code></td>
                    <td><strong>Kandidat Drop.</strong> Tabel peninggalan versi CI3 lawas yang sudah digantikan oleh skema baru NextGen CI4. Dapat dihapus total untuk menghemat storage.</td>
                </tr>
            </tbody>
        </table>

        <h3><i class="fas fa-cogs text-warning"></i> Prosedur Pembersihan Berkala yang Dianjurkan</h3>
        <ol class="step-list">
            <li><strong>Lakukan Backup Terlebih Dahulu:</strong>
                <p>Sebelum menjalankan pembersihan data, selalu buat cadangan database penuh melalui menu <code class="inline">Database</code> &gt; <code class="inline">Backup</code> (<code class="inline">/dbmanager</code>) dan unduh berkas <code class="inline">.sql</code> ke komputer lokal.</p>
            </li>
            <li><strong>Buka Menu Data Manager:</strong>
                <p>Masuk sebagai Administrator &gt; pilih menu <code class="inline">Pengaturan</code> &gt; <code class="inline">Database</code> &gt; klik <code class="inline">Data Manager</code> (<code class="inline">/dbclear</code>).</p>
            </li>
            <li><strong>Pantau Jumlah Baris (Record Count):</strong>
                <p>Periksa tabel-tabel dengan jumlah baris terbesar, terutama tabel log dan session.</p>
            </li>
            <li><strong>Kosongkan Log &amp; Data Kedaluwarsa:</strong>
                <p>Klik tombol merah <code class="inline">Kosongkan</code> pada baris tabel transaksi yang ingin dibersihkan. Konfirmasi tindakan pada dialog modal yang muncul.</p>
            </li>
            <li><strong>Bersihkan Tabel Usang (Jika Ada):</strong>
                <p>Jika server merupakan hasil migrasi dari versi lama, periksa bagian <em>Tabel Usang (Legacy)</em>. Klik <strong>Hapus Tabel Usang</strong> untuk membebaskan ruang penyimpanan.</p>
            </li>
        </ol>
    </div>
    `
};
