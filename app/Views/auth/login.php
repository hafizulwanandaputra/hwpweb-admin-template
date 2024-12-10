<?= $this->extend('auth/templates/login'); ?>
<?= $this->section('content'); ?>
<div class="my-auto">
    <div class="no-fluid-content px-3 py-3 px-md-5">
        <div class="row align-items-center">
            <div class="col-md-6 col-lg-7 text-center text-md-start align-self-start">
                <h1 class="display-6 fw-bold lh-1 mb-3">Login to Your Account</h1>
                <p class="fs-6"><?= $systemName ?><br><small class="fw-bold"><?= $systemSubtitleName ?></small></p>
            </div>
            <div class="col-md">
                <?= form_open('check-login', 'id="loginForm"'); ?>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm <?= (validation_show_error('username')) ? 'is-invalid' : ''; ?>" id="floatingInput" name="username" placeholder="Username" value="" autocomplete="off">
                    <label for="floatingInput">
                        <div class="d-flex align-items-start">
                            <div style="width: 12px; text-align: center;">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <div class="w-100 ms-3">
                                Username
                            </div>
                        </div>
                    </label>
                </div>
                <div class="d-flex flex-column flex-md-row column-gap-3">
                    <div class="flex-fill form-floating mb-3 mb-md-0">
                        <input type="password" class="form-control form-control-sm <?= (validation_show_error('password')) ? 'is-invalid' : ''; ?>" id="floatingPassword" name="password" placeholder="Password" autocomplete="off" data-bs-toggle="popover"
                            data-bs-placement="top"
                            data-bs-trigger="manual"
                            data-bs-title="<em>CAPS LOCK</em> IS ACTIVE"
                            data-bs-content="Please check the status of <span class='badge text-bg-dark bg-gradient kbd'>Caps Lock</span> on your keyboard.">
                        <label for="floatingPassword">
                            <div class="d-flex align-items-start">
                                <div style="width: 12px; text-align: center;">
                                    <i class="fa-solid fa-key"></i>
                                </div>
                                <div class="w-100 ms-3">
                                    Password
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="d-grid w-auto">
                        <button id="loginBtn" class="w-100 btn btn-primary bg-gradient btn-lg rounded" type="submit">
                            <i class="fa-solid fa-right-to-bracket"></i> <span class="d-md-none">LOGIN</span>
                        </button>
                    </div>
                </div>
                <input type="hidden" name="url" value="<?= (isset($_GET['redirect'])) ? base_url('/' . urldecode($_GET['redirect'])) : base_url('/home'); ?>">
                <hr>
                <div class="text-center">
                    <span>Don't have an account? <a href="<?= base_url('register') ?>" class="text-decoration-none">click here!</a></span>
                </div>
                <hr>
                <div class="text-center" style="font-size: 0.75em;">
                    <span class="text-center">&copy; 2020 <?= (date('Y') !== "2020") ? "- " . date('Y') : ''; ?> <span style="font-weight: 900;">HWP</span><span style="font-weight: 300;">web</span><br>Made with <a class="text-decoration-none" href="https://getbootstrap.com/" target="_blank">Bootstrap 5.3.3</a><br>Powered by <a class="text-decoration-none" href="https://www.php.net/releases" target="_blank">PHP <?= phpversion(); ?></a> with <a class="text-decoration-none" href="https://codeigniter.com/user_guide/changelogs/v<?= CodeIgniter\CodeIgniter::CI_VERSION ?>.html" target="_blank">CodeIgniter <?= CodeIgniter\CodeIgniter::CI_VERSION ?></a> using <?= $_SERVER['SERVER_SOFTWARE']; ?><br></span>
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
    <?php if (validation_show_error('username') || validation_show_error('password')) : ?>
        <div id="validationToast" class="toast align-items-center text-bg-danger border border-danger transparent-blur" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body d-flex align-items-start">
                <div style="width: 24px; text-align: center;">
                    <i class="fa-solid fa-circle-xmark"></i>
                </div>
                <div class="w-100 mx-2 text-start">
                    Login error:<br><?= validation_show_error('username') ?><br><?= validation_show_error('password') ?>
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
        $(document).on('click', '#loginBtn', function(e) {
            e.preventDefault();
            $('#loginForm').submit();
            $('input').prop('disabled', true).removeClass('is-invalid');
            $('#loginBtn').prop('disabled', true).html(`
          <span class="spinner-border" style="width: 1em; height: 1em;" aria-hidden="true"></span>  <span class="d-md-none">PLEASE WAIT</span>
        `);
        });
    });
</script>
<?= $this->endSection(); ?>