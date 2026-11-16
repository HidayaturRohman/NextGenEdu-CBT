<?php
$agent = \Config\Services::request()->getUserAgent();
$is_mobile = $agent->isMobile();
$uri = \Config\Services::request()->getUri();
$seg1 = $uri->getTotalSegments() > 0 ? $uri->getSegment(1) : '';
$seg2 = $uri->getTotalSegments() > 1 ? $uri->getSegment(2) : '';

$is_cbtsiswa = ($seg1 === 'cbtsiswa');
// Ujian aktif (sedang mengerjakan soal dengan timer):
$is_cbt_active_exam = ($seg1 === 'cbtsiswa' && ($seg2 === 'penilaian' || $seg2 === 'ujian'));

// Tentukan URL kembali untuk tombol top-left:
if ($seg1 === 'cbtsiswa' && $seg2 === 'konfirmasi') {
    $back_url = base_url('cbtsiswa/cbt');
} else {
    $back_url = base_url('dashboard');
}
?>
<div class="position-relative iq-banner">
    <!--Nav Start-->
    <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar py-2">
        <div class="container-fluid navbar-inner px-2 px-sm-3 position-relative">
            
            <!-- Back Button (Top Left) -->
            <div class="d-flex align-items-center <?= (isset($judul) && $judul == 'Beranda' || $is_cbt_active_exam) ? 'invisible' : '' ?>" style="z-index: 1050;">
                <a href="<?= $back_url ?>" class="btn btn-primary btn-back-responsive d-inline-flex align-items-center justify-content-center shadow-sm" id="url-back">
                    <i class="fas fa-arrow-left"></i>
                    <span class="fw-bold ms-2 d-none d-lg-inline">Kembali</span>
                </a>
            </div>
            
            <!-- School Info (Top Center) -->
            <div class="position-absolute top-50 start-50 translate-middle text-center school-info-container" style="pointer-events: none; width: calc(100% - 104px); max-width: 650px;">
                <h4 class="mb-0 fw-bold text-dark text-truncate school-title" style="letter-spacing: 0.5px;"><?= isset($setting) ? esc($setting->sekolah) : 'Nama Sekolah' ?></h4>
                <div class="text-muted fw-semibold text-truncate school-sub-info">
                    <span class="d-none d-md-inline">Tahun Pelajaran </span><span class="d-inline d-md-none">TP </span><?= isset($tp_active) ? esc($tp_active->tahun) : '' ?> &bull; <span class="d-none d-md-inline">Semester </span><span class="d-inline d-md-none">Smt </span><?= isset($smt_active) ? esc($smt_active->nama_smt) : '' ?>
                </div>
            </div>
            
            <!-- Mobile Notification Bell Icon (Top Right) - Menggantikan tombol logout -->
            <div class="align-items-center ms-auto d-lg-none <?= $is_cbt_active_exam ? 'invisible' : 'd-flex' ?>" style="z-index: 1050;">
                <button type="button" onclick="bukaPengumumanMobile()" class="btn btn-notif-mobile rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm p-0 position-relative" title="Pengumuman Sekolah">
                    <i class="fas fa-bell"></i>
                    <span class="nav-notif-badge <?= (isset($badgePengumuman) && $badgePengumuman > 0) ? '' : 'd-none' ?>" id="badge-top-pengumuman" style="position: absolute; top: -2px; right: -2px; min-width: 17px; height: 17px; font-size: 10px; background: #dc3545; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; border: 2px solid #fff;">
                        <?= (isset($badgePengumuman) && $badgePengumuman > 9) ? '9+' : ($badgePengumuman ?? '') ?>
                    </span>
                </button>
            </div>

            <!-- Desktop User Profile Dropdown -->
            <div class="collapse navbar-collapse <?= $is_cbt_active_exam ? 'invisible' : '' ?>" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto navbar-list mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link py-0 d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php 
                            $user_foto = '';
                            if (isset($user)) {
                                if (is_object($user) && isset($user->foto)) {
                                    $user_foto = $user->foto;
                                } elseif (is_array($user) && isset($user['foto'])) {
                                    $user_foto = $user['foto'];
                                }
                            }
                            if (empty($user_foto)) {
                                $user_foto = session()->get('foto') ?? '';
                            }
                            $avatar = ($user_foto != '' && file_exists(FCPATH . ltrim($user_foto, '/'))) ? base_url($user_foto) : base_url('assets/adminlte/dist/img/avatar5.png');
                            ?>
                            <img src="<?= $avatar ?>" alt="User-Profile" class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">
                            <div class="caption ms-3 d-none d-md-block ">
                                <h6 class="mb-0 caption-title"><?= esc(session()->get('nama') ?? 'User') ?></h6>
                                <p class="mb-0 caption-sub-title"><?= esc(session()->get('role_name') ?? 'Siswa') ?></p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user fa-fw me-2"></i> Profil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-key fa-fw me-2"></i> Ganti Password</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="<?= base_url('auth/logout') ?>" onclick="logout(event); return false;"><i class="fas fa-sign-out-alt fa-fw me-2"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Nav Header Component Start -->
    <div class="iq-navbar-header position-relative" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; overflow: hidden; height: auto !important; min-height: auto !important;">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between align-items-center flex-wrap">
                        <?php
                        $fotoSiswa = (!empty($siswa->foto) && file_exists(FCPATH . ltrim($siswa->foto, '/'))) ? base_url($siswa->foto) : base_url('assets/img/siswa.png');
                        $userFirstName = '';
                        if (isset($user)) {
                            $userFirstName = is_object($user) ? ($user->first_name ?? '') : ($user['first_name'] ?? '');
                        }
                        $namaSiswa = esc($siswa->nama ?? ($userFirstName ?: (session()->get('nama') ?? 'Siswa')));
                        $nisSiswa = esc($siswa->nis ?? 'NIS');
                        $kelasSiswa = esc($siswa->nama_kelas ?? 'Kelas');
                        ?>
                        <!-- Profil Siswa: Hanya muncul di selain halaman ujian (Beranda, Materi, Tugas, dll) -->
                        <?php if (!$is_cbtsiswa): ?>
                        <div class="student-profile-wrapper d-flex align-items-center my-1">
                            <div class="d-inline-flex align-items-center text-start">
                                <img class="avatar shadow-sm flex-shrink-0" src="<?= $fotoSiswa ?>" width="64" height="64" style="border-radius: 50%; border: 3px solid rgba(255,255,255,0.3); object-fit: cover;">
                                <div class="ms-3 text-start">
                                    <h3 class="text-white mb-1 fw-bold student-name text-truncate" style="letter-spacing: 0.5px; font-size: 1.25rem;"><?= $namaSiswa ?></h3>
                                    <div class="d-flex align-items-center text-white student-meta" style="opacity: 0.9; font-size: 0.85rem;">
                                        <i class="fas fa-id-badge me-2"></i> <span><?= $nisSiswa ?></span>
                                        <span class="mx-2">|</span>
                                        <i class="fas fa-chalkboard me-2"></i> <span><?= $kelasSiswa ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Right Widgets (Di samping KANAN pada Desktop): Logo CBT MTs HISLAH (Hanya di CBT) & Widget Jam Iklim -->
                        <div class="header-right-widgets d-flex align-items-center gap-3 my-1 ms-auto ms-lg-0">
                            <!-- Logo CBT MTs HISLAH / CBT APPLICATION: Hanya muncul di halaman CBT/Ujian -->
                            <?php if ($is_cbtsiswa): ?>
                            <div class="cbt-logo-wrapper d-flex align-items-center my-1">
                                <div class="cbt-logo-container d-inline-flex align-items-center justify-content-center">
                                    <img src="<?= isset($setting) && $setting->logo_kiri != null ? base_url($setting->logo_kiri) : base_url('assets/img/favicon.png') ?>" alt="Logo" class="cbt-logo-img me-3 flex-shrink-0" width="56" height="56" style="width: 56px; height: 56px; max-width: 56px; max-height: 56px; object-fit: contain;">
                                    <div class="text-start pe-lg-3 border-end-lg">
                                        <div class="mb-0 text-white fw-bold cbt-title"><?= isset($setting) ? esc($setting->nama_aplikasi) : 'CBT MTs HISLAH' ?></div>
                                        <div class="text-white fw-semibold cbt-subtitle">C B T &nbsp; A P L I C A T I O N</div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                            <!-- Weather & Clock Widget Modern (Jam & Iklim - Hanya Desktop) -->
                            <div class="weather-widget d-none d-lg-flex align-items-center px-3 py-2 shadow-sm my-1" style="border-radius: 50px;">
                                <div class="weather-info d-flex align-items-center pe-3 border-end border-white border-opacity-25">
                                    <div id="weather-icon" class="me-2 text-white d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: rgba(255,255,255,0.2); border-radius: 50%;">
                                        <svg class="icon-24 animated-scaleX" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"></path>
                                        </svg>
                                    </div>
                                    <div class="text-start">
                                        <div class="mb-0 text-white fw-bold lh-1" id="weather-temp" style="font-size: 1.15rem; font-weight: 800;">--°C</div>
                                        <div class="text-white opacity-75 fw-semibold lh-1 mt-1" id="weather-desc" style="font-size: 0.75rem;">Memuat...</div>
                                    </div>
                                </div>
                                <div class="time-info ps-3 text-start d-flex align-items-center">
                                    <div class="me-2 text-white d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: rgba(255,255,255,0.2); border-radius: 50%;">
                                        <i class="far fa-clock text-white" style="font-size: 1.25rem;"></i>
                                    </div>
                                    <div class="text-start">
                                        <div class="mb-0 text-white fw-bold lh-1" id="live-time" style="font-size: 1.15rem; font-weight: 800; letter-spacing: 0.5px;">00:00:00</div>
                                        <div class="text-white opacity-75 fw-semibold lh-1 mt-1" id="live-date" style="font-size: 0.75rem;">--</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </div>
            </div>
        </div>
        <div class="iq-header-img" style="height: 100% !important; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; overflow: hidden; position: absolute; top: 0; left: 0; width: 100%; z-index: -1;">
            <img src="<?= base_url() ?>/assets/hopeui/images/dashboard/top-header.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100" style="object-fit: cover;">
            <img src="<?= base_url() ?>/assets/hopeui/images/dashboard/top-header1.png" alt="header" class="theme-color-purple-img img-fluid w-100 h-100" style="object-fit: cover;">
            <img src="<?= base_url() ?>/assets/hopeui/images/dashboard/top-header2.png" alt="header" class="theme-color-blue-img img-fluid w-100 h-100" style="object-fit: cover;">
            <img src="<?= base_url() ?>/assets/hopeui/images/dashboard/top-header3.png" alt="header" class="theme-color-green-img img-fluid w-100 h-100" style="object-fit: cover;">
            <img src="<?= base_url() ?>/assets/hopeui/images/dashboard/top-header4.png" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100" style="object-fit: cover;">
            <img src="<?= base_url() ?>/assets/hopeui/images/dashboard/top-header5.png" alt="header" class="theme-color-pink-img img-fluid w-100 h-100" style="object-fit: cover;">
        </div>
    </div>

    <style>
    /* Gradient Color Tint for Header Image when Custom Color selected */
    .iq-header-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100% !important;
        overflow: hidden;
    }
    
    html[data-color-format] .iq-header-img::after,
    body[data-color-format] .iq-header-img::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: var(--bs-primary, #3a57e8);
        mix-blend-mode: color;
        pointer-events: none;
    }

    /* Top Navbar Typography & Sizing */
    .school-title {
        font-size: 1.15rem;
    }
    .school-sub-info {
        font-size: 0.85rem;
        margin-top: 2px;
    }

    /* PC View Styles (LOCKED - DO NOT ALTER ON MOBILE EDITS) */
    @media (min-width: 992px) {
        .iq-navbar-header {
            padding-top: 2.25rem !important;
            padding-bottom: 6.5rem !important;
        }
        .overlap {
            margin-top: -1.5rem !important;
            position: relative;
            z-index: 10;
        }
        .cbt-logo-img {
            width: 56px !important;
            height: 56px !important;
            max-width: 56px !important;
            max-height: 56px !important;
        }
        .student-profile-wrapper {
            width: auto !important;
            margin: 0 !important;
        }
        .header-right-widgets {
            width: auto !important;
            margin-left: auto !important;
        }
        .cbt-logo-wrapper {
            width: auto !important;
            margin: 0 !important;
        }
        .border-end-lg {
            border-right: 1px solid rgba(255, 255, 255, 0.25) !important;
        }
    }
    
    .cbt-logo-img {
        width: 56px !important;
        height: 56px !important;
        max-width: 56px !important;
        max-height: 56px !important;
        object-fit: contain;
    }
    
    /* Mobile View Styles: Perfectly Centered Top-Bottom Left-Right & Balanced Overlap */
    @media (max-width: 991.98px) {
        .iq-banner:not(.hide) + .content-inner,
        .conatiner-fluid.content-inner,
        .container-fluid.content-inner,
        .main-content .content-inner {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }
        .iq-navbar-header {
            padding-top: 2rem !important;
            padding-bottom: 6.5rem !important;
        }
        .overlap,
        .app-content.overlap {
            margin-top: -4.5rem !important;
            position: relative;
            z-index: 10;
        }
        .student-profile-wrapper.d-none {
            display: none !important;
        }
        .student-profile-wrapper:not(.d-none) {
            width: 100% !important;
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            text-align: center !important;
            margin: 0 auto !important;
        }
        .student-name {
            font-size: 1.18rem !important;
        }
        .student-meta {
            font-size: 0.82rem !important;
        }
        .header-right-widgets {
            width: 100% !important;
            justify-content: center !important;
            margin: 0 auto !important;
        }
        .border-end-lg {
            border-right: none !important;
        }
        .cbt-logo-wrapper {
            width: 100% !important;
            display: flex !important;
            justify-content: center !important;
            text-align: center !important;
            margin: 0 auto !important;
        }
        .cbt-logo-container {
            margin: 0 auto !important;
            justify-content: center !important;
        }
        .cbt-logo-img {
            width: 52px;
            height: 52px;
        }
        .cbt-title {
            font-size: 1.25rem;
        }
        .cbt-subtitle {
            font-size: 0.78rem;
            letter-spacing: 0.12em;
        }
        .school-title {
            font-size: 1.02rem !important;
        }
        .school-sub-info {
            font-size: 0.76rem !important;
        }
        .btn-back-responsive {
            width: 36px !important;
            height: 36px !important;
            font-size: 0.9rem !important;
        }
            .btn-notif-mobile {
        width: 38px;
        height: 38px;
        border-radius: 50% !important;
        background: #ffffff !important;
        color: #0d6efd !important;
        border: 1.5px solid rgba(13, 110, 253, 0.3) !important;
        font-size: 1.05rem;
        transition: all 0.2s ease;
        position: relative;
    }
    .btn-notif-mobile:hover, .btn-notif-mobile:active {
        background: #0d6efd !important;
        color: #ffffff !important;
        transform: scale(1.05);
    }

    .btn-logout-mobile {
            width: 36px !important;
            height: 36px !important;
            font-size: 0.9rem !important;
        }
    }

    @media (max-width: 400px) {
        .student-name {
            font-size: 1.05rem !important;
        }
        .student-meta {
            font-size: 0.78rem !important;
        }
        .school-title {
            font-size: 0.92rem !important;
        }
        .school-sub-info {
            font-size: 0.70rem !important;
        }
        .cbt-logo-img {
            width: 44px;
            height: 44px;
            margin-right: 0.65rem !important;
        }
        .cbt-title {
            font-size: 1.1rem;
        }
        .cbt-subtitle {
            font-size: 0.68rem;
            letter-spacing: 0.08em;
        }
    }

    .btn-back-responsive {
        width: 36px;
        height: 36px;
        border-radius: 50% !important;
        padding: 0 !important;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }
    @media (min-width: 992px) {
        .btn-back-responsive {
            width: auto;
            height: auto;
            border-radius: 50px !important;
            padding: 0.45rem 1.25rem !important;
            font-size: 0.9rem;
        }
    }

        .btn-notif-mobile {
        width: 38px;
        height: 38px;
        border-radius: 50% !important;
        background: #ffffff !important;
        color: #0d6efd !important;
        border: 1.5px solid rgba(13, 110, 253, 0.3) !important;
        font-size: 1.05rem;
        transition: all 0.2s ease;
        position: relative;
    }
    .btn-notif-mobile:hover, .btn-notif-mobile:active {
        background: #0d6efd !important;
        color: #ffffff !important;
        transform: scale(1.05);
    }

    .btn-logout-mobile {
        width: 36px;
        height: 36px;
        border-radius: 50% !important;
        background: rgba(220, 53, 69, 0.12) !important;
        color: #dc3545 !important;
        border: 1px solid rgba(220, 53, 69, 0.25) !important;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }
    .btn-logout-mobile:hover {
        background: #dc3545 !important;
        color: #ffffff !important;
    }

    .weather-widget {
        background: rgba(255, 255, 255, 0.18) !important;
        backdrop-filter: blur(16px) !important;
        -webkit-backdrop-filter: blur(16px) !important;
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
        border-radius: 14px !important;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12) !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .weather-widget:hover {
        background: rgba(255, 255, 255, 0.25) !important;
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.18) !important;
    }
    </style>
    <!-- Nav Header Component End -->
</div>
