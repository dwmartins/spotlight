import axios from 'axios';
import $ from 'jquery';
import { showAlert } from '../helpers';

$(function() {
    const csrfToken = $('meta[name="csrf-token"]').attr('content')

    $('#darkMode').on('input', (e) => {
        const app_layout = $('.app_layout');
        const darkModeClass = 'dark-mode';
        const isChecked = e.target.checked;

        if(isChecked) {
            app_layout.addClass(darkModeClass);
            document.cookie = `theme=dark-mode; path=/; SameSite=Strict;`;
        } else {
            app_layout.removeClass(darkModeClass);
            document.cookie = "theme=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
        }
    });

    // Change colors
    const saveChangesContainer = $(".confirm_new_colors");
    let initialColors = {};

    function updateColor(inputId, newColor) {
        const colorMapping = {
            "custom-primary": "--custom-primary",
            "custom-success": "--custom-success",
            "custom-warning": "--custom-warning",
            "custom-danger": "--custom-danger",
            "custom-link-color": "--custom-link_color"
        };

        if (colorMapping[inputId]) {
            document.documentElement.style.setProperty(colorMapping[inputId], newColor);

            const hoverColor = darkenColor(newColor, 10);
            document.documentElement.style.setProperty(`${colorMapping[inputId]}-hover`, hoverColor);
        }

        $(`#${inputId}`).val(newColor);
        $(`#preview-${inputId}`).val(newColor);
        saveChangesContainer.fadeIn();
    }

    $(".customColorInput__text-input").on("input", function() {
        let newColor = $(this).val().trim();
        let inputId = $(this).attr("id");

        if (newColor === "") return;

        if (!newColor.startsWith("#")) {
            newColor = "#" + newColor;
        }

        if (/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/.test(newColor)) {
            updateColor(inputId, newColor);
        }
    });

    $(".customColorInput__select-input").on("input", function() {
        let newColor = $(this).val();
        let inputId = $(this).attr("id").replace("preview-", "");
        updateColor(inputId, newColor);
    });

    $(".btn-cancel-colors").on("click", function() {
        debugger
        $(".customColorInput__select-input").each(function() {
            let inputId = $(this).attr("id").replace("preview-", "");
            let originalColor = initialColors[inputId];

            $(this).val(originalColor);
            $(`#${inputId}`).val(originalColor);
            updateColor(inputId, originalColor);
        });

        saveChangesContainer.fadeOut();
    });

    $(".customColorInput__select-input").each(function() {
        let inputId = $(this).attr("id").replace("preview-", "");
        initialColors[inputId] = $(this).val();
    });

    function darkenColor(hexColor, percent) {
        hexColor = hexColor.replace(/^#/, '');
    
        let r = parseInt(hexColor.substring(0, 2), 16);
        let g = parseInt(hexColor.substring(2, 4), 16);
        let b = parseInt(hexColor.substring(4, 6), 16);
    
        r = Math.max(0, Math.min(255, r - (r * percent / 100)));
        g = Math.max(0, Math.min(255, g - (g * percent / 100)));
        b = Math.max(0, Math.min(255, b - (b * percent / 100)));
    
        const toHex = (value) => {
            const hex = Math.round(value).toString(16);
            return hex.length === 1 ? '0' + hex : hex;
        };
    
        return `#${toHex(r)}${toHex(g)}${toHex(b)}`;
    }
});