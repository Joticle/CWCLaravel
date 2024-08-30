<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseSyllabus\CreateCourseSyllabusRequest;
use App\Http\Requests\Admin\CourseSyllabus\UpdateCourseSyllabusRequest;
use App\Models\CourseRequirement;
use App\Models\CourseSyllabus;
use App\Services\CourseSyllabusService;
use App\Services\CourseService;

class CourseSyllabusController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private CourseSyllabusService $courseSyllabusService;

    public function __construct(CourseSyllabusService $courseSyllabusService)
    {
        $this->courseSyllabusService = $courseSyllabusService;
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

        $data['singular_name'] = 'Course Syllabus';
        $data['pulular_name'] = 'Course Syllabuses';
        $breadcrumb = [];
        $breadcrumb['Courses'] = route('admin.course.list');
        if ($course) {
            $breadcrumb[$course->name] = route('admin.course.edit', $course->id);
        } else {
            Session::flash('activeModal', 'selectCourseModal');
        }
        $breadcrumb['Course Syllabuses'] = '';
        $data['breadcrumb'] = $breadcrumb;

        $data['course'] = $course;
        $data['data']   = CourseSyllabus::where('course_id', $course_id)->orderBy('sort_order', 'asc')->get();
        $data['prepopulatedCourses'] = [];
        if($course_id == 0) {
            $data['prepopulatedCourses'] = (new CourseController(new CourseService(new Course())))->search(new Request(), 5)['items'];
        }
        return view('backoffice.course-syllabus.list', $data);
    }

    public function create(CreateCourseSyllabusRequest $request)
    {
        try {

            $this->courseSyllabusService->store($request->all());

            return redirect()->back()->with('success', 'Course Syllabus Created Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $courseSyllabus = CourseSyllabus::findOrFail($id);
        $data['row'] = $courseSyllabus;
        $html = view('backoffice.course-syllabus.edit', $data)->render();
        return ['success' => 'true', 'html' => $html];
    }
    public function update(UpdateCourseSyllabusRequest $request, $id)
    {
        try {
            $courseSyllabus = CourseSyllabus::findOrFail($id);
            $this->courseSyllabusService->update($courseSyllabus, $request->all());
            return redirect()->back()->with('success', 'Course Syllabus Update Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function delete($id)
    {

        try {
            $courseSyllabus = CourseSyllabus::findOrFail($id);
            $this->courseSyllabusService->delete($courseSyllabus);

            return redirect()->back()->with('success', 'Course Syllabus Deleted Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function sort(Request $request)
    {
        try {
            $sorting = $request->get('sorting');
            foreach ($sorting as $id => $sort_order) {
                CourseSyllabus::whereId($id)->update(['sort_order' => $sort_order]);
            }
            return ['success' => 'true', 'message' => 'Sorted'];
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function download($id)
    {
        $courseSyllabus = CourseSyllabus::findOrFail($id);

        return response()->download($courseSyllabus->getFileContentPath());
    }
}
