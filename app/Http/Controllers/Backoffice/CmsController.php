<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\Cms;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CmsController extends Controller
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
    public function index()
    {
        $data = [];
        $data['singular_name'] = 'Cms Page';
        $data['pulular_name'] = 'Cms Pages';
        $breadcrumb = [];
        $breadcrumb['Cms Pages'] = route('admin.cms.list');
        $breadcrumb['All Cms Pages'] = '';
        $data['breadcrumb'] = $breadcrumb;

        $data['data'] = Cms::paginate(env('RECORD_PER_PAGE', 10));
        return view('backoffice.cms.list', $data);
    }
    public function add()
    {
        $data = [];
        $data['singular_name'] = 'Cms Page';
        $data['pulular_name'] = 'Cms Pages';
        $breadcrumb = [];
        $breadcrumb['Cms Pages'] = route('admin.cms.list');
        $breadcrumb['Add Cms Page'] = '';
        $data['breadcrumb'] = $breadcrumb;

        return view('backoffice.cms.add', $data);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }


        $data = [];
        $data['name'] = $request->get('name');
        $data['slug'] = $this->slugify($request->get('name'));
        $data['content'] = $request->get('content');
        $record = Cms::create($data);

        return redirect()->to(route('admin.cms.list'))->with('success', 'Cms Page Created Successfully.');
    }
    private function slugify($text, $id = '')
    {
        $slug = Str::slug($text);
        $isExists = Cms::where('slug', '=', $slug);
        if (!empty($id)) {
            $isExists = $isExists->where('id', '!=', $id);
        }
        $isExists = $isExists->count();
        if ($isExists) {
            $slug = $slug . '-' . $isExists;
        }
        return $slug;
    }
    public function edit($id)
    {
        $cms = Cms::findOrFail($id);

        $data = [];
        $data['singular_name'] = 'Cms Page ';
        $data['pulular_name'] = 'Cms Pages';
        $breadcrumb = [];
        $breadcrumb['Cms Pages'] = route('admin.cms.list');
        $breadcrumb[$cms->name] = '';
        $data['breadcrumb'] = $breadcrumb;
        $data['row'] = $cms;

        return view('backoffice.cms.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $record = Cms::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'content' => 'required',
            'status' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $record->name = $request->get('name');
        $record->content = $request->get('content');
        $record->status = $request->get('status');

        $record->save();
        return redirect()->to(route('admin.cms.list'))->with('success', 'Cms Page Update Successfully.');
    }
    function delete($id)
    {
        Cms::find($id)->delete();
        return redirect()->to(route('admin.cms.list'))->with('success', 'Cms Page Deleted Successfully.');
    }
    function search(Request $request)
    {
        $cms = Cms::where('name', 'like', '%' . $request->q . '%')->limit(15)->get(['id', 'name as text']);
        return ['items' => $cms];
    }
}
