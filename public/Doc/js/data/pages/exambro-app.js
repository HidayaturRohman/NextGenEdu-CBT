if (typeof pageContents === 'undefined') var pageContents = {};

pageContents['exambro-app'] = {
    title: 'Aplikasi Siswa: NextGen Garuda Exambro v1.5',
    desc: 'Panduan lengkap aplikasi ujian anti-curang (Kiosk Mode Android, Anti-Split Screen, QR Scanner Login, dan Pengawasan Web Browser).',
    html: `
    <div class="content-card">
        <h2><i class="fas fa-shield-alt"></i> NextGen Garuda Exambro v1.5 (Android & Web)</h2>
        <p>
            <strong>NextGen Garuda Exambro v1.5</strong> adalah aplikasi peramban ujian aman (<em>Secure Exam Browser</em>) 
            yang dirancang khusus untuk memastikan integritas dan kejujuran pelaksanaan asesmen CBT di sekolah maupun madrasah. 
            Aplikasi ini mendukung dua ekosistem utama: <strong>Aplikasi Android Resmi (APK Kiosk Mode)</strong> untuk smartphone/tablet 
            dan <strong>Web Client Security Protection</strong> untuk perangkat PC/Laptop.
        </p>

        <div class="info-box tip">
            <i class="fas fa-check-circle"></i>
            <div>
                <strong>Versi Rilis Terbaru v1.5:</strong> Dilengkapi proteksi anti-layar belah (Anti-Split Screen), pemindai barcode/QR Code instan dari kartu peserta ujian, blokir floating window/bubble chat, dan verifikasi PIN keluar ujian oleh pengawas.
            </div>
        </div>

        <hr>
        <h3><i class="fab fa-android text-success"></i> Fitur Keamanan Exambro Android (Kiosk Mode)</h3>
        <p>Aplikasi Android NextGen Garuda Exambro v1.5 mengunci perangkat siswa ke dalam lingkungan terisolasi (Sandbox Kiosk) selama ujian berlangsung:</p>

        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th style="width: 25%;">Fitur Keamanan</th>
                        <th style="width: 45%;">Mekanisme Kerja</th>
                        <th style="width: 30%;">Tingkat Proteksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Kiosk Screen Lock-down</strong></td>
                        <td>Mematikan status bar, notification drawer, tombol navigasi fisik/virtual (Home, Back, dan Recent Apps). Siswa tidak bisa beralih ke aplikasi lain.</td>
                        <td><span class="badge badge-danger">Ketat / Wajib</span></td>
                    </tr>
                    <tr>
                        <td><strong>Anti Split-Screen & Pop-up</strong></td>
                        <td>Mendeteksi dan langsung membatalkan upaya membuka multi-window, mode layar belah, kalkulator mengambang, atau bubble chat (WhatsApp, Telegram, dll).</td>
                        <td><span class="badge badge-danger">Ketat / Wajib</span></td>
                    </tr>
                    <tr>
                        <td><strong>Anti Screenshot & Recording</strong></td>
                        <td>Mengaktifkan flag <code>FLAG_SECURE</code> pada sistem Android. Layar otomatis menjadi hitam jika siswa mencoba screenshot atau menggunakan screen recorder.</td>
                        <td><span class="badge badge-warning">Privasi & Anti Bocor</span></td>
                    </tr>
                    <tr>
                        <td><strong>Built-in QR Code Scanner</strong></td>
                        <td>Kamera bawaan langsung aktif saat aplikasi dibuka. Siswa cukup mengarahkan kamera ke QR Code pada Kartu Peserta untuk login otomatis tanpa mengetik manual.</td>
                        <td><span class="badge badge-success">Cepat & Akurat</span></td>
                    </tr>
                    <tr>
                        <td><strong>PIN Konfirmasi Keluar</strong></td>
                        <td>Siswa tidak dapat menutup aplikasi secara sepihak. Diperlukan 6-digit PIN Keluar yang hanya diketahui oleh Pengawas Ruang / Proktor CBT.</td>
                        <td><span class="badge badge-primary">Verifikasi Pengawas</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <hr>
        <h3><i class="fas fa-qrcode text-primary"></i> Alur Login Praktis via QR Scanner</h3>
        <p>Dengan fitur pemindai QR bawaan, proses masuk ruang ujian menjadi sangat cepat bahkan untuk ratusan siswa sekaligus:</p>
        <ol class="step-list">
            <li>
                <strong>Cetak Kartu Peserta Ujian:</strong>
                <p>Admin/Proktor mencetak kartu peserta dari menu <code class="inline">CBT > Pelaksanaan CBT > Cetak CBT</code>. Setiap kartu dilengkapi QR Code unik berisi kredensial login terenkripsi.</p>
            </li>
            <li>
                <strong>Buka Aplikasi Exambro di HP Siswa:</strong>
                <p>Siswa menyalakan HP dan membuka aplikasi <strong>NextGen Garuda Exambro</strong> (atau APK khusus madrasah/sekolah seperti <code>CBT-MADIN-ICT</code>).</p>
            </li>
            <li>
                <strong>Pindai QR Code Kartu:</strong>
                <p>Arahkan kamera ke QR Code di kartu ujian. Sistem akan membaca username & password, lalu melakukan autentikasi otomatis dalam hitungan detik tanpa risiko salah ketik.</p>
            </li>
            <li>
                <strong>Masukkan Token Ujian:</strong>
                <p>Siswa memasukkan 6-digit Token Ujian yang dirilis oleh Proktor/Pengawas dan ujian langsung dimulai.</p>
            </li>
        </ol>

        <hr>
        <h3><i class="fas fa-desktop text-info"></i> Proteksi Keamanan Web Browser (PC / Laptop)</h3>
        <p>Bagi sekolah/madrasah yang menyelenggarakan ujian di laboratorium komputer atau laptop siswa melalui web browser, NextGen Garuda CBT dilengkapi perlindungan berbasis JavaScript & DOM Event:</p>
        <ul class="step-list">
            <li>
                <strong>User Focus Monitoring (Deteksi Pindah Tab):</strong>
                <p>Sistem mendeteksi saat jendela browser kehilangan fokus (window blur / visibility change). Ketika siswa membuka tab baru, mencari jawaban di Google, atau membuka aplikasi lain, sistem mencatat pelanggaran.</p>
            </li>
            <li>
                <strong>Strike Violation System:</strong>
                <p>Setiap pelanggaran tab switch akan memunculkan modal peringatan keras di layar siswa. Jika jumlah pelanggaran melampaui batas maksimal yang ditentukan (default: 3 kali), ujian otomatis disubmit secara paksa (<em>Auto-submit</em>) dan akun siswa terkunci.</p>
            </li>
            <li>
                <strong>Blokir Klik Kanan & Shortcut Developer:</strong>
                <p>Mencegah klik kanan (Context Menu), tombol pintas salin-tempel (<kbd>Ctrl</kbd>+<kbd>C</kbd>, <kbd>Ctrl</kbd>+<kbd>V</kbd>), serta shortcut inspeksi kode (<kbd>F12</kbd>, <kbd>Ctrl</kbd>+<kbd>Shift</kbd>+<kbd>I</kbd>).</p>
            </li>
        </ul>

        <div class="info-box warning">
            <i class="fas fa-exclamation-triangle"></i>
            <div>
                <strong>Peringatan untuk Siswa:</strong> Jangan pernah mencoba meminimalkan browser atau menekan tombol <kbd>Alt</kbd>+<kbd>Tab</kbd> saat ujian berlangsung karena sistem audit log merekam setiap detik perpindahan fokus ke dalam Berita Acara Pelaksanaan Ujian!
            </div>
        </div>

        <hr>
        <h3><i class="fas fa-download text-primary"></i> Unduh File APK Android Exambro</h3>
        <p>File installer Android (.apk) dapat diunduh langsung dari server CBT masing-masing sekolah/madrasah pada folder unduhan publik:</p>
        
        <div class="p-3 my-3 border rounded bg-light" style="background: rgba(0, 201, 167, 0.05) !important; border-color: rgba(0, 201, 167, 0.3) !important;">
            <div class="d-flex align-items-center">
                <i class="fas fa-file-download fa-2x text-primary mr-3"></i>
                <div>
                    <h5 class="mb-1 font-weight-bold">Paket APK Resmi NextGen Garuda CBT v1.5</h5>
                    <p class="mb-0 text-muted" style="font-size: 13px;">Format: Android APK Standar (Android 7.0 Nougat s/d Android 15), Ukuran: ~4.5 MB</p>
                </div>
            </div>
            <div class="mt-3">
                <a href="../downloads/CBT-MADIN-ICT.apk" class="btn btn-sm btn-primary mr-2" download>
                    <i class="fas fa-download"></i> Unduh APK CBT-MADIN-ICT
                </a>
                <a href="../downloads/exambro.apk" class="btn btn-sm btn-outline-secondary" download>
                    <i class="fas fa-download"></i> Unduh Standar Garuda Exambro
                </a>
            </div>
        </div>

        <div class="info-box tip">
            <i class="fas fa-lightbulb"></i>
            <div>
                <strong>Tips Instalasi di HP Siswa:</strong> Aktifkan opsi <em>"Izinkan instalasi aplikasi dari sumber tidak dikenal" (Install from Unknown Sources)</em> pada menu Pengaturan Keamanan Android siswa sebelum menginstal file APK.
            </div>
        </div>
    </div>`
};
