import $ from 'jquery';
import selectize from '@selectize/selectize';

$(function() {

    /**
     * Back to top button in admin panel
     */
    var $backtotop = $('.back-to-top');
    var $btn_change_theme  = $('.btn-change-theme ');
    if ($backtotop.length) {
        var toggleBacktotop = function () {
            if ($(window).scrollTop() > 100) {
                $btn_change_theme.addClass('d-none');
                $backtotop.addClass('active');
            } else {
                $btn_change_theme.removeClass('d-none');
                $backtotop.removeClass('active');
            }
        };

        // Call the function on page load and on scroll
        $(window).on('load scroll', toggleBacktotop);
    }

    /**
     * Sidebar toggle in admin panel
     */
    if ($('.toggle-sidebar-btn').length) {
        $('.toggle-sidebar-btn').on('click', function() {
            $('body').toggleClass('toggle-sidebar');
        });
    }

    /**
     * Email settings view
     */
    $('#encryption').selectize({
        create: false,
        maxItems: 1,
        persist: false
    });

    /**
     * Basic info view
     */
    $('#keywords').selectize({
        plugins: ['remove_button'],
        delimiter: ',',
        persist: false,
        hideSelected: true,
        create: function(input) {
            return {
                value: input,
                text: input
            };
        },
        onItemRemove: function(value) {
            let selectize = this;
            selectize.removeOption(value);
        }
    });
});