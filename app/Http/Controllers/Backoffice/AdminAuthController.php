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
}
