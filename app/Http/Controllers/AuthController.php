<?php

namespace App\Http\Controllers;

use App\Http\Controllers\App\EmailSettingsController;
use App\Mail\ResetPasswordMail;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /**
     * return login view /pages/auth/login.blade.php
     * @return View
     */
    public function show(Request $request): View
    {
        $webSiteName = config('website_info.websiteName');
        $cookie = $request->cookie('remembered_email') ?? null;
        $userName = null;

        if($cookie) {
            $userName = User::where('email', $cookie)->first()->name;
        }

        return view('pages.auth.login', [
            'custom_seo_title' => trans('seo.title_login') . ' | ' . $webSiteName,
            'userName' => $userName
        ]);
    }

    public function AdminLoginView(Request $request): View
    {
        $websiteName = config('website_info.websiteName');
        $cookie = $request->cookie('remembered_email') ?? null;
        $userName = null;

        if($cookie) {
            $userName = User::where('email', $cookie)->first()->name;
        }

        return view('pages.auth.admin-login', [
            'custom_seo_title' => "Dashboard | $websiteName",
            'userName' => $userName
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
            'custom_seo_title' => trans('seo.title_register') . ' | ' . $webSiteName
        ]);
    }

    /**
     * return view to recover password /pages/auth/recover-password.blade.php
     * @return View
     */
    public function recoverPasswordView(): View
    {
        $webSiteName = config('website_info.websiteName'); 

        return view('pages.auth.recover-password', [
            'custom_seo_title' => trans('seo.title_recover_password') . ' | ' . $webSiteName
        ]);
    }

    /**
     * return view to recover password /pages/auth/reset-password.blade.php
     * @return View
     */
    public function resetPasswordView($token): View|RedirectResponse
    {
        $passwordReset = PasswordReset::where('token', $token)->first();
        
        if(!$passwordReset || $passwordReset->created_at->addMinutes(60)->isPast()) {
            return view('pages.auth.link-invalid');
        }

        $user = User::where('email', $passwordReset->email)->first();

        if(!$user) {
            return redirectWithMessage('warning', '', trans('messages.user_not_found'), 'home_page');
        }

        return view('pages.auth.reset-password', [
            'user' => $user,
            'token' => $token
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

            return redirectWithMessage('error', trans('messages.invalid_fields_message'), $errors);
        }

        $remember = $request->has('rememberMe');

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        if($user) {
            if($user->active === 'Y') {
                if(Auth::attempt($credentials, $remember)) {
                    $request->session()->regenerate();
                    
                    $user->updateLastLogin();
        
                    return redirectWithMessage('success', '', trans('messages.login_successfully_message'), 'home_page')->withCookie(cookie('remembered_email', $user->email, 43200)); // 30 days
                }
            }
        }

        return redirectWithMessage('error', '', trans('messages.authentication_failed'));
    } 

    public function AdminLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            $errors = $validator->errors();

            return redirectWithMessage('error', trans('messages.invalid_fields_message'), $errors);
        }  

        $remember = $request->has('rememberMe');

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        if($user) {
            if($user->active === 'Y') {
                if(in_array($user->role, config('constants.has_access_app'))) {
                    if(Auth::attempt($credentials, $remember)) {
                        $request->session()->regenerate();
                        
                        $user->updateLastLogin();
            
                        return redirectWithMessage('success', '', trans('messages.login_successfully_message'), 'app_dashboard')->withCookie(cookie('remembered_email', $user->email, 43200)); // 30 days
                    }
                } else {
                    return redirectWithMessage('error', '', trans('messages.not_have_access_this_area'));
                }
            }
        }

        return redirectWithMessage('error', '', trans('messages.authentication_failed'));
    }

    public function register(Request $request)
    {
        $errors = validateFields($request->all());
        if($errors) {
            return redirectWithMessage('error', trans('messages.invalid_fields_message'), $errors);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'lastName' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:'. config('website_settings.min_password_length')
        ]);

        if($validator->fails()) {
            $errors = $validator->errors();

            return redirectWithMessage('error', trans('messages.invalid_fields_message'), $errors);
        }

        $validatedData = $validator->validated();

        $user = new User($validatedData);
        $user->role = 'visitor';
        $user->password = Hash::make($validatedData['password']);
        $user->save();

        return redirectWithMessage('success', trans('messages.ALERT_TITLE_SUCCESS'), trans('messages.user_created'), 'login', ['email' => $user->email]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirectWithMessage('success', '', trans('messages.logout_successfully_message'), 'home_page');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $errors = validateFields($request->all());
        if($errors) {
            return redirectWithMessage('error', trans('messages.invalid_fields_message'), $errors);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if($validator->fails()) {
            $errors = $validator->errors();

            return response()->json([
                'message' => $errors
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if(!$user || $user->active === 'N') {
            return response()->json([
                'message' => trans('messages.user_not_found')
            ], 422);
        }

        $token = Str::random(60);

        try {
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $user->email],
                [
                    'token' => $token,
                    'created_at' => now()
                ]
            );
    
            $this->sendResetPasswordEmail($user, $token);
    
            return response()->json([
                'message' => trans('messages.recovery_link_has_been_sent')
            ]);
        } catch (\Exception $e) {
            Log::error('Error sending email', [
                'message' => $e->getMessage(),
                'email' => $user->email,
                'stack' => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => trans('messages.fatal_error_message')
            ], 500);
        }
    }

    public function resetPassword(Request $request)
    {
        $errors = validateFields($request->all());
        if($errors) {
            return redirectWithMessage('error', trans('messages.invalid_fields_message'), $errors);
        }

        $validator = Validator::make($request->all(), [
            'newPassword' => 'required|string|max:100|min:'. config('website_settings.min_password_length'),
            'confirmPassword' => 'required|string|max:100',
        ]);

        if($validator->fails()) {
            $errors = $validator->errors();

            return redirectWithMessage('error', trans('messages.invalid_fields_message'), $errors);
        }

        if($request->newPassword !== $request->confirmPassword) {
            return redirectWithMessage('error', trans('messages.alert_title_error'), trans('messages.passwords_not_match'));
        }

        $passwordReset = PasswordReset::where('token', $request->token)->first();
        
        if(!$passwordReset || $passwordReset->created_at->addMinutes(60)->isPast()) {
            return view('pages.auth.link-invalid');
        }

        $user = User::where('id', $request->user_id)->first();

        $user->password = Hash::make($request->newPassword);
        $user->save();
        
        PasswordReset::where('email', $user->email)->delete();

        return redirectWithMessage('success', trans('messages.ALERT_TITLE_SUCCESS'), trans('messages.password_update'), 'login', ['email' => $user->email]);
    }

    private function sendResetPasswordEmail($user, $token)
    {   
        $emailSettingController = new EmailSettingsController();
        $emailSetting = $emailSettingController->getEmailSettings();

        if($emailSetting) {
            config([
                'mail.mailers.smtp.host' => $emailSetting->host,
                'mail.mailers.smtp.port' => $emailSetting->port,
                'mail.mailers.smtp.encryption' => $emailSetting->encryption,
                'mail.mailers.smtp.username' => $emailSetting->username,
                'mail.mailers.smtp.password' => $emailSetting->password,
                'mail.from.address' => $emailSetting->from_address,
            ]);
    
            Mail::to($user->email)->send(new ResetPasswordMail($user, $token));
        }
    }
}
