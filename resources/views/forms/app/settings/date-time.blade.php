<form action="/app/settings/general/date-time" method="post" class="form_clock_type card mb-3 custom-bg-white custom-text-dark rounded-3 border-0 shadow mb-4">
    @csrf

    <div class="card-body">
        <h6 class="card-title mb-4">{{ trans('messages.form_title_date_and_time') }}</h6>

        <div class="container mb-4">
            <div class="row">
                <div class="col-12 col-md-4">
                    <label for="date_format" class="form-label">{{ trans('form.label_date_format') }}</label>
                    <select id="date_format" name="date_format">
                        <option @if ($settings['date_format'] === 'DD-MM-YYYY') selected @endif  value="DD-MM-YYYY">DD-MM-YYYY</option>
                        <option @if ($settings['date_format'] === 'MM-DD-YYYY') selected @endif  value="MM-DD-YYYY">MM-DD-YYYY</option>
                    </select>
                </div>

                <div class="col-12 col-md-4">
                    <label for="clock_type" class="form-label">{{ trans('form.label_clock_type') }}</label>
                    <select id="clock_type" name="clock_type">
                        <option @if ($settings['clock_type'] === '24') selected @endif value="24">{{ trans('messages.date_24_hours') }}</option>
                        <option @if ($settings['clock_type'] === '12') selected @endif value="12">{{ trans('messages.date_12_hours') }}</option>
                    </select>
                </div>

                <div class="col-12 col-md-4">
                    <label for="timezone" class="form-label">{{ trans('form.label_timezone') }}</label>
                    <select id="timezone" name="timezone">
                        @foreach (DateTimeZone::listIdentifiers() as $timezone)
                            <option @if ($settings['timezone'] === $timezone) selected @endif value="{{ $timezone }}">{{ $timezone }}</option>
                        @endforeach
                    </select>
                </div>
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