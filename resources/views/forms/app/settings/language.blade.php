<form action="/app/settings/general" method="post" class="form_language card mb-3 custom-bg-white custom-text-dark rounded-3 border-0 shadow mb-4">
    @csrf
    <input type="hidden" name="field" value="language">

    <div class="card-body">
        <h6 class="card-title mb-4">{{ trans('messages.LANGUAGE') }}</h6>

        <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
            @foreach([
                'pt-BR' => ['flag' => 'https://flagcdn.com/br.svg', 'label' => trans('messages.LANGUAGES.portuguese')],
                'en' => ['flag' => 'https://flagcdn.com/us.svg', 'label' => trans('messages.LANGUAGES.english')],
            ] as $value => $data)
                <label class="language-option p-2 rounded-3 cursor_pointer {{ $settings['language'] === $value ? 'selected' : '' }}" for="language_{{ $value }}">
                    <img src="{{ $data['flag'] }}" alt="{{ $data['label'] }}">
                    <span>{{ $data['label'] }}</span>
                    <input type="radio" id="language_{{ $value }}" name="language" value="{{ $value }}" {{ $settings['language'] === $value ? 'checked' : '' }}>
                </label>
            @endforeach
        </div>
        
        <div class="d-flex justify-content-end">
            <x-buttons.btn-primary-outline 
                text="{{ trans('messages.BTN_TEXT_SAVE_CHANGES') }}" 
                :use-loader="true"
                onclick="toggleLoading(this, true, true)"
                type="submit"
            /> 
        </div>
    </div>
</form>