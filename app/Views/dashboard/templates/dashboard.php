<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?> - HWPWeb Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="<?= base_url(); ?>webadmin/assets/css/dashboard/dashboard.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/main.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/JawiDubai.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Color+Emoji&family=Noto+Sans+Arabic:wdth,wght@62.5..100,100..900&family=Noto+Sans+Mono:wdth,wght@62.5..100,100..900&family=Noto+Sans:ital,wdth,wght@0,62.5..100,100..900;1,62.5..100,100..900&display=swap" rel="stylesheet">
    <link href="<?= base_url() ?>assets/fonts/Geist-1.3.0/font-face.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/fonts/GeistMono-1.3.0/font-face.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/fonts/base-font/geist.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/fontawesome/css/all.css" rel="stylesheet">
    <script src="<?= base_url(); ?>webadmin/assets/tinymce/js/tinymce/tinymce.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <style>
        .toast-container {
            padding-top: 4rem !important;
            right: 0 !important;
        }

        .sidebar {
            top: 0;
            box-shadow: inset 0px 0 0 rgba(0, 0, 0, 0);
            border-right: 1px solid var(--bs-border-color-translucent);
            padding-top: 40px;
        }

        .profilephotosidebar {
            background-image: url('<?= base_url() . 'webadmin/images/profile/blank.jpg' ?>');
            background-color: var(--bs-body-bg);
            width: 32px;
            aspect-ratio: 1/1;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            outline: 3px solid var(--bs-body-bg);
            box-shadow: 0 0 0 4px var(--bs-border-color);
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

        .modal-body div.dataTables_wrapper div.dataTables_processing.card {
            background-color: rgba(var(--bs-body-bg-rgb), var(--bs-bg-opacity)) !important;
            --bs-bg-opacity: 1;
            backdrop-filter: none;
        }

        @media (prefers-reduced-transparency) {
            div.dataTables_wrapper div.dataTables_processing.card {
                --bs-bg-opacity: 1;
                backdrop-filter: none;
            }
        }

        @media (max-width: 767.98px) {
            .toast-container {
                padding-top: 6.5rem !important;
                transform: translateX(-50%) !important;
                left: 50% !important;
            }

            .sidebar {
                padding-top: 5.5rem;
                backdrop-filter: blur(20px);
                --bs-bg-opacity: 0.6667;
                border-right: 0px solid var(--bs-border-color-translucent);
            }

            @media (prefers-reduced-transparency) {
                .sidebar {
                    --bs-bg-opacity: 1;
                    backdrop-filter: none;
                }
            }
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <header class="navbar bg-body-secondary sticky-top flex-md-nowrap p-0 shadow-sm" style="border-bottom: 1px solid var(--bs-border-color-translucent);">
        <div class="d-flex justify-content-center align-items-center col-md-3 col-lg-2 me-0 px-3 py-md-1" style="min-height: 48px;">
            <span class="navbar-brand mx-0 fs-6 text-start text-md-center lh-1">
                My Admin Panel
            </span>
        </div>
        <button class="navbar-toggler position-absolute d-md-none bg-gradient rounded-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex flex-nowrap w-100 align-items-center" style="min-height: 48px;">
            <div class="w-100 ps-3 pe-1 text-truncate">
                <?= $this->renderSection('title'); ?>
            </div>
            <div class="dropdown mx-3">
                <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="rounded-pill bg-body profilephotosidebar me-2"></div>
                </a>
                <ul class="dropdown-menu rounded-3 dropdown-menu-end text-small shadow bg-body transparent-blur">
                    <li class="lh-1" style="padding: var(--bs-dropdown-item-padding-y) var(--bs-dropdown-item-padding-x);">
                        <span><?= session()->get('fullname'); ?></small><br><span class="fw-medium" style="font-size: 8pt;"><?= session()->get('role'); ?></span><br><span class="fw-medium" style="font-size: 8pt;">@<?= session()->get('username'); ?></span></span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="<?= base_url('/settings'); ?>">
                            <div class="d-flex align-items-start">
                                <span style="width: 32px; text-align: left;"><i class="fa-solid fa-gear"></i></span>
                                <span>Settings</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                            <div class="d-flex align-items-start">
                                <span style="width: 32px; text-align: left;"><i class="fa-solid fa-right-from-bracket"></i></span>
                                <span>Logout</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <div class="modal modal-sheet p-4 py-md-5 fade" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex=" -1" aria-labelledby="logoutModal" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-body rounded-4 shadow-lg transparent-blur">
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
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-body-tertiary sidebar shadow-sm collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column mb-auto">
                        <!-- Place Menu Here -->
                        <li class="nav-item">
                            <a class="nav-link p-2" href="<?= base_url('/home'); ?>">
                                <div class="d-flex align-items-start">
                                    <div style="min-width: 24px; max-width: 24px; text-align: center;">
                                        <i class="fa-solid fa-house"></i>
                                    </div>
                                    <div class="flex-fill ms-2 link-body-emphasis">
                                        Home
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link p-2" href="<?= base_url('/examples'); ?>">
                                <div class="d-flex align-items-start">
                                    <div style="min-width: 24px; max-width: 24px; text-align: center;">
                                        <i class="fa-solid fa-database"></i>
                                    </div>
                                    <div class="flex-fill ms-2 link-body-emphasis">
                                        Example CRUD
                                    </div>
                                </div>
                            </a>
                        </li>
                        <?php if (session()->get('role') == 'Administrator') : ?>
                            <li class="nav-item">
                                <a class="nav-link p-2" href="<?= base_url('/users'); ?>">
                                    <div class="d-flex align-items-start">
                                        <div style="min-width: 24px; max-width: 24px; text-align: center;">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                        <div class="flex-fill ms-2 link-body-emphasis">
                                            Users
                                        </div>
                                    </div>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>

            <?= $this->renderSection('content'); ?>
            <div id="toastContainer" class="toast-container position-fixed top-0 p-3" aria-live="polite" aria-atomic="true">
                <?php if (session()->getFlashdata('info')) : ?>
                    <div class="toast fade show align-items-center text-bg-info border border-info rounded-3 transparent-blur" role="alert" aria-live="assertive" aria-atomic="true">
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
                    <div class="toast fade show align-items-center text-bg-success border border-success rounded-3 transparent-blur" role="alert" aria-live="assertive" aria-atomic="true">
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
                    <div class="toast fade show align-items-center text-bg-danger border border-danger rounded-3 transparent-blur" role="alert" aria-live="assertive" aria-atomic="true">
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
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
            <script src="<?= base_url() ?>assets/fontawesome/js/all.js"></script>
            <script src="<?= base_url(); ?>webadmin/assets/js/dashboard/dashboard.js"></script>
            <?= $this->renderSection('javascript'); ?>
            <?= $this->renderSection('datatable'); ?>
            <?= $this->renderSection('tinymce'); ?>
            <?= $this->renderSection('chartjs'); ?>
            <?= $this->renderSection('imgupload'); ?>
            <script>
                $(document).on('click', '#confirmLogout', function() {
                    $('#logoutModal button').prop('disabled', true);
                    $('#logoutMessage').html(`Please wait...`);
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