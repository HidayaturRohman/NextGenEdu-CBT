<!DOCTYPE html>
<html>

<head>

    <!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= isset($judul) ? esc($judul) : 'Aplikasi Ujian CBT & E-Learning' ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php 
    if (!isset($setting) || empty($setting)) {
        try {
            $setting = (new \App\Models\DashboardModel())->getSetting();
        } catch (\Throwable $e) {}
    }
    $logo_app = isset($setting) && !empty($setting->logo_kiri) ? base_url($setting->logo_kiri) : base_url('assets/img/favicon.png'); 
    ?>
    <link rel="shortcut icon" href="<?= $logo_app ?>" type="image/x-icon">

    <!-- Required CSS -->
    <!-- v3 -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/fontawesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/v4-shims.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/Ionicons/css/ionicons.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/jqvmap/jqvmap.min.css">
    <!-- multi select -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/multiselect/css/multi-select.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Datetime picker -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/jquery-datetimepicker/jquery.datetimepicker.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Select2 -->
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

    <!-- fonts -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/adminlte/dist/css/poppins.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/adminlte/dist/css/calibri.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/app/css/show.toast.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/adminlte/dist/css/adminlte.min.css">

    <!-- textarea editor -->
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/summernote/plugin/audio/summernote-audio.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/katex/katex.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/app/css/mystyle.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/DualSelectList/css/bala.DualSelectList.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/app/css/weekCalendar.css">

    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/bootstrap-icon/bootstrap-icons.css">

    <link href="<?= base_url() ?>/assets/plugins/ios-switch/component-custom-switch.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/app/css/player.css" rel="stylesheet">

    <style>
        /* Kunci Tampilan PC di Zoom 80% */
        @media (min-width: 992px) {
            html:not(.flipbook-active) { zoom: 80% !important; }
        }
        @media (max-width: 991.98px) {
            html:not(.flipbook-active) { zoom: 100% !important; }
        }
        @media print {
            html, body { zoom: 100% !important; }
        }
    </style>

    <!-- jQuery -->
    <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url() ?>/assets/plugins/jquery-ui/jquery-ui.min.js"></script>

    <script type="text/javascript" src="<?= base_url() ?>/assets/plugins/DualSelectList/js/bala.DualSelectList.jquery.js"></script>

    <script src="<?= base_url() ?>/assets/plugins/katex/katex.min.js"></script>
    <script defer src="<?= base_url() ?>/assets/plugins/katex/contrib/auto-render.min.js" onload="if(typeof renderMathInElement==='function')renderMathInElement(document.body);"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/app/css/stylised.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/contextmenu/jquery.contextmenu.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/plugins/fields-linker/fieldsLinker.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/plugins/pignose/css/pignose.calendar.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/app/css/new-upload.css">

        
    
    <style id="enterprise-ui-styles">
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

                /* Card Header Layout - Align Tools to Right */
        .card-header {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            flex-wrap: wrap !important;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            background-color: #fff;
        }
        .card-header::after, .card-header::before {
            display: none !important;
        }
        .card-header .card-title, .card-header h3, .card-header h6 {
            margin-bottom: 0 !important;
            font-weight: 600;
        }
        .card-header .card-tools {
            display: flex;
            align-items: center;
            gap: 12px; /* Increased gap */
        }
        /* Standardized Box Sizes for Card Tools */
        .card-header .card-tools .btn {
            margin: 0 !important; 
            padding: 8px 16px !important;
            font-size: 0.9rem !important;
            height: 38px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            border-radius: 6px !important;
            font-weight: 600 !important;
            letter-spacing: 0.3px;
        }

        /* Solid Colors for More Striking Look */
        .btn-warning, .bg-gradient-warning, .table td .btn-warning {
            background-color: #f16a1b !important;
            color: #fff !important;
            border: none !important;
            box-shadow: 0 4px 10px rgba(241, 106, 27, 0.3) !important;
        }
        .btn-warning:hover, .bg-gradient-warning:hover, .table td .btn-warning:hover {
            background-color: #d15610 !important;
        }
        
        .btn-danger, .bg-gradient-danger, .table td .btn-danger {
            background-color: #ea3a3d !important;
            color: #fff !important;
            border: none !important;
            box-shadow: 0 4px 10px rgba(234, 58, 61, 0.3) !important;
        }
        .btn-danger:hover, .bg-gradient-danger:hover, .table td .btn-danger:hover {
            background-color: #c92c2f !important;
        }
        
        .btn-primary, .bg-gradient-primary, .table td .btn-primary {
            background-color: #3a57e8 !important;
            color: #fff !important;
            border: none !important;
            box-shadow: 0 4px 10px rgba(58, 87, 232, 0.3) !important;
        }
        .btn-primary:hover, .bg-gradient-primary:hover, .table td .btn-primary:hover {
            background-color: #2b42b6 !important;
        }
        
        .btn-info, .bg-gradient-info, .table td .btn-info {
            background-color: #088295 !important;
            color: #fff !important;
            border: none !important;
            box-shadow: 0 4px 10px rgba(8, 130, 149, 0.3) !important;
        }
        .btn-info:hover, .bg-gradient-info:hover, .table td .btn-info:hover {
            background-color: #066675 !important;
        }

        .btn-success, .bg-gradient-success, .table td .btn-success {
            background-color: #1aa053 !important;
            color: #fff !important;
            border: none !important;
            box-shadow: 0 4px 10px rgba(26, 160, 83, 0.3) !important;
        }
        .btn-success:hover, .bg-gradient-success:hover, .table td .btn-success:hover {
            background-color: #13793e !important;
        }
        
        .btn-default, .table td .btn-default {
            background-color: #8A92A6 !important;
            color: #fff !important;
            border: none !important;
            box-shadow: 0 4px 10px rgba(138, 146, 166, 0.3) !important;
        }
        .btn-default:hover, .table td .btn-default:hover {
            background-color: #6a7183 !important;
        }
        /* Generic Table Button Styling (Status Badges etc) */
        .table td .btn:not(.btn-action-icon) {
            border-radius: 6px !important;
            padding: 0.4rem 0.8rem !important;
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            gap: 6px;
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
        .btn .text-white {
            color: inherit !important;
        }
    </style>
<style>
        page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: none;
        }

        page[size="A4"][layout="potrait"] {
            width: 21cm;
            height: 29.7cm;
        }

        page[size="A4"] {
            width: 29.7cm;
            height: 21cm;
        }

        .linker-list p {
            margin-bottom: .5rem;
            margin-top: .5rem;
        }
    
        /* Striking Table Design (Corporate Enterprise) */
        .table-responsive {
            /* Removed wrapper box styles so label is not enclosed in an extra box */
        }
        
        .table {
            margin-bottom: 0 !important;
        }
        
        /* Table Header */
        .table thead th {
            background-color: #3a57e8 !important; /* Striking Primary Blue */
            color: #ffffff !important;
            font-weight: 700 !important;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 12px 15px !important;
            border-bottom: none !important;
            border-top: none !important;
            vertical-align: middle;
            text-align: center;
        }
        
        /* Table Body */
        .table tbody td {
            padding: 12px 15px !important;
            vertical-align: middle;
            color: #4a5568;
            border-bottom: 1px solid #ebedf2;
        }
        
        /* Table Hover & Striped Effects */
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(58, 87, 232, 0.02) !important;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(58, 87, 232, 0.08) !important;
            transition: background-color 0.2s ease;
        }
        
        /* Borders */
        .table-bordered th, .table-bordered td {
            border: 1px solid #ebedf2 !important;
        }
        .table-bordered thead th, .table-bordered thead td {
            border-bottom-width: 0 !important;
            border-color: rgba(255,255,255,0.1) !important;
        }
        
        /* DataTables specific fixes */
        .dataTables_wrapper .row {
            margin-bottom: 10px;
        }
