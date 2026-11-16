/**
 * CBT Mobile Experience Enhancer JS
 * Digunakan untuk panel Admin & Guru di tampilan ponsel
 * Pengecualian mutlak: Siswa dan CBT Ujian
 */
(function() {
    'use strict';

    var currentPath = window.location.pathname.toLowerCase();
    if (currentPath.indexOf('cbtsiswa') !== -1 || window.location.href.indexOf('cbtsiswa') !== -1) {
        return;
    }

    // Pembersih otomatis seleksi teks yang tak disengaja saat berinteraksi di mobile sidebar/navbar
    document.addEventListener('selectionchange', function() {
        var sel = window.getSelection();
        if (!sel || !sel.rangeCount) return;
        var anchor = sel.anchorNode;
        if (anchor) {
            var el = anchor.nodeType === 1 ? anchor : anchor.parentElement;
            if (el && (el.closest('aside.sidebar, .navbar, #sidebar-mobile-backdrop') || document.body.classList.contains('mobile-sidebar-open'))) {
                try {
                    sel.removeAllRanges();
                } catch(e) {}
            }
        }
    });
})();
