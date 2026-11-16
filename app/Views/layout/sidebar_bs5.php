<?php
$uri = service('request')->getUri();
$pg  = $uri->getTotalSegments() >= 1 ? $uri->getSegment(1) : '';
$pga = $uri->getTotalSegments() >= 2 ? $uri->getSegment(2) : '';
$user_foto = isset($user->foto) ? $user->foto : ((is_array($user) && isset($user['foto'])) ? $user['foto'] : '');
$avatar    = ($user_foto != '' && file_exists(FCPATH . $user_foto)) ? base_url($user_foto) : base_url('assets/adminlte/dist/img/avatar5.png');

if (!isset($setting) || empty($setting)) {
    try {
        $setting = (new \App\Models\DashboardModel())->getSetting();
    } catch (\Throwable $e) {}
}

$logo_app  = isset($setting) && !empty($setting->logo_kiri) ? base_url($setting->logo_kiri) : base_url('assets/img/favicon.png');
$nama_app  = isset($setting) && !empty($setting->nama_aplikasi) ? $setting->nama_aplikasi : 'NextGenCBT';

$db = \Config\Database::connect();
$isNurulHakim = (isset($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'], 'nurulhakim.sch.id') !== false) || (strpos(base_url(), 'nurulhakim.sch.id') !== false);
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
        <div class="sidebar-list" id="sidebar-list">
            <ul class="navbar-nav iq-main-menu" id="sidebar-menu" style="padding-bottom: 140px !important;">
            </ul>
        </div>
    </div>
<script>
(function() {
    var page     = '<?= $pg ?>';
    var pageact  = '<?= $pga ?>';
    var base_url = '<?= rtrim(base_url(), '/') . '/' ?>';
    var isLogin  = localStorage.getItem('nextgenCBT.login');
    var cbtMode  = isLogin === '1';

    var menus = [
        { header: 'HOME', cbt: '1', menu: [
            { name: 'Dashboard', link: 'dashboard', icon: 'fas fa-desktop', cbt: '1' },
            { name: 'Data Umum', icon: 'fas fa-server', cbt: '1', submenu: [
                { name: 'Tahun Pelajaran', link: 'datatahun', icon: 'far fa-calendar-check' },
                { name: 'Mata Pelajaran',  link: 'datamapel', icon: 'fa fa-book' },
                { name: 'Jurusan',         link: 'datajurusan', icon: 'fa fa-flask' },
                { name: 'Kelas / Rombel', link: 'datakelas', icon: 'fa fa-school' },
                { name: 'Siswa',           link: 'datasiswa', icon: 'fa fa-users' },
                { name: 'Ekstrakurikuler', link: 'dataekstra', icon: 'fa fa-chess' },
                { name: 'Guru',            link: 'dataguru', icon: 'fa fa-chalkboard-teacher' },<?php if (!$isNurulHakim): ?>
                
                <?php endif; ?>
                { name: 'Pengaturan API AI', link: 'aigenerator', icon: 'fas fa-robot text-primary' }
            ]},
            
            { name: 'Data Ujian', icon: 'fa fa-user-graduate', cbt: '1', submenu: [
                { name: 'Jenis Ujian',    link: 'cbtjenis', icon: 'fa fa-project-diagram' },
                { name: 'Sesi',           link: 'cbtsesi', icon: 'far fa-clock' },
                { name: 'Ruang',          link: 'cbtruang', icon: 'fa fa-door-open' },
                { name: 'Nomor Peserta',  link: 'cbtnomorpeserta', icon: 'far fa-id-card' },
                { name: 'Atur Ruang/Sesi',link: 'cbtsesisiswa', icon: 'fa fa-user-clock' },
                { name: 'Bank Soal',      link: 'cbtbanksoal', icon: 'far fa-folder-open' },
                { name: 'Jadwal',         link: 'cbtjadwal', icon: 'far fa-calendar-alt' },
                { name: 'Alokasi Waktu',  link: 'cbtalokasi', icon: 'fa fa-clock-o' },
                { name: 'Pengawas',       link: 'cbtpengawas', icon: 'fa fa-briefcase' },
                { name: 'Token',          link: 'cbttoken', icon: 'fa fa-key' },
                { name: 'Exambro',        link: 'cbtexambro', icon: 'fas fa-shield-alt' }
            ]},
            { name: 'Pengumuman',    link: 'pengumuman', icon: 'fas fa-bullhorn', cbt: '1' },
            { name: 'Upload Banner', link: 'banner',     icon: 'fas fa-images',   cbt: '1' },
            { name: 'Log Aktivitas', link: 'datalogs',   icon: 'fas fa-clock',    cbt: '1' }
        ]},
        { header: 'PELAKSANAAN', cbt: '1', menu: [
            
            
            
            { name: 'Pelaksanaan Ujian', icon: 'fas fa-graduation-cap', cbt: '1', submenu: [
                { name: 'Cetak',            link: 'cbtcetak',    icon: 'fa fa-print' },
                { name: 'Aktivasi Peserta', link: 'cbtactivate', icon: 'fa fa-users-cog' },
                { name: 'Status Siswa',     link: 'cbtstatus',   icon: 'fa fa-user-clock' },
                { name: 'Hasil Ujian',      link: 'cbtnilai',    icon: 'fa fa-file-alt' },
                { name: 'Rekap Nilai',      link: 'cbtrekap',    icon: 'fas fa-trophy' },
                { name: 'Analisis Soal',    link: 'cbtanalisis', icon: 'fas fa-chart-pie' }
            ]}
        ]},
        { header: 'RAPOR', cbt: '1', menu: [
            { name: 'Setting Rapor', link: 'rapor',       icon: 'fas fa-cog', cbt: '1' },
            { name: 'Mapel Rapor',   link: 'rapor/mapel', icon: 'fas fa-book-open text-primary', cbt: '1' },
            { name: 'Leger Nilai',   link: 'rapor/leger', icon: 'fa fa-file-alt', cbt: '1' },
            { name: 'Kumpulan Nilai', link: 'bukurapor',  icon: 'fas fa-book', cbt: '0' },
            { name: 'Alumni',        link: 'dataalumni',  icon: 'fa fa-users', cbt: '0' }
        ]},
        { header: 'PENGATURAN', cbt: '1', menu: [
            { name: 'Profile Sekolah', link: 'sekolah', icon: 'fas fa-university', cbt: '1' },
            { name: 'User Management', icon: 'fa fa-users-cog', cbt: '1', submenu: [
                { name: 'Administrator', link: 'useradmin', icon: 'fas fa-user-shield' },
                { name: 'Guru',          link: 'userguru',  icon: 'fas fa-user-tie' },
                { name: 'Siswa',         link: 'usersiswa', icon: 'fas fa-user-graduate' }
            ]},
            { name: 'Database', icon: 'fa fa-database', cbt: '1', submenu: [
                { name: 'Backup',          link: 'dbmanager', icon: 'fas fa-database' },
                { name: 'Data Manager',    link: 'dbclear',   icon: 'fas fa-database' },
                { name: 'Image Converter', link: 'dbconvert', icon: 'fas fa-image' }
            ]},
            { name: 'Patch & Versi', link: 'patch', icon: 'fas fa-shield-alt', cbt: '1' },
            { name: 'Panduan Pengguna', link: 'Doc', icon: 'fas fa-book-reader', cbt: '1' }
        ]}
    ];

    var html = '';
    var idx  = 0;

    function getSvgIcon(iconClass) {
        if (!iconClass) return '<iconify-icon icon="lucide:circle" class="icon-20" width="20" height="20" style="vertical-align: middle; padding-right: 8px;"></iconify-icon>';

        var map = {
            'fas fa-desktop': 'lucide:home',
            'fa fa-user-tie': 'lucide:user-check',
            'fas fa-user-tie': 'lucide:user-check',
            'fa fa-id-badge': 'lucide:badge-check',
            'fas fa-id-badge': 'lucide:badge-check',
            'fa fa-desktop': 'lucide:home',
            'fas fa-server': 'lucide:database',
            'fa fa-server': 'lucide:database',
            'far fa-calendar-check': 'lucide:calendar-check',
            'fas fa-calendar-check': 'lucide:calendar-check',
            'fa fa-book': 'lucide:book-open',
            'fas fa-book': 'lucide:book-open',
            'fa fa-flask': 'lucide:flask-conical',
            'fas fa-flask': 'lucide:flask-conical',
            'fa fa-school': 'lucide:school',
            'fas fa-school': 'lucide:school',
            'fa fa-users': 'lucide:users',
            'fas fa-users': 'lucide:users',
            'fa fa-chess': 'lucide:puzzle',
            'fas fa-chess': 'lucide:puzzle',
            'fa fa-chalkboard-teacher': 'lucide:presentation',
            'fas fa-chalkboard-teacher': 'lucide:presentation',
            'fas fa-chalkboard': 'lucide:monitor-play',
            'fa fa-chalkboard': 'lucide:monitor-play',
            'fa fa-calendar-alt': 'lucide:calendar-days',
            'far fa-calendar-alt': 'lucide:calendar-days',
            'fas fa-calendar-alt': 'lucide:calendar-days',
            'fa fa-pencil-ruler': 'lucide:pen-tool',
            'fas fa-pencil-ruler': 'lucide:pen-tool',
            'fa fa-drafting-compass': 'lucide:compass',
            'fas fa-drafting-compass': 'lucide:compass',
            'fa fa-user-graduate': 'lucide:graduation-cap',
            'fas fa-user-graduate': 'lucide:graduation-cap',
            'fa fa-project-diagram': 'lucide:network',
            'fas fa-project-diagram': 'lucide:network',
            'far fa-clock': 'lucide:clock',
            'fa fa-clock-o': 'lucide:clock',
            'fas fa-clock': 'lucide:clock',
            'fa fa-clock': 'lucide:clock',
            'fa fa-door-open': 'lucide:door-open',
            'fas fa-door-open': 'lucide:door-open',
            'far fa-id-card': 'lucide:id-card',
            'fas fa-id-card': 'lucide:id-card',
            'fa fa-user-clock': 'lucide:user-cog',
            'fas fa-user-clock': 'lucide:user-cog',
            'far fa-folder-open': 'lucide:folder-open',
            'fas fa-folder-open': 'lucide:folder-open',
            'fa fa-briefcase': 'lucide:briefcase',
            'fas fa-briefcase': 'lucide:briefcase',
            'fa fa-key': 'lucide:key',
            'fas fa-key': 'lucide:key',
            'fas fa-bullhorn': 'lucide:megaphone',
            'fa fa-bullhorn': 'lucide:megaphone',
            'fas fa-microscope': 'lucide:microscope',
            'fa fa-microscope': 'lucide:microscope',
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
            'fa fa-print': 'lucide:printer',
            'fas fa-print': 'lucide:printer',
            'fa fa-users-cog': 'lucide:users-round',
            'fas fa-users-cog': 'lucide:users-round',
            'fa fa-file-alt': 'lucide:file-text',
            'fas fa-file-alt': 'lucide:file-text',
            'fas fa-chart-pie': 'lucide:pie-chart',
            'fa fa-chart-pie': 'lucide:pie-chart',
            'fas fa-book-open': 'lucide:book-open',
            'fa fa-book-open': 'lucide:book-open',
            'fas fa-shield-alt': 'lucide:shield-check',
            'fa fa-shield-alt': 'lucide:shield-check',
            'fas fa-university': 'lucide:building-2',
            'fa fa-university': 'lucide:building-2',
            'fas fa-user-shield': 'lucide:shield-check',
            'fa fa-user-shield': 'lucide:shield-check',
            'fas fa-user-tie': 'lucide:user-cog',
            'fa fa-user-tie': 'lucide:user-cog',
            'fas fa-book-reader': 'lucide:book-marked',
            'fa fa-book-reader': 'lucide:book-marked',
            'fas fa-cog': 'lucide:settings',
            'fa fa-cog': 'lucide:settings',
            'fa fa-database': 'lucide:database',
            'fas fa-database': 'lucide:database',
            'fas fa-image': 'lucide:image',
            'fa fa-image': 'lucide:image',
            'fas fa-sign-out-alt': 'lucide:log-out',
            'fa fa-sign-out-alt': 'lucide:log-out',
            'fas fa-certificate': 'lucide:award',
            'fa fa-table': 'lucide:table',
            'fas fa-table': 'lucide:table',
            'fa fa-building': 'lucide:building-2',
            'fas fa-building': 'lucide:building-2',
            'fa fa-calendar-week': 'lucide:calendar-range',
            'fas fa-calendar-week': 'lucide:calendar-range',
            'fa fa-satellite-dish': 'lucide:radio-tower',
            'fas fa-satellite-dish': 'lucide:radio-tower',
            'fa fa-map-marked-alt': 'lucide:map-pin',
            'fas fa-map-marked-alt': 'lucide:map-pin',
            'fa fa-qrcode': 'lucide:qr-code',
            'fas fa-qrcode': 'lucide:qr-code',
            'fa fa-calendar-times': 'lucide:calendar-x',
            'fas fa-calendar-times': 'lucide:calendar-x',
            'fas fa-robot': 'lucide:bot',
            'fa fa-robot': 'lucide:bot'
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
        if (cbtMode && section.cbt === '0') return;

        if (section.header) {
            html += '<li class="nav-item static-item">'
                  + '<a class="nav-link static-item disabled" href="#" tabindex="-1">'
                  + '<span class="default-icon">' + section.header + '</span>'
                  + '<span class="mini-icon">-</span>'
                  + '</a></li>';

            section.menu.forEach(function(menu) {
                if (cbtMode && menu.cbt === '0') return;
                idx++;
                var cid = 'adm-menu-' + idx;

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
                  + '<a href="' + base_url + 'auth/logout" onclick="logout(event); return false;" class="nav-link">'
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



