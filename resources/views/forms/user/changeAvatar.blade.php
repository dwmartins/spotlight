<div class="changeAvatarComponent item_center d-flex flex-wrap gap-3 p-3 rounded rounded-2 my-sm-2 mb-sm-5">
    <div>
        <div class="position-relative">
            <img src="{{ auth()->user()->getAvatar() }}" alt="Avatar" id="current_user_photo" class="user_photo">
            <label for="new_img" class="btn_change_img"><i class="fa-solid fa-pencil"></i></label>
            <input type="file" id="new_img" class="d-none" accept="image/jpeg, image/jpg, image/png">

            <div class="loadingImg d-none">
                <x-loader />
            </div>
        </div>

        <div class="d-flex justify-content-center gap-2 my-2 options d-none">
            <button id="btn_cancel_img" class="btn btn-sm btn-outline-danger">{{ trans('messages.BTN_TEXT_CANCEL') }}</button>
            
            <x-buttons.btn-primary-outline 
                text="{{ trans('messages.BTN_TEXT_SAVE') }}" 
                loading-text="{{ trans('messages.BTN_LABEL_LOADING') }}"
                :use-loader="true" 
                id="btn_save_img"
            />  
        </div>
    </div>

    <div class="d-flex flex-column align-items-center">
        <p class="custom_dark fw-semibold mt-2 mb-0">{{ auth()->user()->getFullName() }}</p>
        <p class="text-secondary fs-8 text-break">{{ auth()->user()->email }}</p>
        <p class="custom_dark fw-semibold fs-8 text-break mb-0">{{ trans('messages.MEMBER_SINCE') }}:</p>
        <p class="text-secondary fs-8 text-break">{{ getDateAsString(auth()->user()->created_at) }}</p>
    </div>
</div>