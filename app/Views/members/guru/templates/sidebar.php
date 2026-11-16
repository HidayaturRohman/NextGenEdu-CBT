<?php
$uri = service('request')->getUri();
$pg  = $uri->getTotalSegments() >= 1 ? $uri->getSegment(1) : '';
$pga = $uri->getTotalSegments() >= 2 ? $uri->getSegment(2) : '';

if (!isset($setting) || empty($setting)) {
    try {
        $setting = (new \App\Models\DashboardModel())->getSetting();
    } catch (\Throwable $e) {}
}
$logo_app = isset($setting) && !empty($setting->logo_kiri) ? base_url($setting->logo_kiri) : base_url('assets/img/favicon.png');
$nama_app = isset($setting) && !empty($setting->nama_aplikasi) ? $setting->nama_aplikasi : 'NextGenCBT';

$db = \Config\Database::connect();
$tp_id = isset($tp_active) ? ($tp_active->id_tp ?? 0) : 0;
$smt_id = isset($smt_active) ? ($smt_active->id_smt ?? 0) : 0;

$dashModel = new \App\Models\DashboardModel();
if (!$tp_id || !$smt_id) {
    try {
        $tpActive = $dashModel->getTahunActive();
        $smtActive = $dashModel->getSemesterActive();
        $tp_id = $tpActive->id_tp ?? 0;
        $smt_id = $smtActive->id_smt ?? 0;
    } catch (\Throwable $e) {}
}

if (!isset($guru) || empty($guru)) {
    try {
        $userId = session()->get('id_user') ?? session()->get('user_id');
        $username = session()->get('username');
        if ($userId && $tp_id && $smt_id) {
            $guru = $dashModel->getDataGuruByUserId($userId, $tp_id, $smt_id);
        }
        if ((!isset($guru) || empty($guru)) && $username && $tp_id && $smt_id) {
            $guru = $dashModel->getDataGuruByUsername($username, $tp_id, $smt_id);
        }
    } catch (\Throwable $e) {}
}

$is_wali = false;
if (isset($guru)) {
    if ((isset($guru->id_jabatan) && $guru->id_jabatan == '4') || !empty($guru->wali_kelas) || !empty($guru->id_kelas)) {
        $is_wali = true;
    }
}

$mode_rapor_kurmer = 'semua';
if ($tp_id && $smt_id && $db->tableExists('rapor_kurmer_setting')) {
    $rowSettingRapor = $db->table('rapor_kurmer_setting')->where('id_tp', $tp_id)->where('id_smt', $smt_id)->get()->getRow();
    if ($rowSettingRapor && !empty($rowSettingRapor->mode_rapor)) {
        $mode_rapor_kurmer = $rowSettingRapor->mode_rapor;
    }
}

