import $ from 'jquery';

export function showAlert(type, title, messageOrFields) {
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
            iconClass = 'fa-solid fa-circle-check custom_success';
            toastClasses.push('bg-success', 'text-dark');
            break;
        case 'error':
            iconClass = 'fa-solid fa-circle-xmark text-danger';
            toastClasses.push('bg-danger', 'text-dark');
            break;
        case 'info':
            iconClass = 'fa-solid fa-circle-exclamation text-warning';
            toastClasses.push('bg-warning', 'text-dark');
            break;
        default:
            break;
    }

    toastEl.classList.add(...toastClasses);

    const titleHtml = title ? `<strong class="me-auto">${title}</strong>` : '';
    
    let messageHtml;
    let iconPositionHtml = `<i class="${iconClass} fs-5 me-2"></i>`;

    if (typeof messageOrFields === 'object') {
        messageHtml = Object.entries(messageOrFields)
            .map(([field, messages]) => {
                return messages.map((msg) => `<div class="text-secondary">- ${msg}</div>`).join('');
            })
            .join('');
    } else {
        messageHtml = `<span class="text-secondary">${messageOrFields}</span>`;
    }

    if(titleHtml) {
        toastEl.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    <div class="d-flex align-items-center mb-2">
                        ${iconPositionHtml}
                        ${titleHtml}
                    </div>
                    ${messageHtml}
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;
    } else {
        toastEl.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    <div class="d-flex align-items-center mb-2">
                        <i class="${iconClass} fs-5 me-2"></i>
                        ${messageHtml}
                    </div>
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;
    }

    toastContainer.appendChild(toastEl);

    const toast = new bootstrap.Toast(toastEl);
    toast.show();

    toastEl.addEventListener('hidden.bs.toast', function () {
        toastEl.remove();
    });
}


// Function to show or hide the button loading state
export function showLoadingState(button, isLoading, label = 'Salvar', labelWait = 'Aguarde') {
    const spinnerHTML = `
        <span class="m-0 d-flex align-items-center justify-content-center gap-2">
            <div id="loader"></div>
            ${labelWait}
        </span>
    `;

    $(button).prop('disabled', isLoading).html(isLoading ? spinnerHTML : label);
}