<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-teal my-shadow">
    <!-- Brand Logo -->
    <a href="<?= base_url(); ?>" class="brand-link bg-white">
        <?php 
        if (!isset($setting) || empty($setting)) {
            try {
                $setting = (new \App\Models\DashboardModel())->getSetting();
            } catch (\Throwable $e) {}
        }
        $logo_app = isset($setting) && !empty($setting->logo_kiri) ? base_url($setting->logo_kiri) : base_url('assets/img/favicon.png'); 
        $isNurulHakim = (isset($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'], 'nurulhakim.sch.id') !== false) || (strpos(base_url(), 'nurulhakim.sch.id') !== false);
        $db = \Config\Database::connect();
        $nama_app = isset($setting) && !empty($setting->nama_aplikasi) ? $setting->nama_aplikasi : 'E-Learning';
        ?>
        <img src="<?= $logo_app ?>" alt="App Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-light"><?= esc($nama_app) ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar-wrapper">
        <?php 
        $user_foto = isset($user->foto) ? $user->foto : ((is_array($user) && isset($user['foto'])) ? $user['foto'] : '');
        $avatar = ($user_foto != '' && file_exists(FCPATH . $user_foto)) ? base_url($user_foto) : base_url('assets/adminlte/dist/img/avatar5.png'); 
        ?>
        <!-- Sidebar user panel -->
        <div class="user-panel border-0 d-flex mt-3 mb-3">
            <div class="image">
                <img src="<?= $avatar ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block" style="line-height: 1">
                    <?= isset($user->first_name) ? esc($user->first_name) : (is_array($user) && isset($user['first_name']) ? esc($user['first_name']) : 'NoName') ?>
                    <br>
                    <small class="text-muted">
                        <?= isset($user->role_name) ? esc($user->role_name) : (is_array($user) && isset($user['role_name']) ? esc($user['role_name']) : 'Admin') ?>
                    </small>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2 pb-5">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" id="tree-menus" data-lte-toggle="treeview" role="menu" data-accordion="false">
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<?php
$uri = service('request')->getUri();
$page = $uri->getTotalSegments() >= 1 ? $uri->getSegment(1) : '';
$pageact = $uri->getTotalSegments() >= 2 ? $uri->getSegment(2) : '';
?>

<script>
    const page = '<?= $page ?>';
    const pageact = '<?= $pageact ?>';
    
    // Default menu based on CI3 logic
    const menus = [
        {
            'header': 'HOME', 'cbt': '1',
            'menu': [
                {'name': 'Dashboard', 'link': 'dashboard', 'icon': 'fas fa-desktop', 'cbt': '1'},
                {
                    'name': 'Data Umum', 'icon': 'fas fa-server', 'cbt': '1',
                    'submenu': [
                        {'name':"Tahun Pelajaran", 'link':"datatahun", 'icon': 'far fa-calendar-check'},
                        {'name':"Mata Pelajaran", 'link':"datamapel", 'icon': 'fa fa-book'},
                        {'name':"Jurusan", 'link':"datajurusan", 'icon': 'fa fa-flask'},
                        {'name':"Kelas / Rombel", 'link':"datakelas", 'icon': 'fa fa-school'},
                        {'name':"Siswa", 'link':"datasiswa", 'icon': 'fa fa-users'},
                        {'name':"Ekstrakurikuler", 'link':"dataekstra", 'icon': 'fa fa-chess'},
                        {'name':"Guru", 'link':"dataguru", 'icon': 'fa fa-chalkboard-teacher'},<?php if (!$isNurulHakim): ?>
                        
                        <?php endif; ?>
                        {'name':"Pengaturan API AI", 'link':"aigenerator", 'icon': 'fas fa-robot text-primary'}
                    ]
                },
                
                {
                    'name': 'Data Ujian', 'icon': 'fa fa-user-graduate', 'cbt': '1',
                    'submenu': [
                        {'name':"Jenis Ujian", 'link':"cbtjenis", 'icon': 'fa fa-project-diagram'},
                        {'name':"Sesi", 'link':"cbtsesi", 'icon': 'far fa-clock'},
                        {'name':"Ruang", 'link':"cbtruang", 'icon': 'fa fa-door-open'},
                        {'name':"Nomor Peserta", 'link':"cbtnomorpeserta", 'icon': 'far fa-id-card'},
                        {'name':"Atur Ruang/Sesi", 'link':"cbtsesisiswa", 'icon': 'fa fa-user-clock'},
                        {'name':"Bank Soal", 'link':"cbtbanksoal", 'icon': 'far fa-folder-open'},
                        {'name':"Jadwal", 'link':"cbtjadwal", 'icon': 'far fa-calendar-alt'},
                        {'name':"Alokasi Waktu", 'link':"cbtalokasi", 'icon': 'fa fa-clock-o'},
                        {'name':"Pengawas", 'link':"cbtpengawas", 'icon': 'fa fa-briefcase'},
                        {'name':"Token", 'link':"cbttoken", 'icon': 'fa fa-key'},
                        {'name':"Exambro", 'link':"cbtexambro", 'icon': 'fas fa-shield-alt'}
                    ]
                },
                {
                    'name': 'Pengumuman', 'link': 'pengumuman', 'icon': 'fas fa-bullhorn', 'cbt': '1'
                },
                {
                    'name': 'Upload Banner', 'link': 'banner', 'icon': 'fas fa-images', 'cbt': '1'
                },
                {
                    'name': 'Log Aktivitas', 'link': 'datalogs', 'icon': 'fas fa-clock', 'cbt': '1'
                },
            ]
        },
        {
            'header': 'PELAKSANAAN', 'cbt': '1',
            'menu': [
                
                {
                    'name': 'Pelaksanaan Ujian', 'icon': 'fas fa-graduation-cap', 'cbt': '1',
                    'submenu': [
                        {'name': 'Cetak', 'link':"cbtcetak", 'icon': 'fa fa-print'},
                        {'name': 'Aktivasi Peserta', 'link':"cbtactivate", 'icon': 'fa fa-users-cog'},
                        {'name': 'Status Siswa', 'link':"cbtstatus", 'icon': 'fa fa-user-clock'},
                        {'name': 'Hasil Ujian', 'link':"cbtnilai", 'icon': 'fa fa-file-alt'},
                        {'name': 'Rekap Nilai', 'link':"cbtrekap", 'icon': 'fas fa-trophy'},
                        {'name': 'Analisis Soal', 'link':"cbtanalisis", 'icon': 'fas fa-chart-pie'}
                    ]
                },
            ]
        },
        {
            'header': 'RAPOR', 'cbt': '1',
            'menu': [
                {'name': 'Setting Rapor', 'link': 'rapor', 'icon': 'fas fa-cog', 'cbt': '1'},
                {'name': 'Mapel Rapor', 'link': 'rapor/mapel', 'icon': 'fas fa-book-open text-primary', 'cbt': '1'},
                {'name': 'Leger Nilai', 'link': 'rapor/leger', 'icon': 'fa fa-file-alt', 'cbt': '1'},
                {'name': 'Kumpulan Nilai', 'link': 'bukurapor', 'icon': 'fas fa-book', 'cbt': '0'},
                {'name': 'Alumni', 'link': 'dataalumni', 'icon': 'fa fa-users', 'cbt': '0'},
            ]
        },
        {
            'header': 'PENGATURAN',  'cbt': '1',
            'menu': [
                {'name': 'Profile Sekolah', 'link': 'sekolah', 'icon': 'fas fa-university', 'cbt': '1'},
                {
                    'name': 'User Management', 'icon': 'fa fa-users-cog', 'cbt': '1',
                    'submenu': [
                        {'name': 'Administrator', 'link':"useradmin", 'icon': 'fas fa-user-shield'},
                        {'name': 'Guru', 'link':"userguru", 'icon': 'fas fa-user-tie'},
                        {'name': 'Siswa', 'link':"usersiswa", 'icon': 'fas fa-user-graduate'}
                    ]
                },
                {
                    'name': 'Database', 'icon': 'fa fa-users-cog', 'cbt': '1',
                    'submenu': [
                        {'name': 'Backup', 'link':"dbmanager", 'icon': 'fas fa-database'},
                        {'name': 'Data Manager', 'link':"dbclear", 'icon': 'fas fa-database'},
                        {'name': 'Image Converter', 'link':"dbconvert", 'icon': 'fas fa-image'},
                    ]
                },
                {
                    'name': 'Patch & Versi', 'link': "patch", 'icon': 'fas fa-shield-alt', 'cbt': '1'
                },
                {
                    'name': 'Panduan Pengguna', 'link': "Doc", 'icon': 'fas fa-book-reader', 'cbt': '1'
                },
            ]
        }
    ];

    const isLogin = localStorage.getItem('nextgenCBT.login')
    const isCbtMode = isLogin ? isLogin === '1' : false
    let htmlMenu = '';

    function getSvgIcon(iconClass) {
        var map = {
            'fas fa-desktop': 'lucide:home',
            'fas fa-server': 'lucide:database',
            'far fa-calendar-check': 'lucide:calendar-check',
            'fa fa-book': 'lucide:book-open',
            'fa fa-flask': 'lucide:flask-conical',
            'fa fa-school': 'lucide:school',
            'fa fa-users': 'lucide:users',
            'fa fa-chess': 'lucide:puzzle',
            'fa fa-chalkboard-teacher': 'lucide:presentation',
            'fas fa-chalkboard': 'lucide:monitor-play',
            'fa fa-calendar-alt': 'lucide:calendar-days',
            'far fa-calendar-alt': 'lucide:calendar-days',
            'fa fa-pencil-ruler': 'lucide:pen-tool',
            'fa fa-drafting-compass': 'lucide:compass',
            'fa fa-user-graduate': 'lucide:graduation-cap',
            'fas fa-graduation-cap': 'lucide:graduation-cap',
            'fa fa-project-diagram': 'lucide:network',
            'far fa-clock': 'lucide:clock',
            'fa fa-clock-o': 'lucide:clock',
            'fas fa-clock': 'lucide:clock',
            'fa fa-door-open': 'lucide:door-open',
            'far fa-id-card': 'lucide:id-card',
            'fa fa-user-clock': 'lucide:user-cog',
            'far fa-folder-open': 'lucide:folder-open',
            'fa fa-briefcase': 'lucide:briefcase',
            'fa fa-key': 'lucide:key',
            'fas fa-bullhorn': 'lucide:megaphone',
            'fas fa-microscope': 'lucide:microscope',
            'far fa-clipboard': 'lucide:clipboard-list',
            'fa fa-user-check': 'lucide:user-check',
            'fa fa-tasks': 'lucide:list-todo',
            'fa fa-trophy': 'lucide:trophy',
            'fas fa-trophy': 'lucide:trophy',
            'fa fa-print': 'lucide:printer',
            'fa fa-users-cog': 'lucide:users-round',
            'fa fa-file-alt': 'lucide:file-text',
            'fas fa-university': 'lucide:building-2',
            'fas fa-cog': 'lucide:settings',
            'fas fa-user-tie': 'lucide:user-round-tie',
            'fa fa-database': 'lucide:database',
            'fas fa-database': 'lucide:database',
            'fas fa-image': 'lucide:image',
            'fas fa-sign-out-alt': 'lucide:log-out',
            'fas fa-book': 'lucide:book-open',
            'fas fa-robot': 'lucide:bot',
            'fas fa-robot text-primary': 'lucide:bot'
        };
        var iconName = map[iconClass] || 'lucide:chevron-right';
        return '<iconify-icon icon="' + iconName + '" class="icon-20" width="20" height="20" style="vertical-align: middle; padding-right: 8px;"></iconify-icon>';
    }

    menus.forEach(function (header) {
        if (isCbtMode && header.cbt === '0') {
            return
        }
        if (header.header) {
            htmlMenu += `<li class="nav-header">${header.header}</li>`;
            header.menu.forEach(function (menu) {
                if (isCbtMode && menu.cbt === '0') {
                    return
                }
                if (menu.submenu) {
                    var currPath = page + (pageact ? '/' + pageact : '');
                    var open = menu.submenu.some(function(s) {
                        var sl = s.link || s['link'] || '';
                        return sl === currPath || sl === page || 
                               (sl.indexOf('/') !== -1 && sl.split('/')[0] === page && page !== 'dashboard');
                    });
                    htmlMenu += `<li class="nav-item has-treeview ${open ? "menu-open" : ""}">
                    <a href="#" class="nav-link ${open ? "active" : ""}">`
                        <i class="nav-icon">${getSvgIcon(menu.icon)}</i>
                        <p>${menu.name}<i class="fas fa-angle-left right"></i></p>
                    </a><ul class="nav nav-treeview">`;
                    menu.submenu.forEach(function (sub) {
                        htmlMenu += `<li class="nav-item">
                            <a href="${base_url + sub.link}"
                               class="nav-link ${page+'/'+pageact === sub.link || page === sub.link ? "active" : ""}">
                                <i class="nav-icon">${getSvgIcon(sub.icon)}</i>
                                <p>${sub.name}</p>
                            </a>
                        </li>`;
                    })
                    htmlMenu += `</ul></li>`;
                } else {
                    htmlMenu += `<li class="nav-item"><a href="${base_url + menu.link}"
                       class="nav-link ${page === menu.link ? "active" : ""}">
                        <i class="nav-icon">${getSvgIcon(menu.icon)}</i>
                        <p>${menu.name}</p>
                    </a></li>`
                }
            })
        } else {
            htmlMenu += `<hr /><li class="nav-item">
                    <a href="${base_url}auth/logout" onclick="logout(event); return false;" class="nav-link">
                        <i class="nav-icon">${getSvgIcon(header.icon)}</i>
                        <p>${header.name}</p>
                    </a>
                </li>`;
        }
    })
    $('#tree-menus').html(htmlMenu)
</script>


