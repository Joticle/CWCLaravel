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
use Illuminate\Support\Facades\Validator as FacadesValidator;
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
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        try {
            $user = Auth::user();

            $user->name = $request->name;

            // Handle thumbnail update if provided
            if($request->hasFile('thumbnail'))
            {
                $uploadingPath = public_path('/uploads/user/'. $user->id);
                if(!is_dir($uploadingPath)){
                    mkdir($uploadingPath, 0777, true);
                }
                $file = $request->file('thumbnail');
                $fileExtension = $file->getClientOriginalExtension();
                $image_name = 'thumbnail'.time().'.'.$fileExtension;
                $imageUpload = $file->move($uploadingPath, $image_name);
                if ($user->thumbnail) {
                    $previousThumbnailPath = $uploadingPath . '/' . $user->thumbnail;
                    if (file_exists($previousThumbnailPath)) {
                        unlink($previousThumbnailPath);
                    }
                }
                $user->thumbnail = $image_name;
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
            return redirect()->back()->withInput()->withErrors($validator->errors())->with('activeTab', 'update-password');
        }

        try {
            $user = Auth::user();
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->back()->with('success', 'Password updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()])->with('activeTab', 'update-password');
        }
    }

    public function updateThumbnail(Request $request)
    {
        $validator = FacadesValidator::make($request->thumbnail, [
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        try {
            $user = Auth::user();

            if($request->hasFile('thumbnail'))
            {
                $uploadingPath = public_path('/uploads/user/'. $user->id);
                if(!is_dir($uploadingPath)){
                    mkdir($uploadingPath, 0777, true);
                }
                $file = $request->file('thumbnail');
                $fileExtension = $file->getClientOriginalExtension();
                $image_name = 'thumbnail'.time().'.'.$fileExtension;
                $imageUpload = $file->move($uploadingPath, $image_name);
                if ($user->thumbnail) {
                    $previousThumbnailPath = $uploadingPath . '/' . $user->thumbnail;
                    if (file_exists($previousThumbnailPath)) {
                        unlink($previousThumbnailPath);
                    }
                }
                $user->thumbnail = $image_name;
                $user->save();
            }

            return redirect()->back()->with('success', 'Profile updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }

    }

}
