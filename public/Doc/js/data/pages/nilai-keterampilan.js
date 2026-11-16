if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['nilai-keterampilan'] = {
    title: 'Nilai Sumatif Akhir Semester (SAS)',
    desc: 'Panduan input nilai Sumatif Akhir Semester (SAS/PAS/SAT), bobot nilai akhir (NA), dan pembangkit narasi deskripsi capaian otomatis di NextGen Garuda CBT Versi 1.5.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-file-invoice text-success"></i> Nilai Sumatif Akhir Semester (SAS / PAS)</h2>
        <p>Halaman <strong>Input Nilai SAS</strong> (<code class="inline">/rapor/rapornilai/sas</code>) digunakan untuk menginput skor asesmen akhir semester (Sumatif Akhir Semester pada Kurikulum Merdeka atau Penilaian Akhir Semester / KD Keterampilan pada K13). Nilai ini digabungkan dengan Rata-rata Sumatif Lingkup Materi untuk menghasilkan <strong>Nilai Akhir (NA)</strong> Rapor.</p>

        <div class="screenshot-placeholder">
            <i class="fas fa-calculator"></i>
            <p>Lembar Input Nilai Sumatif Akhir Semester (SAS) &amp; Deskripsi Capaian Otomatis (/rapor/rapornilai/sas)</p>
        </div>

        <h3><i class="fas fa-balance-scale text-primary"></i> Pembobotan Nilai Akhir (NA) Rapor</h3>
        <p>Secara default pada Kurikulum Merdeka, Nilai Akhir Rapor dihitung dari rumus pembobotan yang dikonfigurasi di <em>Setting Rapor</em>:</p>
        <div class="alert-box alert-secondary text-center my-3">
            <h5 class="mb-0 fw-bold">Nilai Akhir (NA) = (Bobot LM &times; Rata-rata LM) + (Bobot SAS &times; Nilai SAS) &divide; (Bobot LM + Bobot SAS)</h5>
        </div>
        <p class="small text-muted text-center">Misal bobot LM = 50% dan SAS = 50%, atau LM = 60% dan SAS = 40%.</p>

        <h3><i class="fas fa-magic text-info"></i> Generator Narasi Capaian Kompetensi Otomatis</h3>
        <p>Salah satu fitur tercanggih NextGen Garuda CBT v1.5 adalah generator narasi cerdas: sistem memeriksa perolehan nilai setiap Tujuan Pembelajaran (TP) peserta didik dan merangkumnya secara otomatis menjadi dua paragraf capaian pada lembar rapor resmi:</p>
        <ul class="step-list">
            <li><strong>Capaian Tertinggi:</strong> Menyoroti TP di mana siswa meraih skor tertinggi (misal: <em>"Menunjukkan penguasaan sangat baik dalam menganalisis hukum bacaan mad lazim..."</em>).</li>
            <li><strong>Capaian Terendah:</strong> Menyoroti TP di mana siswa meraih skor terendah dan memerlukan pendampingan (misal: <em>"Perlu peningkatan dan pendampingan lebih lanjut dalam memahami pembagian waris..."</em>).</li>
        </ul>

        <h3><i class="fas fa-sync-alt text-warning"></i> Sinkronisasi Instan dari Ujian CBT</h3>
        <p>Sama halnya dengan lembar PTS, Guru dapat menekan tombol biru <code class="inline"><i class="fas fa-download"></i> Tarik Nilai CBT</code> untuk menarik seluruh skor hasil ujian SAS/PAS yang telah dikerjakan siswa di modul CBT tanpa perlu menyalin satu per satu.</p>
    </div>
    `
};
