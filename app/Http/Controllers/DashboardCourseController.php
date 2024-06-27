<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardCourseController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $data = [];
        $data['title'] = 'Enrolled Courses';
        $data['user'] = $user;
        $data['courses'] = Courses::whereHas('courseEnrolls', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->paginate(env('RECORD_PER_PAGE', 6));


        return view('dashboard.enrolled-courses', $data);
    }
}
