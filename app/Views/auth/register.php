<?= $this->extend('auth/templates/login'); ?>
<?= $this->section('content'); ?>
<div class="my-auto">
    <div class="no-fluid-content px-3 py-3 px-md-5">
        <div class="row align-items-center">
            <div class="col-md-6 col-lg-7 text-start align-self-start">
                <h1 class="display-6 fw-bold lh-1 mb-3">Register Your Account</h1>
                <p class="fs-6"><?= $systemName ?><br><small class="fw-bold"><?= $systemSubtitleName ?></small></p>
            </div>
            <div class="col-md">
                <?= form_open('register/create', 'id="registerForm"'); ?>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control <?= (validation_show_error('fullname')) ? 'is-invalid' : ''; ?> rounded-4" id="fullname" name="fullname" value="<?= old('fullname'); ?>" autocomplete="off" dir="auto" placeholder="fullname">
                    <label for="fullname">Full Name*</label>
                    <div class="invalid-feedback">
                        <?= validation_show_error('fullname'); ?>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control <?= (validation_show_error('username')) ? 'is-invalid' : ''; ?> rounded-4" id="username" name="username" value="<?= old('username'); ?>" autocomplete="off" dir="auto" placeholder="username">
                    <label for="username">User Name*</label>
                    <div class="invalid-feedback">
                        <?= validation_show_error('username'); ?>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control <?= (validation_show_error('new_password1')) ? 'is-invalid' : ''; ?> rounded-4" id="new_password1" name="new_password1" placeholder="new_password1" data-bs-toggle="popover"
                        data-bs-placement="top"
                        data-bs-trigger="manual"
                        data-bs-title="<em>CAPS LOCK</em> IS ACTIVE"
                        data-bs-content="Please check the status of <span class='badge text-bg-dark bg-gradient kbd'>Caps Lock</span> on your keyboard.">
                    <label for="new_password1">New Password*</label>
                    <div class="invalid-feedback">
                        <?= validation_show_error('new_password1'); ?>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control <?= (validation_show_error('new_password2')) ? 'is-invalid' : ''; ?> rounded-4" id="new_password2" name="new_password2" placeholder="new_password2" data-bs-toggle="popover"
                        data-bs-placement="top"
                        data-bs-trigger="manual"
                        data-bs-title="<em>CAPS LOCK</em> IS ACTIVE"
                        data-bs-content="Please check the status of <span class='badge text-bg-dark bg-gradient kbd'>Caps Lock</span> on your keyboard.">
                    <label for="new_password2">Confirm New Password*</label>
                    <div class="invalid-feedback">
                        <?= validation_show_error('new_password2'); ?>
                    </div>
                </div>
                <button class="w-100 btn btn-lg btn-primary bg-gradient rounded-4" type="submit" id="registerBtn">
                    <i class="fa-solid fa-user-plus"></i> REGISTER
                </button>

                <input type="hidden" name="url" value="<?= (isset($_GET['redirect'])) ? base_url('/' . urldecode($_GET['redirect'])) : base_url('/home'); ?>">
                <hr>
                <div class="text-start">
                    <span>Already have an account? <a href="<?= base_url() ?>" class="text-decoration-none">click here!</a></span>
                </div>
                <div class="dropdown d-grid mt-3">
                    <button class="btn btn-outline-body bg-gradient btn-sm rounded-4 dropdown-toggle" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" data-bs-display="static" aria-label="Toggle theme (auto)">
                        <i class="fa-solid fa-palette"></i> Set Theme
                    </button>
                    <ul class="dropdown-menu shadow-sm w-100 bg-body-tertiary transparent-blur" aria-labelledby="bd-theme-text">
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
                <hr>
                <div class="text-start" style="font-size: 0.75em;">
                    <span class="text-start">&copy; 2020 <?= (date('Y') !== "2020") ? "- " . date('Y') : ''; ?> <span style="font-weight: 900;">HWP</span><span style="font-weight: 300;">web</span><br>Made with <a class="text-decoration-none" href="https://getbootstrap.com/" target="_blank">Bootstrap 5.3.3</a><br>Powered by <a class="text-decoration-none" href="https://www.php.net/releases" target="_blank">PHP <?= phpversion(); ?></a> with <a class="text-decoration-none" href="https://codeigniter.com/user_guide/changelogs/v<?= CodeIgniter\CodeIgniter::CI_VERSION ?>.html" target="_blank">CodeIgniter <?= CodeIgniter\CodeIgniter::CI_VERSION ?></a> using <?= $_SERVER['SERVER_SOFTWARE']; ?><br></span>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3">
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
    <?php if (isset($_GET['redirect'])) : ?>
        <div id="redirectToast" class="toast align-items-center text-bg-danger border border-danger transparent-blur" role="alert" aria-live="assertive" aria-atomic="true">
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
        // Show toast messages if they exist
        if ($('#redirectToast').length) {
            var redirectToast = new bootstrap.Toast($('#redirectToast')[0]);
            redirectToast.show();
        }

        if ($('#msgToast').length) {
            var msgToast = new bootstrap.Toast($('#msgToast')[0]);
            msgToast.show();
        }

        if ($('#errorToast').length) {
            var errorToast = new bootstrap.Toast($('#errorToast')[0]);
            errorToast.show();
        }

        if ($('#validationToast').length) {
            var validationToast = new bootstrap.Toast($('#validationToast')[0]);
            validationToast.show();
        }

        setTimeout(function() {
            if ($('#redirectToast').length) {
                var redirectToast = new bootstrap.Toast($('#redirectToast')[0]);
                redirectToast.hide();
            }

            if ($('#msgToast').length) {
                var msgToast = new bootstrap.Toast($('#msgToast')[0]);
                msgToast.hide();
            }

            if ($('#errorToast').length) {
                var errorToast = new bootstrap.Toast($('#errorToast')[0]);
                errorToast.hide();
            }

            if ($('#validationToast').length) {
                var validationToast = new bootstrap.Toast($('#validationToast')[0]);
                validationToast.hide();
            }
        }, 5000);
        $('input.form-control').on('input', function() {
            // Remove the is-invalid class for the current input field
            $(this).removeClass('is-invalid');
            // Hide the invalid-feedback message for the current input field
            $(this).siblings('.invalid-feedback').hide();
        });
        $(document).on('click', '#registerBtn', function(e) {
            e.preventDefault();
            $('#registerForm').submit();
            $('input').prop('disabled', true).removeClass('is-invalid');
            $('#registerBtn').prop('disabled', true).html(`
            <?= $this->include('spinner/spinner'); ?> PLEASE WAIT
        `);
        });
    });
</script>
<?= $this->endSection(); ?>