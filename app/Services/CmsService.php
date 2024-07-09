<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\Cms;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class CmsService.
 */
class CmsService extends BaseService
{
    /**
     * CmsService constructor.
     *
     * @param Cms $cms
     */
    public function __construct(Cms $cms)
    {
        $this->model = $cms;
    }

    /**
     * @param array $data
     *
     * @return Cms
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Cms
    {
        DB::beginTransaction();

        try {

            $cms = Cms::create($data);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException($e->getMessage());
        }

        DB::commit();

        return $cms;
    }

    /**
     * @param Cms $cms
     * @param array $data
     *
     * @return Cms
     * @throws \Throwable
     */
    public function update(Cms $cms, array $data = []): Cms
    {
        DB::beginTransaction();

        try {

            $cms->update($data);
        } catch (Exception $e) {

            DB::rollBack();
            throw new GeneralException(__('There was a problem updating this Cms. Please try again.'));
        }

        DB::commit();

        return $cms;
    }

    /**
     * @param Cms $cms
     *
     * @return Cms
     * @throws GeneralException
     */
    public function delete(Cms $cms): Cms
    {
        if ($this->deleteById($cms->id)) {
            return $cms;
        }

        throw new GeneralException('There was a problem deleting this Cms. Please try again.');
    }

    /**
     * @param Cms $cms
     *
     * @return Cms
     * @throws GeneralException
     */
    public function restore(Cms $cms): Cms
    {
        if ($cms->restore()) {

            return $cms;
        }

        throw new GeneralException(__('There was a problem restoring this Cms. Please try again.'));
    }

    /**
     * @param Cms $cms
     *
     * @return Cms
     * @throws GeneralException
     */
    public function destroy(Cms $cms): bool
    {

        if ($cms->forceDelete()) {

            return true;
        }

        throw new GeneralException('There was a problem permanently deleting this Cms. Please try again.');
    }
}
