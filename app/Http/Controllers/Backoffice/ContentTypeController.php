<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\ContentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContentType\CreateContentTypeRequest;
use App\Services\ContentTypeService;
use Illuminate\Support\Str;
use Validator;

class ContentTypeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private ContentTypeService $contentTypeService;

    public function __construct(ContentTypeService $contentTypeService)
    {
        $this->contentTypeService = $contentTypeService;
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
        $data['singular_name'] = 'Content Type';
        $data['pulular_name'] = 'Content Types';
        $breadcrumb = [];
        $breadcrumb['Content Types'] = route('admin.content-type.list');
        $breadcrumb['All Content Types'] = '';
        $data['breadcrumb'] = $breadcrumb;

        $data['data'] = ContentType::paginate(env('RECORD_PER_PAGE', 10));
        return view('backoffice.content-types.list', $data);
    }
    public function add()
    {
        $data = [];
        $data['singular_name'] = 'Content Type';
        $data['pulular_name'] = 'Content Types';
        $breadcrumb = [];
        $breadcrumb['Add Content Type'] = '';
        $data['breadcrumb'] = $breadcrumb;

        return view('backoffice.content-types.add', $data);
    }
    public function create(CreateContentTypeRequest $request)
    {
        try {

            $this->contentTypeService->store($request->all());

            return redirect()->to(route('admin.content-type.list'))->with('success', 'Content Type Created Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $course = ContentType::findOrFail($id);

        $data = [];
        $data['singular_name'] = 'Content Type';
        $data['pulular_name'] = 'Content Types';
        $breadcrumb = [];
        $breadcrumb['Content Types'] = route('admin.content-type.list');
        $breadcrumb[$course->name] = '';
        $data['breadcrumb'] = $breadcrumb;
        $data['row'] = $course;

        return view('backoffice.content-types.edit', $data);
    }
    public function update(Request $request, $id)
    {
        try {
            $contentType = ContentType::findOrFail($id);
            $this->contentTypeService->update($contentType, $request->all());

            return redirect()->to(route('admin.content-type.list'))->with('success', 'Content Type Update Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function delete($id)
    {
        try {
            $contentType = ContentType::findOrFail($id);
            $this->contentTypeService->delete($contentType);

            return redirect()->to(route('admin.content-type.list'))->with('success', 'Content Type Deleted Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
