<?php

namespace App\Http\Controllers;

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


        return view('dashboard.enrolled-courses', $data);
    }
}
