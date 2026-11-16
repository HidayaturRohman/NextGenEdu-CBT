<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <script>
        // Enforce Light Scheme permanently for Student Member
        try {
            localStorage.setItem('color-mode', 'light');
            sessionStorage.setItem('color-mode', 'light');
            localStorage.removeItem('theme-color');
            sessionStorage.removeItem('theme-color');
            localStorage.removeItem('theme-scheme');
            sessionStorage.removeItem('theme-scheme');
            document.documentElement.setAttribute('data-bs-theme', 'light');
        } catch(e) {}
    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?= isset($judul) ? esc($judul) : 'Aplikasi Ujian CBT & E-Learning' ?></title>
    <?php $logo_app = isset($setting) && $setting->logo_kiri != null ? base_url($setting->logo_kiri) : base_url('assets/img/favicon.png'); ?>
    <link rel="shortcut icon" href="<?= $logo_app ?>" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Aksara Jawa Font Support (Offline & Online) -->
    <link rel="stylesheet" href="<?= base_url('assets/fonts/aksarajawa/aksarajawa.css') ?>">

    <!-- Hope UI Core Theme -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/hopeui/css/core/libs.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/hopeui/css/hope-ui.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/hopeui/css/custom.min.css">
    <!-- Theme setting & dark mode removed for student members: forced light scheme -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/v4-shims.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/bootstrap-icon/bootstrap-icons.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/app/css/jquery.toast.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/app/css/show.toast.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Summernote -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/summernote/plugin/audio/summernote-audio.css">
    <!-- KaTeX -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/katex/katex.css">
    <!-- DateTime picker -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/jquery-datetimepicker/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Other plugins -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/dropify/css/dropify.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/multiselect/css/multi-select.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/DualSelectList/css/bala.DualSelectList.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/contextmenu/jquery.contextmenu.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fields-linker/fieldsLinker.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/pignose/css/pignose.calendar.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/app/css/weekCalendar.css">
    <!-- App CSS (Commented out to prevent Hope UI conflicts) -->
    <!--
    <link rel="stylesheet" href="<?= base_url() ?>/assets/app/css/mystyle.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/app/css/stylised.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/app/css/new-upload.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/app/css/player.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/app/css/premium-dashboard.css?v=<?= time() ?>">
    -->

    <style>
        /* Cegah Pergeseran Halaman / Scrollbar Jump Saat Buka Modal */
        html {
            overflow-y: scroll !important;
            scrollbar-gutter: stable;
        }
        body,
        body.modal-open,
        .main-content,
        .sidebar,
        header,
        .navbar,
        .fixed-top,
        .fixed-bottom {
            padding-right: 0 !important;
            margin-right: 0 !important;
        }
        body.modal-open {
            overflow-y: scroll !important;
        }
        .modal {
            padding-right: 0 !important;
            padding-left: 0 !important;
            overflow-y: auto !important;
        }

        /* Sembunyikan default media controls / play button pada video scanner */
        video::-webkit-media-controls,
        video::-webkit-media-controls-start-playback-button,
        video::-webkit-media-controls-play-button,
        video::-webkit-media-controls-overlay-play-button,
        video::-webkit-media-controls-enclosure,
        video::-webkit-media-controls-panel {
            display: none !important;
            -webkit-appearance: none !important;
            opacity: 0 !important;
            pointer-events: none !important;
        }

        /* Hilangkan Latar Belakang Hitam / Backdrop Modal & SweetAlert */
        .modal-backdrop,
        .modal-backdrop.show,
        .modal-backdrop.fade {
            display: none !important;
            background: transparent !important;
            opacity: 0 !important;
            pointer-events: none !important;
        }
        .modal {
            background: transparent !important;
        }
        .modal-dialog {
            z-index: 1060 !important;
        }
        .modal-content {
            box-shadow: 0 20px 50px -10px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(0, 0, 0, 0.08) !important;
            border-radius: 12px !important;
            border: none !important;
        }
        .swal2-container.swal2-backdrop-show, .swal2-container.swal2-noanimation {
            background: rgba(0, 0, 0, 0.15) !important;
        }

        /* Kunci Tampilan PC di Zoom 85% */
        @media (min-width: 992px) { html:not(.flipbook-active) { zoom: 80% !important; }
        }
        @media (max-width: 991.98px) {
        html, body {
            overflow-x: hidden !important;
            max-width: 100vw !important;
        }
            html:not(.flipbook-active) { zoom: 100% !important; }
        }
        @media print {
            html, body { zoom: 100% !important; }
        }
        body { font-family: 'Inter', sans-serif !important; }
        page { background: white; display: block; margin: 0 auto; margin-bottom: .5cm; box-shadow: none; }
        page[size="A4"][layout="potrait"] { width: 21cm; height: 29.7cm; }
        page[size="A4"] { width: 29.7cm; height: 21cm; }
        .linker-list p { margin-bottom: .5rem; margin-top: .5rem; }
        /* Sembunyikan setting tema / customizer untuk siswa & pastikan mode terang */
        .btn-setting,
        #offcanvasExample,
        [data-bs-target="#offcanvasExample"] {
            display: none !important;
            visibility: hidden !important;
            pointer-events: none !important;
        }

        /* === SISWA ENTERPRISE CONTRAST & HOPE-UI BUTTON FIX === */
        :root,
        [data-bs-theme="light"] {
            --bs-dark: #0f172a;
            --bs-dark-rgb: 15, 23, 42;
            --bs-gray-900: #ffffff;
            --bs-list-group-bg: #ffffff;
            --bs-list-group-color: #1e293b;
            --bs-body-color: #1e293b;
            --bs-body-bg: #f8fafc;
            --bs-primary-hover-bg: #2e46ba;
            --bs-primary-hover-border: #2a3fa8;
            --bs-primary-active-bg: #2a3fa8;
            --bs-primary-active-border: #253896;
            --bs-secondary-hover-bg: #334155;
            --bs-secondary-hover-border: #1e293b;
            --bs-secondary-active-bg: #1e293b;
            --bs-secondary-active-border: #0f172a;
            --bs-success-hover-bg: #15803d;
            --bs-success-hover-border: #166534;
            --bs-success-active-bg: #166534;
            --bs-success-active-border: #14532d;
            --bs-warning-hover-bg: #d97706;
            --bs-warning-hover-border: #b45309;
            --bs-warning-active-bg: #b45309;
            --bs-warning-active-border: #92400e;
            --bs-danger-hover-bg: #b91c1c;
            --bs-danger-hover-border: #991b1b;
            --bs-danger-active-bg: #991b1b;
            --bs-danger-active-border: #7f1d1d;
            --bs-info-hover-bg: #0e7490;
            --bs-info-hover-border: #155e75;
            --bs-info-active-bg: #155e75;
            --bs-info-active-border: #164e63;
            --bs-dark-hover-bg: #0f172a;
            --bs-dark-hover-border: #0f172a;
            --bs-dark-active-bg: #020617;
            --bs-dark-active-border: #020617;
        }

        body {
            background-color: #f8fafc !important;
            color: #1e293b !important;
        }
        .card:not([class*="bg-"]),
        .modal-content {
            background-color: #ffffff !important;
            color: #1e293b !important;
        }
        .list-group-item:not([class*="bg-"]):not(.active) {
            background-color: #ffffff !important;
            color: #1e293b !important;
            --bs-list-group-bg: #ffffff;
            --bs-list-group-color: #1e293b;
        }
        .card-header.bg-light,
        .list-group-item.bg-light {
            background-color: #f1f5f9 !important;
            color: #0f172a !important;
        }
        .text-dark,
        .text-black {
            color: #0f172a !important;
        }
        .card:not([class*="bg-"]) .text-muted,
        .list-group-item .text-muted,
        .table .text-muted,
        .form-text.text-muted {
            color: #475569 !important;
        }
        .card:not([class*="bg-"]) .alert-light {
            background-color: #f8fafc !important;
            color: #1e293b !important;
            border-color: #e2e8f0 !important;
        }
        .card:not([class*="bg-"]) .alert-light .text-muted,
        .card:not([class*="bg-"]) .alert-light li {
            color: #334155 !important;
        }
        .form-control,
        .form-select {
            background-color: #ffffff !important;
            color: #0f172a !important;
        }
        .form-control::placeholder {
            color: #64748b !important;
            opacity: 1 !important;
        }

        /* Lock button contrast across default, hover, focus, active, disabled */
        .btn-success,
        .btn-success:hover,
        .btn-success:focus,
        .btn-success:active,
        .btn-success.active,
        .btn-success:focus-visible,
        .btn-success:disabled,
        .btn-success.disabled {
            background-color: #16a34a !important;
            border-color: #15803d !important;
            color: #ffffff !important;
            --bs-btn-color: #ffffff;
            --bs-btn-bg: #16a34a;
            --bs-btn-border-color: #15803d;
            --bs-btn-hover-color: #ffffff;
            --bs-btn-hover-bg: #15803d;
            --bs-btn-hover-border-color: #166534;
            --bs-btn-active-color: #ffffff;
            --bs-btn-active-bg: #166534;
            --bs-btn-active-border-color: #14532d;
            --bs-btn-disabled-color: #ffffff;
            --bs-btn-disabled-bg: #16a34a;
            --bs-btn-disabled-border-color: #15803d;
        }
        .btn-success:hover,
        .btn-success:focus,
        .btn-success:active {
            background-color: #15803d !important;
            border-color: #166534 !important;
        }
        .btn-primary,
        .btn-primary:hover,
        .btn-primary:focus,
        .btn-primary:active,
        .btn-primary.active,
        .btn-primary:disabled,
        .btn-primary.disabled {
            background-color: #3a57e8 !important;
            border-color: #2e46ba !important;
            color: #ffffff !important;
        }
        .btn-primary:hover,
        .btn-primary:focus,
        .btn-primary:active {
            background-color: #2e46ba !important;
            border-color: #253896 !important;
        }
        .btn-secondary,
        .btn-secondary:hover,
        .btn-secondary:focus,
        .btn-secondary:active,
        .btn-secondary.active,
        .btn-secondary:disabled,
        .btn-secondary.disabled {
            background-color: #475569 !important;
            border-color: #334155 !important;
            color: #ffffff !important;
        }
        .btn-secondary:hover,
        .btn-secondary:focus,
        .btn-secondary:active {
            background-color: #334155 !important;
            border-color: #1e293b !important;
        }
        .btn-danger,
        .btn-danger:hover,
        .btn-danger:focus,
        .btn-danger:active {
            background-color: #dc2626 !important;
            border-color: #b91c1c !important;
            color: #ffffff !important;
        }
        .btn-warning,
        .btn-warning:hover,
        .btn-warning:focus,
        .btn-warning:active {
            background-color: #f59e0b !important;
            border-color: #d97706 !important;
            color: #0f172a !important;
        }
        .btn-info,
        .btn-info:hover,
        .btn-info:focus,
        .btn-info:active {
            background-color: #0891b2 !important;
            border-color: #0e7490 !important;
            color: #ffffff !important;
        }
        .btn-dark,
        .btn-dark:hover,
        .btn-dark:focus,
        .btn-dark:active {
            background-color: #1e293b !important;
            border-color: #0f172a !important;
            color: #ffffff !important;
        }
        .btn-outline-dark {
            background-color: #ffffff !important;
            border-color: #475569 !important;
            color: #1e293b !important;
        }
        .btn-outline-dark * {
            color: inherit !important;
        }
        .btn-outline-dark:hover,
        .btn-outline-dark:focus,
        .btn-outline-dark:active {
            background-color: #1e293b !important;
            border-color: #1e293b !important;
            color: #ffffff !important;
        }
        .btn-light,
        .btn-light:hover,
        .btn-light:focus,
        .btn-light:active,
        .btn-light.disabled,
        .btn-light:disabled {
            background-color: #f1f5f9 !important;
            border-color: #cbd5e1 !important;
            color: #334155 !important;
            opacity: 0.92 !important;
        }
        .btn-success *,
        .btn-primary *,
        .btn-secondary *,
        .btn-danger *,
        .btn-info *,
        .btn-dark * {
            color: #ffffff !important;
        }
        .btn-warning * {
            color: #0f172a !important;
        }
        .swal2-popup .swal2-title {
            color: #0f172a !important;
        }
        .swal2-popup .swal2-html-container {
            color: #334155 !important;
        }
    </style>

    <!-- jQuery (in head for inline scripts) -->
    <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>/assets/plugins/DualSelectList/js/bala.DualSelectList.jquery.js"></script>
    <script defer src="<?= base_url() ?>/assets/plugins/katex/contrib/auto-render.min.js" onload="renderMathInElement(document.body);"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= base_url() ?>/assets/app/js/modern_icons.js"></script>

