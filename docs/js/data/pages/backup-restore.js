if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['backup-restore'] = {
    title: 'Backup & Restore Database',
    desc: 'Panduan lengkap pencadangan berkala database MySQL, pengunduhan berkas .sql, dan pemulihan sistem (restore) di NextGen Garuda CBT Versi 1.5.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-database text-primary"></i> Backup &amp; Restore Database Sistem</h2>
        <p>Database adalah aset terpenting dalam penyelenggaraan CBT dan sistem rapor. Menu <strong>Backup Database</strong> (<code class="inline">/dbmanager</code>) memberikan perlindungan penuh bagi Administrator untuk mencadangkan seluruh data master, bank soal, jadwal, nilai, dan konfigurasi sistem ke dalam berkas arsip SQL terkompresi.</p>

        <div class="alert-box alert-success mb-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-cloud-download-alt fa-2x me-3"></i>
                <div>
                    <strong>Pencadangan Sekali Klik:</strong>
                    <div>Administrator dapat mengunduh salinan database utuh kapan pun dibutuhkan hanya dengan satu kali klik. Berkas hasil unduhan dapat disimpan di flashdisk, Google Drive, atau komputer lokal.</div>
                </div>
            </div>
        </div>

        <div class="screenshot-placeholder">
            <i class="fas fa-server"></i>
            <p>Halaman Backup &amp; Restore Database (/dbmanager)</p>
        </div>

        <h3><i class="fas fa-download text-info"></i> Prosedur Membuat Cadangan (Backup)</h3>
        <ol class="step-list">
            <li>Login sebagai Administrator.</li>
            <li>Buka menu <code class="inline">Pengaturan</code> &gt; <code class="inline">Database</code> &gt; klik <code class="inline">Backup</code> (<code class="inline">/dbmanager</code>).</li>
            <li>Klik tombol hijau <code class="inline"><i class="fas fa-database"></i> Buat Backup Sekarang</code>.</li>
            <li>Sistem akan melakukan dump database secara aman dan menampilkan berkas di daftar riwayat backup.</li>
            <li>Klik tombol <code class="inline"><i class="fas fa-download"></i> Unduh File</code> untuk menyimpan berkas <code class="inline">.sql</code> atau <code class="inline">.zip</code> ke perangkat Anda.</li>
        </ol>

        <h3><i class="fas fa-history text-warning"></i> Prosedur Pemulihan Data (Restore)</h3>
        <p>Gunakan fitur Restore jika server mengalami kerusakan data, setelah migrasi hosting, atau saat ingin mengembalikan data ke titik waktu tertentu:</p>
        <ol class="step-list">
            <li>Pada halaman yang sama, buka panel <em>Restore Database</em>.</li>
            <li>Pilih berkas cadangan dari tabel riwayat server atau klik <em>Upload File Cadangan</em> untuk memilih berkas <code class="inline">.sql</code> dari komputer Anda.</li>
            <li>Periksa peringatan sistem: proses restore akan menimpa data yang ada saat ini dengan data yang ada di dalam berkas cadangan.</li>
            <li>Klik <code class="inline">Konfirmasi &amp; Pulihkan Database</code>.</li>
            <li>Tunggu beberapa saat hingga proses injeksi query selesai 100%. Lakukan logout dan login kembali untuk menyegarkan sesi.</li>
        </ol>

        <div class="alert-box alert-danger mt-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
                <div>
                    <strong>Waktu Ideal Melakukan Backup:</strong>
                    <div>Sangat dianjurkan membuat backup rutin:
                    <br>&bull; Sesaat sebelum pelaksanaan ujian semester dimulai.
                    <br>&bull; Sesaat setelah seluruh ujian CBT selesai dan dikoreksi.
                    <br>&bull; Sesaat sebelum melakukan pembersihan data di menu <em>Data Manager</em>.
                    <br>&bull; Sebelum melakukan upgrade versi atau pemasangan patch sistem.
                    </div>
                </div>
            </div>
        </div>
    </div>
    `
};
