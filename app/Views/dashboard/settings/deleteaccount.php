<?= $this->extend('dashboard/templates/dashboard'); ?>
<?= $this->section('title'); ?>
<div class="d-flex justify-content-start align-items-center">
    <a class="fs-5 me-3" href="<?= base_url('/settings'); ?>"><i class="fa-solid fa-arrow-left"></i></a>
    <span class="fw-medium fs-5 flex-fill text-truncate"><?= $title; ?></span>
    <div id="loadingSpinner" class="spinner-border spinner-border-sm" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<div style="min-width: 1px; max-width: 1px;"></div>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-3 pt-3">
    <div class="no-fluid-content">
        <?= form_open_multipart('/delete/' . session()->get('id_user'), 'id="deleteAccountForm"'); ?>
        <?= csrf_field(); ?>
        <input type="hidden" name="_method" value="DELETE">
        <div class="alert alert-danger bg-gradient" role="alert">
            <div class="d-flex align-items-start">
                <div style="width: 12px; text-align: center;">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>
                <div class="w-100 ms-3">
                    Removing your account will remove your user information and you can't login using your account anymore. If you want to remove this account, type your password below!
                </div>
            </div>
        </div>
        <fieldset class="border rounded px-2 py-0">
            <legend class="float-none w-auto mb-0 px-1 fs-6 fw-bold">Password</legend>
            <div class="form-floating mb-2">
                <input type="password" class="form-control <?= (validation_show_error('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="password">
                <label for="password">Password</label>
                <div class="invalid-feedback">
                    <?= validation_show_error('password'); ?>
                </div>
            </div>
        </fieldset>
        <hr>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <button class="btn btn-danger bg-gradient" type="submit" id="submitBtn"><i class="fa-solid fa-trash"></i> Delete</button>
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
            $('#deleteAccountForm').submit();
            $('input').prop('disabled', true);
            $('#submitBtn').prop('disabled', true).html(`
                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                <span role="status">Processing, please wait...</span>
            `);
        });
    });
</script>
<?= $this->endSection(); ?>