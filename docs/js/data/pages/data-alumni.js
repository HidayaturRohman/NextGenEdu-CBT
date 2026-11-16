if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['data-alumni'] = {
    title: 'Data Alumni & Kelulusan Massal',
    desc: 'Panduan lengkap manajemen siswa purna studi, fitur kelulusan massal 1-klik per rombel akhir, pencarian cepat, dan ekspor data alumni.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-user-graduate"></i> Modul Data Alumni & Kelulusan Massal</h2>
        <p>
            Modul <strong>Data Alumni</strong> (<code class="inline">/alumni</code>) di NextGen Garuda CBT Versi 1.5 
            didedikasikan untuk mencatat, mengarsipkan, dan mengelola seluruh data siswa yang telah menyelesaikan masa studinya 
            (lulusan) dari jenjang SD/MI, SMP/MTs, maupun SMA/MA/SMK.
        </p>
        <p>
            Berbeda dengan sistem CBT lama yang mengharuskan admin mengubah status siswa satu per satu, NextGen Garuda CBT 
            menghadirkan terobosan <strong>Fitur Kelulusan Massal (Bulk Graduation)</strong> yang memungkinkan pelepasan seluruh siswa 
            tingkat akhir dalam satu rombongan belajar hanya dengan <strong>1 Kali Klik</strong>, tanpa menghilangkan riwayat rapor dan nilai ujian mereka.
        </p>

        <div class="info-box tip">
            <i class="fas fa-database"></i>
            <div>
                <strong>Keamanan Data Riwayat:</strong> Memproses siswa menjadi Alumni <em>TIDAK AKAN</em> menghapus nilai rapor, arsip leger, maupun riwayat ujian CBT siswa tersebut. Seluruh data akademik tetap tersimpan abadi untuk kebutuhan pencetakan ulang ijazah, SKHUN, atau transkrip nilai di masa depan.
            </div>
        </div>

        <hr>
        <h3><i class="fas fa-graduation-cap text-success"></i> Fitur Kelulusan Massal (Bulk Graduation 1-Klik)</h3>
        <p>
            Prosedur kelulusan angkatan akhir tahun pelajaran dapat diselesaikan dalam hitungan detik:
        </p>

        <ol class="step-list">
            <li>
                <strong>Buka Menu Alumni:</strong>
                <p>Login sebagai Administrator, klik menu <code class="inline">Rapor</code> atau menu utama <code class="inline">Alumni</code> pada sidebar navigasi.</p>
            </li>
            <li>
                <strong>Pilih Tab "Kelulusan Massal":</strong>
                <p>Klik tombol atau tab <code class="inline"><i class="fas fa-user-check"></i> Proses Kelulusan Massal</code>.</p>
            </li>
            <li>
                <strong>Tentukan Rombongan Belajar (Rombel):</strong>
                <p>Pilih kelas tingkat akhir yang akan diluluskan (contoh: <code>Kelas IX-A</code> untuk MTs/SMP, atau <code>Kelas XII-MIPA</code> untuk MA/SMA).</p>
            </li>
            <li>
                <strong>Isi Parameter Kelulusan:</strong>
                <ul class="step-list">
                    <li><strong>Tahun Kelulusan:</strong> Pilih atau ketik tahun lulus (misal: <code>2026/2027</code>).</li>
                    <li><strong>Tanggal SK Kelulusan:</strong> Tanggal resmi pengumuman kelulusan.</li>
                    <li><strong>Nomor Surat Keputusan (SK):</strong> Nomor SK Kelulusan dari Kepala Madrasah / Kepala Sekolah.</li>
                    <li><strong>Status Default:</strong> Pilih <code>LULUS</code>.</li>
                </ul>
            </li>
            <li>
                <strong>Eksekusi Proses Kelulusan:</strong>
                <p>Tekan tombol <code class="inline btn-success"><i class="fas fa-check"></i> Eksekusi Kelulusan Massal</code>. Sistem akan menampilkan dialog konfirmasi keamanan.</p>
            </li>
            <li>
                <strong>Selesai Seketika:</strong>
                <p>Seluruh siswa di rombel tersebut otomatis berubah statusnya menjadi <strong>ALUMNI</strong>, keluar dari daftar siswa aktif rombel, dan masuk ke basis data direktori alumni sekolah/madrasah!</p>
            </li>
        </ol>

        <hr>
        <h3><i class="fas fa-search text-primary"></i> Pencarian Cepat Alumni (Tracer Search)</h3>
        <p>
            NextGen Garuda CBT menyediakan antarmuka pencarian instan berkecepatan tinggi dengan berbagai kriteria penyaringan:
        </p>
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th style="width: 25%;">Parameter Filter</th>
                        <th style="width: 75%;">Deskripsi Kegunaan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Kata Kunci Bebas</strong></td>
                        <td>Pencarian instan berdasarkan Nama Lengkap Siswa, Nomor Induk Siswa (NIS), atau NISN.</td>
                    </tr>
                    <tr>
                        <td><strong>Tahun Kelulusan</strong></td>
                        <td>Menyaring daftar alumni per angkatan kelulusan (misal: Angkatan 2024, 2025, 2026, dst).</td>
                    </tr>
                    <tr>
                        <td><strong>Rombel Terakhir</strong></td>
                        <td>Menampilkan alumni berdasarkan kelas/jurusan terakhir mereka saat menempuh pendidikan.</td>
                    </tr>
                    <tr>
                        <td><strong>Status Studi Lanjutan</strong></td>
                        <td>Menelusuri alumni yang melanjutkan ke Perguruan Tinggi, Madrasah Aliyah/SMA lanjutan, Pondok Pesantren, atau Dunia Kerja.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <hr>
        <h3><i class="fas fa-exchange-alt text-warning"></i> Manajemen Mutasi & Status Siswa</h3>
        <p>
            Selain siswa lulus normal, modul ini juga dapat mengelola siswa purna lainnya:
        </p>
        <ul class="step-list">
            <li><strong>Lulus:</strong> Siswa yang menyelesaikan pendidikan dan lulus ujian akhir.</li>
            <li><strong>Mutasi Keluar:</strong> Siswa yang pindah ke sekolah/madrasah lain di tengah tahun ajaran.</li>
            <li><strong>Mengundurkan Diri:</strong> Siswa yang berhenti atas permohonan orang tua.</li>
            <li><strong>Alumni Kehormatan / Khusus:</strong> Kategori purna studi lainnya.</li>
        </ul>

        <hr>
        <h3><i class="fas fa-file-excel text-success"></i> Ekspor Data Alumni (Tracer Study & Akreditasi)</h3>
        <p>
            Data direktori alumni dapat diekspor sewaktu-waktu ke dalam format Excel (<code class="inline">.xlsx</code>) atau CSV untuk keperluan:
        </p>
        <ul>
            <li>Dokumentasi instrumen akreditasi sekolah/madrasah (Standar Pengelolaan & Standar Kelulusan).</li>
            <li>Pelacakan alumni (Tracer Study) dan ikatan alumni (IKA).</li>
            <li>Sinkronisasi data lulusan ke database EMIS Kemenag / DAPODIK Kemendikbud.</li>
        </ul>
        <p>Klik tombol <code class="inline"><i class="fas fa-download"></i> Ekspor Data Alumni</code> pada pojok kanan atas tabel alumni untuk mulai mengunduh.</p>
    </div>`
};
