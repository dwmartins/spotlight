<form id="formUserBasicInfo" action="/user" method="post" class="row">
    @csrf
    <div class="mb-3 col-12 col-md-4">
        <label for="name" class="text-secondary mb-2"><span class="text-danger me-1">*</span>{{ trans('form.label_name') }}</label>
        <input type="text" name="name" id="name" autocomplete="name" value="{{ old('name', auth()->user()->name) }}" class="form-control custom_focus text-secondary">
    </div>
    <div class="mb-3 col-12 col-md-4">
        <label for="lastName" class="text-secondary mb-2"><span class="text-danger me-1">*</span>{{ trans('form.label_last_name') }}</label>
        <input type="text" name="lastName" id="lastName" autocomplete="lastName" value="{{ old('lastName', auth()->user()->lastName) }}" class="form-control custom_focus text-secondary">
    </div>
    <div class="mb-3 col-12 col-md-4">
        <label for="dateOfBirth" class="text-secondary mb-2">{{ trans('form.date_birth') }}</label>
        <input type="date" name="dateOfBirth" id="dateOfBirth" value="{{ old('dateOfBirth', auth()->user()->dateOfBirth) }}" class="form-control custom_focus text-secondary">
    </div>
    <div class="mb-3 col-12 col-md-6">
        <label for="email" class="text-secondary mb-2"><span class="text-danger me-1">*</span>{{ trans('form.label_email') }}</label>
        <input type="email" name="email" id="email" autocomplete="email" value="{{ old('email', auth()->user()->email) }}" class="form-control custom_focus text-secondary">
    </div>
    <div class="mb-3 col-12 col-md-6">
        <label for="phone" class="text-secondary mb-2">{{ trans('form.label_phone') }}</label>
        <input type="number" name="phone" id="phone" autocomplete="phone" value="{{ old('phone', auth()->user()->phone) }}" class="form-control custom_focus text-secondary">
    </div>
    <div class="mb-3 col-12">
        <label for="phone" class="text-secondary mb-2">{{ trans('form.label_description') }}</label>
        <x-textarea 
            id="description" 
            name="description" 
            :maxChars="500" 
            placeholder="{{ trans('messages.placeholder_description') }}"
            rows='4'
            value="{{ old('description', auth()->user()->description) }}"
        />
    </div>

    <div class="d-flex justify-content-end mt-3">
        <x-buttons.btn-primary-outline 
            text="{{ trans('messages.btn_text_save_changes') }}" 
            :use-loader="true"
            onclick="toggleLoading(this, true, true)"
            type="submit"
        />  
    </div>
</form>