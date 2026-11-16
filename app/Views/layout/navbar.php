<!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-body shadow">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"><i class="bi bi-list text-dark"></i></a>
        </li>

        <li class="nav-item">
            <span class="nav-link text-dark"><b>TP: <?= isset($tp_active) ? esc($tp_active->tahun) : "Belum di set" ?> Smt: <?= isset($smt_active) ? esc($smt_active->nama_smt) : "Belum di set" ?></b></span>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ms-auto">
        <li class="nav-item d-none d-md-inline-block">
            <a class="nav-link text-bold" href="#" id="live-clock">
                <span class="text-lg">00:00</span>:00
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-bold" href="#" id="navbarUser" role="button" data-bs-toggle="dropdown">
                Hi, <?= isset($user->first_name) ? esc($user->first_name) : (is_array($user) && isset($user['first_name']) ? esc($user['first_name']) : 'User') ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="navbarUser">
                <a class="dropdown-item text-black" href="#"><i class="fas fa-user fa-fw me-2"></i> Profil</a>
                <a class="dropdown-item text-black" href="#"><i class="fas fa-key fa-fw me-2"></i> Ganti Password</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-black" href="<?= base_url('auth/logout') ?>" onclick="logout(event); return false;">
                    <i class="fas fa-sign-out-alt fa-fw me-2 text-danger"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

