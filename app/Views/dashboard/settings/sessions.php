<?= $this->extend('dashboard/templates/dashboard'); ?>
<?= $this->section('title'); ?>
<div class="d-flex justify-content-start align-items-center">
    <a class="fs-5 me-3" href="<?= base_url('/settings'); ?>"><i class="fa-solid fa-arrow-left"></i></a>
    <span class="fw-medium fs-5 flex-fill text-truncate"><?= $title; ?></span>
    <div id="loadingSpinner" class="px-2">
        <?= $this->include('spinner/spinner'); ?>
    </div>
</div>
<div style="min-width: 1px; max-width: 1px;"></div>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<main class="main-content-inside">
    <div class="sticky-top px-3 pt-2" style="z-index: 99;">
        <ul class="list-group no-fluid-content shadow-sm border border-bottom-0">
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
                <table id="tabel" class="table table-sm table-hover m-0 p-0" style="width:100%; font-size: 0.75em;">
                    <thead>
                        <tr class="align-middle">
                            <th scope="col" class="bg-body-secondary border-secondary" style="border-bottom-width: 2px;">No.</th>
                            <th scope="col" class="bg-body-secondary border-secondary text-nowrap" style="border-bottom-width: 2px;">Action</th>
                            <th scope="col" class="bg-body-secondary border-secondary" style="border-bottom-width: 2px;">User</th>
                            <th scope="col" class="bg-body-secondary border-secondary" style="border-bottom-width: 2px;">IP Address</th>
                            <th scope="col" class="bg-body-secondary border-secondary" style="border-bottom-width: 2px;">User Agent</th>
                            <th scope="col" class="bg-body-secondary border-secondary" style="border-bottom-width: 2px;">Login Time</th>
                            <th scope="col" class="bg-body-secondary border-secondary" style="border-bottom-width: 2px;">Expiration</th>
                        </tr>
                    </thead>
                    <tbody class="align-top">
                    </tbody>
                </table>
            </div>
        </div>
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
    <div class="modal modal-sheet p-4 py-md-5 fade" id="flushModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="flushModal" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-body-tertiary rounded-4 shadow-lg transparent-blur">
                <div class="modal-body p-4 text-center">
                    <h5 class="mb-0" id="flushMessage"></h5>
                </div>
                <div class="modal-footer flex-nowrap p-0" style="border-top: 1px solid var(--bs-border-color-translucent);">
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" data-bs-dismiss="modal" style="border-right: 1px solid var(--bs-border-color-translucent);">No</button>
                    <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" id="confirmFlushBtn">Yes</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-sheet p-4 py-md-5 fade" id="deleteExpiredModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteExpiredModalLabel" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-body-tertiary rounded-4 shadow-lg transparent-blur">
                <div class="modal-body p-4 text-center">
                    <h5 class="mb-0" id="deleteExpiredMessage"></h5>
                </div>
                <div class="modal-footer flex-nowrap p-0" style="border-top: 1px solid var(--bs-border-color-translucent);">
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" style="border-right: 1px solid var(--bs-border-color-translucent)!important;" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" id="confirmDeleteExpiredBtn">Yes</button>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection(); ?>
<?= $this->section('datatable'); ?>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#tabel').DataTable({
            "oLanguage": {
                "sEmptyTable": 'There is no session. A session will appear when someone logs into this system on another device.',
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
                $(".pagination").wrap("<div class='overflow-auto'></div>");
                $(".pagination").addClass("pagination-sm");
                $(".page-item .page-link").addClass("bg-gradient");
            },
            'buttons': [{
                text: '<i class="fa-solid fa-broom"></i> Cleanup',
                className: 'btn-danger btn-sm bg-gradient',
                attr: {
                    id: 'flushBtn'
                },
                init: function(api, node, config) {
                    $(node).removeClass('btn-secondary')
                },
            }, {
                text: '<i class="fa-solid fa-trash"></i> Expired',
                className: 'btn-danger btn-sm bg-gradient',
                attr: {
                    id: 'deleteExpiredBtn'
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
                "url": "<?= base_url('/settings/sessionslist') ?>",
                "type": "POST",
                "data": function(d) {
                    d.search = {
                        "value": $('#externalSearch').val()
                    };
                },
                beforeSend: function() {
                    $('#loadingSpinner').show();
                },
                complete: function() {
                    $('#loadingSpinner').hide();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#loadingSpinner').hide();
                    showFailedToast('Gagal memuat data. Silakan coba lagi.');
                }
            },
            columns: [{
                    data: 'no',
                    render: function(data, type, row) {
                        return `<span class="date" style="display: block; text-align: center;">${data}</span>`;
                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                            <div class="d-grid">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-outline-danger text-nowrap bg-gradient delete-btn" style="--bs-btn-padding-y: 0.15rem; --bs-btn-padding-x: 0.5rem; --bs-btn-font-size: 1em;" data-id="${row.id}" data-username="${row.username}" data-bs-toggle="tooltip" data-bs-title="Delete"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </div>
                        `;
                    }
                },
                {
                    data: 'username',
                    render: function(data, type, row) {
                        // Get current date and time in the same format as 'expires_at'
                        const currentDate = new Date();
                        const expiresAt = new Date(row.expires_at); // Assuming 'expires_at' is in a standard date-time string format

                        // Check if 'expires_at' has passed the current date and time
                        const isExpired = expiresAt < currentDate;
                        const statusBadge = isExpired ?
                            '<span class="badge bg-danger bg-gradient">Expired</span>' :
                            '<span class="badge bg-success bg-gradient">Active</span>';
                        return `<strong>${row.fullname}</strong><br>@${data} ${statusBadge}`;
                    }
                },
                {
                    data: 'ip_address',
                    render: function(data, type, row) {
                        return `<span class="date text-nowrap">${data}</span>`;
                    }
                },
                {
                    data: 'user_agent'
                },
                {
                    data: 'created_at',
                    render: function(data, type, row) {
                        return `<span class="date text-nowrap">${data}</span>`;
                    }
                },
                {
                    data: 'expires_at',
                    render: function(data, type, row) {
                        return `<span class="date text-nowrap">${data}</span>`;
                    }
                },
            ],
            "order": [
                [5, 'desc']
            ],
            "columnDefs": [{
                "target": [1],
                "orderable": false
            }, {
                "target": [0, 1, 3, 5, 6],
                "width": "0%"
            }, {
                "target": [2],
                "width": "25%"
            }, {
                "target": [4],
                "width": "75%"
            }],
        });

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

        var userId;
        var userName;

        $(document).on('click', '.delete-btn', function() {
            userId = $(this).data('id');
            userName = $(this).data('username');
            $('[data-bs-toggle="tooltip"]').tooltip('hide');
            $('#deleteMessage').html(`Delete session from @` + userName + `?`);
            $('#deleteModal').modal('show');
        });

        $(document).on('click', '#flushBtn', function() {
            $('#flushMessage').html(`Performing a session cleanup will log out all users except you on this device and require you to log back in. Do you want to continue?`);
            $('#flushModal').modal('show');
        });

        $(document).on('click', '#deleteExpiredBtn', function() {
            $('#deleteExpiredMessage').html(`Delete all expired sessions?`);
            $('#deleteExpiredModal').modal('show');
        });

        $('#confirmDeleteBtn').click(async function() {
            $('#deleteModal button').prop('disabled', true);
            $('#deleteMessage').html('Deleting, please wait...');

            try {
                await axios.delete(`<?= base_url('/settings/deletesession') ?>/${userId}`);
                table.ajax.reload(null, false);
            } catch (error) {
                if (error.response.request.status === 404) {
                    showFailedToast(error.response.data.error);
                } else {
                    showFailedToast('An error occured. Please try again later.<br>' + error);
                }
            } finally {
                $('#deleteModal').modal('hide');
                $('#deleteModal button').prop('disabled', false);
            }
        });

        $('#confirmFlushBtn').click(async function() {
            $('#flushModal button').prop('disabled', true);
            $('#flushMessage').html('Cleaning up, please wait...');

            try {
                const response = await axios.delete(`<?= base_url('/settings/flush') ?>`);
                showSuccessToast(response.data.message);
                table.ajax.reload(null, false);
            } catch (error) {
                if (error.response.request.status === 404) {
                    showFailedToast(error.response.data.error);
                } else {
                    showFailedToast('An error occured. Please try again later.<br>' + error);
                }
            } finally {
                $('#flushModal').modal('hide');
                $('#flushModal button').prop('disabled', false);
            }
        });

        $('#confirmDeleteExpiredBtn').click(async function() {
            $('#deleteExpiredModal button').prop('disabled', true);
            $('#deleteExpiredMessage').html('Deleting, please wait...');

            try {
                const response = await axios.delete(`<?= base_url('/settings/deleteexpired') ?>`);
                showSuccessToast(response.data.message);
                table.ajax.reload(null, false);
            } catch (error) {
                if (error.response.request.status === 404) {
                    showFailedToast(error.response.data.error);
                } else {
                    showFailedToast('An error occured. Please try again later.<br>' + error);
                }
            } finally {
                $('#deleteExpiredModal').modal('hide');
                $('#deleteExpiredModal button').prop('disabled', false);
            }
        });

        <?= $this->include('toast/index') ?>
    });
</script>
<?= $this->endSection(); ?>