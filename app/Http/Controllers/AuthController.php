<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function show(): View
    {
        $webSiteName = config('website_info.websiteName');

        return view('pages.auth.login', [
            'custom_seo_title' => trans('messages.SEO_TITLE_LOGIN') . ' | ' . $webSiteName
        ]);
    }

     /**
     * returns the user register view  /pages/auth/register.blade.php
     * @return View
     */
    public function registerView():  View
    {
        $webSiteName = config('website_info.websiteName');

        return view('pages.auth.register', [
            'custom_seo_title' => trans('messages.SEO_TITLE_REGISTER') . ' | ' . $webSiteName
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            $errors = $validator->errors();

            return redirectWithMessage('error', trans('messages.INVALID_FIELDS_MESSAGE'), $errors);
        }

        $remember = $request->has('rememberMe');

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        if($user) {
            if($user->active === 'Y') {
                if(Auth::attempt($credentials, $remember)) {
                    $request->session()->regenerate();
                    
                    $user->updateLastLogin();
        
                    return redirectWithMessage('success', '', trans('messages.LOGIN_SUCCESSFULLY_MESSAGE'), 'home_page');
                }
            }
        }

        return redirectWithMessage('error', '', trans('messages.AUTHENTICATION_FAILED'));
    } 

    public function register(Request $request)
    {
        $errors = validateFields($request->all());
        if($errors) {
            return redirectWithMessage('error', trans('messages.INVALID_FIELDS_MESSAGE'), $errors);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'lastName' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:'. config('website_settings.min_password_length')
        ]);

        if($validator->fails()) {
            $errors = $validator->errors();

            return redirectWithMessage('error', trans('messages.INVALID_FIELDS_MESSAGE'), $errors);
        }

        $validatedData = $validator->validated();

        $user = new User($validatedData);
        $user->role = 'visitor';
        $user->password = Hash::make($validatedData['password']);
        $user->save();

        return redirectWithMessage('success', trans('messages.ALERT_TITLE_SUCCESS'), trans('messages.USER_CREATED'), 'login', ['email' => $user->email]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirectWithMessage('success', '', trans('messages.LOGOUT_SUCCESSFULLY_MESSAGE'), 'home_page');
    }
}
