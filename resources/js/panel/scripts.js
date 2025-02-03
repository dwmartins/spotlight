import $ from 'jquery';
import selectize from '@selectize/selectize';

$(function() {

    // Email settings
    $('#encryption').selectize({
        create: false,
        maxItems: 1,
        persist: false
    });

    //Basic info
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