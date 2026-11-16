<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <script>
        // Hope UI v5.0.0 Fast Theme & Color Loader (Light Mode Only)
        try {
            localStorage.setItem('color-mode', 'light');
            sessionStorage.setItem('color-mode', 'light');
            const resolvedTheme = 'light';
            localStorage.setItem('lte-theme', resolvedTheme);
            document.documentElement.setAttribute('data-bs-theme', resolvedTheme);
            document.documentElement.style.colorScheme = resolvedTheme;
            
            const savedColor = localStorage.getItem('colorcustom-mode') || sessionStorage.getItem('colorcustom-mode');
            if (savedColor && savedColor !== 'theme-color-default') {
                document.documentElement.setAttribute('data-bs-theme-color', savedColor);
            }
            const savedDir = localStorage.getItem('dir-mode') || sessionStorage.getItem('dir-mode');
            if (savedDir && savedDir !== 'ltr') {
                document.documentElement.setAttribute('dir', savedDir);
            }
        } catch(e) {}
    </script>

    <!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= isset($judul) ? esc($judul) : 'Aplikasi Ujian CBT & E-Learning' ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <!-- Google Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Aksara Jawa Font Support (Offline & Online) -->
    <link rel="stylesheet" href="<?= base_url('assets/fonts/aksarajawa/aksarajawa.css') ?>">
        
    
    <style id="enterprise-ui-styles">
        /* Cegah Pergeseran Halaman / Scrollbar Jump Saat Buka Modal di Desktop */
        @media (min-width: 1200px) {
            html {
                overflow-y: scroll !important;
                scrollbar-gutter: stable;
            }
        }
        @media (max-width: 1199.98px) {
            html {
                overflow-x: hidden !important;
                overflow-y: auto !important;
                height: auto !important;
                min-height: 100% !important;
                -webkit-overflow-scrolling: touch !important;
            }
            body {
                overflow-x: hidden !important;
                overflow-y: auto !important;
                width: 100% !important;
                max-width: 100vw !important;
                min-height: 100% !important;
                position: relative !important;
                -webkit-overflow-scrolling: touch !important;
            }
            .sidebar.sidebar-mini:not(.sidebar-hover:hover) + .main-content,
            .sidebar.sidebar-mini:not(.sidebar-hover:hover) ~ .main-content,
            .sidebar.sidebar-mini + .main-content,
            .sidebar.sidebar-mini ~ .main-content,
            .sidebar-default.sidebar-mini + .main-content,
            .sidebar-default.sidebar-mini ~ .main-content,
            aside.sidebar + .main-content,
            aside.sidebar ~ .main-content,
            .sidebar + .main-content,
            .sidebar ~ .main-content,
            .sidebar-default + .main-content,
            .main-content {
                margin-left: 0 !important;
                margin-right: 0 !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
                left: 0 !important;
                right: 0 !important;
                width: 100% !important;
                max-width: 100vw !important;
                overflow-x: hidden !important;
                box-sizing: border-box !important;
            }
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

        /* Kunci Tampilan PC di Zoom 80% */
        @media (min-width: 992px) {
            html:not(.flipbook-active) {
                zoom: 80% !important;
            }
        }
        @media (max-width: 991.98px) {
            html:not(.flipbook-active) {
                zoom: 100% !important;
            }
        }
        @media print {
            html, body {
                zoom: 100% !important;
            }
        }

        /* Sidebar Enterprise Full-Height & Smooth Scroll (Anti Terpotong pada Zoom PC) */
        aside.sidebar {
            --sidebar-width: 17.8rem;
            position: fixed !important;
            top: 0 !important;
            bottom: 0 !important;
            left: 0 !important;
            height: 100% !important;
            min-height: 100% !important;
            display: flex !important;
            flex-direction: column !important;
            overflow: hidden !important;
            z-index: 1060 !important;
            box-sizing: border-box !important;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s ease, margin 0.3s ease, border-radius 0.3s ease;
        }

        /* Sidebar Types: Boxed */
        aside.sidebar.sidebar-boxed {
            top: 1rem !important;
            bottom: 1rem !important;
            left: 1rem !important;
            height: calc(100vh - 2rem) !important;
            min-height: calc(100vh - 2rem) !important;
            border-radius: 1rem !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08) !important;
        }
        @media (min-width: 1200px) {
            aside.sidebar.sidebar-boxed:not(.sidebar-mini) + .main-content {
                margin-left: calc(17.8rem + 2rem) !important;
            }
            aside.sidebar.sidebar-boxed.sidebar-mini:not(.sidebar-hover:hover) + .main-content {
                margin-left: calc(4.8rem + 2rem) !important;
            }

            /* Sidebar Types: Mini & Hover (Desktop Only) */
            aside.sidebar.sidebar-mini:not(.sidebar-hover:hover) {
                --sidebar-width: 4.8rem !important;
                width: 4.8rem !important;
            }
            aside.sidebar.sidebar-mini.sidebar-hover:hover {
                --sidebar-width: 17.8rem !important;
                width: 17.8rem !important;
            }
            .sidebar.sidebar-mini:not(.sidebar-hover:hover) + .main-content {
                margin-left: 4.8rem !important;
            }
            aside.sidebar.sidebar-mini:not(.sidebar-hover:hover) .sidebar-body .nav-item .nav-link .item-name,
            aside.sidebar.sidebar-mini:not(.sidebar-hover:hover) .sidebar-body .nav-item .right-icon,
            aside.sidebar.sidebar-mini:not(.sidebar-hover:hover) .sidebar-header .logo-title {
                display: none !important;
            }
            aside.sidebar.sidebar-mini:not(.sidebar-hover:hover) .sidebar-body .nav-item .nav-link {
                justify-content: center !important;
                padding: 0.52rem 0 !important;
            }
            aside.sidebar.sidebar-mini:not(.sidebar-hover:hover) .sidebar-body .nav-item.static-item {
                display: none !important;
            }
        }

        /* ==========================================================================
           HOPE UI ENTERPRISE SIDEBAR - 100% CONTRAST & ADAPTIVE HARMONIZATION
           ========================================================================== */
        aside.sidebar.sidebar-white {
            background-color: #ffffff !important;
            border-right: 1px solid rgba(0, 0, 0, 0.07) !important;
        }
        aside.sidebar.sidebar-white .sidebar-header .logo-title {
            color: #232D42 !important;
        }

        /* 1. STATE BLUE SOLID (Active OR Expanded Parent Menu) -> PURE WHITE TEXT & ICONS */
        aside.sidebar .sidebar-body .nav-link.active,
        aside.sidebar .sidebar-body .nav-link[aria-expanded="true"],
        aside.sidebar.sidebar-white .nav-link.active,
        aside.sidebar.sidebar-white .nav-link[aria-expanded="true"],
        aside.sidebar.sidebar-dark .nav-link.active,
        aside.sidebar.sidebar-dark .nav-link[aria-expanded="true"] {
            background: var(--bs-primary) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 14px rgba(58, 87, 232, 0.35) !important;
        }

        aside.sidebar .sidebar-body .nav-link.active *,
        aside.sidebar .sidebar-body .nav-link[aria-expanded="true"] *,
        aside.sidebar.sidebar-white .nav-link.active *,
        aside.sidebar.sidebar-white .nav-link[aria-expanded="true"] *,
        aside.sidebar.sidebar-dark .nav-link.active *,
        aside.sidebar.sidebar-dark .nav-link[aria-expanded="true"] * {
            color: #ffffff !important;
            stroke: #ffffff !important;
        }

        aside.sidebar .sidebar-body .nav-link.active .item-name,
        aside.sidebar .sidebar-body .nav-link[aria-expanded="true"] .item-name,
        aside.sidebar.sidebar-white .nav-link.active .item-name,
        aside.sidebar.sidebar-white .nav-link[aria-expanded="true"] .item-name {
            color: #ffffff !important;
            font-weight: 700 !important;
        }

        aside.sidebar .sidebar-body .nav-link.active .icon,
        aside.sidebar .sidebar-body .nav-link.active .icon *,
        aside.sidebar .sidebar-body .nav-link[aria-expanded="true"] .icon,
        aside.sidebar .sidebar-body .nav-link[aria-expanded="true"] .icon *,
        aside.sidebar .sidebar-body .nav-link.active svg,
        aside.sidebar .sidebar-body .nav-link[aria-expanded="true"] svg,
        aside.sidebar .sidebar-body .nav-link.active iconify-icon,
        aside.sidebar .sidebar-body .nav-link[aria-expanded="true"] iconify-icon,
        aside.sidebar .sidebar-body .nav-link.active .right-icon,
        aside.sidebar .sidebar-body .nav-link.active .right-icon *,
        aside.sidebar .sidebar-body .nav-link[aria-expanded="true"] .right-icon,
        aside.sidebar .sidebar-body .nav-link[aria-expanded="true"] .right-icon * {
            color: #ffffff !important;
            stroke: #ffffff !important;
        }

        aside.sidebar .sidebar-body .nav-link.active svg[fill="currentColor"],
        aside.sidebar .sidebar-body .nav-link[aria-expanded="true"] svg[fill="currentColor"] {
            fill: #ffffff !important;
        }

        /* 2. STATE NORMAL / INACTIVE (White Sidebar -> Bold Dark Text & Slate Icons) */
        aside.sidebar.sidebar-white .nav-link:not(.active):not([aria-expanded="true"]),
        aside.sidebar.sidebar-white .nav-link.collapsed:not(.active) {
            background: transparent !important;
            color: #1e293b !important;
            box-shadow: none !important;
        }

        aside.sidebar.sidebar-white .nav-link:not(.active):not([aria-expanded="true"]) .item-name,
        aside.sidebar.sidebar-white .nav-link.collapsed:not(.active) .item-name {
            color: #1e293b !important;
            font-weight: 600 !important;
        }

        aside.sidebar.sidebar-white .nav-link:not(.active):not([aria-expanded="true"]) .icon,
        aside.sidebar.sidebar-white .nav-link:not(.active):not([aria-expanded="true"]) .icon *,
        aside.sidebar.sidebar-white .nav-link.collapsed:not(.active) .icon,
        aside.sidebar.sidebar-white .nav-link.collapsed:not(.active) .icon * {
            color: #475569 !important;
            stroke: #475569 !important;
        }

        aside.sidebar.sidebar-white .nav-link:not(.active):not([aria-expanded="true"]) .right-icon,
        aside.sidebar.sidebar-white .nav-link:not(.active):not([aria-expanded="true"]) .right-icon *,
        aside.sidebar.sidebar-white .nav-link.collapsed:not(.active) .right-icon,
        aside.sidebar.sidebar-white .nav-link.collapsed:not(.active) .right-icon * {
            color: #64748b !important;
            stroke: #64748b !important;
        }

        /* 3. SUB-NAV ANAK (Child Menu List inside expanded parent) */
        aside.sidebar .sub-nav {
            background: transparent !important;
            padding-left: 0.5rem;
        }

        /* Anak yang tidak aktif */
        aside.sidebar.sidebar-white .sub-nav .nav-link:not(.active) {
            background: transparent !important;
            color: #334155 !important;
            box-shadow: none !important;
        }
        aside.sidebar.sidebar-white .sub-nav .nav-link:not(.active) .item-name {
            color: #334155 !important;
            font-weight: 500 !important;
        }
        aside.sidebar.sidebar-white .sub-nav .nav-link:not(.active) .icon,
        aside.sidebar.sidebar-white .sub-nav .nav-link:not(.active) .icon * {
            color: #64748b !important;
            stroke: #64748b !important;
        }

        /* Anak yang aktif */
        aside.sidebar.sidebar-white .sub-nav .nav-link.active {
            background: var(--bs-primary) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(58, 87, 232, 0.3) !important;
        }
        aside.sidebar.sidebar-white .sub-nav .nav-link.active * {
            color: #ffffff !important;
            stroke: #ffffff !important;
        }

        /* Hover State Menu Normal */
        aside.sidebar.sidebar-white .nav-link:not(.active):not([aria-expanded="true"]):hover {
            background: rgba(58, 87, 232, 0.08) !important;
            color: var(--bs-primary) !important;
        }
        aside.sidebar.sidebar-white .nav-link:not(.active):not([aria-expanded="true"]):hover * {
            color: var(--bs-primary) !important;
            stroke: var(--bs-primary) !important;
        }
        aside.sidebar.sidebar-white .sub-nav .nav-link:not(.active) .icon * {
            color: #64748b !important;
            stroke: #64748b !important;
        }

        /* Sidebar Header Toggle Button: Rapi di Dalam Header, Tanpa Menabrak Batas */
        aside.sidebar .sidebar-header .sidebar-toggle {
            position: static !important;
            right: auto !important;
            top: auto !important;
            margin-right: 0.25rem !important;
            background: rgba(58, 87, 232, 0.1) !important;
            color: var(--bs-primary) !important;
            border: 1px solid rgba(58, 87, 232, 0.2) !important;
            width: 32px !important;
            height: 32px !important;
            min-width: 32px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            border-radius: 50% !important;
            cursor: pointer !important;
            transition: all 0.2s ease !important;
            padding: 0 !important;
            box-shadow: none !important;
        }
        aside.sidebar .sidebar-header .sidebar-toggle:hover {
            background: var(--bs-primary) !important;
            color: #ffffff !important;
            border-color: var(--bs-primary) !important;
        }
        aside.sidebar .sidebar-header .sidebar-toggle .icon,
        aside.sidebar .sidebar-header .sidebar-toggle svg {
            color: currentColor !important;
            stroke: currentColor !important;
            width: 18px !important;
            height: 18px !important;
        }

        /* Top Navbar Profile & Caption Text - Auto-Adaptive Fallback (Light Navbar Default, overridden if dark/colored) */
        .iq-navbar .caption .caption-title,
        .iq-navbar .caption h6 {
            font-weight: 700 !important;
        }
        .iq-navbar .caption .caption-sub-title,
        .iq-navbar .caption p {
            font-weight: 500 !important;
        }

        aside.sidebar.sidebar-dark {
            background-color: #111827 !important;
            border-right: 1px solid rgba(255, 255, 255, 0.08) !important;
        }
        aside.sidebar.sidebar-dark .sidebar-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
        }
        aside.sidebar.sidebar-dark .sidebar-header .logo-title {
            color: #ffffff !important;
        }
        aside.sidebar.sidebar-dark .sidebar-header .icon svg {
            stroke: #ffffff !important;
        }
        aside.sidebar.sidebar-dark .sidebar-body .nav-item.static-item .default-icon {
            color: rgba(255, 255, 255, 0.45) !important;
        }
        aside.sidebar.sidebar-dark .nav-link:not(.active):not([aria-expanded="true"]) {
            color: #cbd5e1 !important;
        }
        aside.sidebar.sidebar-dark .nav-link:hover:not(.active):not([aria-expanded="true"]) {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.1) !important;
        }

        aside.sidebar.sidebar-color {
            background-color: var(--bs-primary) !important;
            border-right: none !important;
        }
        aside.sidebar.sidebar-color .sidebar-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.15) !important;
        }
        aside.sidebar.sidebar-color .sidebar-header .logo-title {
            color: #ffffff !important;
        }
        aside.sidebar.sidebar-color .sidebar-header .icon svg {
            stroke: #ffffff !important;
        }
        aside.sidebar.sidebar-color .sidebar-body .nav-item.static-item .default-icon {
            color: rgba(255, 255, 255, 0.75) !important;
        }
        aside.sidebar.sidebar-color .nav-link:not(.active):not([aria-expanded="true"]) {
            color: #ffffff !important;
            opacity: 0.9;
        }
        aside.sidebar.sidebar-color .nav-link:hover:not(.active):not([aria-expanded="true"]) {
            color: #ffffff !important;
            opacity: 1;
            background: rgba(255, 255, 255, 0.18) !important;
        }
        aside.sidebar.sidebar-color .nav-link.active,
        aside.sidebar.sidebar-color .nav-link:not(.collapsed)[aria-expanded="true"] {
            color: var(--bs-primary) !important;
            background: #ffffff !important;
            font-weight: 700 !important;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.18) !important;
        }
        aside.sidebar.sidebar-color .nav-link.active *,
        aside.sidebar.sidebar-color .nav-link:not(.collapsed)[aria-expanded="true"] * {
            color: var(--bs-primary) !important;
        }
        aside.sidebar.sidebar-color .nav-link.active .icon,
        aside.sidebar.sidebar-color .nav-link:not(.collapsed)[aria-expanded="true"] .icon,
        aside.sidebar.sidebar-color .nav-link.active svg,
        aside.sidebar.sidebar-color .nav-link:not(.collapsed)[aria-expanded="true"] svg {
            color: var(--bs-primary) !important;
            stroke: var(--bs-primary) !important;
        }

        aside.sidebar.sidebar-transparent {
            background-color: transparent !important;
            border-right: 1px dashed rgba(0, 0, 0, 0.15) !important;
        }

        /* Sidebar Active Styles (Rounded & Pill Variants) */
        .sidebar.navs-rounded .sidebar-body .nav-item .nav-link {
            border-radius: 0 2rem 2rem 0 !important;
        }
        .sidebar.navs-rounded-all .sidebar-body .nav-item .nav-link {
            border-radius: 0.5rem !important;
        }
        .sidebar.navs-pill .sidebar-body .nav-item .nav-link {
            border-radius: 0 50rem 50rem 0 !important;
        }
        .sidebar.navs-pill-all .sidebar-body .nav-item .nav-link {
            border-radius: 50rem !important;
        }

        /* Header & Scroll Container */
        aside.sidebar .sidebar-header {
            flex: 0 0 65px !important;
            height: 65px !important;
            min-height: 65px !important;
            max-height: 65px !important;
            box-sizing: border-box !important;
        }
        aside.sidebar .sidebar-body {
            flex: 1 1 0 !important;
            min-height: 0 !important;
            height: auto !important;
            max-height: none !important;
            overflow-y: auto !important;
            overflow-x: hidden !important;
            -webkit-overflow-scrolling: touch !important;
            overscroll-behavior: contain !important;
            overscroll-behavior-y: contain !important;
            touch-action: pan-y !important;
            box-sizing: border-box !important;
        }
        aside.sidebar .sidebar-body #sidebar-menu,
        aside.sidebar .sidebar-body .sidebar-list {
            padding-bottom: 180px !important;
        }
        /* Sidebar Item Anti-Terpotong Batas & Font Pas Full */
        aside.sidebar .sidebar-body .nav-item .nav-link {
            padding: 0.52rem 0.85rem !important;
            display: flex !important;
            align-items: center !important;
            min-height: 44px !important;
            min-width: 0 !important;
            overflow: visible !important;
        }
        aside.sidebar .sidebar-body .nav-item .nav-link .item-name {
            margin-left: 0.75rem !important;
            margin-right: 0.25rem !important;
            font-size: 0.98rem !important;
            font-weight: 600 !important;
            line-height: 1.32 !important;
            white-space: normal !important;
            word-break: normal !important;
            overflow-wrap: break-word !important;
            text-overflow: unset !important;
            flex: 1 1 auto !important;
            min-width: 0 !important;
        }
        aside.sidebar .sidebar-body .sub-nav .nav-link {
            padding-top: 0.42rem !important;
            padding-bottom: 0.42rem !important;
            padding-left: 0.85rem !important;
            padding-right: 0.65rem !important;
            min-height: 40px !important;
            overflow: visible !important;
        }
        aside.sidebar .sidebar-body .sub-nav .nav-link .item-name {
            font-size: 0.92rem !important;
            font-weight: 500 !important;
            line-height: 1.28 !important;
            white-space: normal !important;
            word-break: normal !important;
            overflow-wrap: break-word !important;
            text-overflow: unset !important;
        }
        aside.sidebar .sidebar-body .nav-item.static-item .default-icon {
            font-size: 0.78rem !important;
            letter-spacing: 0.07em !important;
            font-weight: 800 !important;
            color: #64748b;
            text-transform: uppercase !important;
            padding: 0.65rem 0.5rem 0.35rem 0.5rem !important;
            display: block !important;
        }
        aside.sidebar .sidebar-body .nav-link .icon {
            width: 22px !important;
            min-width: 22px !important;
            font-size: 1.15rem !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            flex-shrink: 0 !important;
        }

        /* Submenu Chevron Arrow 90deg Smooth Rotation */
        aside.sidebar .sidebar-body .nav-link .right-icon {
            flex-shrink: 0 !important;
            margin-left: auto !important;
            width: 18px !important;
            display: inline-flex !important;
            align-items: center !important;
            transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }
        aside.sidebar .sidebar-body .nav-link:not(.collapsed) .right-icon,
        aside.sidebar .sidebar-body .nav-link[aria-expanded="true"] .right-icon {
            transform: rotate(90deg) !important;
        }

        aside.sidebar .sidebar-body::-webkit-scrollbar {
            width: 6px !important;
        }
        aside.sidebar .sidebar-body::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.03) !important;
        }
        aside.sidebar .sidebar-body::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2) !important;
            border-radius: 4px !important;
        }
        aside.sidebar .sidebar-body::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.35) !important;
        }

        /* Settings Drawer - Permanent Anti Dark Backdrop & Floating Clean Panel */
        .offcanvas-backdrop,
        .offcanvas-backdrop.fade,
        .offcanvas-backdrop.show,
        .offcanvas-backdrop.fade.show,
        div.offcanvas-backdrop,
        .modal-backdrop.offcanvas-backdrop,
        .screen-darken,
        .screen-darken.active {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
            pointer-events: none !important;
            width: 0 !important;
            height: 0 !important;
            background: transparent !important;
            z-index: -9999 !important;
        }
        #offcanvasExample {
            box-shadow: -10px 0 35px rgba(0, 0, 0, 0.16) !important;
            border-left: 1px solid rgba(0, 0, 0, 0.08) !important;
            z-index: 1080 !important;
        }

        /* Dark Theme Harmonization */
        [data-bs-theme="dark"] .card {
            background-color: #1e293b !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
            color: #e2e8f0 !important;
        }
        [data-bs-theme="dark"] .card-header {
            background-color: #1e293b !important;
            border-bottom-color: rgba(255, 255, 255, 0.08) !important;
            color: #ffffff !important;
        }
        [data-bs-theme="dark"] .card-title,
        [data-bs-theme="dark"] .card-header h3,
        [data-bs-theme="dark"] .card-header h4,
        [data-bs-theme="dark"] .card-header h5,
        [data-bs-theme="dark"] .card-header h6 {
            color: #ffffff !important;
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
            background-color: var(--bs-primary) !important;
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
        
        /* Remove forced white text from icons if hardcoded */
        .btn .text-white {
            color: inherit !important;
        }
    
        /* Sidebar Scroll Fix */
        .sidebar-body {
            flex: 1 1 auto !important;
            min-height: 0 !important;
            height: calc(100% - 65px) !important;
            max-height: calc(100% - 65px) !important;
        }

        /* Select2 BS5 Styling Fix */
        .select2-container {
            width: 100% !important;
            display: block;
        }
        .select2-container .select2-selection--single {
            height: 38px !important;
            padding: 4px 12px !important;
            border: 1px solid #dee2e6 !important;
            border-radius: 6px !important;
            background-color: #ffffff !important;
            box-sizing: border-box !important;
        }
        .select2-container--bootstrap4 .select2-selection--single .select2-selection__rendered,
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 28px !important;
            color: #495057 !important;
            padding-left: 0 !important;
            width: 100% !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            white-space: nowrap !important;
        }
        .select2-container--bootstrap4 .select2-selection--single .select2-selection__arrow,
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px !important;
            right: 8px !important;
            top: 0 !important;
        }
        .select2-container .select2-selection--multiple {
            min-height: 38px !important;
            border: 1px solid #dee2e6 !important;
            border-radius: 6px !important;
        }
        .select2-dropdown {
            z-index: 1065 !important;
            border: 1px solid #dee2e6 !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
        }
        .select2-dropdown--below {
            border-top: none !important;
            border-top-left-radius: 0 !important;
            border-top-right-radius: 0 !important;
            border-bottom-left-radius: 8px !important;
            border-bottom-right-radius: 8px !important;
        }
        .select2-dropdown--above {
            border-bottom: none !important;
            border-bottom-left-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
            border-top-left-radius: 8px !important;
            border-top-right-radius: 8px !important;
        }
        .select2-container--bootstrap4 .select2-results > .select2-results__options,
        .select2-container--default .select2-results > .select2-results__options {
            max-height: 220px !important;
            overflow-y: auto !important;
            overscroll-behavior: contain !important;
            -webkit-overflow-scrolling: touch !important;
        }

        /* ========================================================= */
        /* === MOBILE SIDEBAR & TOUCH SWIPE GESTURE ENHANCEMENTS === */
        /* ========================================================= */
        .sidebar-mobile-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(15, 23, 42, 0.55);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            z-index: 1055;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.3s;
        }

        .sidebar-mobile-backdrop.show {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        /* Mobile TP & Semester Box in Sidebar */
        .sidebar-tp-box {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important;
            border-radius: 12px !important;
            color: #ffffff !important;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.28) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
        }

        .sidebar-tp-box span,
        .sidebar-tp-box strong,
        .sidebar-tp-box i {
            color: #ffffff !important;
        }

        /* Smooth Sidebar Submenu & Arrow Icon Rotation */
        .sidebar-base .sub-nav {
            transition: none !important;
        }
        .sidebar .right-icon {
            transition: transform 0.25s ease-in-out !important;
            display: inline-flex !important;
            align-items: center !important;
        }
        .sidebar .nav-link.collapsed .right-icon,
        .sidebar .nav-link[aria-expanded="false"] .right-icon {
            transform: rotate(0deg) !important;
        }
        .sidebar .nav-link:not(.collapsed)[aria-expanded="true"] .right-icon {
            transform: rotate(90deg) !important;
        }

        /* Clean Sidebar Header & Toggle Alignment */
        .sidebar .sidebar-header {
            position: relative !important;
            padding: 0.85rem 1rem !important;
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            min-height: 68px !important;
        }
        .sidebar .sidebar-header .navbar-brand {
            display: flex !important;
            align-items: center !important;
            padding: 0 !important;
            margin: 0 !important;
            max-width: calc(100% - 38px) !important;
            overflow: hidden !important;
            text-decoration: none !important;
        }
        .sidebar .sidebar-header .navbar-brand .logo-title {
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            font-size: 1.05rem !important;
            font-weight: 700 !important;
            color: #1e293b !important;
            margin-left: 0.5rem !important;
            margin-bottom: 0 !important;
        }
        .sidebar .sidebar-header .sidebar-toggle {
            position: static !important;
            width: 28px !important;
            height: 28px !important;
            min-width: 28px !important;
            min-height: 28px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            border-radius: 50% !important;
            background: var(--bs-primary, #3a57e8) !important;
            color: #ffffff !important;
            cursor: pointer !important;
            box-shadow: 0 2px 6px rgba(58, 87, 232, 0.3) !important;
            flex-shrink: 0 !important;
            margin-left: auto !important;
            top: auto !important;
            right: auto !important;
            padding: 0 !important;
            transition: all 0.2s ease !important;
        }
        .sidebar .sidebar-header .sidebar-toggle:hover {
            transform: scale(1.08) !important;
            box-shadow: 0 3px 8px rgba(58, 87, 232, 0.45) !important;
        }
        .sidebar .sidebar-header .sidebar-toggle .icon {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            line-height: 1 !important;
        }
        .sidebar .sidebar-header .sidebar-toggle svg {
            width: 16px !important;
            height: 16px !important;
        }

        /* Ensure main-content is properly pushed to the right on desktop (PC) */
        @media (min-width: 1200px) {
            :root {
                --sidebar-width: 17.8rem !important;
            }
            /* Explicitly ensure desktop PC sidebar is docked, untransformed, and fully visible */
            aside.sidebar {
                transform: none !important;
                visibility: visible !important;
                opacity: 1 !important;
                pointer-events: auto !important;
                position: fixed !important;
                top: 0 !important;
                bottom: 0 !important;
                left: 0 !important;
                width: var(--sidebar-width, 17.8rem) !important;
                z-index: 1000 !important;
                display: flex !important;
            }
            aside.sidebar.sidebar-mini {
                width: 4.8rem !important;
                transform: none !important;
                visibility: visible !important;
                opacity: 1 !important;
                pointer-events: auto !important;
            }
            .sidebar + .main-content,
            .sidebar ~ .main-content {
                margin-left: var(--sidebar-width, 17.8rem) !important;
            }
            .sidebar.sidebar-mini + .main-content,
            .sidebar.sidebar-mini ~ .main-content {
                margin-left: 4.8rem !important;
            }
        }

        /* Mobile drawer styling (< 1200px) */
        @media (max-width: 1199.98px) {
            .sidebar + .main-content,
            .sidebar ~ .main-content,
            .sidebar.sidebar-mini + .main-content,
            .sidebar.sidebar-mini ~ .main-content,
            .sidebar-default.sidebar-mini + .main-content,
            .sidebar-default.sidebar-mini ~ .main-content,
            .sidebar-default + .main-content,
            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
                max-width: 100vw !important;
            }
            /* Ensure mobile sidebar floats above all page content as drawer */
            aside.sidebar {
                --sidebar-width: 17.8rem !important;
                z-index: 1060 !important;
                position: fixed !important;
                top: 0 !important;
                bottom: 0 !important;
                left: 0 !important;
                height: 100% !important;
                max-height: 100% !important;
                width: 330px !important;
                max-width: 90vw !important;
                box-shadow: 0 0 35px rgba(0, 0, 0, 0.25) !important;
                background-color: #ffffff !important;
                transition: transform 0.32s cubic-bezier(0.25, 0.8, 0.25, 1) !important;
                will-change: transform;
                transform: translate3d(-105%, 0, 0) !important;
            }

            /* Hidden state on mobile (smoothly offscreen to the left) */
            aside.sidebar:not(.mobile-open):not(.show),
            aside.sidebar.sidebar-mini:not(.mobile-open):not(.show) {
                transform: translate3d(-105%, 0, 0) !important;
            }

            /* Open state on mobile */
            body.mobile-sidebar-open aside.sidebar,
            html.mobile-sidebar-open aside.sidebar,
            aside.sidebar.mobile-open,
            aside.sidebar.show {
                transform: translate3d(0, 0, 0) !important;
                visibility: visible !important;
                pointer-events: auto !important;
            }

            body.mobile-sidebar-open {
                overflow: hidden !important;
                touch-action: none !important;
            }

            /* Modern touch-friendly toggle button in navbar */
            .navbar-inner .sidebar-toggle {
                position: relative !important;
                right: auto !important;
                top: auto !important;
                width: 40px !important;
                height: 40px !important;
                min-width: 40px !important;
                border-radius: 10px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                background: var(--bs-primary, #3a57e8) !important;
                color: #ffffff !important;
                box-shadow: 0 3px 10px rgba(58, 87, 232, 0.35) !important;
                cursor: pointer !important;
                z-index: 99 !important;
                flex-shrink: 0;
                margin-right: 12px;
                padding: 0 !important;
            }

            .navbar-inner .sidebar-toggle:active {
                transform: scale(0.92);
            }

            .navbar-inner .sidebar-toggle .icon {
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                transform: none !important;
            }
        }
    </style>
    <style>
        body { font-family: 'Inter', sans-serif !important; }

        @media print {
            .sidebar, .iq-sidebar, .iq-top-navbar, .iq-banner, .iq-navbar-header, .banner-header, .content-header, .card-header, .card-body > .row, .form-group, .btn, .btn-group, .navbar, .no-print, .d-print-none, #loading, footer {
                display: none !important;
            }
            body {
                background: #ffffff !important;
                color: #000000 !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .content-wrapper, .card:not(.kartu-cetak-card), .card-body, .main-content, .my-shadow:not(.kartu-cetak-card), .m-4, .p-4,
            .content-inner, .container-fluid.content-inner, .container-fluid, .row, .col-sm-12 {
                padding: 0 !important;
                margin: 0 !important;
                margin-top: 0 !important;
                padding-top: 0 !important;
                border: none !important;
                box-shadow: none !important;
                background: transparent !important;
                outline: none !important;
            }
            /* Allow kartu borders to show in print */
            #print-preview .kartu-cetak-card,
            #all-print-preview .kartu-cetak-card {
                border: none !important;
                box-shadow: none !important;
                margin: 0 !important;
                padding: 2mm !important;
                background: white !important;
                page-break-after: always;
            }
            #print-preview .kartu-cetak-card:last-child,
            #all-print-preview .kartu-cetak-card:last-child {
                page-break-after: avoid;
            }
            #print-preview table, #all-print-preview table {
                border-collapse: collapse !important;
            }
            #print-preview td, #all-print-preview td {
                border-color: black !important;
            }
            #print-preview, #all-print-preview, #print-preview *, #all-print-preview * {
                visibility: visible !important;
            }
            #print-preview, #all-print-preview {
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            @page {
                size: A4 portrait;
                margin: 10mm;
            }
        }
    </style>

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
    
    <!-- AdminLTE 4 Native Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print" onload="this.media = 'all'" />
    
    <!-- overlayScrollbars (Native ES6) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous" />

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
    <!-- <link rel="stylesheet" href="<?= base_url() ?>/assets/adminlte4/css/adminlte.min.css?v=<?= time() ?>"> -->
    
    <!-- Hope UI v5.0.0 CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/hopeui/css/core/libs.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/hopeui/css/hope-ui.min.css?v=5.0.0">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/hopeui/css/custom.min.css?v=5.0.0">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/hopeui/css/customizer.min.css?v=5.0.0">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/hopeui/css/rtl.min.css?v=5.0.0">

    <!-- textarea editor -->
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/summernote/summernote-lite.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/summernote/plugin/audio/summernote-audio.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/katex/katex.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/app/css/mystyle.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/DualSelectList/css/bala.DualSelectList.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/app/css/weekCalendar.css">

    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/bootstrap-icon/bootstrap-icons.css">

    <link href="<?= base_url() ?>/assets/plugins/ios-switch/component-custom-switch.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/app/css/player.css" rel="stylesheet">

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
        
        /* Theme Color Overrides for Light Mode */
        .btn-primary {
            background-color: var(--bs-primary) !important;
            border-color: var(--bs-primary) !important;
        }
        .bg-primary {
            background-color: var(--bs-primary) !important;
        }
        .text-primary {
            color: var(--bs-primary) !important;
        }

        /* Table Header */
        .table thead th {
            background-color: var(--bs-primary) !important;
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
    
    <!-- Zenith Premium Dashboard CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/app/css/premium-dashboard.css?v=<?= time() ?>">
    <!-- CBT Mobile Experience Enhancer CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/app/css/cbt-mobile-enhancer.css?v=<?= time() ?>">

    <!-- Enterprise Contrast Master: Konsistensi 100% Kontras Mode Light & Dark -->
    <style id="enterprise-contrast-master">
        /* === LIGHT MODE (DEFAULT) === */
        html:not([data-bs-theme="dark"]) body {
            background-color: #f8fafc !important;
            color: #1e293b !important;
        }
        html:not([data-bs-theme="dark"]) .card:not([class*="bg-"]):not(.kpi-pastel-card),
        html:not([data-bs-theme="dark"]) .modal-content {
            background-color: #ffffff !important;
            color: #1e293b !important;
        }
        html:not([data-bs-theme="dark"]) .card-header:not([class*="bg-primary"]):not([class*="bg-secondary"]):not([class*="bg-success"]):not([class*="bg-danger"]):not([class*="bg-warning"]):not([class*="bg-info"]):not([class*="bg-dark"]) {
            background-color: #ffffff !important;
            color: #0f172a !important;
        }
        html:not([data-bs-theme="dark"]) .card-header:not([class*="bg-primary"]):not([class*="bg-secondary"]):not([class*="bg-success"]):not([class*="bg-danger"]):not([class*="bg-warning"]):not([class*="bg-info"]):not([class*="bg-dark"]) .card-title,
        html:not([data-bs-theme="dark"]) .card-header:not([class*="bg-primary"]):not([class*="bg-secondary"]):not([class*="bg-success"]):not([class*="bg-danger"]):not([class*="bg-warning"]):not([class*="bg-info"]):not([class*="bg-dark"]) h3,
        html:not([data-bs-theme="dark"]) .card-header:not([class*="bg-primary"]):not([class*="bg-secondary"]):not([class*="bg-success"]):not([class*="bg-danger"]):not([class*="bg-warning"]):not([class*="bg-info"]):not([class*="bg-dark"]) h4,
        html:not([data-bs-theme="dark"]) .card-header:not([class*="bg-primary"]):not([class*="bg-secondary"]):not([class*="bg-success"]):not([class*="bg-danger"]):not([class*="bg-warning"]):not([class*="bg-info"]):not([class*="bg-dark"]) h5,
        html:not([data-bs-theme="dark"]) .card-header:not([class*="bg-primary"]):not([class*="bg-secondary"]):not([class*="bg-success"]):not([class*="bg-danger"]):not([class*="bg-warning"]):not([class*="bg-info"]):not([class*="bg-dark"]) h6 {
            color: #0f172a !important;
        }
        html:not([data-bs-theme="dark"]) .text-dark,
        html:not([data-bs-theme="dark"]) .text-black {
            color: #0f172a !important;
        }
        html:not([data-bs-theme="dark"]) .card:not([class*="bg-"]) .text-muted,
        html:not([data-bs-theme="dark"]) .table .text-muted,
        html:not([data-bs-theme="dark"]) .form-text.text-muted {
            color: #475569 !important;
        }
        html:not([data-bs-theme="dark"]) .btn-default {
            background-color: #f1f5f9 !important;
            color: #1e293b !important;
            border: 1px solid #cbd5e1 !important;
        }
        html:not([data-bs-theme="dark"]) .btn-default:hover {
            background-color: #e2e8f0 !important;
            color: #0f172a !important;
        }
        html:not([data-bs-theme="dark"]) .table:not(.table-modern) thead th {
            background-color: var(--bs-primary) !important;
            color: #ffffff !important;
        }
        html:not([data-bs-theme="dark"]) .table-modern thead th {
            background-color: #f8fafc !important;
            color: #334155 !important;
        }
        html:not([data-bs-theme="dark"]) .table:not(.table-dark) tbody td,
        html:not([data-bs-theme="dark"]) .table-modern tbody td {
            color: #1e293b !important;
        }
        html:not([data-bs-theme="dark"]) tr.table-light td {
            background-color: #f1f5f9 !important;
            color: #0f172a !important;
        }

        /* === DARK MODE (HARMONIZED & HIGH-CONTRAST) === */
        html[data-bs-theme="dark"] body,
        html[data-bs-theme="dark"] .content-wrapper,
        html[data-bs-theme="dark"] .main-content {
            background-color: #0b0f19 !important;
            color: #e2e8f0 !important;
        }
        html[data-bs-theme="dark"] .card:not([class*="bg-"]):not(.kpi-pastel-card),
        html[data-bs-theme="dark"] .card-bank-soal,
        html[data-bs-theme="dark"] .card-bank-footer,
        html[data-bs-theme="dark"] .modal-content {
            background-color: #1e293b !important;
            color: #e2e8f0 !important;
            border-color: #334155 !important;
        }
        html[data-bs-theme="dark"] .card-header:not([class*="bg-primary"]):not([class*="bg-secondary"]):not([class*="bg-success"]):not([class*="bg-danger"]):not([class*="bg-warning"]):not([class*="bg-info"]):not([class*="bg-dark"]) {
            background-color: #1e293b !important;
            border-bottom-color: #334155 !important;
            color: #f8fafc !important;
        }
        html[data-bs-theme="dark"] .card-header:not([class*="bg-primary"]):not([class*="bg-secondary"]):not([class*="bg-success"]):not([class*="bg-danger"]):not([class*="bg-warning"]):not([class*="bg-info"]):not([class*="bg-dark"]) .card-title,
        html[data-bs-theme="dark"] .card-header:not([class*="bg-primary"]):not([class*="bg-secondary"]):not([class*="bg-success"]):not([class*="bg-danger"]):not([class*="bg-warning"]):not([class*="bg-info"]):not([class*="bg-dark"]) h3,
        html[data-bs-theme="dark"] .card-header:not([class*="bg-primary"]):not([class*="bg-secondary"]):not([class*="bg-success"]):not([class*="bg-danger"]):not([class*="bg-warning"]):not([class*="bg-info"]):not([class*="bg-dark"]) h4,
        html[data-bs-theme="dark"] .card-header:not([class*="bg-primary"]):not([class*="bg-secondary"]):not([class*="bg-success"]):not([class*="bg-danger"]):not([class*="bg-warning"]):not([class*="bg-info"]):not([class*="bg-dark"]) h5,
        html[data-bs-theme="dark"] .card-header:not([class*="bg-primary"]):not([class*="bg-secondary"]):not([class*="bg-success"]):not([class*="bg-danger"]):not([class*="bg-warning"]):not([class*="bg-info"]):not([class*="bg-dark"]) h6,
        html[data-bs-theme="dark"] .card:not([class*="bg-"]) .card-title,
        html[data-bs-theme="dark"] .card:not([class*="bg-"]) h4,
        html[data-bs-theme="dark"] .card:not([class*="bg-"]) h5,
        html[data-bs-theme="dark"] .card:not([class*="bg-"]) h6 {
            color: #f8fafc !important;
        }
        html[data-bs-theme="dark"] body .bg-white:not(.badge):not(.btn):not(.alert),
        html[data-bs-theme="dark"] body .bg-light:not(.badge):not(.btn):not(.alert),
        html[data-bs-theme="dark"] body .filter-container,
        html[data-bs-theme="dark"] body .sesisiswa-filter-container,
        html[data-bs-theme="dark"] body .nomorpeserta-filter-container,
        html[data-bs-theme="dark"] body .banksoal-filter-card,
        html[data-bs-theme="dark"] body .jadwal-filter-card,
        html[data-bs-theme="dark"] body .modal-code-item,
        html[data-bs-theme="dark"] body .legend-pill {
            background-color: #162032 !important;
            color: #e2e8f0 !important;
            border-color: #334155 !important;
        }
        html[data-bs-theme="dark"] body .filter-label {
            color: #cbd5e1 !important;
        }
        html[data-bs-theme="dark"] body .text-dark,
        html[data-bs-theme="dark"] body .text-black {
            color: #f1f5f9 !important;
        }
        html[data-bs-theme="dark"] body .text-muted {
            color: #94a3b8 !important;
        }
        html[data-bs-theme="dark"] body .table-modern,
        html[data-bs-theme="dark"] body .table-modern tbody tr {
            background-color: #1e293b !important;
            border-color: #334155 !important;
        }
        html[data-bs-theme="dark"] body .table-modern thead th {
            background-color: #0f172a !important;
            color: #f8fafc !important;
            border-color: #334155 !important;
        }
        html[data-bs-theme="dark"] body .table-modern tbody td,
        html[data-bs-theme="dark"] body .table:not(.table-dark) tbody td {
            color: #e2e8f0 !important;
            border-color: #334155 !important;
        }
        html[data-bs-theme="dark"] body tr.table-light td {
            background-color: #334155 !important;
            color: #f8fafc !important;
        }
        html[data-bs-theme="dark"] body .btn-default {
            background-color: #334155 !important;
            color: #f1f5f9 !important;
            border: 1px solid #475569 !important;
        }
        html[data-bs-theme="dark"] body .form-control,
        html[data-bs-theme="dark"] body .form-select,
        html[data-bs-theme="dark"] body .input-group-text,
        html[data-bs-theme="dark"] body .select2-container--default .select2-selection--single,
        html[data-bs-theme="dark"] body .select2-container--default .select2-selection--multiple,
        html[data-bs-theme="dark"] body .select2-dropdown {
            background-color: #0f172a !important;
            color: #f8fafc !important;
            border-color: #334155 !important;
        }
        html[data-bs-theme="dark"] body .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #f8fafc !important;
        }
        html[data-bs-theme="dark"] .select2-results__option {
            color: #f1f5f9 !important;
        }
        html[data-bs-theme="dark"] .select2-results__option--highlighted {
            background-color: var(--bs-primary) !important;
            color: #ffffff !important;
        }
        /* Exception: elemen badge putih/terang & alert box custom terang tetap harus berteks gelap */
        html[data-bs-theme="dark"] .badge.bg-white,
        html[data-bs-theme="dark"] .badge.bg-white *,
        html[data-bs-theme="dark"] .badge.bg-light,
        html[data-bs-theme="dark"] .badge.bg-light *,
        html[data-bs-theme="dark"] .badge.text-bg-light,
        html[data-bs-theme="dark"] .bg-warning .text-dark,
        html[data-bs-theme="dark"] .card-bank-header[style*="#ffc107"],
        html[data-bs-theme="dark"] .card-bank-header[style*="#ffc107"] > div > span:not(.badge) {
            color: #0f172a !important;
        }
        html[data-bs-theme="dark"] .badge-kelas {
            background-color: #334155 !important;
            color: #f1f5f9 !important;
            border-color: #475569 !important;
        }
        html[data-bs-theme="dark"] .alert[style*="#e8f8f0"] {
            background-color: #064e3b !important;
            border-color: #047857 !important;
            color: #ecfdf5 !important;
        }
        html[data-bs-theme="dark"] .alert[style*="#e8f8f0"] *:not(.badge) {
            color: #ecfdf5 !important;
        }
        html[data-bs-theme="dark"] .alert[style*="#fff3cd"] {
            background-color: #451a03 !important;
            border-color: #92400e !important;
            color: #fef3c7 !important;
        }
        html[data-bs-theme="dark"] .alert[style*="#fff3cd"] *:not(.badge) {
            color: #fef3c7 !important;
        }
        html[data-bs-theme="dark"] .alert[style*="#eff6ff"] {
            background-color: #172554 !important;
            border-color: #1d4ed8 !important;
            color: #dbeafe !important;
        }
        html[data-bs-theme="dark"] .alert[style*="#eff6ff"] .text-dark {
            color: #dbeafe !important;
        }

        /* === SIDEBAR & INPUT-GROUP MASTER CONTRAST LOCK === */
        .input-group > .input-group-text {
            width: auto !important;
        }

        /* Desktop Sidebar White / Default: Expanded & Active selalu solid primary + teks putih murni meski di-hover */
        @media (min-width: 1200px) {
            aside.sidebar.sidebar-white .sidebar-body .nav-link.active,
            aside.sidebar.sidebar-white .sidebar-body .nav-link.active:hover,
            aside.sidebar.sidebar-white .sidebar-body .nav-link[aria-expanded="true"],
            aside.sidebar.sidebar-white .sidebar-body .nav-link[aria-expanded="true"]:hover,
            aside.sidebar:not(.sidebar-dark):not(.sidebar-color) .sidebar-body .nav-link.active,
            aside.sidebar:not(.sidebar-dark):not(.sidebar-color) .sidebar-body .nav-link.active:hover,
            aside.sidebar:not(.sidebar-dark):not(.sidebar-color) .sidebar-body .nav-link[aria-expanded="true"],
            aside.sidebar:not(.sidebar-dark):not(.sidebar-color) .sidebar-body .nav-link[aria-expanded="true"]:hover {
                background: var(--bs-primary, #3a57e8) !important;
                background-color: var(--bs-primary, #3a57e8) !important;
                color: #ffffff !important;
                box-shadow: 0 4px 14px rgba(58, 87, 232, 0.35) !important;
            }
            aside.sidebar.sidebar-white .sidebar-body .nav-link.active *,
            aside.sidebar.sidebar-white .sidebar-body .nav-link.active:hover *,
            aside.sidebar.sidebar-white .sidebar-body .nav-link[aria-expanded="true"] *,
            aside.sidebar.sidebar-white .sidebar-body .nav-link[aria-expanded="true"]:hover *,
            aside.sidebar:not(.sidebar-dark):not(.sidebar-color) .sidebar-body .nav-link.active *,
            aside.sidebar:not(.sidebar-dark):not(.sidebar-color) .sidebar-body .nav-link.active:hover *,
            aside.sidebar:not(.sidebar-dark):not(.sidebar-color) .sidebar-body .nav-link[aria-expanded="true"] *,
            aside.sidebar:not(.sidebar-dark):not(.sidebar-color) .sidebar-body .nav-link[aria-expanded="true"]:hover * {
                color: #ffffff !important;
                stroke: #ffffff !important;
                fill: #ffffff !important;
            }
            aside.sidebar.sidebar-white .sidebar-body .nav-link:not(.active):not([aria-expanded="true"]),
            aside.sidebar:not(.sidebar-dark):not(.sidebar-color) .sidebar-body .nav-link:not(.active):not([aria-expanded="true"]) {
                background: transparent !important;
                color: #1e293b !important;
            }
            aside.sidebar.sidebar-white .sidebar-body .nav-link:not(.active):not([aria-expanded="true"]) *,
            aside.sidebar:not(.sidebar-dark):not(.sidebar-color) .sidebar-body .nav-link:not(.active):not([aria-expanded="true"]) * {
                color: #1e293b !important;
                stroke: #475569 !important;
            }
            aside.sidebar.sidebar-white .sidebar-body .nav-link:not(.active):not([aria-expanded="true"]):hover,
            aside.sidebar:not(.sidebar-dark):not(.sidebar-color) .sidebar-body .nav-link:not(.active):not([aria-expanded="true"]):hover {
                background: rgba(58, 87, 232, 0.08) !important;
                color: var(--bs-primary, #3a57e8) !important;
            }
            aside.sidebar.sidebar-white .sidebar-body .nav-link:not(.active):not([aria-expanded="true"]):hover *,
            aside.sidebar:not(.sidebar-dark):not(.sidebar-color) .sidebar-body .nav-link:not(.active):not([aria-expanded="true"]):hover * {
                color: var(--bs-primary, #3a57e8) !important;
                stroke: var(--bs-primary, #3a57e8) !important;
            }
        }

        /* Sidebar Dark */
        aside.sidebar.sidebar-dark .sidebar-body .nav-link:not(.active):not([aria-expanded="true"]),
        aside.sidebar.sidebar-dark .sidebar-body .nav-link:not(.active):not([aria-expanded="true"]) * {
            color: #e2e8f0 !important;
            stroke: #cbd5e1 !important;
        }
        aside.sidebar.sidebar-dark .sidebar-body .nav-link.active,
        aside.sidebar.sidebar-dark .sidebar-body .nav-link.active:hover,
        aside.sidebar.sidebar-dark .sidebar-body .nav-link[aria-expanded="true"],
        aside.sidebar.sidebar-dark .sidebar-body .nav-link[aria-expanded="true"]:hover {
            background: var(--bs-primary, #3a57e8) !important;
            color: #ffffff !important;
        }
        aside.sidebar.sidebar-dark .sidebar-body .nav-link.active *,
        aside.sidebar.sidebar-dark .sidebar-body .nav-link[aria-expanded="true"] * {
            color: #ffffff !important;
            stroke: #ffffff !important;
        }

        /* Sidebar Color */
        aside.sidebar.sidebar-color .sidebar-body .nav-link:not(.active):not([aria-expanded="true"]),
        aside.sidebar.sidebar-color .sidebar-body .nav-link:not(.active):not([aria-expanded="true"]) * {
            color: #ffffff !important;
            stroke: #ffffff !important;
        }
        aside.sidebar.sidebar-color .sidebar-body .nav-link.active,
        aside.sidebar.sidebar-color .sidebar-body .nav-link.active:hover,
        aside.sidebar.sidebar-color .sidebar-body .nav-link[aria-expanded="true"],
        aside.sidebar.sidebar-color .sidebar-body .nav-link[aria-expanded="true"]:hover {
            background: #ffffff !important;
            color: var(--bs-primary, #3a57e8) !important;
        }
        aside.sidebar.sidebar-color .sidebar-body .nav-link.active *,
        aside.sidebar.sidebar-color .sidebar-body .nav-link[aria-expanded="true"] * {
            color: var(--bs-primary, #3a57e8) !important;
            stroke: var(--bs-primary, #3a57e8) !important;
        }

        /* === NAVBAR PROFILE AUTO-CONTRAST (OTOMATIS GELAP/PUTIH SESUAI BACKGROUND) === */
        .iq-navbar.navbar-bg-is-light #navbarDropdown,
        .iq-navbar.navbar-bg-is-light .caption .caption-title,
        .iq-navbar.navbar-bg-is-light .caption h6,
        .iq-navbar.navbar-bg-is-light .navbar-brand .logo-title,
        html:not([data-bs-theme="dark"]) .iq-navbar:not(.navs-transparent):not(.navs-color):not(.navbar-bg-is-dark) #navbarDropdown,
        html:not([data-bs-theme="dark"]) .iq-navbar:not(.navs-transparent):not(.navs-color):not(.navbar-bg-is-dark) .caption .caption-title,
        html:not([data-bs-theme="dark"]) .iq-navbar:not(.navs-transparent):not(.navs-color):not(.navbar-bg-is-dark) .caption h6 {
            color: #0f172a !important;
            text-shadow: none !important;
        }
        .iq-navbar.navbar-bg-is-light .caption .caption-sub-title,
        .iq-navbar.navbar-bg-is-light .caption p,
        html:not([data-bs-theme="dark"]) .iq-navbar:not(.navs-transparent):not(.navs-color):not(.navbar-bg-is-dark) .caption .caption-sub-title,
        html:not([data-bs-theme="dark"]) .iq-navbar:not(.navs-transparent):not(.navs-color):not(.navbar-bg-is-dark) .caption p {
            color: #475569 !important;
            text-shadow: none !important;
            opacity: 1 !important;
        }
        .iq-navbar.navbar-bg-is-light #navbarDropdown::after,
        .iq-navbar.navbar-bg-is-light .dropdown-toggle::after,
        html:not([data-bs-theme="dark"]) .iq-navbar:not(.navs-transparent):not(.navs-color):not(.navbar-bg-is-dark) #navbarDropdown::after,
        html:not([data-bs-theme="dark"]) .iq-navbar:not(.navs-transparent):not(.navs-color):not(.navbar-bg-is-dark) .dropdown-toggle::after {
            color: #0f172a !important;
            border-top-color: #0f172a !important;
        }
        .iq-navbar.navbar-bg-is-dark #navbarDropdown,
        .iq-navbar.navbar-bg-is-dark .caption .caption-title,
        .iq-navbar.navbar-bg-is-dark .caption h6,
        .iq-navbar.navs-color #navbarDropdown,
        .iq-navbar.navs-color .caption .caption-title,
        .iq-navbar.navs-color .caption h6,
        .iq-navbar.navs-transparent:not(.navbar-bg-is-light) #navbarDropdown,
        .iq-navbar.navs-transparent:not(.navbar-bg-is-light) .caption .caption-title,
        .iq-navbar.navs-transparent:not(.navbar-bg-is-light) .caption h6,
        html[data-bs-theme="dark"] .iq-navbar:not(.navbar-bg-is-light) #navbarDropdown,
        html[data-bs-theme="dark"] .iq-navbar:not(.navbar-bg-is-light) .caption .caption-title,
        html[data-bs-theme="dark"] .iq-navbar:not(.navbar-bg-is-light) .caption h6 {
            color: #ffffff !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.25) !important;
        }
        .iq-navbar.navbar-bg-is-dark .caption .caption-sub-title,
        .iq-navbar.navbar-bg-is-dark .caption p,
        .iq-navbar.navs-color .caption .caption-sub-title,
        .iq-navbar.navs-color .caption p,
        .iq-navbar.navs-transparent:not(.navbar-bg-is-light) .caption .caption-sub-title,
        .iq-navbar.navs-transparent:not(.navbar-bg-is-light) .caption p,
        html[data-bs-theme="dark"] .iq-navbar:not(.navbar-bg-is-light) .caption .caption-sub-title,
        html[data-bs-theme="dark"] .iq-navbar:not(.navbar-bg-is-light) .caption p {
            color: rgba(255, 255, 255, 0.88) !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2) !important;
            opacity: 1 !important;
        }
        .iq-navbar.navbar-bg-is-dark #navbarDropdown::after,
        .iq-navbar.navbar-bg-is-dark .dropdown-toggle::after,
        .iq-navbar.navs-color #navbarDropdown::after,
        .iq-navbar.navs-color .dropdown-toggle::after,
        .iq-navbar.navs-transparent:not(.navbar-bg-is-light) #navbarDropdown::after,
        .iq-navbar.navs-transparent:not(.navbar-bg-is-light) .dropdown-toggle::after,
        html[data-bs-theme="dark"] .iq-navbar:not(.navbar-bg-is-light) #navbarDropdown::after,
        html[data-bs-theme="dark"] .iq-navbar:not(.navbar-bg-is-light) .dropdown-toggle::after {
            color: #ffffff !important;
            border-top-color: #ffffff !important;
        }

        /* === UNIFIED PASTEL-GRADIENT KPI CARDS (LIGHT & DARK ADAPTIVE) === */
        .kpi-pastel-card {
            border-radius: 14px !important;
            border: 1px solid rgba(15, 23, 42, 0.06) !important;
            box-shadow: 0 3px 12px rgba(15, 23, 42, 0.05) !important;
            transition: transform 0.2s ease, box-shadow 0.2s ease !important;
        }
        .kpi-pastel-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.09) !important;
        }
        .kpi-pastel-icon {
            width: 44px;
            height: 44px;
            border-radius: 50% !important;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #ffffff !important;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
        }
        .kpi-pastel-icon svg {
            width: 20px;
            height: 20px;
        }
        html:not([data-bs-theme="dark"]) .kpi-pastel-card .kpi-pastel-title { color: #334155 !important; font-weight: 700 !important; }
        html:not([data-bs-theme="dark"]) .kpi-pastel-card .kpi-pastel-sub { color: #64748b !important; }

        html:not([data-bs-theme="dark"]) .kpi-pastel-card.kpi-pastel-blue { background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%) !important; border-color: rgba(37, 99, 235, 0.14) !important; }
        html:not([data-bs-theme="dark"]) .kpi-pastel-blue .kpi-pastel-icon { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important; }
        html:not([data-bs-theme="dark"]) .kpi-pastel-blue .kpi-pastel-value { color: #1d4ed8 !important; }

        html:not([data-bs-theme="dark"]) .kpi-pastel-card.kpi-pastel-green { background: linear-gradient(135deg, #ecfdf5 0%, #dcfce7 100%) !important; border-color: rgba(22, 163, 74, 0.14) !important; }
        html:not([data-bs-theme="dark"]) .kpi-pastel-green .kpi-pastel-icon { background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%) !important; }
        html:not([data-bs-theme="dark"]) .kpi-pastel-green .kpi-pastel-value { color: #15803d !important; }

        html:not([data-bs-theme="dark"]) .kpi-pastel-card.kpi-pastel-amber { background: linear-gradient(135deg, #fefce8 0%, #fef9c3 100%) !important; border-color: rgba(217, 119, 6, 0.16) !important; }
        html:not([data-bs-theme="dark"]) .kpi-pastel-amber .kpi-pastel-icon { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important; }
        html:not([data-bs-theme="dark"]) .kpi-pastel-amber .kpi-pastel-value { color: #b45309 !important; }

        html:not([data-bs-theme="dark"]) .kpi-pastel-card.kpi-pastel-red { background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%) !important; border-color: rgba(220, 38, 38, 0.14) !important; }
        html:not([data-bs-theme="dark"]) .kpi-pastel-red .kpi-pastel-icon { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important; }
        html:not([data-bs-theme="dark"]) .kpi-pastel-red .kpi-pastel-value { color: #b91c1c !important; }

        html:not([data-bs-theme="dark"]) .kpi-pastel-card.kpi-pastel-purple { background: linear-gradient(135deg, #f5f3ff 0%, #ede9fe 100%) !important; border-color: rgba(124, 58, 237, 0.14) !important; }
        html:not([data-bs-theme="dark"]) .kpi-pastel-purple .kpi-pastel-icon { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%) !important; }
        html:not([data-bs-theme="dark"]) .kpi-pastel-purple .kpi-pastel-value { color: #6d28d9 !important; }

        html:not([data-bs-theme="dark"]) .kpi-pastel-card.kpi-pastel-cyan { background: linear-gradient(135deg, #ecfeff 0%, #cffafe 100%) !important; border-color: rgba(8, 145, 178, 0.14) !important; }
        html:not([data-bs-theme="dark"]) .kpi-pastel-cyan .kpi-pastel-icon { background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%) !important; }
        html:not([data-bs-theme="dark"]) .kpi-pastel-cyan .kpi-pastel-value { color: #0e7490 !important; }

        html[data-bs-theme="dark"] .kpi-pastel-card { border-color: rgba(148, 163, 184, 0.18) !important; }
        html[data-bs-theme="dark"] .kpi-pastel-card .kpi-pastel-title { color: #cbd5e1 !important; font-weight: 700 !important; }
        html[data-bs-theme="dark"] .kpi-pastel-card .kpi-pastel-sub { color: #94a3b8 !important; }

        html[data-bs-theme="dark"] .kpi-pastel-card.kpi-pastel-blue { background: linear-gradient(135deg, rgba(37, 99, 235, 0.24) 0%, #1e293b 100%) !important; }
        html[data-bs-theme="dark"] .kpi-pastel-blue .kpi-pastel-icon { background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%) !important; }
        html[data-bs-theme="dark"] .kpi-pastel-blue .kpi-pastel-value { color: #60a5fa !important; }

        html[data-bs-theme="dark"] .kpi-pastel-card.kpi-pastel-green { background: linear-gradient(135deg, rgba(22, 163, 74, 0.24) 0%, #1e293b 100%) !important; }
        html[data-bs-theme="dark"] .kpi-pastel-green .kpi-pastel-icon { background: linear-gradient(135deg, #22c55e 0%, #15803d 100%) !important; }
        html[data-bs-theme="dark"] .kpi-pastel-green .kpi-pastel-value { color: #4ade80 !important; }

        html[data-bs-theme="dark"] .kpi-pastel-card.kpi-pastel-amber { background: linear-gradient(135deg, rgba(217, 119, 6, 0.24) 0%, #1e293b 100%) !important; }
        html[data-bs-theme="dark"] .kpi-pastel-amber .kpi-pastel-icon { background: linear-gradient(135deg, #f59e0b 0%, #b45309 100%) !important; }
        html[data-bs-theme="dark"] .kpi-pastel-amber .kpi-pastel-value { color: #fbbf24 !important; }

        html[data-bs-theme="dark"] .kpi-pastel-card.kpi-pastel-red { background: linear-gradient(135deg, rgba(220, 38, 38, 0.24) 0%, #1e293b 100%) !important; }
        html[data-bs-theme="dark"] .kpi-pastel-red .kpi-pastel-icon { background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%) !important; }
        html[data-bs-theme="dark"] .kpi-pastel-red .kpi-pastel-value { color: #f87171 !important; }

        html[data-bs-theme="dark"] .kpi-pastel-card.kpi-pastel-purple { background: linear-gradient(135deg, rgba(124, 58, 237, 0.24) 0%, #1e293b 100%) !important; }
        html[data-bs-theme="dark"] .kpi-pastel-purple .kpi-pastel-icon { background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%) !important; }
        html[data-bs-theme="dark"] .kpi-pastel-purple .kpi-pastel-value { color: #a78bfa !important; }

        html[data-bs-theme="dark"] .kpi-pastel-card.kpi-pastel-cyan { background: linear-gradient(135deg, rgba(8, 145, 178, 0.24) 0%, #1e293b 100%) !important; }
        html[data-bs-theme="dark"] .kpi-pastel-cyan .kpi-pastel-icon { background: linear-gradient(135deg, #06b6d4 0%, #0e7490 100%) !important; }
        html[data-bs-theme="dark"] .kpi-pastel-cyan .kpi-pastel-value { color: #22d3ee !important; }

        /* === FIX HOPE UI UNDEFINED --bs-*-active-bg FOR CHECKED RADIO/CHECKBOX BUTTONS === */
        :root {
            --bs-primary-active-bg: #3a57e8;
            --bs-primary-active-border: #2e46ba;
            --bs-primary-hover-bg: #314ac5;
            --bs-primary-hover-border: #2e46ba;
            --bs-success-active-bg: #16a34a;
            --bs-success-active-border: #15803d;
            --bs-success-hover-bg: #16a34a;
            --bs-success-hover-border: #15803d;
            --bs-warning-active-bg: #f59e0b;
            --bs-warning-active-border: #d97706;
            --bs-warning-hover-bg: #f59e0b;
            --bs-warning-hover-border: #d97706;
            --bs-danger-active-bg: #dc2626;
            --bs-danger-active-border: #b91c1c;
            --bs-danger-hover-bg: #dc2626;
            --bs-danger-hover-border: #b91c1c;
            --bs-info-active-bg: #0891b2;
            --bs-info-active-border: #0e7490;
            --bs-info-hover-bg: #0891b2;
            --bs-info-hover-border: #0e7490;
        }
        .btn-check:checked + .btn-outline-success,
        .btn-check:active + .btn-outline-success,
        .btn-outline-success.active {
            background-color: #16a34a !important;
            border-color: #15803d !important;
            color: #ffffff !important;
            z-index: 2;
        }
        .btn-check:checked + .btn-outline-primary,
        .btn-check:active + .btn-outline-primary,
        .btn-outline-primary.active {
            background-color: var(--bs-primary, #3a57e8) !important;
            border-color: var(--bs-primary, #3a57e8) !important;
            color: #ffffff !important;
            z-index: 2;
        }
        .btn-check:checked + .btn-outline-warning,
        .btn-check:active + .btn-outline-warning,
        .btn-outline-warning.active {
            background-color: #f59e0b !important;
            border-color: #d97706 !important;
            color: #0f172a !important;
            z-index: 2;
        }
        .btn-check:checked + .btn-outline-danger,
        .btn-check:active + .btn-outline-danger,
        .btn-outline-danger.active {
            background-color: #dc2626 !important;
            border-color: #b91c1c !important;
            color: #ffffff !important;
            z-index: 2;
        }
        .btn-check:checked + .btn-outline-info,
        .btn-check:active + .btn-outline-info,
        .btn-outline-info.active {
            background-color: #0891b2 !important;
            border-color: #0e7490 !important;
            color: #ffffff !important;
            z-index: 2;
        }
        .btn-check:checked + .btn-outline-secondary,
        .btn-check:active + .btn-outline-secondary,
        .btn-outline-secondary.active {
            background-color: #475569 !important;
            border-color: #334155 !important;
            color: #ffffff !important;
            z-index: 2;
        }

        /* Dark Mode fixes for LinkerList (Soal Menjodohkan) */
        html[data-bs-theme="dark"] .linker-toolbar {
            background-color: #0f172a !important;
            border-color: #334155 !important;
        }
        .linker-list .item-kiri,
        .linker-list .item-kanan {
            color: #0f172a !important;
        }

        /* Fix Hope UI .btn-dark (di hope-ui.css --bs-btn-color: #000 menumpuk di atas --bs-dark -> hitam di atas hitam) */
        .btn-dark,
        .table td .btn-dark {
            --bs-btn-color: #ffffff;
            --bs-btn-bg: #1e293b;
            --bs-btn-border-color: #1e293b;
            --bs-btn-hover-color: #ffffff;
            --bs-btn-hover-bg: #0f172a;
            --bs-btn-hover-border-color: #0f172a;
            --bs-btn-active-color: #ffffff;
            --bs-btn-active-bg: #0f172a;
            --bs-btn-active-border-color: #0f172a;
            background-color: #1e293b !important;
            border-color: #1e293b !important;
            color: #ffffff !important;
        }
        .btn-dark:hover,
        .btn-dark:focus,
        .btn-dark:active,
        .btn-dark.active,
        .table td .btn-dark:hover {
            background-color: #0f172a !important;
            border-color: #0f172a !important;
            color: #ffffff !important;
        }
        .btn-dark *,
        .btn-dark:hover *,
        .table td .btn-dark * {
            color: #ffffff !important;
        }
        html[data-bs-theme="dark"] .btn-dark {
            background-color: #334155 !important;
            border-color: #475569 !important;
            color: #f8fafc !important;
        }
        html[data-bs-theme="dark"] .btn-dark:hover {
            background-color: #475569 !important;
            border-color: #64748b !important;
            color: #ffffff !important;
        }
        html[data-bs-theme="dark"] .btn-dark *,
        html[data-bs-theme="dark"] .btn-dark:hover * {
            color: #f8fafc !important;
        }

        /* Fix Hope UI .btn-outline-dark (mencegah teks & border putih di atas background putih/terang) */
        .btn-outline-dark {
            --bs-btn-color: #1e293b;
            --bs-btn-border-color: #475569;
            --bs-btn-hover-color: #ffffff;
            --bs-btn-hover-bg: #1e293b;
            --bs-btn-hover-border-color: #1e293b;
            --bs-btn-active-color: #ffffff;
            --bs-btn-active-bg: #0f172a;
            --bs-btn-active-border-color: #0f172a;
            color: #1e293b !important;
            border-color: #475569 !important;
            background-color: #ffffff !important;
        }
        .btn-outline-dark * {
            color: inherit !important;
        }
        .btn-outline-dark:hover,
        .btn-outline-dark:focus,
        .btn-outline-dark:active,
        .btn-outline-dark.active {
            background-color: #1e293b !important;
            border-color: #1e293b !important;
            color: #ffffff !important;
        }
        html[data-bs-theme="dark"] .btn-outline-dark {
            background-color: transparent !important;
            border-color: #94a3b8 !important;
            color: #f8fafc !important;
        }
        html[data-bs-theme="dark"] .btn-outline-dark:hover {
            background-color: #334155 !important;
            border-color: #cbd5e1 !important;
            color: #ffffff !important;
        }
    </style>
</head>
<script>
    var base_url = '<?= rtrim(base_url(), '/') . '/' ?>';
</script>
<script src="<?= base_url() ?>/assets/app/js/generate.js?v=20261112c"></script>
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
    <style id="mobile-responsive-enterprise-fixes">
        @media (max-width: 1199.98px) {
            html {
                overflow-x: hidden !important;
                overflow-y: auto !important;
                width: 100% !important;
                height: auto !important;
                min-height: 100% !important;
                -webkit-overflow-scrolling: touch !important;
            }
            body {
                overflow-x: hidden !important;
                overflow-y: auto !important;
                width: 100% !important;
                min-height: 100% !important;
                position: relative !important;
                -webkit-overflow-scrolling: touch !important;
            }

            /* 1. Prevent right shift on mobile: force main-content to align flush left at 100% width */
            .sidebar.sidebar-mini:not(.sidebar-hover:hover) + .main-content,
            .sidebar.sidebar-mini:not(.sidebar-hover:hover) ~ .main-content,
            .sidebar.sidebar-mini + .main-content,
            .sidebar.sidebar-mini ~ .main-content,
            .sidebar-default.sidebar-mini + .main-content,
            .sidebar-default.sidebar-mini ~ .main-content,
            aside.sidebar + .main-content,
            aside.sidebar ~ .main-content,
            .sidebar + .main-content,
            .sidebar ~ .main-content,
            .sidebar-default + .main-content,
            .main-content {
                margin-left: 0 !important;
                margin-right: 0 !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
                left: 0 !important;
                right: 0 !important;
                width: 100% !important;
                max-width: 100vw !important;
                overflow-x: hidden !important;
                box-sizing: border-box !important;
            }

            /* 2. Keep sticky navbar at 100% width on mobile without right shift */
            .sidebar.sidebar-mini + .main-content .iq-navbar.navs-sticky.menu-sticky,
            .sidebar + .main-content .iq-navbar.navs-sticky.menu-sticky,
            .iq-navbar.navs-sticky.menu-sticky {
                width: 100% !important;
                left: 0 !important;
                right: 0 !important;
            }

            /* 3. Header Biru Bawaan Hope UI & Salam Selamat Datang (Rapi, Proporsional, Tanpa Kotak Kosong) */
            .iq-navbar-header,
            .iq-banner .iq-navbar-header,
            .sidebar + .main-content .iq-navbar-header {
                display: block !important;
                height: auto !important;
                min-height: 85px !important;
                max-height: none !important;
                padding-top: 0.35rem !important;
                padding-bottom: 2.2rem !important;
                position: relative !important;
            }
            .iq-navbar-header .iq-header-img,
            .iq-banner .iq-navbar-header .iq-header-img,
            .sidebar + .main-content .iq-navbar-header .iq-header-img {
                display: block !important;
                position: absolute !important;
                top: 0 !important;
                left: 0 !important;
                width: 100% !important;
                height: 100% !important;
                min-height: 85px !important;
                max-height: 100% !important;
                border-radius: 0 0 16px 16px !important;
                overflow: hidden !important;
                z-index: -1 !important;
            }
            .iq-navbar-header .iq-header-img img,
            .iq-banner .iq-navbar-header .iq-header-img img {
                display: block !important;
                width: 100% !important;
                height: 100% !important;
                object-fit: cover !important;
                object-position: top center !important;
            }
            .iq-navbar-header .iq-container,
            .iq-banner .iq-navbar-header .iq-container,
            .sidebar + .main-content .iq-navbar-header .iq-container {
                padding: 0.75rem 0.85rem 1.65rem 0.85rem !important;
            }
            .iq-navbar-header h2 {
                font-size: 1.15rem !important;
                line-height: 1.25 !important;
                margin-bottom: 2px !important;
                color: #ffffff !important;
                font-weight: 700 !important;
            }
            .iq-navbar-header p {
                font-size: 0.82rem !important;
                line-height: 1.35 !important;
                margin-bottom: 0 !important;
                color: rgba(255, 255, 255, 0.92) !important;
            }

            /* 4. Tarik kartu halaman tepat ke bawah teks Selamat Datang dengan overlap manis (tanpa kotak biru kosong) */
            .iq-banner:not(.hide) + .content-inner,
            .conatiner-fluid.content-inner,
            .container-fluid.content-inner,
            .content-inner,
            .main-content .content-inner {
                margin-top: -1.4rem !important;
                padding-top: 0 !important;
                position: relative !important;
                z-index: 10 !important;
            }

            /* 5. Wider mobile boxes & optimal edge spacing across all pages */
            .container-fluid.content-inner,
            .container-fluid,
            .content-inner,
            .main-content .content-inner {
                padding-left: 9px !important;
                padding-right: 9px !important;
                max-width: 100% !important;
            }
            .content-inner > .row,
            .content-inner .row,
            .main-content .row {
                margin-left: -4px !important;
                margin-right: -4px !important;
            }
            .content-inner > .row > [class*="col-"],
            .content-inner .row > [class*="col-"],
            .content-inner [class*="col-12"],
            .content-inner [class*="col-sm-12"],
            .main-content [class*="col-12"],
            .main-content [class*="col-sm-12"] {
                padding-left: 4px !important;
                padding-right: 4px !important;
            }
            .card {
                width: 100% !important;
                margin-left: 0 !important;
                margin-right: 0 !important;
                border-radius: 12px !important;
            }
            .card .card-body,
            .card-body.p-4 {
                padding: 0.95rem 0.85rem !important;
            }
            .card .card-header {
                padding: 0.75rem 0.85rem !important;
            }
            .content-inner .card:first-child {
                margin-bottom: 1rem !important;
            }

            /* 6. Table responsive horizontal scrolling without breaking layout */
            .table-responsive {
                overflow-x: auto !important;
                -webkit-overflow-scrolling: touch !important;
                width: 100% !important;
            }
        }
    
        /* Support for .btn-xs and .btn-group-xs across entire application */
        .btn-xs,
        .btn-group-xs > .btn {
            padding: 0.18rem 0.45rem !important;
            font-size: 0.72rem !important;
            line-height: 1.35 !important;
            border-radius: 6px !important;
        }

        /* 7. Mobile Phone Layout Ringkas & Elegan (Lebih hemat ruang & tidak terlalu besar) */
        @media (max-width: 768px) {
            /* Sembunyikan tombol floating setting di layar HP */
            .btn-setting,
            .btn-fixed-end {
                display: none !important;
            }

            /* Banner / Header Card Ringkas di HP */
            .card.mb-4 {
                margin-bottom: 0.75rem !important;
            }
            .card .card-body {
                padding: 0.85rem !important;
            }
            .card .card-header {
                padding: 0.65rem 0.85rem !important;
            }

            /* Header Icon Box Ringkas */
            .card-body .rounded-3[style*="width: 60px"],
            .card-body .rounded-3[style*="width: 50px"],
            .card-body .rounded-3[style*="width: 56px"] {
                width: 42px !important;
                height: 42px !important;
                min-width: 42px !important;
                min-height: 42px !important;
                border-radius: 10px !important;
            }
            .card-body .rounded-3[style*="width: 60px"] i,
            .card-body .rounded-3[style*="width: 50px"] i,
            .card-body .rounded-3[style*="width: 56px"] i,
            .card-body .rounded-3[style*="width: 60px"] svg,
            .card-body .rounded-3[style*="width: 50px"] svg,
            .card-body .rounded-3[style*="width: 56px"] svg {
                font-size: 1.15rem !important;
                width: 20px !important;
                height: 20px !important;
            }

            /* Header Typography Ringkas */
            .card-title,
            h4.card-title {
                font-size: 1.05rem !important;
                line-height: 1.25 !important;
                margin-bottom: 3px !important;
            }
            .card-title .badge,
            h4.card-title .badge {
                font-size: 0.68rem !important;
                padding: 2px 7px !important;
                font-weight: 600 !important;
            }
            .card-body p.text-muted,
            .card-body p[style*="font-size: 0.9rem"],
            .card-body p[style*="font-size:0.9rem"] {
                font-size: 0.78rem !important;
                line-height: 1.35 !important;
                margin-bottom: 0 !important;
            }

            /* Header Action Buttons di HP: Tertata Rapi & Pas, Tidak Menumpuk Vertikal Besar */
            .card-body .d-flex.align-items-center.justify-content-between.flex-wrap > .d-flex.gap-2.align-items-center.flex-wrap,
            .header-actions-responsive {
                width: 100% !important;
                display: flex !important;
                flex-wrap: wrap !important;
                gap: 6px !important;
                margin-top: 8px !important;
            }
            .card-body .d-flex.align-items-center.justify-content-between.flex-wrap > .d-flex.gap-2.align-items-center.flex-wrap .btn,
            .header-actions-responsive .btn {
                flex: 1 1 calc(50% - 6px) !important;
                padding: 5px 10px !important;
                font-size: 0.78rem !important;
                font-weight: 600 !important;
                text-align: center !important;
                justify-content: center !important;
                white-space: nowrap !important;
                display: inline-flex !important;
                align-items: center !important;
                border-radius: 50px !important;
            }

            /* Card Header & Card Tools on Mobile */
            .card-header {
                display: flex !important;
                flex-wrap: wrap !important;
                align-items: center !important;
                justify-content: space-between !important;
                gap: 8px !important;
                padding: 0.65rem 0.85rem !important;
            }
            .card-header .card-title,
            .card-header h5,
            .card-header h6 {
                font-size: 0.98rem !important;
                font-weight: 700 !important;
                margin-bottom: 0 !important;
            }
            .card-header .card-tools,
            .card-header .card-header-action {
                display: flex !important;
                flex-wrap: wrap !important;
                align-items: center !important;
                gap: 5px !important;
            }
            .card-header .card-tools .btn,
            .card-header .card-header-action .btn {
                padding: 4px 9px !important;
                font-size: 0.76rem !important;
                font-weight: 600 !important;
                border-radius: 6px !important;
                line-height: 1.3 !important;
            }
            .card-header .card-tools .btn .icon-20,
            .card-header .card-tools .btn svg,
            .card-header .card-tools .btn i {
                width: 14px !important;
                height: 14px !important;
                font-size: 0.8rem !important;
                vertical-align: middle !important;
            }

            /* Table Typography & Action Buttons on Mobile */
            .table th,
            .table td {
                padding: 0.45rem 0.55rem !important;
                font-size: 0.82rem !important;
                vertical-align: middle !important;
            }
            .btn-xs,
            .btn-group-xs > .btn,
            table td .btn,
            table td .btn-group > .btn {
                padding: 3px 6px !important;
                font-size: 0.72rem !important;
                line-height: 1.3 !important;
                border-radius: 5px !important;
            }
            table td .btn i,
            table td .btn svg {
                font-size: 0.75rem !important;
                width: 13px !important;
                height: 13px !important;
            }
            table td .btn-group {
                gap: 2px !important;
            }

            /* DataTables Controls on Mobile */
            .dataTables_wrapper .dataTables_filter,
            .dataTables_wrapper .dataTables_length {
                margin-bottom: 0.5rem !important;
            }
            .dataTables_wrapper .dataTables_filter input,
            .dataTables_wrapper .dataTables_length select {
                font-size: 0.78rem !important;
                padding: 0.25rem 0.5rem !important;
                border-radius: 6px !important;
                height: auto !important;
            }
            .dataTables_wrapper .dataTables_info,
            .dataTables_wrapper .dataTables_paginate {
                font-size: 0.75rem !important;
                margin-top: 0.5rem !important;
            }
            .dataTables_wrapper .dataTables_paginate .paginate_button {
                padding: 3px 8px !important;
                font-size: 0.74rem !important;
                border-radius: 4px !important;
            }

            /* Modal Dialog on Mobile */
            .modal-dialog {
                margin: 0.5rem !important;
            }
            .modal-content {
                border-radius: 14px !important;
            }
            .modal-header {
                padding: 0.65rem 0.95rem !important;
            }
            .modal-title {
                font-size: 0.95rem !important;
            }
            .modal-body {
                padding: 0.75rem 0.95rem !important;
            }
            .modal-footer {
                padding: 0.55rem 0.95rem !important;
                gap: 6px !important;
            }
            .modal-footer .btn {
                padding: 4px 12px !important;
                font-size: 0.8rem !important;
                border-radius: 50px !important;
            }

            /* Form Controls & Filter Bar on Mobile */
            .form-label,
            label {
                font-size: 0.76rem !important;
                margin-bottom: 3px !important;
            }
            .form-control,
            .form-select {
                font-size: 0.82rem !important;
                padding: 0.38rem 0.65rem !important;
                border-radius: 8px !important;
            }
            .input-group-text {
                font-size: 0.8rem !important;
                padding: 0.38rem 0.65rem !important;
            }
            .form-control-sm,
            .form-select-sm {
                font-size: 0.8rem !important;
                padding: 0.35rem 0.6rem !important;
            }
            .form-label.small {
                font-size: 0.75rem !important;
                margin-bottom: 2px !important;
            }

            /* Badges & Radio Button Groups */
            .badge {
                font-size: 0.7rem !important;
                padding: 0.25rem 0.5rem !important;
                font-weight: 600 !important;
            }
            .btn-group[role="group"] > .btn {
                padding: 0.22rem 0.5rem !important;
                font-size: 0.75rem !important;
            }
            .alert {
                padding: 0.6rem 0.85rem !important;
                font-size: 0.8rem !important;
                border-radius: 10px !important;
            }
            .alert ul {
                padding-left: 1.1rem !important;
                margin-bottom: 0 !important;
            }
            .alert li {
                margin-bottom: 2px !important;
                font-size: 0.78rem !important;
            }

            /* Empty state / placeholder boxes ringkas */
            .card-body .text-center.py-4 {
                padding-top: 1.25rem !important;
                padding-bottom: 1.25rem !important;
            }
            .card-body .text-center.py-4 .rounded-circle[style*="width: 60px"] {
                width: 44px !important;
                height: 44px !important;
                margin-bottom: 0.5rem !important;
            }
            .card-body .text-center.py-4 .rounded-circle[style*="width: 60px"] i {
                font-size: 1.3rem !important;
            }
            .card-body .text-center.py-4 h6 {
                font-size: 0.92rem !important;
            }
            .card-body .text-center.py-4 p {
                font-size: 0.78rem !important;
                margin-bottom: 0.75rem !important;
            }

            /* ==========================================================================
               GLOBAL MOBILE BUTTON & BUTTON-FONT SLIMMING (SEMUA MENU TANPA TERKECUALI)
               ========================================================================== */
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

<body class="  " onload="startTime()">
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

    
    <!-- Sidebar -->
    <?php
    $role = (string)(session()->get('role') ?? '');
    if ($role === '1' || empty($role)) {
        echo $this->include('layout/sidebar_bs5');
    
    } elseif ($role === '2') {
        echo $this->include('members/guru/templates/sidebar');
    } elseif ($role === '3') {
        // echo $this->include('members/siswa/templates/sidebar');
    }
    ?>

    <!-- Main Content -->
    <main class="main-content d-flex flex-column" style="min-height: 100vh;">
        <!-- Navbar -->
        <?php
        if ($role == '1' || empty($role) || $role == '2') {
            echo $this->include('layout/navbar_bs5');
        } elseif ($role == '3') {
            echo $this->include('members/siswa/templates/navbar');
        }
        ?>
        <div class="container-fluid content-inner pt-0 py-0 flex-grow-1" style="margin-top: -3.5rem; position: relative; z-index: 10;">
            <div class="row">
                <div class="col-sm-12">
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
        </div>
        
        <!-- Main Footer -->
        <footer class="footer mt-auto" style="background-color: var(--bs-body-bg, #fff); z-index: 99;">
            <div class="footer-body d-flex justify-content-between align-items-center w-100">
                <ul class="left-panel list-inline mb-0 p-0">
                </ul>
                <div class="right-panel">
                    Copyright &copy; NextGenEdu <?= date('Y') ?> Versi 2.2
                </div>
            </div>
        </footer>
    </main>

    <!-- Mobile Sidebar Backdrop Overlay -->
    <div id="sidebar-mobile-backdrop" class="sidebar-mobile-backdrop"></div>
    <?php if ((string)session()->get('role') === '1'): ?>
    <a class="btn btn-fixed-end btn-warning btn-icon btn-setting" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" role="button" aria-controls="offcanvasExample" data-bs-backdrop="false">
      <svg width="24" viewBox="0 0 24 24" class="animated-rotate icon-24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M20.8064 7.62361L20.184 6.54352C19.6574 5.6296 18.4905 5.31432 17.5753 5.83872V5.83872C17.1397 6.09534 16.6198 6.16815 16.1305 6.04109C15.6411 5.91402 15.2224 5.59752 14.9666 5.16137C14.8021 4.88415 14.7137 4.56839 14.7103 4.24604V4.24604C14.7251 3.72922 14.5302 3.2284 14.1698 2.85767C13.8094 2.48694 13.3143 2.27786 12.7973 2.27808H11.5433C11.0367 2.27807 10.5511 2.47991 10.1938 2.83895C9.83644 3.19798 9.63693 3.68459 9.63937 4.19112V4.19112C9.62435 5.23693 8.77224 6.07681 7.72632 6.0767C7.40397 6.07336 7.08821 5.98494 6.81099 5.82041V5.82041C5.89582 5.29601 4.72887 5.61129 4.20229 6.52522L3.5341 7.62361C3.00817 8.53639 3.31916 9.70261 4.22975 10.2323V10.2323C4.82166 10.574 5.18629 11.2056 5.18629 11.8891C5.18629 12.5725 4.82166 13.2041 4.22975 13.5458V13.5458C3.32031 14.0719 3.00898 15.2353 3.5341 16.1454V16.1454L4.16568 17.2346C4.4124 17.6798 4.82636 18.0083 5.31595 18.1474C5.80554 18.2866 6.3304 18.2249 6.77438 17.976V17.976C7.21084 17.7213 7.73094 17.6516 8.2191 17.7822C8.70725 17.9128 9.12299 18.233 9.37392 18.6717C9.53845 18.9489 9.62686 19.2646 9.63021 19.587V19.587C9.63021 20.6435 10.4867 21.5 11.5433 21.5H12.7973C13.8502 21.5001 14.7053 20.6491 14.7103 19.5962V19.5962C14.7079 19.088 14.9086 18.6 15.2679 18.2407C15.6272 17.8814 16.1152 17.6807 16.6233 17.6831C16.9449 17.6917 17.2594 17.7798 17.5387 17.9394V17.9394C18.4515 18.4653 19.6177 18.1544 20.1474 17.2438V17.2438L20.8064 16.1454C21.0615 15.7075 21.1315 15.186 21.001 14.6964C20.8704 14.2067 20.55 13.7894 20.1108 13.5367V13.5367C19.6715 13.284 19.3511 12.8666 19.2206 12.3769C19.09 11.8873 19.16 11.3658 19.4151 10.928C19.581 10.6383 19.8211 10.3982 20.1108 10.2323V10.2323C21.0159 9.70289 21.3262 8.54349 20.8064 7.63277V7.63277V7.62361Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
          <circle cx="12.1747" cy="11.8891" r="2.63616" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
      </svg>
    </a>
    <!-- Wrapper End-->
    <!-- offcanvas start -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" data-bs-scroll="true" data-bs-backdrop="false"
      aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header">
        <div class="d-flex align-items-center">
          <h3 class="offcanvas-title me-3" id="offcanvasExampleLabel">Settings</h3>
        </div>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body data-scrollbar">
        <div class="row">
          <div class="col-lg-12">
            <h5 class="mb-3">Scheme</h5>
            <div class="d-grid gap-3 grid-cols-1 mb-4">
              <div class="btn btn-border active" data-setting="color-mode" data-name="color" data-value="light">
                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill="currentColor"
                    d="M12,8A4,4 0 0,0 8,12A4,4 0 0,0 12,16A4,4 0 0,0 16,12A4,4 0 0,0 12,8M12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6A6,6 0 0,1 18,12A6,6 0 0,1 12,18M20,8.69V4H15.31L12,0.69L8.69,4H4V8.69L0.69,12L4,15.31V20H8.69L12,23.31L15.31,20H20V15.31L23.31,12L20,8.69Z" />
                </svg>
                <span class="ms-2"> Light</span>
              </div>
            </div>
            <hr class="hr-horizontal">
            <div class="d-flex align-items-center justify-content-between">
              <h5 class="mt-4 mb-3">Color Customizer</h5>
              <button class="btn btn-transparent p-0 border-0" data-value="theme-color-default" data-info="#001F4D"
                data-setting="color-mode1" data-name="color" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                data-bs-original-title="Default">
                <svg class="icon-18" width="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M21.4799 12.2424C21.7557 12.2326 21.9886 12.4482 21.9852 12.7241C21.9595 14.8075 21.2975 16.8392 20.0799 18.5506C18.7652 20.3986 16.8748 21.7718 14.6964 22.4612C12.518 23.1505 10.1711 23.1183 8.01299 22.3694C5.85488 21.6205 4.00382 20.196 2.74167 18.3126C1.47952 16.4293 0.875433 14.1905 1.02139 11.937C1.16734 9.68346 2.05534 7.53876 3.55018 5.82945C5.04501 4.12014 7.06478 2.93987 9.30193 2.46835C11.5391 1.99683 13.8711 2.2599 15.9428 3.2175L16.7558 1.91838C16.9822 1.55679 17.5282 1.62643 17.6565 2.03324L18.8635 5.85986C18.945 6.11851 18.8055 6.39505 18.549 6.48314L14.6564 7.82007C14.2314 7.96603 13.8445 7.52091 14.0483 7.12042L14.6828 5.87345C13.1977 5.18699 11.526 4.9984 9.92231 5.33642C8.31859 5.67443 6.8707 6.52052 5.79911 7.74586C4.72753 8.97119 4.09095 10.5086 3.98633 12.1241C3.8817 13.7395 4.31474 15.3445 5.21953 16.6945C6.12431 18.0446 7.45126 19.0658 8.99832 19.6027C10.5454 20.1395 12.2278 20.1626 13.7894 19.6684C15.351 19.1743 16.7062 18.1899 17.6486 16.8652C18.4937 15.6773 18.9654 14.2742 19.0113 12.8307C19.0201 12.5545 19.2341 12.3223 19.5103 12.3125L21.4799 12.2424Z"
                    fill="#31BAF1" />
                  <path
                    d="M20.0941 18.5594C21.3117 16.848 21.9736 14.8163 21.9993 12.7329C22.0027 12.4569 21.7699 12.2413 21.4941 12.2512L19.5244 12.3213C19.2482 12.3311 19.0342 12.5633 19.0254 12.8395C18.9796 14.283 18.5078 15.6861 17.6628 16.8739C16.7203 18.1986 15.3651 19.183 13.8035 19.6772C12.2419 20.1714 10.5595 20.1483 9.01246 19.6114C7.4654 19.0746 6.13845 18.0534 5.23367 16.7033C4.66562 15.8557 4.28352 14.9076 4.10367 13.9196C4.00935 18.0934 6.49194 21.37 10.008 22.6416C10.697 22.8908 11.4336 22.9852 12.1652 22.9465C13.075 22.8983 13.8508 22.742 14.7105 22.4699C16.8889 21.7805 18.7794 20.4073 20.0941 18.5594Z"
                    fill="#0169CA" />
                </svg>
              </button>
            </div>
            <div class="grid-cols-5 mb-4 d-grid gap-x-2">
              <div class="btn btn-border bg-transparent" data-value="theme-color-blue" data-info="#573BFF"
                data-setting="color-mode1" data-name="color" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                data-bs-original-title="Theme-1">
                <svg class="customizer-btn icon-32" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32">
                  <circle cx="12" cy="12" r="10" fill="#00C3F9" />
                  <path d="M2,12 a1,1 1 1,0 20,0" fill="#573BFF" />
                </svg>
              </div>
              <div class="btn btn-border bg-transparent" data-value="theme-color-gray" data-info="#FD8D00"
                data-setting="color-mode1" data-name="color" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                data-bs-original-title="Theme-2">
                <svg class="customizer-btn icon-32" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32">
                  <circle cx="12" cy="12" r="10" fill="#91969E" />
                  <path d="M2,12 a1,1 1 1,0 20,0" fill="#FD8D00" />
                </svg>
              </div>
              <div class="btn btn-border bg-transparent" data-value="theme-color-red" data-info="#366AF0"
                data-setting="color-mode1" data-name="color" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                data-bs-original-title="Theme-3">
                <svg class="customizer-btn icon-32" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32">
                  <circle cx="12" cy="12" r="10" fill="#DB5363" />
                  <path d="M2,12 a1,1 1 1,0 20,0" fill="#366AF0" />
                </svg>
              </div>
              <div class="btn btn-border bg-transparent" data-value="theme-color-yellow" data-info="#6410F1"
                data-setting="color-mode1" data-name="color" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                data-bs-original-title="Theme-4">
                <svg class="customizer-btn icon-32" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32">
                  <circle cx="12" cy="12" r="10" fill="#EA6A12" />
                  <path d="M2,12 a1,1 1 1,0 20,0" fill="#6410F1" />
                </svg>
              </div>
              <div class="btn btn-border bg-transparent" data-value="theme-color-pink" data-info="#25C799"
                data-setting="color-mode1" data-name="color" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                data-bs-original-title="Theme-5">
                <svg class="customizer-btn icon-32" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32">
                  <circle cx="12" cy="12" r="10" fill="#E586B3" />
                  <path d="M2,12 a1,1 1 1,0 20,0" fill="#25C799" />
                </svg>
              </div>
            </div>
            <hr class="hr-horizontal">
            <h5 class="mb-3 mt-4">Scheme Direction</h5>
            <div class="d-grid gap-3 grid-cols-2 mb-4">
              <div class="text-center">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/dark/01.png" alt="ltr"
                  class="mode dark-img img-fluid btn-border p-0 flex-column active mb-2" data-setting="dir-mode"
                  data-name="dir" data-value="ltr">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/light/01.png" alt="ltr"
                  class="mode light-img img-fluid btn-border p-0 flex-column active mb-2" data-setting="dir-mode"
                  data-name="dir" data-value="ltr">
                <span class=" mt-2"> LTR </span>
              </div>
              <div class="text-center">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/dark/02.png" alt=""
                  class="mode dark-img img-fluid btn-border p-0 flex-column mb-2" data-setting="dir-mode" data-name="dir"
                  data-value="rtl">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/light/02.png" alt=""
                  class="mode light-img img-fluid btn-border p-0 flex-column mb-2" data-setting="dir-mode" data-name="dir"
                  data-value="rtl">
                <span class="mt-2 "> RTL </span>
              </div>
            </div>
            <hr class="hr-horizontal">
            <h5 class="mt-4 mb-3">Sidebar Color</h5>
            <div class="d-grid gap-3 grid-cols-2 mb-4">
              <div class="btn btn-border d-block" data-setting="sidebar" data-name="sidebar-color"
                data-value="sidebar-white">
                <span class=""> Default </span>
              </div>
              <div class="btn btn-border d-block" data-setting="sidebar" data-name="sidebar-color"
                data-value="sidebar-dark">
                <span class=""> Dark </span>
              </div>
              <div class="btn btn-border d-block" data-setting="sidebar" data-name="sidebar-color"
                data-value="sidebar-color">
                <span class=""> Color </span>
              </div>
    
              <div class="btn btn-border d-block" data-setting="sidebar" data-name="sidebar-color"
                data-value="sidebar-transparent">
                <span class=""> Transparent </span>
              </div>
            </div>
            <hr class="hr-horizontal">
            <h5 class="mt-4 mb-3">Sidebar Types</h5>
            <div class="d-grid gap-3 grid-cols-3 mb-4">
              <div class="text-center">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/dark/03.png" alt="mini"
                  class="mode dark-img img-fluid btn-border p-0 flex-column mb-2" data-setting="sidebar"
                  data-name="sidebar-type" data-value="sidebar-mini">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/light/03.png" alt="mini"
                  class="mode light-img img-fluid btn-border p-0 flex-column mb-2" data-setting="sidebar"
                  data-name="sidebar-type" data-value="sidebar-mini">
                <span class="mt-2">Mini</span>
              </div>
              <div class="text-center">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/dark/04.png" alt="hover"
                  class="mode dark-img img-fluid btn-border p-0 flex-column mb-2" data-setting="sidebar"
                  data-name="sidebar-type" data-value="sidebar-hover" data-extra-value="sidebar-mini">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/light/04.png" alt="hover"
                  class="mode light-img img-fluid btn-border p-0 flex-column mb-2" data-setting="sidebar"
                  data-name="sidebar-type" data-value="sidebar-hover" data-extra-value="sidebar-mini">
                <span class="mt-2">Hover</span>
              </div>
              <div class="text-center">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/dark/05.png" alt="boxed"
                  class="mode dark-img img-fluid btn-border p-0 flex-column mb-2" data-setting="sidebar"
                  data-name="sidebar-type" data-value="sidebar-boxed">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/light/05.png" alt="boxed"
                  class="mode light-img img-fluid btn-border p-0 flex-column mb-2" data-setting="sidebar"
                  data-name="sidebar-type" data-value="sidebar-boxed">
                <span class="mt-2">Boxed</span>
              </div>
            </div>
            <hr class="hr-horizontal">
            <h5 class="mt-4 mb-3">Sidebar Active Style</h5>
            <div class="d-grid gap-3 grid-cols-2 mb-4">
              <div class="text-center">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/dark/06.png" alt="rounded-one-side"
                  class="mode dark-img img-fluid btn-border p-0 flex-column mb-2" data-setting="sidebar"
                  data-name="sidebar-item" data-value="navs-rounded">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/light/06.png" alt="rounded-one-side"
                  class="mode light-img img-fluid btn-border p-0 flex-column mb-2" data-setting="sidebar"
                  data-name="sidebar-item" data-value="navs-rounded">
                <span class="mt-2">Rounded One Side</span>
              </div>
              <div class="text-center">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/dark/07.png" alt="rounded-all"
                  class="mode dark-img img-fluid btn-border p-0 flex-column active mb-2" data-setting="sidebar"
                  data-name="sidebar-item" data-value="navs-rounded-all">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/light/07.png" alt="rounded-all"
                  class="mode light-img img-fluid btn-border p-0 flex-column active mb-2" data-setting="sidebar"
                  data-name="sidebar-item" data-value="navs-rounded-all">
                <span class="mt-2">Rounded All</span>
              </div>
              <div class="text-center">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/dark/08.png" alt="pill-one-side"
                  class="mode dark-img img-fluid btn-border p-0 flex-column mb-2" data-setting="sidebar"
                  data-name="sidebar-item" data-value="navs-pill">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/light/09.png" alt="pill-one-side"
                  class="mode light-img img-fluid btn-border p-0 flex-column mb-2" data-setting="sidebar"
                  data-name="sidebar-item" data-value="navs-pill">
                <span class="mt-2">Pill One Side</span>
              </div>
              <div class="text-center">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/dark/09.png" alt="pill-all"
                  class="mode dark-img img-fluid btn-border p-0 flex-column" data-setting="sidebar" data-name="sidebar-item"
                  data-value="navs-pill-all">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/light/08.png" alt="pill-all"
                  class="mode light-img img-fluid btn-border p-0 flex-column mb-2" data-setting="sidebar"
                  data-name="sidebar-item" data-value="navs-pill-all">
                <span class="mt-2">Pill All</span>
              </div>
            </div>
            <hr class="hr-horizontal">
            <h5 class="mt-4 mb-3">Navbar Style</h5>
            <div class="d-grid gap-3 grid-cols-2 ">
              <div class=" text-center">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/dark/11.png" alt="image"
                  class="mode dark-img img-fluid btn-border p-0 flex-column mb-2" data-setting="navbar"
                  data-target=".iq-navbar" data-name="navbar-type" data-value="nav-glass">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/light/10.png" alt="image"
                  class="mode light-img img-fluid btn-border p-0 flex-column mb-2" data-setting="navbar"
                  data-target=".iq-navbar" data-name="navbar-type" data-value="nav-glass">
                <span class="mt-2">Glass</span>
              </div>
              <div class=" text-center">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/dark/12.png" alt="sticky"
                  class="mode dark-img img-fluid btn-border p-0 flex-column mb-2" data-setting="navbar"
                  data-target=".iq-navbar" data-name="navbar-type" data-value="navs-sticky">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/light/12.png" alt="sticky"
                  class="mode light-img img-fluid btn-border p-0 flex-column mb-2" data-setting="navbar"
                  data-target=".iq-navbar" data-name="navbar-type" data-value="navs-sticky">
                <span class="mt-2">Sticky</span>
              </div>
              <div class="text-center">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/dark/13.png" alt="transparent"
                  class="mode dark-img img-fluid btn-border p-0 flex-column mb-2" data-setting="navbar"
                  data-target=".iq-navbar" data-name="navbar-type" data-value="navs-transparent">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/light/13.png" alt="transparent"
                  class="mode light-img img-fluid btn-border p-0 flex-column mb-2" data-setting="navbar"
                  data-target=".iq-navbar" data-name="navbar-type" data-value="navs-transparent">
                <span class="mt-2">Transparent</span>
              </div>
              <div class="text-center">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/dark/10.png" alt="color"
                  class="mode dark-img img-fluid btn-border p-0 flex-column mb-2" data-setting="navbar"
                  data-target=".iq-navbar" data-name="navbar-type" data-value="default">
                <img src="<?= base_url('assets/hopeui/images/settings') ?>/light/01.png" alt="color"
                  class="mode light-img img-fluid btn-border p-0 flex-column mb-2" data-setting="navbar"
                  data-name="navbar-default" data-value="default">
                <span class="mt-2">Default</span>
              </div>
              <div class="btn btn-border active col-span-full mt-4 d-block" data-setting="navbar" data-name="navbar-default"
                data-value="default">
                <span class=""> Default Navbar</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <!-- Hope UI Library Bundle Script -->
    <script src="<?= base_url() ?>/assets/hopeui/js/core/libs.min.js"></script>
    <script src="<?= base_url() ?>/assets/hopeui/js/core/external.min.js"></script>
    <script src="<?= base_url() ?>/assets/hopeui/js/hope-ui.js" defer></script>
    <script src="<?= base_url() ?>/assets/hopeui/js/plugins/setting.js?v=<?= time() ?>"></script>
    <script>
        // Permanent Anti Dark Backdrop & Screen Darken Observer
        (function() {
            function purgeBackdrop() {
                var items = document.querySelectorAll('.offcanvas-backdrop, .modal-backdrop.offcanvas-backdrop, .screen-darken');
                if (items.length > 0) {
                    items.forEach(function(el) { el.remove(); });
                    document.body.classList.remove('modal-open', 'offcanvas-active');
                    document.body.style.overflow = '';
                    document.body.style.paddingRight = '';
                }
            }
            if (window.MutationObserver) {
                var observer = new MutationObserver(function() { purgeBackdrop(); });
                if (document.body) {
                    observer.observe(document.body, { childList: true });
                } else {
                    document.addEventListener('DOMContentLoaded', function() {
                        observer.observe(document.body, { childList: true });
                    });
                }
            }
            document.addEventListener('DOMContentLoaded', function() {
                var offcanvasEl = document.getElementById('offcanvasExample');
                if (offcanvasEl) {
                    offcanvasEl.addEventListener('show.bs.offcanvas', purgeBackdrop);
                    offcanvasEl.addEventListener('shown.bs.offcanvas', purgeBackdrop);
                    offcanvasEl.addEventListener('hide.bs.offcanvas', purgeBackdrop);
                    offcanvasEl.addEventListener('hidden.bs.offcanvas', purgeBackdrop);
                }
            });
        })();
    </script>
    
    <!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Required JS -->
<!-- v3 -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    if (typeof $.widget !== 'undefined' && typeof $.ui !== 'undefined' && typeof $.ui.button !== 'undefined') {
        $.widget.bridge('uibutton', $.ui.button);
    }
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
<script src="<?= base_url() ?>/assets/plugins/summernote/summernote-lite.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/summernote/plugin/audio/summernote-audio.js"></script>
<script src="<?= base_url() ?>/assets/plugins/summernote/plugin/file/summernote-file.js"></script>
<script src="<?= base_url() ?>/assets/plugins/summernote/plugin/gallery/dist/summernote-gallery.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/summernote/plugin/math/summernote-math.js"></script>
  
  <!-- overlayScrollbars (Native ES6) -->
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>

  <!-- SweetAlert2 -->
  <script src="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url() ?>/assets/plugins/toastr/toastr.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url() ?>/assets/plugins/select2/js/select2.full.min.js"></script>
<script>
    // Global Select2 Fix: Auto-position, Auto-direction & Zoom compensation
    (function ($) {
        if ($ && $.fn && $.fn.select2 && $.fn.select2.amd) {
            $.fn.select2.amd.require(['select2/dropdown/attachBody'], function (AttachBody) {
                if (AttachBody && AttachBody.prototype) {
                    AttachBody.prototype._positionDropdown = function () {
                        var $window = $(window);
                        var offset = this.$container.offset();
                        var containerHeight = this.$container.outerHeight(false);
                        var dropdownHeight = this.$dropdown.outerHeight(false);

                        var docZoom = parseFloat(window.getComputedStyle(document.documentElement).zoom) || 1;

                        var $offsetParent = this.$dropdownParent;
                        if ($offsetParent.css('position') === 'static') {
                            $offsetParent = $offsetParent.offsetParent();
                        }

                        var parentOffset = { top: 0, left: 0 };
                        if ($.contains(document.body, $offsetParent[0]) || $offsetParent[0].isConnected) {
                            parentOffset = $offsetParent.offset();
                        }

                        // Convert coordinates into CSS pixel space relative to offsetParent
                        var containerCssTop = (offset.top - parentOffset.top) / docZoom;
                        var containerCssLeft = (offset.left - parentOffset.left) / docZoom;

                        // Viewport bounds in visual pixels
                        var viewportTop = $window.scrollTop();
                        var viewportBottom = viewportTop + $window.height();

                        var containerVisualTop = offset.top;
                        var containerVisualBottom = offset.top + (containerHeight * docZoom);
                        var dropdownVisualHeight = dropdownHeight * docZoom;

                        var enoughRoomAbove = (containerVisualTop - dropdownVisualHeight) >= viewportTop;
                        var enoughRoomBelow = viewportBottom >= (containerVisualBottom + dropdownVisualHeight);

                        var newDirection = 'below';
                        if (!enoughRoomBelow && enoughRoomAbove) {
                            newDirection = 'above';
                        } else if (!enoughRoomAbove && enoughRoomBelow) {
                            newDirection = 'below';
                        }

                        var css = {
                            left: Math.round(containerCssLeft),
                            top: newDirection === 'above'
                                ? Math.round(containerCssTop - dropdownHeight)
                                : Math.round(containerCssTop + containerHeight)
                        };

                        this.$dropdown
                            .removeClass('select2-dropdown--above select2-dropdown--below')
                            .addClass('select2-dropdown--' + newDirection);
                        this.$container
                            .removeClass('select2-container--above select2-container--below')
                            .addClass('select2-container--' + newDirection);

                        this.$dropdownContainer.css(css);
                    };

                    AttachBody.prototype._resizeDropdown = function () {
                        // container.outerWidth is already CSS pixels matching dropdown inside same zoom context
                        var width = this.$container.outerWidth(false);
                        var css = {
                            width: width + 'px'
                        };
                        if (this.options.get('dropdownAutoWidth')) {
                            css.minWidth = css.width;
                            css.position = 'relative';
                            css.width = 'auto';
                        }
                        this.$dropdown.css(css);
                    };
                }
            });

            // Auto close open Select2 dropdowns on window scroll
            $(window).on('scroll', function () {
                if ($('.select2-container--open').length) {
                    $('select.select2-hidden-accessible').select2('close');
                }
            });
        }
    })(window.jQuery);
</script>
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
<script src="<?= base_url() ?>/assets/adminlte4/js/adminlte.min.js"></script>
<script>
    // Pastikan AdminLTE ColorMode tidak menimpa tema Hope UI saat DOMContentLoaded
    (function() {
        function enforceHopeUiTheme() {
            try {
                localStorage.setItem('color-mode', 'light');
                sessionStorage.setItem('color-mode', 'light');
                const resolved = 'light';
                localStorage.setItem('lte-theme', resolved);
                document.documentElement.setAttribute('data-bs-theme', resolved);
                document.documentElement.style.colorScheme = resolved;
                if (document.body) {
                    document.body.classList.remove('dark');
                    document.body.classList.add('light');
                }
                syncNavbarAdaptiveContrast();
            } catch(e) {}
        }
        function parseRgbaColor(str) {
            if (!str) return null;
            const m = str.match(/rgba?\(\s*([\d.]+)\s*,\s*([\d.]+)\s*,\s*([\d.]+)(?:\s*,\s*([\d.]+))?\s*\)/i);
            if (!m) return null;
            return {
                r: parseFloat(m[1]),
                g: parseFloat(m[2]),
                b: parseFloat(m[3]),
                a: m[4] !== undefined ? parseFloat(m[4]) : 1
            };
        }
        function syncNavbarAdaptiveContrast() {
            try {
                const nav = document.querySelector('nav.iq-navbar');
                if (!nav) return;
                let isDarkBg = false;
                const navCs = window.getComputedStyle(nav);
                const navBg = parseRgbaColor(navCs.backgroundColor);

                if (nav.classList.contains('navs-color')) {
                    isDarkBg = true;
                } else if (navCs.backgroundImage && navCs.backgroundImage !== 'none') {
                    // nav-glass gradient over blue banner at top of page vs scrolled over light page
                    if (nav.classList.contains('menu-sticky')) {
                        isDarkBg = document.documentElement.getAttribute('data-bs-theme') === 'dark';
                    } else {
                        const header = document.querySelector('.iq-navbar-header');
                        if (header) {
                            const nr = nav.getBoundingClientRect();
                            const hr = header.getBoundingClientRect();
                            isDarkBg = nr.bottom > hr.top + 8 || document.documentElement.getAttribute('data-bs-theme') === 'dark';
                        } else {
                            isDarkBg = true;
                        }
                    }
                } else if (navBg && navBg.a >= 0.45) {
                    const lum = (0.299 * navBg.r + 0.587 * navBg.g + 0.114 * navBg.b) / 255;
                    isDarkBg = lum < 0.62;
                } else {
                    // Transparent navbar: check overlapping banner header or fall back to ancestor/theme
                    const header = document.querySelector('.iq-navbar-header');
                    if (header && !nav.classList.contains('menu-sticky')) {
                        const nr = nav.getBoundingClientRect();
                        const hr = header.getBoundingClientRect();
                        if (nr.bottom > hr.top + 8 && window.getComputedStyle(header).display !== 'none') {
                            isDarkBg = true;
                        } else {
                            isDarkBg = document.documentElement.getAttribute('data-bs-theme') === 'dark';
                        }
                    } else {
                        isDarkBg = document.documentElement.getAttribute('data-bs-theme') === 'dark';
                    }
                }

                nav.classList.toggle('navbar-bg-is-dark', isDarkBg);
                nav.classList.toggle('navbar-bg-is-light', !isDarkBg);
            } catch(e) {}
        }
        enforceHopeUiTheme();
        document.addEventListener('DOMContentLoaded', function() {
            enforceHopeUiTheme();
            setTimeout(enforceHopeUiTheme, 0);
            setTimeout(syncNavbarAdaptiveContrast, 150);
            const nav = document.querySelector('nav.iq-navbar');
            if (nav && typeof MutationObserver !== 'undefined') {
                const navObs = new MutationObserver(syncNavbarAdaptiveContrast);
                navObs.observe(nav, { attributes: true, attributeFilter: ['class', 'style'] });
                navObs.observe(document.documentElement, { attributes: true, attributeFilter: ['data-bs-theme'] });
                if (document.body) {
                    navObs.observe(document.body, { attributes: true, attributeFilter: ['class'] });
                }
            }
            window.addEventListener('scroll', syncNavbarAdaptiveContrast, { passive: true });
        });
    })();
</script>
  
  <!--begin::OverlayScrollbars Configure-->
  <script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
      scrollbarTheme: 'os-theme-light',
      scrollbarAutoHide: 'leave',
      scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function () {
      const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
      const isMobile = window.innerWidth <= 992;
      if (
        sidebarWrapper &&
        OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
        !isMobile
      ) {
        OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
          scrollbars: {
            theme: Default.scrollbarTheme,
            autoHide: Default.scrollbarAutoHide,
            clickScroll: Default.scrollbarClickScroll,
          },
        });
      }
    });
  </script>
  <!--end::OverlayScrollbars Configure-->

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
        var iLen = (oSettings && oSettings._iDisplayLength > 0) ? oSettings._iDisplayLength : 1;
        return {
            "iStart": oSettings ? oSettings._iDisplayStart : 0,
            "iEnd": (oSettings && typeof oSettings.fnDisplayEnd === 'function') ? oSettings.fnDisplayEnd() : 0,
            "iLength": oSettings ? oSettings._iDisplayLength : 10,
            "iTotal": (oSettings && typeof oSettings.fnRecordsTotal === 'function') ? oSettings.fnRecordsTotal() : 0,
            "iFilteredTotal": (oSettings && typeof oSettings.fnRecordsDisplay === 'function') ? oSettings.fnRecordsDisplay() : 0,
            "iPage": oSettings ? Math.ceil(oSettings._iDisplayStart / iLen) : 0,
            "iTotalPages": oSettings ? Math.ceil(((typeof oSettings.fnRecordsDisplay === 'function') ? oSettings.fnRecordsDisplay() : 0) / iLen) : 1
        };
    };
    if ($.fn.dataTable && $.fn.dataTable.Api) {
        $.fn.dataTable.Api.register('fnPagingInfo()', function () {
            return this.iterator('table', function (settings) {
                return $.fn.dataTableExt.oApi.fnPagingInfo(settings);
            }, 1);
        });
    }

        function ajaxcsrf() {
        var csrfName = '<?= csrf_token() ?>';
        var csrfHash = '<?= csrf_hash() ?>';
        
        $.ajaxPrefilter(function (options, originalOptions, jqXHR) {
            if (options.type.toLowerCase() === 'post') {
                if (options.data instanceof FormData) {
                    options.data.append(csrfName, csrfHash);
                } else if (typeof options.data === 'string' && options.data.indexOf(csrfName + '=') === -1) {
                    options.data += (options.data.length > 0 ? '&' : '') + csrfName + '=' + csrfHash;
                } else if (typeof options.data === 'object' && options.data !== null && !options.data[csrfName]) {
                    options.data[csrfName] = csrfHash;
                }
            }
        });
    };

    window.globalToken = window.globalToken || null;
    window.adaJadwalUjian = window.adaJadwalUjian || null;

    function getToken(func) {
        $.ajax({
            url: base_url + "dashboard/checktokenjadwal",
            type: "GET",
            success: function (response) {
                window.globalToken = response.token;
                window.adaJadwalUjian = response.ada_ujian;
                if (typeof globalToken !== 'undefined') {
                    globalToken = response.token;
                }
                createIntervalToken();
                if (func && (typeof func == "function")) {
                    func(response);
                }
            },
            error: function (xhr, status, error) {
                console.log('Error fetching token:', xhr);
            }
        });
    }

    window.timerToken = window.timerToken || null;
    var timerToken = null;

    function createIntervalToken() {
        if (window.timerToken) {
            clearTimeout(window.timerToken);
            window.timerToken = null;
        }

        const tokenObj = window.globalToken || (typeof globalToken !== 'undefined' ? globalToken : null);
        if (!tokenObj) return;

        const viewTimer = $('#interval');
        const viewToken = $('#token-view');
        const infoTimer = $('#info-interval');
        const inputToken = $('#token-input');

        if (tokenObj.token) {
            if (viewToken.length) viewToken.text(tokenObj.token);
            if (inputToken.length) inputToken.val(tokenObj.token);
        }

        if (String(tokenObj.auto) === '0') {
            if (infoTimer.length) infoTimer.addClass('d-none');
            if (viewTimer.length) viewTimer.addClass('d-none');
            return;
        }

        const durasi = Number(tokenObj.jarak) || 15;
        const perdetik = 1000;
        const permenit = 60 * perdetik;
        const perjam = 60 * permenit;
        const t_dur = durasi * (1000 * 60);

        let updatedStr = String(tokenObj.updated || '').replace(/\s+/, 'T');
        let updated = updatedStr ? new Date(updatedStr) : new Date();
        if (isNaN(updated.getTime())) updated = new Date();

        let nowStr = String(tokenObj.now || '').replace(/\s+/, 'T');
        let time_s = nowStr ? new Date(nowStr) : new Date();
        if (isNaN(time_s.getTime())) time_s = new Date();

        let time_c = new Date();
        let diff = time_s - time_c;

        if (infoTimer.length) infoTimer.removeClass('d-none');
        if (viewTimer.length) viewTimer.removeClass('d-none');

        updateViews();

        function updateViews() {
            if (window.timerToken) {
                clearTimeout(window.timerToken);
                window.timerToken = null;
            }

            const currentTokenObj = window.globalToken || tokenObj;
            if (String(currentTokenObj.auto) === '0') {
                if (infoTimer.length) infoTimer.addClass('d-none');
                if (viewTimer.length) viewTimer.addClass('d-none');
                return;
            }

            let now = new Date();
            now.setMilliseconds(now.getMilliseconds() + diff);
            var rem = now.getTime() - updated.getTime();
            const t_remaining = t_dur - rem;

            if (inputToken.length && currentTokenObj.token) inputToken.val(currentTokenObj.token);
            if (viewToken.length && currentTokenObj.token) viewToken.text(currentTokenObj.token);

            if (t_remaining < 0) {
                if (viewTimer.length) viewTimer.html('Memuat token...');
                getToken();
            } else {
                const r_jam = Math.floor(t_remaining / perjam);
                const r_mnt = Math.floor((t_remaining % perjam) / permenit);
                const r_dtk = Math.floor((t_remaining % permenit) / perdetik);

                const timerTokenRemaining = zeroPad(r_jam) + ':' + zeroPad(r_mnt) + ':' + zeroPad(r_dtk);
                if (viewTimer.length) viewTimer.html(timerTokenRemaining);
                if (typeof updateQrModalToken === 'function') {
                    updateQrModalToken(currentTokenObj.token, timerTokenRemaining);
                }
                window.timerToken = setTimeout(updateViews, 1000);
            }
        }
    }

    $(document).ready(function() {
        if ($('#interval').length || $('#token-view').length) {
            getToken();
        }

        // Permanent Anti-Dark Backdrop for Settings Drawer & Offcanvas
        $(document).on('show.bs.offcanvas shown.bs.offcanvas', function(e) {
            $('.offcanvas-backdrop, .modal-backdrop.offcanvas-backdrop, .screen-darken').remove();
            $('body').removeClass('offcanvas-active').css({
                'overflow': 'auto',
                'padding-right': '0px'
            });
        });

        // MutationObserver to instantly remove any backdrops dynamically injected by Bootstrap or Hope UI
        try {
            var backdropObserver = new MutationObserver(function(mutations) {
                mutations.forEach(function(m) {
                    m.addedNodes.forEach(function(node) {
                        if (node.nodeType === 1 && (
                            node.classList.contains('offcanvas-backdrop') ||
                            node.classList.contains('screen-darken') ||
                            (node.classList.contains('modal-backdrop') && $('#offcanvasExample.show').length > 0)
                        )) {
                            node.remove();
                        }
                    });
                });
            });
            backdropObserver.observe(document.body, { childList: true });
        } catch(e) {}
    });

    function zeroPad(no) {
        return no < 10 ? '0' + no : no;
    }

    function reload_ajax() {
        if (typeof table !== 'undefined') table.ajax.reload();
    }

    function logout(e) {
        if (e && e.preventDefault) e.preventDefault();
        var logoutUrl = (typeof base_url !== 'undefined' ? base_url : '<?= rtrim(base_url(), '/') . '/' ?>') + "auth/logout";
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
    window.logout = logout;
</script>

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
                $title.css({'font-size': '1.25rem', 'font-weight': '700'});
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
                    $label.css({'font-size': '1.1rem', 'font-weight': '700', 'color': 'var(--bs-primary)'});
                    
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    var elements = document.querySelectorAll('a, span, div, p');
    for (var i = 0; i < elements.length; i++) {
        if (elements[i].textContent && (elements[i].textContent.includes('Skip to navigation') || elements[i].textContent.includes('Skip to main content'))) {
            elements[i].style.display = 'none';
        }
    }
});
</script>

<script>
$(document).ready(function() {
    // Pindahkan semua modal ke luar dari content-inner agar tidak tertutup backdrop
    $('.modal').each(function() {
        var $modal = $(this);
        var $parentForm = $modal.closest('form');
        if ($parentForm.length > 0) {
            $parentForm.appendTo('body');
        } else {
            $modal.appendTo('body');
        }
    });

    // Global fail-safe dropdown toggle
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    var elements = document.querySelectorAll('a, span, div, p');
    for (var i = 0; i < elements.length; i++) {
        if (elements[i].textContent && (elements[i].textContent.includes('Skip to navigation') || elements[i].textContent.includes('Skip to main content'))) {
            elements[i].style.display = 'none';
        }
    }
});
</script>

<script>
$(document).ready(function() {
    // Permanent Anti Dark Backdrop for Settings Offcanvas
    $(document).on('show.bs.offcanvas shown.bs.offcanvas', '#offcanvasExample', function () {
        $('.offcanvas-backdrop, .modal-backdrop').remove();
        $('body').css({'overflow': '', 'padding-right': ''});
    });
    $(document).on('hide.bs.offcanvas hidden.bs.offcanvas', '#offcanvasExample', function () {
        $('.offcanvas-backdrop, .modal-backdrop').remove();
        $('body').css({'overflow': '', 'padding-right': ''});
    });

    // Toggle Dropdown Profil Navbar
    $(document).on('click', '#navbarDropdown, .iq-navbar .dropdown-toggle', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var $dropdown = $(this).closest('.dropdown');
        var $menu = $dropdown.find('.dropdown-menu');
        var isShowing = $menu.hasClass('show');
        $('.dropdown-menu').removeClass('show');
        $('.dropdown').removeClass('show');
        if (!isShowing) {
            $menu.addClass('show');
            $dropdown.addClass('show');
            $(this).attr('aria-expanded', 'true');
        } else {
            $(this).attr('aria-expanded', 'false');
        }
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('.dropdown-menu').length && !$(e.target).closest('#navbarDropdown').length) {
            $('.iq-navbar .dropdown-menu').removeClass('show');
            $('.iq-navbar .dropdown').removeClass('show');
            $('.iq-navbar .dropdown-toggle').attr('aria-expanded', 'false');
        }
    });
});
</script>
<script src="<?= base_url('assets/app/js/print-area.js') ?>?v=<?= time() ?>"></script>
<script src="<?= base_url('assets/app/js/cetak-area.js') ?>?v=<?= time() ?>"></script>
<script src="<?= base_url('assets/app/js/html-docx.js') ?>"></script>
<script src="<?= base_url('assets/app/js/convert-area.js') ?>"></script>
<script src="<?= base_url('assets/app/js/FileSaver.min.js') ?>"></script>
<script>
function exportWord(selector, title) {
    var sel = selector || '#print-preview';
    var t = title || (typeof docTitle !== 'undefined' ? docTitle : document.title);
    var $target = $(sel);
    if (!$target.length) $target = $('#all-print-preview');
    if (!$target.length) {
        if (typeof Swal !== 'undefined') Swal.fire('Error', 'Target dokumen tidak ditemukan', 'error');
        else alert('Target dokumen tidak ditemukan');
        return;
    }
    if (typeof $target.convertToHtmlFile !== 'function') {
        if (typeof Swal !== 'undefined') Swal.fire('Error', 'Modul Word belum termuat', 'error');
        else alert('Modul Word belum termuat');
        return;
    }
    try {
        var contentDocument = $target.convertToHtmlFile(t, '');
        var content = '<!DOCTYPE html>' + contentDocument.documentElement.outerHTML;
        var converted = htmlDocx.asBlob(content, {
            size: 'A4',
            margins: {top: 700, bottom: 700, left: 1000, right: 1000}
        });
        saveAs(converted, t + '.docx');
    } catch(e) {
        console.error('Export Word failed:', e);
        if (typeof Swal !== 'undefined') Swal.fire('Error', 'Gagal export Word: ' + e.message, 'error');
        else alert('Gagal export Word: ' + e.message);
    }
}
</script>

<script>
// ================================================================
// MOBILE SIDEBAR & TOUCH SWIPE GESTURES (Buka / Tutup dengan Geser)
// ================================================================
(function() {
    // Fungsi pembersih blok seleksi teks bawaan browser
    function clearTextSelection() {
        try {
            if (window.getSelection) {
                if (window.getSelection().empty) {
                    window.getSelection().empty();
                } else if (window.getSelection().removeAllRanges) {
                    window.getSelection().removeAllRanges();
                }
            } else if (document.selection) {
                document.selection.empty();
            }
        } catch(e) {}
    }

    $(function() {
        if (window.innerWidth < 1200) {
            $('aside.sidebar').removeClass('sidebar-mini');
        }
    });

    window.openMobileSidebar = function() {
        clearTextSelection();
        $('aside.sidebar').removeClass('sidebar-mini').addClass('mobile-open');
        $('html, body').addClass('mobile-sidebar-open');
        $('#sidebar-mobile-backdrop').addClass('show');
    };

    window.closeMobileSidebar = function() {
        clearTextSelection();
        $('aside.sidebar').removeClass('mobile-open');
        $('html, body').removeClass('mobile-sidebar-open');
        $('#sidebar-mobile-backdrop').removeClass('show');
    };

    window.toggleMobileSidebar = function() {
        clearTextSelection();
        if ($('body').hasClass('mobile-sidebar-open') || $('aside.sidebar').hasClass('mobile-open')) {
            closeMobileSidebar();
        } else {
            openMobileSidebar();
        }
    };

    // Tombol Toggle Sidebar di Navbar & Sidebar Header
    $(document).on('click', '[data-toggle="sidebar"]', function(e) {
        if (window.innerWidth < 1200) {
            e.preventDefault();
            e.stopPropagation();
            toggleMobileSidebar();
        }
    });

    // Tutup saat backdrop diklik (gunakan click saja agar usapan/scroll di tepi tidak menutup menu tanpa sengaja)
    $(document).on('click', '#sidebar-mobile-backdrop', function(e) {
        e.preventDefault();
        closeMobileSidebar();
    });

    // Cegah gesture drag/touchmove pada backdrop agar tidak menggerakkan halaman belakang
    $(document).on('touchmove', '#sidebar-mobile-backdrop', function(e) {
        e.preventDefault();
    });


    // Tutup saat link menu diklik di mobile (kecuali dropdown / collapse)
    $(document).on('click', '.sidebar .nav-link', function(e) {
        if (window.innerWidth < 1200) {
            var isCollapse = $(this).attr('data-bs-toggle') === 'collapse' || 
                             $(this).attr('data-toggle') === 'collapse' || 
                             $(this).attr('data-sidebar-toggle') === 'collapse' || 
                             $(this).hasClass('static-item');
            var href = $(this).attr('href');
            if (!isCollapse && href && href !== '#' && !href.startsWith('javascript:')) {
                closeMobileSidebar();
            }
        }
    });

    // Tutup dengan tombol Escape
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape' && $('body').hasClass('mobile-sidebar-open')) {
            closeMobileSidebar();
        }
    });

    // Tutup otomatis jika layar dibesarkan ke desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1200 && $('body').hasClass('mobile-sidebar-open')) {
            closeMobileSidebar();
        }
        syncSidebarHeightWithZoom();
    });

    // ================================================================
    // PC SIDEBAR FULL-HEIGHT SYNC FOR SCREEN ZOOM (Anti Menu Terpotong)
    // ================================================================
    function syncSidebarHeightWithZoom() {
        if (window.innerWidth >= 1200) {
            var $sidebar = $('aside.sidebar');
            if ($sidebar.length) {
                var docZoom = parseFloat(window.getComputedStyle(document.documentElement).zoom) || 1;
                if (docZoom !== 1) {
                    var targetH = Math.round(window.innerHeight / docZoom);
                    $sidebar.css({
                        'height': targetH + 'px',
                        'min-height': targetH + 'px',
                        'max-height': targetH + 'px'
                    });
                } else {
                    $sidebar.css({
                        'height': '',
                        'min-height': '',
                        'max-height': ''
                    });
                }
            }
        }
    }
    $(window).on('resize orientationchange load', syncSidebarHeightWithZoom);
    $(document).ready(syncSidebarHeightWithZoom);
    setTimeout(syncSidebarHeightWithZoom, 300);

    // ==========================================
    // TOUCH SWIPE DETECTOR (Deteksi Geser Layar)
    // ==========================================
    var touchStartX = 0;
    var touchStartY = 0;
    var touchEndX = 0;
    var touchEndY = 0;
    var touchStartTime = 0;
    var isSwiping = false;

    window.addEventListener('touchstart', function(e) {
        if (e.touches.length !== 1 || window.innerWidth >= 1200) return;
        var isSidebarOpen = $('body').hasClass('mobile-sidebar-open') || $('aside.sidebar').hasClass('mobile-open');
        if (isSidebarOpen) {
            isSwiping = false;
            return;
        }
        // Hanya aktif jika sentuhan dimulai dari bibir layar paling kiri (<= 35px)
        if (e.touches[0].clientX > 35) return;
        clearTextSelection();

        touchStartX = e.touches[0].clientX;
        touchStartY = e.touches[0].clientY;
        touchEndX = touchStartX;
        touchEndY = touchStartY;
        touchStartTime = Date.now();
        isSwiping = true;
    }, { passive: true });

    window.addEventListener('touchmove', function(e) {
        if (!isSwiping || e.touches.length !== 1) return;
        clearTextSelection();
        touchEndX = e.touches[0].clientX;
        touchEndY = e.touches[0].clientY;
    }, { passive: true });

    window.addEventListener('touchend', function(e) {
        if (!isSwiping) return;
        isSwiping = false;

        clearTextSelection();
        var deltaX = touchEndX - touchStartX;
        var deltaY = touchEndY - touchStartY;
        var absX = Math.abs(deltaX);
        var absY = Math.abs(deltaY);
        var elapsed = Date.now() - touchStartTime;

        // Pastikan gerakan dominan horizontal (bukan scroll ke atas/bawah)
        if (absX > 40 && absX > absY * 1.3 && elapsed < 650) {
            var isSidebarOpen = $('body').hasClass('mobile-sidebar-open') || $('aside.sidebar').hasClass('mobile-open');

            // 1. SWIPE KANAN (Geser dari tepi kiri layar ke kanan): BUKA MENU
            if (deltaX > 0 && !isSidebarOpen) {
                var target = e.target;
                var isInsideScrollable = target && target.closest && target.closest('.table-responsive, .no-swipe, input, textarea, select');
                if (!isInsideScrollable) {
                    openMobileSidebar();
                }
            }
            // 2. SWIPE KIRI (Geser ke kiri saat menu terbuka): TUTUP MENU
            else if (deltaX < 0 && isSidebarOpen) {
                closeMobileSidebar();
            }
        }
    }, { passive: true });
})();

// Polyfill bsCustomFileInput for BS5 compatibility
if (typeof window.bsCustomFileInput === 'undefined') {
    window.bsCustomFileInput = { init: function() {} };
}
</script>
<!-- CBT Mobile Experience Enhancer JS -->
<script src="<?= base_url() ?>/assets/app/js/cbt-mobile-enhancer.js?v=<?= time() ?>"></script>
<?= $this->renderSection('scripts') ?>



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
</body>
</html>
