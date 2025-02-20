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

        $data['total_revenue'] = CourseEnroll::where('status', 'Paid')->sum('amount');
        $data['total_users'] = User::all()->count();
        $data['total_courses'] = Course::all()->count();

        $search = $request->input('search');
        $course_id = $request->input('course_id');
        $user_id = $request->input('user_id');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $query = CourseEnroll::where('status', 'Paid')
            ->where('payment_id', '!=', null)
            ->whereHas('course', function ($q) {
                $q->whereNull('deleted_at');
            })
            ->with(['course', 'user']);

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
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        $data['courses'] = $query->paginate(env('RECORD_PER_PAGE', 10));

        return view('backoffice.revenue.list', compact('data', 'search', 'course_id', 'user_id', 'start_date', 'end_date'));
    }



}

