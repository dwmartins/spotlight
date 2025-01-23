<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'custom_seo_title' => trans('messages.SEO_TITLE_USER_PANEL') . ' | ' . $websiteName
        ]);
    }

    /**
     * returns the user profile view  /pages/user/profile.blade.php
     * @return View
     */
    public function profileView(): View {
        $websiteName = config('website_info.websiteName');

        return view('pages.user.profile', [
            'custom_seo_title' => trans('messages.SEO_TITLE_USER_PROFILE') . ' | ' . $websiteName
        ]);
    }

    public function updateAvatar(Request $request) {
        $file = $request->file('avatar');

        if (!$file) {
            return response()->json([
                'message' => trans('messages.NO_FILE_SENT'),
            ], 400);
        }
        
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        $maxSize = 2048 * 1024; // 2MB
        $errors = [];

        if (!in_array($file->getMimeType(), $allowedMimeTypes)) {
            $errors['type'] = [trans('messages.FILE_TYPE', ['types' => 'jpeg, png, jpg'])];
        }

        if ($file->getSize() > $maxSize) {
            $errors['size'] = [trans('messages.FILE_MAX_SIZE', ['size' => '2'])];
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
                'message' => trans('messages.PROFILE_UPDATED_SUCCESSFULLY'),
                'avatar' => $this->pathToAvatas .'/'. $user->getAvatar(),
            ], 200);
        }
    }
}
