<?php

namespace App\Http\Controllers;

use App\Models\ContentTypes;
use App\Models\CourseEnroll;
use App\Models\Courses;
use App\Models\User;
use App\Utility\StripeController;
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
        //$enrolled_courses = \auth()->user()->courseEnrolled->pluck('course_id')->toArray();
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
        $data['contentTypes'] = ContentTypes::pluck('type','id')->toArray();
        return view('course-detail',$data);
    }
    function courseEnroll($slug){
        $course = Courses::where('status','=','1')->where('slug','=',$slug)->firstOrFail();
        if($course->enrolled()){
            return redirect()->back()->withErrors(['You already enrolled this course.']);
        }
        $data = [];
        $data['course_id'] = $course->id;
        $data['user_id'] = \auth()->user()->id;
        $data['date'] = date('Y-m-d');
        $data['amount'] = $course->price;
        $courseEnroll = CourseEnroll::create($data);

        if(!empty($course->price) && $course->price > 0){

            $line_items = [];
            $unit_price = round($course->price,2);
            $line_items[] = [
                'price_data' => [
                    'currency' => 'USD',
                    'unit_amount' =>$unit_price * 100,
                    'product_data' => [
                        'name' => $course->name,
                        'images' => [$course->getLogo()],
                        'description' => 'Course enrollment payment for ' . $course->name,
                    ],
                ],
                'quantity' => 1,
            ];
            $stripe = new StripeController;
            $meta = ['enroll_id'=>$courseEnroll->id];
            $stripe_response = $stripe->MakePaymentUrl($line_items, $meta);
            if($stripe_response['success'] == 'false'){
                return redirect()->back()->withErrors(['Sorry! There is something wrong the payments.']);
            }
            return redirect()->to($stripe_response['url']);
        }
        $courseEnroll->status = 'Paid';
        $courseEnroll->save();
        return redirect()->back()->with('success','Course Enroll Successfully.');
    }
}
