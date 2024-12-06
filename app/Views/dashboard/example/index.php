<?= $this->extend('dashboard/templates/dashboard'); ?>
<?= $this->section('title'); ?>
<div class="d-flex justify-content-start align-items-center">
    <span class="fw-medium fs-5 flex-fill text-truncate"><?= $title; ?></span>
    <div id="loadingSpinner" class="spinner-border spinner-border-sm" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<div style="min-width: 1px; max-width: 1px;"></div>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<main class="main-content-inside">
    <div class="sticky-top" style="z-index: 99;">
        <ul class="list-group shadow-sm rounded-0">
            <li class="list-group-item border-top-0 border-end-0 border-start-0 bg-body-tertiary transparent-blur">
                <div class="no-fluid-content">
                    <div class="input-group input-group-sm">
                        <input type="search" class="form-control form-control-sm" id="externalSearch" placeholder="Search">
                        <button class="btn btn-success btn-sm bg-gradient" type="button" id="refreshButton"><i class="fa-solid fa-sync"></i></button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <div class="px-3 mt-3">
        <div class="no-fluid-content">
            <div class="mb-3">
                <table id="tabel" class="table table-sm table-hover m-0 p-0" style="width:100%; font-size: 9pt;">
                    <thead>
                        <tr class="align-middle">
                            <th scope="col" class="bg-body-secondary border-secondary" style="border-bottom-width: 2px;">#</th>
                            <th scope="col" class="bg-body-secondary border-secondary text-nowrap" style="border-bottom-width: 2px;">Actions</th>
                            <th scope="col" class="bg-body-secondary border-secondary" style="border-bottom-width: 2px;">Image</th>
                            <th scope="col" class="bg-body-secondary border-secondary" style="border-bottom-width: 2px;">Name</th>
                            <th scope="col" class="bg-body-secondary border-secondary" style="border-bottom-width: 2px;">Email</th>
                            <th scope="col" class="bg-body-secondary border-secondary" style="border-bottom-width: 2px;">Phone Number</th>
                            <th scope="col" class="bg-body-secondary border-secondary" style="border-bottom-width: 2px;">Address</th>
                        </tr>
                    </thead>
                    <tbody class="align-top">
                    </tbody>
                </table>
            </div>
            <div class="modal modal-sheet p-4 py-md-5 fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content bg-body-tertiary rounded-4 shadow-lg transparent-blur">
                        <div class="modal-body p-4 text-center">
                            <h5 class="mb-0" id="deleteMessage"></h5>
                        </div>
                        <div class="modal-footer flex-nowrap p-0" style="border-top: 1px solid var(--bs-border-color-translucent);">
                            <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" style="border-right: 1px solid var(--bs-border-color-translucent)!important;" data-bs-dismiss="modal">No</button>
                            <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" id="confirmDeleteBtn">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <form id="exampleForm" enctype="multipart/form-data" class="modal-content bg-body-tertiary shadow-lg transparent-blur">
                <div class="modal-header justify-content-between pt-2 pb-2" style="border-bottom: 1px solid var(--bs-border-color-translucent);">
                    <h6 class="pe-2 modal-title fs-6 text-truncate" id="exampleModalLabel" style="font-weight: bold;">Add Example Data</h6>
                    <button id="closeBtn" type="button" class="btn btn-danger bg-gradient" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body py-2">
                    <input type="hidden" id="exampleId" name="id">
                    <div class="form-floating mb-1 mt-1">
                        <input type="text" class="form-control" autocomplete="off" dir="auto" placeholder="name" id="name" name="name">
                        <label for="name">Name*</label>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-floating mb-1 mt-1">
                        <input type="text" class="form-control" autocomplete="off" dir="auto" placeholder="email" id="email" name="email">
                        <label for="email">Email*</label>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-floating mb-1 mt-1">
                        <input type="text" class="form-control" autocomplete="off" dir="auto" placeholder="phonenumber" id="phonenumber" name="phonenumber">
                        <label for="phonenumber">Phone Number*</label>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-floating mb-1 mt-1">
                        <input type="text" class="form-control" autocomplete="off" dir="auto" placeholder="address" id="address" name="address">
                        <label for="address">Address*</label>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-1 mt-1">
                        <label for="image" class="form-label mb-0">Image (max 8 MB)</label>
                        <input class="form-control" type="file" id="image" name="image">
                        <div class="invalid-feedback"></div>
                    </div>
                    <!-- Image preview -->
                    <div id="image_preview_div" style="display: none;" class="mb-1 mt-1">
                        <div class="d-flex justify-content-center">
                            <img id="image_preview" src="#" alt="Image Preview" class="img-thumbnail" style="max-width: 100%">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-end pt-2 pb-2" style="border-top: 1px solid var(--bs-border-color-translucent);">
                    <!-- Progress bar -->
                    <div class="mb-1 mt-1 w-100" id="uploadProgressDiv">
                        <div class="progress" style="border-top: 1px solid var(--bs-border-color-translucent); border-bottom: 1px solid var(--bs-border-color-translucent); border-left: 1px solid var(--bs-border-color-translucent); border-right: 1px solid var(--bs-border-color-translucent);">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-gradient" role="progressbar" style="width: 0%; transition: none;" id="uploadProgressBar"></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between w-100">
                        <div>
                            <button type="button" id="cancelButton" class="btn btn-danger bg-gradient" style="display: none;" disabled>
                                <i class="fa-solid fa-xmark"></i> Cancel
                            </button>
                        </div>
                        <button type="submit" id="submitButton" class="btn btn-primary bg-gradient">
                            <i class="fa-solid fa-floppy-disk"></i> Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