</style>
    
    <!-- Iconify for 3D Emojis and Modern Icons Replacer -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= base_url() ?>/assets/app/js/modern_icons.js"></script>
</head>
<script>
    var base_url = '<?= rtrim(base_url(), '/') . '/' ?>';
    var globalToken = window.globalToken || null;
    var adaJadwalUjian = window.adaJadwalUjian || null;
</script>
<script src="<?= base_url() ?>/assets/app/js/generate.js"></script>
<script type="text/javascript">
    let tp_active = '<?= isset($tp_active) ? $tp_active->tahun : '' ?>';
    let smt_active = '<?= isset($smt_active) ? $smt_active->smt : '' ?>';
    let id_tp_active = '<?= isset($tp_active) ? $tp_active->id_tp : '' ?>';
    let id_smt_active = '<?= isset($smt_active) ? $smt_active->id_smt : '' ?>';

    function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);

        $('#live-clock').html('<span class="text-lg">' + h + ':' + m + '</span>:' + s);
        setTimeout(startTime, 1000);
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i
        }
        return i;
    }

    function buat_tanggal_indonesia(str) {
        str = str.replace("Jan", "Januari");
        str = str.replace("Feb", "Februari");
        str = str.replace("Mar", "Maret");
        str = str.replace("Apr", "April");
        str = str.replace("May", "Mei");
        str = str.replace("Jun", "Juni");
        str = str.replace("Jul", "Juli");
        str = str.replace("Aug", "Agustus");
        str = str.replace("Sep", "September");
        str = str.replace("Oct", "Oktober");
        str = str.replace("Nov", "Nopember");
        str = str.replace("Dec", "Desember");
        str = str.replace("Mon", "Senin");
        str = str.replace("Tue", "Selasa");
        str = str.replace("Wed", "Rabu");
        str = str.replace("Thu", "Kamis");
        str = str.replace("Fri", "Jumat");
        str = str.replace("Sat", "Sabtu");
        str = str.replace("Sun", "Minggu");
        return str;
    }

    function sanitizeJSON(unsanitized) {
        return unsanitized.replace(/\\/g, "\\\\").replace(/\n/g, "\\n").replace(/\r/g, "\\r").replace(/\t/g, "\\t").replace(/\f/g, "\\f").replace(/"/g, "\\\"").replace(/'/g, "\\\'").replace(/\&/g, "\\&");
    }

    var bulans = ['Januari', 'Februari', 'Maret', 'April',
        'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    var arrhari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu'];

    function stringToDate(dateStr) {
        var parts = dateStr.split("-");
        return new Date(parts[0], parts[1] - 1, parts[2])
    }

    function dateToString(date) {
        let year = date.getFullYear();
        const month = date.getMonth();
        let day = date.getDate().toString().padStart(2, '0');
        return day + ' ' + bulans[month] + ' ' + year;
    }

    function dateToStringDay(date) {
        let year = date.getFullYear();
        const month = date.getMonth();
        let day = date.getDate().toString().padStart(2, '0');
        return arrhari[date.getDay()] + ', ' + day + ' ' + bulans[month] + ' ' + year;
    }
</script>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed text-sm" onload="startTime()">
<?php
$tp_skrg = get_tp_sekarang();
$smt_skrg = get_smt_sekarang();
if (isset($tp_active) && isset($smt_active)) {
    if ($tp_skrg != $tp_active->tahun || $smt_skrg != $smt_active->id_smt): ?>
    <div class="alert alert-danger alert-dismissible fade show fixed-top shadow-sm text-center mb-0 rounded-0" role="alert" style="z-index: 1050;">
        <strong>Perhatian!</strong> Tahun ajaran telah berganti ke <?= esc($tp_skrg) ?>, Semester <?= esc($smt_skrg) ?>.
        <a href="<?= base_url('datatahun')?>" class="alert-link">Atur Tahun Pelajaran dan Semester</a>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <?php endif; 
}
?>
<div class="wrapper">

    
    <!-- Navbar & Sidebar -->
    <?php
    $role = session()->get('role');
    if ($role == '1' || empty($role)) {
        echo $this->include('layout/navbar');
        echo $this->include('layout/sidebar');
    
    } elseif ($role == '2') {
        echo $this->include('members/guru/templates/navbar');
        echo $this->include('members/guru/templates/sidebar');
    } elseif ($role == '3') {
        echo $this->include('members/siswa/templates/navbar');
        // echo $this->include('members/siswa/templates/sidebar');
    }
    ?>

    
    <!-- Main Content -->
    <?= $this->renderSection('content') ?>

</div>
<!-- /.wrapper -->

<!-- Main Footer -->
<footer class="main-footer">
    <div class="float-end d-none d-sm-inline-block">
        <strong>Copyright &copy; NextGenEdu <?= date('Y') ?> Versi 2.2</strong>
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Required JS -->
<!-- v3 -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- DataTables -->
<script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- Datatables Buttons -->
<script src="<?= base_url() ?>/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url() ?>/assets/plugins/sparklines/sparkline.js"></script>

<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url() ?>/assets/plugins/chart.js/Chart.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/chart.js/chartjs-plugin-labels.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url() ?>/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- moment -->
<script src="<?= base_url() ?>/assets/plugins/moment/moment.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/moment/moment-with-locales.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url() ?>/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url() ?>/assets/plugins/summernote/summernote-bs4.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/summernote/plugin/audio/summernote-audio.js"></script>
<script src="<?= base_url() ?>/assets/plugins/summernote/plugin/file/summernote-file.js"></script>
<script src="<?= base_url() ?>/assets/plugins/summernote/plugin/gallery/dist/summernote-gallery.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/summernote/plugin/math/summernote-math.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url() ?>/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url() ?>/assets/plugins/toastr/toastr.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url() ?>/assets/plugins/select2/js/select2.full.min.js"></script>
<!-- multi select -->
<script src="<?= base_url() ?>/assets/plugins/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="<?= base_url() ?>/assets/plugins/multiselect/js/jquery.quicksearch.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?= base_url() ?>/assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="<?= base_url() ?>/assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>

<!-- Bootstrap Switch -->
<script src="<?= base_url() ?>/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/dropify/js/dropify.min.js"></script>
<script src="<?= base_url() ?>/assets/app/js/jquery.toast.min.js"></script>

<script src="<?= base_url() ?>/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<!-- AdminLTE App -->
<script src="<?= base_url() ?>/assets/adminlte/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url() ?>/assets/adminlte/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>/assets/adminlte/dist/js/demo.js"></script>
<!-- /v3 -->
<!-- datetimepicker -->
<script src="<?= base_url() ?>/assets/plugins/jquery-datetimepicker/jquery.datetimepicker.full.js"></script>
<!-- TimeAgo -->
<script src="<?= base_url() ?>/assets/plugins/jquery-timeago/jquery.timeago.js" type="text/javascript"></script>
<!-- App JS -->
<script src="<?= base_url() ?>/assets/app/js/show.toast.js"></script>

<script src="<?= base_url() ?>/assets/app/js/jquery-thumbnail-cut.js"></script>

<!-- Custom JS -->
<script type="text/javascript">
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

    function logout() {
        swal.fire({
            title: "Logout",
            text: "Anda yakin ingin logout?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Logout!'
        }).then((result) => {
            if (result.value) {
                location.href = base_url + "auth/logout";
            }
        });
    }

</script>

<?= $this->renderSection('scripts') ?>

<!-- Iconify for 3D Emojis and Modern Icons Replacer -->
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<!-- Stabilize UI & Typography (Rock-solid, non-destructive) -->
<script>
$(document).ready(function() {
    function applyGlobalTypography() {
        // 1. Upgrade all Card Titles
        $('.card-header .card-title').each(function() {
            var $title = $(this);
            if ($title.find('iconify-icon, svg, i').length === 0) {
                $title.addClass('d-flex align-items-center');
                $title.prepend('<iconify-icon icon="lucide:layout-list" class="me-2 text-primary" style="font-size: 1.3rem;"></iconify-icon>');
                $title.css({'font-size': '1.25rem', 'font-weight': '700', 'color': '#232D42'});
            }
        });

        // 2. Upgrade all plain Labels in Content
        $('.card-body label').each(function() {
            var $label = $(this);
            if ($label.closest('.modal').length > 0 || $label.closest('.form-group').length > 0 || $label.hasClass('form-check-label') || $label.hasClass('form-label')) {
                return;
            }
            if (!$label.attr('class') && $label.children().length === 0) {
                var text = $label.text().trim();
                if (text.length > 0 && text.length < 40) {
                    $label.addClass('d-flex align-items-center mb-3 mt-2');
                    $label.css({'font-size': '1.1rem', 'font-weight': '700', 'color': '#3a57e8'});
                    
                    var icon = 'lucide:layout-grid';
                    var lower = text.toLowerCase();
                    if (lower.includes('tahun') || lower.includes('tanggal') || lower.includes('jadwal') || lower.includes('waktu')) icon = 'lucide:calendar-days';
                    else if (lower.includes('semester') || lower.includes('kelas') || lower.includes('tingkat') || lower.includes('sesi')) icon = 'lucide:layers';
                    else if (lower.includes('mapel') || lower.includes('pelajaran') || lower.includes('materi')) icon = 'lucide:book-open';
                    else if (lower.includes('siswa') || lower.includes('guru') || lower.includes('user') || lower.includes('peserta') || lower.includes('pengawas')) icon = 'lucide:users';
                    else if (lower.includes('jurusan') || lower.includes('rombel')) icon = 'lucide:library';
                    else if (lower.includes('nilai') || lower.includes('rapor') || lower.includes('predikat')) icon = 'lucide:award';
                    else if (lower.includes('ujian') || lower.includes('soal') || lower.includes('tugas') || lower.includes('bank')) icon = 'lucide:file-text';
                    else if (lower.includes('status') || lower.includes('aktif')) icon = 'lucide:activity';
                    else if (lower.includes('pengaturan') || lower.includes('setting')) icon = 'lucide:settings';
                    else if (lower.includes('kode') || lower.includes('token') || lower.includes('password')) icon = 'lucide:key';
                    else if (lower.includes('durasi') || lower.includes('menit') || lower.includes('jam')) icon = 'lucide:clock';
                    
                    $label.prepend('<iconify-icon icon="' + icon + '" class="me-2" style="font-size: 1.2rem;"></iconify-icon>');
                }
            }
        });

        // 3. Mark Action Buttons in Tables to become squircles
        $('.table td .btn, td .btn').each(function() {
            var $btn = $(this);
            var text = $btn.text().trim().toLowerCase();
            var isAction = (text === 'edit' || text === 'hapus' || text === 'ubah' || text === 'delete' || text === 'lihat' || text === 'detail' || text === 'download' || text === 'unduh' || $btn.hasClass('btn-edit') || $btn.hasClass('btn-hapus'));
            if ((isAction || text === '') && $btn.find('i, iconify-icon, svg').length > 0) {
                $btn.addClass('btn-action-icon');
            }
        });
    }

    applyGlobalTypography();

    // Hook DataTables draw event
    $(document).on('draw.dt', function(e, settings) {
        $('.table td .btn, td .btn').each(function() {
            var $btn = $(this);
            var text = $btn.text().trim().toLowerCase();
            var isAction = (text === 'edit' || text === 'hapus' || text === 'ubah' || text === 'delete' || text === 'lihat' || text === 'detail' || text === 'download' || text === 'unduh' || $btn.hasClass('btn-edit') || $btn.hasClass('btn-hapus'));
            if ((isAction || text === '') && $btn.find('i, iconify-icon, svg').length > 0) {
                $btn.addClass('btn-action-icon');
            }
        });
    });
});
</script>
</body>

</html>


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
    document.addEventListener("DOMContentLoaded", function() {
        var obs = new MutationObserver(function() {
            lockZeroPadding();
        });
        obs.observe(document.body, { attributes: true, attributeFilter: ["style"] });
    });
})();
</script>
