if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['projek-p5-p2ra'] = {
    title: 'Kokurikuler P5 & P2RA',
    desc: 'Panduan lengkap penilaian projek kokurikuler P5 (Kemendikbud) dan P2RA (Kemenag) sesuai jenis madrasah atau sekolah di NextGen Garuda CBT Versi 1.5.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-seedling text-success"></i> Penilaian Kokurikuler: P5 &amp; P2RA</h2>
        <p>Dalam kerangka <strong>Kurikulum Merdeka</strong>, kegiatan kokurikuler bertujuan memperkuat karakter dan kompetensi peserta didik melalui projek nyata. <strong>NextGen Garuda CBT Versi 1.5</strong> menghadirkan modul penilaian kokurikuler terintegrasi yang secara otomatis mendeteksi profil madrasah/sekolah Anda:</p>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card h-100 border-primary border-opacity-25 shadow-sm p-3 rounded-3 bg-light">
                    <h5 class="fw-bold text-primary"><i class="fas fa-mosque me-2"></i> Jalur Kemenag (MI / MTs / MA)</h5>
                    <p class="small text-muted mb-0">Mendukung <strong>P2RA (Profil Pelajar Rahmatan Lil Alamin)</strong> serta integrasi Nilai <em>Panca Cinta</em> / Dimensi Profil Lulusan (DPL): Berkeadaban (Ta’addub), Keteladanan (Qudwah), Kewarganegaraan &amp; Kebangsaan (Muwatanah), Mengambil Jalan Tengah (Tawassut), Berimbang (Tawazun), Lurus &amp; Tegas (I’tidal), Kesetaraan (Musawah), Musyawarah (Syura), Toleransi (Tasamuh), serta Dinamis &amp; Inovatif (Tatawwur wa Ibtikar).</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 border-success border-opacity-25 shadow-sm p-3 rounded-3 bg-light">
                    <h5 class="fw-bold text-success"><i class="fas fa-school me-2"></i> Jalur Kemendikbud (SD / SMP / SMA)</h5>
                    <p class="small text-muted mb-0">Mendukung <strong>P5 (Projek Penguatan Profil Pelajar Pancasila)</strong> dengan 6 Dimensi Utama: Beriman &amp; Bertakwa kepada Tuhan YME dan Berakhlak Mulia, Berkebhinekaan Global, Bergotong Royong, Mandiri, Bernalar Kritis, dan Kreatif.</p>
                </div>
            </div>
        </div>

        <div class="screenshot-placeholder">
            <i class="fas fa-seedling"></i>
            <p>Lembar Input Nilai Kokurikuler P5 / P2RA Wali Kelas (/rapor/raporsikap)</p>
        </div>

        <h3><i class="fas fa-layer-group text-primary"></i> 4 Skala Predikat Perkembangan Peserta Didik</h3>
        <p>Penilaian P5/P2RA tidak menggunakan angka nilai kuantitatif 0-100, melainkan menggunakan rubrik skala perkembangan kualitatif berstandar nasional:</p>
        <table class="table-custom">
            <thead>
                <tr>
                    <th style="width: 15%;">Kode</th>
                    <th style="width: 30%;">Tingkat Capaian</th>
                    <th>Deskripsi Indikator Perilaku</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="badge bg-secondary">MB</span></td>
                    <td><strong>Mulai Berkembang</strong></td>
                    <td>Peserta didik masih memerlukan bimbingan intensif dari fasilitator dalam mengembangkan dimensi/elemen target projek.</td>
                </tr>
                <tr>
                    <td><span class="badge bg-info text-dark">SB</span></td>
                    <td><strong>Sedang Berkembang</strong></td>
                    <td>Peserta didik mulai menunjukkan pemahaman dan partisipasi aktif dalam kegiatan projek namun belum konsisten.</td>
                </tr>
                <tr>
                    <td><span class="badge bg-primary">BSH</span></td>
                    <td><strong>Berkembang Sesuai Harapan</strong></td>
                    <td>Peserta didik telah mencapai target kompetensi dimensi dan elemen projek secara mandiri, aktif, dan konsisten.</td>
                </tr>
                <tr>
                    <td><span class="badge bg-success">SAB</span></td>
                    <td><strong>Sangat Berkembang</strong></td>
                    <td>Peserta didik melampaui ekspektasi target projek dan mampu menjadi teladan atau menginspirasi rekan sebaya di kelas.</td>
                </tr>
            </tbody>
        </table>

        <h3><i class="fas fa-tasks text-warning"></i> Alur Penginputan Nilai Kokurikuler oleh Wali Kelas</h3>
        <ol class="step-list">
            <li><strong>Buka Menu Penilaian Kokurikuler:</strong>
                <p>Login sebagai Guru/Wali Kelas &gt; buka menu <code class="inline">Penilaian</code> &gt; pilih submenu <code class="inline">Input Wali Kelas</code> &gt; klik <code class="inline">Kokurikuler (P5/P2RA)</code> atau akses route <code class="inline">/rapor/raporsikap</code>.</p>
            </li>
            <li><strong>Buat / Daftarkan Tema Projek:</strong>
                <p>Klik tombol <code class="inline">+ Tambah Tema Projek</code>. Tentukan Judul Projek, Deskripsi Projek, serta Dimensi Karakter atau Sub-elemen yang disasar dalam satu semester.</p>
            </li>
            <li><strong>Input Capaian Siswa:</strong>
                <p>Pada tabel siswa kelas binaan, pilih predikat perkembangan masing-masing siswa (<code class="inline">MB</code>, <code class="inline">SB</code>, <code class="inline">BSH</code>, atau <code class="inline">SAB</code>) pada butir-butir dimensi yang diuji.</p>
            </li>
            <li><strong>Berikan Catatan Proses Projek:</strong>
                <p>Tuliskan catatan apresiasi atau evaluasi deskriptif perkembangan karakter siswa selama menjalankan projek.</p>
            </li>
            <li><strong>Kunci &amp; Kirim Nilai:</strong>
                <p>Setelah seluruh siswa dinilai, aktifkan toggle <code class="inline">Kirim Nilai Rapor</code> agar nilai kokurikuler terarsip secara permanen dan otomatis tampil di lembar Cetak Rapor P5/P2RA.</p>
            </li>
        </ol>
    </div>
    `
};
