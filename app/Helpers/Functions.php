<?php

use App\Models\Settings;
use Illuminate\Support\Facades\Cache;

/**
 * @param string $messageType The type of message to display. Can be 'success', 'error', 'info', etc.
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