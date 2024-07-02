<?php

namespace App\Http\Controllers;

use App\Rules\OldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $user = Auth::user();

        $data = [];
        $data['title'] = 'My Profile';
        $data['user'] = $user;

        return view('dashboard.profile', $data);
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            // 'thumbnail' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        try {
            $user = Auth::user();

            $user->name = $request->name;

            // Handle thumbnail update if provided
            // if($request->hasFile('thumbnail'))
            // {
            //     $uploadingPath = public_path('/uploads/user/'. $user->id);
            //     if(!is_dir($uploadingPath)){
            //         mkdir($uploadingPath, 0777, true);
            //     }
            //     $file = $request->file('thumbnail');
            //     $fileExtension = $file->getClientOriginalExtension();
            //     $image_name = 'thumbnail'.time().'.'.$fileExtension;
            //     $imageUpload = $file->move($uploadingPath, $image_name);
            //     if ($user->thumbnail) {
            //         $previousThumbnailPath = $uploadingPath . '/' . $user->thumbnail;
            //         if (file_exists($previousThumbnailPath)) {
            //             unlink($previousThumbnailPath);
            //         }
            //     }
            //     $user->thumbnail = $image_name;
            // }
            $user->save();
            return redirect()->back()->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'old_password' => ['required', 'string', new OldPassword],
                'new_password' => 'required|min:8|confirmed|different:old_password'
            ]
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
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ]);
        }

        try {
            $user = Auth::user();

            if ($request->hasFile('thumbnail')) {
                $uploadingPath = public_path('/uploads/user/' . $user->id);
                if (!is_dir($uploadingPath)) {
                    mkdir($uploadingPath, 0777, true);
                }
                $file = $request->file('thumbnail');
                $fileExtension = $file->getClientOriginalExtension();
                $image_name = 'thumbnail' . time() . '.' . $fileExtension;
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
            return response()->json(['success' => true, 'reload' => true, 'message' => 'Profile Image updated Successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Something went wrong']);
        }
    }
}
