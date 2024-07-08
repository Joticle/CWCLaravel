<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\Course;
use App\Models\CourseModule;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class CourseModuleService.
 */
class CourseModuleService extends BaseService
{
    /**
     * CourseModuleService constructor.
     *
     * @param Course $course_module
     */
    public function __construct(CourseModule $course_module)
    {
        $this->model = $course_module;
    }

    /**
     * @param array $data
     *
     * @return CourseModule
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): CourseModule
    {
        DB::beginTransaction();

        try {

            $course_module = CourseModule::create($data);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException($e->getMessage());
        }

        DB::commit();

        return $course_module;
    }

    /**
     * @param CourseModule $course_module
     * @param array $data
     *
     * @return Course
     * @throws \Throwable
     */
    public function update(Course $course_module, array $data = []): CourseModule
    {
        DB::beginTransaction();

        try {

            $course_module->update($data);
        } catch (Exception $e) {

            DB::rollBack();
            throw new GeneralException(__('There was a problem updating this Course Module. Please try again.'));
        }

        DB::commit();

        return $course_module;
    }

    /**
     * @param CourseModule $course_module
     *
     * @return CourseModule
     * @throws GeneralException
     */
    public function delete(Course $course_module): CourseModule
    {
        if ($this->deleteById($course_module->id)) {
            return $course_module;
        }

        throw new GeneralException('There was a problem deleting this Course Module. Please try again.');
    }

    /**
     * @param CourseModule $course_module
     *
     * @return CourseModule
     * @throws GeneralException
     */
    public function restore(CourseModule $course_module): CourseModule
    {
        if ($course_module->restore()) {

            return $course_module;
        }

        throw new GeneralException(__('There was a problem restoring this Course Module. Please try again.'));
    }

    /**
     * @param CourseModule $course_module
     *
     * @return CourseModule
     * @throws GeneralException
     */
    public function destroy(CourseModule $course_module): bool
    {

        if ($course_module->forceDelete()) {

            return true;
        }

        throw new GeneralException('There was a problem permanently deleting this Course Module. Please try again.');
    }
}
