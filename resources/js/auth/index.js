import { toggleButtonLoading, trans } from "../helpers";
import $ from 'jquery';
import { validateForm } from "../validators/user";

$(function() {
    $('.form_login').on('submit', function(e) {
        const btn = $('#btnLogin');

        const formData = {
            email: $('#email').val(),
            password: $('#password').val()
        }

        const requiredFields = {
            email: { label: trans('LABEL_EMAIL'), required: true},
            password: { label: trans('LABEL_PASSWORD'), required: true},
        }

        if(!validateForm(formData, requiredFields)) {
            e.preventDefault();
            return;
        }

        toggleButtonLoading(btn, true);
    });
})  