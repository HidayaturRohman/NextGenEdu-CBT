if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['patch-version'] = {
    title: 'Patch Database & Auto-Migrator',
    desc: 'Panduan pembaruan sistem berkala, auto-migrasi skema database, verifikasi izin tulis folder, dan instalasi berkas patch di NextGen Garuda CBT Versi 1.5.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-wrench text-primary"></i> Patch Database &amp; Auto-Migrator Sistem</h2>
        <p>Menu <strong>Patch &amp; Versi Sistem</strong> (<code class="inline">/patch</code>) adalah modul pemeliharaan tingkat lanjut bagi Administrator untuk memperbarui sistem, menjalankan migrasi skema database otomatis, serta memantau riwayat pembaruan tanpa perlu menjalankan perintah terminal secara manual.</p>

        <div class="alert-box alert-success mb-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle fa-2x me-3"></i>
                <div>
                    <strong>Pembaruan Tanpa Rasa Khawatir:</strong>
                    <div>Setiap kali patch baru dipasang, modul Patch secara otomatis membuat cadangan snapshot (backup .zip) dari file inti dan mencatat log eksekusi di tabel riwayat. Jika diperlukan, sistem dapat di-rollback ke versi sebelumnya dengan aman.</div>
                </div>
            </div>
        </div>

        <div class="screenshot-placeholder">
            <i class="fas fa-history"></i>
            <p>Dasbor Patch &amp; Auto-Migrator Sistem Administrator (/patch)</p>
        </div>

        <h3><i class="fas fa-shield-alt text-info"></i> Pemeriksaan Izin Tulis Direktori (Folder Permissions)</h3>
        <p>Sebelum menerapkan berkas pembaruan, sistem melakukan diagnosis real-time terhadap direktori inti server:</p>
        <table class="table-custom">
            <thead>
                <tr>
                    <th>Direktori Target</th>
                    <th>Fungsi</th>
                    <th>Status Normal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><code class="inline">app/</code> (<code class="inline">APPPATH</code>)</td>
                    <td>Pembaruan Controller, Model, Helper, dan Router sistem</td>
                    <td><span class="badge bg-success">Writable (Bisa Ditulis)</span></td>
                </tr>
                <tr>
                    <td><code class="inline">public/</code> (<code class="inline">FCPATH</code>)</td>
                    <td>Aset CSS, JavaScript, Dokumentasi, Font, dan Gambar</td>
                    <td><span class="badge bg-success">Writable (Bisa Ditulis)</span></td>
                </tr>
                <tr>
                    <td><code class="inline">writable/</code> (<code class="inline">WRITEPATH</code>)</td>
                    <td>Penyimpanan file cache, log sistem, sesi login, dan unduhan</td>
                    <td><span class="badge bg-success">Writable (Bisa Ditulis)</span></td>
                </tr>
                <tr>
                    <td><code class="inline">writable/patches/backups/</code></td>
                    <td>Penyimpanan arsip snapshot otomatis sebelum migrasi</td>
                    <td><span class="badge bg-success">Writable (Bisa Ditulis)</span></td>
                </tr>
            </tbody>
        </table>

        <h3><i class="fas fa-upload text-warning"></i> Langkah Menerapkan Patch Pembaruan (.zip)</h3>
        <ol class="step-list">
            <li><strong>Dapatkan Berkas Patch Resmi:</strong> Unduh berkas patch resmi berformat <code class="inline">.zip</code> (misal: <code class="inline">patch_nextgen_v1.5_update.zip</code>).</li>
            <li><strong>Buka Menu Patch:</strong> Login sebagai Administrator &gt; buka URL <code class="inline">/patch</code>.</li>
            <li><strong>Unggah File Patch:</strong> Pada panel <em>Upload Berkas Patch</em>, pilih berkas <code class="inline">.zip</code> yang telah diunduh.</li>
            <li><strong>Klik Jalankan Patch &amp; Migrasi:</strong> Sistem mengekstrak berkas, memvalidasi integritas struktur file, memperbarui skema kolom database bila ada fitur baru, dan menyimpan riwayat di tabel <code class="inline">cbt_patch_history</code>.</li>
            <li><strong>Verifikasi Sukses:</strong> Notifikasi hijau akan muncul menandakan pembaruan berhasil diterapkan 100% dan versi aplikasi telah diperbarui.</li>
        </ol>
    </div>
    `
};
