<style>
:root {
    --primary-color: #6366f1;
    --primary-hover: #4f46e5;
}
body#page-top {
    background-color: #f3f4f6;
    font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    color: #1f2937;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
.installed-card {
    background: #ffffff;
    border-radius: 1.25rem;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    max-width: 520px;
    width: 100%;
    padding: 2.5rem 2rem;
    text-align: center;
}
.icon-circle {
    width: 80px;
    height: 80px;
    background: #ecfdf5;
    color: #10b981;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    margin: 0 auto 1.5rem;
}
</style>

<div class="container d-flex justify-content-center align-items-center py-5">
    <div class="installed-card shadow">
        <div class="icon-circle">
            <i class="fas fa-check-circle"></i>
        </div>
        <h3 class="fw-bold text-dark mb-2">Aplikasi Sudah Terinstal!</h3>
        <p class="text-muted mb-4" style="font-size: 0.95rem; line-height: 1.6;">
            Aplikasi CBT telah berhasil dikonfigurasi dan database telah siap digunakan. Anda dapat langsung login menggunakan akun Administrator yang telah dibuat.
        </p>

        <div class="d-grid gap-2">
            <a href="<?= base_url('auth') ?>" class="btn btn-primary btn-lg shadow-sm rounded-pill fw-bold" style="background-color: #6366f1; border-color: #6366f1;">
                <i class="fas fa-sign-in-alt me-2"></i> Buka Halaman Login
            </a>
            <a href="<?= base_url('install?reinstall=1') ?>" class="btn btn-outline-secondary rounded-pill mt-2" onclick="return confirm('Apakah Anda yakin ingin membuka wizard instalasi kembali?')">
                <i class="fas fa-sync me-1"></i> Buka Wizard Instalasi Lagi
            </a>
        </div>
    </div>
</div>
