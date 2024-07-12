<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\Banner;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class BannerService.
 */
class BannerService extends BaseService
{
    /**
     * BannerService constructor.
     *
     * @param Banner $banner
     */
    public function __construct(Banner $banner)
    {
        $this->model = $banner;
    }

    /**
     * @param array $data
     *
     * @return Banner
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Banner
    {
        DB::beginTransaction();

        try {
            // Prepare button data
            $buttonData = null;
            if (isset($data['button']['text']) && isset($data['button']['url']) && isset($data['button']['target_blank'])) {
                $buttonData = [
                    'text' => $data['button']['text'],
                    'url' => $data['button']['url'],
                    'target_blank' => $data['button']['target_blank'],
                ];
            }
            $banner = Banner::create(['pre_title' => $data['pre_title'], 'title' => $data['title'], 'description' => $data['description'], 'button' => json_encode($buttonData)]);

            if (isset($data['image'])) {
                $banner->logo = $banner->uploadFile($data['image'], 'image');
            }
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException($e->getMessage());
        }

        DB::commit();

        return $banner;
    }

    /**
     * @param Banner $banner
     * @param array $data
     *
     * @return Banner
     * @throws \Throwable
     */
    public function update(Banner $banner, array $data = []): Banner
    {
        DB::beginTransaction();

        try {
            if (isset($data['button']['text']) && isset($data['button']['url']) && isset($data['button']['target_blank'])) {
                $data['button'] = [
                    'text' => $data['button']['text'],
                    'url' => $data['button']['url'],
                    'target_blank' => $data['button']['target_blank'],
                ];
            }
            if (isset($data['image'])) {
                $data['image'] = $banner->uploadFile($data['image'], 'image');
            }

            $banner->update($data);
        } catch (Exception $e) {
            DB::rollBack();
            throw new GeneralException(__('There was a problem updating this Banner. Please try again.'));
        }

        DB::commit();

        return $banner;
    }

    /**
     * @param Banner $banner
     *
     * @return Banner
     * @throws GeneralException
     */
    public function delete(Banner $banner): Banner
    {
        if ($this->deleteById($banner->id)) {
            return $banner;
        }

        throw new GeneralException('There was a problem deleting this Banner. Please try again.');
    }

    /**
     * @param Banner $banner
     *
     * @return Banner
     * @throws GeneralException
     */
    public function restore(Banner $banner): Banner
    {
        if ($banner->restore()) {

            return $banner;
        }

        throw new GeneralException(__('There was a problem restoring this Banner. Please try again.'));
    }

    /**
     * @param Banner $banner
     *
     * @return Banner
     * @throws GeneralException
     */
    public function destroy(Banner $banner): bool
    {

        if ($banner->forceDelete()) {

            return true;
        }

        throw new GeneralException('There was a problem permanently deleting this Banner. Please try again.');
    }
}
