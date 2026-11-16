<!DOCTYPE html>
<html>

<head>

    <!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $judul ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php $logo_app = $setting->logo_kiri == null ? base_url() . 'assets/img/favicon.png' : base_url() . $setting->logo_kiri; ?>
    <link rel="shortcut icon" href="<?= $logo_app ?>" type="image/x-icon">

    <!-- Required CSS -->
    <!-- v3 -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
          href="<?= base_url() ?>/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/fontawesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/v4-shims.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/Ionicons/css/ionicons.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- multi select -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/multiselect/css/multi-select.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/summernote/summernote-bs4.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/app/css/jquery.toast.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/toastr/toastr.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/dropify/css/dropify.min.css">

    <!-- Datatables Buttons -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- textarea editor -->
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/katex/katex.css">
    <!-- /texarea editor; -->

    <!-- fonts -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/adminlte/dist/css/poppins.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/adminlte/dist/css/calibri.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/adminlte/dist/css/adminlte.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/app/css/mystyle.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/app/css/show.toast.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/plugins/fields-linker/fieldsLinker.css">
    <link href="<?= base_url() ?>/assets/app/css/player.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url() ?>/assets/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.min.js"></script>

    <script defer src="<?= base_url() ?>/assets/plugins/katex/contrib/auto-render.min.js" onload="renderMathInElement(document.body);"></script>

    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/jquery-datetimepicker/jquery.datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/app/css/new-upload.css">

    <style>
        .linker-list p {
            margin-bottom: .5rem;
            margin-top: .5rem;
        }
        .dates-wrapper {
            position: relative;
            width: 100%;
            max-width: 1200px;
            margin: auto;
            padding: 0 40px;
        }

        .dates-container {
            display: flex;
            justify-content: space-between;
            overflow-x: auto;
            padding: 0;
            white-space: nowrap;
            scroll-behavior: smooth;
        }
        .scroll-button {
            position: absolute;
            top: 35%;
            transform: translateY(-50%);
            background-color: #f7f4ff;
            color: grey;
            border: none;
            padding: 15px 10px;
            cursor: pointer;
            border-radius: 6px;
            z-index: 1;
        }

        .scroll-button:hover {
            color: #1f2d3d;
            background-color: #e0e7ff;
            border-color: #f8f9fa;
        }

        .scroll-left {
            left: 0;
        }

        .scroll-right {
            right: 0;
        }

        /* Universal Rock-Solid Icon Stabilization */
        iconify-icon {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            vertical-align: -0.15em !important;
            width: 1.15em !important;
            height: 1.15em !important;
            min-width: 1.15em !important;
            min-height: 1.15em !important;
            max-width: 1.15em !important;
            max-height: 1.15em !important;
            line-height: 1 !important;
            flex-shrink: 0 !important;
            box-sizing: content-box !important;
        }
        iconify-icon svg {
            display: block !important;
            width: 100% !important;
            height: 100% !important;
            max-width: 100% !important;
            max-height: 100% !important;
            flex-shrink: 0 !important;
        }
        i.fa, i.fas, i.far, i.fal, i.fab, i.bi {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            vertical-align: -0.125em !important;
            line-height: 1 !important;
            flex-shrink: 0 !important;
        }
        .btn i, .btn iconify-icon, .btn svg {
            font-size: 1.05rem !important;
            width: 1.15em !important;
            height: 1.15em !important;
            line-height: 1 !important;
            vertical-align: -0.15em !important;
            flex-shrink: 0 !important;
        }
        .btn-action-icon {
            width: 32px !important;
            height: 32px !important;
            min-width: 32px !important;
            min-height: 32px !important;
            max-width: 32px !important;
            max-height: 32px !important;
            padding: 0 !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            border-radius: 8px !important;
            margin: 0 2px !important;
            font-size: 0 !important;
            line-height: 0 !important;
            flex-shrink: 0 !important;
        }
        .btn-action-icon iconify-icon,
        .btn-action-icon i,
        .btn-action-icon svg {
            margin: 0 !important;
            padding: 0 !important;
            width: 16px !important;
            height: 16px !important;
            min-width: 16px !important;
            min-height: 16px !important;
            max-width: 16px !important;
            max-height: 16px !important;
            font-size: 16px !important;
            color: inherit !important;
            line-height: 1 !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            flex-shrink: 0 !important;
        }
    </style>

    <!-- Iconify for 3D Emojis and Modern Icons Replacer -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= base_url() ?>/assets/app/js/modern_icons.js"></script>