</div>
<?= $this->endSection(); ?>
<?= $this->section('toast'); ?>

<?= $this->endSection(); ?>
<?= $this->section('datatable'); ?>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
<script>
    // DataTables Functions
    $(document).ready(function() {
        let table;

        async function initializeDataTable() {
            table = $('#tabel').DataTable({
                "oLanguage": {
                    "oPaginate": {
                        "sFirst": '<i class="fa-solid fa-angles-left"></i>',
                        "sLast": '<i class="fa-solid fa-angles-right"></i>',
                        "sPrevious": '<i class="fa-solid fa-angle-left"></i>',
                        "sNext": '<i class="fa-solid fa-angle-right"></i>'
                    }
                },
                'dom': "<'d-lg-flex justify-content-lg-between align-items-lg-center mb-0'<'text-md-center text-lg-start'i><'d-md-flex justify-content-md-center d-lg-block'f>>" +
                    "<'d-lg-flex justify-content-lg-between align-items-lg-top'<'text-md-center text-lg-start mt-2'l><'mt-2 mb-2'B>>" +
                    "<'row'<'col-md-12'tr>>" +
                    "<'d-lg-flex justify-content-lg-between align-items-lg-center'<'text-md-center text-lg-start'><'d-md-flex justify-content-md-center d-lg-block'p>>",
                'initComplete': function(settings, json) {
                    $("#tabel").wrap("<div class='card shadow-sm mb-3 overflow-auto position-relative datatables-height'></div>");
                    $('.dataTables_filter input[type="search"]').css({
                        'width': '220px'
                    });
                    $('.dataTables_info').css({
                        'padding-top': '0',
                        'font-variant-numeric': 'tabular-nums'
                    });
                },
                "drawCallback": function() {
                    const api = this.api();
                    const pageInfo = api.page.info();
                    api.column(0, {
                        order: 'applied'
                    }).nodes().each(function(cell, i) {
                        const rowIndex = i + 1 + pageInfo.start;
                        cell.innerHTML = rowIndex;
                        $(cell).css({
                            'font-variant-numeric': 'tabular-nums'
                        });
                    });
                    $(".pagination").wrap("<div class='overflow-auto'></div>");
                    $(".pagination").addClass("pagination-sm");
                    $(".page-item .page-link").addClass("bg-gradient");

                    // Re-initialize tooltips after redraw
                    $('[data-bs-toggle="tooltip"]').tooltip();
                },
                'buttons': [{
                    text: '<i class="fa-solid fa-plus"></i> Add',
                    className: 'btn-primary btn-sm bg-gradient',
                    attr: {
                        id: 'addExampleBtn'
                    },
                    init: function(api, node, config) {
                        $(node).removeClass('btn-secondary')
                    },
                }],
                "search": {
                    "caseInsensitive": true
                },
                "searching": false, // Disable the internal search bar
                'pageLength': 12,
                'lengthMenu': [
                    [12, 24, 36, 48, 60],
                    [12, 24, 36, 48, 60]
                ],
                "autoWidth": true,
                "processing": false,
                "serverSide": true,
                "ajax": {
                    "url": "<?= base_url('/examples/getexamples') ?>",
                    "type": "POST",
                    "data": function(d) {
                        // Add the search parameter to the request
                        d.search = {
                            "value": $('#externalSearch').val()
                        };
                    },
                    beforeSend: function() {
                        // Show the custom processing spinner
                        $('#loadingSpinner').show();
                    },
                    complete: function() {
                        // Hide the custom processing spinner after the request is complete
                        $('#loadingSpinner').hide();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Hide the custom processing spinner on error
                        $('#loadingSpinner').hide();
                        // Show the Bootstrap error toast when the AJAX request fails
                        showFailedToast('Failed to load data. Please try again.');
                    }
                },
                columns: [{
                        data: null
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `<div class="btn-group" role="group">
                                <button class="btn btn-outline-body text-nowrap bg-gradient edit-btn" style="--bs-btn-padding-y: 0.15rem; --bs-btn-padding-x: 0.5rem; --bs-btn-font-size: 9pt;" data-id="${row.id}" data-bs-toggle="tooltip" data-bs-title="Edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn btn-outline-danger text-nowrap bg-gradient delete-btn" style="--bs-btn-padding-y: 0.15rem; --bs-btn-padding-x: 0.5rem; --bs-btn-font-size: 9pt;" data-id="${row.id}" data-bs-toggle="tooltip" data-bs-title="Delete"><i class="fa-solid fa-trash"></i></button>
                            </div>`;
                        }
                    },
                    {
                        data: 'image_url',
                        render: function(data, type, row) {
                            return `<img src="${data}" alt="${data}" style="width: 128px;">`;
                        }
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'phonenumber',
                        render: function(data, type, row) {
                            return `<span class='date'>+${data}</span>`;
                        }
                    },
                    {
                        data: 'address'
                    },
                ],
                "order": [
                    [3, 'desc']
                ],
                "columnDefs": [{
                    "targets": [0, 1, 2],
                    "orderable": false
                }, {
                    "targets": [0, 1],
                    "width": "0%"
                }, {
                    "targets": [3, 4],
                    "width": "50%"
                }],
            });

            // Initialize tooltips initially
            $('[data-bs-toggle="tooltip"]').tooltip();

            table.on('draw', function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            });

            // Bind the external search input to the table search
            $('#externalSearch').on('input', function() {
                table.search(this.value).draw(); // Trigger search on the table
            });

            $('#refreshButton').on('click', async function() {
                table.ajax.reload(null, false);
            });
        }

        // Initialize the DataTable
        initializeDataTable();
        // Show add example modal
        $('#addExampleBtn').click(function() {
            $('#exampleModalLabel').text('Add Example Data');
            $('#exampleForm')[0].reset();
            $('#exampleId').val('');
            $('#image_preview_div').hide();
            $('#image_preview').attr('src', '#');
            $('#exampleModal').modal('show');
        });
        // Show edit example modal
        $(document).on('click', '.edit-btn', async function() {
            var $this = $(this);
            var id = $this.data('id');
            $('[data-bs-toggle="tooltip"]').tooltip('hide');
            // Disable the button and show a spinner
            $this.prop('disabled', true).html(`<span class="spinner-border" style="width: 11px; height: 11px;" aria-hidden="true"></span>`);

            try {
                // Make the Axios GET request using async/await
                let response = await axios.get('<?= base_url('/examples/getexample') ?>/' + id);
                let data = response.data;

                // Set the modal title and form fields with the retrieved data
                $('#exampleModalLabel').text('Edit Example Data');
                $('#exampleId').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#phonenumber').val(data.phonenumber);
                $('#address').val(data.address);

                // Set the image preview, or hide the preview if no image is available
                if (data.image) {
                    $('#image_preview').attr('src', '<?= base_url('uploads/images') ?>/' + data.image);
                    $('#image_preview_div').show();
                } else {
                    $('#image_preview_div').hide();
                }

                // Show the modal
                $('#exampleModal').modal('show');
            } catch (error) {
                // Handle any error responses
                showFailedToast('An error occurred. Please try again.');
            } finally {
                // Re-enable the button after the request is completed
                $this.prop('disabled', false).html(`<i class="fa-solid fa-pen-to-square"></i>`);
            }
        });

        // Show image preview when a file is selected
        $('#image').change(function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image_preview').attr('src', e.target.result);
                $('#image_preview_div').show();
            };
            reader.readAsDataURL(this.files[0]);
        });

        // Store the ID of the example to be deleted
        var exampleIdToDelete;

        // Show delete confirmation modal
        $(document).on('click', '.delete-btn', function() {
            exampleIdToDelete = $(this).data('id');
            $('[data-bs-toggle="tooltip"]').tooltip('hide');
            $('#deleteMessage').html(`Are you sure want to delete this data?`);
            $('#deleteModal').modal('show');
        });

        // Confirm deletion
        $('#confirmDeleteBtn').click(async function() {
            $('#deleteModal button').prop('disabled', true);
            $('#deleteMessage').html(`Deleting, please wait...`);

            try {
                // Perform the delete operation
                let response = await axios.delete('<?= base_url('/examples/deleteexample') ?>/' + exampleIdToDelete);

                // Show success message
                showSuccessToast(response.data.message);

                // Reload the table
                table.ajax.reload();
            } catch (error) {
                // Handle any error responses
                showFailedToast('An error occurred. Please try again.');
            } finally {
                // Re-enable the delete button and hide the modal
                $('#deleteModal').modal('hide');
                $('#deleteModal button').prop('disabled', false);
            }
        });

        // Submit example form (Add/Edit)
        $('#exampleForm').submit(async function(e) {
            e.preventDefault();

            var url = $('#exampleId').val() ? '<?= base_url('/examples/updateexample') ?>' : '<?= base_url('/examples/addexample') ?>';
            var formData = new FormData(this);
            console.log("Form URL:", url);
            console.log("Form Data:", formData);

            const CancelToken = axios.CancelToken;
            const source = CancelToken.source();

            // Clear previous validation states
            $('#exampleForm .is-invalid').removeClass('is-invalid');
            $('#exampleForm .invalid-feedback').text('').hide();

            // Show processing button and progress bar
            $('#uploadProgressBar').removeClass('bg-danger').css('width', '0%');
            $('#cancelButton').prop('disabled', false).show();
            $('#submitButton').prop('disabled', true).html(`
                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                <span role="status">Processing <span id="uploadPercentage" style="font-variant-numeric: tabular-nums;">0%</span></span>
            `);

            // Disable form inputs
            $('#exampleForm input').prop('disabled', true);

            try {
                // Perform the post request with progress handling
                let response = await axios.post(url, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
                    onUploadProgress: function(progressEvent) {
                        if (progressEvent.lengthComputable) {
                            var percent = Math.round((progressEvent.loaded / progressEvent.total) * 100);
                            $('#uploadProgressBar').css('width', percent + '%');
                            $('#uploadPercentage').html(percent + '%');
                        }
                    },
                    cancelToken: source.token // Attach the token here
                });

                // Handle successful response
                if (response.data.success) {
                    showSuccessToast(response.data.message, 'success');
                    $('#exampleModal').modal('hide');
                    $('#uploadProgressBar').css('width', '0%');
                    table.ajax.reload();
                } else {
                    console.log("Validation Errors:", response.data.errors);

                    // Clear previous validation states
                    $('#exampleForm .is-invalid').removeClass('is-invalid');
                    $('#exampleForm .invalid-feedback').text('').hide();

                    // Display new validation errors
                    for (var field in response.data.errors) {
                        if (response.data.errors.hasOwnProperty(field)) {
                            var fieldElement = $('#' + field);
                            var feedbackElement = fieldElement.siblings('.invalid-feedback'); // Adjust if necessary

                            console.log("Target Field:", fieldElement);
                            console.log("Target Feedback:", feedbackElement);

                            if (fieldElement.length > 0 && feedbackElement.length > 0) {
                                fieldElement.addClass('is-invalid');
                                feedbackElement.text(response.data.errors[field]).show();

                                // Remove error message when the user corrects the input
                                fieldElement.on('input change', function() {
                                    $(this).removeClass('is-invalid');
                                    $(this).siblings('.invalid-feedback').text('').hide();
                                });
                            } else {
                                console.warn("Element not found for field:", field);
                            }
                        }
                    }
                    showFailedToast('Please correct the errors in the form.');
                    $('#uploadProgressBar').addClass('bg-danger');
                }
            } catch (error) {
                if (axios.isCancel(error)) {
                    showFailedToast(error.message);
                    $('#uploadProgressBar').css('width', '0%');
                } else {
                    showFailedToast('An error occurred. Please try again.');
                    $('#uploadProgressBar').addClass('bg-danger');
                }
            } finally {
                // Reset the form and UI elements
                $('#uploadPercentage').html('0%');
                $('#cancelButton').prop('disabled', true).hide();
                $('#submitButton').prop('disabled', false).html(`
                    <i class="fa-solid fa-floppy-disk"></i> Save
                `);
                $('#exampleForm input').prop('disabled', false);
            }

            // Attach the cancel functionality to the close button
            $('#closeBtn, #cancelButton').on('click', function() {
                source.cancel('Operation canceled by the user.');
            });
        });

        $('#exampleModal').on('hidden.bs.modal', function() {
            $('#exampleForm')[0].reset();
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').text('').hide();
            $('#image_preview_div').hide(); // Hide preview when modal is closed
            $('#image_preview').attr('src', '#');
            $('#uploadProgressBar').removeClass('bg-danger').css('width', '0%');
        });

        <?= $this->include('toast/index') ?>
    });
</script>
<?= $this->endSection(); ?>