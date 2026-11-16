if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['nilai-pengetahuan'] = {
    title: 'Nilai Sumatif Lingkup Materi / PTS',
    desc: 'Panduan input nilai Sumatif Lingkup Materi (LM) dan Asesmen Sumatif Tengah Semester (PTS/STS), import Excel, serta integrasi otomatis di NextGen Garuda CBT Versi 1.5.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-pencil-alt text-primary"></i> Nilai Sumatif Lingkup Materi &amp; PTS/STS</h2>
        <p>Pada <strong>NextGen Garuda CBT Versi 1.5</strong>, lembar penilaian ini mengakomodasi dua kurikulum sekaligus: penilaian <strong>Sumatif Lingkup Materi (LM) / Asesmen Sumatif Tengah Semester (STS)</strong> untuk Kurikulum Merdeka, serta <strong>Penilaian Harian &amp; Penilaian Tengah Semester (PTS) KD Pengetahuan</strong> untuk Kurikulum 2013.</p>

        <div class="screenshot-placeholder">
            <i class="fas fa-table"></i>
            <p>Lembar Input Nilai Sumatif Lingkup Materi &amp; PTS Guru Mapel (/rapor/rapornilai/pts)</p>
        </div>

        <h3><i class="fas fa-keyboard text-info"></i> 3 Metode Pengisian Nilai</h3>
        <p>Guru pengampu mata pelajaran dapat mengisi nilai melalui tiga cara yang sangat fleksibel:</p>
        <ol class="step-list">
            <li><strong>Input Langsung di Tabel Web:</strong>
                <p>Ketikkan angka nilai 0–100 pada kotak input siswa. Tekan tombol <code class="inline">Enter</code> atau panah bawah pada keyboard untuk berpindah ke baris siswa berikutnya dengan cepat.</p>
            </li>
            <li><strong>Tarik Nilai CBT Otomatis (Direkomendasikan):</strong>
                <p>Klik tombol biru <code class="inline"><i class="fas fa-download"></i> Tarik Nilai CBT</code> di pojok kanan atas tabel. Pilih jadwal ujian PTS/STS CBT yang telah dikoreksi, dan seluruh nilai siswa langsung terisi otomatis tanpa perlu menyalin manual.</p>
            </li>
            <li><strong>Upload Nilai via Format Excel:</strong>
                <p>Klik tombol <code class="inline"><i class="fas fa-file-excel"></i> Download Format</code> untuk mengunduh template Excel berisi daftar siswa kelas. Isi kolom nilai di Excel offline, lalu unggah kembali melalui tombol <code class="inline"><i class="fas fa-upload"></i> Upload Nilai</code>.</p>
            </li>
        </ol>

        <h3><i class="fas fa-save text-success"></i> Menyimpan &amp; Menghitung Nilai</h3>
        <p>Setelah seluruh nilai terisi, klik tombol hijau <code class="inline"><i class="fas fa-save"></i> Simpan Nilai</code>. Sistem otomatis melakukan penghitungan rata-rata sumatif dan predikat per siswa.</p>
    </div>
    `
};
