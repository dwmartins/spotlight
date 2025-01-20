<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:' . config('constants.min_password_length')
        ]);

        if($validator->fails()) {
            $errors = $validator->errors();

            return redirectWithMessage('error', 'Campos invalidos', $errors);
        }

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        if($user) {
            if($user->active === 'Y') {
                if(Auth::attempt($credentials)) {
                    $request->session()->regenerate();
        
                    return redirectWithMessage('success', '', 'Login efetuado com sucesso!', 'home_page');
                }
            }
        }

        return redirectWithMessage('error', '', trans('messages.AUTHENTICATION_FAILED'));
    } 

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirectWithMessage('success', '', 'Você saiu com sucesso!', 'home_page');
    }
}