$mode_presensi = 'sederhana';
$pkl_aktif = 0;
if ($db->tableExists('presensi_setting')) {
    $rowSettingPresensi = $db->table('presensi_setting')->get()->getRow();
    if ($rowSettingPresensi && !empty($rowSettingPresensi->mode_presensi)) {
        $mode_presensi = $rowSettingPresensi->mode_presensi;
    }
    if ($rowSettingPresensi && !empty($rowSettingPresensi->pkl_aktif)) {
        $pkl_aktif = (int)$rowSettingPresensi->pkl_aktif;
    }
}
?>
<aside class="sidebar sidebar-default sidebar-white sidebar-base navs-rounded-all">
    <script>
        (function() {
            try {
                var aside = document.currentScript.parentElement;
                var sb = localStorage.getItem('sidebar') || 'sidebar-white';
                aside.classList.remove('sidebar-white', 'sidebar-dark', 'sidebar-color', 'sidebar-transparent');
                aside.classList.add(sb);
                var st = localStorage.getItem('sidebar-style') || 'navs-rounded-all';
                aside.classList.remove('navs-rounded', 'navs-rounded-all', 'navs-pill', 'navs-pill-all');
                aside.classList.add(st);
                if (window.innerWidth >= 1200) {
                    var ty = JSON.parse(localStorage.getItem('sidebarType') || '[]');
                    if (Array.isArray(ty)) {
                        ty.forEach(function(t) { aside.classList.add(t); });
                    }
                }
            } catch(e) {}
        })();
    </script>
    <div class="sidebar-header d-flex align-items-center justify-content-between">
        <a href="<?= base_url() ?>" class="navbar-brand">
            <img src="<?= $logo_app ?>" alt="Logo" style="height:32px; width:auto; max-width:40px; object-fit:contain;">
            <h4 class="logo-title m-0 ms-2"><?= esc($nama_app) ?></h4>
        </a>
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
            <i class="icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </i>
        </div>
    </div>
    <div class="sidebar-body pt-0">
        <div class="sidebar-tp-box mx-3 my-2 p-3 rounded-3 bg-primary text-white shadow-sm d-xl-none" style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important; color: #ffffff !important;">
            <div class="pb-2 mb-2 d-flex justify-content-between align-items-center text-white" style="font-size: 0.88rem; border-bottom: 1px solid rgba(255,255,255,0.25);">
                <span class="text-white"><i class="far fa-calendar-alt me-1"></i> Tahun:</span>
                <strong class="fw-bold text-white"><?= isset($tp_active) ? esc($tp_active->tahun) : "Belum di set" ?></strong>
            </div>
            <div class="d-flex justify-content-between align-items-center text-white" style="font-size: 0.88rem;">
                <span class="text-white"><i class="fas fa-layer-group me-1"></i> Semester:</span>
                <strong class="fw-bold text-white"><?= isset($smt_active) ? esc($smt_active->nama_smt) : "Belum di set" ?></strong>
            </div>
        </div>
        
        <!-- Profile Guru (Opsional) -->
        <div class="d-flex align-items-center justify-content-center mb-3">
            <div class="text-center">
                <img src="<?= (isset($guru->foto) && file_exists(FCPATH . $guru->foto)) ? base_url($guru->foto) : base_url('assets/img/guru.png') ?>" class="rounded-circle shadow-sm" alt="User Image" style="height: 50px; width: 50px; object-fit: cover;">
                <p class="mb-0 mt-2 fw-bold text-dark" style="font-size: 0.9rem;"><?= isset($guru->nama_guru) ? $guru->nama_guru : 'Guru' ?></p>
            </div>
        </div>

        <div class="sidebar-list" id="sidebar-list">
            <ul class="navbar-nav iq-main-menu" id="sidebar-menu" style="padding-bottom: 140px !important;">
            </ul>
        </div>
    </div>
