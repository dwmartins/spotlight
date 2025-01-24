import $ from 'jquery';

/**
 * Retrieves a translated string and replaces placeholders.
 *
 * @param {string} key - The translation key to look up.
 * @param {Object} [replacements={}] - Key-value pairs for placeholder replacements.
 *   Example: { attribute: 'name' }
 * @returns {string} - Translated string with placeholders replaced, or the key if not found.
 *
 * @example
 * trans('FIELD_REQUIRED', { attribute: 'name' });
 * // Returns: "The name field is required."
 */
export function trans(key, replacements = {}) {
    let text = window.Translations[key] || key;

    for (const [placeholder, value] of Object.entries(replacements)) {
        const regex = new RegExp(`:${placeholder}`, 'g');
        text = text.replace(regex, value);
    }

    return text;
}

/**
 * @param {string} key 
 * @returns returns the configuration
 */
export function getWebsiteSetting(key) {
    return window.website_settings[key] || key
}

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
        messageHtml = `<span class="text-secondary ">${messageOrFields}</span>`;
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
export function toggleButtonLoading(button, isLoading) {
    
    if (!button.data('original-text')) {
        button.data('original-text', button.text());
    }
    
    const loadingText = button.data('trans-loading');
    const originalText = button.data('original-text');

    const spinnerHTML = `
        <span class="m-0 d-flex align-items-center justify-content-center gap-2">
            <div class="loader"></div>
            ${loadingText}
        </span>
    `;

    $(button).prop('disabled', isLoading).html(isLoading ? spinnerHTML : originalText);
}

export function toggleLoading(button, isLoading = false) {
    const spinner = button.querySelector('.spinner-loader');
    const btnText = button.querySelector('.btn-text');

    if (isLoading) {
        console.log('foi')
        button.setAttribute('disabled', 'true');

        const loadingText = button.getAttribute('data-trans-loading');
        if (spinner) spinner.classList.remove('d-none');

        if (btnText && loadingText) {
            button.setAttribute('data-default-text', btnText.textContent.trim());
            btnText.textContent = loadingText;
        }
    } else {
        button.removeAttribute('disabled');

        const defaultText = button.getAttribute('data-default-text');
        if (spinner) spinner.classList.add('d-none');

        if (btnText && defaultText) {
            btnText.textContent = defaultText;
        }
    }
}

window.toggleLoading = toggleLoading;