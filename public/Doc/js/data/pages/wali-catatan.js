if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['wali-catatan'] = {
    title: 'Portal Wali Kelas: Catatan & Pembinaan Siswa',
    desc: 'Panduan pencatatan perkembangan kepribadian, kedisiplinan, bimbingan konseling (BK), dan umpan balik wali kelas.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-clipboard-check"></i> Catatan & Pembinaan Karakter Siswa</h2>
        <p>
            Menu <strong>Catatan</strong> (<code class="inline">/walicatatan</code>) digunakan oleh Wali Kelas 
            untuk mendokumentasikan rekam jejak perilaku, pembinaan kedisiplinan, prestasi membanggakan, maupun kendala 
            belajar yang dialami siswa selama satu semester. 
            Catatan ini menjadi dasar evaluasi objektif saat rapat pleno kenaikan kelas atau kelulusan serta 
            menjadi bahan penyusunan <strong>Catatan Wali Kelas pada Lembar Buku Rapor</strong>.
        </p>

        <div class="info-box tip">
            <i class="fas fa-heart"></i>
            <div>
                <strong>Pendekatan Holistik:</strong> Sistem membagi catatan menjadi dua jenis: <strong>Catatan Kelas Umum</strong> (pengumuman & arahan untuk seluruh kelas) dan <strong>Catatan Personal Siswa</strong> (bimbingan privat dan perkembangan individual).
            </div>
        </div>

        <hr>
        <h3><i class="fas fa-user-edit text-primary"></i> Menambahkan Catatan Personal Siswa</h3>
        <ol class="step-list">
            <li>Buka menu <code class="inline">Wali Kelas > Catatan</code>.</li>
            <li>Pilih tab <strong>Catatan Siswa</strong>.</li>
            <li>Pilih nama siswa yang ingin diberikan catatan pembinaan.</li>
            <li>Isi formulir bimbingan:
                <ul class="step-list">
                    <li><strong>Tanggal Kejadian / Pembinaan:</strong> Tanggal saat pembinaan dilakukan.</li>
                    <li><strong>Jenis Catatan:</strong> Positif (Prestasi/Kebaikan), Netral (Informasi), atau Perhatian Khusus (Pelanggaran/Kedisiplinan).</li>
                    <li><strong>Uraian Catatan:</strong> Deskripsi lengkap kejadian, perilaku siswa, dan nasihat/tindak lanjut yang diberikan wali kelas.</li>
                    <li><strong>Tampilkan ke Orang Tua / Siswa:</strong> Pilih apakah catatan ini dapat dilihat oleh siswa di portalnya atau hanya untuk arsip internal guru & BK.</li>
                </ul>
            </li>
            <li>Klik tombol <code class="inline btn-success"><i class="fas fa-save"></i> Simpan Catatan</code>.</li>
        </ol>

        <hr>
        <h3><i class="fas fa-bullhorn text-warning"></i> Catatan Kelas Umum</h3>
        <p>
            Catatan kelas umum ditujukan untuk memotivasi seluruh siswa binaan:
        </p>
        <ul>
            <li>Peringatan persiapan asesmen semester / ujian CBT.</li>
            <li>Instruksi kebersihan dan pembagian jadwal piket kelas.</li>
            <li>Arahan pembinaan apel pagi atau kegiatan keagamaan sekolah/madrasah.</li>
        </ul>
        <p>Siswa dapat membaca catatan ini secara langsung pada menu <strong>Catatan</strong> di aplikasi siswa.</p>
    </div>`
};
