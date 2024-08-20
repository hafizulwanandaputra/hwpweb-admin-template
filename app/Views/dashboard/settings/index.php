<?= $this->extend('dashboard/templates/dashboard'); ?>
<?= $this->section('title'); ?>
<div class="d-flex justify-content-start align-items-center">
    <span class="fw-medium fs-5 flex-fill text-truncate"><?= $title; ?></span>
    <div id="loadingSpinner" class="spinner-border spinner-border-sm" role="status" style="display: none;">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<div style="min-width: 1px; max-width: 1px;"></div>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3">
    <!-- Place Settings Item Here -->
    <h5>Account Settings</h5>
    <ul class="list-group shadow-sm rounded-3 mb-3">
        <li class="list-group-item p-1 list-group-item-action">
            <div class="d-flex align-items-start">
                <a href="<?= base_url('/settings/edit'); ?>" class="stretched-link" style="min-width: 48px; max-width: 48px; text-align: center;">
                    <p class="mb-0" style="font-size: 1.75rem!important;"><i class="fa-solid fa-user-pen"></i></p>
                </a>
                <div class="align-self-center flex-fill ps-1 text-wrap overflow-hidden" style="text-overflow: ellipsis;">
                    <h5 class="card-title">Change User Information</h5>
                </div>
                <div class="align-self-center" style="min-width: 48px; max-width: 48px; text-align: center;">
                    <span class="text-body-tertiary"><i class="fa-solid fa-angle-right"></i></span>
                </div>
            </div>
        </li>
        <li class="list-group-item p-1 list-group-item-action">
            <div class="d-flex align-items-start">
                <a href="<?= base_url('/settings/changepassword'); ?>" class="stretched-link" style="min-width: 48px; max-width: 48px; text-align: center;">
                    <p class="mb-0" style="font-size: 1.75rem!important;"><i class="fa-solid fa-key"></i></p>
                </a>
                <div class="align-self-center flex-fill ps-1 text-wrap overflow-hidden" style="text-overflow: ellipsis;">
                    <h5 class="card-title">Change Password</h5>
                </div>
                <div class="align-self-center" style="min-width: 48px; max-width: 48px; text-align: center;">
                    <span class="text-body-tertiary"><i class="fa-solid fa-angle-right"></i></span>
                </div>
            </div>
        </li>
        <?php if ($countadmin > 1) : ?>
            <li class="list-group-item p-1 list-group-item-action">
                <div class=" d-flex align-items-start">
                    <a href="<?= base_url('/settings/deleteaccount'); ?>" class="stretched-link" style="min-width: 48px; max-width: 48px; text-align: center;">
                        <p class="mb-0 text-danger" style="font-size: 1.75rem!important;"><i class="fa-solid fa-trash"></i></p>
                    </a>
                    <div class="align-self-center flex-fill ps-1 text-wrap overflow-hidden" style="text-overflow: ellipsis;">
                        <h5 class="card-title text-danger">Delete Account</h5>
                    </div>
                    <div class="align-self-center" style="min-width: 48px; max-width: 48px; text-align: center;">
                        <span class="text-body-tertiary"><i class="fa-solid fa-angle-right"></i></span>
                    </div>
                </div>
            </li>
        <?php endif; ?>
    </ul>
    <h5>System</h5>
    <ul class="list-group shadow-sm rounded-3 mb-3">
        <li class="list-group-item p-1 list-group-item-action">
            <div class="d-flex align-items-start">
                <a href="<?= base_url('/settings/about'); ?>" class="stretched-link" style="min-width: 48px; max-width: 48px; text-align: center;">
                    <p class="mb-0" style="font-size: 1.75rem!important;"><i class="fa-solid fa-circle-info"></i></p>
                </a>
                <div class="align-self-center flex-fill ps-1 text-wrap overflow-hidden" style="text-overflow: ellipsis;">
                    <h5 class="card-title">About This System</h5>
                </div>
                <div class="align-self-center" style="min-width: 48px; max-width: 48px; text-align: center;">
                    <span class="text-body-tertiary"><i class="fa-solid fa-angle-right"></i></span>
                </div>
            </div>
        </li>
    </ul>
</main>
</div>
<?= $this->endSection(); ?>