<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Rules\OldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Validator;

class AdminAuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth')->except('login');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(\auth()->check() && \auth()->user()->role == 'Admin'){
            return redirect()->to(route('admin.dashboard'));
        }
        return redirect()->to(route('admin.login'));
    }
    public function login()
    {
        $data = [];
        return view('backoffice.auth.login',$data);
    }
    public function logout()
    {
        \auth()->logout();
        return redirect()->to(route('admin.login'));
    }

    public function profile()
    {
        $data = [];
        $data['singular_name'] = 'Profile';
        $data['pulular_name'] = 'Profiles';
        $breadcrumb = [];
        $breadcrumb['Profile'] = '';
        $data['breadcrumb'] = $breadcrumb;

        $data['user'] = auth()->user();
        return view('backoffice.profile.edit', $data);
    }

    public function profilePost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        try {
            $user = Auth::user();

            $user->name = $request->name;

            // Handle thumbnail update if provided
            if ($request->hasFile('thumbnail')) {

                $path = $request->file('thumbnail')->store('uploads/user/' . $user->id, 'public');
                // Delete the previous thumbnail if it exists
                if ($user->thumbnail && Storage::disk('public')->exists($user->thumbnail)) {
                    Storage::disk('public')->delete($user->thumbnail);
                }
                $user->thumbnail = $path;
            }

            $user->save();

            return redirect()->back()->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => ['required','string', new OldPassword],
            'new_password' => 'required|min:8|confirmed|different:old_password']
        );

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        try {
            $user = Auth::user();
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->back()->with('success', 'Password updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
