if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['rekap-nilai-elearning'] = {
    title: 'Rekap Nilai Siswa Semester (E-Learning)',
    desc: 'Panduan lengkap monitoring rekapitulasi nilai semester e-learning, dual mode (Ringkas vs Detail), KKM dinamis, dan cetak leger resmi.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-file-invoice-dollar"></i> Rekapitulasi Nilai Siswa Semester</h2>
        <p>
            Menu <strong>Rekap Nilai Siswa Semester</strong> (<code class="inline">/elearning/nilaisemester</code>) 
            adalah pusat pemantauan performa akademik komprehensif bagi Guru dan Administrator di NextGen Garuda CBT Versi 1.5. 
            Modul ini mengintegrasikan seluruh riwayat aktivitas belajar daring—mulai dari absensi materi, skor tugas harian, 
            Rata-rata Penilaian Harian (RPH), Penilaian Tengah Semester (PTS), hingga Penilaian Akhir Semester (PAS/PAT)—menjadi 
            leger nilai semester yang siap cetak dan siap diolah ke Buku Rapor.
        </p>

        <div class="info-box tip">
            <i class="fas fa-magic"></i>
            <div>
                <strong>Inovasi Versi 1.5:</strong> Dilengkapi fitur <strong>Dual Mode Tampilan</strong> (Mode Ringkas Bulanan vs Mode Detail Harian), <strong>KKM Dinamis Real-Time</strong> (perhitungan ulang ketuntasan instan), <strong>Ringkasan KPI Cards</strong>, dan <strong>Cetak Resmi Landscape A4</strong> dengan kop dinas serta deteksi otomatis Kepala Madrasah / Kepala Sekolah.
            </div>
        </div>

        <hr>
        <h3><i class="fas fa-sign-in-alt text-primary"></i> Cara Mengakses Menu</h3>
        <ol class="step-list">
            <li>Login ke sistem sebagai <strong>Guru</strong> atau <strong>Administrator</strong>.</li>
            <li>Pada sidebar navigasi sebelah kiri, buka kelompok menu <code class="inline">Hasil E-Learning</code>.</li>
            <li>Pilih submenu <code class="inline">Rekap Nilai</code> (atau akses URL <code class="inline">/elearning/nilaisemester</code>).</li>
            <li>Pilih <strong>Kelas / Rombel</strong> dan <strong>Mata Pelajaran</strong> yang ingin dilihat, lalu tekan tombol <strong>Tampilkan Data</strong>.</li>
        </ol>

        <hr>
        <h3><i class="fas fa-toggle-on text-success"></i> Fitur Unggulan: Dual Mode Tampilan</h3>
        <p>
            Guru dapat berpindah mode tampilan dengan mudah menggunakan tombol toggle switcher di pojok kanan atas tabel nilai:
        </p>

        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="p-3 border rounded h-100" style="background: rgba(0, 201, 167, 0.05); border-color: rgba(0, 201, 167, 0.3) !important;">
                    <h5 class="font-weight-bold text-success"><i class="fas fa-calendar-alt"></i> 1. Mode Ringkas (Bulanan)</h5>
                    <p style="font-size: 13.5px;">
                        Dirancang khusus untuk monitoring bulanan dan pelaporan berkala wali kelas / kepala sekolah:
                    </p>
                    <ul style="font-size: 13px; padding-left: 18px;">
                        <li><strong>Rata-rata Bulanan (B1 - B6):</strong> Menampilkan progres nilai per bulan (Juli s/d Desember untuk Semester Ganjil, atau Januari s/d Juni untuk Semester Genap).</li>
                        <li><strong>Rata-rata E-Learning:</strong> Skor gabungan dari seluruh materi dan tugas daring selama satu semester.</li>
                        <li><strong>Nilai RPH:</strong> Rata-rata Penilaian Harian dari ulangan/kuis formatif.</li>
                        <li><strong>PTS & PAS/PAT:</strong> Skor ujian tengah semester dan akhir semester.</li>
                        <li><strong>Nilai Akhir (NA) & Predikat:</strong> Kalkulasi otomatis nilai akhir dan grade (A, B, C, D).</li>
                        <li><strong>Status Ketuntasan:</strong> Label badge visual <span class="badge badge-success">TUNTAS</span> (hijau) atau <span class="badge badge-danger">REMEDIAL</span> (merah) sesuai batas KKM.</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="p-3 border rounded h-100" style="background: rgba(0, 123, 255, 0.05); border-color: rgba(0, 123, 255, 0.3) !important;">
                    <h5 class="font-weight-bold text-primary"><i class="fas fa-list-ol"></i> 2. Mode Detail (Harian)</h5>
                    <p style="font-size: 13.5px;">
                        Dirancang untuk analisis mendalam guru mata pelajaran dalam memeriksa kepatuhan siswa:
                    </p>
                    <ul style="font-size: 13px; padding-left: 18px;">
                        <li><strong>Rincian Per Pertemuan:</strong> Menampilkan kolom spesifik untuk setiap Materi (M1, M2, M3, ...) dan Tugas (T1, T2, T3, ...).</li>
                        <li><strong>Status Penyelesaian:</strong> Membedakan siswa yang sudah membaca/mengumpulkan tugas tepat waktu, terlambat, atau belum mengerjakan sama sekali.</li>
                        <li><strong>Nilai Riil Tiap Tugas:</strong> Skor murni setiap tugas terstruktur yang telah diperiksa oleh guru.</li>
                        <li><strong>Catatan Guru:</strong> Memuat catatan feedback atau koreksi tugas bagi masing-masing siswa.</li>
                    </ul>
                </div>
            </div>
        </div>

        <hr>
        <h3><i class="fas fa-sliders-h text-warning"></i> KKM Dinamis Real-Time</h3>
        <p>
            Setiap mata pelajaran atau jenjang kelas memiliki standar Kriteria Ketuntasan Minimal (KKM) yang berbeda. 
            NextGen Garuda CBT Versi 1.5 menyediakan kontrol KKM dinamis interaktif:
        </p>
        <ul class="step-list">
            <li>
                <strong>Input Nilai KKM di Kontrol Header:</strong>
                <p>Ketikkan angka KKM (misalnya: <code>75</code>) pada kotak input KKM yang tersedia di atas tabel nilai.</p>
            </li>
            <li>
                <strong>Kalkulasi Instan Tanpa Reload Halaman:</strong>
                <p>Sistem JavaScript secara otomatis menghitung ulang seluruh status siswa di tabel dalam waktu kurang dari 1 detik. Siswa yang nilainya di bawah KKM langsung berubah menjadi status <em>REMEDIAL</em>, dan statistik ringkasan kelas seketika disesuaikan.</p>
            </li>
        </ul>

        <hr>
        <h3><i class="fas fa-chart-pie text-info"></i> Ringkasan KPI Cards (Statistik Kelas)</h3>
        <p>Di bagian atas rekapitulasi, sistem menyajikan 5 kartu ringkasan eksekutif:</p>
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="p-3 border rounded text-center bg-white shadow-sm">
                    <span class="text-muted" style="font-size: 12px; text-transform: uppercase;">Total Siswa</span>
                    <h4 class="font-weight-bold text-dark mt-1 mb-0">32 Siswa</h4>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="p-3 border rounded text-center bg-white shadow-sm">
                    <span class="text-muted" style="font-size: 12px; text-transform: uppercase;">Rata-rata Kelas</span>
                    <h4 class="font-weight-bold text-primary mt-1 mb-0">82.45</h4>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="p-3 border rounded text-center bg-white shadow-sm">
                    <span class="text-muted" style="font-size: 12px; text-transform: uppercase;">Persentase Ketuntasan</span>
                    <h4 class="font-weight-bold text-success mt-1 mb-0">93.75%</h4>
                </div>
            </div>
        </div>

        <hr>
        <h3><i class="fas fa-print text-danger"></i> Cetak Leger Resmi (Format Landscape A4)</h3>
        <p>
            Dokumen rekap nilai semester dapat langsung dicetak menjadi berkas fisik dinas dengan format Landscape A4 yang rapi:
        </p>
        <ol class="step-list">
            <li>Klik tombol <code class="inline"><i class="fas fa-print"></i> Cetak Rekap</code> di bagian atas tabel.</li>
            <li>Jendela pratinjau cetak browser akan terbuka dengan format khusus cetak:
                <ul class="step-list">
                    <li><strong>Kop Surat Resmi:</strong> Menampilkan logo ganda instansi, nama sekolah/madrasah, alamat lengkap, dan garis pembatas resmi.</li>
                    <li><strong>Tabel Nilai Bergaris Rapi:</strong> Seluruh kolom nilai, rata-rata, predikat, dan ketuntasan tertata rapi tanpa terpotong batas kertas.</li>
                    <li><strong>Blok Tanda Tangan Cerdas:</strong>
                        <br>Di sebelah kanan: <em>Guru Mata Pelajaran</em> atau <em>Wali Kelas</em>.
                        <br>Di sebelah kiri: Mengetahui <strong>Kepala Madrasah</strong> (jika MI, MTs, MA) atau <strong>Kepala Sekolah</strong> (jika SD, SMP, SMA) lengkap dengan Nama Lengkap dan NIP/NUPTK.
                    </li>
                </ul>
            </li>
            <li>Pilih printer fisik atau simpan sebagai dokumen <strong>PDF</strong> berkualitas tinggi.</li>
        </ol>

        <hr>
        <h3><i class="fas fa-file-excel text-success"></i> Ekspor Data ke Excel</h3>
        <p>
            Untuk keperluan arsip kurikulum atau input nilai ke aplikasi eksternal (seperti Rapor Digital Madrasah / RDM atau e-Rapor Kemendikbud):
        </p>
        <ol class="step-list">
            <li>Klik tombol <code class="inline"><i class="fas fa-file-excel"></i> Ekspor Excel</code>.</li>
            <li>Sistem akan men-generate file spreadsheet (<code class="inline">.xlsx</code>) yang berisi tabel rekapitulasi semester lengkap beserta formula perhitungan rata-rata dan keterangannya.</li>
        </ol>
    </div>`
};
