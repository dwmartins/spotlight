import $ from 'jquery';
import selectize from '@selectize/selectize';

$(function() {

    // Email settings
    $('#authentication').selectize({
        create: false,
        maxItems: 1,
        persist: false
    })
});