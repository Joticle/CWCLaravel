<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\CourseModules;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Validator;

class CourseModuleController extends Controller
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
    public function index($course_id=0)
    {
        $data = [];
        $course = Course::whereId($course_id)->first();

        $data['singular_name'] = 'Course Module';
        $data['pulular_name'] = 'Course Modules';
        $breadcrumb = [];
        $breadcrumb['Courses'] = route('admin.course.list');
        if($course){
            $breadcrumb[$course->name] = route('admin.course.edit',$course->id);
        }else{
            Session::flash('activeModal','selectCourseModal');
        }
        $breadcrumb['Course Modules'] = '';
        $data['breadcrumb'] = $breadcrumb;

        $data['course'] = $course;
        $data['data']   = CourseModules::where('course_id','=',$course_id)->orderBy('sort_order','asc')->get();
        return view('backoffice.course-modules.list',$data);
    }

    public function create(Request $request, $course_id)
    {
        //debug($request->all(),1);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $data = [];
        $data['course_id'] = $course_id;
        $data['name'] = $request->get('name');
        $data['slug'] = $this->slugify($request->get('name'));
        $data['description'] = $request->get('description');
        $data['start_date'] = $request->get('start_date');
        $data['end_date'] = $request->has('end_date')?$request->get('end_date'):null;
        $record = CourseModules::create($data);

        return redirect()->back()->with('success','Course Module Created Successfully.');
    }
    private function slugify($text,$id=''){
        $slug = Str::slug($text);
        $isExists = CourseModules::where('slug','=',$slug);
        if(!empty($id)){
            $isExists = $isExists->where('id','!=',$id);
        }
        $isExists = $isExists->count();
        if($isExists){
            $slug = $slug.'-'.$isExists;
        }
        return $slug;
    }
    public function edit($id)
    {
        $course = CourseModules::findOrFail($id);
        $data['course'] = $course;
        $html = view('backoffice.course-modules.edit',$data)->render();
        return ['success'=>'true','html'=>$html];
    }
    public function update(Request $request, $id)
    {
        //debug($request->all(),1);
        $record = CourseModules::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $record->name = $request->get('name');
        //$record->slug = $this->slugify($request->get('name'), $id);
        $record->description = $request->get('description');
        $record->start_date = $request->get('start_date');
        $record->end_date = $request->has('end_date')?$request->get('end_date'):null;
        $record->status = $request->get('status');
        $record->save();
        return redirect()->back()->with('success','Course Module Update Successfully.');
    }
    function delete($id){
        CourseModules::whereId($id)->delete();
        return redirect()->back()->with('success','Course Module Deleted Successfully.');
    }
    function sort(Request $request){
        //debug($request->all(),1);
        $sorting = $request->get('sorting');
        foreach ($sorting as $id=>$sort_order){
            CourseModules::whereId($id)->update(['sort_order'=>$sort_order]);
        }
        return ['success'=>'true','message'=>'Sorted'];
    }
}
