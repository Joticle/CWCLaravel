<?php

namespace App\Http\Controllers;

use App\Models\CourseEnroll;
use App\Models\Course;
use App\Models\User;
use App\Utility\StripeController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;

class FrontEndPaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    function paymentSuccess(){
        $stripe = new StripeController;
        $sessionId = \request()->get('sessionId','');
        $stripe_response = $stripe->checkConfirmPayment($sessionId);
        if($stripe_response['success']=='true'){
            return redirect()->to($stripe_response['url'])->with('success','Course Enroll Successfully.');
        }
        abort(404);
    }
    function paymentError(){
        $stripe = new StripeController;
        $sessionId = \request()->get('sessionId','');
        $stripe_response = $stripe->checkCancelPayment($sessionId);
        return redirect()->to($stripe_response['url'])->withErrors(['Payment Cancel! Sorry You Cannot Enroll The Course.']);
    }
}
