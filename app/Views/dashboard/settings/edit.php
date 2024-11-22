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
        <?= form_open_multipart('/settings/update', 'id="userInfoForm"'); ?>
        <?= csrf_field(); ?>
        <fieldset class="border rounded-3 px-2 py-0">
            <legend class="float-none w-auto mb-0 px-1 fs-6 fw-bold">User Information</legend>
            <div class="form-floating mb-2">
                <input type="text" class="form-control rounded-3 <?= (validation_show_error('fullname')) ? 'is-invalid' : ''; ?>" id="fullname" name="fullname" value="<?= (old('fullname')) ? old('fullname') : htmlspecialchars(session()->get('fullname')); ?>" autocomplete="off" dir="auto" placeholder="fullname">
                <label for="fullname">Full Name*</label>
                <div class="invalid-feedback">
                    <?= validation_show_error('fullname'); ?>
                </div>
            </div>
            <div class="form-floating mb-2">
                <input type="text" class="form-control rounded-3 <?= (validation_show_error('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?= (old('username')) ? old('username') : htmlspecialchars(session()->get('username')); ?>" autocomplete="off" dir="auto" placeholder="username">
                <label for="username">User Name*</label>
                <div class="invalid-feedback">
                    <?= validation_show_error('username'); ?>
                </div>
            </div>
        </fieldset>
        <hr>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <button class="btn btn-primary rounded-3 bg-gradient" type="submit" id="submitBtn"><i class="fa-solid fa-user-pen"></i> Change</button>
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
            $('#userInfoForm').submit();
            $('input').prop('disabled', true);
            $('#submitBtn').prop('disabled', true).html(`
                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                <span role="status">Processing, please wait...</span>
            `);
        });
    });
</script>
<?= $this->endSection(); ?>