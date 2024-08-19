<?= $this->extend('auth/templates/login'); ?>
<?= $this->section('content'); ?>
<main class="form-signin w-100 m-auto">
    <div class="modal d-block" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-body rounded-4 shadow-lg transparent-blur">
                <div class="modal-body">
                    <?= form_open('check-login', 'id="loginForm"'); ?>
                    <h1 class="h3 mb-2 fw-normal">
                        Login to Your Account
                    </h1>
                    <div class="form-floating">
                        <input type="text" class="form-control username rounded-top-3 <?= (validation_show_error('username')) ? 'is-invalid' : ''; ?>" id="floatingInput" name="username" placeholder="Username" value="" autocomplete="off">
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
                    <div class="form-floating">
                        <input type="password" class="form-control rounded-bottom-3 <?= (validation_show_error('password')) ? 'is-invalid' : ''; ?>" id="floatingPassword" name="password" placeholder="Password" autocomplete="off">
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
                    <input type="hidden" name="url" value="<?= (isset($_GET['redirect'])) ? base_url('/' . urldecode($_GET['redirect'])) : base_url('/home'); ?>">
                    <button class="w-100 btn btn-lg btn-primary rounded-3 bg-gradient" type="submit" id="loginBtn">
                        <i class="fa-solid fa-right-to-bracket"></i> LOGIN
                    </button>
                    <?= form_close(); ?>
                    <div class="mt-3">
                        <span>Don't have an account, <a href="<?= base_url('/register') ?>" class="text-decoration-none">click here!</a></span>
                    </div>
                </div>
                <!-- FOOTER -->
                <div class="modal-footer d-block" style="font-size: 9pt; border-top: 1px solid var(--bs-border-color-translucent);">
                    <span class="text-center">&copy; 2020 <?= (date('Y') !== "2020") ? "- " . date('Y') : ''; ?> <span style="font-weight: 900;">HWP</span><span style="font-weight: 300;">web</span><br>Made with <a class="text-decoration-none" href="https://getbootstrap.com/" target="_blank">Bootstrap 5.3.3</a><br>Powered by <a class="text-decoration-none" href="https://www.php.net/releases" target="_blank">PHP <?= phpversion(); ?></a> with <a class="text-decoration-none" href="https://codeigniter.com/user_guide/changelogs/v<?= CodeIgniter\CodeIgniter::CI_VERSION ?>.html" target="_blank">CodeIgniter <?= CodeIgniter\CodeIgniter::CI_VERSION ?></a> using <?= $_SERVER['SERVER_SOFTWARE']; ?><br>Pattern: <a class="text-decoration-none" href="https://codepen.io/bap13/pen/oBMYPV" target="_blank">CSS Heart Polka-dot Background Pattern by Brett Peters via CodePen</a></span>
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
    <?php if (validation_show_error('username') || validation_show_error('password')) : ?>
        <div class="toast fade show align-items-center text-bg-danger border border-danger rounded-3 transparent-blur" role="alert" aria-live="assertive" aria-atomic="true">
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