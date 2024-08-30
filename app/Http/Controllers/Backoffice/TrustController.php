<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Trust;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Trust\CreateTrustRequest;
use App\Http\Requests\Admin\Trust\UpdateTrustRequest;
use App\Services\TrustService;

class TrustController extends Controller
{
    private TrustService $trustService;

    public function __construct(TrustService $trustService)
    {
        $this->trustService = $trustService;
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
        $data['singular_name'] = 'Trust';
        $data['pulular_name'] = 'Trusties';
        $breadcrumb = [];
        $breadcrumb['Trusties'] = route('admin.trust.list');
        $breadcrumb['All Trusties'] = '';
        $data['breadcrumb'] = $breadcrumb;

        $data['data'] = Trust::paginate(env('RECORD_PER_PAGE', 10));
        return view('backoffice.trust.list', $data);
    }
    public function add()
    {
        $data = [];
        $data['singular_name'] = 'Trust';
        $data['pulular_name'] = 'Trusties';
        $breadcrumb = [];
        $breadcrumb['Trusties'] = route('admin.trust.list');
        $breadcrumb['All Trusties'] = '';
        $data['breadcrumb'] = $breadcrumb;

        return view('backoffice.trust.add', $data);
    }
    public function create(CreateTrustRequest $request)
    {
        try {
            $this->trustService->store($request->validated());

            return redirect()->to(route('admin.trust.list'))->with('success', 'Trust Created Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $connection = Trust::findOrFail($id);

        $data = [];
        $data['singular_name'] = 'Trust';
        $data['pulular_name'] = 'Trusties';
        $breadcrumb = [];
        $breadcrumb['Trusties'] = route('admin.trust.list');
        $breadcrumb[$connection->name] = '';
        $data['breadcrumb'] = $breadcrumb;
        $data['row'] = $connection;

        return view('backoffice.trust.edit', $data);
    }
    public function update(UpdateTrustRequest $request, $id)
    {
        try {

            $connection = Trust::findOrFail($id);
            $this->trustService->update($connection, $request->all());

            return redirect()->to(route('admin.trust.list'))->with('success', 'Trust Update Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function delete($id)
    {
        try {

            $connection = Trust::findOrFail($id);
            $this->trustService->delete($connection);

            return redirect()->to(route('admin.trust.list'))->with('success', 'Trust Deleted Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
