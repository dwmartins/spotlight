import { showAlert, trans } from '../helpers';

class FileValidator {
    imgExtensions = ['image/jpeg', 'image/jpg', 'image/png'];
    imgSize = 5 * 1024 * 1024; // 5MB

    faviconExtensions = ['image/vnd.microsoft.icon', 'image/x-icon', 'image/jpeg', 'image/jpg', 'image/png'];
    faviconFileSize = 5 * 1024 * 1024; // 5MB

    img(image, size = 5) {
        if(size) {
            this.imgSize = size * 1024 * 1024;
        }  

        if(image.size > this.imgSize) {
            showAlert('warning', '', trans('IMG_MAX_SIZE', { attribute: size}));
            return false;
        }

        if (!this.imgExtensions.includes(image.type)) {
            showAlert('warning', '', trans('IMG_FORMAT'));
            return false;
        }

        return true;
    }

    favicon(favicon, size) {
        if(size){
            this.faviconFileSize = size * 1024 * 1024;
        }

        if (favicon.size > this.faviconFileSize) {
            showAlert('warning', '', trans('IMG_MAX_SIZE', { attribute: size}));
            return false;
        }
    
        if (!this.faviconExtensions.includes(favicon.type)) {
            showAlert('warning', '', trans('ICON_FORMAT') );
            return false;
        }
    
        return true;
    }
}

export default new FileValidator();