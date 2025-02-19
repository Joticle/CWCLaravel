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

        $search = $request->input('search');

        $query = CourseEnroll::where('status', 'Paid')
            ->where('payment_id', '!=', null)
            ->whereHas('course', function ($query) {
                $query->whereNull('deleted_at');
            })
            ->with(['course', 'user']);

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('course', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%$search%");
                })
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%$search%");
                    });
            });
        }

        $data['courses'] = $query->paginate(env('RECORD_PER_PAGE', 10));

        return view('backoffice.revenue.list', compact('data', 'search'));
    }






}

