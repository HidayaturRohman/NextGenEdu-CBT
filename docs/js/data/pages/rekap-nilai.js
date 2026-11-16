if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['rekap-nilai'] = {
    title: 'Rekapitulasi Nilai Ujian CBT',
    desc: 'Panduan lengkap melihat rekapitulasi nilai ujian CBT, filter kelas, KKM dinamis, dan ekspor excel di NextGen Garuda CBT Versi 1.5.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-chart-bar"></i> Rekapitulasi Nilai Ujian CBT</h2>
        <p>
            Menu <strong>Rekap Nilai</strong> pada kelompok Hasil CBT menampilkan seluruh rekapitulasi hasil ujian siswa 
            dalam satu tabel komprehensif. Modul ini memungkinkan guru dan administrator menganalisis ketercapaian kompetensi 
            berdasarkan nilai batas KKM, memfilter per kelas, serta mengekspor data ke format spreadsheet Excel.
        </p>

        <div class="info-box tip">
            <i class="fas fa-info-circle"></i>
            <div>
                <strong>Otomatis & Real-Time:</strong> Nilai soal pilihan ganda, PG kompleks, menjodohkan, dan isian singkat 
                langsung terakumulasi secara otomatis. Untuk soal esai, guru dapat memasukkan nilai manual pada menu Koreksi sebelum mencetak rekap akhir.
            </div>
        </div>

        <hr>
        <h3><i class="fas fa-step-forward text-primary"></i> Langkah Melihat Rekap Nilai CBT</h3>
        <ol class="step-list">
            <li>Buka menu <code class="inline">CBT > Hasil CBT > Rekap Nilai</code>.</li>
            <li>Pilih <strong>Jadwal Ujian</strong> yang ingin dilihat dari dropdown.</li>
            <li>Pilih <strong>Kelas</strong> jika ingin menampilkan data kelas tertentu.</li>
            <li>Tabel rekapitulasi akan menyajikan:
                <ul class="step-list">
                    <li><strong>Nomor Peserta & Nama Siswa:</strong> Identitas resmi peserta ujian.</li>
                    <li><strong>Perolehan Butir:</strong> Jumlah Benar, Salah, dan Kosong.</li>
                    <li><strong>Nilai PG & Nilai Esai:</strong> Rincian nilai per jenis soal.</li>
                    <li><strong>Nilai Akhir (Skor 0 - 100):</strong> Nilai murni hasil asesmen.</li>
                    <li><strong>Status KKM:</strong> Indikator Tuntas atau Remedial.</li>
                    <li><strong>Waktu Pengerjaan:</strong> Lama pengerjaan dalam format menit dan detik.</li>
                </ul>
            </li>
        </ol>

        <hr>
        <h3><i class="fas fa-sliders-h text-warning"></i> KKM Dinamis Real-Time</h3>
        <p>
            Guru dapat memasukkan angka KKM (contoh: <code>75</code>) pada kotak filter KKM di bagian atas tabel. 
            Sistem seketika mengelompokkan siswa yang tuntas dan siswa yang wajib mengikuti ujian remedial tanpa perlu me-reload halaman.
        </p>

        <hr>
        <h3><i class="fas fa-print text-danger"></i> Cetak Rekap & Ekspor Excel</h3>
        <ol class="step-list">
            <li><strong>Cetak Rekap Nilai (Landscape A4):</strong> Klik tombol <code class="inline"><i class="fas fa-print"></i> Cetak Rekap</code> untuk menghasilkan lembar penilaian resmi ber-Kop Surat dengan tanda tangan otomatis Guru Pengampu dan Kepala Madrasah / Kepala Sekolah.</li>
            <li><strong>Ekspor Excel:</strong> Klik tombol <code class="inline"><i class="fas fa-file-excel"></i> Ekspor Excel</code> untuk mengunduh rekap nilai lengkap dengan lembar kunci jawaban dan butir soal.</li>
        </ol>
    </div>`
};
