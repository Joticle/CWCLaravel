<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use App\Models\Courses;
use App\Models\Faqs;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;

class FrontEndCourseController extends Controller
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
    function courses(){
        $data = [];
        $data['title'] = 'All Courses';
        //$data['description'] = 'All Courses';
        $breadcrumb = [];
        $breadcrumb['Home'] = route('index');
        $breadcrumb['All Courses'] = '';
        $data['breadcrumb'] = $breadcrumb;
        $today = Carbon::today();
        $data['courses'] = Courses::where('status','=','1')->where(function ($query) use ($today) {
            $query->whereNull('end_date')->orWhere('end_date', '>=', $today);
        })->withCount('modules')->paginate(env('RECORD_PER_PAGE',10));

        return view('courses',$data);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    function courseDetail($slug){
        $course = Courses::where('status','=','1')->where('slug','=',$slug)->withCount('modules')->firstOrFail();

        $data = [];
        $data['title'] = $course->name;
        //$data['description'] = 'All Courses';
        $breadcrumb = [];
        $breadcrumb['Home'] = route('index');
        $breadcrumb['All Courses'] = route('courses');
        $breadcrumb[$course->name] = '';
        $data['breadcrumb'] = $breadcrumb;
        $today = Carbon::today();

        $data['course'] = $course;
        return view('course-detail',$data);
    }
}
