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

    // Change color
    const saveChangesContainer = $(".confirm_new_colors");
    let initialColors = {};

    $(".customColorInput__select-input").each(function() {
        let inputId = $(this).attr("id");
        initialColors[inputId] = $(this).val();
    });

    $(".customColorInput__select-input").on("input", function() {
        let newColor = $(this).val();
        let inputId = $(this).attr("id");

        let colorMapping = {
            "colorPrimary": "--custom-primary",
            "colorSuccess": "--custom-success",
            "colorWarning": "--custom-warning",
            "colorDanger": "--custom-danger",
            "colorLinks": "--custom-link_color"
        };

        if (colorMapping[inputId]) {
            document.documentElement.style.setProperty(colorMapping[inputId], newColor);
        }

        $("#" + inputId + "Text").val(newColor);
    });

    $(".customColorInput__select-input").on("input", function() {
        let newColor = $(this).val();
        let inputId = $(this).attr("id");

        $("#" + inputId + "Text").val(newColor);
        updateColor(inputId, newColor);
        saveChangesContainer.fadeIn();
    });

    $(".customColorInput__text-input").on("input", function() {
        let newColor = $(this).val();
        let inputId = $(this).attr("id").replace("Text", "");

        if (newColor === "") return;

        if (!newColor.startsWith("#")) {
            newColor = "#" + newColor;
        }

        if (/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/.test(newColor)) {
            $("#" + inputId).val(newColor);
            updateColor(inputId, newColor);
            saveChangesContainer.fadeIn();
        }
    });

    $(".customColorInput__text-input").on("blur keypress", function(e) {
        if (e.type === "keypress" && e.which !== 13) return;

        let newColor = $(this).val().trim();
        if (newColor === "") return;

        if (!newColor.startsWith("#")) {
            newColor = "#" + newColor;
            $(this).val(newColor);
        }
    });

    $(".btn-save-colors").on("click", function() {
        let colors = {
            primary: $("#colorPrimary").val(),
            success: $("#colorSuccess").val(),
            warning: $("#colorWarning").val(),
            danger: $("#colorDanger").val(),
            link_color: $("#colorLinks").val()
        };
        
        saveChangesContainer.fadeOut();
        alert('Cores atualizadas com sucesso.')
    });

    $(".btn-cancel-colors").on("click", function() {
        $(".customColorInput__select-input").each(function() {
            let inputId = $(this).attr("id");
            let originalColor = initialColors[inputId];

            $(this).val(originalColor);
            $("#" + inputId + "Text").val(originalColor);
            updateColor(inputId, originalColor);
        });

        saveChangesContainer.fadeOut();
    });

    function updateColor(inputId, newColor) {
        let colorMapping = {
            "colorPrimary": "--custom-primary",
            "colorSuccess": "--custom-success",
            "colorWarning": "--custom-warning",
            "colorDanger": "--custom-danger"
        };

        if (colorMapping[inputId]) {
            document.documentElement.style.setProperty(colorMapping[inputId], newColor);
        }
    }
});