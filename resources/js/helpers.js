export function showAlert(type, message) {
    const toastContainer = document.getElementById('toastContainer');

    const toastEl = document.createElement('div');
    toastEl.className = 'toast align-items-center border-0';
    toastEl.setAttribute('role', 'alert');
    toastEl.setAttribute('aria-live', 'assertive');
    toastEl.setAttribute('aria-atomic', 'true');

    let iconClass = '';
    const toastClasses = ['bg-white'];

    switch (type) {
        case 'success':
            iconClass = 'fa-regular fa-circle-check text-success';
            toastClasses.push('bg-success', 'text-dark');
            break;
        case 'error':
            iconClass = 'fa-solid fa-circle-exclamation text-danger';
            toastClasses.push('bg-danger', 'text-dark');
            break;
        case 'info':
            iconClass = 'fa-solid fa-triangle-exclamation text-warning';
            toastClasses.push('bg-warning', 'text-dark');
            break;
        default:
            break;
    }

    toastEl.classList.add(...toastClasses);

    toastEl.innerHTML = `
        <div class="d-flex">
            <div class="toast-body d-flex align-items-center gap-2">
                <i class="${iconClass} fs-5"></i>
                <span>${message}</span>
            </div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;

    toastContainer.appendChild(toastEl);

    const toast = new bootstrap.Toast(toastEl);
    toast.show();

    toastEl.addEventListener('hidden.bs.toast', function () {
        toastEl.remove();
    });
}
