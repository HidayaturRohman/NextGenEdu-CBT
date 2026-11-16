</div>
<!-- /.content-wrapper -->

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

</div>

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
</aside>
<!-- /.control-sidebar -->

</div>

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

    function logout(e) {
        if (e && e.preventDefault) e.preventDefault();
        var logoutUrl = base_url + "auth/logout";
        var sweet = (typeof Swal !== 'undefined') ? Swal : ((typeof swal !== 'undefined') ? swal : null);
        if (sweet && typeof sweet.fire === 'function') {
            sweet.fire({
                title: "Logout",
                text: "Anda yakin ingin logout?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Logout!'
            }).then((result) => {
                if (result.value || result.isConfirmed) {
                    location.href = logoutUrl;
                }
            });
        } else {
            if (confirm("Anda yakin ingin logout?")) {
                location.href = logoutUrl;
            }
        }
        return false;
    }
</script>
<script>
$(document).ready(function() {
        var iconMap = {
        'fa-file': 'file',
        'fa-file-excel': 'bar-chart-2',
        'fa-file-pdf': 'file-text',
        'fa-file-pdf-o': 'file-text',
        'fa-file-word': 'file-text',
        'fa-file-word-o': 'file-text',
        'fa-tasks': 'list-todo',
        'fa-book': 'book-open',
        'fa-book-open': 'book-open',
        'fa-edit': 'pencil',
        'fa-pencil': 'pencil',
        'fa-pencil-alt': 'pencil',
        'fa-pencil-square-o': 'pencil',
        'fa-bullhorn': 'megaphone',
        'fa-history': 'history',
        'fa-clock': 'clock',
        'fa-clock-o': 'clock',
        'fa-graduation-cap': 'graduation-cap',
        'fa-chalkboard-teacher': 'presentation',
        'fa-cogs': 'settings',
        'fa-cog': 'settings',
        'fa-gear': 'settings',
        'fa-envelope': 'mail',
        'fa-trash': 'trash-2',
        'fa-trash-alt': 'trash-2',
        'fa-trash-o': 'trash-2',
        'fa-plus': 'plus',
        'fa-plus-circle': 'plus-circle',
        'fa-save': 'save',
        'fa-print': 'printer',
        'fa-download': 'download',
        'fa-upload': 'upload',
        'fa-cloud-upload-alt': 'cloud-upload',
        'fa-eye': 'eye',
        'fa-eye-slash': 'eye-off',
        'fa-sign-out-alt': 'log-out',
        'fa-door-open': 'door-open',
        'fa-flask': 'flask-conical',
        'fa-chess': 'puzzle',
        'fa-chalkboard': 'monitor-play',
        'fa-pencil-ruler': 'pen-tool',
        'fa-drafting-compass': 'compass',
        'fa-user-graduate': 'graduation-cap',
        'fa-project-diagram': 'network',
        'fa-id-card': 'id-card',
        'fa-user-clock': 'user-cog',
        'fa-folder-open': 'folder-open',
        'fa-briefcase': 'briefcase',
        'fa-microscope': 'microscope',
        'fa-clipboard': 'clipboard-list',
        'fa-users-cog': 'users-round',
        'fa-user-tie': 'user-round-tie',
        'fa-university': 'building-2',
        'fa-trophy': 'trophy',
        'fa-sync-alt': 'refresh-cw',
        'fa-sync': 'refresh-cw',
        'fa-refresh': 'refresh-cw',
        'fa-undo': 'undo',
        'fa-rotate-left': 'undo',
        'fa-search': 'search',
        'fa-search-plus': 'zoom-in',
        'fa-search-minus': 'zoom-out',
        'fa-check': 'check',
        'fa-check-circle': 'check-circle',
        'fa-check-double': 'check-check',
        'fa-times': 'x',
        'fa-times-circle': 'x-circle',
        'fa-times-circle-o': 'x-circle',
        'fa-ban': 'ban',
        'fa-warning': 'alert-triangle',
        'fa-exclamation-triangle': 'alert-triangle',
        'fa-info-circle': 'info',
        'fa-question-circle': 'help-circle',
        'fa-chart-pie': 'pie-chart',
        'fa-chart-bar': 'bar-chart',
        'fa-bell': 'bell',
        'fa-bars': 'menu',
        'fa-list': 'list',
        'fa-list-ol': 'list-ordered',
        'fa-list-ul': 'list',
        'fa-th': 'grid',
        'fa-th-large': 'layout-grid',
        'fa-home': 'home',
        'fa-key': 'key',
        'fa-lock': 'lock',
        'fa-unlock': 'unlock',
        'fa-image': 'image',
        'fa-video': 'video',
        'fa-music': 'music',
        'fa-folder': 'folder',
        'fa-folder-open': 'folder-open',
        'fa-database': 'database',
        'fa-server': 'database',
        'fa-globe-americas': 'globe',
        'fa-link': 'link',
        'fa-camera': 'camera',
        'fa-paper-plane': 'send',
        'fa-heart': 'heart',
        'fa-star': 'star',
        'fa-star-half-alt': 'star-half',
        'fa-arrow-left': 'arrow-left',
        'fa-arrow-right': 'arrow-right',
        'fa-arrow-down': 'arrow-down',
        'fa-angle-left': 'chevron-left',
        'fa-arrow-circle-left': 'arrow-left-circle',
        'fa-arrow-circle-right': 'arrow-right-circle',
        'fa-balance-scale-right': 'scale',
        'fa-circle': 'circle',
        'fa-circle-o-notch': 'loader-2',
        'fa-spinner': 'loader-2',
        'fa-comments': 'message-circle',
        'fa-commenting-o': 'message-circle',
        'fa-copy': 'copy',
        'fa-ellipsis-v': 'more-vertical',
        'fa-minus': 'minus',
        'fa-reply': 'reply',
        'fa-school': 'school',
        'fa-scissors': 'scissors',
        'fa-square': 'square',
        'fa-tools': 'wrench',
        'fa-vcard-o': 'id-card',
        'fa-venus-mars': 'users'
    };

    function processIcons(context) {
        // 1. Replace all FontAwesome icons
        $('i.fa, i.fas, i.far, i.fal, i.fab', context).each(function() {
            var $el = $(this);
            var classes = $el.attr('class') ? $el.attr('class').split(' ') : [];
            var newIcon = null;
            var faClass = null;
            
            for (var i = 0; i < classes.length; i++) {
                if (iconMap[classes[i]]) {
                    newIcon = iconMap[classes[i]];
                    faClass = classes[i];
                    break;
                } else if (classes[i].startsWith('fa-') && classes[i] !== 'fa-fw' && classes[i] !== 'fa-sm' && classes[i] !== 'fa-lg' && classes[i] !== 'fa-2x' && classes[i] !== 'fa-spin') {
                    faClass = classes[i];
                }
            }
            
            if (!newIcon && faClass) {
                newIcon = 'chevron-right';
            }
            
            if (newIcon) {
                var iconify = $('<iconify-icon></iconify-icon>');
                iconify.attr('icon', 'lucide:' + newIcon);
                iconify.attr('class', $el.attr('class'));
                if (faClass) {
                    iconify.removeClass('fa fas far fal fab ' + faClass);
                } else {
                    iconify.removeClass('fa fas far fal fab');
                }
                
                if(iconify.hasClass('nav-icon')) {
                    iconify.css({'font-size': '1.3rem', 'margin-right': '0.2rem', 'vertical-align': 'middle'});
                }
                if($el.parent().hasClass('btn')) {
                    iconify.css({'vertical-align': 'middle', 'font-size': '1.2rem'});
                }
                $el.replaceWith(iconify);
            }
        });

        // 2. Auto-inject icons into text-only buttons
        $('.btn', context).each(function() {
            var $btn = $(this);
            // Ignore if button already has an icon
            if ($btn.find('i, iconify-icon, svg').length === 0) {
                var text = $btn.text().trim().toLowerCase();
                var iconToAdd = null;
                
                if (text.includes('aktifkan') || text === 'aktif') {
                    iconToAdd = 'check-mark-button';
                } else if (text.includes('nonaktif')) {
                    iconToAdd = 'cross-mark';
                } else if (text.includes('edit') || text.includes('ubah')) {
                    iconToAdd = 'pencil';
                } else if (text.includes('hapus') || text.includes('delete') || text.includes('clear')) {
                    iconToAdd = 'wastebasket';
                } else if (text.includes('simpan') || text.includes('save')) {
                    iconToAdd = 'floppy-disk';
                } else if (text.includes('tambah') || text.includes('add')) {
                    iconToAdd = 'plus';
                } else if (text.includes('reload') || text.includes('refresh') || text.includes('sync')) {
                    iconToAdd = 'counterclockwise-arrows-button';
                } else if (text.includes('batal') || text.includes('cancel') || text.includes('tutup') || text.includes('close')) {
                    iconToAdd = 'cross-mark';
                } else if (text.includes('lihat') || text.includes('detail') || text.includes('view')) {
                    iconToAdd = 'eyes';
                } else if (text.includes('cetak') || text.includes('print')) {
                    iconToAdd = 'printer';
                } else if (text.includes('download') || text.includes('unduh')) {
                    iconToAdd = 'down-arrow';
                } else if (text.includes('upload') || text.includes('unggah') || text.includes('import')) {
                    iconToAdd = 'up-arrow';
                } else if (text.includes('kirim') || text.includes('send') || text.includes('submit')) {
                    iconToAdd = 'airplane';
                } else if (text.includes('login') || text.includes('masuk')) {
                    iconToAdd = 'door';
                }
                
                if (iconToAdd) {
                    var iconify = $('<iconify-icon icon="lucide:' + iconToAdd + '"></iconify-icon>');
                    iconify.css({'vertical-align': 'middle', 'font-size': '1.2rem', 'margin-right': '0.3rem'});
                    // Only prepend if the button has text
                    if(text.length > 0) {
                        $btn.prepend(iconify);
                    } else {
                        iconify.css({'margin-right': '0'});
                        $btn.append(iconify);
                    }
                }
            }
        });
    }

    // Run once on load
    processIcons(document);

    // Run whenever DOM changes (for AJAX DataTables, modals, etc)
    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.addedNodes && mutation.addedNodes.length > 0) {
    };

    function processIcons(context) {
        // 1. Replace all FontAwesome icons
        $('i.fa, i.fas, i.far, i.fal, i.fab', context).each(function() {
            var $el = $(this);
            var classes = $el.attr('class') ? $el.attr('class').split(' ') : [];
            var newIcon = null;
            var faClass = null;
            
            for (var i = 0; i < classes.length; i++) {
                if (iconMap[classes[i]]) {
                    newIcon = iconMap[classes[i]];
                    faClass = classes[i];
                    break;
                } else if (classes[i].startsWith('fa-') && classes[i] !== 'fa-fw' && classes[i] !== 'fa-sm' && classes[i] !== 'fa-lg' && classes[i] !== 'fa-2x' && classes[i] !== 'fa-spin') {
                    faClass = classes[i];
                }
            }
            
            if (!newIcon && faClass) {
                newIcon = 'chevron-right';
            }
            
            if (newIcon) {
                var iconify = $('<iconify-icon></iconify-icon>');
                iconify.attr('icon', 'lucide:' + newIcon);
                iconify.attr('class', $el.attr('class'));
                if (faClass) {
                    iconify.removeClass('fa fas far fal fab ' + faClass);
                } else {
                    iconify.removeClass('fa fas far fal fab');
                }
                
                if(iconify.hasClass('nav-icon')) {
                    iconify.css({'font-size': '1.3rem', 'margin-right': '0.2rem', 'vertical-align': 'middle'});
                }
                if($el.parent().hasClass('btn')) {
                    iconify.css({'vertical-align': 'middle', 'font-size': '1.2rem'});
                }
                $el.replaceWith(iconify);
            }
        });

        // 2. Auto-inject icons into text-only buttons
        $('.btn', context).each(function() {
            var $btn = $(this);
            // Ignore if button already has an icon
            if ($btn.find('i, iconify-icon, svg').length === 0) {
                var text = $btn.text().trim().toLowerCase();
                var iconToAdd = null;
                
                if (text.includes('aktifkan') || text === 'aktif') {
                    iconToAdd = 'check-mark-button';
                } else if (text.includes('nonaktif')) {
                    iconToAdd = 'cross-mark';
                } else if (text.includes('edit') || text.includes('ubah')) {
                    iconToAdd = 'pencil';
                } else if (text.includes('hapus') || text.includes('delete') || text.includes('clear')) {
                    iconToAdd = 'wastebasket';
                } else if (text.includes('simpan') || text.includes('save')) {
                    iconToAdd = 'floppy-disk';
                } else if (text.includes('tambah') || text.includes('add')) {
                    iconToAdd = 'plus';
                } else if (text.includes('reload') || text.includes('refresh') || text.includes('sync')) {
                    iconToAdd = 'counterclockwise-arrows-button';
                } else if (text.includes('batal') || text.includes('cancel') || text.includes('tutup') || text.includes('close')) {
                    iconToAdd = 'cross-mark';
                } else if (text.includes('lihat') || text.includes('detail') || text.includes('view')) {
                    iconToAdd = 'eyes';
                } else if (text.includes('cetak') || text.includes('print')) {
                    iconToAdd = 'printer';
                } else if (text.includes('download') || text.includes('unduh')) {
                    iconToAdd = 'down-arrow';
                } else if (text.includes('upload') || text.includes('unggah') || text.includes('import')) {
                    iconToAdd = 'up-arrow';
                } else if (text.includes('kirim') || text.includes('send') || text.includes('submit')) {
                    iconToAdd = 'airplane';
                } else if (text.includes('login') || text.includes('masuk')) {
                    iconToAdd = 'door';
                }
                
                if (iconToAdd) {
                    var iconify = $('<iconify-icon icon="lucide:' + iconToAdd + '"></iconify-icon>');
                    iconify.css({'vertical-align': 'middle', 'font-size': '1.2rem', 'margin-right': '0.3rem'});
                    // Only prepend if the button has text
                    if(text.length > 0) {
                        $btn.prepend(iconify);
                    } else {
                        iconify.css({'margin-right': '0'});
                        $btn.append(iconify);
                    }
                }
            }
        });
    }

    // Run once on load
    processIcons(document);

    // Run whenever DOM changes (for AJAX DataTables, modals, etc)
    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.addedNodes && mutation.addedNodes.length > 0) {
                for (var i = 0; i < mutation.addedNodes.length; i++) {
                    var node = mutation.addedNodes[i];
                    if (node.nodeType === 1) { // ELEMENT_NODE
                        processIcons(node);
                    }
                }
            }
        });
    });
    observer.observe(document.body, { childList: true, subtree: true });

    setInterval(function() {
        if ($('.modal:visible').length === 0 && $('.modal-backdrop').length > 0) {
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open').css({'padding-right': '', 'overflow': ''});
        }
    }, 500);
<script>
$(document).ready(function() {
    $(document).on('click', '[data-bs-toggle="dropdown"], [data-toggle="dropdown"], .dropdown-toggle', function(e) {
        var $toggle = $(this);
        var $parent = $toggle.closest('.dropdown, .nav-item');
        var $menu = $parent.find('.dropdown-menu');
        if ($menu.length) {
            e.preventDefault();
            e.stopPropagation();
            var isOpen = $menu.hasClass('show');
            $('.dropdown-menu').removeClass('show');
            $('.dropdown, .nav-item').removeClass('show');
            if (!isOpen) {
                $parent.addClass('show');
                $menu.addClass('show');
            }
        }
    });
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.dropdown, .nav-item').length) {
            $('.dropdown-menu').removeClass('show');
            $('.dropdown, .nav-item').removeClass('show');
        }
    });
});
</script>
</body>

</html>
