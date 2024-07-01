<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConnectionController extends Controller
{
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
        $data['singular_name'] = 'Connection';
        $data['pulular_name'] = 'Connections';
        $breadcrumb = [];
        $breadcrumb['Connections'] = route('admin.connection.list');
        $breadcrumb['All Courses'] = '';
        $data['breadcrumb'] = $breadcrumb;

        $data['data'] = Connection::paginate(env('RECORD_PER_PAGE', 10));
        return view('backoffice.connection.list', $data);
    }
    public function add()
    {
        $data = [];
        $data['singular_name'] = 'Connection';
        $data['pulular_name'] = 'Connections';
        $breadcrumb = [];
        $breadcrumb['Connections'] = route('admin.connection.list');
        $breadcrumb['Add Course'] = '';
        $data['breadcrumb'] = $breadcrumb;

        return view('backoffice.connection.add', $data);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'logo' => 'required|image',
            'description' => 'required',
            'button.text' => 'required',
            'button.url' => 'required|url',
            'button.target_blank' => 'required|in:0,1',
            'categories.*.name' => 'required',
            'categories.*.icon' => 'required|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $data = [];
        $data['name'] = $request->get('name');
        $data['description'] = $request->get('description');
        $record = Connection::create($data);

        if ($request->hasFile('logo')) {
            $uploadingPath = public_path('/uploads/connections/' . $record->id);
            if (!is_dir($uploadingPath)) {
                mkdir($uploadingPath, 0777, true);
            }
            $file = $request->file('logo');
            $fileExtension = $file->getClientOriginalExtension();
            $image_name = 'logo' . time() . '.' . $fileExtension;
            $imageUpload = $file->move($uploadingPath, $image_name);
            $record->logo = $image_name;
        }

        // Prepare button data
        $buttonData = [
            'text' => $request->input('button.text'),
            'url' => $request->input('button.url'),
            'target_blank' => $request->input('button.target_blank'),
        ];

        // Prepare category data
        $categoryData = [];
        foreach ($request->categories as $index => $category) {
            // Create directory for categories if it doesn't exist
            $categoryPath = public_path('/uploads/connections/' . $record->id . '/categories');
            if (!is_dir($categoryPath)) {
                mkdir($categoryPath, 0777, true);
            }
            // Handle category icon upload
            $iconFile = $category['icon'];
            $iconExtension = $iconFile->getClientOriginalExtension();
            $iconName = $index.'_icon_' . time() . '.' . $iconExtension;
            $iconFile->move($categoryPath, $iconName);

            $categoryData[] = [
                'name' => $category['name'],
                'icon' => $iconName,
            ];
        }
        $record->button = $buttonData;
        $record->categories = $categoryData;
        $record->save();


        return redirect()->to(route('admin.connection.list'))->with('success', 'Course Created Successfully.');
    }

    public function edit($id)
    {
        $course = Connection::findOrFail($id);

        $data = [];
        $data['singular_name'] = 'Course ';
        $data['pulular_name'] = 'Connections';
        $breadcrumb = [];
        $breadcrumb['Connections'] = route('admin.connection.list');
        $breadcrumb[$course->name] = '';
        $data['breadcrumb'] = $breadcrumb;
        $data['row'] = $course;

        return view('backoffice.connection.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $record = Connection::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $record->name = $request->get('name');
        //$record->slug = $this->slugify($request->get('name'), $id);
        $record->description = $request->get('description');
        $record->start_date = $request->get('start_date');
        $record->end_date = $request->has('end_date') ? $request->get('end_date') : null;
        $record->status = $request->get('status');
        $record->price = $request->get('price');
        $record->level = $request->get('level');

        if ($request->hasFile('logo')) {
            $uploadingPath = public_path('/uploads/connections/' . $record->id);
            if (!is_dir($uploadingPath)) {
                mkdir($uploadingPath, 0777);
            }
            if (!empty($record->logo)) {
                unlink($uploadingPath . '/' . $record->logo);
            }
            $file = $request->file('logo');
            $fileExtension = $file->getClientOriginalExtension();
            $image_name = 'logo' . time() . '.' . $fileExtension;
            $imageUpload = $file->move($uploadingPath, $image_name);
            $record->logo = $image_name;
        }

        $record->save();
        return redirect()->to(route('admin.connection.list'))->with('success', 'Course Update Successfully.');
    }
    function delete($id)
    {
        Connection::whereId($id)->delete();
        return redirect()->to(route('admin.connection.list'))->with('success', 'Course Deleted Successfully.');
    }
    function search(Request $request)
    {
        $courses = Connection::where('name', 'like', '%' . $request->q . '%')->active();
        if ($request->has('with') && $request->get('with') == 'modules') {
            $courses = $courses->with('modules');
        }
        $courses = $courses->limit(15)->get();
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
