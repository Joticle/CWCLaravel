<?php

namespace App\Http\Controllers;

use App\Models\CourseEnroll;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardCourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
