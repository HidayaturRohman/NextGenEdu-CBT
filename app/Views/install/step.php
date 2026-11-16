<style>
:root {
    --primary-color: #6366f1;
    --primary-hover: #4f46e5;
    --success-color: #10b981;
    --danger-color: #dc3545;
    --danger-hover: #bb2d3b;
}

body#page-top {
    background-color: #f3f4f6;
    font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    color: #1f2937;
}

/* Slideshow Styles */
.slideshow-wrapper {
    position: relative;
    height: 100%;
    min-height: 600px;
    border-radius: 1rem;
    overflow: hidden;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2);
}

.slideshow-wrapper .carousel,
.slideshow-wrapper .carousel-inner,
.slideshow-wrapper .carousel-item {
    height: 100%;
}

.slideshow-wrapper .carousel-item img {
    object-fit: cover;
    width: 100%;
    height: 100%;
}

.slideshow-overlay {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: linear-gradient(135deg, rgba(99, 102, 241, 0.85) 0%, rgba(79, 70, 229, 0.85) 100%);
    z-index: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 2rem;
    text-align: center;
    color: #fff;
}

.slideshow-overlay .logo-circle {
    width: 100px;
    height: 100px;
    background: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
    box-shadow: 0 10px 25px rgba(0,0,0,0.25);
    padding: 8px;
}

.slideshow-overlay .logo-circle img {
    width: 82px;
    height: 82px;
    object-fit: contain;
}

.slideshow-overlay h1 {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}

.slideshow-overlay p {
    font-size: 0.95rem;
    opacity: 0.95;
    max-width: 320px;
    line-height: 1.6;
}

/* Card Styling */
.card-step {
    position: relative;
    border: none;
    border-radius: 1rem;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    background: #fff;
}

.card-header {
    background: #fff;
    border-bottom: 1px solid rgba(0,0,0,.05);
}

/* Form Controls */
.form-control {
    border-radius: 0.5rem;
    padding: 0.6rem 1rem;
    border: 1px solid #e5e7eb;
    transition: all 0.2s ease;
    background-color: #fff;
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
    background-color: #fff;
}

.form-label {
    font-weight: 600;
    color: #374151;
    font-size: 0.875rem;
    margin-bottom: 0.375rem;
}

/* Buttons */
.btn-primary-step {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    border-radius: 0.5rem;
    font-weight: 600;
    padding: 0.55rem 1.5rem;
    color: #fff;
    transition: all 0.2s;
}

.btn-primary-step:hover {
    background-color: var(--primary-hover);
    border-color: var(--primary-hover);
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.3);
}

.btn-prev {
    background-color: #6c757d;
    border-color: #6c757d;
    border-radius: 0.5rem;
    font-weight: 600;
    padding: 0.55rem 1.5rem;
    color: #fff;
    transition: all 0.2s;
}

.btn-prev:hover {
    background-color: #5a6268;
    color: #fff;
}

.btn-success-step {
    background-color: var(--success-color);
    border-color: var(--success-color);
    border-radius: 0.5rem;
    font-weight: 600;
    padding: 0.55rem 1.8rem;
    color: #fff;
}
.btn-success-step:hover {
    background-color: #059669;
    color: #fff;
}

/* Stepper Styles */
.stepper {
    padding: 0 1rem;
}

.stepper-line {
    height: 3px;
    background: #e5e7eb;
    top: 20px;
    left: 12%;
    right: 12%;
    width: 76%;
    z-index: 0;
}

.step {
    z-index: 1;
    cursor: pointer;
}

.step-circle {
    width: 42px;
    height: 42px;
    background: #fff;
    border: 2px solid #e5e7eb !important;
    color: #9ca3af;
    font-size: 1rem;
    font-weight: 700;
    transition: all 0.3s ease;
}

.step.current .step-circle {
    background: var(--primary-color);
    border-color: var(--primary-color) !important;
    color: #fff;
    box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.3);
    transform: scale(1.08);
}

.step.completed .step-circle {
    background: var(--success-color);
    border-color: var(--success-color) !important;
    color: #fff;
}

