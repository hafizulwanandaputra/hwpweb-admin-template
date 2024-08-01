<?= $this->extend('dashboard/templates/dashboard'); ?>
<?= $this->section('title'); ?>
<div class="d-flex justify-content-start align-items-center">
    <a class="fs-5 me-3" href="<?= base_url('/settings'); ?>"><i class="fa-solid fa-arrow-left"></i></a>
    <span class="fw-medium fs-5 flex-fill text-truncate"><?= $title; ?></span>
</div>
<div style="min-width: 1px; max-width: 1px;"></div>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-3">
    <?= form_open_multipart('/delete/' . session()->get('id_user')); ?>
    <?= csrf_field(); ?>
    <input type="hidden" name="_method" value="DELETE">
    <div class="alert alert-danger bg-gradient rounded-3" role="alert">
        <div class="d-flex align-items-start">
            <div style="width: 12px; text-align: center;">
                <i class="fa-solid fa-circle-exclamation"></i>
            </div>
            <div class="w-100 ms-3">
                Removing your account will remove your user information and you can't login using your account anymore. If you want to remove this account, type your password below!
            </div>
        </div>
    </div>
    <fieldset class="border rounded-3 px-2 py-0">
        <legend class="float-none w-auto mb-0 px-1 fs-6 fw-bold">Password</legend>
        <div class="form-floating mb-2">
            <input type="password" class="form-control rounded-3 <?= (validation_show_error('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="password">
            <label for="password">Password</label>
            <div class="invalid-feedback">
                <?= validation_show_error('password'); ?>
            </div>
        </div>
    </fieldset>
    <hr>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
        <button class="btn btn-danger rounded-3 bg-gradient" type="submit"><i class="fa-solid fa-trash"></i> Delete</button>
    </div>
    <?= form_close(); ?>
</main>
</div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('javascript'); ?>
<script>
    var warnMessage = "Save your unsaved changes before leaving this page!";
    $("input").change(function() {
        window.onbeforeunload = function() {
            return 'You have unsaved changes on this page!';
        }
    });
    $("select").change(function() {
        window.onbeforeunload = function() {
            return 'You have unsaved changes on this page!';
        }
    });
    $(function() {
        $('button[type=submit]').click(function(e) {
            window.onbeforeunload = null;
        });
    });
</script>
<?= $this->endSection(); ?>