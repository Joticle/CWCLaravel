<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Cases;
use App\Models\Course;
use App\Models\Faqs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Validator;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [];
        $data['total_paid_courses'] = Course::where('price', '>', 0)->count();
        $data['total_free_courses'] = Course::where('price', '=', 0)->count();
        return view('backoffice.dashboard',$data);
    }
    function logout(){
        Auth::logout();
        return redirect()->to(route('login'));
    }

}
