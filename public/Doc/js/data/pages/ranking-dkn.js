if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['ranking-dkn'] = {
    title: 'Ranking Nilai & DKN Kelulusan',
    desc: 'Panduan pencetakan peringkat belajar kelas/paralel dan penerbitan Daftar Kumpulan Nilai (DKN) resmi kelulusan di NextGen Garuda CBT Versi 1.5.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-trophy text-warning"></i> Ranking Nilai &amp; DKN Kelulusan</h2>
        <p>Halaman <strong>Ranking Nilai</strong> (<code class="inline">/rapor/cetakranking</code>) dan <strong>Daftar Kumpulan Nilai / DKN</strong> (<code class="inline">/rapor/dkn</code>) merupakan dokumen rekapitulasi puncak yang merangkum seluruh prestasi akademik peserta didik di kelas dan tingkat angkatan paralel.</p>

        <div class="alert-box alert-success mb-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-medal fa-2x me-3"></i>
                <div>
                    <strong>Kalkulasi Ranking Cerdas &amp; Presisi:</strong>
                    <div>Sistem secara otomatis menghitung Total Nilai Seluruh Mata Pelajaran dan Nilai Rata-rata (Mean) setiap siswa, lalu mengurutkannya secara presisi mulai dari Peringkat 1 hingga terakhir tanpa perlu rumus Excel manual.</div>
                </div>
            </div>
        </div>

        <div class="screenshot-placeholder">
            <i class="fas fa-table"></i>
            <p>Lembar Cetak Ranking &amp; DKN Kelulusan Siswa (/rapor/cetakranking &amp; /rapor/dkn)</p>
        </div>

        <h3><i class="fas fa-star text-primary"></i> 1. Fitur Ranking Nilai Kelas</h3>
        <p>Dapat diakses oleh Wali Kelas melalui menu <code class="inline">Cetak Rapor</code> &gt; <code class="inline">Ranking Nilai</code>. Menyediakan fitur unggulan:</p>
        <ul class="step-list">
            <li><strong>Tampilan Tabel Peringkat Lengkap:</strong> Menampilkan Nomor Urut, NIS/NISN, Nama Siswa, Nilai per Kelompok Mapel, Total Nilai, Rata-rata, serta Peringkat (Rank) di kelas.</li>
            <li><strong>Identifikasi Juara Kelas (Top 3 / Top 10):</strong> Menyorot peserta didik berprestasi terbaik dengan badge piala emas, perak, dan perunggu.</li>
            <li><strong>Siap Cetak Satu Lembar:</strong> Format cetak telah disesuaikan dengan kertas F4/A4 lengkap dengan kop surat lembaga, titimangsa, tanda tangan Wali Kelas, dan Kepala Madrasah/Kepala Sekolah.</li>
        </ul>

        <h3><i class="fas fa-file-alt text-info"></i> 2. Daftar Kumpulan Nilai (DKN) Kelulusan</h3>
        <p>DKN (<code class="inline">/rapor/dkn</code>) adalah dokumen resmi yang wajib disiapkan bagi siswa tingkat akhir (Kelas 9 MTs/SMP atau Kelas 12 MA/SMA/SMK) sebagai rujukan penerbitan Ijazah dan Surat Keterangan Lulus (SKL):</p>
        <table class="table-custom">
            <thead>
                <tr>
                    <th style="width: 25%;">Komponen DKN</th>
                    <th>Keterangan Teknis Dokumen</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Identitas Peserta</strong></td>
                    <td>Nama Lengkap Siswa sesuai Akta Kelahiran, NISN resmi Dapodik/EMIS, Nomor Induk (NIS), dan Tempat Tanggal Lahir.</td>
                </tr>
                <tr>
                    <td><strong>Komposisi Nilai Ujian</strong></td>
                    <td>Rata-rata Nilai Rapor Semester 1 s.d. 5/6, Nilai Ujian Madrasah / Asesmen Akhir (AM / ASBK), serta Nilai Gabungan Kelulusan.</td>
                </tr>
                <tr>
                    <td><strong>Pengesahan Resmi</strong></td>
                    <td>Dilengkapi lembar pengesahan Pengawas Pembina Kementerian Agama / Cabang Dinas Pendidikan, Kepala Satuan Pendidikan, dan Stempel Resmi Lembaga.</td>
                </tr>
                <tr>
                    <td><strong>Ekspor Excel &amp; PDF</strong></td>
                    <td>Dapat dicetak langsung ke PDF beresolusi tinggi atau diunduh dalam format lembar kerja Excel (<code class="inline">.xlsx</code>) untuk integrasi arsip dinas.</td>
                </tr>
            </tbody>
        </table>

        <h3><i class="fas fa-print text-warning"></i> Langkah Mencetak Ranking &amp; DKN</h3>
        <ol class="step-list">
            <li>Buka menu <code class="inline">Cetak Rapor</code> &gt; klik <code class="inline">Ranking Nilai</code>.</li>
            <li>Pilih Rombel Kelas yang ingin dicetak (otomatis terisi rombel binaan bagi Wali Kelas).</li>
            <li>Periksa urutan peringkat dan kesesuaian nilai rata-rata siswa.</li>
            <li>Klik tombol biru <code class="inline"><i class="fas fa-print"></i> Cetak Dokumen</code> untuk mencetak langsung ke printer atau tombol hijau <code class="inline"><i class="fas fa-file-excel"></i> Download Excel</code> untuk mengunduh berkas rekap.</li>
        </ol>
    </div>
    `
};
