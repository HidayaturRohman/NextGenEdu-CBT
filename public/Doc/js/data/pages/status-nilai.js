if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['status-nilai'] = {
    title: 'Monitoring Status Nilai',
    desc: 'Panduan dasbor kontrol keterisian nilai seluruh mata pelajaran oleh Wali Kelas sebelum proses cetak rapor di NextGen Garuda CBT Versi 1.5.',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-chart-line text-info"></i> Monitoring Status Nilai Rapor Kelas Binaan</h2>
        <p>Halaman <strong>Status Nilai</strong> (<code class="inline">/rapor/statusnilai</code>) adalah dasbor monitoring khusus bagi <strong>Wali Kelas</strong> untuk memantau progres penginputan nilai rapor yang dilakukan oleh seluruh guru pengampu mata pelajaran di kelas binaannya secara real-time.</p>

        <div class="alert-box alert-success mb-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-double fa-2x me-3"></i>
                <div>
                    <strong>Kendali Penuh di Tangan Wali Kelas:</strong>
                    <div>Wali Kelas tidak perlu lagi menanyakan satu per satu kepada guru mapel mengenai status nilai. Cukup buka halaman ini, persentase keterisian nilai per mata pelajaran akan tampak dengan indikator warna yang jelas.</div>
                </div>
            </div>
        </div>

        <div class="screenshot-placeholder">
            <i class="fas fa-tasks"></i>
            <p>Dasbor Monitoring Keterisian Nilai Rapor Seluruh Guru Mapel (/rapor/statusnilai)</p>
        </div>

        <h3><i class="fas fa-traffic-light text-primary"></i> Indikator Status Keterisian Nilai</h3>
        <p>Tabel monitoring menampilkan daftar seluruh mata pelajaran beserta nama guru pengampu dan status persentase:</p>
        <table class="table-custom">
            <thead>
                <tr>
                    <th style="width: 20%;">Indikator Badge</th>
                    <th style="width: 30%;">Status Keterisian</th>
                    <th>Keterangan &amp; Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> Lengkap (100%)</span></td>
                    <td>Seluruh siswa di kelas telah memiliki nilai akhir rapor</td>
                    <td>Nilai aman dan siap untuk dicetak pada lembar rapor siswa dan leger nilai.</td>
                </tr>
                <tr>
                    <td><span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i> Belum Lengkap (&lt;100%)</span></td>
                    <td>Sebagian siswa telah dinilai, namun masih ada siswa yang kosong</td>
                    <td>Kemungkinan terdapat siswa susulan, remedial, atau belum selesai diinput oleh guru pengampu.</td>
                </tr>
                <tr>
                    <td><span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i> Belum Diisi (0%)</span></td>
                    <td>Belum ada satu pun nilai yang tersimpan di sistem</td>
                    <td>Wali Kelas dapat mengingatkan guru pengampu mapel bersangkutan agar segera menginput nilai atau menggunakan fitur <em>Tarik Nilai CBT</em>.</td>
                </tr>
            </tbody>
        </table>

        <h3><i class="fas fa-list-ol text-warning"></i> Alur Pengecekan oleh Wali Kelas</h3>
        <ol class="step-list">
            <li>Login sebagai Guru / Wali Kelas.</li>
            <li>Buka menu <code class="inline">Penilaian</code> &gt; pilih submenu <code class="inline">Input Wali Kelas</code> &gt; klik <code class="inline">Status Nilai</code>.</li>
            <li>Periksa baris demi baris mata pelajaran pada tabel. Pastikan seluruh mapel berstatus badge hijau <code class="inline">Lengkap (100%)</code>.</li>
            <li>Jika seluruh mapel telah tuntas, Wali Kelas dapat melanjutkan ke tahap pengisian <strong>Kokurikuler P5/P2RA</strong>, <strong>Prestasi Siswa</strong>, <strong>Kehadiran &amp; Catatan</strong>, dan <strong>Cetak Rapor</strong>.</li>
        </ol>
    </div>
    `
};
