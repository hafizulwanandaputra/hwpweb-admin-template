<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title . ' - ' . $systemName ?></title>
    <!-- 
    UNCOMMENT IF YOU WANT TO USE AS PWA 
    - Set up your PWA application in public/manifest.json
    - Set up your PWA service worker in public/service-worker.js
    -->
    <link rel="manifest" href="<?= base_url(); ?>/manifest.json">
    <meta name="theme-color" content="#e9ecef">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="<?= base_url(); ?>assets/css/dashboard/dashboard.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/main.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/JawiDubai.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="<?= base_url(); ?>assets/fonts/IosevkaHwpMono/IosevkaHwpMono.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/fonts/base-font.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/fontawesome/css/all.css" rel="stylesheet">
    <script src="<?= base_url(); ?>assets/tinymce/js/tinymce/tinymce.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script>
        (() => {
            'use strict'

            const getStoredTheme = () => localStorage.getItem('theme');
            const setStoredTheme = theme => localStorage.setItem('theme', theme);

            const getPreferredTheme = () => {
                const storedTheme = getStoredTheme();
                if (storedTheme) {
                    return storedTheme;
                }

                return 'auto';
            };

            const setTheme = theme => {
                let themeColor = '';
                let isDarkMode = theme === 'auto' ? window.matchMedia('(prefers-color-scheme: dark)').matches : theme === 'dark';

                if (isDarkMode) {
                    $('html').attr('data-bs-theme', 'dark');
                    themeColor = '#343a40';
                } else {
                    $('html').attr('data-bs-theme', theme);
                    themeColor = '#e9ecef';
                }
                $('meta[name="theme-color"]').attr('content', themeColor);

                const colorSettings = {
                    color: isDarkMode ? "#FFFFFF" : "#000000",
                    borderColor: isDarkMode ? "rgba(255,255,255,0.1)" : "rgba(0,0,0,0.1)",
                    backgroundColor: isDarkMode ? "rgba(255,255,0,0.1)" : "rgba(0,255,0,0.1)",
                    lineBorderColor: isDarkMode ? "rgba(255,255,0,0.4)" : "rgba(0,255,0,0.4)",
                    gridColor: isDarkMode ? "rgba(255,255,255,0.2)" : "rgba(0,0,0,0.2)"
                };

                if (typeof chartInstances !== 'undefined') {
                    chartInstances.forEach(chart => {
                        if (chart.options.scales) {
                            if (chart.options.scales.x) {
                                if (chart.options.scales.x.ticks) {
                                    chart.options.scales.x.ticks.color = colorSettings.color;
                                }
                                if (chart.options.scales.x.title) {
                                    chart.options.scales.x.title.color = colorSettings.color;
                                }
                                if (chart.options.scales.x.grid) {
                                    chart.options.scales.x.grid.color = colorSettings.gridColor;
                                }
                            }

                            if (chart.options.scales.y) {
                                if (chart.options.scales.y.ticks) {
                                    chart.options.scales.y.ticks.color = colorSettings.color;
                                }
                                if (chart.options.scales.y.title) {
                                    chart.options.scales.y.title.color = colorSettings.color;
                                }
                                if (chart.options.scales.y.grid) {
                                    chart.options.scales.y.grid.color = colorSettings.gridColor;
                                }
                            }
                        }

                        if (chart.options.elements && chart.options.elements.line) {
                            chart.options.elements.line.borderColor = colorSettings.lineBorderColor;
                        }

                        if ((chart.config.type === 'doughnut' || chart.config.type === 'pie') && chart.options.plugins && chart.options.plugins.legend) {
                            chart.options.plugins.legend.labels.color = colorSettings.color;
                        }

                        chart.update();
                    });
                }
            };

            setTheme(getPreferredTheme());

            const showActiveTheme = (theme, focus = false) => {
                const themeSwitcher = $('#bd-theme');

                if (!themeSwitcher.length) {
                    return;
                }

                const themeSwitcherText = $('#bd-theme-text');
                const activeThemeIcon = $('.theme-icon-active use');
                const btnToActive = $(`[data-bs-theme-value="${theme}"]`);

                $('[data-bs-theme-value]').removeClass('active').attr('aria-pressed', 'false');
                btnToActive.addClass('active').attr('aria-pressed', 'true');

                if (focus) {
                    themeSwitcher.focus();
                }
            };

            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                const storedTheme = getStoredTheme();
                if (storedTheme !== 'light' && storedTheme !== 'dark') {
                    setTheme(getPreferredTheme());
                }
            });

            $(document).ready(() => {
                showActiveTheme(getPreferredTheme());

                $('[data-bs-theme-value]').on('click', function() {
                    const theme = $(this).attr('data-bs-theme-value');
                    setStoredTheme(theme);
                    setTheme(theme);
                    showActiveTheme(theme, true);
                });
            });
        })();
    </script>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            overflow: auto;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            height: 100%;
            /* Use viewport height to ensure full height */
        }

        .header {
            flex-shrink: 0;
            /* Prevent header from shrinking */
        }

        .main-content-wrapper {
            display: flex;
            flex: 1;
            /* Allows this container to grow and fill the remaining space */
            overflow: hidden;
            /* Prevents overflow from affecting the container's size */
            padding-left: calc(var(--bs-gutter-x) * .5);
            padding-right: calc(var(--bs-gutter-x) * .5);
        }

        .toast-container {
            padding-top: calc(3rem + 1rem) !important;
            right: 0 !important;
        }

        .sidebar {
            box-shadow: inset 0px 0 0 rgba(0, 0, 0, 0);
            border-right: 1px solid var(--bs-border-color);
            height: 100%;
            overflow: auto;
        }

        .main-content {
            flex: 1;
            /* Allows the content area to grow and fill remaining space */
            overflow: auto;
            /* Enables scrolling in the content area */
        }

        .main-content-inside {
            margin-left: 220px;
        }

        #sidebarMenu,
        #sidebarHeader {
            max-width: 220px;
            min-width: 220px;
        }

        .profilephotosidebar {
            background-color: var(--bs-body-bg);
            width: 32px;
            aspect-ratio: 1/1;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            outline: 1px solid var(--bs-body-bg);
            box-shadow: 0 0 0 2px var(--bs-secondary);
        }

        .profilephotosidebar svg {
            fill: var(--bs-body-color);
            /* Bootstrap white color */
        }

        div.dataTables_processing>div:last-child {
            display: none;
        }

        div.dataTables_wrapper div.dataTables_processing.card {
            position: fixed;
            margin: 0 !important;
            z-index: 999;
            top: 50% !important;
            left: 50% !important;
            transform: translate(-50%, -50%) !important;
            --bs-bg-opacity: 1;
            backdrop-filter: none;
            background-color: rgba(var(--bs-body-bg-rgb), var(--bs-bg-opacity)) !important;
            border: 1px solid var(--bs-border-color-translucent);
            box-shadow: var(--bs-box-shadow) !important;
            border-radius: var(--bs-border-radius) !important;
        }

        table.dataTable {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }

        .modal-body div.dataTables_wrapper div.dataTables_processing.card {
            background-color: rgba(var(--bs-body-bg-rgb), var(--bs-bg-opacity)) !important;
            --bs-bg-opacity: 1;
            backdrop-filter: none;
        }

        .two-column-list {
            columns: 2;
            /* Creates two columns */
            -webkit-columns: 2;
            /* For Safari and older browsers */
            -moz-columns: 2;
            /* For Firefox */
        }

        .two-column-list li {
            break-inside: avoid-column;
            /* Prevents items from breaking between columns */
            word-break: break-all;
        }

        .card {
            --bs-card-border-color: var(--bs-border-color);
        }

        @media (prefers-reduced-transparency: no-preference) {
            div.dataTables_wrapper div.dataTables_processing.card {
                --bs-bg-opacity: 0.75;
                backdrop-filter: blur(20px);
            }
        }

        .no-fluid-content {
            --bs-gutter-x: 0;
            --bs-gutter-y: 0;
            width: 100%;
            padding-right: calc(var(--bs-gutter-x) * 0.5);
            padding-left: calc(var(--bs-gutter-x) * 0.5);
            margin-right: auto;
            margin-left: auto;
            max-width: 960px;
        }

        .no-caret::after {
            display: none;
        }

        @media (max-width: 767.98px) {
            .toast-container {
                padding-top: calc(6rem + 1rem) !important;
                transform: translateX(-50%) !important;
                left: 50% !important;
            }

            .main-content-inside {
                margin-left: 0;
            }

            .sidebar {
                top: 3rem;
                border-right: 0px solid var(--bs-border-color);
                width: 100%;
            }

            #sidebarMenu2 {
                height: calc(100% - 3rem);
                padding-top: 0;
            }

            #sidebarMenu {
                max-width: 100%;
                min-width: 0;
                opacity: 0;
                transition: opacity 0.25s ease-out, transform 0.25s ease-out;
                transform: translateY(-10px);
            }

            #sidebarHeader {
                max-width: 100%;
                min-width: 0;
            }

            #sidebarMenu.show {
                opacity: 1;
                transform: translateY(0);
            }

            @media (prefers-reduced-motion: reduce) {
                #sidebarMenu {
                    transition: none;
                }
            }
        }
    </style>
    <?= $this->include('spinner/spinner-css'); ?>
    <?= $this->renderSection('header'); ?>
