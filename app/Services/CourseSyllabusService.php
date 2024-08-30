<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\Course;
use App\Models\CourseSyllabus;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class CourseSyllabusService.
 */
class CourseSyllabusService extends BaseService
{
    /**
     * CourseSyllabusService constructor.
     *
     * @param CourseSyllabus $courseSyllabus
     */
    public function __construct(CourseSyllabus $courseSyllabus)
    {
        $this->model = $courseSyllabus;
    }

    /**
     * @param array $data
     *
     * @return CourseSyllabus
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): CourseSyllabus
    {
        DB::beginTransaction();

        try {

            foreach ($data['files'] as $file) {
                $courseSyllabus = CourseSyllabus::create(['course_id' => $data['course_id'], 'name' => $data['name']]);
                $courseSyllabus->file = $courseSyllabus->uploadFile($file, 'file');
                $courseSyllabus->save();
            }
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException($e->getMessage());
        }

        DB::commit();

        return $courseSyllabus;
    }

    /**
     * @param CourseSyllabus $courseSyllabus
     * @param array $data
     *
     * @return CourseSyllabus
     * @throws \Throwable
     */
    public function update(CourseSyllabus $courseSyllabus, array $data = []): CourseSyllabus
    {
        DB::beginTransaction();

        try {

            if (isset($data['file'])) {
                $data['file'] = $courseSyllabus->uploadFile($data['file'], 'file');
            }
            $courseSyllabus->update($data);
        } catch (Exception $e) {

            DB::rollBack();
            throw new GeneralException(__('There was a problem updating this Course Syllabus. Please try again.'));
        }

        DB::commit();

        return $courseSyllabus;
    }

    /**
     * @param CourseSyllabus $courseSyllabus
     *
     * @return CourseSyllabus
     * @throws GeneralException
     */
    public function delete(CourseSyllabus $courseSyllabus): CourseSyllabus
    {
        if (!$this->hasSoftDelete($courseSyllabus)) {
            $courseSyllabus->removeSyllabus();
        }
        if ($this->deleteById($courseSyllabus->id)) {
            return $courseSyllabus;
        }

        throw new GeneralException('There was a problem deleting this CourseSyllabus. Please try again.');
    }

    /**
     * @param CourseSyllabus $courseSyllabus
     *
     * @return CourseSyllabus
     * @throws GeneralException
     */
    public function restore(CourseSyllabus $courseSyllabus): CourseSyllabus
    {
        if ($courseSyllabus->restore()) {

            return $courseSyllabus;
        }

        throw new GeneralException(__('There was a problem restoring this CourseSyllabus. Please try again.'));
    }

    /**
     * @param CourseSyllabus $courseSyllabus
     *
     * @return CourseSyllabus
     * @throws GeneralException
     */
    public function destroy(CourseSyllabus $courseSyllabus): bool
    {

        if ($courseSyllabus->forceDelete()) {

            return true;
        }

        throw new GeneralException('There was a problem permanently deleting this CourseSyllabus. Please try again.');
    }
}
