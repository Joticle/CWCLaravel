<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Connection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Connection\CreateConnectionRequest;
use App\Http\Requests\Admin\Connection\UpdateConnectionRequest;
use App\Services\ConnectionService;
use Illuminate\Support\Facades\Validator;

class ConnectionController extends Controller
{
    private ConnectionService $connectionService;

    public function __construct(ConnectionService $connectionService)
    {
        $this->connectionService = $connectionService;
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
    public function create(CreateConnectionRequest $request)
    {
        try {
            $this->connectionService->store($request->all());

            return redirect()->to(route('admin.connection.list'))->with('success', 'Connection Created Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
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
    public function update(UpdateConnectionRequest $request, $id)
    {
        try {

            $connection = Connection::findOrFail($id);
            $this->connectionService->update($connection, $request->all());

            return redirect()->to(route('admin.connection.list'))->with('success', 'Connection Update Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function delete($id)
    {
        try {

            $connection = Connection::findOrFail($id);
            $this->connectionService->delete($connection);

            return redirect()->to(route('admin.connection.list'))->with('success', 'Connection Deleted Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
