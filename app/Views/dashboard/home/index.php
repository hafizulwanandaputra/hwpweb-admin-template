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
<main class="col-md-9 ms-sm-auto col-lg-10 px-3 px-md-4">
    <div class="d-flex justify-content-start align-items-start pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 me-3"><i class="fa-regular fa-face-smile-beam"></i></h1>
        <h1 class="h2"><?= $txtgreeting . ', ' . session()->get('fullname') . '!'; ?></h1>
    </div>
    <p>Hello World!</p>
    <!-- Place Informations Here -->
</main>
</div>
<?= $this->endSection(); ?>
<?= $this->section('chartjs'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js" integrity="sha512-SIMGYRUjwY8+gKg7nn9EItdD8LCADSDfJNutF9TPrvEo86sQmFMh6MyralfIyhADlajSxqc7G0gs7+MwWF/ogQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // Chart.js script here
</script>
<?= $this->endSection(); ?>