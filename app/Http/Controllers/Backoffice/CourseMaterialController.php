<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\ContentTypes;
use App\Models\CourseModuleContent;
use App\Models\CourseModules;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Validator;

class CourseMaterialController extends Controller
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
    public function index($module_id=0)
    {

        $data = [];
        $course_id = 0;
        $courseModule = [];
        if($module_id){
            $courseModule = CourseModules::whereId($module_id)->first();
            $course_id = $courseModule->course_id;
        }
        $course = Course::whereId($course_id)->first();

        $data['singular_name'] = 'Course Content';
        $data['pulular_name'] = 'Course Contents';
        $breadcrumb = [];
        $breadcrumb['Courses'] = route('admin.course.list');
        if($course && $module_id){
            $breadcrumb[$course->name] = route('admin.course.edit',$course->id);
            $breadcrumb[$courseModule->name] = route('admin.course.module.list',$course->id);
        }else{
            Session::flash('activeModal','selectCourseModuleModal');
        }
        $breadcrumb['Course Module Content'] = '';
        $data['breadcrumb'] = $breadcrumb;

        $data['course'] = $course;
        $data['courseModule'] = $courseModule;

        $data['data']   = CourseModuleContent::where('course_id','=',$course_id)->where('course_module_id','=',$module_id)->orderBy('sort_order','asc')->get();
        $content_types = ContentTypes::where('status','=','1')->get()->toArray();
        $data['content_types'] = array_column($content_types, null, 'id');
        return view('backoffice.course-material.list',$data);
    }

    public function create(Request $request, $module_id)
    {
        //debug($request->all(),1);
        $validator = Validator::make($request->all(), [
            'content_type' => 'required',
            'name' => 'required',
            'value' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $courseModule = CourseModules::whereId($module_id)->first();
        $course_id = $courseModule->course_id;

        $data = [];
        $data['course_id'] = $course_id;
        $data['course_module_id'] = $module_id;
        $data['name'] = $request->get('name');
        $data['content_type_id'] = $request->get('content_type');
        $record = CourseModuleContent::create($data);
        if($request->hasFile('value')){
            $uploadingPath = public_path('/uploads/course-module-content/'.$record->id);
            if(!is_dir($uploadingPath)){
                mkdir($uploadingPath,0777);
            }
            $file = $request->file('value');
            $fileExtension = $file->getClientOriginalExtension();
            $image_name = 'file-'.rand(0,999).'-'.time().'.'.$fileExtension;
            $imageUpload = $file->move($uploadingPath, $image_name);
            $record->value = $image_name;
            $record->save();
        }else{
            $record->value = $request->get('value');
            $record->save();
        }
        return redirect()->back()->with('success','Course Module Content Created Successfully.');
    }
    function delete($id){
        CourseModuleContent::whereId($id)->delete();
        return redirect()->back()->with('success','Course Module Content Deleted Successfully.');
    }
    function sort(Request $request){
        //debug($request->all(),1);
        $sorting = $request->get('sorting');
        foreach ($sorting as $id=>$sort_order){
            CourseModuleContent::whereId($id)->update(['sort_order'=>$sort_order]);
        }
        return ['success'=>'true','message'=>'Sorted'];
    }
}
