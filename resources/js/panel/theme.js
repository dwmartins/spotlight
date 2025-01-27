import $ from 'jquery';

$(function() {
    const app_layout = $('.app_layout');
    const toggleThemeButton = $('.change_theme');
    const darkModeClass = 'dark-mode';

    toggleThemeButton.on('click', () => {
        app_layout.toggleClass(darkModeClass);

        if(app_layout.hasClass(darkModeClass)) {
            document.cookie = `theme=dark-mode; path=/; SameSite=Strict;`;
        } else {
            document.cookie = "theme=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
        }
    });
});