<script>
window.onerror = function(msg, url, lineNo, columnNo, error) {
  console.warn('Suppressed error:', msg, url, lineNo);
  return true;
};
</script>

    <style>
        /* Cegah Pergeseran Halaman / Scrollbar Jump Saat Buka Modal */
        html {
            overflow-y: scroll !important;
            scrollbar-gutter: stable;
        }
        body,
        body.modal-open,
        .main-content,
        .sidebar,
        header,
        .navbar,
        .fixed-top,
        .fixed-bottom {
            padding-right: 0 !important;
            margin-right: 0 !important;
        }
        body.modal-open {
            overflow-y: scroll !important;
        }
        .modal {
            padding-right: 0 !important;
            padding-left: 0 !important;
            overflow-y: auto !important;
        }

        /* Sembunyikan default media controls / play button pada video scanner */
        video::-webkit-media-controls,
        video::-webkit-media-controls-start-playback-button,
        video::-webkit-media-controls-play-button,
        video::-webkit-media-controls-overlay-play-button,
        video::-webkit-media-controls-enclosure,
        video::-webkit-media-controls-panel {
            display: none !important;
            -webkit-appearance: none !important;
            opacity: 0 !important;
            pointer-events: none !important;
        }

        /* Hilangkan Latar Belakang Hitam / Backdrop Modal & SweetAlert */
        .modal-backdrop,
        .modal-backdrop.show,
        .modal-backdrop.fade {
            display: none !important;
            background: transparent !important;
            opacity: 0 !important;
            pointer-events: none !important;
        }
        .modal {
            background: transparent !important;
        }
        .modal-dialog {
            z-index: 1060 !important;
        }
        .modal-content {
            box-shadow: 0 20px 50px -10px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(0, 0, 0, 0.08) !important;
            border-radius: 12px !important;
            border: none !important;
        }
        .swal2-container.swal2-backdrop-show, .swal2-container.swal2-noanimation {
            background: rgba(0, 0, 0, 0.15) !important;
        }

    /* Responsive Overlap Styling for all Student Views */
    @media (min-width: 992px) {
        .overlap {
            margin-top: -1.5rem !important;
            position: relative;
            z-index: 10;
        }
    }
    @media (max-width: 991.98px) {
        html, body {
            overflow-x: hidden !important;
            max-width: 100vw !important;
        }
        .iq-banner:not(.hide) + .content-inner,
        .conatiner-fluid.content-inner,
        .container-fluid.content-inner,
        .main-content .content-inner {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }
        .overlap,
        .app-content.overlap {
            margin-top: -4.5rem !important;
            position: relative;
            z-index: 10;
        }

        /* Wider mobile boxes & optimal edge spacing */
        .container,
        .container-fluid,
        .content-inner,
        .main-content .content-inner {
            padding-left: 9px !important;
            padding-right: 9px !important;
            max-width: 100% !important;
        }
        .row {
            margin-left: -4px !important;
            margin-right: -4px !important;
        }
        .row > [class*="col-"] {
            padding-left: 4px !important;
            padding-right: 4px !important;
        }
        .card {
            width: 100% !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
            border-radius: 14px !important;
        }
        .card .card-body,
        .card-body.p-4 {
            padding: 0.95rem 0.85rem !important;
        }
        .card .card-header {
            padding: 0.75rem 0.85rem !important;
        }
    }
    /* Mobile Horizontal Table Scroll Enhancement */
    .table-responsive {
        overflow-x: auto !important;
        -webkit-overflow-scrolling: touch !important;
        touch-action: pan-x pan-y !important;
        width: 100% !important;
    }
    .table-responsive::-webkit-scrollbar {
        height: 6px;
    }
    .table-responsive::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    .table-responsive::-webkit-scrollbar-track {
        background: #f1f5f9;
    }
    /* Sembunyikan footer di layar ponsel / tablet (< 992px) karena siswa memakai Bottom Navigation Bar */
    @media (max-width: 991.98px) {
        html, body {
            overflow-x: hidden !important;
            max-width: 100vw !important;
        }
        footer.footer,
        .footer {
            display: none !important;
        }
    }
    /* Footer desktop disembunyikan saat modal terbuka */
    body.modal-open footer,
    body.modal-open .footer,
    .modal.show ~ footer {
        display: none !important;
    }

    /* Menu bawah mobile ShopeePay dibuat PATEN selalu tampil di atas modal pada tampilan mobile */
    @media (max-width: 991.98px) {
        #shopeepay-bottom-nav,
        body.modal-open #shopeepay-bottom-nav,
        .modal-backdrop ~ #shopeepay-bottom-nav,
        .modal.show ~ #shopeepay-bottom-nav,
        body.modal-open div#shopeepay-bottom-nav {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            z-index: 9999 !important;
            pointer-events: auto !important;
        }
        #shopeepay-bottom-nav .bump-svg-wrapper {
            z-index: 9998 !important;
        }
        #shopeepay-bottom-nav .nav-center-bump-action {
            z-index: 10000 !important;
        }

        /* Dialog modal pada mobile diberi margin bawah agar seluruh tombol aksi tidak tertutup bottom nav */
        .modal-dialog {
            margin: 0.75rem auto 88px auto !important;
            max-height: calc(100vh - 100px) !important;
        }
        .modal {
            z-index: 1060 !important;
        }
        .modal-backdrop {
            z-index: 1050 !important;
        }
    }

    @media (min-width: 992px) {
        #shopeepay-bottom-nav {
            display: none !important;
        }
    }

    /* Khusus Simulasi Lab jika aktif */
    #modalLabSimulasi.show ~ #shopeepay-bottom-nav {
        display: none !important;
    }
    /* Modal Lab Simulasi Interaktif berada di atas segalanya */
    #modalLabSimulasi {
        z-index: 2050 !important;
    }
    #modalLabSimulasi .modal-dialog {
        z-index: 2060 !important;
    }

    /* Support .btn-xs globally */
    .btn-xs,
    .btn-group-xs > .btn {
        padding: 0.2rem 0.5rem !important;
        font-size: 0.72rem !important;
        line-height: 1.25 !important;
        border-radius: 6px !important;
    }

    /* ==========================================================================
       GLOBAL MOBILE BUTTON & BUTTON-FONT SLIMMING (SEMUA MENU TANPA TERKECUALI)
       ========================================================================== */
    @media (max-width: 767.98px) {
        .btn:not(.btn-close):not(.sidebar-toggle):not(.mobile-drawer-close-btn):not(.cbt-banner-nav):not(.nav-center-bump-action):not(.btn-notif-mobile):not(.btn-back-responsive):not(.btn-logout-mobile),
        .btn-lg:not(.btn-close),
        .btn.px-3:not(.btn-close):not(.btn-back-responsive),
        .btn.px-4:not(.btn-close),
        .btn.px-5:not(.btn-close),
        .btn.py-2:not(.btn-close),
        .btn.py-3:not(.btn-close) {
            font-size: 0.75rem !important;
            line-height: 1.25 !important;
            padding: 0.3rem 0.65rem !important;
            min-height: 28px !important;
            height: auto !important;
            letter-spacing: 0.01em !important;
        }
        .btn:not(.text-wrap):not(.w-100):not(.d-block) {
            white-space: nowrap !important;
        }
        .btn.btn-sm:not(.btn-close):not(.btn-notif-mobile):not(.btn-back-responsive),
        .btn.btn-sm.px-3:not(.btn-close),
        .btn.btn-sm.px-4:not(.btn-close),
        .btn-group-sm > .btn,
        .card-header .btn:not(.btn-close),
        .card-tools .btn:not(.btn-close) {
            font-size: 0.71rem !important;
            line-height: 1.2 !important;
            padding: 0.24rem 0.56rem !important;
            min-height: 25px !important;
            height: auto !important;
        }
        .btn.btn-xs:not(.btn-close),
        .btn.btn-xs.px-3:not(.btn-close),
        .btn-group-xs > .btn,
        table td .btn:not(.btn-action-icon),
        table td .btn-group > .btn:not(.btn-action-icon) {
            font-size: 0.68rem !important;
            line-height: 1.2 !important;
            padding: 0.2rem 0.48rem !important;
            min-height: 22px !important;
            height: auto !important;
        }
        .btn.btn-action-icon,
        table td .btn.btn-action-icon {
            width: 26px !important;
            height: 26px !important;
            min-width: 26px !important;
            min-height: 26px !important;
            padding: 0 !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 0.72rem !important;
        }
        .btn:not(.btn-close):not(.sidebar-toggle):not(.nav-center-bump-action):not(.btn-notif-mobile):not(.btn-back-responsive) i,
        .btn:not(.btn-close):not(.sidebar-toggle):not(.nav-center-bump-action):not(.btn-notif-mobile):not(.btn-back-responsive) .fas,
        .btn:not(.btn-close):not(.sidebar-toggle):not(.nav-center-bump-action):not(.btn-notif-mobile):not(.btn-back-responsive) .far,
        .btn:not(.btn-close):not(.sidebar-toggle):not(.nav-center-bump-action):not(.btn-notif-mobile):not(.btn-back-responsive) .fab,
        .btn:not(.btn-close):not(.sidebar-toggle):not(.nav-center-bump-action):not(.btn-notif-mobile):not(.btn-back-responsive) .bi {
            font-size: 0.74rem !important;
            line-height: 1 !important;
            vertical-align: -0.05em !important;
        }
        .btn.btn-sm i,
        .btn.btn-xs i,
        table td .btn i {
            font-size: 0.68rem !important;
        }
        .btn:not(.btn-close):not(.sidebar-toggle):not(.nav-center-bump-action) svg,
        .btn:not(.btn-close):not(.sidebar-toggle):not(.nav-center-bump-action) .icon-20,
        .btn:not(.btn-close):not(.sidebar-toggle):not(.nav-center-bump-action) .icon-18 {
            width: 13px !important;
            height: 13px !important;
            vertical-align: -0.12em !important;
        }
        .btn:not(.btn-close):not(.sidebar-toggle):not(.nav-center-bump-action) iconify-icon {
            font-size: 0.82rem !important;
            vertical-align: -0.12em !important;
        }
        .swal2-popup .swal2-actions .swal2-styled {
            font-size: 0.75rem !important;
            padding: 0.32rem 0.8rem !important;
            min-height: 28px !important;
            border-radius: 8px !important;
        }
        .dataTables_wrapper .dt-buttons .btn {
            font-size: 0.69rem !important;
            padding: 0.2rem 0.5rem !important;
            min-height: 24px !important;
        }
        .input-group > .btn {
            font-size: 0.73rem !important;
            padding: 0.26rem 0.55rem !important;
        }
    }
    </style>

