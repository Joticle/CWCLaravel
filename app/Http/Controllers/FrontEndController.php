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

        /*breadcrumb start*/
        $breadcrumb = [];
        $breadcrumb['Home'] = route('index');
        $breadcrumb[$page->name] = '';
        $data['breadcrumb'] = $breadcrumb;
        /*breadcrumb end*/


        $data['row']  = $page;

        return view('page', $data);
    }

    public function connectionPage($slug)
    {
        $row = Connection::where('slug', $slug)->firstOrFail();
        $data = [];

        /*breadcrumb start*/
        $breadcrumb = [];
        $breadcrumb['Home'] = route('index');
        $breadcrumb[$row->name] = '';
        $data['breadcrumb'] = $breadcrumb;
        /*breadcrumb end*/

        $data['row']  = $row;

        return view('page', $data);
    }
}
