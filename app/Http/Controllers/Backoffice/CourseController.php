<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Course\CreateCourseRequest;
use App\Http\Requests\Admin\Course\UpdateCourseRequest;
use App\Models\CourseSyllabus;
use App\Models\Tag;
use App\Services\CourseService;
use App\Services\CourseSyllabusService;
use Illuminate\Support\Str;
use Validator;

class CourseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private CourseService $courseService;
    private CourseSyllabusService $courseSyllabusService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
        $this->courseSyllabusService = new CourseSyllabusService(new CourseSyllabus());
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

        $data['data'] = Course::paginate(env('RECORD_PER_PAGE', 10));
        return view('backoffice.courses.list', $data);
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
        $data['levels'] = Course::LEVELS;
        $data['tags'] = Tag::all();

        return view('backoffice.courses.add', $data);
    }
    public function create(CreateCourseRequest $request)
    {

        try {

            $course = $this->courseService->store($request->all());
            if(!empty($request->syllabuses)) {
                $request->merge(['course_id' => $course->id]);
                $this->courseSyllabusService->store($request->only('syllabuses', 'course_id'));
            }

            return redirect()->to(route('admin.course.list'))->with('success', 'Course Created Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);

        $data = [];
        $data['singular_name'] = 'Course ';
        $data['pulular_name'] = 'Courses';
        $breadcrumb = [];
        $breadcrumb['Courses'] = route('admin.course.list');
        $breadcrumb[$course->name] = '';
        $data['breadcrumb'] = $breadcrumb;
        $data['row'] = $course;
        $data['levels'] = Course::LEVELS;
        $data['tags'] = Tag::all();

        return view('backoffice.courses.edit', $data);
    }
    public function update(UpdateCourseRequest $request, $id)
    {
        try {

            $course = Course::findOrFail($id);
            $this->courseService->update($course, $request->all());

            return redirect()->to(route('admin.course.list'))->with('success', 'Course Update Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            $course = Course::findOrFail($id);
            $this->courseService->delete($course);

            return redirect()->to(route('admin.course.list'))->with('success', 'Course Deleted Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function search(Request $request)
    {

        $limit = $request->q == '' ? 5 : 15;

        $courses = Course::where('name', 'like', '%' . $request->q . '%')->active();
        if ($request->has('with') && $request->get('with') == 'modules') {
            $courses = $courses->with('modules');
        }
        $courses = $courses->limit($limit)->get();
        $data = [];
        foreach ($courses as $course) {
            $row = [];
            $row['id'] = $course->id;
            $row['text'] = $course->name;
            $row['logo'] = $course->getLogo();
            $row['description'] = Str::words(strip_tags($course->description), 5, '...');
            $row['start_date'] = _date($course->start_date);
            $row['end_date'] = !empty($course->end_date) ? _date($course->end_date) : '--';
            if ($request->has('with') && $request->get('with') == 'modules') {
                $row['children'] = $course->modules;
            }
            $data[] = $row;
        }
        return ['items' => $data];
    }
}
