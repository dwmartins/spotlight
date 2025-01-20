import { showAlert} from './helpers';

document.addEventListener('DOMContentLoaded', () => {
    AOS.init();

    // Initialize all tooltips automatically
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map((tooltipTriggerEl) => {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // get the notifications if there are any
    if (window.sessionMessage) {
        showAlert(window.sessionMessage.type, window.sessionMessage.title, window.sessionMessage.fields);
    }
});