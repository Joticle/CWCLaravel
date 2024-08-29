<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [];
        $data['singular_name'] = 'Header Menu';
        $breadcrumb = [];
        $breadcrumb['Header Menu'] = route('admin.header.menus');
        $data['breadcrumb'] = $breadcrumb;
        return view('backoffice.menus.index', $data);
    }
}
