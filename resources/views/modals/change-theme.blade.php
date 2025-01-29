<div class="offcanvas offcanvas-end custom-bg-white modal-change-theme" tabindex="-1" id="changeTheme">
    <div class="offcanvas-header">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="px-5">
        <h5 class="text-center custom-text-dark">{{ trans('messages.CHANGE_YOUR_THEME_HERE') }}</h5>
        <hr class="text-secondary mb-4">

        <form action="/app/custom/colors" method="post"  class="mb-4">
            @csrf
            <h6 class="text-center custom-text-dark mb-3">Colors</h6>

            <div class="mb-2">
                <span class="custom-text-dark fs-7">Primary:</span>
                <div class="customColorInput custom-text-dark">
                    <input type="text" id="custom-primary" name="primary" class="customColorInput__text-input jsColorValue custom-text-dark" value="{{ config('website_colors.primary') }}">
                    <input type="color" id="preview-custom-primary" class="customColorInput__select-input custom-text-dark" value="{{ config('website_colors.primary') }}">
                </div>
            </div>

            <div class="mb-2">
                <span class="custom-text-dark fs-7">Success:</span>
                <div class="customColorInput custom-text-dark">
                    <input type="text" id="custom-success" name="success" class="customColorInput__text-input jsColorValue custom-text-dark" value="{{ config('website_colors.success') }}">
                    <input type="color" id="preview-custom-success" class="customColorInput__select-input custom-text-dark" value="{{ config('website_colors.success') }}">
                </div>
            </div>

            <div class="mb-2">
                <span class="custom-text-dark fs-7">Warning:</span>
                <div class="customColorInput custom-text-dark">
                    <input type="text" id="custom-warning" name="warning" class="customColorInput__text-input jsColorValue custom-text-dark" value="{{ config('website_colors.warning') }}">
                    <input type="color" id="preview-custom-warning" class="customColorInput__select-input custom-text-dark" value="{{ config('website_colors.warning') }}">
                </div>
            </div>

            <div class="mb-2">
                <span class="custom-text-dark fs-7">Danger:</span>
                <div class="customColorInput custom-text-dark">
                    <input type="text" id="custom-danger" name="danger" class="customColorInput__text-input jsColorValue custom-text-dark" value="{{ config('website_colors.danger') }}">
                    <input type="color" id="preview-custom-danger" class="customColorInput__select-input custom-text-dark" value="{{ config('website_colors.danger') }}">
                </div>
            </div>

            <div class="mb-2">
                <span class="custom-text-dark fs-7">Links:</span>
                <div class="customColorInput custom-text-dark">
                    <input type="text" id="custom-link-color" name="link_color" class="customColorInput__text-input jsColorValue custom-text-dark" value="{{ config('website_colors.link_color') }}">
                    <input type="color" id="preview-custom-link-color" class="customColorInput__select-input custom-text-dark" value="{{ config('website_colors.link_color') }}">
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <div class="confirm_new_colors" style="display: none;">
                    <p class="custom-text-dark mb-1">Salvar alterações?</p>
                    <div class="d-flex justify-content-center gap-2">
                        <button type="submit" class="btn btn-primary btn-sm btn-save-colors">Sim</button>
                        <button class="btn btn-danger btn-sm btn-cancel-colors">Não</button>
                    </div>
                </div>
            </div>
        </form>        

        <hr class="text-secondary mb-4">

        <div class="d-flex justify-content-between">
            <h6 class="custom-text-dark mb-0">Light / Dark</h6>
            <input class="switch" name="darkMode" id="darkMode" type="checkbox" @checked(isset($_COOKIE['theme']) ? true : false)>
        </div>

        <hr class="text-secondary mb-4">
    </div>
  </div>