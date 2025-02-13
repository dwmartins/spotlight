<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class UserController extends Controller
{
    private $pathToAvatas = 'users/avatars';
    /**
     * returns the user panel view  /pages/user/panel.blade.php
     * @return View
     */
    public function panelView(): View {
        $websiteName = config('website_info.websiteName');

        return view('pages.user.panel', [
            'custom_seo_title' => trans('seo.title_user_panel') . ' | ' . $websiteName
        ]);
    }

    /**
     * returns the user profile view  /pages/user/profile.blade.php
     * @return View
     */
    public function profileView(): View {
        $websiteName = config('website_info.websiteName');

        return view('pages.user.profile', [
            'custom_seo_title' => trans('seo.title_user_profile') . ' | ' . $websiteName
        ]);
    }

    public function update(Request $request) {
        $errors = validateFields($request->all());
        if($errors) {
            return redirectWithMessage('error', trans('messages.invalid_fields_message'), $errors);
        }
        
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => $request->has('name') ? 'required|string|max:255' : 'nullable|string|max:255',
            'email' => $request->has('email') ? 'required|email|unique:users,email,' . $user->id : 'nullable',

            'lastName' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:100',
            'dateOfBirth' => 'nullable|date',
            'description' => 'nullable|string|max:500',
            'address' => 'nullable|string|max:255',
            'complement' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'zipCode' => 'nullable|string|max:20',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
        ]);

        if($validator->fails()) {
            $errors = $validator->errors();

            return redirectWithMessage('error', trans('messages.invalid_fields_message'), $errors, 'user_profile');
        }

        $user->update($request->all());

        return redirectWithMessage('success', '', trans('messages.user_update_message'), 'user_profile');
    }

    public function updateAvatar(Request $request) {
        $file = $request->file('avatar');

        if (!$file) {
            return response()->json([
                'message' => trans('messages.no_file_sent'),
            ], 400);
        }
        
        $allowedMimeTypes = config('constants.allowedMimeTypes.images');
        $maxSize = config('constants.allowedFileSizes.avatars'); // 2MB
        $errors = [];

        if (!in_array($file->getMimeType(), $allowedMimeTypes)) {
            $errors['type'] = [trans('messages.file_type', ['types' => 'jpeg, png, jpg'])];
        }

        if ($file->getSize() > $maxSize) {
            $errors['size'] = [trans('messages.file_max_size', ['size' => '2'])];
        }

        if($errors) {
            return response()->json([
                'message' => $errors
            ], 400);
        }

        $user = Auth::user();

        if($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($this->pathToAvatas . '/' . $user->avatar)) {
                Storage::disk('public')->delete($this->pathToAvatas . '/' . $user->avatar);
            }

            $image = $request->file('avatar');
            $imageName = $user->id . '.' . $image->getClientOriginalExtension();

            $image->storeAs($this->pathToAvatas, $imageName, 'public');

            $user->avatar = $imageName;
            $user->save();

            return response()->json([
                'message' => trans('messages.profile_updated_successfully'),
                'avatar' => $this->pathToAvatas .'/'. $user->getAvatar(),
            ], 200);
        }
    }

    public function changePassword(Request $request) {
        $errors = validateFields($request->all());
        if($errors) {
            return redirectWithMessage('error', trans('messages.invalid_fields_message'), $errors);
        }

        $validator = Validator::make($request->all(), [
            'currentPassword' => 'required|string|max:100',
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

        $user = Auth::user();

        if (!Hash::check($request->currentPassword, $user->password)) {
            return redirectWithMessage('error', trans('messages.alert_title_error'), trans('messages.current_password_incorrect'));
        }

        $user->password = Hash::make($request->newPassword);
        $user->save();

        return redirectWithMessage('success', trans('messages.alert_title_success'), trans('messages.password_update'), 'user_profile');
    }

    public function updateSettings(Request $request) {
        $user = Auth::user();

        $user->acceptsEmails = $request->has('acceptsEmails') ? 'Y' : 'N';
        $user->save();

        return redirectWithMessage('success', trans('messages.alert_title_success'), trans('messages.updated_user_settings'), 'user_profile');
    }

    public function deleteAccount(Request $request) {
        $user = Auth::user();
        $confirmDelete = $request->has('confirmAccountDeletion');

        if($confirmDelete) {
            if ($user->avatar && Storage::disk('public')->exists($this->pathToAvatas . '/' . $user->avatar)) {
                Storage::disk('public')->delete($this->pathToAvatas . '/' . $user->avatar);
            }
            
            $user->delete();
            Auth::logout();

            return redirectWithMessage('success', trans('messages.alert_title_success'), trans('messages.account_deleted_successfully'), 'home_page');
        }

        return back();
    }
}
