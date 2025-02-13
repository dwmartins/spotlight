<form id="formResetPassword" action="/user/change-password" method="post" class="row">
    @csrf
    <div class="mb-3 col-12 col-md-4">
        <label for="currentPassword" class="text-secondary mb-2"><span class="text-danger me-1">*</span>{{ trans('form.label_current_password') }}</label>
        <input type="password" name="currentPassword" id="currentPassword" class="form-control custom_focus text-secondary">
    </div>
    <div class="mb-3 col-12 col-md-4">
        <label for="newPassword" class="text-secondary mb-2"><span class="text-danger me-1">*</span>{{ trans('form.label_new_password') }}</label>
        <div class="position-relative">
            <input type="password" name="newPassword" id="newPassword" class="form-control custom_focus text-secondary">
            <i class="fa-regular icon_show_password fa-eye text-secondary"></i>
        </div>
    </div>
    <div class="mb-3 col-12 col-md-4">
        <label for="confirmPassword" class="text-secondary mb-2"><span class="text-danger me-1">*</span>{{ trans('form.label_confirm_password') }}</label>
        <div class="position-relative">
            <input type="password" name="confirmPassword" id="confirmPassword" class="form-control custom_focus text-secondary">
            <i class="fa-regular icon_show_password fa-eye text-secondary"></i>
        </div>
    </div>

    <p class="text-secondary fs-7 my-0">{{ trans('messages.minimum_characters_password', ['min' => config('website_settings.min_password_length')]) }}</p>

    <div class="d-flex justify-content-end mt-3">
        <x-buttons.btn-primary-outline 
            text="{{ trans('messages.btn_text_save_changes') }}" 
            :use-loader="true"
            type="submit"
            id="btn_change_password"
        />  
    </div>
</form>