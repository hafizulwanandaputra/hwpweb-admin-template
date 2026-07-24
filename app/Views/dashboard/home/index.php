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
            <p>
                For more information about Bootstrap 5.3 components, <a href="https://getbootstrap.com/docs/5.3/getting-started/introduction/" target="_blank">click here</a>.
            </p>
            <hr />
            <p>
                The <code>&lt;body&gt;</code> tag uses <code>bg-body-hwpweb</code> class, which means:
            </p>
            <ol>
                <li>
                    If the light theme is applied, the background color is <code>--bs-tertiary-bg</code>.
                </li>
                <li>
                    If the dark theme is applied, the background color is <code>--bs-body-bg</code>.
                </li>
            </ol>
            <h2>Gradient Enabled by Default</h2>
            <p>
                Bootstrap 5.3 elements has been modified to use gradients on some elements but not all. The gradient is applied by default to the following elements:
            </p>
            <ol>
                <li class="mb-2">
                    Basic button
                    <div>
                        <button type="button" class="btn btn-primary">
                            Primary
                        </button>
                        <button type="button" class="btn btn-secondary">
                            Secondary
                        </button>
                        <button type="button" class="btn btn-success">
                            Success
                        </button>
                        <button type="button" class="btn btn-danger">
                            Danger
                        </button>
                        <button type="button" class="btn btn-warning">
                            Warning
                        </button>
                        <button type="button" class="btn btn-info">
                            Info
                        </button>
                        <button type="button" class="btn btn-light">
                            Light
                        </button>
                        <button type="button" class="btn btn-dark">
                            Dark
                        </button>
                    </div>
                </li>
                <li class="mb-2">
                    Pagination at <code>page-link</code> class
                    <nav>
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link">Previous</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </li>
                <li class="mb-2">
                    Pill nav tabs
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Active</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                </li>
            </ol>
            <h2>New Components</h2>
            <p>
                These are new components that are not available in Bootstrap 5.3, but are added in this template:
            </p>
            <ol>
                <li class="mb-2">
                    Basic button using <code>btn-body</code> and <code>btn-outline-body</code> class
                    <div>
                        <button type="button" class="btn btn-body">
                            Button
                        </button>
                        <button type="button" class="btn btn-outline-body">
                            Outline Button
                        </button>
                    </div>
                </li>
            </ol>
            <h2>New Modal Design</h2>
            For modal, use this element for header:
            <div class="rounded bg-body border p-3 text-break">
                <pre class="mb-0">
&lt;div class=&quot;modal-header justify-content-between pt-2 pb-2&quot; style=&quot;border-bottom: 1px solid var(--bs-border-color-translucent);&quot;&gt;
    &lt;h6 class=&quot;pe-2 modal-title fs-6 text-truncate&quot; style=&quot;font-weight: bold;&quot;&gt;Modal Title&lt;/h6&gt;
    &lt;button id=&quot;closeBtn&quot; type=&quot;button&quot; class=&quot;btn-close&quot; data-bs-dismiss=&quot;modal&quot; aria-label=&quot;Close&quot;&gt;&lt;/button&gt;
&lt;/div&gt;</pre>
            </div>
            and for footer:
            <div class="rounded bg-body border p-3 text-break">
                <pre class="mb-0">
&lt;div class=&quot;modal-footer justify-content-end pt-2 pb-2&quot; style=&quot;border-top: 1px solid var(--bs-border-color-translucent);&quot;&gt;
    &lt;div class=&quot;mb-1 mt-1 w-100&quot; id=&quot;uploadProgressDiv&quot;&gt;
        &lt;div class=&quot;progress&quot; style=&quot;border-top: 1px solid var(--bs-border-color-translucent); border-bottom: 1px solid var(--bs-border-color-translucent); border-left: 1px solid var(--bs-border-color-translucent); border-right: 1px solid var(--bs-border-color-translucent);&quot;&gt;
            &lt;div class=&quot;progress-bar progress-bar-striped progress-bar-animated &quot; role=&quot;progressbar&quot; style=&quot;width: 0%; transition: none;&quot; id=&quot;uploadProgressBar&quot;&gt;&lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class=&quot;d-flex justify-content-between w-100&quot;&gt;
        &lt;div&gt;
            &lt;button type=&quot;button&quot; id=&quot;cancelButton&quot; class=&quot;btn btn-danger &quot; style=&quot;display: none;&quot; disabled&gt;
                &lt;i class=&quot;fa-solid fa-xmark&quot;&gt;&lt;/i&gt; Cancel
            &lt;/button&gt;
        &lt;/div&gt;
        &lt;button type=&quot;submit&quot; id=&quot;submitButton&quot; class=&quot;btn btn-primary &quot;&gt;
              &lt;i class=&quot;fa-solid fa-floppy-disk&quot;&gt;&lt;/i&gt; Save
        &lt;/button&gt;
    &lt;/div&gt;
&lt;/div&gt;</pre>
            </div>
            This is the code for modal sheet
            <div class="rounded bg-body border p-3 text-break">
                <pre class="mb-0">
&lt;div class=&quot;modal modal-sheet p-4 py-md-5 fade&quot; id=&quot;sheetModal&quot; data-bs-backdrop=&quot;static&quot; data-bs-keyboard=&quot;false&quot; tabindex=&quot; -1&quot; aria-labelledby=&quot;sheetModal&quot; aria-hidden=&quot;true&quot; role=&quot;dialog&quot;&gt;
    &lt;div class=&quot;modal-dialog modal-dialog-centered&quot; role=&quot;document&quot;&gt;
        &lt;div class=&quot;modal-content bg-body-tertiary rounded-5 shadow-lg transparent-blur&quot;&gt;
            &lt;div class=&quot;modal-body p-4&quot;&gt;
                &lt;h5 class=&quot;mb-0&quot; id=&quot;sheetMessage&quot;&gt;&lt;/h5&gt;
                &lt;h6 class=&quot;mb-0 fw-normal&quot; id=&quot;sheetSubmessage&quot;&gt;&lt;/h6&gt;
                &lt;div class=&quot;row gx-2 pt-4&quot;&gt;
                    &lt;div class=&quot;col d-grid&quot;&gt;
                        &lt;button type=&quot;button&quot; class=&quot;btn btn-lg btn-body  fs-6 mb-0 rounded-4&quot; data-bs-dismiss=&quot;modal&quot;&gt;No&lt;/button&gt;
                    &lt;/div&gt;
                    &lt;div class=&quot;col d-grid&quot;&gt;
                        &lt;button type=&quot;submit&quot; class=&quot;btn btn-lg btn-primary  fs-6 mb-0 rounded-4&quot; id=&quot;confirmSheet&quot;&gt;Yes&lt;/button&gt;
                    &lt;/div&gt;
                &lt;/div&gt;
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