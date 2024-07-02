<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Connection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $breadcrumb['All Connections'] = '';
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
        $breadcrumb['Add Connection'] = '';
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
            $iconName = $index . '_icon_' . time() . '.' . $iconExtension;
            $iconFile->move($categoryPath, $iconName);

            $categoryData[] = [
                'name' => $category['name'],
                'icon' => $iconName,
            ];
        }
        $record->button = $buttonData;
        $record->categories = $categoryData;
        $record->save();


        return redirect()->to(route('admin.connection.list'))->with('success', 'Connection Created Successfully.');
    }

    public function edit($id)
    {
        $connection = Connection::findOrFail($id);

        $data = [];
        $data['singular_name'] = 'Course ';
        $data['pulular_name'] = 'Connections';
        $breadcrumb = [];
        $breadcrumb['Connections'] = route('admin.connection.list');
        $breadcrumb[$connection->name] = '';
        $data['breadcrumb'] = $breadcrumb;
        $data['row'] = $connection;

        return view('backoffice.connection.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $record = Connection::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'logo' => 'sometimes|image|max:2048',
            'description' => 'required',
            'status' => 'required|in:0,1',
            'button.text' => 'required',
            'button.url' => 'required|url',
            'button.target_blank' => 'required|in:0,1',
            'categories.*.name' => 'required',
            'categories.*.icon' => 'sometimes|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $record->name = $request->get('name');
        $record->description = $request->get('description');
        $record->status = $request->get('status');

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

        // Prepare button data
        $buttonData = [
            'text' => $request->input('button.text'),
            'url' => $request->input('button.url'),
            'target_blank' => $request->input('button.target_blank'),
        ];

        // Prepare category data
        $categoryData = [];

        foreach ($request->categories as $index => $category) {
            $categoryPath = public_path('/uploads/connections/' . $record->id . '/categories');
            if (!is_dir($categoryPath)) {
                mkdir($categoryPath, 0777, true);
            }

            $categories = $record->categories;

            $iconName = $categories[$index]->icon ?? null;
            if (isset($category['icon']) && $category['icon']->isValid()) {
                // Remove old icon if exists
                if ($iconName && file_exists($categoryPath . '/' . $iconName)) {
                    unlink($categoryPath . '/' . $iconName);
                }
                $iconFile = $category['icon'];
                $iconExtension = $iconFile->getClientOriginalExtension();
                $iconName = $index . '_icon_' . time() . '.' . $iconExtension;
                $iconFile->move($categoryPath, $iconName);
            }

            $categoryData[] = [
                'name' => $category['name'],
                'icon' => $iconName,
            ];
        }

        $record->button = $buttonData;
        $record->categories = $categoryData;
        $record->save();

        return redirect()->to(route('admin.connection.list'))->with('success', 'Connection Update Successfully.');
    }
    function delete($id)
    {
        Connection::whereId($id)->delete();
        return redirect()->to(route('admin.connection.list'))->with('success', 'Connection Deleted Successfully.');
    }
    function search(Request $request)
    {
        // $connections = Connection::where('name', 'like', '%' . $request->q . '%')->active();
        // if ($request->has('with') && $request->get('with') == 'modules') {
        //     $connections = $connections->with('modules');
        // }
        // $connections = $connections->limit(15)->get();
        // $data = [];
        // foreach ($connections as $connection) {
        //     $row = [];
        //     $row['id'] = $connection->id;
        //     $row['text'] = $connection->name;
        //     $row['logo'] = $connection->getLogo();
        //     $row['description'] = Str::words(strip_tags($connection->description), 5, '...');
        //     $row['start_date'] = _date($connection->start_date);
        //     $row['end_date'] = !empty($connection->end_date) ? _date($connection->end_date) : '--';
        //     if ($request->has('with') && $request->get('with') == 'modules') {
        //         $row['children'] = $connection->modules;
        //     }
        //     $data[] = $row;
        // }
        // return ['items' => $data];
    }
}
