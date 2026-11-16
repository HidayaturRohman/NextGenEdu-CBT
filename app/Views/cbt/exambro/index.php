<?= $this->extend('layout/dashboard_template_bs5') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-sm-12">
        <!-- Header Banner -->
        <div class="card mb-4 border-0 shadow-sm" style="border-radius: 14px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3 flex-shrink-0">
                            <div class="rounded-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 58px; height: 58px; background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%); color: #ffffff;">
                                <i class="fas fa-shield-alt fa-2x"></i>
                            </div>
                        </div>
                        <div>
                            <h4 class="card-title mb-1 fw-bold text-dark d-flex align-items-center">
                                <?= $judul ?>
                            </h4>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                <?= $subjudul ?>
                            </p>
                        </div>
                    </div>
                    <div>
                        <a href="<?= base_url('cbtjadwal') ?>" class="btn btn-outline-primary d-inline-flex align-items-center gap-2 fw-semibold px-3 py-2" style="border-radius: 8px;">
                            <i class="far fa-calendar-alt"></i>
                            <span>Buka Jadwal Ujian</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Column: Form Setting -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                        <h6 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                            <i class="fas fa-sliders-h text-primary"></i>
                            <span>Konfigurasi Keamanan Browser & Aplikasi Ujian</span>
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        <form id="form-exambro">
                            <!-- Info Box -->
                            <div class="alert alert-info border-0 rounded-3 mb-4 p-3" style="background-color: #eff6ff; border-left: 4px solid #3b82f6 !important;">
                                <div class="d-flex align-items-start gap-2">
                                    <i class="fas fa-info-circle text-primary mt-1"></i>
                                    <div class="small text-dark">
                                        Aturan ini akan berlaku otomatis pada setiap <strong>Jadwal Ujian</strong> yang mengaktifkan opsi penguncian browser (Wajib Exambro, Hanya Android, atau Hanya PC). Siswa yang mengakses menggunakan Google Chrome, Mozilla Firefox, Safari, atau browser biasa akan langsung diblokir.
                                    </div>
                                </div>
                            </div>

                            <!-- User-Agent Android -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-dark mb-1">
                                    <i class="fab fa-android text-success me-1"></i> Tanda Pengenal (User-Agent) Exambro Android
                                </label>
                                <input type="text" class="form-control" name="agent_android" id="agent_android" 
                                       value="<?= esc($exambro->agent_android ?? 'Exambro,FlyExam,Candy,ExambroAndroid') ?>" 
                                       placeholder="Contoh: Exambro,FlyExam,Candy" required style="border-radius: 8px; height: 44px;">
                                <div class="form-text text-muted small mt-1">
                                    Pisahkan dengan tanda koma (<code>,</code>) jika ada beberapa aplikasi. Sistem akan mendeteksi apakah header browser mengandung salah satu kata kunci di atas.
                                </div>
                            </div>

                            <!-- User-Agent PC -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-dark mb-1">
                                    <i class="fas fa-desktop text-info me-1"></i> Tanda Pengenal (User-Agent) Exambro PC / Windows
                                </label>
                                <input type="text" class="form-control" name="agent_pc" id="agent_pc" 
                                       value="<?= esc($exambro->agent_pc ?? 'SEB,SafeExamBrowser,ExambroPC') ?>" 
                                       placeholder="Contoh: SEB,SafeExamBrowser,ExambroPC" required style="border-radius: 8px; height: 44px;">
                                <div class="form-text text-muted small mt-1">
                                    Contoh: <code>SEB</code> untuk Safe Exam Browser, atau nama Exambro Windows resmi sekolah Anda.
                                </div>
                            </div>

                            <hr class="my-4 text-muted opacity-25">

                            <!-- Link Download APK Android -->
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark mb-1">
                                    <i class="fas fa-link text-primary me-1"></i> Link Download APK Exambro Android Resmi (Untuk Siswa)
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fab fa-google-play text-muted"></i></span>
                                    <input type="url" class="form-control border-start-0" name="link_android" id="link_android" 
                                           value="<?= esc($exambro->link_android ?? '') ?>" 
                                           placeholder="https://drive.google.com/... atau link APK" style="border-radius: 0 8px 8px 0; height: 44px;">
                                </div>
                                <div class="form-text text-muted small mt-1">
                                    Tautan ini akan tampil sebagai tombol unduhan saat siswa diblokir di HP Android.
                                </div>
                            </div>

                            <!-- Link Download Exambro PC -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-dark mb-1">
                                    <i class="fas fa-link text-primary me-1"></i> Link Download Exambro PC / Windows (Untuk Siswa)
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fab fa-windows text-muted"></i></span>
                                    <input type="url" class="form-control border-start-0" name="link_pc" id="link_pc" 
                                           value="<?= esc($exambro->link_pc ?? '') ?>" 
                                           placeholder="https://drive.google.com/... atau link installer PC" style="border-radius: 0 8px 8px 0; height: 44px;">
                                </div>
                                <div class="form-text text-muted small mt-1">
                                    Tautan ini akan tampil sebagai tombol unduhan saat siswa diblokir di laptop/komputer PC.
                                </div>
                            </div>

                            <hr class="my-4 text-muted opacity-25">

                            <!-- Pesan Pemblokiran Kustom (Highlighted) -->
                            <div class="mb-4 p-3 rounded-3 bg-light border border-warning border-opacity-50">
                                <label class="form-label fw-bold text-dark mb-1 d-flex align-items-center justify-content-between">
                                    <span>
                                        <i class="fas fa-bullhorn text-danger me-1"></i> Pesan Peringatan Saat Siswa Diblokir
                                        <span class="badge bg-danger text-white ms-2 small">Wajib Tampil</span>
                                    </span>
                                    <small class="text-muted fw-normal">Diedit secara fleksibel</small>
                                </label>
                                <textarea class="form-control border-warning border-opacity-50" name="pesan_blokir" id="pesan_blokir" rows="3" 
                                          style="border-radius: 8px; font-size: 0.95rem;" placeholder="Tuliskan pesan instruksi untuk siswa..."><?= esc($exambro->pesan_blokir ?? 'Ujian ini terkunci dan wajib dikerjakan melalui aplikasi Exambro resmi sekolah. Akses melalui browser biasa (Google Chrome, Firefox, Safari, Edge) tidak diizinkan. Silakan buka atau unduh aplikasi Exambro resmi di bawah ini.') ?></textarea>
                                <div class="form-text text-muted small mt-1">
                                    <i class="fas fa-info-circle me-1 text-primary"></i> Pesan teks instruksi ini akan otomatis dibaca oleh siswa yang mencoba membuka ujian menggunakan Google Chrome, Firefox, Safari, atau browser biasa tanpa Exambro.
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4 pt-2">
                                <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2 px-4 py-2.5 fw-bold shadow-sm" id="btn-save" style="border-radius: 8px;">
                                    <i class="fas fa-save"></i>
                                    <span>Simpan Pengaturan</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Column: Quick Status & Testing Guide -->
            <div class="col-lg-4">
                <!-- User-Agent Diagnostic Card -->
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h6 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                            <i class="fas fa-laptop-code text-secondary"></i>
                            <span>Deteksi Browser Anda Saat Ini</span>
                        </h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="p-2.5 rounded-3 bg-light border mb-3">
                            <small class="text-muted d-block mb-1 fw-bold">User-Agent Perangkat Anda:</small>
                            <code class="text-break" style="font-size: 0.8rem; color: #d97706;"><?= esc($current_agent) ?></code>
                        </div>
                        <p class="small text-muted mb-0">
                            Gunakan kotak ini untuk memverifikasi apakah Exambro Anda mengirimkan kata kunci User-Agent yang sesuai.
                        </p>
                    </div>
                </div>

                <!-- Live Preview Card: Tampilan Layar Saat Siswa Diblokir -->
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 14px; overflow: hidden;">
                    <div class="card-header bg-danger text-white py-2.5 d-flex align-items-center justify-content-between">
                        <span class="fw-bold small"><i class="fas fa-eye me-1"></i> Pratinjau Tampilan Siswa Diblokir</span>
                        <span class="badge bg-white text-danger px-2 py-0.5 small fw-bold">Live Preview</span>
                    </div>
                    <div class="card-body p-3 bg-light text-center">
                        <div class="d-inline-flex align-items-center justify-content-center bg-danger bg-opacity-10 text-danger rounded-circle p-2 mb-2" style="width: 50px; height: 50px;">
                            <i class="fas fa-shield-alt fa-2x"></i>
                        </div>
                        <h6 class="fw-bold text-danger mb-1" style="font-size: 0.95rem;">AKSES UJIAN DIKUNCI</h6>
                        <span class="badge bg-danger text-white px-2 py-1 rounded-pill mb-2" style="font-size: 0.72rem;">
                            <i class="fas fa-lock me-1"></i> Wajib Exambro Resmi
                        </span>
                        <div class="alert alert-danger p-2 text-start small mb-2 bg-white border border-danger border-opacity-25 rounded-2" style="font-size: 0.8rem; line-height: 1.5;">
                            <strong class="d-block text-danger mb-1" style="font-size: 0.78rem;"><i class="fas fa-bullhorn me-1"></i> Pesan Peringatan:</strong>
                            <div id="preview-pesan-blokir" class="text-dark">
                                <?= nl2br(esc($exambro->pesan_blokir ?? 'Ujian ini terkunci dan wajib dikerjakan melalui aplikasi Exambro resmi sekolah. Akses melalui browser biasa (Google Chrome, Firefox, Safari, Edge) tidak diizinkan. Silakan buka atau unduh aplikasi Exambro resmi di bawah ini.')) ?>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center gap-1 flex-wrap">
                            <span class="btn btn-success btn-sm disabled py-1 px-2" style="font-size: 0.75rem;"><i class="fab fa-android me-1"></i> Download Android</span>
                            <span class="btn btn-info btn-sm text-white disabled py-1 px-2" style="font-size: 0.75rem;"><i class="fas fa-desktop me-1"></i> Download PC</span>
                        </div>
                    </div>
                </div>

                <!-- Petunjuk Pengaturan Jadwal -->
                <div class="card border-0 shadow-sm" style="border-radius: 14px;">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h6 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                            <i class="fas fa-question-circle text-info"></i>
                            <span>Pilihan Penguncian di Jadwal Ujian</span>
                        </h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-unstyled mb-0 d-flex flex-column gap-3 small">
                            <li class="d-flex align-items-start gap-2">
                                <span class="badge bg-secondary p-1.5 mt-0.5"><i class="fas fa-globe"></i></span>
                                <div>
                                    <strong class="text-dark">Bebas (Semua Browser):</strong><br>
                                    <span class="text-muted">Siswa bebas memakai Chrome, Firefox, Safari, atau HP/Laptop tanpa blokir.</span>
                                </div>
                            </li>
                            <li class="d-flex align-items-start gap-2">
                                <span class="badge bg-primary p-1.5 mt-0.5"><i class="fas fa-lock"></i></span>
                                <div>
                                    <strong class="text-dark">Wajib Exambro (Android & PC):</strong><br>
                                    <span class="text-muted">Wajib memakai Exambro resmi. Siswa yang membuka dari browser biasa langsung diblokir.</span>
                                </div>
                            </li>
                            <li class="d-flex align-items-start gap-2">
                                <span class="badge bg-success p-1.5 mt-0.5"><i class="fab fa-android"></i></span>
                                <div>
                                    <strong class="text-dark">Hanya Exambro Android:</strong><br>
                                    <span class="text-muted">Hanya boleh dikerjakan di HP Android dengan Exambro resmi.</span>
                                </div>
                            </li>
                            <li class="d-flex align-items-start gap-2">
                                <span class="badge bg-info p-1.5 mt-0.5"><i class="fas fa-desktop"></i></span>
                                <div>
                                    <strong class="text-dark">Hanya Exambro PC:</strong><br>
                                    <span class="text-muted">Hanya boleh dikerjakan di komputer PC / Laptop dengan Exambro resmi.</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#pesan_blokir').on('input', function() {
        var val = $(this).val().trim();
        if (!val) val = 'Ujian ini terkunci dan wajib dikerjakan melalui aplikasi Exambro resmi sekolah...';
        $('#preview-pesan-blokir').text(val);
    });

    $('#form-exambro').on('submit', function(e) {
        e.preventDefault();
        var $btn = $('#btn-save');
        $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...');

        $.ajax({
            url: '<?= base_url('cbtexambro/save') ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(res) {
                $btn.prop('disabled', false).html('<i class="fas fa-save me-2"></i>Simpan Pengaturan');
                if (res.status) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: res.message,
                            timer: 1800,
                            showConfirmButton: false
                        });
                    } else {
                        alert(res.message);
                    }
                } else {
                    alert(res.message || 'Gagal menyimpan pengaturan');
                }
            },
            error: function(xhr) {
                $btn.prop('disabled', false).html('<i class="fas fa-save me-2"></i>Simpan Pengaturan');
                alert('Terjadi kesalahan pada server');
            }
        });
    });
});
</script>

<?= $this->endSection() ?>
