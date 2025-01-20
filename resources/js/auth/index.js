import { showAlert, showLoadingState } from "../helpers";
import $ from 'jquery';

$(function() {
    $('.form_login').on('submit', function(e) {
        const btn = $('#btnLogin');
        const btn_text = $(btn).text();
        const trans_loading = $(btn).data('trans-loading');

        showLoadingState(btn, true, btn_text, trans_loading);
    });
})