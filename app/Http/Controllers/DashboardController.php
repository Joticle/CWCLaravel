<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [];
        $data['title'] = 'Dashboard';
        $breadcrumb = [];
        $breadcrumb['Home'] = route('index');
        $breadcrumb['All Courses'] = '';
        $data['breadcrumb'] = $breadcrumb;

        $user = Auth::user();
        $data['user'] = $user;
        $data['courseEnrolled'] = $user->courseEnrolled;
        return view('dashboard.index', $data);
    }
}
