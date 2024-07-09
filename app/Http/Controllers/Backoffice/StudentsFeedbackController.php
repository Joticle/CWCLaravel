<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\StudentsFeedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StudentsFeedback\CreateStudentsFeedbackRequest;
use App\Http\Requests\Admin\StudentsFeedback\UpdateStudentsFeedbackRequest;
use App\Services\StudentsFeedbackService;
use Illuminate\Support\Facades\Validator;

class StudentsFeedbackController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private StudentsFeedbackService $studentsFeedbackService;

    public function __construct(StudentsFeedbackService $studentsFeedbackService)
    {
        $this->studentsFeedbackService = $studentsFeedbackService;
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

        $data['data'] = StudentsFeedback::paginate(env('RECORD_PER_PAGE', 10));
        return view('backoffice.students-feedback.list', $data);
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


        return view('backoffice.students-feedback.add', $data);
    }
    public function create(CreateStudentsFeedbackRequest $request)
    {
        try {

            $this->studentsFeedbackService->store($request->all());

            return redirect()->to(route('admin.student-feedback.list'))->with('success', 'Student Feedback Created Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
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

        return view('backoffice.students-feedback.edit', $data);
    }
    public function update(UpdateStudentsFeedbackRequest $request, $id)
    {
        try {

            $studentFeedback = StudentsFeedback::findOrFail($id);
            $this->studentsFeedbackService->update($studentFeedback, $request->all());

            return redirect()->to(route('admin.student-feedback.list'))->with('success', 'Student Feedback Update Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function delete($id)
    {
        try {
            $studentFeedback = StudentsFeedback::findOrFail($id);
            $this->studentsFeedbackService->delete($studentFeedback);

            return redirect()->to(route('admin.student-feedback.list'))->with('success', 'Student Feedback Deleted Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
