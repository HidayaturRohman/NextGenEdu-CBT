if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['perpustakaan'] = {
    title: 'Perpustakaan Digital',
    desc: 'Mengelola perpustakaan digital e-learning.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-book"></i> Perpustakaan Digital</h2>
        <p>Perpustakaan Digital menyediakan fitur untuk mengelola buku dan referensi digital dalam sistem e-learning.</p>

        <div class="screenshot-placeholder">
            <i class="fas fa-image"></i>
            <p>Screenshot akan ditambahkan di sini</p>
        </div>

        <h3>Menambah Buku Digital</h3>
        <ol class="step-list">
            <li>Buka menu <code class="inline">E-Learning > Data E-Learning > Perpustakaan Digital</code></li>
            <li>Klik tombol <code class="inline">Tambah Buku</code></li>
            <li>Isi data buku:
                <ul style="margin-top:8px">
                    <li><strong>Judul</strong> — judul buku</li>
                    <li><strong>Penulis</strong> — nama penulis</li>
                    <li><strong>Kategori</strong> — kategori buku</li>
                    <li><strong>Deskripsi</strong> — deskripsi buku</li>
                    <li><strong>File</strong> — upload file buku (PDF)</li>
                    <li><strong>Cover</strong> — upload gambar cover</li>
                </ul>
            </li>
            <li>Klik <code class="inline">Simpan</code></li>
        </ol>

        <h3>Fitur Perpustakaan</h3>
        <ul>
            <li><strong>Pencarian</strong> — cari buku berdasarkan judul atau penulis</li>
            <li><strong>Kategori</strong> — filter berdasarkan kategori</li>
            <li><strong>Download</strong> — download buku untuk dibaca offline</li>
            <li><strong>Reading History</strong> — riwayat bacaan siswa</li>
        </ul>

        <div class="info-box tip">
            <i class="fas fa-lightbulb"></i>
            <div>Gunakan Perpustakaan Digital untuk menyediakan referensi tambahan bagi siswa dalam proses pembelajaran.</div>
        </div>
    </div>`
};