</head>

<script type="text/javascript">
    let base_url = '<?= rtrim(base_url(), '/') . '/' ?>';

    $(document).ready(function () {
        // cek update
        const page = '<?= service('uri')->getSegment(1) ?>';
        if (page !== 'dashboard') {
            $.ajax({
                url: base_url + "dashboard/check_version",
                type: "GET",
                success: function (response) {
                    if (!response.is_latest) {
                        window.location.href = base_url + 'dashboard/need_update'
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr);
                }
            });
        }
    });

</script>

<?php

$uri  = service('uri');
$dash = $uri->getSegment(1);
$cbt  = $uri->getSegment(2);

$exludes = ["dashboard", "penilaian"];
$dnone = in_array($dash, $exludes) || in_array($cbt, $exludes) ? 'invisible' : '';

$to_home = ['bukamateri', 'bukatugas', 'konfirmasi'];
$previous = "javascript:history.go(-1)";
if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}
$backTo = in_array(strtolower($cbt ?? ''), $to_home) ? $previous : base_url('dashboard');

$display_clock  = $cbt == "penilaian" ? '' : 'd-none';
$display_logout = $cbt == "penilaian" ? 'd-none' : '';
?>

<body class="layout-top-nav layout-navbar-fixed">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand-md navbar-dark navbar-green border-bottom-0">
        <ul class="navbar-nav ms-2 <?= $dnone ?>" id="back">
            <li class="nav-item">
                <a href="<?= $backTo ?>" type="button" class="btn btn-success shadow-sm" id="url-back">
                    <i class="fas fa-arrow-left me-2"></i><span class="d-none d-sm-inline-block ms-1">Kembali</span>
                </a>
            </li>
        </ul>
        <div class="mx-auto text-white text-center" style="line-height: 1">
            <span class="text-md p-0 d-inline-block text-truncate" style="max-width: 250px"><?= $setting->sekolah ?></span>
            <br>
            <small>TP: <?= $tp_active->tahun ?> Smt: <?= $smt_active->smt ?></small>
        </div>
        <ul class="navbar-nav <?= $display_clock ?>">
            <li class="nav-item">
                <div id="live-clock" class="text-end text-white"></div>
            </li>
        </ul>
        <ul class="navbar-nav <?= $display_logout ?> ms-2">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white fw-bold" href="#" id="siswaNavbarUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle me-1"></i>
                    <?= esc(session()->get('nama') ?? session()->get('username') ?? 'Siswa') ?>
                </a>
                <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="siswaNavbarUser">
                    <a class="dropdown-item text-black" href="#"><i class="fas fa-user fa-fw me-2"></i> Profil</a>
                    <a class="dropdown-item text-black" href="#"><i class="fas fa-key fa-fw me-2"></i> Ganti Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="<?= base_url('auth/logout') ?>" onclick="logout(event); return false;">
                        <i class="fas fa-sign-out-alt fa-fw me-2"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>

    <script type="text/javascript">
        const isLogin = localStorage.getItem('nextgenCBT.login')
        const isCbtMode = isLogin ? isLogin === '1' : false
        if (isCbtMode) {
            $("a#url-back").attr("href", base_url + 'cbtsiswa/cbt');
            if ('<?= $cbt ?>' === 'cbt') {
                $('#back').addClass('d-none')
            }
        }
    </script>
