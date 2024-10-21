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
<main class="col-md-9 ms-sm-auto col-lg-10 px-3 px-md-4 pt-3">
    <div class="mb-2">
        <table id="tabel" class="table table-sm table-hover" style="width:100%; font-size: 9pt;">
            <thead>
                <tr class="align-middle">
                    <th scope="col" class="bg-body-secondary border-secondary" style="border-bottom-width: 2px;">#</th>
                    <th scope="col" class="bg-body-secondary border-secondary text-nowrap" style="border-bottom-width: 2px;">Actions</th>
                    <th scope="col" class="bg-body-secondary border-secondary" style="border-bottom-width: 2px;">Full Name</th>
                    <th scope="col" class="bg-body-secondary border-secondary" style="border-bottom-width: 2px;">User Name</th>
                    <th scope="col" class="bg-body-secondary border-secondary" style="border-bottom-width: 2px;">Role</th>
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
                    <h5 class="mb-0" id="deleteMessage">Are you sure want to delete this user?</h5>
                </div>
                <div class="modal-footer flex-nowrap p-0" style="border-top: 1px solid var(--bs-border-color-translucent);">
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" style="border-right: 1px solid var(--bs-border-color-translucent)!important;" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" id="confirmDeleteBtn">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-sheet p-4 py-md-5 fade" id="resetPasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-body-tertiary rounded-4 shadow-lg transparent-blur">
                <div class="modal-body p-4 text-center">
                    <h5 class="mb-0" id="resetPasswordMessage"></h5>
                </div>
                <div class="modal-footer flex-nowrap p-0" style="border-top: 1px solid var(--bs-border-color-translucent);">
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" style="border-right: 1px solid var(--bs-border-color-translucent)!important;" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" id="confirmResetPasswordBtn">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="userModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable rounded-3">
            <form id="userForm" enctype="multipart/form-data" class="modal-content bg-body-tertiary shadow-lg transparent-blur">
                <div class="modal-header justify-content-between pt-2 pb-2" style="border-bottom: 1px solid var(--bs-border-color-translucent);">
                    <h6 class="pe-2 modal-title fs-6 text-truncate" id="userModalLabel" style="font-weight: bold;">Add User</h6>
                    <button type="button" class="btn btn-danger btn-sm bg-gradient ps-0 pe-0 pt-0 pb-0 rounded-3" data-bs-dismiss="modal" aria-label="Close"><span data-feather="x" class="mb-0" style="width: 30px; height: 30px;"></span></button>
                </div>
                <div class="modal-body py-2">
                    <input type="hidden" id="userId" name="id_user">
                    <input type="hidden" id="original_username" name="original_username">
                    <div class="form-floating mb-1 mt-1">
                        <input type="text" class="form-control" autocomplete="off" dir="auto" placeholder="fullname" id="fullname" name="fullname">
                        <label for="fullname">Full Name*</label>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-floating mb-1 mt-1">
                        <input type="text" class="form-control" autocomplete="off" dir="auto" placeholder="username" id="username" name="username">
                        <label for="username">Full Name*</label>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-floating mb-1 mt-1">
                        <select class="form-select" id="role" name="role" aria-label="role">
                            <option value="">-- Select Role --</option>
                            <option value="Administrator">Administrator</option>
                            <option value="User">User</option>
                        </select>
                        <label for="role">Role</label>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer justify-content-end pt-2 pb-2" style="border-top: 1px solid var(--bs-border-color-translucent);">
                    <button type="submit" id="submitButton" class="btn btn-primary bg-gradient rounded-3">
                        <i class="fa-solid fa-floppy-disk"></i> Save
                    </button>
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
                    "<'d-lg-flex justify-content-lg-between align-items-lg-center'<'text-md-center text-lg-start mt-2'l><'mt-2 mb-2 mb-lg-0'B>>" +
                    "<'row'<'col-md-12'tr>>" +
                    "<'d-lg-flex justify-content-lg-between align-items-lg-center'<'text-md-center text-lg-start'><'d-md-flex justify-content-md-center d-lg-block'p>>",
                'initComplete': function(settings, json) {
                    $("#tabel").wrap("<div class='overflow-auto position-relative'></div>");
                    $('.dataTables_filter input[type="search"]').css({
                        'width': '220px'
                    });
                    $('.dataTables_info').css({
                        'padding-top': '0',
                        'font-variant-numeric': 'tabular-nums'
                    });
                },
                "drawCallback": function() {
                    var api = this.api();
                    api.column(0, {
                        order: 'applied'
                    }).nodes().each(function(cell, i) {
                        cell.innerHTML = i + 1;
                        $(cell).css({
                            'font-variant-numeric': 'tabular-nums'
                        });
                    });
                    $(".pagination").wrap("<div class='overflow-auto'></div>");
                    $(".pagination").addClass("pagination-sm");
                    $('.pagination-sm').css({
                        '--bs-pagination-border-radius': 'var(--bs-border-radius-lg)'
                    });
                    $(".page-item .page-link").addClass("bg-gradient");
                    $(".form-control").addClass("rounded-3");
                    $(".form-select").addClass("rounded-3");

                    // Re-initialize tooltips after table redraw
                    $('[data-bs-toggle="tooltip"]').tooltip();
                },
                'buttons': [{
                    action: function(e, dt, node, config) {
                        dt.ajax.reload(null, false);
                    },
                    text: '<i class="fa-solid fa-arrows-rotate"></i> Refresh',
                    className: 'btn-body btn-sm bg-gradient rounded-start-3',
                    init: function(api, node, config) {
                        $(node).removeClass('btn-secondary');
                    },
                }, {
                    text: '<i class="fa-solid fa-plus"></i> Add User',
                    className: 'btn-primary btn-sm bg-gradient rounded-end-3',
                    attr: {
                        id: 'addUserBtn'
                    },
                    init: function(api, node, config) {
                        $(node).removeClass('btn-secondary');
                    },
                }],
                "search": {
                    "caseInsensitive": true
                },
                'pageLength': 25,
                'lengthMenu': [
                    [25, 50, 100, 250, 500],
                    [25, 50, 100, 250, 500]
                ],
                "autoWidth": true,
                "processing": false,
                "serverSide": true,
                "ajax": {
                    "url": "<?= base_url('/users/getusers') ?>",
                    "type": "POST",
                    "data": function(d) {
                        // Include additional parameters
                        d.search = {
                            "value": $('.dataTables_filter input[type="search"]').val()
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
                            <button class="btn btn-outline-body text-nowrap bg-gradient rounded-start-3 resetpwd-btn" style="--bs-btn-padding-y: 0.15rem; --bs-btn-padding-x: 0.5rem; --bs-btn-font-size: 9pt;" data-id="${row.id_user}" data-bs-toggle="tooltip" data-bs-title="Reset Password"><i class="fa-solid fa-key"></i></button>
                            <button class="btn btn-outline-body text-nowrap bg-gradient edit-btn" style="--bs-btn-padding-y: 0.15rem; --bs-btn-padding-x: 0.5rem; --bs-btn-font-size: 9pt;" data-id="${row.id_user}" data-bs-toggle="tooltip" data-bs-title="Edit"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="btn btn-outline-danger text-nowrap bg-gradient rounded-end-3 delete-btn" style="--bs-btn-padding-y: 0.15rem; --bs-btn-padding-x: 0.5rem; --bs-btn-font-size: 9pt;" data-id="${row.id_user}" data-bs-toggle="tooltip" data-bs-title="Delete"><i class="fa-solid fa-trash"></i></button>
                        </div>`;
                        }
                    },
                    {
                        data: 'fullname'
                    },
                    {
                        data: 'username'
                    },
                    {
                        data: 'role'
                    },
                ],
                "order": [
                    [2, 'desc']
                ],
                "columnDefs": [{
                    "targets": [0, 1],
                    "orderable": false
                }, {
                    "targets": [0, 1],
                    "width": "0%"
                }, {
                    "targets": [2, 3],
                    "width": "50%"
                }],
            });
            // Initialize tooltips initially
            $('[data-bs-toggle="tooltip"]').tooltip();
        }

        // Initialize the DataTable
        initializeDataTable();
        // Show add user modal
        $('#addUserBtn').click(function() {
            $('#userModalLabel').text('Add User');
            $('#userForm')[0].reset();
            $('#userId').val('');
            $('#userModal').modal('show');
        });
        // Show edit user modal
        $(document).on('click', '.edit-btn', async function() {
            const $this = $(this);
            const id = $this.data('id');
            // Hide all active Bootstrap tooltips
            $('[data-bs-toggle="tooltip"]').tooltip('hide');
            // Disable the button and show the loading spinner
            $this.prop('disabled', true).html(`<span class="spinner-border" style="width: 11px; height: 11px;" aria-hidden="true"></span>`);

            try {
                // Make the GET request
                const response = await axios.get(`<?= base_url('/users/getuser') ?>/${id}`);
                const data = response.data;

                // Set the modal title and form fields with the retrieved data
                $('#userModalLabel').text('Edit User');
                $('#userId').val(data.id_user);
                $('#fullname').val(data.fullname);
                $('#username').val(data.username);
                $('#role').val(data.role);

                // Set the original_username hidden field
                $('#original_username').val(data.username);

                // Show the modal
                $('#userModal').modal('show');
            } catch (error) {
                // Handle any error responses
                showFailedToast('An error occurred. Please try again.');
            } finally {
                // Re-enable the button and restore the original HTML
                $this.prop('disabled', false).html(`<i class="fa-solid fa-pen-to-square"></i>`);
            }
        });

        // Store the ID of the user to be deleted
        var userIdToDelete;

        // Show delete confirmation modal
        $(document).on('click', '.delete-btn', function() {
            userIdToDelete = $(this).data('id');
            $('[data-bs-toggle="tooltip"]').tooltip('hide');
            $('#deleteMessage').html(`Are you sure want to delete this user?`);
            $('#deleteModal').modal('show');
        });

        $(document).on('click', '.resetpwd-btn', function() {
            userIdToDelete = $(this).data('id');
            $('[data-bs-toggle="tooltip"]').tooltip('hide');
            $('#resetPasswordMessage').html(`Are you sure want to reset this user's password?`);
            $('#resetPasswordModal').modal('show');
        });

        // Confirm deletion
        $('#confirmDeleteBtn').click(async function() {
            // Disable all buttons in the modal
            $('#deleteModal button').prop('disabled', true);
            $('#deleteMessage').html('Deleting, please wait...');

            try {
                // Perform the delete request
                const response = await axios.delete(`<?= base_url('/users/deleteuser') ?>/${userIdToDelete}`);

                // Show success message
                showSuccessToast(response.data.message);

                // Reload the table
                table.ajax.reload();
            } catch (error) {
                // Handle any error responses
                showFailedToast('An error occurred. Please try again.');
            } finally {
                // Hide the modal and re-enable the delete button
                $('#deleteModal').modal('hide');
                $('#deleteModal button').prop('disabled', false);
            }
        });

        $('#confirmResetPasswordBtn').click(async function() {
            // Disable all buttons in the reset password modal
            $('#resetPasswordModal button').prop('disabled', true);
            $('#resetPasswordMessage').html('Processing, please wait...');

            try {
                // Perform the reset password request
                const response = await axios.post(`<?= base_url('/users/resetpassword') ?>/${userIdToDelete}`);

                // Show success message
                showSuccessToast(response.data.message);

                // Reload the table
                table.ajax.reload();
            } catch (error) {
                // Handle any error responses
                showFailedToast('An error occurred. Please try again.');
            } finally {
                // Hide the modal and re-enable the reset password button
                $('#resetPasswordModal').modal('hide');
                $('#resetPasswordModal button').prop('disabled', false);
            }
        });

        // Submit user form (Add/Edit)
        $('#userForm').submit(async function(e) {
            e.preventDefault();

            const url = $('#userId').val() ? '<?= base_url('/users/updateuser') ?>' : '<?= base_url('/users/adduser') ?>';
            const formData = new FormData(this);
            console.log("Form URL:", url);
            console.log("Form Data:", $(this).serialize());

            // Clear previous validation states
            $('#userForm .is-invalid').removeClass('is-invalid');
            $('#userForm .invalid-feedback').text('').hide();

            // Show processing state
            $('#submitButton').prop('disabled', true).html(`
                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                <span role="status">Processing, please wait...</span>
            `);
            $('#userForm input, #userForm select, #closeBtn').prop('disabled', true);

            try {
                const response = await axios.post(url, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });

                // Handle the success response
                if (response.data.success) {
                    showSuccessToast(response.data.message, 'success');
                    $('#userModal').modal('hide');
                    table.ajax.reload();
                } else {
                    console.log("Validation Errors:", response.data.errors);

                    // Clear previous validation states
                    $('#userForm .is-invalid').removeClass('is-invalid');
                    $('#userForm .invalid-feedback').text('').hide();

                    // Display new validation errors
                    for (const field in response.data.errors) {
                        if (response.data.errors.hasOwnProperty(field)) {
                            const fieldElement = $('#' + field);
                            const feedbackElement = fieldElement.siblings('.invalid-feedback'); // Adjust if necessary

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
                }
            } catch (error) {
                // Handle any error responses
                showFailedToast('An error occurred. Please try again.');
            } finally {
                // Re-enable the submit button and other inputs after the request is completed
                $('#submitButton').prop('disabled', false).html(`
                    <i class="fa-solid fa-floppy-disk"></i> Save
                `);
                $('#userForm input, #userForm select, #closeBtn').prop('disabled', false);
            }
        });

        $('#userModal').on('hidden.bs.modal', function() {
            $('#userForm')[0].reset();
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').text('').hide();
        });
        // Show toast notification
        function showSuccessToast(message) {
            var toastHTML = `<div id="toast" class="toast fade show align-items-center text-bg-success border border-success rounded-3 transparent-blur" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body d-flex align-items-start">
                    <div style="width: 24px; text-align: center;">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div class="w-100 mx-2 text-start" id="toast-message">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>`;
            var toastElement = $(toastHTML);
            $('#toastContainer').append(toastElement); // Make sure there's a container with id `toastContainer`
            var toast = new bootstrap.Toast(toastElement);
            toast.show();
        }

        function showFailedToast(message) {
            var toastHTML = `<div id="toast" class="toast fade show align-items-center text-bg-danger border border-danger rounded-3 transparent-blur" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body d-flex align-items-start">
                    <div style="width: 24px; text-align: center;">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </div>
                    <div class="w-100 mx-2 text-start" id="toast-message">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>`;
            var toastElement = $(toastHTML);
            $('#toastContainer').append(toastElement); // Make sure there's a container with id `toastContainer`
            var toast = new bootstrap.Toast(toastElement);
            toast.show();
        }
    });
</script>
<?= $this->endSection(); ?>