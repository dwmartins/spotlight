import $ from 'jquery';
import { showAlert, toggleLoading, trans } from '../../helpers';
import selectize from '@selectize/selectize';

$(function() {
    // Form language
    const languageOptions = document.querySelectorAll('.language-option');

    languageOptions.forEach(option => {
        option.addEventListener('click', () => {
            languageOptions.forEach(opt => opt.classList.remove('selected'));
            option.classList.add('selected');
            option.querySelector('input').checked = true;
        })
    })

    // Form data and time
    $('#date_format').selectize({
        create: false,
        maxItem: 1,
        persist: false
    });

    $('#clock_type').selectize({
        create: false,
        maxItem: 1,
        persist: false
    });

    $('#timezone').selectize({
        create: false,
        maxItem: 1,
        persist: false
    });
});