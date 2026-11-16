if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['img-converter'] = {
    title: 'Image Converter & WebP Media Optimizer',
    desc: 'Utilitas kompresi massal gambar soal CBT ke format WebP super ringan untuk mencegah server down dan mempercepat loading ujian.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-file-image"></i> NextGen Image Converter & WebP Optimizer</h2>
        <p>
            Modul <strong>Image Converter</strong> (<code class="inline">/tools/image_converter</code>) adalah utilitas 
            khusus pada NextGen Garuda CBT Versi 1.5 yang berfungsi mengoptimalkan seluruh aset gambar pada Bank Soal dan Materi Pembelajaran. 
            Modul ini mengonversi gambar berukuran besar dari format standar (JPG, PNG, GIF, BMP) menjadi format modern berdaya kompresi tinggi: 
            <strong>WebP</strong>.
        </p>

        <div class="info-box danger">
            <i class="fas fa-exclamation-triangle"></i>
            <div>
                <strong>Tantangan Utama Server CBT:</strong> Gambar berformat JPG/PNG yang disalin dari Microsoft Word biasanya berukuran 1MB hingga 3MB per gambar. 
                Ketika 500 hingga 1.000 siswa membuka soal ujian secara bersamaan, server harus mentransfer ratusan Megabyte dalam hitungan detik. Hal inilah yang kerap menyebabkan 
                <em>Server Down, Loading Berputar Terus, atau Error 504 Gateway Timeout</em>!
            </div>
        </div>

        <div class="info-box tip">
            <i class="fas fa-bolt"></i>
            <div>
                <strong>Solusi Cerdas WebP:</strong> Format WebP mampu memangkas ukuran file gambar hingga <strong>70% s/d 85%</strong> 
                dengan kualitas visual yang tetap jernih dan tajam bagi mata manusia. Gambar 2.5 MB dapat menyusut drastis menjadi hanya <strong>~180 KB</strong>!
            </div>
        </div>

        <hr>
        <h3><i class="fas fa-cogs text-primary"></i> Fitur-Fitur Unggulan Converter</h3>
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th style="width: 25%;">Fitur</th>
                        <th style="width: 75%;">Penjelasan & Manfaat</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Batch Drag & Drop Upload</strong></td>
                        <td>Mendukung pemilihan banyak file sekaligus (hingga puluhan/ratusan gambar) cukup dengan menyeretnya (drag & drop) ke area dropzone.</td>
                    </tr>
                    <tr>
                        <td><strong>Slider Kualitas Kompresi</strong></td>
                        <td>Pengaturan persentase kualitas gambar (60% s/d 95%). Nilai rekomendasi adalah <strong>80%</strong> untuk keseimbangan optimal antara ukuran file mikro dan ketajaman teks/diagram.</td>
                    </tr>
                    <tr>
                        <td><strong>Live Before-After Comparison</strong></td>
                        <td>Menampilkan pratinjau berdampingan sebelum dan sesudah konversi, lengkap dengan rincian ukuran asli, ukuran hasil, dan persentase penghematan storage.</td>
                    </tr>
                    <tr>
                        <td><strong>Auto-Integrate Bank Soal</strong></td>
                        <td>Hasil konversi dapat langsung disimpan ke folder media CBT (<code class="inline">uploads/images/</code>) atau diunduh sebagai arsip ZIP.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <hr>
        <h3><i class="fas fa-list-ol text-success"></i> Langkah-Langkah Menggunakan Image Converter</h3>
        <ol class="step-list">
            <li>
                <strong>Buka Menu Converter:</strong>
                <p>Login sebagai Administrator, klik menu <code class="inline">Database</code> &gt; <code class="inline">Image Converter</code> (atau menu Utilitas).</p>
            </li>
            <li>
                <strong>Pilih atau Seret Gambar:</strong>
                <p>Klik tombol <strong>Pilih File Gambar</strong> atau seret file JPG/PNG dari komputer Anda ke dalam kotak upload yang tersedia.</p>
            </li>
            <li>
                <strong>Tentukan Level Kualitas (Quality Slider):</strong>
                <p>Geser slider kualitas ke angka <code>80%</code> (atau <code>85%</code> jika gambar memuat teks grafik yang sangat halus).</p>
            </li>
            <li>
                <strong>Klik Tombol "Konversi Semua":</strong>
                <p>Sistem akan memproses gambar satu per satu secara paralel dengan progress bar interaktif.</p>
            </li>
            <li>
                <strong>Unduh Hasil atau Simpan:</strong>
                <p>Klik tombol <code class="inline btn-primary"><i class="fas fa-download"></i> Unduh Semua (ZIP)</code> atau simpan langsung ke repositori media server CBT.</p>
            </li>
        </ol>

        <hr>
        <h3><i class="fas fa-check-double text-info"></i> Kompatibilitas Browser & Aplikasi Exambro</h3>
        <p>
            Format WebP didukung 100% secara native oleh seluruh platform NextGen Garuda CBT:
        </p>
        <ul>
            <li><strong>Aplikasi Android NextGen Exambro v1.5:</strong> Merender WebP secara instan dengan konsumsi RAM yang sangat rendah pada smartphone siswa.</li>
            <li><strong>Peramban Desktop:</strong> Google Chrome, Microsoft Edge, Mozilla Firefox, Safari, dan Opera.</li>
        </ul>
    </div>`
};
