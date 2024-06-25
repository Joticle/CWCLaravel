<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
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

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        try
        {

            $user = auth()->user();
            $path = Storage::disk('local')->putFile('profile/thumnail',$request->thumbnail);

            // delete previous thumbnail
            if (Storage::disk('local')->exists($user->thumbnail)) {
                Storage::disk('local')->delete($user->thumbnail);
            }

            $user->thumbnail = $path;
            $user->thumbnail = $request->name;
            $user->save();

            return redirect()->back()->with('success','Profile Updated Successfully.');

        } catch (\Exception $e) {
            // Handle other exceptions (e.g., database errors, server issues, etc.)
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
