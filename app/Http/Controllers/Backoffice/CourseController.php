<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Courses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Support\Str;
use Validator;

class CourseController extends Controller
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
        $data['singular_name'] = 'Course';
        $data['pulular_name'] = 'Courses';
        $breadcrumb = [];
        $breadcrumb['Courses'] = route('admin.course.list');
        $breadcrumb['All Courses'] = '';
        $data['breadcrumb'] = $breadcrumb;

        $data['data'] = Courses::paginate(env('RECORD_PER_PAGE',10));
        return view('backoffice.courses.list',$data);
    }
    public function add()
    {
        $data = [];
        $data['singular_name'] = 'Course';
        $data['pulular_name'] = 'Courses';
        $breadcrumb = [];
        $breadcrumb['Courses'] = route('admin.course.list');
        $breadcrumb['Add Course'] = '';
        $data['breadcrumb'] = $breadcrumb;
        $data['levels'] = Courses::LEVELS;

        return view('backoffice.courses.add',$data);
    }
    public function create(Request $request)
    {
        //debug($request->all(),1);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'logo' => 'required|image',
            'description' => 'required',
            'start_date' => 'required',
            'price' => 'required|numeric',
            'level' => 'required|in:' . implode(',', Courses::LEVELS),
            'tags.*' => 'exists:tags,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $data = [];
        $data['name'] = $request->get('name');
        $data['slug'] = $this->slugify($request->get('name'));
        $data['description'] = $request->get('description');
        $data['start_date'] = $request->get('start_date');
        $data['end_date'] = $request->has('end_date')?$request->get('end_date'):null;
        $data['price'] = $request->get('price');
        $data['level'] = $request->get('level');
        $record = Courses::create($data);

        if(!empty($request->tags)) {
            $record->tags()->sync($request->tags);
        }

        if($request->hasFile('logo')){
            $uploadingPath = public_path('/uploads/courses/'.$record->id);
            if(!is_dir($uploadingPath)){
                mkdir($uploadingPath,0777);
            }
            $file = $request->file('logo');
            $fileExtension = $file->getClientOriginalExtension();
            $image_name = 'logo'.time().'.'.$fileExtension;
            $imageUpload = $file->move($uploadingPath, $image_name);
            $record->logo = $image_name;
            $record->save();
        }
        return redirect()->to(route('admin.course.list'))->with('success','Course Created Successfully.');
    }
    private function slugify($text,$id=''){
        $slug = Str::slug($text);
        $isExists = Courses::where('slug','=',$slug);
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
        $course = Courses::findOrFail($id);

        $data = [];
        $data['singular_name'] = 'Course ';
        $data['pulular_name'] = 'Courses';
        $breadcrumb = [];
        $breadcrumb['Courses'] = route('admin.course.list');
        $breadcrumb[$course->name] = '';
        $data['breadcrumb'] = $breadcrumb;
        $data['row'] = $course;
        $data['levels'] = Courses::LEVELS;
        $data['tags'] = Tag::get(['id','name as text']);

        return view('backoffice.courses.edit',$data);
    }
    public function update(Request $request,$id)
    {
        $record = Courses::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'price' => 'required|numeric',
            'level' => 'required|in:' . implode(',', Courses::LEVELS),
            'tags.*' => 'exists:tags,id'
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
        $record->price = $request->get('price');
        $record->level = $request->get('level');
        if($request->hasFile('logo')){
            $uploadingPath = public_path('/uploads/courses/'.$record->id);
            if(!is_dir($uploadingPath)){
                mkdir($uploadingPath,0777);
            }
            if(!empty($record->logo)){
                unlink($uploadingPath.'/'.$record->logo);
            }
            $file = $request->file('logo');
            $fileExtension = $file->getClientOriginalExtension();
            $image_name = 'logo'.time().'.'.$fileExtension;
            $imageUpload = $file->move($uploadingPath, $image_name);
            $record->logo = $image_name;
        }
        $record->save();
        return redirect()->to(route('admin.course.list'))->with('success','Course Update Successfully.');
    }
    function delete($id){
        Courses::whereId($id)->delete();
        return redirect()->to(route('admin.course.list'))->with('success','Course Deleted Successfully.');
    }
    function search(Request $request){
        $courses = Courses::where('name','like','%'.$request->q.'%')->where('status','=','1');
        if($request->has('with') && $request->get('with') == 'modules'){
            $courses = $courses->with('modules');
        }
        $courses = $courses->limit(15)->get();
        $data = [];
        foreach ($courses as $course){
            $row = [];
            $row['id'] = $course->id;
            $row['text'] = $course->name;
            $row['logo'] = $course->getLogo();
            $row['description'] = Str::words(strip_tags($course->description), 5, '...');
            $row['start_date'] = _date($course->start_date);
            $row['end_date'] = !empty($course->end_date)?_date($course->end_date):'--';
            if($request->has('with') && $request->get('with') == 'modules'){
                $row['children'] = $course->modules;
            }
            $data[] = $row;
        }
        return ['items'=>$data];
    }
}
