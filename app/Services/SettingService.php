<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\Setting;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class SettingService.
 */
class SettingService extends BaseService
{
    /**
     * SettingService constructor.
     *
     * @param Setting $setting
     */
    public function __construct(Setting $setting)
    {
        $this->model = $setting;
    }

    /**
     * @param array $data
     *
     * @return Setting
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Setting
    {
        DB::beginTransaction();

        try {
            $setting = Setting::create($data);

            if (isset($data['favicon'])) {
                $setting->favicon = $setting->uploadFile($data['favicon'], 'favicon');
            }
            if (isset($data['logo'])) {
                $setting->logo = $setting->uploadFile($data['logo'], 'logo');
            }
            if (isset($data['owner_image'])) {
                $setting->owner_image = $setting->uploadFile($data['owner_image'], 'owner_image');
            }
            $setting->save();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException($e->getMessage());
        }

        DB::commit();

        return new Setting();
    }

    /**
     * @param Setting $setting
     * @param array $data
     *
     * @return Setting
     * @throws \Throwable
     */
    public function update(Setting $setting, array $data = []): Setting
    {
        DB::beginTransaction();

        try {

            if (isset($data['favicon'])) {
                $data['favicon'] = $setting->uploadFile($data['favicon'], 'favicon');
            }
            if (isset($data['logo'])) {
                $data['logo'] = $setting->uploadFile($data['logo'], 'logo');
            }
            if (isset($data['owner_image'])) {
                $data['owner_image'] = $setting->uploadFile($data['owner_image'], 'owner_image');
            }

            $setting->update($data);
        } catch (Exception $e) {
            DB::rollBack();
            throw new GeneralException(__('There was a problem updating this Setting. Please try again.'));
        }

        DB::commit();

        return $setting;
    }

    /**
     * @param Setting $setting
     *
     * @return Setting
     * @throws GeneralException
     */
    public function delete(Setting $setting): Setting
    {
        if (!$this->hasSoftDelete($setting)) {
            $setting->removeSyllabus();
        }
        if ($this->deleteById($setting->id)) {
            return $setting;
        }

        throw new GeneralException('There was a problem deleting this Setting. Please try again.');
    }

    /**
     * @param Setting $setting
     *
     * @return Setting
     * @throws GeneralException
     */
    public function restore(Setting $setting): Setting
    {
        if ($setting->restore()) {

            return $setting;
        }

        throw new GeneralException(__('There was a problem restoring this Setting. Please try again.'));
    }

    /**
     * @param Setting $setting
     *
     * @return Setting
     * @throws GeneralException
     */
    public function destroy(Setting $setting): bool
    {

        if ($setting->forceDelete()) {

            return true;
        }

        throw new GeneralException('There was a problem permanently deleting this Setting. Please try again.');
    }
}
