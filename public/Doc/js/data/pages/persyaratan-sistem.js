if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['persyaratan-sistem'] = {
    title: 'Persyaratan Sistem',
    desc: 'Spesifikasi minimum dan yang disarankan untuk menjalankan NextGen Garuda CBT Versi 1.5.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-desktop"></i> Persyaratan Perangkat Keras (Hardware)</h2>
        <div class="table-responsive">
            <table class="table-custom">
                <thead><tr><th style="width: 25%;">Komponen</th><th style="width: 35%;">Minimum (Uji Coba / Kecil)</th><th style="width: 40%;">Disarankan (Ujian Masal > 500 Siswa)</th></tr></thead>
                <tbody>
                    <tr><td><strong>Prosesor</strong></td><td>Dual-core 2.0 GHz</td><td>Quad-core / 8 vCPU 3.0 GHz atau lebih tinggi</td></tr>
                    <tr><td><strong>RAM</strong></td><td>4 GB</td><td>8 GB s/d 16 GB DDR4/DDR5</td></tr>
                    <tr><td><strong>Penyimpanan</strong></td><td>10 GB SSD</td><td>40 GB+ NVMe SSD (High IOPS untuk transaksi CBT)</td></tr>
                    <tr><td><strong>Jaringan / Bandwidth</strong></td><td>100 Mbps LAN</td><td>1 Gbps Gigabit LAN / 100 Mbps Dedicated Internet</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="content-card">
        <h2><i class="fas fa-server"></i> Persyaratan Perangkat Lunak (Server Environment)</h2>
        <div class="table-responsive">
            <table class="table-custom">
                <thead><tr><th>Komponen</th><th>Versi yang Didukung</th><th>Rekomendasi Produksi</th></tr></thead>
                <tbody>
                    <tr><td><strong>PHP Runtime</strong></td><td>PHP 8.2 s/d PHP 8.4</td><td><strong>PHP 8.3 (High Performance & Security)</strong></td></tr>
                    <tr><td><strong>Database Server</strong></td><td>MariaDB 10.4+ / MySQL 8.0+</td><td><strong>MariaDB 10.6+ / 10.11 LTS</strong></td></tr>
                    <tr><td><strong>Web Server</strong></td><td>Apache 2.4 (mod_rewrite aktif) / Nginx 1.20+</td><td><strong>Apache 2.4 / Nginx + PHP-FPM</strong></td></tr>
                    <tr><td><strong>Framework Engine</strong></td><td>CodeIgniter 4.7 Enterprise</td><td>Terintegrasi di dalam aplikasi</td></tr>
                </tbody>
            </table>
        </div>

        <h3 style="margin-top:20px"><i class="fas fa-puzzle-piece text-primary"></i> Ekstensi Wajib PHP</h3>
        <p>Ekstensi berikut wajib diaktifkan pada berkas konfigurasi <code class="inline">php.ini</code>:</p>
        <div class="table-responsive">
            <table class="table-custom">
                <thead><tr><th>Ekstensi</th><th>Fungsi Utama</th></tr></thead>
                <tbody>
                    <tr><td><code>intl</code></td><td>Standar wajib CodeIgniter 4 untuk lokalisasi, format angka, dan tanggal.</td></tr>
                    <tr><td><code>mbstring</code></td><td>Pemrosesan string multibyte dan karakter khusus.</td></tr>
                    <tr><td><code>gd (WebP enabled)</code></td><td>Pemrosesan gambar, foto siswa, logo kop, dan utilitas <strong>Image Converter WebP</strong>.</td></tr>
                    <tr><td><code>mysqli</code></td><td>Koneksi berkecepatan tinggi ke database MariaDB / MySQL.</td></tr>
                    <tr><td><code>curl</code></td><td>Komunikasi API, sinkronisasi token, dan update sistem.</td></tr>
                    <tr><td><code>zip</code></td><td>Ekspor/import data, backup database terkompresi, dan paket gambar ZIP.</td></tr>
                    <tr><td><code>json</code></td><td>Pertukaran data REST API internal dengan aplikasi Exambro Android.</td></tr>
                    <tr><td><code>fileinfo</code></td><td>Validasi keamanan MIME type berkas yang diunggah.</td></tr>
                </tbody>
            </table>
        </div>

        <div class="info-box tip" style="margin-top:16px;">
            <i class="fas fa-lightbulb"></i>
            <div>Pada server lokal berbasis <strong>Laragon</strong> atau VPS Linux (Ubuntu/Debian dengan Nginx), Anda dapat mengaktifkan ekstensi ini dengan mudah via menu PHP Extensions atau perintah <code>apt install php8.3-intl php8.3-gd php8.3-mbstring php8.3-curl php8.3-zip</code>.</div>
        </div>
    </div>

    <div class="content-card">
        <h2><i class="fas fa-sliders-h"></i> Rekomendasi Konfigurasi php.ini</h2>
        <p>Agar server stabil melayani ratusan koneksi siswa secara bersamaan tanpa kehabisan memori:</p>
        <div class="code-block">
            <span class="code-label">php.ini</span>
memory_limit = 512M
max_execution_time = 300
upload_max_filesize = 64M
post_max_size = 64M
max_input_vars = 5000
date.timezone = "Asia/Jakarta"
        </div>
    </div>`
};
