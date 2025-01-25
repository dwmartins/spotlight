<form id="formUserAddress" action="/user" method="post" class="row">
    @csrf
    <div class="mb-3 col-12 col-md-6">
        <label for="address" class="text-secondary mb-2">{{ trans('messages.LABEL_ADDRESS') }}</label>
        <input type="text" name="address" id="address" autocomplete="address" value="{{ old('address', auth()->user()->address) }}" class="form-control custom_focus text-secondary">
    </div>
    <div class="mb-3 col-12 col-md-3">
        <label for="complement" class="text-secondary mb-2">{{ trans('messages.LABEL_COMPLEMENT') }}</label>
        <input type="text" name="complement" id="complement" autocomplete="complement" value="{{ old('complement', auth()->user()->complement) }}" class="form-control custom_focus text-secondary">
    </div>
    <div class="mb-3 col-12 col-md-3">
        <label for="city" class="text-secondary mb-2">{{ trans('messages.LABEL_CITY') }}</label>
        <input type="text" name="city" id="city" autocomplete="city" value="{{ old('city', auth()->user()->city) }}" class="form-control custom_focus text-secondary">
    </div>
    <div class="mb-3 col-12 col-md-4">
        <label for="zipCode" class="text-secondary mb-2">{{ trans('messages.LABEL_ZIP_CODE') }}</label>
        <input type="number" name="zipCode" id="zipCode" autocomplete="zipCode" value="{{ old('zipCode', auth()->user()->zipCode) }}" class="form-control custom_focus text-secondary">
    </div>
    <div class="mb-3 col-12 col-md-4">
        <label for="state" class="text-secondary mb-2">{{ trans('messages.LABEL_STATE') }}</label>
        <input type="text" name="state" id="state" autocomplete="state" value="{{ old('state', auth()->user()->state) }}" class="form-control custom_focus text-secondary">
    </div>
    <div class="mb-3 col-12 col-md-4">
        <label for="country" class="text-secondary mb-2">{{ trans('messages.LABEL_COUNTRY') }}</label>
        <input type="text" name="country" id="country" autocomplete="country" value="{{ old('country', auth()->user()->country) }}" class="form-control custom_focus text-secondary">
    </div>

    <div class="d-flex justify-content-end mt-3">
        <x-buttons.btn-primary-outline 
            text="{{ trans('messages.BTN_TEXT_SAVE_CHANGES') }}" 
            :use-loader="true"
            onclick="toggleLoading(this, true, true)"
            type="submit"
        />  
    </div>
</form>