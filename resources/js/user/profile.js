import $ from 'jquery';
import { showAlert, toggleLoading, trans } from '../helpers';
import axios from 'axios';

$(async function() {

    // Change profile
    $('#new_img').on('change', async function() {
        let file = this.files[0];

        if(!file) return;

        $('.loadingImg').removeClass('d-none');
        $('.btn_change_img').addClass('d-none');

        const reader = new FileReader();

        reader.onload = function(e) {
            $('#current_user_photo').attr('src', e.target.result);
        }

        reader.readAsDataURL(file)

        $('.loadingImg').addClass('d-none');
        $('.btn_change_img').removeClass('d-none');
        $('.changeAvatarComponent .options').removeClass('d-none');
    });

    $('#btn_cancel_img').on('click', function() {
        $('.options').addClass('d-none');
        $('#current_user_photo').attr('src', $('#current_user_photo').attr('src'));
    });

    $('#btn_save_img').on('click', saveAvatar);

    // toggle user forms
    $('[data-toggle]').on('click', function() {
        let targetFormId  = $(this).data('toggle');
        $(`#${targetFormId}`).slideToggle(300);
    })

    // Validate the password change form
    $('#formResetPassword').on('submit', (e) => {
        const btn = document.getElementById('btn_change_password');
        toggleLoading(btn, true);

        let errors = {};

        $('#formResetPassword').find('input').each(function() {
            if($(this).attr('name') == '_token') {
                return;
            }

            $(this).removeClass('invalid_field');
            const fieldName = $(this).attr('name');
            const fieldValue = $(this).val();
            const translatedFieldName = trans(`attributes.${fieldName}`);

            if(!fieldValue) {
                errors[fieldName] = [
                    trans('field_required_message', { attribute: translatedFieldName })
                ];

                $(this).addClass('invalid_field');
            }
        });

        if(Object.keys(errors).length > 0) {
            e.preventDefault();
            toggleLoading(btn, false);
            showAlert('error', trans('invalid_fields'), errors);
            return;
        }

        if($('#newPassword').val() !== $('#confirmPassword').val()) {
            e.preventDefault();
            toggleLoading(btn, false);
            showAlert('error', trans('alert_title_error'), trans('passwords_not_match'));
        }
    });

    // Form Delete account
    $('#formDeleteAccount').on('submit', (e) => {
        if(!$("#confirmAccountDeletion").is(":checked")) {
            showAlert('warning', '', trans('alert_delete_account'));
            e.preventDefault();
            return;
        }

        const btn = document.getElementById('btn_delete_account');
        toggleLoading(btn, true);
    });
});

async function saveAvatar() {
    const btnSave = document.getElementById('btn_save_img');
    const formData = new FormData();

    formData.append('avatar', $('#new_img')[0].files[0]);

    $('#btn_cancel_img').addClass('d-none');

    toggleLoading(btnSave, true);

    try {
        const url = `/user/update-avatar`;

        const response = await axios.post(url, formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });

        toggleLoading(btnSave, false);
        $('.options').addClass('d-none');
        $('#btn_cancel_img').removeClass('d-none');

        showAlert('success', '', response.data.message);
    } catch (error) {
        showAlert('error', '', error.response.data.message);

        toggleLoading(btnSave, false);
        $('#btn_cancel_img').removeClass('d-none');
    }
}