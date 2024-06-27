<?php

namespace App\Http\Controllers;

use App\Models\CourseEnroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
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
    public function index()
    {
        $data = [];
        $data['title'] = 'Dashboard';
        $breadcrumb = [];
        $breadcrumb['Home'] = route('index');
        $breadcrumb['All Courses'] = '';
        $data['breadcrumb'] = $breadcrumb;

        $user = Auth::user();
        $data['user'] = $user;
        $data['courseEnrolled'] = $user->courseEnrolled;
        return view('dashboard.index', $data);
    }
    public function myCourses()
    {
        $data = [];
        $data['title'] = 'Dashboard';
        $breadcrumb = [];
        $breadcrumb['Home'] = route('index');
        $breadcrumb['All Courses'] = '';
        $data['breadcrumb'] = $breadcrumb;

        $user = Auth::user();
        $data['user'] = $user;
        $data['courseEnrolled'] = CourseEnroll::where('user_id','=',$user->id)->where('status','=','Paid')->paginate(env('RECORD_PER_PAGE',6));
        return view('dashboard.my-courses', $data);
    }
}
