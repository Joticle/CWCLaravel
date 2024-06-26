<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\StudentsFeedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StudentsFeedbackController extends Controller
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
        $data['singular_name'] = 'Student Feedback';
        $data['pulular_name'] = 'Students Feedback';
        $breadcrumb = [];
        $breadcrumb['Students Feedback'] = route('admin.student-feedback.list');
        $breadcrumb['All Students Feedback'] = '';
        $data['breadcrumb'] = $breadcrumb;

        $data['data'] = StudentsFeedback::paginate(env('RECORD_PER_PAGE',10));
        return view('backoffice.students-feedback.list',$data);
    }
    public function add()
    {
        $data = [];
        $data['singular_name'] = 'Student Feedback';
        $data['pulular_name'] = 'Students Feedback';
        $breadcrumb = [];
        $breadcrumb['Students Feedback'] = route('admin.student-feedback.list');
        $breadcrumb['Add Student Feedback'] = '';
        $data['breadcrumb'] = $breadcrumb;
        $data['ratings'] = StudentsFeedback::RATINGS;


        return view('backoffice.students-feedback.add',$data);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'designation' => 'required|string',
            'image' => 'required|image',
            'text' => 'required',
            'rating' => 'required|in:' . implode(',', StudentsFeedback::RATINGS),
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $data = [];
        $data['name'] = $request->get('name');
        $data['designation'] = $request->get('designation');
        $data['text'] = $request->get('text');
        $data['rating'] = $request->get('rating');
        $record = StudentsFeedback::create($data);

        if($request->hasFile('image')){
            $uploadingPath = public_path('/uploads/students/'.$record->id);
            if(!is_dir($uploadingPath)){
                mkdir($uploadingPath,0777,true);
            }
            $file = $request->file('image');
            $fileExtension = $file->getClientOriginalExtension();
            $image_name = 'image'.time().'.'.$fileExtension;
            $imageUpload = $file->move($uploadingPath, $image_name);
            $record->image = $image_name;
            $record->save();
        }
        return redirect()->to(route('admin.student-feedback.list'))->with('success','Student Feedback Created Successfully.');
    }
    public function edit($id)
    {
        $course = StudentsFeedback::findOrFail($id);

        $data = [];
        $data['singular_name'] = 'Student Feedback';
        $data['pulular_name'] = 'Students Feedback';
        $breadcrumb = [];
        $breadcrumb['Students Feedback'] = route('admin.student-feedback.list');
        $breadcrumb[$course->name] = '';
        $data['breadcrumb'] = $breadcrumb;
        $data['row'] = $course;
        $data['ratings'] = StudentsFeedback::RATINGS;

        return view('backoffice.students-feedback.edit',$data);
    }
    public function update(Request $request,$id)
    {
        $record = StudentsFeedback::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'designation' => 'required|string',
            'image' => 'nullable|image',
            'text' => 'required',
            'status' => 'required|in:0,1',
            'rating' => 'required|in:' . implode(',', StudentsFeedback::RATINGS),
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $record->name = $request->get('name');
        $record->designation = $request->get('designation');
        $record->text = $request->get('text');
        $record->rating = $request->get('rating');
        $record->status = $request->get('status');

        if($request->hasFile('image')){
            $uploadingPath = public_path('/uploads/students/'.$record->id);
            if(!is_dir($uploadingPath)){
                mkdir($uploadingPath,0777);
            }
            if(!empty($record->logo)){
                unlink($uploadingPath.'/'.$record->logo);
            }
            $file = $request->file('image');
            $fileExtension = $file->getClientOriginalExtension();
            $image_name = 'image'.time().'.'.$fileExtension;
            $imageUpload = $file->move($uploadingPath, $image_name);
            $record->image = $image_name;
        }
        $record->save();
        return redirect()->to(route('admin.student-feedback.list'))->with('success','Student Feedback Update Successfully.');
    }
    public function delete($id){
        StudentsFeedback::whereId($id)->delete();
        return redirect()->to(route('admin.student-feedback.list'))->with('success','Student Feedback Deleted Successfully.');
    }
}
