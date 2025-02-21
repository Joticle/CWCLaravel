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

        $data['total_revenue'] = CourseEnroll::where('status', 'Paid')->whereNotNull('payment_id')->whereHas('course')->sum('amount');
        $data['total_users'] = User::count();
        $data['total_courses'] = Course::count();

        $data['all_courses'] = Course::all();
        $data['all_users'] = User::all();

        // Get filter values
        $search = $request->input('search');
        $course_id = $request->input('course_id');
        $user_id = $request->input('user_id');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $query = CourseEnroll::where('status', 'Paid')->whereNotNull('payment_id')->whereHas('course');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('course', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%$search%");
                })->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%$search%");
                });
            });
        }

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

        return view('backoffice.revenue.list', compact('data', 'search', 'course_id', 'user_id', 'start_date', 'end_date'));
    }
}

