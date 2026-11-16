<style>
@media (max-width: 1199.98px) {
    .iq-navbar .navbar-inner {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        position: relative !important;
        padding-left: 0.75rem !important;
        padding-right: 0.75rem !important;
    }
    .iq-navbar .navbar-brand-mobile-center {
        position: absolute !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        margin: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        max-width: calc(100% - 110px) !important;
        text-align: center !important;
    }
    .iq-navbar .navbar-brand-mobile-center .logo-title {
        font-size: 1.05rem !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
    }
    .iq-navbar .navbar-toggler {
        display: none !important;
    }
}
@media (min-width: 1200px) {
    .navbar-tp-desktop-center {
        position: absolute !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        z-index: 990;
    }
}
.iq-navbar, .iq-navbar .navbar-inner {
    overflow: visible !important;
}
.nav-item.dropdown {
    position: relative !important;
}
.nav-item.dropdown .dropdown-menu {
    top: 100% !important;
    right: 0 !important;
    left: auto !important;
    transform: none !important;
    margin-top: 8px !important;
    border-radius: 12px !important;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
}
.nav-item.dropdown .dropdown-menu.show {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
    z-index: 99999 !important;
}
</style>
<script>
(function() {
    function initProfileDropdown() {
        document.addEventListener('click', function(e) {
            var toggle = e.target.closest('#navbarDropdown, .iq-navbar .dropdown-toggle');
            if (toggle) {
                e.preventDefault();
                e.stopPropagation();
                var dropdown = toggle.closest('.dropdown');
                var menu = dropdown ? dropdown.querySelector('.dropdown-menu') : null;
                if (menu) {
                    var willShow = !menu.classList.contains('show');
                    document.querySelectorAll('.dropdown-menu.show').forEach(function(m) {
                        m.classList.remove('show');
                    });
                    document.querySelectorAll('.dropdown.show').forEach(function(d) {
                        d.classList.remove('show');
                    });
                    if (willShow) {
                        menu.classList.add('show');
                        dropdown.classList.add('show');
                        toggle.setAttribute('aria-expanded', 'true');
                    } else {
                        toggle.setAttribute('aria-expanded', 'false');
                    }
                }
                return;
            }

            // Klik di luar dropdown menutup menu
            if (!e.target.closest('.dropdown-menu')) {
                document.querySelectorAll('.iq-navbar .dropdown-menu.show').forEach(function(m) {
                    m.classList.remove('show');
                });
                document.querySelectorAll('.iq-navbar .dropdown.show').forEach(function(d) {
                    d.classList.remove('show');
                });
                document.querySelectorAll('.iq-navbar .dropdown-toggle[aria-expanded="true"]').forEach(function(t) {
                    t.setAttribute('aria-expanded', 'false');
                });
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initProfileDropdown);
    } else {
        initProfileDropdown();
    }
})();
</script>
<div class="position-relative iq-banner">
    <!--Nav Start-->
    <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
        <div class="container-fluid navbar-inner position-relative">
            <div class="sidebar-toggle" data-toggle="sidebar" data-active="true" title="Menu Navigasi" role="button" aria-label="Toggle navigation">
                <i class="icon d-flex align-items-center justify-content-center">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </i>
            </div>
            
            <a href="<?= base_url() ?>" class="navbar-brand d-xl-none navbar-brand-mobile-center align-items-center">
                <?php 
                if (!isset($setting) || empty($setting)) {
                    try {
                        $setting = (new \App\Models\DashboardModel())->getSetting();
                    } catch (\Throwable $e) {}
                }
                $logo_app = isset($setting) && !empty($setting->logo_kiri) ? base_url($setting->logo_kiri) : base_url('assets/img/favicon.png'); 
                $nama_app = isset($setting) && !empty($setting->nama_aplikasi) ? $setting->nama_aplikasi : 'NextGenCBT';
                ?>
                <div class="logo-main d-flex align-items-center">
                    <img src="<?= $logo_app ?>" alt="Logo" style="height: 32px; width: auto; max-width: 40px; object-fit: contain;">
                </div>
                <!--logo End-->
                <h4 class="logo-title m-0 ms-2"><?= esc($nama_app) ?></h4>
            </a>

            <!-- Mobile Logout Icon Only (Pojok Kanan Atas Versi Mobile) -->
            <a href="<?= base_url('auth/logout') ?>" onclick="logout(event); return false;" class="d-xl-none text-danger ms-auto p-2 d-flex align-items-center justify-content-center" style="font-size: 1.35rem;" title="Logout">
                <i class="fas fa-sign-out-alt"></i>
            </a>

            <div class="input-group search-input d-none">
                <span class="input-group-text" id="search-input">
                  <svg width="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                      <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                  </svg>
                </span>
                <input type="search" class="form-control" placeholder="Search...">
            </div>
            
            <!-- TP & Semester Info for Desktop (Dead Center in Top Bar) -->
            <div class="d-none d-xl-flex align-items-center justify-content-center px-4 py-2 bg-primary text-white rounded-pill shadow-sm navbar-tp-desktop-center" style="font-size: 0.85rem; letter-spacing: 0.3px;">
                <span class="d-flex align-items-center me-3">
                    <iconify-icon icon="lucide:calendar-days" class="me-2" style="font-size: 1.15rem; vertical-align: middle;"></iconify-icon>
                    <span>Tahun Pelajaran: <strong class="fw-bold"><?= isset($tp_active) ? esc($tp_active->tahun) : "Belum di set" ?></strong></span>
                </span>
                <span class="opacity-50 me-3">|</span>
                <span class="d-flex align-items-center">
                    <iconify-icon icon="lucide:layers" class="me-2" style="font-size: 1.15rem; vertical-align: middle;"></iconify-icon>
                    <span>Semester: <strong class="fw-bold"><?= isset($smt_active) ? esc($smt_active->nama_smt) : "Belum di set" ?></strong></span>
                </span>
            </div>

            <div class="d-none d-xl-flex align-items-center ms-auto" id="navbarSupportedContent" style="z-index: 1005;">
                <ul class="navbar-nav ms-auto navbar-list mb-0 align-items-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link py-0 d-flex align-items-center dropdown-toggle" href="javascript:void(0);" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                            <?php 
                            $user_foto = '';
                            if (isset($user->foto)) $user_foto = $user->foto;
                            elseif (isset($guru->foto)) $user_foto = $guru->foto;
                            elseif (isset($siswa->foto)) $user_foto = $siswa->foto;
                            elseif (is_array($user ?? null) && isset($user['foto'])) $user_foto = $user['foto'];
                            
                            $avatar = ($user_foto != '' && file_exists(FCPATH . $user_foto)) ? base_url($user_foto) : base_url('assets/adminlte/dist/img/avatar5.png');
                            ?>
                            <img src="<?= $avatar ?>" alt="User-Profile" class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">
                            <div class="caption ms-3 d-none d-md-block text-start">
                                <h6 class="mb-0 caption-title fw-bold" style="font-weight: 700 !important;"><?= esc(session()->get('nama') ?? 'User') ?></h6>
                                <p class="mb-0 caption-sub-title small" style="font-size: 0.75rem;"><?= esc(session()->get('role_name') ?? 'Administrator') ?></p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="navbarDropdown" style="z-index: 9999; min-width: 200px;">
                            <li><a class="dropdown-item py-2 fw-semibold" href="<?= base_url('useradmin/profile') ?>"><i class="fas fa-user fa-fw me-2 text-primary"></i> Profil</a></li>
                            <li><a class="dropdown-item py-2 fw-semibold" href="<?= base_url('useradmin/gantipassword') ?>"><i class="fas fa-key fa-fw me-2 text-warning"></i> Ganti Password</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item py-2 text-danger fw-semibold" href="<?= base_url('auth/logout') ?>" onclick="logout(event); return false;"><i class="fas fa-sign-out-alt fa-fw me-2"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Nav Header Component Start -->
    <div class="iq-navbar-header" style="height: 215px;">
        <div class="container-fluid iq-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="flex-wrap d-flex justify-content-between align-items-center">
                        <div>
                            <?php
                            $hour = (int) date('H');
                            if ($hour >= 3 && $hour < 11) {
                                $sapaan = 'Pagi yang cerah';
                            } elseif ($hour >= 11 && $hour < 15) {
                                $sapaan = 'Siang yang cerah';
                            } elseif ($hour >= 15 && $hour < 18) {
                                $sapaan = 'Sore yang indah';
                            } else {
                                $sapaan = 'Malam yang tenang';
                            }
                            ?>
                            <h2 class="fw-bold mb-1 text-white" style="font-size: 1.6rem;"><?= $sapaan ?>, <?= esc(session()->get('nama') ?? 'User') ?>!</h2>
                            <p class="mb-0 text-white" style="font-size: 1.15rem; opacity: 0.95;">Selamat datang di <?= isset($setting->sekolah) ? esc($setting->sekolah) : (is_array($setting ?? null) && isset($setting['sekolah']) ? esc($setting['sekolah']) : 'Sekolah') ?>.</p>
                        </div>
                        <!-- Weather & Clock Widget Compact Modern Capsule -->
                        <div class="weather-widget d-none d-lg-flex align-items-center shadow-sm my-1">
                            <!-- Iklim / Cuaca -->
                            <div class="weather-info d-flex align-items-center pe-3 border-end border-white border-opacity-25">
                                <div id="weather-icon" class="weather-icon-badge me-2 text-white">
                                    <svg class="animated-scaleX" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"></path>
                                    </svg>
                                </div>
                                <div class="text-start">
                                    <div class="mb-0 text-white fw-bold lh-1" id="weather-temp">--&deg;C</div>
                                    <div class="text-white opacity-75 fw-semibold lh-1 mt-1" id="weather-desc">Memuat...</div>
                                </div>
                            </div>
                            <!-- Jam & Tanggal -->
                            <div class="time-info ps-3 d-flex align-items-center text-start">
                                <div class="clock-icon-badge me-2 text-white">
                                    <i class="far fa-clock"></i>
                                </div>
                                <div>
                                    <div class="mb-0 text-white fw-bold lh-1" id="live-time">00:00:00</div>
                                    <div class="text-white opacity-75 fw-semibold lh-1 mt-1" id="live-date">--</div>
                                </div>
                            </div>
                        </div>
                        <style>
                        .weather-widget {
                            background: linear-gradient(135deg, rgba(255, 255, 255, 0.22) 0%, rgba(255, 255, 255, 0.08) 100%);
                            backdrop-filter: blur(16px);
                            -webkit-backdrop-filter: blur(16px);
                            border: 1px solid rgba(255, 255, 255, 0.35);
                            border-radius: 50px;
                            padding: 8px 18px;
                            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12), inset 0 1px 1px rgba(255, 255, 255, 0.4);
                            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
                        }
                        .weather-widget:hover {
                            background: linear-gradient(135deg, rgba(255, 255, 255, 0.28) 0%, rgba(255, 255, 255, 0.14) 100%);
                            transform: translateY(-2px);
                            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.16), inset 0 1px 2px rgba(255, 255, 255, 0.5);
                        }
                        .weather-icon-badge,
                        .clock-icon-badge {
                            width: 36px;
                            height: 36px;
                            border-radius: 50%;
                            background: rgba(255, 255, 255, 0.2);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            flex-shrink: 0;
                        }
                        .weather-icon-badge svg {
                            width: 22px !important;
                            height: 22px !important;
                        }
                        .clock-icon-badge i {
                            font-size: 1.05rem;
                        }
                        #weather-temp,
                        #live-time {
                            font-size: 1.15rem;
                            font-weight: 800;
                        }
                        #live-time {
                            letter-spacing: 0.5px;
                        }
                        #weather-desc,
                        #live-date {
                            font-size: 0.72rem;
                        }
                        </style>
                    </div>
                </div>
            </div>
        </div>
        <div class="iq-header-img">
            <img src="<?= base_url() ?>/assets/hopeui/images/dashboard/top-header.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
            <img src="<?= base_url() ?>/assets/hopeui/images/dashboard/top-header1.png" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
            <img src="<?= base_url() ?>/assets/hopeui/images/dashboard/top-header2.png" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
            <img src="<?= base_url() ?>/assets/hopeui/images/dashboard/top-header3.png" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
            <img src="<?= base_url() ?>/assets/hopeui/images/dashboard/top-header4.png" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
            <img src="<?= base_url() ?>/assets/hopeui/images/dashboard/top-header5.png" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
        </div>
    </div>
    <!-- Nav Header Component End -->
</div>






<script>
document.addEventListener('DOMContentLoaded', function() {
    function updateClock() {
        const now = new Date();
        const timeStr = now.toLocaleTimeString('id-ID', { hour12: false, hour: '2-digit', minute: '2-digit', second: '2-digit' });
        const dateStr = now.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
        const timeEl = document.getElementById('live-time');
        const dateEl = document.getElementById('live-date');
        if (timeEl) timeEl.innerText = timeStr;
        if (dateEl) dateEl.innerText = dateStr;
    }
    setInterval(updateClock, 1000);
    updateClock();
});
</script>