<?php

namespace App\Services;

use App\Exceptions\GeneralException;
use App\Models\CourseModuleContent;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class CourseModuleContentService.
 */
class CourseModuleContentService extends BaseService
{
    /**
     * CourseModuleContentService constructor.
     *
     * @param CourseModuleContent $course_module_content
     */
    public function __construct(CourseModuleContent $course_module_content)
    {
        $this->model = $course_module_content;
    }

    /**
     * @param array $data
     *
     * @return CourseModuleContent
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): CourseModuleContent
    {
        DB::beginTransaction();

        try {

            $course_module_content = CourseModuleContent::create($data);
            if (isset($data['value']) && $data['value'] instanceof \Illuminate\Http\UploadedFile) {
                $course_module_content->value = $course_module_content->uploadFile($data['value'], 'value');
                $course_module_content->save();
            }
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException($e->getMessage());
        }

        DB::commit();

        return $course_module_content;
    }

    /**
     * @param CourseModuleContent $course_module_content
     * @param array $data
     *
     * @return CourseModuleContent
     * @throws \Throwable
     */
    public function update(CourseModuleContent $course_module_content, array $data = []): CourseModuleContent
    {
        DB::beginTransaction();

        try {

            if (isset($data['value']) && $data['value'] instanceof \Illuminate\Http\UploadedFile) {
                $data['value'] = $course_module_content->uploadFile($data['value'], 'value');
            }

            $course_module_content->update($data);
        } catch (Exception $e) {

            DB::rollBack();
            throw new GeneralException(__('There was a problem updating this Course Module. Please try again.'));
        }

        DB::commit();

        return $course_module_content;
    }

    /**
     * @param CourseModuleContent $course_module_content
     *
     * @return CourseModuleContent
     * @throws GeneralException
     */
    public function delete(CourseModuleContent $course_module_content): CourseModuleContent
    {
        if ($this->deleteById($course_module_content->id)) {
            return $course_module_content;
        }

        throw new GeneralException('There was a problem deleting this Course Module. Please try again.');
    }

    /**
     * @param CourseModuleContent $course_module_content
     *
     * @return CourseModuleContent
     * @throws GeneralException
     */
    public function restore(CourseModuleContent $course_module_content): CourseModuleContent
    {
        if ($course_module_content->restore()) {

            return $course_module_content;
        }

        throw new GeneralException(__('There was a problem restoring this Course Module. Please try again.'));
    }

    /**
     * @param CourseModuleContent $course_module_content
     *
     * @return CourseModuleContent
     * @throws GeneralException
     */
    public function destroy(CourseModuleContent $course_module_content): bool
    {

        if ($course_module_content->forceDelete()) {

            return true;
        }

        throw new GeneralException('There was a problem permanently deleting this Course Module. Please try again.');
    }
}
