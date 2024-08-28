<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseRequirement\CreateCourseRequirementRequest;
use App\Http\Requests\Admin\CourseRequirement\UpdateCourseRequirementRequest;
use App\Models\CourseRequirement;
use App\Services\CourseRequirementService;
use App\Services\CourseService;
use Illuminate\Support\Str;
use Validator;

class CourseRequirementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private CourseRequirementService $courseRequirementService;

    public function __construct(CourseRequirementService $courseRequirementService)
    {
        $this->courseRequirementService = $courseRequirementService;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($course_id = 0)
    {
        $data = [];
        $course = Course::whereId($course_id)->first();

        $data['singular_name'] = 'Course Requirement';
        $data['pulular_name'] = 'Course Requirements';
        $breadcrumb = [];
        $breadcrumb['Courses'] = route('admin.course.list');
        if ($course) {
            $breadcrumb[$course->name] = route('admin.course.edit', $course->id);
        } else {
            Session::flash('activeModal', 'selectCourseModal');
        }
        $breadcrumb['Course Requirements'] = '';
        $data['breadcrumb'] = $breadcrumb;

        $data['course'] = $course;
        $data['data']   = CourseRequirement::where('course_id', '=', $course_id)->orderBy('sort_order', 'asc')->get();
        $data['prepopulatedCourses'] = [];
        if($course_id == 0) {
            $data['prepopulatedCourses'] = (new CourseController(new CourseService(new Course())))->search(new Request(), 5)['items'];
        }
        return view('backoffice.course-requirements.list', $data);
    }

    public function create(CreateCourseRequirementRequest $request)
    {
        try {

            $this->courseRequirementService->store($request->all());

            return redirect()->back()->with('success', 'Course Requirement Created Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $course = CourseRequirement::findOrFail($id);
        $data['course'] = $course;
        $html = view('backoffice.course-requirements.edit', $data)->render();
        return ['success' => 'true', 'html' => $html];
    }
    public function update(UpdateCourseRequirementRequest $request, $id)
    {
        try {
            $courseRequirement = CourseRequirement::findOrFail($id);
            $this->courseRequirementService->update($courseRequirement, $request->all());
            return redirect()->back()->with('success', 'Course Requirement Update Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function delete($id)
    {

        try {
            $courseRequirement = CourseRequirement::findOrFail($id);
            $this->courseRequirementService->delete($courseRequirement);

            return redirect()->back()->with('success', 'Course Requirement Deleted Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function sort(Request $request)
    {
        try {
            $sorting = $request->get('sorting');
            foreach ($sorting as $id => $sort_order) {
                CourseRequirement::whereId($id)->update(['sort_order' => $sort_order]);
            }
            return ['success' => 'true', 'message' => 'Sorted'];
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
