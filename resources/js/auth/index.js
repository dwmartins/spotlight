import { showAlert, toggleButtonLoading, trans } from "../helpers";
import $ from 'jquery';
import { validateForm } from "../validators/user";
import axios from "axios";

$(function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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

    // Send password recovery link
    $('.form_recover_password').on('submit', async (e) => {
        e.preventDefault();
        const btn_send_code = document.getElementById('btn_send_code');

        const formData = {
            email: $(this).find('#email').val(),
            _token: csrfToken
        }

        const requiredFields = {
            email: { label: trans('LABEL_EMAIL'), required: true},
        }

        if(!validateForm(formData, requiredFields)) {
            return;
        }

        toggleLoading(btn_send_code, true);

        try {
            const url = '/recover-password';
            const response = await axios.post(url, formData);
            $(this).find('#email').val('');
            showAlert('success', '', response.data.message);
        } catch (error) {
            showAlert('error', '', error.response.data.message);
        } finally {
            toggleLoading(btn_send_code, false);
        }
    });

    // Reset password
    $('#newPassword, #confirmPassword').on('input', function () {
        const icon = $(this).siblings('.icon_show_password');
        togglePasswordIcon(this, icon);
    });

    $('.form_reset_password').on('submit', async (e) => {
        const btn_change_password = document.getElementById('btn_change_password');

        const formData = {
            newPassword: $(this).find('#newPassword').val(),
            confirmPassword: $(this).find('#confirmPassword').val()
        }

        const requiredFields = {
            newPassword: { label: trans('LABEL_NEW_PASSWORD'), required: true},
            confirmPassword: { label: trans('LABEL_CONFIRM_PASSWORD'), required: true}
        }

        if(!validateForm(formData, requiredFields)) {
            e.preventDefault();
            return;
        }

        toggleLoading(btn_change_password, true);
    });

    function togglePasswordIcon(input, icon) {
        if ($(input).val().length > 0) {
            $(icon).removeClass('d-none');
        } else {
            $(icon).addClass('d-none');
        }
    }
})  