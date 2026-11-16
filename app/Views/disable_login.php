<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Akun Belum Aktif</title>
    <link rel="stylesheet" href="<?= base_url() ?>/assets/adminlte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/all.min.css">
    <?php if (isset($setting) && $setting): ?>
    <?php $favicon = $setting->logo_kiri ?? ''; ?>
    <link rel="shortcut icon" href="<?= $favicon ? base_url($favicon) : base_url('assets/img/favicon.png') ?>" type="image/x-icon">
    <?php endif; ?>
    <style>
        body {
            background: linear-gradient(135deg, #1a3c2e 0%, #2d6a4f 50%, #40916c 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .disable-card {
            background: rgba(255,255,255,0.97);
            border-radius: 16px;
            padding: 48px 40px;
            max-width: 480px;
            width: 100%;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .disable-icon {
            width: 90px;
            height: 90px;
            background: #fff3cd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
        }
        .disable-icon i {
            font-size: 42px;
            color: #e6ac00;
        }
        .disable-card h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a3c2e;
            margin-bottom: 12px;
        }
        .disable-card p {
            color: #6c757d;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 0;
        }
        .school-name {
            font-size: 0.85rem;
            color: #adb5bd;
            margin-bottom: 4px;
        }
        .btn-back {
            margin-top: 28px;
            background: #2d6a4f;
            color: white;
            border: none;
            padding: 10px 32px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: background 0.2s;
        }
        .btn-back:hover {
            background: #1a3c2e;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="disable-card">
        <?php if (isset($setting) && $setting): ?>
        <p class="school-name"><?= esc($setting->sekolah ?? '') ?></p>
        <?php endif; ?>

        <div class="disable-icon">
            <i class="fas fa-user-clock"></i>
        </div>

        <h2>Akun Belum Terdaftar</h2>
        <p>
            Akun Anda belum terdaftar di kelas aktif untuk tahun pelajaran / semester saat ini.
            <br><br>
            Silakan hubungi administrator atau wali kelas Anda untuk pendaftaran.
        </p>

        <a href="<?= base_url('auth/logout') ?>" class="btn-back">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </a>
    </div>
</body>
</html>
