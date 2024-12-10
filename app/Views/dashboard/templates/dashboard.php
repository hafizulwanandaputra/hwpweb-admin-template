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
    <meta name="theme-color" content="#e9ecef" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#2b3035" media="(prefers-color-scheme: dark)">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="<?= base_url(); ?>assets/css/dashboard/dashboard.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/main.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/JawiDubai.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Color+Emoji&family=Noto+Sans+Arabic:wdth,wght@62.5..100,100..900&family=Noto+Sans+Mono:wdth,wght@62.5..100,100..900&family=Noto+Sans:ital,wdth,wght@0,62.5..100,100..900;1,62.5..100,100..900&display=swap" rel="stylesheet">
    <link href="<?= base_url() ?>assets/fonts/inter-hwp/inter-hwp.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/fonts/base-font.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/fontawesome/css/all.css" rel="stylesheet">
    <script src="<?= base_url(); ?>assets/tinymce/js/tinymce/tinymce.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <style>
        /* Custom Scrollbar Styles */
        html {
            scrollbar-width: thin;
            /* For Firefox */
            scrollbar-color: var(--bs-secondary-color) var(--bs-border-color-translucent);
        }

        ::-webkit-scrollbar {
            width: 16px;
            height: 16px;
        }

        ::-webkit-scrollbar-track {
            background-color: var(--bs-border-color-translucent);
        }

        ::-webkit-scrollbar-thumb {
            background-color: var(--bs-secondary-color);
            border-radius: 10px;
            border: 4px solid var(--bs-border-color-translucent);
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: var(--bs-secondary-color);
        }

        ::-webkit-scrollbar-button:single-button {
            background-color: var(--bs-secondary-color);
            border: 1px solid var(--bs-border-color-translucent);
            width: 16px;
            height: 16px;
        }

        ::-webkit-scrollbar-button:single-button:vertical:decrement {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23ffffff" viewBox="0 0 16 16"><path d="M4 10l4-4 4 4H4z"/></svg>');
            background-repeat: no-repeat;
            background-position: center;
        }

        ::-webkit-scrollbar-button:single-button:vertical:increment {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23ffffff" viewBox="0 0 16 16"><path d="M12 6L8 10 4 6h8z"/></svg>');
            background-repeat: no-repeat;
            background-position: center;
        }

        ::-webkit-scrollbar-button:single-button:horizontal:decrement {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23ffffff" viewBox="0 0 16 16"><path d="M10 12l-4-4 4-4v8z"/></svg>');
            background-repeat: no-repeat;
            background-position: center;
        }

        ::-webkit-scrollbar-button:single-button:horizontal:increment {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23ffffff" viewBox="0 0 16 16"><path d="M6 4l4 4-4 4V4z"/></svg>');
            background-repeat: no-repeat;
            background-position: center;
        }

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
            padding-top: 4rem !important;
            right: 0 !important;
        }

        .sidebar {
            box-shadow: inset 0px 0 0 rgba(0, 0, 0, 0);
            border-right: 1px solid var(--bs-border-color-translucent);
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
            background-color: rgba(var(--bs-body-bg-rgb), var(--bs-bg-opacity)) !important;
            --bs-bg-opacity: 0.6667;
            backdrop-filter: blur(20px);
            border: 1px solid var(--bs-border-color-translucent);
            box-shadow: var(--bs-box-shadow) !important;
            border-radius: var(--bs-border-radius-lg) !important;
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

        @media (prefers-reduced-transparency) {
            div.dataTables_wrapper div.dataTables_processing.card {
                --bs-bg-opacity: 1;
                backdrop-filter: none;
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
                padding-top: 7rem !important;
                transform: translateX(-50%) !important;
                left: 50% !important;
            }

            .main-content-inside {
                margin-left: 0;
            }

            .sidebar {
                top: 48px;
                backdrop-filter: blur(20px);
                --bs-bg-opacity: 0.6667;
                border-right: 0px solid var(--bs-border-color-translucent);
                width: 100%;
            }

            #sidebarMenu2 {
                height: calc(100vh - 96px);
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

            @media (prefers-reduced-transparency) {
                .sidebar {
                    --bs-bg-opacity: 1;
                    backdrop-filter: none;
                }
            }
        }
    </style>
    <?= $this->renderSection('header'); ?>
</head>

<body>
    <div class="wrapper">
        <!-- HEADER -->
        <header class="navbar bg-body-secondary sticky-top flex-md-nowrap p-0 shadow-sm header" style="border-bottom: 1px solid var(--bs-border-color-translucent);">
            <div id="sidebarHeader" class="d-flex justify-content-center align-items-center px-3 py-md-1" style="max-height: 48px; min-height: 48px;">
                <span class="navbar-brand mx-0 fs-6 text-start text-md-center lh-1">
                    My Admin Panel
                </span>
            </div>
            <button type="button" class="btn btn-outline-secondary bg-gradient d-md-none mx-3" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation"><i class="fa-solid fa-bars"></i></button>
            <div class="d-flex w-100 align-items-center text-truncate" style="min-height: 48px; max-height: 48px;">
                <div class="w-100 ps-3 pe-1 pe-lg-2 text-truncate" style="flex: 1; min-width: 0;">
                    <?= $this->renderSection('title'); ?>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="vr d-none d-lg-block border-success-subtle" style="height: 32px;"></div>
                </div>
                <div class="me-3 ms-1 ms-lg-3">
                    <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none" data-bs-toggle="offcanvas" data-bs-target="#userOffcanvas" role="button" aria-controls="userOffcanvas">
                        <div class="me-2 d-none d-lg-block text-end">
                            <div class="d-flex flex-column">
                                <div class="text-nowrap fw-medium lh-sm" style="font-size: 0.75em;"><?= session()->get('fullname') ?></div>
                                <div class="text-nowrap lh-sm" style="font-size: 0.7em;">@<?= session()->get('username') ?> • <span class="date"><?= $_SERVER['REMOTE_ADDR'] ?></span></div>
                            </div>
                        </div>
                        <div class="rounded-pill bg-body profilephotosidebar d-flex justify-content-center align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM14 14s-1-4-6-4-6 4-6 4 1 0 6 0 6 0 6 0z" />
                            </svg>
                        </div>
                    </a>

                    <div class="offcanvas offcanvas-end bg-body-tertiary shadow-sm transparent-blur" tabindex="-1" id="userOffcanvas" aria-labelledby="userOffcanvasLabel">
                        <div class="offcanvas-header pt-0 pb-0 d-flex justify-content-between">
                            <div class="d-flex align-items-center col-md-3 col-lg-2 me-0 py-md-1" style="max-height: 48px; min-height: 48px; max-height: 48px;">
                                <span class="navbar-brand mx-0 fs-6 lh-1">
                                    My Admin Panel
                                </span>
                            </div>
                            <button id="closeOffcanvasBtn" type="button" class="btn btn-secondary bg-gradient" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-angles-right"></i></button>
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
                                    <a class="nav-link nav-link-offcanvas fw-medium p-2" href="<?= base_url('/settings'); ?>">
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
                                    <a id="logoutButton" class="nav-link fw-medium p-2" href="#">
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
                <div class="modal-content bg-body-tertiary rounded-4 shadow-lg transparent-blur">
                    <div class="modal-body p-4 text-center">
                        <h5 class="mb-0" id="logoutMessage">Do you want to logout?</h5>
                    </div>
                    <div class="modal-footer flex-nowrap p-0" style="border-top: 1px solid var(--bs-border-color-translucent);">
                        <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" data-bs-dismiss="modal" style="border-right: 1px solid var(--bs-border-color-translucent);">No</button>
                        <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" id="confirmLogout" onclick="window.location.href='<?= base_url('/logout'); ?>';">Yes</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- CONTENTS -->
        <div class="main-content-wrapper">
            <nav id="sidebarMenu" class="d-md-block bg-body-tertiary sidebar shadow-sm collapse">
                <div id="sidebarMenu2" class="position-sticky sidebar-sticky p-1">
                    <ul class="nav nav-pills flex-column">
                        <!-- Place Menu Here -->
                        <li class="nav-item">
                            <a class="nav-link p-2 <?= (strpos(uri_string(), 'home') === 0) ? 'active' : '' ?>" href="<?= base_url('/home'); ?>" onclick="showSpinner()">
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
                            <a class="nav-link p-2 <?= (strpos(uri_string(), 'examples') === 0) ? 'active' : '' ?>" href="<?= base_url('/examples'); ?>" onclick="showSpinner()">
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
                                <a class="nav-link p-2 <?= (strpos(uri_string(), 'users') === 0) ? 'active' : '' ?>" href="<?= base_url('/users'); ?>" onclick="showSpinner()">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
    <script>
        /*!
         * Color mode toggler for Bootstrap's docs (https://getbootstrap.com/)
         * Copyright 2011-2023 The Bootstrap Authors
         * Licensed under the Creative Commons Attribution 3.0 Unported License.
         */

        (() => {
            'use strict'

            const getStoredTheme = () => localStorage.getItem('theme')
            const setStoredTheme = theme => localStorage.setItem('theme', theme)

            const getPreferredTheme = () => {
                const storedTheme = getStoredTheme()
                if (storedTheme) {
                    return storedTheme
                }

                return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
            }

            const setTheme = theme => {
                if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    document.documentElement.setAttribute('data-bs-theme', 'dark')
                } else {
                    document.documentElement.setAttribute('data-bs-theme', theme)
                }
            }

            setTheme(getPreferredTheme())

            const showActiveTheme = (theme, focus = false) => {
                const themeSwitcher = document.querySelector('#bd-theme')

                if (!themeSwitcher) {
                    return
                }

                const themeSwitcherText = document.querySelector('#bd-theme-text')
                const activeThemeIcon = document.querySelector('.theme-icon-active use')
                const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
                const svgOfActiveBtn = btnToActive.querySelector('svg use').getAttribute('href')

                document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
                    element.classList.remove('active')
                    element.setAttribute('aria-pressed', 'false')
                })

                btnToActive.classList.add('active')
                btnToActive.setAttribute('aria-pressed', 'true')
                activeThemeIcon.setAttribute('href', svgOfActiveBtn)
                const themeSwitcherLabel = `${themeSwitcherText.textContent} (${btnToActive.dataset.bsThemeValue})`
                themeSwitcher.setAttribute('aria-label', themeSwitcherLabel)

                if (focus) {
                    themeSwitcher.focus()
                }
            }

            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                const storedTheme = getStoredTheme()
                if (storedTheme !== 'light' && storedTheme !== 'dark') {
                    setTheme(getPreferredTheme())
                }
            })

            window.addEventListener('DOMContentLoaded', () => {
                showActiveTheme(getPreferredTheme())

                document.querySelectorAll('[data-bs-theme-value]')
                    .forEach(toggle => {
                        toggle.addEventListener('click', () => {
                            const theme = toggle.getAttribute('data-bs-theme-value')
                            setStoredTheme(theme)
                            setTheme(theme)
                            showActiveTheme(theme, true)
                        })
                    })
            })
        })()
    </script>
</body>

</html>