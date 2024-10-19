<?php
$platform = $agent->getPlatform();
$iconClass = '';
$browser = $agent->getBrowser();
$browserIcon = '';

if (stripos($platform, 'Windows') !== false) {
    $iconClass = '<i class="fa-brands fa-windows"></i>';
} elseif (stripos($platform, 'Mac') !== false) {
    $iconClass = '<i class="fa-brands fa-apple"></i>';
} elseif (stripos($platform, 'Linux') !== false) {
    $iconClass = '<i class="fa-brands fa-linux"></i>';
} elseif (stripos($platform, 'Android') !== false) {
    $iconClass = '<i class="fa-brands fa-android"></i>';
} elseif (stripos($platform, 'iOS') !== false || stripos($platform, 'iPhone') !== false || stripos($platform, 'iPad') !== false) {
    $iconClass = '<i class="fa-brands fa-apple"></i>';
} else {
    $iconClass = '<i class="fa-solid fa-computer"></i>';
}

if (stripos($browser, 'Chrome') !== false) {
    $browserIcon = '<i class="fa-brands fa-chrome"></i>';
} elseif (stripos($browser, 'Firefox') !== false) {
    $browserIcon = '<i class="fa-brands fa-firefox-browser"></i>';
} elseif (stripos($browser, 'Safari') !== false) {
    $browserIcon = '<i class="fa-brands fa-safari"></i>';
} elseif (stripos($browser, 'Edge') !== false) {
    $browserIcon = '<i class="fa-brands fa-edge"></i>';
} elseif (stripos($browser, 'Opera') !== false || stripos($browser, 'OPR') !== false) {
    $browserIcon = '<i class="fa-brands fa-opera"></i>';
} elseif (stripos($browser, 'Internet Explorer') !== false || stripos($browser, 'IE') !== false) {
    $browserIcon = '<i class="fa-brands fa-internet-explorer"></i>';
} else {
    $browserIcon = '<i class="fa-solid fa-globe"></i>';
}
?>
<?= $this->extend('dashboard/templates/dashboard'); ?>
<?= $this->section('header'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jqueryVersion = $.fn.jquery;
        document.getElementById('jquery-version').innerHTML = `${jqueryVersion}`;
    });
