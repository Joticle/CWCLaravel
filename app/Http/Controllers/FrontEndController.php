<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use App\Models\Connection;
use App\Models\Courses;
use App\Models\Faqs;
use App\Models\StudentsFeedback;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;

class FrontEndController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [];
        $data['studentsFeedback']  = StudentsFeedback::active()->get();
        $data['connections']  = Connection::active()->get();
        return view('home',$data);
    }
    function logout(){
        Auth::logout();
        return redirect()->to(route('index'));
    }
}
