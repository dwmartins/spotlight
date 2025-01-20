import { showAlert, toggleButtonLoading } from "../helpers";
import $ from 'jquery';

$(function() {

    $('.form_login').on('submit', function(e) {
        const btn = $('#btnLogin');



        toggleButtonLoading(btn, true);
    });
})  