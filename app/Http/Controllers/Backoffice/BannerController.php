<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Banner;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Banner\CreateBannerRequest;
use App\Http\Requests\Admin\Banner\UpdateBannerRequest;
use App\Services\BannerService;

class BannerController extends Controller
{
    private BannerService $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
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
        $data['singular_name'] = 'Banner';
        $data['pulular_name'] = 'Banners';
        $breadcrumb = [];
        $breadcrumb['Banners'] = route('admin.banner.list');
        $breadcrumb['All Banners'] = '';
        $data['breadcrumb'] = $breadcrumb;

        $data['data'] = Banner::latest()->paginate(env('RECORD_PER_PAGE', 10));
        return view('backoffice.banner.list', $data);
    }
    public function add()
    {
        $data = [];
        $data['singular_name'] = 'Banner';
        $data['pulular_name'] = 'Banners';
        $breadcrumb = [];
        $breadcrumb['Banners'] = route('admin.banner.list');
        $breadcrumb['Add Banner'] = '';
        $data['breadcrumb'] = $breadcrumb;

        return view('backoffice.banner.add', $data);
    }
    public function create(CreateBannerRequest $request)
    {
        try {
            $this->bannerService->store($request->validated());

            return redirect()->to(route('admin.banner.list'))->with('success', 'Banner Created Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);

        $data = [];
        $data['singular_name'] = 'Banner ';
        $data['pulular_name'] = 'Banners';
        $breadcrumb = [];
        $breadcrumb['Banners'] = route('admin.banner.list');
        $breadcrumb[$banner->title] = '';
        $data['breadcrumb'] = $breadcrumb;
        $data['row'] = $banner;

        return view('backoffice.banner.edit', $data);
    }
    public function update(UpdateBannerRequest $request, $id)
    {
        try {

            $banner = Banner::findOrFail($id);
            $this->bannerService->update($banner, $request->all());

            return redirect()->to(route('admin.banner.list'))->with('success', 'Banner Update Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function delete($id)
    {
        try {

            $banner = Banner::findOrFail($id);
            $this->bannerService->delete($banner);

            return redirect()->to(route('admin.banner.list'))->with('success', 'Banner Deleted Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