</head>

<body class="bg-body-hwpweb">
    <div class="wrapper">
        <!-- HEADER -->
        <header class="navbar bg-body-secondary sticky-top flex-md-nowrap p-0 shadow-sm header" style="border-bottom: 1px solid var(--bs-border-color);">
            <div id="sidebarHeader" class="d-flex justify-content-center align-items-center px-3 py-md-1" style="min-height: 3rem; max-height: 3rem;">
                <span class="navbar-brand mx-0 fs-6 text-start text-md-center lh-1">
                    My Admin Panel
                </span>
            </div>
            <button type="button" class="btn btn-outline-secondary bg-gradient d-md-none mx-3" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation"><i class="fa-solid fa-bars"></i></button>
            <div class="d-flex w-100 align-items-center text-truncate" style="min-height: 3rem; max-height: 3rem;">
                <div class="w-100 ps-3 pe-1 pe-lg-2 text-truncate" style="flex: 1; min-width: 0;">
                    <?= $this->renderSection('title'); ?>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="vr d-none d-lg-block border-success-subtle" style="height: 2.5rem;"></div>
                </div>
                <div class="me-3 ms-1 ms-lg-3">
                    <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none" data-bs-toggle="offcanvas" data-bs-target="#userOffcanvas" role="button" aria-controls="userOffcanvas">
                        <div class="me-2 d-none d-lg-block text-end">
                            <div class="d-flex flex-column">
                                <div class="text-nowrap fw-medium lh-sm" style="font-size: 0.75em;"><?= session()->get('fullname') ?></div>
                                <div class="text-nowrap lh-sm" style="font-size: 0.7em;">@<?= session()->get('username') ?> • <span class="date"><?= $_SERVER['REMOTE_ADDR'] ?></span></div>
                            </div>
                        </div>
                        <div class="rounded-pill bg-body profilephotosidebar d-flex justify-content-center align-items-center" style="min-height: 2rem; max-height: 2rem; min-width: 2rem; max-width: 2rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM14 14s-1-4-6-4-6 4-6 4 1 0 6 0 6 0 6 0z" />
                            </svg>
                        </div>
                    </a>

                    <div class="offcanvas offcanvas-end bg-body-tertiary shadow-sm transparent-blur" tabindex="-1" id="userOffcanvas" aria-labelledby="userOffcanvasLabel">
                        <div class="offcanvas-header pt-0 pb-0 d-flex justify-content-between">
                            <div class="d-flex align-items-center col-md-3 col-lg-2 me-0 py-md-1" style="min-height: 3rem; max-height: 3rem;">
                                <span class="navbar-brand mx-0 fs-6 lh-1">
                                    My Admin Panel
                                </span>
                            </div>
                            <div class="d-flex flex-row">
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary bg-gradient dropdown-toggle" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" data-bs-display="static" aria-label="Toggle theme (auto)">
                                        <i class="fa-solid fa-palette"></i>
                                    </button>
                                    <ul class="dropdown-menu shadow-sm dropdown-menu-end bg-body-tertiary transparent-blur" aria-labelledby="bd-theme-text">
                                        <li>
                                            <button type="button" class="dropdown-item" data-bs-theme-value="light" aria-pressed="false">
                                                Light
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item" data-bs-theme-value="dark" aria-pressed="false">
                                                Dark
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item active" data-bs-theme-value="auto" aria-pressed="true">
                                                System
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <button id="closeOffcanvasBtn" type="button" class="btn btn-secondary bg-gradient ms-2" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-angles-right"></i></button>
                            </div>
                        </div>
                        <div class="offcanvas-body p-1">
                            <div class="d-flex justify-content-center">
                                <div class="rounded-pill bg-body profilephotosidebar m-2 d-flex justify-content-center align-items-center" style="width: 96px; height: 96px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM14 14s-1-4-6-4-6 4-6 4 1 0 6 0 6 0 6 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="text-center w-100 lh-sm mb-3">
                                <span>
                                    <?= session()->get('fullname'); ?><br>
                                    <span style="font-size: 0.85em;">@<?= session()->get('username'); ?></span><br>
                                    <span style="font-size: 0.75em;"><?= session()->get('role'); ?></span><br>
                                    <span class="date" style="font-size: 0.75em;">IP address: <?= $_SERVER['REMOTE_ADDR'] ?></span><br>
                                    <span class="date" style="font-size: 0.75em;">Login time: <?= session()->get('created_at'); ?></span><br>
                                    <span class="date" style="font-size: 0.75em;">Expires: <?= session()->get('expires_at'); ?></span>
                                </span>
                            </div>
                            <hr class="my-1">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a style="font-size: 0.95em;" class="nav-link nav-link-offcanvas px-2 py-1" href="<?= base_url('/settings'); ?>">
                                        <div class="d-flex align-items-start">
                                            <div style="min-width: 24px; max-width: 24px; text-align: center;">
                                                <i class="fa-solid fa-gear"></i>
                                            </div>
                                            <div class="flex-fill ms-2 link-body-emphasis">
                                                Settings
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a style="font-size: 0.95em;" id="logoutButton" class="nav-link px-2 py-1" href="#">
                                        <div class="d-flex align-items-start text-danger">
                                            <div style="min-width: 24px; max-width: 24px; text-align: center;">
                                                <i class="fa-solid fa-right-from-bracket"></i>
                                            </div>
                                            <div class="flex-fill ms-2 link-body-emphasis">
                                                Logout
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="modal modal-sheet p-4 py-md-5 fade" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex=" -1" aria-labelledby="logoutModal" aria-hidden="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content bg-body-tertiary rounded-5 shadow-lg transparent-blur">
                    <div class="modal-body p-4">
                        <h5 class="mb-0" id="logoutMessage">Do you want to logout?</h5>
                        <div class="row gx-2 pt-4">
                            <div class="col d-grid">
                                <button type="button" class="btn btn-lg btn-body bg-gradient fs-6 mb-0 rounded-4" data-bs-dismiss="modal">No</button>
                            </div>
                            <div class="col d-grid">
                                <button type="button" class="btn btn-lg btn-primary bg-gradient fs-6 mb-0 rounded-4" id="confirmLogout" onclick="window.location.href='<?= base_url('/logout'); ?>';">Yes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONTENTS -->
        <div class="main-content-wrapper">
            <nav id="sidebarMenu" class="d-md-block bg-body-secondary sidebar shadow-sm collapse transparent-blur">
                <div id="sidebarMenu2" class="position-sticky sidebar-sticky p-1">
                    <ul class="nav nav-pills flex-column">
                        <!-- Place Menu Here -->
                        <li class="nav-item">
                            <a style="font-size: 0.95em;" class="nav-link px-2 py-1 <?= (strpos(uri_string(), 'home') === 0) ? 'active' : '' ?>" href="<?= base_url('/home'); ?>" onclick="showSpinner()">
                                <div class="d-flex align-items-start">
                                    <div <?= (strpos(uri_string(), 'home') === 0) ? 'class="text-white"' : '' ?> style="min-width: 24px; max-width: 24px; text-align: center;">
                                        <i class="fa-solid fa-house"></i>
                                    </div>
                                    <div class="flex-fill ms-2 <?= (strpos(uri_string(), 'home') === 0) ? 'text-white' : 'link-body-emphasis' ?>">
                                        Home
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a style="font-size: 0.95em;" class="nav-link px-2 py-1 <?= (strpos(uri_string(), 'examples') === 0) ? 'active' : '' ?>" href="<?= base_url('/examples'); ?>" onclick="showSpinner()">
                                <div class="d-flex align-items-start">
                                    <div <?= (strpos(uri_string(), 'examples') === 0) ? 'class="text-white"' : '' ?> style="min-width: 24px; max-width: 24px; text-align: center;">
                                        <i class="fa-solid fa-database"></i>
                                    </div>
                                    <div class="flex-fill ms-2 <?= (strpos(uri_string(), 'examples') === 0) ? 'text-white' : 'link-body-emphasis' ?>">
                                        Example CRUD
                                    </div>
                                </div>
                            </a>
                        </li>
                        <?php if (session()->get('role') == 'Administrator') : ?>
                            <li class="nav-item">
                                <a style="font-size: 0.95em;" class="nav-link px-2 py-1 <?= (strpos(uri_string(), 'users') === 0) ? 'active' : '' ?>" href="<?= base_url('/users'); ?>" onclick="showSpinner()">
                                    <div class="d-flex align-items-start">
                                        <div <?= (strpos(uri_string(), 'users') === 0) ? 'class="text-white"' : '' ?> style="min-width: 24px; max-width: 24px; text-align: center;">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                        <div class="flex-fill ms-2 <?= (strpos(uri_string(), 'users') === 0) ? 'text-white' : 'link-body-emphasis' ?>">
                                            Users
                                        </div>
                                    </div>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
            <main class="main-content">
                <?= $this->renderSection('content'); ?>
            </main>
        </div>
        <div id="toastContainer" class="toast-container position-fixed top-0 p-3" aria-live="polite" aria-atomic="true">
            <?php if (session()->getFlashdata('info')) : ?>
                <div id="infoToast" class="toast align-items-center text-bg-info border border-info transparent-blur" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-body d-flex align-items-start">
                        <div style="width: 24px; text-align: center;">
                            <i class="fa-solid fa-circle-info"></i>
                        </div>
                        <div class="w-100 mx-2 text-start">
                            <?= session()->getFlashdata('info'); ?>
                        </div>
                        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('msg')) : ?>
                <div id="msgToast" class="toast align-items-center text-bg-success border border-success transparent-blur" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-body d-flex align-items-start">
                        <div style="width: 24px; text-align: center;">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <div class="w-100 mx-2 text-start">
                            <?= session()->getFlashdata('msg'); ?>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div id="errorToast" class="toast align-items-center text-bg-danger border border-danger transparent-blur" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-body d-flex align-items-start">
                        <div style="width: 24px; text-align: center;">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </div>
                        <div class="w-100 mx-2 text-start">
                            <?= session()->getFlashdata('error'); ?>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            <?php endif; ?>
            <?= $this->renderSection('toast'); ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>assets/fontawesome/js/all.js"></script>
    <script src="<?= base_url(); ?>assets/js/dashboard/dashboard.js"></script>
    <?= $this->renderSection('javascript'); ?>
    <?= $this->renderSection('datatable'); ?>
    <?= $this->renderSection('tinymce'); ?>
    <?= $this->renderSection('chartjs'); ?>
    <?= $this->renderSection('imgupload'); ?>
    <script>
        function showSpinner() {
            $('#loadingSpinner').show();
        }
        $(window).on('beforeunload', function() {
            showSpinner();
        });
        $(document).on('click', '#confirmLogout', function() {
            $('#logoutModal button').prop('disabled', true);
            $('#logoutMessage').html(`Please wait...`);
        });
        $(document).ready(function() {
            $('.nav-link-offcanvas-ext').on('click', function(e) {
                const offcanvasInstance = bootstrap.Offcanvas.getInstance($('#userOffcanvas')[0]);
                if (offcanvasInstance) {
                    e.preventDefault(); // Prevent the immediate navigation

                    offcanvasInstance.hide(); // Hide the offcanvas

                    // Get the target URL from the clicked link
                    const targetUrl = $(this).attr('href');

                    // Once the offcanvas is hidden, navigate to the settings page
                    $('#userOffcanvas').one('hidden.bs.offcanvas', function() {
                        window.open(targetUrl, '_blank'); // Open the URL in a new tab
                    });
                }
            });
            $('.nav-link-offcanvas').on('click', function(e) {
                const offcanvasInstance = bootstrap.Offcanvas.getInstance($('#userOffcanvas')[0]);
                if (offcanvasInstance) {
                    e.preventDefault(); // Prevent the immediate navigation

                    offcanvasInstance.hide(); // Hide the offcanvas

                    // Get the target URL from the clicked link
                    const targetUrl = $(this).attr('href');

                    // Once the offcanvas is hidden, navigate to the settings page
                    $('#userOffcanvas').one('hidden.bs.offcanvas', function() {
                        window.location.href = targetUrl;
                    });
                }
            });
            $('#logoutButton').on('click', function(e) {
                e.preventDefault(); // Prevent default anchor behavior

                const offcanvasInstance = bootstrap.Offcanvas.getInstance($('#userOffcanvas')[0]);
                if (offcanvasInstance) {
                    offcanvasInstance.hide();

                    // Attach the event listener only once for the next time offcanvas is hidden
                    $('#userOffcanvas').one('hidden.bs.offcanvas', function() {
                        $('#logoutModal').modal('show');
                    });
                }
            });
            // Show toast messages if they exist
            if ($('#infoToast').length) {
                var infoToast = new bootstrap.Toast($('#infoToast')[0]);
                infoToast.show();
            }

            if ($('#msgToast').length) {
                var msgToast = new bootstrap.Toast($('#msgToast')[0]);
                msgToast.show();
            }

            if ($('#errorToast').length) {
                var errorToast = new bootstrap.Toast($('#errorToast')[0]);
                errorToast.show();
            }

            setTimeout(function() {
                if ($('#infoToast').length) {
                    var infoToast = new bootstrap.Toast($('#infoToast')[0]);
                    infoToast.hide();
                }

                if ($('#msgToast').length) {
                    var msgToast = new bootstrap.Toast($('#msgToast')[0]);
                    msgToast.hide();
                }

                if ($('#errorToast').length) {
                    var errorToast = new bootstrap.Toast($('#errorToast')[0]);
                    errorToast.hide();
                }
            }, 5000);
        });
    </script>
</body>

</html>