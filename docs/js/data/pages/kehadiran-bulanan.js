if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['kehadiran-bulanan'] = {
    title: 'Kehadiran Bulanan & Leger Presensi Siswa',
    desc: 'Panduan lengkap rekapitulasi kehadiran bulanan siswa, matriks kalender tanggal 1-31, formula persentase, cetak leger landscape A4, dan ekspor excel.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-calendar-check"></i> Kehadiran Bulanan & Leger Presensi Siswa</h2>
        <p>
            Menu <strong>Kehadiran Bulanan</strong> pada NextGen Garuda CBT Versi 1.5 berfungsi untuk merekapitulasi 
            seluruh catatan absensi siswa selama satu bulan kalender secara utuh. 
            Modul ini menyajikan data presensi dalam bentuk <strong>Matriks Kalender Presensi (Tanggal 1 s/d 31)</strong>, 
            menghitung persentase kehadiran siswa secara otomatis, serta menyediakan fasilitas <strong>Cetak Leger Presensi Bulanan Resmi</strong> 
            untuk laporan ke Seksi Kesiswaan, Bimbingan Konseling (BK), dan Pimpinan Satuan Pendidikan.
        </p>

        <div class="info-box tip">
            <i class="fas fa-check-circle"></i>
            <div>
                <strong>Standar Cetak Dinas:</strong> Format cetak leger bulanan dirancang khusus dalam layout <strong>Landscape A4</strong> 
                dengan kop surat dinas resmi dan tanda tangan otomatis yang disesuaikan secara cerdas: <strong>Kepala Madrasah</strong> untuk jenjang Kemenag (MI/MTs/MA) 
                dan <strong>Kepala Sekolah</strong> untuk jenjang Dikdasmen (SD/SMP/SMA).
            </div>
        </div>

        <hr>
        <h3><i class="fas fa-search-plus text-primary"></i> Cara Mengakses & Memfilter Data</h3>
        <ol class="step-list">
            <li>Buka kelompok menu <code class="inline">Hasil E-Learning</code> pada sidebar navigasi.</li>
            <li>Klik submenu <code class="inline">Kehadiran Bulanan</code>.</li>
            <li>Gunakan kontrol filter di bagian atas halaman:
                <ul class="step-list">
                    <li><strong>Bulan:</strong> Pilih bulan yang ingin direkap (misal: Agustus).</li>
                    <li><strong>Tahun:</strong> Pilih tahun kalender aktif (misal: 2026).</li>
                    <li><strong>Kelas / Rombel:</strong> Pilih rombongan belajar (misal: Kelas VII-A atau Kelas X-MIPA 1).</li>
                    <li><strong>Mata Pelajaran (Opsional):</strong> Dapat difilter per mapel atau dilihat presensi umum kelas.</li>
                </ul>
            </li>
            <li>Klik tombol <code class="inline"><i class="fas fa-filter"></i> Tampilkan Presensi</code>.</li>
        </ol>

        <hr>
        <h3><i class="fas fa-table text-success"></i> Matriks Kalender Presensi (Tanggal 1 - 31)</h3>
        <p>
            Tabel presensi bulanan menyajikan kolom tanggal yang dinamis sesuai jumlah hari efektif pada bulan terpilih. 
            Setiap sel tanggal menampilkan status absensi siswa dengan visual badge berwarna:
        </p>

        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th style="width: 15%;">Kode Status</th>
                        <th style="width: 25%;">Arti Keterangan</th>
                        <th style="width: 60%;">Kriteria & Perilaku Sistem</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="badge badge-success p-2 font-weight-bold">H</span></td>
                        <td><strong>Hadir (Present)</strong></td>
                        <td>Siswa login ke sistem, mengakses materi KBM daring, atau diabsen Hadir secara manual oleh Guru/Wali Kelas.</td>
                    </tr>
                    <tr>
                        <td><span class="badge badge-warning p-2 font-weight-bold text-dark">S</span></td>
                        <td><strong>Sakit (Sick)</strong></td>
                        <td>Siswa berhalangan karena sakit yang dibuktikan dengan surat dokter atau konfirmasi orang tua kepada wali kelas.</td>
                    </tr>
                    <tr>
                        <td><span class="badge badge-info p-2 font-weight-bold">I</span></td>
                        <td><strong>Izin (Permitted)</strong></td>
                        <td>Siswa berhalangan hadir dengan alasan kepentingan keluarga/kegiatan resmi yang disetujui sekolah/madrasah.</td>
                    </tr>
                    <tr>
                        <td><span class="badge badge-danger p-2 font-weight-bold">A</span></td>
                        <td><strong>Alpa / Tanpa Keterangan</strong></td>
                        <td>Siswa tidak hadir dalam KBM daring tanpa adanya konfirmasi yang sah dari orang tua/wali.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <hr>
        <h3><i class="fas fa-calculator text-warning"></i> Kolom Rekapitulasi & Formula Persentase</h3>
        <p>Di sebelah kanan kolom kalender harian, sistem menyediakan 5 kolom rekapitulasi akumulasi:</p>
        <ul class="step-list">
            <li><strong>Total Hadir (H):</strong> Total kumulatif hari hadir siswa dalam bulan bersangkutan.</li>
            <li><strong>Total Sakit (S):</strong> Total kumulatif hari sakit.</li>
            <li><strong>Total Izin (I):</strong> Total kumulatif hari izin resmi.</li>
            <li><strong>Total Alpa (A):</strong> Total kumulatif hari tanpa keterangan.</li>
            <li>
                <strong>Persentase Kehadiran (% Hadir):</strong>
                <p>Dihitung secara presisi oleh sistem menggunakan formula standar pendidikan:</p>
                <div class="info-box info">
                    <i class="fas fa-square-root-alt"></i>
                    <div>
                        <strong>Rumus:</strong> <code>% Kehadiran = [ Total Hadir / (Total Hadir + Sakit + Izin + Alpa) ] &times; 100%</code>
                    </div>
                </div>
            </li>
        </ul>

        <div class="row">
            <div class="col-md-4 mb-2">
                <div class="p-2 border rounded text-center" style="background: rgba(40, 167, 69, 0.1);">
                    <strong class="text-success">&ge; 90% - 100%</strong>
                    <div style="font-size: 12px;">Sangat Baik / Sangat Disiplin</div>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="p-2 border rounded text-center" style="background: rgba(255, 193, 7, 0.15);">
                    <strong class="text-warning text-dark">75% - 89%</strong>
                    <div style="font-size: 12px;">Baik / Cukup Disiplin</div>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="p-2 border rounded text-center" style="background: rgba(220, 53, 69, 0.1);">
                    <strong class="text-danger">&lt; 75%</strong>
                    <div style="font-size: 12px;">Perlu Pembinaan BK / Wali Kelas</div>
                </div>
            </div>
        </div>

        <hr>
        <h3><i class="fas fa-print text-danger"></i> Cetak Leger Presensi Bulanan (Landscape A4)</h3>
        <p>Untuk mencetak berkas presensi fisik yang siap ditandatangani dan diarsipkan:</p>
        <ol class="step-list">
            <li>Klik tombol <code class="inline"><i class="fas fa-print"></i> Cetak Leger Presensi</code> di atas tabel.</li>
            <li>Sistem akan menyusun pratinjau cetak satu halaman penuh A4 Landscape:
                <ul class="step-list">
                    <li><strong>Kop Instansi Lengkap:</strong> Memuat logo pemerintah/kemenag dan logo sekolah/madrasah.</li>
                    <li><strong>Judul Dokumen:</strong> "LEGER DAFTAR KEHADIRAN SISWA BULAN [NAMA BULAN] [TAHUN]".</li>
                    <li><strong>Tabel Presensi Matriks:</strong> Font ukuran mikro proporsional (8pt) sehingga seluruh tanggal 1-31 dan kolom rekapitulasi muat sempurna tanpa margin terpotong.</li>
                    <li><strong>Tanda Tangan Pengesahan:</strong>
                        <br>- Sebelah Kanan: <em>Wali Kelas</em>.
                        <br>- Sebelah Kiri: Mengetahui <strong>Kepala Madrasah</strong> (pada MI/MTs/MA) atau <strong>Kepala Sekolah</strong> (pada SD/SMP/SMA).
                    </li>
                </ul>
            </li>
            <li>Klik tombol Print pada browser atau pilih "Save as PDF".</li>
        </ol>

        <hr>
        <h3><i class="fas fa-file-excel text-success"></i> Ekspor Excel Presensi Bulanan</h3>
        <p>Data presensi dapat diunduh dalam format Excel (<code class="inline">.xlsx</code>) untuk integrasi dengan database kesiswaan induk atau pelaporan EMIS/DAPODIK dengan mengklik tombol <code class="inline"><i class="fas fa-file-excel"></i> Ekspor Excel</code>.</p>
    </div>`
};
