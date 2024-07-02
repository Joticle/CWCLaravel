<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WhishlistController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        $data = [];
        $data['title'] = 'Whishlist';
        $data['user'] = $user;


        return view('dashboard.whishlist', $data);
    }
}
