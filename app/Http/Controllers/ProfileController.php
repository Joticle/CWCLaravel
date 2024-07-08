<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateUserAvatarRequest;
use App\Http\Requests\User\UpdateUserPasswordRequest;
use App\Http\Requests\User\UpdateUserProfileRequest;
use App\Rules\OldPassword;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('auth');
        $this->userService = $userService;
    }

    public function index()
    {

        $user = Auth::user();

        $data = [];
        $data['title'] = 'My Profile';
        $data['user'] = $user;

        return view('dashboard.profile', $data);
    }

    public function updateProfile(UpdateUserProfileRequest $request)
    {
        try {

            $user = Auth::user();

            $this->userService->update($user, $request->validated());

            return redirect()->back()->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function updatePassword(UpdateUserPasswordRequest $request)
    {

        try {

            $user = Auth::user();
            $this->userService->update($user, $request->only(['password']));

            return redirect()->back()->with('success', 'Password updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()])->with('activeTab', 'update-password');
        }
    }

    public function updateThumbnail(UpdateUserAvatarRequest $request)
    {


        try {
            $user = Auth::user();

            $this->userService->update($user, $request->validated());

            return response()->json(['success' => true, 'reload' => true, 'message' => 'Profile Image updated Successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Something went wrong']);
        }
    }
}
