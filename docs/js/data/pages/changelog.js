if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['changelog'] = {
    title: 'Riwayat Pembaruan (Changelog)',
    desc: 'Catatan resmi rilis fitur, peningkatan performa, dan pembaruan NextGen Garuda CBT.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-history"></i> Riwayat Pembaruan Resmi</h2>
        <p>Catatan rilis dan dokumentasi fitur baru pada <strong>NextGen Garuda CBT</strong>.</p>

        <hr>
        <div class="version-item mb-4">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h3 class="mb-0 text-primary"><i class="fas fa-tag"></i> NextGen Garuda CBT Versi 1.5</h3>
                <span class="badge badge-primary px-3 py-2 font-weight-bold">RILIS TERBARU 2026/2027</span>
            </div>
            <p class="text-muted" style="font-size: 13px;">Pembaruan skala besar sistem Asesmen CBT, E-Learning, Rapor Digital, dan Modul Alumni Terpadu.</p>

            <h5 class="font-weight-bold text-success mt-3"><span class="badge badge-success mr-2">New</span> Fitur & Modul Baru</h5>
            <ul>
                <li><strong>Rekap Nilai Siswa Semester (<code class="inline">/elearning/nilaisemester</code>):</strong>
                    <ul>
                        <li>Fitur <strong>Dual Mode Tampilan</strong>: Mode Ringkas (Bulanan M1-M6, Rata-rata E-learning, RPH, PTS, PAS/PAT, NA, Predikat, Ketuntasan) dan Mode Detail (Rincian per pertemuan Materi & Tugas harian, tanggal selesai, nilai riil, dan catatan guru).</li>
                        <li><strong>KKM Dinamis Interaktif:</strong> Input KKM langsung di header tabel dengan kalkulasi ulang status ketuntasan siswa seketika (zero-reload).</li>
                        <li><strong>Ringkasan KPI Cards:</strong> 5 kartu ringkasan cepat (Total Siswa, Rata-rata Kelas, Nilai Maksimum, Nilai Minimum, Persentase Ketuntasan).</li>
                        <li><strong>Cetak Dokumen Landscape A4:</strong> Format cetak dinas rapi dilengkapi kop surat resmi dan blok tanda tangan otomatis guru & pimpinan.</li>
                    </ul>
                </li>
                <li><strong>Presensi Kehadiran Bulanan & Leger (<code class="inline">/elearning/kehadiran</code>):</strong>
                    <ul>
                        <li>Matriks kalender presensi harian dinamis (Tanggal 1 s/d 31).</li>
                        <li>Kode status visual Hadir (H), Sakit (S), Izin (I), dan Alpa (A).</li>
                        <li>Perhitungan otomatis kumulatif hari dan <strong>Persentase Kehadiran (% Hadir)</strong>.</li>
                        <li>Cetak Leger Presensi Bulanan Resmi format Landscape A4 dan ekspor spreadsheet Excel.</li>
                    </ul>
                </li>
                <li><strong>Modul Data Alumni & Kelulusan Massal (<code class="inline">/alumni</code>):</strong>
                    <ul>
                        <li>Fitur <strong>Kelulusan Massal 1-Klik</strong>: Meluluskan seluruh siswa rombel kelas akhir (Kelas 9 / Kelas 12 / Kelas 6) secara serentak ke arsip alumni tanpa menghapus riwayat nilai dan rapor.</li>
                        <li>Pencarian cepat alumni (Tracer Search) berdasarkan NISN, Nama, Tahun Kelulusan, atau Rombel Terakhir.</li>
                        <li>Ekspor data alumni ke Excel untuk keperluan akreditasi dan pelacakan kelulusan.</li>
                    </ul>
                </li>
                <li><strong>NextGen Garuda Exambro v1.5 (Android & Web Client):</strong>
                    <ul>
                        <li>Aplikasi Kiosk Lock-down Browser resmi Android dengan proteksi Anti-Split Screen, blokir floating window/bubble chat, dan blokir tombol navigasi Home/Recent Apps.</li>
                        <li><strong>Built-in QR Code Scanner:</strong> Login instan peserta dengan memindai barcode/QR pada Kartu Peserta Ujian.</li>
                        <li>Proteksi Privasi Layar Hitam (Anti-Screenshot & Anti Screen Recording).</li>
                        <li>Verifikasi PIN Keluar Pengawas Ruang.</li>
                        <li>Proteksi Web Browser: Deteksi perpindahan tab (User Focus Lost), Strike Violation Counter, dan Auto-submit.</li>
                    </ul>
                </li>
                <li><strong>NextGen Image Converter & WebP Optimizer (<code class="inline">/tools/image_converter</code>):</strong>
                    <ul>
                        <li>Utilitas kompresi massal gambar soal ke format WebP super ringan (penghematan ukuran 70-85%).</li>
                        <li>Drag & drop multi-file upload, slider kualitas kompresi, dan pratinjau perbandingan ukuran sebelum-sesudah konversi.</li>
                        <li>Menghilangkan kendala server down saat ribuan siswa mengakses soal bergambar bersamaan.</li>
                    </ul>
                </li>
                <li><strong>Dual Nomenklatur Jabatan Otomatis:</strong>
                    <ul>
                        <li>Penerapan otomatis sebutan <strong>Kepala Madrasah</strong> untuk jenjang Kementerian Agama (MI, MTs, MA).</li>
                        <li>Penerapan otomatis sebutan <strong>Kepala Sekolah</strong> untuk jenjang Dinas Pendidikan (SD, SMP, SMA, SMK).</li>
                    </ul>
                </li>
                <li><strong>Analisis Butir Soal Interaktif (<code class="inline">/cbtanalisis</code>):</strong>
                    <ul>
                        <li>Visualisasi grafik distribusi nilai dan tingkat kesukaran soal menggunakan pustaka <strong>Chart.js</strong>.</li>
                        <li>Analisis psikometri lengkap: Daya Pembeda (DP), Tingkat Kesukaran (TK), dan Efektivitas Pengecoh (Distraktor).</li>
                    </ul>
                </li>
            </ul>

            <h5 class="font-weight-bold text-info mt-3"><span class="badge badge-info mr-2">Improvement</span> Peningkatan Kinerja & Arsitektur</h5>
            <ul>
                <li>Upgrade framework inti ke <strong>CodeIgniter 4.7</strong> dengan kompatibilitas penuh untuk <strong>PHP 8.3+</strong>.</li>
                <li>Optimasi query database MariaDB/MySQL dengan index join relasional untuk mengurangi beban CPU server hingga 60%.</li>
                <li>Peningkatan keamanan sesi token dengan token CSRF dinamis dan sanitasi input anti-SQL Injection.</li>
            </ul>
        </div>
    </div>`
};
