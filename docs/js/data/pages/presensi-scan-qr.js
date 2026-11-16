if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['presensi-scan-qr'] = {
    title: 'Presensi Digital & Scan QR Code Siswa',
    desc: 'Panduan lengkap absensi cepat via Scan QR Code smartphone siswa, pemindaian kartu fisik, live presence monitor, dan sinkronisasi ke rapor.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-qrcode"></i> Presensi Digital & Scan QR Code</h2>
        <p>
            Modul <strong>Presensi Siswa</strong> (<code class="inline">/presensi</code>) di NextGen Garuda CBT Versi 1.5 
            menghadirkan sistem presensi digital nirsentuh (<em>contactless attendance</em>) berkecepatan tinggi. 
            Sistem ini mendukung dua metode pemindaian: 
            <strong>Pemindaian Mandiri oleh Siswa</strong> melalui tombol QR scanner di aplikasi mobile siswa (ShopeePay/SeaBank center bump button), 
            dan <strong>Pemindaian Kartu Siswa oleh Guru/Piket</strong> menggunakan barcode scanner USB atau kamera HP guru.
        </p>

        <div class="info-box tip">
            <i class="fas fa-bolt"></i>
            <div>
                <strong>Sinkronisasi 1-Klik ke Buku Rapor:</strong> Data rekapitulasi kehadiran (Hadir, Sakit, Izin, Alpa) dari modul Presensi dapat langsung disinkronkan ke dalam nilai absensi Buku Rapor Semester melalui tombol <code>Sinkron ke Rapor</code> tanpa perlu mengetik ulang satu per satu!
            </div>
        </div>

        <hr>
        <h3><i class="fas fa-camera text-primary"></i> 1. Metode Scan Mandiri (Smartphone Siswa)</h3>
        <p>Siswa melakukan absensi mandiri saat tiba di gerbang atau di ruang kelas:</p>
        <ol class="step-list">
            <li>Siswa membuka aplikasi <strong>NextGen Garuda CBT</strong> di smartphone mereka.</li>
            <li>Di bilah navigasi bawah (bottom navigation), tekan tombol lingkaran menonjol di tengah: <code class="inline"><i class="fas fa-qrcode"></i> Scan QR Absensi</code>.</li>
            <li>Kamera pemindai layar penuh (full-screen immersive scanner) akan aktif.</li>
            <li>Arahkan kamera ke <strong>QR Code Meja Kelas / QR Gate Harian</strong> yang dipasang oleh sekolah/madrasah.</li>
            <li>Sistem memvalidasi identitas, tanggal, dan jam kehadiran, lalu memunculkan suara notifikasi sukses dan status absensi langsung tercatat <strong>HADIR</strong>.</li>
        </ol>

        <hr>
        <h3><i class="fas fa-id-card text-success"></i> 2. Metode Scan Kartu Siswa (Oleh Guru / Petugas Piket)</h3>
        <p>Bagi siswa yang tidak membawa smartphone ke sekolah/madrasah:</p>
        <ol class="step-list">
            <li>Admin/Guru membuka menu <code class="inline">Presensi > Kartu Presensi</code> untuk mencetak <strong>Kartu Presensi Siswa</strong> yang memuat Barcode / QR Code unik per siswa.</li>
            <li>Pada pagi hari, petugas piket atau guru kelas membuka halaman <code class="inline">Presensi > Scan Kartu</code> di laptop/HP petugas.</li>
            <li>Siswa cukup menunjukkan kartu presensinya ke kamera laptop atau barcode scanner USB.</li>
            <li>Data kehadiran siswa seketika masuk ke database secara real-time.</li>
        </ol>

        <hr>
        <h3><i class="fas fa-sync-alt text-warning"></i> 3. Fitur "Sinkron ke Rapor" (Sync to Rapor)</h3>
        <p>Di akhir semester, wali kelas tidak perlu lagi menghitung manual jumlah absensi:</p>
        <ol class="step-list">
            <li>Buka menu <code class="inline">Presensi > Rekap Kehadiran</code>.</li>
            <li>Pilih kelas dan semester aktif.</li>
            <li>Klik tombol berwarna hijau <code class="inline btn-success"><i class="fas fa-sync"></i> Sinkron ke Rapor</code>.</li>
            <li>Sistem secara otomatis mentransfer jumlah akumulasi Sakit (S), Izin (I), dan Alpa (A) ke tabel penilaian rapor kelas tersebut dalam hitungan detik.</li>
        </ol>
    </div>`
};
