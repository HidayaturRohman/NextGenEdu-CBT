if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['tarik-nilai-cbt'] = {
    title: 'Tarik Nilai CBT ke Rapor',
    desc: 'Panduan otomatisasi integrasi dan penarikan nilai ujian CBT langsung ke kolom nilai Asesmen Rapor (PTS/STS & SAS/PAS) tanpa perlu input manual.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-sync-alt text-primary"></i> Otomatisasi Tarik Nilai CBT ke Rapor</h2>
        <p>Fitur <strong>Tarik Nilai CBT</strong> adalah salah satu keunggulan utama <strong>NextGen Garuda CBT Versi 1.5</strong> yang menjembatani modul ujian online dengan modul buku rapor. Dengan fitur ini, Guru Pengampu Mapel dan Wali Kelas tidak perlu lagi menyalin atau menginput ulang nilai siswa dari pelaksanaan ujian CBT ke lembar penilaian rapor secara manual.</p>

        <div class="alert-box alert-success mb-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-magic fa-2x me-3"></i>
                <div>
                    <strong>Sekali Klik, Nilai Langsung Masuk:</strong>
                    <div>Nilai hasil ujian siswa yang sudah tersimpan di modul CBT (termasuk hasil koreksi esai dan soal AKM kompleks) dapat langsung ditarik ke penilaian Sumatif Tengah Semester (PTS/STS) atau Sumatif Akhir Semester (SAS/PAS) hanya dengan memilih jadwal ujian terkait.</div>
                </div>
            </div>
        </div>

        <div class="screenshot-placeholder">
            <i class="fas fa-laptop-code"></i>
            <p>Antarmuka Penarikan Nilai CBT ke Lembar Nilai Rapor (Menu Rapor Nilai &gt; Tarik Nilai CBT)</p>
        </div>

        <h3><i class="fas fa-route text-info"></i> Lokasi &amp; Akses Menu</h3>
        <p>Fitur Tarik Nilai CBT dapat diakses melalui dua jalur berikut:</p>
        <ul class="step-list">
            <li><strong>Jalur Guru Mapel:</strong> Buka menu <code class="inline">Penilaian</code> &gt; pilih <code class="inline">Input Nilai PTS</code> atau <code class="inline">Input Nilai SAS</code> &gt; pilih Kelas dan Mata Pelajaran yang diampu &gt; klik tombol biru <code class="inline"><i class="fas fa-download"></i> Tarik Nilai CBT</code> di bagian atas tabel penilaian.</li>
            <li><strong>Jalur API / URL Langsung:</strong> Sistem mengeksekusi endpoint <code class="inline">/rapor/tariknilaicbt</code> dengan pengiriman token dan ID Jadwal Ujian secara aman.</li>
        </ul>

        <h3><i class="fas fa-list-ol text-warning"></i> Alur Kerja Penarikan Nilai CBT</h3>
        <ol class="step-list">
            <li><strong>Pastikan Ujian CBT Selesai &amp; Dikoreksi:</strong>
                <p>Sebelum menarik nilai, pastikan siswa telah menyelesaikan ujian pada jadwal terkait. Jika bank soal memiliki butir soal tipe Esai atau Uraian, pastikan Guru telah melakukan koreksi nilai melalui menu <code class="inline">Pelaksanaan Ujian</code> &gt; <code class="inline">Koreksi</code> agar total skor siswa sudah 100% final.</p>
            </li>
            <li><strong>Buka Lembar Penilaian Rapor:</strong>
                <p>Masuk ke menu <code class="inline">Input Nilai PTS</code> (jika untuk nilai tengah semester) atau <code class="inline">Input Nilai SAS</code> (jika untuk nilai akhir semester). Tentukan Kelas serta Mata Pelajaran yang sesuai.</p>
            </li>
            <li><strong>Klik Tombol "Tarik Nilai CBT":</strong>
                <p>Klik tombol <code class="inline">Tarik Nilai CBT</code>. Modal dialog interaktif akan muncul menampilkan daftar seluruh jadwal ujian CBT yang terdaftar untuk kelas dan mata pelajaran tersebut pada tahun pelajaran serta semester aktif.</p>
            </li>
            <li><strong>Pilih Jadwal Ujian Sumber:</strong>
                <p>Pilih jadwal ujian yang ingin dijadikan acuan nilai rapor. Modal akan menampilkan informasi kode bank soal, jenis ujian (misal: PTS, STS, PAS, SAS, USBK), tanggal ujian, dan jumlah siswa yang telah berstatus selesai.</p>
            </li>
            <li><strong>Konfirmasi Pengisian Nilai:</strong>
                <p>Pilih opsi target kolom (apakah masuk sebagai nilai asesmen utama atau nilai sumatif per TP), lalu klik <strong>Terapkan Nilai</strong>. Nilai seluruh siswa di kelas tersebut akan terisi secara otomatis tanpa mengganti data siswa yang tidak mengikuti ujian.</p>
            </li>
            <li><strong>Simpan Lembar Penilaian:</strong>
                <p>Periksa kembali kelengkapan nilai, kemudian klik tombol hijau <code class="inline"><i class="fas fa-save"></i> Simpan Nilai</code>. Sistem otomatis mengkalkulasi Capaian Kompetensi tertinggi dan terendah untuk deskripsi rapor.</p>
            </li>
        </ol>

        <div class="alert-box alert-warning mt-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
                <div>
                    <strong>Catatan Penting Sinkronisasi:</strong>
                    <div>Jika terdapat siswa susulan yang baru mengerjakan CBT belakangan, Guru cukup menekan kembali tombol <code class="inline">Tarik Nilai CBT</code> pada kelas tersebut; sistem akan melakukan pembaharuan data (update) nilai secara cerdas tanpa menghapus nilai siswa lainnya yang sudah ada.</div>
                </div>
            </div>
        </div>
    </div>
    `
};
