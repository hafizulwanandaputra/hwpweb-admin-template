<?= $this->extend('dashboard/templates/dashboard'); ?>
<?= $this->section('title'); ?>
<div class="d-flex justify-content-start align-items-center">
    <span class="fw-medium fs-5 flex-fill text-truncate"><?= $title; ?></span>
    <div id="loadingSpinner" class="px-2">
        <?= $this->include('spinner/spinner'); ?>
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
            <p>The <code>&lt;body&gt;</code> tag uses <code>bg-body-hwpweb</code> class, which means:</p>
            <ol>
                <li>If the light theme is applied, the background color is <code>--bs-tertiary-bg</code>.</li>
                <li>If the dark theme is applied, the background color is <code>--bs-body-bg</code>.</li>
            </ol>
            <p>Some Bootstrap 5.3 elements has been modified to use gradients on some elements but not all. Add <code>bg-gradient</code> for elements of:</p>
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
            For modal, use this element for header:
            <div class="rounded bg-body-tertiary p-3 text-break">
                <pre class="mb-0">&lt;div class=&quot;modal-header justify-content-between pt-2 pb-2&quot; style=&quot;border-bottom: 1px solid var(--bs-border-color-translucent);&quot;&gt;
    &lt;h6 class=&quot;pe-2 modal-title fs-6 text-truncate&quot; style=&quot;font-weight: bold;&quot;&gt;Modal Title&lt;/h6&gt;
    &lt;button id=&quot;closeBtn&quot; type=&quot;button&quot; class=&quot;btn-close&quot; data-bs-dismiss=&quot;modal&quot; aria-label=&quot;Close&quot;&gt;&lt;/button&gt;
&lt;/div&gt;</pre>
            </div>
            and for footer:
            <div class="rounded bg-body-tertiary p-3 text-break">
                <pre class="mb-0">&lt;div class=&quot;modal-footer justify-content-end pt-2 pb-2&quot; style=&quot;border-top: 1px solid var(--bs-border-color-translucent);&quot;&gt;
    &lt;div class=&quot;mb-1 mt-1 w-100&quot; id=&quot;uploadProgressDiv&quot;&gt;
        &lt;div class=&quot;progress&quot; style=&quot;border-top: 1px solid var(--bs-border-color-translucent); border-bottom: 1px solid var(--bs-border-color-translucent); border-left: 1px solid var(--bs-border-color-translucent); border-right: 1px solid var(--bs-border-color-translucent);&quot;&gt;
            &lt;div class=&quot;progress-bar progress-bar-striped progress-bar-animated bg-gradient&quot; role=&quot;progressbar&quot; style=&quot;width: 0%; transition: none;&quot; id=&quot;uploadProgressBar&quot;&gt;&lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;d-flex justify-content-between w-100&quot;&gt;
        &lt;div&gt;
            &lt;button type=&quot;button&quot; id=&quot;cancelButton&quot; class=&quot;btn btn-danger bg-gradient&quot; style=&quot;display: none;&quot; disabled&gt;
                &lt;i class=&quot;fa-solid fa-xmark&quot;&gt;&lt;/i&gt; Cancel
            &lt;/button&gt;
        &lt;/div&gt;
        &lt;button type=&quot;submit&quot; id=&quot;submitButton&quot; class=&quot;btn btn-primary bg-gradient&quot;&gt;
            &lt;i class=&quot;fa-solid fa-floppy-disk&quot;&gt;&lt;/i&gt; Save
        &lt;/button&gt;
    &lt;/div&gt;
&lt;/div&gt;</pre>
            </div>
            <hr>
            This is the code for modal sheet
            <div class="rounded bg-body-tertiary p-3 text-break">
                <pre class="mb-0">&lt;div class=&quot;modal modal-sheet p-4 py-md-5 fade&quot; id=&quot;sheetModal&quot; data-bs-backdrop=&quot;static&quot; data-bs-keyboard=&quot;false&quot; tabindex=&quot; -1&quot; aria-labelledby=&quot;sheetModal&quot; aria-hidden=&quot;true&quot; role=&quot;dialog&quot;&gt;
    &lt;div class=&quot;modal-dialog modal-dialog-centered&quot; role=&quot;document&quot;&gt;
        &lt;div class=&quot;modal-content bg-body-tertiary rounded-4 shadow-lg transparent-blur&quot;&gt;
            &lt;div class=&quot;modal-body p-4 text-center&quot;&gt;
                &lt;h5 class=&quot;mb-0&quot; id=&quot;sheetMessage&quot;&gt;Message?&lt;/h5&gt;
                &lt;h6 class=&quot;mb-0&quot; id=&quot;sheetSubmessage&quot;&gt;&lt;/h6&gt;
            &lt;/div&gt;
            &lt;div class=&quot;modal-footer flex-nowrap p-0&quot; style=&quot;border-top: 1px solid var(--bs-border-color-translucent);&quot;&gt;
                &lt;button type=&quot;button&quot; class=&quot;btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0&quot; data-bs-dismiss=&quot;modal&quot; style=&quot;border-right: 1px solid var(--bs-border-color-translucent);&quot;&gt;No&lt;/button&gt;
                &lt;button type=&quot;button&quot; class=&quot;btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0&quot; id=&quot;confirmSheet&quot;&gt;Yes&lt;/a&gt;
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