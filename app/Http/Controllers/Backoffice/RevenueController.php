<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseEnroll;
use App\Models\Course;
use App\Models\User;

class RevenueController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['title'] = 'Paid Courses';

        $data['breadcrumb'] = [
            'Dashboard' => route('admin.dashboard'),
            'Paid Courses' => ''
        ];

        $data['total_revenue'] = CourseEnroll::where('status', 'Paid')
            ->whereNotNull('payment_id')
            ->whereHas('course')
            ->sum('amount');

        $data['total_users'] = User::count();
        $data['total_paid_courses'] = Course::where('price', '>', 0)->count();
        $data['total_free_courses'] = Course::where('price', '=', 0)->count();

        // Get filter values
        $course_id = $request->input('course_id');
        $user_id = $request->input('user_id');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $query = CourseEnroll::where('status', 'Paid')->whereNotNull('payment_id')->whereHas('course');

        if (!empty($course_id)) {
            $query->where('course_id', $course_id);
        }

        if (!empty($user_id)) {
            $query->where('user_id', $user_id);
        }

        if (!empty($start_date) && !empty($end_date)) {
            $query->whereBetween('created_at', [date('Y-m-d', strtotime($start_date)), date('Y-m-d', strtotime($end_date))]);
        }

        $data['courses'] = $query->paginate(env('RECORD_PER_PAGE', 10));

        // Get filtered course and user lists based on enrolled records
        $filteredCourseIds = $query->pluck('course_id')->unique();
        $filteredUserIds = $query->pluck('user_id')->unique();

        $data['filtered_courses'] = Course::whereIn('id', $filteredCourseIds)->get();
        $data['filtered_users'] = User::whereIn('id', $filteredUserIds)->get();

        return view('backoffice.revenue.list', compact('data', 'course_id', 'user_id', 'start_date', 'end_date'));
    }

}

