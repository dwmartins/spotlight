<form id="formDeleteAccount" action="/user/delete" method="post" class="mt-5">
    @csrf
    <p class="fs-5 custom_dark mb-3">{{ trans('messages.USER_PROFILE_DELETE') }}</p>

    <div class="alert-danger alert border-0 d-flex flex-nowrap gap-4">
        <div>
            <i class="fa-solid fa-triangle-exclamation text-danger fs-1"></i>
        </div>
        <div>
            <p class="text-danger fw-semibold mb-0 fs-7">{{ trans('messages.DELETE_ACCOUNT_TEXT') }}</p>
            <p class="text-danger mb-0 fs-7">{{ trans('messages.ACTION_CANNOT_UNDONE') }}</p>
        </div>
    </div>

    <label for="confirmAccountDeletion" class="form-check-label text-secondary fs-7 mb-3 cursor_pointer">
        <div class="d-flex align-items-center gap-2">
            <input
            type="checkbox"
            name="confirmAccountDeletion"
            class="form-check-input custom_focus p-2"
            id="confirmAccountDeletion"
            >
            {{ trans('messages.CONFIRM_DELETE_ACCOUNT') }}
        </div>
    </label>

    <div class="d-flex justify-content-end mt-3">
        <x-buttons.btn-danger
            text="{{ trans('messages.BTN_TEXT_DELETE_ACCOUNT') }}" 
            :use-loader="true"
            type="submit"
            id="btn_delete_account"
        /> 
    </div>

</form>