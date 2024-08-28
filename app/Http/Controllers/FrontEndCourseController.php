<?php

namespace App\Http\Controllers;

use App\Models\ContentType;
use App\Models\ContentTypes;
use App\Models\CourseEnroll;
use App\Models\Course;
use App\Models\Tag;
use App\Models\User;
use App\Utility\StripeController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
    function courses(Request $request)
    {

        $data = [];
        $data['title'] = 'All Courses';
        //$data['description'] = 'All Courses';
        $breadcrumb = [];
        $breadcrumb['Home'] = route('index');
        $breadcrumb['All Courses'] = '';
        $data['breadcrumb'] = $breadcrumb;
        $today = Carbon::today();
        $userId = user_id();
        $data['courses'] = Course::active()->withCount(['enrolledUsers as is_enrolled' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }, 'modules'])->where(function ($query) use ($today) {
            $query->whereNull('end_date')->orWhere('end_date', '>=', $today);
        })->paginate(env('RECORD_PER_PAGE', 10));
        //$enrolled_courses = \auth()->user()->courseEnrolled->pluck('course_id')->toArray();

        $data['levels'] = Course::LEVELS;
        $data['tags'] = Tag::pluck('name');


        return view('courses', $data);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    function courseDetail($slug)
    {
        $userId = user_id();
        $course = Course::active()->where('slug', '=', $slug)->withCount(['enrolledUsers as is_enrolled' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }, 'modules'])->firstOrFail();

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
        $data['contentTypes'] = ContentType::pluck('type', 'id')->toArray();
        return view('course-detail', $data);
    }
    function courseEnroll($slug)
    {
        $course = Course::active()->where('slug', '=', $slug)->firstOrFail();
        if ($course->enrolled()) {
            return redirect()->back()->withErrors(['You already enrolled this course.']);
        }
        $data = [];
        $data['course_id'] = $course->id;
        $data['user_id'] = \auth()->user()->id;
        $data['date'] = date('Y-m-d');
        $data['amount'] = $course->price;
        $courseEnroll = CourseEnroll::create($data);

        if (!empty($course->price) && $course->price > 0) {

            $line_items = [];
            $unit_price = round($course->price, 2);
            $line_items[] = [
                'price_data' => [
                    'currency' => 'USD',
                    'unit_amount' => $unit_price * 100,
                    'product_data' => [
                        'name' => $course->name,
                        'images' => [$course->getLogo()],
                        'description' => 'Course enrollment payment for ' . $course->name,
                    ],
                ],
                'quantity' => 1,
            ];
            $stripe = new StripeController;
            $meta = ['enroll_id' => $courseEnroll->id];
            $stripe_response = $stripe->MakePaymentUrl($line_items, $meta);
            if ($stripe_response['success'] == 'false') {
                return redirect()->back()->withErrors(['Sorry! There is something wrong the payments.']);
            }
            return redirect()->to($stripe_response['url']);
        }
        $courseEnroll->status = 'Paid';
        $courseEnroll->save();
        return redirect()->back()->with('success', 'Course Enroll Successfully.');
    }

    public function coursesSearch(Request $request)
    {

        $today = Carbon::today();
        $userId = user_id();
        $courseLevels = array_keys(Arr::except(Course::LEVELS, ['All Levels']));

        $courses = Course::active()
            ->withCount([
                'enrolledUsers as is_enrolled' => function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                },
                'modules'
            ])
            ->where(function ($query) use ($today) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', $today);
            })
            ->when($request->search, function ($query) use ($request) {
                return $query->where(function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('description', 'like', '%' . $request->search . '%');
                });
            })
            ->when(isset($request->price), function ($query) use ($request) {
                $price = $request->price;
                return $query->when($price == 1, function ($q) {
                    $q->whereNot('price', 0);
                }, function ($q) {
                    $q->where('price', 0);
                });
            })
            ->when($request->has('tags') && !empty($request->tags), function ($query) use ($request) {

                return $query->where(function ($q) use ($request) {
                    $q->whereRaw('FIND_IN_SET(?, tags)', [$request->tags[0]]);

                    foreach (array_slice($request->tags, 1) as $term) {
                        $q->orWhereRaw('FIND_IN_SET(?, tags)', [$term]);
                    }
                });
            })
            ->when(request()->has('levels') && empty(array_diff($request->levels, $courseLevels)), function ($query) use ($request) {
                return $query->whereIn('level', $request->levels);
            })
            ->get();

        $html = '';
        $success = false;

        if ($courses->isNotEmpty()) {
            $html = view('course.list', compact('courses'))->render();
            $success = true;
        }

        return response()->json(['success' => $success, 'html' => $html]);
    }
}
