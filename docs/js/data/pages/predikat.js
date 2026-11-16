if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['predikat'] = {
    title: 'Interval Predikat & Nilai',
    desc: 'Panduan kalkulasi otomatis rentang predikat A, B, C, D dan narasi capaian belajar siswa berdasarkan batas KKM/KKTP di NextGen Garuda CBT Versi 1.5.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-chart-pie text-primary"></i> Interval Predikat &amp; Rentang Nilai</h2>
        <p>Pada <strong>NextGen Garuda CBT Versi 1.5</strong>, sistem secara otomatis menghitung rentang <strong>Interval Predikat</strong> (<code class="inline">A</code>, <code class="inline">B</code>, <code class="inline">C</code>, dan <code class="inline">D</code>) secara dinamis menggunakan rumus baku pembagian selisih nilai ketuntasan terhadap nilai maksimum 100.</p>

        <div class="screenshot-placeholder">
            <i class="fas fa-balance-scale"></i>
            <p>Tabel Interval Predikat Otomatis Rapor Siswa</p>
        </div>

        <h3><i class="fas fa-calculator text-info"></i> Rumus Interval Panjang Predikat</h3>
        <p>Panjang interval (<code class="inline">Interval</code>) dihitung dengan rumus:</p>
        <div class="alert-box alert-secondary text-center my-3">
            <h5 class="mb-0 fw-bold">Interval = (100 – KKM / KKTP) &divide; 3</h5>
        </div>
        <p>Sebagai contoh, apabila nilai KKM mata pelajaran ditetapkan sebesar <strong>75</strong>:</p>
        <ul>
            <li>Panjang Interval = (100 – 75) &divide; 3 = <strong>8,33</strong></li>
            <li>Predikat D (Perlu Bimbingan) : Nilai &lt; 75 (0 s.d. 74)</li>
            <li>Predikat C (Cukup) : 75 s.d. 83 (75 + 8,33)</li>
            <li>Predikat B (Baik) : 84 s.d. 91 (83 + 8,33)</li>
            <li>Predikat A (Sangat Baik) : 92 s.d. 100</li>
        </ul>

        <h3><i class="fas fa-table text-success"></i> Matriks Predikat &amp; Deskripsi Rapor IKM</h3>
        <table class="table-custom">
            <thead>
                <tr>
                    <th style="width: 15%;">Predikat</th>
                    <th style="width: 25%;">Kategori IKM</th>
                    <th>Pengaruh ke Deskripsi Narasi Rapor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="badge bg-success">A</span></td>
                    <td><strong>Sangat Baik</strong></td>
                    <td>Menjadi butir <em>Capaian Kompetensi Tertinggi</em>: Menunjukkan penguasaan yang sangat baik dalam seluruh tujuan pembelajaran.</td>
                </tr>
                <tr>
                    <td><span class="badge bg-primary">B</span></td>
                    <td><strong>Baik</strong></td>
                    <td>Menunjukkan ketercapaian kompetensi yang baik dan tuntas secara mandiri.</td>
                </tr>
                <tr>
                    <td><span class="badge bg-warning text-dark">C</span></td>
                    <td><strong>Cukup</strong></td>
                    <td>Telah mencapai batas ketuntasan minimum dengan bimbingan standar.</td>
                </tr>
                <tr>
                    <td><span class="badge bg-danger">D</span></td>
                    <td><strong>Perlu Bimbingan</strong></td>
                    <td>Menjadi butir <em>Capaian Kompetensi Terendah</em>: Perlu bimbingan dan pendampingan intensif dalam meningkatkan penguasaan materi terkait.</td>
                </tr>
            </tbody>
        </table>
    </div>
    `
};
