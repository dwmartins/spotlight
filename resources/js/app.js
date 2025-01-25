import { showAlert} from './helpers';
import $ from 'jquery';

$(function() {
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

    // Click event to toggle password visibility and icon
    $('.icon_show_password').on('click', function () {
        var $icon = $(this);
        var $input = $(this).siblings('input');

        if ($input.attr('type') === 'password') {
            $input.attr('type', 'text');
            $icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            $input.attr('type', 'password');
            $icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });
});