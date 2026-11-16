if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['rapor-mapel'] = {
    title: 'Mata Pelajaran & Urutan Rapor',
    desc: 'Panduan konfigurasi struktur mata pelajaran rapor, pengelompokan kurikulum, dan sinkronisasi otomatis dari bank soal CBT di NextGen Garuda CBT Versi 1.5.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-book-open text-primary"></i> Kelola &amp; Urutan Mata Pelajaran Rapor</h2>
        <p>Halaman <strong>Kelola &amp; Revisi Mapel Rapor</strong> (<code class="inline">/rapor/mapel</code>) digunakan oleh Administrator untuk mengatur struktur, penomoran urut, serta pengelompokan mata pelajaran yang akan dicetak pada lembar Rapor Sisipan (STS) maupun Rapor Akhir Semester (SAS/SAT).</p>

        <div class="alert-box alert-info mb-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-sync-alt fa-2x me-3"></i>
                <div>
                    <strong>Sinkronisasi Instan dari Modul CBT:</strong>
                    <div>Mata pelajaran yang tampil pada rapor dapat disinkronkan langsung dari daftar mata pelajaran ujian CBT yang telah diselenggarakan, memastikan tidak ada mapel ujian yang terlewat atau salah penamaan di rapor.</div>
                </div>
            </div>
        </div>

        <div class="screenshot-placeholder">
            <i class="fas fa-list-ol"></i>
            <p>Pengaturan Penampilan &amp; Urutan Mata Pelajaran Rapor (/rapor/mapel)</p>
        </div>

        <h3><i class="fas fa-toggle-on text-success"></i> 2 Mode Penentuan Mapel Rapor</h3>
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card p-3 border-primary border-opacity-25 rounded-3 bg-light h-100">
                    <h5 class="fw-bold text-primary"><i class="fas fa-bolt me-2"></i> Mode Otomatis Sesuai Ujian</h5>
                    <p class="small text-muted mb-0">Sistem secara otomatis menampilkan mata pelajaran pada rapor yang memiliki Bank Soal atau Jadwal Ujian aktif pada semester berjalan. Sangat praktis dan meminimalisir kesalahan cetak mata pelajaran yang belum diujikan.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-3 border-secondary border-opacity-25 rounded-3 bg-light h-100">
                    <h5 class="fw-bold text-dark"><i class="fas fa-sliders-h me-2"></i> Mode Manual / Seleksi Terpilih</h5>
                    <p class="small text-muted mb-0">Administrator memiliki kendali penuh untuk memilih mapel mana saja yang dicetak per tingkat kelas, mengatur urutan nomor mata pelajaran (1, 2, 3...), serta menyesuaikan nama tampil resmi mata pelajaran.</p>
                </div>
            </div>
        </div>

        <h3><i class="fas fa-tools text-warning"></i> Tombol Aksi Cepat</h3>
        <ul class="step-list">
            <li><code class="inline"><i class="fas fa-sync"></i> Sinkronkan dengan Mapel Ujian CBT</code>: Memindai seluruh bank soal yang diujikan pada semester aktif dan mendaftarkannya otomatis ke tabel mapel rapor.</li>
            <li><code class="inline"><i class="fas fa-undo"></i> Reset Standar Madrasah / Sekolah</code>: Mengembalikan format pengelompokan dan urutan mata pelajaran sesuai standar baku Kemenag (Kelompok PAI: Al-Qur'an Hadis, Akidah Akhlak, Fikih, SKI, Bahasa Arab) atau standar Kemendikbud (Pendidikan Agama &amp; Budi Pekerti, Pancasila, Bahasa Indonesia, Matematika, IPA, IPS, Bahasa Inggris, PJOK, Seni &amp; Mulok).</li>
        </ul>

        <h3><i class="fas fa-check-circle text-primary"></i> Pengelompokan Mata Pelajaran pada Dokumen Cetak</h3>
        <p>Mata pelajaran yang tersimpan akan dikelompokkan secara rapi di lembar cetak rapor:</p>
        <table class="table-custom">
            <thead>
                <tr>
                    <th style="width: 25%;">Kelompok</th>
                    <th>Komposisi Mata Pelajaran</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Kelompok A (Umum / PAI)</strong></td>
                    <td>Pendidikan Agama Islam (Qur'an Hadis, Akidah Akhlak, Fikih, SKI), Pendidikan Pancasila, Bahasa Indonesia, Bahasa Arab, Matematika, Ilmu Pengetahuan Alam (IPA), Ilmu Pengetahuan Sosial (IPS), Bahasa Inggris.</td>
                </tr>
                <tr>
                    <td><strong>Kelompok B (Kewilayahan)</strong></td>
                    <td>Pendidikan Jasmani, Olahraga &amp; Kesehatan (PJOK), Seni dan Budaya / Prakarya, Informatika.</td>
                </tr>
                <tr>
                    <td><strong>Muatan Lokal (Mulok)</strong></td>
                    <td>Bahasa Daerah (Jawa/Sunda/dll), Baca Tulis Al-Qur'an (BTA), Tahfidz, Ke-NU-an / Ke-Muhammadiyahan / Muatan Sekolah.</td>
                </tr>
            </tbody>
        </table>
    </div>
    `
};
