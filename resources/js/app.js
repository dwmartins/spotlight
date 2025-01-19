import { showAlert} from './helpers';

document.addEventListener('DOMContentLoaded', function () {
    AOS.init();

    // Initialize all tooltips automatically
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    if (window.sessionMessage) {
        console.log(window.sessionMessage)
        showAlert(window.sessionMessage.type, window.sessionMessage.text);
    }
});