if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['wali-siswa'] = {
    title: 'Portal Wali Kelas: Data Siswa Binaan',
    desc: 'Panduan khusus wali kelas dalam mengelola, memverifikasi data, dan melengkapi dokumen siswa di kelas bimbingannya.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-users-cog"></i> Manajemen Siswa Binaan (Wali Kelas)</h2>
        <p>
            Menu <strong>Siswa</strong> pada kelompok Wali Kelas (<code class="inline">/walisiswa</code>) 
            disediakan khusus untuk Guru yang ditugaskan sebagai <strong>Wali Kelas</strong> pada tahun pelajaran aktif. 
            Modul ini memberikan kewenangan kepada wali kelas untuk mengawasi seluruh peserta didik di kelasnya, 
            memeriksa kelengkapan biodata, mengedit kontak darurat orang tua, serta mengunggah berkas pendukung siswa.
        </p>

        <div class="info-box tip">
            <i class="fas fa-user-check"></i>
            <div>
                <strong>Akses Khusus Wali Kelas:</strong> Menu ini hanya muncul secara otomatis pada akun Guru yang memiliki penugasan Wali Kelas di menu Data Guru oleh Administrator.
            </div>
        </div>

        <hr>
        <h3><i class="fas fa-list-alt text-primary"></i> Fitur & Informasi Siswa Binaan</h3>
        <p>Pada tabel siswa binaan, wali kelas dapat melihat:</p>
        <ul class="step-list">
            <li><strong>Foto Siswa:</strong> Foto profil resmi siswa untuk verifikasi identitas kartu peserta ujian.</li>
            <li><strong>NIS & NISN:</strong> Nomor Induk Siswa lokal dan Nomor Induk Siswa Nasional dari Kemendikbud/Kemenag.</li>
            <li><strong>Nama Lengkap & Jenis Kelamin:</strong> Identitas resmi sesuai Akta Kelahiran dan Kartu Keluarga (KK).</li>
            <li><strong>Nama Orang Tua / Wali:</strong> Data ayah, ibu, atau wali murid beserta nomor WhatsApp untuk komunikasi berkala.</li>
            <li><strong>Status Akun:</strong> Memantau apakah siswa sudah aktif, login, atau mengalami masalah akun.</li>
        </ul>

        <hr>
        <h3><i class="fas fa-edit text-success"></i> Memperbarui Biodata Siswa</h3>
        <ol class="step-list">
            <li>Buka menu <code class="inline">Wali Kelas > Siswa</code>.</li>
            <li>Klik tombol <code class="inline btn-info"><i class="fas fa-pencil-alt"></i> Edit</code> pada baris siswa yang bersangkutan.</li>
            <li>Perbarui data identitas siswa:
                <ul class="step-list">
                    <li>Data Pribadi (Tempat/Tanggal Lahir, Agama, Alamat Lengkap, RT/RW, Desa, Kecamatan).</li>
                    <li>Data Orang Tua (Nama Ayah/Ibu, Pekerjaan, Pendidikan Terakhir, Penghasilan, No. HP).</li>
                    <li>Data Periodik (Tinggi Badan, Berat Badan, Jarak ke Sekolah, Waktu Tempuh).</li>
                </ul>
            </li>
            <li><strong>Unggah Berkas Pendukung (Opsional):</strong> Wali kelas dapat mengunggah scan Kartu Keluarga (KK), Akta Kelahiran, atau KIP/PIP jika diperlukan sekolah/madrasah.</li>
            <li>Klik <code class="inline btn-success"><i class="fas fa-save"></i> Simpan Perubahan</code>.</li>
        </ol>

        <div class="info-box warning">
            <i class="fas fa-exclamation-triangle"></i>
            <div>
                <strong>Penting untuk Rapor:</strong> Ketepatan data tempat/tanggal lahir dan nama orang tua di halaman ini akan langsung tercetak pada <em>Halaman Identitas Buku Rapor Siswa</em>. Pastikan wali kelas memeriksa ejaan nama sebelum mencetak rapor!
            </div>
        </div>
    </div>`
};
