<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\ContentType;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class ContentTypeService.
 */
class ContentTypeService extends BaseService
{
    /**
     * ContentTypeService constructor.
     *
     * @param ContentType $ContentType
     */
    public function __construct(ContentType $ContentType)
    {
        $this->model = $ContentType;
    }

    /**
     * @param array $data
     *
     * @return ContentType
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): ContentType
    {
        DB::beginTransaction();

        try {

            $ContentType = ContentType::create($data);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException($e->getMessage());
        }

        DB::commit();

        return $ContentType;
    }

    /**
     * @param ContentType $ContentType
     * @param array $data
     *
     * @return ContentType
     * @throws \Throwable
     */
    public function update(ContentType $ContentType, array $data = []): ContentType
    {
        DB::beginTransaction();

        try {

            $ContentType->update($data);
        } catch (Exception $e) {

            DB::rollBack();
            throw new GeneralException(__('There was a problem updating this Content Type. Please try again.'));
        }

        DB::commit();

        return $ContentType;
    }

    /**
     * @param ContentType $ContentType
     *
     * @return ContentType
     * @throws GeneralException
     */
    public function delete(ContentType $ContentType): ContentType
    {
        if ($this->deleteById($ContentType->id)) {
            return $ContentType;
        }

        throw new GeneralException('There was a problem deleting this Content Type. Please try again.');
    }

    /**
     * @param ContentType $ContentType
     *
     * @return ContentType
     * @throws GeneralException
     */
    public function restore(ContentType $ContentType): ContentType
    {
        if ($ContentType->restore()) {

            return $ContentType;
        }

        throw new GeneralException(__('There was a problem restoring this Content Type. Please try again.'));
    }

    /**
     * @param ContentType $ContentType
     *
     * @return ContentType
     * @throws GeneralException
     */
    public function destroy(ContentType $ContentType): bool
    {

        if ($ContentType->forceDelete()) {

            return true;
        }

        throw new GeneralException('There was a problem permanently deleting this Content Type. Please try again.');
    }
}
