/*
* Version: 5.0.0
* Template: Hope-Ui - Responsive Bootstrap 5 Admin Dashboard Template
* Author: iqonic.design
* Integrated with LocalStorage Persistence for CBT & E-Learning System
*/

(function () {
    "use strict";

    // Storage helper for persistence across page loads & browser restarts
    const getSetting = (key) => {
        try {
            return localStorage.getItem(key) || sessionStorage.getItem(key);
        } catch(e) {
            return null;
        }
    };
    const setSetting = (key, val) => {
        try { localStorage.setItem(key, val); } catch(e){}
        try { sessionStorage.setItem(key, val); } catch(e){}
    };
    const removeSetting = (key) => {
        try { localStorage.removeItem(key); } catch(e){}
        try { sessionStorage.removeItem(key); } catch(e){}
    };

    let sidebarTypeSetting = [];

    // RTL mode on change offcanvas position change function
    const rtlModeDefault = (check) => {
        if (check) {
            $('.offcanvas-start').addClass('on-rtl start').removeClass('offcanvas-start');
            $('.offcanvas-end').addClass('on-rtl end').removeClass('offcanvas-end');
            $('.on-rtl.start').addClass('offcanvas-end').removeClass('start');
            $('.on-rtl.end').addClass('offcanvas-start').removeClass('end');
        } else {
            $('.offcanvas-start').addClass('on-rtl start').removeClass('offcanvas-start');
            $('.offcanvas-end').addClass('on-rtl end').removeClass('offcanvas-end');
            $('.on-rtl.start').addClass('offcanvas-end').removeClass('start');
            $('.on-rtl.end').addClass('offcanvas-start').removeClass('end');
        }
    };

    // On Page Load Active Function
    const checkSettingMenu = (type, name, value, data) => {
        if (data == 'addedClass') {
            document.querySelectorAll(`[data-setting="${type}"][data-name="${name}"].active`).forEach((el) => {
                el.classList.remove('active');
            });
            document.querySelectorAll(`[data-setting="${type}"][data-name="${name}"][data-value="${value}"]`).forEach((el) => {
                el.classList.add('active');
            });
        }
        if (data == 'noClass') {
            const dataRemove = `[data-setting="${type}"][data-name="${name}"]`;
            const dataAdd = `[data-setting="${type}"][data-name="${name}"][data-value="${value}"]`;

            document.querySelectorAll(dataRemove).forEach((el) => {
                el.classList.remove('active');
            });
            document.querySelectorAll(dataAdd).forEach((el) => {
                el.classList.add('active');
            });
        }
    };

    // Dark mode enable & disabled function
    const resolveColorMode = (val) => {
        if (val === 'auto') {
            return (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) ? 'dark' : 'light';
        }
        return val === 'dark' ? 'dark' : 'light';
    };

    const syncBodyThemeClasses = (resolved) => {
        try {
            document.documentElement.setAttribute('data-bs-theme', resolved);
            document.documentElement.style.colorScheme = resolved;
            localStorage.setItem('lte-theme', resolved);
            if (document.body) {
                document.body.classList.toggle('dark', resolved === 'dark');
                document.body.classList.toggle('light', resolved === 'light');
            }
        } catch(e) {}
    };

    const darkMode = () => {
        const currentTheme = document.querySelector('html').getAttribute('data-bs-theme');
        if (currentTheme === 'auto') {
            syncBodyThemeClasses(resolveColorMode('auto'));
        }
    };

    // For Dark, RTL & Sidebar Class Update
    const changeMode = (type, value, target) => {
        let detailObj = {};
        if (type == 'color-mode') {
            const resolved = resolveColorMode(value);
            detailObj = { dark: resolved };
            setSetting('color-mode', value);
            syncBodyThemeClasses(resolved);
        }
        if (type == 'dir-mode') {
            detailObj = { dir: value };
            setSetting('dir-mode', value);
            document.querySelector('html').setAttribute('dir', value);
        }
        if (type == 'sidebar') {
            detailObj = { 'sidebar-color': value };
            setSetting('sidebar', value);
            document.querySelectorAll('.sidebar, .sidebar-default').forEach((sidebarclass) => {
                sidebarclass.classList.remove('sidebar-white', 'sidebar-dark', 'sidebar-color', 'sidebar-transparent');
                sidebarclass.classList.add(value);
            });
        }
        if (type == 'sidebar-style') {
            setSetting('sidebar-style', value);
            document.querySelectorAll('.sidebar, .sidebar-default').forEach((sidebar) => {
                sidebar.classList.remove('navs-rounded', 'navs-rounded-all', 'navs-pill', 'navs-pill-all');
                sidebar.classList.add(value);
            });
        }
        const event = new CustomEvent("ChangeMode", { detail: detailObj });
        document.dispatchEvent(event);
    };

    // Page on load function
    const updateMode = () => {
        document.addEventListener('ChangeMode', (e) => {
            if (e.detail.dir === 'rtl' || e.detail.dir === 'ltr') {
                rtlModeDefault(true);
            }
            if (e.detail.dark !== null || e.detail.dark !== undefined) {
                darkMode();
            }
        });

        // Scheme dikunci pada Light Mode
        const colorMode = 'light';
        setSetting('color-mode', 'light');
        checkSettingMenu('color-mode', 'color', colorMode, 'addedClass');
        changeMode('color-mode', colorMode);

        // For RTL Mode
        const dirMode = getSetting('dir-mode');
        if (dirMode !== null && dirMode !== undefined && dirMode !== 'ltr') {
            checkSettingMenu('dir-mode', 'dir', dirMode, 'addedClass');
            changeMode('dir-mode', dirMode);
        }

        // For Sidebar Color (Default: sidebar-white)
        const sidebarColors = getSetting('sidebar') || 'sidebar-white';
        checkSettingMenu('sidebar', 'sidebar-color', sidebarColors, 'addedClass');
        changeMode('sidebar', sidebarColors);

        // For Sidebar Types
        const sidebarTypeSession = getSetting('sidebarType');
        if (sidebarTypeSession !== null && sidebarTypeSession !== undefined) {
            try {
                sidebarTypeSetting = JSON.parse(sidebarTypeSession);
                Array.from(sidebarTypeSetting, (type) => {
                    document.querySelectorAll(`[data-setting="sidebar"][data-name="sidebar-type"][data-value="${type}"]`).forEach((el) => {
                        el.classList.add('active');
                    });
                    document.querySelectorAll('.sidebar, .sidebar-default').forEach((sb) => {
                        sb.classList.add(type);
                    });
                });
            } catch(e) {}
        }

        // For Sidebar Active Style (Default: navs-rounded-all)
        const allActiveType = getSetting('sidebar-style') || 'navs-rounded-all';
        document.querySelectorAll('.sidebar, .sidebar-default').forEach((sidebar) => {
            sidebar.classList.remove('navs-rounded-all', 'navs-rounded', 'navs-pill', 'navs-pill-all');
            sidebar.classList.add(`${allActiveType}`);
        });
        checkSettingMenu('sidebar', 'sidebar-item', allActiveType, 'addedClass');

        // For Navbar & Header Style
        const allNavbarType = getSetting('navbarTypes');
        if (allNavbarType !== null && allNavbarType !== undefined) {
            const iqNav = document.querySelector('.iq-navbar');
            if (iqNav && (allNavbarType == 'nav-glass' || allNavbarType == 'navs-sticky' || allNavbarType == 'navs-transparent')) {
                iqNav.classList.add(`${allNavbarType}`);
            }
            if (iqNav && allNavbarType == 'default') {
                iqNav.classList.remove('nav-glass', 'navs-sticky', 'navs-transparent');
            }
            checkSettingMenu('navbar', 'navbar-type', allNavbarType, 'noClass');
        }
    };

    updateMode();

    // Scheme dikunci ke Light Mode
    const colorModeElements = document.querySelectorAll('[data-setting="color-mode"][data-name="color"]');
    Array.from(colorModeElements, (mode) => {
        mode.addEventListener('click', (e) => {
            Array.from(colorModeElements, (el) => {
                el.classList.remove('active');
            });
            setSetting('color-mode', 'light');
            mode.classList.add('active');
            changeMode('color-mode', 'light');
        });
    });

    // RTL & LTR Click Listener
    const dirModeElements = document.querySelectorAll('[data-setting="dir-mode"][data-name="dir"]');
    Array.from(dirModeElements, (mode) => {
        mode.addEventListener('click', (e) => {
            Array.from(dirModeElements, (el) => {
                el.classList.remove('active');
            });
            const val = mode.getAttribute('data-value');
            Array.from(document.querySelectorAll(`[data-value="${val}"]`), (el) => el.classList.add('active'));
            setSetting('dir-mode', val);
            changeMode('dir-mode', val);
        });
    });

    // Sidebar Color Click Listener
    const sidebarColorsElements = document.querySelectorAll('[data-setting="sidebar"][data-name="sidebar-color"]');
    Array.from(sidebarColorsElements, (mode) => {
        mode.addEventListener('click', (e) => {
            Array.from(sidebarColorsElements, (el) => {
                el.classList.remove('active');
                document.querySelectorAll('.sidebar, .sidebar-default').forEach(sb => sb.classList.remove(el.getAttribute('data-value')));
            });
            const val = mode.getAttribute('data-value');
            setSetting('sidebar', val);
            mode.classList.add('active');
            changeMode('sidebar', val);
        });
    });

    // Sidebar type style Click Listener
    const sidebarTypesElements = document.querySelectorAll('[data-setting="sidebar"][data-name="sidebar-type"]');
    Array.from(sidebarTypesElements, (sidebarType) => {
        sidebarType.addEventListener('click', (e) => {
            const sidebars = document.querySelectorAll('.sidebar, .sidebar-default');
            const val = sidebarType.getAttribute('data-value');
            const extraVal = sidebarType.getAttribute('data-extra-value');

            if (sidebarType.classList.contains('active')) {
                sidebarType.classList.remove('active');
                sidebars.forEach(sb => sb.classList.remove(val));
                const idx = sidebarTypeSetting.indexOf(val);
                if (idx !== -1) sidebarTypeSetting.splice(idx, 1);
                if (extraVal) {
                    sidebars.forEach(sb => sb.classList.remove(extraVal));
                    document.querySelectorAll(`[data-value="${extraVal}"]`).forEach(el => el.classList.remove('active'));
                    const extraIdx = sidebarTypeSetting.indexOf(extraVal);
                    if (extraIdx !== -1) sidebarTypeSetting.splice(extraIdx, 1);
                }
            } else {
                document.querySelectorAll(`[data-value="${val}"]`).forEach(el => el.classList.add('active'));
                sidebars.forEach(sb => sb.classList.add(val));
                if (sidebarTypeSetting.indexOf(val) === -1) sidebarTypeSetting.push(val);
                if (extraVal) {
                    sidebars.forEach(sb => sb.classList.add(extraVal));
                    document.querySelectorAll(`[data-value="${extraVal}"]`).forEach(el => el.classList.add('active'));
                    if (sidebarTypeSetting.indexOf(extraVal) === -1) sidebarTypeSetting.push(extraVal);
                }
            }
            setSetting('sidebarType', JSON.stringify(sidebarTypeSetting));
        });
    });

    // Sidebar Active Style Click Listener
    const allActiveTypeElements = document.querySelectorAll('[data-setting="sidebar"][data-name="sidebar-item"]');
    Array.from(allActiveTypeElements, (activeStyle) => {
        activeStyle.addEventListener('click', (e) => {
            const val = activeStyle.getAttribute('data-value');
            Array.from(allActiveTypeElements, (el) => {
                el.classList.remove('active');
                document.querySelectorAll('.sidebar, .sidebar-default').forEach(sb => sb.classList.remove(el.getAttribute('data-value')));
            });
            setSetting('sidebar-style', val);
            activeStyle.classList.add('active');
            document.querySelectorAll(`[data-value="${val}"]`).forEach(el => el.classList.add('active'));
            changeMode('sidebar-style', val);
        });
    });

    // Navbar Style Click Listener
    const allNavbarTypeElements = document.querySelectorAll('[data-setting="navbar"][data-name="navbar-type"]');
    Array.from(allNavbarTypeElements, (navbarType) => {
        navbarType.addEventListener('click', (e) => {
            Array.from(allNavbarTypeElements, (el) => {
                el.classList.remove('active');
                const targetEl = document.querySelector(el.getAttribute('data-target'));
                if (targetEl) targetEl.classList.remove(el.getAttribute('data-value'));
            });
            const val = navbarType.getAttribute('data-value');
            const target = navbarType.getAttribute('data-target');
            setSetting('navbarTypes', val);
            document.querySelectorAll(`[data-value="${val}"]`).forEach(el => el.classList.add('active'));
            const targetEl = document.querySelector(target);
            if (targetEl) targetEl.classList.add(val);
        });
    });

    // Navbar default style Click Listener
    const defaultNavbarType = document.querySelector('[data-setting="navbar"][data-name="navbar-default"]');
    if (defaultNavbarType !== null) {
        defaultNavbarType.addEventListener("click", (e) => {
            const nav = document.querySelector('.iq-navbar');
            if (nav) nav.classList.remove('nav-glass', 'navs-sticky', 'navs-transparent');
            const header = document.querySelector('.iq-navbar-header');
            if (header) header.classList.remove('navs-bg-color');
            setSetting('navbarTypes', 'default');
        });
    }

    // Color Presets (Color Customizer)
    const customizerMode = (custombodyclass, colors, colorInfo) => {
        document.querySelector('html').setAttribute('data-bs-theme-color', `${custombodyclass}`);
        setSetting('colorcustom-mode', custombodyclass);
        setSetting('colorcustominfo-mode', colors || '');
        
        try {
            const primaryColor = getComputedStyle(document.body).getPropertyValue('--bs-primary');
            setSetting('colorcustomchart-mode', primaryColor);
            if (colors) document.documentElement.style.setProperty('--bs-secondary', colors);
            const color = getSetting('colorcustomchart-mode');
            const event = new CustomEvent("ColorChange", { detail: { detail1: (color || colorInfo || '').trim(), detail2: (colors || '').trim() } });
            document.dispatchEvent(event);
        } catch(e) {}

        const elements = document.querySelectorAll('[data-setting="color-mode1"][data-name="color"]');
        Array.from(elements, (mode) => {
            if (mode.getAttribute('data-value') === custombodyclass) {
                mode.classList.add('active');
            } else {
                mode.classList.remove('active');
            }
        });
    };

    const colorElements = document.querySelectorAll('[data-setting="color-mode1"][data-name="color"]');
    Array.from(colorElements, (mode) => {
        mode.addEventListener('click', (e) => {
            const val = mode.getAttribute('data-value');
            const colors = mode.getAttribute('data-info');
            customizerMode(val, colors, colors);
        });
    });

    // Initialize custom color on load
    const savedCustomColor = getSetting('colorcustom-mode');
    const savedColors = getSetting('colorcustominfo-mode');
    const savedChartColor = getSetting('colorcustomchart-mode');
    if (savedCustomColor) {
        customizerMode(savedCustomColor, savedColors, savedChartColor);
    }

    // Ensure no dark backdrop overlay ever appears when offcanvas settings is opened
    const offcanvasEl = document.getElementById('offcanvasExample');
    if (offcanvasEl) {
        const removeBackdrop = () => {
            document.querySelectorAll('.offcanvas-backdrop, .modal-backdrop').forEach(el => el.remove());
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
        };
        offcanvasEl.addEventListener('show.bs.offcanvas', removeBackdrop);
        offcanvasEl.addEventListener('shown.bs.offcanvas', removeBackdrop);
        offcanvasEl.addEventListener('hide.bs.offcanvas', removeBackdrop);
        offcanvasEl.addEventListener('hidden.bs.offcanvas', removeBackdrop);
    }

})();