.step-label {
    color: #9ca3af;
    font-weight: 500;
    font-size: 0.8rem;
    transition: all 0.3s;
    margin-top: 0.5rem;
}

.step.current .step-label {
    color: var(--primary-color);
    font-weight: 700;
}

.step.completed .step-label {
    color: var(--success-color);
    font-weight: 600;
}

.step-content {
    display: none;
    animation: fadeIn 0.35s ease;
}

.step-content.active {
    display: block;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
}

.req-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 0.78rem;
    font-weight: 600;
    margin: 2px;
}
.req-badge.ok {
    background-color: #ecfdf5;
    color: #065f46;
    border: 1px solid #a7f3d0;
}
.req-badge.fail {
    background-color: #fef2f2;
    color: #991b1b;
    border: 1px solid #fecaca;
}
</style>

<section class="d-flex align-items-center py-4" style="background-color: #f3f4f6; min-height: 100vh;">
    <div class="container p-2 p-md-4">
        <div class="row">
            <!-- Left Side: Slideshow & Info -->
            <div class="col-lg-4 d-flex flex-column justify-content-center pt-3 pt-lg-0">
                <div class="slideshow-wrapper">
                    <div id="installCarousel" class="carousel slide" data-ride="carousel" data-interval="4000">
                        <div class="carousel-inner h-100">
                            <div class="carousel-item active h-100">
                                <img src="<?= base_url('assets/img/wall1.jpg') ?>" alt="Slide 1" onerror="this.src='<?= base_url('assets/img/login_bg.jpg') ?>'">
                            </div>
                            <div class="carousel-item h-100">
                                <img src="<?= base_url('assets/img/wall2.png') ?>" alt="Slide 2" onerror="this.src='<?= base_url('assets/img/login_bg.jpg') ?>'">
                            </div>
                            <div class="carousel-item h-100">
                                <img src="<?= base_url('assets/img/wall3.jpg') ?>" alt="Slide 3" onerror="this.src='<?= base_url('assets/img/login_bg.jpg') ?>'">
                            </div>
                        </div>
                    </div>
                    <!-- Overlay with Logo & Tagline -->
                    <div class="slideshow-overlay">
                        <div class="logo-circle">
                            <img src="<?= base_url('assets/img/logo_nextgen_garuda.png') ?>" alt="NextGen Garuda CBT" onerror="this.src='<?= base_url('assets/img/favicon.png') ?>'">
                        </div>
                        <h1>NextGen Garuda CBT</h1>
                        <p>Sistem Ujian CBT, E-Learning Tatap Muka & Presensi QR Code Modern Terpadu.</p>
                        
                        <div class="mt-3 text-start bg-white bg-opacity-25 p-2 rounded-3" style="font-size: 0.8rem; width: 100%;">
                            <div class="fw-bold mb-1"><i class="fas fa-check-circle me-1"></i> Status Server:</div>
                            <?php if (!empty($data->requirements)): ?>
                                <?php foreach ($data->requirements as $req): ?>
                                    <div class="d-flex justify-content-between py-1 border-bottom border-light border-opacity-25">
                                        <span><?= esc($req['name']) ?></span>
                                        <span class="badge <?= $req['status'] ? 'bg-success' : 'bg-danger' ?>">
                                            <?= $req['status'] ? 'OK' : 'Perlu Diaktifkan' ?>
                                        </span>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Wizard Steps Form Card -->
            <div class="col-lg-8 mt-4 mt-lg-0">
                <div class="card card-step shadow">
                    <div class="card-header p-4 pb-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold text-dark mb-0"><i class="fas fa-magic text-primary me-2"></i>Instalasi Aplikasi CBT</h5>
                            <span class="badge bg-soft-primary text-primary px-3 py-2 rounded-pill fw-bold">Step-by-Step Setup</span>
                        </div>

                        <!-- Stepper Indicators -->
                        <div class="stepper d-flex justify-content-between position-relative">
                            <div class="stepper-line position-absolute"></div>
                            
                            <div class="step d-flex flex-column align-items-center" data-step="1" onclick="jumpToStep(1)">
                                <div class="step-circle d-flex align-items-center justify-content-center rounded-circle">1</div>
                                <span class="step-label label">Database</span>
                            </div>
                            <div class="step d-flex flex-column align-items-center" data-step="2" onclick="jumpToStep(2)">
                                <div class="step-circle d-flex align-items-center justify-content-center rounded-circle">2</div>
                                <span class="step-label label">Admin</span>
                            </div>
                            <div class="step d-flex flex-column align-items-center" data-step="3" onclick="jumpToStep(3)">
                                <div class="step-circle d-flex align-items-center justify-content-center rounded-circle">3</div>
                                <span class="step-label label">Sekolah</span>
                            </div>
                            <div class="step d-flex flex-column align-items-center" data-step="4" onclick="jumpToStep(4)">
                                <div class="step-circle d-flex align-items-center justify-content-center rounded-circle">4</div>
                                <span class="step-label label">Selesai</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4 p-lg-5" style="background-color: #fafafa;">
                        <form id="form-installer" method="post" accept-charset="utf-8">
                            <?= csrf_field() ?>
                            
                            <!-- STEP 1: DATABASE -->
                            <div class="step-content" data-step="1">
                                <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                                    <h6 class="text-uppercase fw-bold text-primary mb-0"><i class="fas fa-database me-2"></i>Langkah 1: Konfigurasi Database</h6>
                                    <small class="text-muted">MySQL / MariaDB</small>
                                </div>
                                
                                <div class="alert alert-info border-0 rounded-3 shadow-sm d-flex align-items-center mb-4 py-2" role="alert">
                                    <i class="fas fa-info-circle me-2 fs-5"></i>
                                    <div style="font-size: 0.88rem;">
                                        Masukkan informasi database Anda. Database akan dibuat otomatis jika belum ada di server MySQL.
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <label for="input-nama-host" class="form-label">Host Name</label>
                                        <input type="text" class="form-control" id="input-nama-host" name="hostname" value="<?= esc($data->hostname ?? 'localhost') ?>" placeholder="localhost atau 127.0.0.1" required>
                                        <small class="form-text text-muted">Gunakan <code>localhost</code> untuk server lokal/cPanel.</small>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="input-port-host" class="form-label">Port</label>
                                        <input type="number" class="form-control" id="input-port-host" name="port" value="<?= esc($data->port ?? '3306') ?>" placeholder="3306">
                                        <small class="form-text text-muted">Standar MySQL: 3306.</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="input-user-host" class="form-label">Username Database</label>
                                        <input type="text" class="form-control" id="input-user-host" name="hostuser" value="<?= esc($data->username ?? 'root') ?>" placeholder="root" required>
                                        <small class="form-text text-muted">Username MySQL (di Laragon/XAMPP: <code>root</code>).</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="input-pass-host" class="form-label">Password Database</label>
                                        <input type="password" class="form-control" id="input-pass-host" value="<?= esc($data->password ?? '') ?>" name="hostpass" placeholder="Password Database">
                                        <small class="form-text text-muted">Kosongkan jika MySQL tidak memakai password.</small>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="input-nama-db" class="form-label">Nama Database</label>
                                        <input type="text" class="form-control" id="input-nama-db" name="database" value="<?= esc(!empty($data->database) ? $data->database : 'cbt_db') ?>" placeholder="cbt_db" required>
                                        <small class="form-text text-muted">Nama database yang ingin digunakan (tanpa spasi).</small>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                                    <button type="button" id="btn-test-db" class="btn btn-outline-primary fw-bold rounded-pill px-4">
                                        <i class="fas fa-plug me-1"></i> Tes & Buat Database
                                    </button>
                                    <button type="button" id="next1" class="btn btn-primary-step rounded-pill px-4">
                                        Selanjutnya &rarr;
                                    </button>
                                </div>
                            </div>

                            <!-- STEP 2: ADMINISTRATOR -->
                            <div class="step-content" data-step="2">
                                <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                                    <h6 class="text-uppercase fw-bold text-primary mb-0"><i class="fas fa-user-shield me-2"></i>Langkah 2: Setup Akun Administrator</h6>
                                    <small class="text-muted">Super Admin</small>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Lengkap Admin</label>
                                        <input type="text" name="nama_lengkap" id="input-nama-adm" placeholder="Nama Lengkap Administrator" value="<?= esc(!empty($data->nama_admin) ? $data->nama_admin : 'Administrator CBT') ?>" class="form-control adm" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Username Login</label>
                                        <input type="text" name="username" id="input-user" placeholder="admin" class="form-control adm" value="<?= esc(!empty($data->user_admin) ? $data->user_admin : 'admin') ?>" required>
                                        <small class="form-text text-muted">Digunakan untuk login ke panel admin.</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" id="input-pass" placeholder="Minimal 6 karakter" value="<?= esc($data->pass_admin ?? 'admin123') ?>" class="form-control adm" required>
                                        <small class="form-text text-muted">Minimal 6 karakter.</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Konfirmasi Password</label>
                                        <input type="password" id="input-rep-pass" class="form-control adm" value="<?= esc($data->pass_admin ?? 'admin123') ?>" placeholder="Ulangi Password" required>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                                    <button type="button" id="prev2" class="btn btn-prev rounded-pill px-4">&larr; Sebelumnya</button>
                                    <button type="button" id="next2" class="btn btn-primary-step rounded-pill px-4">Selanjutnya &rarr;</button>
                                </div>
                            </div>

                            <!-- STEP 3: PROFIL SEKOLAH -->
                            <div class="step-content" data-step="3">
                                <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                                    <h6 class="text-uppercase fw-bold text-primary mb-0"><i class="fas fa-school me-2"></i>Langkah 3: Profil Sekolah & Aplikasi</h6>
                                    <small class="text-muted">Data Identitas</small>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Aplikasi</label>
                                        <input type="text" id="input-nama-app" name="nama_aplikasi" placeholder="Contoh: NextGen Garuda CBT" class="form-control app" value="<?= esc($data->aplikasi ?? 'NextGen Garuda CBT') ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Sekolah / Lembaga Pendidikan</label>
                                        <input type="text" id="input-nama-skl" name="nama_sekolah" placeholder="Nama Resmi Sekolah / Lembaga" class="form-control app" value="<?= esc($data->sekolah ?? '') ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Jenjang</label>
                                        <select class="form-control app" id="input-jenjang" name="jenjang" required>
                                            <option value="" disabled <?= empty($data->jenjang) ? 'selected' : '' ?>>Pilih Jenjang</option>
                                            <option value="1" <?= ($data->jenjang ?? '') == '1' ? 'selected' : '' ?>>SD / MI</option>
                                            <option value="2" <?= ($data->jenjang ?? '') == '2' || empty($data->jenjang) ? 'selected' : '' ?>>SMP / MTs</option>
                                            <option value="3" <?= ($data->jenjang ?? '') == '3' ? 'selected' : '' ?>>SMA / MA / SMK</option>
                                            <option value="4" <?= ($data->jenjang ?? '') == '4' ? 'selected' : '' ?>>Lembaga / Kursus / Umum</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Satuan Pendidikan</label>
                                        <select class="form-control app" id="input-satuan" name="satuan" required>
                                            <option value="" disabled>Pilih Satuan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Kepala Sekolah / Pimpinan Lembaga</label>
                                        <input type="text" id="input-nama-kepsek" name="kepsek" placeholder="Nama Kepala Sekolah / Pimpinan beserta gelar" class="form-control app" value="<?= esc($data->kepsek ?? '') ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Alamat Lengkap</label>
                                        <input type="text" id="input-alamat" class="form-control app" placeholder="Jalan / RT / RW" name="alamat" value="<?= esc($data->alamat ?? '') ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Desa / Kelurahan</label>
                                        <input type="text" id="input-desa" name="desa" placeholder="Desa atau Kelurahan" class="form-control app" value="<?= esc($data->desa ?? '') ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Kecamatan</label>
                                        <input type="text" id="input-kec" name="kec" placeholder="Kecamatan" class="form-control app" value="<?= esc($data->kec ?? '') ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Kota / Kabupaten</label>
                                        <input type="text" id="input-kota" name="kota" placeholder="Kabupaten atau Kota" class="form-control app" value="<?= esc($data->kota ?? '') ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Provinsi</label>
                                        <input type="text" id="input-prov" name="prov" class="form-control" placeholder="Provinsi" value="<?= esc($data->prov ?? 'Jawa Timur') ?>">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                                    <button type="button" id="prev3" class="btn btn-prev rounded-pill px-4">&larr; Sebelumnya</button>
                                    <button type="button" id="next3" class="btn btn-primary-step rounded-pill px-4">Selanjutnya &rarr;</button>
                                </div>
                            </div>

                            <!-- STEP 4: KONFIRMASI & SELESAI -->
                            <div class="step-content" data-step="4">
                                <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                                    <h6 class="text-uppercase fw-bold text-success mb-0"><i class="fas fa-check-double me-2"></i>Langkah 4: Konfirmasi & Finalisasi</h6>
                                    <small class="text-muted">Siap Digunakan</small>
                                </div>

                                <div class="card bg-white border rounded-3 p-3 mb-3 shadow-sm">
                                    <table class="table table-sm table-borderless mb-0" style="font-size: 0.92rem;">
                                        <tbody>
                                            <tr><td class="text-muted fw-bold" style="width: 35%;">Database</td><td id="text-db" class="fw-bold text-dark">:</td></tr>
                                            <tr><td class="text-muted fw-bold">Nama Aplikasi</td><td id="text-app" class="fw-bold text-dark">:</td></tr>
                                            <tr><td class="text-muted fw-bold">Nama Sekolah</td><td id="text-skl" class="fw-bold text-dark">:</td></tr>
                                            <tr><td class="text-muted fw-bold">Kepala Sekolah</td><td id="text-kep" class="fw-bold text-dark">:</td></tr>
                                            <tr><td class="text-muted fw-bold">Jenjang / Satuan</td><td id="text-jen" class="fw-bold text-dark">:</td></tr>
                                            <tr><td class="text-muted fw-bold">Alamat</td><td id="text-alm" class="fw-bold text-dark">:</td></tr>
                                            <tr class="border-top"><td class="text-muted fw-bold">Nama Admin</td><td id="text-adm" class="fw-bold text-primary">:</td></tr>
                                            <tr><td class="text-muted fw-bold">Username Login</td><td id="text-usr" class="fw-bold text-primary">:</td></tr>
                                            <tr><td class="text-muted fw-bold">Password Login</td><td id="text-pass" class="fw-bold text-primary">:</td></tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                                    <button type="button" id="prev4" class="btn btn-prev rounded-pill px-4">&larr; Sebelumnya</button>
                                    <button type="button" id="btn-submit-install" class="btn btn-success-step rounded-pill shadow px-4">
                                        <i class="fas fa-save me-1"></i> Selesaikan Instalasi
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var dataInstall = <?= json_encode($data) ?>;
    var currentPage = dataInstall.current_page || 1;
    var satuanPend = [[], ["SD", "MI"], ["SMP", "MTs"], ["SMA", "MA", "SMK"], ["Lembaga", "Bimbel / Kursus", "Perguruan Tinggi", "Umum"]];
    var isDbReady = (currentPage > 1);

    $(document).ready(function () {
        // Init carousel
        if ($('#installCarousel').length) {
            $('#installCarousel').carousel({ interval: 4000, pause: "hover" });
        }

        // Init Satuan dropdown
        function updateSatuanDropdown(jenjangVal, selectedSatuan) {
            var htmlOptions = '<option value="" disabled>Pilih Satuan</option>';
            var satSelected = satuanPend[jenjangVal] || [];
            for (let i = 0; i < satSelected.length; i++) {
                var val = (i + 1);
                var isSel = (selectedSatuan == val) ? 'selected' : '';
                htmlOptions += '<option value="' + val + '" ' + isSel + '>' + satSelected[i] + '</option>';
            }
            $('#input-satuan').html(htmlOptions);
        }

        var initJenjang = $('#input-jenjang').val() || 2;
        updateSatuanDropdown(initJenjang, dataInstall.satuan || 2);

        $('#input-jenjang').change(function () {
            updateSatuanDropdown($(this).val(), null);
        });

        // Set initial page view
        switchPage(currentPage, false);

        // Tombol Tes & Buat Database
        $('#btn-test-db').click(function () {
            testAndSetupDb();
        });

        // Step 1: Next
        $('#next1').click(function () {
            if (isDbReady) {
                currentPage = 2;
                switchPage(currentPage, false);
            } else {
                testAndSetupDb(function () {
                    currentPage = 2;
                    switchPage(currentPage, false);
                });
            }
        });

        // Step 2: Administrator validation & Next
        $('#next2').click(function () {
            var namaAdm = $('#input-nama-adm').val().trim();
            var userAdm = $('#input-user').val().trim();
            var passAdm = $('#input-pass').val();
            var repPass = $('#input-rep-pass').val();

            if (!namaAdm || !userAdm || !passAdm) {
                Swal.fire('Error', 'Semua form administrator wajib diisi!', 'warning');
                return;
            }
            if (passAdm.length < 6) {
                Swal.fire('Error', 'Password minimal harus 6 karakter!', 'warning');
                return;
            }
            if (passAdm !== repPass) {
                Swal.fire('Error', 'Konfirmasi password tidak cocok!', 'warning');
                return;
            }

            $('.card-step').find('[data-step="2"]').addClass('completed');
            currentPage = 3;
            switchPage(currentPage, false);
        });

        $('#prev2').click(function () {
            currentPage = 1;
            switchPage(currentPage, true);
        });

        // Step 3: Sekolah validation & Next
        $('#next3').click(function () {
            var namaApp = $('#input-nama-app').val().trim();
            var namaSkl = $('#input-nama-skl').val().trim();
            var kepsek  = $('#input-nama-kepsek').val().trim();
            var alamat  = $('#input-alamat').val().trim();

            if (!namaApp || !namaSkl || !kepsek || !alamat) {
                Swal.fire('Error', 'Mohon lengkapi data profil sekolah yang bertanda wajib!', 'warning');
                return;
            }

            $('.card-step').find('[data-step="3"]').addClass('completed');
            currentPage = 4;
            switchPage(currentPage, false);
        });

        $('#prev3').click(function () {
            currentPage = 2;
            switchPage(currentPage, true);
        });

        $('#prev4').click(function () {
            currentPage = 3;
            switchPage(currentPage, true);
        });

        // Step 4: Selesaikan Instalasi
        $('#btn-submit-install').click(function () {
            Swal.fire({
                title: 'Menyimpan Instalasi...',
                text: 'Sistem sedang menyiapkan data konfigurasi dan akun administrator.',
                allowOutsideClick: false,
                didOpen: () => { Swal.showLoading(); }
            });

            var formData = $('#form-installer').serialize();

            $.ajax({
                url: base_url + 'install/createapp',
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function (res) {
                    Swal.close();
                    if (res.status === 'success') {
                        Swal.fire({
                            title: 'Instalasi Berhasil! 🎉',
                            html: '<div class="text-start p-2"><p>Aplikasi CBT berhasil dikonfigurasi dan siap digunakan.</p>' +
                                '<div class="bg-light p-3 rounded-3 border"><strong>Username:</strong> ' + $('#input-user').val() + '<br>' +
                                '<strong>Password:</strong> ' + $('#input-pass').val() + '</div><p class="mt-2 text-muted" style="font-size: 0.85rem;">Simpan informasi akun ini dengan baik.</p></div>',
                            icon: 'success',
                            confirmButtonColor: '#6366f1',
                            confirmButtonText: '<i class="fas fa-sign-in-alt me-1"></i> Buka Halaman Login'
                        }).then(function () {
                            window.location.href = res.redirect || (base_url + 'auth');
                        });
                    } else {
                        Swal.fire('Gagal Menyimpan', res.message || 'Terjadi kesalahan saat menyimpan data.', 'error');
                    }
                },
                error: function (xhr) {
                    Swal.close();
                    Swal.fire('Error', 'Gagal menghubungi server: ' + (xhr.statusText || 'Error'), 'error');
                }
            });
        });

        function testAndSetupDb(onSuccessCallback) {
            var host = $('#input-nama-host').val().trim();
            var port = $('#input-port-host').val().trim() || 3306;
            var user = $('#input-user-host').val().trim();
            var pass = $('#input-pass-host').val();
            var db   = $('#input-nama-db').val().trim();

            if (!host || !user || !db) {
                Swal.fire('Peringatan', 'Host Name, Username, dan Nama Database wajib diisi!', 'warning');
                return;
            }

            Swal.fire({
                title: 'Memeriksa Database...',
                html: '<div class="text-center py-2"><i class="fas fa-spinner fa-spin fa-2x text-primary mb-2"></i><div>Menghubungkan ke MySQL & mengimpor struktur tabel...</div></div>',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => { Swal.showLoading(); }
            });

            $.ajax({
                url: base_url + 'install/checkdatabase',
                method: 'POST',
                data: {
                    hostname: host,
                    port: port,
                    hostuser: user,
                    hostpass: pass,
                    database: db
                },
                dataType: 'json',
                success: function (res) {
                    Swal.close();
                    if (res.status) {
                        isDbReady = true;
                        $('.card-step').find('[data-step="1"]').addClass('completed');
                        Swal.fire({
                            title: 'Database Terhubung!',
                            text: res.message || 'Koneksi database berhasil.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        if (typeof onSuccessCallback === 'function') {
                            onSuccessCallback();
                        }
                    } else {
                        isDbReady = false;
                        Swal.fire('Gagal Menghubungkan', res.message || 'Gagal koneksi ke database.', 'error');
                    }
                },
                error: function (xhr) {
                    Swal.close();
                    Swal.fire('Koneksi Gagal', 'Server merespon error: ' + (xhr.statusText || 'Internal Server Error'), 'error');
                }
            });
        }
    });

    function jumpToStep(stepNum) {
        if (stepNum > 1 && !isDbReady) {
            Swal.fire('Perhatian', 'Harap selesaikan konfigurasi database terlebih dahulu pada Langkah 1.', 'info');
            return;
        }
        currentPage = stepNum;
        switchPage(currentPage, false);
    }

    function switchPage(page, back) {
        $('.step').removeClass('current');
        $('.card-step').find('[data-step="' + page + '"]').addClass('current');

        if (isDbReady && page > 1) {
            $('.card-step').find('[data-step="1"]').addClass('completed');
        }

        $('.step-content').removeClass('active');
        $('.card-step').find('.step-content[data-step="' + page + '"]').addClass('active');

        // Ringkasan Step 4
        if (page == 4) {
            $('#text-db').text(': ' + ($('#input-nama-db').val() || '-'));
            $('#text-app').text(': ' + ($('#input-nama-app').val() || '-'));
            $('#text-skl').text(': ' + ($('#input-nama-skl').val() || '-'));
            $('#text-kep').text(': ' + ($('#input-nama-kepsek').val() || '-'));
            $('#text-jen').text(': ' + ($('#input-jenjang option:selected').text() || '-') + ' (' + ($('#input-satuan option:selected').text() || '-') + ')');
            $('#text-alm').text(': ' + ($('#input-alamat').val() || '') + ', ' + ($('#input-desa').val() || '') + ', ' + ($('#input-kec').val() || '') + ', ' + ($('#input-kota').val() || ''));
            $('#text-adm').text(': ' + ($('#input-nama-adm').val() || '-'));
            $('#text-usr').text(': ' + ($('#input-user').val() || '-'));
            $('#text-pass').text(': ' + ($('#input-pass').val() || '-'));
        }
    }
</script>
