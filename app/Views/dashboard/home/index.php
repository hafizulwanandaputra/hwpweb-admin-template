<?= $this->extend('dashboard/templates/dashboard'); ?>
<?= $this->section('title'); ?>
<div class="d-flex justify-content-start align-items-center">
    <span class="fw-medium fs-5 flex-fill text-truncate"><?= $title; ?></span>
    <div id="loadingSpinner" class="spinner-border spinner-border-sm mx-2" role="status" style="min-width: 1rem;">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<div style="min-width: 1px; max-width: 1px;"></div>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<main class="main-content-inside px-3">
    <div class="no-fluid-content">
        <div class="d-flex justify-content-start align-items-start pt-3">
            <h1 class="h2 mb-0 me-3"><i class="fa-regular fa-face-smile-beam"></i></h1>
            <h1 class="h2 mb-0"><?= $txtgreeting . ', ' . session()->get('fullname') . '!'; ?></h1>
        </div>
        <hr>
        <!-- Place Informations Here -->
        <div class="mb-3">
            <p>For more information about Bootstrap 5.3 components, <a href="https://getbootstrap.com/docs/5.3/getting-started/introduction/" target="_blank">click here</a>.</p>
            <hr>
            <p>Bootstrap 5.3 elements has been modified to use gradients on some elements but not all. Add <code>bg-gradient</code> for elements of:</p>
            <ol>
                <li class="mb-2">
                    <span class="badge text-bg-primary bg-gradient">Badge</span>
                </li>
                <li class="mb-2">
                    <button type="button" class="btn btn-primary bg-gradient">Buttons</button>
                </li>
                <li class="mb-2">
                    <button type="button" class="btn btn-outline-primary bg-gradient">Outline Buttons</button>
                </li>
                <li class="mb-2">
                    Pagination at <code>page-link</code> class
                    <nav>
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link bg-gradient">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link bg-gradient" href="#">1</a></li>
                            <li class="page-item active" aria-current="page">
                                <a class="page-link bg-gradient" href="#">2</a>
                            </li>
                            <li class="page-item"><a class="page-link bg-gradient" href="#">2</a></li>
                            <li class="page-item">
                                <a class="page-link bg-gradient" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </li>
                <li class="mb-2">
                    Progress Bar at <code>progress-bar</code> class
                    <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-gradient" style="width: 0%"></div>
                    </div>
                    <div class="progress mt-2" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-gradient" style="width: 25%"></div>
                    </div>
                    <div class="progress mt-2" role="progressbar" aria-label="Basic example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-gradient" style="width: 50%"></div>
                    </div>
                    <div class="progress mt-2" role="progressbar" aria-label="Basic example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-gradient" style="width: 75%"></div>
                    </div>
                    <div class="progress mt-2" role="progressbar" aria-label="Basic example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-gradient" style="width: 100%"></div>
                    </div>
                </li>
            </ol>
            <hr>
            <p>For modal, use this element for header:</p>
            <div class="rounded bg-body-tertiary p-3 text-break">
                <pre class="mb-0">&lt;div class="modal-header justify-content-between pt-2 pb-2" style="border-bottom: 1px solid var(--bs-border-color-translucent);"&gt;
    &lt;h6 class="pe-2 modal-title fs-6 text-truncate" style="font-weight: bold;"&gt;Modal Title&lt;/h6&gt;
    &lt;button id="closeBtn" type="button" class="btn btn-danger bg-gradient" data-bs-dismiss="modal" aria-label="Close"&gt;&lt;i class="fa-solid fa-xmark"&gt;&lt;/i&gt;&lt;/button&gt;
&lt;/div&gt;</pre>
            </div>
            <hr>
            <p>This is the code for modal sheet</p>
            <div class="rounded bg-body-tertiary p-3 text-break">
                <pre class="mb-0">&lt;div class="modal modal-sheet p-4 py-md-5 fade" id="sheetModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex=" -1" aria-labelledby="sheetModal" aria-hidden="true" role="dialog"&gt;
    &lt;div class="modal-dialog modal-dialog-centered" role="document"&gt;
        &lt;div class="modal-content bg-body-tertiary rounded-4 shadow-lg transparent-blur"&gt;
            &lt;div class="modal-body p-4 text-center"&gt;
                &lt;h5 class="mb-0" id="sheetMessage"&gt;Message?&lt;/h5&gt;
                &lt;h6 class="mb-0" id="sheetSubmessage"&gt;&lt;/h6&gt;
            &lt;/div&gt;
            &lt;div class="modal-footer flex-nowrap p-0" style="border-top: 1px solid var(--bs-border-color-translucent);"&gt;
                &lt;button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" data-bs-dismiss="modal" style="border-right: 1px solid var(--bs-border-color-translucent);"&gt;No&lt;/button&gt;
                &lt;button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" id="confirmSheet"&gt;Yes&lt;/a&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;</pre>
            </div>
        </div>
    </div>
</main>
</div>
<?= $this->endSection(); ?>
<?= $this->section('javascript'); ?>
<script>
    $(document).ready(function() {
        $('#loadingSpinner').hide();
    });
</script>
<?= $this->endSection(); ?>
<?= $this->section('chartjs'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js" integrity="sha512-SIMGYRUjwY8+gKg7nn9EItdD8LCADSDfJNutF9TPrvEo86sQmFMh6MyralfIyhADlajSxqc7G0gs7+MwWF/ogQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // Chart.js script here
</script>
<?= $this->endSection(); ?>