<script>
(function() {
    var page     = '<?= $pg ?>';
    var pageact  = '<?= $pga ?>';
    var isWali   = <?= $is_wali ? 'true' : 'false' ?>;
    var base_url = '<?= rtrim(base_url(), '/') . '/' ?>';
    var isLogin  = localStorage.getItem('nextgenCBT.login') || localStorage.getItem('garudaCBT.login');
    var isCbtMode  = isLogin === '1';

    var menus = [
        {
            'header': 'HOME', 'cbt': '1',
            'menu': [
                {'name': 'Beranda', 'link': 'dashboard', 'icon': 'fas fa-desktop', 'cbt': '1'},
                {'name': 'Profile', 'link': 'guru', 'icon': 'fas fa-user', 'cbt': '1'},
                {'name': 'Pengumuman', 'link': 'pengumuman', 'icon': 'fas fa-bullhorn', 'cbt': '1'},
                {
                    'name': 'Wali Kelas', 'icon': 'fas fa-chart-pie', 'cbt': '1', 'wali': true,
                    'submenu': [
                        {'name': 'Siswa', 'link':"walisiswa", 'icon': 'fas fa-users'},
                        {'name': 'Struktur', 'link':"walistruktur", 'icon': 'far fa-circle'},
                        {'name': 'Catatan', 'link':"walicatatan", 'icon': 'fa fa-pencil-alt'}
                    ]
                },
                
                
                
                {
                    'name': 'Ulangan / Ujian', 'icon': 'fa fa-user-graduate', 'cbt': '1',
                    'submenu': [
                        {'name':"Bank Soal", 'link':"cbtbanksoal", 'icon': 'far fa-folder-open'},
                        {'name': 'Cetak', 'link':"cbtcetak", 'icon': 'fa fa-print'},
                        {'name': 'Status Siswa', 'link':"cbtstatus", 'icon': 'fa fa-user-clock'},
                        {'name': 'Hasil Ujian', 'link':"cbtnilai", 'icon': 'fa fa-file-alt'},
                        {'name': 'Rekap Nilai', 'link':"cbtrekap", 'icon': 'fas fa-trophy'}
                    ]
                },
                {
                    'name': 'Log Aktivitas', 'link': 'datalogs', 'icon': 'fas fa-clock', 'cbt': '1'
                }
            ]
        },
        {
            'header': 'PENILAIAN', 'cbt': '0',
            'menu': [
                {
                    'name': 'Data Acuan Rapor', 'icon': 'fas fa-chart-pie', 'cbt': '0',
                    'submenu': [
                        {'name': 'Tujuan Pembelajaran (TP)', 'link': 'rapor/raporkikd', 'icon': 'fas fa-book', 'cbt': '0'},
                        {'name': 'KKTP / Interval Nilai', 'link': 'rapor/raporkkm', 'icon': 'fa fa-balance-scale-right', 'cbt': '0'},
                    ]
                },
                <?php if ($mode_rapor_kurmer !== 'sas'): ?>
                {'name': 'Input Nilai PTS', 'link': 'rapor/rapornilai/pts', 'icon': 'fa fa-pencil-alt text-warning', 'cbt': '0'},
                <?php endif; ?>
                <?php if ($mode_rapor_kurmer !== 'sts'): ?>
                {'name': 'Input Nilai SAS', 'link': 'rapor/rapornilai/sas', 'icon': 'fa fa-pencil-alt text-success', 'cbt': '0'},
                <?php endif; ?>
                {
                    'name': 'Input Wali Kelas', 'icon': 'fas fa-chalkboard-teacher', 'cbt': '0', 'wali': true,
                    'submenu': [
                        {'name': 'Status Nilai', 'link': 'rapor/statusnilai', 'icon': 'fas fa-chart-line text-info', 'cbt': '0'},
                        {'name': 'Kokurikuler (P5/P2RA)', 'link': 'rapor/raporsikap', 'icon': 'fas fa-seedling', 'cbt': '0'},
                        {'name': 'Prestasi Siswa', 'link': 'rapor/raporprestasi', 'icon': 'fa fa-trophy', 'cbt': '0'},
                        {'name': 'Kehadiran & Catatan', 'link': 'rapor/raporcatatan', 'icon': 'fa fa-user-check', 'cbt': '0'},
                        {'name': 'Kenaikan Kelas', 'link': 'rapor/rapornaik', 'icon': 'fa fa-graduation-cap', 'cbt': '0'},
                    ]
                }
            ]
        },
        {
            'header': 'CETAK RAPOR', 'cbt': '0', 'wali': true,
            'menu': [
                <?php if ($mode_rapor_kurmer !== 'sts'): ?>
                {'name': 'Rapor Akhir (SAS)', 'link': 'rapor/cetakakhir', 'icon': 'fas fa-book', 'cbt': '0'},
                <?php endif; ?>
                <?php if ($mode_rapor_kurmer !== 'sas'): ?>
                {'name': 'Rapor Tengah (STS)', 'link': 'rapor/cetakpts', 'icon': 'fas fa-certificate text-warning', 'cbt': '0'},
                <?php endif; ?>
                {'name': 'Leger Nilai', 'link': 'rapor/cetakleger', 'icon': 'fa fa-table', 'cbt': '0'},
                {'name': 'Ranking Nilai', 'link': 'rapor/cetakranking', 'icon': 'fas fa-trophy text-warning', 'cbt': '0'},
            ]
        },
        {
            'header': 'ARSIP', 'cbt': '0', 'wali': true,
            'menu': [
                {'name': 'Arsip Rapor', 'link': 'bukurapor', 'icon': 'fas fa-university', 'cbt': '0'}
            ]
        }
    ];

    var html = '';
    var idx  = 0;

    function getSvgIcon(iconClass) {
        if (!iconClass) return '<iconify-icon icon="lucide:circle" class="icon-20" width="20" height="20" style="vertical-align: middle; padding-right: 8px;"></iconify-icon>';

        var map = {
            'fas fa-desktop': 'lucide:home',
            'fa fa-desktop': 'lucide:home',
            'fas fa-user': 'lucide:user',
            'fa fa-user': 'lucide:user',
            'fas fa-bullhorn': 'lucide:megaphone',
            'fa fa-bullhorn': 'lucide:megaphone',
            'fas fa-chart-pie': 'lucide:pie-chart',
            'fa fa-chart-pie': 'lucide:pie-chart',
            'fas fa-users': 'lucide:users',
            'fa fa-users': 'lucide:users',
            'far fa-circle': 'lucide:circle',
            'fa fa-pencil-alt': 'lucide:pencil',
            'fas fa-pencil-alt': 'lucide:pencil',
            'fas fa-chalkboard': 'lucide:monitor-play',
            'fa fa-chalkboard': 'lucide:monitor-play',
            'fa fa-calendar-alt': 'lucide:calendar-days',
            'far fa-calendar-alt': 'lucide:calendar-days',
            'fas fa-calendar-alt': 'lucide:calendar-days',
            'fa fa-pencil-ruler': 'lucide:pen-tool',
            'fas fa-pencil-ruler': 'lucide:pen-tool',
            'fa fa-drafting-compass': 'lucide:compass',
            'fas fa-drafting-compass': 'lucide:compass',
            'far fa-clipboard': 'lucide:clipboard-list',
            'fas fa-clipboard': 'lucide:clipboard-list',
            'fas fa-clipboard-list': 'lucide:clipboard-list',
            'fa fa-clipboard-list': 'lucide:clipboard-list',
            'fa fa-user-check': 'lucide:user-check',
            'fas fa-user-check': 'lucide:user-check',
            'fab fa-whatsapp': 'lucide:message-circle',
            'fa fa-whatsapp': 'lucide:message-circle',
            'fa fa-tasks': 'lucide:list-todo',
            'fas fa-tasks': 'lucide:list-todo',
            'fa fa-trophy': 'lucide:trophy',
            'fas fa-trophy': 'lucide:trophy',
            'fa fa-user-graduate': 'lucide:graduation-cap',
            'fas fa-user-graduate': 'lucide:graduation-cap',
            'far fa-id-card': 'lucide:id-card',
            'fas fa-id-card': 'lucide:id-card',
            'fa fa-user-clock': 'lucide:user-cog',
            'fas fa-user-clock': 'lucide:user-cog',
            'far fa-folder-open': 'lucide:folder-open',
            'fas fa-folder-open': 'lucide:folder-open',
            'fa fa-clock-o': 'lucide:clock',
            'fas fa-clock': 'lucide:clock',
            'fa fa-clock': 'lucide:clock',
            'fa fa-print': 'lucide:printer',
            'fas fa-print': 'lucide:printer',
            'fa fa-file-alt': 'lucide:file-text',
            'fas fa-file-alt': 'lucide:file-text',
            'fa fa-balance-scale-right': 'lucide:scale',
            'fas fa-balance-scale-right': 'lucide:scale',
            'fas fa-book': 'lucide:book-open',
            'fa fa-book': 'lucide:book-open',
            'fas fa-book-reader': 'lucide:book-open',
            'fa fa-book-reader': 'lucide:book-open',
            'fas fa-university': 'lucide:building-2',
            'fa fa-university': 'lucide:building-2',
            'fas fa-sign-out-alt': 'lucide:log-out',
            'fa fa-sign-out-alt': 'lucide:log-out',
            'fas fa-certificate': 'lucide:award',
            'fa fa-certificate': 'lucide:award',
            'fas fa-table': 'lucide:table',
            'fa fa-table': 'lucide:table'
        };

        // 1. Direct match
        var iconName = map[iconClass.trim()];

        // 2. Class-based search
        if (!iconName) {
            var parts = iconClass.split(' ');
            for (var p = 0; p < parts.length; p++) {
                var cls = parts[p].trim();
                if (cls.startsWith('fa-') && cls !== 'fa-fw') {
                    for (var key in map) {
                        if (key.indexOf(cls) !== -1) {
                            iconName = map[key];
                            break;
                        }
                    }
                }
                if (iconName) break;
            }
        }

        if (iconName) {
            return '<iconify-icon icon="' + iconName + '" class="icon-20" width="20" height="20" style="vertical-align: middle; padding-right: 8px;"></iconify-icon>';
        }
        return '<i class="' + iconClass + '" style="font-size: 1.05rem; width: 20px; text-align: center; margin-right: 8px; vertical-align: middle;"></i>';
    }

    menus.forEach(function(section) {
        if (isCbtMode && section.cbt === '0') {
            return;
        }
        if (!isWali && section.wali) {
            return;
        }

        if (section.header) {
            html += '<li class="nav-item static-item">'
                  + '<a class="nav-link static-item disabled" href="#" tabindex="-1">'
                  + '<span class="default-icon">' + section.header + '</span>'
                  + '<span class="mini-icon">-</span>'
                  + '</a></li>';

            section.menu.forEach(function(menu) {
                if (isCbtMode && menu.cbt === '0') return;
                if (!isWali && menu.wali) return;
                
                idx++;
                var cid = 'guru-menu-' + idx;

                if (menu.submenu) {
                    var currPath = page + (pageact ? '/' + pageact : '');
                    var open = menu.submenu.some(function(s) {
                        return s.link === currPath || s.link === page || 
                               (s.link.indexOf('/') !== -1 && s.link.split('/')[0] === page && page !== 'dashboard');
                    });

                    html += '<li class="nav-item">'
                          + '<a class="nav-link' + (open ? '' : ' collapsed') + '" data-bs-toggle="collapse"'
                          + ' href="#' + cid + '" role="button" aria-expanded="' + (open ? 'true' : 'false') + '"'
                          + ' aria-controls="' + cid + '">'
                          + '<i class="icon">' + getSvgIcon(menu.icon) + '</i>'
                          + '<span class="item-name">' + menu.name + '</span>'
                          + '<i class="right-icon"><svg class="icon-18" xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></i>'
                          + '</a>'
                          + '<ul class="sub-nav collapse' + (open ? ' show' : '') + '" id="' + cid + '" data-bs-parent="#sidebar-menu">';

                    menu.submenu.forEach(function(sub) {
                        var isAct = (sub.link === currPath || sub.link === page);
                        html += '<li class="nav-item">'
                              + '<a href="' + base_url + sub.link + '" class="nav-link' + (isAct ? ' active' : '') + '">'
                              + '<i class="icon">' + getSvgIcon(sub.icon) + '</i>'
                              + '<i class="sidenav-mini-icon"> &bull; </i>'
                              + '<span class="item-name">' + sub.name + '</span>'
                              + '</a></li>';
                    });
                    html += '</ul></li>';

                } else {
                    var isAct = (page === menu.link);
                    html += '<li class="nav-item">'
                          + '<a href="' + base_url + menu.link + '" class="nav-link' + (isAct ? ' active' : '') + '">'
                          + '<i class="icon">' + getSvgIcon(menu.icon) + '</i>'
                          + '<span class="item-name">' + menu.name + '</span>'
                          + '</a></li>';
                }
            });

        } else {
            html += '<li class="nav-item"><hr class="hr-horizontal"></li>'
                  + '<li class="nav-item">'
                  + '<a href="' + base_url + section.link + '" class="nav-link">'
                  + '<i class="icon text-danger">' + getSvgIcon(section.icon) + '</i>'
                  + '<span class="item-name text-danger">' + section.name + '</span>'
                  + '</a></li>';
        }
    });

    document.getElementById('sidebar-menu').innerHTML = html;
    try {
        if (typeof Scrollbar !== 'undefined' && Scrollbar.has(document.querySelector('.sidebar-body'))) {
            Scrollbar.destroy(document.querySelector('.sidebar-body'));
        }
    } catch(e) {}
})();
</script>
</aside>