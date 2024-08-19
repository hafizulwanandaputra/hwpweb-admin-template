<?= $this->extend('auth/templates/login'); ?>
<?= $this->section('content'); ?>
<main class="form-signin w-100 m-auto">
    <div class="modal d-block" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-body rounded-4 shadow-lg transparent-blur">
                <div class="modal-body">
                    <?= form_open('register/create', 'id="registerForm"'); ?>
                    <h1 class="h3 mb-2 fw-normal">
                        Register your Account
                    </h1>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control rounded-3 <?= (validation_show_error('fullname')) ? 'is-invalid' : ''; ?>" id="fullname" name="fullname" value="<?= old('fullname'); ?>" autocomplete="off" dir="auto" placeholder="fullname">
                        <label for="fullname">Full Name*</label>
                        <div class="invalid-feedback">
                            <?= validation_show_error('fullname'); ?>
                        </div>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control rounded-3 <?= (validation_show_error('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?= old('username'); ?>" autocomplete="off" dir="auto" placeholder="username">
                        <label for="username">User Name*</label>
                        <div class="invalid-feedback">
                            <?= validation_show_error('username'); ?>
                        </div>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control rounded-3 <?= (validation_show_error('new_password1')) ? 'is-invalid' : ''; ?>" id="new_password1" name="new_password1" placeholder="new_password1">
                        <label for="new_password1">New Password*</label>
                        <div class="invalid-feedback">
                            <?= validation_show_error('new_password1'); ?>
                        </div>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control rounded-3 <?= (validation_show_error('new_password2')) ? 'is-invalid' : ''; ?>" id="new_password2" name="new_password2" placeholder="new_password2">
                        <label for="new_password2">Confirm New Password*</label>
                        <div class="invalid-feedback">
                            <?= validation_show_error('new_password2'); ?>
                        </div>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary rounded-3 bg-gradient" type="submit" id="registerBtn">
                        <i class="fa-solid fa-user-plus"></i> REGISTER
                    </button>
                    <?= form_close(); ?>
                    <div class="mt-3">
                        <span>Already have an account, <a href="<?= base_url() ?>" class="text-decoration-none">click here!</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3">
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
    <?php if (isset($_GET['redirect'])) : ?>
        <div class="toast fade show align-items-center text-bg-danger border border-danger rounded-3 transparent-blur" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body d-flex align-items-start">
                <div style="width: 24px; text-align: center;">
                    <i class="fa-solid fa-circle-xmark"></i>
                </div>
                <div class="w-100 mx-2 text-start">
                    Please login first before accessing "<?= urldecode($_GET['redirect']); ?>"
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
</div>
<?= $this->endSection(); ?>