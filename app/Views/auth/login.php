<?= $this->extend('layout/auth_template') ?>

<?= $this->section('content') ?>
<?php
$logo_app = (isset($setting) && $setting->logo_kiri != null) ? base_url($setting->logo_kiri) : ((isset($setting) && $setting->logo_kanan != null) ? base_url($setting->logo_kanan) : base_url('assets/img/favicon.png'));
$nama_aplikasi = isset($setting->nama_aplikasi) && !empty($setting->nama_aplikasi) ? $setting->nama_aplikasi : 'CBTGaruda';
$sekolah = isset($setting->sekolah) && !empty($setting->sekolah) ? $setting->sekolah : 'Aplikasi Ujian CBT & E-Learning';
$alamat = isset($setting->alamat) && !empty($setting->alamat) ? $setting->alamat : '';
$npsn = isset($setting->npsn) && !empty($setting->npsn) ? $setting->npsn : '-';
$kepsek = isset($setting->kepsek) && !empty($setting->kepsek) ? $setting->kepsek : '-';
?>

<style>
    :root {
        --primary: #2563eb;
        --primary-accent: #06b6d4;
        --emerald: #10b981;
        --gold: #f59e0b;
        --navy-dark: #0a101f;
        --text-dark: #0f172a;
        --text-light: #64748b;
    }

    body {
        font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, sans-serif;
        background-color: #080d1a;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        overflow-x: hidden;
        position: relative;
    }

    /* DYNAMIC ANIMATED GALAXY & NEBULA BACKGROUND */
    .aurora-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 0;
        pointer-events: none;
        overflow: hidden;
        background: radial-gradient(ellipse at 50% 20%, #171135 0%, #0a0f24 50%, #040711 100%);
    }

    .orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        opacity: 0.55;
        animation: floatOrb 22s ease-in-out infinite alternate;
        mix-blend-mode: screen;
    }
    .orb-1 {
        width: 580px;
        height: 580px;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.75) 0%, transparent 70%);
        top: -150px;
        left: -150px;
    }
    .orb-2 {
        width: 520px;
        height: 520px;
        background: radial-gradient(circle, rgba(139, 92, 246, 0.7) 0%, transparent 70%);
        bottom: -120px;
        right: -120px;
        animation-duration: 26s;
    }
    .orb-3 {
        width: 460px;
        height: 460px;
        background: radial-gradient(circle, rgba(6, 182, 212, 0.6) 0%, transparent 70%);
        top: 35%;
        left: 50%;
        animation-duration: 20s;
    }
    .orb-4 {
        width: 380px;
        height: 380px;
        background: radial-gradient(circle, rgba(236, 72, 153, 0.45) 0%, transparent 70%);
        bottom: 18%;
        left: 12%;
        animation-duration: 24s;
    }

    @keyframes floatOrb {
        0% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(70px, 50px) scale(1.12); }
        100% { transform: translate(-50px, 90px) scale(0.92); }
    }

    /* CANVAS PARTICLES */
    #particlesCanvas {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        pointer-events: none;
    }

    .main-wrapper {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px 18px;
        width: 100%;
        position: relative;
        z-index: 10;
    }

    /* MAIN LOGIN CARD */
    .login-card-container {
        width: 100%;
        max-width: 1050px;
        min-height: 590px;
        background: rgba(255, 255, 255, 0.98);
        border-radius: 28px;
        box-shadow: 
            0 30px 80px -15px rgba(0, 0, 0, 0.65),
            0 0 0 1px rgba(255, 255, 255, 0.3),
            0 0 50px rgba(37, 99, 235, 0.25);
        display: flex;
        overflow: hidden;
        position: relative;
        z-index: 10;
        backdrop-filter: blur(20px);
    }

    /* SISI KIRI: FORM LOGIN (BAGIAN PUTIH) */
    .form-side {
        flex: 1.15;
        padding: 48px 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        position: relative;
        border-right: 1px solid rgba(226, 232, 240, 0.8);
    }

    .form-side::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 160px;
        height: 160px;
        background: radial-gradient(circle at top left, rgba(37, 99, 235, 0.08) 0%, transparent 70%);
        border-top-left-radius: 28px;
        pointer-events: none;
    }

    /* BRANDING KHUSUS TAMPILAN MOBILE (HANYA DI HP) */
    .brand-mobile {
        display: none;
        text-align: center;
        margin-bottom: 24px;
    }

    .brand-logo-mobile {
        width: 74px;
        height: 74px;
        object-fit: contain;
        background: #ffffff;
        border-radius: 20px;
        padding: 10px;
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.18);
        border: 2px solid rgba(37, 99, 235, 0.2);
        margin: 0 auto 12px;
        display: inline-block;
    }

    .brand-mobile h3 {
        font-size: 1.45rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .brand-mobile p {
        font-size: 0.86rem;
        color: #64748b;
        font-weight: 600;
        margin: 0;
    }

    /* HEADER DESKTOP */
    .brand-desktop {
        display: block;
    }

    .form-header-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 14px;
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.12) 0%, rgba(6, 182, 212, 0.15) 100%);
        border: 1px solid rgba(37, 99, 235, 0.25);
        border-radius: 20px;
        color: #1d4ed8;
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 0.3px;
        margin-bottom: 16px;
        width: fit-content;
    }

    .form-header-badge i {
        color: #0284c7;
        animation: pulse-icon 2s infinite;
    }

    @keyframes pulse-icon {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
    }

    .form-title {
        font-size: 1.85rem;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.5px;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-subtitle {
        font-size: 0.93rem;
        color: #64748b;
        margin-bottom: 28px;
        line-height: 1.45;
    }

    /* INPUT FIELDS MEWAH */
    .input-group-pro {
        margin-bottom: 20px;
    }

    .input-label-pro {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.88rem;
        font-weight: 700;
        color: #334155;
        margin-bottom: 8px;
    }

    .input-box {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-icon-box {
        position: absolute;
        left: 14px;
        width: 32px;
        height: 32px;
        border-radius: 9px;
        background: #f1f5f9;
        color: #64748b;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
        transition: all 0.25s ease;
        pointer-events: none;
    }

    .input-field-pro {
        width: 100%;
        height: 52px;
        padding: 0 48px 0 54px;
        background: #f8fafc;
        border: 1.8px solid #e2e8f0;
        border-radius: 14px;
        font-size: 0.96rem;
        color: #0f172a;
        font-weight: 600;
        transition: all 0.25s ease;
    }

    .input-field-pro:focus {
        background: #ffffff;
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.16);
        outline: none;
    }

    .input-field-pro:focus ~ .input-icon-box,
    .input-box:focus-within .input-icon-box {
        background: linear-gradient(135deg, #2563eb, #0284c7);
        color: #ffffff;
        box-shadow: 0 3px 8px rgba(37, 99, 235, 0.35);
    }

    .toggle-password {
        position: absolute;
        right: 14px;
        color: #94a3b8;
        cursor: pointer;
        padding: 8px;
        font-size: 1.05rem;
        transition: color 0.2s;
    }

    .toggle-password:hover {
        color: #1e293b;
    }

    /* REMEMBER & HELP ROW */
    .form-utility-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        font-size: 0.86rem;
    }

    .custom-check {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        color: #475569;
        font-weight: 600;
        user-select: none;
    }

    .custom-check input {
        accent-color: #2563eb;
        width: 17px;
        height: 17px;
        cursor: pointer;
    }

    .help-link {
        color: #2563eb;
        font-weight: 700;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 4px;
        transition: color 0.2s;
    }
    .help-link:hover {
        color: #1d4ed8;
        text-decoration: underline;
    }

    /* MULTI-TONE GRADIENT BUTTON */
    .btn-submit-pro {
        width: 100%;
        height: 54px;
        background: linear-gradient(135deg, #1d4ed8 0%, #0284c7 45%, #059669 100%);
        background-size: 200% auto;
        border: none;
        border-radius: 14px;
        color: #ffffff;
        font-size: 1.05rem;
        font-weight: 700;
        letter-spacing: 0.4px;
        cursor: pointer;
        box-shadow: 0 10px 25px -4px rgba(2, 132, 199, 0.45);
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        position: relative;
        overflow: hidden;
    }

    .btn-submit-pro::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: 0.6s;
    }

    .btn-submit-pro:hover {
        background-position: right center;
        box-shadow: 0 14px 30px -4px rgba(5, 150, 105, 0.5);
        transform: translateY(-2px);
    }

    .btn-submit-pro:hover::before {
        left: 100%;
    }

    .btn-submit-pro:active {
        transform: translateY(0);
    }

    .btn-submit-pro:disabled {
        opacity: 0.65;
        cursor: not-allowed;
        transform: none !important;
    }

    /* SECURITY FOOTER BADGES */
    .form-footer-pro {
        margin-top: 26px;
        padding-top: 18px;
        border-top: 1px dashed #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 0.78rem;
        color: #64748b;
    }

    .security-badge {
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 600;
        color: #059669;
    }

    /* SISI KANAN: HERO INFO PANEL (TAMPIL DI DESKTOP / LAYAR LEBAR) */
    .hero-side {
        flex: 1;
        background: linear-gradient(145deg, #0f172a 0%, #1e293b 50%, #0c1527 100%);
        padding: 44px 42px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
        color: #ffffff;
    }

    /* DOODLE WATERMARK EDUKASI */
    .hero-doodle-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0.09;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160' viewBox='0 0 160 160'%3E%3Cpath fill='%23ffffff' d='M25 40 L45 20 L65 40 L45 60 Z M110 30 C120 20 135 20 145 30 C155 40 155 55 145 65 L125 85 L100 60 Z M30 110 L50 110 L50 130 L30 130 Z M100 120 L130 90 L140 100 L110 130 Z M80 20 L85 35 L100 35 L88 45 L92 60 L80 50 L68 60 L72 45 L60 35 L75 35 Z M15 80 L35 80 L25 100 Z M80 85 C95 85 95 105 80 105 C65 105 65 85 80 85 Z'/%3E%3C/svg%3E");
        background-repeat: repeat;
        pointer-events: none;
        z-index: 1;
    }

    .hero-side::before {
        content: '';
        position: absolute;
        top: -80px;
        left: 50%;
        transform: translateX(-50%);
        width: 380px;
        height: 220px;
        background: radial-gradient(ellipse, rgba(56, 189, 248, 0.28) 0%, transparent 70%);
        pointer-events: none;
        z-index: 1;
    }

    .hero-header {
        position: relative;
        z-index: 2;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .logo-box-glow {
        position: relative;
        margin-bottom: 14px;
    }

    .logo-wrap {
        width: 86px;
        height: 86px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 24px;
        padding: 12px;
        box-shadow: 
            0 15px 35px rgba(0, 0, 0, 0.4),
            0 0 0 3px rgba(56, 189, 248, 0.35),
            0 0 30px rgba(56, 189, 248, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease;
    }

    .logo-wrap:hover {
        transform: translateY(-4px) scale(1.05);
    }

    .logo-wrap img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        filter: drop-shadow(0 2px 5px rgba(0,0,0,0.15));
    }

    .app-name {
        font-size: 1.65rem;
        font-weight: 800;
        color: #ffffff;
        letter-spacing: -0.3px;
        margin-bottom: 6px;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.4);
    }

    .school-name-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.86rem;
        color: #fbbf24;
        font-weight: 700;
        background: rgba(245, 158, 11, 0.14);
        border: 1px solid rgba(245, 158, 11, 0.32);
        padding: 5px 14px;
        border-radius: 20px;
        backdrop-filter: blur(6px);
        margin-bottom: 6px;
    }

    .school-address {
        font-size: 0.8rem;
        color: #94a3b8;
        max-width: 360px;
        line-height: 1.4;
    }

    /* CYBER-GLOW DIGITAL CLOCK CARD */
    .clock-card {
        background: rgba(15, 23, 42, 0.72);
        border: 1.5px solid rgba(56, 189, 248, 0.35);
        border-radius: 20px;
        padding: 16px 20px;
        text-align: center;
        position: relative;
        z-index: 2;
        margin: 18px 0;
        box-shadow: 
            0 10px 30px rgba(0, 0, 0, 0.4),
            inset 0 0 25px rgba(56, 189, 248, 0.12);
        backdrop-filter: blur(12px);
    }

    .clock-card-label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        color: #38bdf8;
        font-weight: 800;
        margin-bottom: 4px;
    }

    .clock-time {
        font-size: 2.35rem;
        font-weight: 800;
        letter-spacing: 4px;
        font-variant-numeric: tabular-nums;
        color: #38bdf8;
        text-shadow: 0 0 20px rgba(56, 189, 248, 0.75);
        line-height: 1.1;
    }

    .clock-date {
        font-size: 0.86rem;
        color: #cbd5e1;
        margin-top: 6px;
        font-weight: 600;
        letter-spacing: 0.2px;
    }

    /* GRID INFO TILES */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        position: relative;
        z-index: 2;
    }

    .info-pill {
        display: flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.07);
        border: 1px solid rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(10px);
        padding: 12px 14px;
        border-radius: 14px;
        color: #e2e8f0;
        gap: 12px;
        transition: all 0.25s ease;
    }

    .info-pill:hover {
        background: rgba(255, 255, 255, 0.14);
        border-color: rgba(56, 189, 248, 0.45);
        transform: translateY(-2px);
    }

    .info-pill.full-width {
        grid-column: span 2;
    }

    .pill-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: rgba(56, 189, 248, 0.18);
        color: #38bdf8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.05rem;
        flex-shrink: 0;
        box-shadow: 0 4px 10px rgba(0,0,0,0.25);
    }

    .pill-icon.green {
        background: rgba(16, 185, 129, 0.22);
        color: #34d399;
    }

    .pill-icon.gold {
        background: rgba(251, 191, 36, 0.22);
        color: #fbbf24;
    }

    .status-dot-active {
        width: 10px;
        height: 10px;
        background: #10b981;
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 12px #10b981;
        animation: pulse-dot 1.8s infinite;
    }

    @keyframes pulse-dot {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.4; transform: scale(0.8); }
    }

    .hero-motto {
        position: relative;
        z-index: 2;
        margin-top: 14px;
        padding: 8px 14px;
        background: rgba(0, 0, 0, 0.25);
        border-radius: 12px;
        font-size: 0.78rem;
        color: #94a3b8;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    /* STATUS MODAL */
    .status-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.65);
        backdrop-filter: blur(6px);
        z-index: 10002;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }
    .status-overlay.active {
        opacity: 1;
        visibility: visible;
    }
    .status-box {
        background: white;
        padding: 35px;
        border-radius: 20px;
        text-align: center;
        max-width: 380px;
        width: 90%;
        box-shadow: 0 20px 50px rgba(0,0,0,0.4);
        transform: scale(0.8);
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .status-overlay.active .status-box {
        transform: scale(1);
    }
    .status-icon {
        font-size: 3.5rem;
        margin-bottom: 15px;
        display: inline-block;
    }
    .status-title {
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 8px;
        color: var(--text-dark);
    }
    .status-desc {
        font-size: 0.95rem;
        color: #64748b;
        line-height: 1.4;
    }
    .status-success .status-icon { color: #10b981; }
    .status-success .status-title { color: #10b981; }
    .status-fail .status-icon { color: #ef4444; }
    .status-fail .status-title { color: #ef4444; }

    /* RESPONSIVE: VERSI MOBILE HANYA PERLIHATKAN BAGIAN PUTIH! */
    @media (max-width: 880px) {
        .main-wrapper { 
            padding: 16px; 
        }

        .login-card-container {
            max-width: 480px;
            min-height: auto;
            border-radius: 24px;
        }

        /* SISI KANAN (HERO-SIDE GELAP) DISEMBUNYIKAN TOTAL DI MOBILE */
        .hero-side {
            display: none !important;
        }

        /* SISI KIRI (BAGIAN PUTIH) MENGISI PENUH LAYAR HP */
        .form-side {
            flex: 1;
            padding: 36px 26px;
            border-right: none;
        }

        /* MUNCULKAN LOGO & NAMA SEKOLAH DI ATAS FORM PADA HP */
        .brand-mobile {
            display: block !important;
        }

        /* SEMBUNYIKAN HEADER DESKTOP PADA HP */
        .brand-desktop {
            display: none !important;
        }

        .form-title { 
            font-size: 1.55rem; 
            justify-content: center;
        }

        .form-subtitle {
            text-align: center;
            margin-bottom: 22px;
        }
    }
</style>

<!-- DYNAMIC AMBIENT AURORA BACKGROUND -->
<div class="aurora-bg">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
    <div class="orb orb-4"></div>
</div>

<!-- CANVAS PARTICLES (KILAU CAHAYA LEMBUT) -->
<canvas id="particlesCanvas"></canvas>

<!-- STATUS MODAL -->
<div id="statusModal" class="status-overlay">
    <div class="status-box" id="statusBox">
        <i id="statusIcon" class="fas fa-check-circle status-icon"></i>
        <h3 id="statusTitle" class="status-title">Berhasil</h3>
        <p id="statusMessage" class="status-desc">Pesan status di sini.</p>
    </div>
</div>

<!-- MAIN LOGIN SECTION -->
<div class="main-wrapper">
    <div class="login-card-container">
        
        <!-- SISI KIRI: FORM LOGIN (BAGIAN PUTIH) -->
        <div class="form-side">
            <div>
                <!-- HEADER KHUSUS MOBILE: LOGO & IDENTITAS SEKOLAH DI HP -->
                <div class="brand-mobile">
                    <img src="<?= $logo_app ?>" alt="Logo" class="brand-logo-mobile">
                    <h3><?= esc($nama_aplikasi) ?></h3>
                    <p><?= esc($sekolah) ?><?= !empty($alamat) ? ' • ' . esc($alamat) : '' ?></p>
                </div>

                <!-- HEADER DESKTOP -->
                <div class="brand-desktop">
                    <div class="form-header-badge">
                        <i class="fas fa-certificate"></i>
                        <span>PORTAL CBT & E-LEARNING RESMI</span>
                    </div>

                    <h1 class="form-title">
                        <span>Selamat Datang!</span>
                        <span style="font-size: 1.4rem;">👋</span>
                    </h1>
                    <p class="form-subtitle">Silakan masukkan username & password akun Anda untuk masuk ke sistem.</p>
                </div>

                <?php if (session()->getFlashdata('message')) : ?>
                    <div id="infoMessage" class="alert alert-danger p-2 text-center small mb-3"><?= session()->getFlashdata('message') ?></div>
                <?php else: ?>
                    <div id="infoMessage" class="d-none"></div>
                <?php endif; ?>

                <!-- FORM INPUT SATU FORM RESMI -->
                <form action="<?= base_url('auth/login') ?>" id="login" method="post">
                    <?= csrf_field() ?>
                    
                    <!-- Username -->
                    <div class="input-group-pro">
                        <label class="input-label-pro" for="username">
                            <span>Username</span>
                            <span style="font-size: 0.76rem; color: #1d4ed8; font-weight: 600;"><i class="fas fa-check-circle me-1"></i>Akun Resmi</span>
                        </label>
                        <div class="input-box">
                            <div class="input-icon-box">
                                <i class="fas fa-user"></i>
                            </div>
                            <input type="text" name="username" id="username" placeholder="Masukkan username Anda..." autofocus class="input-field-pro" autocomplete="off" required>
                        </div>
                        <div class="help-block text-danger small mt-1"></div>
                    </div>

                    <!-- Password -->
                    <div class="input-group-pro">
                        <label class="input-label-pro" for="password">
                            <span>Kata Sandi (Password)</span>
                        </label>
                        <div class="input-box">
                            <div class="input-icon-box">
                                <i class="fas fa-lock"></i>
                            </div>
                            <input type="password" name="password" id="password" placeholder="Masukkan kata sandi Anda..." class="input-field-pro" required>
                            <i class="fas fa-eye-slash toggle-password" id="toggle-password"></i>
                        </div>
                        <div class="help-block text-danger small mt-1"></div>
                    </div>

                    <!-- Hidden CBT Only -->
                    <input type="hidden" id="cbt-only" name="cbt-only" value="0">

                    <div class="form-utility-row" style="justify-content: flex-end;">
                        <a href="javascript:void(0)" class="help-link" onclick="showStatusModal('error', 'Jika Anda lupa password atau terkendala login, silakan hubungi Proktor atau Tim IT Sekolah.')">
                            <i class="fas fa-question-circle"></i> Butuh Bantuan?
                        </a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="submit" class="btn-submit-pro">
                        <span>Login</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- SISI KANAN: HERO PANEL (HANYA MUNCUL DI DESKTOP / LAYAR LEBAR) -->
        <div class="hero-side">
            <!-- DOODLE WATERMARK -->
            <div class="hero-doodle-bg"></div>

            <!-- HEADER IDENTITAS -->
            <div class="hero-header">
                <div class="logo-box-glow">
                    <div class="logo-wrap">
                        <img src="<?= $logo_app ?>" alt="Logo">
                    </div>
                </div>
                <h2 class="app-name"><?= esc($nama_aplikasi) ?></h2>
                <div class="school-name-badge">
                    <i class="fas fa-graduation-cap"></i>
                    <span><?= esc($sekolah) ?></span>
                </div>
                <?php if (!empty($alamat)): ?>
                    <p class="school-address"><?= esc($alamat) ?></p>
                <?php endif; ?>
            </div>

            <!-- CLOCK CARD DENGAN CYBER GLOW -->
            <div class="clock-card">
                <div class="clock-card-label">
                    <i class="fas fa-clock"></i>
                    <span>Waktu Server Real-time</span>
                </div>
                <div class="clock-time" id="clockTime">--:--:--</div>
                <div class="clock-date" id="clockDate">--</div>
            </div>

            <!-- GRID INFO TILES -->
            <div>
                <div class="info-grid">
                    <div class="info-pill full-width">
                        <div class="pill-icon green">
                            <span class="status-dot-active"></span>
                        </div>
                        <div style="flex: 1;">
                            <strong style="color: #ffffff; display: block; font-size: 0.88rem;">Server CBT Siap Ujian</strong>
                            <span style="font-size: 0.78rem; color: #94a3b8;">Latency < 25ms • Koneksi Aman</span>
                        </div>
                        <span style="font-size: 0.72rem; background: rgba(16,185,129,0.2); color: #34d399; font-weight: 700; padding: 3px 8px; border-radius: 8px;">ONLINE</span>
                    </div>

                    <div class="info-pill">
                        <div class="pill-icon gold">
                            <i class="fas fa-university"></i>
                        </div>
                        <div>
                            <strong style="color: #ffffff; display: block; font-size: 0.85rem;">NPSN : <?= esc($npsn) ?></strong>
                            <span style="font-size: 0.76rem; color: #94a3b8;">Terakreditasi</span>
                        </div>
                    </div>

                    <div class="info-pill">
                        <div class="pill-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div>
                            <strong style="color: #ffffff; display: block; font-size: 0.85rem;">Kepala Madrasah</strong>
                            <span style="font-size: 0.76rem; color: #94a3b8;"><?= esc($kepsek) ?></span>
                        </div>
                    </div>
                </div>

                <!-- MOTTO TICKER -->
                <div class="hero-motto">
                    <i class="fas fa-quote-left" style="color: #fbbf24;"></i>
                    <span>Junjung tinggi integritas & kejujuran saat ujian!</span>
                    <i class="fas fa-quote-right" style="color: #fbbf24;"></i>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    let base_url = '<?= rtrim(base_url(), '/') . '/' ?>';

    $(document).ready(function(){
        startClock();

        // Toggle Password
        $('#toggle-password').on('click', function () {
            const input = $('#password');
            const type = input.attr('type') === 'password' ? 'text' : 'password';
            input.attr('type', type);
            $(this).toggleClass('fa-eye-slash fa-eye');
        });

        // Default login mode to E-Learning & CBT (0)
        localStorage.setItem('nextgenCBT.login', '0');

        $('form#login').on('submit', function(e){
            e.preventDefault();
            e.stopImmediatePropagation();

            var btnsubmit = $('#submit');
            var originalBtnHtml = btnsubmit.html();
            btnsubmit.attr('disabled', 'disabled').html('<span>Memproses...</span> <i class="fas fa-spinner fa-spin"></i>');

            const cbtOnly = $('#cbt-only').val();
            localStorage.setItem('nextgenCBT.login', cbtOnly);

            function doLogin(targetUrl, isFallback) {
                $.ajax({
                    url: targetUrl,
                    type: 'POST',
                    data: $('form#login').serialize(),
                    success: function(data){
                        btnsubmit.removeAttr('disabled').html(originalBtnHtml);
                        
                        try {
                            if(typeof data === 'string') {
                                data = JSON.parse(data);
                            }
                        } catch(e) {}

                        if(data.success){
                            showStatusModal('success', 'Akses Diberikan! Mengalihkan ke sistem...');

                            setTimeout(function(){
                                let redirectUrl = data.url;
                                if (cbtOnly === '1' && data.role == '3') {
                                    redirectUrl = 'cbtsiswa/cbt';
                                }
                                let go = (isFallback || targetUrl.indexOf('index.php') !== -1)
                                    ? base_url + 'index.php/' + redirectUrl
                                    : base_url + redirectUrl;
                                window.location.href = go;
                            }, 1000);
                        } else {
                            let displayMsg = data.message || 'Username atau password salah!';
                            showStatusModal('error', displayMsg);
                            $('#password').val('');
                        }
                    },
                    error: function(xhr) {
                        if (!isFallback && (xhr.status === 404 || xhr.status === 405)) {
                            let fallbackUrl = base_url + 'index.php/auth/login';
                            doLogin(fallbackUrl, true);
                            return;
                        }
                        showStatusModal('error', 'Gagal terhubung ke server.');
                        btnsubmit.removeAttr('disabled').html(originalBtnHtml);
                    }
                });
            }

            doLogin($(this).attr('action'), false);
        });
    });

    function startClock() {
        function tick() {
            const now = new Date();
            const h = String(now.getHours()).padStart(2, '0');
            const m = String(now.getMinutes()).padStart(2, '0');
            const s = String(now.getSeconds()).padStart(2, '0');
            $('#clockTime').text(`${h}:${m}:${s}`);
            
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            $('#clockDate').text(now.toLocaleDateString('id-ID', options));
        }
        setInterval(tick, 1000);
        tick();
    }

    function showStatusModal(type, message) {
        const modal = $('#statusModal');
        const box = $('#statusBox');
        const icon = $('#statusIcon');
        const title = $('#statusTitle');
        const msg = $('#statusMessage');

        box.removeClass('status-success status-fail');

        switch(type) {
            case 'success':
                box.addClass('status-success');
                icon.attr('class', 'fas fa-check-circle status-icon');
                title.text('Berhasil');
                break;
            case 'error':
            default:
                box.addClass('status-fail');
                icon.attr('class', 'fas fa-times-circle status-icon');
                title.text('Informasi Login');
                break;
        }
        
        msg.text(message);
        modal.addClass('active');

        if(type === 'success') {
            setTimeout(function(){ hideStatusModal(); }, 1500);
        } else {
            setTimeout(function(){ hideStatusModal(); }, 2500);
        }
    }

    function hideStatusModal() {
        $('#statusModal').removeClass('active');
    }

    // =========================================================================
    // GALAXY LIVE & FLOATING MATHEMATICAL FORMULAS ENGINE
    // =========================================================================
    (function() {
        const canvas = document.getElementById('particlesCanvas');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        let w, h;
        let isMobile = window.innerWidth < 768;

        function resize() {
            w = canvas.width = window.innerWidth;
            h = canvas.height = window.innerHeight;
            isMobile = w < 768;
        }
        window.addEventListener('resize', resize);
        resize();

        // Parallax State
        let mouse = { x: w / 2, y: h / 2, targetX: w / 2, targetY: h / 2 };
        window.addEventListener('mousemove', (e) => {
            mouse.targetX = e.clientX;
            mouse.targetY = e.clientY;
        });

        // 1. GALAXY STARS
        const STAR_COUNT = isMobile ? 65 : 140;
        const stars = [];
        const starColors = ['#ffffff', '#bae6fd', '#c7d2fe', '#fbcfe8', '#a7f3d0'];

        for (let i = 0; i < STAR_COUNT; i++) {
            stars.push({
                x: Math.random() * w,
                y: Math.random() * h,
                r: Math.random() * 1.8 + 0.4,
                color: starColors[Math.floor(Math.random() * starColors.length)],
                alpha: Math.random() * 0.7 + 0.3,
                twinkleSpeed: Math.random() * 0.03 + 0.008,
                twinklePhase: Math.random() * Math.PI * 2,
                parallaxZ: Math.random() * 0.5 + 0.1
            });
        }

        // 2. SHOOTING STARS (METEORS)
        const meteors = [];
        let nextMeteorTime = Date.now() + 1500;

        function spawnMeteor() {
            meteors.push({
                x: Math.random() * (w * 0.8) + (w * 0.1),
                y: Math.random() * (h * 0.4),
                len: Math.random() * 90 + 70,
                speed: Math.random() * 6 + 7,
                angle: (Math.PI / 4) + (Math.random() * 0.2 - 0.1),
                alpha: 1,
                decay: Math.random() * 0.018 + 0.012
            });
            nextMeteorTime = Date.now() + Math.random() * 4500 + 2500;
        }

        // 3. MATHEMATICAL & SCIENTIFIC FORMULAS
        const MATH_FORMULAS = [
            'E = mc²',
            'e^{iπ} + 1 = 0',
            '∫ f(x) dx',
            '∑ 1/n² = π²/6',
            'a² + b² = c²',
            'sin²θ + cos²θ = 1',
            'f\'(x) = lim Δy/Δx',
            '∇ × B = μ₀J',
            'H|ψ⟩ = E|ψ⟩',
            'λ = h / p',
            'PV = nRT',
            'π ≈ 3.14159',
            'e ≈ 2.71828',
            'φ = 1.618',
            'lim_{x→∞} (1 + 1/x)ˣ = e',
            '∂u/∂t = α∇²u',
            'F = ma',
            'Δx · Δp ≥ ℏ/2',
            '√(-1) = i',
            'cos(2θ) = cos²θ - sin²θ',
            'S = k ln Ω',
            '∫ eˣ dx = eˣ + C',
            'log(xy) = log x + log y',
            'd/dx (ln x) = 1/x',
            'x = (-b ± √(b²-4ac)) / 2a',
            'E = hν',
            '∇ · E = ρ / ε₀',
            '∞', '∑', '∫', '∬', '√x', 'λ', 'μ', 'σ', 'Ω', 'θ', 'α', 'β', 'Δ', '∇', 'ψ'
        ];

        const NEON_PALETTE = [
            { text: '#38bdf8', glow: 'rgba(56, 189, 248, 0.7)' },
            { text: '#818cf8', glow: 'rgba(129, 140, 248, 0.7)' },
            { text: '#34d399', glow: 'rgba(52, 211, 153, 0.65)' },
            { text: '#c084fc', glow: 'rgba(192, 132, 252, 0.7)' },
            { text: '#fbbf24', glow: 'rgba(251, 191, 36, 0.65)' },
            { text: '#f472b6', glow: 'rgba(244, 114, 182, 0.65)' }
        ];

        const FORMULA_COUNT = isMobile ? 18 : 34;
        const formulas = [];

        function createFormula(initRandomY) {
            const fontScale = Math.random() * 0.6 + 0.7;
            const colorObj = NEON_PALETTE[Math.floor(Math.random() * NEON_PALETTE.length)];
            const text = MATH_FORMULAS[Math.floor(Math.random() * MATH_FORMULAS.length)];
            const isSingleSymbol = text.length <= 2;
            const size = Math.round((isSingleSymbol ? 24 : 15) * fontScale);

            return {
                text: text,
                x: Math.random() * w,
                y: initRandomY ? Math.random() * h : h + Math.random() * 60 + 20,
                z: fontScale,
                size: size,
                color: colorObj.text,
                glow: colorObj.glow,
                vx: (Math.random() - 0.5) * 0.35,
                vy: -(Math.random() * 0.45 + 0.25) * fontScale,
                angle: (Math.random() - 0.5) * 0.25,
                angleSpeed: (Math.random() - 0.5) * 0.003,
                oscT: Math.random() * Math.PI * 2,
                oscSpeed: Math.random() * 0.02 + 0.01,
                oscAmp: Math.random() * 0.5 + 0.3,
                baseAlpha: Math.random() * 0.4 + 0.35,
                alpha: 0
            };
        }

        for (let i = 0; i < FORMULA_COUNT; i++) {
            formulas.push(createFormula(true));
        }

        // 4. ANIMATION LOOP
        let globalTime = 0;

        function animate() {
            globalTime += 0.016;
            ctx.clearRect(0, 0, w, h);

            // Smooth parallax interpolation
            mouse.x += (mouse.targetX - mouse.x) * 0.04;
            mouse.y += (mouse.targetY - mouse.y) * 0.04;
            const offsetX = (mouse.x - w / 2) * 0.035;
            const offsetY = (mouse.y - h / 2) * 0.035;

            // DRAW STARS & CONSTELLATION LINES
            ctx.save();
            ctx.lineWidth = 0.5;
            for (let i = 0; i < stars.length; i++) {
                const s1 = stars[i];
                for (let j = i + 1; j < stars.length; j++) {
                    const s2 = stars[j];
                    const dx = (s1.x - s2.x);
                    const dy = (s1.y - s2.y);
                    const dist = Math.sqrt(dx * dx + dy * dy);
                    if (dist < 75) {
                        const lineAlpha = (1 - dist / 75) * 0.14 * Math.min(s1.alpha, s2.alpha);
                        ctx.strokeStyle = `rgba(147, 197, 253, ${lineAlpha})`;
                        ctx.beginPath();
                        ctx.moveTo(s1.x + offsetX * s1.parallaxZ, s1.y + offsetY * s1.parallaxZ);
                        ctx.lineTo(s2.x + offsetX * s2.parallaxZ, s2.y + offsetY * s2.parallaxZ);
                        ctx.stroke();
                    }
                }
            }

            // Draw Stars
            for (let s of stars) {
                s.twinklePhase += s.twinkleSpeed;
                const currentAlpha = s.alpha * (0.65 + 0.35 * Math.sin(s.twinklePhase));
                const px = s.x + offsetX * s.parallaxZ;
                const py = s.y + offsetY * s.parallaxZ;

                ctx.beginPath();
                ctx.arc(px, py, s.r, 0, Math.PI * 2);
                ctx.fillStyle = s.color;
                ctx.globalAlpha = currentAlpha;
                ctx.shadowBlur = s.r > 1.2 ? 6 : 0;
                ctx.shadowColor = s.color;
                ctx.fill();
            }
            ctx.restore();

            // DRAW SHOOTING STARS (METEORS)
            if (Date.now() > nextMeteorTime) {
                spawnMeteor();
            }

            for (let i = meteors.length - 1; i >= 0; i--) {
                const m = meteors[i];
                m.x += Math.cos(m.angle) * m.speed;
                m.y += Math.sin(m.angle) * m.speed;
                m.alpha -= m.decay;

                if (m.alpha <= 0 || m.x > w + 100 || m.y > h + 100) {
                    meteors.splice(i, 1);
                    continue;
                }

                ctx.save();
                const tailX = m.x - Math.cos(m.angle) * m.len;
                const tailY = m.y - Math.sin(m.angle) * m.len;
                const grad = ctx.createLinearGradient(m.x, m.y, tailX, tailY);
                grad.addColorStop(0, `rgba(255, 255, 255, ${m.alpha})`);
                grad.addColorStop(0.3, `rgba(56, 189, 248, ${m.alpha * 0.8})`);
                grad.addColorStop(1, 'rgba(56, 189, 248, 0)');

                ctx.strokeStyle = grad;
                ctx.lineWidth = 1.8;
                ctx.lineCap = 'round';
                ctx.shadowBlur = 8;
                ctx.shadowColor = 'rgba(56, 189, 248, 0.9)';
                ctx.beginPath();
                ctx.moveTo(m.x, m.y);
                ctx.lineTo(tailX, tailY);
                ctx.stroke();
                ctx.restore();
            }

            // DRAW FLOATING MATHEMATICAL & SCIENTIFIC FORMULAS
            ctx.save();
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';

            for (let i = 0; i < formulas.length; i++) {
                const f = formulas[i];

                f.y += f.vy;
                f.x += f.vx;
                f.oscT += f.oscSpeed;
                f.angle += f.angleSpeed;

                // Edge margins fade
                const edgeMargin = 80;
                let edgeAlpha = 1;
                if (f.y < edgeMargin) edgeAlpha = Math.max(0, f.y / edgeMargin);
                if (f.y > h - edgeMargin) edgeAlpha = Math.max(0, (h - f.y) / edgeMargin);
                if (f.x < edgeMargin) edgeAlpha = Math.min(edgeAlpha, Math.max(0, f.x / edgeMargin));
                if (f.x > w - edgeMargin) edgeAlpha = Math.min(edgeAlpha, Math.max(0, (w - f.x) / edgeMargin));

                f.alpha = f.baseAlpha * edgeAlpha * (0.85 + 0.15 * Math.sin(f.oscT));

                // Wrap-around if it floats completely off-screen
                if (f.y < -50 || f.x < -60 || f.x > w + 60) {
                    formulas[i] = createFormula(false);
                    continue;
                }

                // Render formula with parallax shift
                const renderX = f.x + offsetX * f.z * 1.6 + Math.sin(f.oscT) * f.oscAmp * 8;
                const renderY = f.y + offsetY * f.z * 1.6;

                ctx.save();
                ctx.translate(renderX, renderY);
                ctx.rotate(f.angle);
                ctx.font = `600 ${f.size}px "Cambria Math", "KaTeX_Math", "Times New Roman", "Segoe UI Symbol", serif`;
                ctx.fillStyle = f.color;
                ctx.globalAlpha = Math.max(0, Math.min(1, f.alpha));
                ctx.shadowBlur = f.z > 0.9 ? 12 : 6;
                ctx.shadowColor = f.glow;
                ctx.fillText(f.text, 0, 0);
                ctx.restore();
            }
            ctx.restore();

            requestAnimationFrame(animate);
        }
        animate();
    })();
</script>
<?= $this->endSection() ?>