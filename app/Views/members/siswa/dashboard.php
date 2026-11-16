<?= $this->extend('layout/dashboard_template_bs5_siswa') ?>
<?= $this->section('content') ?>

<?php
/**
 * Modern Beranda Siswa matching Materi Page (/kbm/materi) Layout
 */
?>

<div class="d-contents">
    <div class="sticky"></div>
    <div class="app-content overlap pb-5">
        <div class="container">
            <!-- Top Hero Banner & Student Widget -->
            <?= $this->include('members/siswa/templates/top') ?>

            <!-- Banner Slider Carousel (Auto-slide, 2 banners on PC, 1 centered banner with left/right peek on Mobile) -->
            <?php
            $defaultApkLink = \App\Models\BannerModel::resolveSchoolApkLink('downloads/CBT_Resmi.apk');
            $bannerList = isset($banners) && !empty($banners) ? $banners : [
                (object)[
                    'id_banner'   => 1,
                    'judul'       => 'Aplikasi Android CBT Resmi Telah Tersedia!',
                    'subjudul'    => 'Download dan pasang APK ini di HP Anda untuk mengikuti ujian dengan aman dan nyaman tanpa kendala.',
                    'gambar'      => null,
                    'url_link'    => $defaultApkLink,
                    'tombol_teks' => 'Download APK Siswa',
                    'warna_bg'    => 'linear-gradient(135deg, #1e3c72 0%, #2a5298 100%)'
                ],
                (object)[
                    'id_banner'   => 2,
                    'judul'       => 'E-Learning & Perpustakaan Digital Sekolah',
                    'subjudul'    => 'Baca buku digital perpustakaan, materi ajar guru, dan kerjakan tugas interaktif secara langsung.',
                    'gambar'      => null,
                    'url_link'    => 'cbtsiswa/cbt',
                    'tombol_teks' => 'Buka Materi & Buku',
                    'warna_bg'    => 'linear-gradient(135deg, #0d9488 0%, #065f46 100%)'
                ],
                (object)[
                    'id_banner'   => 3,
                    'judul'       => 'Jadwal Pelajaran & Kalender Akademik',
                    'subjudul'    => 'Pantau jadwal tatap muka kelas, alokasi waktu jam belajar, dan agenda ujian semester.',
                    'gambar'      => null,
                    'url_link'    => 'cbtsiswa/cbt',
                    'tombol_teks' => 'Lihat Jadwal Kelas',
                    'warna_bg'    => 'linear-gradient(135deg, #7c3aed 0%, #4c1d95 100%)'
                ]
            ];
            ?>

            <style>
                .cbt-banner-section {
                    position: relative;
                    margin-bottom: 1.5rem;
                    user-select: none;
                    width: 100%;
                    max-width: 100%;
                    overflow: hidden;
                }
                .cbt-banner-viewport {
                    overflow: hidden;
                    width: 100%;
                    max-width: 100%;
                    border-radius: 16px;
                    padding: 0;
                    height: 190px;
                    position: relative;
                }
                .cbt-banner-track {
                    display: flex;
                    align-items: stretch;
                    height: 100%;
                    transition: transform 0.45s cubic-bezier(0.25, 1, 0.5, 1);
                    will-change: transform;
                }
                .cbt-banner-slide {
                    flex: 0 0 auto;
                    height: 100%;
                    max-width: 100%;
                    box-sizing: border-box;
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                    overflow: hidden;
                    border-radius: 16px;
                }
                .cbt-banner-card {
                    width: 100%;
                    height: 100%;
                    max-height: 100%;
                    border-radius: 16px;
                    overflow: hidden;
                    position: relative;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
                    transition: transform 0.25s ease, box-shadow 0.25s ease;
                    text-decoration: none !important;
                }
                .cbt-banner-card:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.14);
                }
                .cbt-banner-pure-img {
                    width: 100% !important;
                    height: 100% !important;
                    max-height: 100% !important;
                    object-fit: cover !important;
                    object-position: center !important;
                    border-radius: 16px !important;
                    display: block !important;
                }
                .cbt-banner-img-bg {
                    position: absolute;
                    inset: 0;
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    z-index: 1;
                }
                .cbt-banner-overlay {
                    position: absolute;
                    inset: 0;
                    background: linear-gradient(180deg, rgba(15, 23, 42, 0.1) 0%, rgba(15, 23, 42, 0.85) 100%);
                    z-index: 2;
                }
                .cbt-banner-content {
                    position: relative;
                    z-index: 3;
                    padding: 1.25rem 1.5rem;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    gap: 1rem;
                    height: 100%;
                }
                .cbt-banner-title {
                    font-size: 1.15rem;
                    font-weight: 700;
                    color: #ffffff;
                    margin-bottom: 0.3rem;
                    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.35);
                    line-height: 1.3;
                }
                .cbt-banner-desc {
                    font-size: 0.82rem;
                    color: rgba(255, 255, 255, 0.88);
                    margin-bottom: 0;
                    line-height: 1.4;
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
                }
                .cbt-banner-icon-badge {
                    width: 48px;
                    height: 48px;
                    border-radius: 12px;
                    background: rgba(255, 255, 255, 0.18);
                    backdrop-filter: blur(4px);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: #ffffff;
                    font-size: 1.4rem;
                    flex-shrink: 0;
                    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
                }
                .cbt-banner-btn {
                    white-space: nowrap;
                    font-size: 0.82rem;
                    font-weight: 600;
                    padding: 0.5rem 1.1rem;
                    border-radius: 50px;
                    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
                    transition: transform 0.2s, background-color 0.2s;
                    flex-shrink: 0;
                }
                .cbt-banner-btn:hover {
                    transform: scale(1.04);
                }
                .cbt-banner-nav {
                    position: absolute;
                    top: 50%;
                    transform: translateY(-50%);
                    width: 36px;
                    height: 36px;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.9);
                    border: 1px solid rgba(0, 0, 0, 0.08);
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                    color: #1e293b;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    cursor: pointer;
                    z-index: 10;
                    transition: all 0.2s;
                }
                .cbt-banner-nav:hover {
                    background: #ffffff;
                    color: #0284c7;
                    transform: translateY(-50%) scale(1.1);
                }
                .cbt-banner-prev { left: -14px; }
                .cbt-banner-next { right: -14px; }
                .cbt-banner-dots {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 6px;
                    margin-top: 10px;
                }
                .cbt-banner-dot {
                    width: 8px;
                    height: 8px;
                    border-radius: 4px;
                    background: #cbd5e1;
                    transition: all 0.3s;
                    cursor: pointer;
                }
                .cbt-banner-dot.active {
                    width: 24px;
                    background: #0284c7;
                }

                /* Responsive rules: PC (2 banners) vs Mobile (1 banner centered with left/right peek) */
                @media (min-width: 768px) {
                    .cbt-banner-viewport {
                        height: 190px !important;
                    }
                    .cbt-banner-slide {
                        width: calc((100% - 16px) / 2);
                        margin-right: 16px;
                        height: 190px !important;
                    }
                    .cbt-banner-card {
                        height: 190px !important;
                    }
                    .cbt-banner-pure-img {
                        height: 190px !important;
                    }
                }
                @media (max-width: 767.98px) {
                    .cbt-banner-viewport {
                        height: 155px !important;
                        overflow: hidden;
                    }
                    .cbt-banner-slide {
                        width: 82% !important;
                        margin-right: 12px;
                        height: 155px !important;
                    }
                    .cbt-banner-slide.active {
                        transform: scale(1);
                    }
                    .cbt-banner-slide:not(.active) {
                        transform: scale(0.96);
                        opacity: 0.88;
                    }
                    .cbt-banner-card {
                        height: 155px !important;
                        max-height: 155px !important;
                    }
                    .cbt-banner-pure-img {
                        height: 155px !important;
                        max-height: 155px !important;
                    }
                    .cbt-banner-content {
                        flex-direction: column;
                        align-items: flex-start;
                        justify-content: space-between;
                        padding: 1.1rem;
                    }
                    .cbt-banner-title {
                        font-size: 1rem;
                    }
                    .cbt-banner-nav {
                        display: none !important;
                    }
                }

                .menu-notif-badge {
                    position: absolute;
                    top: -2px;
                    right: -4px;
                    min-width: 20px;
                    height: 20px;
                    padding: 0 5px;
                    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
                    color: #ffffff;
                    font-size: 0.72rem;
                    font-weight: 700;
                    line-height: 18px;
                    border: 2px solid #ffffff;
                    border-radius: 999px;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    box-shadow: 0 2px 8px rgba(239, 68, 68, 0.45);
                    z-index: 5;
                    animation: pulseMenuBadge 2.2s infinite ease-in-out;
                }
                @keyframes pulseMenuBadge {
                    0% { transform: scale(1); }
                    50% { transform: scale(1.15); }
                    100% { transform: scale(1); }
                }
            </style>

            <div class="row">
                <div class="col-12">
                    <div class="cbt-banner-section" id="cbtBannerSection">
                        <!-- Left & Right Nav Arrows (Desktop) -->
                        <button type="button" class="cbt-banner-nav cbt-banner-prev" id="cbtBannerPrev" title="Sebelumnya">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button type="button" class="cbt-banner-nav cbt-banner-next" id="cbtBannerNext" title="Berikutnya">
                            <i class="fas fa-chevron-right"></i>
                        </button>

                        <!-- Viewport Container -->
                        <?php
                        $filteredBanners = [];
                        $showJadwalBanner = ($setting->fitur_jadwal ?? '1') != '0';
                        foreach ($bannerList as $bItem) {
                            $bItemArr = (array)$bItem;
                            $bLink = $bItemArr['url_link'] ?? '';
                            $bJudul = strtolower($bItemArr['judul'] ?? '');
                            if (!$showJadwalBanner && (strpos($bLink, 'jadwal') !== false || strpos($bJudul, 'jadwal') !== false)) {
                                continue;
                            }
                            if ($bLink === 'jadwalpelajaran') {
                                if (is_object($bItem)) $bItem->url_link = 'cbtsiswa/cbt';
                                else $bItem['url_link'] = 'cbtsiswa/cbt';
                            }
                            $filteredBanners[] = $bItem;
                        }
                        $bannerList = $filteredBanners;
                        ?>
                        <div class="cbt-banner-viewport" id="cbtBannerViewport">
                            <div class="cbt-banner-track" id="cbtBannerTrack">
                                <?php foreach ($bannerList as $idx => $b): 
                                    $bData = (array)$b;
                                    $rawLink = $bData['url_link'] ?? '';
                                    $lowerJudul = strtolower($bData['judul'] ?? '');
                                    $isApkBanner = (stripos($rawLink, '.apk') !== false || strpos($lowerJudul, 'apk') !== false || strpos($lowerJudul, 'android') !== false);
                                    $targetUrl = !empty($bData['url_link']) ? (filter_var($bData['url_link'], FILTER_VALIDATE_URL) ? $bData['url_link'] : base_url($bData['url_link'])) : '#';
                                    $cleanApkPath = parse_url($rawLink, PHP_URL_PATH) ?: 'app.apk';
                                    $apkDownloadAttr = $isApkBanner ? 'download="' . esc(basename($cleanApkPath)) . '" data-apk-banner="1"' : '';
                                    $hasImg = !empty($bData['gambar']) && file_exists(FCPATH . $bData['gambar']);
                                    $bgStyle = !empty($bData['warna_bg']) ? $bData['warna_bg'] : 'linear-gradient(135deg, #1e3c72 0%, #2a5298 100%)';
                                    
                                    // Deteksi icon berdasarkan judul / link
                                    $iconClass = 'fas fa-bullhorn';
                                    if (strpos($lowerJudul, 'android') !== false || strpos($lowerJudul, 'apk') !== false) {
                                        $iconClass = 'fab fa-android text-warning';
                                    } elseif (strpos($lowerJudul, 'elearning') !== false || strpos($lowerJudul, 'materi') !== false || strpos($lowerJudul, 'buku') !== false) {
                                        $iconClass = 'fas fa-book-reader text-warning';
                                    } elseif (strpos($lowerJudul, 'jadwal') !== false || strpos($lowerJudul, 'kalender') !== false) {
                                        $iconClass = 'fas fa-calendar-alt text-warning';
                                    } elseif (strpos($lowerJudul, 'ujian') !== false || strpos($lowerJudul, 'cbt') !== false) {
                                        $iconClass = 'fas fa-laptop-code text-warning';
                                    }
                                ?>
                                    <div class="cbt-banner-slide <?= ($idx === 0) ? 'active' : '' ?>" data-index="<?= $idx ?>">
                                        <a href="<?= esc($targetUrl) ?>" <?= $apkDownloadAttr ?> <?= $isApkBanner ? 'onclick="handleApkBannerClick(event, \'' . esc($targetUrl, 'js') . '\', \'' . esc($bData['judul'], 'js') . '\')"' : '' ?> class="cbt-banner-card" style="<?= $hasImg ? 'background: #f8fafc;' : 'background: ' . esc($bgStyle) . ';' ?>" <?= (!empty($bData['url_link']) && filter_var($bData['url_link'], FILTER_VALIDATE_URL)) ? 'target="_blank" rel="noopener noreferrer"' : '' ?>>
                                            <?php if ($hasImg): ?>
                                                <!-- Tampilan Banner Gambar Grafis Penuh (Seperti PLN Mobile / E-Commerce) -->
                                                <img src="<?= base_url($bData['gambar']) ?>" alt="<?= esc($bData['judul']) ?>" class="cbt-banner-pure-img" style="width: 100% !important; height: 100% !important; max-height: 100% !important; object-fit: cover !important; object-position: center !important; border-radius: 16px !important; display: block !important;" loading="lazy">
                                            <?php else: ?>
                                                <!-- Tampilan Banner Kartu Gradasi Dinamis (Jika tanpa gambar) -->
                                                <div class="cbt-banner-content">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="cbt-banner-icon-badge d-none d-sm-flex">
                                                            <i class="<?= $iconClass ?>"></i>
                                                        </div>
                                                        <div>
                                                            <h5 class="cbt-banner-title"><?= esc($bData['judul']) ?></h5>
                                                            <?php if (!empty($bData['subjudul'])): ?>
                                                                <p class="cbt-banner-desc"><?= esc($bData['subjudul']) ?></p>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>

                                                    <?php if (!empty($bData['url_link'])): ?>
                                                        <div class="mt-2 mt-md-0">
                                                            <span class="btn btn-warning text-dark cbt-banner-btn">
                                                                <?php if (strpos(strtolower($bData['tombol_teks'] ?? ''), 'download') !== false): ?>
                                                                    <i class="fas fa-download me-1"></i>
                                                                <?php else: ?>
                                                                    <i class="fas fa-arrow-right me-1"></i>
                                                                <?php endif; ?>
                                                                <?= esc($bData['tombol_teks'] ?? 'Lihat Detail') ?>
                                                            </span>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Dot Indicators -->
                        <div class="cbt-banner-dots" id="cbtBannerDots">
                            <?php foreach ($filteredBanners as $idx => $b): ?>
                                <span class="cbt-banner-dot <?= ($idx === 0) ? 'active' : '' ?>" data-index="<?= $idx ?>" onclick="goToBannerSlide(<?= $idx ?>)"></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <script>
                        function handleApkBannerClick(e, url, title) {
                            if (!url || url === '#' || url.indexOf('javascript') === 0) return;

                            var isApp = !!(window.CbtBridge || /CbtExamApp|Exambro|Candy|FlyExam|Nextgen/i.test(navigator.userAgent));

                            if (window.CbtBridge) {
                                if (typeof window.CbtBridge.downloadApk === 'function') {
                                    e.preventDefault();
                                    window.CbtBridge.downloadApk(url);
                                    return false;
                                }
                                if (typeof window.CbtBridge.openBrowser === 'function') {
                                    e.preventDefault();
                                    window.CbtBridge.openBrowser(url);
                                    return false;
                                }
                                if (typeof window.CbtBridge.openExternal === 'function') {
                                    e.preventDefault();
                                    window.CbtBridge.openExternal(url);
                                    return false;
                                }
                            }

                            // Jika di dalam WebView Android dan mengunduh APK
                            if (isApp && url.indexOf('.apk') !== -1) {
                                e.preventDefault();

                                var cleanUrl = url.replace(/^https?:\/\//i, '');
                                var scheme = url.indexOf('https') === 0 ? 'https' : 'http';
                                var intentUrl = 'intent://' + cleanUrl + '#Intent;scheme=' + scheme + ';action=android.intent.action.VIEW;end';

                                if (typeof swal !== 'undefined' && swal.fire) {
                                    swal.fire({
                                        title: 'Unduh Pembaruan Aplikasi',
                                        html: '<div class="text-start" style="font-size: 0.92rem; line-height: 1.5;">' +
                                              '<p class="mb-2">Aplikasi: <strong class="text-primary">' + (title || 'APK Terbaru') + '</strong></p>' +
                                              '<div class="p-2 mb-3 bg-light rounded border text-muted small">' +
                                              '<i class="fas fa-info-circle text-info me-1"></i> Untuk mengunduh & memasang pembaruan versi baru, silakan buka melalui browser HP (Chrome) atau unduh langsung.' +
                                              '</div>' +
                                              '<a href="' + intentUrl + '" class="btn btn-warning text-dark fw-bold w-100 mb-2 py-2 shadow-sm d-flex align-items-center justify-content-center">' +
                                              '   <i class="fab fa-chrome fa-lg me-2"></i> Buka di Browser HP (Chrome)' +
                                              '</a>' +
                                              '<a href="' + url + '" target="_blank" download class="btn btn-outline-primary fw-semibold w-100 mb-2 py-2 d-flex align-items-center justify-content-center">' +
                                              '   <i class="fas fa-download me-2"></i> Download Langsung' +
                                              '</a>' +
                                              '<button type="button" onclick="navigator.clipboard.writeText(\'' + url + '\'); swal.showValidationMessage(\'Link berhasil disalin! Buka Chrome lalu paste link.\');" class="btn btn-outline-secondary btn-sm w-100">' +
                                              '   <i class="fas fa-copy me-1"></i> Salin Tautan Download' +
                                              '</button>' +
                                              '</div>',
                                        icon: 'info',
                                        showConfirmButton: true,
                                        confirmButtonText: 'Tutup',
                                        confirmButtonColor: '#6c757d'
                                    });
                                } else {
                                    window.location.href = url;
                                }
                                return false;
                            }
                        }

                        (function() {
                            try {
                                var ver = (window.CbtBridge && typeof window.CbtBridge.getAppVersion === 'function') ? window.CbtBridge.getAppVersion() : '';
                                if (!ver && navigator.userAgent) {
                                    var m = navigator.userAgent.match(/CbtExamApp\/([0-9.]+)/i) || navigator.userAgent.match(/CbtApp\/([0-9.]+)/i);
                                    if (m && m[1]) ver = m[1];
                                }
                                if (ver) {
                                    var apkCards = document.querySelectorAll('a[data-apk-banner="1"]');
                                    apkCards.forEach(function(card) {
                                        var descEl = card.querySelector('.cbt-banner-desc');
                                        if (descEl && descEl.innerHTML.indexOf('Terpasang') === -1) {
                                            descEl.innerHTML += ' <span class="badge bg-light text-dark border ms-1"><i class="fas fa-mobile-alt me-1"></i> Terpasang: v' + ver + '</span>';
                                        }
                                    });
                                }
                            } catch (e) {}
                        })();
                    </script>
                </div>
            </div>

            <!-- Card 1: Menu Utama (Sesuai Layout Materi) -->
            <div class="row">
                <div class="col-12">
                    <div class="card my-shadow mb-4 border-0" style="border-radius: 15px; overflow: hidden;">
                        <div class="card-header d-flex justify-content-between align-items-center py-3 border-bottom">
                            <h6 class="text-center w-100 fw-bold mb-0 text-uppercase" style="letter-spacing: 0.05em;">
                                <i class="fas fa-th-large text-primary me-2"></i> MENU UTAMA
                            </h6>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <?php foreach ($menu as $m): 
                                    if (($setting->fitur_jadwal ?? '1') == '0' && stripos($m->title, 'jadwal') !== false) {
                                        continue;
                                    }
                                    $menuKey = '';
                                    if (strpos(strtolower($m->title), 'ujian') !== false) {
                                        $menuKey = 'ujian';
                                    } elseif (strpos(strtolower($m->title), 'tugas') !== false) {
                                        $menuKey = 'tugas';
                                    }
                                ?>
                                    <div class="col-lg-2 col-md-3 col-sm-4 col-4 text-center">
                                        <a href="<?= base_url($m->link) ?>" class="text-decoration-none text-body d-block p-2 rounded-3 hover-bg-light transition">
                                            <div class="position-relative d-inline-block">
                                                <img class="img-fluid mb-2" src="<?= base_url() ?>/assets/app/img/<?= $m->icon ?>" width="72" height="72" alt="<?= esc($m->title) ?>"/>
                                                <?php if ($menuKey): ?>
                                                    <span class="menu-notif-badge d-none" id="menu-badge-<?= $menuKey ?>"></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="fw-semibold small text-truncate"><?= esc($m->title) ?></div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2 & 3: Info/Pengumuman & Jadwal Hari Ini -->
            <?php $showJadwalSiswa = ($setting->fitur_jadwal ?? '1') != '0'; ?>
            <div class="row">
                <!-- Info / Pengumuman -->
                <div class="col-12 <?= $showJadwalSiswa ? 'col-md-7 d-none d-md-block' : 'col-md-12' ?>">
                    <div class="card my-shadow mb-4 border-0" style="border-radius: 15px; overflow: hidden;">
                        <div class="card-header d-flex justify-content-between align-items-center py-3 border-bottom">
                            <h6 class="text-center w-100 fw-bold mb-0 text-uppercase" style="letter-spacing: 0.05em;">
                                <i class="fas fa-bullhorn text-success me-2"></i> INFO / PENGUMUMAN
                            </h6>
                        </div>
                        <div class="card-body p-4" style="min-height: 250px;">
                            <div class="konten-pengumuman">
                                <div id="pengumuman"></div>
                                <p id="loading-post" class="text-center d-none my-3 text-muted">
                                    <i class="fas fa-spinner fa-spin me-1"></i> Memuat pengumuman...
                                </p>
                                <div id="loadmore-post" onclick="getPosts()" class="text-center mt-3 d-none">
                                    <button class="btn btn-outline-secondary btn-sm rounded-pill px-4">Muat Timeline lainnya...</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($showJadwalSiswa): ?>
                <div class="col-12 col-md-5">
                    <div class="card my-shadow mb-4 border-0" style="border-radius: 15px; overflow: hidden;">
                        <div class="card-header d-flex justify-content-between align-items-center py-3 border-bottom">
                            <h6 class="fw-bold mb-0 text-uppercase" style="letter-spacing: 0.05em;">
                                <i class="far fa-calendar-alt text-danger me-2"></i> JADWAL HARI INI
                            </h6>
                            <button type="button" onclick="loadJadwal()" class="btn btn-sm btn-light rounded-pill px-3 shadow-sm text-danger fw-semibold">
                                <i class="fas fa-sync-alt me-1"></i> Reload
                            </button>
                        </div>
                        <div class="card-body p-4" style="min-height: 250px;">
                            <div class="table-responsive" id="list-jadwal"></div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

<!-- Modal Pengumuman -->
<div class="modal fade" id="pengumumanModal" tabindex="-1" aria-labelledby="previewLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-bottom border-light">
                <div class="user-block d-flex align-items-center">
                    <img id="foto" class="rounded-circle me-3 border" src="<?= base_url() ?>/assets/img/user.jpg" width="45" height="45" alt="User Image">
                    <div>
                        <h6 id="username" class="mb-0 fw-bold">Pengirim</h6>
                        <small id="tgl" class="text-muted">Tanggal</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div id="isi-pengumuman"></div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Komentar -->
<div class="modal fade" id="komentarModal" tabindex="-1" aria-labelledby="komentarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-bottom border-light">
                <h5 class="modal-title fw-bold" id="komentarLabel">Tulis Komentar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <img class="rounded-circle me-3 border" src="<?= base_url('assets/img/siswa.png') ?>" width="40" height="40" alt="Siswa">
                    <span class="fw-semibold text-body"><?= esc($siswa->nama) ?></span>
                </div>
                <form id="komentar" action="<?= base_url('siswa/savekomentar') ?>" method="post">
                    <input type="hidden" id="id-post" name="id_post" value="">
                    <div class="input-group">
                        <input type="text" name="text" placeholder="Tulis komentar..." class="form-control rounded-pill-start" required>
                        <button type="submit" class="btn btn-success rounded-pill-end px-4">Komentari</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Balasan -->
<div class="modal fade" id="balasanModal" tabindex="-1" aria-labelledby="balasanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-bottom border-light">
                <h5 class="modal-title fw-bold" id="balasanLabel">Tulis Balasan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <img class="rounded-circle me-3 border" src="<?= base_url('assets/img/siswa.png') ?>" width="40" height="40" alt="Siswa">
                    <span class="fw-semibold text-body"><?= esc($siswa->nama) ?></span>
                </div>
                <form id="balasan" action="<?= base_url('siswa/savebalasan') ?>" method="post">
                    <input type="hidden" id="id-comment" name="id_comment" value="">
                    <div class="input-group">
                        <input type="text" name="text" placeholder="Tulis balasan..." class="form-control rounded-pill-start" required>
                        <button type="submit" class="btn btn-success rounded-pill-end px-4">Balas</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    let jadwalKbm;
    var arrIst = [];
    var kelas = '<?= esc($siswa->id_kelas) ?>';
    var kodeKelas = '<?= esc($siswa->kode_kelas) ?>';
    var pengumuman;

    var halaman = 0;
    var idSiswa = "<?= esc($siswa->id_siswa) ?>";

    function createTime(d) {
        var date = new Date(d);

        var jam = date.getHours();
        var menit = date.getMinutes();
        var sJam = jam < 10 ? '0' + jam : '' + jam;
        var sMenit = menit < 10 ? '0' + menit : '' + menit;

        var hari = daysdifference(d);
        var time;

        if (hari === 0) {
            time = sJam + ':' + sMenit;
        } else if (hari === 1) {
            time = 'kemarin ' + sJam + ':' + sMenit;
        } else {
            time = (typeof $.timeago === 'function' ? $.timeago(d) : d) + ', ' + sJam + ':' + sMenit;
        }
        return time;
    }

    function daysdifference(last) {
        var startDay = new Date(last);
        var endDay = new Date();
        var millisBetween = startDay.getTime() - endDay.getTime();
        var days = millisBetween / (1000 * 3600 * 24);
        return Math.round(Math.abs(days));
    }

    function addComments(id, comments, append) {
        if (!comments) return;
        if (!Array.isArray(comments)) comments = [comments];
        var comm = '';
        if (!comments || !Array.isArray(comments)) return;

        $.each(comments, function (i, v) {
            if (!v || !v.id_comment) return;
            var dari, foto, avatar;
            if (v.dari == '0') {
                dari = 'Admin';
                avatar = v.foto != null ? '<img class="rounded-circle border" src="' + v.foto + '" alt="Img" width="40" height="40">' :
                    '<div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px">A</div>'
            } else {
                if (v.dari_group == '2') {
                    dari = v.nama_guru;
                    foto = v.foto != null ? base_url + v.foto : base_url + 'assets/img/siswa.png';
                    avatar = '<img class="rounded-circle border" src="' + foto + '" alt="Img" width="40" height="40">';
                } else {
                    dari = v.nama_siswa;
                    foto = v.foto_siswa != null ? base_url + v.foto_siswa : base_url + 'assets/img/siswa.png';
                    avatar = '<img class="rounded-circle border" src="' + foto + '" alt="Img" width="40" height="40">';
                }
            }

            comm += '<div class="d-flex mt-2" id="parent-reply' + v.id_comment + '">'
                + avatar +
                '    <div class="w-100 ms-2">' +
                '        <div class="border p-2 px-3 bg-light rounded-4">' +
                '            <span class="small text-muted fw-bold">' + dari + '</span>' +
                '            <div class="comment-text small text-body">' + v.text + '</div>' +
                '        </div>' +
                '        <div class="ms-2 mt-1">' +
                '            <span class="small me-2 text-muted">' + createTime(v.tanggal) + '</span>' +
                '            <span id="trigger-reply' + v.id_comment + '" class="btn btn-sm me-2 text-muted p-0 action-collapse" data-bs-toggle="collapse" aria-expanded="true"' +
                '                              aria-controls="collapse-reply' + v.id_comment + '"' +
                '                              href="#collapse-reply' + v.id_comment + '"><b>' + v.jml + ' balasan</b></span>' +
                '            <span class="btn btn-sm me-2 text-muted p-0 btn-toggle-reply"' +
                '                  data-id="' + v.id_comment + '" data-bs-toggle="modal" data-bs-target="#balasanModal">' +
                '                <i class="fas fa-reply me-1"></i> <b>Balas</b></span>';
            if (v.dari_group === '3' && v.dari === idSiswa) {
                comm += '            <span class="btn btn-sm text-danger p-0" data-id="' + v.id_comment + '">' +
                    '                <i class="fas fa-trash me-1"></i> Hapus' +
                    '            </span>';
            }
            comm += '        </div>' +
                '<div id="collapse-reply' + v.id_comment + '" class="p-2 collapse toggle-reply" data-id="' + v.id_comment + '" data-parent="#parent-reply' + v.id_comment + '">';
            if (v.jml != '0') {
                comm += '<div id="konten-reply' + v.id_comment + '"></div>' +
                    '<div id="loadmore-reply' + v.id_comment + '" onclick="getReplies(' + v.id_comment + ')" class="text-center mb-3 loadmore-reply">' +
                    '       <button class="btn btn-sm btn-outline-secondary rounded-pill">Muat balasan lainnya...</button>' +
                    '</div>';
            }
            comm += '    <div id="loading-reply' + v.id_comment + '" class="text-center d-none py-2">' +
                '        <div class="spinner-border spinner-border-sm text-primary" role="status"></div>' +
                '    </div>' +
                '</div>' +
                '    </div>' +
                '</div>';
        });

        if (append) {
            $(`#konten${id}`).append(comm);
        } else {
            $(`#konten${id}`).prepend(comm);
        }

        $('.toggle-reply').off('shown.bs.collapse').on('shown.bs.collapse', function (e) {
            var konten = $(this);
            var id = konten.data('id');
            var list = $(this).find('.media, .d-flex').length;
            if (list === 0) $(`#loadmore-reply${id}`).click();
        });

        $('#balasan').off('submit').on('submit', function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();

            var id = $(this).find('input[name=id_comment]').val();
            $.ajax({
                url: base_url + "siswa/savebalasan",
                data: $(this).serialize(),
                method: 'POST',
                dataType: "JSON",
                success: function (response) {
                    $('#balasanModal').modal('hide');
                    addReplies(id, response, false);
                },
                error: function (xhr, status, error) {
                    $('#balasanModal').modal('hide');
                    if (typeof showDangerToast === 'function') {
                        showDangerToast('Error, balasan tidak terkirim');
                    }
                }
            });
        });
        wrappTables();
    }

    function addReplies(id, replies, append) {
        if (!replies) return;
        if (!Array.isArray(replies)) replies = [replies];
        var repl = '';
        if (!replies || !Array.isArray(replies)) return;

        $.each(replies, function (i, v) {
            if (!v || !v.id_reply) return;
            var sudahAda = $(`.media${v.id_reply}`).length;
            if (!sudahAda) {
                var dari, foto, avatar;
                if (v.dari == '0') {
                    dari = 'Admin';
                    avatar = v.foto != null ? '<img class="rounded-circle border" src="' + v.foto + '" alt="Img" width="35" height="35">' :
                        '<div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center fw-bold me-2" style="width: 35px; height: 35px">A</div>';
                } else {
                    if (v.dari_group == '2') {
                        dari = v.nama_guru;
                        foto = v.foto != null ? base_url + v.foto : base_url + 'assets/img/siswa.png';
                        avatar = '<img class="rounded-circle border me-2" src="' + foto + '" alt="Img" width="35" height="35">';
                    } else {
                        dari = v.nama_siswa;
                        foto = v.foto_siswa != null ? base_url + v.foto_siswa : base_url + 'assets/img/siswa.png';
                        avatar = '<img class="rounded-circle border me-2" src="' + foto + '" alt="Img" width="35" height="35">';
                    }
                }

                repl +=
                    '<div class="d-flex mt-2 media' + v.id_reply + '">'
                    + avatar +
                    '    <div class="w-100">' +
                    '        <div class="border p-2 px-3 bg-light rounded-4">' +
                    '            <span class="small text-muted fw-bold">' + dari + '</span>' +
                    '            <div class="comment-text small text-body">' + v.text + '</div>' +
                    '        </div>' +
                    '        <div class="ms-2 mt-1">' +
                    '            <small class="me-2 text-muted">' + createTime(v.tanggal) + '</small>';
                if (v.dari_group === '3' && v.dari === idSiswa) {
                    repl += '            <span class="btn btn-sm text-danger p-0" data-id="' + v.id_reply + '">' +
                        '                <i class="fas fa-trash me-1"></i> Hapus' +
                        '            </span>';
                }
                repl += '        </div>' +
                    '    </div>' +
                    '</div>';
            }
        });

        if (append) {
            $(`#konten-reply${id}`).append(repl);
        } else {
            $(`#konten-reply${id}`).prepend(repl);
        }
    }

    function getComments(id) {
        $(`#loading${id}`).removeClass('d-none');
        $(`#loadmore${id}`).addClass('d-none');
        var $count = $(`#loadmore${id}`), page = $count.data('count');
        if (!page) page = 0;

        setTimeout(function () {
            $.ajax({
                url: base_url + "siswa/getcomment/" + id + "/" + page,
                type: "GET",
                success: function (response) {
                    page += 1;
                    $count.data('count', page);
                    if (response && response.length === 5) {
                        $(`#loadmore${id}`).removeClass('d-none');
                    }
                    $(`#loading${id}`).addClass('d-none');
                    addComments(id, response, true);
                }, error: function (xhr, status, error) {
                    $(`#loading${id}`).addClass('d-none');
                }
            });
        }, 300);
    }

    function getReplies(id) {
        $(`#loading-reply${id}`).removeClass('d-none');
        $(`#loadmore-reply${id}`).addClass('d-none');
        var $count = $(`#loadmore-reply${id}`), page = $count.data('count');
        if (!page) page = 0;

        setTimeout(function () {
            $.ajax({
                url: base_url + "siswa/getreplies/" + id + "/" + page,
                type: "GET",
                success: function (response) {
                    page += 1;
                    $count.data('count', page);
                    if (response && response.length === 5) {
                        $(`#loadmore-reply${id}`).removeClass('d-none');
                    }
                    $(`#loading-reply${id}`).addClass('d-none');
                    addReplies(id, response, true);
                }, error: function (xhr, status, error) {
                    $(`#loading-reply${id}`).addClass('d-none');
                }
            });
        }, 300);
    }

    function addPosts(response) {
        if (response && response.length > 0) {
            var card = '';
            $.each(response, function (i, v) {
                var dari, foto, avatar;
                if (v.dari == '0') {
                    dari = 'Admin';
                    avatar = v.foto != null ? '<img class="rounded-circle border" src="' + v.foto + '" alt="Img" width="45" height="45">' :
                        '<div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center fw-bold" style="width: 45px; height: 45px">A</div>';
                } else {
                    if (v.dari_group == '2') {
                        dari = v.nama_guru;
                        foto = v.foto != null ? base_url + v.foto : base_url + 'assets/img/siswa.png';
                        avatar = '<img class="rounded-circle border" src="' + foto + '" alt="Img" width="45" height="45">';
                    } else {
                        dari = v.nama_siswa;
                        foto = v.foto_siswa != null ? base_url + v.foto_siswa : base_url + 'assets/img/siswa.png';
                        avatar = '<img class="rounded-circle border" src="' + foto + '" alt="Img" width="45" height="45">';
                    }
                }

                card += '<div class="card border-0 shadow-sm rounded-4 mb-3 overflow-hidden">' +
                    '    <div class="card-body p-4" id="parent' + v.id_post + '">' +
                    '        <div class="d-flex align-items-center mb-2">' +
                    avatar +
                    '                <div class="ms-3">' +
                    '                    <h6 class="fw-bold text-body mb-0">' + dari + '</h6>' +
                    '                    <small class="text-muted">' + createTime(v.tanggal) + '</small>' +
                    '                </div>' +
                    '        </div>' +
                    '        <div class="my-3 text-body">' + v.text + '</div>' +
                    '        <div class="d-flex gap-2 pt-2 border-top border-light">' +
                    '            <button type="button" class="btn btn-light btn-sm rounded-pill px-3 me-2 btn-toggle"' +
                    '                    data-id="' + v.id_post + '" data-bs-toggle="modal"' +
                    '                    data-bs-target="#komentarModal"><i class="fas fa-reply me-1"></i> Tulis komentar' +
                    '            </button>' +
                    '            <button type="button" id="trigger' + v.id_post + '" class="btn btn-light btn-sm rounded-pill px-3 action-collapse"' +
                    '                    data-bs-toggle="collapse" aria-expanded="true"' +
                    '                    aria-controls="collapse-' + v.id_post + '"' +
                    '                    href="#collapse-' + v.id_post + '">' +
                    '                <i class="far fa-comments me-1"></i>' + v.jml + ' komentar' +
                    '            </button>' +
                    '        </div>' +
                    '    </div>' +
                    '    <div id="collapse-' + v.id_post + '" class="p-3 collapse bg-light border-top toggle-comment"' +
                    '         data-id="' + v.id_post + '" data-parent="#parent' + v.id_post + '">' +
                    '        <div id="konten' + v.id_post + '"></div>' +
                    '        <div id="loading' + v.id_post + '" class="text-center d-none py-3">' +
                    '            <div class="spinner-border spinner-border-sm text-primary" role="status"></div>' +
                    '        </div>';
                if (v.jml == '0') {
                    card += '<div class="text-center text-muted small py-2">Belum ada komentar</div>';
                } else {
                    card += '<div id="loadmore' + v.id_post + '"' +
                        '     onclick="getComments(' + v.id_post + ')"' +
                        '     class="text-center mt-3 loadmore">' +
                        '    <button class="btn btn-sm btn-outline-secondary rounded-pill px-3">Muat komentar lainnya...</button>' +
                        '</div>';
                }
                card += '</div>' +
                    '</div>';
            });
            $('#pengumuman').html(card);

            $('.toggle-comment').off('shown.bs.collapse').on('shown.bs.collapse', function (e) {
                var konten = $(this);
                var id = konten.data('id');
                var list = $(this).find('.d-flex').length;
                if (list === 0) $(`#loadmore${id}`).click();
            });

            $('#komentarModal').off('show.bs.modal').on('show.bs.modal', function (e) {
                var id = $(e.relatedTarget).data('id');
                $("#id-post").val(id);

                var isVisible = $(`#collapse-${id}`).hasClass('show');
                if (!isVisible) {
                    $(`#trigger${id}`).click();
                }
            });

            $('#balasanModal').off('show.bs.modal').on('show.bs.modal', function (e) {
                var id = $(e.relatedTarget).data('id');
                $("#id-comment").val(id);

                var isVisible = $(`#collapse-reply${id}`).hasClass('show');
                if (!isVisible) {
                    $(`#trigger-reply${id}`).click();
                }
            });

            $('#komentar').off('submit').on('submit', function (e) {
                e.preventDefault();
                e.stopImmediatePropagation();

                var id = $(this).find('input[name=id_post]').val();
                $.ajax({
                    url: base_url + "siswa/savekomentar",
                    data: $(this).serialize(),
                    method: 'POST',
                    dataType: "JSON",
                    success: function (response) {
                        $('#komentarModal').modal('hide');
                        addComments(id, response, false);
                    },
                    error: function (xhr, status, error) {
                        $('#komentarModal').modal('hide');
                        if (typeof showDangerToast === 'function') {
                            showDangerToast('Error, komentar tidak terkirim');
                        }
                    }
                });
            });
            wrappTables();
        } else {
            $('#pengumuman').html('<div class="alert alert-light border-0 text-center py-4 text-muted"><i class="fas fa-inbox fa-2x mb-2 opacity-50 d-block"></i>Tidak ada pengumuman</div>');
        }
    }

    function getPosts() {
        $(`#loading-post`).removeClass('d-none');
        $(`#loadmore-post`).addClass('d-none');

        setTimeout(function () {
            $.ajax({
                url: base_url + "siswa/getpost?halaman=" + halaman + "&kelas=" + kodeKelas,
                type: "GET",
                success: function (response) {
                    halaman += 1;
                    if (response && response.length === 5) {
                        $(`#loadmore-post`).removeClass('d-none');
                    }
                    $(`#loading-post`).addClass('d-none');
                    addPosts(response);
                }, error: function (xhr, status, error) {
                    $(`#loading-post`).addClass('d-none');
                }
            });
        }, 300);
    }

    function loadJadwal() {
        <?php if (($setting->fitur_jadwal ?? '1') == '0'): ?>
        return;
        <?php endif; ?>
        var date = new Date();
        var hari = date.getDay();

        $.ajax({
            type: 'GET',
            url: base_url + 'dashboard/getjadwalhariini/' + kelas + '/' + hari,
            success: function (data) {
                if (typeof data === 'string') {
                    try { data = JSON.parse(data); } catch(e) {}
                }
                if (data && typeof data === 'object' && !Array.isArray(data)) {
                    data = Object.values(data);
                }
                if (Array.isArray(data) && data.length > 0) {
                    var tableJadwal = '<table class="table table-hover align-middle w-100 mb-0">' +
                        '<thead class="bg-light">' +
                        '<tr>' +
                        '<th class="text-center py-2.5" style="width: 130px;">Waktu</th>' +
                        '<th class="py-2.5">Mapel</th>' +
                        '</tr></thead>' +
                        '<tbody>';

                    data.sort(function(a, b) {
                        return (a.dari || '').localeCompare(b.dari || '');
                    });
                    for (const jadwal of data) {
                        const mapel = jadwal.id_mapel === '-1' ? '<span class="badge bg-warning bg-opacity-15 text-warning border border-warning border-opacity-20 px-2.5 py-1">Istirahat</span>' : 
                                     (jadwal.id_mapel === '-2' ? '<span class="badge bg-success bg-opacity-15 text-success border border-success border-opacity-20 px-2.5 py-1">Upacara</span>' : 
                                     `<span class="fw-bold text-body">${jadwal.kode ?? '-'}</span>`);
                        const bg = jadwal.id_mapel === '-1' ? 'table-warning' : (jadwal.id_mapel === '-2' ? 'table-success' : '');
                        tableJadwal += '<tr class="'+bg+'">' +
                            '<td class="text-center fw-semibold text-muted small py-3">' + (jadwal.dari ?? '') + ' ~ ' + (jadwal.sampai ?? '') + '</td>' +
                            '<td class="py-3">' + mapel + '</td>' +
                            '</tr>';
                    }
                    tableJadwal += '</tbody></table>';
                    $('#list-jadwal').html(tableJadwal);
                } else {
                    $('#list-jadwal').html('<div class="alert alert-light border-0 text-center py-4 mb-0 text-muted"><i class="fas fa-calendar-day fa-2x mb-2 opacity-50 d-block"></i>Tidak ada jadwal hari ini</div>');
                }
            }
        });
    }

    $(document).ready(function () {
        $('#pengumumanModal').off('show.bs.modal').on('show.bs.modal', function (e) {
            var pos = $(e.relatedTarget).data('pos');
            var item = pengumuman[pos];
            if (!item) return;
            var tgl = formatTanggal(item.date);

            $('#username').text(item.nama_guru || 'Pengirim');
            $('#tgl').text(tgl);
            $('#foto').attr('src', base_url + '/assets/img/' + (item.foto || 'user.jpg'));
            $('#isi-pengumuman').html('<h4>' + (item.judul || '') + '</h4>' + (item.text || ''));
        });

        const tempMateri = 'nextgenCBT.materi_siswa';
        const tempArsip = 'nextgenCBT.arsip_materi';
        if (localStorage.getItem(tempMateri)) {
            localStorage.removeItem(tempMateri);
        }
        if (localStorage.getItem(tempArsip)) {
            localStorage.removeItem(tempArsip);
        }

        loadJadwal();
        getPosts();
        initBannerCarousel();
    });

    function wrappTables() {
        $('table').each(function () {
            if (! $(this).parents('.table-responsive').length) {
                $(this).wrap('<div class="table-responsive"></div>');
            }
        });
    }

    /* ==========================================================
       BANNER CAROUSEL ENGINE (PC: 2 slides, Mobile: Peek 1 slide)
       ========================================================== */
    var bannerCurrentIdx = 0;
    var bannerAutoTimer = null;
    var bannerIsDragging = false;
    var bannerStartX = 0;
    var bannerCurrentX = 0;

    function initBannerCarousel() {
        var section = document.getElementById('cbtBannerSection');
        var track = document.getElementById('cbtBannerTrack');
        var viewport = document.getElementById('cbtBannerViewport');
        var prevBtn = document.getElementById('cbtBannerPrev');
        var nextBtn = document.getElementById('cbtBannerNext');

        if (!section || !track || !viewport) return;

        var slides = track.querySelectorAll('.cbt-banner-slide');
        if (slides.length <= 1) {
            if (prevBtn) prevBtn.style.display = 'none';
            if (nextBtn) nextBtn.style.display = 'none';
            var dots = document.getElementById('cbtBannerDots');
            if (dots) dots.style.display = 'none';
            return;
        }

        updateBannerPositions(false);

        window.addEventListener('resize', function () {
            updateBannerPositions(false);
        });

        if (prevBtn) {
            prevBtn.addEventListener('click', function () {
                prevBannerSlide();
                restartBannerAuto();
            });
        }
        if (nextBtn) {
            nextBtn.addEventListener('click', function () {
                nextBannerSlide();
                restartBannerAuto();
            });
        }

        // Hover pause
        section.addEventListener('mouseenter', function () {
            stopBannerAuto();
        });
        section.addEventListener('mouseleave', function () {
            startBannerAuto();
        });

        // Touch gestures for mobile swipe
        viewport.addEventListener('touchstart', function (e) {
            if (!e.touches || !e.touches[0]) return;
            bannerIsDragging = true;
            bannerStartX = e.touches[0].clientX;
            bannerCurrentX = bannerStartX;
            stopBannerAuto();
        }, { passive: true });

        viewport.addEventListener('touchmove', function (e) {
            if (!bannerIsDragging || !e.touches || !e.touches[0]) return;
            bannerCurrentX = e.touches[0].clientX;
        }, { passive: true });

        viewport.addEventListener('touchend', function () {
            if (!bannerIsDragging) return;
            bannerIsDragging = false;
            var diff = bannerCurrentX - bannerStartX;
            if (diff > 40) {
                prevBannerSlide();
            } else if (diff < -40) {
                nextBannerSlide();
            } else {
                updateBannerPositions(true);
            }
            startBannerAuto();
        });

        startBannerAuto();
    }

    function updateBannerPositions(animate) {
        var track = document.getElementById('cbtBannerTrack');
        var viewport = document.getElementById('cbtBannerViewport');
        if (!track || !viewport) return;

        var slides = track.querySelectorAll('.cbt-banner-slide');
        var total = slides.length;
        if (total === 0) return;

        var isMobile = window.innerWidth < 768;
        var viewportWidth = viewport.offsetWidth;

        if (isMobile) {
            // Mobile: 82% width per slide with center alignment and peek on left & right
            var slideWidth = Math.round(viewportWidth * 0.82);
            var gap = 12;
            var peekOffset = Math.round((viewportWidth - slideWidth) / 2);

            slides.forEach(function (slide) {
                slide.style.width = slideWidth + 'px';
                slide.style.marginRight = gap + 'px';
            });

            var targetX = peekOffset - (bannerCurrentIdx * (slideWidth + gap));
        } else {
            // PC / Desktop: 2 banners side by side
            var gap = 16;
            var slideWidth = Math.round((viewportWidth - gap) / 2);

            slides.forEach(function (slide) {
                slide.style.width = slideWidth + 'px';
                slide.style.marginRight = gap + 'px';
            });

            var maxIdx = Math.max(0, total - 2);
            var effectiveIdx = Math.min(bannerCurrentIdx, maxIdx);
            var targetX = - (effectiveIdx * (slideWidth + gap));
        }

        track.style.transition = (animate !== false) ? 'transform 0.45s cubic-bezier(0.25, 1, 0.5, 1)' : 'none';
        track.style.transform = 'translateX(' + targetX + 'px)';

        // Update active class on slides & dots
        slides.forEach(function (s, i) {
            if (i === bannerCurrentIdx) {
                s.classList.add('active');
            } else {
                s.classList.remove('active');
            }
        });

        var dots = document.querySelectorAll('.cbt-banner-dot');
        dots.forEach(function (d, i) {
            if (i === bannerCurrentIdx) {
                d.classList.add('active');
            } else {
                d.classList.remove('active');
            }
        });
    }

    function nextBannerSlide() {
        var track = document.getElementById('cbtBannerTrack');
        if (!track) return;
        var total = track.querySelectorAll('.cbt-banner-slide').length;
        var isMobile = window.innerWidth < 768;
        var limit = isMobile ? total - 1 : Math.max(0, total - 2);

        if (bannerCurrentIdx >= limit) {
            bannerCurrentIdx = 0;
        } else {
            bannerCurrentIdx++;
        }
        updateBannerPositions(true);
    }

    function prevBannerSlide() {
        var track = document.getElementById('cbtBannerTrack');
        if (!track) return;
        var total = track.querySelectorAll('.cbt-banner-slide').length;
        var isMobile = window.innerWidth < 768;
        var limit = isMobile ? total - 1 : Math.max(0, total - 2);

        if (bannerCurrentIdx <= 0) {
            bannerCurrentIdx = limit;
        } else {
            bannerCurrentIdx--;
        }
        updateBannerPositions(true);
    }

    function goToBannerSlide(idx) {
        bannerCurrentIdx = idx;
        updateBannerPositions(true);
        restartBannerAuto();
    }

    function startBannerAuto() {
        stopBannerAuto();
        bannerAutoTimer = setInterval(function () {
            nextBannerSlide();
        }, 4500);
    }

    function stopBannerAuto() {
        if (bannerAutoTimer) {
            clearInterval(bannerAutoTimer);
            bannerAutoTimer = null;
        }
    }

    function restartBannerAuto() {
        stopBannerAuto();
        startBannerAuto();
    }
</script>
<?= $this->endSection() ?>
