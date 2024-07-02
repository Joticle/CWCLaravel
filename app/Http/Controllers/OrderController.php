<?php

namespace App\Http\Controllers;

use App\Models\CourseEnroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function orderHistory()
    {
        $user = Auth::user();

        $data = [];
        $data['title'] = 'Order History';
        $data['user'] = $user;
        $data['orders'] = CourseEnroll::with('course')->where('user_id', $user->id)->paginate(env('RECORD_PER_PAGE'));

        return view('dashboard.order-history', $data);

    }
}
