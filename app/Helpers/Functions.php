<?php

use App\Models\Settings;
use Illuminate\Support\Facades\Cache;

/**
 * @param string $messageType The type of message to display. Can be 'success', 'error', 'warning', etc.
 * @param string $title The title of the message. May be an empty string if there is no title.
 * @param string|array $messageOrFields The message or an array of field errors. It can be a simple string
 * or an associative array with fields as key and messages as value.
 * @param string|null $route (Optional) The route to which the user will be redirected. If not provided,
 * the user will be redirected to the previous page.
 * @param array $params (option) Is an array of parameters to be passed to the URL.
 */
function redirectWithMessage($messageType, $title, $messageOrFields, $route = null, $params = []) {
    $message = ['type' => $messageType, 'title' => $title, 'fields' => $messageOrFields];

    if($route) {
        return redirect()->route($route, $params)->with('message', $message);
    }

    return back()->withInput()->with('message', $message);
}

function setGreeting() {
    $hour = date('G');

    if ($hour >= 6 && $hour < 12) {
        return trans('messages.good_morning');
    } elseif ($hour >= 12 && $hour < 18) {
        return trans('messages.good_afternoon');
    } else {
        return trans('messages.good_night');
    }
}

function getDateAsString($date) {
    $dateTime = new DateTime($date);

    $formatter = new IntlDateFormatter(
        app()->getLocale(),
        IntlDateFormatter::LONG,
        IntlDateFormatter::NONE
    );

    return $formatter->format($dateTime);
}

function getSimpleDate($date) {
    $format = config('website_settings.date_format', 'DD-MM-YYYY');
    $inputFormat = 'Y-m-d';
    $dateTime = DateTime::createFromFormat($inputFormat, $date);

    if($dateTime) {
        $normalizedFormat = str_replace('-', '/', $format);
        $phpFormat = str_replace(['DD', 'MM', 'YYYY'], ['d', 'm', 'Y'], $normalizedFormat);

        return $dateTime->format($phpFormat);
    }

    return $date;
}

/**
 * Validate form fields to check for malicious characters.
 * 
 * @param array $data The submitted form data (e.g., $_POST).
 * @return array An associative array of errors, where the key is the field name 
 *               and the value is the error message if any malicious characters are found.
 */
function validateFields($data) {
    $errors = [];

    $maliciousPattern = '/<[^>]*>|javascript:|data:|url\(|<script.*?>.*?<\/script>/i';

    foreach ($data as $key => $value) {
        if($key === '_token') {
            continue;
        }

        if($key === 'keywords') {
            $value = json_encode($value);
        }

        if (preg_match($maliciousPattern, $value)) {
            $errors[$key] = [
                trans('validation.FIELD_INVALID_CHARACTERS', [
                    'attribute' => trans('validation.attributes.' . $key)
                ])
            ];
        }
    }

    return $errors;
}