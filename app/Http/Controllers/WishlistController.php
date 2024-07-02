<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WishlistController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        $data = [];
        $data['title'] = 'Wishlist';
        $data['user'] = $user;
        $data['courses'] = $user->wishlist()->paginate(env('RECORD_PER_PAGE',10));


        return view('dashboard.wishlist', $data);
    }

    public function action(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|exists:courses,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ]);
        }

        try {
            $user = Auth::user();
            $courseId = $request->input('course_id');

            $user->wishlist()->toggle($courseId);

            return response()->json(['success' => true, 'reload' => true, 'message' => 'Course bookmarked Successfully.']);
        } catch (\Exception $e) {
            dd($e);
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
