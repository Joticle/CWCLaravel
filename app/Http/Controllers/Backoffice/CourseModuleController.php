<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\CourseModule;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseModule\CreateCourseModuleRequest;
use App\Http\Requests\Admin\CourseModule\UpdateCourseModuleRequest;
use App\Services\CourseModuleService;
use Illuminate\Support\Str;
use Validator;

class CourseModuleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private CourseModuleService $courseModuleService;

    public function __construct(CourseModuleService $courseModuleService)
    {
        $this->courseModuleService = $courseModuleService;
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

        $data['singular_name'] = 'Course Module';
        $data['pulular_name'] = 'Course Modules';
        $breadcrumb = [];
        $breadcrumb['Courses'] = route('admin.course.list');
        if ($course) {
            $breadcrumb[$course->name] = route('admin.course.edit', $course->id);
        } else {
            Session::flash('activeModal', 'selectCourseModal');
        }
        $breadcrumb['Course Modules'] = '';
        $data['breadcrumb'] = $breadcrumb;

        $data['course'] = $course;
        $data['data']   = CourseModule::where('course_id', '=', $course_id)->orderBy('sort_order', 'asc')->get();
        return view('backoffice.course-modules.list', $data);
    }

    public function create(CreateCourseModuleRequest $request)
    {
        try {

            $this->courseModuleService->store($request->all());

            return redirect()->back()->with('success', 'Course Module Created Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $course = CourseModule::findOrFail($id);
        $data['course'] = $course;
        $html = view('backoffice.course-modules.edit', $data)->render();
        return ['success' => 'true', 'html' => $html];
    }
    public function update(UpdateCourseModuleRequest $request, $id)
    {
        try {
            $courseModule = CourseModule::findOrFail($id);
            $this->courseModuleService->update($courseModule, $request->all());
            return redirect()->back()->with('success', 'Course Module Update Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function delete($id)
    {

        try {
            $course = CourseModule::findOrFail($id);
            $this->courseModuleService->delete($course);

            return redirect()->back()->with('success', 'Course Module Deleted Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function sort(Request $request)
    {
        try {
            $sorting = $request->get('sorting');
            foreach ($sorting as $id => $sort_order) {
                CourseModule::whereId($id)->update(['sort_order' => $sort_order]);
            }
            return ['success' => 'true', 'message' => 'Sorted'];
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
