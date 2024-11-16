function showSuccessToast(message) {
var toastHTML = `<div id="toast" class="toast fade align-items-center text-bg-success border border-success rounded-3 transparent-blur" role="alert" aria-live="assertive" aria-atomic="true">
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
var toastHTML = `<div id="toast" class="toast fade align-items-center text-bg-danger border border-danger rounded-3 transparent-blur" role="alert" aria-live="assertive" aria-atomic="true">
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