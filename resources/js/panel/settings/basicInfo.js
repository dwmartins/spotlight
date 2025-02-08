import $ from 'jquery';
import FileValidator from '../../validators/fileValidator';
import { showAlert, toggleLoading, trans } from '../../helpers';

$(function() {
    function setupImageUploader(fieldId, previewId, loadingClass, selectedContainerId, uploadContainerId) {
        const originalSrc = $(`#${previewId}`).attr('src');

        $(`#${fieldId}`).on('change', function() {
            const file = this.files[0];

            if (!file) return;

            if(fieldId === "favicon") {
                // max 2mb
                if(!FileValidator.favicon(file, 2)) {
                    $(this).val(''); 
                    return;
                }
            } else {
                if (!FileValidator.img(file)) {
                    $(this).val(''); 
                    return;
                }
            }

            $(`#${previewId}`).addClass('d-none');
            $(`.${loadingClass}`).removeClass('d-none');
            $(`#${selectedContainerId} .fileName`).text(file.name);
            
            const reader = new FileReader();
            reader.onload = function(e) {
                $(`#${previewId}`).attr('src', e.target.result);
                $(`#${previewId}`).removeClass('d-none');
                $(`.${loadingClass}`).addClass('d-none');
            };
            reader.readAsDataURL(file);
            
            $(`#${selectedContainerId}`).removeClass('d-none');
            $(`#${uploadContainerId}`).addClass('d-none');
        });

        $(`#${selectedContainerId} .btn-danger`).on('click', function() {
            $(`#${fieldId}`).val('');
            $(`#${previewId}`).attr('src', originalSrc);

            $(`#${selectedContainerId}`).addClass('d-none');
            $(`#${uploadContainerId}`).removeClass('d-none');
        });
    }

    // Configure the fields
    setupImageUploader('logoImage', 'current_logoImage', 'loading_logoImage', 'logoImage_selected', 'upload_logoImage');
    setupImageUploader('coverImage', 'current_coverImage', 'loading_coverImage', 'coverImage_selected', 'upload_coverImage');
    setupImageUploader('favicon', 'current_favicon', 'loading_favicon', 'favicon_selected', 'upload_favicon');
    setupImageUploader('defaultImage', 'current_defaultImage', 'loading_defaultImage', 'defaultImage_selected', 'upload_defaultImage');

    $('.form-update-images').on('submit', (e) => {
        let hasFile = false;
        const btn_save_files = document.getElementById('btn_save_files');
        
        $('.form-update-images').find('input').each(function() {
            if($(this).attr('name') == '_token') {
                return;
            }
            
            if($(this).val()) {
                hasFile = true;
            }
        });

        if(!hasFile) {
            e.preventDefault();
            showAlert('warning', '', trans('MESSAGE_SELECT_IMAGE'));
            return;
        }

        toggleLoading(btn_save_files, true);
    });
});