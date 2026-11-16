/**
 * Modern Icons & Button Stabilizer (2026 Style)
 * Ensures all icons (Iconify, FontAwesome, SVG) remain rock-solid, fixed size, and stable.
 * Avoids destructive DOM replacement and runaway MutationObservers.
 */
(function() {
    function stabilizeActionButtons(context) {
        var root = context || document;
        var actionButtons = root.querySelectorAll('.table td .btn, td .btn');
        actionButtons.forEach(function(btn) {
            var text = btn.textContent.trim().toLowerCase();
            var isAction = (text === 'edit' || text === 'hapus' || text === 'ubah' || text === 'delete' || text === 'lihat' || text === 'detail' || text === 'download' || text === 'unduh' || btn.classList.contains('btn-edit') || btn.classList.contains('btn-hapus'));
            if ((isAction || text === '') && btn.querySelector('i, iconify-icon, svg')) {
                btn.classList.add('btn-action-icon');
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            stabilizeActionButtons();
        });
    } else {
        stabilizeActionButtons();
    }

    // Hook into jQuery / DataTables draw event if available
    if (window.jQuery) {
        jQuery(document).on('draw.dt', function(e, settings) {
            if (settings && settings.nTable) {
                stabilizeActionButtons(settings.nTable);
            }
        });
    }
})();
