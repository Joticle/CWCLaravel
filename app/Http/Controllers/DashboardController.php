<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $data = [];
        $data['title'] = 'Dashboard';
        $data['user'] = $user;

        $data['enrolledCount'] = $user->courseEnrolled->count();

        return view('dashboard.index', $data);
    }
}
