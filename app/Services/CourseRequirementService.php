<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\CourseRequirement;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class CourseRequirementService.
 */
class CourseRequirementService extends BaseService
{
    /**
     * CourseRequirementService constructor.
     *
     * @param CourseRequirement $course_requirement
     */
    public function __construct(CourseRequirement $course_requirement)
    {
        $this->model = $course_requirement;
    }

    /**
     * @param array $data
     *
     * @return CourseRequirement
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): CourseRequirement
    {
        DB::beginTransaction();

        try {

            $course_requirement = CourseRequirement::create($data);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException($e->getMessage());
        }

        DB::commit();

        return $course_requirement;
    }

    /**
     * @param CourseRequirement $course_requirement
     * @param array $data
     *
     * @return CourseRequirement
     * @throws \Throwable
     */
    public function update(CourseRequirement $course_requirement, array $data = []): CourseRequirement
    {
        DB::beginTransaction();

        try {

            $course_requirement->update($data);
        } catch (Exception $e) {

            DB::rollBack();
            throw new GeneralException(__('There was a problem updating this Course Requirement. Please try again.'));
        }

        DB::commit();

        return $course_requirement;
    }

    /**
     * @param CourseRequirement $course_requirement
     *
     * @return CourseRequirement
     * @throws GeneralException
     */
    public function delete(CourseRequirement $course_requirement): CourseRequirement
    {
        if ($this->deleteById($course_requirement->id)) {
            return $course_requirement;
        }

        throw new GeneralException('There was a problem deleting this Course Requirement. Please try again.');
    }

    /**
     * @param CourseRequirement $course_requirement
     *
     * @return CourseRequirement
     * @throws GeneralException
     */
    public function restore(CourseRequirement $course_requirement): CourseRequirement
    {
        if ($course_requirement->restore()) {

            return $course_requirement;
        }

        throw new GeneralException(__('There was a problem restoring this Course Requirement. Please try again.'));
    }

    /**
     * @param CourseRequirement $course_requirement
     *
     * @return CourseRequirement
     * @throws GeneralException
     */
    public function destroy(CourseRequirement $course_requirement): bool
    {

        if ($course_requirement->forceDelete()) {

            return true;
        }

        throw new GeneralException('There was a problem permanently deleting this Course Requirement. Please try again.');
    }
}
