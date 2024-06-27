<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WhishlistController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $data = [];
        $data['title'] = 'Whishlist';
        $data['user'] = $user;


        return view('dashboard.whishlist', $data);
    }
}
