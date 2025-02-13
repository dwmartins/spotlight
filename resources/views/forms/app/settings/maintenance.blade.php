<form action="/app/settings/general" method="post" class="form_maintenance card mb-3 custom-bg-white custom-text-dark rounded-3 border-0 shadow mb-4 h-100">
    @csrf
    <input type="hidden" name="type" value="checkbox">
    <input type="hidden" name="field" value="maintenance">

    <div class="card-body d-flex flex-column justify-content-between">
        <div>
            <h6 class="card-title mb-4">{{ trans('messages.maintenance_mode') }}</h6>

            <div class="d-flex align-items-center gap-2 form-check-label mb-4">
                <input class="switch" name="maintenance" id="maintenance" type="checkbox" {{ $settings['maintenance'] == 'on' ? 'checked' : '' }}>
                {{ trans('messages.maintenance_text') }}
            </div>
    
            <div class="card-info">
                <small class="form-text futuristic-description">
                    {{ trans('messages.maintenance_description') }}
                </small>
            </div>
        </div>
        
        <div class="d-flex justify-content-end">
            <x-buttons.btn-primary-outline 
                text="{{ trans('messages.btn_text_save_changes') }}" 
                :use-loader="true"
                onclick="toggleLoading(this, true, true)"
                type="submit"
            /> 
        </div>
    </div>
</form>