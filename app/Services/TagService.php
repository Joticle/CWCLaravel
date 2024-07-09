<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\Tag;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class TagService.
 */
class TagService extends BaseService
{
    /**
     * TagService constructor.
     *
     * @param Tag $tag
     */
    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

    /**
     * @param array $data
     *
     * @return Tag
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Tag
    {
        DB::beginTransaction();

        try {

            $tag = Tag::create($data);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException($e->getMessage());
        }

        DB::commit();

        return $tag;
    }

    /**
     * @param Tag $tag
     * @param array $data
     *
     * @return Tag
     * @throws \Throwable
     */
    public function update(Tag $tag, array $data = []): Tag
    {
        DB::beginTransaction();

        try {

            $tag->update($data);
        } catch (Exception $e) {

            DB::rollBack();
            throw new GeneralException(__('There was a problem updating this Tag. Please try again.'));
        }

        DB::commit();

        return $tag;
    }

    /**
     * @param Tag $tag
     *
     * @return Tag
     * @throws GeneralException
     */
    public function delete(Tag $tag): Tag
    {
        if ($this->deleteById($tag->id)) {
            return $tag;
        }

        throw new GeneralException('There was a problem deleting this Tag. Please try again.');
    }

    /**
     * @param Tag $tag
     *
     * @return Tag
     * @throws GeneralException
     */
    public function restore(Tag $tag): Tag
    {
        if ($tag->restore()) {

            return $tag;
        }

        throw new GeneralException(__('There was a problem restoring this Tag. Please try again.'));
    }

    /**
     * @param Tag $tag
     *
     * @return Tag
     * @throws GeneralException
     */
    public function destroy(Tag $tag): bool
    {

        if ($tag->forceDelete()) {

            return true;
        }

        throw new GeneralException('There was a problem permanently deleting this Tag. Please try again.');
    }
}
