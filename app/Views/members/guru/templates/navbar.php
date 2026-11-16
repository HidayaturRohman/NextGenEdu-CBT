<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light shadow">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

        <li class="nav-item">
            <span class="nav-link text-dark">TP: <?= isset($tp_active) ? $tp_active->tahun : "Belum di set" ?> Smt: <?= isset($smt_active) ? $smt_active->nama_smt : "Belum di set" ?></span>
        </li>
    </ul>

    <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item me-3">
            <div id="live-clock"></div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-bold" href="#" id="navbarUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user-circle me-1"></i>
                <?= esc(session()->get('nama') ?? session()->get('username') ?? 'Guru') ?>
            </a>
            <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="navbarUser">
                <a class="dropdown-item text-black" href="<?= base_url('guru/profile') ?>"><i class="fas fa-user fa-fw me-2"></i> Profil</a>
                <a class="dropdown-item text-black" href="<?= base_url('useradmin/gantipassword') ?>"><i class="fas fa-key fa-fw me-2"></i> Ganti Password</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="<?= base_url('auth/logout') ?>" onclick="logout(event); return false;">
                    <i class="fas fa-sign-out-alt fa-fw me-2"></i> Logout
                </a>
            </div>
        </li>
    </ul>

</nav>
