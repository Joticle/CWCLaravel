<?php
namespace App\Utility;

use App\Models\CourseEnroll;
use App\Models\Courses;
use App\Models\Payments;
use Stripe\Checkout\Session;

class StripeController
{
    public $secret;
    function __construct(){
        $this->secret = env('STRIPE_SECRET_KEY');
        \Stripe\Stripe::setApiKey($this->secret);
    }
    function MakePaymentUrl($line_items, $metadata){
        try{
            $data = [];
            $data['payment_method_types'] = ['card'];
            $data['line_items'] = $line_items;
            $data['mode'] = 'payment'; // 'setup' or 'subscription' can be used here based on your needs
            $data['success_url'] = route('payment.success').'?sessionId={CHECKOUT_SESSION_ID}';
            $data['cancel_url'] = route('payment.error').'?sessionId={CHECKOUT_SESSION_ID}';
            $data['metadata'] = $metadata;
            $checkout_session = Session::create($data);
            return ['success'=>'true','url'=> $checkout_session->url];
        } catch (\Exception $e){
            return ['success'=>'false', 'message'=>$e->getMessage()];
        }
    }
    function checkConfirmPayment($sessionId){
        $message = 'Sorry! your payment cannot processed.';
        $success = 'false';
        $url = '';

        try {
            $session = Session::retrieve($sessionId);
            if(isset($session->id) && !empty($session->id) && $session->payment_status == 'paid'){
                $payment_intent = \Stripe\PaymentIntent::retrieve($session->payment_intent);
                // Save payment response
                $payment = new Payments();
                $payment->payment_id = $payment_intent->id;
                $payment->user_id = auth()->user()->id;
                $payment->amount = $payment_intent->amount/100;
                $payment->currency = $payment_intent->currency;
                $payment->status = $payment_intent->status;
                $payment->response = json_encode($payment_intent);
                $payment->save();

                if($session->metadata->enroll_id){
                    $enroll_id = $session->metadata->enroll_id;
                    $courseEnroll = CourseEnroll::find($enroll_id);
                    $courseEnroll->payment_id = $payment->id;
                    $courseEnroll->status = 'Paid';
                    $courseEnroll->save();

                    $course = Courses::find($courseEnroll->course_id);
                    $success = 'true';
                    $message = 'Payment Confirmed Successfully.';
                    $url = route('course.detail',$course->slug);
                }
            }
        }catch (\Exception $e){
            $message = $e->getMessage();
        }
        return ['success'=>$success, 'message'=>$message,'url'=>$url];
    }
    function checkCancelPayment($sessionId){
        $message = 'Sorry! your payment cannot processed.';
        $success = 'false';
        $url = url('/');
        try {
            $session = Session::retrieve($sessionId);
            if(isset($session->id) && !empty($session->id)){

                if($session->metadata->enroll_id){
                    $enroll_id = $session->metadata->enroll_id;
                    $courseEnroll = CourseEnroll::find($enroll_id);
                    $course = Courses::find($courseEnroll->course_id);
                    $url = route('course.detail',$course->slug);
                    $courseEnroll->delete();
                }
            }
        }catch (\Exception $e){
            $message = $e->getMessage();
        }
        return ['success'=>$success, 'message'=>$message,'url'=>$url];
    }

}