</script>
<?= $this->endSection(); ?>
<?= $this->section('title'); ?>
<div class="d-flex justify-content-start align-items-center">
    <a class="fs-5 me-3" href="<?= base_url('/settings'); ?>"><i class="fa-solid fa-arrow-left"></i></a>
    <span class="fw-medium fs-5 flex-fill text-truncate">About This System</span>
    <div id="loadingSpinner" class="spinner-border spinner-border-sm" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<div style="min-width: 1px; max-width: 1px;"></div>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-3 px-md-4 pt-3">
    <h5>Client Information</h5>
    <ul class="list-group shadow-sm rounded-3 mb-3">
        <li class="list-group-item p-1 list-group-item-action disabled" aria-disabled="true">
            <div class="d-flex align-items-start">
                <a href="#" class="stretched-link" style="min-width: 48px; max-width: 48px; text-align: center;">
                    <p class="mb-0" style="font-size: 1.75rem!important;"><?= $iconClass; ?></p>
                </a>
                <div class="align-self-center flex-fill ps-1 text-wrap overflow-hidden" style="text-overflow: ellipsis;">
                    <h5 class="card-title">Operating System</h5>
                    <span><?= $agent->getPlatform(); ?></span>
                </div>
            </div>
        </li>
        <li class="list-group-item p-1 list-group-item-action disabled" aria-disabled="true">
            <div class="d-flex align-items-start">
                <a href="#" class="stretched-link" style="min-width: 48px; max-width: 48px; text-align: center;">
                    <p class="mb-0" style="font-size: 1.75rem!important;"><?= $browserIcon; ?></p>
                </a>
                <div class="align-self-center flex-fill ps-1 text-wrap overflow-hidden" style="text-overflow: ellipsis;">
                    <h5 class="card-title">Web Browser</h5>
                    <span><?= $agent->getBrowser() . ' ' . $agent->getVersion(); ?></span>
                </div>
            </div>
        </li>
        <?php if ($agent->isMobile()) : ?>
            <li class="list-group-item p-1 list-group-item-action disabled" aria-disabled="true">
                <div class="d-flex align-items-start">
                    <a href="#" class="stretched-link" style="min-width: 48px; max-width: 48px; text-align: center;">
                        <p class="mb-0" style="font-size: 1.75rem!important;"><i class="fa-solid fa-mobile-screen"></i></p>
                    </a>
                    <div class="align-self-center flex-fill ps-1 text-wrap overflow-hidden" style="text-overflow: ellipsis;">
                        <h5 class="card-title">Mobile Phone</h5>
                        <span><?= $agent->getMobile(); ?></span>
                    </div>
                </div>
            </li>
        <?php endif; ?>
        <li class="list-group-item p-1 list-group-item-action disabled" aria-disabled="true">
            <div class="d-flex align-items-start">
                <a href="#" class="stretched-link" style="min-width: 48px; max-width: 48px; text-align: center;">
                    <p class="mb-0" style="font-size: 1.75rem!important;"><i class="fa-solid fa-globe"></i></p>
                </a>
                <div class="align-self-center flex-fill ps-1 text-wrap overflow-hidden" style="text-overflow: ellipsis;">
                    <h5 class="card-title">Client IP Address</h5>
                    <span><?= $_SERVER['REMOTE_ADDR'] ?> via port <?= $_SERVER['REMOTE_PORT'] ?></span>
                </div>
            </div>
        </li>
        <li class="list-group-item p-1 list-group-item-action disabled" aria-disabled="true">
            <div class="d-flex align-items-start">
                <a href="#" class="stretched-link" style="min-width: 48px; max-width: 48px; text-align: center;">
                    <p class="mb-0" style="font-size: 1.75rem!important;"><i class="fa-solid fa-user-large"></i></p>
                </a>
                <div class="align-self-center flex-fill ps-1 text-wrap overflow-hidden" style="text-overflow: ellipsis;">
                    <h5 class="card-title">User Agent</h5>
                    <span><?= $agent->getAgentString(); ?></span>
                </div>
            </div>
        </li>
    </ul>
    <h5>Backend Information</h5>
    <ul class="list-group shadow-sm rounded-3 mb-3">
        <li class="list-group-item p-1 list-group-item-action disabled" aria-disabled="true">
            <div class="d-flex align-items-start">
                <a href="#" class="stretched-link" style="min-width: 48px; max-width: 48px; text-align: center;">
                    <p class="mb-0" style="font-size: 1.75rem!important;"><i class="fa-solid fa-server"></i></p>
                </a>
                <div class="align-self-center flex-fill ps-1 text-wrap overflow-hidden" style="text-overflow: ellipsis;">
                    <h5 class="card-title">Web Server</h5>
                    <span><?= $_SERVER['SERVER_SOFTWARE']; ?></span>
                </div>
            </div>
        </li>
        <li class="list-group-item p-1 list-group-item-action disabled" aria-disabled="true">
            <div class="d-flex align-items-start">
                <a href="#" class="stretched-link" style="min-width: 48px; max-width: 48px; text-align: center;">
                    <p class="mb-0" style="font-size: 1.75rem!important;"><i class="fa-solid fa-globe"></i></p>
                </a>
                <div class="align-self-center flex-fill ps-1 text-wrap overflow-hidden" style="text-overflow: ellipsis;">
                    <h5 class="card-title">Server Hostname and IP Address</h5>
                    <span><?= ($_SERVER['SERVER_NAME'] == $_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : '<span class="text-nowrap">' . $_SERVER['SERVER_NAME'] . '</span> (' . $_SERVER['SERVER_ADDR'] . ')'; ?> via port <?= $_SERVER['SERVER_PORT'] ?></span>
                </div>
            </div>
        </li>
        <li class="list-group-item p-1 list-group-item-action disabled" aria-disabled="true">
            <div class="d-flex align-items-start">
                <a href="#" class="stretched-link" style="min-width: 48px; max-width: 48px; text-align: center;">
                    <p class="mb-0" style="font-size: 1.75rem!important;"><i class="fa-solid fa-globe"></i></p>
                </a>
                <div class="align-self-center flex-fill ps-1 text-wrap overflow-hidden" style="text-overflow: ellipsis;">
                    <h5 class="card-title">HTTPS Connection</h5>
                    <span><?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'Used' : 'Not Used'; ?></span>
                </div>
            </div>
        </li>
        <li class="list-group-item p-1 list-group-item-action disabled" aria-disabled="true">
            <div class="d-flex align-items-start">
                <a href="#" class="stretched-link" style="min-width: 48px; max-width: 48px; text-align: center;">
                    <p class="mb-0" style="font-size: 1.75rem!important;"><i class="fa-solid fa-database"></i></p>
                </a>
                <div class="align-self-center flex-fill ps-1 text-wrap overflow-hidden" style="text-overflow: ellipsis;">
                    <h5 class="card-title">Database</h5>
                    <span><?= esc($version_comment) ?> version <?= esc($version) ?></span>
                </div>
            </div>
        </li>
        <li class="list-group-item p-1 list-group-item-action disabled" aria-disabled="true">
            <div class="d-flex align-items-start">
                <a href="#" class="stretched-link" style="min-width: 48px; max-width: 48px; text-align: center;">
                    <p class="mb-0" style="font-size: 1.75rem!important;"><i class="fa-brands fa-php"></i></p>
                </a>
                <div class="align-self-center flex-fill ps-1 text-wrap overflow-hidden" style="text-overflow: ellipsis;">
                    <h5 class="card-title">PHP and CodeIgniter Version</h5>
                    <span><?= phpversion(); ?> • <?= CodeIgniter\CodeIgniter::CI_VERSION ?></span>
                </div>
            </div>
        </li>
        <li class="list-group-item p-1 list-group-item-action disabled" aria-disabled="true">
            <div class="d-flex align-items-start">
                <a href="#" class="stretched-link" style="min-width: 48px; max-width: 48px; text-align: center;">
                    <p class="mb-0" style="font-size: 1.75rem!important;"><i class="fa-brands fa-php"></i></p>
                </a>
                <div class="align-self-center flex-fill ps-1 text-wrap overflow-hidden" style="text-overflow: ellipsis;">
                    <h5 class="card-title">PHP Extensions</h5>
                    <span><?= esc($php_extensions) ?></span>
                </div>
            </div>
        </li>
    </ul>
    <h5>Frontend Information</h5>
    <ul class="list-group shadow-sm rounded-3 mb-3">
        <li class="list-group-item p-1 list-group-item-action disabled" aria-disabled="true">
            <div class="d-flex align-items-start">
                <a href="#" class="stretched-link" style="min-width: 48px; max-width: 48px; text-align: center;">
                    <p class="mb-0" style="font-size: 1.75rem!important;"><i class="fa-brands fa-bootstrap"></i></p>
                </a>
                <div class="align-self-center flex-fill ps-1 text-wrap overflow-hidden" style="text-overflow: ellipsis;">
                    <h5 class="card-title">Bootstrap Version</h5>
                    <span>5.3.3</span>
                </div>
            </div>
        </li>
        <li class="list-group-item p-1 list-group-item-action disabled" aria-disabled="true">
            <div class="d-flex align-items-start">
                <a href="#" class="stretched-link" style="min-width: 48px; max-width: 48px; text-align: center;">
                    <p class="mb-0" style="font-size: 1.75rem!important;"><i class="fa-brands fa-js"></i></p>
                </a>
                <div class="align-self-center flex-fill ps-1 text-wrap overflow-hidden" style="text-overflow: ellipsis;">
                    <h5 class="card-title">jQuery Version</h5>
                    <span id="jquery-version">Loading...</span>
                </div>
            </div>
        </li>
    </ul>
    <hr>
    <!-- Place Copyright Here -->
    <p>&copy; 2020 <?= (date('Y') !== "2020") ? "- " . date('Y') : ''; ?> <span style="font-weight: 900;">HWP</span><span style="font-weight: 300;">web</span><br>The application's template is based from <a class="text-decoration-none" href="https://github.com/hafizulwanandaputra/hwpweb-admin-template" target="_blank"><span style="font-weight: 900;">HWP</span><span style="font-weight: 300;">web</span> ADMIN Template</a>.</p>
</main>
</div>
<?= $this->endSection(); ?>
<?= $this->section('javascript'); ?>
<script>
    $(document).ready(function() {
        $('#loadingSpinner').hide();
    });
</script>
<?= $this->endSection(); ?>