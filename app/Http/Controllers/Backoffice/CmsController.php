<?php

namespace App\Http\Controllers\Backoffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Cms\CreateCmsRequest;
use App\Http\Requests\Admin\Cms\UpdateCmsRequest;
use App\Models\Cms;
use App\Services\CmsService;

class CmsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private CmsService $cmsService;

    public function __construct(CmsService $cmsService)
    {
        $this->cmsService = $cmsService;
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
        $data['singular_name'] = 'Cms Page';
        $data['pulular_name'] = 'Cms Pages';
        $breadcrumb = [];
        $breadcrumb['Cms Pages'] = route('admin.cms.list');
        $breadcrumb['All Cms Pages'] = '';
        $data['breadcrumb'] = $breadcrumb;

        $data['data'] = Cms::paginate(env('RECORD_PER_PAGE', 10));
        return view('backoffice.cms.list', $data);
    }
    public function add()
    {
        $data = [];
        $data['singular_name'] = 'Cms Page';
        $data['pulular_name'] = 'Cms Pages';
        $breadcrumb = [];
        $breadcrumb['Cms Pages'] = route('admin.cms.list');
        $breadcrumb['Add Cms Page'] = '';
        $data['breadcrumb'] = $breadcrumb;

        return view('backoffice.cms.add', $data);
    }
    public function create(CreateCmsRequest $request)
    {
        try {

            $this->cmsService->store($request->all());

            return redirect()->to(route('admin.cms.list'))->with('success', 'Cms Page Created Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $cms = Cms::findOrFail($id);

        $data = [];
        $data['singular_name'] = 'Cms Page ';
        $data['pulular_name'] = 'Cms Pages';
        $breadcrumb = [];
        $breadcrumb['Cms Pages'] = route('admin.cms.list');
        $breadcrumb[$cms->name] = '';
        $data['breadcrumb'] = $breadcrumb;
        $data['row'] = $cms;

        return view('backoffice.cms.edit', $data);
    }
    public function update(UpdateCmsRequest $request, $id)
    {
        try {
            $cms = Cms::findOrFail($id);
            $this->cmsService->update($cms, $request->validated());

            return redirect()->to(route('admin.cms.list'))->with('success', 'Cms Page Update Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            $cms = Cms::findOrFail($id);

            $this->cmsService->delete($cms);

            return redirect()->to(route('admin.cms.list'))->with('success', 'Cms Page Deleted Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function search(Request $request)
    {
        $cms = Cms::where('name', 'like', '%' . $request->q . '%')->limit(15)->get(['id', 'name as text']);
        return ['items' => $cms];
    }
}
