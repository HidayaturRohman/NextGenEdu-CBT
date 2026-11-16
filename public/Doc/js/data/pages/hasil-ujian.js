if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['hasil-ujian'] = {
    title: 'Hasil Ujian CBT Real-Time',
    desc: 'Panduan lengkap pemantauan hasil ujian siswa real-time, koreksi esai, simulasi KKM dinamis, dan cetak dokumen ujian resmi.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-chart-line"></i> Rekapitulasi Hasil Ujian CBT Real-Time</h2>
        <p>
            Menu <strong>Hasil Ujian</strong> (<code class="inline">/cbthasil</code>) menyajikan rekapitulasi nilai 
            seluruh peserta ujian secara instan begitu peserta menyelesaikan ujian di perangkat mereka. 
            Modul ini memungkinkan Proktor, Guru Mata Pelajaran, dan Administrator memantau perolehan skor, 
            memeriksa rincian lembar jawaban siswa, mengkoreksi jawaban esai, melakukan simulasi KKM dinamis, 
            serta mencetak Berita Acara dan Rekap Nilai Resmi.
        </p>

        <div class="info-box tip">
            <i class="fas fa-sync-alt"></i>
            <div>
                <strong>Sinkronisasi Real-Time:</strong> Nilai soal objektif (Pilihan Ganda, PG Kompleks, Menjodohkan, Isian Singkat) 
                langsung dikalkulasi oleh server detik itu juga saat siswa mengklik tombol <em>"Selesai Ujian"</em> pada aplikasi Exambro.
            </div>
        </div>

        <hr>
        <h3><i class="fas fa-eye text-primary"></i> Memantau Hasil Ujian</h3>
        <ol class="step-list">
            <li>Buka menu <code class="inline">CBT > Hasil CBT > Hasil Ujian</code>.</li>
            <li>Pilih <strong>Jadwal Ujian</strong> dari dropdown yang tersedia.</li>
            <li>Filter berdasarkan <strong>Kelas / Rombel</strong>, <strong>Sesi</strong>, atau <strong>Ruangan</strong> jika diperlukan.</li>
            <li>Tabel hasil ujian akan menampilkan informasi lengkap:
                <ul class="step-list">
                    <li><strong>No. Peserta & NISN:</strong> Identitas resmi peserta.</li>
                    <li><strong>Nama Siswa:</strong> Nama lengkap peserta ujian.</li>
                    <li><strong>Kelas & Sesi:</strong> Rombongan belajar dan sesi ujian siswa.</li>
                    <li><strong>Benar / Salah / Kosong:</strong> Rincian perolehan butir jawaban objektif.</li>
                    <li><strong>Nilai PG:</strong> Skor murni jawaban pilihan ganda / objektif.</li>
                    <li><strong>Nilai Esai:</strong> Skor uraian yang dinilai oleh guru pengampu.</li>
                    <li><strong>Nilai Akhir (NA):</strong> Akumulasi nilai akhir berbobot.</li>
                    <li><strong>Status KKM:</strong> <span class="badge badge-success">TUNTAS</span> atau <span class="badge badge-danger">REMEDIAL</span>.</li>
                    <li><strong>Lama Pengerjaan:</strong> Durasi waktu yang dihabiskan siswa mengerjakan ujian.</li>
                </ul>
            </li>
        </ol>

        <hr>
        <h3><i class="fas fa-sliders-h text-warning"></i> KKM Dinamis Real-Time</h3>
        <p>
            Tabel hasil ujian dilengkapi kotak kontrol <strong>Batas Nilai KKM</strong>:
        </p>
        <ul class="step-list">
            <li>Ketikkan target KKM pada kotak input (contoh: <code>75</code>).</li>
            <li>Tanpa memuat ulang halaman (zero reload), seluruh baris tabel seketika membarui indikator kelulusan siswa, menghitung jumlah siswa yang tuntas vs siswa yang memerlukan ujian remedial.</li>
        </ul>

        <hr>
        <h3><i class="fas fa-search-plus text-info"></i> Inspeksi Lembar Jawaban Siswa</h3>
        <p>
            Untuk melihat detail lembar jawaban siswa tertentu:
        </p>
        <ol class="step-list">
            <li>Klik ikon <code class="inline"><i class="fas fa-search"></i> Lihat Jawaban</code> pada baris nama siswa.</li>
            <li>Modal interaktif akan menampilkan lembar kerja siswa nomor demi nomor:
                <ul class="step-list">
                    <li>Pilihan jawaban yang dipilih oleh siswa vs kunci jawaban yang benar.</li>
                    <li>Keterangan status per butir: Benar (Hijau), Salah (Merah), atau Kosong/Ragu-ragu (Kuning).</li>
                    <li>Skor poin yang diperoleh pada masing-masing butir soal.</li>
                </ul>
            </li>
        </ol>

        <hr>
        <h3><i class="fas fa-print text-danger"></i> Dokumen Resmi Ujian Siap Cetak</h3>
        <p>
            NextGen Garuda CBT menyediakan format cetak berkas administrasi ujian resmi:
        </p>
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="p-3 border rounded text-center bg-white shadow-sm h-100">
                    <i class="fas fa-file-contract fa-2x text-primary mb-2"></i>
                    <h6 class="font-weight-bold">Berita Acara (BAP)</h6>
                    <p class="text-muted" style="font-size: 12px;">Format resmi Berita Acara Pelaksanaan Ujian memuat data ruang, sesi, jumlah hadir, izin, alpa, dan catatan kejadian proktor.</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="p-3 border rounded text-center bg-white shadow-sm h-100">
                    <i class="fas fa-clipboard-list fa-2x text-success mb-2"></i>
                    <h6 class="font-weight-bold">Daftar Hadir Peserta</h6>
                    <p class="text-muted" style="font-size: 12px;">Lembar presensi ujian fisik per ruangan/sesi lengkap dengan kolom tanda tangan peserta ujian.</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="p-3 border rounded text-center bg-white shadow-sm h-100">
                    <i class="fas fa-award fa-2x text-warning mb-2"></i>
                    <h6 class="font-weight-bold">Rekap Nilai Landscape A4</h6>
                    <p class="text-muted" style="font-size: 12px;">Daftar nilai cetak dinas dengan Kop Instansi resmi, logo ganda, dan tanda tangan otomatis Kepala Madrasah / Kepala Sekolah.</p>
                </div>
            </div>
        </div>

        <hr>
        <h3><i class="fas fa-file-excel text-success"></i> Ekspor Nilai ke Excel</h3>
        <p>Klik tombol <code class="inline"><i class="fas fa-file-excel"></i> Ekspor Excel</code> untuk mengunduh rekapitulasi nilai lengkap beserta lembar rincian jawaban per butir soal untuk analisis lebih lanjut.</p>
    </div>`
};