</head>

<script>
    var base_url = '<?= rtrim(base_url(), '/') . '/' ?>';
    var globalToken = window.globalToken || null;
    var adaJadwalUjian = window.adaJadwalUjian || null;
</script>
<!-- Token auto-generator script hanya dimuat di panel admin/proktor, tidak di halaman siswa -->
<script type="text/javascript">
    let tp_active_val = '<?= isset($tp_active) ? $tp_active->tahun : '' ?>';
    let smt_active_val = '<?= isset($smt_active) ? $smt_active->smt : '' ?>';
    let id_tp_active = '<?= isset($tp_active) ? $tp_active->id_tp : '' ?>';
    let id_smt_active = '<?= isset($smt_active) ? $smt_active->id_smt : '' ?>';

    function startTime() {
        var today = new Date();
        var h = today.getHours(), m = today.getMinutes(), s = today.getSeconds();
        m = checkTime(m); s = checkTime(s);
        $('#live-clock').html('<span class="text-lg">' + h + ':' + m + '</span>:' + s);
        setTimeout(startTime, 1000);
    }
    function checkTime(i) { if (i < 10) { i = "0" + i; } return i; }

    function buat_tanggal_indonesia(str) {
        var map = {"Jan":"Januari","Feb":"Februari","Mar":"Maret","Apr":"April","May":"Mei","Jun":"Juni",
            "Jul":"Juli","Aug":"Agustus","Sep":"September","Oct":"Oktober","Nov":"Nopember","Dec":"Desember",
            "Mon":"Senin","Tue":"Selasa","Wed":"Rabu","Thu":"Kamis","Fri":"Jumat","Sat":"Sabtu","Sun":"Minggu"};
        return str.replace(/Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec|Mon|Tue|Wed|Thu|Fri|Sat|Sun/g, function(m){return map[m]||m;});
    }
    function sanitizeJSON(unsanitized) {
        return unsanitized.replace(/\\/g, "\\\\").replace(/\n/g, "\\n").replace(/\r/g, "\\r")
            .replace(/\t/g, "\\t").replace(/\f/g, "\\f").replace(/"/g, "\\\"")
            .replace(/'/g, "\\'").replace(/\&/g, "\\&");
    }
    var bulans = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    var arrhari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu'];
    function stringToDate(dateStr) { var p = dateStr.split("-"); return new Date(p[0], p[1]-1, p[2]); }
    function dateToString(date) {
        return date.getDate().toString().padStart(2,'0') + ' ' + bulans[date.getMonth()] + ' ' + date.getFullYear();
    }
    function dateToStringDay(date) {
        return arrhari[date.getDay()] + ', ' + date.getDate().toString().padStart(2,'0') + ' ' + bulans[date.getMonth()] + ' ' + date.getFullYear();
    }
</script>

<body class="layout-fixed bg-body-tertiary text-sm" onload="startTime()">
<?php
$tp_skrg = get_tp_sekarang();
$smt_skrg = get_smt_sekarang();
if (isset($tp_active) && isset($smt_active)) {
    if ($tp_skrg != $tp_active->tahun || $smt_skrg != $smt_active->id_smt): ?>
    <div class="alert alert-danger alert-dismissible fade show fixed-top shadow-sm text-center mb-0 rounded-0" role="alert" style="z-index:1050;">
        <strong>Perhatian!</strong> Tahun ajaran telah berganti ke <?= esc($tp_skrg) ?>, Semester <?= esc($smt_skrg) ?>.
        <a href="<?= base_url('datatahun')?>" class="alert-link">Atur Tahun Pelajaran dan Semester</a>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <?php endif;
}
?>

    <!-- Main Content -->
    <main class="main-content d-flex flex-column" style="min-height: 100vh;">
    <!-- Sidebar -->
    <?php
    $role = session()->get('role');
    if ($role == '1' || empty($role)) {
        echo $this->include('layout/sidebar_bs5');
    } elseif ($role == '2') {
        echo $this->include('members/guru/templates/navbar');
    } elseif ($role == '3') {
        echo $this->include('members/siswa/templates/navbar');
    }
    ?>
    <div class="container-fluid content-inner mt-n5 py-0 flex-grow-1">
        <div class="row">
            <div class="col-sm-12">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

<?php
    $uri = \Config\Services::request()->getUri();
    $seg1 = $uri->getTotalSegments() > 0 ? $uri->getSegment(1) : '';
    $seg2 = $uri->getTotalSegments() > 1 ? $uri->getSegment(2) : '';
    // Mode Ujian Berlangsung / Konfirmasi Ujian:
    $is_cbt_exam_mode = ($seg1 === 'cbtsiswa' && ($seg2 === 'konfirmasi' || $seg2 === 'penilaian' || $seg2 === 'ujian'));
    ?>

    <?php if ($is_cbt_exam_mode && isset($running_text) && count($running_text) > 0): ?>
    <!-- Fixed Running Text Bar: HANYA TAMPIL SAAT UJIAN BERLANGSUNG / KONFIRMASI UJIAN (FULL SCREEN EXAM) -->
    <div id="running-text-bar" style="position: fixed; bottom: 0; left: 0; right: 0; z-index: 1050; background: linear-gradient(90deg, #0d6efd 0%, #0a58ca 100%); color: #ffffff; padding: 7px 16px; box-shadow: 0 -3px 12px rgba(0,0,0,0.18); display: flex; align-items: center; font-size: 0.95rem; font-weight: 500;">
        <div class="d-flex align-items-center text-warning fw-bold me-3 text-nowrap" style="letter-spacing: 0.5px;">
            <i class="fas fa-bullhorn me-1"></i> <span class="d-none d-sm-inline">PENGUMUMAN:</span>
        </div>
        <div id="running-text-siswa" class="marquee flex-grow-1" style="overflow: hidden; white-space: nowrap;"></div>
    </div>
    <style>
        /* Cegah Pergeseran Halaman / Scrollbar Jump Saat Buka Modal */
        html {
            overflow-y: scroll !important;
            scrollbar-gutter: stable;
        }
        body,
        body.modal-open,
        .main-content,
        .sidebar,
        header,
        .navbar,
        .fixed-top,
        .fixed-bottom {
            padding-right: 0 !important;
            margin-right: 0 !important;
        }
        body.modal-open {
            overflow-y: scroll !important;
        }
        .modal {
            padding-right: 0 !important;
            padding-left: 0 !important;
            overflow-y: auto !important;
        }

        /* Sembunyikan default media controls / play button pada video scanner */
        video::-webkit-media-controls,
        video::-webkit-media-controls-start-playback-button,
        video::-webkit-media-controls-play-button,
        video::-webkit-media-controls-overlay-play-button,
        video::-webkit-media-controls-enclosure,
        video::-webkit-media-controls-panel {
            display: none !important;
            -webkit-appearance: none !important;
            opacity: 0 !important;
            pointer-events: none !important;
        }

        /* Hilangkan Latar Belakang Hitam / Backdrop Modal & SweetAlert */
        .modal-backdrop,
        .modal-backdrop.show,
        .modal-backdrop.fade {
            display: none !important;
            background: transparent !important;
            opacity: 0 !important;
            pointer-events: none !important;
        }
        .modal {
            background: transparent !important;
        }
        .modal-dialog {
            z-index: 1060 !important;
        }
        .modal-content {
            box-shadow: 0 20px 50px -10px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(0, 0, 0, 0.08) !important;
            border-radius: 12px !important;
            border: none !important;
        }
        .swal2-container.swal2-backdrop-show, .swal2-container.swal2-noanimation {
            background: rgba(0, 0, 0, 0.15) !important;
        }

        body { padding-bottom: 42px !important; }
        @keyframes fallbackMarquee {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
        .marquee-fallback {
            display: inline-block;
            white-space: nowrap;
            animation: fallbackMarquee 25s linear infinite;
        }
        .marquee-fallback:hover {
            animation-play-state: paused;
        }
    </style>
    <?php endif; ?>

    <footer class="footer mt-auto d-none d-lg-block" style="background-color: var(--bs-body-bg, #fff); z-index: 99;">
        <div class="footer-body d-flex justify-content-between align-items-center w-100">
            <ul class="left-panel list-inline mb-0 p-0"></ul>
            <div class="right-panel">Copyright &copy; NextGenEdu <?= date('Y') ?> Versi 2.2</div>
        </div>
    </footer>
</main>

<!-- Hope UI JS Bundle -->
<script src="<?= base_url() ?>/assets/hopeui/js/core/libs.min.js"></script>
<script src="<?= base_url() ?>/assets/hopeui/js/core/external.min.js"></script>
<script src="<?= base_url() ?>/assets/hopeui/js/hope-ui.js" defer></script>

<!-- DataTables -->
<script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };
    </script>
    <!-- Charts & misc -->
    <script src="<?= base_url() ?>/assets/plugins/sparklines/sparkline.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/chart.js/Chart.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/chart.js/chartjs-plugin-labels.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/moment/moment.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/moment/moment-with-locales.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="<?= base_url() ?>/assets/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/summernote/plugin/audio/summernote-audio.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/summernote/plugin/file/summernote-file.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/summernote/plugin/gallery/dist/summernote-gallery.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/summernote/plugin/math/summernote-math.js"></script>
    <!-- Other plugins -->
    <script src="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.min.js?v=20261115"></script>
    <script src="<?= base_url() ?>/assets/plugins/toastr/toastr.min.js"></script>
    <script src="<?= base_url() ?>/assets/app/js/jquery.toast.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/jquery-datetimepicker/jquery.datetimepicker.full.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/multiselect/js/jquery.multi-select.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>/assets/plugins/multiselect/js/jquery.quicksearch.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/dropify/js/dropify.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

    <script>
        if (typeof $.widget !== 'undefined' && typeof $.ui !== 'undefined' && typeof $.ui.button !== 'undefined') {
            $.widget.bridge('uibutton', $.ui.button);
        }

        // Polyfill for $.fn.modal in Bootstrap 5
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof $ !== 'undefined' && typeof $.fn.modal === 'undefined') {
                $.fn.modal = function(action) {
                    return this.each(function() {
                        if (typeof bootstrap !== 'undefined') {
                            var modal = bootstrap.Modal.getInstance(this) || new bootstrap.Modal(this);
                            if (action === 'show') {
                                modal.show();
                            } else if (action === 'hide') {
                                modal.hide();
                            } else if (action === 'toggle') {
                                modal.toggle();
                            } else if (action === 'dispose') {
                                modal.dispose();
                            }
                        }
                    });
                };
            }
        });
    </script>

    <!-- App JS -->
    <script src="<?= base_url() ?>/assets/app/js/show.toast.js"></script>
    <script src="<?= base_url() ?>/assets/app/js/jquery-thumbnail-cut.js"></script>

    <!-- Custom JS -->
    <script type="text/javascript">
        // fnPagingInfo is already added above, but we can keep it here just in case, or leave it where it is.
        // Actually, I added fnPagingInfo earlier on line 196.

        function ajaxcsrf() {
            var csrfname = '<?= csrf_token() ?>';
            var csrfhash = '<?= csrf_hash() ?>';
            var csrf = {};
            csrf[csrfname] = csrfhash;
            $.ajaxSetup({
                "data": csrf
            });
        }

        function reload_ajax() {
            if (typeof table !== 'undefined') table.ajax.reload();
        }

        function logout(e) {
            if (e && typeof e.preventDefault === 'function') e.preventDefault();
            swal.fire({
                title: "Logout",
                text: "Anda yakin ingin logout?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Logout!'
            }).then((result) => {
                if (result.value || result.isConfirmed) {
                    location.href = base_url + "auth/logout";
                }
            });
        }
    </script>

    <?= $this->renderSection('scripts') ?>
