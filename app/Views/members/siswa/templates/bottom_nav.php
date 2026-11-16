<?php
/**
 * Bottom Navigation Bar untuk CBT Free (Beranda, Pengumuman, Ujian, Profil)
 */
$uriNav = service('uri');
$seg1 = $uriNav->getSegment(1) ?? '';
$seg2 = $uriNav->getSegment(2) ?? '';

$is_home    = ($seg1 === 'siswa' || $seg1 === 'dashboard' || $seg1 === '');
$is_ujian   = ($seg1 === 'cbtsiswa' || $seg1 === 'cbt');
$is_peng    = ($seg1 === 'pengumuman');

$dbNav = \Config\Database::connect();
$badgeUjian = 0;
if ($dbNav->tableExists('cbt_jadwal')) {
    $todayNav = date('Y-m-d');
    $badgeUjian = $dbNav->table('cbt_jadwal')
        ->where('tgl_mulai <=', $todayNav)
        ->where('tgl_selesai >=', $todayNav)
        ->where('status', 1)
        ->countAllResults();
}
?>

<!-- ================= BOTTOM NAVIGATION BAR (CBT FREE) ================= -->
<div id="shopeepay-bottom-nav" class="d-block d-lg-none">
    <div class="bottom-nav-container justify-content-around">
        <!-- 1. Beranda -->
        <a href="<?= base_url('dashboard') ?>" class="nav-item <?= $is_home ? 'active' : '' ?>">
            <div class="nav-icon">
                <i class="fas fa-home"></i>
            </div>
            <span class="nav-label">Beranda</span>
        </a>

        <!-- 2. Pengumuman -->
        <a href="<?= base_url('pengumuman') ?>" class="nav-item <?= $is_peng ? 'active' : '' ?>">
            <div class="nav-icon">
                <i class="fas fa-bullhorn"></i>
            </div>
            <span class="nav-label">Pengumuman</span>
        </a>

        <!-- 3. Ujian CBT -->
        <a href="<?= base_url('cbtsiswa/cbt') ?>" class="nav-item <?= $is_ujian ? 'active' : '' ?>">
            <div class="nav-icon position-relative">
                <i class="fas fa-laptop-code"></i>
                <?php if ($badgeUjian > 0): ?>
                <span class="nav-notif-badge"><?= $badgeUjian > 9 ? '9+' : $badgeUjian ?></span>
                <?php endif; ?>
            </div>
            <span class="nav-label">Ujian CBT</span>
        </a>

        <!-- 4. Profil Siswa -->
        <a href="javascript:void(0)" onclick="bukaProfilMobile()" class="nav-item">
            <div class="nav-icon">
                <i class="fas fa-user-circle"></i>
            </div>
            <span class="nav-label">Profil</span>
        </a>
    </div>
</div>

<!-- Modal Profil Mobile Siswa -->
<div class="modal fade" id="modalProfilMobile" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
            <div class="modal-header bg-primary text-white border-0 py-3">
                <h6 class="modal-title fw-bold"><i class="fas fa-user-graduate me-2"></i>Profil Siswa</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-4">
                <div class="avatar-wrapper mb-3">
                    <img src="<?= base_url('assets/img/user-default.png') ?>" class="rounded-circle shadow" style="width: 80px; height: 80px; object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=Siswa&background=0D8ABC&color=fff'">
                </div>
                <h5 class="fw-bold text-dark mb-1"><?= session()->get('first_name') ?? session()->get('username') ?></h5>
                <p class="text-muted small mb-3">Peserta Ujian CBT</p>
                <div class="d-grid gap-2">
                    <a href="<?= base_url('auth/logout') ?>" class="btn btn-danger py-2 rounded-pill fw-bold">
                        <i class="fas fa-sign-out-alt me-2"></i>Keluar / Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function bukaProfilMobile() {
    if (typeof bootstrap !== 'undefined') {
        var modalEl = document.getElementById('modalProfilMobile');
        var myModal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
        myModal.show();
    } else if (typeof $ !== 'undefined') {
        $('#modalProfilMobile').modal('show');
    }
}
</script>
