if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['kkm'] = {
    title: 'KKM & Kriteria Ketuntasan',
    desc: 'Panduan penetapan Kriteria Ketuntasan Minimal (KKM) dan ambang batas kelulusan kompetensi belajar siswa di NextGen Garuda CBT Versi 1.5.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-bullseye text-primary"></i> Kriteria Ketuntasan Minimal (KKM)</h2>
        <p><strong>KKM (Kriteria Ketuntasan Minimal)</strong> adalah standar batas nilai terendah yang wajib dicapai oleh peserta didik untuk dinyatakan tuntas dalam suatu mata pelajaran. Pada <strong>NextGen Garuda CBT Versi 1.5</strong>, KKM mendukung kurikulum ganda: format KKM Klasik (Kurikulum 2013) serta terintegrasi dengan <strong>KKTP</strong> (Kurikulum Merdeka).</p>

        <div class="screenshot-placeholder">
            <i class="fas fa-sliders-h"></i>
            <p>Pengaturan KKM Mata Pelajaran Guru (/rapor/raporkkm)</p>
        </div>

        <h3><i class="fas fa-calculator text-info"></i> 3 Aspek Penentuan Nilai KKM</h3>
        <p>Sesuai pedoman penilaian pendidikan nasional, penetapan angka KKM mata pelajaran dihitung berdasarkan tiga indikator utama:</p>
        <table class="table-custom">
            <thead>
                <tr>
                    <th style="width: 25%;">Aspek Penilaian</th>
                    <th>Penjelasan Indikator</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>1. Kompleksitas Materi</strong></td>
                    <td>Tingkat kesulitan dan kedalaman materi pada mata pelajaran. Semakin tinggi tingkat kesulitan, rentang KKM dapat disesuaikan secara proporsional.</td>
                </tr>
                <tr>
                    <td><strong>2. Daya Dukung Madrasah</strong></td>
                    <td>Ketersediaan fasilitas sarana prasarana belajar, laboratorium, buku ajar, proyektor/komputer, dan kompetensi pendidik.</td>
                </tr>
                <tr>
                    <td><strong>3. Intake Siswa</strong></td>
                    <td>Tingkat kemampuan rata-rata siswa baru yang masuk berdasarkan nilai rapor jenjang sebelumnya atau hasil asesmen diagnostik awal.</td>
                </tr>
            </tbody>
        </table>

        <h3><i class="fas fa-cogs text-warning"></i> Cara Mengatur KKM di Sistem</h3>
        <ol class="step-list">
            <li>Login sebagai Guru Pengampu Mapel.</li>
            <li>Buka menu <code class="inline">Penilaian</code> &gt; pilih submenu <code class="inline">Data Acuan Rapor</code> &gt; klik <code class="inline">KKTP / Interval Nilai</code>.</li>
            <li>Pilih Mata Pelajaran dan Rombel Kelas target.</li>
            <li>Ketikkan angka KKM (misalnya: <code class="inline">75</code>).</li>
            <li>Sistem akan secara otomatis membagi rentang nilai menjadi 4 predikat (<code class="inline">D</code>: Perlu Bimbingan / Kurang, <code class="inline">C</code>: Cukup, <code class="inline">B</code>: Baik, <code class="inline">A</code>: Sangat Baik).</li>
            <li>Klik tombol hijau <code class="inline"><i class="fas fa-save"></i> Simpan KKM</code>.</li>
        </ol>

        <div class="alert-box alert-success mt-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-lightbulb fa-2x me-3"></i>
                <div>
                    <strong>Transisi ke Kurikulum Merdeka (IKM):</strong>
                    <div>Bagi madrasah atau sekolah yang telah menerapkan Kurikulum Merdeka penuh, nilai KKM ini bertindak sebagai ambang batas <em>Kriteria Ketercapaian Tujuan Pembelajaran (KKTP)</em>. Pelajari panduan lengkapnya pada menu <strong>Tujuan Pembelajaran (TP) &amp; KKTP</strong>.</div>
                </div>
            </div>
        </div>
    </div>
    `
};