<!-- Role-specific dashboard JS -->
    <?php
    $role = session()->get('role');
    if ($role == '1' || empty($role)) { ?>
    <script src="<?= base_url('assets/app/js/dashboard.js?v=' . time()) ?>"></script>
    <?php } elseif ($role == '2') { ?>
    <script src="<?= base_url('assets/app/js/dashboard_guru.js?v=' . time()) ?>"></script>
    <?php } elseif ($role == '6') { ?>
    <script src="<?= base_url('assets/app/js/dashboard_siswa.js?v=' . time()) ?>"></script>
    <?php } ?>

    <!-- Global logout function (available for all roles) -->
    <script>
        if (typeof logout === 'undefined') {
            function logout() {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Logout',
                        text: 'Anda yakin ingin logout?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Logout!',
                        cancelButtonText: 'Batal'
                    }).then(function(result) {
                        if (result.value || result.isConfirmed) {
                            window.location.href = base_url + 'auth/logout';
                        }
                    });
                } else {
                    if (confirm('Anda yakin ingin logout?')) {
                        window.location.href = base_url + 'auth/logout';
                    }
                }
            }
        }
    </script>

    <script src="<?= base_url() ?>/assets/app/js/jquery.marquee.min.js"></script>

<script src="<?= base_url() ?>/assets/app/js/weather-widget.js"></script>
<script src="<?= base_url() ?>/assets/app/js/cetak-area.js"></script>
<script>
$(document).ready(function() {
<?php if (isset($running_text) && count($running_text) > 0): ?>
    try {
        var runningTextData = <?= json_encode($running_text, JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
        var validItems = [];
        if (Array.isArray(runningTextData)) {
            $.each(runningTextData, function (i, v) {
                if (v && v.text && $.trim(v.text) !== '') {
                    validItems.push('<span class="mx-3">' + $('<div>').text(v.text).html() + '</span>');
                }
            });
        }
        if (validItems.length > 0) {
            var fullHtml = validItems.join(' <span style="color: #ffc107;">&bull;</span> ');
            $('#running-text-siswa').html(fullHtml);
            
            if (typeof $.fn.marquee === 'function') {
                $('#running-text-siswa').marquee({
                    duration: 16000,
                    gap: 50,
                    delayBeforeStart: 500,
                    direction: 'left',
                    duplicated: true,
                    pauseOnHover: true
                });
            } else {
                $('#running-text-siswa').addClass('marquee-fallback');
            }
        } else {
            $('#running-text-bar').hide();
            $('body').css('padding-bottom', '0');
        }
    } catch(err) {
        console.error('Marquee initialization error:', err);
    }
<?php endif; ?>
});

document.addEventListener('DOMContentLoaded', function() {
    var skipEls = document.querySelectorAll('.skip-link, [href="#content"], [href="#main"]');
    for (var i = 0; i < skipEls.length; i++) {
        skipEls[i].style.display = 'none';
    }
});

// Sidebar Submenu Accordion Toggle
$(document).on('click', '.sidebar .nav-link[data-sidebar-toggle="collapse"], .sidebar .nav-link[data-bs-toggle="collapse"], .sidebar .nav-link[data-toggle="collapse"]', function(e) {
    e.preventDefault();
    e.stopPropagation();

    var $toggle = $(this);
    var targetSelector = $toggle.attr('data-bs-target') || $toggle.attr('href');
    if (!targetSelector || targetSelector === '#' || !targetSelector.startsWith('#')) return;

    var $target = $(targetSelector);
    if (!$target.length) return;

    var isShown = $target.hasClass('show') || $target.is(':visible');

    if (isShown) {
        $target.stop(true, true).slideUp(200, function() {
            $target.removeClass('show').css('display', '');
        });
        $toggle.addClass('collapsed').attr('aria-expanded', 'false');
    } else {
        var $container = $toggle.closest('#sidebar-menu, .sidebar-list, .sidebar');
        var $otherSubNavs = $container.find('.sub-nav.show, .sub-nav:visible').not($target);
        if ($otherSubNavs.length) {
            $otherSubNavs.stop(true, true).slideUp(200, function() {
                $(this).removeClass('show').css('display', '');
            });
            $container.find('.nav-link[data-sidebar-toggle="collapse"], .nav-link[data-bs-toggle="collapse"], .nav-link[data-toggle="collapse"]')
                .not($toggle)
                .addClass('collapsed')
                .attr('aria-expanded', 'false');
        }

        $target.stop(true, true).hide().addClass('show').slideDown(200, function() {
            $target.css('display', '');
        });
        $toggle.removeClass('collapsed').attr('aria-expanded', 'true');
    }
});
</script>

<script>
// Cegah layar gerak / shift ke kanan saat buka modal
(function() {
    function lockZeroPadding() {
        if (document.body && document.body.style.paddingRight !== "0px") {
            document.body.style.paddingRight = "0px";
        }
    }
    if (typeof $ !== "undefined") {
        $(document).on("show.bs.modal shown.bs.modal hide.bs.modal hidden.bs.modal", function() {
            lockZeroPadding();
        });
    }
})();
</script>

<?php if (!$is_cbt_exam_mode): ?>
<!-- Mobile Bottom Navigation (ShopeePay Style) for Siswa (Hanya tampil di luar ujian) -->
<?= $this->include('members/siswa/templates/bottom_nav') ?>
<?php endif; ?>

</body>
</html>
