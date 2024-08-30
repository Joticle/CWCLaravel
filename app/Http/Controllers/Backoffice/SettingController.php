<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\CreateSettingRequest;
use App\Http\Requests\Admin\Setting\UpdateSocialProfilesRequest;
use App\Models\Setting;
use App\Services\SettingService;

class SettingController extends Controller
{

    private $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }
    public function setting()
    {

        $data = [];
        $data['singular_name'] = 'Setting';
        $data['pulular_name'] = 'Setting';
        $breadcrumb = [];
        $breadcrumb['Dashboard'] = route('admin.index');

        $data['breadcrumb'] = $breadcrumb;

        $setting = Setting::first();
        $data['setting']  = $setting;

        return view('backoffice.setting.index', $data);
    }

    public function storeSetting(CreateSettingRequest $request)
    {
        try {

            $setting = Setting::first();
            if($setting) {
                $this->settingService->update($setting, $request->validated());
            }
            else {
                $this->settingService->store($request->validated());
            }

            return redirect()->back()->with('success', 'Setting updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function storeSocialProfiles(UpdateSocialProfilesRequest $request)
    {
        try {

            $setting = Setting::first();

            $this->settingService->update($setting, $request->validated());

            return redirect()->back()->with('success', 'Social profiles updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
