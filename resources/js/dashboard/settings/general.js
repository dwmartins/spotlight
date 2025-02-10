import $ from 'jquery';
import { showAlert, toggleLoading, trans } from '../../helpers';

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
});