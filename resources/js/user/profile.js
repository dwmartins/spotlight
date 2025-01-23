import $ from 'jquery';
import { showAlert, trans } from '../helpers';
import axios from 'axios';

$(async function() {
    const currentUserImg = $('#current_user_photo').attr('src');
    const btnSaveImg = $('#btn_save_img');
    const btnCancelImg = $('#btn_cancel_img');

    $('#new_img').on('change', async function() {
        let file = this.files[0];

        if(!file) return;

        $('.loadingImg').removeClass('d-none');
        $('.btn_change_img').addClass('d-none');
        $('.options').removeClass('d-none');

        const reader = new FileReader();

        reader.onload = function(e) {
            $('#current_user_photo').attr('src', e.target.result);
        }

        reader.readAsDataURL(file)

        $('.loadingImg').addClass('d-none');
        $('.btn_change_img').removeClass('d-none');

        $('#userPanelView .options').removeClass('d-none');
    });

    btnCancelImg.on('click', function() {
        $('.options').addClass('d-none');
        $('#current_user_photo').attr('src', currentUserImg);
    });

    btnSaveImg.on('click', saveAvatar);
});

async function saveAvatar() {
    const newImg = $('#new_img')[0];

    let formData = new FormData();
    formData.append('avatar', newImg.files[0]);

    $('.btn_change_img').addClass('d-none');
    $('#btn_cancel_img').addClass('d-none');

    try {
        const url = `/${trans('PATH_PREFIX_USER')}/update-avatar`;

        const response = await axios.post(url, formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });

        $('.options').addClass('d-none');
        $('.btn_change_img').removeClass('d-none');
        $('#btn_save_img').prop('disabled', false).text('Salvar');

        showAlert('success', '', response.data.message);
    } catch (error) {
        showAlert('error', '', error.response.data.message);

        $('.btn_change_img').removeClass('d-none');
        $('#btn_cancel_img').removeClass('d-none');
        $('#btn_save_img').prop('disabled', false).text('Salvar');
    }
}