if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['wali-struktur'] = {
    title: 'Portal Wali Kelas: Struktur Organisasi Kelas',
    desc: 'Panduan menyusun bagan kepengurusan kelas digital (Ketua Kelas, Wakil, Sekretaris, Bendahara, dan Seksi).',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-sitemap"></i> Struktur Organisasi Kelas Digital</h2>
        <p>
            Menu <strong>Struktur</strong> pada kelompok Wali Kelas (<code class="inline">/walistruktur</code>) 
            berfungsi menetapkan susunan kepengurusan kelas yang sah untuk tahun pelajaran berjalan. 
            Fitur ini secara otomatis menyusun bagan organisasi kelas yang rapi, transparan, dan dapat 
            diakses oleh seluruh siswa serta guru.
        </p>

        <div class="info-box tip">
            <i class="fas fa-id-badge"></i>
            <div>
                <strong>Membangun Kepemimpinan Siswa:</strong> Pengurus kelas yang ditugaskan akan memiliki tanda kehormatan khusus pada daftar presensi dan profil kelas.
            </div>
        </div>

        <hr>
        <h3><i class="fas fa-user-friends text-primary"></i> Jabatan Pengurus Kelas yang Disediakan</h3>
        <table class="table-custom">
            <thead>
                <tr>
                    <th style="width: 30%;">Posisi Jabatan</th>
                    <th style="width: 70%;">Tugas Utama</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Ketua Kelas</strong></td>
                    <td>Memimpin koordinasi kelas, menjembatani komunikasi siswa dengan guru dan wali kelas.</td>
                </tr>
                <tr>
                    <td><strong>Wakil Ketua Kelas</strong></td>
                    <td>Membantu ketua kelas dan menggantikan peran saat ketua berhalangan hadir.</td>
                </tr>
                <tr>
                    <td><strong>Sekretaris 1 & 2</strong></td>
                    <td>Mencatat agenda kelas, mengelola jadwal piket kebersihan, dan mencatat absensi harian manual.</td>
                </tr>
                <tr>
                    <td><strong>Bendahara 1 & 2</strong></td>
                    <td>Mengelola kas kelas untuk kebutuhan kegiatan siswa dan sosial.</td>
                </tr>
                <tr>
                    <td><strong>Seksi-Seksi Khusus</strong></td>
                    <td>Seksi Keagamaan/Ibadah, Seksi Kebersihan, Seksi Keamanan/Ketertiban, dan Seksi Olahraga & Kesenian.</td>
                </tr>
            </tbody>
        </table>

        <hr>
        <h3><i class="fas fa-pencil-alt text-success"></i> Cara Mengatur Struktur Kelas</h3>
        <ol class="step-list">
            <li>Buka menu <code class="inline">Wali Kelas > Struktur</code>.</li>
            <li>Pada masing-masing kotak jabatan (Ketua, Wakil, Sekretaris, dll.), pilih nama siswa dari dropdown yang berisi seluruh siswa di kelas tersebut.</li>
            <li>Jika ada jabatan yang tidak digunakan, kosongkan pilihan dropdown tersebut.</li>
            <li>Klik tombol <code class="inline btn-success"><i class="fas fa-save"></i> Simpan Struktur Kelas</code>.</li>
            <li>Bagan organisasi kelas digital akan otomatis terbentuk dan dapat dicetak sebagai kelengkapan administrasi kelas pada dinding ruang kelas.</li>
        </ol>
    </div>`
};
