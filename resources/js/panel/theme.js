import $ from 'jquery';

$(function() {
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

    $(".btn-save-colors").on("click", function() {
        let colors = {
            primary: $("#custom-primary").val(),
            success: $("#custom-success").val(),
            warning: $("#custom-warning").val(),
            danger: $("#custom-danger").val(),
            link_color: $("#custom-link-color").val()
        };

        saveChangesContainer.fadeOut();
        alert('Cores atualizadas com sucesso.');
    });

    $(".btn-cancel-colors").on("click", function() {
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
});