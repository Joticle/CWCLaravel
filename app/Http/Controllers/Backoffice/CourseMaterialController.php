<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\ContentType;
use App\Models\CourseModuleContent;
use App\Models\CourseModule;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseModuleContent\CreateCourseModuleContentRequest;
use App\Services\CourseModuleContentService;
use Illuminate\Support\Str;
use Validator;

class CourseMaterialController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private CourseModuleContentService $courseModuleContentService;

    public function __construct(CourseModuleContentService $courseModuleContentService)
    {
        $this->courseModuleContentService = $courseModuleContentService;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($module_id = 0)
    {

        $data = [];
        $course_id = 0;
        $courseModule = [];
        if ($module_id) {
            $courseModule = CourseModule::whereId($module_id)->first();
            $course_id = $courseModule->course_id;
        }
        $course = Course::whereId($course_id)->first();

        $data['singular_name'] = 'Course Content';
        $data['pulular_name'] = 'Course Contents';
        $breadcrumb = [];
        $breadcrumb['Courses'] = route('admin.course.list');
        if ($course && $module_id) {
            $breadcrumb[$course->name] = route('admin.course.edit', $course->id);
            $breadcrumb[$courseModule->name] = route('admin.course.module.list', $course->id);
        } else {
            Session::flash('activeModal', 'selectCourseModuleModal');
        }
        $breadcrumb['Course Module Content'] = '';
        $data['breadcrumb'] = $breadcrumb;

        $data['course'] = $course;
        $data['courseModule'] = $courseModule;

        $data['data']   = CourseModuleContent::where('course_id', '=', $course_id)->where('course_module_id', '=', $module_id)->orderBy('sort_order', 'asc')->get();
        $content_types = ContentType::where('status', '=', '1')->get()->toArray();
        $data['content_types'] = array_column($content_types, null, 'id');
        return view('backoffice.course-material.list', $data);
    }

    public function create(CreateCourseModuleContentRequest $request)
    {
        try {

            $this->courseModuleContentService->store($request->all());
            return redirect()->back()->with('success', 'Course Module Content Created Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            $courseModuleContent = CourseModuleContent::findOrFail($id);
            $this->courseModuleContentService->delete($courseModuleContent);

            return redirect()->back()->with('success', 'Course Module Content Deleted Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function sort(Request $request)
    {
        try {
            $sorting = $request->get('sorting');
            foreach ($sorting as $id => $sort_order) {
                CourseModuleContent::whereId($id)->update(['sort_order' => $sort_order]);
            }
            return ['success' => 'true', 'message' => 'Sorted'];
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
