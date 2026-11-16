if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['upload-banner'] = {
    title: 'Upload Banner Slider Siswa',
    desc: 'Panduan mengelola banner slider pengumuman bergambar pada beranda aplikasi siswa (Shopee / E-commerce style).',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-images"></i> Manajemen Banner Slider Siswa</h2>
        <p>
            Menu <strong>Upload Banner</strong> (<code class="inline">/banner</code>) memungkinkan Administrator 
            menampilkan spanduk/banner promosi, pengumuman penting, jadwal kegiatan sekolah/madrasah, atau 
            motivasi belajar dalam bentuk korsel bergambar (<em>image slider carousel</em>) modern pada halaman 
            beranda siswa (Shopee/SeaBank style).
        </p>

        <div class="info-box tip">
            <i class="fas fa-mobile-alt"></i>
            <div>
                <strong>Tampilan Interaktif di Aplikasi Siswa:</strong> Banner yang aktif akan otomatis bergeser (autoplay) 
                setiap 4-5 detik di smartphone siswa, memberikan nuansa aplikasi modern yang menarik dan informatif bagi generasi digital.
            </div>
        </div>

        <hr>
        <h3><i class="fas fa-plus-circle text-primary"></i> Menambah Banner Baru</h3>
        <ol class="step-list">
            <li>Buka menu <code class="inline">Data Umum > Upload Banner</code> (atau akses URL <code class="inline">/banner</code>).</li>
            <li>Klik tombol <code class="inline btn-primary"><i class="fas fa-plus"></i> Tambah Banner</code>.</li>
            <li>Isi formulir banner:
                <ul class="step-list">
                    <li><strong>Judul Banner:</strong> Keterangan singkat banner (contoh: <em>Jadwal Asesmen Sumatif Akhir Semester 2026/2027</em>).</li>
                    <li><strong>Pilih Berkas Gambar:</strong> Unggah gambar berformat JPG, PNG, atau WebP.</li>
                    <li><strong>Ukuran yang Disarankan:</strong> Resolusi <strong>1200 x 500 piksel</strong> (aspek rasio 12:5 atau 16:9) dengan ukuran file di bawah 500 KB agar cepat dimuat di HP siswa.</li>
                    <li><strong>Tautan / Link (Opsional):</strong> Masukkan link tujuan jika siswa mengklik banner tersebut.</li>
                    <li><strong>Status:</strong> Pilih <code>Aktif</code> agar langsung tampil di beranda siswa.</li>
                </ul>
            </li>
            <li>Klik tombol <code class="inline btn-success"><i class="fas fa-save"></i> Simpan Banner</code>.</li>
        </ol>

        <hr>
        <h3><i class="fas fa-toggle-on text-success"></i> Mengatur Status & Menghapus Banner</h3>
        <table class="table-custom">
            <thead>
                <tr>
                    <th style="width: 25%;">Tindakan</th>
                    <th style="width: 75%;">Keterangan & Cara Kerja</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Toggle Aktif / Nonaktif</strong></td>
                    <td>Klik tombol status (Aktif/Nonaktif) pada tabel banner. Banner yang dinonaktifkan tidak akan muncul di layar siswa tanpa perlu dihapus dari database.</td>
                </tr>
                <tr>
                    <td><strong>Hapus Banner</strong></td>
                    <td>Klik tombol tempat sampah merah <i class="fas fa-trash text-danger"></i> untuk menghapus banner secara permanen beserta berkas gambarnya di server.</td>
                </tr>
            </tbody>
        </table>

        <div class="info-box info">
            <i class="fas fa-lightbulb"></i>
            <div>
                <strong>Tips Kinerja:</strong> Gunakan menu <strong>Image Converter WebP</strong> pada NextGen Garuda CBT untuk mengompres banner sebelum diunggah agar loading beranda siswa tetap secepat kilat meskipun diakses ratusan siswa serentak.
            </div>
        </div>
    </div>`
};
