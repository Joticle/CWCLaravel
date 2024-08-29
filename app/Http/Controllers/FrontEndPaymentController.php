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
    function paymentSuccess()
    {
        $stripe = new StripeController;
        $sessionId = \request()->get('sessionId', '');
        $stripe_response = $stripe->checkConfirmPayment($sessionId);
        if ($stripe_response['success'] == 'true') {
            return redirect()->to($stripe_response['url'])->with('success', 'Course Enroll Successfully.');
        }
        abort(404);
    }
    function paymentError()
    {
        $stripe = new StripeController;
        $sessionId = \request()->get('sessionId', '');
        $stripe_response = $stripe->checkCancelPayment($sessionId);
        return redirect()->to($stripe_response['url'])->withErrors(['Payment Cancel! Sorry You Cannot Enroll The Course.']);
    }

    public function checkout($id = 0)
    {
        try {
            $course = Course::active()->find($id);
            $line_items = [];
            $unit_price = round($course->price, 2);
            $line_items[] = [
                'price_data' => [
                    'currency' => 'USD',
                    'unit_amount' => $unit_price * 100,
                    'product_data' => [
                        'name' => $course->name,
                        'images' => [$course->getLogo()],
                        'description' => 'Course enrollment payment for ' . $course->name,
                    ],
                ],
                'quantity' => 1,
            ];
            $meta = ['user_id' => user_id(), 'course_id' => $course->id];
            $stripe = new StripeController;
            $response = $stripe->MakePaymentUrl($line_items, $meta);
            if ($response['success'] == false) {
                return response()->json(['success' => false, 'message' => $response['message']]);
            }
            return response()->json(['success' => true, 'data' => ['clientSecret' => $response['secret']]]);
        } catch(\Exception $ex) {
            return response()->json(['success' => false, 'message' => $ex->getMessage()]);
        }

    }
}
