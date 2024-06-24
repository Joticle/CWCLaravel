<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\ContentTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Validator;

class ContentTypeController extends Controller
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
        $data['singular_name'] = 'Content Type';
        $data['pulular_name'] = 'Content Types';
        $breadcrumb = [];
        $breadcrumb['Content Types'] = route('admin.content-type.list');
        $breadcrumb['All Content Types'] = '';
        $data['breadcrumb'] = $breadcrumb;

        $data['data'] = ContentTypes::paginate(env('RECORD_PER_PAGE',10));
        return view('backoffice.content-types.list',$data);
    }
    public function add()
    {
        $data = [];
        $data['singular_name'] = 'Content Type';
        $data['pulular_name'] = 'Content Types';
        $breadcrumb = [];
        $breadcrumb['Add Content Type'] = '';
        $data['breadcrumb'] = $breadcrumb;

        return view('backoffice.content-types.add',$data);
    }
    public function create(Request $request)
    {
        //debug($request->all(),1);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $data = [];
        $data['name'] = $request->get('name');
        $data['type'] = $request->get('type');
        $record = ContentTypes::create($data);
        return redirect()->to(route('admin.content-type.list'))->with('success','Content Type Created Successfully.');
    }

    public function edit($id)
    {
        $course = ContentTypes::findOrFail($id);

        $data = [];
        $data['singular_name'] = 'Content Type';
        $data['pulular_name'] = 'Content Types';
        $breadcrumb = [];
        $breadcrumb['Content Types'] = route('admin.content-type.list');
        $breadcrumb[$course->name] = '';
        $data['breadcrumb'] = $breadcrumb;
        $data['row'] = $course;

        return view('backoffice.content-types.edit',$data);
    }
    public function update(Request $request,$id)
    {
        $record = ContentTypes::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $record->name = $request->get('name');
        $record->type = $request->get('type');
        $record->status = $request->get('status');
        $record->save();
        return redirect()->to(route('admin.content-type.list'))->with('success','Content Type Update Successfully.');
    }
    function delete($id){
        ContentTypes::whereId($id)->delete();
        return redirect()->to(route('admin.content-type.list'))->with('success','Content Type Deleted Successfully.');
    }
}
