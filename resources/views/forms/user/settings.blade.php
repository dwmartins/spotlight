<form id="formSettingsUser" action="/user/settings" method="post" class="row">
    @csrf
    <label for="acceptsEmails" class="form-check-label text-secondary fs-7 mb-3 cursor_pointer">
        <div class="d-flex align-items-center gap-2">
            <input
            type="checkbox"
            name="acceptsEmails"
            class="form-check-input custom_focus p-2"
            id="acceptsEmails"
            @if(auth()->user()->acceptsEmails === "Y") checked  @endif
        >
        {{ trans('messages.alert_title_error') }}
        </div>
    </label>

    <div class="d-flex justify-content-end mt-3">
        <x-buttons.btn-primary-outline 
            text="{{ trans('messages.btn_text_save_changes') }}" 
            :use-loader="true"
            onclick="toggleLoading(this, true, true)"
            type="submit"
        /> 
    </div>
</form>