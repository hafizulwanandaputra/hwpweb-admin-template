<?= $this->extend('dashboard/templates/dashboard'); ?>
<?= $this->section('title'); ?>
<div class="d-flex justify-content-start align-items-center">
    <a class="fs-5 me-3" href="<?= base_url('/settings'); ?>"><i class="fa-solid fa-arrow-left"></i></a>
    <span class="fw-medium fs-5 flex-fill text-truncate"><?= $title; ?></span>
    <div id="loadingSpinner" class="spinner-border spinner-border-sm mx-2" role="status" style="min-width: 1rem;">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<div style="min-width: 1px; max-width: 1px;"></div>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<main class="main-content-inside px-3 pt-3">
    <div class="no-fluid-content">
        <div class="alert alert-info" role="alert">
            <div class="d-flex align-items-start">
                <div style="width: 12px; text-align: center;">
                    <i class="fa-solid fa-circle-info"></i>
                </div>
                <div class="w-100 ms-3">
                    Password must be at least 3 characters
                </div>
            </div>
        </div>
        <?= form_open_multipart('/settings/changepassword/update', 'id="changePasswordForm"'); ?>
        <div class="mb-3">
            <div class="fw-bold mb-2 border-bottom">Password</div>
            <div class="form-floating mb-2">
                <input type="password" class="form-control <?= (validation_show_error('current_password')) ? 'is-invalid' : ''; ?>" id="current_password" name="current_password" placeholder="current_password">
                <label for="current_password">Old Password</label>
                <div class="invalid-feedback">
                    <?= validation_show_error('current_password'); ?>
                </div>
            </div>
            <div class="form-floating mb-2">
                <input type="password" class="form-control <?= (validation_show_error('new_password1')) ? 'is-invalid' : ''; ?>" id="new_password1" name="new_password1" placeholder="new_password1">
                <label for="new_password1">New Password</label>
                <div class="invalid-feedback">
                    <?= validation_show_error('new_password1'); ?>
                </div>
            </div>
            <div class="form-floating mb-2">
                <input type="password" class="form-control <?= (validation_show_error('new_password2')) ? 'is-invalid' : ''; ?>" id="new_password2" name="new_password2" placeholder="new_password2">
                <label for="new_password2">Confirm New Password</label>
                <div class="invalid-feedback">
                    <?= validation_show_error('new_password2'); ?>
                </div>
            </div>
        </div>
        <hr>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <button class="btn btn-primary bg-gradient" type="submit"><i class="fa-solid fa-pen-to-square" id="submitBtn"></i> Change</button>
        </div>
        <?= form_close(); ?>
    </div>
</main>
</div>
<?= $this->endSection(); ?>
<?= $this->section('javascript'); ?>
<script>
    $(document).ready(function() {
        $('#loadingSpinner').hide();
        $('input.form-control').on('input', function() {
            // Remove the is-invalid class for the current input field
            $(this).removeClass('is-invalid');
            // Hide the invalid-feedback message for the current input field
            $(this).siblings('.invalid-feedback').hide();
        });
        $(document).on('click', '#submitBtn', function(e) {
            e.preventDefault();
            $('#changePasswordForm').submit();
            $('input').prop('disabled', true);
            $('#submitBtn').prop('disabled', true).html(`
                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                <span role="status">Processing, please wait...</span>
            `);
        });
    });
</script>
<?= $this->endSection(); ?>