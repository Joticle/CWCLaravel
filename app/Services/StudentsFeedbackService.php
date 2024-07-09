<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\StudentsFeedback;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class StudentsFeedbackService.
 */
class StudentsFeedbackService extends BaseService
{
    /**
     * StudentsFeedbackService constructor.
     *
     * @param StudentsFeedback $studentsFeedback
     */
    public function __construct(StudentsFeedback $studentsFeedback)
    {
        $this->model = $studentsFeedback;
    }

    /**
     * @param array $data
     *
     * @return StudentsFeedback
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): StudentsFeedback
    {
        DB::beginTransaction();

        try {

            $studentsFeedback = StudentsFeedback::create($data);

            if (isset($data['image'])) {
                $studentsFeedback->image = $studentsFeedback->uploadFile($data['image'], 'image');
                $studentsFeedback->save();
            }
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException($e->getMessage());
        }

        DB::commit();

        return $studentsFeedback;
    }

    /**
     * @param StudentsFeedback $studentsFeedback
     * @param array $data
     *
     * @return StudentsFeedback
     * @throws \Throwable
     */
    public function update(StudentsFeedback $studentsFeedback, array $data = []): StudentsFeedback
    {
        DB::beginTransaction();

        try {

            if (isset($data['image'])) {
                $data['image'] = $studentsFeedback->uploadFile($data['image'], 'image');
            }
            $studentsFeedback->update($data);
        } catch (Exception $e) {

            DB::rollBack();
            throw new GeneralException(__('There was a problem updating this StudentsFeedback. Please try again.'));
        }

        DB::commit();

        return $studentsFeedback;
    }

    /**
     * @param StudentsFeedback $studentsFeedback
     *
     * @return StudentsFeedback
     * @throws GeneralException
     */
    public function delete(StudentsFeedback $studentsFeedback): StudentsFeedback
    {
        if ($this->deleteById($studentsFeedback->id)) {
            return $studentsFeedback;
        }

        throw new GeneralException('There was a problem deleting this StudentsFeedback. Please try again.');
    }

    /**
     * @param StudentsFeedback $studentsFeedback
     *
     * @return StudentsFeedback
     * @throws GeneralException
     */
    public function restore(StudentsFeedback $studentsFeedback): StudentsFeedback
    {
        if ($studentsFeedback->restore()) {

            return $studentsFeedback;
        }

        throw new GeneralException(__('There was a problem restoring this StudentsFeedback. Please try again.'));
    }

    /**
     * @param StudentsFeedback $studentsFeedback
     *
     * @return StudentsFeedback
     * @throws GeneralException
     */
    public function destroy(StudentsFeedback $studentsFeedback): bool
    {

        if ($studentsFeedback->forceDelete()) {

            return true;
        }

        throw new GeneralException('There was a problem permanently deleting this StudentsFeedback. Please try again.');
    }
}
