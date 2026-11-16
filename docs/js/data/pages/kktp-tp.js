if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['kktp-tp'] = {
    title: 'Tujuan Pembelajaran (TP) & KKTP',
    desc: 'Panduan penyusunan Tujuan Pembelajaran (TP), Lingkup Materi, dan Kriteria Ketercapaian Tujuan Pembelajaran (KKTP) dalam Kurikulum Merdeka di NextGen Garuda CBT Versi 1.5.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-bullseye text-primary"></i> Tujuan Pembelajaran (TP) &amp; KKTP</h2>
        <p>Dalam paradigma <strong>Kurikulum Merdeka (IKM)</strong>, guru tidak lagi menggunakan Kompetensi Dasar (KD 3 dan KD 4) melainkan <strong>Tujuan Pembelajaran (TP)</strong> dan <strong>Kriteria Ketercapaian Tujuan Pembelajaran (KKTP)</strong>. Modul ini merupakan pondasi utama yang menentukan deskripsi capaian kompetensi otomatis pada rapor peserta didik.</p>

        <div class="alert-box alert-success mb-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-magic fa-2x me-3"></i>
                <div>
                    <strong>Generator Deskripsi Capaian Otomatis:</strong>
                    <div>Setiap butir TP dan Lingkup Materi yang Anda susun di sini akan dirangkum otomatis oleh sistem menjadi narasi capaian tertinggi (TP yang berhasil dikuasai dengan baik) dan capaian terendah (TP yang perlu bimbingan lanjut) pada lembar rapor siswa.</div>
                </div>
            </div>
        </div>

        <div class="screenshot-placeholder">
            <i class="fas fa-tasks"></i>
            <p>Pengelolaan Tujuan Pembelajaran &amp; KKTP Guru Mapel (/rapor/raporkikd &amp; /rapor/raporkkm)</p>
        </div>

        <h3><i class="fas fa-pen-fancy text-info"></i> 1. Pengelolaan Tujuan Pembelajaran (TP)</h3>
        <p>Menu ini dapat diakses melalui <code class="inline">Penilaian</code> &gt; <code class="inline">Data Acuan Rapor</code> &gt; <code class="inline">Tujuan Pembelajaran (TP)</code> atau URL <code class="inline">/rapor/raporkikd</code>.</p>
        <ol class="step-list">
            <li><strong>Pilih Mapel &amp; Kelas:</strong> Pilih mata pelajaran yang Anda ampu dan rombel kelas target.</li>
            <li><strong>Tambah TP Baru:</strong> Klik tombol <code class="inline">+ Tambah TP</code>.</li>
            <li><strong>Isi Parameter TP:</strong>
                <ul>
                    <li><strong>Kode TP:</strong> Contoh: <code class="inline">TP-1</code>, <code class="inline">TP-2</code>, <code class="inline">TP-3</code>.</li>
                    <li><strong>Lingkup Materi:</strong> Topik atau bab materi esensial (contoh: <em>Hukum Bacaan Mad Lazim</em>, <em>Persamaan Linear Satu Variabel</em>, <em>Sistem Pencernaan Manusia</em>).</li>
                    <li><strong>Deskripsi Tujuan Pembelajaran:</strong> Kalimat operasional kompetensi peserta didik dengan awalan kata kerja aktif ringkas (contoh: <em>Memahami dan mengidentifikasi ketentuan hukum bacaan mad lazim dalam ayat Al-Qur'an</em>). Hindari teks terlalu panjang agar muat di kolom rapor.</li>
                </ul>
            </li>
            <li><strong>Simpan TP:</strong> Klik <code class="inline">Simpan</code>. Daftar TP akan langsung aktif dan menjadi opsi saat menginput nilai Sumatif Harian / Lingkup Materi.</li>
        </ol>

        <h3><i class="fas fa-balance-scale text-warning"></i> 2. Penentuan Kriteria Ketercapaian Tujuan Pembelajaran (KKTP)</h3>
        <p>Menu ini dapat diakses melalui <code class="inline">Penilaian</code> &gt; <code class="inline">Data Acuan Rapor</code> &gt; <code class="inline">KKTP / Interval Nilai</code> atau URL <code class="inline">/rapor/raporkkm</code>.</p>
        <p>KKTP berfungsi sebagai batas nilai tuntas atau ambang penguasaan materi (pengganti istilah KKM). Sistem NextGen CBT Versi 1.5 menggunakan interval 4 kategori capaian:</p>
        <table class="table-custom">
            <thead>
                <tr>
                    <th style="width: 25%;">Rentang Interval Nilai</th>
                    <th style="width: 25%;">Kategori Capaian</th>
                    <th>Tindakan / Intervensi Guru</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="badge bg-danger">0 – 69</span></td>
                    <td><strong>Perlu Bimbingan</strong></td>
                    <td>Peserta didik belum mencapai ketuntasan minimum, wajib mengikuti program remedial terstruktur.</td>
                </tr>
                <tr>
                    <td><span class="badge bg-warning text-dark">70 – 79</span></td>
                    <td><strong>Cukup</strong></td>
                    <td>Peserta didik telah mencapai ketuntasan dasar namun masih memerlukan latihan pendalaman.</td>
                </tr>
                <tr>
                    <td><span class="badge bg-primary">80 – 89</span></td>
                    <td><strong>Baik</strong></td>
                    <td>Peserta didik telah menguasai seluruh indikator TP dengan baik dan mandiri.</td>
                </tr>
                <tr>
                    <td><span class="badge bg-success">90 – 100</span></td>
                    <td><strong>Sangat Baik</strong></td>
                    <td>Peserta didik melampaui indikator ketuntasan capaian TP, layak diberikan program pengayaan.</td>
                </tr>
            </tbody>
        </table>
    </div>
    `
};
