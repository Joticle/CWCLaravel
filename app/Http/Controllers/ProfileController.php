<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index() {

        $user = Auth::user();

        $data = [];
        $data['title'] = 'Profile';
        $data['user'] = $user;

        return view('dashboard.profile', $data);

    }
}
