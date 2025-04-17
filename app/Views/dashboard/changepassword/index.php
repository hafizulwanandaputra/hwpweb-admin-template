<?= $this->extend('dashboard/templates/dashboard'); ?>
<?= $this->section('title'); ?>
<div class="d-flex justify-content-start align-items-center">
    <a class="fs-5 me-3" href="<?= base_url('/settings'); ?>"><i class="fa-solid fa-arrow-left"></i></a>
    <span class="fw-medium fs-5 flex-fill text-truncate"><?= $title; ?></span>
    <div id="loadingSpinner" class="px-2">
        <?= $this->include('spinner/spinner'); ?>
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
                <input type="password" class="form-control <?= (validation_show_error('current_password')) ? 'is-invalid' : ''; ?>" id="current_password" name="current_password" placeholder="current_password" data-bs-toggle="popover"
                    data-bs-placement="top"
                    data-bs-trigger="manual"
                    data-bs-title="<em>CAPS LOCK</em> IS ACTIVE"
                    data-bs-content="Please check the status of <span class='badge text-bg-dark bg-gradient kbd'>Caps Lock</span> on your keyboard.">
                <label for="current_password">Old Password</label>
                <div class="invalid-feedback">
                    <?= validation_show_error('current_password'); ?>
                </div>
            </div>
            <div class="form-floating mb-2">
                <input type="password" class="form-control <?= (validation_show_error('new_password1')) ? 'is-invalid' : ''; ?>" id="new_password1" name="new_password1" placeholder="new_password1" data-bs-toggle="popover"
                    data-bs-placement="top"
                    data-bs-trigger="manual"
                    data-bs-title="<em>CAPS LOCK</em> IS ACTIVE"
                    data-bs-content="Please check the status of <span class='badge text-bg-dark bg-gradient kbd'>Caps Lock</span> on your keyboard.">
                <label for="new_password1">New Password</label>
                <div class="invalid-feedback">
                    <?= validation_show_error('new_password1'); ?>
                </div>
            </div>
            <div class="form-floating mb-2">
                <input type="password" class="form-control <?= (validation_show_error('new_password2')) ? 'is-invalid' : ''; ?>" id="new_password2" name="new_password2" placeholder="new_password2" data-bs-toggle="popover"
                    data-bs-placement="top"
                    data-bs-trigger="manual"
                    data-bs-title="<em>CAPS LOCK</em> IS ACTIVE"
                    data-bs-content="Please check the status of <span class='badge text-bg-dark bg-gradient kbd'>Caps Lock</span> on your keyboard.">
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
        $('input[type="password"]').each(function() {
            const passwordInput = $(this);
            const popover = new bootstrap.Popover(passwordInput[0], {
                html: true,
                template: '<div class="popover shadow-lg" role="tooltip">' +
                    '<div class="popover-arrow"></div>' +
                    '<h3 class="popover-header"></h3>' +
                    '<div class="popover-body">Caps Lock is active!</div>' +
                    '</div>'
            });

            let capsLockActive = false;

            passwordInput.on('focus', function() {
                passwordInput[0].addEventListener('keyup', function(event) {
                    const currentCapsLock = event.getModifierState('CapsLock');

                    if (currentCapsLock !== capsLockActive) {
                        capsLockActive = currentCapsLock;
                        if (capsLockActive) {
                            popover.show();
                        } else {
                            popover.hide();
                        }
                    }
                });
            });

            passwordInput.on('blur', function() {
                popover.hide();
                passwordInput[0].removeEventListener('keyup', function() {});
                capsLockActive = false;
            });
        });
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
                <?= $this->include('spinner/spinner'); ?>
                <span role="status">Processing, please wait...</span>
            `);
        });
    });
</script>
<?= $this->endSection(); ?>