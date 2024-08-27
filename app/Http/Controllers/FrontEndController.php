<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Cases;
use App\Models\Cms;
use App\Models\Connection;
use App\Models\Course;
use App\Models\Faqs;
use App\Models\StudentsFeedback;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;

class FrontEndController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [];
        $data['studentsFeedback']  = StudentsFeedback::active()->get();
        $data['connections']  = Connection::active()->get();
        $data['banners']  = Banner::active()->get();
        \DB::statement("ALTER TABLE `courses` CHANGE `level` `level` ENUM('Beginner','Intermediate','Expert','All Levels') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Beginner';");
        exit;
        return view('home',$data);
    }
    function logout(){
        Auth::logout();
        return redirect()->to(route('index'));
    }
    public function cmsPage($slug)
    {
        $page = Cms::where('slug', $slug)->firstOrFail();

        $data = [];
        $data['page']  = $page;

        return view('cms-page', $data);
    }
}
