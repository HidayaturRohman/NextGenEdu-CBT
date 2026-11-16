if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['absensi'] = {
    title: 'Presensi Siswa KBM',
    desc: 'Panduan pencatatan kehadiran siswa dalam kegiatan belajar mengajar harian, sinkronisasi presensi QR, dan rekapitulasi kehadiran di NextGen Garuda CBT Versi 1.5.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-clipboard-check text-primary"></i> Presensi Kehadiran Siswa KBM</h2>
        <p>Pencatatan presensi siswa di <strong>NextGen Garuda CBT Versi 1.5</strong> terbagi menjadi dua level integrasi: <strong>Presensi Tatap Muka KBM</strong> per jam pelajaran guru, serta <strong>Presensi Gerbang / Harian Siswa</strong> menggunakan sistem Scan QR Code kamera HP.</p>

        <div class="alert-box alert-success mb-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-qrcode fa-2x me-3"></i>
                <div>
                    <strong>Modul Khusus Presensi Scan QR:</strong>
                    <div>Untuk panduan lengkap pencetakan kartu siswa ber-QR, pemindaian kamera siswa mandiri, dan integrasi otomatis ke buku rapor, silakan buka menu <strong>Presensi Scan QR &amp; Kamera Siswa</strong>.</div>
                </div>
            </div>
        </div>

        <div class="screenshot-placeholder">
            <i class="fas fa-user-check"></i>
            <p>Lembar Presensi Siswa Tatap Muka KBM (/elearning/harian &amp; /presensi/harian)</p>
        </div>

        <h3><i class="fas fa-list-ol text-info"></i> Langkah Pengisian Presensi KBM oleh Guru Mapel</h3>
        <ol class="step-list">
            <li>Buka menu <code class="inline">Presensi Siswa</code> &gt; pilih <code class="inline">Presensi Harian</code>.</li>
            <li>Pilih Rombel Kelas dan Jam Pelajaran yang sedang berlangsung.</li>
            <li>Secara default seluruh siswa tercentang berstatus <strong>Hadir (H)</strong>.</li>
            <li>Ubah status siswa yang berhalangan menjadi <strong>Sakit (S)</strong>, <strong>Izin (I)</strong>, atau <strong>Alpa (A)</strong>.</li>
            <li>Klik tombol hijau <code class="inline"><i class="fas fa-save"></i> Simpan Kehadiran</code>.</li>
        </ol>

        <h3><i class="fas fa-sync text-warning"></i> Sinkronisasi ke Buku Rapor</h3>
        <p>Seluruh akumulasi ketidakhadiran (S, I, A) selama satu semester akan terkumpul otomatis dan dapat ditarik langsung oleh Wali Kelas pada lembar <em>Kehadiran &amp; Catatan Rapor</em> tanpa perlu penghitungan manual di buku absensi kertas.</p>
    </div>
    `
};
