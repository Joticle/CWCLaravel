<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\Course;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class CourseService.
 */
class CourseService extends BaseService
{
    /**
     * CourseService constructor.
     *
     * @param Course $course
     */
    public function __construct(Course $course)
    {
        $this->model = $course;
    }

    /**
     * @param array $data
     *
     * @return Course
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Course
    {
        DB::beginTransaction();

        try {

            $course = Course::create($data);

            if (isset($data['logo'])) {
                $course->logo = $course->uploadFile($data['logo'], 'logo');
                $course->save();
            }
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException($e->getMessage());
        }

        DB::commit();

        return $course;
    }

    /**
     * @param Course $course
     * @param array $data
     *
     * @return Course
     * @throws \Throwable
     */
    public function update(Course $course, array $data = []): Course
    {
        DB::beginTransaction();

        try {

            if (isset($data['logo'])) {
                $data['logo'] = $course->uploadFile($data['logo'], 'logo');
            }
            $course->update($data);
        } catch (Exception $e) {

            DB::rollBack();
            throw new GeneralException(__('There was a problem updating this Course. Please try again.'));
        }

        DB::commit();

        return $course;
    }

    /**
     * @param Course $course
     *
     * @return Course
     * @throws GeneralException
     */
    public function delete(Course $course): Course
    {
        if ($this->deleteById($course->id)) {
            return $course;
        }

        throw new GeneralException('There was a problem deleting this Course. Please try again.');
    }

    /**
     * @param Course $course
     *
     * @return Course
     * @throws GeneralException
     */
    public function restore(Course $course): Course
    {
        if ($course->restore()) {

            return $course;
        }

        throw new GeneralException(__('There was a problem restoring this Course. Please try again.'));
    }

    /**
     * @param Course $course
     *
     * @return Course
     * @throws GeneralException
     */
    public function destroy(Course $course): bool
    {

        if ($course->forceDelete()) {

            return true;
        }

        throw new GeneralException('There was a problem permanently deleting this Course. Please try again.');
    }
}
